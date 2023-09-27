<?php
// Inclua o arquivo de conexão
include_once('conexao/conexao.php');
include_once('classe/classe.php');

// Crie uma instância da classe de conexão ao banco de dados
$database = new Conection();

// Obtenha a conexão com o banco de dados
$db = $database->getConnection();

// Crie uma instância da classe Cliente, passando a conexão como parâmetro
$cliente = new Cliente($db);

// Verifique se o formulário de cadastro foi enviado
if (isset($_POST['cadastrar'])) {
    // Obtenha os dados do formulário
    $nome = $_POST['nome'];
    $apelido = $_POST['apelido'];
    $email =  $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha =  $_POST['senha'];
    $confsenha =  $_POST['confsenha'];

    // Verificar se as senhas coincidem
    if ($senha !== $confsenha) {
        // Se as senhas não coincidirem, exibir um alerta JavaScript
        echo "<script>alert('As senhas não coincidem. Por favor, digite novamente.')</script>";
    } else {
        // Chame o método "cadastrar" da classe Cliente para registrar o cliente
        if ($cliente->cadastrar($nome, $apelido, $email, $telefone, $senha, $confsenha)) {
            // Se o cadastro for bem-sucedido, exiba um alerta JavaScript
            echo "<script>alert('Cadastro realizado com sucesso')</script>";
        } else {
            // Se houver erro no cadastro, exiba um alerta JavaScript
            echo "<script>alert('Erro ao cadastrar!')</script>";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <!-- Vincule o arquivo CSS para estilizar a página -->
    <link rel="stylesheet" type="text/css" href="designe.css">
</head>

<body>
    <h2>Criar Conta</h2>
</body>
<form method="post">
    <!-- Campos de entrada para o cadastro -->
    <label for="nome">Nome</label>
    <input type="text" name="nome" id="nome" placeholder="Digite seu nome completo" required>

    <label for="apelido">Apelido</label>
    <input type="text" name="apelido" id="apelido" placeholder="Digite como quer ser chamado" required>

    <label for="email">E-mail</label>
    <input type="email" name="email" id="email" placeholder="Digite seu E-mail" required>

    <label for="telefone">Telefone</label>
    <input type="tel" name="telefone" id="telefone" placeholder="Digite seu Telefone" required>

    <label for="senha">Senha</label>
    <input type="password" name="senha" id="senha" placeholder="Digite sua senha"  pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\W+)(?=^.{8,50}$).*$" required>

    <label for="confsenha">Confirmar Senha</label>
    <input type="password" name="confsenha" id="confsenha" placeholder="Confirme sua senha"  pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\W+)(?=^.{8,50}$).*$" required>

    <!-- Botão de envio do formulário -->
    <button type="submit" name="cadastrar">Criar Conta</button>
</form>

<!-- Link para voltar para a tela de login -->
<a href="login.php">Voltar para Tela de login</a>

</html>