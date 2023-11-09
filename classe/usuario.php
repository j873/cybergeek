<?php
include_once('conexao/conexao.php');

$db = new Conection();

class Usuario
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function cadastrar($nome, $email, $senha, $confSenha, $telefone, $apelido)
    {

        if ($senha === $confSenha) {

            $verificarExistente = $this->verificarExistente($nome, $email);
            if ($verificarExistente) {
                print "<script>alert('Email ou Nome de usuario ja cadastrado!')</script>";
                return false;
            }


            $senhaCrip = password_hash($senha, PASSWORD_DEFAULT);

            $query = "INSERT  usuario (nome,email,senha,apelido,telefone) VALUES (?,?,?,?,?)";

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(1, $nome);
            $stmt->bindValue(2, $email);
            $stmt->bindValue(3, $senhaCrip);
            $stmt->bindValue(4, $apelido);
            $stmt->bindValue(5, $telefone);
            $result = $stmt->execute();

            return $result;
        }
    }

    public function verificarExistente($nome, $email)
    {
        $query = "SELECT COUNT(*) FROM usuario WHERE nome = ? and email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $nome);
        $stmt->bindValue(2, $email);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }

    public function logar($email, $senha)
    {
        $sql = "SELECT * FROM usuario WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($senha, $cliente['senha'])) {
                return true;
            }
        }
        return false;
    }

    public function verificarAdm($login)
    {
        $query = "SELECT adm FROM usuario WHERE  email = :email OR apelido = :apelido ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':email', $login);
        $stmt->bindValue(':apelido', $login);


        if ($stmt->rowCount() == 1) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuario['adm'] == 1;
        }

        return false;
    }
    
}
