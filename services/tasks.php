<?php

include_once '../repositories/tasks.php';
include_once '../utils/session.php';

class TasksService {
  private static $tasksRepository = null;
  
  public function __construct() {
    self::$tasksRepository = new TasksRepository();
  }

  public function createTask(int $moduleId, string $name, string $description) {
    self::$tasksRepository->createTask($moduleId, $name, $description);
  }

  public function submitTask(int $taskId, int $userId, string $content) {
    self::$tasksRepository->submitTask($taskId, $userId, $content);
  }

  public function getMyTasks(int $userId): array {
    $myTasks = self::$tasksRepository->getMyTasks($userId);
    return $myTasks;
  }

  public function getSubmittedTasks(int $userId): array {
    $submittedTasks = self::$tasksRepository->getSubmittedTasks($userId);
    return $submittedTasks;
  }
}
