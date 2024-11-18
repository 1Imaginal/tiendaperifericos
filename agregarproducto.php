<?php
    include("conexion.php");

    $idProducto = mysqli_real_escape_string($con, $_POST['idProducto']);
    $precio = mysqli_real_escape_string($con, $_POST['precio']);

    if(!$session){
        header("Location: login.html");
        exit();
    }

    $id = $_SESSION["id"];

    $query = "INSERT INTO carrito (idUsuario, idProducto, unidades, precio) VALUES ('$id', '$idProducto', 1, $precio);";

    if (mysqli_query($con, $query)) {
        echo "Producto agregado al carrito";
    } else {
        echo "Error: " . mysqli_error($con);
    }

    header("Location: carrito.php");
    exit();
?>