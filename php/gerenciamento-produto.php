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
    <link rel="stylesheet" href="../css/gerenciamento-produto.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">

    <title>Gerenciamento de Produtos</title>
</head>

<body>
    <header>
        <img src="../img/logo.png" id="logo" onclick="javascript:location.href='direcionamento.php'">
    </header>

    <main>
        <h1>Lista de Produtos</h1>
        <table border='2'>
            <tr>
                <th>Produto</th>
                <!-- <th>Descrição</th> -->
                <th>Categoria</th>
                <th>Valor</th>
                <th>Ações</th>
                <!-- <th>Excluir</th> -->
            </tr>
            <?php
            include '../php-action/conexao.php';

            $sql_tipo = "SELECT * FROM produtos_cadastrados";
            $resulta = $conn->query($sql_tipo);

            if ($resulta->num_rows > 0) {

                while ($row = $resulta->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['nome_produto'] . '</td>';
                    echo '<td>' . $row['categoria_produto'] . '</td>';
                    echo '<td>' . $row['valor_produto'] . '</td>';
                    echo '<td> 
                    <div class="acoes">
                    <a class="btn-editar" href= "../php-action/editar_produto.php?id=' . $row['id_produto'] . '"><img src="../img/lapis.png" id="btn_editar"></a> ';
                    echo '<a class="btn-excluir" href= "../php-action/excluir_produto.php?id=' . $row['id_produto'] . '"><img src="../img/lata-lixo-vermelho.png" id="btn-excluir"></a> </td>';
                    echo '</div>';
                    echo '</tr>';
                }
            }
            ?>
        </table>

    </main>
    <footer>
        <p id="txt-footer">Desenvolvido por DesignFlow &copy;</p>
    </footer>
</body>

</html>