<?php

require_once 'conexao.php';

session_start();

if (!isset($_SESSION['user']) || $_POST['id'] == null) {
    header("Location: index.php");
    exit();
}
$id_usuario = $_SESSION['user']['id_usuario'];
$id_op = $_POST['id'];
$data = date('Y-m-d');

$query = "UPDATE `operacao` SET `STATUS_OP` = 'Fechada', `DATA_FINAL_OP` = '$data' WHERE `operacao`.`id_op` = $id_op;";
$request = mysqli_query($conexao,$query);

$query = "SELECT livro_1 FROM operacao WHERE `operacao`.`id_op` = $id_op;";
$request = mysqli_query($conexao,$query);
$result = mysqli_fetch_assoc($request);

$id_livro = $result['livro_1'];
$query = "UPDATE `livro` SET `STATUS_LIVRO` = 'indisponivel' WHERE `livro`.`id_livro` = $id_livro;";
$request = mysqli_query($conexao,$query);

alerta("Livro recebido");
        echo "<script language='javascript'>window.location='index.php';</script>";
exit();

function alerta($text)
{
    echo "<script language='javascript'>alert('$text');</script>";
}
