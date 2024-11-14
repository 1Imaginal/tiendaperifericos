<?php
  include("cambiarnav.php");
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