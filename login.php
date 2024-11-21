<?php
    include("conexion.php");

    $usuario = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['pswd']);

    $query = "SELECT id, password_hash, admin from usuarios WHERE nombre = \"$usuario\"";

    $result = mysqli_query($con,$query);
    $row = mysqli_fetch_array($result);

    if($row != null){
        if(password_verify($password,$row["password_hash"])){
            session_start();
            $_SESSION["id"] = $row["id"];
            $_SESSION["admin"] = $row["admin"];
            echo "<h1> Sesion iniciada </h1>";
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "<h1> Usuario no existente </h1>";
    }

    header("Location: index.php");
    exit();
?>