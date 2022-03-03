-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 03-03-2022 a las 12:59:47
-- Versión del servidor: 8.0.28-0ubuntu0.20.04.3
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `kindergarten`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `daily`
--

CREATE TABLE `daily` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `breackfast` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lunch1` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lunch2` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dessert` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `snack` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bottle` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diaper` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nap` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `absence` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `daily`
--

INSERT INTO `daily` (`id`, `student_id`, `breackfast`, `lunch1`, `lunch2`, `dessert`, `snack`, `bottle`, `diaper`, `nap`, `message`, `date`, `absence`) VALUES
(1, 1, 'a', 'a', 'b', 'b', '', 'c', 'c', 'c', 'Mensaje numero 1', '2022-02-07', ''),
(2, 1, 'b', 'b', 'a', '', '', 'c', 'c', '', 'Mensaje numero 2', '2022-02-06', ''),
(3, 3, 'd', 'c', 'a', 'a', '', 'c', 'd', 'a', 'otro nuevoreter', '2022-02-24', 'a'),
(4, 1, 'c', 'c', 'd', 'a', NULL, NULL, NULL, NULL, NULL, '2022-02-24', NULL),
(5, 3, NULL, 'c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-27', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220205112603', '2022-02-05 12:26:34', 366),
('DoctrineMigrations\\Version20220209103012', '2022-02-09 11:30:40', 178);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student`
--

CREATE TABLE `student` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `phone1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `letter` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `student`
--

INSERT INTO `student` (`id`, `user_id`, `name`, `surname`, `birth_date`, `phone1`, `phone2`, `letter`) VALUES
(1, 2, 'Lucia', 'Garcia', '2019-04-27', '600111222', 'A', 'A'),
(3, 2, 'Julia', 'Garcia', '2021-04-27', '600111222', '600444555', 'A'),
(4, 1, 'aaaa', 'aaa', '2022-02-07', 'aaa', 'aaaaa', 'A'),
(7, 8, 'alumno1', 'alumno1', '2021-10-01', '952339873', '699853214', 'A'),
(8, 9, 'alumno2', 'alumno2', '2021-12-04', '952648854', '600232331', 'A'),
(9, 10, 'alumno3', 'alumno3', '2021-07-05', '952326598', '632514872', 'A'),
(10, 11, 'alumno4', 'alumno4', '2021-02-11', '952233584', '652365874', 'A'),
(11, 12, 'alumno5', 'alumno5', '2021-02-05', '952366472', '663251228', 'A'),
(12, 14, 'alumno6', 'alumno6', '2021-02-11', '952877458', '602215842', 'A'),
(13, 15, 'alumno7', 'alumno7', '2021-03-30', '952366971', '693325484', 'A'),
(14, 16, 'alumno8', 'alumno8', '2021-12-10', '952875454', '602125486', 'A'),
(15, 17, 'alumno9', 'alumno9', '2021-07-23', '952365212', '698524862', 'A'),
(16, 18, 'alumno10', 'alumno10', '2021-11-04', '952684475', '632552231', 'A'),
(17, 19, 'alumno11', 'alumno11', '2020-08-11', '952663325', '669545485', 'A'),
(18, 20, 'alumno12', 'alumno12', '2020-09-01', '952323254', '677521248', 'A'),
(19, 21, 'alumno13', 'alumno13', '2020-01-25', '952632547', '611425187', 'A'),
(20, 21, 'alumno13', 'alumno13', '2020-01-25', '952632547', '611425187', 'A'),
(21, 22, 'alumno14', 'alumno14', '2020-03-12', '952365478', '678521485', 'A'),
(22, 23, 'alumno15', 'alumno15', '2020-03-22', '952258745', '654785214', 'A'),
(23, 24, 'alumno16', 'alumno16', '2020-09-09', '952326598', '654548787', 'A'),
(24, 25, 'alumno17', 'alumno17', '2020-12-13', '952545874', '646526587', 'A'),
(25, 26, 'alumno18', 'alumno18', '2020-04-27', '952878785', '665566874', 'A'),
(26, 27, 'alumno19', 'alumno19', '2020-04-02', '952658795', '658742178', 'A'),
(27, 28, 'alumno20', 'alumno20', '2020-08-22', '952658555', '658554874', 'A'),
(28, 29, 'alumno21', 'alumno21', '2019-03-11', '95225578', '656669632', 'A'),
(29, 30, 'alumno22', 'alumno22', '2019-12-06', '952225484', '658796584', 'A'),
(30, 32, 'alumno23', 'alumno23', '2019-04-12', '952887896', '633265842', 'A'),
(31, 33, 'alumno24', 'alumno24', '2019-08-08', '952326482', '622383384', 'A'),
(32, 34, 'alumno25', 'alumno25', '2019-07-12', '952684875', '632547852', 'A'),
(33, 35, 'alumno26', 'alumno26', '2019-10-19', '952365879', '698105478', 'A'),
(34, 36, 'alumno27', 'alumno27', '2019-02-01', '952875462', '658487732', 'A'),
(35, 37, 'alumno28', 'alumno28', '2019-05-14', '952658785', '658745842', 'A'),
(36, 38, 'alumno29', 'alumno29', '2019-11-07', '952996655', '633225587', 'A'),
(37, 39, 'alumno30', 'alumno30', '2019-07-03', '952478454', '632547887', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `email`, `password`, `user_type`, `roles`) VALUES
(1, 'Javier', 'Garcia', 'javier@javier.com', '123456', '1', 'null'),
(2, 'Javier2', 'Garcia', 'javier@garcia.com', '$2y$13$odT9OH6Q29JVaRgdMhfzWOgKkqsmaphZiFqb51wv2W4Wu7.Q4irPS', '1', '[]'),
(8, 'tutor1', 'tutor1', 'tutor1@tutor1.com', '$2y$13$F/klvTr7AsGDWdLiTcbSy.GQBcSI2rDWozrWSayTtMbykqYpTeOtS', '2', '[]'),
(9, 'tutor2', 'tutor2', 'tutor2@tutor2.com', '$2y$13$vs4IOPLJ/OvHX3.Xl653hOxnuTmJiHfTIXb0q5sUeyxYUYg1Y5MSS', '2', '[]'),
(10, 'tutor3', 'tutor3', 'tutor3@tutor3.com', '$2y$13$/lWJaMhB6DqA1v/mgti/HOCNVkUQ2WBdti6r6iP1c67VrvyPyeYly', '2', '[]'),
(11, 'tutor4', 'tutor4', 'tutor4@tutor4.com', '$2y$13$YKucWyvr2AERr0eHVcmhCOnB7Wb88W7hQj06Ei4sHszbEAwQ/mnIa', '2', '[]'),
(12, 'tutor5', 'tutor5', 'tutor5@tutor5.com', '$2y$13$Z2j1ZZ50wQuNmI80.pCbeuQw.3v0/xAhkQkb0V0yIt/L5IKzK8ly6', '2', '[]'),
(14, 'tutor6', 'tutor6', 'tutor6@tutor6.com', '$2y$13$mcFj5QhggBbhjxast7kHPe.i12ei.Tdp.PYBT8HbK2dGuWcEcgYAi', '2', '[]'),
(15, 'tutor7', 'tutor7', 'tutor7@tutor7.com', '$2y$13$3qFismL9JABHQEcO7gCx.uSH4YjjVldUXmvYrZkWOSp/LqIsi1Ozy', '2', '[]'),
(16, 'tutor8', 'tutor8', 'tutor8@tutor8.com', '$2y$13$AXSQm/HiolQNglK0OPVaSOiupN4fmDNXULbkZQOzrYEMa2DJAFAPK', '2', '[]'),
(17, 'tutor9', 'tutor9', 'tutor9@tutor9.com', '$2y$13$nauXMaJuak4kefXEWRmdzON69hdxxIYP0O1DH3J0ILM5Xr4uGpYLW', '2', '[]'),
(18, 'tutor10', 'tutor10', 'tutor10@tutor10.com', '$2y$13$noNnhajuyv18kC6svxVbwOpdAivgVF8uB8o1.l/err10bSYDpXpLC', '2', '[]'),
(19, 'tutor11', 'tutor11', 'tutor11@tutor11.com', '$2y$13$/xgsJ30QmlAZtg8lkZVaD.4pMYXs9Or7SIGYAEkS5itqNcMf9NNWy', '2', '[]'),
(20, 'tutor12', 'tutor12', 'tutor12@tutor12.com', '$2y$13$mUqjeqmKJOlDlIM9P60hhezAKCvw7oNt4jQcQeZgKPiR8J5CvZNPK', '2', '[]'),
(21, 'tutor13', 'tutor13', 'tutor13@tutor13.com', '$2y$13$XStsShfTm1yHizDO70IRtuOQYZVJquhyugfUjLFc9V/JCMPdaOIYC', '2', '[]'),
(22, 'tutor14', 'tutor14', 'tutor14@tutor14.com', '$2y$13$ApvHySN1vmgOcRvAzMcjReu1bwJQA2JrXRNt4IAqpWsQZbc7xx4OK', '2', '[]'),
(23, 'tutor15', 'tutor15', 'tutor15@tutor15.com', '$2y$13$7gfauP.eVCKb7LfX7iL0.uaDmh2b82FDxLbvRn6BjT6IfR1gH1xd.', '2', '[]'),
(24, 'tutor16', 'tutor16', 'tutor16@tutor16.com', '$2y$13$syIx2FSubMTkZcbJWiYrheT9Jz0h5F9ZzkGMwUdubrlaAnEkxHKrW', '2', '[]'),
(25, 'tutor17', 'tutor17', 'tutor17@tutor17.com', '$2y$13$AcXwQjgewpD/aOOlHBhcLeM4SN9bRnSQoBGYULQbIepEcfl.H1lPm', '2', '[]'),
(26, 'tutor18', 'tutor18', 'tutor18@tutor18.com', '$2y$13$OfvBtBDd2oMP2vgCqSdQlubl0wkHMaIqUy3EBB.bbRuS2lMEE.WHa', '2', '[]'),
(27, 'tutor19', 'tutor19', 'tutor19@tutor19.com', '$2y$13$lg6ClIQ0gm/Lu2AdYHlfb.koKPuZMdx8fIkqawiHOafO8wDsk9AlS', '2', '[]'),
(28, 'tutor20', 'tutor20', 'tutor20@tutor20.com', '$2y$13$Teg2LvDLrNbcIG1PdGnUpOZ0EB086GQ4sXdEIEnGZ63zqYamL48Pm', '2', '[]'),
(29, 'tutor21', 'tutor21', 'tutor21@tutor21.com', '$2y$13$qyRgMmmLPVxU6XPOqG0ZhOMeUcNLT3jHraGfZOoFtsKdJYqU1R1Ue', '2', '[]'),
(30, 'tutor22', 'tutor22', 'tutor22@tutor22.com', '$2y$13$wWe3NybsuYwRg0kHCnykueDkbE2V5vLDwql/qmGgnevYkltWuvdDm', '2', '[]'),
(32, 'tutor23', 'tutor23', 'tutor23@tutor23.com', '$2y$13$ILEK6wOCDD7L.7KlSHZiwuIuLgDuZSeGpCaHWJdy31CxAkj0Ew4fC', '2', '[]'),
(33, 'tutor24', 'tutor24', 'tutor24@tutor24.com', '$2y$13$vN7JHd8G3bSXI05z0w2Oz.mv5q8aDJPU6b09MPyXJFvVcOCxCTjvG', '2', '[]'),
(34, 'tutor25', 'tutor25', 'tutor25@tutor25.com', '$2y$13$5Dkb0DY03XgBgE46CZ8gceZ2wo1NJUS82kg9aNKvoURb8yp18WXp2', '2', '[]'),
(35, 'tutor26', 'tutor26', 'tutor26@tutor26.com', '$2y$13$GYBjfiDKD.4RULcKjJ55s.kOv52iozoMFgxrS39wOGbg2HYyzFvvK', '2', '[]'),
(36, 'tutor27', 'tutor27', 'tutor27@tutor27.com', '$2y$13$/j.Qef6PeQrtDZkkRhi/Du882Exs1IRz8KFWYytXl4ciu3AbYBk1O', '2', '[]'),
(37, 'tutor28', 'tutor28', 'tutor28@tutor28.com', '$2y$13$aGX9IPJm4EyYGJMpbWd3yengryHLWnMoQ5y7a3zBYqhV8T24QlppO', '2', '[]'),
(38, 'tutor29', 'tutor29', 'tutor29@tutor29.com', '$2y$13$NBavL59NyJu7N8rvzaFzyeuDoJ.R/PMbtoFtF48RK2rncdSIZSGiK', '2', '[]'),
(39, 'tutor30', 'tutor30', 'tutor30@tutor30.com', '$2y$13$QHyekLfqTAfs9loPa9qVm..x1qn5YMBg8j2oiTc5.f0HJid0dMqtS', '2', '[]');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `daily`
--
ALTER TABLE `daily`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8E9DAB6ACB944F1A` (`student_id`);

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indices de la tabla `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B723AF33A76ED395` (`user_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `daily`
--
ALTER TABLE `daily`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `student`
--
ALTER TABLE `student`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `daily`
--
ALTER TABLE `daily`
  ADD CONSTRAINT `FK_8E9DAB6ACB944F1A` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`);

--
-- Filtros para la tabla `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `FK_B723AF33A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
