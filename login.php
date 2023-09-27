<?php
session_start();

require_once('classe/classe.php');
require_once('conexao/conexao.php');

$database = new Conection();
$db = $database->getConnection();
$cliente = new Cliente($db);

if(isset($_POST['logar'])){
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if($cliente->logar($email, $senha)){
        $_SESSION['email'] = $email;

        header("Location:index.php");
        exit();
    }else{
        print "<script>alert('Login invalido')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="desigen.css">
</head>

<body>
    <h2>Login</h2>
</body>
<form method="post">
    <label for="emai">E-mail</label>
    <input type="email" name="email" id="email" placeholder="Digite seu E-mail" required>

    <label for="senha">Senha:</label>
    <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>
    <button type="submit" name="logar">logar</button>
</form>
<a href="cadastrar.php" role="button">Criar Conta</a>

</html>