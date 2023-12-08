<?php
session_start();

// Função para obter informações do produto por ID no banco de dados real
function obterInformacoesDoProdutoPorID($idProduto)
{
    // Configurações do banco de dados
    $host = 'localhost';
    $dbname = 'cybergeek';
    $username = 'root';
    $password = '';

    try {
        // Conecta ao banco de dados usando PDO
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta para obter as informações do produto
        $query = "SELECT * FROM produto_compras WHERE id_produto = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $idProduto, PDO::PARAM_INT);
        $stmt->execute();

        // Retorna as informações do produto como um array associativo
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Trata erros de conexão com o banco de dados
        die("Erro na conexão com o banco de dados: " . $e->getMessage());
    }
}

// Verifica se o ID do produto foi recebido
if (isset($_POST['id_produto'])) {
    $idProduto = $_POST['id_produto'];

    // Verifica se a sessão do carrinho existe, se não, cria uma nova
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = array();
    }

    // Verifica se o produto já está no carrinho
    if (!isset($_SESSION['carrinho'][$idProduto])) {
        // Obtém as informações do produto do banco de dados
        $produto = obterInformacoesDoProdutoPorID($idProduto);

        // Verifica se o produto existe no banco de dados
        if ($produto) {
            // Adiciona o produto ao carrinho
            $_SESSION['carrinho'][$idProduto] = $produto;

            // Retorna uma resposta de sucesso
            echo json_encode(array('status' => 'success', 'message' => 'Produto adicionado ao carrinho com sucesso!'));
        } else {
            // Retorna uma resposta de erro se o produto não foi encontrado no banco de dados
            echo json_encode(array('status' => 'error', 'message' => 'Produto não encontrado no banco de dados.'));
        }
    } else {
        // Retorna uma resposta informando que o produto já está no carrinho
        echo json_encode(array('status' => 'error', 'message' => 'O produto já está no carrinho.'));
    }
} else {
    // Retorna uma resposta de erro se o ID do produto não foi recebido
    echo json_encode(array('status' => 'error', 'message' => 'ID do produto não recebido.'));
}
?>
