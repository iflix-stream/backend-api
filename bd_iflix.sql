-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 05-Set-2017 às 03:39
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
  `nome` varchar(45) DEFAULT NULL,
  `sinopse` varchar(45) DEFAULT NULL,
  `temporada_id` int(11) NOT NULL,
  `duracao` varchar(45) DEFAULT NULL,
  `caminho` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `filme`
--

CREATE TABLE `filme` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` varchar(45) DEFAULT NULL,
  `classificacao` varchar(11) DEFAULT NULL,
  `genero` varchar(22) DEFAULT NULL,
  `caminho` varchar(45) DEFAULT NULL,
  `duracao` varchar(45) DEFAULT NULL,
  `sinopse` varchar(45) DEFAULT NULL,
  `thumbnail` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `idioma_episodio`
--

CREATE TABLE `idioma_episodio` (
  `id` int(11) NOT NULL,
  `descricao` varchar(45) DEFAULT NULL,
  `caminho` varchar(45) DEFAULT NULL,
  `episodio_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `idioma_filme`
--

CREATE TABLE `idioma_filme` (
  `id` int(11) NOT NULL,
  `descricao` varchar(45) DEFAULT NULL,
  `caminho` varchar(45) DEFAULT NULL,
  `video_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `legenda_episodio`
--

CREATE TABLE `legenda_episodio` (
  `id` int(11) NOT NULL,
  `descricao` varchar(45) DEFAULT NULL,
  `caminho` varchar(45) DEFAULT NULL,
  `episodio_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `legenda_filme`
--

CREATE TABLE `legenda_filme` (
  `id` int(11) NOT NULL,
  `descricao` varchar(45) DEFAULT NULL,
  `caminho` varchar(45) DEFAULT NULL,
  `video_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `minha_lista`
--

CREATE TABLE `minha_lista` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `serie_id` int(11) NOT NULL DEFAULT '0',
  `filme_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `serie`
--

CREATE TABLE `serie` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` varchar(45) DEFAULT NULL,
  `classificacao` varchar(45) DEFAULT NULL,
  `genero` varchar(45) DEFAULT NULL,
  `thumbnail` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `temporada`
--

CREATE TABLE `temporada` (
  `id` int(11) NOT NULL,
  `serie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(180) DEFAULT NULL,
  `avatar` varchar(80) DEFAULT NULL,
  `isControleDosPais` tinyint(4) DEFAULT '0',
  `senha` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `dataNascimento` date DEFAULT NULL,
  `dataCriacao` date DEFAULT NULL,
  `dataAlteracao` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `avatar`, `isControleDosPais`, `senha`, `email`, `dataNascimento`, `dataCriacao`, `dataAlteracao`, `status`) VALUES
(1, 'Lucas', 'lola', 0, 'theboss321', 'lukinh123@gmail.com', NULL, NULL, NULL, 1),
(2, 'Marcio Lucas', 'sadadasd', 0, 'pamonha4321', 'marciioluucas@gmail.com', NULL, NULL, NULL, 1),
(3, 'Marcio Lucas', 'avatares/default.png', 0, 'pamonha4321', 'marciioluucas@gmail.com', NULL, '2017-09-05', NULL, 1),
(4, 'Marcio Lucas', 'avatares/default.png', 0, 'pamonha4321', 'marciioluucas@gmail.com', '1998-02-11', '2017-09-05', '2017-09-05', 1),
(5, 'Juanes Adriano', 'avatares/default.png', 0, 'pamonha4321', 'jonas@gmail.com', '1998-02-11', '2017-09-05', '2017-09-05', 1),
(6, 'Juanes Adriano', 'avatares/default.png', 0, 'pamonha4321', 'jonas@gmail.com', '1998-02-11', '2017-09-05', '2017-09-05', 1),
(7, 'Pamonha Adriano', 'avatares/default.png', 0, 'pamonha4321', 'jonas@gmail.com', '1998-02-11', '2017-09-05', '2017-09-05', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `episodio`
--
ALTER TABLE `episodio`
  ADD PRIMARY KEY (`id`,`temporada_id`),
  ADD KEY `fk_episodio_temporada1_idx` (`temporada_id`);

--
-- Indexes for table `filme`
--
ALTER TABLE `filme`
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
-- Indexes for table `minha_lista`
--
ALTER TABLE `minha_lista`
  ADD PRIMARY KEY (`id`,`usuario_id`),
  ADD KEY `fk_minha_lista_usuario1_idx` (`usuario_id`),
  ADD KEY `fk_minha_lista_serie1_idx` (`serie_id`),
  ADD KEY `fk_minha_lista_filme1_idx` (`filme_id`);

--
-- Indexes for table `serie`
--
ALTER TABLE `serie`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `episodio`
--
ALTER TABLE `episodio`
  ADD CONSTRAINT `fk_episodio_temporada1` FOREIGN KEY (`temporada_id`) REFERENCES `temporada` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Limitadores para a tabela `minha_lista`
--
ALTER TABLE `minha_lista`
  ADD CONSTRAINT `fk_minha_lista_filme1` FOREIGN KEY (`filme_id`) REFERENCES `filme` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_minha_lista_serie1` FOREIGN KEY (`serie_id`) REFERENCES `serie` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_minha_lista_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `temporada`
--
ALTER TABLE `temporada`
  ADD CONSTRAINT `fk_temporada_serie1` FOREIGN KEY (`serie_id`) REFERENCES `serie` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
