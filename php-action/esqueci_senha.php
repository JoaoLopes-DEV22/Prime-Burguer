<?php

include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome_usuario = $_POST['user'];
    $senha_cripto = password_hash($_POST['password'], PASSWORD_BCRYPT);

    /*-----Selecionando os usuários-----*/

    $sql_usuario = "SELECT * FROM usuarios WHERE nome_usuario = ?";
    $stmt = $conn->prepare($sql_usuario);
    $stmt->bind_param("s", $nome_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        $pedido = $resultado->fetch_assoc();
    } else {
        die("Usuário não encontrado");
    }

    /*-----Atualização da Senha do Usuário no Banco de Dados-----*/
    $sql = "UPDATE usuarios SET senha_usuario = ? WHERE nome_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $senha_cripto, $nome_usuario);

    if ($stmt->execute()) {
        header("Location: ../index.php");
    } else {
        echo "Erro ao atualizar senha:" . $conn->error;
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/esqueci_senha.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
    <title>Esqueci Minha Senha</title>
</head>

<body>

    <div class="container">

        <div class="logo-area">
            <img src="../img/logo.png" id="logo" class="img-responsive">
        </div>

        <div class="card-form">

            <div class="title">
                <h1 id="txt-title">Esqueci Minha Senha</h1>
            </div>

            <!--Área dos Inputs-->
            <form action="" method="post">
                <div class="inputs">
                    <div class="user">
                        <img src="../img/user-icon.png" id="icon-perfil">
                        <input type="text" name="user" id="user" class="input-item" placeholder="Usuário">
                    </div>
                    <div class="senha">
                        <img src="../img/pass-icon.png" id="icon-senha">
                        <input type="password" name="password" id="password" class="input-item" placeholder="Nova Senha">
                    </div>
                </div>
                <!--Botão de login-->
                <div class="btn">
                    <input type="submit" value="Salvar" id="btn-login">
                </div>
            </form>
            <div class="faca-conta">
                <span id="nao-tem-conta">Já tem uma conta? <a href="../index.php" id="faca-uma">Faça login!</a></span>
            </div>
        </div>
    </div>
</body>

</html>