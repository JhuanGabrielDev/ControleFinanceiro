function ValidarMeusDados(){
    var nome = document.getElementById("nome").value;
    var email = $("#email").val();

    if(nome.trim() == ''){
        alert ("Preencha o campo nome");
        $("#nome").focus();
        return false;
    }
    if(email.trim() == ''){
        alert("Preencha o campo email");
        return false;
    }
}

function ValidarCategoria(){
    if($("#nomecategoria").val().trim() == ''){
        alert ("Preencha o nome da categoria");
        $("#nomecategoria").focus();
        return false;
    }
}

function ValidarEmpresa(){
    if($("#nomeempresa").val().trim() == ''){
        alert("Preencha o nome da empresa");
        $("#nomeempresa").focus();
        return false;
    }
}

function ValidarConta(){
    if($("#banco").val().trim() == ''){
        alert ("Preencha o nome do banco");
        $("#banco").focus();
        return false;
    }
}

if($("#agencia").val().trim() == ''){
    alert ("Preencha o número da agência");
    $("#agencia").focus();
    return false;
}
if($("#numero").val().trim() == ''){
    alert("Preencha o número da conta");
    $("#numero").focus();
    return false;
}
if($("#saldo").val().trim() == ''){
    alert ("Preencha o valor dos saldo");
    $("#saldo").focus();
    return false;
}