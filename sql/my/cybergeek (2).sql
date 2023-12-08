-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/12/2023 às 01:58
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
-- Estrutura para tabela `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `NF` int(11) NOT NULL,
  `proc_entrega` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
(10, 'Funko do Mydoria ', '149', 11, 'img/funko_midoriya.webp', 'Funko do My hero Academia, do personagem Mydoria ', 'Funko Pop');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `apelido` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(14) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `adm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `apelido`, `email`, `telefone`, `senha`, `adm`) VALUES
(3, 'juan', 'peneira', 'jd9730541@gmail.com', '41989026701', '$2y$10$fxcQih/jaOQxLTeZ.GXBL.lVeX8IPkXh5oogAB8XsgUFd5Uj4ioj2', 0),
(4, 'queijo', 'peneira', 'te@gmail.com', '41989026701', '$2y$10$2DoBLbU/kA9dbVgX4mIpquq6DNPbZlmOuwpRebt0DfZjTNuEgjMLm', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_produto` (`id_produto`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `produto_compras`
--
ALTER TABLE `produto_compras`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produto_compras`
--
ALTER TABLE `produto_compras`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_produto`) REFERENCES `produto_compras` (`id_produto`),
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
