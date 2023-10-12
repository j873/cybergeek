<?php
require_once('classe/classe.php');
require_once('conexao/conexao.php');

$database = new Conection();
$db = $database->getConnection();
$classUsuario = new Cliente($db);


if (isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $apelido = $_POST['apelido'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $confSenha = $_POST['confSenha'];

    if ($classUsuario->cadastrar($nome,  $email,  $senha, $confSenha, $telefone, $apelido)) {
        print "<script> alert('Cadastro efetuado com sucesso!')</script>";
    } else {
        print "<script> alert('Erro ao Cadastrar')</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</head>

<body>

    <?php include_once('view/header.php'); ?>


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center">Criar Conta</h2>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome de Usuário</label>
                                <input type="text" class="form-control" name="nome" id="nome" required>
                            </div>
                            <div class="mb-3">
                                <label for="apelido" class="form-label">Apelido do ususario</label>
                                <input type="text" class="form-control" name="apelido" id="apelido" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                            <div class="mb-3">
                                <label for="telefone" class="form-label">Telefone do Usuário</label>
                                <input type="text" class="form-control" name="telefone" id="telefone" required>
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" class="form-control" name="senha" id="senha" required>
                            </div>
                            <div class="mb-3">
                                <label for="confSenha" class="form-label">Confirmar Senha</label>
                                <input type="password" class="form-control" name="confSenha" id="confSenha" required>
                            </div>
                            <button type="submit" name="cadastrar" class="btn btn-primary btn-block">Criar Conta</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>