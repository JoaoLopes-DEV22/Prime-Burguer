<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome_produto = $_POST['nome'];
    $descricao = $_POST['desc'];
    $categoria = $_POST['categoria'];
    $preco = $_POST['preco'];

    $imagem = $_FILES['img']['name'];
    $temp_name = $_FILES['img']['tmp_name'];

    // Determina o diretório de destino baseado na categoria selecionada
    $target_dir = "../img/$categoria/";

    // Verifica se o diretório existe, e se não, cria-o
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($imagem);

    move_uploaded_file($temp_name, $target_file);

    // Insira o caminho do arquivo no banco de dados
    $sql_inserir = "INSERT INTO produtos_cadastrados (nome_produto, descricao_produto, img_produto, categoria_produto, valor_produto) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_inserir);
    $stmt->bind_param("ssssd", $nome_produto, $descricao, $target_file, $categoria, $preco);
    $stmt->execute();

    header("Location:../php/burguer-casual.php");
}
