<?php
  include("cambiarnav.php");

  if(!$session){
    header("Location: login.html");
    exit();
  }
  $id = $_SESSION["id"];
  $query = "SELECT p.id, p.modelo, p.idCat, p.unidades, p.idObj, f.nombre AS fabricante, p.precio, p.img FROM productos p INNER JOIN fabricante f ON f.id=p.idFab";

  if(mysqli_connect_errno()){ 
    echo "<div class=\"alert alert-success\"><strong>Error</strong>" . mysqli_connect_error() . "</div>";
  }

  $result = mysqli_query($con,$query);
  
  $query_fabricante = "SELECT * FROM fabricante";

  if(mysqli_connect_errno()){ 
    echo "<div class=\"alert alert-success\"><strong>Error</strong>" . mysqli_connect_error() . "</div>";
  }
  $result_fabricante = mysqli_query($con,$query_fabricante);

  $query_transacciones = "SELECT p.modelo AS producto, c.unidades, c.precio, c.fecha, c.idUsuario FROM compras c 
    INNER JOIN productos p ON c.idProducto=p.id ORDER BY c.fecha DESC"; 
      
  if(mysqli_connect_errno()){ 
    echo "<div class=\"alert alert-success\"><strong>Error</strong>" . mysqli_connect_error() . "</div>";
  }

  $result_transacciones = mysqli_query($con,$query_transacciones);
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
  <div class="container-flex m-3">
    <h1>Panel de control</h1>
    <form action="funcionesAdministrador.php">
    <input type="hidden" name="accion" value="actualizarProducto">
    <div class="mb-3 mt-3">
      <select class="form-select" aria-label="Producto a modificar" name="idProducto">
      <option selected disabled>Producto a modificar</option>
        <?php
          while($row = mysqli_fetch_array($result)){
            echo "<option value=" . $row["id"] . ">" . $row["modelo"] . "</option>";
          }
        ?>
      </select>
      <div class="row my-4">
        <div class="col">
          <input type="number" class="form-control mx-2" id="unidades" name="unidades">
        </div>
        <div class="col">
          <button type="submit" class="btn btn-success">Actualizar unidades</button> <button type="submit" class="btn btn-danger mx-4">Eliminar producto</button>
        </div>
      </div>
    </form>
    <div class="container-flex m-3">
    <h1>Insertar producto</h1>
    <form action="funcionesAdministrador.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="accion" value="insertarProducto">
            <div class="my-3">
              <label for="modelo" class="form-label">Modelo</label>
              <input type="text" class="form-control" id="modelo" placeholder="Modelo del producto" name="modelo" required>
            </div>
            <div class="mb-3">
              <label for="fabricante" class="form-label">Fabricante</label>
              <select class="form-select" aria-label="Producto a modificar" name="idFabricante" required>
                <option selected disabled>Fabricante del producto</option>
                  <?php
                    while($row = mysqli_fetch_array($result_fabricante)){
                      echo "<option value=" . $row["id"] . ">" . $row["nombre"] . "</option>";
                    }
                  ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="idCategoria" class="form-label">Categoria</label>
              <select class="form-select" aria-label="Producto a modificar" name="idCategoria" required>
                <option selected disabled value="">Categoria del producto</option>
                <option value="1">Mouse</option>
                <option value="2">Teclado</option>
                <option value="3">Mousepad</option>
              </select>
            </div>
            <div class="row my-3">
              <div class="col-4">
                <label for="caracteristica1" class="form-label">Caracteristica 1</label>
                <input type="text" class="form-control" id="caracteristica1" placeholder="Caracteristica" name="caracteristica1">
              </div>
              <div class="col-4">
                <label for="caracteristica2" class="form-label">Caracteristica 2</label>
                <input type="text" class="form-control" id="caracteristica2" placeholder="Caracteristica" name="caracteristica2">
              </div>
              <div class="col-4">
                <label for="caracteristica1" class="form-label">Caracteristica 3</label>
                <input type="text" class="form-control" id="caracteristica3" placeholder="Caracteristica" name="caracteristica3">
              </div>
            </div>
            <div class="mb-3">
              <label for="precio" class="form-label">Precio</label>
              <input type="number" class="form-control" id="precio" placeholder="Precio del producto" name="precio" min="0" required>
            </div>
            <div class="mb-3">
              <label for="unidades" class="form-label">Unidades</label>
              <input type="number" class="form-control" id="unidades" placeholder="Precio del producto" name="unidades" min="0" required>
            </div>
            <div class="mb-3">
              <label for="img" class="form-label">Imagen</label>
              <input type="file" class="form-control" id="img" placeholder="Imagen del producto" name="img">
            </div>
            <button type="submit" class="btn btn-primary">Insertar producto</button>
          </form>
    </div>
    <div class="container-flex m-3">
    <h1>Historial de transacciones</h1>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Usuario</th>
          <th>Producto</th>
          <th>Unidades</th>
          <th>Precio</th>
          <th>Fecha</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while($row = mysqli_fetch_array($result_transacciones)){
            echo "<tr>";
            echo "<td>" . $row["idUsuario"] . "</td>";
            echo "<td>" . $row["producto"] . "</td>";
            echo "<td>" . $row["unidades"] . "</td>";
            echo "<td>" . $row["precio"] . "</td>";
            echo "<td>" . $row["fecha"] . "</td>";
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>
  </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
