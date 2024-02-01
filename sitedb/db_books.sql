-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 04 2023 г., 09:20
-- Версия сервера: 5.7.17
-- Версия PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `db_books`
--

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `id` char(13) NOT NULL,
  `author` char(50) DEFAULT NULL,
  `title` char(100) DEFAULT NULL,
  `price` char(13) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `author`, `title`, `price`) VALUES
('0-201-89683-4', 'Кнут Д.', 'Искусство программирования', '450'),
('0-07-013151-1', 'Кормен Т, Лейзерсон И.Ч.', 'Алгоритмы: построение и анализ', '320'),
('978-5-8459-16', 'Нильсен Я., Перниче К.', 'Веб-дизайн: анализ удобств использования веб-сайтов', '670'),
('987-5-8459-17', 'Титтел Э., Ноубл Дж.', 'HTML, XHTML и CSS для чайникиов', '800'),
('978-5-8459-1', 'Суэринг С., Конверс Т, Джойс', 'Библия программиста', '550'),
('977-5-8459-16', 'Зандстра М.', 'PHP объекты, шаблоны и методики программирования', '900'),
('007-228-1337', 'Steve, Huise', 'Искусство обмана. Выбор лучшего велосипеда', '18000');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
