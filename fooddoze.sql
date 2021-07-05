-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 22, 2021 at 02:21 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fooddoze`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `IDadmin` int(11) NOT NULL,
  `admin_name` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `admin_email` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `admin_password` varchar(255) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`IDadmin`, `admin_name`, `admin_email`, `admin_password`) VALUES
(3, 'Admin', 'admin@admin.com', '$2y$10$jqc5Lb3nO8wSX3qqXiOyTuis0iNO/8CISRkQrf32p27JhOYR4rHj.');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `IDclient` int(11) NOT NULL,
  `client_name` varchar(45) DEFAULT NULL,
  `client_first_name` varchar(255) DEFAULT NULL,
  `client_email` varchar(45) DEFAULT NULL,
  `client_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`IDclient`, `client_name`, `client_first_name`, `client_email`, `client_password`) VALUES
(40, 'Mario', 'Mario', 'mario@mario.ch', '$2y$10$lm3dGlTMzjueDYW0DfdH1OLhJSOjw50C8sv1nST9hOYsC01GHtjV.'),
(41, 'Mario', 'Luigi', 'luigi@mario.ch', '$2y$10$yTJ4QNkd6tOIOd.YH9qrX.4QNSEF7oVFp9JLG33zpe9mVsDFsd4fe');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `IDrecipe` int(11) NOT NULL,
  `recipe_name` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `recipe_category` varchar(255) NOT NULL,
  `recipe_ingredients` text CHARACTER SET utf8mb4 NOT NULL,
  `recipe_description` text CHARACTER SET utf8mb4 NOT NULL,
  `recipe_image` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `image_description` varchar(255) NOT NULL,
  `recipe_generated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`IDrecipe`, `recipe_name`, `recipe_category`, `recipe_ingredients`, `recipe_description`, `recipe_image`, `image_description`, `recipe_generated`) VALUES
(26, 'Bärlauch-Pasta', 'Pasta', '<h2>Zutaten f&uuml;r&nbsp;2&nbsp;Portionen</h2>\r\n\r\n<ul>\r\n	<li><strong>1/2 Bund</strong> B&auml;rlauch</li>\r\n	<li><strong>4 Bl </strong>Basilikum</li>\r\n	<li><strong>10 Stk </strong>Baumn&uuml;sse, kleingehackt</li>\r\n	<li><strong>1 Stk </strong>Knoblauchzehen</li>\r\n	<li><strong>1/2 Schuss </strong>Oliven&ouml;l</li>\r\n	<li><strong>1/2 Prise </strong>Pfeffer</li>\r\n	<li><strong>1/2 EL </strong>Salz</li>\r\n	<li><strong>1/2 Prise</strong> Salz</li>\r\n	<li><strong>200g </strong>Spaghetti</li>\r\n</ul>\r\n', '<h2>Zubereitung</h2>\r\n\r\n<ol>\r\n	<li>Fr&uuml;hlingszeit ist B&auml;rlauchzeit und in Kombination mit Pasta entstehen k&ouml;stliche B&auml;rlauch Spaghetti.</li>\r\n	<li>F&uuml;llen Sie 2 Liter Wasser in einen Topf und kochen Sie es auf, bis es sprudelt. Geben Sie einen Essl&ouml;ffel Salz und 400 Gramm Spaghetti hinzu.</li>\r\n	<li>Lassen Sie die Spaghettis 10 Minuten kochen, bis sie bissfest (al dente) sind, sch&uuml;tten Sie die Spaghetti durch ein Sieb ab und schrecken diese mit kalten Wasser ab.</li>\r\n	<li>Nun den B&auml;rlauch waschen, trocken sch&uuml;tteln und klein schneiden. Den Knoblauch sch&auml;len und fein hacken. Auch die Baumn&uuml;sse klein hacken.</li>\r\n	<li>Eine Pfanne mit einem Schuss Oliven&ouml;l (oder Butter) erhitzen, den Knoblauch, Baumn&uuml;sse und den B&auml;rlauch hinzuf&uuml;gen - ca. 1 Minute and&uuml;nsten und danach die Spaghetti hinzuf&uuml;gen.</li>\r\n	<li>Nochmals unter st&auml;ndigem R&uuml;hren 2 Minuten d&uuml;nsten und mit Salz und Pfeffer abschmecken.</li>\r\n	<li>Servieren Sie die fertigen B&auml;rlauch Spaghetti, garniert mit Basilikum und geriebenen Parmesan.</li>\r\n</ol>\r\n', 'baerlauch_pasta.jpeg', 'Pasta mit Bärlauch Sauce', '2021-06-07 07:09:43'),
(27, 'Peperoni Pasta', 'Pasta', '<h2>Zutaten f&uuml;r&nbsp;2&nbsp;Portionen</h2>\r\n\r\n<ul>\r\n	<li><strong>300 g </strong>Bandnudeln</li>\r\n	<li><strong>2 Stk </strong>Peperoni,&nbsp;rot</li>\r\n	<li><strong>1 Prise </strong>Pfeffer</li>\r\n	<li><strong>200 ml</strong> Rahm</li>\r\n	<li><strong>1 Prise </strong>Salz</li>\r\n	<li><strong>2 EL </strong>Tomatenmark</li>\r\n	<li><strong>1 Stk </strong>Zwiebel</li>\r\n</ul>\r\n', '<h2>Zubereitung</h2>\r\n\r\n<ol>\r\n	<li>Zuerst werden die Bandnudeln in einem grossen Topf mit kochendem Salzwasser bissfest gegart.</li>\r\n	<li>Unterdessen die Peperoni waschen, halbieren, entkernen und klein w&uuml;rfeln. Die Zwiebel sch&auml;len und fein hacken.</li>\r\n	<li>Beides in einer Pfanne f&uuml;r ca. 5&ndash;7 Minuten and&uuml;nsten.</li>\r\n	<li>Nun das Gem&uuml;se mit dem Rahm abl&ouml;schen und das Tomatenmark einr&uuml;hren. Aufkochen lassen und kurz etwas einkochen lassen.</li>\r\n	<li>Die fertigen Bandnudeln abgiessen und gut abtropfen lassen. Zuletzt die Peperoni-Rahm-Sauce mit Salz und Pfeffer abschmecken.</li>\r\n	<li>Die fertigen Bandnudeln an Peperoni-Rahm-Sauce umgehend anrichten und geniessen.</li>\r\n</ol>\r\n', 'peperoni_pasta.jpeg', 'Pasta mit Peperoni Sauce', '2021-06-07 07:17:17'),
(30, 'Leichte Sauerrahmsuppe', 'Suppe', '<h2>Zutaten f&uuml;r&nbsp;2&nbsp;Portionen</h2>\r\n\r\n<ul>\r\n	<li><strong>3/8 l</strong> Wasser</li>\r\n	<li><strong>1/2 TL</strong> K&uuml;mmel</li>\r\n	<li><strong>1/2 Becher </strong>Sauerrahm</li>\r\n	<li><strong>20 g </strong>Mehl</li>\r\n	<li><strong>1 1/2 Stk</strong> Knoblauchzehen</li>\r\n	<li><strong>1/2 TL </strong>Salz</li>\r\n</ul>\r\n', '<h2>Zubereitung</h2>\r\n\r\n<ol>\r\n	<li>In einem Topf den K&uuml;mmel mit dem Wasser aufkochen.</li>\r\n	<li>Das Mehl mit Sauerrahm gut verquirlen, danach sofort ins kochende K&uuml;mmelwasser einsprudeln.</li>\r\n	<li>Mit Knoblauch und Salz w&uuml;rzen und mit&nbsp;Suppengew&uuml;rz&nbsp;abschmecken.</li>\r\n</ol>\r\n', 'creme_suppe.jpeg', 'Creme Suppe', '2021-06-07 08:06:22'),
(32, 'Spargelcremesuppe', 'Suppe', '<h2>Zutaten f&uuml;r&nbsp;2&nbsp;Portionen</h2>\r\n\r\n<ul>\r\n	<li><strong>250 g </strong>Spargel</li>\r\n	<li><strong>250 g </strong>Gem&uuml;sesuppe bzw. Spargelfond</li>\r\n	<li><strong>15 g </strong>Butter</li>\r\n	<li><strong>1/2 TL </strong>Salz</li>\r\n	<li><strong>1/2 Prise</strong> Zucker</li>\r\n	<li><strong>1 EL</strong> Mehl</li>\r\n	<li><strong>50 ml </strong>Wei&szlig;wein</li>\r\n	<li><strong>1/2 Stk </strong>Eigelb</li>\r\n	<li><strong>100 ml </strong>Obers</li>\r\n	<li><strong>1 1/2 Prise</strong> Pfeffer (wei&szlig;)</li>\r\n	<li><strong>1 1/2 Prise </strong>Muskatnu&szlig;</li>\r\n	<li><strong>1/4 Stk </strong>Zitrone</li>\r\n</ul>\r\n', '<h2>Zubereitung</h2>\r\n\r\n<ol>\r\n	<li>F&uuml;r die Spargelcremesuppe den Spargel sch&auml;len und anschlie&szlig;end die K&ouml;pfe abschneiden.</li>\r\n	<li>Die Suppe zum Kochen bringen, 1 Teel&ouml;ffel Butter und eine Prise Zucker zugeben.</li>\r\n	<li>Die Spargelstangen ohne K&ouml;pfe in 2 cm lange St&uuml;cke schneiden und in der Br&uuml;he etwa 20 Minuten kochen lassen.</li>\r\n	<li>Wenn der Spargel weich ist, die Suppe vom Herd nehmen. Den Spargel in der Suppe mit dem P&uuml;rierstab gut p&uuml;rieren.</li>\r\n	<li>Die restliche Butter in einem Topf auf kleiner Flamme zerlassen und das Mehl gleichm&auml;&szlig;ig dar&uuml;berst&auml;uben und unter st&auml;ndigem r&uuml;hren goldgelb anschwitzen.</li>\r\n	<li>Nun den Wei&szlig;wein langsam unter st&auml;ndigem umr&uuml;hren dazugie&szlig;en und anschlie&szlig;end die Spargelsuppe dazugeben - das Ganze aufkochen, dann die Spargelk&ouml;pfe hinzugeben und etwa 12 Minuten sanft k&ouml;cheln.</li>\r\n</ol>\r\n', 'spargel_suppe.jpeg', 'Spargelcremesuppe', '2021-06-11 11:27:50'),
(33, 'Brokkoli-Penne', 'Pasta', '<p>&nbsp;</p>\r\n\r\n<h2>Zutaten f&uuml;r&nbsp;2&nbsp;Portionen</h2>\r\n\r\n<ul>\r\n	<li><strong>3/8 kg </strong>Brokkoli</li>\r\n	<li><strong>1/4 l </strong>Gem&uuml;sesuppe</li>\r\n	<li><strong>200 g</strong> Vollkornpenne</li>\r\n	<li><strong>80 g </strong>Roquefort</li>\r\n</ul>\r\n', '<h2>Zubereitung</h2>\r\n\r\n<ol>\r\n	<li>Zuerst Kohlsprossen in R&ouml;schen zerteilen und in kochendem Salzwasser kurz (nicht ganz weich)&nbsp;<a href=\"https://www.gutekueche.at/blanchieren-abbruehen-artikel-2637\">blanchieren</a>, Brokkoli danach abgie&szlig;en und abtropfen lassen. Danach Nudeln gem&auml;&szlig; Packungsanleitung kochen.</li>\r\n	<li>W&auml;hrenddessen Zwiebel w&uuml;rfeln und mit Brokkoli in einer beschichteten Pfanne in Butter und &Ouml;l anbraten. Nun Thymian hinzugeben und alles mit Mehl bestauben, kurz anschwitzen und mit Gem&uuml;sesuppe und Schlagobers abl&ouml;schen.</li>\r\n	<li>Danach Roquefort zerbr&ouml;seln und einmengen, mit Salz und Pfeffer w&uuml;rzen und alles kurz k&ouml;cheln lassen. Fertige Nudeln unterheben und mit Waln&uuml;ssen bestreut servieren.</li>\r\n</ol>\r\n', 'penne_broccoli.jpeg', 'Brokkoli Penne', '2021-06-11 11:51:17'),
(34, 'Burger', 'Gemuese', '<h2>Zutaten f&uuml;r 2 Burger</h2>\r\n\r\n<ul>\r\n	<li><strong>⅜&nbsp; Dose</strong> Kichererbsen &agrave; ca. 250 g, abgetropft</li>\r\n	<li><strong>100&nbsp;g</strong> K&uuml;rbis</li>\r\n	<li><strong>12&nbsp;g</strong> Sesamk&ouml;rner</li>\r\n	<li><strong>48&nbsp;g</strong> Toastbrot, gew&uuml;rfelt</li>\r\n	<li><strong>⅜</strong> Knoblauchzehe, fein gehackt</li>\r\n	<li><strong>1&frac14;&nbsp;EL</strong> Paniermehl</li>\r\n	<li><strong>⅜&nbsp;TL </strong>Paprikapulver</li>\r\n	<li><strong>80&nbsp;g </strong>H&uuml;ttenk&auml;se</li>\r\n	<li><strong>&frac34;&nbsp;EL</strong> Limettensaft</li>\r\n	<li><strong>&frac34;</strong> Thymianzweige</li>\r\n	<li><strong>1⅝ - 2⅜</strong> Vollkornbr&ouml;tchen</li>\r\n	<li><strong>12&nbsp;g</strong> Butter</li>\r\n	<li><strong>1 &frac14; </strong>Zwiebeln, in dicken Scheiben</li>\r\n	<li><strong>1 &frac14;&nbsp;</strong> EL Raps&ouml;l</li>\r\n</ul>\r\n', '<h2>Zubereitung</h2>\r\n\r\n<ol>\r\n	<li>Burger: Kichererbsen mit dem K&uuml;rbis in eine Sch&uuml;ssel geben. Mit dem P&uuml;rierstab p&uuml;rieren, so dass es noch kleine St&uuml;cke drin hat. Sesam in einer Pfanne ohne Fett r&ouml;sten. Sesam, Toastbrot, Knoblauch mit der Erbsen-K&uuml;rbismasse verr&uuml;hren, Paniermehl darunterr&uuml;hren, mit Paprikapulver und Salz w&uuml;rzen. Aus der Masse 4-6 Burger formen, k&uuml;hl stellen.</li>\r\n	<li>Limetten-H&uuml;ttenk&auml;se-Sauce: H&uuml;ttenk&auml;se mit Limettensaft und Thymian verr&uuml;hren, w&uuml;rzen.</li>\r\n	<li>Br&ouml;tchen halbieren und umgekehrt in einer Pfanne ohne Fett r&ouml;sten. Butter in einer Pfanne erhitzen und die Zwiebelscheiben darin knusprig braten.</li>\r\n	<li>Burger im heissen &Ouml;l von beiden Seiten ca. 6-8 Minuten braten. Kurz auf K&uuml;chenpapier abtropfen lassen. Je eine Br&ouml;tchenh&auml;lfte mit Salat, Burger, Zwiebeln und Limetten-H&uuml;ttenk&auml;se-Sauce belegen.</li>\r\n</ol>\r\n', 'veggieburger.jpeg', 'Veggie Burger', '2021-06-18 09:34:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD UNIQUE KEY `IDadmin` (`IDadmin`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`IDclient`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`IDrecipe`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `IDadmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `IDclient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `IDrecipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
