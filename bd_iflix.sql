drop DATABASE bd_iflix;
create DATABASE bd_iflix;
use bd_iflix;


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "-03:00";
-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 21-Out-2017 às 16:00
-- Versão do servidor: 10.1.28-MariaDB
-- PHP Version: 7.1.10


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

--
-- Extraindo dados da tabela `assistindo_filme`
--

INSERT INTO `assistindo_filme` (`idassistindo_filme`, `filme_id`, `usuario_id`, `horario_play`) VALUES
(6, 2, 13, '2017-10-21 05:46:42');

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
  `serie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `episodio`
--

INSERT INTO `episodio` (`id`, `nome`, `sinopse`, `temporada_id`, `duracao`, `caminho`, `serie_id`) VALUES
(1, 'A Hard Days Night', 'Meredith%20Grey%2C%20filha%20da%20famosa%20cirurgi%C3%A3%20Ellis%20Grey%2C%20caminha%20depois%20de%20dispensar%20seu%20companheiro%20por%20uma%20noite%20dizendo%20que%20iria%20se%20atrasar%20para%20o%20primeiro%20dia%20de%20trabalho.%20Ela%20%C3%A9%20uma%20residente%20do%20primeiro%20ano%20no%20hospital%20Seattle%20Grace%20e%20est%C3%A1%20trabalhando%20com%20algumas%20pessoas%20interessantes.%20Cristina%20Yang%20%C3%A9%20uma%20garota%20altamente%20competitiva%20que%20se%20tornou%20amiga%20de%20Meredith.%20George%20O%E2%80%99Malley%20%C3%A9%20um%20homem%20afetuoso%20que%2C%20depois%20de%20cometer%20uma%20falha%20em%20sua%20primeira%20cirurgia%2C%20%C3%A9%20classificado%20como%20007%20(liberado%20para%20matar).%20Izzie%20Stevens%20%C3%A9%20uma%20ex-modelo%20que%20n%C3%A3o%20teve%20nenhum%20tratamento%20especial%20em%20seu%20primeiro%20dia%20e%20%C3%A9%20for%C3%A7ada%20a%20fazer%20exames%20retais.%20Alex%20Karev%20%C3%A9%20um%20cara%20arrogante%20que%20d%C3%A1%20um%20diagn%C3%B3stico%20errado%20para%20um%20paciente%20em%20seu%20primeiro%20turno.%20Comandando-os%20est%C3%A1%20Miranda%20Bailey%2C%20conhecida%20como%20%E2%80%98A%20Nazista%E2%80%99.%20Meredith%20tamb%C3%A9m%20fica%20surpresa%20quando%20percebe%20que%20seu%20amigo%20da%20noite%20anterior%20%C3%A9%20o%20Dr.%20Derek%20Shepherd%2C%20que%20tamb%C3%A9m%20ir%C3%A1%20supervisionar%20sua%20resid%C3%AAncia.', 1, '00:40', '1', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `episodio_assistido`
--

CREATE TABLE `episodio_assistido` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `episodio_id` int(11) NOT NULL,
  `episodio_temporada_id` int(11) NOT NULL,
  `episodio_serie_id` int(11) NOT NULL,
  `tempo` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(2, 'A culpa e da estrelas', 15, '1', '2:00', 'Naosei', 'https://upload.wikimedia.org/wikipedia/pt/thumb/0/08/The_Fault_in_Our_Stars_%28filme%29.jpg/200px-The_Fault_in_Our_Stars_%28filme%29.jpg', 1, 1),
(3, 'Esquadrao Suicida', 18, '1', '5:00', 'sadsadasdsa', 'http://cinepop.com.br/wp-content/uploads/2016/12/esquadraosuicida2_2-750x380.jpg', 1, 1),
(5, 'Kingsman: Servico Secreto', 18, '1', '2:00', 'asdasdsad', 'http://i.lv3.hbo.com/assets/images/movies/kingsman-the-secret-service/kingsman-the-secret-service-1920.jpg', 3, 1),
(6, 'Mulher Maravilha', 18, '1', '2:00', 'asdasdsad', 'https://i.ytimg.com/vi/zl29F2c1Vf0/maxresdefault.jpg', 3, 1),
(12, 'Uma noite no museu', 6, '1', '2:30', 'O%20seguran%C3%A7a%20Larry%20Daley%20%28Ben%20Stiller%29%20segue%20com%20seu%20inusitado%20trabalho%20no%20Museu%20de%20Hist%C3%B3ria%20Natural%20de%20Nova%20York.%20Determinado%20dia%2C%20descobre%20que%20a%20pe%C3%A7a%20que%20faz%20os%20objetos%20do%20museu%20ganharem%20vida%20est%C3%A1%20sofrendo%20um%20processo%20de%20danifica%C3%A7%C3%A3o.%20Com%20isso%2C%20todos%20dos%20amigos%20de%20Larry%20correm%20o%20risco%20de%20n%C3%A3o%20ganharem%20mais%20vida.%20Para%20tentar%20salvar%20a%20turma%2C%20ele%20vai%20para%20Londres%20pedir%20a%20orienta%C3%A7%C3%A3o%20do%20fara%C3%B3%20%28Ben%20Kingsley%29%20que%20est%C3%A1%20em%20exposi%C3%A7%C3%A3o%20no%20museu%20local.', 'http://portalcaneca.com.br/wp-content/uploads/2015/01/uma-noite-no-museu-3.png', 1, 1);

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
(3, 'Suspense', 1);

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
(1, 'Greys Anatomy', 'Grey%E2%80%99s%20Anatomy%20%C3%A9%20um%20drama%20m%C3%A9dico%20norte-americano%20exibido%20no%20hor%C3%A1rio%20nobre%20da%20rede%20ABC.%20Seu%20epis%C3%B3dio-piloto%20foi%20transmitido%20pela%20primeira%20vez%20em%2027%20de%20mar%C3%A7o%20de%202005%20nos%20Estados%20Unidos.%20O%20folhetim%20%C3%A9%20protagonizado%20por%20Ellen%20Pompeo%2C%20como%20Dra.%20Meredith%20Grey%2C%20residente%20do%20fict%C3%ADcio%20hospital%20cir%C3%BArgico%20Seattle%20Grace%2C%20em%20Seattle%2C%20Washington%2C%20o%20mais%20r%C3%ADgido%20programa%20cir%C3%BArgico%20de%20Harvard.%20A%20s%C3%A9rie%20%C3%A9%20focada%20nela%20e%20seus%20colegas%2C%20tamb%C3%A9m%20internos%3A%20Cristina%2C%20Izzie%2C%20George%20e%20Alex%2C%20mostrando%20suas%20vidas%20amorosas%20e%20as%20dificuldades%20pelas%20quais%20passam%20no%20trabalho.%0A%0AO%20t%C3%ADtulo%20do%20seriado%20%C3%A9%20uma%20brincadeira%20com%20Gray%E2%80%99s%20Anatomy%20(Anatomia%20de%20Gray)%2C%20o%20famoso%20livro%20de%20anatomia%20de%20Henry%20Gray.%20A%20s%C3%A9rie%2C%20exibida%20nos%20Estados%20Unidos%20ap%C3%B3s%20o%20hit%20Desperate%20Housewives%2C%20logo%20se%20tornou%20um%20sucesso.%0A%0ATal%20sucesso%20se%20repete%20no%20Brasil%2C%20onde%20a%20s%C3%A9rie%20%C3%A9%20exibida%20pelo%20canal%20Sony%20Entertainment%20Television%20em%20hor%C3%A1rio%20nobre.%20Em%20Portugal%2C%20a%20s%C3%A9rie%20foi%20para%20o%20ar%20pelo%20canal%20Fox%20Life%20e%20pela%20RTP2.', 15, 'https://goo.gl/gqxywA', 1, 1);

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
(1, 1, 1);

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
(8, 'Marcio Lucas', '1', 0, '$2y$10$sB1.GlH0bWTr5mY8TqP5f.DrIyMRJ2EyDfQ4UKGDkN4Jv8.ppBXFi', 'marciioluucas@gmail.com', '1998-02-11', '2017-09-05', '2017-09-05', 1, 0),
(9, 'Juanes Adriano', 'avatares/default.png', 0, '$2y$10$mnK1eKgDBrN.u3lB4TDnqud.nL4bVCF.AIHjcKxIp0ukwf3uuJ4oi', 'juaneshtk50@gmail.com', '1997-07-26', '2017-09-11', '2017-09-11', 1, 0),
(11, 'Teste teste', 'avatares/default.png', 0, '$2y$10$vbAEZ2N/nH1mIjQ.ReO/2em3luH0aeVzP5lTxq2iVhln/7JKwVoo.', 'teste@test.com', '1998-02-11', '2017-09-11', '2017-09-11', 1, 0),
(13, 'Lucas Goncalves', 'avatares/default.png', 0, '$2y$10$NCB.O6hykNDlYJ.RN6LKt.rxkEg/79aytP8pxwL1F3qxMIrvOd8yO', 'lucas@hotmail.com', '1995-10-10', '2017-10-06', '2017-10-06', 1, 0),
(14, 'Lucas', '1', 0, '$2y$10$Q4.QFGLV0BCtfTGm3IV/ZOk8dqjyKIGIR8Z7WGthd8TQQXuieAUp.', 'lucaslucas@hotmail.com', '2017-10-17', '2017-10-18', '2017-10-18', 1, 0);

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
  ADD KEY `fk_episodio_temporada1_idx` (`temporada_id`),
  ADD KEY `fk_episodio_serie1_idx` (`serie_id`);

--
-- Indexes for table `episodio_assistido`
--
ALTER TABLE `episodio_assistido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_serie_assistido_usuario1_idx` (`usuario_id`),
  ADD KEY `fk_serie_assistido_episodio1_idx` (`episodio_id`,`episodio_temporada_id`,`episodio_serie_id`);

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
  MODIFY `idassistindo_filme` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `assistindo_serie`
--
ALTER TABLE `assistindo_serie`
  MODIFY `idassistindo_serie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `episodio`
--
ALTER TABLE `episodio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `episodio_assistido`
--
ALTER TABLE `episodio_assistido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `filme`
--
ALTER TABLE `filme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `filme_assistido`
--
ALTER TABLE `filme_assistido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `serie`
--
ALTER TABLE `serie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `temporada`
--
ALTER TABLE `temporada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  ADD CONSTRAINT `fk_serie_assistido_episodio1` FOREIGN KEY (`episodio_id`,`episodio_temporada_id`,`episodio_serie_id`) REFERENCES `episodio` (`id`, `temporada_id`, `serie_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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
