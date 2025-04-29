<?php

namespace backend\repositories;

require_once dirname(dirname(__FILE__)) . '\db\config\connection.php';
require_once dirname(dirname(__FILE__)) . '\models\Demanda.php';

use backend\db\config\Connection;
use backend\models\Demanda;
use PDO;

class DemandaRepository
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

            $createStatement = $this->pdo->prepare('INSERT INTO demandas (titulo, cep) VALUES (:titulo, :cep)');
            $createStatement->bindParam(':titulo', $data['titulo']);
            $createStatement->bindParam(':cep', $data['cep']);

            $createStatement->execute();

            $this->pdo->commit();

            return $this->buildDemanda($this->pdo->lastInsertId(), $data);
        } catch (\Throwable $th) {
            $this->pdo->rollBack();

            throw $th;
        }
    }

    public function getAll()
    {
        $selectStatement = $this->pdo->prepare('SELECT * FROM demandas');
        $selectStatement->execute();

        return $selectStatement->fetchAll(PDO::FETCH_ASSOC);
    }

    private function buildDemanda(int $id, array $data): Demanda
    {

        $demanda = new Demanda(
            $data['titulo'],
            $data['cep'],
        );

        $demanda->setId($id);

        return $demanda;
    }
}
