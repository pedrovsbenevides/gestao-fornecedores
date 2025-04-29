<?php

namespace backend\models;

class Fornecedor
{

    private int $id;
    private string $razaoSocial;
    private string $cep;

    public function __construct(string $razaoSocial, string $cep)
    {
        $this->razaoSocial = $razaoSocial;
        $this->cep = $cep;
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

    public function getRazaoSocial()
    {
        return $this->razaoSocial;
    }

    public function setRazaoSocial($razaoSocial)
    {
        $this->razaoSocial = $razaoSocial;

        return $this;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    public function toArray(): array
    {
        $fornecedor['id'] = $this->getId();
        $fornecedor['razaoSocial'] = $this->getRazaoSocial();
        $fornecedor['cep'] = $this->getCep();

        return $fornecedor;
    }
}
