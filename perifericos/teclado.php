<!DOCTYPE html>
<html lang="en">
<head>
    <?php
      include("../conexion.php");

      $query = "SELECT t.modelo, f.nombre AS fabricante, t.precio FROM teclado t INNER JOIN fabricante f ON f.id=t.idFab";

      if(mysqli_connect_errno()){ 
        echo "<div class=\"alert alert-success\"><strong>Error</strong>" . mysqli_connect_error() . "</div>";
      }

      $result = mysqli_query($con,$query);
      mysqli_close($con);
      ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Tienda</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="../index.html">Tienda perifericos</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="navbar-nav me-auto">
              <li class="nav-item">
                <a class="nav-link" href="mouse.php">Mouse</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="teclado.php">Teclado</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="mousepad.php">Mousepad</a>
              </li>
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="text" placeholder="Busca un producto">
              <button class="btn btn-primary" type="button" action="resultado.php" method="get">Buscar</button>
            </form>
          </div>
        </div>
      </nav>
      <div class="container my-4">
        <table class="table table striped">
          <thead>
            <tr>
              <th>Modelo</th>
              <th>Fabricante</th>
              <th>Precio</th>
            </tr>
          </thead>
          <tbody>
          <?php
                while($row = mysqli_fetch_array($result)){
                  echo "<tr>";
                  echo "<td>" . $row['modelo'] . "</td>";
                  echo "<td>" . $row['fabricante'] . "</td>";
                  echo "<td>" . $row['precio'] . '$' .  "</td>";
                  echo "</tr>";
                }
                ?>
          </tbody>
        </table>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>