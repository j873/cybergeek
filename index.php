<?php
session_start();

require_once('classe/classe.php');
require_once('conexao/conexao.php');
require_once('classe/carrinho.php');

$database = new Conection();
$db = $database->getConnection();
$classUsuario = new Cliente($db);

$produtos = [];

$query = "SELECT * FROM produto_compras ";
$result = $db->query($query);

if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $produtos[] = $row;
    }
}

$id_produto = isset($_GET['id_produto']) ? $_GET['id_produto'] : "";


?>


<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/1a56e06420.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <style>
        .product-card {
            width: 100%;
            min-width: 300px;
            margin: 10px;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .product-card img {
            max-width: 100%;
            height: auto;
            flex: 1;
        }

        .product-card .card-body {
            padding: 10px;
            text-align: center;
        }

        .product-card h2 {
            font-size: 18px;
            margin-top: 10px;
        }

        .product-card p {
            font-size: 14px;
            color: #666;
        }

        .favorite-icon {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .favorite-button {
            width: 30px;
            height: 30px;
            font-size: 18px;
            padding: 0;
        }

        .add-to-cart-button {
            margin-top: 10px;

        }

        .btn_visu {
            margin-bottom: 20px;

        }
    </style>
</head>

<body>
    <?php include_once('view/header_main.php'); ?>

    <div class="container">
        <div class="row">
            <?php foreach ($produtos as $produto => $value) : ?>
                <div class="col-md-3 product-card">
                    <div class="card position-relative">
                        <span class="favorite-icon"><a href="?id_produto=<?= $produto ?>"><button type="button" class="btn btn-outline-danger favorite-button"><i class="fas fa-heart"></i></button></a></span>
                        <img src="<?= $value["img_produto"] ?>" alt="<?= $value["nome_produto"] ?>" class="card-img-top">
                        <div class="card-body">
                            <h2 class="card-title"><?= $value["nome_produto"] ?></h2>
                            <p class="card-text"><?= $value["descri"] ?></p>
                            <p class="produto-preco">Preço: R$ <?php echo number_format($value['preco_produto'], 2, ',', '.'); ?></p>
                            <input type="hidden" name="produto_id" value="<?= $value["id_produto"] ?>">
                            <a href="visualizar.php?id_produto=<?= $value["id_produto"] ?>" class="btn_visu btn btn-primary">Visualizar Produto</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
    if ($id_produto !== "" && isset($produtos[$id_produto])) {
        $carrinho = new Carrinho($id_produto, $produtos[$id_produto]['nome_produto'], $produtos[$id_produto]['descri'], $produtos[$id_produto]['preco_produto'], $produtos[$id_produto]['img_produto']);
        $carrinho->getCarrinho();
    }
    if (isset($_SESSION['carrinho']) && is_array($_SESSION['carrinho'])) {
        foreach ($_SESSION['carrinho'] as $produto => $value) {
            echo "<p> Id do produto: " . $value['id_produto'] . " | 
                            Nome do Produto: " . $value['nome_produto'] . " | 
                            Descrição: " . $value['descri'] . " |
                            Preço: " . $value['preco_produto'] . "| 
                             Foto do Produto: " . $value['img_produto'] .
                "</p><br>";
            echo "<a href='javascript:void(0);' class='excluir-produto' data-id='{$produto}'>Excluir</a>";
        }
    } else {
        $_SESSION['carrinho'] = array();
        echo "";
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