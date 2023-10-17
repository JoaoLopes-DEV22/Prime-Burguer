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
    <title>Frango</title>
    <link rel="stylesheet" href="../css/porcao.css">
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

            <h4 id="txt-title">Frangos</h4>

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
                <ul id="portion" class="ul-options">Frango</ul>
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
                    <img src="../img/Porções/frango-simples.png" class="img-burg">
                </div>

                <div class="product">

                    <h2 class="title-product">Porção de Frango simples</h2>

                    <p>Sabor autêntico do frango em uma porção descomplicada.</p>

                    <div class="buy">

                        <h3>R$19,99</h3>
                        <input type="button" value="Adicionar" class="btn-add" data-nome="Porção de Frango simples" data-preco="19.99" data-imagem="../img/Porções/frango-simples.png">

                    </div>
                </div>
            </div>

            <!-- Produto 2 -->

            <div class="card-product">

                <div class="img-product">
                    <img src="../img/Porções/frango-empanado.png" class="img-burg">
                </div>

                <div class="product">

                    <h2 class="title-product">Porção de Frango empanado</h2>

                    <p>Textura crocante, sabor suculento. Frango empanado para quem ama uma experiência de sabores contrastantes.</p>

                    <div class="buy">

                        <h3>R$22,99</h3>
                        <input type="button" value="Adicionar" class="btn-add" data-nome="Porção de Frango empanado" data-preco="22.99" data-imagem="../img/Porções/frango-empanado.png">

                    </div>
                </div>
            </div>

            <!-- Produto 3 -->

            <div class="card-product">

                <div class="img-product">
                    <img src="../img/Porções/frango-batata-frita.png" class="img-burg">
                </div>

                <div class="product">

                    <h2 class="title-product">Porção de Frango + fritas</h2>

                    <p>Frango e fritas gourmet em uma porção irresistível. Combinação de sabores que sacia seu desejo por uma refeição deliciosa.</p>

                    <div class="buy">

                        <h3>R$29,99</h3>
                        <input type="button" value="Adicionar" class="btn-add" data-nome="Porção de Frango + fritas" data-preco="29.99" data-imagem="../img/Porções/frango-batata-frita.png">

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