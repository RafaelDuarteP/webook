<?php

    require_once 'conexao.php';

    $search = $_GET['search'];

    if (empty($query)){
        header('location: index.php');
        exit();
    }

    $query = "select ISBN from livro
    where titulo LIKE ('%$search%') or
    autor LIKE ('%$search%');";

    $request = mysqli_query($conexao,$query);

    

?>