<?php
    include("conexion.php");

    $usuario = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['pswd']);
    $password = password_hash($password, PASSWORD_DEFAULT);

    $query="INSERT INTO usuarios (nombre, password_hash)
    VALUES ('$usuario', '$password');";

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