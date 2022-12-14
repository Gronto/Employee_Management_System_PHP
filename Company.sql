-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Дек 14 2022 г., 14:06
-- Версия сервера: 10.4.25-MariaDB
-- Версия PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Company`
--

-- --------------------------------------------------------

--
-- Структура таблицы `accounting`
--

CREATE TABLE `accounting` (
  `id` int(11) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `salary` int(11) NOT NULL,
  `prizes` int(11) DEFAULT NULL,
  `Percentage_of_salary_for_taxes` tinyint(4) NOT NULL,
  `total_salary` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Бухгалтерия';

--
-- Дамп данных таблицы `accounting`
--

INSERT INTO `accounting` (`id`, `full_name`, `job_title`, `salary`, `prizes`, `Percentage_of_salary_for_taxes`, `total_salary`) VALUES
(5, 'Андрей Белый', 'QA', 450000, 0, 10, 405000),
(6, 'Гоша Дударь', 'Team Lead', 1700000, 1000000, 15, 2295000);

--
-- Триггеры `accounting`
--
DELIMITER $$
CREATE TRIGGER `calc_total_salary_onInsert` BEFORE INSERT ON `accounting` FOR EACH ROW BEGIN
  SET NEW.total_salary = (NEW.salary + NEW.prizes) - ((NEW.salary + NEW.prizes) / 100 * NEW.Percentage_of_salary_for_taxes);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `calc_total_salary_onUpdate` BEFORE UPDATE ON `accounting` FOR EACH ROW BEGIN
  SET NEW.total_salary = (NEW.salary + NEW.prizes) - ((NEW.salary + NEW.prizes) / 100 * NEW.Percentage_of_salary_for_taxes);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `job_title` varchar(50) NOT NULL,
  `photo` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Сотрудники';

--
-- Дамп данных таблицы `employees`
--

INSERT INTO `employees` (`id`, `email`, `password`, `full_name`, `birth_date`, `address`, `job_title`, `photo`) VALUES
(1, 'admin@admin.login', 'admin', 'Админ', '1997-04-13', '-', '-', NULL),
(4, 'andro@mail.ru', 'andro', 'Дрозденко Андрей', '2004-04-15', 'ул. Мира, дом 2, кв. 22', 'Senior Frontend Developer', NULL),
(5, 'white@gmail.com', 'white', 'Андрей Белый', '2006-11-22', 'пр. Республики 2, дом 6, кв. 30', 'QA', NULL),
(6, 'gosha@gmail.com', 'gosha', 'Гоша Дударь', '1999-10-10', 'Россия, Москва, ул. Московская 23/2, кв. 32', 'Team Lead', NULL),
(7, 'UXVika@gmail.com', 'UXUIUXUI', 'Гранецкая Виктория', '2001-07-19', 'проспект Республики, 7/2', 'UX/UI Designer', NULL),
(8, 'arrlekinoo@gmail.com', 'arrlekinoo', 'Арлекин Дударь', '2002-12-09', 'проспект Республики, 7/3', 'DevOps', NULL),
(9, 'arknol@gmail.com', 'knolarthur', 'Артур Кноль', '2003-12-21', 'проспект Республики, 7/4', 'Junior Backend Developer', NULL),
(10, 'ITSEC@gmail.com', 'ITSEC0', 'Александр Про', NULL, NULL, 'IT Security Specialist', NULL),
(11, '123456', 'yura@gmail.com', 'Юрий Александрович', '2000-12-12', 'gfjdksl', 'Бизнес-консультант', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `accounting`
--
ALTER TABLE `accounting`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `full_name` (`full_name`),
  ADD KEY `job_title` (`job_title`);

--
-- Индексы таблицы `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `full_name` (`full_name`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `job_title` (`job_title`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `accounting`
--
ALTER TABLE `accounting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `accounting`
--
ALTER TABLE `accounting`
  ADD CONSTRAINT `accounting_ibfk_1` FOREIGN KEY (`id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `accounting_ibfk_2` FOREIGN KEY (`full_name`) REFERENCES `employees` (`full_name`),
  ADD CONSTRAINT `accounting_ibfk_3` FOREIGN KEY (`job_title`) REFERENCES `employees` (`job_title`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
