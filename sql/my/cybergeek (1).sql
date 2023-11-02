-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/11/2023 às 01:16
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cybergeek`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `apelido` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(14) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `adm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `apelido`, `email`, `telefone`, `senha`, `adm`) VALUES
(3, 'juan', 'peneira', 'jd9730541@gmail.com', '41989026701', '$2y$10$fxcQih/jaOQxLTeZ.GXBL.lVeX8IPkXh5oogAB8XsgUFd5Uj4ioj2', 0),
(4, 'queijo', 'peneira', 'te@gmail.com', '41989026701', '$2y$10$2DoBLbU/kA9dbVgX4mIpquq6DNPbZlmOuwpRebt0DfZjTNuEgjMLm', 1),
(5, 'pinheiro', '', 'q12d@gmail.com', '', '$2y$10$.2VgNdvTC9WK6D189h.iPOIDl0GREPVAfBKZ.7XQlTqyR8irPnog.', 0),
(6, 'Esmeralda', 'piromaniaco', 'q12d@gmail.com', '41989026701', '$2y$10$/bjRpITomOxTQunjBfK5beuudlQ4sJgODoCcVT6FcCGjiR8nMKgay', 0),
(7, 'teste', 'main vayne', 'teste@gmail.com', '41989026701', '$2y$10$9rIk8gfGHjAkjl5BAewKTOUcjnWwqSyVGtaSgtnobTeo0.Gq.FZoG', 0),
(8, 'jonas', 'piromaniaco', 'jd@gmail.com', '41989026701', '$2y$10$2WO1iERxOhVTFXd1naBXCu50C5S3LsJ3bpTtjw/9YMJ19YK7lRx.O', 0),
(9, 'junior', 'pique', '12@gmail.com', '41989026701', '$2y$10$aDjqkHbzcoco.L7xBzG36.RWeNjH7Qo.FrFgzHpWxpUH.jfEk6YSK', 0),
(10, 'pipoca', 'NÓS', 'Nos@gmail.com', '41989026701', '$2y$10$Y5QeZnme3gGI.MaRT3AUGOy4UpyLLECq69NCdmpVolXpzLy0INgzW', 0),
(11, 'viola davis', 'É', 'Davis@gmail.com', '41989026701', '$2y$10$LlQjhJ7GL00xhziCgY7XwOk4/.xBnlK4HaFKLjUScSQaKISaIZ8U6', 0),
(12, 'Esmeralda', 'NÓS', 'q1211d@gmail.com', '41989026701', '$2y$10$f6zYxshrTc6kwBuAqaZza.1HpGlSnJs4V6opt92V.ajHaE7iMP04.', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto_compras`
--

CREATE TABLE `produto_compras` (
  `id_produto` int(11) NOT NULL,
  `nome_produto` varchar(255) NOT NULL,
  `preco_produto` varchar(255) NOT NULL,
  `qatd_produto` int(11) NOT NULL,
  `img_produto` varchar(255) NOT NULL,
  `descri` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto_compras`
--

INSERT INTO `produto_compras` (`id_produto`, `nome_produto`, `preco_produto`, `qatd_produto`, `img_produto`, `descri`, `tipo`) VALUES
(6, 'Funko Pop do Harry Potter', '79', 4, 'img/funko.pop_luna.jpg', 'Funko da personagem Luna da serie Harry potter ', 'Funko Pop'),
(7, 'Action figure do Naruto', '679', 5, 'img/figure_itachi.webp', 'Action figure do Personagem Itachi da serie Naruto', 'action figure'),
(8, 'Moletom do Naruto', '69', 5, 'img/images.png', 'moletom da Akatsuki ', 'roupa'),
(9, 'Quadro de Anime ', '50', 9, 'img/images (2).jpeg', 'vem com um Quadro aleatório de anime ', 'decoração'),
(10, 'Funko do Mydoria ', '149', 11, 'img/funko_midoriya.webp', 'Funko do My hero Academia, do personagem Mydoria ', 'Funko Pop'),
(11, 'Funko do One Piece', '123', 5, 'img/funko_zoro].webp', 'Funko Pop do Zoro de One Piece', 'Funko Pop'),
(12, 'Camiseta manga longa ', '120', 5, 'img/longa-jojo-bohemian-rhapsody-frente.jpg', 'Camiseta manga longa de Jojo', 'roupa');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produto_compras`
--
ALTER TABLE `produto_compras`
  ADD PRIMARY KEY (`id_produto`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `produto_compras`
--
ALTER TABLE `produto_compras`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
