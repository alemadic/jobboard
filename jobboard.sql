-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 01, 2020 at 04:42 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `anketaodgovori`
--

DROP TABLE IF EXISTS `anketaodgovori`;
CREATE TABLE IF NOT EXISTS `anketaodgovori` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdPitanja` int(11) NOT NULL,
  `IdKor` int(11) NOT NULL,
  `Odg` float NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `uq_pitanjeKor` (`IdPitanja`,`IdKor`),
  KEY `IdKor` (`IdKor`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anketaodgovori`
--

INSERT INTO `anketaodgovori` (`Id`, `IdPitanja`, `IdKor`, `Odg`) VALUES
(1, 1, 20, 1),
(2, 2, 20, 10),
(3, 1, 24, 0),
(4, 2, 24, 9),
(16, 3, 9, 1),
(17, 2, 9, 9);

-- --------------------------------------------------------

--
-- Table structure for table `firme`
--

DROP TABLE IF EXISTS `firme`;
CREATE TABLE IF NOT EXISTS `firme` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(50) NOT NULL,
  `Logo` varchar(50) NOT NULL,
  `IdPoslodavca` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Logo` (`Logo`),
  KEY `IdPoslodavca` (`IdPoslodavca`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `firme`
--

INSERT INTO `firme` (`Id`, `Naziv`, `Logo`, `IdPoslodavca`) VALUES
(11, 'IndiaNIC', 'slike/1585133432indianic.png', 5),
(12, 'Hewlett-Packard', 'slike/1585156104hp.png', 6),
(13, 'Net Worth LLC', 'slike/1585156643networth.png', 7),
(14, 'Family Wizard', 'slike/1585156735familywizard.jpg', 8),
(15, 'Coin Jar', 'slike/1585156772coinjar.png', 9),
(16, 'Holmbergs Tech', 'slike/1585156902holmbergs.png', 10),
(17, 'Ten Technology', 'slike/1585156948ten.png', 11),
(18, 'BT Development', 'slike/1585157012bt.png', 12),
(19, 'Calibrate LLC', 'slike/1585157102calibrate.jpg', 13),
(20, 'Enosis Marketing', 'slike/1585157392enosis.png', 14),
(21, 'Continental', 'slike/1585157451continental.png', 15),
(22, 'Global Marketing', 'slike/1585157495global.png', 16),
(23, 'Benet Bio', 'slike/1585157558benet.jpg', 17),
(25, 'Smart Media', 'slike/1585165461smartmedia.jpg', 19);

-- --------------------------------------------------------

--
-- Table structure for table `iskustvo`
--

DROP TABLE IF EXISTS `iskustvo`;
CREATE TABLE IF NOT EXISTS `iskustvo` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(30) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iskustvo`
--

INSERT INTO `iskustvo` (`Id`, `Naziv`) VALUES
(1, 'Junior'),
(2, 'Medior'),
(3, 'Senior'),
(4, 'Internship');

-- --------------------------------------------------------

--
-- Table structure for table `kategorije`
--

DROP TABLE IF EXISTS `kategorije`;
CREATE TABLE IF NOT EXISTS `kategorije` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Ime` varchar(50) NOT NULL,
  `Popularnost` tinyint(1) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Ime` (`Ime`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategorije`
--

INSERT INTO `kategorije` (`Id`, `Ime`, `Popularnost`) VALUES
(1, 'Software engineering', 1),
(2, 'Web development', 1),
(7, 'Mobile development', 0),
(8, 'Marketing', 0),
(9, 'Creative & design', 1),
(11, 'Tele Market', 0);

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

DROP TABLE IF EXISTS `korisnici`;
CREATE TABLE IF NOT EXISTS `korisnici` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Ime` varchar(30) DEFAULT NULL,
  `Prezime` varchar(50) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Lozinka` varchar(50) NOT NULL,
  `Cv` varchar(255) DEFAULT NULL,
  `UlogeId` tinyint(4) NOT NULL,
  `DatumKreiran` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `uqEmail` (`Email`),
  KEY `UlogeId` (`UlogeId`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`Id`, `Ime`, `Prezime`, `Email`, `Lozinka`, `Cv`, `UlogeId`, `DatumKreiran`) VALUES
(1, '', '', 'alemadic@gmail.com', 'alemadic', NULL, 2, '2020-03-25 10:37:56'),
(2, 'Aleksandar', 'Jakovljevic', 'acaspektor@gmail.com', 'd3bdc44d424e58da42c2dce023d0d4fe', 'userCvs/1585132911it2.pdf', 3, '2020-03-25 09:41:51'),
(3, 'Blake', 'Conally', 'modsi@gmail.com', 'a1a96d456fc279a866c93ebddf70dd39', 'userCvs/1585133167laboratorije.pdf', 3, '2020-03-25 09:46:07'),
(5, NULL, NULL, 'admin@india.com', '46673b769afeb8d3112ef03a72589659', NULL, 2, '2020-03-25 10:50:32'),
(6, NULL, NULL, 'hpadmin@gmail.com', 'aacb1c6927cf882206e35b3df67eb923', NULL, 2, '2020-03-25 17:08:24'),
(7, NULL, NULL, 'admin@networth.com', '9726bf731c7c6935f38b2c75bee0b198', NULL, 2, '2020-03-25 17:17:24'),
(8, NULL, NULL, 'admin@fwizard.com', 'd0723a17d6a4e865e860144d6c10a3e2', NULL, 2, '2020-03-25 17:18:55'),
(9, NULL, NULL, 'admin@coinjar.com', '669294e6374324a724ad63edc3abaa07', NULL, 2, '2020-03-25 17:19:32'),
(10, NULL, NULL, 'admin@holmber.com', 'd78c9469f04e0e3d44980a8233a6bcab', NULL, 2, '2020-03-25 17:21:42'),
(11, NULL, NULL, 'admin@ten.com', 'd9532da113c7dbbe725a14f8f1844b0b', NULL, 2, '2020-03-25 17:22:28'),
(12, NULL, NULL, 'admin@btd.com', '1a0d94c2765aa9007170aa859a90fc6c', NULL, 2, '2020-03-25 17:23:32'),
(13, NULL, NULL, 'admin@calibrate.com', 'ba213c57dd10b96970efcce3a54c18d0', NULL, 2, '2020-03-25 17:25:02'),
(14, NULL, NULL, 'admin@enosis.com', '3bb125cda18f5ad3ed75f3a7b1f70e0b', NULL, 2, '2020-03-25 17:29:52'),
(15, NULL, NULL, 'conti@gmail.com', 'e884efd48e09611c5699607bc497f1b9', NULL, 2, '2020-03-25 17:30:51'),
(16, NULL, NULL, 'admin@global.com', '235ac8ff28f564b59b396f25f1ad4db0', NULL, 2, '2020-03-25 17:31:35'),
(17, NULL, NULL, 'admin@benet.com', '9d7ca4544f368b3e1024e86d9d59f117', NULL, 2, '2020-03-25 17:32:39'),
(19, NULL, NULL, 'admin@smartm.com', 'fb74af8d2eb41f81f0ae001ad91b3afc', NULL, 2, '2020-03-25 19:44:21'),
(20, 'Stephen', 'Jordan', 'jordan@bulls.com', '5e761456804e455ece24468b010043d8', 'userCvs/1585165672praktikumbazepod.pdf', 3, '2020-03-25 18:47:52'),
(23, NULL, NULL, 'admin@jobboard.com', '069d7d017666ccc99ea64a2b5cd3ee7d', NULL, 1, '2020-03-26 09:24:19'),
(24, 'Michael', 'Jenkins', 'jenka@gmail.com', 'c2ed32d0cbb76dc1da45ce5738dfc561', 'userCvs/1585317666dummy.pdf', 3, '2020-03-27 13:01:06'),
(25, 'Pink', 'Panter', 'panter@gmail.com', '74d4429f5d201e4515ac21842d12cfbb', 'userCvs/1585730412dummy.pdf', 3, '2020-04-01 06:40:12'),
(28, 'Brzi', 'Gonzales', 'gonzales@gmail.com', 'c0010167d03a95d438cd184519dc05de', 'userCvs/1585730769dummy.pdf', 3, '2020-04-01 06:46:09');

-- --------------------------------------------------------

--
-- Table structure for table `lokacije`
--

DROP TABLE IF EXISTS `lokacije`;
CREATE TABLE IF NOT EXISTS `lokacije` (
  `Id` int(5) NOT NULL AUTO_INCREMENT,
  `Grad` varchar(50) NOT NULL,
  `Drzava` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lokacije`
--

INSERT INTO `lokacije` (`Id`, `Grad`, `Drzava`) VALUES
(1, 'San Francisco', 'CA'),
(2, 'Chicago', 'Il'),
(3, 'Miami', 'Fl'),
(4, 'New York', 'NY'),
(5, 'San Jose', 'CA'),
(6, 'Los Angeles', 'CA'),
(7, 'Seattle', 'Washington'),
(8, 'Boston', 'MA'),
(9, 'Austin', 'TX');

-- --------------------------------------------------------

--
-- Table structure for table `meni`
--

DROP TABLE IF EXISTS `meni`;
CREATE TABLE IF NOT EXISTS `meni` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Ime` varchar(50) NOT NULL,
  `Putanja` varchar(50) NOT NULL,
  `GlavnaNav` tinyint(1) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meni`
--

INSERT INTO `meni` (`Id`, `Ime`, `Putanja`, `GlavnaNav`) VALUES
(1, 'home', 'index.php', 1),
(2, 'Browse Job', 'jobs.php', 1),
(3, 'Contact', 'contact.php', 1),
(4, 'Log in', 'login.php', 0),
(5, 'Register', 'register.php', 0),
(7, 'Log out', 'logout.php', 0),
(9, 'Profile', 'profile.php', 0),
(10, 'Docs', 'docs.pdf', 1),
(11, 'Author', 'autor.php', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oglasi`
--

DROP TABLE IF EXISTS `oglasi`;
CREATE TABLE IF NOT EXISTS `oglasi` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Naslov` varchar(50) NOT NULL,
  `KategorijeId` int(11) NOT NULL,
  `Kreiran` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Rok` timestamp NOT NULL,
  `Plata` decimal(10,0) NOT NULL,
  `LokacijaId` int(11) NOT NULL,
  `Opis` text NOT NULL,
  `FirmaId` int(11) NOT NULL,
  `TipPoslaId` int(11) NOT NULL,
  `IskustvoId` int(11) NOT NULL,
  `Aktivan` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Id`),
  KEY `KategorijeId` (`KategorijeId`,`LokacijaId`,`FirmaId`,`TipPoslaId`,`IskustvoId`),
  KEY `TipPoslaId` (`TipPoslaId`),
  KEY `IskustvoId` (`IskustvoId`),
  KEY `FirmaId` (`FirmaId`),
  KEY `LokacijaId` (`LokacijaId`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oglasi`
--

INSERT INTO `oglasi` (`Id`, `Naslov`, `KategorijeId`, `Kreiran`, `Rok`, `Plata`, `LokacijaId`, `Opis`, `FirmaId`, `TipPoslaId`, `IskustvoId`, `Aktivan`) VALUES
(1, 'Web developer', 2, '2020-03-25 10:52:34', '2020-04-14 22:00:00', '89000', 9, 'A Web Developer is responsible for the coding, design and layout of a website according to a company\'s specifications. As the role takes into consideration user experience and function, a certain level of both graphic design and computer programming is necessary. Once a website has been created, a Web Developer will generally assist with the maintenance and upkeep of the website. You will work on: \r\nDevelop, test and integrate advanced e-commerce solutions for world wide famous clients. \r\nWork on implementing both client-specific and generic modules for Magento as well as integration between Magento and different systems. \r\nWork in Vagrant, Nginx, MySQL and PHP7, while quality and deployment are maintained by automated testing via continuous integration servers', 11, 1, 1, 1),
(4, 'Ruby/React Developer', 2, '2020-03-25 18:04:20', '2020-04-22 22:00:00', '87000', 6, 'We are seeking a senior-level Ruby/React developer to join our distributed team. The position includes responsibility for rapidly building and launching web applications to power new ventures.We compensate our employees with a fair salary package according to experience and skills. On top of that, we provide perks which extends further than monetary needs. \r\nYou must be able to work both independently and in a collaborative team environment, and meet required schedules and timelines\r\nFamiliarity with all layers of the web development stack (from database and infrastructure, to javascript and CSS).\r\nYou should be confident with Ruby on Rails, PostgreSQL, and React, our default tools.', 19, 2, 2, 1),
(5, 'C++ Programmer', 1, '2020-03-25 18:04:20', '2020-05-19 22:00:00', '92000', 8, 'If you are not afraid of C++, and if you are not afraid to dig deep and wrestle with pointers, virtual calls and memory allocation, and if you are not afraid of making code super-fast, and even sometimes to take a look at how assembler code looks like, then truly you are afraid of nothing. We need brave men and women. \r\nYou must have: Advanced knowledge of core programming skills, data structures and algorithms.\r\nYou will be part of our team for code vectorization and parallelization.\r\nWorking in stimulating environment with great possibilities for learning\r\nPlease apply here. ', 12, 1, 2, 1),
(6, 'iOS Software Engineer', 7, '2020-03-25 18:04:20', '2020-05-07 22:00:00', '104000', 5, 'We are looking for one iOS Medior Software Engineer.\r\n\r\nOur mission is to bring digital identities to the world. We want to give our users control over their digital identities. We strive to make users digital life easier and more secure by getting rid of passwords and mitigating thefts and frauds. You need to be working with iOS back-end services.', 16, 2, 4, 1),
(17, 'Back-End Developer', 2, '2020-03-26 05:40:06', '2020-03-23 23:00:00', '110000', 6, 'We are up-and-coming game development studio.\r\nWork primarily on remote game server and its connection to the games and rest of the platform. You will develop interactive content that runs on our online platform, in cooperation with Game Designers, Graphic Artists, Animators, Sound Designers, Mathematicians and Test Engineers.\r\nYou will work on: Develop, test and integrate advanced e-commerce solutions for world wide famous clients. Work on some of the most exciting projects in the field of e-commerce solutions', 21, 1, 2, 1),
(18, 'PHP/JavaScript Dev', 2, '2020-03-26 05:40:06', '2020-06-18 22:00:00', '83000', 9, 'We are an IT service and technology consultancy organization. Our focus is on customized IT solutions in JavaScript and open source environments. We offer our employees exciting projects and the opportunity to grow with us.We are looking for an additional developer to join our team and help us deliver some in-house projects and also to work with some of our clients. We are a remote-first company and you can work from any place in the world.\r\nYou have Experience with Laravel, Yii, Symfony or a similar MVC framework.', 16, 2, 1, 1),
(19, 'PHP/JavaScript Dev', 2, '2020-03-26 05:40:06', '2020-05-28 22:00:00', '99000', 2, 'We are seeking a PHP/JavaScript Developer (Intermediate+) to join our team of 250+ professionals across 40 countries. The successful candidate will work with a talented senior team to develop industry-leading applications with the latest technologies. The initial project is a complex audiovisual media and translation system.', 11, 1, 2, 1),
(20, '.NET Developer', 1, '2020-03-26 05:40:06', '2020-04-29 22:00:00', '120000', 3, 'With more than 300 tech solutions delivered over the past 18 years our deep expertise in software development allows us to provide one of the best products in the industry. We are looking for a .NET/C# Developer to join us in our Belgrade office and work in our team on different projects for large local and international clients. Your primary responsibilities will be to design and develop .NET/C# applications and to coordinate with the rest of the team working on different layers of the infrastructure. Therefore, a commitment to collaborative problem solving, sophisticated design, and quality products are essential.', 15, 1, 1, 1),
(21, 'Mobile Developer', 7, '2020-03-26 05:40:06', '2020-05-19 22:00:00', '85000', 8, 'We are looking for a React Native developer interested in building performant mobile apps on both the iOS and Android platforms. You will be responsible for architecting and building these applications, as well as coordinating with the teams responsible for other layers of the product infrastructure. Building a product is a highly collaborative effort, and as such, a strong team player with a commitment to perfection is required. You will: Build pixel-perfect, buttery smooth UIs across both mobile platforms.\r\n\r\nLeverage native APIs for deep integrations with both platforms.\r\n', 25, 1, 3, 1),
(22, 'Backend Developer', 1, '2020-03-26 05:40:06', '2020-05-19 22:00:00', '115000', 1, 'You will participate in designing and building robust backend systems to support core products. Cooperate with talented and highly experienced professionals to produce excellent code and unit tests. You will participate in designing and building robust backend systems to support core products.\r\n\r\nWe are proud to be an equal opportunity employer. We believe our differences help us create a better workplace, a better product, and a better community. We do not discriminate on the basis of race, color, ancestry, religion, national origin, marital status, pregnancy, sex.', 16, 1, 3, 1),
(29, 'Frontend engineer ', 2, '2020-03-26 05:57:03', '2020-04-16 22:00:00', '87000', 4, 'We are building modern web services for healthcare. Of our clients are world leading pharma and health companies including multiple fortune 500 companies . We\'re looking for experienced frontend engineers to join our frontend team and help us build great services in ReactJS and MobX. You are Senior 3+ years of relevant experience, Proficient in ReactJS, MobX, TS', 15, 1, 3, 1),
(30, 'HTML5 Game Developer', 7, '2020-03-26 05:57:03', '2020-05-13 22:00:00', '79000', 5, 'You will develop interactive content that runs on our online platform, in cooperation with Game Designers, Graphic Artists, Animators, Sound Designers, Mathematicians and Test Engineers.\r\nYOu need to be in: Object-oriented programming, design patterns. \r\n\r\nNodeJS and/or its frameworks', 18, 1, 4, 1),
(31, 'Android Application Developer', 7, '2020-03-26 05:57:03', '2020-06-24 22:00:00', '89000', 2, 'You role: Software development for Android based set top boxes through iWedia\'s projects with the most notable TV operators worldwide, Android TV applications design and development including defining of RESTful TV backend APIs for new UI applications, Working as a member of agile development team composed of application designers, Android system engineers and DTV middleware developers', 18, 2, 3, 1),
(32, 'iOS Software Engineer', 7, '2020-03-26 05:57:03', '2020-06-18 22:00:00', '86000', 8, 'Our mission is to bring digital identities to the world. We want to give our users control over their digital identities. We strive to make users digital life easier and more secure by getting rid of passwords and mitigating thefts and frauds.\r\nWorks on design, development, test, maintenance and documentation of software components (applications, services, products). Is actively involved in code review. Works with and helps other departments - QA, devops and design to better understand the product, potential issues and improvements to be applied', 18, 1, 2, 1),
(38, 'Embedded  Engineer', 1, '2020-03-27 14:50:17', '2020-05-21 22:00:00', '98000', 2, 'We develop financially successful products, services and business models for today\'s digital world from coming up with the initial idea through to the implementation and operation. We can achieve this by drawing on the experience of over 1000 in-house experts in different areas of technical expertise and you as new colleague can help us do even more.\r\nWe know that the team is greater than the sum of individuals. Work in multidisciplinary teams, international environment and projects. YOu have: A technical related degree. By now, you have gathered more than 4 years of relevant experience.', 18, 1, 2, 1),
(40, 'Embedded  Engineer', 1, '2020-03-27 14:50:20', '2020-05-21 22:00:00', '98000', 2, 'We develop financially successful products, services and business models for today\'s digital world from coming up with the initial idea through to the implementation and operation. We can achieve this by drawing on the experience of over 1000 in-house experts in different areas of technical expertise and you as new colleague can help us do even more.\r\nWe know that the team is greater than the sum of individuals. Work in multidisciplinary teams, international environment and projects. ', 18, 1, 2, 1),
(41, 'Java Dev', 1, '2020-03-27 14:50:20', '2020-05-27 22:00:00', '83000', 8, 'We are partnered up with some of the world\'s largest and biggest brands in the world such as Porsche, Amazon, IKEA, Deutsche bank.\r\nWork on advanced and large scale projects. Some of them are developed from scratch while others are already in development.\r\nGet a chance to apply and learn or improve your knowledge of the latest web technologies. \r\nActively take part in the decision-making process during the project development.\r\n', 15, 1, 2, 1),
(42, 'Fullstack Engineer', 2, '2020-03-27 14:53:39', '2020-06-10 22:00:00', '110000', 9, 'We are on the move and want to keep moving. We are farsighted. We are proactive. We are courageous. We are TX.\r\n\r\nAs we keep on expanding, we are currently looking for Senior Fullstack Engineers, and would like to welcome you on board with us very soon.\r\n\r\nDesign and deliver highly scalable multi-tiered distributed microservices.\r\nBuild next-generation web applications using modern frameworks', 12, 1, 1, 1),
(45, 'Marketer', 8, '2020-03-28 20:35:27', '2020-04-28 22:00:00', '3123', 3, 'dasd as dasd d aidh aiodhas uajdah sidhsaaduas9ahd asid ashdiaosd ashd aosi dhadoias dhsaid asoh dasodi as dhsadu ashduasi dhsau as', 11, 1, 4, 1),
(53, 'Proba v10', 7, '2020-03-31 02:37:02', '2020-04-04 22:00:00', '133123123', 5, 'asdsadas djaksdasdhsdhjlakdh asd hakd lashkldhasdlk ashdlasdh jsaldas asd sad asda', 14, 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `oglasitags`
--

DROP TABLE IF EXISTS `oglasitags`;
CREATE TABLE IF NOT EXISTS `oglasitags` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `OglasId` int(11) NOT NULL,
  `TagId` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pitanja`
--

DROP TABLE IF EXISTS `pitanja`;
CREATE TABLE IF NOT EXISTS `pitanja` (
  `IdPitanja` int(11) NOT NULL AUTO_INCREMENT,
  `Pitanje` varchar(70) NOT NULL,
  PRIMARY KEY (`IdPitanja`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pitanja`
--

INSERT INTO `pitanja` (`IdPitanja`, `Pitanje`) VALUES
(1, 'Have you found a job through our platform?'),
(2, 'How would you rate platform?'),
(3, 'Have you found employees through our platform?');

-- --------------------------------------------------------

--
-- Table structure for table `prijavaoglas`
--

DROP TABLE IF EXISTS `prijavaoglas`;
CREATE TABLE IF NOT EXISTS `prijavaoglas` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `IdOglasa` int(11) NOT NULL,
  `IdKorisnika` int(11) NOT NULL,
  `Poruka` text NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `uqi_korinisk_oglas` (`IdOglasa`,`IdKorisnika`),
  KEY `IdKorisnika` (`IdKorisnika`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prijavaoglas`
--

INSERT INTO `prijavaoglas` (`Id`, `IdOglasa`, `IdKorisnika`, `Poruka`) VALUES
(1, 1, 24, 'Hello, I am interested in this job. Want to hear more info'),
(2, 41, 20, 'Lorem ipsum dolor sit amet rsa dsa ds a das'),
(3, 42, 20, 'I wanna work here'),
(5, 41, 28, 'I want to take this job'),
(6, 1, 25, 'I want to work here');

-- --------------------------------------------------------

--
-- Table structure for table `slike`
--

DROP TABLE IF EXISTS `slike`;
CREATE TABLE IF NOT EXISTS `slike` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Putanja` varchar(50) NOT NULL,
  `Opis` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Ime` varchar(30) NOT NULL,
  `Popular` tinyint(1) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`Id`, `Ime`, `Popular`) VALUES
(1, 'Php', 1),
(2, 'Mysql', 1),
(3, 'JavaScript', 1),
(4, 'HTML', 0),
(5, 'CSS', 0),
(6, 'React', 1),
(7, 'Vue', 0),
(8, 'C#', 1),
(9, 'C++', 0),
(10, 'Adobe Photoshop', 1),
(11, 'Adobe Illustrator', 0),
(12, 'Sketch', 0),
(13, 'Java', 0),
(14, 'Node.js', 0),
(15, 'Ms office', 0),
(16, 'Adobe xd', 0),
(17, 'Php', 1),
(18, 'SEO', 0),
(19, 'Google analytics', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tipposla`
--

DROP TABLE IF EXISTS `tipposla`;
CREATE TABLE IF NOT EXISTS `tipposla` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `NazivTip` varchar(30) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipposla`
--

INSERT INTO `tipposla` (`Id`, `NazivTip`) VALUES
(1, 'Full-time'),
(2, 'Part-time');

-- --------------------------------------------------------

--
-- Table structure for table `uloge`
--

DROP TABLE IF EXISTS `uloge`;
CREATE TABLE IF NOT EXISTS `uloge` (
  `Id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(30) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uloge`
--

INSERT INTO `uloge` (`Id`, `Naziv`) VALUES
(1, 'admin'),
(2, 'Poslodavac'),
(3, 'Korisnik');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anketaodgovori`
--
ALTER TABLE `anketaodgovori`
  ADD CONSTRAINT `anketaodgovori_ibfk_1` FOREIGN KEY (`IdPitanja`) REFERENCES `pitanja` (`IdPitanja`),
  ADD CONSTRAINT `anketaodgovori_ibfk_2` FOREIGN KEY (`IdKor`) REFERENCES `korisnici` (`Id`);

--
-- Constraints for table `firme`
--
ALTER TABLE `firme`
  ADD CONSTRAINT `firme_ibfk_1` FOREIGN KEY (`IdPoslodavca`) REFERENCES `korisnici` (`Id`);

--
-- Constraints for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD CONSTRAINT `korisnici_ibfk_1` FOREIGN KEY (`UlogeId`) REFERENCES `uloge` (`Id`);

--
-- Constraints for table `oglasi`
--
ALTER TABLE `oglasi`
  ADD CONSTRAINT `oglasi_ibfk_1` FOREIGN KEY (`TipPoslaId`) REFERENCES `tipposla` (`Id`),
  ADD CONSTRAINT `oglasi_ibfk_2` FOREIGN KEY (`IskustvoId`) REFERENCES `iskustvo` (`Id`),
  ADD CONSTRAINT `oglasi_ibfk_3` FOREIGN KEY (`FirmaId`) REFERENCES `firme` (`Id`),
  ADD CONSTRAINT `oglasi_ibfk_4` FOREIGN KEY (`LokacijaId`) REFERENCES `lokacije` (`Id`),
  ADD CONSTRAINT `oglasi_ibfk_5` FOREIGN KEY (`KategorijeId`) REFERENCES `kategorije` (`Id`);

--
-- Constraints for table `prijavaoglas`
--
ALTER TABLE `prijavaoglas`
  ADD CONSTRAINT `prijavaoglas_ibfk_1` FOREIGN KEY (`IdOglasa`) REFERENCES `oglasi` (`Id`),
  ADD CONSTRAINT `prijavaoglas_ibfk_2` FOREIGN KEY (`IdKorisnika`) REFERENCES `korisnici` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
