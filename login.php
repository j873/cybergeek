<?php
session_start();

require_once('classe/classe.php');
require_once('conexao/conexao.php');

$database = new Conection();
$db = $database->getConnection();
$classUsuario = new Cliente($db);

if(isset($_POST['logar'])){
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    

    if($classUsuario->logar($login, $senha)){
        if($classUsuario->verificarAdm($login)){
            $_SESSION['nome'] = $login;
            $_SESSION['adm'] = true; 
            header("Location: adm.php");
            exit();
        }else{
            $_SESSION['nome'] = $login;
            header("Location: index.php");
            exit();
        }
       
    }else{
        echo "<script>alert('Login inválido')</script>";
    }

}

?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


   
</body>
</html>