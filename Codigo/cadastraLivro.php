<?php

require_once 'conexao.php';

session_start();

if (!isset($_SESSION['user'])) {
    alerta("Você precisa efetuar login para cadastrar um livro");
    echo "<script language='javascript'>window.location='login.html';</script>";
    exit();
}

$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$editora = $_POST['editora'];
$edicao = $_POST['edicao'];
$ano = $_POST['ano'];
$idioma = $_POST['idioma'];
$paginas = $_POST['paginas'];
$isbn = $_POST['isbn'];
$genero = $_POST['genero'];
$tipo = $_POST['tipo'];
$usuario = $_SESSION['user']['id_usuario'];

if (
    empty($titulo) || empty($autor) || empty($editora) || empty($edicao) || empty($ano) || empty($idioma) || empty($paginas)
    || empty($isbn) || empty($genero) || empty($tipo)
) {
    header('Location: index.php');
    exit();
}

$query = "INSERT INTO livro (`ISBN`, `GENERO`, `TITULO`, `EDICAO`, `NUMERO_PAGINAS`, `IDIOMA`, `ANO`, `EDITORA`, `AUTOR`, `TIPO`, `id_usuario`) 
VALUES ('$isbn', '$genero', '$titulo', '$edicao', '$paginas', '$idioma', '$ano', '$editora', '$autor', '$tipo', '$usuario');";
$request = mysqli_query($conexao, $query);
$result = mysqli_affected_rows($conexao);



if ($result == true) {
    alerta("Livro cadastrado com sucesso");
    echo "<script language='javascript'>window.location='index.php';</script>";
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
