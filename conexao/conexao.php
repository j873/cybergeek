<?php
class Conection{
    private $host = "localhost";
    private $usuario = "root";
    private $senha = "";
    private $banco = "cybergeek";
    public $conn;

    public function getConnection(){
        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=". $this->host.";dbname=". $this->banco,$this->usuario,$this->senha);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            echo "";
        }catch(PDOException $e){
            echo "Erro na conexão: " . $e->getMessage();
        }

        return $this->conn;
    }
}
