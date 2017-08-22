-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 22 2017 г., 21:17
-- Версия сервера: 5.5.53
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `my_own_player`
--

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1501326074),
('m170729_105803_create_user_table', 1501326076),
('m170730_102942_add_position_column_to_user_table', 1501410619),
('m170730_103355_drop_user_table', 1501411150),
('m170730_104024_create_user_table', 1501411256),
('m170801_172031_player', 1501610094),
('m170805_170736_playlist', 1501953043);

-- --------------------------------------------------------

--
-- Структура таблицы `player`
--

CREATE TABLE `player` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `playlist_id` int(10) DEFAULT NULL,
  `music_name` varchar(100) NOT NULL,
  `music_default_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `player`
--

INSERT INTO `player` (`id`, `user_id`, `playlist_id`, `music_name`, `music_default_name`) VALUES
(5, 1, 9, 'Баста - Шар', 'tati_ftsmokimo_i_basta_-_shar_krutitsja_vertitsja_zaycevnet_(zv.fm)'),
(7, 1, 9, 'Ремикс', 'muzika_v_mashinu_-_atb_-_9pm_snebastar_remix_radio_edit_2017_(zf.fm)'),
(10, 1, 10, 'Rag\'n\'bone Man - Human', 'ragnbone_man_-_human_original_version_(zf.fm)'),
(11, 1, 9, 'Rag\'n\'bone Man - Human', 'ragnbone_man_-_human_original_version_(zf.fm)'),
(13, 1, 9, 'test1', 'burak_yeter_feat_danelle_sadoval_-_tuesday_(zv.fm)'),
(14, 1, 10, 'Tuesday', 'burak_yeter_feat_danelle_sadoval_-_tuesday_(zv.fm)');

-- --------------------------------------------------------

--
-- Структура таблицы `playlist`
--

CREATE TABLE `playlist` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `playlist_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `playlist`
--

INSERT INTO `playlist` (`id`, `user_id`, `playlist_name`) VALUES
(9, 1, 'Playlist_1'),
(10, 1, 'Playlist_2'),
(11, 1, 'Playlist_3');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `name` varchar(25) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `auth_key` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `email`, `name`, `password`, `auth_key`) VALUES
(1, 's@s.c', 'Роман', '$2y$13$uyo/x7zO5Vxv7rFcKmV1VuZoTx.1SJQXOEstIu1Gj4dRZ6tb4YLxK', 'SPd_mrq48PdXzcWqhZNORSpnQl0zl2iA'),
(2, 'sss@sss.c', 'Роман', '$2y$13$WRLlfDiR68nlVjcNvcwIA.DfSYoqZCSB1bDqN9vOfa45rh0FLy2Eq', 'eRrA5aECKKcy1ZUr-IGhI6m_mtZWue5-');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `player`
--
ALTER TABLE `player`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `player`
--
ALTER TABLE `player`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT для таблицы `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
