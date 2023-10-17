<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mesa = $_POST['mesa_pedido'];

    // Atualize o status do pedido para 'CONCLUÍDO' onde mesa_pedido é igual a $mesa
    $updateQuery = "UPDATE pedidos SET status_pedido = 'CONCLUÍDO' WHERE mesa_pedido = $mesa";
    $conn->query($updateQuery);

    mysqli_close($conn);
}
