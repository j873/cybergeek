<?php
// include('conexao/conexao.php');

    class Carrinho{
        public $id_produto;
        public $nome_produto;
        public $descri;
        public $preco_produto;
        public $img_produto;

        public function __construct($id_produto, $nome_produto, $descri, $preco_produto, $img_produto){
            $this->id_produto = $id_produto;
            $this->nome_produto = $nome_produto;
            $this->descri= $descri;
            $this->preco_produto = $preco_produto;
            $this->img_produto = $img_produto;
        }


        public function getCarrinho()
        {
             $_SESSION['carrinho'][$this->id_produto] = [
                'id_produto' => "{$this->id_produto}",
                'nome_produto' => "{$this->nome_produto}",
                'descri' => "{$this->descri}",
                'preco_produto' => "{$this->preco_produto}",
                'img_produto' => "{$this->img_produto}"
            ];

            // print_r($_SESSION);

           
            
        }

    
    }


?>