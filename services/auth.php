<?php

include_once '../repositories/user.php';
include_once '../utils/session.php';

class AuthService {
  private static $userRepository = null;
  
  public function __construct() {
    self::$userRepository = new UserRepository();
  }

  public function handleLogin(string $inputEmail, string $inputPassword): array {
    $currentUser = self::$userRepository->getUser($inputEmail);

    $rows = $currentUser['rows'];
    if ($rows < 1) return array('error' => 'Usuario no encontrado o contraseña incorrecta');
    
    $userId = (int)$currentUser['id'];
    $email = $currentUser['email'];
    $name = $currentUser['name'];
    $surname = $currentUser['surname'];
    $isTeacher = (bool)$currentUser['isTeacher'];
    $hashedPassword = $currentUser['hashedPassword'];

    $verifiedPassword = password_verify($inputPassword, $hashedPassword);
    if (!$verifiedPassword) return array('error' => 'Usuario no encontrado o contraseña incorrecta');

    updateSession($userId, $email, $name, $surname, $isTeacher);
    return array(
      'id' => $userId,
      'email' => $email,
      'name' => $name,
      'surname' => $surname,
      'isTeacher' => $isTeacher
    );
  }

  public function handleSignin(string $email, string $name, string $surname, bool $isTeacher, string $password): array {
    $currentUser = self::$userRepository->getUser($email);

    $rows = $currentUser['rows'];
    if ($rows >= 1) return array('error' => 'El usuario ya existe');

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $id = self::$userRepository->createUser($name, $surname, $email, $isTeacher, $hashedPassword);

    updateSession($id, $email, $name, $surname, $isTeacher);
    return array(
      'id' => $id,
      'username' => $email,
      'name' => $name,
      'surname' => $surname,
      'isTeacher' => $isTeacher
    );
  }

  public function getStudents(): array {
    $allStudents = self::$userRepository->getAllStudents();

    return $allStudents;
  }

  public function handleLogout() {
    deleteSession();
  }
}
