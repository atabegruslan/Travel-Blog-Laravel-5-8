-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 12 2019 г., 18:37
-- Версия сервера: 10.4.8-MariaDB
-- Версия PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `travel_blog_lara5`
--

-- --------------------------------------------------------

--
-- Структура таблицы `entries`
--

CREATE TABLE `entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `place` varchar(15) NOT NULL,
  `comments` varchar(50) NOT NULL,
  `img_url` varchar(500) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `entries`
--

INSERT INTO `entries` (`id`, `place`, `comments`, `img_url`, `user_id`, `time`) VALUES
(1, 'Baku', 'Lorem Ipsum is simply dummy text', 'http://localhost/laravel_5_8/travel_blog/public/images/611031576162936.jpg', 2, '2019-12-12 15:02:16'),
(2, 'Akhaltsikhe', 'Lorem Ipsum is simply dummy text', 'http://localhost/laravel_5_8/travel_blog/public/images/374541576162962.jpg', 2, '2019-12-12 15:02:43'),
(3, 'Gori', 'Lorem Ipsum is simply dummy text', 'http://localhost/laravel_5_8/travel_blog/public/images/298881576162977.jpg', 2, '2019-12-12 15:02:58'),
(4, 'Samarkand', 'Lorem Ipsum is simply dummy text', 'http://localhost/laravel_5_8/travel_blog/public/images/752131576162991.jpg', 2, '2019-12-12 15:03:11'),
(5, 'Kadovan', 'Lorem Ipsum is simply dummy text', 'http://localhost/laravel_5_8/travel_blog/public/images/324811576163012.jpg', 2, '2019-12-12 15:03:32'),
(6, 'Mardin', 'Lorem Ipsum is simply dummy text', 'http://localhost/laravel_5_8/travel_blog/public/images/243031576163030.jpg', 2, '2019-12-12 15:03:51'),
(7, 'Ashgabad', 'Lorem Ipsum is simply dummy text', 'http://localhost/laravel_5_8/travel_blog/public/images/813851576163042.jpg', 2, '2019-12-12 15:04:03'),
(8, 'Khiva', 'Lorem Ipsum is simply dummy text', 'http://localhost/laravel_5_8/travel_blog/public/images/493561576163054.jpg', 2, '2019-12-12 15:04:15'),
(9, 'Vardzia', 'Lorem Ipsum is simply dummy text', 'http://localhost/laravel_5_8/travel_blog/public/images/796901576163070.jpg', 2, '2019-12-12 15:04:31'),
(10, 'Esfahan', 'Lorem Ipsum is simply dummy text', 'http://localhost/laravel_5_8/travel_blog/public/images/430161576163085.jpg', 2, '2019-12-12 15:04:45'),
(11, 'Moscow', 'Lorem Ipsum is simply dummy text', 'http://localhost/laravel_5_8/travel_blog/public/images/602131576163097.jpg', 2, '2019-12-12 15:04:58'),
(12, 'Saigon', 'Lorem Ipsum is simply dummy text', 'http://localhost/laravel_5_8/travel_blog/public/images/244241576163110.jpg', 2, '2019-12-12 15:05:11'),
(13, 'Saigon', 'Lorem Ipsum is simply dummy text', 'http://localhost/laravel_5_8/travel_blog/public/images/278111576163124.jpg', 2, '2019-12-12 15:05:24'),
(14, 'Can Gio', 'Lorem Ipsum is simply dummy text', 'http://localhost/laravel_5_8/travel_blog/public/images/683821576163139.jpg', 2, '2019-12-12 15:05:40'),
(15, 'Auckland', 'Lorem Ipsum is simply dummy text', 'http://localhost/laravel_5_8/travel_blog/public/images/216791576163153.jpg', 2, '2019-12-12 15:05:53'),
(16, 'Mui Ne', 'Lorem Ipsum is simply dummy text', 'http://localhost/laravel_5_8/travel_blog/public/images/905451576163165.jpg', 2, '2019-12-12 15:06:06'),
(17, 'Buu Long', 'Lorem Ipsum is simply dummy text', 'http://localhost/laravel_5_8/travel_blog/public/images/790131576163180.jpg', 2, '2019-12-12 15:06:21'),
(18, 'Moscow', 'Lorem Ipsum is simply dummy text', 'http://localhost/laravel_5_8/travel_blog/public/images/309101576163193.jpg', 2, '2019-12-12 15:06:34');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(6, '2016_06_01_000004_create_oauth_clients_table', 2),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('e3fdb4b243b997b9579869eef18bd28a52ca63b6f953a0c883959da49016a007660c3c0c88579d78', 2, 2, NULL, '[]', 0, '2019-12-12 00:11:50', '2019-12-12 00:11:50', '2020-12-12 07:11:50'),
('fdb0a0c6130c4a629d19df7f26ec7a85d0d6d317999d324aaf9ff882240811768b490c294b5efd7c', 2, 2, NULL, '[]', 0, '2019-12-12 08:34:28', '2019-12-12 08:34:28', '2020-12-12 15:34:28');

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'KygivvkgstEclXCZIWsktl4eFDG4Xbpy4b2pc3tN', 'http://localhost', 1, 0, 0, '2019-12-11 23:58:41', '2019-12-11 23:58:41'),
(2, NULL, 'Laravel Password Grant Client', 'tfGaQSCI10kV9wIOQ5EIbZb82yZ9xKZXqx2BHjYM', 'http://localhost', 0, 1, 0, '2019-12-11 23:58:41', '2019-12-11 23:58:41');

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-12-11 23:58:41', '2019-12-11 23:58:41');

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `oauth_refresh_tokens`
--

INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('3bf3380c592135e4531ab855b24e8d96529e5640fc7d42b4b45ad7e240a1601b050d131d959ff49a', 'fdb0a0c6130c4a629d19df7f26ec7a85d0d6d317999d324aaf9ff882240811768b490c294b5efd7c', 0, '2020-12-12 15:34:28'),
('66036edd9e104a25b91e97bd0620db526dc0002494795fc376f3abad042439c9512c31c120a32a91', 'e3fdb4b243b997b9579869eef18bd28a52ca63b6f953a0c883959da49016a007660c3c0c88579d78', 0, '2020-12-12 07:11:50');

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal',
  `social_id` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `type`, `social_id`) VALUES
(2, 'ruslan', 'ruslan_aliyev_@hotmail.com', NULL, '$2y$10$fEwIRaEJB3A3sDSYHObUTeKwe/HUocxuX78M2IfsbMBydqbLvRe0a', NULL, '2019-12-11 07:54:39', '2019-12-11 07:54:39', 'normal', NULL),
(3, 'Admin', 'steppe.ego@gmail.com', NULL, '$2y$10$2CdWmW8tPwGL6oeYL2SvEOVK/K9VCcP7OcsepAmttT.dbXDqOCvQS', NULL, '2019-12-12 08:37:10', '2019-12-12 08:37:10', 'normal', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_entry` (`user_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Индексы таблицы `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Индексы таблицы `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Индексы таблицы `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `entries`
--
ALTER TABLE `entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `entries`
--
ALTER TABLE `entries`
  ADD CONSTRAINT `user_entry` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
