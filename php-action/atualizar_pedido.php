<?php
include 'conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM pedidos WHERE mesa_pedido = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // Recupere os dados do primeiro pedido (mesa e observação)
        $pedido = $resultado->fetch_assoc();
    } else {
        die("Pedido não encontrado.");
    }
} else {
    die("Mesa do pedido não especificada.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mesa_pedido = $_POST['mesa_pedido'];
    $observacao_pedido = $_POST['observacao_pedido'];

    /* Atualize a mesa e observação para o pedido */
    $sql = "UPDATE pedidos SET mesa_pedido = ?, observacao_pedido = ? WHERE mesa_pedido = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $mesa_pedido, $observacao_pedido, $id);

    if ($stmt->execute()) {
        // Atualização bem-sucedida para mesa e observação

        // Agora, atualize os itens do pedido
        foreach ($_POST['nome_pedido'] as $index => $nome_pedido) {
            $quantidade_pedido = $_POST['quantidade_pedido'][$index];
            $id_pedido = $_POST['id_pedido'][$index];

            $sql = "UPDATE pedidos SET nome_pedido = ?, quantidade_pedido = ? WHERE id_pedido = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sii", $nome_pedido, $quantidade_pedido, $id_pedido);

            if (!$stmt->execute()) {
                echo "Erro ao atualizar nome e quantidade do pedido:" . $conn->error;
            }
        }

        header("Location: ../php/tv-cozinha.php");
    } else {
        echo "Erro ao atualizar mesa e observação do pedido:" . $conn->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pedido</title>
    <link rel="stylesheet" href="../css/atualizar_pedido.css">
</head>

<body>
    <header>
        <img src="../img/logo.png" id="logo" onclick="javascript:location.href='direcionamento.php'">
    </header>
    <form action='' method='post'>
        <h1>Editar Pedido</h1>
        <input type='hidden' name='id' value='<?php echo $id; ?>'>

        <!-- Campo para alterar o número da mesa (exibido apenas uma vez) -->
        <div class="itens-forms">

            <label for='mesa_pedido' class="label-item">Mesa:</label>
            <input type='number' class="input-item" name='mesa_pedido' min='1' value='<?php echo $pedido['mesa_pedido']; ?>'>

            <!-- Campo para alterar a observação (exibido apenas uma vez) -->
            <label for='observacao_pedido' class="label-item">Observação do Pedido:</label>
            <input type='text' class="input-item" name='observacao_pedido' value='<?php echo $pedido['observacao_pedido']; ?>'>

            <!-- Loop para exibir os itens de pedido para edição -->
            <?php
            $sql_itens = "SELECT * FROM pedidos WHERE mesa_pedido = ?";
            $stmt_itens = $conn->prepare($sql_itens);
            $stmt_itens->bind_param("i", $id);
            $stmt_itens->execute();
            $resultado_itens = $stmt_itens->get_result();

            while ($item_pedido = $resultado_itens->fetch_assoc()) {
                echo "<label for='nome_pedido' class='label-item'>Nome do Pedido:</label>";
                echo "<input type='text'class='input-item' name='nome_pedido[]' value='" . $item_pedido['nome_pedido'] . "'>";

                echo "<label for='quantidade_pedido' class='label-item'>Quantidade de " . $item_pedido['nome_pedido'] . ":</label>";
                echo "<input type='number'class='input-item' min='1' name='quantidade_pedido[]' value='" . $item_pedido['quantidade_pedido'] . "'>";

                echo "<input type='hidden'class='input-item' name='id_pedido[]' value='" . $item_pedido['id_pedido'] . "'>";
            }
            ?>
        </div>

        <input type='submit' value='Atualizar' id="btn-atualizar">
    </form>
</body