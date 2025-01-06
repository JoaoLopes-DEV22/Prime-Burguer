<?php
include 'conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
    } else {
        die("Usuário não encontrado.");
    }
} else {
    die("Não foi possível especificar o usuário.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $funcao = $_POST['funcao'];

    /* Atualize a mesa e observação para o pedido */
    $sql = "UPDATE usuarios SET nome_usuario = ?, status_usuario = ? WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nome, $funcao, $id);

    if ($stmt->execute()) {
        header("Location: ../php/gerenciamento.php");
    } else {
        echo "Erro ao atualizar usuário:" . $conn->error;
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
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
</head>

<body>
    <header>
        <img src="../img/logo.png" id="logo">
    </header>

    <form action='' method='post'>
        <h1>Editar Pedido</h1>
        <input type='hidden' name='id' value='<?php echo $id; ?>'>

        <div class="itens-forms">

            <label for='nome' class="label-item">Nome do usuário:</label>
            <input type='text' class="input-item" name='nome' value='<?php echo $row['nome_usuario']; ?>'>

            <label for='funcao' class="label-item">Função:</label>
            <select name="funcao" id="" class="input-item">
                <option value="Administrador" class="input-item">Administrador</option>
                <option value="Cozinheiro" class="input-item">Cozinheiro</option>
            </select>

        </div>

        <input type='submit' value='Atualizar' id="btn-atualizar">
        <button id="btn-voltar" onclick="javascript:location.href='../php/gerenciamento.php'">Voltar</button>
    </form>
</body