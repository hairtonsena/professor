-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 20-Nov-2014 às 00:48
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

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_privilegio_admin` FOREIGN KEY (`id_privilegio_admin`) REFERENCES `privilegio_admin` (`id_privilegio_admin`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
