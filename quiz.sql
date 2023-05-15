-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 15, 2023 at 01:54 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `difficulty` varchar(50) DEFAULT NULL,
  `question` text,
  `correct_answer` text,
  `incorrect_answers` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `category`, `type`, `difficulty`, `question`, `correct_answer`, `incorrect_answers`) VALUES
(1, 'Entertainment: Video Games', 'multiple', 'hard', 'What was the name of the hero in the 80s animated video game \'Dragon\'s Lair\'?', 'Dirk the Daring', '[\"Arthur\",\"Sir%20Toby%20Belch\",\"Guy%20of%20Gisbourne\"]'),
(2, 'Animals', 'multiple', 'easy', 'What is the scientific name for modern day humans?', 'Homo Sapiens', '[\"Homo%20Ergaster\",\"Homo%20Erectus\",\"Homo%20Neanderthalensis\"]'),
(3, 'Entertainment: Books', 'multiple', 'hard', 'What is Ron Weasley\'s middle name?', 'Bilius', '[\"Arthur\",\"John\",\"Dominic\"]'),
(4, 'Entertainment: Comics', 'multiple', 'easy', 'Who is the creator of the comic series \"The Walking Dead\"?', 'Robert Kirkman', '[\"Stan%20Lee\",\"Malcolm%20Wheeler-Nicholson\",\"Robert%20Crumb\"]'),
(5, 'Entertainment: Board Games', 'multiple', 'medium', 'At the start of a standard game of the Monopoly, if you throw a double six, which square would you land on?', 'Electric Company', '[\"Water%20Works\",\"Chance\",\"Community%20Chest\"]'),
(6, 'Geography', 'multiple', 'easy', 'What is the capital of Jamaica?', 'Kingston', '[\"Rio%20de%20Janeiro\",\"Dar%20es%20Salaam\",\"Kano\"]'),
(7, 'History', 'multiple', 'medium', 'When did Jamaica recieve its independence from England? ', '1962', '[\"1492\",\"1963\",\"1987\"]'),
(8, 'Animals', 'boolean', 'easy', 'Kangaroos keep food in their pouches next to their children.', 'False', '[\"True\"]'),
(9, 'General Knowledge', 'multiple', 'medium', 'In 2013 how much money was lost by Nigerian scams?', '$12.7 Billion', '[\"%2495%20Million\",\"%24956%20Million\",\"%242.7%20Billion\"]'),
(10, 'History', 'multiple', 'medium', 'How old was Lyndon B. Johnson when he assumed the role of President of the United States?', '55', '[\"50\",\"60\",\"54\"]'),
(11, 'Entertainment: Video Games', 'multiple', 'hard', 'In World of Warcraft lore, who organized the creation of the Paladins?', 'Alonsus Faol', '[\"Uther%20the%20Lightbringer\",\"Alexandros%20Mograine\",\"Sargeras%2C%20The%20Daemon%20Lord\"]'),
(12, 'Entertainment: Video Games', 'boolean', 'medium', 'In the game \"Subnautica\", a \"Cave Crawler\" will attack you.', 'True', '[\"False\"]'),
(13, 'Entertainment: Japanese Anime & Manga', 'multiple', 'medium', 'What is the name of the device that allows for infinite energy in the anime \"Dimension W\"?', 'Coils', '[\"Wires\",\"Collectors\",\"Tesla\"]'),
(14, 'Entertainment: Video Games', 'multiple', 'medium', 'What is the name of Cream the Rabbit\'s mom in the \"Sonic the Hedgehog\" series?', 'Vanilla', '[\"Peach\",\"Strawberry\",\"Mint\"]'),
(15, 'History', 'multiple', 'easy', 'These two countries held a commonwealth from the 16th to 18th century.', 'Poland and Lithuania', '[\"Hutu%20and%20Rwanda\",\"North%20Korea%20and%20South%20Korea\",\"Bangladesh%20and%20Bhutan\"]'),
(16, 'Entertainment: Television', 'multiple', 'hard', 'Which of these voices wasn\'t a choice for the House AI in \"The Simpsons Treehouse of Horror\" short, House of Whacks?', 'George Clooney', '[\"Matthew%20Perry\",\"Dennis%20Miller\",\"Pierce%20Brosnan\"]'),
(17, 'Entertainment: Music', 'multiple', 'medium', 'From which album is the Gorillaz song, \"On Melancholy Hill\" featured in?', 'Plastic Beach', '[\"Demon%20Days\",\"Humanz\",\"The%20Fall\"]'),
(18, 'General Knowledge', 'boolean', 'easy', 'Scotland voted to become an independent country during the referendum from September 2014.', 'False', '[\"True\"]'),
(19, 'Entertainment: Video Games', 'multiple', 'medium', 'In Left 4 Dead, which campaign has the protagonists going through a subway in order to reach a hospital for evacuation?', 'No Mercy', '[\"Subway%20Sprint\",\"Hospital%20Havoc\",\"Blood%20Harvest\"]'),
(20, 'History', 'multiple', 'hard', 'What was the last colony the UK ceded marking the end of the British Empire?', 'Hong Kong', '[\"India\",\"Australia\",\"Ireland\"]');

-- --------------------------------------------------------

--
-- Table structure for table `quizscores`
--

DROP TABLE IF EXISTS `quizscores`;
CREATE TABLE IF NOT EXISTS `quizscores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `score` int DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `quizscores`
--

INSERT INTO `quizscores` (`id`, `score`, `name`) VALUES
(10, 2, 'Saad'),
(9, 0, 'Abid'),
(8, 1, 'Saad'),
(7, 2, 'Satti'),
(11, 0, 'Waqar'),
(12, 1, 'Waqar'),
(13, 0, 'Satti'),
(14, 2, ''),
(15, 0, 'Waqar'),
(16, 0, 'Satti'),
(17, 0, 'Waqar'),
(18, 0, 'Waqar'),
(19, 0, 'Waqar'),
(20, 0, 'Waqar'),
(21, 0, ''),
(22, 0, ''),
(23, 0, 'Waqar'),
(24, 3, 'Waqar'),
(25, 1, 'Waqar');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
