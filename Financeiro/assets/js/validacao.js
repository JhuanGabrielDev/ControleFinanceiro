function ValidarMeusDados() {
    var nome = document.getElementById("nome").value;
    var email = $("#email").val();

    if (nome.trim() == '') {
        alert("Preencha o campo nome");
        $("#nome").focus();
        return false;
    }

    // if (email.trim() == '') {
    //     alert("Preencha o campo email");
    //     $("#emailUsuario").focus();
    //     return false;
    // }

    if ($("#email").val().trim() == '') {
        alert("Preencha o E-mail do Usuário");
        $("#email").focus();
        return false;
    }

    if ($("#senha").val().trim() == '') {
        alert("Preencha a Senha");
        $("#senha").focus();
        return false;
    }
   
}

function ValidarCategoria() {
    if ($("#nomeCat").val().trim() == '') {
        alert("Preencha o nome da categoria");
        $("#nomeCat").focus();
        return false;
    }
}

function ValidarEmpresa() {
    if ($("#nome_Emp").val().trim() == '') {
        alert("Preencha o nome da empresa");
        $("#nome_Emp").focus();
        return false;
    }
    if ($("#telefone").val().trim() == '') {
        alert("Preencha o campo TELEFONE");
        $("#telefone").focus();
        return false;

    }
    // if ($("#endereco").val().trim() == '') {
    //     alert("Preencha o campo ENDEREÇO");
    //     $("#endereco").focus();
    //     return false;


    // } 
}
function ValidarConta() {
    if ($("#banco").val().trim() == '') {
        alert("Preencha o nome do banco");
        $("#banco").focus();
        return false;
    }
    if ($("#agencia").val().trim() == '') {
        alert("Preencha o número da agência");
        $("#agencia").focus();
        return false;
    }
    if ($("#numero").val().trim() == '') {
        alert("Preencha o número da conta");
        $("#numero").focus();
        return false;
    }
    if ($("#saldo").val().trim() == '') {
        alert("Preencha o valor do saldo");
        $("#saldo").focus();
        return false;
    }
}

function ValidarMovimento() {
    if ($("#tipo").val() == '') {
        alert("selecione o tipo do movimento");
        $("#tipo").focus();
        return false;
    }
    if ($("#data").val().trim() == '') {
        alert("Selecione a data do movimento");
        $("#data").focus();
        return false;
    }
    if ($("#valor").val().trim() == '') {
        alert("Preencha o valor");
        $("#valor").focus();
        return false;
    }
    if ($("#categoria").val() == '') {
        alert("Selecione a categoria");
        $("#categoria").focus();
        return false;
    }
    if ($("#empresa").val() == '') {
        alert("Selecione a empresa");
        $("#empresa").focus();
        return false;
    }
    if ($("#conta").val() == '') {
        alert("Selecione a conta");
        $("#conta").focus();
        return false;
    }
}

function ValidarConsultaPeriodo() {
    if ($("#data_inicial").val().trim() == '') {
        alert("Selecione a data inicial");
        $("#data_inicial").focus();
        return false;
    }
    if ($("#data_final").val().trim() == '') {
        alert("Selecione a data final");
        $("#data_final").focus();
        return false;
    }
}

function ValidarLogin() {
    if ($("#emailUsuario").val().trim() == '') {
        alert("Preencha o campos email");
        $("#emailUsuario").focus();
        return false;
    }
    if ($("#senha").val().trim() == '') {
        alert("Preencha o campos senha");
        $("#senha").focus();
        return false;
    }
}

function ValidarCadastro() {
    if ($("#nomeUsuario").val().trim() == '') {
        alert("Preencha o campos nome");
        $("#nomeUsuario").focus();
        return false;
    }
    if ($("#emailUsuario").val().trim() == '') {
        alert("Preencha o campos email");
        $("#emailUsuario").focus();
        return false;
    }
    if ($("#senha").val().trim() == '') {
        alert("Preencha o campos senha");
        $("#senha").focus();
        return false;
    }
    if ($("#repSenha").val().trim() == '') {
        alert("Preencha o campos confirmar senha");
        $("#repSenha").focus();
        return false;
    }
    if ($("#senha").val().trim().length < 6) {
        alert("A senha deverá ter no mínimo 6 caracteres");
        $("#senha").focus();
        return false;
    }
    if ($("#senha").val().trim() != $("#repSenha").val().trim()) {
        alert("O Campo senha e repetir senha deverão ser iguais");
        $("#repSenha").focus();
        return false;
    }
}