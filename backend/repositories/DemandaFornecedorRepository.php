<?php

namespace backend\repositories;

require_once dirname(dirname(__FILE__)) . '\db\config\connection.php';

use backend\db\config\Connection;
use backend\models\DemandaFornecedor;
use DateTime;
use PDO;

class DemandaFornecedorRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Connection::Connect();
    }

    public function create(int $demandaId, int $fornecedorId)
    {
        try {
            $currentDate = new DateTime();
            $currentDate = $currentDate->format("Y-m-d");
            $this->pdo->beginTransaction();

            $createStatement = $this->pdo->prepare('INSERT INTO demandas_fornecedores (demanda_id, fornecedor_id, created_at) VALUES (:demanda_id, :fornecedor_id, :created_at)');
            $createStatement->bindParam(':demanda_id', $demandaId);
            $createStatement->bindParam(':fornecedor_id', $fornecedorId);
            $createStatement->bindParam(':created_at', $currentDate);

            $createStatement->execute();

            $this->pdo->commit();

            $data['demanda_id'] = $demandaId;
            $data['fornecedor_id'] = $fornecedorId;
            $data['created_at'] = $currentDate;

            return $this->buildDemandaFornecedor($this->pdo->lastInsertId(), $data);
        } catch (\Throwable $th) {
            $this->pdo->rollBack();

            throw $th;
        }
    }

    public function getByDemandaAndFornecedor(int $demandaId, int $fornecedorId)
    {
        $selectStatement = $this->pdo->prepare('SELECT 1 FROM demandas_fornecedores WHERE demanda_id = :demanda_id AND fornecedor_id = :fornecedor_id');
        $selectStatement->bindParam(':demanda_id', $demandaId);
        $selectStatement->bindParam(':fornecedor_id', $fornecedorId);

        $selectStatement->execute();

        return $selectStatement->fetch(PDO::FETCH_ASSOC);
    }

    private function buildDemandaFornecedor(int $id, array $data): DemandaFornecedor
    {

        $demanda = new DemandaFornecedor(
            $data['demanda_id'],
            $data['fornecedor_id'],
            $data['created_at']
        );

        $demanda->setId($id);

        return $demanda;
    }
}
