<?php

// Inclua a lógica de conexão com o banco de dados aqui
// Substitua os valores conforme necessário (host, dbname, usuário, senha)
$host = "localhost";
$dbname = "cybergeek";
$usuario = "root";
$senha = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $usuario, $senha);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

// Função de busca
function search($conn, $searchTerm)
{
    try {
        $query = "SELECT * FROM produto_compras WHERE nome_produto LIKE :search OR preco_produto LIKE :search OR tipo LIKE :search";
        $stmt = $conn->prepare($query);
        $searchTerm = "%" . $searchTerm . "%";
        $stmt->bindParam(":search", $searchTerm, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Tratamento de erros (pode ser personalizado conforme necessário)
        die("Erro na busca: " . $e->getMessage());
    }
}

// Função de filtro por tipo
function filterByType($conn, $tipo)
{
    try {
        $query = "SELECT * FROM produto_compras WHERE tipo = :tipo";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Tratamento de erros (pode ser personalizado conforme necessário)
        die("Erro ao filtrar por tipo: " . $e->getMessage());
    }
}

// Processar o formulário
if (isset($_GET['searchTerm']) || isset($_GET['tipo'])) {
    if (isset($_GET['searchTerm'])) {
        $searchTerm = $_GET['searchTerm'];

        // Chame a função de busca
        $resultados = search($conn, $searchTerm);

        // Exiba os resultados ou faça o que quiser com eles
        if (!empty($resultados)) {
            echo "<h2>Resultados da Busca:</h2>";
            foreach ($resultados as $resultado) {
                echo "<p>Nome: " . $resultado['nome_produto'] . ", Preço: " . $resultado['preco_produto'] . ", Tipo: " . $resultado['tipo'] . "</p>";
            }
        } else {
            echo "<p>Nenhum resultado encontrado para a busca: $searchTerm</p>";
        }
    } elseif (isset($_GET['tipo'])) {
        $tipo = $_GET['tipo'];

        // Chame a função de filtro por tipo
        $resultados = filterByType($conn, $tipo);

        // Exiba os resultados ou faça o que quiser com eles
        if (!empty($resultados)) {
            echo "<h2>Resultados do Filtro por Tipo:</h2>";
            foreach ($resultados as $resultado) {
                echo "<p>Nome: " . $resultado['nome_produto'] . ", Preço: " . $resultado['preco_produto'] . ", Tipo: " . $resultado['tipo'] . "</p>";
            }
        } else {
            echo "<p>Nenhum resultado encontrado para o tipo: $tipo</p>";
        }
    }
}
