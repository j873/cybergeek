<?php
session_start();

require_once('classe/usuario.php');
require_once('conexao/conexao.php');

$database = new Conection();
$db = $database->getConnection();
$classUsuario = new Usuario($db);

if (isset($_POST['logar'])) {
    $login = $_POST['login'];
    $senha = $_POST['senha'];



    if ($classUsuario->logar($login, $senha)) {
        $infoUsuario = $classUsuario->obterInformacoesUsuario($login); // Substitua 'obterInformacoesUsuario' pelo método correto que retorna as informações do usuário
        if ($classUsuario->verificarAdm($login)) {
            $_SESSION['nome'] = $login;
            $_SESSION['adm'] = true;
            header("Location: adm.php");
            exit();
        } else {
            $_SESSION['nome'] = $infoUsuario['nome'];
            $_SESSION['apelido'] = $infoUsuario['apelido']; // Adicione essa linha para definir o apelido na sessão
    
            header("Location: index.php");
            exit();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
                        <h2 class="card-title text-center">Login</h2>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="login" class="form-label">Nome de Usuário ou E-mail</label>
                                <input type="text" class="form-control" name="login" id="login" required>
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" class="form-control" name="senha" id="senha" required>
                            </div>
                            <button type="submit" name="logar" class="btn btn-primary btn-block">Logar</button>
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
            window.location.href = "cadastrar.php";
        }
    </script>
</body>

</html>