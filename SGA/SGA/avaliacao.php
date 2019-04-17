<?php
/**
 * Created by PhpStorm.
 * User: alunoces
 * Date: 16/04/2019
 * Time: 22:14
 */

include_once "estrutura/Template.php";
require_once "db/avaliacaoDAO.php";
require_once "classes/avaliacao.php";

$template = new Template();
$object = new avaliacaoDAO();

$template->header();
$template->sidebar();
$template->navbar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
    $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $cargo = (isset($_POST["cargo"]) && $_POST["cargo"] != null) ? $_POST["cargo"] : "";
} else if (!isset($id)) {
    // Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $nome = NULL;
    $cargo = NULL;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {
    $professor = new professor($id, '', '');

    $resultado = $object->atualizar($professor);
    $nome = $resultado->getNome();
    $cargo = $resultado->getCargo();
}

if(isset($_REQUEST["act"]) && $_REQUEST["act"] == "save"){
    $professor = new professor($id, $nome, $cargo);
    $msg = $object->salvar($professor);
    $id = null;
    $nome = null;
    $matricula = null;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "") {
    $avaliacao = new avaliacao($id, '', '','','','','','','');
    $msg = $object->remover($avaliacao);
    $id = null;
}

?>



<div class='content' xmlns="http://www.w3.org/1999/html">
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='card'>
                    <div class='header'>
                        <h4 class='title'>Avaliações</h4>
                        <p class='category'>Lista de avaliações do sistema</p>

                    </div>
                    <div class='content table-responsive'>

                        <form action="?act=save" method="POST" name="form1" >
                            <hr>
                            <i class="ti-save"></i>
                            <input type="hidden" size="5" name="id" value="<?php
                            // Preenche o id no campo id com um valor "value"
                            echo (isset($id) && ($id != null || $id != "")) ? $id : '';
                            ?>" />
                            Nota 1:
                            <input type="number" size="50" name="nota1" value="<?php
                            // Preenche o nome no campo nome com um valor "value"
                            echo (isset($nota1) && ($nota1 != null || $nota1 != "")) ? $nota1 : '';
                            ?>" />
                            Nota 2:
                            <input type="number" size="50" name="nota2" value="<?php
                            // Preenche o nome no campo nome com um valor "value"
                            echo (isset($nota2) && ($nota2 != null || $nota2 != "")) ? $nota2 : '';
                            ?>" />
                            Nota 3:
                            <input type="number" size="50" name="nota3" value="<?php
                            // Preenche o nome no campo nome com um valor "value"
                            echo (isset($nota3) && ($nota3 != null || $nota3 != "")) ? $nota3 : '';
                            ?>" />
                            Nota 4:
                            <input type="number" size="50" name="nota4" value="<?php
                            // Preenche o nome no campo nome com um valor "value"
                            echo (isset($nota4) && ($nota4 != null || $nota4 != "")) ? $nota4 : '';
                            ?>" />
                            Nota Final:
                            <input type="number" size="50" name="notaFinal" value="<?php
                            // Preenche o nome no campo nome com um valor "value"
                            echo (isset($notaFinal) && ($notaFinal != null || $notaFinal != "")) ? $notaFinal : '';
                            ?>" />
                            Cargo:
                            <input type="submit" VALUE="Cadastrar"/>
                            <hr>
                        </form>

                        <?php
                        echo (isset($msg) && ($msg != null || $msg != "")) ? $msg : '';

                        //chamada a paginação
                        $object->tabelapaginada();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$template->footer();
?>

