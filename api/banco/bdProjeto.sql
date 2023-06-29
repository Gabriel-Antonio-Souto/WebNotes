-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 13/01/2022 às 21:47
-- Versão do servidor: 10.4.18-MariaDB
-- Versão do PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdProjeto`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbTexto`
--

CREATE TABLE `tbTexto` (
  `idTexto` int(11) NOT NULL,
  `tituloTexto` varchar(250) NOT NULL,
  `texto` text NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbUsuario`
--

CREATE TABLE `tbUsuario` (
  `idUsuario` int(11) NOT NULL,
  `nomeUsuario` varchar(250) NOT NULL,
  `emailUsuario` varchar(250) NOT NULL,
  `senhaUsuario` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tbTexto`
--
ALTER TABLE `tbTexto`
  ADD PRIMARY KEY (`idTexto`),
  ADD KEY `emailUsuario` (`idUsuario`);

--
-- Índices de tabela `tbUsuario`
--
ALTER TABLE `tbUsuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbTexto`
--
ALTER TABLE `tbTexto`
  MODIFY `idTexto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT de tabela `tbUsuario`
--
ALTER TABLE `tbUsuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
