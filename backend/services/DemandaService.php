<?php

namespace backend\services;

require_once dirname(__FILE__) . '\contracts\DemandaContract.php';
require_once dirname(dirname(__FILE__)) . '\models\Demanda.php';
require_once dirname(dirname(__FILE__)) . '\repositories\DemandaRepository.php';

use backend\models\Demanda;
use backend\services\contracts\DemandaContract;
use backend\repositories\DemandaRepository;

class DemandaService implements DemandaContract
{

    private DemandaRepository $repo;

    public function __construct()
    {
        $this->repo = new DemandaRepository();
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
}
