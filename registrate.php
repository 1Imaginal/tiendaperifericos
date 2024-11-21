<?php
  include("cambiarnav.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
            cambiarnav($session, $nombre);
            ?>
        </div>
      </div>
    </div>
  </nav>
  <div class="container my-5">
    <h1 class="display-1" style="text-align:center">Registrate Ahora!</h1>
  </div>
    <div class="container position-absolute top-50 start-50 translate-middle">
      <form action="registro.php" method="post" onkeyup="validarFormulario()">
        <div class="mb-3 mt-3">
          <label for="username" class="form-label">Nombre de usuario</label>
          <input type="text" class="form-control" id="username" placeholder="Ingresa tu nombre de usuario" name="username" required>
          <span id="mensaje-usuario"></span>
        </div>
        <div class="mb-3">
          <label for="pwd" class="form-label">Contraseña</label>
          <input type="password" class="form-control" id="pwd" placeholder="Ingresa tu contraseña" name="pswd" required>
          <span id="mensaje-pwd"></span>
        </div>
        <div class="mb-3">
          <label for="pwdconf" class="form-label">Confirmar contraseña</label>
          <input type="password" class="form-control" id="pwdconf" placeholder="Ingresa nuevamente tu contraseña" name="pswdconf" required>
          <span id="mensaje-conf"></span>
        </div>
        <button type="submit" class="btn btn-success" id="registro" disabled>Registrarse</button>
      </form>
    </div>
    <script>
        function tamanoUsuario(){
          if(document.getElementById('username').value.length >= 3) {
            document.getElementById('mensaje-usuario').style.color = 'green';
            document.getElementById('mensaje-usuario').innerHTML = 'Nombre de usuario valido';
            return true;
          } else {
            document.getElementById('mensaje-usuario').style.color = 'red';
            document.getElementById('mensaje-usuario').innerHTML = 'El nombre de usuario debe tener almenos 3 caracteres';
            return false;
          }
        }

        function tamanoContrasena(){
          if(document.getElementById('pwd').value.length >= 6) {
            document.getElementById('mensaje-pwd').style.color = 'green';
            document.getElementById('mensaje-pwd').innerHTML = 'Contraseña válida';
            return true;
          } else {
            document.getElementById('mensaje-pwd').style.color = 'red';
            document.getElementById('mensaje-pwd').innerHTML = 'La contraseña debe tener almenos 6 caracteres';
            return false;
          }
        }

        function coinciden() {
        if (document.getElementById('pwd').value == document.getElementById('pwdconf').value) {
          document.getElementById('mensaje-conf').style.color = 'green';
          document.getElementById('mensaje-conf').innerHTML = 'Las contraseñas coinciden';
          return true;
        } else {
          document.getElementById('mensaje-conf').style.color = 'red';
          document.getElementById('mensaje-conf').innerHTML = 'Las contraseñas no coinciden';
          return false;
        }
      }

      function validarFormulario(){
        if(tamanoUsuario() && tamanoContrasena() && coinciden()){
          document.getElementById('registro').disabled = false;
        }
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>