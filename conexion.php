<?php
    $con = mysqli_connect("localhost", "root", "", "tienda_perifericos");
    
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    session_start();
    $session = false;
    if(isset($_SESSION["id"])){
        $session=true;
        $id = $_SESSION["id"];
        $query = "select nombre from usuarios where id = $id";

        $result = mysqli_query($con,$query);
        $row = mysqli_fetch_array($result);
        $nombre = $row["nombre"];
    } else {
        $nombre = "guest";
    }
    
?>