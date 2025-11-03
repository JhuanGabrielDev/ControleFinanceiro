<?php

if(isset($_GET['ret'])){
    $ret = $_GET['ret'];
}

if (isset($ret)) {

    switch ($ret) {
        case 0:
            echo '<div class="alert alert-warning">
        Preencha todos os campos.
    </div>';
            break;
        case 1:
            echo '<div class="alert alert-success">
                Ação realizada com sucesso.
            </div>';
            break;

        case -1:
            echo '<div class="alert alert-danger">
                    Ocorreu um erro na operação. Tente mais tarde.
                </div>';
            break;
        case -2:
            echo '<div class="alert alert-danger">
                    A senha deverá conter no mínimo 6 caracteres.
                </div>';
            break;
        case -3:
            echo '<div class="alert alert-danger">
                    A senha e a confirmação de senha precisam ser a mesma.
                </div>';
            break;

            case -4:
                echo '<div class="alert alert-danger">
                       Este ITEM esta em uso, não pode ser excluido.
                    </div>';

                    case -5:
                        echo '<div class="alert alert-danger">
                            E-mail ja cadastrado. Coloque outro e-mail
                            </div>';

                            case -6:
                                echo '<div class="alert alert-danger">
                                    Usuario não encontrado
                                    </div>';
    }

}
