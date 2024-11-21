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
        
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?mensaje=" . $mensaje . "&tipo=" . $tipo);
        exit();
    }


    function insertarProducto($con){

        $uploadDir = "rsc/productos/";
    
        
        // Nombre y ubicación temporal del archivo
        $fileName = basename($_FILES['img']['name']);
        $tempPath = $_FILES['img']['tmp_name'];
        
        // Ruta completa donde se guardará el archivo
        $uploadFilePath = $uploadDir . $fileName;

        // Validaciones (opcional)
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'webp']; // Extensiones permitidas
        if (!in_array(strtolower($fileType), $allowedTypes)) {
            echo "Tipo de archivo no permitido.";
            exit();
        }

        // Mover el archivo desde el directorio temporal al directorio destino
        if (!move_uploaded_file($tempPath, $uploadFilePath)) {
            echo "Error al subir el archivo";
        }

        $modelo = mysqli_real_escape_string($con, $_POST['modelo']);
        $idFabricante = mysqli_real_escape_string($con, $_POST['idFabricante']);
        $idCategoria = mysqli_real_escape_string($con, $_POST['idCategoria']);
        $precio = mysqli_real_escape_string($con, $_POST['precio']);
        $unidades = mysqli_real_escape_string($con, $_POST['unidades']);
        $caracteristica1 = mysqli_real_escape_string($con, $_POST['caracteristica1']);
        $caracteristica2 = mysqli_real_escape_string($con, $_POST['caracteristica2']);
        $caracteristica3 = mysqli_real_escape_string($con, $_POST['caracteristica3']);

        switch($idCategoria){
            case 1:
                $query_temp="INSERT INTO mouse (forma, sensor, peso)
                VALUES ('$caracteristica1', '$caracteristica2', '$caracteristica3');";

                $categoria = "mouse";
                break;
            case 2:
                $query_temp="INSERT INTO teclado (tamano, switches, rgb)
                VALUES ('$caracteristica1', '$caracteristica2', '$caracteristica3');";

                $categoria = "teclado";
                break;
            case 3:
                $query_temp="INSERT INTO mousepad (material, tamano, color)
                VALUES ('$caracteristica1', '$caracteristica2', '$caracteristica3');";

                $categoria = mousepad;
                break;
        }

        if (!mysqli_query($con, $query_temp)) {
            echo "<div class=\"alert alert-warning\">
            <strong>Error</strong> Registro fallido.
            </div>";
        }

        $query_ultimoID = "SELECT id from $categoria ORDER BY id DESC LIMIT 1";
        $result_ultimoID = mysqli_query($con,$query_ultimoID);
        $row_ultimoID = mysqli_fetch_array($result_ultimoID);
        $ultimoID = $row_ultimoID["id"];

        $query="INSERT INTO productos (modelo, idObj, idFab, idCat, precio, unidades, img)
        VALUES ('$modelo', $ultimoID, $idFabricante, $idCategoria, $precio, $unidades, '$fileName');";

        if (!mysqli_query($con, $query)) {
            echo "<div class=\"alert alert-warning\">
            <strong>Error</strong> Registro fallido.
            </div>";
        }
    
    }

    function actualizarProducto($con){

        $idProducto = mysqli_real_escape_string($con, $_POST['idProducto']);
        $unidades = mysqli_real_escape_string($con, $_POST['unidades']);

        $query = "UPDATE productos SET unidades = $unidades WHERE id = $idProducto";

        if (!mysqli_query($con, $query)) {
            echo "<div class=\"alert alert-warning\">
            <strong>Error</strong> Registro fallido.
            </div><script>alert(\"unidades actualizadas\"></script>";
        }
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