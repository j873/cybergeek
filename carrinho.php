<?php
session_start();
require_once('classe/usuario.php');
require_once('conexao/conexao.php');
require_once('classe/carrinho.php');

$database = new Conection();
$db = $database->getConnection();
$classUsuario = new Usuario($db);
$produtos = [];

$query = "SELECT * FROM produto_compras";
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
    <title>Carrinho</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <?php include_once('view/header_main.php'); ?>
    <div class="container">
        <h1>Seu Carrinho</h1>

        <?php if ($id_produto !== "" && isset($produtos[$id_produto])) : ?>
            <?php
            $carrinho = new Carrinho(
                $id_produto,
                $produtos[$id_produto]['nome_produto'],
                $produtos[$id_produto]['descri'],
                $produtos[$id_produto]['preco_produto'],
                $produtos[$id_produto]['img_produto']
            );
            $carrinho->getCarrinho();
            ?>
        <?php endif; ?>

        <?php if (!empty($_SESSION['carrinho'])) : ?>
            <?php foreach ($_SESSION['carrinho'] as $produto => $value) : ?>
                <div class="product-card">
                    <img src="<?= $value['img_produto'] ?>" alt="Imagem do Produto">
                    <div class="product-details">
                        <div class="product-title"><?= $value['nome_produto'] ?></div>
                        <div class="product-description"><?= $value['descri'] ?></div>
                        <div class="product-price">Preço: R$ <?= $value['preco_produto'] ?></div>
                        <button class="remove-button" data-id="<?= $produto ?>">Remover</button>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="product-card">
                <div class="product-price">Preço Total: R$ <?= formatarPrecoTotal($_SESSION['carrinho']) ?></div>
            </div>
        <?php else : ?>
            <div class="empty-cart-message">Seu carrinho está vazio.</div>
        <?php endif; ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $(".remove-button").click(function() {
                var idProduto = $(this).data("id");

                $.ajax({
                    url: "excluir.php",
                    type: "POST",
                    data: {
                        id_produto: idProduto
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    },
                });
            });
        });
    </script>
</body>

</html>

<?php
function formatarPrecoTotal($carrinho)
{
    $precoTotal = array_sum(array_column($carrinho, 'preco_produto'));
    return number_format($precoTotal, 2, ',', '.');
}
?>