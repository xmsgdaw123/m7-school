<?php

include_once '../database/connection.php';

class TasksRepository {
  public function __construct() {
  }

  public function createTask(int $moduleId, string $name, string $description): int {
    global $mysqli;

    $query = 'INSERT INTO tasks (moduleId, name, description) VALUES (?, ?, ?)';

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('iss', $moduleId, $name, $description);
    $stmt->execute();

    return $stmt->insert_id;
  }

  public function submitTask(int $taskId, int $userId, string $content): int {
    global $mysqli;

    $query = 'INSERT INTO taskitems (taskId, userId, submitted, submittedAt, content) VALUES (?, ?, ?, ?, ?)';

    $submitted = 1;

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('iiiss', $taskId, $userId, $submitted, date("d-m-Y H:i:s"), $content);
    $stmt->execute();

    return $stmt->insert_id;
  }

  public function getMyTasks(int $userId): array {
    global $mysqli;

    $query = 'SELECT tasks.id, modules.code, tasks.name, tasks.description FROM tasks INNER JOIN modules ON tasks.moduleId = modules.id INNER JOIN moduleusers ON moduleusers.moduleId = modules.id WHERE moduleusers.userId = ?';

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $stmt->bind_result($id, $code, $name, $description);
    $stmt->store_result();

    $modules = [];

    while ($stmt->fetch()) {
      $modules[] = array(
        'id' => $id,
        'code' => $code,
        'name' => $name,
        'description' => $description
      );
    }

    return $modules;
  }

  public function getSubmittedTasks(int $userId): array {
    global $mysqli;

    $query = 'SELECT tasks.id, modules.code, tasks.name, taskitems.submittedAt, taskitems.note, taskitems.content FROM taskitems INNER JOIN tasks ON tasks.id = taskitems.taskId INNER JOIN modules ON modules.id = tasks.moduleId WHERE taskitems.userId = ?';

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $stmt->bind_result($id, $code, $name, $submittedAt, $note, $content);
    $stmt->store_result();

    $modules = [];

    while ($stmt->fetch()) {
      $modules[] = array(
        'id' => $id,
        'code' => $code,
        'name' => $name,
        'submittedAt' => $submittedAt,
        'note' => $note,
        'content' => $content
      );
    }

    return $modules;
  }
}
