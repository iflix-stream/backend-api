-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 24-Nov-2017 às 17:59
-- Versão do servidor: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_iflix`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `assistindo_filme`
--

CREATE TABLE IF NOT EXISTS `assistindo_filme` (
  `idassistindo_filme` INT(11)   NOT NULL AUTO_INCREMENT,
  `filme_id`           INT(11)   NOT NULL,
  `usuario_id`         INT(11)   NOT NULL,
  `horario_play`       TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idassistindo_filme`),
  KEY `fk_assistindo_filme_filme1_idx` (`filme_id`),
  KEY `fk_assistindo_filme_usuario1_idx` (`usuario_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `assistindo_serie`
--

CREATE TABLE IF NOT EXISTS `assistindo_serie` (
  `idassistindo_serie`    INT(11)   NOT NULL AUTO_INCREMENT,
  `usuario_id`            INT(11)   NOT NULL,
  `episodio_id`           INT(11)   NOT NULL,
  `episodio_temporada_id` INT(11)   NOT NULL,
  `episodio_serie_id`     INT(11)   NOT NULL,
  `horario_play`          TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idassistindo_serie`),
  KEY `fk_table1_usuario1_idx` (`usuario_id`),
  KEY `fk_table1_episodio1_idx` (`episodio_id`, `episodio_temporada_id`, `episodio_serie_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `episodio`
--

CREATE TABLE IF NOT EXISTS `episodio` (
  `id`           INT(11)      NOT NULL AUTO_INCREMENT,
  `nome`         VARCHAR(255) NOT NULL,
  `sinopse`      TEXT         NOT NULL,
  `temporada_id` INT(11)      NOT NULL,
  `duracao`      VARCHAR(45)  NOT NULL,
  `caminho`      VARCHAR(100) NOT NULL,
  `serie_id`     INT(11)      NOT NULL,
  `numero`       INT(11)      NOT NULL,
  PRIMARY KEY (`id`, `temporada_id`, `serie_id`),
  UNIQUE KEY `episodio_numero_uindex` (`numero`),
  KEY `fk_episodio_temporada1_idx` (`temporada_id`),
  KEY `fk_episodio_serie1_idx` (`serie_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `episodio_assistido`
--

CREATE TABLE IF NOT EXISTS `episodio_assistido` (
  `id`            INT(11)  NOT NULL AUTO_INCREMENT,
  `usuario_id`    INT(11)  NOT NULL,
  `episodio_id`   INT(11)  NOT NULL,
  `tempo`         INT(11)  NOT NULL DEFAULT '0',
  `dataCriacao`   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dataAlteracao` DATETIME          DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_serie_assistido_usuario1_idx` (`usuario_id`),
  KEY `fk_serie_assistido_episodio1_idx` (`episodio_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

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

CREATE TABLE IF NOT EXISTS `filme` (
  `id`            INT(11)      NOT NULL AUTO_INCREMENT,
  `nome`          VARCHAR(255) NOT NULL,
  `classificacao` INT(11)      NOT NULL,
  `caminho`       VARCHAR(45)  NOT NULL,
  `duracao`       VARCHAR(45)  NOT NULL,
  `sinopse`       TEXT         NOT NULL,
  `thumbnail`     VARCHAR(255) NOT NULL,
  `genero_id`     INT(11)      NOT NULL,
  `status`        TINYINT(4)   NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_filme_genero1_idx` (`genero_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `filme_assistido`
--

CREATE TABLE IF NOT EXISTS `filme_assistido` (
  `id`         INT(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` INT(11) NOT NULL,
  `filme_id`   INT(11) NOT NULL,
  `tempo`      INT(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_filme_assistido_usuario1_idx` (`usuario_id`),
  KEY `fk_filme_assistido_filme1_idx` (`filme_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `genero`
--

CREATE TABLE IF NOT EXISTS `genero` (
  `id`           INT(11)     NOT NULL AUTO_INCREMENT,
  `nome`         VARCHAR(50) NOT NULL,
  `statusGenero` INT(11)     NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `idioma_episodio`
--

CREATE TABLE IF NOT EXISTS `idioma_episodio` (
  `id`          INT(11)      NOT NULL AUTO_INCREMENT,
  `idioma`      VARCHAR(50)  NOT NULL,
  `caminho`     VARCHAR(100) NOT NULL,
  `episodio_id` INT(11)      NOT NULL,
  PRIMARY KEY (`id`, `episodio_id`),
  KEY `fk_idioma_serie_episodio1_idx` (`episodio_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `idioma_filme`
--

CREATE TABLE IF NOT EXISTS `idioma_filme` (
  `id`       INT(11)      NOT NULL AUTO_INCREMENT,
  `idioma`   VARCHAR(50)  NOT NULL,
  `caminho`  VARCHAR(100) NOT NULL,
  `video_id` INT(11)      NOT NULL,
  PRIMARY KEY (`id`, `video_id`),
  KEY `fk_idioma_video_idx` (`video_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `legenda_episodio`
--

CREATE TABLE IF NOT EXISTS `legenda_episodio` (
  `id`          INT(11)      NOT NULL AUTO_INCREMENT,
  `descricao`   VARCHAR(50)  NOT NULL,
  `caminho`     VARCHAR(100) NOT NULL,
  `episodio_id` INT(11)      NOT NULL,
  PRIMARY KEY (`id`, `episodio_id`),
  KEY `fk_legenda_serie_episodio1_idx` (`episodio_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `legenda_filme`
--

CREATE TABLE IF NOT EXISTS `legenda_filme` (
  `id`       INT(11)      NOT NULL AUTO_INCREMENT,
  `idioma`   VARCHAR(50)  NOT NULL,
  `caminho`  VARCHAR(100) NOT NULL,
  `video_id` INT(11)      NOT NULL,
  PRIMARY KEY (`id`, `video_id`),
  KEY `fk_legenda_video1_idx` (`video_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `minha_lista_filme`
--

CREATE TABLE IF NOT EXISTS `minha_lista_filme` (
  `id`         INT(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` INT(11) NOT NULL,
  `filme_id`   INT(11) NOT NULL,
  PRIMARY KEY (`id`, `usuario_id`),
  KEY `fk_minha_lista_filme_usuario1_idx` (`usuario_id`),
  KEY `fk_minha_lista_filme_filme1_idx` (`filme_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `minha_lista_serie`
--

CREATE TABLE IF NOT EXISTS `minha_lista_serie` (
  `id`         INT(11) NOT NULL AUTO_INCREMENT,
  `serie_id`   INT(11) NOT NULL,
  `usuario_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `usuario_id`),
  KEY `fk_minha_lista_serie_serie1_idx` (`serie_id`),
  KEY `fk_minha_lista_serie_usuario1_idx` (`usuario_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pesquisa`
--

CREATE TABLE IF NOT EXISTS `pesquisa` (
  `id`         INT(11)      NOT NULL AUTO_INCREMENT,
  `texto`      VARCHAR(100) NOT NULL,
  `contexto`   VARCHAR(45)  NOT NULL,
  `data_hora`  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuario_id` INT(11)      NOT NULL,
  `ativada`    TINYINT(4)   NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_pesquisa_usuario1_idx` (`usuario_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `serie`
--

CREATE TABLE IF NOT EXISTS `serie` (
  `id`            INT(11)      NOT NULL AUTO_INCREMENT,
  `nome`          VARCHAR(255) NOT NULL,
  `sinopse`       TEXT         NOT NULL,
  `classificacao` INT(11)      NOT NULL,
  `thumbnail`     VARCHAR(100) NOT NULL,
  `genero_id`     INT(11)      NOT NULL,
  `status`        TINYINT(4)            DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_serie_genero1_idx` (`genero_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `temporada`
--

CREATE TABLE IF NOT EXISTS `temporada` (
  `id`       INT(11) NOT NULL AUTO_INCREMENT,
  `numero`   INT(11) NOT NULL,
  `serie_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `serie_id`),
  KEY `fk_temporada_serie1_idx` (`serie_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id`                INT(11)      NOT NULL AUTO_INCREMENT,
  `nome`              VARCHAR(180) NOT NULL,
  `avatar`            VARCHAR(100) NOT NULL,
  `isControleDosPais` TINYINT(4)            DEFAULT '0',
  `senha`             VARCHAR(255) NOT NULL,
  `email`             VARCHAR(255) NOT NULL,
  `dataNascimento`    DATE         NOT NULL,
  `dataCriacao`       DATE         NOT NULL,
  `dataAlteracao`     DATE         NOT NULL,
  `status`            TINYINT(4)            DEFAULT '1',
  `isOnline`          TINYINT(4)            DEFAULT '0',
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `assistindo_filme`
--
ALTER TABLE `assistindo_filme`
  ADD CONSTRAINT `fk_assistindo_filme_filme1` FOREIGN KEY (`filme_id`) REFERENCES `filme` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_assistindo_filme_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `assistindo_serie`
--
ALTER TABLE `assistindo_serie`
  ADD CONSTRAINT `fk_table1_episodio1` FOREIGN KEY (`episodio_id`, `episodio_temporada_id`, `episodio_serie_id`) REFERENCES `episodio` (`id`, `temporada_id`, `serie_id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_table1_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `episodio`
--
ALTER TABLE `episodio`
  ADD CONSTRAINT `fk_episodio_serie1` FOREIGN KEY (`serie_id`) REFERENCES `serie` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_episodio_temporada1` FOREIGN KEY (`temporada_id`) REFERENCES `temporada` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `episodio_assistido`
--
ALTER TABLE `episodio_assistido`
  ADD CONSTRAINT `fk_serie_assistido_episodio1` FOREIGN KEY (`episodio_id`) REFERENCES `episodio` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_serie_assistido_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `filme`
--
ALTER TABLE `filme`
  ADD CONSTRAINT `fk_filme_genero1` FOREIGN KEY (`genero_id`) REFERENCES `genero` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `filme_assistido`
--
ALTER TABLE `filme_assistido`
  ADD CONSTRAINT `fk_filme_assistido_filme1` FOREIGN KEY (`filme_id`) REFERENCES `filme` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_filme_assistido_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `idioma_episodio`
--
ALTER TABLE `idioma_episodio`
  ADD CONSTRAINT `fk_idioma_serie_episodio1` FOREIGN KEY (`episodio_id`) REFERENCES `episodio` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `idioma_filme`
--
ALTER TABLE `idioma_filme`
  ADD CONSTRAINT `fk_idioma_video` FOREIGN KEY (`video_id`) REFERENCES `filme` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `legenda_episodio`
--
ALTER TABLE `legenda_episodio`
  ADD CONSTRAINT `fk_legenda_serie_episodio1` FOREIGN KEY (`episodio_id`) REFERENCES `episodio` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `legenda_filme`
--
ALTER TABLE `legenda_filme`
  ADD CONSTRAINT `fk_legenda_video1` FOREIGN KEY (`video_id`) REFERENCES `filme` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `minha_lista_filme`
--
ALTER TABLE `minha_lista_filme`
  ADD CONSTRAINT `fk_minha_lista_filme_filme1` FOREIGN KEY (`filme_id`) REFERENCES `filme` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_minha_lista_filme_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `minha_lista_serie`
--
ALTER TABLE `minha_lista_serie`
  ADD CONSTRAINT `fk_minha_lista_serie_serie1` FOREIGN KEY (`serie_id`) REFERENCES `serie` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_minha_lista_serie_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `pesquisa`
--
ALTER TABLE `pesquisa`
  ADD CONSTRAINT `fk_pesquisa_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `serie`
--
ALTER TABLE `serie`
  ADD CONSTRAINT `fk_serie_genero1` FOREIGN KEY (`genero_id`) REFERENCES `genero` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `temporada`
--
ALTER TABLE `temporada`
  ADD CONSTRAINT `fk_temporada_serie1` FOREIGN KEY (`serie_id`) REFERENCES `serie` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
