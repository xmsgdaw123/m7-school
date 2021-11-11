<?php

include_once '../repositories/modules.php';
include_once '../utils/session.php';

class ModulesService {
  private static $modulesRepository = null;
  
  public function __construct() {
    self::$modulesRepository = new ModulesRepository();
  }

  public function createModule(string $code, string $name, string $description): array {
    $moduleFound = self::$modulesRepository->getModuleByCode($code);

    $rows = $moduleFound['rows'];
    if ($rows === 1) return array('error' => 'El módulo con ese código ya existe');
    
    $id = self::$modulesRepository->createModule($code, $name, $description);
    return array(
      'id' => $id
    );
  }

  public function getModules(): array {
    $allModules = self::$modulesRepository->getAllModules();
    return $allModules;
  }

  public function getEnrolledModules(int $userId): array {
    $allModules = self::$modulesRepository->getEnrolledModules($userId);
    return $allModules;
  }

  public function enrollUser(int $moduleId, int $userId) {
    self::$modulesRepository->enrollUser($moduleId, $userId);
  }
}
