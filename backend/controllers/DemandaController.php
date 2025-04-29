<?php

namespace backend\controllers;

require_once dirname(dirname(__FILE__)) . '\helpers\ResponseHelper.php';
require_once dirname(dirname(__FILE__)) . '\services\DemandaService.php';

use backend\helpers\ResponseHelper;
use backend\services\DemandaService;

class DemandaController
{

    private DemandaService $service;

    public function __construct()
    {
        $this->service = new DemandaService();
    }

    public function create()
    {
        try {
            $request = json_decode(file_get_contents('php://input'), true);

            if (empty($request['titulo']) || empty($request['cep'])) {
                return ResponseHelper::error('Título e CEP são obrigatórios.');
            }

            $response = $this->service->create($request);
            return ResponseHelper::success($response->toArray());
        } catch (\Throwable $th) {
            return ResponseHelper::error($th->getMessage());
        }
    }

    public function assocFornecedores()
    {
        try {
            $request = json_decode(file_get_contents('php://input'), true);

            if (empty($request['demanda_id']) || empty($request['fornecedores_ids'])) {
                return ResponseHelper::error('Demanda e Fornecedores são obrigatórios.');
            }

            $response = $this->service->assocFornecedores($request);
            return ResponseHelper::success($response);
        } catch (\Throwable $th) {
            return ResponseHelper::error($th->getMessage());
        }
    }

    public function getAll()
    {
        try {
            $response = $this->service->listDemandasFornecedores();

            return ResponseHelper::success($response);
        } catch (\Throwable $th) {
            return ResponseHelper::error($th->getMessage());
        }
    }
}
