<?php
session_start();

require_once('classe/usuario.php');
require_once('conexao/conexao.php');
require_once('classe/carrinho.php');

$database = new Conection();
$db = $database->getConnection();
$classUsuario = new Usuario($db);

$produtos = [];

function getAllProdutos($db)
{
    $query = "SELECT * FROM produto_compras";
    $stmt = $db->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function filtrarPorTipo($db, $tipo)
{
    $query = "SELECT * FROM produto_compras WHERE tipo = :tipo";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function buscarPorTermo($db, $searchTerm)
{
    $query = "SELECT * FROM produto_compras WHERE nome_produto LIKE :search OR preco_produto LIKE :search OR tipo LIKE :search";
    $stmt = $db->prepare($query);
    $searchTerm = "%" . $searchTerm . "%";
    $stmt->bindParam(":search", $searchTerm, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Adicione produtos ao carrinho
if (isset($_GET['id_produto'])) {
    $id_produto = (int)$_GET['id_produto'];
    $queryProduto = "SELECT * FROM produto_compras WHERE id_produto = :id_produto";
    $stmtProduto = $db->prepare($queryProduto);
    $stmtProduto->bindParam(":id_produto", $id_produto, PDO::PARAM_INT);
    $stmtProduto->execute();
    $produto = $stmtProduto->fetch(PDO::FETCH_ASSOC);

    if ($produto) {
        // Adiciona o produto ao carrinho
        $carrinho = new Carrinho($produto['id_produto'], $produto['nome_produto'], $produto['descri'], $produto['preco_produto'], $produto['img_produto']);
        $carrinho->getCarrinho();

        // Redireciona para evitar o reenvio do formulário ao atualizar a página
        
    }
}

// Obtém todos os produtos se não houver um termo de pesquisa
if (isset($_GET['searchTerm'])) {
    $searchTerm = $_GET['searchTerm'];
    $produtos = buscarPorTermo($db, $searchTerm);
} elseif (isset($_GET['tipo'])) {
    $tipoProduto = $_GET['tipo'];
    $produtos = filtrarPorTipo($db, $tipoProduto);
} else {
    $produtos = getAllProdutos($db);
}

?>


<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <?php include_once('view/header_main.php'); ?>


    <?php

    if (!empty($mensagem)) {
        echo "<p>$mensagem</p>";
    }
    ?>
    <div class="container">
        <div class="row">
            <?php foreach ($produtos as $produto => $value) : ?>
                <div class="col-md-3 product-card">
                    <div class="card position-relative">
                        <span class="favorite-icon"><a href="?id_produto=<?= $produto ?>"><button type="button" class="btn btn-outline-danger favorite-button"><i class="fas fa-heart"></i></button></a></span>
                        <a href="visualizar.php?id_produto=<?= $value["id_produto"] ?>">
                            <img src="<?= $value["img_produto"] ?>" alt="<?= $value["nome_produto"] ?>" class="card-img-top">
                            <div class="card-body">
                                <h2 class="card-title"><?= $value["nome_produto"] ?></h2>
                                <p class="card-text"><?= $value["descri"] ?></p>
                                <p class="produto-preco">Preço: R$ <?php echo number_format($value['preco_produto'], 2, ',', '.'); ?></p>
                                <input type="hidden" name="produto_id" value="<?= $value["id_produto"] ?>">
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
        if (isset($id_produto) && $id_produto !== "" && isset($produtos[$id_produto])) {
            $carrinho = new Carrinho($id_produto, $produtos[$id_produto]['nome_produto'], $produtos[$id_produto]['descri'], $produtos[$id_produto]['preco_produto'], $produtos[$id_produto]['img_produto']);
            $carrinho->getCarrinho();
            if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho'])) {
                foreach ($_SESSION['carrinho'] as $produto => $value) {
                    echo "<p> Id do produto: " . $value['id_produto'] . " | 
                            Nome do Produto: " . $value['nome_produto'] . " | 
                            Descrição: " . $value['descri'] . " |
                            Preço: " . $value['preco_produto'] . "| Foto do Produto: " . $value['img_produto'] . "</p><br>";
                    echo "<a href='javascript:void(0);' class='excluir-produto' data-id='{$produto}'>Excluir</a>";
                }
            } else {
                $_SESSION['carrinho'] = array();
                echo "";
            }
        }
        ?>
        <script>
            $(document).ready(function() {
                $(".excluir-produto").click(function() {
                    var idProduto = $(this).data("id");

                    $.ajax({
                        url: "excluir.php", // Onde "excluir_produto.php" é o script PHP para processar a exclusão
                        type: "POST",
                        data: {
                            id_produto: idProduto
                        },
                        success: function(response) {
                            // Atualize a exibição do carrinho após a exclusão bem-sucedida
                            // Você pode recarregar a página ou atualizar a lista de produtos do carrinho via AJAX
                            location.reload(); // Recarrega a página (isso é apenas um exemplo)
                        },
                        error: function(xhr, status, error) {
                            // Lida com erros de solicitação AJAX, se necessário
                            console.error(error);
                        },
                    });
                });
            });
        </script>
</body>

</html>

</html>