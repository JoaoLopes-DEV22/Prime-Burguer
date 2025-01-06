<?php
include 'conexao.php'; // Inclui o arquivo de conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] === "POST") { // Verifica se o formulário foi submetido via método POST

    /*-----Coleta de Informações-----*/
    $nome_usuario = $_POST['user']; // Obtém o nome de usuário do formulário
    $senha_usuario = password_hash($_POST['password'], PASSWORD_DEFAULT); // Gera um hash da senha para armazenamento seguro no banco de dados
    $status_usuario = $_POST['status']; // Obtém o status do usuário do formulário

    /*-----Inserir no Banco de Dados-----*/
    $sql_inserir = "INSERT INTO usuarios (nome_usuario , senha_usuario , status_usuario) VALUES (? , ? , ?)"; // Prepara a instrução SQL de inserção
    $stmt = $conn->prepare($sql_inserir); // Prepara a consulta
    $stmt->bind_param("sss", $nome_usuario, $senha_usuario, $status_usuario); // Faz o bind dos parâmetros
    $stmt->execute(); // Executa a consulta para inserir os dados no banco de dados

    /*-----Redirecionar para a página de login após o cadastro-----*/
    header("Location: ../index.php"); // Redireciona de volta para a página de login após o cadastro
}
