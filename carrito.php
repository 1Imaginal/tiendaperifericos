<?php
      include("cambiarnav.php");

      if(!$session){
        header("Location: login.html");
        exit();
      }
      $id = $_SESSION["id"];
      $query = "SELECT p.modelo AS producto, p.img, p.id, p.idCat, p.idObj, c.unidades, c.precio FROM carrito c 
      INNER JOIN productos p ON c.idProducto=p.id where idUsuario = $id";

      if(mysqli_connect_errno()){ 
        echo "<div class=\"alert alert-success\"><strong>Error</strong>" . mysqli_connect_error() . "</div>";
      }

      $result = mysqli_query($con,$query);
      mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="rsc/style.css">
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
            cambiarnav($session, $nombre);
            ?>
        </div>
      </div>
    </div>
  </nav>
    <?php
      $total=0;
      while($row = mysqli_fetch_array($result)){
        $total += ($row['precio'] - 0.01)*$row['unidades'];
        echo "<div class=\"container\">";
        echo "<div class=\"row\">";
        echo "<div class=\"col-3 my-2\">";
        echo "<a href=\"detalles.php?id=" . $row['id'] . "&idCat=" . $row['idCat'] . "&idObj=" . $row['idObj'] . 
                " \"style=\"text-decoration: none; color: #735334;\">";
        echo "<img class=\"img-thumbnail float-start\" src=\"rsc/productos/" . $row['img'] . "\" alt=\"" . $row['producto'] . 
                    "\"style=\"width:250px; height:200px;\">";
        echo "</a>";
        echo "</div><div class=\"col-3 my-4\"> ";
        echo "<a href=\"detalles.php?id=" . $row['id'] . "&idCat=" . $row['idCat'] . "&idObj=" . $row['idObj'] . 
        " \"style=\"text-decoration: none; color: #735334;\">";
        echo "<h2>" . $row['producto'] . "</h2>";
        echo "</a>";

        echo "<form action=\"actualizarUnidades.php\" method=\"POST\">";
        echo "<label for=\"unidades-" . $row['id'] . "\" class=\"form-label\">Unidades:</label>";
        echo "<div class=\"d-flex align-items-center\">";
        echo "<button type=\"submit\" name=\"accion\" value=\"decrementar\" class=\"btn btn-danger\">-</button>";
        echo "<input type=\"number\" class=\"form-control mx-2\" id=\"unidades-" . $row['id'] . "\" name=\"unidades[" . $row['id'] . "]\" value=\"" . $row['unidades'] . "\" min=\"1\" max=\"10\" readonly>";
        echo "<button type=\"submit\" name=\"accion\" value=\"incrementar\" class=\"btn btn-success\">+</button>";
        echo "</div>";
        echo "</form>";

        echo "<h4>" . $row['precio'] - 0.01 . "$</h4>";
        echo "</div> <div class=\"col-1 \"></div> <div class=\"col-2\">";
        echo "<form action=\"eliminarproducto.php\" method=\"post\">";
        echo "<button type=\"submit\" class=\"btn btn-danger btn-lg my-5\">Eliminar</button>";
        echo "<input type=\"hidden\" name=\"idProducto\" value=\"" . $row['id'] . "\">";
        echo "</form>";
        echo "</div></div></div>";
      }
    ?>
  
  <div class="container my-4">
    <div class="row">
      <div class="col-7">
        <h2>Total: <?php echo $total ."$"; ?></h2>
        <input type="hidden" id="total" value="<?php echo $total ?>">
      </div>
      <div class="col">
        <form action="realizarpedido.php" method="post">
          <button type="submit" class="btn btn-outline-success btn-lg" id="realizarPedido" hidden>Realizar pedido</button>
        </form>
      </div>
    </div>
  </div>
<script>
  if(document.getElementById('total').value > 0){
    document.getElementById('realizarPedido').hidden = false;
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
