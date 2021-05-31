function validar(){
    var nome = formuser.nome.value;
    var senha = formuser.senha.value;
    var email = formuser.email.value;
    var telefone = formuser.telefone.value;
    var CEP = formuser.cep.value;
    var Logradouro = formuser.logradouro.value;
    var Número = formuser.numero.value;
    var Bairro = formuser.bairro.value;
    var Cidade = formuser.cidade.value;

    if (nome == ""){
        alert ("Campo nome é obrigatório");
        formuser.nome.focus();
        return false;
    }
    if (email == ""){
        alert ("Campo email é obrigatório");
        formuser.email.focus();
        return false;
    }
    if (senha == ""){
        alert ("Campo senha é obrigatório");
        formuser.senha.focus();
        return false;
    }
    if (telefone == ""){
        alert ("Campo telefone é obrigatório");
        formuser.telefone.focus();
        return false;
    }
    if (CEP == ""){
        alert ("Campo CEP é obrigatório");
        formuser.cep.focus();
        return false;
    }
    if (Logradouro == ""){
        alert ("Campo logradouro é obrigatório");
        formuser.logradouro.focus();
        return false;
    }
    if (Número == ""){
        alert ("Campo número é obrigatório");
        formuser.numero.focus();
        return false;
    }
    if (Bairro == ""){
        alert ("Campo bairro é obrigatório");
        formuser.bairro.focus();
        return false;
    }
    if (Cidade == ""){
        alert ("Campo cidade é obrigatório");
        formuser.cidade.focus();
        return false;
    }



}
