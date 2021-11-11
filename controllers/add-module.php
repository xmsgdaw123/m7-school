<?php
include_once '../utils/http.php';
include_once '../services/modules.php';

$code = filter_input(INPUT_POST, 'code');
$name = filter_input(INPUT_POST, 'name');
$description = filter_input(INPUT_POST, 'description');

if (!isset($code) or !isset($name) or !isset($description)) {
  sendHttpResponse('error', 'Faltan los datos del nuevo módulo');
  exit();
}

$modulesService = new ModulesService();

$data = $modulesService->createModule($code, $name, $description);

if (array_key_exists('error', $data)) {
  sendHttpResponse('error', $data['error']);
} else {
  header('Location: ../dashboard/modules.php');
  // sendHttpResponse('success', json_encode($data));
}