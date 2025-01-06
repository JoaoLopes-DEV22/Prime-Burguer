function apagarPedido(mesaPedido) {
    if (confirm("Tem certeza que deseja apagar este pedido?")) {
        // Faça uma solicitação AJAX para o servidor para remover o pedido do banco de dados
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../php-action/apagar_pedido.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Se a exclusão no banco de dados foi bem-sucedida, remova a div da tela
                var divPedido = document.querySelector(".nmr-pedido:contains('" + mesaPedido + "')").closest(".card");
                divPedido.remove();
            }
        };
        xhr.send("mesa_pedido=" + mesaPedido);
        window.location.reload();
    }
}

function concluirPedidos(mesaPedido) {
    if (confirm("Tem certeza de que deseja concluir este pedido?")) {
        // Faça uma solicitação AJAX para o servidor para atualizar o status do pedido no banco de dados
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../php-action/enviar_pedido.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Se a atualização no banco de dados foi bem-sucedida, atualize a interface
                var divPedido = document.querySelector(".nmr-mesa:contains('" + mesaPedido + "')").closest(".card");
                divPedido.remove();
            }
        };
        xhr.send("mesa_pedido=" + mesaPedido);
        window.location.reload();
    }
}
