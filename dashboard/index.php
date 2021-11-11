<?php
include_once '../utils/session.php';
if (!isLoggedIn()) {
  header('Location: index.php');
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
  <link rel="stylesheet" href="../public/style.css">
</head>

<body>
  <div class="index-app">
    <div class="login-form">
      <div id="login-title" class="login-title">CEFP Núria<span id="breadcrumb" class="breadcrumb">/</span></div>
      <nav class="dashboard-nav">
        <a href="./index.php" class="nav-item active">Inicio</a>
        <a href="./modules.php" class="nav-item">Mis módulos</a>
        <a href="./tasks.php" class="nav-item">Mis tareas</a>
      </nav>
      <div>
        <div id="home-container">
          <div>Hola <?php echo $_SESSION['name']; ?></div>
          <div>Tu id de usuario es: <?php echo $_SESSION['id']; ?></div>
          <div>Tu rol es: <?php echo $_SESSION['isTeacher'] ? 'profesor' : 'alumno'; ?></div>
          <div>Tu última visita fue el: <?php echo $_COOKIE['lastVisit']; ?></div>
          <a href="../controllers/logout.php" id="btn-logout" class="btn-submit">Cerrar sesión</a>
        </div>
      </div>
    </div>
  </div>
  <script src="../public/app.js"></script>
</body>

</html>