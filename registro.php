<?php
    include("conexion.php");

    $usuario = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['pswd']);
    $password = password_hash($password, PASSWORD_DEFAULT);

    $query_select = "SELECT id FROM usuarios WHERE nombre = '$usuario'";
    $result = mysqli_query($con,$query_select);
    $row = mysqli_fetch_array($result);

    if($row == null){
        $query="INSERT INTO usuarios (nombre, password_hash)
        VALUES ('$usuario', '$password');";
    } else {
        $mensaje = "Nombre de usuario no disponible";
        $tipo = "danger";
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?mensaje=" . $mensaje . "&tipo=" . $tipo);
        exit();
    }

    if (mysqli_query($con, $query)) {
        $mensaje = "Registro exitoso";
        $tipo = "success";
        header("Location: index.php?mensaje=" . $mensaje . "&tipo=" . $tipo);
        exit();
    } else {
        $mensaje = "Registro fallido";
        $tipo = "danger";
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?mensaje=" . $mensaje . "&tipo=" . $tipo);
        exit();
    }

?>