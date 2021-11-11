<?php
include_once '../utils/http.php';
include_once '../services/auth.php';

$operation = filter_input(INPUT_POST, 'operation');
$email = filter_input(INPUT_POST, 'email');
$name = filter_input(INPUT_POST, 'name');
$surname = filter_input(INPUT_POST, 'surname');
$isTeacher = filter_input(INPUT_POST, 'isTeacher');
$password = filter_input(INPUT_POST, 'password');

if (!isset($operation)) {
  sendHttpResponse('error', 'Falta el código de la operación');
  exit();
}

if ($operation === 'login' and (!isset($email) or !isset($password))) {
  sendHttpResponse('error', 'Faltan las credenciales de inicio de sesión');
  exit();
}

if ($operation !== 'login' and (!isset($email) or !isset($name) or !isset($surname) or !isset($isTeacher) or !isset($password))) {
  sendHttpResponse('error', 'Faltan las credenciales de registro');
  exit();
}

$authService = new AuthService();

if ($operation === 'login') {
  $data = $authService->handleLogin($email, $password);
} else {
  $data = $authService->handleSignin($email, $name, $surname, $isTeacher === 'true' ? true : false, $password);
}

if (array_key_exists('error', $data)) {
  sendHttpResponse('error', $data['error']);
} else {
  header('Location: ../dashboard/index.php');
  // sendHttpResponse('success', json_encode($data));
}