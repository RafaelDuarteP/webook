<?php

    require_once 'conexao.class.php';

    $search = $_GET['search'];

    if (empty($query)){
        header('location: index.php');
        exit();
    }

    $conect = new conexao();

    $query = "select ISBN from livro
    where titulo LIKE ('%$search%') or
    autor LIKE ('%$search%');";

    $result = $conect->query($query);

    

?>