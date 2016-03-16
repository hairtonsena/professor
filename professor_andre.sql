-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 01/08/2015 às 20:34
-- Versão do servidor: 5.5.44-0ubuntu0.14.04.1
-- Versão do PHP: 5.5.9-1ubuntu4.11

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
  `email_aluno` varchar(70) DEFAULT NULL,
  `status_aluno` int(1) NOT NULL,
  PRIMARY KEY (`id_aluno`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Fazendo dump de dados para tabela `aluno`
--

INSERT INTO `aluno` (`id_aluno`, `nome_aluno`, `matricula_aluno`, `senha_aluno`, `cpf_aluno`, `email_aluno`, `status_aluno`) VALUES
(1, 'Danilo Moabb', '321232', '25d55ad283aa400af464c76d713c07ad', '293.512.508-81', NULL, 1),
(2, 'Vilson Cordeiro', '654123', '', '308.022.635-69', NULL, 1),
(3, 'Grazy coutinho', '111225', '813cabec90f224a91068c10e2898ee8a', '907.226.868-70', NULL, 1),
(4, 'Simone Sobral', '521463', '', '99999999999', NULL, 1),
(5, 'Vinicios Silva', '321456', 'e10adc3949ba59abbe56e057f20f883e', '42352868033', NULL, 1),
(6, 'Janice Oliveira', '741258', '', '481.077.520-82', NULL, 1),
(7, 'Hairton Sobral', '101112', '25d55ad283aa400af464c76d713c07ad', '103.661.826-92', 'hairtonsena@yahoo.com.br', 1),
(8, 'Murilo Sandiego', '101113', 'd41d8cd98f00b204e9800998ecf8427e', '812.235.745-80', NULL, 1),
(9, 'Fabrício Dias', '111215', 'c4c777dc4811f11bffae3da4191dcb98', '732.214.835-54', NULL, 1),
(10, 'Roberto Jorge', '111219', 'd41d8cd98f00b204e9800998ecf8427e', '250.266.537-07', NULL, 1),
(11, 'Excluir este', '000000', '78c59e005c5c61b6657df0d5ae9cc9d9', '446.076.431-81', NULL, 1),
(12, 'Outro apagar', '111310', '9b6bad319487a1ce5c968771a6d1de1b', '354.004.318-79', NULL, 1),
(13, 'João de Almeida Costa', '141511', 'debddf53f8ce0eeb9026e3c5b4288c7a', '486.260.754-30', 'joao@hotmail.com', 1);

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
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(5, 3),
(13, 3),
(1, 4),
(5, 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `anexo_trabalho`
--

CREATE TABLE IF NOT EXISTS `anexo_trabalho` (
  `id_anexo_trabalho` int(11) NOT NULL AUTO_INCREMENT,
  `nome_anexo_trabalho` varchar(120) NOT NULL,
  `arquivo_anexo_trabalho` varchar(120) DEFAULT NULL,
  `trabalho_id_trabalho` int(11) NOT NULL,
  PRIMARY KEY (`id_anexo_trabalho`,`trabalho_id_trabalho`),
  KEY `fk_anexo_trabalho_trabalho1_idx` (`trabalho_id_trabalho`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Fazendo dump de dados para tabela `anexo_trabalho`
--

INSERT INTO `anexo_trabalho` (`id_anexo_trabalho`, `nome_anexo_trabalho`, `arquivo_anexo_trabalho`, `trabalho_id_trabalho`) VALUES
(1, 'RESULTADO-DA-ANÁLISE-DE-RECURSO-SAÚDE.pdf', 'RESULTADO-DA-ANÁLISE-DE-RECURSO-SAÚDE.pdf', 12),
(2, 'RESULTADO-DA-ANÁLISE-DE-RECURSO-SAÚDE1.pdf', 'RESULTADO-DA-ANÁLISE-DE-RECURSO-SAÚDE1.pdf', 12),
(3, 'boleto_dominio.pdf', 'boleto_dominio.pdf', 12);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Fazendo dump de dados para tabela `avaliacao`
--

INSERT INTO `avaliacao` (`id_avaliacao`, `descricao_avaliacao`, `data_avaliacao`, `valor_avaliacao`, `turma_id_turma`) VALUES
(2, '2ª Avaliação', '2015-01-21', 20, 1),
(3, '3ª Avaliação', '2015-01-30', 20, 1),
(4, '1ª Avaliação', '2015-01-31', 25, 4),
(5, 'ultima', '2015-01-31', 10, 1),
(6, 'Aparece', '2015-02-28', 10, 4),
(7, '1ª Avaliação', '2015-01-22', 10, 3),
(8, 'completa', '2015-01-31', 35, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Fazendo dump de dados para tabela `avaliacao_recuperacao`
--

INSERT INTO `avaliacao_recuperacao` (`id_avaliacao_recuperacao`, `descricao_avaliacao_recuperacao`, `data_avaliacao_recuperacao`, `valor_avaliacao_recuperacao`, `turma_id_turma`) VALUES
(1, 'Avaliação de Recuperação', '2015-07-06', 100, 1),
(2, 'Avaliação de Recuperação', '0000-00-00', 100, 5);

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
(2, 'Português', '<p>Est&aacute; &eacute; uma descria&ccedil;&atilde;o falando sobre os principais focos que a disciplina pretende atingir.</p>\n', 1),
(3, 'Redes de Computadores', '<div style="text-align: justify;"><span style="font-size:13px">O aluno ter&aacute; a oportunidade de conhecer os fundamentos b&aacute;sicos do processo de comunica&ccedil;&atilde;o entre computadores. Ir&aacute; estudar os principais desafios, conceitos, protocolos, arquiteturas e tecnologias existentes nesta &aacute;rea de pesquisa sob constante evolu&ccedil;&atilde;o. Ap&oacute;s o curso, o aluno ter&aacute; uma s&oacute;lida forma&ccedil;&atilde;o te&oacute;rica para estudos avan&ccedil;ados na &aacute;rea.</span></div>\n', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Fazendo dump de dados para tabela `nota_avaliacao`
--

INSERT INTO `nota_avaliacao` (`id_nota`, `valor_nota`, `aluno_id_aluno`, `avaliacao_id_avaliacao`) VALUES
(6, 9, 4, 2),
(7, 19, 5, 2),
(8, 15, 6, 2),
(10, 10, 4, 3),
(11, 15, 5, 3),
(12, 7, 6, 3),
(18, 3, 4, 5),
(19, 5, 5, 5),
(20, 0, 6, 5),
(21, 0, 3, 8),
(22, 0, 4, 8),
(23, 15, 5, 8),
(24, 0, 6, 8),
(25, 10, 3, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Fazendo dump de dados para tabela `nota_avaliacao_recuperacao`
--

INSERT INTO `nota_avaliacao_recuperacao` (`id_nota_avaliacao_recuperacao`, `valor_nota_avaliacao_recuperacao`, `avaliacao_recuperacao_id_avaliacao_recuperacao`, `aluno_id_aluno`) VALUES
(4, 0, 1, 4),
(5, 0, 1, 6),
(6, 65, 1, 5);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Fazendo dump de dados para tabela `nota_trabalho`
--

INSERT INTO `nota_trabalho` (`id_nota_trabalho`, `valor_nota_trabalho`, `aluno_id_aluno`, `trabalho_id_trabalho`) VALUES
(2, 0, 3, 12),
(3, 0, 4, 12),
(4, 5, 5, 12),
(5, 0, 6, 12);

-- --------------------------------------------------------

--
-- Estrutura para tabela `noticia`
--

CREATE TABLE IF NOT EXISTS `noticia` (
  `id_noticia` int(11) NOT NULL AUTO_INCREMENT,
  `url_noticia` varchar(120) NOT NULL,
  `titulo_noticia` varchar(120) NOT NULL,
  `imagem_mini_noticia` varchar(50) DEFAULT NULL,
  `conteudo_noticia` text NOT NULL,
  `data_noticia` date NOT NULL,
  `status_noticia` int(1) NOT NULL,
  PRIMARY KEY (`id_noticia`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Fazendo dump de dados para tabela `noticia`
--

INSERT INTO `noticia` (`id_noticia`, `url_noticia`, `titulo_noticia`, `imagem_mini_noticia`, `conteudo_noticia`, `data_noticia`, `status_noticia`) VALUES
(10, 'PALESTRA-Gestao-de-Conflitos-Palestrante-Prof-Menegatti', 'PALESTRA: Gestão de Conflitos - Palestrante Prof. Menegatti', 'mini_e2f5b36c2a1d1aa1c97f0f7bb9960ddd.jpg', '<p><strong>Esse tema &eacute; uma sugest&atilde;o que servir&aacute; de base para o primeiro contato. Ap&oacute;s o briefing, o Prof. Menegatti customizar&aacute; a palestra de acordo com as informa&ccedil;&otilde;es passadas pelo cliente. Se desejar, escolha mais de uma palestra ou sugira novos t&oacute;picos.</strong></p>\n<p>&nbsp;<img style="display: block; margin-left: auto; margin-right: auto;" src="/andre/noticia/source/topo_novo(1).jpg" alt="" width="400" height="119" /></p>\n<p><strong>&raquo; Palestra:&nbsp;COMO LIDAR COM CONFLITOS NO AMBIENTE DE TRABALHO<br /></strong><br />Se voc&ecirc; passa a maior parte do tempo no trabalho, que tal investir num ambiente produtivo e harmonioso?</p>\n<p><img style="display: block; margin-left: auto; margin-right: auto;" src="/andre/noticia/source/img_3048.jpg" alt="" width="400" /></p>\n<p>As empresas est&atilde;o com muita dificuldade de comunica&ccedil;&atilde;o, conviv&ecirc;ncia, trabalho em equipe e insubordina&ccedil;&atilde;o dos funcion&aacute;rios. O resultado disso &eacute; que 87% das demiss&otilde;es s&atilde;o geradas por defici&ecirc;ncia em rela&ccedil;&otilde;es interpessoais e n&atilde;o por incapacidade t&eacute;cnica. Para se ter uma ideia, da maioria dos colaboradores que s&atilde;o mandados embora, apenas 20% assumem que tiveram dificuldades pessoais, outros 80% descarregam a culpa nos colegas e na empresa.</p>', '2015-02-02', 1),
(11, 'Inicio-da-aulas', 'Início da aulas', NULL, '<h1 style="color: #ff0000;">In&iacute;cio da aulas</h1>\n<p>As aulas est&atilde;o voutando e todo devem se prepara par mais um semestre.<br />Espero que possa aproveirar ao m&aacute;ximo este semestre.</p>', '2014-02-04', 1),
(12, 'Teste-de-data', 'Teste de data', NULL, '<p>Este &eacute; apenas um teste de data para ver se a ordena&ccedil;&atilde;o esta correta</p>', '2015-01-28', 1),
(13, 'Teste-de-tabala', 'Teste de tabala', 'mini_dd1e15b57d7519d8a64cc2da726a5a52.jpg', '<table class=" table table-bordered">\n<tbody>\n<tr>\n<td><strong>asdfasdf</strong></td>\n<td><strong>asdfasdfsadf</strong></td>\n<td><strong>asdfasdfsadf</strong></td>\n</tr>\n<tr>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n</tr>\n<tr>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n<td>&nbsp;</td>\n</tr>\n</tbody>\n</table>', '2015-02-05', 1),
(14, 'Danilo-Moabb_1', 'Danilo Moabb', 'CONVITE.jpg', '<p>Hairton sobral silva</p>\n<p><img src="/andre/noticia/source/GADO1.jpg" alt="" width="300" height="199" /></p>\n<p>lasdlflasdfl</p>\n<p><img src="/andre/noticia/source/iconePregao05.png" alt="" width="214" height="140" /></p>', '2015-02-04', 1);

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
  `imagem_professor` varchar(45) DEFAULT NULL,
  `sobre_professor` text,
  PRIMARY KEY (`id_professor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Fazendo dump de dados para tabela `professor`
--

INSERT INTO `professor` (`id_professor`, `nome_professor`, `email_professor`, `senha_professor`, `cpf_professor`, `imagem_professor`, `sobre_professor`) VALUES
(1, 'Hairton Sobral Silva', 'hairtonsena@yahoo.com.br', '25d55ad283aa400af464c76d713c07ad', '12345678901', '30dc999a12bc4f377335ac07ec5745f5.jpg', '<p>Este &eacute; um texto teste s&oacute; para ver como vai ficar na pagina de sobre do professor andre aristotoles de administra&ccedil;&atilde;o. kkkk</p>\n');

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
(12, 'Trabalho para testar', 'Parafraseando o dicionário Houaiss, matemática e? a ciência que se ocupa do estudo de objetos abstratos, tais quais, como nu?meros, figuras e funções, e estabelece relações existentes entre eles. Para tanto, e? uma ciência que exige raciocínio lógico. Na Pre?-Histo?ria, os pastores na?o tinham nenhum conhecimento matemático, mas sabiam comparar as grandezas.', '2015-02-08', 15, 1, 1, 'pas_54b024287497c');

-- --------------------------------------------------------

--
-- Estrutura para tabela `trabalho_aluno`
--

CREATE TABLE IF NOT EXISTS `trabalho_aluno` (
  `id_trabalho_aluno` int(11) NOT NULL AUTO_INCREMENT,
  `data_envio_trabalho_aluno` date NOT NULL,
  `hora_envio_trabalho_aluno` time NOT NULL,
  `nome_arquivo_trabalho_aluno` varchar(120) NOT NULL,
  `aluno_id_aluno` int(11) NOT NULL,
  `trabalho_id_trabalho` int(11) NOT NULL,
  PRIMARY KEY (`id_trabalho_aluno`,`aluno_id_aluno`,`trabalho_id_trabalho`),
  KEY `fk_trabalho_aluno_aluno1_idx` (`aluno_id_aluno`),
  KEY `fk_trabalho_aluno_trabalho1_idx` (`trabalho_id_trabalho`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Fazendo dump de dados para tabela `trabalho_aluno`
--

INSERT INTO `trabalho_aluno` (`id_trabalho_aluno`, `data_envio_trabalho_aluno`, `hora_envio_trabalho_aluno`, `nome_arquivo_trabalho_aluno`, `aluno_id_aluno`, `trabalho_id_trabalho`) VALUES
(1, '0000-00-00', '00:00:00', 'CURRICULUM-VITAE-ANEXO-III.pdf', 5, 12);

-- --------------------------------------------------------

--
-- Estrutura para tabela `turma`
--

CREATE TABLE IF NOT EXISTS `turma` (
  `id_turma` int(11) NOT NULL AUTO_INCREMENT,
  `nome_turma` varchar(45) NOT NULL,
  `horario_turma` text,
  `status_turma` int(1) NOT NULL,
  `disciplina_id_disciplina` int(5) NOT NULL,
  PRIMARY KEY (`id_turma`,`disciplina_id_disciplina`),
  KEY `fk_turma_disciplina_idx` (`disciplina_id_disciplina`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Fazendo dump de dados para tabela `turma`
--

INSERT INTO `turma` (`id_turma`, `nome_turma`, `horario_turma`, `status_turma`, `disciplina_id_disciplina`) VALUES
(1, '210', '<table border="1" cellpadding="1" cellspacing="1" class="table table-bordered" style="width:100%">\n	<tbody>\n		<tr>\n			<td style="text-align:center"><strong>Segunda</strong></td>\n			<td style="text-align:center"><strong>Ter&ccedil;a</strong></td>\n			<td style="text-align:center"><strong>Quarta</strong></td>\n			<td style="text-align:center"><strong>Quinta</strong></td>\n			<td style="text-align:center"><strong>Ter&ccedil;a</strong></td>\n		</tr>\n		<tr>\n			<td>asdf</td>\n			<td>asdf</td>\n			<td>as</td>\n			<td>sfd</td>\n			<td>dsf</td>\n		</tr>\n		<tr>\n			<td>asd</td>\n			<td>sadf</td>\n			<td>ffff</td>\n			<td>fdsf</td>\n			<td>&nbsp;</td>\n		</tr>\n		<tr>\n			<td>as</td>\n			<td>asdf</td>\n			<td>asd</td>\n			<td>sdf</td>\n			<td>sdf</td>\n		</tr>\n	</tbody>\n</table>\n\n<p>&nbsp;</p>\n', 1, 3),
(3, 'agora', NULL, 2, 3),
(4, 'Literatura', NULL, 1, 2),
(5, '240', NULL, 1, 1);

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
-- Restrições para tabelas `trabalho_aluno`
--
ALTER TABLE `trabalho_aluno`
  ADD CONSTRAINT `fk_trabalho_aluno_aluno1` FOREIGN KEY (`aluno_id_aluno`) REFERENCES `aluno` (`id_aluno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_trabalho_aluno_trabalho1` FOREIGN KEY (`trabalho_id_trabalho`) REFERENCES `trabalho` (`id_trabalho`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `fk_turma_disciplina` FOREIGN KEY (`disciplina_id_disciplina`) REFERENCES `disciplina` (`id_disciplina`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
