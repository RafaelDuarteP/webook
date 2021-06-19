<?php

require_once 'conexao.php';

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
$id_usuario = $_SESSION['user']['id_usuario'];

$query = "SELECT id_op, tipo, data_op,livro_1 FROM operacao WHERE usuario_1 = $id_usuario OR usuario_2 = $id_usuario AND status_op = 'aberta'; ";
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
                <img class="mx-auto logo" src="./img/WeBookLogo.png" alt="logo">
            </div>
            <!--Menu de botões-->
            <button class="col-auto navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#buttonsMenu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-ellipsis-v"></i>
            </button>
            <div class="col-12 col-md-auto">
                <div class="collapse navbar-collapse  mt-2 mt-lg-0" id="buttonsMenu">
                    <div class="row justify-content-end">
                        <div class="col-12 col-md-auto mt-4">
                            <button onclick="window.history.back()" type="button" class="btn-header">Voltar</button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>


    </header>

    <section class="container-lg mt-5">
        <div class="row">
            <h1 class="col-auto"> Notificações</h1>
        </div>
        <?php
        if (mysqli_num_rows($request) == 0) :
        ?>
            <ul class="row justify-content-end">
                <li class="col-10" style="list-style-type:square  ;font-size:x-large; text-indent: 20px;">
                    Sem novas notificações
                </li>
            </ul>
        <?php
        else :
        ?>

            <ul class="row notifications justify-content-end">
                <?php
                for ($i = 0; $i < mysqli_num_rows($request); $i++) :
                    $item = $result[$i];

                ?>
                    <li onclick="window.location.href = '<?php echo 'ntf.php?id='.$item[0] ?>'" class="col-10">
                        <h2><?php
                                $tempQuery = "select titulo from livro where id_livro = $item[3]";
                                $tempRequest = mysqli_query($conexao,$tempQuery);
                                $tempResult = mysqli_fetch_assoc($tempRequest);

                                echo $tempResult['titulo'];
                        ?></h2>
                        <p class="d-inline"><?php echo $item[1] ?> ||</p>
                        <p class="d-inline"><?php echo $item[2] ?></p>
                    </li>
                <?php
                endfor;
                ?>
            </ul>

        <?php
        endif;
        ?>



    </section>

    <!--Script do Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

    <script type="text/javascript" src="./script.js"></script>
</body>

</html>