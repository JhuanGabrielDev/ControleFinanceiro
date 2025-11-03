<?php

require_once '../DAO/UsuarioDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/CategoriaDAO.php';

if (isset($_POST['btnGravar'])) {
    $nomeCat = $_POST['nomeCat'];


    $objDAO = new CategoriaDAO();
    $ret = $objDAO->CadastrarCategoria($nomeCat);
}


?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once '_head.php';
?>

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
                        <?php include_once '_msg.php'; ?>
                        <h2>Novas Categorias</h2>
                        <h5>Aqui voce poderá cadastrar todas as suas categorias </h5>
                    </div>
                </div>
                <hr />
                <form action="nova_categoria.php" method="POST">
                    <div class="form-group">
                        <label>Nome da categoria</label>
                        <input class="form-control" name="nomeCat" id="nomeCat" placeholder="Digite uma nova categoria. Ex: conta de luz, lazer, conta de água..." maxlength="35" />
                    </div>
                    <button type="submit" onclick="return ValidarCategoria()" class="btn btn-success" name="btnGravar">Gravar</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>