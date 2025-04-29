<?php

namespace backend\models;

class DemandaFornecedor
{
    private int $id;
    private int $demandaId;
    private int $fornecedorId;
    private string $createdAt;

    public function __construct(int $demandaId, int $fornecedorId, string $createdAt)
    {
        $this->demandaId = $demandaId;
        $this->fornecedorId = $fornecedorId;
        $this->createdAt = $createdAt;
    }

    public function getDemandaId()
    {
        return $this->demandaId;
    }

    public function setDemandaId($demandaId)
    {
        $this->demandaId = $demandaId;

        return $this;
    }

    public function getCreatedAt()
    {
        return date('d/m/y', strtotime($this->createdAt));
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getFornecedorId()
    {
        return $this->fornecedorId;
    }

    public function setFornecedorId($fornecedorId)
    {
        $this->fornecedorId = $fornecedorId;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function toArray(): array
    {
        $demandaFornecedor['id'] = $this->getId();
        $demandaFornecedor['demanda_id'] = $this->getDemandaId();
        $demandaFornecedor['fornecedor_id'] = $this->getFornecedorId();
        $demandaFornecedor['created_at'] = $this->getCreatedAt();

        return $demandaFornecedor;
    }
}
