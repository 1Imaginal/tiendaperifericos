<?php
    include("conexion.php");

    if(!$session){
        header("Location: login.html");
        exit();
    }

    $idProducto = mysqli_real_escape_string($con, $_POST['idProducto']);
    $precio = mysqli_real_escape_string($con, $_POST['precio']);
    $id = $_SESSION["id"];

    $query_select = "SELECT idProducto, unidades FROM carrito WHERE idUsuario = $id AND idProducto = $idProducto";
    $result = mysqli_query($con,$query_select);
    $row = mysqli_fetch_array($result);

    if($row == null){
        $query = "INSERT INTO carrito (idUsuario, idProducto, unidades, precio) VALUES ('$id', '$idProducto', 1, $precio);";
    } else {
        $unidades = $row['unidades'] + 1;
        $query = "UPDATE carrito SET unidades = $unidades WHERE idProducto = $idProducto AND idUsuario = $id";
    }
    
    // Evaluamos si funciona y definimos el mensaje sin hacer 'echo'
    if (mysqli_query($con, $query)) {
        $mensaje = "Producto añadido al carrito";
        $tipo = "success";
    } else {
        $mensaje = "Error al añadir producto";
        $tipo = "danger";
    }

    // Usamos urlencode() por si el mensaje tiene espacios
    header("Location: ../carrito.php?mensaje=" . urlencode($mensaje) . "&tipo=" . $tipo);
    exit();
?>