-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 14 2018 г., 12:16
-- Версия сервера: 5.6.37
-- Версия PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `burgers2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `orders2`
--

CREATE TABLE `orders2` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `home` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `part` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `appt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `floor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `orders2`
--

INSERT INTO `orders2` (`id`, `user_id`, `street`, `home`, `part`, `appt`, `floor`, `comment`) VALUES
(5, 0, 'какаято', '1', '1', '15', '189', 'Хочу еды'),
(6, 0, 'какаято', '1', '1', '15', '189', 'ЕЩЕ ХОЧУ ЕДЫ!!!'),
(7, 0, 'какаято', '186', '6', '4', '5', 'нужна еда');

-- --------------------------------------------------------

--
-- Структура таблицы `users2`
--

CREATE TABLE `users2` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users2`
--

INSERT INTO `users2` (`id`, `email`, `name`, `tel`, `count`) VALUES
(4, 'klepnev-ea@yandex.ru', 'оля', '415489426', 2),
(5, 'evgeniyanatolich@yandex.ru', 'вася', '03', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `orders2`
--
ALTER TABLE `orders2`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users2`
--
ALTER TABLE `users2`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `orders2`
--
ALTER TABLE `orders2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `users2`
--
ALTER TABLE `users2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
