<?php

require_once "conexao.php";

session_start();

if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = md5($_POST['senha']);
$telefone = $_POST['telefone'];
$cep = $_POST['cep'];
$logradouro = $_POST['logradouro'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];



if (
    empty($nome) || empty($email) || empty($senha) || empty($telefone) || empty($cep) || empty($logradouro) || empty($numero)
    || empty($bairro) || empty($cidade) || empty($estado)
) {
    header('Location: index.php');
    exit();
}

$query = "select id_usuario from usuario
where email = '$email';";
$request = mysqli_query($conexao,$query);
$result = mysqli_num_rows($request);

if ($result != 0 ){
    alerta("Email já cadastrado");
    echo "<script language='javascript'>window.location='cadastroUsuario.html';</script>";   
}



$query = "INSERT INTO `webook`.`usuario` (`email`, `nome`, `telefone`, `senha`, `rua`, `bairro`, `cidade`, `estado`, `numero_casa`, `cep`) 
VALUES ('$email', '$nome', '$telefone', '$senha', '$logradouro', '$bairro', '$cidade', '$estado', '$numero', '$cep');
";
$request = mysqli_query($conexao,$query);
$result = mysqli_affected_rows($conexao);

if ($result == true) {
    alerta("Ususario cadastrado com sucesso você pode entrar pela pagina de login");
    echo "<script language='javascript'>window.location='login.html';</script>";
    exit();
} else {
    alerta("Livro não cadastrado");
    echo "<script language='javascript'>window.location='index.php';</script>";
    exit();
}

function alerta($text)
{
    echo "<script language='javascript'>alert('$text');</script>";
}