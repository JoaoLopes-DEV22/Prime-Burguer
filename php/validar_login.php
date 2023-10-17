<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuarioCorreto = "adm";
    $senhaCorreta = 123;

    $usuarioCozinhaCorreto = "coz";
    $senhaCozinhaCorreta = 1234;

    if ($_POST['user'] == $usuarioCorreto && $_POST['password'] == $senhaCorreta) {
        $_SESSION["logado"] = true;
        header("Location:direcionamento.php");
    } 
    else if($_POST['user'] == $usuarioCozinhaCorreto && $_POST['password'] == $senhaCozinhaCorreta){
        $_SESSION["logado"] = true;
        header("Location:tv-cozinha-copia.php");
    }
    else {
        header("Location:../php/index.php");
    }
}
