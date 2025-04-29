<?php

namespace backend\routes;

require_once dirname(dirname(__FILE__)) . '\controllers\FornecedorController.php';
require_once dirname(dirname(__FILE__)) . '\helpers\ResponseHelper.php';

use backend\controllers\FornecedorController;
use backend\helpers\ResponseHelper;

$controller = new FornecedorController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->create();
} else {
    return ResponseHelper::notAllowed();
}
