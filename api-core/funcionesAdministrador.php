<?php
    include("conexion.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $accion = $_POST['accion'];
        
        if ($accion == 'insertarProducto') {
            insertarProducto($con);
            $mensaje = "Producto insertado";
            $tipo = "success";
        } 
        elseif ($accion == 'actualizarProducto') {
            actualizarProducto($con);
            $mensaje = "Producto actualizado";
            $tipo = "warning";
        } 
        elseif ($accion == 'eliminarProducto') {
            eliminarProducto($con);
            $mensaje = "Producto eliminado";
            $tipo = "danger";
        }
        elseif ($accion == 'insertarFabricante') {
            insertarFabricante($con);
            $mensaje = "Fabricante insertado";
            $tipo = "success";
        }
        
        header("Location: ../paneldecontrol.php?mensaje=" . urlencode($mensaje) . "&tipo=" . $tipo);
        exit();
    }

    function insertarFabricante($con){

        $nombre = mysqli_real_escape_string($con, $_POST['nombre']);

        $query = "INSERT INTO  fabricante (nombre) VALUES ('$nombre')";

        if (!mysqli_query($con, $query)) {
            echo "<div class=\"alert alert-warning\">
            <strong>Error</strong> Registro fallido.
            </div>";
        }
    }


    function insertarProducto($con){

    // Nombre y ubicación temporal del archivo
    $fileName = basename($_FILES['img']['name']);
    $tempPath = $_FILES['img']['tmp_name'];

    // Validaciones
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'webp']; // Extensiones permitidas
    
    if (!in_array(strtolower($fileType), $allowedTypes)) {
        $mensaje = urlencode("Tipo de archivo no permitido.");
        header("Location: /paneldecontrol.php?mensaje=" . $mensaje . "&tipo=danger");
        exit();
    }

    $directorioDestino = $_SERVER['DOCUMENT_ROOT'] . "/rsc/productos/";

    if (!file_exists($directorioDestino)) {
        mkdir($directorioDestino, 0777, true);
    }

    if (!move_uploaded_file($tempPath, $directorioDestino . $fileName)) {
        $mensaje = urlencode("Error al subir el archivo de imagen.");
        header("Location: /paneldecontrol.php?mensaje=" . $mensaje . "&tipo=danger");
        exit();
    }

    // Escapar variables de seguridad
    $modelo = mysqli_real_escape_string($con, $_POST['modelo']);
    $idFabricante = mysqli_real_escape_string($con, $_POST['idFabricante']);
    $idCategoria = mysqli_real_escape_string($con, $_POST['idCategoria']);
    $precio = mysqli_real_escape_string($con, $_POST['precio']);
    $unidades = mysqli_real_escape_string($con, $_POST['unidades']);
    $caracteristica1 = mysqli_real_escape_string($con, $_POST['caracteristica1']);
    $caracteristica2 = mysqli_real_escape_string($con, $_POST['caracteristica2']);
    $caracteristica3 = mysqli_real_escape_string($con, $_POST['caracteristica3']);

    // Definir consultas específicas por categoría
    switch($idCategoria){
        case 1:
            $query_temp = "INSERT INTO mouse (forma, sensor, peso) VALUES ('$caracteristica1', '$caracteristica2', '$caracteristica3');";
            $categoria = "mouse";
            break;
        case 2:
            $query_temp = "INSERT INTO teclado (tamano, switches, rgb) VALUES ('$caracteristica1', '$caracteristica2', '$caracteristica3');";
            $categoria = "teclado";
            break;
        case 3:
            $query_temp = "INSERT INTO mousepad (material, tamano, color) VALUES ('$caracteristica1', '$caracteristica2', '$caracteristica3');";
            $categoria = "mousepad"; // Corregido: Faltaban las comillas aquí
            break;
    }

    // Insertar características específicas
    if (!mysqli_query($con, $query_temp)) {
        $mensaje = urlencode("Error al registrar características del producto.");
        header("Location: /paneldecontrol.php?mensaje=" . $mensaje . "&tipo=warning");
        exit();
    }

    // Obtener el ID recién creado
    $query_ultimoID = "SELECT id from $categoria ORDER BY id DESC LIMIT 1";
    $result_ultimoID = mysqli_query($con, $query_ultimoID);
    $row_ultimoID = mysqli_fetch_array($result_ultimoID);
    $ultimoID = $row_ultimoID["id"];

    // Insertar en la tabla principal de productos
    $query = "INSERT INTO productos (modelo, idObj, idFab, idCat, precio, unidades, img)
              VALUES ('$modelo', $ultimoID, $idFabricante, $idCategoria, $precio, $unidades, '$fileName');";

    if (!mysqli_query($con, $query)) {
        $mensaje = urlencode("Error al registrar el producto principal.");
        header("Location: /paneldecontrol.php?mensaje=" . $mensaje . "&tipo=warning");
        exit();
    }
    
    // Si todo salió bien, redirige con mensaje de éxito
    $mensaje = urlencode("Producto agregado correctamente.");
    header("Location: /paneldecontrol.php?mensaje=" . $mensaje . "&tipo=success");
    exit();
}

function actualizarProducto($con){
    $idProducto = mysqli_real_escape_string($con, $_POST['idProducto']);
    $unidades = mysqli_real_escape_string($con, $_POST['unidades']);

    // Validación de unidades
    if($unidades < 0 || $unidades == ''){
        $mensaje = urlencode("Numero de unidades no valido");
        header("Location: /paneldecontrol.php?mensaje=" . $mensaje . "&tipo=danger");
        exit();
    }

    $query = "UPDATE productos SET unidades = $unidades WHERE id = $idProducto";

    // Manejo de error en la base de datos
    if (!mysqli_query($con, $query)) {
        $mensaje = urlencode("Registro fallido");
        header("Location: /paneldecontrol.php?mensaje=" . $mensaje . "&tipo=warning");
        exit();
    }
    
    // Manejo de éxito
    $mensaje = urlencode("Producto actualizado");
    header("Location: /paneldecontrol.php?mensaje=" . $mensaje . "&tipo=success");
    exit();
}

    function eliminarProducto($con){

        $idProducto = mysqli_real_escape_string($con, $_POST['idProducto']);

        $query= "SELECT img, idObj, idCat FROM productos WHERE id = $idProducto";
        $result= mysqli_query($con, $query);
    
        $row = mysqli_fetch_assoc($result);
        $imagePath = "rsc/productos/" . $row['img']; // Ruta completa de la imagen

        // Verifica si el archivo existe y elimínalo
        if (file_exists($imagePath)) {
            if (!unlink($imagePath)) {
                echo "<div class=\"alert alert-warning\">
                <strong>Error</strong> No se pudo eliminar la imagen del producto.
                </div>";
                return; // Evita continuar si no se elimina la imagen
            }
        }
    
        $idObjeto = $row['idObj'];
        $idCategoria = $row['idCat'];

        switch($idCategoria){
            case 1:
                $categoria = "mouse";
                break;
            case 2:
                $categoria = "teclado";
                break;
            case 3:
                $categoria = mousepad;
                break;
        }

        $query_delete_categoria = "DELETE FROM $categoria WHERE id = $idObjeto";

        $query_delete_producto = "DELETE FROM productos WHERE id = $idProducto";
    
        if (!mysqli_query($con, $query_delete_categoria)) {
            echo "<div class=\"alert alert-warning\">
            <strong>Error</strong> No se pudo eliminar el producto.
            </div>";
        }

        if (!mysqli_query($con, $query_delete_producto)) {
            echo "<div class=\"alert alert-warning\">
            <strong>Error</strong> No se pudo eliminar el producto.
            </div>";
        }
    }

?>