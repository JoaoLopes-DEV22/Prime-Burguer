<?php
include 'conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM produtos_cadastrados WHERE id_produto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
    } else {
        die("Produto não encontrado.");
    }
} else {
    die("Não foi possível especificar o produto.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $descricao = $_POST['desc'];
    $categoria = $_POST['cat'];
    $preco = $_POST['preco'];

    /* Atualize a mesa e observação para o pedido */
    $sql = "UPDATE produtos_cadastrados SET nome_produto = ?, descricao_produto = ?, categoria_produto = ?, valor_produto = ? WHERE id_produto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdi", $nome, $descricao, $categoria, $preco, $id);

    if ($stmt->execute()) {
        header("Location: ../php/gerenciamento-produto.php");
    } else {
        echo "Erro ao atualizar produto:" . $conn->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="../css/atualizar_pedido.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
</head>

<body>
    <header>
        <img src="../img/logo.png" id="logo">
    </header>

    <form action='' method='post'>
        <h1>Editar Produto</h1>
        <input type='hidden' name='id' value='<?php echo $id; ?>'>

        <div class="itens-forms">

            <label for='nome' class="label-item">Nome do produto:</label>
            <input type='text' class="input-item" name='nome' value='<?php echo $row['nome_produto']; ?>'>

            <label for="desc" class="label-item">Descrição do Produto:</label>
            <textarea name="desc" id="" cols="10" rows="" class='input-item'><?php echo $row["descricao_produto"] ?></textarea>

            <label for='cat' class="label-item">Categoria:</label>
            <select name="cat" id="" class="input-item">
                <option value="Casuais" class="input-item" <?php if ($row['categoria_produto'] === 'Casuais') echo 'selected'; ?>>Casuais</option>
                <option value="Gourmet" class="input-item" <?php if ($row['categoria_produto'] === 'Gourmet') echo 'selected'; ?>>Gourmet</option>
                <option value="Veganos" class="input-item" <?php if ($row['categoria_produto'] === 'Veganos') echo 'selected'; ?>>Veganos</option>
                <option value="Da Casa" class="input-item" <?php if ($row['categoria_produto'] === 'Da Casa') echo 'selected'; ?>>Da Casa</option>
                <option value="Fritas" class="input-item" <?php if ($row['categoria_produto'] === 'Fritas') echo 'selected'; ?>>Fritas</option>
                <option value="Nuggets" class="input-item" <?php if ($row['categoria_produto'] === 'Nuggets') echo 'selected'; ?>>Nuggets</option>
                <option value="Calabresa" class="input-item" <?php if ($row['categoria_produto'] === 'Calabresa') echo 'selected'; ?>>Calabresa</option>
                <option value="Frango" class="input-item" <?php if ($row['categoria_produto'] === 'Frango') echo 'selected'; ?>>Frango</option>
                <option value="Refrigerantes" class="input-item" <?php if ($row['categoria_produto'] === 'Refrigerantes') echo 'selected'; ?>>Refrigerantes</option>
                <option value="Sucos" class="input-item" <?php if ($row['categoria_produto'] === 'Sucos') echo 'selected'; ?>>Sucos</option>
                <option value="Drinks" class="input-item" <?php if ($row['categoria_produto'] === 'Drinks') echo 'selected'; ?>>Drinks</option>
            </select>

            <label for="preco" class="label-item">Valor do Produto:</label>
            <input type="number" name="preco" class="input-item" id="" step="0.010" value='<?php echo $row['valor_produto']; ?>'>

        </div>

        <input type='submit' value='Atualizar' id="btn-atualizar">
        <button id="btn-voltar" onclick="javascript:location.href='../php/gerenciamento-produto.php'">Voltar</button>
    </form>
</body>

</html>