<?php
include 'conexao.php';

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
    <title>Burguer's da Casa</title>
    <link rel="stylesheet" href="../css/burguer.css">
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

            <h4 id="txt-title">Da Casa</h4>

            <div class="configs">

                <div class="carrinho">
                    <img src="../img/cesta.png" class="icon-cesta" onclick="abrirModalCarrinho()">
                    <span class="quant" id="quantidade-carrinho">0</span>
                </div>

                <img src="../img/sair.png" class="icon" onclick="javascript:location.href='logout.php'">


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
                <ul id="burguers">Da Casa</ul>
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
                <ul onclick="mudarTelaDrink()" class="ul-options">Drink's</ul>
            </div>

        </aside>

        <!-- Resumo do Pedido -->

        <!--Modal-->
        <div id="fade" class="hide"></div>

        <div id="modal" class="hide">
            <div id="modal-content"> <!-- Adicione a classe modal-content aqui -->
                <div class="modal-header">
                    <h2 id="titulo">Resumo do Pedido</h2>
                    <input type="number" class="number-mesa" name="num" id="num" placeholder="Insira a Mesa">
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

            <!-- Produto 1 -->

            <div class="card-product">

                <div class="img-product">
                    <img src="../img/Burguers/casa/oliver-burguer.png" class="img-burg">
                </div>

                <div class="product">

                    <h2 class="title-product">Oliver Burguer</h2>

                    <p>Um hambúrguer gourmet com carne premium, pão brioche artesanal, queijo Gruyère, cebolas caramelizadas, maionese de alho, vegetais frescos e picles caseiros. Uma experiência culinária única e inesquecível.</p>

                    <div class="buy">

                        <h3>R$50,99</h3>
                        <input type="button" value="Adicionar" class="btn-add" data-nome="Oliver Burguer" data-preco="50.99" data-imagem="../img/Burguers/casa/oliver-burguer.png">

                    </div>
                </div>
            </div>

            <!-- Produto 2 -->
            <div class="card-product">

                <div class="img-product">
                    <img src="../img/Burguers/casa/light-burguer.png" class="img-burg">
                </div>

                <div class="product">

                    <h2 class="title-product">Luz Burguer</h2>

                    <p>Servido em pão fresco, “Luz Burguer” é especialmente desenvolvido para realçar os sabores intensos. A textura equilibrada do pão complementa a suculência da carne, tornando cada mordida única.</p>

                    <div class="buy">

                        <h3>R$45,99</h3>
                        <input type="button" value="Adicionar" class="btn-add" data-nome="Luz Burguer" data-preco="45.99" data-imagem="../img/Burguers/casa/light-burguer.png">

                    </div>
                </div>
            </div>

            <!-- Produto 3 -->

            <div class="card-product">

                <div class="img-product">
                    <img src="../img/Burguers/casa/bento-burguer.png" class="img-burg">
                </div>

                <div class="product">

                    <h2 class="title-product">Bennto Burguer</h2>

                    <p>Uma fusão de sabores exóticos aguarda você com o Bennto Burguer. Com ingredientes dos mais derivados lugares cuidadosamente selecionados, criando uma harmonia.</p>

                    <div class="buy">

                        <h3>R$40,99</h3>
                        <input type="button" value="Adicionar" class="btn-add" data-nome="Bennto Burguer" data-preco="40.99" data-imagem="../img/Burguers/casa/bento-burguer.png">

                    </div>
                </div>
            </div>

            <!-- Produto 4 -->

            <div class="card-product">

                <div class="img-product">
                    <img src="../img/Burguers/casa/sauce-burguer.png" class="img-burg">
                </div>

                <div class="product">

                    <h2 class="title-product">Sauce Burguer</h2>

                    <p>Uma celebração de sabores diversos, o Sauce Burguer é feito com uma variedade de molhos especiais para agradar aos amantes de opções diversas.</p>

                    <div class="buy">

                        <h3>R$42,99</h3>
                        <input type="button" value="Adicionar" class="btn-add" data-nome="Sauce Burguer" data-preco="42.99" data-imagem="../img/Burguers/casa/sauce-burguer.png">

                    </div>
                </div>
            </div>

            <!-- Produto 5 -->

            <div class="card-product">

                <div class="img-product">
                    <img src="../img/Burguers/casa/wendell-burguer.png" class="img-burg">
                </div>

                <div class="product">

                    <h2 class="title-product">Wendell Burguer</h2>

                    <p>É a escolha reforçada para os amantes de academia. Com ingredientes nutritivos e ricos em proteína vegana, este hambúrguer é uma opção substancial para sustentar o seu estilo de vida ativo.</p>

                    <div class="buy">

                        <h3>R$41,99</h3>
                        <input type="button" value="Adicionar" class="btn-add" data-nome="Wendell Burguer" data-preco="41.99" data-imagem="../img/Burguers/casa/wendell-burguer.png">

                    </div>
                </div>
            </div>

            <!-- Produto 6 -->

            <div class="card-product">

                <div class="img-product">
                    <img src="../img/Burguers/casa/vitoria-burguer.png" class="img-burg">
                </div>

                <div class="product">

                    <h2 class="title-product">Vitoria Burguer</h2>

                    <p>Nossa criação exclusiva combina carne suculenta, queijo derretido, alface fresca e molho especial da casa. Uma vitória de sabores em cada mordida.</p>

                    <div class="buy">

                        <h3>R$48,99</h3>
                        <input type="button" value="Adicionar" class="btn-add" data-nome="Vitoria Burguer" data-preco="48.99" data-imagem="../img/Burguers/casa/vitoria-burguer.png">

                    </div>
                </div>
            </div>

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