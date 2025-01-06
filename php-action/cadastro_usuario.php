<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/cadastro_usuario.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
    <title>Faça seu Cadastro</title>
</head>

<body>

    <div class="container">

        <div class="logo-area">
            <img src="../img/logo.png" id="logo" class="img-responsive">
        </div>

        <div class="card-form">

            <div class="title">
                <h1 id="txt-title">CADASTRO</h1>
            </div>

            <!--Área dos Inputs-->
            <form action="inserir_usuario.php" method="post">
                <div class="inputs">
                    <div class="user">
                        <img src="../img/user-icon.png" id="icon-perfil">
                        <input type="text" name="user" id="user" class="input-item" placeholder="Usuário">
                    </div>
                    <div class="senha">
                        <img src="../img/pass-icon.png" id="icon-senha">
                        <input type="password" name="password" id="password" class="input-item" placeholder="Senha">
                    </div>

                    <div class="status_user">
                        <input type="radio" name="status" id="adm" value="Administrador"><span id="nome-status">Administrador</span>
                        <input type="radio" name="status" id="coz" value="Cozinheiro"><span id="coz-status">Cozinheiro</span>
                    </div>
                </div>
                
                <!--Botão de login-->
                <div class="btn">
                    <input type="submit" value="Cadastre-se" id="btn-login">
                </div>
            </form>

            <!--Área de perguntar para o usuário se tem uma conta-->
            <div class="faca-conta">
                <span id="nao-tem-conta">Já tem uma conta? <a href="../index.php" id="faca-uma">Faça login!</a></span>
            </div>
        </div>

    </div>

</body>

</html>