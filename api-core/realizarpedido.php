<?php
    include("conexion.php");

    if(!$session){
        header("Location: iniciosesion.php");
        exit();
    }

    $id = $_SESSION["id"];
    $query = "SELECT idProducto, unidades, precio FROM carrito where idUsuario = $id";

    if(mysqli_connect_errno()){ 
        die("Error de conexión: " . mysqli_connect_error());
    }

    $result = mysqli_query($con,$query);

    if (!$result) {
        die("Error en la consulta: " . mysqli_error($con));
    }

    while($row = mysqli_fetch_array($result)){
        $idProducto = $row["idProducto"];
        $unidades = $row["unidades"];
        $precio = $row["precio"] - 0.01;
        $subtotal = $precio * $unidades; // Este es tu 'total'

        $query_unidades = "SELECT unidades from productos where id=$idProducto";
        $result_unidades = mysqli_query($con,$query_unidades);
        $row_unidades = mysqli_fetch_array($result_unidades);
        $unidades_disponibles = $row_unidades["unidades"];

        if($unidades > $unidades_disponibles){
            $mensaje = "No hay suficientes unidades disponibles de algún producto";
            $tipo = "danger";
            header("Location: carrito.php?mensaje=" . urlencode($mensaje) . "&tipo=" . $tipo);
            exit();
        }

        // CORRECCIÓN AQUÍ: Se añade 'total' y se ordenan los valores correctamente
        $query_insert = "INSERT INTO compras(idUsuario, idProducto, total, precio, unidades) VALUES ($id, $idProducto, $subtotal, $precio, $unidades)";
        mysqli_query($con, $query_insert);

        $query_updateUnidades = "UPDATE productos SET unidades = $unidades_disponibles - $unidades WHERE id=$idProducto";
        mysqli_query($con, $query_updateUnidades);
    }

    $query_limpiarCarrito = "DELETE FROM carrito WHERE idUsuario = $id";
    mysqli_query($con, $query_limpiarCarrito);

    mysqli_close($con);
    
    $mensaje = "Pedido realizado con éxito";
    $tipo = "success";
    header("Location: ../compras.php?mensaje=" . urlencode($mensaje) . "&tipo=" . $tipo);
    exit();
?>