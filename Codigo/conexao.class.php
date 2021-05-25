<?php

/* Classe de conexão ao banco de dados */

class conexao {
    private $host; // armazena o endereço do host
    private $user; // armazena o ususario do sgbd
    private $senha; // armazena a senha do usuario
    private $banco; // armazena qual base de dados a ser usada
    private $conexao; // armazena a conexao

    function __constructor($host,$user,$senha,$banco){
        $this->host = $host;
        $this->user = $user;
        $this->senha = $senha;
        $this->banco = $banco;
        $con = mysqli_connect($this->host,$this->user,$this->senha,$this->banco);

        if ($con == false)
            die("Erro ao conectar");
    }

    function getConexao(){
        return $this->conexao;
    }

    function fechar(){
        mysqli_close($this->conexao);
    }

    function query($query){
        return mysqli_query($this->conexao,$query);
    }
}

?>