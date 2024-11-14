<?php
  include("conexion.php");
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

  function cambiarnav($session, $nombre){
    if(!$session){
      echo "<ul class=\"navbar-nav me-auto\">
              <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"registro.html\">Registrarse</a>
              </li>
              <li class=\"nav-item\">
                <a class=\"nav-link\" href=\"login.html\">Iniciar Sesion</a>
              </li>
            </ul>";
    } else {
      echo "
            <ul class=\"navbar-nav me-auto\">
              <li class=\"nav-item dropdown me-auto mx-3\">
                <a class=\"nav-link dropdown-toggle\" href=\"#\" role=\"button\" data-bs-toggle=\"dropdown\">" .$nombre . "</a>
                <ul class=\"dropdown-menu dropdown-menu-end\">
                  <li><a class=\"dropdown-item\" href=\"carrito.php\">Carrito</a></li>
                  <li><a class=\"dropdown-item\" href=\"favoritos.php\">Favoritos</a></li>
                  <li><a class=\"dropdown-item\" href=\"compras.php\">Compras</a></li>
                    <li><a class=\"dropdown-item\" href=\"logout.php\">Cerrar sesion</a></li>
                </ul>
              </li>
            </ul>";
    }
  }
?>