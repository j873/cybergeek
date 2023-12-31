<?php
include('conexao/conexao.php');

$db = new Conection();

class CrudProduto
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function create($postValue)
    {
        $nome_produto = $postValue['nome_produto'];
        $tipo = $postValue['tipo'];
        $qatd_produto = $postValue['qatd_produto'];
        $descri = $postValue['descri'];
        $preco_produto = $postValue['preco_produto'];

        $nome_produto = isset($postValue['nome_produto']) ? $postValue['nome_produto'] : '';
        $tipo = isset($postValue['tipo']) ? $postValue['tipo'] : '';
        $qatd_produto = isset($postValue['qatd_produto']) ? $postValue['qatd_produto'] : '';
        $descri = isset($postValue['descri']) ? $postValue['descri'] : '';
        $preco_produto = isset($postValue['preco_produto']) ? $postValue['preco_produto'] : '';

        if (isset($_FILES['img_produto'])) {
            $arquivo = $_FILES['img_produto'];
            $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
            $ex_permitidos = array('jpg', 'jpeg', 'png', 'gif', 'webp');

            if (in_array(strtolower($extensao), $ex_permitidos)) {
                $caminho_arquivo = 'img/' . $arquivo['name'];
                move_uploaded_file($arquivo['tmp_name'], $caminho_arquivo);
            } else {
                die('Você não pode fazer upload desse tipo de arquivo');
            }
        } else {
            $caminho_arquivo = ''; // Se nenhum arquivo foi enviado, defina o caminho como vazio
        }


        $query = "INSERT INTO produto_compras (nome_produto, tipo, qatd_produto,descri,preco_produto, img_produto) VALUES (?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nome_produto);
        $stmt->bindParam(2, $tipo);
        $stmt->bindParam(3, $qatd_produto);
        $stmt->bindParam(4, $descri);
        $stmt->bindParam(5, $preco_produto);
        $stmt->bindParam(6, $caminho_arquivo);


        $rows = $this->read();
        if ($stmt->execute()) {
            print "<script> alert('Cadastro realizado com sucesso!!! ')</script>";
            print "<script>  location.href='?action=read';</script>";
            return true;
        } else {
            return false;
        }
    }


    public function read()
    {
        $query = "SELECT * FROM produto_compras";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function search($searchTerm, $fields = ['nome_produto', 'preco_produto', 'tipo'])
    {
        try {
            $conditions = [];
            foreach ($fields as $field) {
                $conditions[] = "$field LIKE :search";
            }

            $query = "SELECT * FROM produto_compras WHERE " . implode(" OR ", $conditions);

            $stmt = $this->conn->prepare($query);
            $searchTerm = "%" . $searchTerm . "%";
            $stmt->bindParam(":search", $searchTerm, PDO::PARAM_STR);
            $stmt->execute();

            // Retorna os resultados em vez do statement
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Tratamento de erros (pode ser personalizado conforme necessário)
            die("Erro na busca: " . $e->getMessage());
        }
    }
    // Método para excluir um produto pelo ID
    public function delete($idProduto)
    {
        try {
            $query = "DELETE FROM produto_compras WHERE id_produto = :id_produto";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_produto', $idProduto, PDO::PARAM_INT);
            $stmt->execute();

            // Verifica se alguma linha foi afetada (se o produto existia)
            if ($stmt->rowCount() > 0) {
                return true; // Exclusão bem-sucedida
            } else {
                return false; // Produto não encontrado
            }
        } catch (PDOException $e) {
            // Exibe mensagens de erro específicas
            die("Erro na exclusão do produto: " . $e->getMessage());
        }
    }
}
