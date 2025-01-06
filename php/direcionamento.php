<?php

include '../php-action/conexao.php';

session_start();
if ($_SESSION["logado"] !== true) {
    header("Location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Direcionamento</title>
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/direcionamento.css">
</head>

<body>
    <div class="logo">
        <img src="../img/logo.png">
    </div>

    <div class="card-choice">
        <div class="item-choice" onclick="javascript:location.href='tv-clientes.php'">
            <img src="../img/garcom.png" class="img-choice">
            <h1>Cliente</h1>
        </div>
        <div class="item-choice" onclick="javascript:location.href='burguer-casual.php'">
            <img src="../img/cardapio.png" class="img-choice">
            <h1>Cardápio</h1>
        </div>
        <div class="item-choice" onclick="javascript:location.href='tv-cozinha.php'">
            <img src="../img/chefe-de-cozinha.png" class="img-choice">
            <h1>Cozinha</h1>
        </div>
    </div>
</body>

</html>