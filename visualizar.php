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


?>

<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Produto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            text-align: center;
        }

        h1 {
            font-size: 32px;
            margin: 0;
            padding: 20px 0;
            color: #333;
        }

        .produto-info {
            text-align: left;
            padding: 20px;
            border-top: 1px solid #ddd;
        }

        .produto-img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .produto-titulo {
            font-size: 24px;
            margin: 10px 0;
            color: #333;
        }

        .produto-descricao {
            font-size: 16px;
            margin-bottom: 20px;
            color: #555;
        }

        .produto-preco {
            font-size: 24px;
            color: #e44d26;
        }

        /* Estilos para o campo de busca de CEP */
        .cep-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            color: #555;
        }

        /* Estilos para os botões */
        .acao-button {
            display: inline-block;
            padding: 12px 24px;
            margin: 0 10px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            color: #fff;
        }

        .comprar-button,
        .buscar-button {
            background-color: #e44d26;
            margin: 20px
        }

        .carrinho-button {
            background-color: #333;
        }

        .comprar-button:hover,
        .carrinho-button:hover {
            background-color: #333;
        }

        /* Estilos para o campo de comentários */
        .comentarios-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            color: #555;
        }

        /* Estilos para o botão Voltar */
        .voltar-button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #333;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            color: #fff;
        }

        .voltar-button:hover {
            background-color: #555;
        }
    </style>
</head>

<body>

    <?php require('view/header_main.php'); ?>


    <div class="container">
        <h1>Detalhes do Produto</h1>

        <div class="produto-info">
            <img src="<?php echo $produto['img_produto']; ?>" alt="<?php echo $produto['nome_produto']; ?>" class="produto-img">
            <div>
                <h2 class="produto-titulo"><?php echo $produto['nome_produto']; ?></h2>
                <p class="produto-descricao"><?php echo $produto['descri']; ?></p>
                <p class="produto-preco">Preço: R$ <?php echo number_format($produto['preco_produto'], 2, ',', '.'); ?></p>
            </div>
            <!-- Botão de comprar -->
            <a href="Compra.php" class="acao-button comprar-button">Comprar</a>

            <!-- Botão de adicionar ao carrinho -->
            <a href="#" class="acao-button carrinho-button">Adicionar ao Carrinho</a>

            <!-- Campo para colocar comentários -->
            <textarea class="comentarios-input" placeholder="Deixe seu comentário"></textarea>

            <!-- Botão para voltar à página principal -->
            <a href="index.php" class="voltar-button">Voltar</a>
        </div>
    </div>



    <script>
        function redirecionarParaLogin() {
            // Redireciona para a página de login
            window.location.href = "login.php";
        }
    </script>
</body>

</html>