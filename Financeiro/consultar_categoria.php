<?php
require_once '../DAO/UsuarioDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/CategoriaDAO.php';

$objDAO = new CategoriaDAO();
$categorias = $objDAO->ConsultarCategoria();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once '_head.php';

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
                        <h2>Consultar categoria</h2>
                        <h5>Consulte todas as suas categorias aqui </h5>
                        <?php include_once '_msg.php'; ?>
                    </div>
                </div>
                <hr/>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                              <span>Categoria cadastrada. Caso deseje alterar, clique no botão.</span>  
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Nome da categoria</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($categorias as $item){ ?>
                                            
                                                <tr class="odd gradeX">
                                                    <td><?= $item['nome_categoria'] ?></td>
                                                    <td>
                                                        <a href="alterar_categoria.php?cod=<?= $item['id_categoria'] ?>" class="btn btn-primary btn-sm"> Alterar </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <hr />
    </div>
</body>
</html>