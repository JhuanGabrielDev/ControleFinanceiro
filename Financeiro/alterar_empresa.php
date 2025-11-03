<?php

require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/EmpresaDAO.php';

$objDAO = new EmpresaDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    $idEmpresa = $_GET['cod'];

    $dados = $objDAO->DetalharEmpresa($idEmpresa);

    // echo '<pre>';
    // var_dump($dados);
    // echo '</pre>';
  
    if (count($dados) == 0) {
        header('location: consultar_empresa.php');
        exit;
    }
} else if (isset($_POST['btnSalvar'])) {
    $idEmpresa = $_POST['cod'];
    $nome_Emp = $_POST['nome_Emp'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    $ret = $objDAO->AlterarEmpresa($nome_Emp, $telefone, $endereco, $idEmpresa);

    header('location: consultar_empresa.php?ret=' . $ret);
    exit;
} else if (isset($_POST['btnExcluir'])) {
    $idEmpresa = $_POST['cod'];

    $ret = $objDAO->ExcluirEmpresa($idEmpresa);

    header('location: consultar_empresa.php?ret=' . $ret);
    exit;
} else {
    header('location: consultar_empresa.php');
    exit;
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
include_once "_head.php";
?>

<body>
    <?php
    include_once "_topo.php";
    include_once "_menu.php";
    ?>

    <div id="wrapper">
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Alterar Empresa</h2>
                        <h5>Aqui você poderá alterar as suas empresas</h5>
                        <?php include_once '_msg.php'; ?>
                    </div>
                </div>
                <hr />
                <form action="alterar_empresa.php" method="post">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_empresa'] ?>">
                    <div class="form-group">
                        <label>Nome da Empresa</label>
                        <input class="form-control" name="nome_Emp" placeholder="Digite aqui o nome da sua empresa" id="nome_Emp" value="<?= $dados[0]['nome_empresa'] ?>" required />
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input class="form-control" name="telefone" placeholder="Digite aqui o telefone" id="telefone" value="<?= $dados[0]['telefone_empresa'] ?>" required />
                    </div>
                    <div class="form-group">
                        <label>Endereço</label>
                        <input class="form-control" name="endereco" placeholder="Digite aqui o endereço" id="endereco" value="<?= $dados[0]['endereco_empresa'] ?>" />
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success" name="btnSalvar" onclick="return ValidarEmpresa()">Salvar</button>
                        <button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger">Excluir</button>
                    </div>
                    <!-- Modal Excluir -->
                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de exclusão</h4>
                                </div>
                                <div class="modal-body">
                                    <b>Deseja excluir a empresa: <b> <?= $dados[0]['nome_empresa'] ?></b>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary" name="btnExcluir">Sim</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>