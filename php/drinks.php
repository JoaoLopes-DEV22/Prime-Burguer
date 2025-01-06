<?php
include '../php-action/conexao.php';

session_start();
if (!isset($_SESSION["logado"]) || $_SESSION["logado"] !== true) {
    header("Location: ../index.php");
    exit;
}

// Obtenha o nome do usuário da sessão
$username = $_SESSION["nome_usuario"];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drink's</title>
    <link rel="stylesheet" href="../css/drinks.css">
    <script src="../js/navs.js"></script>
    <link rel="shortcut icon" href="../favicon/favicon.ico" type="image/x-icon">
</head>

<body>

    <!-- Área de Cabeçalho e Navegação -->
    <header class="responsive-header">

<div class="logo-area">
    <img src="../img/logo.png" id="img-logo" alt="Logo" onclick="javascript:location.href='direcionamento.php'">
</div>

<div class="search-area">

    <h4 id="txt-title">Casuais</h4>

    <div class="configs">

        <div class="carrinho">
            <img src="../img/cesta.png" class="icon-cesta" onclick="abrirModalCarrinho()">
            <span class="quant" id="quantidade-carrinho">0</span>
        </div>

        <div class="user-name-area">
            <p id="user-name"><?php echo $username; ?></p>
            <img src="../img/user-c.png" id="user-c-icon" onclick="toggleDrop()">
        </div>

    </div>

   <div class="menu">
                <ul class="exit">
                    <li class="logout">
                        <a href="../php-action/adicionar_produto.php" class="sair">
                            <img src="../img/mais-icon.png" id="icon-sair">
                            Adicionar Produto
                        </a>
                    </li>
                    <li class="logout">
                        <a href="comandas.php" class="sair">
                            <img src="../img/icon-pedido.png" id="icon-sair">
                            Gerenciar Comandas
                        </a>
                    </li>
                    <li class="logout">
                        <a href="gerenciamento.php" class="sair">
                            <img src="../img/funcs-icon.png" id="icon-sair">
                            Gerenciar Funcionários
                        </a>
                    </li>
                    <li class="logout">
                        <a href="gerenciamento-produto.php" class="sair">
                            <img src="../img/produtos-icon.png" id="icon-sair">
                            Gerenciar Produtos
                        </a>
                    </li>
                    <li class="logout" onclick="javascript:location.href='logout.php'">
                        <a href="../php-action/logout.php" class="sair">
                            <img src="../img/sair.png" id="icon-sair">
                            Sair da Sua Conta
                        </a>
                    </li>
                </ul>
            </div>

</div>
</header>

    <section class="toogle-area">
        <div id="menu-toggle" class="menu-toggle" onclick="toggleMenu()" ondblclick="toggleDropdown()">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
    </section>

    <main>

        <aside id="myDropdown">

            <!--Área de Categoria de Hambúrguer-->

            <div class="category-burg">
                <div class="linha"></div>

                <div class="burguer-icon">
                    <img src="../img/icon-burguer.png" class="icon-category">
                </div>

                <div class="linha2"></div>
            </div>

            <!--Opções de Hambúrgueres-->

            <div class="burguer-options">
                <ul onclick="mudarTelaBurguerCasual()" class="ul-options">Casuais</ul>
                <ul onclick="mudarTelaBurguerGourmet()" class="ul-options">Gourmet</ul>
                <ul onclick="mudarTelaBurguerVegano()" class="ul-options">Veganos</ul>
                <ul onclick="mudarTelaBurguerDaCasa()" class="ul-options">Da Casa</ul>
            </div>

            <!--Área de Categoria de Porções-->

            <div class="category-portions">
                <div class="linha"></div>

                <div class="portion-icon">
                    <img src="../img/icon-batata.png" class="icon-category">
                </div>

                <div class="linha2"></div>
            </div>

            <!--Opções de Porções-->

            <div class="portions-options">
                <ul onclick="mudarTelaBatataFrita()" class="ul-options">Fritas</ul>
                <ul onclick="mudarTelaNugget()" class="ul-options">Nuggets</ul>
                <ul onclick="mudarTelaCalabresa()" class="ul-options">Calabresa</ul>
                <ul onclick="mudarTelaFrango()" class="ul-options">Frango</ul>
            </div>

            <!--Área de Categoria de Bebidas-->

            <div class="category-drinks">
                <div class="linha"></div>

                <div class="drink-icon">
                    <img src="../img/icon-refri.png" class="icon-category">
                </div>

                <div class="linha2"></div>
            </div>

            <!--Opções de Bebidas-->

            <div class="drinks-options">
                <ul onclick="mudarTelaRefrigerante()" class="ul-options">Refrigerantes</ul>
                <ul onclick="mudarTelaSuco()" class="ul-options">Sucos</ul>
                <ul id="drinks" class="ul-options">Drink's</ul>
            </div>

        </aside>

        <!-- Resumo do Pedido -->

        <!--Modal-->
        <div id="fade" class="hide"></div>

        <div id="modal" class="hide">
            <div id="modal-content"> <!-- Adicione a classe modal-content aqui -->
                <div class="modal-header">
                    <h2 id="titulo">Resumo do Pedido</h2>
                    <input type="number" class="number-mesa" name="num" id="num" placeholder="Insira a Mesa" min="1">
                    <img src="../img/icon-X.png" id="close-modal" onclick="fecharModal()">
                </div>
                <div class="modal-body">
                    <div id="carrinho-items">
                        <!-- Os produtos do carrinho serão adicionados dinamicamente aqui -->
                    </div>
                </div>
                <div class="final-produto">
                    <div class="obs">
                        <img src="../img/obs.png" id="obs-icon">
                        <textarea name="observacao" id="observacao" cols="16" rows="2" placeholder="Observações"></textarea>
                    </div>
                    <div class="preco-total">
                        <span id="p-total">Total: R$ 00,00 </span>
                    </div>
                </div>
                <div class="btns-modal">
                    <input type="button" class="btn-cancelar" value="Cancelar">
                    <input type="button" class="btn-concluir" value="Concluir" onclick="EnviarPedidoServidor()">
                </div>
            </div>
        </div>
        <!--FIM Modal-->

        <!-- Área dos Cards dos produtos -->

        <div class="all-products">
            <?php
            include '../php-action/conexao.php';

            // Verifique a conexão
            if (mysqli_connect_errno()) {
                echo "Falha na conexão com o banco de dados: " . mysqli_connect_error();
            }

            // Consulta para obter os pedidos
            $consulta = "SELECT * FROM produtos_cadastrados WHERE categoria_produto = 'Drinks' ORDER BY id_produto ASC";
            $resultado = $conn->query($consulta);

            // Verificar se a consulta retornou algum resultado
            if ($resultado->num_rows > 0) :
                // Exibir os produtos
                while ($row = $resultado->fetch_assoc()) :
                    echo '
                        <div class="card-product">
                            <div class="img-product">
                                <img src="' . $row["img_produto"] . '" class="img-burg">
                            </div>
                            <div class="product">
                                <h2 class="title-product">' . $row["nome_produto"] . '</h2>
                                <p>' . $row["descricao_produto"] . '</p>
                                <div class="buy">
                                    <h3>R$' . $row["valor_produto"] . '</h3>
                                    <input type="button" value="Adicionar" class="btn-add" data-nome="' . $row["nome_produto"] . '" data-preco="' . $row["valor_produto"] . '" data-imagem="' . $row["img_produto"] . '">
                                </div>
                            </div>
                        </div>';
                endwhile;
            else:
                echo "Nenhum produto encontrado para esta categoria.";
            endif;

            // Fechar a conexão
            $conn->close();

            ?>
        </div>
    </main>
    <footer>
        <p id="txt-footer">Desenvolvido por DesignFlow &copy;</p>
    </footer>
    <script src="../js/script.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/3.0.1/js.cookie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>