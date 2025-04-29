<?php

namespace backend\services\contracts;

use backend\models\Demanda;

interface DemandaContract
{

    public function create(array $data): Demanda;

    public function assocFornecedores(array $data);

    public function listDemandasFornecedores(): array;

    public function getAll(): array;
}
