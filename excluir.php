<?php
session_start();

if (isset($_POST['id_produto'])) {
    $idProdutoExcluir = $_POST['id_produto'];

    // Remova o item do carrinho
    if (isset($_SESSION['carrinho'][$idProdutoExcluir])) {
        unset($_SESSION['carrinho'][$idProdutoExcluir]);
    }
}


?>