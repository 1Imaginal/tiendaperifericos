<?php
    include("conexion.php");

    $idProducto = mysqli_real_escape_string($con, $_POST['idProducto']);

    if(!$session){
        header("Location: login.html");
        exit();
    }
    
    $id = $_SESSION["id"];

    $query = "DELETE FROM carrito where idUsuario = $id AND idProducto = $idProducto";

    // Ejecutar la consulta y verificar el resultado
    if (mysqli_query($con, $query)) {
        echo "Producto agregado al carrito";
    } else {
        echo "Error: " . mysqli_error($con);
    }

    header("Location: carrito.php");
    exit();
?>