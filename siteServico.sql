-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 21-Nov-2014 às 16:45
-- Versão do servidor: 5.5.37-0ubuntu0.13.10.1
-- versão do PHP: 5.5.3-1ubuntu2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `siteServico`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `nome_admin` varchar(50) NOT NULL,
  `cpf_admin` varchar(14) NOT NULL,
  `email_admin` varchar(70) NOT NULL,
  `senha_admin` varchar(40) NOT NULL,
  `status_admin` int(1) NOT NULL,
  `id_privilegio_admin` int(2) NOT NULL,
  PRIMARY KEY (`id_admin`),
  KEY `fk_privilegio_admin` (`id_privilegio_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `admin`
--

INSERT INTO `admin` (`id_admin`, `nome_admin`, `cpf_admin`, `email_admin`, `senha_admin`, `status_admin`, `id_privilegio_admin`) VALUES
(1, 'Hairton Sobral Silva', '10366182692', 'hairtonsena@yahoo.com.br', '25d55ad283aa400af464c76d713c07ad', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome_categoria` varchar(35) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

CREATE TABLE IF NOT EXISTS `cidade` (
  `id_cidade` int(11) NOT NULL AUTO_INCREMENT,
  `nome_cidade` varchar(30) NOT NULL,
  `id_uf` int(3) NOT NULL,
  PRIMARY KEY (`id_cidade`),
  KEY `fk_uf` (`id_uf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `empreendimento`
--

CREATE TABLE IF NOT EXISTS `empreendimento` (
  `id_empreendimento` int(11) NOT NULL AUTO_INCREMENT,
  `nome_empreendimento` varchar(70) NOT NULL,
  `cpf_empreendimento` varchar(14) NOT NULL,
  `cnpj_empreendimento` varchar(18) NOT NULL,
  `endereco_empreendimento` varchar(70) NOT NULL,
  `bairro_empreendimento` varchar(50) NOT NULL,
  `telefone_empreendimento` varchar(15) NOT NULL,
  `web_empreendimento` varchar(100) NOT NULL,
  `descricao_empreendimento` text,
  `logo_empreendimento` varchar(50) DEFAULT NULL,
  `data_cadastro_empreendimento` date NOT NULL,
  `status_empreendimento` int(1) NOT NULL,
  `id_tipo_empreendimento` int(2) NOT NULL,
  `id_sub_categoria` int(11) NOT NULL,
  `id_cidade` int(11) NOT NULL,
  PRIMARY KEY (`id_empreendimento`),
  KEY `fk_tipo_empreendimento` (`id_tipo_empreendimento`),
  KEY `fk_sub_categoria` (`id_sub_categoria`),
  KEY `fk_cidade` (`id_cidade`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `privilegio_admin`
--

CREATE TABLE IF NOT EXISTS `privilegio_admin` (
  `id_privilegio_admin` int(2) NOT NULL AUTO_INCREMENT,
  `nome_privilegio_admin` varchar(30) NOT NULL,
  PRIMARY KEY (`id_privilegio_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `privilegio_admin`
--

INSERT INTO `privilegio_admin` (`id_privilegio_admin`, `nome_privilegio_admin`) VALUES
(1, 'super');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sub_categoria`
--

CREATE TABLE IF NOT EXISTS `sub_categoria` (
  `id_sub_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome_sub_categoria` varchar(35) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id_sub_categoria`),
  KEY `fk_categoria` (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_empreendimento`
--

CREATE TABLE IF NOT EXISTS `tipo_empreendimento` (
  `id_tipo_empreendimento` int(2) NOT NULL,
  `nome_tipo_empreendimento` varchar(30) NOT NULL,
  PRIMARY KEY (`id_tipo_empreendimento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `uf`
--

CREATE TABLE IF NOT EXISTS `uf` (
  `id_uf` int(3) NOT NULL AUTO_INCREMENT,
  `nome_uf` varchar(30) NOT NULL,
  PRIMARY KEY (`id_uf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_privilegio_admin` FOREIGN KEY (`id_privilegio_admin`) REFERENCES `privilegio_admin` (`id_privilegio_admin`);

--
-- Limitadores para a tabela `cidade`
--
ALTER TABLE `cidade`
  ADD CONSTRAINT `fk_uf` FOREIGN KEY (`id_uf`) REFERENCES `uf` (`id_uf`);

--
-- Limitadores para a tabela `empreendimento`
--
ALTER TABLE `empreendimento`
  ADD CONSTRAINT `fk_cidade` FOREIGN KEY (`id_cidade`) REFERENCES `cidade` (`id_cidade`),
  ADD CONSTRAINT `fk_sub_categoria` FOREIGN KEY (`id_sub_categoria`) REFERENCES `sub_categoria` (`id_sub_categoria`),
  ADD CONSTRAINT `fk_tipo_empreendimento` FOREIGN KEY (`id_tipo_empreendimento`) REFERENCES `tipo_empreendimento` (`id_tipo_empreendimento`);

--
-- Limitadores para a tabela `sub_categoria`
--
ALTER TABLE `sub_categoria`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
