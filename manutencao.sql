-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 08-Nov-2018 às 22:29
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manutencao`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `conserto`
--

CREATE TABLE `conserto` (
  `id` int(11) NOT NULL,
  `patri_maq` int(11) NOT NULL,
  `local` int(11) NOT NULL,
  `est_resp` int(11) NOT NULL,
  `data_entrada` date NOT NULL,
  `data_saida` date DEFAULT NULL,
  `defeito` varchar(60) NOT NULL,
  `reparo` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `conserto`
--

INSERT INTO `conserto` (`id`, `patri_maq`, `local`, `est_resp`, `data_entrada`, `data_saida`, `defeito`, `reparo`) VALUES
(2, 456776, 5, 1, '2018-10-10', NULL, 'monitor fica rosa', 'troca de lcd'),
(6, 454567, 14, 16, '2018-10-10', NULL, 'reinicia a cada meia hora', ''),
(7, 576457, 14, 1, '2018-10-17', NULL, 'tela azul', ''),
(8, 252627, 1, 1, '2018-10-17', NULL, 'tela azul', ''),
(9, 576457, 4, 2, '2018-10-19', NULL, 'botÃ£o de ligar quebrado', ''),
(10, 576457, 2, 3, '2018-10-19', NULL, 'botÃ£o de ligar quebrado', 'trocou botÃ£o de ligar'),
(11, 576457, 3, 1, '2018-11-21', NULL, 'queimou a fonte', ''),
(12, 576457, 3, 1, '2018-11-21', NULL, 'queimou a fonte', ''),
(13, 456776, 3, 1, '2018-10-19', NULL, 'tela azul', ''),
(14, 252627, 1, 1, '2018-10-19', NULL, 'queimou a fonte', ''),
(15, 456776, 13, 16, '2018-10-17', NULL, 'nÃ£o liga', 'trocou botÃ£o de ligar'),
(16, 252627, 3, 2, '2018-10-19', NULL, 'nÃ£o da video', ''),
(17, 576457, 4, 2, '2018-10-23', '2018-11-01', 'botÃ£o de ligar quebrado', ''),
(18, 252627, 4, 3, '2018-10-24', '2018-11-01', 'nÃ£o liga', ''),
(22, 252627, 13, 16, '2018-10-24', '2018-11-01', 'botÃ£o de ligar quebrado', ''),
(23, 252627, 1, 1, '2018-10-24', NULL, 'botÃ£o de ligar quebrado', ''),
(25, 252627, 1, 2, '2018-10-25', NULL, 'nÃ£o liga', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estagiario`
--

CREATE TABLE `estagiario` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `estagiario`
--

INSERT INTO `estagiario` (`id`, `nome`, `status`) VALUES
(1, 'Gabriel ', 1),
(2, 'Rodolfo', 0),
(3, 'Higor', 1),
(4, 'Pablo', 0),
(16, 'joao', 1),
(17, 'lucas', 0),
(18, 'lucas', 0),
(19, 'lucas', 0),
(20, 'carla', 0),
(21, 'carol', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `local`
--

CREATE TABLE `local` (
  `id` int(11) NOT NULL,
  `predio` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `local`
--

INSERT INTO `local` (`id`, `predio`) VALUES
(1, 'Prédio 1'),
(2, 'Prédio 2'),
(3, 'Prédio de História'),
(4, 'Prédio de Psicologia'),
(5, 'Prédio Nova Central'),
(13, 'CPPA'),
(14, 'CEDAP');

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE `login` (
  `usuario` varchar(10) NOT NULL,
  `senha` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`usuario`, `senha`) VALUES
('Aldo Anton', '698d51a19d8a121ce581499d7b701668'),
('Aldocm', '202cb962ac59075b964b07152d234b70'),
('gabriel', '202cb962ac59075b964b07152d234b70'),
('Natane', 'a09b68ada5e8b2060f380a53c02cf3d8'),
('wadoryu', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Estrutura da tabela `maquina`
--

CREATE TABLE `maquina` (
  `patrimonio` int(11) NOT NULL,
  `processador` varchar(8) NOT NULL,
  `mem_ram` varchar(8) NOT NULL,
  `hd` varchar(8) NOT NULL,
  `mac` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `maquina`
--

INSERT INTO `maquina` (`patrimonio`, `processador`, `mem_ram`, `hd`, `mac`) VALUES
(252627, 'i5', '8gb', '1tb', '16-jf-o9-o8-t6-yt-76'),
(454567, 'i3', '4gb', '500gb', 'ha-3h-y4-hs-83-js-84'),
(456776, 'i7', '16gb', '2tb', 'hg-76-8u-oi-9o-09-hf'),
(576457, 'i7', '16', '2tb', '17-su-u8-87-jh-98-9i');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conserto`
--
ALTER TABLE `conserto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `predio_id_fk` (`local`) USING BTREE,
  ADD KEY `estagiario_id_fk` (`est_resp`) USING HASH,
  ADD KEY `maquina_patri_fk` (`patri_maq`) USING BTREE;

--
-- Indexes for table `estagiario`
--
ALTER TABLE `estagiario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estagiario_id` (`id`);

--
-- Indexes for table `local`
--
ALTER TABLE `local`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`usuario`);

--
-- Indexes for table `maquina`
--
ALTER TABLE `maquina`
  ADD PRIMARY KEY (`patrimonio`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conserto`
--
ALTER TABLE `conserto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `estagiario`
--
ALTER TABLE `estagiario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `local`
--
ALTER TABLE `local`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `maquina`
--
ALTER TABLE `maquina`
  MODIFY `patrimonio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=576458;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `conserto`
--
ALTER TABLE `conserto`
  ADD CONSTRAINT `estagiario_id_fk` FOREIGN KEY (`est_resp`) REFERENCES `estagiario` (`id`),
  ADD CONSTRAINT `local_id_fk` FOREIGN KEY (`local`) REFERENCES `local` (`id`),
  ADD CONSTRAINT `maquina_patri_fk` FOREIGN KEY (`patri_maq`) REFERENCES `maquina` (`patrimonio`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
