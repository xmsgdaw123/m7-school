<?php
include_once '../utils/http.php';
include_once '../services/modules.php';

$moduleId = (int)filter_input(INPUT_POST, 'moduleId');
$userId = (int)filter_input(INPUT_POST, 'userId');

if (!isset($moduleId) or !isset($userId)) {
  sendHttpResponse('error', 'Faltan las ids del módulo o del usuario');
  exit();
}

$modulesService = new ModulesService();
$modulesService->enrollUser($moduleId, $userId);

header('Location: ../dashboard/modules.php');