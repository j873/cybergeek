<?php 
session_start();
require_once('conexao/conexao.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <div>
            <label for="pag">Selecione a sua forma de pagamento</label>
            <select name="opcao" id="opcao">
                <option value="pix">PIX</option>
                <option value="boleto">BOLETO</option>
                <option value="credito">CARTÃO DE CREDITO</option>
                <option value="debito">CARTÂO DE DEBITO</option>
            </select>
            <button class="" type="submit" id="" >selecione</button>
        </div>
    </form>
    <a href="index.php">Voltar para tela principal</a>
</body>
</html>