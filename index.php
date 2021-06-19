<?php

require_once 'conexao.php';

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
                <img class="mx-auto logo" src="./img/WeBookLogo.png" alt="logo">
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
            Livros Recentes
        </h1>

        <div class="row justify-content-evenly mt-5">
            <h3 class="col-12">
                Livros para empréstimo
            </h3>
            <?php
            $query = "select titulo, editora, autor, edicao, id_livro from livro where tipo = 'emprestimo' and status_livro = 'disponivel'";
            $request = mysqli_query($conexao, $query);
            $result = mysqli_fetch_all($request);

            for ($i = 0; $i < mysqli_num_rows($request) && $i < 10; $i++) {
                $livro = $result[$i];
                $id_livro = $livro[4];
                $titulo = $livro[0];
                $editora = $livro[1];
                $edicao = $livro[3];
                $autor = $livro[2];

                echo "
                    <div class='col-10 col-md-4 col-lg-2 my-2 mx-2 card-livro'>
                <a href='livro.php?id=$id_livro'>
                    <div>
                    <h1>$titulo</h1>
                    <p>$editora</p>
                    <p>$autor</p>
                    <p>$edicao ª edição</p>
                    </div>
                </a>
            </div>
                    ";
            }
            ?>
        </div>

        <div class="row justify-content-evenly mt-5">
            <h3 class="col-12">
                Livros para doação
            </h3>
            <?php
            $query = "select titulo, editora, autor, edicao, id_livro from livro where tipo = 'doacao' and status_livro = 'disponivel'";
            $request = mysqli_query($conexao, $query);
            $result = mysqli_fetch_all($request);

            for ($i = 0; $i < mysqli_num_rows($request) && $i < 10; $i++) {
                $livro = $result[$i];
                $id_livro = $livro[4];
                $titulo = $livro[0];
                $editora = $livro[1];
                $edicao = $livro[3];
                $autor = $livro[2];

                echo "
                    <div class='col-10 col-md-4 col-lg-2 my-2 mx-2 card-livro'>
                <a href='livro.php?id=$id_livro'>
                    <div>
                    <h1>$titulo</h1>
                    <p>$editora</p>
                    <p>$autor</p>
                    <p>$edicao ª edição</p>
                    </div>
                </a>
            </div>
                    ";
            }
            ?>
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

                Somos um grupo de estudantes de Engenharia de Software pela PUC - Minas e esse site trata-se de um projeto da disciplina TRABALHO INTERDISCIPLINAR: APLICAÇÕES PARA PROCESSOS DE NEGÓCIOS.
            </p>
        </div>
        <!--Cards de integrantes-->
        <div class="row justify-content-evenly">
            <div class="col-10 col-md-5 col-lg-3 mt-3 card-integrante position-relative">
                <div class="foto-integrante position-absolute">
                    <img src="./img/Rafael.jpg" alt="">
                </div>
                <div class="infos-integrante">
                    <h3 class="text-center">Rafael Duarte Pereira</h3>
                    <p class="text-center">Estudante de Engenharia de Software pela PUC - Minas</p>
                    <div class="row midias-integrante justify-content-evenly">
                        <a class="col-auto" href="https://www.instagram.com/fael.desenhos/" target="_blank">
                            <i class="fab fa-instagram fa-2x"></i>
                        </a>
                        <a class="col-auto" href="https://github.com/RafaelDuarteP" target="_blank">
                            <i class="fab fa-github fa-2x"></i>
                        </a>
                        <a class="col-auto" href="mailto:rafaelduarte1234.2015@gmail.com" target="_blank">
                            <i class="fas fa-at fa-2x"></i>
                        </a>
                        <a class="col-auto" href="https://www.linkedin.com/in/rafael-duarte-9087a11bb/" target="_blank">
                            <i class="fab fa-linkedin fa-2x"></i>
                        </a>
                    </div>
                    <p class="text-center">Desenvolvedor</p>
                </div>
            </div>
            <div class="col-10 col-md-5 col-lg-3 mt-3 card-integrante position-relative">
                <div class="foto-integrante position-absolute">
                    <img src="./img/default-image.jpg" alt="">
                </div>
                <div class="infos-integrante">
                    <h3 class="text-center">Rodolfo Rocha Rodrigues</h3>
                    <p class="text-center">Estudante de Engenharia de Software pela PUC - Minas</p>
                    <div class="row midias-integrante justify-content-evenly">
                        <a class="col-auto" href="https://www.instagram.com/rodolforocha22/">
                            <i class="fab fa-instagram fa-2x"></i>
                        </a>
                        <a class="col-auto" href="https://github.com/rodolfo12381">
                            <i class="fab fa-github fa-2x"></i>
                        </a>
                        <a class="col-auto" href="mailto:rodolforrodrigues14@gmail.com">
                            <i class="fas fa-at fa-2x"></i>
                        </a>
                        <a class="col-auto" href="https://www.linkedin.com/in/rodolfo-rocha-rodrigues-a834b1205/">
                            <i class="fab fa-linkedin fa-2x"></i>
                        </a>
                    </div>
                    <p class="text-center">Desenvolvedor</p>
                </div>
            </div>
            <div class="col-10 col-md-5 col-lg-3 mt-3 card-integrante position-relative">
                <div class="foto-integrante position-absolute">
                    <img src="./img/default-image.jpg" alt="">
                </div>
                <div class="infos-integrante">
                    <h3 class="text-center">Vinicius George dos Santos</h3>
                    <p class="text-center">Estudante de Engenharia de Software pela PUC - Minas</p>
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
                    <p class="text-center">Desenvolvedor</p>
                </div>
            </div>
            <div class="col-10 col-md-5 col-lg-3 mt-3 card-integrante position-relative">
                <div class="foto-integrante position-absolute">
                    <img src="./img/default-image.jpg" alt="">
                </div>
                <div class="infos-integrante">
                    <h3 class="text-center">Mateus Valadares Zambrano Jacques</h3>
                    <p class="text-center">Estudante de Engenharia de Software pela PUC - Minas</p>
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
                    <p class="text-center">Desenvolvedor</p>
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
                <img src="./img/WeBookLogo.png" alt="logo" class="logo">
            </div>
        </div>
    </footer>

    <!--Script do Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

    <script type="text/javascript" src="./script.js"></script>
</body>

</html>