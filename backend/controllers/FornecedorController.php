<?php

namespace backend\controllers;

require_once dirname(dirname(__FILE__)) . '\helpers\ResponseHelper.php';
require_once dirname(dirname(__FILE__)) . '\services\FornecedorService.php';

use backend\helpers\ResponseHelper;
use backend\services\FornecedorService;

class FornecedorController
{

    private FornecedorService $service;

    public function __construct()
    {
        $this->service = new FornecedorService();
    }

    public function create()
    {
        try {
            $request = json_decode(file_get_contents('php://input'), true);

            if (empty($request['razao_social']) || empty($request['cep'])) {
                return ResponseHelper::error('Razao Social e CEP são obrigatórios.');
            }

            $response = $this->service->create($request);
            return ResponseHelper::success($response->toArray());
        } catch (\Throwable $th) {
            return ResponseHelper::error($th->getMessage());
        }
    }
}
