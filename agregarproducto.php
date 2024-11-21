<?php
    include("conexion.php");

    $idProducto = mysqli_real_escape_string($con, $_POST['idProducto']);
    $precio = mysqli_real_escape_string($con, $_POST['precio']);

    if(!$session){
        header("Location: login.html");
        exit();
    }

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
    

    if (mysqli_query($con, $query)) {
        echo "Producto agregado al carrito";
    } else {
        echo "Error: " . mysqli_error($con);
    }

    $mensaje = "Producto añadido al carrito";
    $tipo = "success";
    header("Location: carrito.php?mensaje=" . $mensaje . "&tipo=" . $tipo);
    exit();
?>