<?php

    require_once 'conexao.class.php';

    $query = $_GET['search'];

    if (empty($query)){
        header('location: index.html');
        exit();
    }

    $conect = new conexao();

    $query = "select ISBN from livro
    where titulo LIKE ('$query') or
    autor LIKE ('$query');";

    $result = $conect->query($query);

    

?>