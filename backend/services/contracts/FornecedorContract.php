<?php

namespace backend\services\contracts;

use backend\models\Fornecedor;

interface FornecedorContract
{

    public function create(array $data): Fornecedor;

    public function getAll(): array;
}
