-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 17 2023 г., 18:44
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `transport`
--

-- --------------------------------------------------------

--
-- Структура таблицы `road`
--

CREATE TABLE `road` (
  `id` int UNSIGNED NOT NULL,
  `start_station_id` int UNSIGNED NOT NULL,
  `final_station_id` int UNSIGNED NOT NULL,
  `distance` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `road`
--

INSERT INTO `road` (`id`, `start_station_id`, `final_station_id`, `distance`) VALUES
(1, 1, 2, 950),
(2, 1, 3, 140),
(3, 1, 4, 50);

-- --------------------------------------------------------

--
-- Структура таблицы `route`
--

CREATE TABLE `route` (
  `id` int UNSIGNED NOT NULL,
  `route_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `number_of_stop` int UNSIGNED NOT NULL,
  `number_of_car` int UNSIGNED NOT NULL,
  `number_of_passengers` int UNSIGNED NOT NULL,
  `road_id` int UNSIGNED NOT NULL,
  `transport_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `route`
--

INSERT INTO `route` (`id`, `route_number`, `number_of_stop`, `number_of_car`, `number_of_passengers`, `road_id`, `transport_id`) VALUES
(1, '10', 10, 1, 200, 1, 1),
(2, '11', 4, 3, 160, 1, 2),
(3, '12', 20, 1, 150, 1, 3),
(4, '13', 2, 2, 100, 2, 1),
(5, '14', 25, 2, 300, 2, 2),
(6, '15', 17, 5, 800, 2, 3),
(7, '16', 6, 1, 90, 3, 1),
(8, '17', 7, 3, 400, 3, 2),
(9, '18', 19, 2, 610, 3, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `station`
--

CREATE TABLE `station` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `station`
--

INSERT INTO `station` (`id`, `title`) VALUES
(1, 'Санкт-Петербург'),
(2, 'Москва'),
(3, 'Петрозаводск'),
(4, 'Выборг');

-- --------------------------------------------------------

--
-- Структура таблицы `transport`
--

CREATE TABLE `transport` (
  `id` int UNSIGNED NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `number_of_car` int UNSIGNED NOT NULL,
  `fare` int UNSIGNED NOT NULL,
  `avg_speed` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `transport`
--

INSERT INTO `transport` (`id`, `type`, `number_of_car`, `fare`, `avg_speed`) VALUES
(1, 'Автобус', 10, 50, 15),
(2, 'Троллейбус', 10, 75, 20),
(3, 'Трамвай', 10, 200, 30);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int UNSIGNED NOT NULL,
  `login` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `phone`, `email`, `fio`, `token`) VALUES
(3, 'daniil', '$2y$13$8/8XamlcGI8po3.E7NljzuZKJ9YjDjpv98xYp7c/jNiIbO0EYhMU2', '89817406942', 'daniil@gmail.com', 'Семенов Даниил', 'U9rtoXfEMpyy7DAnuxvJXEBm8T17roMo');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `road`
--
ALTER TABLE `road`
  ADD PRIMARY KEY (`id`),
  ADD KEY `start_station_id` (`start_station_id`,`final_station_id`),
  ADD KEY `final_station_id` (`final_station_id`);

--
-- Индексы таблицы `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`id`),
  ADD KEY `road_id` (`road_id`),
  ADD KEY `transport_id` (`transport_id`);

--
-- Индексы таблицы `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `transport`
--
ALTER TABLE `transport`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_transport_id` (`type`),
  ADD KEY `type_transport_id_2` (`type`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `road`
--
ALTER TABLE `road`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `route`
--
ALTER TABLE `route`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `station`
--
ALTER TABLE `station`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `transport`
--
ALTER TABLE `transport`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `road`
--
ALTER TABLE `road`
  ADD CONSTRAINT `road_ibfk_1` FOREIGN KEY (`start_station_id`) REFERENCES `station` (`id`),
  ADD CONSTRAINT `road_ibfk_2` FOREIGN KEY (`final_station_id`) REFERENCES `station` (`id`);

--
-- Ограничения внешнего ключа таблицы `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `route_ibfk_1` FOREIGN KEY (`road_id`) REFERENCES `road` (`id`),
  ADD CONSTRAINT `route_ibfk_2` FOREIGN KEY (`transport_id`) REFERENCES `transport` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
