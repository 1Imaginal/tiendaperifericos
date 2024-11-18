<!DOCTYPE html>
<html lang="en">
<head>
    <?php
      include("cambiarnav.php");

      $idCat = $_GET['idCat'];
      $query = "SELECT p.id, p.modelo, p.idCat, p.idObj, f.nombre AS fabricante, p.precio, p.img FROM productos p INNER JOIN fabricante f ON f.id=p.idFab WHERE
      idCat = $idCat";

      if(mysqli_connect_errno()){ 
        echo "<div class=\"alert alert-success\"><strong>Error</strong>" . mysqli_connect_error() . "</div>";
      }

      $result = mysqli_query($con,$query);
      mysqli_close($con);
      ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
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
            </div>
          </div>
        </div>
      </nav>
      <div class="container-flex">
        <div class="container">
          <div class="row my-4">
              <?php
                  while($row = mysqli_fetch_array($result)){
                      echo "<div class=\"col my-3\">";
                      echo "<div class=\"card\" style=\"width:400px;  color: #735334;\">";
                      echo "<a href=\"detalles.php?id=" . $row['id'] . "&idCat=" . $row['idCat'] . "&idObj=" . $row['idObj'] . 
                      " \"style=\"text-decoration: none;  color: #735334;\">";
                      echo "<img class=\"card-img-top\" src=\"rsc/productos/" . $row['img'] . "\" alt=\"" . $row['modelo'] . "\">";
                      echo "<h4 class=\"card-title mx-3\">" . $row['modelo'] . "</h4>";
                      echo "</a>";
                      echo "<div class=\"card-body\">";
                      echo "<p class=\"card-text\">" . $row['fabricante'] . "</p>";
                      echo "<h5 class=\"card-text\">" . $row['precio']-0.01 . "$</h5>";
                      
                      echo "<form action=\"agregarproducto.php\" method=\"post\">";
                      echo "<input type=\"hidden\" name=\"idProducto\" value=\"" . $row['id'] . "\">";
                      echo "<input type=\"hidden\" name=\"idCat\" value=\"" . $row['idCat'] . "\">";
                      echo "<input type=\"hidden\" name=\"precio\" value=\"" . $row['precio'] . "\">";
                      echo "<button type=\"submit\" class=\"btn btn-primary\">Agregar al carrito</button>";
                      echo "</form>";
                      echo "</div></div></div>";
                  }
              ?>
          </div>
        </div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>