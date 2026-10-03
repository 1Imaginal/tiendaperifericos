<?php
$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: 'admin_perifericos'; // Tu contraseña local por defecto
$database = getenv('DB_NAME') ?: 'tienda_perifericos';

// Una sola conexión utilizando las variables
$con = mysqli_connect($host, $user, $password, $database);

if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}

session_start();
$session = false;
if(isset($_SESSION["id"])){
    $session = true;
    $id = $_SESSION["id"];
    $query = "SELECT nombre FROM usuarios WHERE id = $id";

    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $nombre = $row["nombre"];
} else {
    $nombre = "guest";
}
?>