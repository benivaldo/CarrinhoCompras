-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 21-Jan-2018 às 20:50
-- Versão do servidor: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `compras`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(1, 'Brinquedos'),
(3, 'Eletrônicos'),
(2, 'Games'),
(4, 'Informática');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `numero` int(11) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `cep` char(8) NOT NULL,
  `estado` char(2) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `logradouro`, `numero`, `bairro`, `cep`, `estado`, `cidade`, `email`) VALUES
(1, 'José Benivaldo Lima da Silva', 'Av. Salvador Jorge Velho', 130, 'Pque São Rafael', '08310480', 'SP', 'São Paulo', 'jose.benivaldo@email.com'),
(2, 'Maria Antônia Lopes', 'Av. Salvador Jorge Velho', 150, 'Pque São Rafael', '08310480', 'Sp', 'São Paulo', 'maria.antonia@email.copm');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `date_create` date NOT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `cliente_id`, `date_create`, `status`) VALUES
(20, 1, '2018-01-21', 'Aguardando pagamento'),
(21, 2, '2018-01-21', 'Aguardando pagamento'),
(22, 2, '2018-01-21', 'Aguardando pagamento'),
(23, 1, '2018-01-21', 'Aguardando pagamento');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido_itens`
--

CREATE TABLE `pedido_itens` (
  `id_item` bigint(20) UNSIGNED NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `pedido_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pedido_itens`
--

INSERT INTO `pedido_itens` (`id_item`, `codigo`, `quantidade`, `valor`, `total`, `pedido_id`) VALUES
(24, '400', 1, '1500.00', '1500.00', 20),
(25, '200', 1, '160.00', '160.00', 20),
(26, '100', 1, '160.00', '160.00', 20),
(27, '600', 1, '2400.00', '2400.00', 21),
(28, '500', 1, '3500.00', '3500.00', 21),
(29, '500', 1, '3500.00', '3500.00', 22),
(30, '500', 1, '3500.00', '3500.00', 23);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(20) UNSIGNED NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `quantidade` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `codigo`, `nome`, `descricao`, `valor`, `imagem`, `quantidade`) VALUES
(1, '100', 'Injustice - Xbox One', 'Desenvolva e fortaleça a versão definitiva de suas lendas favoritas da Dc em Injustice 2. Com uma grande variedade de super-heróis e supervilões da Dc, Injustice 2 permite personalizar cada um dos personagens icônicos com equipamentos únicos e potentes. Controle o visual, o estilo de combate e o desenvolvimento dos seus personagens favoritos em uma grande variedade de modos de jogo. Esta é a sua lenda. Sua jornada. Seu Injustice.\r\n', '160.00', 'imagens/132114843_1GG.jpg', 1),
(2, '200', 'Forza 7 - Xbox One', 'Data de lançamento: 03 de Outubro de 2017 Venha correr no jogo mais esperado da categoria. São mais de 700 carros e 200 diferentes configurações de pistas, em mais de 30 locais ao redor do mundo. Forza Motorsport 7 inclui um sistema de clima totalmente dinâmico contando com simulação de areia, chuva e vento durante a corrida. Além disso, permite diversas customizações para deixar o jogo do seu jeito.', '160.00', 'imagens/132532885_1GG.jpg', 1),
(3, '300', 'PUBG - Xbox One', 'Dos criadores do fenômeno de vendas para computador, o PlayerUnknown\'s Battlegrounds leva os jogadores a uma batalha de sobrevivência competitiva, onde você lutará freneticamente para ser o último jogador vivo. Saqueie suprimentos, encontre armas e equipamentos para enfrentar o inimigo em uma partida jogada sozinho ou em equipe. Saia como o único sobrevivente em uma experiência eletrizante de jogo, cheia de momentos inesperados de adrenalina.', '100.00', 'imagens/132794560_1GG.jpg', 1),
(4, '400', 'Console - Xbox One S', 'X-Box One console da Microsoft, com 500GB de armazenamento.', '1500.00', 'imagens/31036327G1.jpg', 1),
(5, '500', 'Iphone 8', 'Design todo em vidro. Câmeras avançadas. Chip A11 Bionic. Recarga sem fio(1).\r\nO iPhone 8 é uma nova geração do iPhone. Ele tem o vidro mais resistente da categoria, moldura reforçada de alumínio aeroespacial, recarga sem fio integrada(1) e resistência à água e poeira(2). A tela Retina HD de 4,7 polegadas tem True Tone(3) e a câmera de 12 MP conta com novo sensor e um processador de imagem avançado. Tudo isso só é possível graças ao A11 Bionic, o chip mais inteligente e poderoso em um smartphone, que também dá vida a apps e jogos incríveis em realidade aumentada. O iPhone 8 é brilhante. Em todos os sentidos. ', '3500.00', 'imagens/132651745G1.jpg', 1),
(6, '600', 'Notebook Samsung Expert X23 ', 'Samsung Expert X23 possui processador Intel Core i5, Sistema operacional Windows 10 com 8GB de memória RAM, HD de 1TB e tela LED HD de 15.6\'.\r\n', '2400.00', 'imagens/132538283G1.jpg', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_categoria`
--

CREATE TABLE `produto_categoria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produto_codigo` varchar(255) NOT NULL,
  `categoria_nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto_categoria`
--

INSERT INTO `produto_categoria` (`id`, `produto_codigo`, `categoria_nome`) VALUES
(1, '100', 'Games'),
(8, '200', 'Games'),
(9, '300', 'Games'),
(3, '400', 'Brinquedos'),
(2, '400', 'Games'),
(11, '500', 'Eletrônicos'),
(13, '600', 'Informática');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(10) UNSIGNED DEFAULT NULL,
  `pwd_reset_token` varchar(32) DEFAULT NULL,
  `pwd_reset_token_creation_date` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `email`, `full_name`, `password`, `status`, `pwd_reset_token`, `pwd_reset_token_creation_date`, `date_created`) VALUES
(0, 'admin@example.com', 'Admin', '$2y$10$bGDt.Uukz0/yZlrT26Ay4.UzhCsNlYRCbAun5s3b1B5o4mXnprQta', 1, NULL, NULL, '2018-01-21 13:24:04'),
(1, 'jose.benivaldo@email.com', 'Jose Benivaldo Lim da Silva', '$2y$10$ICPBa6/kLKTGsAV2R/88AuRm0rr20JiWMLbePZRI8tOoqbWlNzxmG', 1, NULL, NULL, '2018-01-21 00:00:00'),
(2, 'maria.antonia@email.com', 'Maria Antonia Lopes', '$2y$10$ICPBa6/kLKTGsAV2R/88AuRm0rr20JiWMLbePZRI8tOoqbWlNzxmG', 1, NULL, NULL, '2018-01-21 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `pedido_itens`
--
ALTER TABLE `pedido_itens`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `pedido_id` (`pedido_id`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indexes for table `produto_categoria`
--
ALTER TABLE `produto_categoria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `produto_codigo` (`produto_codigo`,`categoria_nome`),
  ADD KEY `categoria_nome` (`categoria_nome`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `pedido_itens`
--
ALTER TABLE `pedido_itens`
  MODIFY `id_item` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `produto_categoria`
--
ALTER TABLE `produto_categoria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `pedido_itens`
--
ALTER TABLE `pedido_itens`
  ADD CONSTRAINT `pedido_itens_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`);

--
-- Limitadores para a tabela `produto_categoria`
--
ALTER TABLE `produto_categoria`
  ADD CONSTRAINT `produto_categoria_ibfk_1` FOREIGN KEY (`produto_codigo`) REFERENCES `produtos` (`codigo`),
  ADD CONSTRAINT `produto_categoria_ibfk_2` FOREIGN KEY (`categoria_nome`) REFERENCES `categorias` (`nome`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
