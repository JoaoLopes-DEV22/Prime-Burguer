<?php
// Conexão com o banco de dados
include 'conexao.php';

// Recupere os dados do pedido do JavaScript
$data = json_decode(file_get_contents('php://input'));

$mesaPedido = $data->mesa_pedido;
$nomePedido = $data->nome_pedido;
$quantidadePedido = $data->quantidade_pedido;
$observacaoPedido = $data->observacao_pedido;

if ($mesaPedido < 0) {
    echo "É necessário colocar o número da mesa";
} else {
    // Insira os dados do pedido na tabela 'pedidos'
    $sql = "INSERT INTO pedidos (mesa_pedido, nome_pedido, quantidade_pedido, observacao_pedido) VALUES ('$mesaPedido', '$nomePedido', '$quantidadePedido', '$observacaoPedido')";

    if ($conn->query($sql) === TRUE) {
        echo "Pedido inserido com sucesso!";
    } else {
        echo "Erro ao inserir pedido: " . $conn->error;
    }

    // Feche a conexão com o banco de dados
    $conn->close();
}
