<?php

namespace backend\models;

class Demanda
{
    private int $id;
    private string $titulo;
    private string $cep;

    public function __construct($titulo, $cep)
    {
        $this->titulo = $titulo;
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

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

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
        $demanda['id'] = $this->getId();
        $demanda['titulo'] = $this->getTitulo();
        $demanda['cep'] = $this->getCep();

        return $demanda;
    }
}
