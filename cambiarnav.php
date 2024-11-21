<?php
  include("conexion.php");
    if(isset($_GET['mensaje'])){
      $mensaje = $_GET['mensaje'];
      $tipo = $_GET['tipo'];
      echo "<div class='alert alert-$tipo alert-dismissible py-3 m-0'><button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button><strong>$mensaje</strong></div>";
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
                  <li><a class=\"dropdown-item\" href=\"compras.php\">Compras</a></li>";
      if($_SESSION["admin"]){
        echo "<li><a class=\"dropdown-item\" href=\"paneldecontrol.php\">Panel de control</a></li>";
      }
      echo "<li><a class=\"dropdown-item\" href=\"logout.php\">Cerrar sesion</a></li>
                </ul>
              </li>
            </ul>";
    }
  }
?>