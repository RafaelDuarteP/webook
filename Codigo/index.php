<?php

require_once 'conexao.php';

session_start();

if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = null;
} elseif ($_SESSION['user'] != null) {
    $id_usuario = $_SESSION['user']['id_usuario'];
    $query = "select nome from usuario where id_usuario = $id_usuario ;";

    $request = mysqli_query($conexao,$query);
    $nomeUsuario = mysqli_fetch_assoc($request);
    $nomeUsuario = $nomeUsuario['nome'];
}

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
    <title>WeBook</title>
    <link type="text/css" rel="stylesheet" href="style.css">
</head>

<body>
    <!--Cabeçalho-->
    <header class="container-fluid">
        <div class="row align-items-center justify-content-between">
            <div class="col-3">
                <img class="logo" src="./img/default-image.jpg" alt="logo">
            </div>
            <!--Menu de botões-->
            <div class="col-auto">
                <div class="row">
                    <?php
                    if ($_SESSION['user'] != null) :
                    ?>
                        <div class="col-auto">
                            <a class="link-header" href="#"><?php echo $nomeUsuario; ?></a>
                        </div>

                    <?php
                    else :
                    ?>

                        <div class="col-auto">
                            <a class="link-header" href="#">Login</a>
                        </div>

                    <?php
                    endif;
                    ?>
                    <div class="col-auto">
                        <button type="button" class="btn-header">Cadastrar livro</button>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn-header <?php if ($_SESSION['user'] != null) echo 'disbled'; ?>">Cadastre-se</button>
                    </div>
                </div>
            </div>
        </div>
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
            Livros Recentes
        </h1>

        <div class="row justify-content-evenly mt-5">
            <h3 class="col-12">
                Livros para empréstimo
            </h3>
            <div class="col-2 card-livro">
                <a href="#">
                    <img class="w-100" src="./img/default-image.jpg" alt="">
                </a>
            </div>
            <div class="col-2 card-livro">
                <a href="#">
                    <img class="w-100" src="./img/default-image.jpg" alt="">
                </a>
            </div>
            <div class="col-2 card-livro">
                <a href="#">
                    <img class="w-100" src="./img/default-image.jpg" alt="">
                </a>
            </div>
            <div class="col-2 card-livro">
                <a href="#">
                    <img class="w-100" src="./img/default-image.jpg" alt="">
                </a>
            </div>
            <div class="col-2 card-livro">
                <a href="#">
                    <img class="w-100" src="./img/default-image.jpg" alt="">
                </a>
            </div>
        </div>

        <div class="row justify-content-evenly mt-5">
            <h3 class="col-12">
                Livros para doação
            </h3>
            <div class="col-2 card-livro">
                <a href="#">
                    <img class="w-100" src="./img/default-image.jpg" alt="">
                </a>
            </div>
            <div class="col-2 card-livro">
                <a href="#">
                    <img class="w-100" src="./img/default-image.jpg" alt="">
                </a>
            </div>
            <div class="col-2 card-livro">
                <a href="#">
                    <img class="w-100" src="./img/default-image.jpg" alt="">
                </a>
            </div>
            <div class="col-2 card-livro">
                <a href="#">
                    <img class="w-100" src="./img/default-image.jpg" alt="">
                </a>
            </div>
            <div class="col-2 card-livro">
                <a href="#">
                    <img class="w-100" src="./img/default-image.jpg" alt="">
                </a>
            </div>
        </div>

        <div class="row justify-content-evenly mt-5">
            <h3 class="col-12">
                Livros para trocar
            </h3>
            <div class="col-2 card-livro">
                <a href="#">
                    <img class="w-100" src="./img/default-image.jpg" alt="">
                </a>
            </div>
            <div class="col-2 card-livro">
                <a href="#">
                    <img class="w-100" src="./img/default-image.jpg" alt="">
                </a>
            </div>
            <div class="col-2 card-livro">
                <a href="#">
                    <img class="w-100" src="./img/default-image.jpg" alt="">
                </a>
            </div>
            <div class="col-2 card-livro">
                <a href="#">
                    <img class="w-100" src="./img/default-image.jpg" alt="">
                </a>
            </div>
            <div class="col-2 card-livro">
                <a href="#">
                    <img class="w-100" src="./img/default-image.jpg" alt="">
                </a>
            </div>
        </div>
    </section>

    <!--Container Sobre nós-->
    <section class="container-fluid about-us">
        <!--Descrição do projeto-->
        <div class="row justify-content-center">
            <h1 class="text-center col-12">
                Sobre Nós
            </h1>
            <p class="text-justify col-8">
                Descrição do projeto
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos laborum quod amet aperiam velit,
                minus ratione optio sapiente pariatur eveniet doloribus quo ipsa sunt eligendi tempore provident
                voluptates. Repudiandae delectus aut nihil impedit adipisci aperiam! Reiciendis tempore ipsum sequi esse
                quae vel recusandae itaque, quaerat quia. Atque voluptate dicta voluptatem!
            </p>
        </div>
        <!--Cards de integrantes-->
        <div class="row justify-content-evenly">
            <div class="col-2 card-integrante position-relative">
                <div class="foto-integrante position-absolute">
                    <img src="./img/default-image.jpg" alt="">
                </div>
                <div class="infos-integrante">
                    <h3 class="text-center">Nome</h3>
                    <p class="text-center">Descrição</p>
                    <div class="row midias-integrante justify-content-evenly">
                        <a class="col-auto" href="#">
                            <i class="fab fa-instagram fa-2x"></i>
                        </a>
                        <a class="col-auto" href="#">
                            <i class="fab fa-github fa-2x"></i>
                        </a>
                        <a class="col-auto" href="#">
                            <i class="fas fa-at fa-2x"></i>
                        </a>
                        <a class="col-auto" href="#">
                            <i class="fab fa-linkedin fa-2x"></i>
                        </a>
                    </div>
                    <p class="text-center">Função</p>
                </div>
            </div>
            <div class="col-2 card-integrante position-relative">
                <div class="foto-integrante position-absolute">
                    <img src="./img/default-image.jpg" alt="">
                </div>
                <div class="infos-integrante">
                    <h3 class="text-center">Nome</h3>
                    <p class="text-center">Descrição</p>
                    <div class="row midias-integrante justify-content-evenly">
                        <a class="col-auto" href="#">
                            <i class="fab fa-instagram fa-2x"></i>
                        </a>
                        <a class="col-auto" href="#">
                            <i class="fab fa-github fa-2x"></i>
                        </a>
                        <a class="col-auto" href="#">
                            <i class="fas fa-at fa-2x"></i>
                        </a>
                        <a class="col-auto" href="#">
                            <i class="fab fa-linkedin fa-2x"></i>
                        </a>
                    </div>
                    <p class="text-center">Função</p>
                </div>
            </div>
            <div class="col-2 card-integrante position-relative">
                <div class="foto-integrante position-absolute">
                    <img src="./img/default-image.jpg" alt="">
                </div>
                <div class="infos-integrante">
                    <h3 class="text-center">Nome</h3>
                    <p class="text-center">Descrição</p>
                    <div class="row midias-integrante justify-content-evenly">
                        <a class="col-auto" href="#">
                            <i class="fab fa-instagram fa-2x"></i>
                        </a>
                        <a class="col-auto" href="#">
                            <i class="fab fa-github fa-2x"></i>
                        </a>
                        <a class="col-auto" href="#">
                            <i class="fas fa-at fa-2x"></i>
                        </a>
                        <a class="col-auto" href="#">
                            <i class="fab fa-linkedin fa-2x"></i>
                        </a>
                    </div>
                    <p class="text-center">Função</p>
                </div>
            </div>
            <div class="col-2 card-integrante position-relative">
                <div class="foto-integrante position-absolute">
                    <img src="./img/default-image.jpg" alt="">
                </div>
                <div class="infos-integrante">
                    <h3 class="text-center">Nome</h3>
                    <p class="text-center">Descrição</p>
                    <div class="row midias-integrante justify-content-evenly">
                        <a class="col-auto" href="#">
                            <i class="fab fa-instagram fa-2x"></i>
                        </a>
                        <a class="col-auto" href="#">
                            <i class="fab fa-github fa-2x"></i>
                        </a>
                        <a class="col-auto" href="#">
                            <i class="fas fa-at fa-2x"></i>
                        </a>
                        <a class="col-auto" href="#">
                            <i class="fab fa-linkedin fa-2x"></i>
                        </a>
                    </div>
                    <p class="text-center">Função</p>
                </div>
            </div>
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
                <img src="./img/default-image.jpg" alt="logo" class="logo">
            </div>
        </div>
    </footer>

    <!--Script do Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

    <script type="text/javascript" src="./script.js"></script>
</body>

</html>