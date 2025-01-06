var produtosEscolhidos = carregarCarrinhoDosCookies();
var quantidadeNoCarrinho = produtosEscolhidos.length;

// Função para salvar o carrinho em cookies
function salvarCarrinhoNoCookie(carrinho) {
  Cookies.set("carrinho", JSON.stringify(carrinho));
  Cookies.set("quantidadeNoCarrinho", quantidadeNoCarrinho);
}

function carregarCarrinhoDosCookies() {
  var carrinhoCookie = Cookies.get("carrinho");
  if (carrinhoCookie) {
    return JSON.parse(carrinhoCookie);
  } else {
    return [];
  }
}

// Função para carregar o número de itens do carrinho dos cookies e exibi-lo
function carregarNumeroCarrinhoDosCookies() {
  var quantidade = Cookies.get("quantidadeNoCarrinho");
  if (quantidade) {
    quantidadeNoCarrinho = parseInt(quantidade);
    atualizarNumeroCarrinho();
  }
}

// Chame essa função quando a página carregar
window.addEventListener("load", carregarNumeroCarrinhoDosCookies);

// Variáveis globais para manter o estado do pedido
var pedido = {
  nome: "",
  preco: 0,
  quantidade: 1,
  imagem: ""
};

// Função para calcular o valor total do pedido
function calcularTotalPedido() {
  var total = 0;
  produtosEscolhidos.forEach(function (produto) {
    total += produto.preco * produto.quantidade;
  });
  return total;
}

function aumentarQuantidade(produto) {
  // Encontre o produto no carrinho
  var produtoExistente = produtosEscolhidos.findIndex(function (item) {
    return item.nome === produto.nome;
  });

  // Aumente a quantidade do produto se ele existir
  if (produtoExistente != -1) {
    produtosEscolhidos[produtoExistente].quantidade++;
    quantidadeNoCarrinho++;

    // Atualize a quantidade no modal
    var quantidadeElementModal = document.querySelector(".quantidade-no-modal");
    if (quantidadeElementModal) {
      quantidadeElementModal.textContent = produtosEscolhidos[produtoExistente].quantidade;
    }

    // Atualize o preço total do pedido
    var totalPedido = calcularTotalPedido();
    var pTotalElement = document.getElementById("p-total");
    if (pTotalElement) {
      pTotalElement.textContent = "Total: R$" + totalPedido.toFixed(2);
    }
  }

  // Atualize o número do carrinho
  atualizarNumeroCarrinho();
  salvarCarrinhoNoCookie(produtosEscolhidos);
  abrirModalCarrinho();
}

function diminuirQuantidade(produto) {
  // Encontre o índice do produto no carrinho
  var produtoIndex = produtosEscolhidos.findIndex(function (item) {
    return item.nome === produto.nome;
  });

  // Se o produto existir no carrinho
  if (produtoIndex !== -1) {
    if (produtosEscolhidos[produtoIndex].quantidade > 1) {
      // Se a quantidade for maior que 1, diminua a quantidade
      produtosEscolhidos[produtoIndex].quantidade--;
      quantidadeNoCarrinho--;
    } else {
      // Se a quantidade for igual a 1, remova o produto do carrinho
      produtosEscolhidos.splice(produtoIndex, 1);
      quantidadeNoCarrinho--;
    }
  }

  // Atualize o preço total do pedido
  var totalPedido = calcularTotalPedido();
  var pTotalElement = document.getElementById("p-total");
  if (pTotalElement) {
    pTotalElement.textContent = "Total: R$" + totalPedido.toFixed(2);
  }

  // Atualize o número do carrinho
  atualizarNumeroCarrinho();
  salvarCarrinhoNoCookie(produtosEscolhidos);

  // Atualize o modal do carrinho
  abrirModalCarrinho();
}

// Função para atualizar o modal com as informações do produto
function atualizarModal() {
  var nomeProdutoElement = document.getElementById("nome-produto");
  var imgBuyElement = document.getElementById("img-buy");
  var precoElement = document.querySelector(".preco");
  var quantidadeElement = document.querySelector(".quantidade");
  var pTotalElement = document.getElementById("p-total");

  if (
    nomeProdutoElement &&
    imgBuyElement &&
    precoElement &&
    quantidadeElement &&
    pTotalElement
  ) {
    nomeProdutoElement.textContent = pedido.nome;
    imgBuyElement.src = pedido.imagem;
    precoElement.textContent = "R$" + pedido.preco.toFixed(2);
    quantidadeElement.textContent = pedido.quantidade;

    // Chame a função para calcular o valor total do pedido
    var totalPedido = calcularTotalPedido();

    // Atualize o valor total no modal do carrinho
    pTotalElement.textContent = "Total: R$" + totalPedido.toFixed(2);

    // Encontre o elemento HTML que exibe a quantidade no modal usando a classe
    var quantidadeElementModal = document.querySelector(".quantidade-no-modal");

    if (quantidadeElementModal) {
      console.log("Encontrado elemento com classe 'quantidade-no-modal'");
      // Atualize o texto para mostrar a nova quantidade
      quantidadeElementModal.textContent = pedido.quantidade;
      console.log("Quantidade atualizada para: " + pedido.quantidade);
    } else {
      console.log("Elemento com classe 'quantidade-no-modal' não encontrado.");
    }
  }
}

// Função para abrir o modal com as informações do produto
function abrirModal(produto) {
  pedido = {
    nome: produto.nome,
    preco: produto.preco,
    quantidade: 1,
    imagem: produto.imagem
  };

  // Chame a função para calcular o valor total do pedido
  var totalPedido = calcularTotalPedido();

  // Atualize o valor total no modal do carrinho
  document.getElementById("p-total").textContent =
    "Total: R$" + totalPedido.toFixed(2);

  atualizarModal();

  // Exiba o modal do carrinho
  document.getElementById("fade").style.display = "block";
  document.getElementById("modal").style.display = "block";

  console.log("Modal aberto com produto: ", produto.nome);
}

function toggleDrop() {
  var dropdown = document.querySelector(".menu");
  if (dropdown.style.display === "block") {
    dropdown.style.display = "none";
  } else {
    dropdown.style.display = "block";
  }
}

function toggleMenu() {
  var menuToggle = document.getElementById("menu-toggle");
  var aside = document.querySelector("aside");

  // Verifica se o ícone de toggle tem a classe 'opened'
  if (menuToggle.classList.contains("opened")) {
    menuToggle.classList.remove("opened");
    aside.style.display = "none";
  } else {
    menuToggle.classList.add("opened");
    aside.style.display = "block";
  }
  const dropdown = document.getElementById("myDropdown");
  dropdown.classList.toggle("active");
  if (dropdown.classList.contains("active")) {
    dropdown.style.maxHeight = dropdown.scrollHeight + "px";
  } else {
    dropdown.style.maxHeight = "0";
  }
}

// Obtém todos os botões "Adicionar" dos cards de produtos
var btnAddProduto = document.querySelectorAll(".btn-add");

// Adiciona um ouvinte de clique a cada botão
btnAddProduto.forEach(function (btn) {
  btn.addEventListener("click", function () {
    // Obtém informações do produto a partir dos atributos de dados
    var produto = {
      nome: this.getAttribute("data-nome"),
      preco: parseFloat(this.getAttribute("data-preco")),
      imagem: this.getAttribute("data-imagem")
    };
    adicionarAoCarrinho(produto);
  });
});

function fecharModal() {
  document.getElementById("fade").style.display = "none";
  document.getElementById("modal").style.display = "none";
}

function adicionarAoCarrinho(produto, index) {
  // Crie um novo objeto para representar o produto escolhido
  var produtoEscolhido = {
    nome: produto.nome,
    preco: produto.preco,
    quantidade: 1,
    imagem: produto.imagem
  };

  // Verifique se o produto já foi escolhido antes
  var produtoExistente = produtosEscolhidos.find(function (item) {
    return item.nome === produtoEscolhido.nome;
  });

  // Se o produto já existe, atualize apenas a quantidade
  if (produtoExistente) {
    produtoExistente.quantidade++;
  } else {
    // Caso contrário, adicione o novo produto à lista
    produtosEscolhidos.push(produtoEscolhido);
  }

  Swal.fire({
    icon: "success",
    title: "Produto adicionado com sucesso!"
  });

  // Atualize a quantidade no carrinho e no modal
  quantidadeNoCarrinho++;
  atualizarNumeroCarrinho();

  var itemCarrinho = document.createElement("div");
  itemCarrinho.classList.add("item-carrinho"); // Adicione a classe de estilização

  // Crie a estrutura de preço e quantidade para o produto
  var produtoPreco = document.createElement("div");
  produtoPreco.classList.add("produto-preco");

  var preco = document.createElement("div");
  preco.classList.add("preco");
  preco.textContent = "R$" + produto.preco.toFixed(2);

  var add = document.createElement("div");
  add.classList.add("add");

  // Crie as divs para os botões de "+" e "-"
  var subtrair = document.createElement("div");
  subtrair.classList.add("subtrair");
  subtrair.textContent = "-";

  var quantidade = document.createElement("p");
  quantidade.classList.add("quantidade-no-modal");
  quantidade.textContent = produto.quantidade;

  var somar = document.createElement("div");
  somar.classList.add("somar");
  somar.textContent = "+";

  // Adicione os elementos ao itemCarrinho
  add.appendChild(subtrair);
  add.appendChild(quantidade);
  add.appendChild(somar);

  produtoPreco.appendChild(preco);
  produtoPreco.appendChild(add);

  // Adicione ouvintes de evento aos botões de "+" e "-"
  somar.addEventListener("click", function () {
    aumentarQuantidade(produtoEscolhido, index);
    atualizarModal();
  });

  subtrair.addEventListener("click", function () {
    diminuirQuantidade(produtoEscolhido, index);
    atualizarModal();
  });

  // Agora, você pode chamar a função atualizarModal() aqui
  atualizarModal();

  console.log("Produto adicionado ao carrinho: ", produto.nome);
  salvarCarrinhoNoCookie(produtosEscolhidos);
}

function atualizarNumeroCarrinho() {
  var elementoNumeroCarrinho = document.getElementById("quantidade-carrinho");
  elementoNumeroCarrinho.textContent = quantidadeNoCarrinho;
}

// Função para abrir a modal do carrinho
function abrirModalCarrinho() {
  // Limpe qualquer conteúdo anterior do modal do carrinho
  var modalBody = document.getElementById("carrinho-items");
  modalBody.innerHTML = ""; // Limpa o conteúdo anterior

  // Itere pela lista de produtos escolhidos e exiba-os no modal
  produtosEscolhidos.forEach(function (produto) {
    var itemCarrinho = document.createElement("div");
    itemCarrinho.classList.add("item-carrinho"); // Adicione a classe de estilização

    // Crie a estrutura de preço e quantidade para o produto
    var produtoPreco = document.createElement("div");
    produtoPreco.classList.add("produto-preco");

    var preco = document.createElement("div");
    preco.classList.add("preco");
    preco.textContent = "R$" + produto.preco.toFixed(2);

    var add = document.createElement("div");
    add.classList.add("add");

    var subtrair = document.createElement("div");
    subtrair.classList.add("subtrair");
    subtrair.textContent = "-";

    var quantidade = document.createElement("p");
    quantidade.classList.add("quantidade-no-modal");
    quantidade.textContent = produto.quantidade;

    var somar = document.createElement("div");
    somar.classList.add("somar");
    somar.textContent = "+";

    // Adicione os elementos ao itemCarrinho
    add.appendChild(subtrair);
    add.appendChild(quantidade);
    add.appendChild(somar);

    produtoPreco.appendChild(preco);
    produtoPreco.appendChild(add);

    // Adicione ouvintes de evento aos botões de + e -
    somar.addEventListener("click", function () {
      aumentarQuantidade(produto);
    });

    subtrair.addEventListener("click", function () {
      diminuirQuantidade(produto);
    });

    // Adicione a imagem do produto
    var imagemProduto = document.createElement("img");
    imagemProduto.src = produto.imagem;

    // Adicione informações do produto (nome, preço, quantidade, etc.)
    var infoProduto = document.createElement("div");
    infoProduto.classList.add("info-produto");

    var nomeProduto = document.createElement("h4");
    nomeProduto.textContent = produto.nome;

    // Adicione os elementos ao itemCarrinho
    infoProduto.appendChild(nomeProduto);

    // Adicione os elementos ao itemCarrinho
    itemCarrinho.appendChild(imagemProduto);
    itemCarrinho.appendChild(infoProduto);
    itemCarrinho.appendChild(produtoPreco);

    // Chame a função para calcular o valor total do pedido
    var totalPedido = calcularTotalPedido();

    // Atualize o valor total no modal do carrinho
    document.getElementById("p-total").textContent =
      "Total: R$" + totalPedido.toFixed(2);

    // Adicione o item do carrinho ao modal
    modalBody.appendChild(itemCarrinho);
  });

  var btnCancelar = document.querySelector(".btn-cancelar");
  btnCancelar.addEventListener("click", function () {
    limparCarrinho();
    fecharModal();
  });

  // Adicionar classe CSS ao elemento do conteúdo do modal
  var modalContent = document.getElementById("modal-content");
  modalContent.classList.add("modal-content");

  // Exiba o modal do carrinho
  document.getElementById("fade").style.display = "block";
  document.getElementById("modal").style.display = "block";
}

function limparCarrinho() {
  quantidadeNoCarrinho = 0;
  produtosEscolhidos = [];
  var zerarPedido = document.getElementById("p-total");
  zerarPedido.innerHTML = "Total: R$0.00";

  document.querySelector("textarea").value = "";
  document.getElementById("num").value = "";

  const carrinhoItems = document.querySelectorAll(".item-carrinho");
  carrinhoItems.forEach(item => {
    item.remove();
  });
  // Atualizar a quantidade no ícone do carrinho
  document.getElementById("quantidade-carrinho").textContent = "0";

  // Limpar o conteúdo do modal
  var modalBody = document.getElementById("carrinho-items");
  modalBody.innerHTML = "";

  // Atualizar o número de itens no carrinho
  atualizarNumeroCarrinho();

  salvarCarrinhoNoCookie(produtosEscolhidos);
}

// ---------------- PEGAR PARA INSERIR NO BANCO ---------------- //

function EnviarPedidoServidor() {
  produtosEscolhidos.forEach(function (produto) {
    // Calcula o valor total para cada produto
    var totalPedido = calcularTotalPedido();
    // var totalPedido = parseFloat(document.querySelector("#p-total").innerText.replace("R$", "").trim());

    // Objeto que contém os dados do pedido
    var pedidoData = {
      mesa_pedido: document.getElementById("num").value,
      nome_pedido: produto.nome,
      valor_pedido: produto.preco,
      quantidade_pedido: produto.quantidade,
      observacao_pedido: document.querySelector("textarea").value,
      total_pedido: totalPedido.toFixed(2)
    };

    // Faça a chamada AJAX para inserir o pedido no banco de dados
    fetch("../php-action/inserir_pedido.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json;charset=UTF-8"
      },
      body: JSON.stringify(pedidoData)
    })
      .then(function (response) {
        if (response.ok) {
          return response.text();
        } else {
          throw new Error("Erro na inserção do pedido no banco de dados.");
        }
      })
      .then(function (data) {
        // Verifique a resposta do servidor (pode mostrar uma mensagem de sucesso ou lidar com erros)
        console.log(data);
      })
      .catch(function (error) {
        // Lide com erros aqui, se necessário
        console.error(error);
      });
  });

  // Após o envio de todos os produtos, limpe o carrinho
  limparCarrinho();
  fecharModal();
}
