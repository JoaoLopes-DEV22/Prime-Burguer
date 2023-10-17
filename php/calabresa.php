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
    <title>Calabresa</title>
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

            <h4 id="txt-title">Calabresas</h4>

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
                <ul id="portion" class="ul-options">Calabresa</ul>
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
                    <img src="../img/Porções/calabresa-simples.png" class="img-burg">
                </div>

                <div class="product">

                    <h2 class="title-product">Porção de Calabresa simples</h2>

                    <p>A autenticidade da calabresa artesanal em sua forma pura, celebração do sabor tradicional.</p>

                    <div class="buy">

                        <h3>R$29,99</h3>
                        <input type="button" value="Adicionar" class="btn-add" data-nome="Porção de Calabresa simples" data-preco="29.99" data-imagem="../img/Porções/calabresa-simples.png">

                    </div>
                </div>
            </div>

            <!-- Produto 2 -->

            <div class="card-product">

                <div class="img-product">
                    <img src="../img/Porções/calabresa-batata.png" class="img-burg">
                </div>

                <div class="product">

                    <h2 class="title-product">Porção de Calabresa + Fritas</h2>

                    <p>Intensidade da calabresa artesanal com fritas crocantes, uma combinação que satisfaz os apreciadores de sabores marcantes.</p>

                    <div class="buy">

                        <h3>R$39,90</h3>
                        <input type="button" value="Adicionar" class="btn-add" data-nome="Porção de Calabresa + Fritas" data-preco="39.99" data-imagem="../img/Porções/calabresa-batata.png">

                    </div>
                </div>
            </div>

            <!-- Produto 3 -->

            <div class="card-product">

                <div class="img-product">
                    <img src="../img/Porções/calabresa-contra-file.png" class="img-burg">
                </div>

                <div class="product">

                    <h2 class="title-product">Porção de Calabresa + Fritas + Contra Filé</h2>

                    <p>Experiência completa: calabresa artesanal, fritas e suculento contra filé grelhado, tudo em uma única porção.</p>

                    <div class="buy">

                        <h3>R$52,99</h3>
                        <input type="button" value="Adicionar" class="btn-add" data-nome="Porção de Calabresa + Fritas + Contra Filé" data-preco="52.99" data-imagem="../img/Porções/calabresa-contra-file.png">

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