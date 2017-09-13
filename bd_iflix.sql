-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 13-Set-2017 às 03:47
-- Versão do servidor: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_iflix`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `episodio`
--

CREATE TABLE `episodio` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sinopse` text NOT NULL,
  `temporada_id` int(11) NOT NULL,
  `duracao` varchar(45) NOT NULL,
  `caminho` varchar(100) NOT NULL,
  `serie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `episodio`
--

INSERT INTO `episodio` (`id`, `nome`, `sinopse`, `temporada_id`, `duracao`, `caminho`, `serie_id`) VALUES
  (1, 'Piloto', 'aspdkaspodk', 1, 'adssa', 'asdweq', 0),
  (2, 'wqeqwe', 'qweqwe', 1, 'eqweqwe', 'qweqweqwe', 0),
  (3, 'Pilot greys', 'ewqeqweqwe', 3, '21312', '123123', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `filme`
--

CREATE TABLE `filme` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `classificacao` int(11) NOT NULL,
  `caminho` varchar(45) NOT NULL,
  `duracao` varchar(45) NOT NULL,
  `sinopse` text NOT NULL,
  `thumbnail` varchar(100) NOT NULL,
  `genero_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `filme`
--

INSERT INTO `filme` (`id`, `nome`, `classificacao`, `caminho`, `duracao`, `sinopse`, `thumbnail`, `genero_id`, `status`) VALUES
  (1, 'Um dia de amanha', 18, '31231', 'qweqwe', '12312qwdas', 'wqsaeqwe123', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `genero`
--

CREATE TABLE `genero` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `genero`
--

INSERT INTO `genero` (`id`, `nome`) VALUES
  (1, 'Terror'),
  (2, 'Terror');

-- --------------------------------------------------------

--
-- Estrutura da tabela `idioma_episodio`
--

CREATE TABLE `idioma_episodio` (
  `id` int(11) NOT NULL,
  `idioma` varchar(50) NOT NULL,
  `caminho` varchar(100) NOT NULL,
  `episodio_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `idioma_filme`
--

CREATE TABLE `idioma_filme` (
  `id` int(11) NOT NULL,
  `idioma` varchar(50) NOT NULL,
  `caminho` varchar(100) NOT NULL,
  `video_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `legenda_episodio`
--

CREATE TABLE `legenda_episodio` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `caminho` varchar(100) NOT NULL,
  `episodio_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `legenda_filme`
--

CREATE TABLE `legenda_filme` (
  `id` int(11) NOT NULL,
  `idioma` varchar(50) NOT NULL,
  `caminho` varchar(100) NOT NULL,
  `video_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `minha_lista_filme`
--

CREATE TABLE `minha_lista_filme` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `filme_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `minha_lista_filme`
--

INSERT INTO `minha_lista_filme` (`id`, `usuario_id`, `filme_id`) VALUES
  (1, 8, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `minha_lista_serie`
--

CREATE TABLE `minha_lista_serie` (
  `id` int(11) NOT NULL,
  `serie_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `minha_lista_serie`
--

INSERT INTO `minha_lista_serie` (`id`, `serie_id`, `usuario_id`) VALUES
  (1, 1, 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `serie`
--

CREATE TABLE `serie` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sinopse` text NOT NULL,
  `classificacao` int(11) NOT NULL,
  `thumbnail` varchar(100) NOT NULL,
  `genero_id` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `serie`
--

INSERT INTO `serie` (`id`, `nome`, `sinopse`, `classificacao`, `thumbnail`, `genero_id`, `status`) VALUES
  (1, 'How I met your mother', 'qweqweqadsdas', 14, 'qweqwadsdasd', 1, 1),
  (2, 'Greys Anatomy', 'dsasadaas', 14, 'qweqwewqwq', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `temporada`
--

CREATE TABLE `temporada` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `serie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `temporada`
--

INSERT INTO `temporada` (`id`, `numero`, `serie_id`) VALUES
  (1, 1, 1),
  (2, 2, 1),
  (3, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(180) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `isControleDosPais` tinyint(4) DEFAULT '0',
  `senha` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dataNascimento` date NOT NULL,
  `dataCriacao` date NOT NULL,
  `dataAlteracao` date NOT NULL,
  `status` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `avatar`, `isControleDosPais`, `senha`, `email`, `dataNascimento`, `dataCriacao`, `dataAlteracao`, `status`) VALUES
  (8, 'Marcio', 'avatares/default.png', 0, '$2y$10$sB1.GlH0bWTr5mY8TqP5f.DrIyMRJ2EyDfQ4UKGDkN4Jv8.ppBXFi', 'marciioluucas@gmail.com', '1998-02-11', '2017-09-05', '2017-09-05', 1),
  (9, 'Juanes Adriano', 'avatares/default.png', 0, '$2y$10$mnK1eKgDBrN.u3lB4TDnqud.nL4bVCF.AIHjcKxIp0ukwf3uuJ4oi', 'juaneshtk50@gmail.com', '1997-07-26', '2017-09-11', '2017-09-11', 1),
  (10, 'Marcio Lucas', 'avatares/default.png', 0, '$2y$10$weLlNbVWUj3BEYsAGFsVD.9mejsI.aCIF/uaU0UXM59iyfNrrL2G6', 'marciioluucas2@gmail.com', '1998-02-11', '2017-09-11', '2017-09-11', 1),
  (11, 'Teste teste', 'avatares/default.png', 0, '$2y$10$vbAEZ2N/nH1mIjQ.ReO/2em3luH0aeVzP5lTxq2iVhln/7JKwVoo.', 'teste@test.com', '1998-02-11', '2017-09-11', '2017-09-11', 1),
  (12, 'Marcio', 'avatares/default.png', 0, '$2y$10$g.ISpwCExr2KkUiCz/rxK.wPUfuoBnIm4aJN2ir87l66fdx.JqbFC', 'marciioluucas@hotmail.com', '1998-02-11', '2017-09-12', '2017-09-12', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `episodio`
--
ALTER TABLE `episodio`
  ADD PRIMARY KEY (`id`,`temporada_id`,`serie_id`),
  ADD KEY `fk_episodio_temporada1_idx` (`temporada_id`),
  ADD KEY `fk_episodio_serie1_idx` (`serie_id`);

--
-- Indexes for table `filme`
--
ALTER TABLE `filme`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_filme_genero1_idx` (`genero_id`);

--
-- Indexes for table `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `idioma_episodio`
--
ALTER TABLE `idioma_episodio`
  ADD PRIMARY KEY (`id`,`episodio_id`),
  ADD KEY `fk_idioma_serie_episodio1_idx` (`episodio_id`);

--
-- Indexes for table `idioma_filme`
--
ALTER TABLE `idioma_filme`
  ADD PRIMARY KEY (`id`,`video_id`),
  ADD KEY `fk_idioma_video_idx` (`video_id`);

--
-- Indexes for table `legenda_episodio`
--
ALTER TABLE `legenda_episodio`
  ADD PRIMARY KEY (`id`,`episodio_id`),
  ADD KEY `fk_legenda_serie_episodio1_idx` (`episodio_id`);

--
-- Indexes for table `legenda_filme`
--
ALTER TABLE `legenda_filme`
  ADD PRIMARY KEY (`id`,`video_id`),
  ADD KEY `fk_legenda_video1_idx` (`video_id`);

--
-- Indexes for table `minha_lista_filme`
--
ALTER TABLE `minha_lista_filme`
  ADD PRIMARY KEY (`id`,`usuario_id`),
  ADD KEY `fk_minha_lista_filme_usuario1_idx` (`usuario_id`),
  ADD KEY `fk_minha_lista_filme_filme1_idx` (`filme_id`);

--
-- Indexes for table `minha_lista_serie`
--
ALTER TABLE `minha_lista_serie`
  ADD PRIMARY KEY (`id`,`usuario_id`),
  ADD KEY `fk_minha_lista_serie_serie1_idx` (`serie_id`),
  ADD KEY `fk_minha_lista_serie_usuario1_idx` (`usuario_id`);

--
-- Indexes for table `serie`
--
ALTER TABLE `serie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_serie_genero1_idx` (`genero_id`);

--
-- Indexes for table `temporada`
--
ALTER TABLE `temporada`
  ADD PRIMARY KEY (`id`,`serie_id`),
  ADD KEY `fk_temporada_serie1_idx` (`serie_id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `episodio`
--
ALTER TABLE `episodio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `filme`
--
ALTER TABLE `filme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `genero`
--
ALTER TABLE `genero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `idioma_episodio`
--
ALTER TABLE `idioma_episodio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `idioma_filme`
--
ALTER TABLE `idioma_filme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `legenda_episodio`
--
ALTER TABLE `legenda_episodio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `legenda_filme`
--
ALTER TABLE `legenda_filme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `minha_lista_filme`
--
ALTER TABLE `minha_lista_filme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `minha_lista_serie`
--
ALTER TABLE `minha_lista_serie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `serie`
--
ALTER TABLE `serie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `temporada`
--
ALTER TABLE `temporada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `episodio`
--
ALTER TABLE `episodio`
  ADD CONSTRAINT `fk_episodio_serie1` FOREIGN KEY (`serie_id`) REFERENCES `serie` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_episodio_temporada1` FOREIGN KEY (`temporada_id`) REFERENCES `temporada` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `filme`
--
ALTER TABLE `filme`
  ADD CONSTRAINT `fk_filme_genero1` FOREIGN KEY (`genero_id`) REFERENCES `genero` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `idioma_episodio`
--
ALTER TABLE `idioma_episodio`
  ADD CONSTRAINT `fk_idioma_serie_episodio1` FOREIGN KEY (`episodio_id`) REFERENCES `episodio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `idioma_filme`
--
ALTER TABLE `idioma_filme`
  ADD CONSTRAINT `fk_idioma_video` FOREIGN KEY (`video_id`) REFERENCES `filme` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `legenda_episodio`
--
ALTER TABLE `legenda_episodio`
  ADD CONSTRAINT `fk_legenda_serie_episodio1` FOREIGN KEY (`episodio_id`) REFERENCES `episodio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `legenda_filme`
--
ALTER TABLE `legenda_filme`
  ADD CONSTRAINT `fk_legenda_video1` FOREIGN KEY (`video_id`) REFERENCES `filme` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `minha_lista_filme`
--
ALTER TABLE `minha_lista_filme`
  ADD CONSTRAINT `fk_minha_lista_filme_filme1` FOREIGN KEY (`filme_id`) REFERENCES `filme` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_minha_lista_filme_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `minha_lista_serie`
--
ALTER TABLE `minha_lista_serie`
  ADD CONSTRAINT `fk_minha_lista_serie_serie1` FOREIGN KEY (`serie_id`) REFERENCES `serie` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_minha_lista_serie_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `serie`
--
ALTER TABLE `serie`
  ADD CONSTRAINT `fk_serie_genero1` FOREIGN KEY (`genero_id`) REFERENCES `genero` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `temporada`
--
ALTER TABLE `temporada`
  ADD CONSTRAINT `fk_temporada_serie1` FOREIGN KEY (`serie_id`) REFERENCES `serie` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
