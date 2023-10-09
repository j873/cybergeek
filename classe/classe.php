<?php
include_once('conexao/conexao.php');

$db = new Conection();

class Cliente
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function cadastrar($nome, $email, $senha,$confSenha)
    {

        if ($senha === $confSenha) {

            $verificarExistente = $this->verificarExistente($nome, $email);
            if ($verificarExistente) {
                print "<script>alert('Email ou Nome de usuario ja cadastrado!')</script>";
                return false;
            }


            $senhaCrip = password_hash($senha, PASSWORD_DEFAULT);

            $query = "INSERT  cliente (nome,email,senha) VALUES (?,?,?)";

            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(1, $nome);
            $stmt->bindValue(2, $email);
            $stmt->bindValue(3, $senhaCrip);
            $result = $stmt->execute();

            return $result;
        }
    }

    public function verificarExistente($nome, $email)
    {
        $query = "SELECT COUNT(*) FROM usuarios WHERE nome = ? and email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $nome);
        $stmt->bindValue(2, $email);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }

    public function logar($email, $senha)
    {
        $sql = "SELECT * FROM cliente WHERE email = :email";
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
        $query = "SELECT adm FROM cliente WHERE  email = :email OR nome = :nome ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':email', $login);
        $stmt->bindValue(':nome', $login);
        

        if ($stmt->rowCount() == 1) {
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuario['adm'] == 1;
        }

        return false;
    }
}
