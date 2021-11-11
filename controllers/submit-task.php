<?php
include_once '../utils/http.php';
include_once '../services/tasks.php';

$taskId = (int)filter_input(INPUT_POST, 'taskId');
$content = filter_input(INPUT_POST, 'content');

if (!isset($taskId) or !isset($content)) {
  header('Location: ../dashboard/tasks.php');
  exit();
}

$tasksService = new TasksService();

$data = $tasksService->submitTask($taskId, (int)$_SESSION['id'], $content);

header('Location: ../dashboard/tasks.php');