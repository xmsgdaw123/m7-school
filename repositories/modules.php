<?php

include_once '../database/connection.php';

class ModulesRepository {
  public function __construct() {
  }

  public function getModuleByCode(string $code): array {
    global $mysqli;

    $query = 'SELECT id, code, name, description FROM modules WHERE code = ?';

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $code);
    $stmt->execute();
    $stmt->bind_result($id, $code, $name, $description);
    $stmt->store_result();
    $stmt->fetch();

    return array(
      'id' => $id,
      'code' => $code,
      'name' => $name,
      'description' => $description
    );
  }

  public function createModule(string $code, string $name, string $description): int {
    global $mysqli;

    $query = 'INSERT INTO modules (code, name, description) VALUES (?, ?, ?)';

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('sss', $code, $name, $description);
    $stmt->execute();

    return $stmt->insert_id;
  }

  public function getAllModules(): array {
    global $mysqli;

    $query = 'SELECT * FROM modules';

    $stmt = $mysqli->prepare($query);
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

  public function getEnrolledModules(int $userId): array {
    global $mysqli;

    $query = 'SELECT modules.id, modules.code, modules.name, modules.description FROM moduleusers INNER JOIN modules ON moduleusers.moduleId = modules.id WHERE moduleusers.userId = ?';

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

  public function enrollUser(int $moduleId, int $userId) {
    global $mysqli;

    $query = 'INSERT INTO moduleusers(moduleId, userId) VALUES (?, ?)';

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('ii', $moduleId, $userId);
    $stmt->execute();
  }
}
