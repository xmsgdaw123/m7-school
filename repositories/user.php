<?php

include_once '../database/connection.php';

class UserRepository {
  public function __construct() {
  }

  public function getUser(string $email): array {
    global $mysqli;

    $query = 'SELECT id, name, surname, email, isTeacher, hashedPassword FROM users WHERE email = ?';

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($id, $name, $surname, $email, $isTeacher, $hashedPassword);
    $stmt->store_result();
    $stmt->fetch();

    return array(
      'rows' => $stmt->num_rows,
      'id' => $id,
      'name' => $name,
      'surname' => $surname,
      'email' => $email,
      'isTeacher' => $isTeacher,
      'hashedPassword' => $hashedPassword
    );
  }

  public function getUserById(int $id): array {
    global $mysqli;

    $query = 'SELECT id, name, surname, email, isTeacher FROM users WHERE id = ?';

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $stmt->bind_result($id, $name, $surname, $email, $isTeacher);
    $stmt->store_result();
    $stmt->fetch();

    return array(
      'id' => $id,
      'name' => $name,
      'surname' => $surname,
      'email' => $email,
      'isTeacher' => $isTeacher,
    );
  }

  public function createUser(string $name, string $surname, string $email, bool $isTeacher, string $hashedPassword): int {
    global $mysqli;

    $query = 'INSERT INTO users (name, surname, email, isTeacher, hashedPassword) VALUES (?, ?, ?, ?, ?)';

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('sssis', $name, $surname, $email, $isTeacher, $hashedPassword);
    $stmt->execute();

    return $stmt->insert_id;
  }

  public function getAllStudents(): array {
    global $mysqli;

    $query = 'SELECT id, name, surname, email FROM users WHERE isTeacher = 0';

    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $stmt->bind_result($id, $name, $surname, $email);
    $stmt->store_result();

    $modules = [];

    while ($stmt->fetch()) {
      $modules[] = array(
        'id' => $id,
        'name' => $name,
        'surname' => $surname,
        'email' => $email
      );
    }

    return $modules;
  }
}
