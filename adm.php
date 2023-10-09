<?php
session_start();

if (!isset($_SESSION['nome'])) {
    header("Location: ../index.php");
    exit();
}

$login = $_SESSION['nome'];

require_once('classe/produ.php');
require_once('conexao/conexao.php');

$database = new Conection();
$db = $database->getConnection();
$crud = new CrudProduto($db);

// Solicitações do usuário
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'create':
            $crud->create($_POST);
            $rows = $crud->read(); // atualiza a variável $rows após a criação de um novo registro
            break;
        case 'read':
            $rows = $crud->read();
            break;
        default:
            $rows = $crud->read();
            break;
    }
} else {
    $rows = $crud->read();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard ADM</title>
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</head>

<body>
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
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Não há registros a serem exibidos.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Inclua os arquivos JavaScript do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script>

	<footer class="footer">
        <?php include_once('view/footer.php'); ?>
	</footer>
</body>

</html>