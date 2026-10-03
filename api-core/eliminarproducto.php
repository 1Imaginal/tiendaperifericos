<?php
    include("conexion.php");

    if(!$session){
        header("Location: iniciosesion.php");
        exit();
    }
    
    $idProducto = mysqli_real_escape_string($con, $_POST['idProducto']);
    $id = $_SESSION["id"];

    $query = "DELETE FROM carrito where idUsuario = $id AND idProducto = $idProducto";

    // Evaluamos sin hacer 'echo' y corregimos el mensaje
    if (mysqli_query($con, $query)) {
        $mensaje = "Producto eliminado del carrito";
        $tipo = "warning"; // Usamos warning (amarillo) para denotar eliminación
    } else {
        $mensaje = "Error al eliminar el producto";
        $tipo = "danger";
    }

    header("Location: /carrito.php?mensaje=" . urlencode($mensaje) . "&tipo=" . $tipo);
    exit();
?>