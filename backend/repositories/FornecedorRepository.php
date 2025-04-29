<?php

namespace backend\repositories;

require_once dirname(dirname(__FILE__)) . '\db\config\connection.php';
require_once dirname(dirname(__FILE__)) . '\models\Fornecedor.php';

use backend\db\config\Connection;
use backend\models\Fornecedor;
use PDO;

class FornecedorRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Connection::Connect();
    }

    public function create(array $data)
    {
        try {

            $this->pdo->beginTransaction();

            $createStatement = $this->pdo->prepare('INSERT INTO fornecedores (razao_social, cep) VALUES (:razao_social, :cep)');
            $createStatement->bindParam(':razao_social', $data['razao_social']);
            $createStatement->bindParam(':cep', $data['cep']);

            $createStatement->execute();

            $this->pdo->commit();

            return $this->buildFornecedor($this->pdo->lastInsertId(), $data);
        } catch (\Throwable $th) {
            $this->pdo->rollBack();

            throw $th;
        }
    }

    public function getByDemanda(int $demandaId)
    {
        $selectStatement = $this->pdo->prepare('
            SELECT fornecedores.id, fornecedores.razao_social, fornecedores.cep 
            FROM fornecedores
            INNER JOIN demandas_fornecedores ON fornecedores.id = demandas_fornecedores.fornecedor_id
            WHERE demandas_fornecedores.demanda_id = :demandaId
        ');

        $selectStatement->bindParam(':demandaId', $demandaId);
        $selectStatement->execute();

        return $selectStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    private function buildFornecedor(int $id, array $data): Fornecedor
    {

        $Fornecedor = new Fornecedor(
            $data['razao_social'],
            $data['cep'],
        );

        $Fornecedor->setId($id);

        return $Fornecedor;
    }
}
