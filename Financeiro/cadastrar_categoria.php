<?php
include_once '../DAO/UsuarioDAO.php';


if(isset($_POST['btnSalvar'])){

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $rsenha = $_POST['rsenha'];

    $objDAO = new UsuarioDAO();
    $ret = $objDAO->CadastrarUsuario($nome, $email, $senha, $rsenha);
}



?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once "_head.php";

?>
<body>
    <div class="container">
        <div class="row text-center  ">
            <div class="col-md-12">
                <br /><br />
                <?php include_once '_msg.php'; ?>
                <h2> Controle Financeiro: CADASTRO</h2>
                <h5>( Faça seu cadastro )</h5>
                 <br />
            </div>
        </div>
         <div class="row">  
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                        <strong>  Usuário novo, faça seu cadastro </strong>  
                            </div>
                            <div class="panel-body">
                                <form action="cadastro.php" method="POST">
<br/>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-circle-o-notch"  ></i></span>
                                            <input type="text" class="form-control" placeholder="Seu nome" name="nome" id="nome" />
                                        </div>

                                         <div class="form-group input-group">
                                            <span class="input-group-addon">@</span>
                                            <input type="text" class="form-control" placeholder="Seu e-mail" name="email" id="email" />
                                        </div>
                                      <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" class="form-control" placeholder="crie sua senha (mínimo 6 caracteres)" name="senha" id="senha"/>
                                        </div>
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" class="form-control" placeholder="confirme sua senha" name="rsenha" id="rsenha" />
                                        </div>
                                     
                                     <button href="index.html" class="btn btn-success " onclick="return ValidarCadastro()" name="btnSalvar">Cadastrar</button>
                                    <hr />
                                    Já tem cadastro?  <a href="login.php" >Faça o login aqui!!</a>
                                    </form>
                            </div>                          
                        </div>
                    </div>
                
                
        </div>
    </div>
   
</body>
</html>
