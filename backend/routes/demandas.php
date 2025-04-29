<?php

namespace backend\routes;

require_once dirname(dirname(__FILE__)) . '\controllers\DemandaController.php';
require_once dirname(dirname(__FILE__)) . '\helpers\ResponseHelper.php';

use backend\controllers\DemandaController;
use backend\helpers\ResponseHelper;

$controller = new DemandaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->create();
} else {
    return ResponseHelper::notAllowed();
}
