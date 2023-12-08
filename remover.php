// remover_produto.php

<?php
session_start();

if (!isset($_SESSION['nome'])) {
    header("Location: .../index.php");
    exit();
}

require_once('classe/produ.php');
require_once('conexao/conexao.php');

$database = new Conection();
$db = $database->getConnection();
$crud = new CrudProduto($db);

// Verifica se o ID do produto foi enviado por POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_produto'])) {
    $idProduto = $_POST['id_produto'];

    // Chama o método de exclusão
    if ($crud->delete($idProduto)) {
        $_SESSION['mensagem'] = "Produto removido com sucesso.";
    } else {
        $_SESSION['mensagem'] = "Produto não encontrado.";
    }
} else {
    $_SESSION['mensagem'] = "ID do produto não recebido.";
}

// Redireciona de volta para a página do painel de controle
header("Location: adm.php");
exit();
?>