<?php
session_start();

if (!isset($_SESSION['nome'])) {
    header("Location: .../index.php");
    exit();
}

$login = $_SESSION['nome'];

require_once('classe/produ.php');
require_once('conexao/conexao.php');

$database = new Conection();
$db = $database->getConnection();
$crud = new CrudProduto($db);

// Verifica se uma requisição de remoção foi feita
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_produto'])) {
    $idProduto = $_POST['id_produto'];
    $remocaoSucesso = $crud->delete($idProduto);

    // Exibe mensagem de sucesso ou erro após a remoção
    if ($remocaoSucesso) {
        $mensagemRemocao = "Produto removido com sucesso!";
    } else {
        $mensagemRemocao = "Erro ao remover o produto. Verifique se o produto existe.";
    }
}

// Lê os produtos após a remoção (ou normalmente)
$rows = $crud->read();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard ADM</title>
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="adm">
    <div class="container mt-5">
        <h1 class="text-center">Painel de Controle do ADM</h1>
        <p class="text-center">Seja bem-vindo, <?php echo $login; ?></p>
        <a href="logout.php" class="btn btn-danger float-right">Sair</a>

        <form method="POST" action="?action=create" enctype="multipart/form-data" class="mt-5">
            <div class="mb-3">
                <label for="nome_produto" class="form-label">Nome do Produto</label>
                <input type="text" name="nome_produto" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <select name="tipo" class="form-select">
                    <option value="roupa">Roupa</option>
                    <option value="action figure">Action figure</option>
                    <option value="decoração">decoração</option>
                    <option value="Funko Pop">Funko Pop</option>
                    <option value="cosplay">Cosplay</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="qatd_produto" class="form-label">Quantidade do Produto</label>
                <input type="number" name="qatd_produto" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="descri" class="form-label">Descrição</label>
                <input type="text" name="descri" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="preco_produto" class="form-label">Preço do Produto</label>
                <input type="number" name="preco_produto" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="img_produto" class="form-label">Foto do Produto</label>
                <input type="file" name="img_produto" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary float-right">Cadastrar</button>
        </form>

        <table class="table mt-5">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome do Produto</th>
                    <th>Tipo</th>
                    <th>Qtda de Produtos</th>
                    <th>Descrição</th>
                    <th>Caminho Imagem</th>
                    <th>Preço do Produto</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($rows)) {
                    foreach ($rows as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['id_produto'] . "</td>";
                        echo "<td>" . $row['nome_produto'] . "</td>";
                        echo "<td>" . $row['tipo'] . "</td>";
                        echo "<td>" . $row['qatd_produto'] . "</td>";
                        echo "<td>" . $row['descri'] . "</td>";
                        echo "<td>" . $row['img_produto'] . "</td>";
                        echo "<td>" . $row['preco_produto'] . "</td>";

                        // Botão de Remover
                        echo "<td>
                                <form method='post'>
                                    <input type='hidden' name='id_produto' value='" . $row['id_produto'] . "'>
                                    <button type='submit' class='btn btn-danger btn-sm'>Remover</button>
                                </form>
                            </td>";

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Não há registros a serem exibidos.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Inclua os arquivos JavaScript do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script>

    <body>
        <footer class="bg-dark text-light text-center py-3">
            <div class="container">
                <p>&copy; <?php echo date("Y"); ?> Seu E-commerce. Todos os direitos reservados.</p>
            </div>
        </footer>
    </body>
</body>

</html>