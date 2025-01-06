<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se o parâmetro "mesa_pedido" foi enviado
    if (isset($_POST['mesa_pedido'])) {
        $mesaPedido = $_POST['mesa_pedido'];

        // Execute uma consulta para excluir todos os pedidos com o mesmo número de mesa
        $excluirConsulta = "DELETE FROM pedidos WHERE mesa_pedido = $mesaPedido";
        if ($conn->query($excluirConsulta) === TRUE) {
            // Exclusão bem-sucedida
            echo "Pedido apagado com sucesso!";
        } else {
            // Erro ao excluir
            echo "Erro ao apagar pedido: " . $conn->error;
        }
    }
}

// Feche a conexão com o banco de dados
mysqli_close($conn);
