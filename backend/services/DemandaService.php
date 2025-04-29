<?php

namespace backend\services;

require_once dirname(__FILE__) . '\contracts\DemandaContract.php';
require_once dirname(dirname(__FILE__)) . '\models\Demanda.php';
require_once dirname(dirname(__FILE__)) . '\repositories\DemandaRepository.php';
require_once dirname(dirname(__FILE__)) . '\repositories\DemandaFornecedorRepository.php';

use backend\models\Demanda;
use backend\repositories\DemandaFornecedorRepository;
use backend\services\contracts\DemandaContract;
use backend\repositories\DemandaRepository;

class DemandaService implements DemandaContract
{

    private DemandaRepository $repo;
    private DemandaFornecedorRepository $demandaFornecedorRepo;

    public function __construct()
    {
        $this->repo = new DemandaRepository();
        $this->demandaFornecedorRepo = new DemandaFornecedorRepository();
    }

    public function create(array $data): Demanda
    {
        try {

            $demanda = $this->repo->create($data);

            return $demanda;
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function assocFornecedores(array $data)
    {
        $demandaFornecedores = [];

        try {
            foreach ($data['fornecedores_ids'] as $fornecedorId) {
                if (empty($this->demandaFornecedorRepo->getByDemandaAndFornecedor($data['demanda_id'], $fornecedorId))) {
                    array_push($demandaFornecedores, $this->demandaFornecedorRepo->create($data['demanda_id'], $fornecedorId)->toArray());
                }
            }

            return $demandaFornecedores;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
