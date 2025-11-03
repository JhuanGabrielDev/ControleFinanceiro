<?php

require_once '../DAO/UsuarioDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/UsuarioDAO.php';

$objDAO = new UsuarioDAO();

if (isset($_POST['btnGravar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $ret = $objDAO->GravarMeusDados($nome, $email, $senha);
}
$dados = $objDAO->CarregarMeusDados();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php
    include_once '_head.php';
    ?>
</head>

<body>
    <?php
    include_once '_topo.php';
    include_once '_menu.php';
    ?>
    <div id="wrapper">
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Alterar dados de acesso</h2>
                        <h5>Nessa página voce pode alterar seus dados. </h5>
                        <?php include_once '_msg.php'; ?>
                    </div>
                </div>
                <hr />
                <form action="meus_dados.php" method="POST">
                    <div class="form-group">
                        <label>Aletere seu Nome</label>
                        <input class="form-control" placeholder="Altere seu nome" name="nome" id="nome" value="<?= $dados[0]['nome_usuario'] ?> "/>
                    </div>
                    <div class="form-group">
                        <label>Aletere seu E-mail</label>
                        <input class="form-control" placeholder="Altere seu e-mail" name="email" id="email" value="<?= $dados[0]['email_usuario'] ?> "/>
                    </div>
                    <div class="form-group">
                        <label>Aletere sua senha</label>
                        <input class="form-control" placeholder="Altere sua senha" name="senha" id="senha" value="<?= $dados[0]['senha_usuario'] ?> "/>
                    </div>
                    <button type="submit" class="btn btn-success" name="btnGravar" onclick="return ValidarMeusDados()">Gravar</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>