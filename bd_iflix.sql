-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 24-Nov-2017 às 22:38
-- Versão do servidor: 10.1.28-MariaDB
-- PHP Version: 7.1.10

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
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sinopse` text NOT NULL,
  `temporada_id` int(11) NOT NULL,
  `duracao` varchar(45) NOT NULL,
  `caminho` varchar(100) NOT NULL,
  `serie_id` int(11) NOT NULL,
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `episodio_assistido`
--

CREATE TABLE `episodio_assistido` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `episodio_id` int(11) NOT NULL,
  `tempo` int(11) NOT NULL DEFAULT '0',
  `dataCriacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dataAlteracao` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Acionadores `episodio_assistido`
--
DELIMITER $$
CREATE TRIGGER `episodio_assistido_BEFORE_UPDATE` BEFORE UPDATE ON `episodio_assistido` FOR EACH ROW BEGIN
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
  (1, 'A mÃºmia', 12, '1', '6605.608437', 'Na MesopotÃ¢mia, sÃ©culos atrÃ¡s, Ahmanet (Sofia Boutella) tem seus planos interrompidos justamente quando estÃ¡ prestes a invocar Set, o deus da morte, de forma que juntos possam governar o mundo.  Mumificada, ela Ã© aprisionada dentro de uma tumba. Nos dias atuais, o local Ã© descoberto por acidente por Nick Morton (Tom Cruise) e Chris Vail (Jake Johnson), saqueadores de artefatos antigos que estavam na regiÃ£o em busca de raridades. Ao lado da pesquisadora Jenny Halsey (Annabelle Wallis), eles investigam a tumba recÃ©m-descoberta e, acidentalmente, despertam Ahmanet. Ela logo elege Nick como seu escolhido e, a partir de entÃ£o, busca a adaga de Set para que possa invocÃ¡-lo no corpo do saqueador. ', 'https://i.ytimg.com/vi/FF_gexjZtV8/maxresdefault.jpg', 1, 1),
  (2, 'Carros 3', -1, '1', '6144.971437', 'Veterano das pistas, o campeonÃ­ssimo RelÃ¢mpago McQueen se vÃª em apuros apÃ³s o surgimento de um novato bastante veloz, Jackson Storm, que utiliza de alta tecnologia nos treinamentos. Obrigado a chegar ao limite para batÃª-lo, McQueen acaba sofrendo um sÃ©rio acidente durante uma corrida, que o obriga a abandonar o campeonato daquele ano. Prestes a iniciar a prÃ³xima temporada, ele se vÃª em dÃºvidas sobre se consegue ser rÃ¡pido o suficiente para bater Storm e, por causa disto, busca ajuda com seu novo patrocinador.', 'https://i.ytimg.com/vi/17iql5AMls4/maxresdefault.jpg', 2, 1),
  (3, 'CÃ­rculo de fogo', 12, '1', '7877.712', 'Quando vÃ¡rias criaturas monstruosas, conhecidas como Kaiju, comeÃ§am a emergir do mar, tem inÃ­cio uma batalha entre estes seres e os humanos. Para combatÃª-los, a humanidade desenvolve uma sÃ©rie de robÃ´s gigantescos, os Jaegers, cada um controlado por duas pessoas atravÃ©s de uma conexÃ£o neural. Entretanto, mesmo os Jaegers se mostram insuficientes para derrotar os Kaiju. Diante deste cenÃ¡rio, a Ãºltima esperanÃ§a Ã© um velho robÃ´, obsoleto, que passa a ser comandado por um antigo piloto (Charlie Hunnam) e uma treinadora (Rinko Kikuchi).', 'http://all4desktop.com/data_images/1280%20x%20720/4154440-pacific-rim-movie.jpg', 1, 1),
  (4, 'GuardiÃµes da GalÃ¡xia', 12, '1', '8146.137437', 'Peter Quill (Chris Pratt) foi abduzido da Terra quando ainda era crianÃ§a. Adulto, fez carreira como saqueador e ganhou o nome de Senhor das Estrelas. Quando rouba uma esfera, na qual o poderoso vilÃ£o Ronan, da raÃ§a kree, estÃ¡ interessado, passa a ser procurado por vÃ¡rios caÃ§adores de recompensas. Para escapar do perigo, Quill une forÃ§as com quatro personagens fora do sistema: Groot, uma Ã¡rvore humanÃ³ide (Vin Diesel), a sombria e perigosa Gamora (Zoe Saldana), o guaxinim rÃ¡pido no gatilho Rocket Racoon (Bradley Cooper) e o vingativo Drax, o Destruidor (Dave Bautista). Mas o Senhor das Estrelas descobre que a esfera roubada possui um poder capaz de mudar os rumos do universo, e logo o grupo deverÃ¡ proteger o objeto para salvar o futuro da galÃ¡xia.', 'https://cdn.fstatic.com/public/articles/files/2014/07/a6fb79e7-30d0-44d6-b243-c0949bfa81d2.jpg', 3, 1),
  (5, 'Mad Max - Estrada da fÃºria', 16, '1', '7223.382833', 'ApÃ³s ser capturado por Immortan Joe, um guerreiro das estradas chamado Max (Tom Hardy) se vÃª no meio de uma guerra mortal, iniciada pela Imperatriz Furiosa (Charlize Theron) na tentativa se salvar um grupo de garotas. TambÃ©m tentanto fugir, Max aceita ajudar Furiosa em sua luta contra Joe e se vÃª dividido entre mais uma vez seguir sozinho seu caminho ou ficar com o grupo. ', 'http://www.wearemoviegeeks.com/wp-content/uploads/mad-max-fury-road-cd-cover.jpg', 3, 1);

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
  (1, 1, 1, 425);

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
  (1, 'Aventura', 1),
  (2, 'Animacao', 1),
  (3, 'Acao', 1);

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
-- Estrutura da tabela `pesquisa`
--

CREATE TABLE `pesquisa` (
  `id` int(11) NOT NULL,
  `texto` varchar(100) NOT NULL,
  `contexto` varchar(45) NOT NULL,
  `data_hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL,
  `ativada` tinyint(4) NOT NULL DEFAULT '1'
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

-- --------------------------------------------------------

--
-- Estrutura da tabela `temporada`
--

CREATE TABLE `temporada` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `serie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  (1, 'Marcio Lucas', '2.png', 0, '$2y$10$El3Jbt9v6eY2zqeeG4ymfOHqD/HZ95sszVn.EmlNciEmvNagdIAoS', 'marciioluucas@gmail.com', '1998-02-11', '2017-11-23', '2017-11-23', 1, 0);

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
-- Indexes for table `pesquisa`
--
ALTER TABLE `pesquisa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pesquisa_usuario1_idx` (`usuario_id`);

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
  MODIFY `idassistindo_filme` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assistindo_serie`
--
ALTER TABLE `assistindo_serie`
  MODIFY `idassistindo_serie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `episodio`
--
ALTER TABLE `episodio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `episodio_assistido`
--
ALTER TABLE `episodio_assistido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `filme`
--
ALTER TABLE `filme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `filme_assistido`
--
ALTER TABLE `filme_assistido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `genero`
--
ALTER TABLE `genero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `minha_lista_serie`
--
ALTER TABLE `minha_lista_serie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesquisa`
--
ALTER TABLE `pesquisa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `serie`
--
ALTER TABLE `serie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temporada`
--
ALTER TABLE `temporada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
