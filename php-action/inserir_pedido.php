<?php
// Conexão com o banco de dados
include 'conexao.php';

// Recupere os dados do pedido do JavaScript
$data = json_decode(file_get_contents('php://input'));

$mesaPedido = $data->mesa_pedido;
$nomePedido = $data->nome_pedido;
$valorPedido = $data->valor_pedido;
$quantidadePedido = $data->quantidade_pedido;
$observacaoPedido = $data->observacao_pedido;
$totalPedido = ($data->total_pedido != null) ? $data->total_pedido : 0; // Defina um valor padrão (0, por exemplo)

if ($mesaPedido < 0) {
    echo "É necessário colocar o número da mesa";
} else {
    // Instrução preparada para evitar SQL injection
    $sql = "INSERT INTO pedidos (mesa_pedido, nome_pedido, valor_pedido, quantidade_pedido, observacao_pedido, total) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Vincular parâmetros
    $stmt->bind_param("isdssd", $mesaPedido, $nomePedido, $valorPedido, $quantidadePedido, $observacaoPedido, $totalPedido);

    // Executar a instrução preparada
    if ($stmt->execute()) {
        echo "Pedido inserido com sucesso!";
    } else {
        echo "Erro ao inserir pedido: " . $stmt->error;
    }

    // Fechar a instrução preparada e a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}
