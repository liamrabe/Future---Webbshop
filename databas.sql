-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 11 mars 2020 kl 19:53
-- Serverversion: 10.4.11-MariaDB
-- PHP-version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `future`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `comments`
--

CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `post_id` int(10) NOT NULL,
  `content` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellstruktur `communities`
--

CREATE TABLE `communities` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `communities`
--

INSERT INTO `communities` (`id`, `name`, `url`) VALUES
(1, 'MateBook', 'matebook'),
(2, 'MateBuds', 'matebuds'),
(3, 'Mate X', 'matex'),
(4, 'Generell', 'general'),
(5, 'Övrigt', 'offtopic');

-- --------------------------------------------------------

--
-- Tabellstruktur `guestbook`
--

CREATE TABLE `guestbook` (
  `id` int(10) NOT NULL,
  `name` text NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `guestbook`
--

INSERT INTO `guestbook` (`id`, `name`, `message`, `timestamp`) VALUES
(1, 'John Doe', 'Wow, vilken sida.', '2020-03-04 09:26:12'),
(2, 'Bob Doe', 'Wow, vilken sida.', '2020-03-04 10:58:52'),
(3, 'Jane Doe', 'Hej från Sverige.', '2020-03-04 10:59:30'),
(4, 'Jim Doe', 'Oj oj, ni blev äntligen klara med sidan...', '2020-03-04 10:59:54'),
(5, 'Jim Halpert', 'Vilken typ av Björn är bäst?', '2020-03-04 11:00:29'),
(6, 'Dwight Schrute', 'Identitetsstöld är inte ett skämt!', '2020-03-04 11:00:51'),
(7, 'Michael Scott', 'Det var det hon sa.', '2020-03-04 11:01:07'),
(8, 'Johnny Doe', 'Bra hemsida', '2020-03-04 11:29:14'),
(9, 'Jimmy Doe', 'Bra hemsida', '2020-03-04 11:29:14'),
(10, 'Bobby Doe', 'Bra hemsida', '2020-03-04 11:29:14'),
(11, 'Raymond Holt', 'Bra hemsida', '2020-03-04 11:29:14'),
(12, 'Jake Peralta', 'Bra hemsida', '2020-03-04 11:29:14'),
(13, 'Jesse Pinkman', 'Bra hemsida', '2020-03-04 11:29:14'),
(14, 'Charles Boyle', 'Bra hemsida', '2020-03-04 11:29:14'),
(15, 'Robert California', 'Bra hemsida', '2020-03-04 11:29:14'),
(16, 'David Wallace', 'Bra hemsida', '2020-03-04 11:29:14'),
(17, 'Phillip Fry', 'Bra hemsida', '2020-03-04 11:29:14'),
(18, 'Terry Jeffords', 'Bra hemsida', '2020-03-04 11:29:14'),
(19, 'Kevin Malone', 'Bra hemsida', '2020-03-04 11:29:14'),
(20, 'Creed Bratton', 'Bra hemsida', '2020-03-04 11:29:14'),
(21, 'Andy Bernard', 'Bra hemsida', '2020-03-04 11:29:14'),
(22, 'Marcus Tullius Cicero', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ultrices dolor nisi, quis maximus dolor tristique ac. Aliquam erat volutpat. Nam rhoncus leo vitae eros euismod imperdiet. Fusce hendrerit pellentesque luctus. Duis eros erat, suscipit ac leo et, egestas tempor nibh. Curabitur iaculis, quam id lacinia eleifend, leo leo gravida nisi, ac blandit nulla urna non turpis. Sed a lorem velit. Aenean eget nibh facilisis elit ullamcorper lacinia. Donec nec tellus erat. Aliquam dapibus metus vitae sem rutrum laoreet.\r\n\r\n\r\nSed et elit sit amet nibh tincidunt viverra. Vestibulum eu venenatis sapien. Maecenas bibendum eu velit non maximus. Nullam in dolor fringilla, rhoncus augue quis, interdum quam. Ut sagittis magna elit, eu efficitur turpis tempus vitae. Nam commodo risus mattis metus ornare, non malesuada turpis fringilla. Suspendisse mi sapien, suscipit eget ex nec, auctor condimentum arcu. Fusce velit ipsum, pharetra vitae tincidunt eu, posuere et mi. Suspendisse lobortis varius laoreet. Duis at lacus in diam rutrum ullamcorper eu vitae odio. Aenean iaculis ligula eget diam vehicula, vitae sodales nisl convallis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas vel lectus quis felis semper venenatis.\r\n\r\n\r\nEtiam auctor accumsan diam, convallis viverra libero viverra nec. Vivamus sagittis eros et magna blandit, et eleifend urna elementum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer blandit risus vitae metus semper consectetur. Phasellus eu enim consequat, gravida justo eu, aliquam justo. Donec auctor turpis vel est sagittis, eget dapibus augue eleifend. Vivamus dignissim venenatis nisl, non tincidunt velit tristique id. Donec consectetur hendrerit justo quis auctor. Praesent sed aliquam ligula. Mauris scelerisque neque tempus lacus porttitor, sed mollis ipsum aliquam. Integer porta erat quis ligula pellentesque fermentum.\r\n\r\n\r\nProin viverra consectetur leo, lacinia tempus quam interdum quis. Praesent lacinia, nulla fringilla bibendum interdum, ligula justo dignissim turpis, sit amet efficitur ligula magna a mi. Nullam commodo nec magna ac pulvinar. Fusce molestie leo augue, eu lobortis orci tincidunt eget. Morbi accumsan blandit arcu porta imperdiet. Mauris laoreet ex sit amet augue ornare, ut imperdiet ipsum ultricies. Nam neque metus, luctus ut diam in, convallis sollicitudin massa. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla vitae aliquet mauris. Nulla fringilla magna ut sapien consequat, eu lobortis arcu luctus. Maecenas viverra eget dolor pretium aliquet. Proin pellentesque hendrerit magna, sit amet posuere arcu consectetur molestie.\r\n\r\n\r\nAliquam maximus fermentum dapibus. Vestibulum eu vehicula magna, id semper quam. Nulla et efficitur leo. Praesent sed risus nec urna aliquet maximus. Fusce id erat facilisis, posuere mi nec, convallis leo. Quisque quis nisi bibendum, dignissim leo eu, rutrum arcu. Nulla accumsan placerat accumsan. Etiam non ullamcorper neque. Sed eleifend fermentum ullamcorper. Mauris fermentum eros arcu, at mollis ipsum lacinia et. Nulla facilisi. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Duis aliquet, lectus a feugiat scelerisque, nibh ipsum pharetra ligula, dignissim volutpat sem ipsum sed nunc. Vivamus consequat in dui non dapibus. Cras aliquet vel nunc et placerat. ', '2020-03-04 13:06:13'),
(23, 'CSRF-token test.', 'Ny CSRF-token bibliotek test.', '2020-03-08 00:45:36');

-- --------------------------------------------------------

--
-- Tabellstruktur `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `price` int(10) NOT NULL,
  `status` text NOT NULL DEFAULT 'mottages'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `user_id`, `timestamp`, `price`, `status`) VALUES
(1, 1, 4, '2020-03-11 17:56:29', 1299, 'levererat'),
(2, 3, 4, '2020-03-11 17:56:22', 1299, 'ute på leverans'),
(3, 1, 1, '2020-03-11 17:56:12', 1299, 'levererat'),
(4, 2, 4, '2020-03-06 10:50:58', 1299, 'mottages'),
(5, 2, 4, '2020-03-11 17:56:36', 11999, 'skickats'),
(6, 1, 4, '2020-03-06 10:53:03', 14999, 'mottages'),
(7, 3, 4, '2020-03-06 10:53:53', 1299, 'mottages'),
(8, 1, 4, '2020-03-06 11:21:10', 14999, 'mottages'),
(9, 1, 4, '2020-03-06 11:21:36', 14999, 'mottages'),
(10, 1, 4, '2020-03-06 11:22:08', 14999, 'mottages'),
(11, 1, 4, '2020-03-06 12:12:14', 14999, 'mottages'),
(12, 3, 4, '2020-03-06 12:52:50', 1299, 'mottages'),
(13, 1, 4, '2020-03-07 12:51:34', 14999, 'mottages'),
(14, 1, 4, '2020-03-07 15:50:27', 14999, 'mottages'),
(15, 1, 4, '2020-03-11 17:34:02', 14999, 'mottages'),
(16, 1, 4, '2020-03-11 17:55:36', 14999, 'mottages'),
(17, 2, 4, '2020-03-11 17:55:42', 11999, 'mottages'),
(18, 3, 4, '2020-03-11 17:55:47', 1299, 'mottages');

-- --------------------------------------------------------

--
-- Tabellstruktur `posts`
--

CREATE TABLE `posts` (
  `id` int(10) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `created`, `updated`, `user_id`) VALUES
(1, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:09', '2020-03-06 16:06:09', 2),
(2, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:10', '2020-03-06 16:06:10', 3),
(3, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:10', '2020-03-06 16:06:10', 1),
(4, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:10', '2020-03-06 16:06:10', 2),
(5, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:10', '2020-03-06 16:06:10', 3),
(6, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:10', '2020-03-06 16:06:10', 3),
(7, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:10', '2020-03-06 16:06:10', 2),
(8, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:10', '2020-03-06 16:06:10', 2),
(9, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:10', '2020-03-06 16:06:10', 4),
(10, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:10', '2020-03-06 16:06:10', 3),
(11, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:10', '2020-03-06 16:06:10', 4),
(12, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:10', '2020-03-06 16:06:10', 2),
(13, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:10', '2020-03-06 16:06:10', 3),
(14, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:10', '2020-03-06 16:06:10', 4),
(15, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:10', '2020-03-06 16:06:10', 1),
(16, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:10', '2020-03-06 16:06:10', 1),
(17, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:10', '2020-03-06 16:06:10', 1),
(18, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:10', '2020-03-06 16:06:10', 2),
(19, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:10', '2020-03-06 16:06:10', 1),
(20, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:10', '2020-03-06 16:06:10', 3),
(21, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:10', '2020-03-06 16:06:10', 4),
(22, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:10', '2020-03-06 16:06:10', 4),
(23, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:10', '2020-03-06 16:06:10', 2),
(24, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:10', '2020-03-06 16:06:10', 4),
(25, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:10', '2020-03-06 16:06:10', 4),
(26, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:11', '2020-03-06 16:06:11', 4),
(27, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:11', '2020-03-06 16:06:11', 4),
(28, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:11', '2020-03-06 16:06:11', 3),
(29, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:11', '2020-03-06 16:06:11', 1),
(30, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:11', '2020-03-06 16:06:11', 1),
(31, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:11', '2020-03-06 16:06:11', 1),
(32, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:11', '2020-03-06 16:06:11', 2),
(33, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:11', '2020-03-06 16:06:11', 1),
(34, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:11', '2020-03-06 16:06:11', 3),
(35, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:11', '2020-03-06 16:06:11', 1),
(36, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:11', '2020-03-06 16:06:11', 1),
(37, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:11', '2020-03-06 16:06:11', 3),
(38, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:11', '2020-03-06 16:06:11', 3),
(39, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:11', '2020-03-06 16:06:11', 2),
(40, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:11', '2020-03-06 16:06:11', 4),
(41, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:11', '2020-03-06 16:06:11', 1),
(42, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:11', '2020-03-06 16:06:11', 4),
(43, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:11', '2020-03-06 16:06:11', 3),
(44, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:11', '2020-03-06 16:06:11', 4),
(45, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:11', '2020-03-06 16:06:11', 1),
(46, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:11', '2020-03-06 16:06:11', 2),
(47, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:11', '2020-03-06 16:06:11', 3),
(48, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:11', '2020-03-06 16:06:11', 2),
(49, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:11', '2020-03-06 16:06:11', 4),
(50, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:11', '2020-03-06 16:06:11', 1),
(51, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:12', '2020-03-06 16:06:12', 4),
(52, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:12', '2020-03-06 16:06:12', 1),
(53, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:12', '2020-03-06 16:06:12', 3),
(54, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:12', '2020-03-06 16:06:12', 3),
(55, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:12', '2020-03-06 16:06:12', 2),
(56, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:12', '2020-03-06 16:06:12', 4),
(57, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:12', '2020-03-06 16:06:12', 4),
(58, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:12', '2020-03-06 16:06:12', 2),
(59, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:12', '2020-03-06 16:06:12', 1),
(60, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:12', '2020-03-06 16:06:12', 3),
(61, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:12', '2020-03-06 16:06:12', 4),
(62, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:12', '2020-03-06 16:06:12', 3),
(63, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:12', '2020-03-06 16:06:12', 1),
(64, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:12', '2020-03-06 16:06:12', 2),
(65, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:12', '2020-03-06 16:06:12', 4),
(66, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:12', '2020-03-06 16:06:12', 1),
(67, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:12', '2020-03-06 16:06:12', 4),
(68, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:12', '2020-03-06 16:06:12', 4),
(69, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:12', '2020-03-06 16:06:12', 1),
(70, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:12', '2020-03-06 16:06:12', 1),
(71, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:12', '2020-03-06 16:06:12', 4),
(72, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:12', '2020-03-06 16:06:12', 3),
(73, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:12', '2020-03-06 16:06:12', 1),
(74, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:12', '2020-03-06 16:06:12', 1),
(75, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:12', '2020-03-06 16:06:12', 2),
(76, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:13', '2020-03-06 16:06:13', 2),
(77, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:13', '2020-03-06 16:06:13', 2),
(78, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:13', '2020-03-06 16:06:13', 1),
(79, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:13', '2020-03-06 16:06:13', 2),
(80, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:13', '2020-03-06 16:06:13', 2),
(81, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:13', '2020-03-06 16:06:13', 4),
(82, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:13', '2020-03-06 16:06:13', 2),
(83, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:13', '2020-03-06 16:06:13', 1),
(84, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:13', '2020-03-06 16:06:13', 1),
(85, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:13', '2020-03-06 16:06:13', 2),
(86, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:13', '2020-03-06 16:06:13', 2),
(87, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:13', '2020-03-06 16:06:13', 3),
(88, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:13', '2020-03-06 16:06:13', 4),
(89, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:13', '2020-03-06 16:06:13', 1),
(90, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:13', '2020-03-06 16:06:13', 3),
(91, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:13', '2020-03-06 16:06:13', 1),
(92, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:13', '2020-03-06 16:06:13', 4),
(93, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:13', '2020-03-06 16:06:13', 3),
(94, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:13', '2020-03-06 16:06:13', 4),
(95, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:13', '2020-03-06 16:06:13', 3),
(96, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:13', '2020-03-06 16:06:13', 2),
(97, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:13', '2020-03-06 16:06:13', 2),
(98, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:13', '2020-03-06 16:06:13', 4),
(99, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:13', '2020-03-06 16:06:13', 4),
(100, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:13', '2020-03-06 16:06:13', 1),
(101, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:13', '2020-03-06 16:06:13', 1),
(102, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:14', '2020-03-06 16:06:14', 4),
(103, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:14', '2020-03-06 16:06:14', 1),
(104, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:14', '2020-03-06 16:06:14', 2),
(105, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:14', '2020-03-06 16:06:14', 1),
(106, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:14', '2020-03-06 16:06:14', 4),
(107, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:14', '2020-03-06 16:06:14', 1),
(108, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:14', '2020-03-06 16:06:14', 1),
(109, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:14', '2020-03-06 16:06:14', 2),
(110, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:14', '2020-03-06 16:06:14', 2),
(111, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:14', '2020-03-06 16:06:14', 3),
(112, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:14', '2020-03-06 16:06:14', 2),
(113, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:14', '2020-03-06 16:06:14', 3),
(114, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:14', '2020-03-06 16:06:14', 3),
(115, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:14', '2020-03-06 16:06:14', 1),
(116, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:14', '2020-03-06 16:06:14', 4),
(117, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:14', '2020-03-06 16:06:14', 1),
(118, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:14', '2020-03-06 16:06:14', 4),
(119, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:14', '2020-03-06 16:06:14', 4),
(120, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:14', '2020-03-06 16:06:14', 2),
(121, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:14', '2020-03-06 16:06:14', 3),
(122, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:14', '2020-03-06 16:06:14', 1),
(123, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:14', '2020-03-06 16:06:14', 2),
(124, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:14', '2020-03-06 16:06:14', 3),
(125, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:14', '2020-03-06 16:06:14', 3),
(126, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:15', '2020-03-06 16:06:15', 1),
(127, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:15', '2020-03-06 16:06:15', 3),
(128, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:15', '2020-03-06 16:06:15', 4),
(129, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:15', '2020-03-06 16:06:15', 3),
(130, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:15', '2020-03-06 16:06:15', 1),
(131, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:15', '2020-03-06 16:06:15', 2),
(132, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:15', '2020-03-06 16:06:15', 2),
(133, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:15', '2020-03-06 16:06:15', 3),
(134, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:15', '2020-03-06 16:06:15', 1),
(135, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:15', '2020-03-06 16:06:15', 3),
(136, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:15', '2020-03-06 16:06:15', 3),
(137, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:15', '2020-03-06 16:06:15', 3),
(138, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:15', '2020-03-06 16:06:15', 1),
(139, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:15', '2020-03-06 16:06:15', 2),
(140, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:15', '2020-03-06 16:06:15', 2),
(141, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:15', '2020-03-06 16:06:15', 3),
(142, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:15', '2020-03-06 16:06:15', 1),
(143, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:15', '2020-03-06 16:06:15', 4),
(144, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:15', '2020-03-06 16:06:15', 1),
(145, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:15', '2020-03-06 16:06:15', 2),
(146, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:15', '2020-03-06 16:06:15', 3),
(147, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:15', '2020-03-06 16:06:15', 4),
(148, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:15', '2020-03-06 16:06:15', 2),
(149, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:15', '2020-03-06 16:06:15', 3),
(150, 'Lorem ipsum dolor sit amet.', 'Lorem ipsum dolor sit amet.', '2020-03-06 16:06:16', '2020-03-06 16:06:16', 4),
(151, 'HATAR DEN HÄR JÄVLA SIDAN.', 'Fuck denna sida, så mycket jag vill ta bort.\r\n\r\n\r\nDÖÖÖÖÖ!!!!!!!!!!!!', '2020-03-07 20:36:16', '2020-03-07 20:36:16', 4);

-- --------------------------------------------------------

--
-- Tabellstruktur `products`
--

CREATE TABLE `products` (
  `id` int(10) NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `banner` text NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `tagline` text NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `banner`, `description`, `price`, `tagline`, `url`) VALUES
(1, 'Mate X', 'matex', 'matex-banner', 'Upplev framtidens mobilteknologi med Future Mate X. Den nya vikbara designen integrerar en ny era av kommunikativ interaktion. Håll telefonen kompakt för dina dagliga smartphoneanvändning eller öppna upp den för en exceptionell upplevelse inom multitasking eller underhållning.', 14999, 'Hastighet till ett lågt pris.', 'MateX'),
(2, 'MateBook', 'matebook', 'matebook-banner', 'Future MateBook är designad för optimal portabilitet. En smal 14,9 mm metallram som är noggrant utformad, med diamantskuren yta i varje hörn, ger den en ultra-modern premium utformning. En kraftfull och elegant laptop. ', 11999, 'Hastighet till ett lågt pris.', 'MateBook'),
(3, 'MateBuds', 'matebuds', 'matebuds-banner', 'Compact, but sturdy, the Future MateBuds included charging case will fit in any bag or jacket pocket you’re taking on-the-GO with you. Lights on the outside will indicate how much power you have left before your next charge. ', 1299, 'Hastighet till ett lågt pris.', 'MateBuds');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `avatar` text NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(256) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `access_token` char(255) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `role` text NOT NULL DEFAULT 'user',
  `gender` text NOT NULL,
  `birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `avatar`, `username`, `password`, `email`, `reg_date`, `access_token`, `firstname`, `lastname`, `role`, `gender`, `birthday`) VALUES
(1, 'https://www.gravatar.com/avatar/bf3586378503a799b295cf51f3089d02', 'bobdoe', '$2y$10$B78.OP0.uULBBlnMM2Afv.YEg2Djq6JJhxKr/tEA9gOhsoELBk6wa', 'bobdoe@example.com', '2020-03-03 18:26:44', '4d0cd747fc6d81c248ecd7af71331b82054dd08ebc6545cd4b1b376f9a5cbb34381d5e8075172f1a8fa437a50783036e1d405d0173ababe33ccc2a7ec9824ded352802bda6e018ac37118db69a84aceeafd5f7c1f1c4731cd703b7988ae56d023a933007066883de45f0dcf12220517c81e5d26ce2593fabd8fd019538e73d3', 'Bob', 'Doe', 'admin', 'male', '1970-01-01'),
(2, 'https://www.gravatar.com/avatar/fd876f8cd6a58277fc664d47ea10ad19', 'johndoe', '$2y$10$VnWMxD9XYqhFQUkG3nYwrO8TvUtiZYrPM9.VB8GCxePNuPGY0QfG2', 'johndoe@example.com', '2020-03-03 18:27:05', 'd09950922c8a4aef4ae493a96f860a4e67855cc25106c4c1c8e85a1e7c06e8fd3b238d97fc549966621ae44905349993d193d229170281c987ee37e2c18e53f7d4c852178d4a95e0c84a376bf9ac6c4e4b0733ccc85992668f6cd88fca38418005486d4dad72455bab6aaaccb8d8007ad1433fa1238b74374d29c0f68b1b96c', 'John', 'Doe', 'user', 'male', '1970-01-01'),
(3, 'https://www.gravatar.com/avatar/e1f3994f2632af3d1c8c2dcc168a10e6', 'janedoe', '$2y$10$jjImoAzzRJXStNGipEaC/OBVqukcA5xwIlUPHeDmCsX0uIOIkIvdm', 'janedoe@example.com', '2020-03-03 18:28:13', '298fe593216b83f44ba741bdda86d314d5f6fc5c743b75cbe5ec4d90e4464d300bee70e4828eacba0d8ede927451d791dfa185c092f90c943fcc560e1a6f3f39425e3838e8bdeae2384b0f20986b542e4511708b4b586bb2b23c452a2e4566d73d3a3af934d21a940ecf89dd48d6b78d6da1bc348370c22bd68c465be10d208', 'Jane', 'Doe', 'user', 'female', '1970-01-01'),
(4, 'https://www.gravatar.com/avatar/1802fe9ae1102e31d140688ce6f1b399', 'liamrabe', '$2y$10$SbinDMuk1pac7gLz55VqZ.m0oTFIxf.VM7InLliDBf3kkC5mW7jA6', 'liamrabe@hotmail.com', '2020-03-04 13:50:06', '050f382175f1ec5da3bd218cc9d2c549911010c1162a6e305f93e1b0ea6ac11ffd0aac29bb64bab4f96abb78f022df83e6dfc35e47fe4dfb8288f84e5235df5ee1eaf07e649ee95b6983ff792341ed63232646c216d691af77bc00fefbc85d12359b86c49b325ab9f342086f77c6e4b6be9de0513a32f6bed9e27423e93aff2', 'Liam', 'Rabe', 'admin', 'male', '1997-09-27'),
(5, 'https://www.gravatar.com/avatar/f8c941f732a06c6df1479c2b71fad0ab', 'abednadir', '$2y$10$MsnHEMeydhGMfpb4dP2amOLz3Cox7feBxS0ac9YKwNPYJD7hOU2uy', 'abednadir@example.com', '2020-03-07 22:46:23', '93da763f809184758beba30105b9c32678f23d102f4e03e9071bf317d5cd580bb5867ab743cf518aa15b1e4066a323956ce556bce7aad02ff0ac700376a36f5e423a6792e31bb54804f0bdcd744efe2bd9ab343f0e292e57a9dedbfe361a36834ebf9cfa40a37c215e3fee573a955be838b910798a1fcb78cbf3ff0eb938064', 'Abed', 'Nadir', 'user', 'male', '1970-01-01');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `communities`
--
ALTER TABLE `communities`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `guestbook`
--
ALTER TABLE `guestbook`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT för tabell `communities`
--
ALTER TABLE `communities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT för tabell `guestbook`
--
ALTER TABLE `guestbook`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT för tabell `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT för tabell `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT för tabell `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
