<?php
/**
 * Created by PhpStorm.
 * User: alunoces
 * Date: 16/04/2019
 * Time: 22:11
 */

class avaliacao
{
    private $idAvaliacao;
    private $nota1;
    private $nota2;
    private $nota3;
    private $nota4;
    private $notaFinal;
    private $situacao;
    private $turma;
    private $aluno;

    /**
     * avaliacao constructor.
     * @param $idAvaliacao
     * @param $nota1
     * @param $nota2
     * @param $nota3
     * @param $nota4
     * @param $notaFinal
     * @param $situacao
     */
    public function __construct($idAvaliacao, $nota1, $nota2, $nota3, $nota4, $notaFinal, $situacao, $turma, $aluno)
    {
        $this->idAvaliacao = $idAvaliacao;
        $this->nota1 = $nota1;
        $this->nota2 = $nota2;
        $this->nota3 = $nota3;
        $this->nota4 = $nota4;
        $this->notaFinal = $notaFinal;
        $this->situacao = $situacao;
        $this->turma = $turma;
        $this->aluno = $aluno;
    }

    /**
     * @return mixed
     */
    public function getIdAvaliacao()
    {
        return $this->idAvaliacao;
    }

    /**
     * @param mixed $idAvaliacao
     */
    public function setIdAvaliacao($idAvaliacao)
    {
        $this->idAvaliacao = $idAvaliacao;
    }

    /**
     * @return mixed
     */
    public function getNota1()
    {
        return $this->nota1;
    }

    /**
     * @param mixed $nota1
     */
    public function setNota1($nota1)
    {
        $this->nota1 = $nota1;
    }

    /**
     * @return mixed
     */
    public function getNota2()
    {
        return $this->nota2;
    }

    /**
     * @param mixed $nota2
     */
    public function setNota2($nota2)
    {
        $this->nota2 = $nota2;
    }

    /**
     * @return mixed
     */
    public function getNota3()
    {
        return $this->nota3;
    }

    /**
     * @param mixed $nota3
     */
    public function setNota3($nota3)
    {
        $this->nota3 = $nota3;
    }

    /**
     * @return mixed
     */
    public function getNota4()
    {
        return $this->nota4;
    }

    /**
     * @param mixed $nota4
     */
    public function setNota4($nota4)
    {
        $this->nota4 = $nota4;
    }

    /**
     * @return mixed
     */
    public function getNotaFinal()
    {
        return $this->notaFinal;
    }

    /**
     * @param mixed $notaFinal
     */
    public function setNotaFinal($notaFinal)
    {
        $this->notaFinal = $notaFinal;
    }

    /**
     * @return mixed
     */
    public function getSituacao()
    {
        return $this->situacao;
    }

    /**
     * @param mixed $situacao
     */
    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;
    }

    /**
     * @return mixed
     */
    public function getTurma()
    {
        return $this->turma;
    }

    /**
     * @param mixed $turma
     */
    public function setTurma($turma)
    {
        $this->turma = $turma;
    }

    /**
     * @return mixed
     */
    public function getAluno()
    {
        return $this->aluno;
    }

    /**
     * @param mixed $aluno
     */
    public function setAluno($aluno)
    {
        $this->aluno = $aluno;
    }
}