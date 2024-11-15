<?php
    include("conexion.php");

    $idProducto = mysqli_real_escape_string($con, $_POST['idProducto']);

    if($session){
        $id = $_SESSION["id"];

        $query = "DELETE FROM carrito where idUsuario = $id AND idProducto = $idProducto";

    } else {
        $query = "DELETE FROM carrito where idUsuario = $id";
    }

    // Ejecutar la consulta y verificar el resultado
    if (mysqli_query($con, $query)) {
        echo "Producto agregado al carrito";
    } else {
        echo "Error: " . mysqli_error($con);
    }

    header("Location: carrito.php");
    exit();
?>