<?php
include_once('conexao/conexao.php');
include_once('classe/classe.php');

$database = new Conection();
$db = $database->getConnection();
$cliente = new Cliente($db);

if (isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $apelido = $_POST['apelido'];
    $email =  $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha =  $_POST['senha'];
    $confsenha =  $_POST['confsenha'];

    if ($cliente->cadastrar($nome,$apelido,$email,$telefone, $senha, $confsenha)) {
        print "<script>alert ('Cadastro realizado com sucesso')</script>";
    } else {
        print "<script>alert ('Erro ao cadastrar!')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>

<body>
    <h2>Criar Conta</h2>
</body>
<form method="post">
    <label for="nome">Nome</label>
    <input type="text" name="nome" id="nome" placeholder="Digite seu nome" required>

    <label for="apelido">Apelido</label>
    <input type="text" name="apelido" id="apelido" placeholder="Digite um nome alternativo" required>

    <label for="email">E-mail</label>
    <input type="email" name="email" id="email" placeholder="Digite seu E-mail" required>

    <label for="telefone">Telefone</label>
    <input type="tel" name="telefone" id="telefone" placeholder="Digite seu Telefone" required>

    <label for="senha">Senha</label>
    <input type="password" name="senha" id="senha" placeholder="Digite sua senha"  pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\W+)(?=^.{8,50}$).*$" required>

    <label for="confsenha">Confirmar Senha</label>
    <input type="password" name="confsenha" id="confsenha" required>

    <button type="submit" name="cadastrar">Criar Conta</button>
</form>
<a href="login.php">Voltar para Tela de login</a>

</html>
