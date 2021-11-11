<?php
include_once '../utils/session.php';
include_once '../services/modules.php';
include_once '../services/tasks.php';
if (!isLoggedIn()) {
  header('Location: index.php');
}

$modulesService = new ModulesService();
$modules = $modulesService->getModules();

$tasksService = new TasksService();
$tasks = $tasksService->getMyTasks((int)$_SESSION['id']);
$submittedTasks = $tasksService->getSubmittedTasks((int)$_SESSION['id']);
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
      <div id="login-title" class="login-title">CEFP Núria<span id="breadcrumb" class="breadcrumb">/tareas</span></div>
      <nav class="dashboard-nav">
        <a href="./index.php" class="nav-item">Inicio</a>
        <a href="./modules.php" class="nav-item">Mis módulos</a>
        <a href="./tasks.php" class="nav-item active">Mis tareas</a>
      </nav>
      <div>
        <div id="home-container">
          <div style="display: <?php echo $_SESSION['isTeacher'] ? 'block' : 'none'; ?>;">
            <div class="bold">Añadir tareas</div>
            <form action="../controllers/add-task.php" method="POST">
              <div class="inline-flex" style="margin-bottom: 5px;">
                <div>
                  <div class="login-info">Módulo</div>
                  <select name="moduleId" class="select">
                    <?php
                    foreach ($modules as $module) {
                      echo '<option value="' . $module['id'] . '">' . $module['code'] . '</option>';
                    }
                    ?>
                  </select>
                </div>
                <div>
                  <div class="login-info">Nombre</div>
                  <input name="name" class="text-input" type="text" placeholder="Nombre...">
                </div>
              </div>
              <div class="login-info">Descripción</div>
              <input name="description" class="text-input" type="text" placeholder="Descripción...">
              <button id="add-task" class="btn-submit" type="submit">Añadir tarea</button>
            </form>
          </div>
          <div style="display: <?php echo $_SESSION['isTeacher'] ? 'none' : 'block'; ?>;">
            <div class="bold">Mis tareas</div>
            <?php
            foreach ($tasks as $task) {
              if (array_search((int)$task['id'], array_column($submittedTasks, 'id')) !== false) continue;
              echo '<form action="../controllers/submit-task.php" method="POST" class="mb">'
              . '<input type="hidden" name="taskId" value="' . $task['id'] . '">'
              . '<div><span>'
              . $task['code'] . '</span> - <span>'
              . $task['name']
              . '</span></div>' . $task['description'] .
              '<div></div><textarea name="content"></textarea><button class="btn-submit btn-submit-task">Enviar</button></form>';
            }
            ?>
          </div>
          <div style="display: <?php echo $_SESSION['isTeacher'] ? 'none' : 'block'; ?>;">
            <div class="bold">Tareas entregadas</div>
            <?php
            foreach ($submittedTasks as $submittedTask) {
              echo '<div><div>' . $submittedTask['code'] . ' - ' . $submittedTask['name'] . '</div>'
              . '<div>Fecha: ' . $submittedTask['submittedAt'] . '</div>'
              . '<div>Nota: ' . (is_null($submittedTask['note']) ? 'No corregida' : $submittedTask['note']) . '</div>'
              . '<textarea disabled>' . $submittedTask['content'] . '</textarea></div>';
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../public/app.js"></script>
</body>

</html>