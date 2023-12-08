<?php
session_start();

require_once('classe/usuario.php');
require_once('conexao/conexao.php');

$database = new Conection();
$db = $database->getConnection();
$classUsuario = new Usuario($db);

$produto = null;

// Verifica se um ID de produto foi passado via GET
if (isset($_GET['id_produto'])) {
    $id_produto = $_GET['id_produto'];

    // Consulta SQL para buscar informações do produto pelo ID
    $sql = "SELECT * FROM produto_compras WHERE id_produto = :id_produto";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id_produto', $id_produto);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "Produto não encontrado.";
        exit();
    }
}

// Redireciona para a página de login se o usuário não estiver logado
if (!isset($_SESSION['nome'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Produto</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
</head>

<body>

    <?php require('view/header_main.php'); ?>

    <div class="container mt-3">
        <h1 class="mb-4">Detalhes do Produto</h1>

        <div class="produto-info">
            <img src="<?php echo $produto['img_produto']; ?>" alt="<?php echo $produto['nome_produto']; ?>" class="produto-img">
            <div>
                <h2 class="produto-titulo"><?php echo $produto['nome_produto']; ?></h2>
                <p class="produto-descricao"><?php echo $produto['descri']; ?></p>
                <p class="produto-preco">Preço: R$ <?php echo number_format($produto['preco_produto'], 2, ',', '.'); ?></p>
            </div>

            <!-- Botões -->
            <div class="mt-4">
                <!-- Botão de comprar -->
                <a href="Compra.php" class="btn btn-primary mr-2">Comprar</a>

                <!-- Botão de adicionar ao carrinho -->
                <button class="btn btn-success mr-2" onclick="adicionarAoCarrinho(<?php echo $produto['id_produto']; ?>)">Adicionar ao Carrinho</button>

                <!-- Botão para voltar à página principal -->
                <a href="index.php" class="btn btn-secondary">Voltar</a>
            </div>

            <!-- Campo para colocar comentários -->
            <textarea class="form-control mt-4" placeholder="Deixe seu comentário"></textarea>
        </div>
    </div>

    <!-- Inclua os arquivos JavaScript do Bootstrap e jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI/t1f1fV8oX8HqAqDdELkOZO+Y9Adn6/i+L2y8E=" crossorigin="anonymous"></script>


    <script>
        function adicionarAoCarrinho(idProduto) {
            // Envia uma solicitação AJAX para adicionar o produto ao carrinho
            $.ajax({
                url: 'adicionar_carrinho.php',
                method: 'POST',
                data: {
                    id_produto: idProduto
                },
                dataType: 'json',
                success: function(response) {
                    // Exibe a resposta no console (você pode personalizar isso conforme necessário)
                    console.log(response);

                    // Aqui, você pode adicionar lógica para exibir mensagens ao usuário, se desejar
                    alert(response.message);
                },
                error: function(error) {
                    // Trata erros na solicitação AJAX (você pode personalizar isso conforme necessário)
                    console.error('Erro na solicitação AJAX:', error);
                }
            });
        }
    </script>
</body>

</html>