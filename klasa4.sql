-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 03 Cze 2022, 05:27
-- Wersja serwera: 10.4.16-MariaDB
-- Wersja PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `klasa4`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `accounts`
--

CREATE TABLE `accounts` (
  `ID` int(11) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `accounts`
--

INSERT INTO `accounts` (`ID`, `email`, `password`, `name`) VALUES
(2, 'kamilada2002@wp.pl', '098f6bcd4621d373cade4e832627b4f6', 'Koke'),
(4, 'moke123@wp.pl', 'adasaasdasdasdasdasdasd', 'moke'),
(5, 'roke@wp.pl', 'axzcasd', 'roke1337');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `done_question`
--

CREATE TABLE `done_question` (
  `ID` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `ID_QUIZ` int(11) NOT NULL,
  `PROCENT` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `done_question`
--

INSERT INTO `done_question` (`ID`, `ID_USER`, `ID_QUIZ`, `PROCENT`) VALUES
(1, 2, 1, 100),
(2, 2, 1, 33.3),
(3, 2, 2, 50),
(4, 2, 3, 33.3),
(5, 2, 3, 100),
(6, 2, 2, 100),
(7, 2, 1, 100),
(8, 2, 2, 100),
(9, 2, 3, 33.3),
(10, 2, 2, 33.3),
(11, 2, 3, 33.3),
(12, 2, 1, 0),
(13, 2, 2, 0),
(14, 2, 2, 0),
(15, 2, 2, 33.3),
(16, 2, 2, 33.3),
(17, 2, 3, 33.3),
(18, 2, 1, 75),
(19, 2, 1, 75),
(20, 2, 1, 75),
(21, 2, 1, 75),
(22, 2, 1, 75),
(23, 2, 1, 75),
(24, 2, 1, 25),
(25, 2, 2, 66.7),
(26, 2, 2, 33.3),
(27, 2, 3, 33.3),
(28, 2, 1, 75),
(29, 2, 1, 100),
(30, 2, 1, 100),
(31, 2, 4, 0),
(32, 2, 2, 0),
(33, 2, 2, 0),
(34, 2, 2, 33.3),
(35, 2, 1, 75),
(36, 2, 2, 33.3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `news`
--

CREATE TABLE `news` (
  `ID` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `autor` varchar(32) NOT NULL,
  `date` date NOT NULL,
  `text` varchar(3228) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `news`
--

INSERT INTO `news` (`ID`, `title`, `autor`, `date`, `text`) VALUES
(1, 'Ogloszenie', 'Admin', '2021-09-06', 'Ogłoszenie – krótka forma wypowiedzi, w której autor ogłasza coś odbiorcy. W ogłoszeniu treść powinna być maksymalnie streszczona, przy czym zawarte powinny być wszelkie niezbędne informacje.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `questions`
--

CREATE TABLE `questions` (
  `ID` int(11) NOT NULL,
  `ID_QUIZ` int(11) NOT NULL,
  `question` varchar(1228) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `questions`
--

INSERT INTO `questions` (`ID`, `ID_QUIZ`, `question`) VALUES
(1, 1, '{\"question\":\"Ile to 2+2\",\"answear\":[\"6\",\"5\",\"4\",\"1\"],\"coretant\":2}'),
(2, 1, '{\"question\":\"Ile to 125+5\",\"answear\":[\"130\",\"125\",\"140\",\"145\"],\"coretant\":0}'),
(3, 1, '{\"question\":\"Czy 111 + 111 to 222?\",\"answear\":[\"tak\",\"nie\"],\"coretant\":0}'),
(4, 1, '{\"question\":\"2+x=6\",\"answear\":[\"5\",\"3\",\"4\"],\"coretant\":2}'),
(5, 2, '{\"question\":\"Ile to 5*8?\",\"answear\":[\"35\",\"40\",\"65\",\"20\"],\"coretant\":1}'),
(6, 2, '{\"question\":\"Ile to 7*9?\",\"answear\":[\"63\",\"72\",\"52\",\"45\"],\"coretant\":0}'),
(7, 2, '{\"question\":\"Ile to 3*8?\",\"answear\":[\"22\",\"32\",\"18\",\"24\"],\"coretant\":3}'),
(8, 3, '{\"question\":\"ile wzrostu ma pan patryk\",\"answear\":[\"150 w kapeluszu \",\"180jak siedzi\",\"130 to polecam\"],\"coretant\":0}'),
(9, 3, '{\"question\":\"ile madzia ma koni\",\"answear\":[\"80\",\"110\",\"280\"],\"coretant\":2}'),
(10, 3, '{\"question\":\"ile dziordzio wazy\",\"answear\":[\"tona\",\"dwie\",\"tego sie nieda obliczyc \"],\"coretant\":2}');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `quizes`
--

CREATE TABLE `quizes` (
  `ID` int(11) NOT NULL,
  `ID_AUTHOR` int(11) NOT NULL,
  `title` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `quizes`
--

INSERT INTO `quizes` (`ID`, `ID_AUTHOR`, `title`) VALUES
(1, 2, 'Dodawanie'),
(2, 2, 'Tabliczka mnożenia');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `done_question`
--
ALTER TABLE `done_question`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`ID`);
ALTER TABLE `questions` ADD FULLTEXT KEY `question` (`question`);
ALTER TABLE `questions` ADD FULLTEXT KEY `question_2` (`question`);

--
-- Indeksy dla tabeli `quizes`
--
ALTER TABLE `quizes`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `accounts`
--
ALTER TABLE `accounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `done_question`
--
ALTER TABLE `done_question`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT dla tabeli `news`
--
ALTER TABLE `news`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `questions`
--
ALTER TABLE `questions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `quizes`
--
ALTER TABLE `quizes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
