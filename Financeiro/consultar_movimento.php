<?php

require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/MovimentoDAO.php';

$data_inicial = '';
$data_final = '';
$tipo = '';

if (isset($_POST['btnPesquisar'])) {
    $tipo = $_POST['tipo'];
    $data_inicial = $_POST['data_inicial'];
    $data_final = $_POST['data_final'];

    $objDAO = new MovimentoDAO();
    $movs = $objDAO->FiltrarMovimento($tipo, $data_inicial, $data_final);
} else if (isset($_POST['btnExcluir']) && isset($_POST['idMov'])) {
    $idMov = $_POST['idMov'];
    $idConta = $_POST['idConta'];
    $tipo = $_POST['tipo'];
    $valor = $_POST['valor'];
    
    $objDAO = new MovimentoDAO();
    $ret = $objDAO->ExcluirMovimento($idMov, $idConta, $tipo, $valor);
    
    // Redirecionar após exclusão para evitar múltiplos envios do formulário
    header("Location: consultar_movimento.php");
    exit();
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once "_head.php"; ?>

<body>
    <?php include_once "_topo.php"; ?>
    <?php include_once "_menu.php"; ?>
    <div id="wrapper">
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php include_once '_msg.php'   ?>
                        <h2>Consultar movimento</h2>
                        <h5>Consulte todos os movimentos de determinado período</h5>
                    </div>
                </div>
                <hr />
                <form method="post" action="consultar_movimento.php">
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Tipo do Movimento *</label>
                            <select class="form-control" name="tipo">
                                <option value="0" <?= $tipo == '0' ? 'selected' : '' ?>>TODOS</option>
                                <option value="1" <?= $tipo == '1' ? 'selected' : '' ?>>Entrada</option>
                                <option value="2" <?= $tipo == '2' ? 'selected' : '' ?>>Saída</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Data Inicial *</label>
                            <input type="date" class="form-control" placeholder="Coloque a data do movimento" id="data_inicial" name="data_inicial" value="<?= $data_inicial ?>" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Data Final *</label>
                            <input type="date" class="form-control" placeholder="Coloque a data do movimento" id="data_final" name="data_final" value="<?= $data_final ?>" />
                        </div>
                    </div>

                    <center>
                        <button class="btn btn-info" type="submit" onclick="return ValidarConsultaPeriodo()" name="btnPesquisar">Pesquisar</button>
                    </center>
                </form>

                <hr>
                <?php if (isset($movs)) { ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Resultado encontrado
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Data</th>
                                                    <th>Tipo</th>
                                                    <th>Categoria</th>
                                                    <th>Empresa</th>
                                                    <th>Conta</th>
                                                    <th>Valor</th>
                                                    <th>Observação</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $total = 0;
                                                    
                                                    foreach ($movs as $i => $movimento) {
                                                        if ($movimento['tipo_movimento'] == 1) {
                                                            $total += $movimento['valor_movimento'];
                                                        } else {
                                                            $total -= $movimento['valor_movimento'];
                                                        }
                                                ?>
                                                    <tr class="odd gradeX">
                                                        <td><?= $movimento['data_movimento'] ?></td>
                                                        <td><?= $movimento['tipo_movimento'] == 1 ? 'Entrada' : 'Saída' ?></td>
                                                        <td><?= $movimento['nome_categoria'] ?></td>
                                                        <td><?= $movimento['nome_empresa'] ?></td>
                                                        <td><?= $movimento['banco_conta'] ?> / Ag. <?= $movimento['agencia_conta'] ?> - Núm. <?= $movimento['numero_conta'] ?></td>
                                                        <td>R$ <?= number_format($movimento['valor_movimento'], 2, ',', '.')  ?></td>
                                                        <td><?= $movimento['obs_movimento'] ?></td>
                                                        <td>
                                                            <a href="#" class="btn btn-danger btn-sm" data-toggle="modal"  data-target="#modalExcluir<?= $i ?>">Excluir</a>
                                                            <form method="post" action="consultar_movimento.php">
                                                                <input type="hidden" name="idMov" value="<?= $movimento['id_movimento'] ?>">
                                                                <input type="hidden" name="idConta" value="<?= $movimento['id_conta'] ?>">
                                                                <input type="hidden" name="tipo" value="<?= $movimento['tipo_movimento'] ?>">
                                                                <input type="hidden" name="valor" value="<?= $movimento['valor_movimento'] ?>">
                                                                <div class="modal fade" id="modalExcluir<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                                <h4 class="modal-title" id="myModalLabel">Confirmação de exclusão</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <center><b> Deseja excluir o movimento:</b> <br><br></center>
                                                                                <b> Data do movimento:</b> <?= $movimento['data_movimento'] ?><br>
                                                                                <b> Tipo do movimento:</b> <?= $movimento['tipo_movimento'] == 1 ? 'Entrada' : 'Saída' ?> <br>
                                                                                <b>Categoria:</b> <?= $movimento['nome_categoria'] ?><br>
                                                                                <b>Empresa:</b> <?= $movimento['nome_empresa'] ?><br>
                                                                                <b>Conta:</b> <?= $movimento['banco_conta']  ?> / Ag. <?= $movimento['agencia_conta'] ?> - Núm. <?= $movimento['numero_conta'] ?><br>
                                                                                <b>Valor:</b> R$ <?= number_format($movimento['valor_movimento'], 2, ',', '.') ?> <br>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                                <button type="submit" class="btn btn-primary" name="btnExcluir">Sim</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php  } ?>
                                            </tbody>
                                        </table>
                                        <center>
                                            <label style="color: <?= $total < 0 ? 'red' : 'green' ?>;">TOTAL: R$ <?= number_format($total, 2,  ',', '.') ?></label>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
</body>

</html>
