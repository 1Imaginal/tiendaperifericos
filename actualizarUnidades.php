<?php
    include("conexion.php");

    if (!$session) {
        header("Location: login.html");
        exit();
    }

    $id = $_SESSION["id"];
    $unidades = $_POST['unidades']; // Unidades seleccionadas
    $accion = $_POST['accion']; // Acción (incrementar o decrementar)

    // Recorrer el array de unidades
    foreach ($unidades as $idProducto => $cantidad) {
        // Verificar que la cantidad sea un valor válido
        if ($accion == 'incrementar') {
            $cantidad++;
        } elseif ($accion == 'decrementar' && $cantidad > 1) {
            $cantidad--;
        }

        // Actualizar las unidades en la tabla carrito
        $query_update = "UPDATE carrito SET unidades = $cantidad WHERE idProducto = $idProducto AND idUsuario = $id";
        
        if (!mysqli_query($con, $query_update)) {
            echo "<div class=\"alert alert-danger\"><strong>Error:</strong> " . mysqli_error($con) . "</div>";
        }
    }

    mysqli_close($con);

    // Redirigir nuevamente al carrito después de actualizar
    header("Location: carrito.php");
    exit();
?>