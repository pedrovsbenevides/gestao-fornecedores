<?php

namespace backend\services;

require_once dirname(__FILE__) . '\contracts\FornecedorContract.php';
require_once dirname(dirname(__FILE__)) . '\models\Fornecedor.php';
require_once dirname(dirname(__FILE__)) . '\repositories\FornecedorRepository.php';

use backend\models\Fornecedor;
use backend\services\contracts\FornecedorContract;
use backend\repositories\FornecedorRepository;

class FornecedorService implements FornecedorContract
{

    private FornecedorRepository $repo;

    public function __construct()
    {
        $this->repo = new FornecedorRepository();
    }

    public function create(array $data): Fornecedor
    {
        try {

            $fornecedor = $this->repo->create($data);

            return $fornecedor;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getAll(): array
    {

        try {
            $fornecedores = $this->repo->getAll();

            return $fornecedores;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
