<?php
/**
 * Created by PhpStorm.
 * User: alunoces
 * Date: 16/04/2019
 * Time: 21:10
 */

class professor
{
    private $idProfessor;
    private $nome;
    private $cargo;

    /**
     * professor constructor.
     * @param $idProfessor
     * @param $nome
     * @param $cargo
     */
    public function __construct($idProfessor, $nome, $cargo)
    {
        $this->idProfessor = $idProfessor;
        $this->nome = $nome;
        $this->cargo = $cargo;
    }


    public function getIdProfessor()
    {
        return $this->idProfessor;
    }

    public function setIdProfessor($idProfessor)
    {
        $this->idProfessor = $idProfessor;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getCargo()
    {
        return $this->cargo;
    }

    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
    }
}