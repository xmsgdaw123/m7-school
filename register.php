<?php
  include_once './utils/session.php';
  if (isLoggedIn()) {
    header('Location: dashboard/index.php');
  }
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CEFP Núria</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./public/style.css">
</head>

<body>
  <div class="index-app">
    <div class="login-form">
      <div id="login-title" class="login-title">CEFP Núria</div>
      <form>
        <div>
          <div class="login-info">Correo electrónico</div>
          <input id="email" class="text-input mb" type="text" placeholder="Correo...">
          <div class="login-info">Nombre</div>
          <input id="name" class="text-input mb" type="text" placeholder="Nombre...">
          <div class="login-info">Apellidos</div>
          <input id="surname" class="text-input mb" type="text" placeholder="Apellidos...">
          <div class="login-info">Contraseña</div>
          <input id="password" class="text-input mb" type="password" placeholder="Contraseña...">
          <div class="login-info">Registrar como profesor</div>
          <input id="isTeacher" type="checkbox">
          <button id="btn-auth" class="btn-submit" type="submit">Enviar</button>
          <a href="index.php" class="login-switch">Iniciar sesión</button>
        </div>
      </form>
    </div>
  </div>
  <script src="./public/app.js"></script>
</body>

</html>