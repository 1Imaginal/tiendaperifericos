<?php
    include("conexion.php");

    $usuario = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['pswd']);

    $query = "SELECT id, admin from usuarios WHERE nombre = \"$usuario\" AND password_hash = \"$password\"";

    
    $result = mysqli_query($con,$query);
    $row = mysqli_fetch_array($result);

    if($row != null){
        session_start();
        $_SESSION["id"] = $row["id"];
        $_SESSION["admin"] = $row["admin"];
        echo "<h1> Sesion iniciada </h1>";
    } else {
        echo "<h1> Inicio de sesion fallido </h1>";
    }

    header("Location: index.php");
    exit();
?>