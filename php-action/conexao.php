<?php
// Conexão com o banco de dados
$servername = "localhost"; // Nome do servidor do banco de dados
$username = "root"; // Nome de usuário do banco de dados
$password = ""; // Senha do banco de dados
$dbname = "hamburgueria_db"; // Nome do banco de dados

// Crie uma conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

mysqli_set_charset($conn, "utf8");

// Verifique a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}
