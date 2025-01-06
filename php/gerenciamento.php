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
    <link rel="stylesheet" href="../css/gerenciamento.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
    <title>Gerenciamento de Usuários</title>
</head>

<body>
    <header>
        <img src="../img/logo.png" id="logo" onclick="javascript:location.href='direcionamento.php'">
    </header>

    <main>
        <h1>Lista de Usuários</h1>
        <table border='2'>
            <tr>
                <th>Nome</th>
                <th>Função</th>
                <th>Ações</th>
            </tr>
            <?php
            include '../php-action/conexao.php';

            $sql_tipo = "SELECT * FROM usuarios";
            $resulta = $conn->query($sql_tipo);

            if ($resulta->num_rows > 0) {

                while ($row = $resulta->fetch_assoc()) {

                    echo '<tr>';
                    echo '<td>' . $row['nome_usuario'] . '</td>';
                    echo '<td>' . $row['status_usuario'] . '</td>';
                    // echo '';
                    echo '<td> 
                    <div class = "acoes">
                    <a class="btn-editar" href= "../php-action/editar_usuario.php?id=' . $row['id_usuario'] . '"><img src="../img/lapis.png" id="btn_editar">
                    </a>';
                    echo '<a class="btn-excluir" href= "../php-action/excluir_usuario.php?id=' . $row['id_usuario'] . '"><img src="../img/lata-lixo-vermelho.png" id="btn-excluir"></a></td>';
                    echo '</tr>';
                    echo '</div>';
                }
            }
            ?>
        </table>

    </main>

    <footer>
        <p id="txt-footer">Desenvolvido por DesignFlow &copy;</p>
    </footer>

    <script>
        // Função para verificar a posição da tabela
        function verificarPosicaoTabela() {
            var tabela = document.querySelector("table");
            var linhasTabela = tabela.getElementsByTagName("tr");
            var oitavaLinha = linhasTabela[7]; // A 8ª linha (índice 7)

            if (oitavaLinha) {
                // Quando a 8ª linha estiver presente, definir o footer como position: relative
                var footer = document.querySelector("footer");
                footer.style.position = "relative";
            }
        }

        // Chame a função após o carregamento da página
        window.addEventListener("load", verificarPosicaoTabela);
    </script>
</body>

</html>