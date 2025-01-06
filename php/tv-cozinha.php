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
    <link rel="stylesheet" href="../css/tv-cozinha.css">
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
    <title>Tv-Cozinha</title>
</head>

<body>
    <header>
        <img src="../img/logo.png" id="logo" onclick="javascript:location.href='direcionamento.php'">
    </header>
    <main>
        <section class="column" id="left-column">
            <!-- PHP para exibir os pedidos recuperados do banco de dados -->
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
                        echo "<div class='area-extra'>";
                        echo "<h2 class='obs'>OBSERVAÇÕES:</h2>";
                        echo "<p>" . $observacao_pedido . "</p>";
                        echo "<div class='icons'>";
                        echo "<a href='../php-action/atualizar_pedido.php?id=" . $pedido_anterior . "'><img src='../img/lapis.png' class='icon'></a>";
                        echo "<img src='../img/lata-de-lixo.png' class='icon' id='lixo-icon' onclick='apagarPedido(" . $pedido_anterior . ")'>";
                        echo "<input type='submit' value='Enviar' class='btn-enviar' onclick='concluirPedidos(" . $pedido_anterior . ")'>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }

                    echo "<div class='card'>";
                    echo "<div class='area-pedido'>";
                    echo "<h1 class='nmr-pedido'>" . $linha['mesa_pedido'] . "</h1>"; // Exibe o número da mesa
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
                echo "<div class='area-extra'>";
                echo "<h2 class='obs'>OBSERVAÇÕES:</h2>";
                echo "<p>" . $observacao_pedido . "</p>";
                echo "<div class='icons'>";
                echo "<a href='../php-action/atualizar_pedido.php?id=" . $pedido_anterior . "'><img src='../img/lapis.png' class='icon'></a>";
                echo "<img src='../img/lata-de-lixo.png' class='icon' id='lixo-icon' onclick='apagarPedido(" . $pedido_anterior . ")'>";
                echo "<input type='submit' value='Enviar' class='btn-enviar' onclick='concluirPedidos(" . $pedido_anterior . ")'>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            else{
                echo "Nenhum pedido encontrado!";
            }
            // Fechar a conexão com o banco de dados
            mysqli_close($conn);

            ?>

        </section>
    </main>

    <script src="../js/cozinha.js"></script>
</body>

</html>