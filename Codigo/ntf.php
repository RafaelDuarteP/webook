<?php

require_once 'conexao.php';

session_start();

if (!isset($_SESSION['user']) || $_GET['id'] == null) {
    header("Location: index.php");
    exit();
}
$id_usuario = $_SESSION['user']['id_usuario'];
$id_op = $_GET['id'];

$query1 = "SELECT USUARIO_1 as 'user1', USUARIO_2 as 'user2', LIVRO_1 as 'livro' FROM operacao WHERE id_op = $id_op;";
$request1 = mysqli_query($conexao, $query1);
$result1 = mysqli_fetch_assoc($request1);

$livro = $result1['livro'];
$query2 = "SELECT titulo FROM livro WHERE id_livro = '$livro'";
$request2 = mysqli_query($conexao, $query2);
$resultLivro = mysqli_fetch_assoc($request2);
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
            <h1 class="col-auto"> Detalhes da notificação</h1>
        </div>

        <?php
        if ($id_usuario == $result1['user1']) :
            $user = $result1['user2'];
            $query3 = "SELECT nome, rua,numero_casa AS 'numero', bairro, cidade, estado, cep, telefone FROM usuario WHERE id_usuario = $user;";
            $request3 = mysqli_query($conexao, $query3);
            $resultUser = mysqli_fetch_assoc($request3);
        ?>

            <div class="row notify">
                <div>
                    <h1 class="col-12">
                        <?php echo $resultLivro['titulo']; ?>
                    </h1>
                    <h3 class="col-12">enviar para:</h3>
                    <p><?php echo $resultUser['nome']; ?></p>
                    <p><?php echo $resultUser['telefone']; ?></p>
                    <p><?php echo $resultUser['rua']; ?></p>
                    <p><?php echo $resultUser['numero']; ?></p>
                    <p><?php echo $resultUser['bairro']; ?></p>
                    <p><?php echo $resultUser['cidade']; ?></p>
                    <p><?php echo $resultUser['estado']; ?></p>
                    <p><?php echo $resultUser['cep']; ?></p>
                </div>
            </div>

        <?php
        elseif ($id_usuario == $result1['user2']):
            $user = $result1['user1'];
            $query3 = "SELECT nome, telefone FROM usuario WHERE id_usuario = $user;";
            $request3 = mysqli_query($conexao, $query3);
            $resultUser = mysqli_fetch_assoc($request3);
        ?>

            <div class="row notify">
                <div>
                    <h1 class="col-12 text-center"><?php echo $resultLivro['titulo']; ?></h1>
                    <p class="col-12 text-center">Aguardando recebimento de <?php echo $resultUser['nome']; ?> </p>
                    <p class="col-12 text-center">Contato: <?php echo $resultUser['telefone']; ?> </p>
                    <form action="chegou.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $id_op; ?>">
                        <button type="submit" class="btn-envio">Confirmar Recebimento</button>
                    </form>
                    <form action="cancela.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $id_op; ?>">
                        <button type="submit" class="btn-envio">Cancelar Recebimento</button>
                    </form>
                </div>
            </div>

        <?php
        endif;
        ?>



    </section>

    <!--Script do Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

    <script type="text/javascript" src="./script.js"></script>
</body>

</html>