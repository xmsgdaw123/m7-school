<?php
include_once '../utils/http.php';
include_once '../services/modules.php';

$modulesService = new ModulesService();
$data = $modulesService->getModules();

if (array_key_exists('error', $data)) {
  sendHttpResponse('error', $data['error']);
} else {
  // header('Location: ../dashboard/modules.php');
  sendHttpResponse('success', json_encode($data));
}