-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2020 年 6 月 24 日 18:26
-- サーバのバージョン： 10.4.11-MariaDB
-- PHP のバージョン: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gsacf_l03_12`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `cource_table`
--

CREATE TABLE `cource_table` (
  `cource_id` int(12) NOT NULL,
  `cource_txt` text COLLATE utf8_unicode_ci NOT NULL,
  `cource_gap` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `cource_table`
--

INSERT INTO `cource_table` (`cource_id`, `cource_txt`, `cource_gap`) VALUES
(1, '東京DEV', 0),
(2, '東京LAB', 7),
(3, '福岡DEV', 10),
(4, '福岡LAB', 13);

-- --------------------------------------------------------

--
-- テーブルの構造 `gram_table`
--

CREATE TABLE `gram_table` (
  `id` int(12) NOT NULL,
  `users_id` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `users_password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `last_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `last_name_kana` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `first_name_kana` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `nick_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `users_location` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `cource` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `ki` int(32) NOT NULL,
  `touitsu_ki` int(32) NOT NULL,
  `cource_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gram_table`
--

INSERT INTO `gram_table` (`id`, `users_id`, `users_password`, `is_admin`, `is_deleted`, `created_at`, `updated_at`, `last_name`, `first_name`, `last_name_kana`, `first_name_kana`, `nick_name`, `users_location`, `cource`, `ki`, `touitsu_ki`, `cource_id`) VALUES
(1, '1', '1', 1, 0, '2020-06-12 01:09:50', '2020-06-12 01:09:50', 'AAA', '000', 'エー', 'ゼロ', 'アルファ', '東京', 'DEV', 1, 1, 1),
(2, '2', '2', 1, 0, '2020-06-12 01:12:33', '2020-06-12 15:05:10', 'BBB', '111', 'ビー', 'イチ', 'ブラボー', '東京', 'LAB', 1, 8, 2),
(3, '3', '3', 0, 0, '2020-06-12 08:07:03', '2020-06-12 08:07:03', 'ccc', '222', 'シー', 'ニ', 'チャーリー', '福岡', 'DEV', 1, 11, 3),
(4, '4', '4', 0, 0, '2020-06-12 08:08:50', '2020-06-12 08:08:50', 'ddd', '333', 'ディー', 'サン', 'デルタ', '福岡', 'LAB', 1, 14, 4),
(5, '5', '5', 0, 0, '2020-06-12 08:10:08', '2020-06-12 08:10:08', 'eee', '444', 'イー', 'ヨン', 'エコー', '東京', 'DEV', 16, 16, 1),
(6, '6', '6', 0, 0, '2020-06-12 08:11:13', '2020-06-12 08:11:13', 'fff', '555', 'エフ', 'ゴ', 'フォックス', '東京', 'LAB', 9, 16, 2),
(7, '7', '7', 0, 0, '2020-06-12 08:12:10', '2020-06-12 08:12:10', 'ggg', '666', 'ジー', 'ロク', 'ゴルフ', '福岡', 'DEV', 6, 16, 3),
(8, '8', '8', 1, 0, '2020-06-12 08:13:15', '2020-06-12 08:13:15', 'hhh', '777', 'エイチ', 'ナナ', 'ホテル', '福岡', 'LAB', 3, 16, 4),
(10, '999', '999', 0, 0, '2020-06-12 08:53:04', '2020-06-12 08:53:04', '999', '999', '999', '999', '999', '999', '999', 999, 999, 1),
(12, '666', '666', 0, 0, '2020-06-12 10:06:37', '2020-06-12 10:07:58', '666666', '666666', '666666', '666666', '666666', '0', '0', 1, 16, 2),
(13, '111', '111', 0, 0, '2020-06-12 10:13:09', '2020-06-12 10:30:22', '111', '111', '111', '111', '111111', '0', '0', 3, 14, 3),
(14, '3333', '3333', 0, 0, '2020-06-12 14:54:03', '2020-06-12 14:54:03', '3333', '3333', '3333', '3333', '3333', '福岡', 'DEV', 3, 3, 4);

-- --------------------------------------------------------

--
-- テーブルの構造 `like_table`
--

CREATE TABLE `like_table` (
  `id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `todo_id` int(12) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `like_table`
--

INSERT INTO `like_table` (`id`, `user_id`, `todo_id`, `created_at`) VALUES
(19, 1, 13, '2020-06-12 12:17:53'),
(20, 1, 14, '2020-06-12 12:17:54'),
(21, 1, 18, '2020-06-12 12:17:56'),
(22, 1, 19, '2020-06-12 12:17:56'),
(23, 1, 20, '2020-06-12 12:17:58'),
(25, 2, 13, '2020-06-12 16:22:07'),
(26, 2, 14, '2020-06-12 16:22:10'),
(28, 2, 16, '2020-06-12 16:22:13'),
(29, 2, 17, '2020-06-12 16:22:13'),
(30, 2, 18, '2020-06-12 16:22:14'),
(31, 2, 19, '2020-06-12 16:22:15'),
(32, 2, 20, '2020-06-12 16:22:15'),
(33, 2, 12, '2020-06-12 16:26:47');

-- --------------------------------------------------------

--
-- テーブルの構造 `todo_table`
--

CREATE TABLE `todo_table` (
  `id` int(12) NOT NULL,
  `todo` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` date NOT NULL,
  `image` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `todo_table`
--

INSERT INTO `todo_table` (`id`, `todo`, `deadline`, `image`, `created_at`, `updated_at`) VALUES
(12, 'aaa', '2020-06-02', NULL, '2020-06-05 12:24:04', '2020-06-12 08:19:05'),
(13, 'bbb', '2020-06-04', NULL, '2020-06-05 12:24:09', '2020-06-05 12:24:09'),
(14, 'ccc', '2020-06-11', NULL, '2020-06-05 12:24:14', '2020-06-05 12:24:14'),
(16, 'eee', '2020-06-02', NULL, '2020-06-05 12:24:22', '2020-06-05 12:24:22'),
(17, 'fff', '2020-06-03', NULL, '2020-06-05 12:24:28', '2020-06-05 12:24:28'),
(18, 'zzz', '2020-06-11', NULL, '2020-06-05 12:24:32', '2020-06-05 12:24:41'),
(19, 'あああ', '2020-06-19', NULL, '2020-06-09 01:05:49', '2020-06-09 01:05:49'),
(20, 'aaa', '2020-06-05', NULL, '2020-06-12 07:43:24', '2020-06-12 07:43:24'),
(21, 'aaa', '2020-06-05', 'upload/20200616051313d9e2bdbe546120a88f621bb2f3014f16.png', '2020-06-16 12:13:13', '2020-06-16 12:13:13');

-- --------------------------------------------------------

--
-- テーブルの構造 `users_table`
--

CREATE TABLE `users_table` (
  `id` int(12) NOT NULL,
  `user_id` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` int(1) NOT NULL,
  `is_deleted` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `users_table`
--

INSERT INTO `users_table` (`id`, `user_id`, `password`, `is_admin`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'testuser', '1234', 1, 0, '2020-06-09 11:53:36', '2020-06-09 11:53:36'),
(2, '3', '3', 0, 0, '2020-06-12 09:04:59', '2020-06-12 09:04:59');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_table_00000001`
--

CREATE TABLE `user_table_00000001` (
  `users_id` int(12) NOT NULL,
  `relation` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `user_table_00000001`
--

INSERT INTO `user_table_00000001` (`users_id`, `relation`) VALUES
(2, '契約チューター'),
(5, '生徒'),
(6, '生徒');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_table_00000002`
--

CREATE TABLE `user_table_00000002` (
  `users_id` int(12) NOT NULL,
  `relation` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `user_table_00000002`
--

INSERT INTO `user_table_00000002` (`users_id`, `relation`) VALUES
(1, '雇用主'),
(5, '生徒'),
(6, '生徒');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_table_00000003`
--

CREATE TABLE `user_table_00000003` (
  `users_id` int(12) NOT NULL,
  `relation` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `user_table_00000003`
--

INSERT INTO `user_table_00000003` (`users_id`, `relation`) VALUES
(4, '契約チューター'),
(7, '生徒'),
(8, '生徒');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_table_00000004`
--

CREATE TABLE `user_table_00000004` (
  `users_id` int(12) NOT NULL,
  `relation` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `user_table_00000004`
--

INSERT INTO `user_table_00000004` (`users_id`, `relation`) VALUES
(3, '雇用主'),
(7, '生徒'),
(8, '生徒');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_table_00000005`
--

CREATE TABLE `user_table_00000005` (
  `users_id` int(12) NOT NULL,
  `relation` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `user_table_00000005`
--

INSERT INTO `user_table_00000005` (`users_id`, `relation`) VALUES
(1, '先生'),
(2, 'チューター');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_table_00000006`
--

CREATE TABLE `user_table_00000006` (
  `users_id` int(12) NOT NULL,
  `relation` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `user_table_00000006`
--

INSERT INTO `user_table_00000006` (`users_id`, `relation`) VALUES
(1, '先生'),
(2, 'チューター');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_table_00000007`
--

CREATE TABLE `user_table_00000007` (
  `users_id` int(12) NOT NULL,
  `relation` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `user_table_00000007`
--

INSERT INTO `user_table_00000007` (`users_id`, `relation`) VALUES
(3, '先生'),
(4, 'チューター');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_table_00000008`
--

CREATE TABLE `user_table_00000008` (
  `users_id` int(12) NOT NULL,
  `relation` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `user_table_00000008`
--

INSERT INTO `user_table_00000008` (`users_id`, `relation`) VALUES
(3, '先生'),
(4, 'チューター');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `cource_table`
--
ALTER TABLE `cource_table`
  ADD PRIMARY KEY (`cource_id`);

--
-- テーブルのインデックス `gram_table`
--
ALTER TABLE `gram_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `like_table`
--
ALTER TABLE `like_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `todo_table`
--
ALTER TABLE `todo_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `user_table_00000001`
--
ALTER TABLE `user_table_00000001`
  ADD PRIMARY KEY (`users_id`);

--
-- テーブルのインデックス `user_table_00000002`
--
ALTER TABLE `user_table_00000002`
  ADD PRIMARY KEY (`users_id`);

--
-- テーブルのインデックス `user_table_00000003`
--
ALTER TABLE `user_table_00000003`
  ADD PRIMARY KEY (`users_id`);

--
-- テーブルのインデックス `user_table_00000004`
--
ALTER TABLE `user_table_00000004`
  ADD PRIMARY KEY (`users_id`);

--
-- テーブルのインデックス `user_table_00000005`
--
ALTER TABLE `user_table_00000005`
  ADD PRIMARY KEY (`users_id`);

--
-- テーブルのインデックス `user_table_00000006`
--
ALTER TABLE `user_table_00000006`
  ADD PRIMARY KEY (`users_id`);

--
-- テーブルのインデックス `user_table_00000007`
--
ALTER TABLE `user_table_00000007`
  ADD PRIMARY KEY (`users_id`);

--
-- テーブルのインデックス `user_table_00000008`
--
ALTER TABLE `user_table_00000008`
  ADD PRIMARY KEY (`users_id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `cource_table`
--
ALTER TABLE `cource_table`
  MODIFY `cource_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルのAUTO_INCREMENT `gram_table`
--
ALTER TABLE `gram_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- テーブルのAUTO_INCREMENT `like_table`
--
ALTER TABLE `like_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- テーブルのAUTO_INCREMENT `todo_table`
--
ALTER TABLE `todo_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- テーブルのAUTO_INCREMENT `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
