-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 09, 2018 alle 13:25
-- Versione del server: 10.1.21-MariaDB
-- Versione PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alternanza_lettere`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `account`
--

CREATE TABLE `account` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `tipoAccount` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `account`
--

INSERT INTO `account` (`username`, `password`, `tipoAccount`) VALUES
('admin', 'admin', 'admin'),
('prof', 'prof', 'insegnante'),
('prof2', 'prof2', 'insegnante'),
('prof3', 'prof3', 'insegnante'),
('prof5', 'prof5', 'insegnante'),
('st', 'st', 'studente'),
('stud', 'stud', 'studente'),
('stud5', 'stud5', 'studente');

-- --------------------------------------------------------

--
-- Struttura della tabella `elencoquiz`
--

CREATE TABLE `elencoquiz` (
  `id` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `insegnante` varchar(255) NOT NULL,
  `classe` varchar(10) NOT NULL,
  `materia` varchar(20) NOT NULL,
  `attiva` varchar(2) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `elencoquiz`
--

INSERT INTO `elencoquiz` (`id`, `nome`, `insegnante`, `classe`, `materia`, `attiva`) VALUES
('quiz08/02/2018_01:32:12pm', 'testQ', 'prof', '1A', 'Italiano', 'si'),
('quiz08/02/2018_01:38:54pm', 'afdaf', 'prof', '1A', 'Italiano', 'no'),
('quiz09/02/2018_12:01:41pm', 'dfdsf', 'prof', '1A', 'Italiano', 'no');

-- --------------------------------------------------------

--
-- Struttura della tabella `insegnante`
--

CREATE TABLE `insegnante` (
  `username` varchar(20) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `insegnante`
--

INSERT INTO `insegnante` (`username`, `nome`, `cognome`) VALUES
('prof', 'prof', 'prof'),
('prof2', 'prof2', 'prof2'),
('prof3', 'prof3', 'prof3'),
('prof5', 'prof5', 'prof5');

-- --------------------------------------------------------

--
-- Struttura della tabella `quiz08/02/2018_01:32:12pm`
--

CREATE TABLE `quiz08/02/2018_01:32:12pm` (
  `id` int(255) NOT NULL,
  `tipoDomanda` varchar(30) NOT NULL,
  `testoDomanda` varchar(255) NOT NULL,
  `risposte` varchar(255) NOT NULL,
  `rispostaCorretta` varchar(255) NOT NULL,
  `punti` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `quiz08/02/2018_01:32:12pm`
--

INSERT INTO `quiz08/02/2018_01:32:12pm` (`id`, `tipoDomanda`, `testoDomanda`, `risposte`, `rispostaCorretta`, `punti`) VALUES
(1, 'v-f', 'vero', 'vero*falso', 'vero', 1),
(2, 'multi', 'nsnn', 'n*s*n*n', 's', 2),
(3, 'fill', 'a * b *', 'a*b*c*d* * *-a*b*c*d* * *', 'b*c*', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `quiz08/02/2018_01:38:54pm`
--

CREATE TABLE `quiz08/02/2018_01:38:54pm` (
  `id` int(255) NOT NULL,
  `tipoDomanda` varchar(30) NOT NULL,
  `testoDomanda` varchar(255) NOT NULL,
  `risposte` varchar(255) NOT NULL,
  `rispostaCorretta` varchar(255) NOT NULL,
  `punti` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `quiz08/02/2018_01:38:54pm`
--

INSERT INTO `quiz08/02/2018_01:38:54pm` (`id`, `tipoDomanda`, `testoDomanda`, `risposte`, `rispostaCorretta`, `punti`) VALUES
(2, 'multi', 'ciao', 'c*i*a*o', 'c', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `quiz09/02/2018_12:01:41pm`
--

CREATE TABLE `quiz09/02/2018_12:01:41pm` (
  `id` int(255) NOT NULL,
  `tipoDomanda` varchar(30) NOT NULL,
  `testoDomanda` varchar(255) NOT NULL,
  `risposte` varchar(255) NOT NULL,
  `rispostaCorretta` varchar(255) NOT NULL,
  `punti` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `quiz09/02/2018_12:01:41pm`
--

INSERT INTO `quiz09/02/2018_12:01:41pm` (`id`, `tipoDomanda`, `testoDomanda`, `risposte`, `rispostaCorretta`, `punti`) VALUES
(1, 'fill', 'sfd *  fsd ', 'fsd*gfdsg*s* * * *', 'gfdsg*', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `risultati`
--

CREATE TABLE `risultati` (
  `id` int(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `codiceQuiz` varchar(255) NOT NULL,
  `risposte` varchar(255) DEFAULT 'vuoto',
  `punteggio` float DEFAULT '0',
  `consegnato` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `risultati`
--

INSERT INTO `risultati` (`id`, `username`, `codiceQuiz`, `risposte`, `punteggio`, `consegnato`) VALUES
(23, 'stud', 'quiz08/02/2018_01:32:12pm', 'vero*s*-*c*', 4.5, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `studente`
--

CREATE TABLE `studente` (
  `username` varchar(20) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `classe` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `studente`
--

INSERT INTO `studente` (`username`, `nome`, `cognome`, `classe`) VALUES
('st', 'Kevin', 'Cicia', '1N'),
('stud', 'studente', 'studente', '1A'),
('stud5', 'studente5', 'studente5', '3E');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`username`);

--
-- Indici per le tabelle `elencoquiz`
--
ALTER TABLE `elencoquiz`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `insegnante`
--
ALTER TABLE `insegnante`
  ADD PRIMARY KEY (`username`);

--
-- Indici per le tabelle `quiz08/02/2018_01:32:12pm`
--
ALTER TABLE `quiz08/02/2018_01:32:12pm`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `quiz08/02/2018_01:38:54pm`
--
ALTER TABLE `quiz08/02/2018_01:38:54pm`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `quiz09/02/2018_12:01:41pm`
--
ALTER TABLE `quiz09/02/2018_12:01:41pm`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `risultati`
--
ALTER TABLE `risultati`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `studente`
--
ALTER TABLE `studente`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `quiz08/02/2018_01:32:12pm`
--
ALTER TABLE `quiz08/02/2018_01:32:12pm`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT per la tabella `quiz08/02/2018_01:38:54pm`
--
ALTER TABLE `quiz08/02/2018_01:38:54pm`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT per la tabella `quiz09/02/2018_12:01:41pm`
--
ALTER TABLE `quiz09/02/2018_12:01:41pm`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT per la tabella `risultati`
--
ALTER TABLE `risultati`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
