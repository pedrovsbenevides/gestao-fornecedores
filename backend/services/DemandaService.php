<?php

namespace backend\services;

require_once dirname(__FILE__) . '\contracts\DemandaContract.php';
require_once dirname(dirname(__FILE__)) . '\models\Demanda.php';
require_once dirname(dirname(__FILE__)) . '\repositories\DemandaRepository.php';
require_once dirname(dirname(__FILE__)) . '\repositories\DemandaFornecedorRepository.php';
require_once dirname(dirname(__FILE__)) . '\repositories\FornecedorRepository.php';
require_once dirname(dirname(__FILE__)) . '\helpers\GeoHelper.php';

use backend\helpers\GeoHelper;
use backend\models\Demanda;
use backend\repositories\DemandaFornecedorRepository;
use backend\services\contracts\DemandaContract;
use backend\repositories\DemandaRepository;
use backend\repositories\FornecedorRepository;

class DemandaService implements DemandaContract
{

    private DemandaRepository $repo;
    private DemandaFornecedorRepository $demandaFornecedorRepo;
    private FornecedorRepository $fornecedorRepo;

    public function __construct()
    {
        $this->repo = new DemandaRepository();
        $this->demandaFornecedorRepo = new DemandaFornecedorRepository();
        $this->fornecedorRepo = new FornecedorRepository();
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

    public function listDemandasFornecedores(): array
    {
        try {

            $demandas = $this->repo->getAll();

            foreach ($demandas as &$demanda) {

                $fornecedores = $this->fornecedorRepo->getByDemanda($demanda['id']);

                foreach ($fornecedores as &$fornecedor) {
                    $fornecedor['distancia_demanda'] = GeoHelper::CalculateDistance($demanda['cep'], $fornecedor['cep']);
                }

                $distanceGroup = [];
                foreach ($fornecedores as &$fornecedor) {
                    $dist = $fornecedor['distancia_demanda'];
                    $distanceGroup[$dist][] = $fornecedor;
                }

                $listFornecedores = [];
                $seed = time() % 1000;
                foreach (array_keys($distanceGroup) as $distancia) {
                    $fornecedoresGroup = $distanceGroup[$distancia];
                    $roundRobinPosition = $seed % count($fornecedoresGroup);
                    $roundedGroup = array_merge(array_slice($fornecedoresGroup, $roundRobinPosition), array_slice($fornecedoresGroup, 0, $roundRobinPosition));
                    $listFornecedores = array_merge($listFornecedores, $roundedGroup);
                }

                usort($listFornecedores, fn($a, $b) => $a['distancia_demanda'] <=> $b['distancia_demanda']);

                $demanda['fornecedores'] = $listFornecedores;
            }

            return $demandas;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getAll(): array
    {

        try {
            $demandas = $this->repo->getAll();

            return $demandas;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
