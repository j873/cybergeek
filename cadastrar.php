<?php
require_once('classe/usuario.php');
require_once('conexao/conexao.php');

$database = new Conection();
$db = $database->getConnection();
$classUsuario = new Usuario($db);

if (isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $apelido = $_POST['apelido'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $confSenha = $_POST['confSenha'];

    if ($classUsuario->cadastrar($nome,  $email,  $senha, $confSenha, $telefone, $apelido)) {
        header("Location: login.php");
        exit;
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
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <?php include_once('view/header_main.php'); ?>



    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center">Criar Conta</h2>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome do Usuário</label>
                                <input type="text" class="form-control" name="nome" id="nome" required>
                            </div>
                            <div class="mb-3">

                                <label for="apelido" class="form-label">Apelido do usuario</label>
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
                                <input type="password" class="form-control" name="senha" id="senha" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$" required>
                            </div>
                            <div class="mb-3">
                                <label for="confSenha" class="form-label">Confirmar Senha</label>
                                <input type="password" class="form-control" name="confSenha" id="confSenha" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$" required>
                            </div>
                            <button type="submit" name="cadastrar" class="btn btn-primary btn-block" id="botao">Criar Conta</button>
                            <button onclick="redirecionarParaLogin()" class="btn btn-primary btn-block">Se cadastre que aqui</button>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function redirecionarParaLogin() {
            // Redireciona para a página de login
            window.location.href = "login.php";
        }
    </script>
</body>

</html>