<?php
include_once '../utils/http.php';
include_once '../services/auth.php';

$authService = new AuthService();
$data = $authService->getStudents($email, $password);

if (array_key_exists('error', $data)) {
  sendHttpResponse('error', $data['error']);
} else {
  header('Location: ../dashboard/index.php');
  // sendHttpResponse('success', json_encode($data));
}