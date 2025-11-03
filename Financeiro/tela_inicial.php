<?php
    require_once '../DAO/UsuarioDAO.php';
    UtilDAO::VerificarLogado();
    require_once '../DAO/UtilDAO.php';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once '_head.php'; ?>

<body>
    <div id="wrapper">
        <?php
            include_once '_topo.php';
            include_once '_menu.php';
        ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Sistema de Controle Financeiro.</h2>
                        <h5>Seja bem vindo [ Nome do Usuário ], esse é seu Sistema de Controle Financeiro (Fluxo de Caixa), você pode acessar os módulos no MENU a esquerda.</h5>
                    </div>
                </div>
                <hr/>

            </div>
        </div>
    </div>
</body>
</html>