<?php
session_start();
if ($_SESSION['logado'] !== true) {
    header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/adicionar-produto.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
    <title>Adicionar Produto</title>
</head>

<body>
    <header>
        <img src="../img/logo.png" id="logo" onclick="javascript:location.href='../php/direcionamento.php'">
    </header>

    <main>
        <h1>ADICIONAR PRODUTO</h1>

        <div class="card-form">
            <form action='inserir_produto.php' method='post' enctype="multipart/form-data">
                <input type='hidden' name='id' value='<?php echo $id; ?>' required>

                <div id="produto">
                    <div class="inf-nome">
                        <label for='nome' class="label-item">Nome do Produto:</label>
                        <input type='text' class="input-item" name='nome' required>
                    </div>
                    <div class="inf-preco">
                        <label for="preco" class="label-item">Preço:</label>
                        <input type="number" class="input-item" name="preco" step="0.010" required>
                    </div>
                </div>

                <div class="itens-forms">

                    <label for='categoria' class="label-item">Categoria:</label>
                    <select name="categoria" id="" class="input-item" required>
                        <option value="Casuais" class="input-item">Casuais</option>
                        <option value="Gourmet" class="input-item">Gourmet</option>
                        <option value="Veganos" class="input-item">Veganos</option>
                        <option value="Da Casa" class="input-item">Da Casa</option>
                        <option value="Fritas" class="input-item">Fritas</option>
                        <option value="Nuggets" class="input-item">Nuggets</option>
                        <option value="Calabresa" class="input-item">Calabresa</option>
                        <option value="Frango" class="input-item">Frango</option>
                        <option value="Refrigerantes" class="input-item">Refrigerantes</option>
                        <option value="Sucos" class="input-item">Sucos</option>
                        <option value="Drinks" class="input-item">Drinks</option>
                    </select>

                    <label for="desc" class="label-item">Descrição do Produto:</label>
                    <textarea name="desc" id="desc" cols="30" rows="10" class="input-item-textarea" required></textarea>

                    <label for="img" class="label-item">Imagem:</label>
                    <input type="file" name="img" class="input-item" required>
                </div>

                <input type='submit' value='Adicionar' id="btn-atualizar">
            </form>

            <button id="btn-voltar" onclick="javascript:location.href='../php/burguer-casual.php'">Voltar</button>

        </div>

    </main>
    <footer>
        <p id="txt-footer">Desenvolvido por DesignFlow &copy;</p>
    </footer>
</body>

</html>