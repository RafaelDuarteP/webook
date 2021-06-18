<?php

require_once 'conexao.php';

$search = $_GET['search'];

session_start();

if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = null;
} elseif ($_SESSION['user'] != null) {
    $id_usuario = $_SESSION['user']['id_usuario'];
    $query = "select nome from usuario where id_usuario = $id_usuario ;";

    $request = mysqli_query($conexao, $query);
    $nomeUsuario = mysqli_fetch_assoc($request);
    $nomeUsuario = $nomeUsuario['nome'];
}

if (empty($search)) {
    header('location: index.php');
    exit();
}

$query = "select titulo, editora, autor, edicao, id_livro, tipo from livro 
where status_livro = 'disponivel' AND TITULO LIKE '%$search%' OR AUTOR LIKE '%$search%';";

$request = mysqli_query($conexao, $query);
$result = mysqli_fetch_all($request);




?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Link do Bootstrap v5.0-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <!--Link do FontAwesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="shortcut icon" href="./img/WeBookShortcut.png" type="image/x-icon">
    <title>WeBook</title>
    <link type="text/css" rel="stylesheet" href="style.css">
</head>

<body>

    <!--Cabeçalho-->
    <header class="container-fluid">
        <nav class="navbar navbar-expand-md align-items-center justify-content-between">
            <div class="col-3">
                <a href="./"><img class="mx-auto logo" src="./img/WeBookLogo.png" alt="logo"></a>
            </div>
            <!--Menu de botões-->
            <button class="col-auto navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#buttonsMenu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-ellipsis-v"></i>
            </button>
            <div class="col-12 col-md-auto">
                <div class="collapse navbar-collapse  mt-2 mt-lg-0" id="buttonsMenu">
                    <div class="row justify-content-end">
                        <?php
                        if ($_SESSION['user'] != null) :
                        ?>
                            <div class="col-12 col-md-auto mt-4 dropdown">
                                <a class="link-header" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo $nomeUsuario; ?>
                                </a>
                                <div class="dropdown-menu sair" aria-labelledby="dropdownMenuLink">
                                    <p><a href="./notifications.php">Notificações</a></p>
                                    <p><a href="./logoff.php">Sair</a></p>
                                </div>
                            </div>

                        <?php
                        else :
                        ?>

                            <div class="col-12 col-md-auto mt-4">
                                <a class="link-header" href="./Login.html">Login</a>
                            </div>

                        <?php
                        endif;
                        ?>
                        <div class="col-12 col-md-auto mt-4">
                            <button onclick="window.location.href ='./cadatroLivro.html' " type="button" class="btn-header">Cadastrar livro</button>
                        </div>
                        <div class="col-12 col-md-auto mt-4">
                            <button onclick="window.location.href ='./cadastroUsuario.html' " <?php if ($_SESSION['user'] != null) echo "disabled"; ?> type="button" class="btn-header">Cadastre-se</button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>


    </header>

    <!--Container de busca-->
    <section class="pesquisa container-fluid">
        <div class="row ">
            <form class="col-12" action="busca.php" method="get">
                <label class="label-search d-block" for="search">Pesquisa</label>
                <div class="row justify-content-center">
                    <input class="col-auto" type="text" name="search" id="search">
                    <button class="col-auto btn-search" type="submit"><i class="fas fa-search fa-2x"></i></button>
                </div>
            </form>
        </div>
    </section>

    <!--Container de livros recentes-->
    <section class="container-lg recentes">
        <h1 class="text-center mt-5">
            Exibindo resultados para: "<?php echo $search ?>"
        </h1>

        <div class="row justify-content-evenly mt-5">
            <?php

            for ($i = 0; $i < mysqli_num_rows($request); $i++) :
                $livro = $result[$i];
                $id_livro = $livro[4];
                $titulo = $livro[0];
                $editora = $livro[1];
                $edicao = $livro[3];
                $autor = $livro[2];
                $tipo = $livro[5];
            ?>

                <div class="col-10 col-md-4 col-lg-2 my-2 mx-2 card-livro">
                    <a href="livro.php?id=<?php echo $id_livro ?>">
                        <div>
                            <h1><?php echo $titulo ?></h1>
                            <p><?php echo $editora ?> </p>
                            <p><?php echo $autor ?> </p>
                            <p><?php echo $edicao  ?>ª edição </p>
                            <p><?php echo $tipo ?> </p>
                        </div>
                    </a>
                </div>

            <?php
            endfor;
            ?>

        </div>


    </section>



    <!--Rodapé-->
    <footer class="containe-fluid">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <p>
                    Trabalho Interdiciplinar II - Engenharia de Software / Sistemas de Informação - PUC MINAS - 2021
                </p>
            </div>
            <div class="col-auto">
                <img src="./img/WeBookLogo.png" alt="logo" class="logo">
            </div>
        </div>
    </footer>

    <!--Script do Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

    <script type="text/javascript" src="./script.js"></script>
</body>

</html>