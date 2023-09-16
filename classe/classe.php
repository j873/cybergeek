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

    public function cadastrar($nome, $apelido, $email, $telefone, $senha, $confsenha)
    {
        if ($senha === $confsenha) {
            $emailExistente = $this->verificarEmailExistente($email);
            $nomeExistente = $this->verificarNomeexistente($nome);
            if ($emailExistente || $nomeExistente) {
                print "<script> alert('Email e Nome já cadastrado')</script>";
                return false;
            }

            $SenhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

            $sql = "INSERT INTO cliente (nome,apelido, email,telefone, senha) VALUES (? ,? ,? ,?,?)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1, $nome);
            $stmt->bindValue(2, $apelido);
            $stmt->bindValue(3, $email);
            $stmt->bindValue(4, $telefone);
            $stmt->bindValue(5, $SenhaCriptografada);

            $result = $stmt->execute();

            return $result;
        } else {
            return false;
        }
    }

    private function verificarNomeexistente($nome)
    {
        $sql = "SELECT COUNT(*) FROM cliente WHERE nome = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $nome);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    private function verificarEmailExistente($email)
    {
        $sql = "SELECT COUNT(*) FROM cliente WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $email);
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
}
