<?php
/**
 * Created by PhpStorm.
 * User: alunoces
 * Date: 16/04/2019
 * Time: 22:10
 */
require_once 'db/conexao.php';
require_once 'classes/avaliacao.php';

class avaliacaoDAO
{
    public function salvar(avaliacao $avaliacao)
    {
        global $pdo;
        try {

            if ($avaliacao->getIdProfessor() != "") {
                $statement = $pdo->prepare("UPDATE Professor SET Nome=:nome, Cargo=:cargo  WHERE idProfessor = :id;");
                $statement->bindValue(":id", $avaliacao->getIdProfessor());
            } else {
                $statement = $pdo->prepare("INSERT INTO Professor (Nome, Cargo) VALUES (:nome, :cargo)");
            }
            $statement->bindValue(":nome", $avaliacao->getNome());
            $statement->bindValue(":cargo", $avaliacao->getCargo());

            if ($statement->execute()) {
                if ($statement->rowCount() > 0) {
                    return "Dados cadastrados com sucesso!";
                } else {
                    return "Erro ao tentar efetivar cadastro";
                }
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function atualizar(avaliacao $avaliacao)
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("SELECT idProfessor, Nome, Cargo FROM Professor WHERE idProfessor = :id");
            $statement->bindValue(":id", $avaliacao->getIdProfessor());
            if ($statement->execute()) {
                $rs = $statement->fetch(PDO::FETCH_OBJ);
                $avaliacao->setIdProfessor($rs->idProfessor);
                $avaliacao->setNome($rs->Nome);
                $avaliacao->setCargo($rs->Cargo);
                return $avaliacao;
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            return "Erro: ".$erro->getMessage();
        }
    }

    public function remover(avaliacao $avaliacao)
    {
        global $pdo;
        try {
            $statement = $pdo->prepare("DELETE FROM Avaliacao WHERE idAvaliacao = :id");
            $statement->bindValue(":id", $avaliacao->getIdAvaliacao());
            if ($statement->execute()) {
                return "Registo foi excluído com êxito";
            } else {
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
            }
        } catch (PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }

    public function tabelapaginada()
    {

        //carrega o banco
        global $pdo;


//endereço atual da página
        $endereco = $_SERVER ['PHP_SELF'];

        /* Constantes de configuração */
        define('QTDE_REGISTROS', 3);
        define('RANGE_PAGINAS', 1);

        /* Recebe o número da página via parâmetro na URL */
        $pagina_atual = (isset($_GET['page']) && is_numeric($_GET['page'])) ? $_GET['page'] : 1;

        /* Calcula a linha inicial da consulta */
        $linha_inicial = ($pagina_atual -1) * QTDE_REGISTROS;

        /* Instrução de consulta para paginação com MySQL */
        $sql = "SELECT idAvaliacao, turma_idturma, aluno_idaluno, nota1, nota2, nota3, nota4, notaFinal, situação FROM Avaliacao LIMIT {$linha_inicial}, " . QTDE_REGISTROS;
        $statement = $pdo->prepare($sql);
        $statement->execute();
        $dados = $statement->fetchAll(PDO::FETCH_OBJ);

        /* Conta quantos registos existem na tabela */
        $sqlContador = "SELECT COUNT(*) AS total_registros FROM Avaliacao";
        $statement = $pdo->prepare($sqlContador);
        $statement->execute();
        $valor = $statement->fetch(PDO::FETCH_OBJ);

        /* Idêntifica a primeira página */
        $primeira_pagina = 1;

        /* Cálcula qual será a última página */
        $ultima_pagina  = ceil($valor->total_registros / QTDE_REGISTROS);

        /* Cálcula qual será a página anterior em relação a página atual em exibição */
        $pagina_anterior = ($pagina_atual > 1) ? $pagina_atual -1 : 0 ;

        /* Cálcula qual será a pŕoxima página em relação a página atual em exibição */
        $proxima_pagina = ($pagina_atual < $ultima_pagina) ? $pagina_atual +1 : 0 ;

        /* Cálcula qual será a página inicial do nosso range */
        $range_inicial  = (($pagina_atual - RANGE_PAGINAS) >= 1) ? $pagina_atual - RANGE_PAGINAS : 1 ;

        /* Cálcula qual será a página final do nosso range */
        $range_final   = (($pagina_atual + RANGE_PAGINAS) <= $ultima_pagina ) ? $pagina_atual + RANGE_PAGINAS : $ultima_pagina ;

        /* Verifica se vai exibir o botão "Primeiro" e "Pŕoximo" */
        $exibir_botao_inicio = ($range_inicial < $pagina_atual) ? 'mostrar' : 'esconder';

        /* Verifica se vai exibir o botão "Anterior" e "Último" */
        $exibir_botao_final = ($range_final > $pagina_atual) ? 'mostrar' : 'esconder';

        if (!empty($dados)):
            echo "<table class='table table-striped table-bordered'>
     <thead>
       <tr class='active'>
        <th>Código</th>
        <th>Turma</th>
        <th>Aluno</th>
        <th>Nota 1</th>
        <th>Nota 2</th>
        <th>Nota 3</th>
        <th>Nota 4</th>
        <th>Nota Final</th>
        <th>Situação</th>
        <th colspan='2'>Ações</th>
       </tr>
     </thead>
     <tbody>";
            foreach($dados as $avaliacao):
                $situacao = ($avaliacao->nota1+$avaliacao->nota2)/2 >= 7 ? 'Aprovado'
                    : ((($avaliacao->nota1 + $avaliacao->nota2) / 2) + $avaliacao->notaFinal) / 2 >= 6 ? 'Aprovado' : 'Reprovado';
                echo "<tr>
        <td>$avaliacao->idAvaliacao</td>
        <td>$avaliacao->turma_idturma</td>
        <td>$avaliacao->aluno_idaluno</td>
        <td>$avaliacao->nota1</td>
        <td>$avaliacao->nota2</td>
        <td>$avaliacao->nota3</td>
        <td>$avaliacao->nota4</td>
        <td>$avaliacao->notaFinal</td>
        <td>$situacao</td>
        <td><a href='?act=upd&id=$avaliacao->idAvaliacao'><i class='ti-reload'></i></a></td>
        <td><a href='?act=del&id=$avaliacao->idAvaliacao'><i class='ti-close'></i></a></td>
       </tr>";
            endforeach;
            echo "</tbody>
     </table>

     <div class='box-paginacao'>
       <a class='box-navegacao $exibir_botao_inicio' href='$endereco?page=$primeira_pagina' title='Primeira Página'>Primeira</a>
       <a class='box-navegacao $exibir_botao_inicio' href='$endereco?page=$pagina_anterior' title='Página Anterior'>Anterior</a>
";
            /* Loop para montar a páginação central com os números */
            for ($i=$range_inicial; $i <= $range_final; $i++):
                $destaque = ($i == $pagina_atual) ? 'destaque' : '' ;

                echo "<a class='box-numero $destaque' href='$endereco?page=$i'>$i</a>";
            endfor;
            echo
            "<a class='box-navegacao $exibir_botao_final' href='$endereco?page=$proxima_pagina' title='Próxima Página'>Próxima</a>
       <a class='box-navegacao $exibir_botao_final' href='$endereco?page=$ultima_pagina' title='Última Página'>Último</a>
     </div>";
        else:
            echo "<p class='bg-danger'>Nenhum registro foi encontrado!</p>";
        endif;

    }
}