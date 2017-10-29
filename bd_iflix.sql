drop DATABASE bd_iflix;
create DATABASE bd_iflix;
use bd_iflix;

-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26-Out-2017 às 20:03
-- Versão do servidor: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "-03:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_iflix`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `assistindo_filme`
--

CREATE TABLE `assistindo_filme` (
  `idassistindo_filme` int(11) NOT NULL,
  `filme_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `horario_play` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `assistindo_serie`
--

CREATE TABLE `assistindo_serie` (
  `idassistindo_serie` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `episodio_id` int(11) NOT NULL,
  `episodio_temporada_id` int(11) NOT NULL,
  `episodio_serie_id` int(11) NOT NULL,
  `horario_play` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `episodio`
--

CREATE TABLE `episodio` (
  `id`           int(11)      NOT NULL,
  `nome`         varchar(255) NOT NULL,
  `sinopse`      text         NOT NULL,
  `temporada_id` int(11)      NOT NULL,
  `duracao`      varchar(45)  NOT NULL,
  `caminho`      varchar(100) NOT NULL,
  `serie_id`     INT(11)      NOT NULL,
  `numero`       INT(11)      NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `episodio`
--

INSERT INTO `episodio` (`id`, `nome`, `sinopse`, `temporada_id`, `duracao`, `caminho`, `serie_id`, `numero`) VALUES
  (2, 'Panico na floresta do pijama', 'Panico na floresta do pijama', 2, '660', '1', 2, 1),
  (3, 'Problemas na terra do caroco', 'Problemas na terra do caroco', 2, '660', '2', 2, 2),
  (4, 'Prisioneiras do amor', 'Prisioneiras do amor', 2, '660', '3', 2, 3),
  (5, 'Dona Tromba', 'Dona tromba', 2, '660', '4', 2, 4),
  (6, 'O enquiridio', 'O enquiridio', 2, '660', '5', 2, 5),
  (7, 'Zig Zag', 'Zig Zag', 2, '660', '6', 2, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `episodio_assistido`
--

CREATE TABLE `episodio_assistido` (
  `id`            int(11)  NOT NULL,
  `usuario_id`    int(11)  NOT NULL,
  `episodio_id`   int(11)  NOT NULL,
  `tempo`         INT(11)  NOT NULL DEFAULT '0',
  `dataCriacao`   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dataAlteracao` DATETIME          DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `episodio_assistido`
--

INSERT INTO `episodio_assistido` (`id`, `usuario_id`, `episodio_id`, `tempo`, `dataCriacao`, `dataAlteracao`) VALUES
  (15, 98, 2, 27, '2017-10-29 14:31:28', '2017-10-29 14:40:48'),
  (16, 98, 4, 53, '2017-10-29 14:32:54', '2017-10-29 14:35:50');

--
-- Acionadores `episodio_assistido`
--
DELIMITER $$
CREATE TRIGGER `episodio_assistido_BEFORE_UPDATE`
BEFORE UPDATE ON `episodio_assistido`
FOR EACH ROW
  BEGIN
    SET new.dataAlteracao = NOW();
  END
$$
DELIMITER ;

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
  `thumbnail` varchar(255) NOT NULL,
  `genero_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `filme`
--

INSERT INTO `filme` (`id`, `nome`, `classificacao`, `caminho`, `duracao`, `sinopse`, `thumbnail`, `genero_id`, `status`) VALUES
  (12, 'A mumia', 6, '1', '2:30',
   'Nas%20profundezas%20do%20deserto%2C%20uma%20antiga%20rainha%20cujo%20destino%20foi%20injustamente%20tirado%20est%C3%A1%20mumificada.%20Apesar%20de%20estar%20sepultada%20em%20sua%20cripta%2C%20ela%20desperta%20nos%20dias%20atuais.%20Com%20uma%20maldade%20acumulada%20ao%20longo%20dos%20anos%2C%20ela%20espelha%20terror%20desde%20as%20areais%20do%20Oriente%20M%C3%A9dio%20at%C3%A9%20os%20becos%20de%20Londres.',
   'https://i.ytimg.com/vi/X6g-nYaDEyw/maxresdefault.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `filme_assistido`
--

CREATE TABLE `filme_assistido` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `filme_id` int(11) NOT NULL,
  `tempo` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `filme_assistido`
--

INSERT INTO `filme_assistido` (`id`, `usuario_id`, `filme_id`, `tempo`) VALUES
  (8, 98, 12, 2205);

-- --------------------------------------------------------

--
-- Estrutura da tabela `genero`
--

CREATE TABLE `genero` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `statusGenero` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `genero`
--

INSERT INTO `genero` (`id`, `nome`, `statusGenero`) VALUES
  (1, 'Terror', 1),
  (3, 'Suspense', 1),
  (4, 'Animacao', 1);

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `minha_lista_serie`
--

CREATE TABLE `minha_lista_serie` (
  `id` int(11) NOT NULL,
  `serie_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  (2, 'Hora de aventura',
   'Finn%2C%20o%20garoto%20humano%20com%20um%20chap%C3%A9u%20incr%C3%ADvel%2C%20e%20Jake%2C%20o%20cachorro%20inteligente%2C%20s%C3%A3o%20amigos%20%C3%ADntimos%20e%20parceiros%20em%20estranhas%20aventuras%20na%20terra%20do%20Ooo.',
   -1, 'https://goo.gl/aAFEbX', 4, 1);

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
  (2, 1, 2);

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
  `status` tinyint(4) DEFAULT '1',
  `isOnline` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `avatar`, `isControleDosPais`, `senha`, `email`, `dataNascimento`, `dataCriacao`, `dataAlteracao`, `status`, `isOnline`) VALUES
  (9, 'Juanes Adriano', 'avatares/default.png', 0, '$2y$10$mnK1eKgDBrN.u3lB4TDnqud.nL4bVCF.AIHjcKxIp0ukwf3uuJ4oi', 'juaneshtk50@gmail.com', '1997-07-26', '2017-09-11', '2017-09-11', 1, 0),
  (11, 'Teste teste', 'avatares/default.png', 0, '$2y$10$vbAEZ2N/nH1mIjQ.ReO/2em3luH0aeVzP5lTxq2iVhln/7JKwVoo.', 'teste@test.com', '1998-02-11', '2017-09-11', '2017-09-11', 1, 0),
  (13, 'Lucas Goncalves', 'avatares/default.png', 0, '$2y$10$NCB.O6hykNDlYJ.RN6LKt.rxkEg/79aytP8pxwL1F3qxMIrvOd8yO', 'lucas@hotmail.com', '1995-10-10', '2017-10-06', '2017-10-06', 1, 0),
  (14, 'Lucas', '1', 0, '$2y$10$Q4.QFGLV0BCtfTGm3IV/ZOk8dqjyKIGIR8Z7WGthd8TQQXuieAUp.', 'lucaslucas@hotmail.com', '2017-10-17', '2017-10-18', '2017-10-18', 1, 0),
  (85, 'Jubiraci', '1', 0, '$2y$10$Nxy/SOjrbggvpaGRH7y7ZuUQm/lgK6GshHLoiDUaUCzrJbIJw4XQm', 'jujuju@gmail.com', '1997-10-22', '2017-10-27', '2017-10-27', 1, 0),
  (86, 'AsnDsaD', '1', 0, '$2y$10$o9RffcmdvGLxR09LTrKpiuoypziG/eGUMohO6JBgINx0GniNT76SO', 'LASDAS@HOTMAIL.COM', '2017-10-24', '2017-10-27', '2017-10-27', 1, 0),
  (87, 'ASD', '1', 0, '$2y$10$/Q3/Y6uHaDLSmWR8M/u4AeQSpzESiZbPflp23KpmrokpA0tmpk9t2', 'ASDSA@HSD.COM', '2017-10-04', '2017-10-27', '2017-10-27', 1, 0),
  (88, 'marciisaojdsa', '1', 0, '$2y$10$jd.kltCVDKYZprFLIjBRDOTnUxbjgkxxJrvR0EaMXHTyfm6ZWnI3u', 'odsajsa@ffd.com', '2017-10-27', '2017-10-27', '2017-10-27', 1, 0),
  (89, 'werr', '1', 0, '$2y$10$BWA6/0qypsbeGW9lBQ3My.Jhlo6LXmpB5AB65XubnDcaU.lSqtDD2', 'rweerw@ffsd.com', '2017-10-17', '2017-10-27', '2017-10-27', 1, 0),
  (90, 'Teste de software', '1', 0, '$2y$10$6xEByrFFrhI44NLtJp/Amep8EWbL.PvQokWychxKF5a5aEoS.EgSC', 'teste@gmail.com', '2017-10-23', '2017-10-29', '2017-10-29', 1, 0),
  (98, 'Marcio Lucas', '1', 0, '$2y$10$llrRgdrRUEnkj2cj/BwsjOU.bVQXIexD23ZAsXx45yuCTZ7j/XSjO', 'marciioluucas@gmail.com', '1998-02-11', '2017-10-29', '2017-10-29', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assistindo_filme`
--
ALTER TABLE `assistindo_filme`
  ADD PRIMARY KEY (`idassistindo_filme`),
  ADD KEY `fk_assistindo_filme_filme1_idx` (`filme_id`),
  ADD KEY `fk_assistindo_filme_usuario1_idx` (`usuario_id`);

--
-- Indexes for table `assistindo_serie`
--
ALTER TABLE `assistindo_serie`
  ADD PRIMARY KEY (`idassistindo_serie`),
  ADD KEY `fk_table1_usuario1_idx` (`usuario_id`),
  ADD KEY `fk_table1_episodio1_idx` (`episodio_id`,`episodio_temporada_id`,`episodio_serie_id`);

--
-- Indexes for table `episodio`
--
ALTER TABLE `episodio`
  ADD PRIMARY KEY (`id`,`temporada_id`,`serie_id`),
  ADD UNIQUE KEY `episodio_numero_uindex` (`numero`),
  ADD KEY `fk_episodio_temporada1_idx` (`temporada_id`),
  ADD KEY `fk_episodio_serie1_idx` (`serie_id`);

--
-- Indexes for table `episodio_assistido`
--
ALTER TABLE `episodio_assistido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_serie_assistido_usuario1_idx` (`usuario_id`),
  ADD KEY `fk_serie_assistido_episodio1_idx` (`episodio_id`);

--
-- Indexes for table `filme`
--
ALTER TABLE `filme`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_filme_genero1_idx` (`genero_id`);

--
-- Indexes for table `filme_assistido`
--
ALTER TABLE `filme_assistido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_filme_assistido_usuario1_idx` (`usuario_id`),
  ADD KEY `fk_filme_assistido_filme1_idx` (`filme_id`);

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
-- AUTO_INCREMENT for table `assistindo_filme`
--
ALTER TABLE `assistindo_filme`
  MODIFY `idassistindo_filme` INT(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assistindo_serie`
--
ALTER TABLE `assistindo_serie`
  MODIFY `idassistindo_serie` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `episodio`
--
ALTER TABLE `episodio`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 8;
--
-- AUTO_INCREMENT for table `episodio_assistido`
--
ALTER TABLE `episodio_assistido`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 17;
--
-- AUTO_INCREMENT for table `filme`
--
ALTER TABLE `filme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `filme_assistido`
--
ALTER TABLE `filme_assistido`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 9;
--
-- AUTO_INCREMENT for table `genero`
--
ALTER TABLE `genero`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 5;
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
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 33;
--
-- AUTO_INCREMENT for table `minha_lista_serie`
--
ALTER TABLE `minha_lista_serie`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `serie`
--
ALTER TABLE `serie`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 3;
--
-- AUTO_INCREMENT for table `temporada`
--
ALTER TABLE `temporada`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 3;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 99;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `assistindo_filme`
--
ALTER TABLE `assistindo_filme`
  ADD CONSTRAINT `fk_assistindo_filme_filme1` FOREIGN KEY (`filme_id`) REFERENCES `filme` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_assistindo_filme_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `assistindo_serie`
--
ALTER TABLE `assistindo_serie`
  ADD CONSTRAINT `fk_table1_episodio1` FOREIGN KEY (`episodio_id`,`episodio_temporada_id`,`episodio_serie_id`) REFERENCES `episodio` (`id`, `temporada_id`, `serie_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_table1_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `episodio`
--
ALTER TABLE `episodio`
  ADD CONSTRAINT `fk_episodio_serie1` FOREIGN KEY (`serie_id`) REFERENCES `serie` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_episodio_temporada1` FOREIGN KEY (`temporada_id`) REFERENCES `temporada` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `episodio_assistido`
--
ALTER TABLE `episodio_assistido`
  ADD CONSTRAINT `fk_serie_assistido_episodio1` FOREIGN KEY (`episodio_id`) REFERENCES `episodio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_serie_assistido_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `filme`
--
ALTER TABLE `filme`
  ADD CONSTRAINT `fk_filme_genero1` FOREIGN KEY (`genero_id`) REFERENCES `genero` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `filme_assistido`
--
ALTER TABLE `filme_assistido`
  ADD CONSTRAINT `fk_filme_assistido_filme1` FOREIGN KEY (`filme_id`) REFERENCES `filme` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_filme_assistido_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
