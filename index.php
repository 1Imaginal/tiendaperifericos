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
    <div class="container-fluid my-2 py-2 text-center">
        <h1>Tienda de perifericos</h1>
        <p>Juan Pablo Pinto Ruiz</p> 
    </div>
    <div class="container my-1">
        <div class="row">
            <div class="col-4">
               <a href="productos.php?idCat=1" style="text-decoration: none; color: #735334;"> <h2 class="text-center">Mouse</h2></a>
               <a href="productos.php?idCat=1">
                <img src="rsc/mouse.webp" class="img-fluid" alt="mouse" style="width:100%;">
               </a> 
            </div>
            <div class="col-4">
                <a href="productos.php?idCat=2" style="text-decoration: none; color: #735334;"> <h2 class="text-center">Teclado</h2></a>
                <a href="productos.php?idCat=2">
                 <img src="rsc/teclado.jpg" class="img-fluid" alt="teclado" style="width:100%;">
                </a> 
             </div>
             <div class="col-4">
                <a href="productos.php?idCat=3" style="text-decoration: none; color: #735334;"> <h2 class="text-center">Mousepad</h2></a>
                <a href="productos.php?idCat=3">
                 <img src="rsc/mousepad.jpg" class="img-fluid" alt="mousepad" style="width:100%;">
                </a> 
             </div>
        </div>
    </div>
    <div class="container my-5">
        <h2>¿Por qué nosotros?</h1>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Natus esse inventore eum doloribus minima molestiae aliquid blanditiis culpa fugiat ullam unde quas, velit sint quos eligendi, cumque ipsum nisi? Quia!</p>
        <p>Amet, vel fuga voluptatum unde provident distinctio velit fugit culpa qui sint iusto minus quos laboriosam praesentium corporis facilis molestias voluptates! Pariatur non dolorum tenetur vitae sint fuga dolor facilis.</p>
        <p>Accusantium, in facilis nam commodi iste deserunt placeat non a ducimus maxime praesentium ex error soluta aspernatur optio quis quas eveniet! Sunt, saepe accusantium repudiandae odit officiis similique esse commodi!</p> 
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>