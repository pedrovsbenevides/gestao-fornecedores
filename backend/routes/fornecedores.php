<?php

namespace backend\routes;

require_once dirname(dirname(__FILE__)) . '\controllers\FornecedorController.php';
require_once dirname(dirname(__FILE__)) . '\helpers\ResponseHelper.php';

use backend\controllers\FornecedorController;
use backend\helpers\ResponseHelper;

header('Access-Control-Allow-Origin: http://127.0.0.1:5500');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$controller = new FornecedorController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->create();
} else {
    return ResponseHelper::notAllowed();
}
