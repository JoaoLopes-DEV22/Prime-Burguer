<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conexao.php';

    $usuarioDigitado = $_POST['user'];
    $senhaDigitado = $_POST['password'];

    $consulta = "SELECT * FROM usuarios WHERE nome_usuario = '$usuarioDigitado'";
    $resultado = $conn->query($consulta);

    if ($resultado) {
        $row = $resultado->fetch_assoc();

        if (password_verify($senhaDigitado, $row['senha_usuario'])) {
            $_SESSION["logado"] = true;
            $_SESSION["nome_usuario"] = $row['nome_usuario'];
            if ($row['status_usuario'] == "Administrador") {
                header("Location: ../php/direcionamento.php");
                exit();
            } else if ($row['status_usuario'] == "Cozinheiro") {
                header("Location: ../php/tv-cozinha-copia.php");
                exit();
            }
        } else {
            header("Location: ../index.php?error=senha_incorreta");
            exit();
        }
    } else {
        header("Location: ../index.php?error=usuario_nao_encontrado");
        exit();
    }
}
