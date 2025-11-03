<?php
     require_once '../DAO/UsuarioDAO.php';
     UtilDAO::VerificarLogado();
     require_once '../DAO/EmpresaDAO.php';

if(isset($_POST['btnGravar'])){

    
    $nome_Emp = $_POST['nome_Emp'];   
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    $objDAO = new EmpresaDAO();
    $ret = $objDAO->CadastrarEmpresa($nome_Emp, $telefone, $endereco);

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
                    <?php include_once '_msg.php' ?>
                    <h2>Nova Empresa</h2>
                    <h5>Aqui você poderá cadastrar as novas empresas</h5>
                </div>
            </div>
            <hr />
            <form action="nova_empresa.php" method="POST">
            <div class="form-group">
                <label>Nome da Empresa *</label>
                <input type="text" class="form-control" placeholder="Digite aqui o nome da empresa..." name="nome_Emp" id="nome_Emp"/>
            </div>

            <div class="form-group">
                <label>telefone</label>
                <input type="number" class="form-control" placeholder="Digite aqui o telefone da empresa" name="telefone" id="telefone"/>
            </div>
            <div class="form-group">
                <label>Endereço</label>
                <input class="form-control" placeholder="Digite aqui o endereço da empresa (opcional)" name="endereco"/>
            </div>
            <button type="submit" class="btn btn-success" onclick="return ValidarEmpresa()" name="btnGravar">Gravar</button>
            </form>
        </div>
    </div>
</body>