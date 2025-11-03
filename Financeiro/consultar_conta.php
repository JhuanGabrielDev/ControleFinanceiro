<?php

     require_once '../DAO/UtilDAO.php';
    UtilDAO::VerificarLogado();
    require_once '../DAO/ContaDAO.php';
    
    $objDAO = new ContaDAO();
    $contas = $objDAO->ConsultarConta();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once "_head.php";
?>

<body>
    <?php include_once "_topo.php";
    include_once "_menu.php";
    ?>
    <div id="wrapper">
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2>Consultar Contas</h2>
                    <h5>Consulte todas as suas contas</h5>
                    <?php include_once '_msg.php'; ?>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <span>Contas Cadastradas, caso deseje alterar, clique no botão</span>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Banco</th>
                                            <th>Agência</th>
                                            <th>Número da Conta</th>
                                            <th>Saldo</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($contas as $item) {?>
                                        <tr class="odd gradeX">
                                            <th><?= $item['banco_conta'] ?></th>
                                            <th><?= $item['agencia_conta'] ?></th>
                                            <th><?= $item['numero_conta'] ?></th>
                                            <th> R$<?= $item['saldo_conta'] ?></th>
                                            <td>
                                                <a href="alterar_conta.php?cod=<?= $item['id_conta'] ?>" class="btn btn-warning btn-sm">Alterar</a>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>