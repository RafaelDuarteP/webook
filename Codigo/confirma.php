<?php

require_once "conexao.php";

session_start();

if (!isset($_SESSION['user'])) {
    alerta("Você precisa efetuar login para adquirir um livro");
    echo "<script language='javascript'>window.location='login.html';</script>";
    exit();
}

$livro = $_POST['livro'];
$tipo = $_POST['tipo'];
$data = date('Y-m-d');
$user1 = $_POST['user_1'];
$user2 = $_POST['user_2'];


if ($user1 === $user2) {
    alerta("Você não pode adiquirir o próprio livro");
    echo "<script language='javascript'>window.location='index.php';</script>";
    exit();
}


$query = "INSERT INTO `webook`.`operacao` (`TIPO`, `DATA_OP`, `STATUS_OP`, `LIVRO_1`, `USUARIO_1`, `USUARIO_2`) 
VALUES ('$tipo', '$data', 'Aberta', '$livro', '$user1', '$user2');
";

$request = mysqli_query($conexao, $query);
$result = mysqli_affected_rows($conexao);

if ($result == true) {
    $query = "UPDATE `webook`.`livro` SET `STATUS_LIVRO` = 'Em processo' WHERE (`id_livro` = '$livro');";
    $request = mysqli_query($conexao, $query);
    $result = mysqli_affected_rows($conexao);
    if ($result == true) {
        alerta("Livro reservado com sucesso confira o painel de notificações para mais informações");
        echo "<script language='javascript'>window.location='index.php';</script>";
    exit();
    }
}


function alerta($text)
{
    echo "<script language='javascript'>alert('$text');</script>";
}
