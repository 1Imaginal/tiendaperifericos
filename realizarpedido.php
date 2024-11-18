<?php
    include("conexion.php");

    if(!$session){
        header("Location: login.html");
        exit();
    }

    

    $id = $_SESSION["id"];
    $query = "SELECT idProducto, unidades, precio FROM carrito where idUsuario = $id";

    if(mysqli_connect_errno()){ 
        echo "<div class=\"alert alert-danger\"><strong>Error</strong>" . mysqli_connect_error() . "</div>";
      }

      $result = mysqli_query($con,$query);

      if (!$result) {
        die("<div class=\"alert alert-danger\"><strong>Error:</strong> " . mysqli_error($con) . "</div>");
    }

    while($row = mysqli_fetch_array($result)){
        $idProducto = $row["idProducto"];
        $unidades = $row["unidades"];
        $precio = $row["precio"]-0.01;
        $subtotal=$precio*$unidades;

        $query_unidades = "SELECT unidades from productos where id=$idProducto";
        $result_unidades = mysqli_query($con,$query_unidades);
        $row_unidades = mysqli_fetch_array($result_unidades);
        $unidades_disponibles = $row_unidades["unidades"];

        if($unidades > $unidades_disponibles){
            die("<div class=\"alert alert-danger\"><strong>No hay suficientes unidades</strong></div>");
        }

        $query_insert = "INSERT INTO compras(idUsuario, idProducto, unidades, precio) VALUES ($id, $idProducto, $unidades, $subtotal)";

        if (!mysqli_query($con, $query_insert)) {
            echo "<div class=\"alert alert-danger\"><strong>Error:</strong> " . mysqli_error($con) . "</div>";
        }

        $query_updateUnidades = "UPDATE productos SET unidades = $unidades_disponibles-$unidades WHERE id=$idProducto";

        if (!mysqli_query($con, $query_updateUnidades)) {
            echo "<div class=\"alert alert-danger\"><strong>Error:</strong> " . mysqli_error($con) . "</div>";
        }
      }

    $query_limpiarCarrito = "DELETE FROM carrito WHERE idUsuario = $id";
    if (!mysqli_query($con, $query_limpiarCarrito)) {
    echo "<div class=\"alert alert-danger\"><strong>Error:</strong> " . mysqli_error($con) . "</div>";
    }

    mysqli_close($con);

    header("Location: compras.php");
    exit();
?>