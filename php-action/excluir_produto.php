<?php

include 'conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM produtos_cadastrados WHERE id_produto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../php/gerenciamento-produto.php");
    } else {
        echo "Erro ao excluir produto:" . $conn->error;
    }

    $stmt->close();
}
