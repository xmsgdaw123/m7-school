<?php
include_once '../utils/http.php';
include_once '../services/tasks.php';

$moduleId = (int)filter_input(INPUT_POST, 'moduleId');
$name = filter_input(INPUT_POST, 'name');
$description = filter_input(INPUT_POST, 'description');

if (!isset($moduleId) or !isset($name) or !isset($description)) {
  header('Location: ../dashboard/tasks.php');
  exit();
}

$tasksService = new TasksService();

$data = $tasksService->createTask($moduleId, $name, $description);

header('Location: ../dashboard/tasks.php');