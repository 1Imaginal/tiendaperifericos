<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include("cambiarnav.php");

        $id = $_GET['id'];
        $idCat = $_GET['idCat'];
        $idObj = $_GET['idObj'];
        
        $query_producto  = "SELECT p.modelo, p.precio, p.img, p.unidades, p.descripcion, f.nombre AS fabricante FROM productos p
        INNER JOIN fabricante f ON f.id=p.idFab  WHERE idCat = $idCat AND p.id = $id";

        $result_producto = mysqli_query($con,$query_producto);
        $row_producto = mysqli_fetch_array($result_producto);

        switch($idCat){
          case 1:
            $query_caracteristicas = "SELECT forma, sensor, peso FROM mouse WHERE id = $idObj";
            break;
          case 2:
            $query_caracteristicas = "SELECT tamano, switches, rgb FROM teclado WHERE id = $idObj";
            break;
          case 3:
            $query_caracteristicas = "SELECT  material, tamano, color FROM mousepad WHERE id = $idObj";
            break;
        }

        $result_caracteristicas = mysqli_query($con,$query_caracteristicas);
        $row_caracteristicas = mysqli_fetch_assoc($result_caracteristicas);

        if(mysqli_connect_errno()){ 
          echo "<div class=\"alert alert-success\"><strong>Error</strong>" . mysqli_connect_error() . "</div>";
        }
  


        mysqli_close($con);
  
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Tienda</title>
</head>
<body>
  <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #99846e;">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Tienda perifericos</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="productos.php?idCat=1">Mouse</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="productos.php?idCat=2">Teclado</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="productos.php?idCat=3">Mousepad</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="text" placeholder="Busca un producto">
          <button class="btn btn-primary" type="button" action="resultado.php" method="get">Buscar</button>
        </form>
        <div class="d-flex flex-row-reverse">
              <?php
                cambiarnav($session,$nombre);
              ?>
          </ul>
        </div>
      </div>
    </div>
  </nav>
      <div class="container my-4">
        <div class="row">
            <div class="col-12 col-md-6">
                    <img src="rsc/productos/<?php echo$row_producto['img'];?>"  alt="producto" class="img-fluid">
            </div>
            <div class="col-12 col-md-6 my-5" style="text-align:justify;">
                <h5 class="my-3"><?php echo $row_producto['fabricante']?></h5>
                <h2 class="my-3"><?php echo $row_producto['modelo']?></h2>
                <h4 class="my-3"><?php echo $row_producto['precio']-0.01 . "$"?></h4>

                <h3>Caracteristicas</h3>
                <ul>
                <?php
                   switch($idCat){
                    case 1:
                      echo "<li class=\"my-3\">Forma : " . $row_caracteristicas["forma"] . "</li>";
                      echo "<li class=\"my-3\">Sensor : " . $row_caracteristicas["sensor"] . "</li>"; 
                      echo "<li class=\"my-3\">Peso : " . $row_caracteristicas["peso"] . "</li>";
                      break;
                    case 2:
                      echo "<li class=\"my-3\">Tamaño : " . $row_caracteristicas["tamano"] . "</li>";
                      echo "<li class=\"my-3\">Switches : " . $row_caracteristicas["switches"] . "</li>"; 
                      echo "<li class=\"my-3\">RGB : " . $row_caracteristicas["rgb"] . "</li>";
                      break;
                    case 3:
                      echo "<li class=\"my-3\">Material : " . $row_caracteristicas["material"] . "</li>";
                      echo "<li class=\"my-3\">Tamaño : " . $row_caracteristicas["tamano"] . "</li>"; 
                      echo "<li class=\"my-3\">Color : " . $row_caracteristicas["color"] . "</li>";
                      break;
                   }
                   
                   echo "<li class=\"my-4\">" . $row_producto["unidades"] . " Unidades disponibles</li>";

                   echo "<form action=\"agregarproducto.php\" method=\"post\">";
                   echo "<input type=\"hidden\" name=\"idProducto\" value=\"" . $id . "\">";
                   echo "<input type=\"hidden\" name=\"idCat\" value=\"" . $idCat . "\">";
                   echo "<input type=\"hidden\" name=\"precio\" value=\"" . $row_producto['precio'] . "\">";
                   echo "<button type=\"submit\" class=\"btn btn-primary\">Agregar al carrito</button>";
                   echo "</form>";

                   if(isset($_SESSION["admin"])){
                    if($_SESSION["admin"]){
                      echo "<form action=\"funcionesAdministrador.php\" method=\"post\">";
                      echo "
                      <input type=\"hidden\" name=\"idProducto\" value=\"" . $id . "\">
                      <div class=\"row my-4\">
                        <div class=\"col\">
                          <input type=\"number\" class=\"form-control mx-2\" id=\"unidades\" name=\"unidades\" placeholder=" . $row_producto["unidades"] . ">
                        </div>
                        <div class=\"col\">
                          <button type=\"submit\"class=\"btn btn-success\" name=\"accion\" value=\"actualizarProducto\">Actualizar unidades</button>
                        </div>
                        <button type=\"submit\"class=\"btn btn-danger my-5\" name=\"accion\" value=\"eliminarProducto\">Eliminar producto</button>
                      </div>";
                      echo "</div>";
                      echo "</form>";
                    }
                  } 
                ?>
                </ul>

            </div>
        </div>
      </div>
      <div class="container my-0 py-2" style="font-size: 2em">
        <h3 class="display-5">Descripción</h3>
        <?php echo "<p>" . $row_producto["descripcion"] . "</p>"; ?>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>