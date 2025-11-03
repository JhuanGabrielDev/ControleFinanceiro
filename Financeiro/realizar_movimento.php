<?php
require_once '../DAO/UsuarioDAO.php';
UtilDAO::VerificarLogado();

include_once '../DAO/MovimentoDAO.php';
include_once '../DAO/CategoriaDAO.php';
include_once '../DAO/EmpresaDAO.php';
include_once '../DAO/ContaDAO.php';

$dao_cat = new CategoriaDAO();
$dao_emp = new EmpresaDAO();
$dao_con = new ContaDAO();


$tipo = '';
$categoria = '';
$empresa = '';
$conta = '';

if (isset($_POST['btnGravar'])) {
    $tipo = $_POST['tipo'];
    $data = $_POST['data'];
    $valor = $_POST['valor'];
    $obs = $_POST['obs'];
    $categoria = $_POST['categoria'];
    $empresa = $_POST['empresa'];
    $conta = $_POST['conta'];

    $objDAO = new MovimentoDAO();
    $ret = $objDAO->RealizarMovimento($tipo, $data, $valor, $obs, $categoria, $empresa, $conta);
}

$categoria = $dao_cat->ConsultarCategoria();
$empresa = $dao_emp->ConsultarEmpresa();
$conta = $dao_con->ConsultarConta();
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
                        <?php include_once '_msg.php'; ?>
                        <h2>Realizar Movimento</h2>
                        <h5>Aqui você poderá realizar seus movimentos de entrada ou saída</h5>
                    </div>
                </div>
                <hr />
                <form method="POST" action="realizar_movimento.php">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tipo do Movimento</label>
                            <select class="form-control" name="tipo" id="tipo">
                                <option value="">Selecione</option>
                                <option value="1" <?= $tipo == 1 ? 'selected' : '' ?>>Entrada</option>
                                <option value="2" <?= $tipo == 2 ? 'selected' : '' ?>>Saída</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label> Selecione uma Data</label>
                            <input type="date" class="form-control" name="data" id="data" value="<?= isset($data) ? $data : '' ?>" />
                        </div>

                        <div class="form-group">
                            <label> Digite o valor (R$):</label>
                            <input class="form-control" placeholder="Digite o valor aqui..." name="valor" id="valor" value="<?= isset($valor) ? $valor : '' ?>" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label> Selecione uma Categoria Financeira:</label>
                            <select class="form-control" name="categoria" id="categoria">
                                <option value="">Selecione</option>
                                <?php foreach($categoria as $item): ?>
                                    <option value="<?= $item['id_categoria'] ?>" <?= $categoria == $item['id_categoria'] ? 'selected' : '' ?>>
                                        <?= $item['nome_categoria'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label> Selecione uma Empresa:</label>
                            <select class="form-control" name="empresa" id="empresa">
                                <option value="">Selecione</option>
                                <?php foreach($empresa as $item): ?>
                                    <option value="<?= $item['id_empresa'] ?>" <?= $empresa == $item['id_empresa'] ? 'selected' : '' ?>>
                                        <?= $item['nome_empresa'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label> Selecione uma Conta Bancária:</label>
                            <select class="form-control" name="conta" id="conta">
                                <option value="">Selecione</option>
                                <?php foreach($conta as $item): ?>
                                    <option value="<?= $item['id_conta'] ?>" <?= $conta == $item['id_conta'] ? 'selected' : '' ?>>
                                        Banco <?= $item['banco_conta'] ?>, Agência: <?= $item['agencia_conta'] ?> / <?= $item['numero_conta'] ?> - Saldo: R$ <?= $item['saldo_conta'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Observação (opcional)</label>
                            <textarea class="form-control" rows="3" name="obs"></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success" name="btnGravar" onclick="return ValidarMovimento()">Gravar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
