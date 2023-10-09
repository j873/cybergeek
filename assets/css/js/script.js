<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    $(document).ready(function () {
        $(".excluir-produto").click(function () {
            var idProduto = $(this).data("id");

            $.ajax({
                url: "excluir_produto.php", // Onde "excluir_produto.php" é o script PHP para processar a exclusão
                type: "POST",
                data: { id_produto: idProduto },
                success: function (response) {
                    // Atualize a exibição do carrinho após a exclusão bem-sucedida
                    // Você pode recarregar a página ou atualizar a lista de produtos do carrinho via AJAX
                    location.reload(); // Recarrega a página (isso é apenas um exemplo)
                },
                error: function (xhr, status, error) {
                    // Lida com erros de solicitação AJAX, se necessário
                    console.error(error);
                },
            });
        });
    });


    alert('oi');