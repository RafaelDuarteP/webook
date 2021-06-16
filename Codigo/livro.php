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
        <div class="row align-items-center justify-content-between">
            <div class="col-3">
                <a href="./"><img class="logo" src="./img/WeBookLogo.png" alt="logo"></a>
            </div>
            <div class="col-auto">
                <div class="row">
                    <?php
                    if ($_SESSION['user'] != null) :
                    ?>
                        <div class="col-auto">
                            <a class="link-header" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo $nomeUsuario; ?>
                            </a>
                            <ul class="dropdown-menu sair" aria-labelledby="dropdownMenuLink">
                                <li><a href="./logoff.php">Sair</a></li>
                            </ul>
                        </div>

                    <?php
                    else :
                    ?>

                        <div class="col-auto">
                            <a class="link-header" href="./Login.html">Login</a>
                        </div>

                    <?php
                    endif;
                    ?>
                    <div class="col-auto">
                        <button onclick="window.location.href ='./cadatroLivro.html' " type="button" class="btn-header">Cadastrar livro</button>
                    </div>
                    <div class="col-auto">
                        <button onclick="window.location.href ='./cadastroUsuario.html' " type="<?php if ($_SESSION['user'] != null) echo 'disbled';
                                                                                                else echo 'button'; ?>" class="btn-header">Cadastre-se</button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php
    if (!empty($_GET['id'])) {
        $id_livro = $_GET['id'];
        $query = "select isbn,titulo, genero, edicao, editora, autor, tipo, id_usuario
        from livro
        where id_livro= '$id_livro' and STATUS_LIVRO = 'disponivel';";
        $request = mysqli_query($conexao, $query);
        $result = mysqli_num_rows($request);

        if ($result == 0) {
            alerta("Livro indisponivel");
            echo "<script language='javascript'>window.location='index.php';</script>";
        }
        $result = mysqli_fetch_assoc($request);
    } else {
        header("Location: index.php");
        exit();
    }


    ?>

    <section class="container-xl">

        <div class="row info-livro">
            <div class="col-4">
                <img class="w-100" src="./img/default-image.jpg" alt="">
            </div>
            <div class="col-8">
                <h1><?php echo $result['titulo'] ?></h1>
                <p><?php echo $result['autor'] ?></p>
                <p><?php echo $result['genero'] ?></p>
                <p><?php echo $result['editora'] . ',' . $result['edicao'] ?>ª edição</p>
            </div>
        </div>

        <div class="row align-items-center empr-livro">
            <div class="col-8">
                <h1><?php echo $result['titulo'] ?></h1>
                <p><?php
                $id_usuario_1 = $result['id_usuario'];
                $nomeUsuarioCad = mysqli_fetch_assoc(mysqli_query($conexao,"select nome from usuario where id_usuario = '$id_usuario_1';"));
                echo $nomeUsuarioCad['nome'];
                ?></p>
                <p><?php echo $result['tipo'] ?></p>
            </div>
            <form class="col-4" action="confirma.php" method="post">
                <input type="hidden" name="livro" value="<?php
                                                            echo $id_livro; ?>">
                <input type="hidden" name="tipo" value="<?php
                                                        echo $result['tipo']; ?>">
                <input type="hidden" name="user_1" value="<?php
                                                            echo $result['id_usuario']; ?>">
                <input type="hidden" name="user_2" value="<?php
                                                            echo $id_usuario; ?>">
                <button type="submit" class="btn-envio">Eu quero este livro!</button>
            </form>
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

<?php
function alerta($text)
{
    echo "<script language='javascript'>alert('$text');</script>";
}
