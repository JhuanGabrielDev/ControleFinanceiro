<?php

    require_once '../DAO/UtilDAO.php';
    UtilDAO::VerificarLogado();
    require_once '../DAO/ContaDAO.php';

$objDAO = new ContaDAO();

if(isset($_GET['cod']) && is_numeric($_GET['cod'])){

    $idConta = $_GET['cod'];
    $dados = $objDAO->DetalharConta($idConta);

      if(count($dados) == 0){
        header('location: consultar_conta.php');
        exit;
      }

}else if (isset($_POST['btnSalvar'])){
    $idConta = $_POST['cod'];
    $banco = $_POST['banco'];
    $agencia = $_POST['agencia'];
    $numero = $_POST['numero'];
    $saldo = $_POST['saldo'];

    $ret = $objDAO->AlterarConta($idConta, $banco, $agencia, $numero, $saldo);

    header('location: consultar_conta.php?ret='  .  $ret);
    exit;

   
}else if (isset($_POST['btnExcluir'])){
    $idConta = $_POST['cod'];
    $ret = $objDAO->ExcluirConta($idConta);
    header('location: consultar_conta.php?ret=' . $ret);
    exit;
}else {
  
    header('location: consultar_conta.php');
    exit;

}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php include_once "_head.php";
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
                    <h2>Nova Conta</h2>
                    <h5>Aqui você poderá alterar suas contas</h5>
                </div>
            </div>
            <hr />
            <form method="POST" action="alterar_conta.php">
                <input type="hidden" name="cod" value="<?= $dados[0]['id_conta'] ?>">
            <div class="form-group">
                <label>Nome do Banco </label>
                <input class="form-control" placeholder="Digite aqui o nome do seu banco...." id="banco" name="banco" value="<?= $dados[0]['banco_conta'] ?>"/>
            </div>
            <div class="form-group">
            <label>Agência</label>
            <input type="number" class="form-control" placeholder="Digite aqui a agência..." id="agencia" name="agencia" value="<?= $dados[0]['agencia_conta'] ?>"/>
            </div>
            <div class="form-group">
                <label>Número da conta </label>
                <input type="number" class="form-control" placeholder="Digite aqui o número da sua conta..." id="numero" name="numero" value="<?= $dados[0]['numero_conta'] ?>"/>
            </div>
            <div class="form-group">
                <label>Saldo </label>
                <input type="number" class="form-control" placeholder="Digite aqui o valor do saldo..." id="saldo" name="saldo" value="<?= $dados[0]['saldo_conta'] ?>"/>
            </div>
        <button type="submit" class="btn btn-success" onclick="return ValidarConta()" name="btnSalvar">Salvar</button>
        <button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger" >Excluir</button>
                   
                   <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                       <div class="modal-dialog">
                           <div class="modal-content">
                               <div class="modal-header">
                                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                   <h4 class="modal-title" id="myModalLabel">Confirmação de exclusão</h4>
                               </div>
                               <div class="modal-body">
                                   Deseja exluir a Conta:  <b><?=  $dados[0]['banco_conta'] ?>  / <?= $dados[0]['agencia_conta'] ?> - <?=  $dados[0]['numero_conta'] ?> ?</b>
                               </div>
                               <div class="modal-footer">
                                   <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                   <button type="submit" class="btn btn-primary" name="btnExcluir">Sim</button>
                               </div>
                           </div>
                       </div>
                   </div>
        </div>
    </div>
    </div>
</form>
</body>
</html>

