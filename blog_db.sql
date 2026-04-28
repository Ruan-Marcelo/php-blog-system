-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Tempo de geração: 28/04/2026 às 01:11
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `blog_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `admin`
--

INSERT INTO `admin` (`id`, `first_name`, `last_name`, `username`, `password`) VALUES
(1, 'Apoio', 'Pet', 'apoio_pet', '$2y$10$PG9x1RcB8MiuezhYXd027eb/rQBt3yEphOJ6wOp1XNaS/pcc5UKMG');

-- --------------------------------------------------------

--
-- Estrutura para tabela `animals`
--

CREATE TABLE `animals` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `species` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `animals`
--

INSERT INTO `animals` (`id`, `name`, `species`, `age`, `description`, `created_at`, `image`) VALUES
(51, 'Mimi', 'Gato', 2, 'Muito carinhosa', '2026-04-23 16:01:54', 'ANIMAL-69ea59ce5b8222.39094122.png'),
(52, 'Bento', 'Cachorro', 6, 'Experiente e calmo', '2026-04-23 16:01:54', 'ANIMAL-69ea5998812ff3.16130976.png'),
(53, 'Luna II', 'Gato', 1, 'Filhote disponível', '2026-04-23 16:01:54', 'ANIMAL-69ea5991249401.16780728.png'),
(54, 'Rex II', 'Cachorro', 3, 'Resgatado recente', '2026-04-23 16:01:54', 'ANIMAL-69ea5988926626.91023796.png'),
(55, 'Milo II', 'Gato', 4, 'Muito tranquilo', '2026-04-23 16:01:54', 'ANIMAL-69ea59810b5341.16507702.png'),
(56, 'Bolt II', 'Cachorro', 2, 'Muito rápido', '2026-04-23 16:01:54', 'ANIMAL-69ea5979299df0.29056511.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `active` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `banner`
--

INSERT INTO `banner` (`id`, `image`, `title`, `active`) VALUES
(2, 'banner_69ea5d7ed14e86.70142553.png', 'Adoção', 1),
(3, 'banner_69ea5d8c4e7858.38106230.png', 'Adoção ', 1),
(4, 'banner_69ea5d95932118.23791618.png', 'Pets', 1),
(5, 'banner_69ebeddfedee23.21656818.png', 'Comida', 1),
(6, 'banner_69ebedeb3e22c9.40934002.png', 'acessórios ', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(127) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(38, 'Adoção'),
(39, 'Saúde animal '),
(40, 'Denúncia ');

-- --------------------------------------------------------

--
-- Estrutura para tabela `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `crated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comment`
--

INSERT INTO `comment` (`comment_id`, `comment`, `user_id`, `post_id`, `crated_at`) VALUES
(82, 'Ações como essa salvam vidas de verdade.', 1, 26, '2026-04-23 13:21:06'),
(83, 'Muito importante para controle de zoonoses.', 2, 26, '2026-04-23 13:21:06'),
(84, 'Parabéns pela iniciativa.', 3, 26, '2026-04-23 13:21:06'),
(85, 'Isso deveria existir em todas as cidades.', 4, 26, '2026-04-23 13:21:06'),
(86, 'Excelente projeto social.', 5, 26, '2026-04-23 13:21:06'),
(87, 'Muito triste ver tantos animais abandonados.', 1, 27, '2026-04-23 13:21:06'),
(88, 'Vocês fazem a diferença.', 2, 27, '2026-04-23 13:21:06'),
(89, 'Apoio total a essa causa.', 3, 27, '2026-04-23 13:21:06'),
(90, 'Sensibiliza muito esse tipo de ação.', 4, 27, '2026-04-23 13:21:06'),
(91, 'Parabéns equipe!', 6, 27, '2026-04-23 13:21:06'),
(92, 'Castração é essencial.', 1, 28, '2026-04-23 13:21:06'),
(93, 'Evita sofrimento futuro.', 2, 28, '2026-04-23 13:21:06'),
(94, 'Muito bom ver isso acontecendo.', 3, 28, '2026-04-23 13:21:06'),
(95, 'Importante para saúde pública.', 4, 28, '2026-04-23 13:21:06'),
(96, 'Excelente conteúdo.', 5, 28, '2026-04-23 13:21:06'),
(117, 'Educação sobre animais é essencial.', 1, 33, '2026-04-23 13:21:06'),
(118, 'Começa desde cedo.', 2, 33, '2026-04-23 13:21:06'),
(119, 'Muito bom esse conteúdo.', 3, 33, '2026-04-23 13:21:06'),
(120, 'Parabéns pela iniciativa.', 4, 33, '2026-04-23 13:21:06'),
(121, 'Excelente.', 6, 33, '2026-04-23 13:21:06'),
(122, 'ONGs precisam de apoio constante.', 1, 34, '2026-04-23 13:21:06'),
(123, 'Vou ajudar como puder.', 2, 34, '2026-04-23 13:21:06'),
(124, 'Muito importante isso.', 3, 34, '2026-04-23 13:21:06'),
(125, 'Parabéns equipe.', 4, 34, '2026-04-23 13:21:06'),
(126, 'Excelente trabalho.', 5, 34, '2026-04-23 13:21:06'),
(134, 'Isso sim é um assunto importante ', 11, 72, '2026-04-27 18:54:49'),
(135, 'Show De bola', 11, 34, '2026-04-27 18:56:07'),
(136, 'Concordo plenamente', 12, 72, '2026-04-27 18:57:10'),
(137, 'Faz o L', 13, 72, '2026-04-27 18:58:42');

-- --------------------------------------------------------

--
-- Estrutura para tabela `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `post_title` varchar(127) NOT NULL,
  `post_text` text NOT NULL,
  `category` int(11) NOT NULL,
  `publish` int(2) NOT NULL DEFAULT 1,
  `cover_url` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `crated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `post`
--

INSERT INTO `post` (`post_id`, `post_title`, `post_text`, `category`, `publish`, `cover_url`, `crated_at`) VALUES
(26, 'Adoção responsável muda destinos', 'Cada adoção evita sofrimento e abre espaço para novos resgates.', 38, 1, 'COVER-69ebeaff1e7360.70521633.jpg', '2026-04-23 13:02:46'),
(27, 'Cães resgatados em operação emergencial', 'Equipe salvou 8 cães em situação de risco extremo.', 38, 1, 'COVER-69ebeb061e6077.86964233.jpg', '2026-04-23 13:02:46'),
(28, 'Importância da castração gratuita', 'Campanhas ajudam a reduzir abandono e superpopulação.', 39, 1, 'COVER-69ebeb31538eb2.59207322.jpg', '2026-04-23 13:02:46'),
(33, 'Abandono de animais no Brasil', 'Milhares de animais sofrem abandono diariamente.', 40, 1, 'COVER-69ebeb93ac71d2.43652879.jpg', '2026-04-23 13:02:46'),
(34, 'Denúncia de maus-tratos', 'Denunciar salva vidas e ajuda na punição de crimes.', 40, 1, 'COVER-69ebebda967695.27080895.jpeg', '2026-04-23 13:02:46'),
(72, 'Castração como política pública', 'Reduz sofrimento e abandono.', 39, 1, 'COVER-69ebebef047162.91359424.jpg', '2026-04-23 13:02:46');

-- --------------------------------------------------------

--
-- Estrutura para tabela `post_like`
--

CREATE TABLE `post_like` (
  `like_id` int(11) NOT NULL,
  `liked_by` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `liked_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `post_like`
--

INSERT INTO `post_like` (`like_id`, `liked_by`, `post_id`, `liked_at`) VALUES
(75, 1, 1, '2026-04-23 13:03:34'),
(76, 2, 1, '2026-04-23 13:03:34'),
(77, 3, 1, '2026-04-23 13:03:34'),
(78, 4, 1, '2026-04-23 13:03:34'),
(79, 5, 1, '2026-04-23 13:03:34'),
(80, 1, 2, '2026-04-23 13:03:34'),
(81, 2, 2, '2026-04-23 13:03:34'),
(82, 3, 2, '2026-04-23 13:03:34'),
(83, 4, 2, '2026-04-23 13:03:34'),
(84, 2, 3, '2026-04-23 13:03:34'),
(85, 3, 3, '2026-04-23 13:03:34'),
(86, 4, 3, '2026-04-23 13:03:34'),
(87, 5, 3, '2026-04-23 13:03:34'),
(88, 1, 4, '2026-04-23 13:03:34'),
(89, 2, 4, '2026-04-23 13:03:34'),
(90, 3, 4, '2026-04-23 13:03:34'),
(91, 4, 5, '2026-04-23 13:03:34'),
(92, 5, 5, '2026-04-23 13:03:34'),
(93, 6, 5, '2026-04-23 13:03:34'),
(94, 1, 6, '2026-04-23 13:03:34'),
(95, 2, 6, '2026-04-23 13:03:34'),
(96, 3, 6, '2026-04-23 13:03:34'),
(97, 4, 6, '2026-04-23 13:03:34'),
(98, 2, 7, '2026-04-23 13:03:34'),
(99, 3, 7, '2026-04-23 13:03:34'),
(100, 5, 7, '2026-04-23 13:03:34'),
(101, 1, 8, '2026-04-23 13:03:34'),
(102, 2, 8, '2026-04-23 13:03:34'),
(103, 4, 8, '2026-04-23 13:03:34'),
(104, 3, 9, '2026-04-23 13:03:34'),
(105, 4, 9, '2026-04-23 13:03:34'),
(106, 5, 9, '2026-04-23 13:03:34'),
(107, 1, 10, '2026-04-23 13:03:34'),
(108, 2, 10, '2026-04-23 13:03:34'),
(109, 6, 10, '2026-04-23 13:03:34'),
(110, 1, 11, '2026-04-23 13:03:34'),
(111, 2, 11, '2026-04-23 13:03:34'),
(112, 3, 11, '2026-04-23 13:03:34'),
(113, 4, 12, '2026-04-23 13:03:34'),
(114, 5, 12, '2026-04-23 13:03:34'),
(115, 6, 12, '2026-04-23 13:03:34'),
(116, 1, 13, '2026-04-23 13:03:34'),
(117, 2, 13, '2026-04-23 13:03:34'),
(118, 3, 13, '2026-04-23 13:03:34'),
(119, 4, 13, '2026-04-23 13:03:34'),
(120, 2, 14, '2026-04-23 13:03:34'),
(121, 3, 14, '2026-04-23 13:03:34'),
(122, 1, 15, '2026-04-23 13:03:34'),
(123, 5, 15, '2026-04-23 13:03:34'),
(124, 6, 15, '2026-04-23 13:03:34'),
(125, 2, 16, '2026-04-23 13:03:34'),
(126, 3, 16, '2026-04-23 13:03:34'),
(127, 4, 16, '2026-04-23 13:03:34'),
(128, 1, 17, '2026-04-23 13:03:34'),
(129, 2, 17, '2026-04-23 13:03:34'),
(130, 3, 17, '2026-04-23 13:03:34'),
(131, 4, 18, '2026-04-23 13:03:34'),
(132, 5, 18, '2026-04-23 13:03:34'),
(133, 6, 18, '2026-04-23 13:03:34'),
(134, 1, 19, '2026-04-23 13:03:34'),
(135, 2, 19, '2026-04-23 13:03:34'),
(136, 3, 19, '2026-04-23 13:03:34'),
(137, 4, 20, '2026-04-23 13:03:34'),
(138, 5, 20, '2026-04-23 13:03:34'),
(139, 6, 20, '2026-04-23 13:03:34'),
(141, 1, 1, '2026-04-23 13:05:26'),
(142, 2, 1, '2026-04-23 13:05:26'),
(143, 3, 1, '2026-04-23 13:05:26'),
(144, 4, 1, '2026-04-23 13:05:26'),
(145, 5, 1, '2026-04-23 13:05:26'),
(146, 1, 2, '2026-04-23 13:05:26'),
(147, 2, 2, '2026-04-23 13:05:26'),
(148, 3, 2, '2026-04-23 13:05:26'),
(149, 4, 2, '2026-04-23 13:05:26'),
(150, 2, 3, '2026-04-23 13:05:26'),
(151, 3, 3, '2026-04-23 13:05:26'),
(152, 4, 3, '2026-04-23 13:05:26'),
(153, 5, 3, '2026-04-23 13:05:26'),
(154, 1, 4, '2026-04-23 13:05:26'),
(155, 2, 4, '2026-04-23 13:05:26'),
(156, 3, 4, '2026-04-23 13:05:26'),
(157, 4, 5, '2026-04-23 13:05:26'),
(158, 5, 5, '2026-04-23 13:05:26'),
(159, 6, 5, '2026-04-23 13:05:26'),
(160, 1, 6, '2026-04-23 13:05:26'),
(161, 2, 6, '2026-04-23 13:05:26'),
(162, 3, 6, '2026-04-23 13:05:26'),
(163, 4, 6, '2026-04-23 13:05:26'),
(164, 2, 7, '2026-04-23 13:05:26'),
(165, 3, 7, '2026-04-23 13:05:26'),
(166, 5, 7, '2026-04-23 13:05:26'),
(167, 1, 8, '2026-04-23 13:05:26'),
(168, 2, 8, '2026-04-23 13:05:26'),
(169, 4, 8, '2026-04-23 13:05:26'),
(170, 3, 9, '2026-04-23 13:05:26'),
(171, 4, 9, '2026-04-23 13:05:26'),
(172, 5, 9, '2026-04-23 13:05:26'),
(173, 1, 10, '2026-04-23 13:05:26'),
(174, 2, 10, '2026-04-23 13:05:26'),
(175, 6, 10, '2026-04-23 13:05:26'),
(176, 1, 11, '2026-04-23 13:05:26'),
(177, 2, 11, '2026-04-23 13:05:26'),
(178, 3, 11, '2026-04-23 13:05:26'),
(179, 4, 12, '2026-04-23 13:05:26'),
(180, 5, 12, '2026-04-23 13:05:26'),
(181, 6, 12, '2026-04-23 13:05:26'),
(182, 1, 13, '2026-04-23 13:05:26'),
(183, 2, 13, '2026-04-23 13:05:26'),
(184, 3, 13, '2026-04-23 13:05:26'),
(185, 4, 13, '2026-04-23 13:05:26'),
(186, 2, 14, '2026-04-23 13:05:26'),
(187, 3, 14, '2026-04-23 13:05:26'),
(188, 1, 15, '2026-04-23 13:05:26'),
(189, 5, 15, '2026-04-23 13:05:26'),
(190, 6, 15, '2026-04-23 13:05:26'),
(191, 2, 16, '2026-04-23 13:05:26'),
(192, 3, 16, '2026-04-23 13:05:26'),
(193, 4, 16, '2026-04-23 13:05:26'),
(194, 1, 17, '2026-04-23 13:05:26'),
(195, 2, 17, '2026-04-23 13:05:26'),
(196, 3, 17, '2026-04-23 13:05:26'),
(197, 4, 18, '2026-04-23 13:05:26'),
(198, 5, 18, '2026-04-23 13:05:26'),
(199, 6, 18, '2026-04-23 13:05:26'),
(200, 1, 19, '2026-04-23 13:05:26'),
(201, 2, 19, '2026-04-23 13:05:26'),
(202, 3, 19, '2026-04-23 13:05:26'),
(203, 4, 20, '2026-04-23 13:05:26'),
(204, 5, 20, '2026-04-23 13:05:26'),
(205, 6, 20, '2026-04-23 13:05:26'),
(206, 1, 26, '2026-04-23 13:21:24'),
(207, 2, 26, '2026-04-23 13:21:24'),
(208, 3, 26, '2026-04-23 13:21:24'),
(209, 4, 26, '2026-04-23 13:21:24'),
(210, 5, 26, '2026-04-23 13:21:24'),
(211, 1, 27, '2026-04-23 13:21:24'),
(212, 2, 27, '2026-04-23 13:21:24'),
(213, 3, 27, '2026-04-23 13:21:24'),
(214, 4, 27, '2026-04-23 13:21:24'),
(215, 6, 27, '2026-04-23 13:21:24'),
(216, 1, 28, '2026-04-23 13:21:24'),
(217, 2, 28, '2026-04-23 13:21:24'),
(218, 3, 28, '2026-04-23 13:21:24'),
(219, 5, 28, '2026-04-23 13:21:24'),
(220, 6, 28, '2026-04-23 13:21:24'),
(241, 1, 33, '2026-04-23 13:21:24'),
(242, 2, 33, '2026-04-23 13:21:24'),
(243, 3, 33, '2026-04-23 13:21:24'),
(244, 5, 33, '2026-04-23 13:21:24'),
(245, 6, 33, '2026-04-23 13:21:24'),
(246, 1, 34, '2026-04-23 13:21:24'),
(247, 2, 34, '2026-04-23 13:21:24'),
(248, 3, 34, '2026-04-23 13:21:24'),
(249, 4, 34, '2026-04-23 13:21:24'),
(250, 5, 34, '2026-04-23 13:21:24'),
(436, 1, 72, '2026-04-23 13:21:24'),
(437, 2, 72, '2026-04-23 13:21:24'),
(438, 3, 72, '2026-04-23 13:21:24'),
(439, 4, 72, '2026-04-23 13:21:24'),
(440, 6, 72, '2026-04-23 13:21:24'),
(459, 11, 72, '2026-04-27 18:54:36'),
(460, 11, 34, '2026-04-27 18:56:06'),
(461, 12, 72, '2026-04-27 18:57:00'),
(462, 13, 72, '2026-04-27 18:58:41');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `fname`, `username`, `password`) VALUES
(10, 'RUAN', 'ruan', '$2y$10$FGb7Sb12MX9upPRV7oxhMuH7zRAafYH423VR/g46JihRzMsNs905.'),
(11, 'Lucas', 'lucasYag', '$2y$10$drTx/3YXFuYeQaOjNMo0VeWCxHQq5lVgoPjcE9.z6VVUcgMW3DrB2'),
(12, 'Gustavo Guanabara', 'gustaBB', '$2y$10$r.qZnvFLSHjVAdFzKcs83.qbG554p1znH/AiS3Lq93hVPOn8q/fK6'),
(13, 'Pedro Henrique', 'DogDoBem', '$2y$10$jkWnRdXaYpUwefwM8mGyPe8TcnGWgSp0zebqORPYrj5vGQVYy81i.');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Índices de tabela `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Índices de tabela `post_like`
--
ALTER TABLE `post_like`
  ADD PRIMARY KEY (`like_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de tabela `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT de tabela `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de tabela `post_like`
--
ALTER TABLE `post_like`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=463;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
