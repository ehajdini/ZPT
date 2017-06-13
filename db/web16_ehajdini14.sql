-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 13, 2017 at 08:44 PM
-- Server version: 5.5.55-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `web16_ehajdini14`
--

-- --------------------------------------------------------

--
-- Table structure for table `assistance`
--

CREATE TABLE IF NOT EXISTS `assistance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jobseeker_id` varchar(10) NOT NULL,
  `assistance_request` tinyint(1) NOT NULL,
  `assistance_confirmation` tinyint(1) NOT NULL,
  `money` int(11) NOT NULL,
  `date` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jobseeker_id` (`jobseeker_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `assistance`
--

INSERT INTO `assistance` (`id`, `jobseeker_id`, `assistance_request`, `assistance_confirmation`, `money`, `date`) VALUES
(1, 'J12321648F', 1, 0, 0, NULL),
(2, 'J12343678F', 1, 1, 7000, NULL),
(3, 'J12356678T', 0, 0, 0, NULL),
(5, 'J12345678V', 0, 0, 0, NULL),
(6, 'J12346678Q', 1, 0, 0, NULL),
(7, 'J18987678A', 0, 0, 0, NULL),
(8, 'J24324323K', 1, 1, 0, NULL),
(9, 'J41216041W', 1, 0, 0, NULL),
(10, 'J15446678T', 1, 0, 0, NULL),
(11, 'J42341443L', 0, 0, 0, NULL),
(12, 'J42341423P', 1, 1, 7000, NULL),
(13, 'J12354678F', 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE IF NOT EXISTS `business` (
  `nipt` char(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nr_of_workers` int(11) NOT NULL DEFAULT '0',
  `nr_of_vacant_pos` int(11) DEFAULT '0',
  `about` text,
  `email` varchar(30) DEFAULT NULL,
  `phone` char(10) DEFAULT NULL,
  PRIMARY KEY (`nipt`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`nipt`, `name`, `password`, `nr_of_workers`, `nr_of_vacant_pos`, `about`, `email`, `phone`) VALUES
('A12345670A', 'Era Catering', '$2y$10$gi.wB/7qNbVA4NVFR/uc9upPSX.tS2NA0kQs1y9f/.JRWVoM7vvZ2', 3, 7, 'A small company based in Tirana, whose aim is to improve the air quality.', 'era@gmail.com', '0681234563'),
('A12345673A', 'Nokia Tirana', '$2y$10$HXYkVmn4ny0E6Bf8JyA9Z.ygq9QbTjQ2MwEJQ68bqIVJ4xqk3eS0G', 0, 0, 'Connecting the world!', 'nokia@hotmail.com', '0691234567');

-- --------------------------------------------------------

--
-- Table structure for table `business_workers`
--

CREATE TABLE IF NOT EXISTS `business_workers` (
  `nipt` char(10) NOT NULL,
  `id` char(10) NOT NULL,
  `name` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_workers`
--

INSERT INTO `business_workers` (`nipt`, `id`, `name`, `surname`) VALUES
('A12345670A', 'A12345678I', 'Trason', 'Smith'),
('A12345670A', 'A12345678N', 'Frida ', 'Oshafi'),
('A12345670A', 'J12345678N', 'Stephan', 'Hawkings');

-- --------------------------------------------------------

--
-- Table structure for table `consulence`
--

CREATE TABLE IF NOT EXISTS `consulence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jobseeker_id` varchar(10) NOT NULL,
  `consulence_request` int(11) NOT NULL,
  `consulence_confirmation` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `consulence`
--

INSERT INTO `consulence` (`id`, `jobseeker_id`, `consulence_request`, `consulence_confirmation`, `date`) VALUES
(1, 'J12321648F', 1, 0, NULL),
(2, 'J12343678F', 1, 0, NULL),
(3, 'J12356678T', 0, 0, NULL),
(4, 'J12356908T', 1, 0, NULL),
(5, 'J12345678V', 1, 0, NULL),
(6, 'J12346678Q', 1, 0, NULL),
(7, 'J18987678A', 0, 0, NULL),
(8, 'J24324323K', 1, 0, NULL),
(9, 'J41216041W', 1, 0, NULL),
(10, 'J15446678T', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobseeker`
--

CREATE TABLE IF NOT EXISTS `jobseeker` (
  `ID` varchar(11) NOT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `Name` varchar(20) NOT NULL,
  `Surname` varchar(20) NOT NULL,
  `Registerdate` varchar(12) NOT NULL,
  `Profession` varchar(30) DEFAULT NULL,
  `Number` varchar(15) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Gender` varchar(11) NOT NULL,
  `Training` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobseeker`
--

INSERT INTO `jobseeker` (`ID`, `Password`, `Name`, `Surname`, `Registerdate`, `Profession`, `Number`, `Email`, `Gender`, `Training`) VALUES
('J12321648F', '$2y$10$cNphmhW5pv4tgKRnpWUG4eKZDqMV0KhA5Mel.i7qg6FYlRx./5W0K', 'Lori', 'Bode', '10-06-2017', 'Designer', '+355691891111', 'loribode@gmail.com', 'Female', NULL),
('J12343678F', '$2y$10$cNphmhW5pv4tgKRnpWUG4eKZDqMV0KhA5Mel.i7qg6FYlRx./5W0K', 'Altin', 'Lame', '10-06-2017', 'Electrician', '+355674312421', 'altinlame@gmail.com', 'Male', NULL),
('J12345678V', '$2y$10$gi.wB/7qNbVA4NVFR/uc9upPSX.tS2NA0kQs1y9f/.JRWVoM7vvZ2', 'Uendi', 'Ahemetaj', '10-06-2017', 'Babysitter', '+355691434313', 'uendiahmetaj@gmail.com', 'Female', NULL),
('J12346678Q', '$2y$10$cNphmhW5pv4tgKRnpWUG4eKZDqMV0KhA5Mel.i7qg6FYlRx./5W0K', 'Tim', 'Pavli', '10-06-2017', 'Plumber', '+355691890111', 'timpavli@tim.com', 'Male', NULL),
('J12354678F', NULL, 'Cara', 'Chan', '12-06-2017', 'Cleaner', '+35569134313', 'caesarvance@mail.com', 'Female', NULL),
('J12356678T', '$2y$10$cNphmhW5pv4tgKRnpWUG4eKZDqMV0KhA5Mel.i7qg6FYlRx./5W0K', 'Bora', 'Ziko', '10-06-2017', 'Economist', '+355694330111', 'boraziko@outlook.com', 'Female', NULL),
('J15446678T', '$2y$10$cNphmhW5pv4tgKRnpWUG4eKZDqMV0KhA5Mel.i7qg6FYlRx./5W0K', 'Ann', 'Satoui', '10-06-2017', 'Hairdresser', '+355697894313', 'annsatoui@link.com', 'Female', NULL),
('J18987678A', '$2y$10$gi.wB/7qNbVA4NVFR/uc9upPSX.tS2NA0kQs1y9f/.JRWVoM7vvZ2', 'Sigi', 'Lima', '10-06-2017', 'Seller', '+355691114313', 'sigilima@mmd.com', 'Female', NULL),
('J24324323K', '$2y$10$cNphmhW5pv4tgKRnpWUG4eKZDqMV0KhA5Mel.i7qg6FYlRx./5W0K', 'Cara', 'Jones', '10-06-2017', 'Lawyer', '+355692111113', 'timjones@tim.com', 'Male', NULL),
('J42341443L', NULL, 'Sara', 'Gjoni', '11-06-2017', 'DishWasher', '+355694345342', 'sgjoni@mail.com', 'Female', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mediation`
--

CREATE TABLE IF NOT EXISTS `mediation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nipt` char(10) NOT NULL,
  `pid` char(10) NOT NULL,
  `confirmation` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mediation`
--

INSERT INTO `mediation` (`id`, `nipt`, `pid`, `confirmation`) VALUES
(1, 'A12345673A', 'J18987678A', 1);

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE IF NOT EXISTS `salary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` char(10) NOT NULL,
  `base` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pid` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`id`, `pid`, `base`) VALUES
(1, 'J12355678A', 45000),
(4, 'J24324323K', 35000),
(5, 'J12321678F', 45000),
(6, 'J12340078K', 20000),
(7, 'J12846678T', 25000),
(8, 'J12456778O', 30000),
(9, 'J12365478A', 55000),
(10, 'J97845612P', 1000000),
(11, 'J42398094R', 9990),
(12, 'J42341443P', 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id` char(10) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `directory` varchar(30) DEFAULT NULL,
  `position` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `previouswdays` int(11) DEFAULT NULL,
  `workingdays` int(11) NOT NULL,
  `salary` int(11) NOT NULL,
  `startingdate` varchar(15) DEFAULT NULL,
  `gender` tinyint(4) NOT NULL,
  `office` varchar(6) NOT NULL,
  `confirmation` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `password`, `directory`, `position`, `email`, `phone`, `name`, `surname`, `previouswdays`, `workingdays`, `salary`, `startingdate`, `gender`, `office`, `confirmation`) VALUES
('J12321678F', 'ee11cbb19052e40b07aac0ca060c23ee', 'juridik', 'Lawyer', 'timjones@zpt.gov.al', '+355692111113', 'Tim', 'Jones', 0, 0, 30682, '05-06-2017', 1, 'J100', 1),
('J12340078K', NULL, NULL, 'Sanitary', 'anakoti@zpt.gov.al', '+355691890111', 'Ana', 'Koti', 0, 0, 1818, '05-06-2017', 0, 'N000', 1),
('J12346678T', 'ee11cbb19052e40b07aac0ca060c23ee', 'finance1', 'Financier', 'timchan@zpt.gov.al', '+355692111113', 'Tim', 'Chan', 0, 0, 0, '03-06-2017', 1, 'F200', 1),
('J12355678A', 'ee11cbb19052e40b07aac0ca060c23ee', 'hr', 'HR', 'carajo@zpt.gov.al', '+355691111113', 'Cara', 'Jones', 0, 0, 30682, '03-06-2017', 0, 'H200', 1),
('J12365478A', 'ee11cbb19052e40b07aac0ca060c23ee', 'finance2', 'Financier', 'carastevens@zpt.gov.al', '+355234874443', 'Cara', 'Stevens', 0, 0, 35000, '05-06-2017', 0, 'F300', 1),
('J12385421Y', '6ad14ba9986e3615423dfca256d04e3f', 'admin', 'Administrator', 'fatmirylli@zpt.gov.al', '+355684651254', 'Fatmir', 'Ylli', 0, 0, 0, '07-06-2017', 1, 'D100', 1),
('J12456778O', '6ad14ba9986e3615423dfca256d04e3f', 'trainings', 'TrainingsManager', 'markotto@zpt.gov.al', '+355691890111', 'Marc', 'Otto', 0, 0, 1364, '05-06-2017', 1, 'H200', 1),
('J12846678T', '3cfcb061ac3b4fbef0b85b955a8951e5', 'finance2', 'Secretary', 'silvabruce@zpt.gov.al', '+355686767678', 'Silva', 'Bruce', 0, 0, 31818, '05-06-2017', 0, 'S100', 1),
('J23131542G', NULL, NULL, 'VicePresident', 'vasilperparimi@zpt.gov.al', '+355696545124', 'Vasil', 'Perparimi', 0, 0, 0, '07-06-2017', 1, 'D200', 1),
('J23154300O', '6ad14ba9986e3615423dfca256d04e3f', 'vacancy', 'VacancyManager', 'gentianvasili@zpt.gov.al', '+355686543211', 'Gentian', 'Vasili', 0, 0, 0, '07-06-2017', 1, 'H500', 1),
('J24324323K', NULL, NULL, 'Accountant', 'airisatou@zpt.gov.al', '+355691111113', 'Airi', 'Satou', 2, 0, 3182, '05-06-2017', 1, 'F200', 1),
('J42341443P', 'ee11cbb19052e40b07aac0ca060c23ee', 'informatizimi', 'IT', 'albanhoxha@zpt.gov.al', '+355694345342', 'Alban', 'Hoxha', 1, 0, 0, '11-06-2017', 1, 'T100', 1),
('J42398094R', '6ad14ba9986e3615423dfca256d04e3f', 'jobseeker', 'HR', 'albanpavli@zpt.gov.al', '+355694521132', 'Alban', 'Pavli', 0, 0, 0, '07-06-2017', 1, 'H300', 1),
('J97845612P', '6ad14ba9986e3615423dfca256d04e3f', 'info', 'Informatizimi', 'afrimkostandini@zpt.gov.al', '+355968754821', 'Afrim', 'Kostandini', 1, 0, 45455, '07-06-2017', 1, 'H200', 1);

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

CREATE TABLE IF NOT EXISTS `trainings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` longtext NOT NULL,
  `start` varchar(20) NOT NULL,
  `end` varchar(20) NOT NULL,
  `places` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `trainings`
--

INSERT INTO `trainings` (`id`, `title`, `description`, `start`, `end`, `places`) VALUES
(3, 'Kurs pÃ«r Programet Financa 5 dhe Alpha', 'Me datÃ« 10 03 2017 fillon kursi pÃ«r programet e Administrimit Financiar dhe KontabÃ«l tÃ« KompanisÃ« Financa 5 dhe Alpha Business. Kursi do tÃ« ju njohÃ« me hapat qÃ« duhen ndjekur pÃ«r rregjistrimin e njÃ« kompanie, rregjistrim e shitjeve, blerjeve mÃ« specifikisht do ti gjeni nÃ« programin e trajnimit duke klikuar nÃ«: Financa 5 - Alpha Business', '2017-10-03', '2017-11-15', 16),
(4, 'Kurs pÃ«r Web-Design', 'Se Shpejti fillon kursi pÃ«r Web-Design. MÃ«soni se si ndÃ«rtohen faqen e internetit dhe bÃ«huni pjesÃ« e saj qÃ« navigoni Ã§do ditÃ« me anÃ« Laptopit, SmartPhon-it tuaj apo desktopit. PÃ«r tu njohur me programin e kursi mund tÃ« vizitoni linkun WebDesign', '2017-06-11', '2017-06-30', 10),
(5, 'Gjermanisht Niveli B1', 'Sapo ka filluar kursi i GjuhÃ«s Gjermane pÃ«r nivelin B1 - Mesatar. Kursi zhvillohet me metoda interaktive duke pÃ«rdorur mjetet e fundit tÃ« teknlogjisÃ« pÃ«r dÃ«gjimin, leximin dhe shkrimin. Libri i pÃ«rdorur pÃ«r kÃ«tÃ« kurs Ã«shtÃ« CORNELSEN. Kursi zhvillohet sipas standarteve tÃ« CEFR (Common European Framework of Reference for Foreign Languages). Kursi do tÃ« zhvillohet nÃ« 25 Seanca nga 120 minuta, frekuenca e numrit tÃ« seancave dhe orari i zhvillimit tÃ« kursit do tÃ« pÃ«rcaktohet nga Grupi.\r\nKushdo qÃ« nuk ka pasur ndonjÃ«herÃ« kontakt me gjuhÃ«n Gjermane por edhe ata persona qÃ« kanÃ« pasur njÃ« kontakt shumÃ« tÃ« pakÃ«t me tÃ« komunikuarit nÃ« gjuhÃ«n Gjermane quhen fillestar dhe i pÃ«rkasin nivelit A1.\r\n\r\nMegjithatÃ« kushdo qÃ« nuk Ã«shtÃ« i sigurt pÃ«r nivelin tÃ« cilit i pÃ«rket atÃ«here ju duhet vetÃ«m tÃ« na kontaktoni me format e mÃ«poshtme dhe tÃ« rregjistroheni nÃ«pÃ«rmjet Internetit ose pranÃ« ambjenteve tona nÃ« mÃ«nyrÃ« qÃ« tÃ« bÃ«ni njÃ« test pranÃ« ITK-sÃ« dhe tÃ« siguroheni pÃ«r nivelin tÃ« cilit i pÃ«rkisni.Kontaktoni', '2017-07-01', '2017-08-01', 20),
(6, 'Kurs per Parukeri', 'Kursi i parukerisÃ« zhvillohet nÃ« kabinete tÃ« veÃ§anta pÃ«r zhvillimin e pjesÃ«s teorike. Kursanteve ju demonstrohen tÃ« gjitha teknikat nÃ« mÃ«nyrÃ« teorike duke u shpjeguar Ã§do element i procesit tÃ« punÃ«s dhe nÃ« tÃ« njÃ«jtÃ«n kohÃ« ato demonstrohen me video projektor. NdÃ«rsa kabineti tjetÃ«r i praktikÃ«s Ã«shtÃ« i kompletuar me 12 vende pune, ku secila prej kursanteve ka kukullÃ«n e vet tÃ« punÃ«s. NÃ« kÃ«tÃ« mjedis mÃ«sohet qÃ« nga krehja e flokÃ«ve, llojet e ndryshme tÃ« prerjeve deri tek stilimi sipas metoda bashkÃ«kohore dhe tÃ« pÃ«rparuara.\r\nKursi Ã«shtÃ« i ndarÃ« nÃ« katÃ«r nivele me kohÃ«zgjatje 300 orÃ«.\r\nNÃ« pÃ«rfundim tÃ« kÃ«tij kursi, kursanti pÃ«rfiton kÃ«to njohuri dhe aftÃ«si:\r\nNÃ« fund tÃ« nivelit tÃ« parÃ« fitohet njohja me mjetet e parukerisÃ« dhe stilimit, llojet e ndryshme te prerjeve, llojet e ndryshme tÃ« krehjes dhe zbatimi i tyre nÃ« praktikÃ«.\r\nNÃ« fund tÃ« nivelit tÃ« dytÃ« fitohen njohuri si kombinimet e ngjyrave nÃ« ngjyrosjen e flokÃ«ve, llojet e ndryshme tÃ« permanentit dhe ushtrimi i tyre nÃ« praktikÃ«.\r\nNÃ« fund tÃ« nivelit tÃ« tretÃ« fitohen njohuri si prerje tÃ« ndryshme, stilim nusesh, modele tÃ« ndryshme nusesh, make-up i syve fytyrÃ«s dhe qafÃ«s', '2017-08-01', '2018-02-01', 20),
(7, 'Kurs per Rrobaqepesi', 'Kursi pÃ«r rrobaqepÃ«si zhvillohet nÃ« njÃ« kabinet tÃ« ngritur dhe tÃ« kompletuar duke pasur parasysh qÃ« Ã§do kursant tÃ« ketÃ« vendin e tij tÃ« punÃ«s . pra pÃ«r secilin kursant ka njÃ« makinÃ« qepÃ«se. Edhe nÃ« kÃ«tÃ« kurs programet mÃ«simore parashikojnÃ« qÃ« raporti midis pjesÃ«s teorike dhe asaj praktike tÃ« jetÃ« 80% praktikÃ« dhe 20%teori. KÃ«tu kursanti mÃ«son qÃ« nga pÃ«rgatitja dhe qepja e fundit tÃ« thjeshtÃ« dhe deri te kostumi. Numri maksimal i kursantÃ«ve pÃ«r njÃ« grup Ã«shtÃ« 12. Kursi i plotÃ« pÃ«r rrobaqepÃ«si pÃ«rbÃ«het nga 600 orÃ« mÃ«simore dhe ofrohet nÃ« 6 nivele.\r\nNÃ« pÃ«rfundim tÃ« kÃ«tij kursi, kursanti pÃ«rfiton kÃ«to njohuri dhe aftÃ«si:\r\nNÃ« fund tÃ« nivelit tÃ« parÃ« realizohet njohja me mjetet e rrobaqepÃ«sisÃ«, kallÃ«pet, pÃ«rgatitja e kallÃ«pit pÃ«r fundin, bluzÃ«n, fustanin e thjeshtÃ«, si dhe prerjen e qepjen e tyre.\r\nNÃ« fund tÃ« nivelit tÃ« dytÃ« realizohet pÃ«rgatitja e kallÃ«peve dhe prerja e pantallonave pÃ«r gra, burra dhe fÃ«mijÃ«, pÃ«rgatitja e kallÃ«peve pÃ«r kÃ«misha grash dhe burrash, fustane tÃ« ndÃ«rlikuara, si dhe prerja e qepja e tyre.\r\nNÃ« fund tÃ« nivelit tÃ« tretÃ« realizohet pÃ«rgatitja e kallÃ«pit pÃ«r modele pantallonash tÃ« ndÃ«rlikuara pÃ«r burra, kallÃ«pe tÃ« pjesÃ«ve pÃ«rbÃ«rÃ«se tÃ« xhaketÃ«s pÃ«r burra dhe gra, si dhe prerjen dhe qepjen e xhaketÃ«s si pÃ«r burra dhe gra.', '2017-06-02', '2017-09-02', 5);

-- --------------------------------------------------------

--
-- Table structure for table `vacancy`
--

CREATE TABLE IF NOT EXISTS `vacancy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nipt` char(10) NOT NULL,
  `position` varchar(20) NOT NULL,
  `places` int(11) NOT NULL,
  `announced_date` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `vacancy`
--

INSERT INTO `vacancy` (`id`, `nipt`, `position`, `places`, `announced_date`) VALUES
(1, 'A12345670A', 'Waiter', 2, '11-06-2017'),
(2, 'A12345673A', 'Seller', 1, '11-06-2017'),
(3, 'A12345670A', 'DishWasher', 2, '11-06-2017');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `salary`
--
ALTER TABLE `salary`
  ADD CONSTRAINT `salary_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `staff` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
