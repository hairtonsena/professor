-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 12/01/2015 às 10:57
-- Versão do servidor: 5.5.40-0ubuntu0.14.04.1
-- Versão do PHP: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `professor_andre`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

CREATE TABLE IF NOT EXISTS `aluno` (
  `id_aluno` int(11) NOT NULL AUTO_INCREMENT,
  `nome_aluno` varchar(50) NOT NULL,
  `matricula_aluno` varchar(25) NOT NULL,
  `senha_aluno` varchar(45) NOT NULL,
  `cpf_aluno` varchar(14) NOT NULL,
  `status_aluno` int(1) NOT NULL,
  PRIMARY KEY (`id_aluno`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Fazendo dump de dados para tabela `aluno`
--

INSERT INTO `aluno` (`id_aluno`, `nome_aluno`, `matricula_aluno`, `senha_aluno`, `cpf_aluno`, `status_aluno`) VALUES
(1, 'Danilo Moabb', '321232', 'e10adc3949ba59abbe56e057f20f883e', '293.512.508-81', 1),
(2, 'Vilson Cordeiro', '654123', '', '308.022.635-69', 1),
(3, 'Grazy coutinho', '111225', '', '907.226.868-70', 1),
(4, 'Simone Sobral', '521463', '', '99999999999', 1),
(5, 'Vinicios Silva', '321456', '', '42352868033', 1),
(6, 'Janice Oliveira', '741258', '', '481.077.520-82', 1),
(7, 'Hairton Sobral', '101112', '4fa8d8a1890200f7183bf1f6a3248713', '103.661.826-92', 1),
(8, 'Murilo Sandiego', '101113', 'd41d8cd98f00b204e9800998ecf8427e', '812.235.745-80', 1),
(9, 'Fabrício Dias', '111215', 'c4c777dc4811f11bffae3da4191dcb98', '732.214.835-54', 1),
(10, 'Roberto Jorge', '111219', 'd41d8cd98f00b204e9800998ecf8427e', '250.266.537-07', 1),
(11, 'excluir este', '000000', '78c59e005c5c61b6657df0d5ae9cc9d9', '446.076.431-81', 1),
(12, 'outro apagar', '111310', '9b6bad319487a1ce5c968771a6d1de1b', '354.004.318-79', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno_has_turma`
--

CREATE TABLE IF NOT EXISTS `aluno_has_turma` (
  `aluno_id_aluno` int(11) NOT NULL,
  `turma_id_turma` int(11) NOT NULL,
  PRIMARY KEY (`aluno_id_aluno`,`turma_id_turma`),
  KEY `fk_aluno_has_turma_turma1_idx` (`turma_id_turma`),
  KEY `fk_aluno_has_turma_aluno1_idx` (`aluno_id_aluno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `aluno_has_turma`
--

INSERT INTO `aluno_has_turma` (`aluno_id_aluno`, `turma_id_turma`) VALUES
(1, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(5, 3),
(1, 4),
(5, 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `anexo_trabalho`
--

CREATE TABLE IF NOT EXISTS `anexo_trabalho` (
  `id_anexo_trabalho` int(11) NOT NULL AUTO_INCREMENT,
  `nome_anexo_trabalho` varchar(50) NOT NULL,
  `arquivo_anexo_trabalho` varchar(50) DEFAULT NULL,
  `trabalho_id_trabalho` int(11) NOT NULL,
  PRIMARY KEY (`id_anexo_trabalho`,`trabalho_id_trabalho`),
  KEY `fk_anexo_trabalho_trabalho1_idx` (`trabalho_id_trabalho`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Fazendo dump de dados para tabela `anexo_trabalho`
--

INSERT INTO `anexo_trabalho` (`id_anexo_trabalho`, `nome_anexo_trabalho`, `arquivo_anexo_trabalho`, `trabalho_id_trabalho`) VALUES
(32, 'boleto_dominio.pdf', 'boleto_dominio.pdf', 11);

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacao`
--

CREATE TABLE IF NOT EXISTS `avaliacao` (
  `id_avaliacao` int(11) NOT NULL AUTO_INCREMENT,
  `descricao_avaliacao` varchar(140) NOT NULL,
  `data_avaliacao` date NOT NULL,
  `valor_avaliacao` float NOT NULL,
  `turma_id_turma` int(11) NOT NULL,
  PRIMARY KEY (`id_avaliacao`,`turma_id_turma`),
  KEY `fk_avaliacao_turma1_idx` (`turma_id_turma`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Fazendo dump de dados para tabela `avaliacao`
--

INSERT INTO `avaliacao` (`id_avaliacao`, `descricao_avaliacao`, `data_avaliacao`, `valor_avaliacao`, `turma_id_turma`) VALUES
(1, '1ª Avaliação', '2014-12-31', 20, 1),
(2, '2ª Avaliação', '2015-01-21', 20, 1),
(3, '3ª Avaliação', '2015-01-30', 20, 1),
(4, '1ª Avaliação', '2015-01-31', 25, 4),
(5, 'ultima', '2015-01-31', 10, 1),
(6, 'Aparece', '2015-02-28', 10, 4),
(7, '1ª Avaliação', '2015-01-22', 10, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacao_recuperacao`
--

CREATE TABLE IF NOT EXISTS `avaliacao_recuperacao` (
  `id_avaliacao_recuperacao` int(11) NOT NULL AUTO_INCREMENT,
  `descricao_avaliacao_recuperacao` varchar(50) NOT NULL,
  `data_avaliacao_recuperacao` date NOT NULL,
  `valor_avaliacao_recuperacao` float NOT NULL,
  `turma_id_turma` int(11) NOT NULL,
  PRIMARY KEY (`id_avaliacao_recuperacao`,`turma_id_turma`),
  KEY `fk_avaliacao_recuperacao_turma1_idx` (`turma_id_turma`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Fazendo dump de dados para tabela `avaliacao_recuperacao`
--

INSERT INTO `avaliacao_recuperacao` (`id_avaliacao_recuperacao`, `descricao_avaliacao_recuperacao`, `data_avaliacao_recuperacao`, `valor_avaliacao_recuperacao`, `turma_id_turma`) VALUES
(1, 'Avaliação de Recuperação', '0000-00-00', 100, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `disciplina`
--

CREATE TABLE IF NOT EXISTS `disciplina` (
  `id_disciplina` int(5) NOT NULL AUTO_INCREMENT,
  `nome_disciplina` varchar(45) NOT NULL,
  `descricao_disciplina` text NOT NULL,
  `status_disciplina` int(1) NOT NULL,
  PRIMARY KEY (`id_disciplina`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Fazendo dump de dados para tabela `disciplina`
--

INSERT INTO `disciplina` (`id_disciplina`, `nome_disciplina`, `descricao_disciplina`, `status_disciplina`) VALUES
(1, 'História', '<p>E texto sim</p>\n', 1),
(2, 'Português', '<p>kkkkkkkkkkkk agora eu consigo ver</p>\n', 1),
(3, 'Matemática', '<h3>Redes de Computadores I &ndash; 2014.02 &ndash; TADS</h3>\n\n<p style="text-align:justify">O aluno ter&aacute; a oportunidade de conhecer os fundamentos b&aacute;sicos do processo de comunica&ccedil;&atilde;o entre computadores. Ir&aacute; estudar os principais desafios, conceitos, protocolos, arquiteturas e tecnologias existentes nesta &aacute;rea de pesquisa sob constante evolu&ccedil;&atilde;o. Ap&oacute;s o curso, o aluno ter&aacute; uma s&oacute;lida forma&ccedil;&atilde;o te&oacute;rica para estudos avan&ccedil;ados na &aacute;rea.</p>\n', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `nota_avaliacao`
--

CREATE TABLE IF NOT EXISTS `nota_avaliacao` (
  `id_nota` int(11) NOT NULL AUTO_INCREMENT,
  `valor_nota` float NOT NULL,
  `aluno_id_aluno` int(11) NOT NULL,
  `avaliacao_id_avaliacao` int(11) NOT NULL,
  PRIMARY KEY (`id_nota`,`aluno_id_aluno`,`avaliacao_id_avaliacao`),
  KEY `fk_nota_aluno1_idx` (`aluno_id_aluno`),
  KEY `fk_nota_avaliacao1_idx` (`avaliacao_id_avaliacao`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Fazendo dump de dados para tabela `nota_avaliacao`
--

INSERT INTO `nota_avaliacao` (`id_nota`, `valor_nota`, `aluno_id_aluno`, `avaliacao_id_avaliacao`) VALUES
(1, 15, 1, 1),
(2, 2, 4, 1),
(3, 20, 5, 1),
(4, 17, 6, 1),
(5, 10, 1, 2),
(6, 9, 4, 2),
(7, 1, 5, 2),
(8, 15, 6, 2),
(9, 20, 1, 3),
(10, 10, 4, 3),
(11, 15, 5, 3),
(12, 5, 6, 3),
(13, 18, 3, 1),
(14, 20, 3, 2),
(15, 15, 3, 3),
(16, 10, 1, 5),
(17, 5, 3, 5),
(18, 3, 4, 5),
(19, 1, 5, 5),
(20, 0, 6, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `nota_avaliacao_recuperacao`
--

CREATE TABLE IF NOT EXISTS `nota_avaliacao_recuperacao` (
  `id_nota_avaliacao_recuperacao` int(11) NOT NULL AUTO_INCREMENT,
  `valor_nota_avaliacao_recuperacao` float NOT NULL,
  `avaliacao_recuperacao_id_avaliacao_recuperacao` int(11) NOT NULL,
  `aluno_id_aluno` int(11) NOT NULL,
  PRIMARY KEY (`id_nota_avaliacao_recuperacao`,`avaliacao_recuperacao_id_avaliacao_recuperacao`,`aluno_id_aluno`),
  KEY `fk_nota_avaliacao_recuperacao_avaliacao_recuperacao1_idx` (`avaliacao_recuperacao_id_avaliacao_recuperacao`),
  KEY `fk_nota_avaliacao_recuperacao_aluno1_idx` (`aluno_id_aluno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Fazendo dump de dados para tabela `nota_avaliacao_recuperacao`
--

INSERT INTO `nota_avaliacao_recuperacao` (`id_nota_avaliacao_recuperacao`, `valor_nota_avaliacao_recuperacao`, `avaliacao_recuperacao_id_avaliacao_recuperacao`, `aluno_id_aluno`) VALUES
(1, 68, 1, 1),
(2, 50, 1, 5),
(3, 0, 1, 3),
(4, 0, 1, 4),
(5, 0, 1, 6);

-- --------------------------------------------------------

--
-- Estrutura para tabela `nota_trabalho`
--

CREATE TABLE IF NOT EXISTS `nota_trabalho` (
  `id_nota_trabalho` int(11) NOT NULL AUTO_INCREMENT,
  `valor_nota_trabalho` float NOT NULL,
  `aluno_id_aluno` int(11) NOT NULL,
  `trabalho_id_trabalho` int(11) NOT NULL,
  PRIMARY KEY (`id_nota_trabalho`,`aluno_id_aluno`,`trabalho_id_trabalho`),
  KEY `fk_nota_tabalho_aluno1_idx` (`aluno_id_aluno`),
  KEY `fk_nota_tabalho_trabalho1_idx` (`trabalho_id_trabalho`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor`
--

CREATE TABLE IF NOT EXISTS `professor` (
  `id_professor` int(2) NOT NULL AUTO_INCREMENT,
  `nome_professor` varchar(45) NOT NULL,
  `email_professor` varchar(65) NOT NULL,
  `senha_professor` varchar(45) NOT NULL,
  `cpf_professor` varchar(14) NOT NULL,
  PRIMARY KEY (`id_professor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Fazendo dump de dados para tabela `professor`
--

INSERT INTO `professor` (`id_professor`, `nome_professor`, `email_professor`, `senha_professor`, `cpf_professor`) VALUES
(1, 'Hairton Sobral', 'hairtonsena@yahoo.com.br', '25d55ad283aa400af464c76d713c07ad', '111111111');

-- --------------------------------------------------------

--
-- Estrutura para tabela `trabalho`
--

CREATE TABLE IF NOT EXISTS `trabalho` (
  `id_trabalho` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_trabalho` varchar(100) NOT NULL,
  `descricao_trabalho` text,
  `data_entrega_trabalho` date NOT NULL,
  `valor_nota_trabalho` float NOT NULL,
  `abilitar_upload_trabalho` int(1) NOT NULL,
  `turma_id_turma` int(11) NOT NULL,
  `pasta_upload_trabalho` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_trabalho`,`turma_id_turma`),
  KEY `fk_trabalho_turma1_idx` (`turma_id_turma`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Fazendo dump de dados para tabela `trabalho`
--

INSERT INTO `trabalho` (`id_trabalho`, `titulo_trabalho`, `descricao_trabalho`, `data_entrega_trabalho`, `valor_nota_trabalho`, `abilitar_upload_trabalho`, `turma_id_turma`, `pasta_upload_trabalho`) VALUES
(11, 'teste', 'trabalho teste', '2015-01-31', 10, 1, 1, 'pas_54ac148f71e9c'),
(12, 'Trabalho para testar', 'Parafraseando o diciona?rio Houaiss, matema?tica e? a cie?ncia que se ocupa do estudo de objetos abstratos, tais quais, como nu?meros, figuras e func?o?es, e estabelece relac?o?es existentes entre eles. Para tanto, e? uma cie?ncia que exige racioci?nio lo?gico. Na Pre?-Histo?ria, os pastores na?o tinham nenhum conhecimento matema?tico, mas sabiam comparar as grandezas.', '2015-02-08', 20, 1, 1, 'pas_54b024287497c');

-- --------------------------------------------------------

--
-- Estrutura para tabela `turma`
--

CREATE TABLE IF NOT EXISTS `turma` (
  `id_turma` int(11) NOT NULL AUTO_INCREMENT,
  `nome_turma` varchar(45) NOT NULL,
  `status_turma` varchar(45) NOT NULL,
  `disciplina_id_disciplina` int(5) NOT NULL,
  PRIMARY KEY (`id_turma`,`disciplina_id_disciplina`),
  KEY `fk_turma_disciplina_idx` (`disciplina_id_disciplina`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Fazendo dump de dados para tabela `turma`
--

INSERT INTO `turma` (`id_turma`, `nome_turma`, `status_turma`, `disciplina_id_disciplina`) VALUES
(1, '210', '2', 3),
(3, 'agora', '1', 3),
(4, 'Literatura', '1', 2);

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `aluno_has_turma`
--
ALTER TABLE `aluno_has_turma`
  ADD CONSTRAINT `fk_aluno_has_turma_aluno1` FOREIGN KEY (`aluno_id_aluno`) REFERENCES `aluno` (`id_aluno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_aluno_has_turma_turma1` FOREIGN KEY (`turma_id_turma`) REFERENCES `turma` (`id_turma`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `anexo_trabalho`
--
ALTER TABLE `anexo_trabalho`
  ADD CONSTRAINT `fk_anexo_trabalho_trabalho1` FOREIGN KEY (`trabalho_id_trabalho`) REFERENCES `trabalho` (`id_trabalho`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD CONSTRAINT `fk_avaliacao_turma1` FOREIGN KEY (`turma_id_turma`) REFERENCES `turma` (`id_turma`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `avaliacao_recuperacao`
--
ALTER TABLE `avaliacao_recuperacao`
  ADD CONSTRAINT `fk_avaliacao_recuperacao_turma1` FOREIGN KEY (`turma_id_turma`) REFERENCES `turma` (`id_turma`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `nota_avaliacao`
--
ALTER TABLE `nota_avaliacao`
  ADD CONSTRAINT `fk_nota_aluno1` FOREIGN KEY (`aluno_id_aluno`) REFERENCES `aluno` (`id_aluno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nota_avaliacao1` FOREIGN KEY (`avaliacao_id_avaliacao`) REFERENCES `avaliacao` (`id_avaliacao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `nota_avaliacao_recuperacao`
--
ALTER TABLE `nota_avaliacao_recuperacao`
  ADD CONSTRAINT `fk_nota_avaliacao_recuperacao_aluno1` FOREIGN KEY (`aluno_id_aluno`) REFERENCES `aluno` (`id_aluno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nota_avaliacao_recuperacao_avaliacao_recuperacao1` FOREIGN KEY (`avaliacao_recuperacao_id_avaliacao_recuperacao`) REFERENCES `avaliacao_recuperacao` (`id_avaliacao_recuperacao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `nota_trabalho`
--
ALTER TABLE `nota_trabalho`
  ADD CONSTRAINT `fk_nota_tabalho_aluno1` FOREIGN KEY (`aluno_id_aluno`) REFERENCES `aluno` (`id_aluno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nota_tabalho_trabalho1` FOREIGN KEY (`trabalho_id_trabalho`) REFERENCES `trabalho` (`id_trabalho`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `trabalho`
--
ALTER TABLE `trabalho`
  ADD CONSTRAINT `fk_trabalho_turma1` FOREIGN KEY (`turma_id_turma`) REFERENCES `turma` (`id_turma`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `fk_turma_disciplina` FOREIGN KEY (`disciplina_id_disciplina`) REFERENCES `disciplina` (`id_disciplina`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
