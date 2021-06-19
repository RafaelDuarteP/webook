<?php

require_once "conexao.php";

session_start();

$email = $_POST['usuario'];
$senha = md5($_POST['senha']);

if (empty($email) || empty($senha)){
    header("Location: index.php");
    exit();
}


$query = "select id_usuario from usuario
where email = '$email' and senha = '$senha';";

$request = mysqli_query($conexao,$query);
$result = mysqli_fetch_assoc($request);


if ($result != null){
    $_SESSION['user'] = $result;
    header("Location: index.php");
    exit();
}else{
    $_SESSION['user'] = null;
    header("Location: login.html");
    exit();
}

?>