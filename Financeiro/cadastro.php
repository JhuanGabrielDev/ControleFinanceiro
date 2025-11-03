<?php

require_once '../DAO/UsuarioDAO.php';

if(isset($_POST['btnCadastrar'])){
    $nomeUsuario = $_POST['nomeUsuario'];
    $emailUsuario = $_POST['emailUsuario'];
    $senha = $_POST['senha'];
    $repSenha = $_POST['repSenha'];

    // Validação dos dados
    $errors = [];
    if (empty($nomeUsuario)) {
        $errors[] = "Nome é obrigatório.";
    }
    if (empty($emailUsuario)) {
        $errors[] = "E-mail é obrigatório.";
    }
    if (empty($senha)) {
        $errors[] = "Senha é obrigatória.";
    }
    if (strlen($senha) < 6 || strlen($senha) > 8) {
        $errors[] = "A senha deve conter entre 6 e 8 caracteres.";
    }
    if ($senha !== $repSenha) {
        $errors[] = "As senhas não coincidem.";
    }

    // Se não houver erros, cadastrar o usuário
    if (empty($errors)) {
        $objDAO = new UsuarioDAO();
        $ret = $objDAO->CadastrarUsuario($nomeUsuario, $emailUsuario, $senha, $repSenha);

        // Verifica o retorno da operação de cadastro
        if ($ret) {
            echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href = 'login.php';</script>";
        } else {
            echo "<script>alert('Erro ao cadastrar usuário. Tente novamente mais tarde.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once '_head.php'; ?>

<body>
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <br/>
                <br/>              
                <h2>Cadastro de Conta</h2>
                <h5>(Cadastre seus Dados de Acesso aqui).</h5>
                <br/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Preencha todos os dados:</strong>
                    </div>
                    <div class="panel-body">
                        <?php 
                        if (!empty($errors)) {
                            foreach ($errors as $error) {
                                echo "<div class='alert alert-danger'>$error</div>";
                            }
                        }
                        ?>
                        <br />

                        <form action="cadastro.php" method="POST" role="form">
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-circle-o-notch"></i></span>
                                <input type="text" class="form-control" placeholder="Digite seu Nome aqui..." name="nomeUsuario" id="nomeUsuario" value="<?= isset($nomeUsuario) ? $nomeUsuario : '' ?>" required />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon">@</span>
                                <input type="email" class="form-control" placeholder="Digite seu E-mail aqui..." name="emailUsuario" id="emailUsuario" value="<?= isset($emailUsuario) ? $emailUsuario : '' ?>" required />
                            </div>
                            <span style="font-size: 9px; padding-left: 4px; font-style: italic;">A SENHA deve conter entre 6 e 8 caracteres!</span>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" placeholder="Digite sua Senha aqui..." name="senha" id="senha" value="<?= isset($senha) ? $senha : '' ?>" required />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" placeholder="Digite novamente sua Senha..." name="repSenha"  id="repSenha" value="<?= isset($repSenha) ? $repSenha : '' ?>" required />
                            </div>
                            <button class="btn btn-success" name="btnCadastrar" onclick="return ValidarCadastro()">Cadastrar</button>
                        </form>
                        <hr/>
                        <span>Já possui uma Conta?</span> <a href="login.php">Clique aqui...</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
