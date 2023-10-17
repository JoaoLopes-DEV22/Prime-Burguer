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
    <title>Refrigerantes</title>
    <link rel="stylesheet" href="../css/refrigerante.css">
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

            <h4 id="txt-title">Refrigerantes</h4>

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
                <ul id="drinks" class="ul-options">Refrigerantes</ul>
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
                    <img src="../img/Bebidas/coca.png" class="img-burg">
                </div>

                <div class="product">

                    <h2 class="title-product">Coca - Cola</h2>

                    <p>Aclamado em todo o mundo, o sabor icônico da Coca-Cola é uma explosão de refrescância e felicidade. Uma escolha clássica para saciar a sede.</p>

                    <div class="buy">

                        <h3>R$6,99</h3>
                        <input type="button" value="Adicionar" class="btn-add" data-nome="Coca - Cola" data-preco="6.99" data-imagem="../img/Bebidas/coca.png">

                    </div>
                </div>
            </div>

            <!-- Produto 2 -->

            <div class="card-product">

                <div class="img-product">
                    <img src="../img/Bebidas/guarana.png" class="img-burg">
                </div>

                <div class="product">

                    <h2 class="title-product">Guaraná</h2>

                    <p>Com um toque brasileiro, o Guaraná oferece um sabor único e energizante. A doçura equilibrada e a efervescência fazem dele uma escolha popular.</p>

                    <div class="buy">

                        <h3>R$6,99</h3>
                        <input type="button" value="Adicionar" class="btn-add" data-nome="Guaraná" data-preco="6.99" data-imagem="../img/Bebidas/guarana.png">

                    </div>
                </div>
            </div>

            <!-- Produto 3 -->

            <div class="card-product">

                <div class="img-product">
                    <img src="../img/Bebidas/sprite.png" class="img-burg">
                </div>

                <div class="product">

                    <h2 class="title-product">Sprite</h2>

                    <p>Brilhante e cítrico, o Sprite traz a sensação de limpeza e frescor. Seu sabor limonado é uma opção vibrante para momentos leves.</p>

                    <div class="buy">

                        <h3>R$6,99</h3>
                        <input type="button" value="Adicionar" class="btn-add" data-nome="Sprite" data-preco="6.99" data-imagem="../img/Bebidas/sprite.png">

                    </div>
                </div>
            </div>

            <!-- Produto 4 -->

            <div class="card-product">

                <div class="img-product">
                    <img src="../img/Bebidas/fanta.png" class="img-burg">
                </div>

                <div class="product">

                    <h2 class="title-product">Fanta</h2>

                    <p> Celebre a diversão com os diversos sabores da Fanta. Das frutas às cores vibrantes, cada gole é uma experiência alegre e refrescante.</p>

                    <div class="buy">

                        <h3>R$6,99</h3>
                        <input type="button" value="Adicionar" class="btn-add" data-nome="Fanta" data-preco="6.99" data-imagem="../img/Bebidas/fanta.png">

                    </div>
                </div>
            </div>

            <!-- Produto 5 -->

            <div class="card-product">

                <div class="img-product">
                    <img src="../img/Bebidas/pepsi.png" class="img-burg">
                </div>

                <div class="product">

                    <h2 class="title-product">Pepsi</h2>

                    <p>Uma alternativa saborosa, a Pepsi oferece um sabor distinto e equilibrado. Satisfazendo paladares diversos, é uma escolha para quem busca uma opção diferente de cola.</p>

                    <div class="buy">

                        <h3>R$6,99</h3>
                        <input type="button" value="Adicionar" class="btn-add" data-nome="Pepsi" data-preco="6.99" data-imagem="../img/Bebidas/pepsi.png">

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