<?php

require_once "conexao.class.php";

session_start();

$email = $_POST('usuario');
$senha = md5($_POST('senha'));

if (empty($email) || empty($senha)){
    header("Location: index.php");
    exit();
}

$connect = new conexao();

$query = "select id_usuario from usuario
where email = '$email' and senha = '$senha';";

$result = $connect->query($query);

if ($result != null){
    $_SESSION['user'] = $result;
    header("Location: index.php");
    exit();
}else{
    $_SESSION['user'] = null;
    header("Location: index.php");
    exit();
}

?>