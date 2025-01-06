<?php

include 'conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../php/gerenciamento.php");
    } else {
        echo "Erro ao excluir usuário:" . $conn->error;
    }

    $stmt->close();
}
