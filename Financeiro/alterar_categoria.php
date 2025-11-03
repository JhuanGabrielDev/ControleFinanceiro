<?php
require_once '../DAO/UsuarioDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/CategoriaDAO.php';

$objDAO = new CategoriaDAO();

// Validação do GET
if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    $idCategoria = $_GET['cod'];
    $dados = $objDAO->DetalharCategoria($idCategoria);

    if (count($dados) == 0) {
        header('location: consultar_categoria.php');
        exit;
    }
} else if (isset($_POST['btnSalvar'])) {
    // Validação de POST para salvar categoria
    $nomeCat = trim($_POST['nomeCat']);
    $idCategoria = $_POST['cod'];

    // Validação do nome da categoria
    if (empty($nomeCat)) {
        // Caso o nome da categoria esteja vazio
        echo "<script>alert('O nome da categoria não pode ser vazio.');</script>";
    } else {
        // Caso o nome da categoria seja válido
        $ret = $objDAO->AlterarCategoria($nomeCat, $idCategoria);
        header('location: consultar_categoria.php?ret=' . $ret);
        exit;
    }
} else if (isset($_POST['btnExcluir'])) {
    // Validação de exclusão de categoria
    $idCategoria = $_POST['cod'];
    $ret = $objDAO->ExcluirCategoria($idCategoria);
    header('location: consultar_categoria.php?ret=' . $ret); 
    exit;
} else {
    header('location: consultar_categoria.php');
    exit;
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once "_head.php"; ?>

<body>
    <?php include_once "_topo.php"; include_once "_menu.php"; ?>
    <div id="wrapper">
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Alterar Categoria</h2>
                        <h5>Aqui você poderá alterar ou excluir suas categorias</h5>
                        <?php include_once '_msg.php' ?>
                    </div>
                </div>
                <hr />
                <form action="alterar_categoria.php" method="post" onsubmit="return validarFormulario()">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_categoria'] ?>">
                    <div class="form-group">
                        <label>Digite o nome da Categoria</label>
                        <input class="form-control" placeholder="Digite uma nova categoria. Ex: conta de luz" name="nomeCat" id="nomeCat" value="<?= $dados[0]['nome_categoria'] ?>" maxlength="35" />
                    </div>
                    <button type="submit" class="btn btn-success" name="btnSalvar">Salvar</button>
                    <button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger">Excluir</button>
                   
                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de exclusão</h4>
                                </div>
                                <div class="modal-body">
                                   Deseja excluir a categoria:  <b> <?=  $dados[0]['nome_categoria'] ?> </b>
                                </div> 
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary" name="btnExcluir" onclick="return ValidarCategoria()" >Sim</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Validação do formulário no lado do cliente
        function validarFormulario() {
            var nomeCategoria = document.getElementById('nomeCat').value.trim();

            // Verifica se o campo de nome da categoria está vazio
            if (nomeCategoria === "") {
                alert("O nome da categoria não pode ser vazio.");
                return false; // Impede o envio do formulário
            }

            return true; // Permite o envio do formulário
        }
    </script>
</body>

</html>
