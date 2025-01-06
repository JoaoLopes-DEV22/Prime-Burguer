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
    <link rel="stylesheet" href="../css/tv-clientes.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
    <title>Tv-Clientes</title>
</head>

<body>

    <header>

        <img src="../img/logo.png" id="logo" onclick="javascript:location.href='direcionamento.php'">

    </header>

    <main>

        <section class="column">

            <div id="card-andamento">
                <h1 class="status-pd">EM ANDAMENTO</h1>
            </div>

            <?php
            include '../php-action/conexao.php';

            // Verifique a conexão
            if (mysqli_connect_errno()) {
                echo "Falha na conexão com o banco de dados: " . mysqli_connect_error();
            }

            // Consulta para obter os pedidos
            $consulta = "SELECT * FROM pedidos WHERE status_pedido = 'EM ANDAMENTO' ORDER BY id_pedido ASC";
            $resultado = $conn->query($consulta);

            // Variável para controlar a coluna atual
            $coluna_atual = "left";
            $pedido_anterior = null; // Variável para controlar o pedido anterior

            // Exibir os pedidos
            while ($linha = mysqli_fetch_assoc($resultado)) {
                // Verifique se o pedido atual é diferente do pedido anterior
                if ($pedido_anterior !== $linha['mesa_pedido']) {
                    // Se for um novo pedido, exiba um novo cartão
                    if ($pedido_anterior !== null) {
                        echo "</ul>";
                        echo "</div>";
                    }

                    echo "<div class='card'>";
                    echo "<h2 class='nmr-pedido'>" . $linha['mesa_pedido'] . "</h1>"; // Exibe o número da mesa
                    echo "<ul>";

                    // Reinicialize as observações do pedido
                    $observacao_pedido = "";

                    // Mantenha o pedido anterior atualizado
                    $pedido_anterior = $linha['mesa_pedido'];
                }

                echo "<li>" . $linha['quantidade_pedido'] . "x " . $linha['nome_pedido'] . "</li>"; // Exiba os itens do pedido em forma de lista

                // Mantenha as observações do pedido
                $observacao_pedido = $linha['observacao_pedido'];
            }

            // Certifique-se de exibir o último pedido
            if ($pedido_anterior !== null) {
                echo "</ul>";
                echo "</div>";
            }

            // Fechar a conexão com o banco de dados
            mysqli_close($conn);

            ?>

        </section>



        <section class="column">

            <div id="card-concluido">
                <h1 class="status-pd">CONCLUÍDO</h1>
            </div>

            <?php
            include '../php-action/conexao.php';

            // Verifique a conexão
            if (mysqli_connect_errno()) {
                echo "Falha na conexão com o banco de dados: " . mysqli_connect_error();
            }

            // Consulta para obter os pedidos
            $consulta = "SELECT * FROM pedidos WHERE status_pedido = 'CONCLUÍDO' ORDER BY id_pedido ASC";
            $resultado = $conn->query($consulta);

            // Variável para controlar a coluna atual
            $coluna_atual = "left";
            $pedido_anterior = null; // Variável para controlar o pedido anterior

            // Exibir os pedidos
            while ($linha = mysqli_fetch_assoc($resultado)) {
                // Verifique se o pedido atual é diferente do pedido anterior
                if ($pedido_anterior !== $linha['mesa_pedido']) {
                    // Se for um novo pedido, exiba um novo cartão
                    if ($pedido_anterior !== null) {
                        echo "</ul>";
                        echo "</div>";
                    }

                    echo "<div class='card'>";
                    echo "<h2 class='nmr-pedido'>" . $linha['mesa_pedido'] . "</h1>"; // Exibe o número da mesa
                    echo "<ul>";

                    // Reinicialize as observações do pedido
                    $observacao_pedido = "";

                    // Mantenha o pedido anterior atualizado
                    $pedido_anterior = $linha['mesa_pedido'];
                }

                echo "<li>" . $linha['quantidade_pedido'] . "x " . $linha['nome_pedido'] . "</li>"; // Exiba os itens do pedido em forma de lista

                // Mantenha as observações do pedido
                $observacao_pedido = $linha['observacao_pedido'];
            }

            // Certifique-se de exibir o último pedido
            if ($pedido_anterior !== null) {
                echo "</ul>";
                echo "</div>";
            }

            // Fechar a conexão com o banco de dados
            mysqli_close($conn);

            ?>


        </section>

    </main>

</body>

</html>