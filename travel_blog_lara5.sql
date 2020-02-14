-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 11 2020 г., 09:22
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
-- Структура таблицы `action_log`
--

CREATE TABLE `action_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `table_name` varchar(100) NOT NULL,
  `method` varchar(100) NOT NULL,
  `record_key_name` varchar(50) NOT NULL,
  `record_id` int(10) UNSIGNED NOT NULL,
  `params` mediumtext NOT NULL,
  `is_restored` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `entry_id` int(10) UNSIGNED NOT NULL,
  `contents` varchar(10000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentor_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `entry_id`, `contents`, `commentor_id`) VALUES
(1, 83, '<p>sgf v <i><strong>Assd</strong></i></p>', 2);

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
(18, 'Moscow', 'Lorem Ipsum is simply dummy text Edited', 'http://localhost/laravel_5_8/travel_blog/public/images/309101576163193.jpg', 2, '2019-12-13 02:14:44');

-- --------------------------------------------------------

--
-- Структура таблицы `entry_region`
--

CREATE TABLE `entry_region` (
  `id` int(10) UNSIGNED NOT NULL,
  `place_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `fcm_tokens`
--

CREATE TABLE `fcm_tokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `token` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2),
(8, '2020_01_03_020323_create_notifications_table', 3),
(9, '2020_01_03_035912_create_push_subscriptions_table', 4),
(10, '2014_10_11_000000_create_entries_table', 5),
(11, '2014_10_13_000000_add_social_columns_into_users_table', 6),
(12, '2019_12_27_083500_create_action_log_table', 6),
(13, '2020_01_30_145000_create_regions_table', 6),
(14, '2020_01_30_145500_create_region_entry_table', 6),
(15, '2020_01_30_163540_create_region_tree_table', 7),
(16, '2020_01_31_152827_create_fcm_tokens_table', 8),
(17, '2020_02_02_192501_create_comments_table', 9);

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Структура таблицы `push_subscriptions`
--

CREATE TABLE `push_subscriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `subscribable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subscribable_id` bigint(20) UNSIGNED NOT NULL,
  `endpoint` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `public_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_encoding` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `push_subscriptions`
--

INSERT INTO `push_subscriptions` (`id`, `subscribable_type`, `subscribable_id`, `endpoint`, `public_key`, `auth_token`, `content_encoding`, `created_at`, `updated_at`) VALUES
(3, 'App\\Models\\User', 2, 'https://fcm.googleapis.com/fcm/send/d5QfWzEYZ4c:APA91bHNu2UtuuKMM9fnOpSGu0Qq8FHu3-fx7WVcpgkMKdampLhMMmOBJKebwDbNQN19nBnnfyf_BhIlV1xOpjF4ilngeHpPTfAC4Gx1JavTZ8cVcWMuhvI_K0CK8dUOCD-es4Z4Hhuj', 'BIJdK4so7N1kwqoX9H7TI2x6BevI6qTnbCubY_3gwp9hmGUrNsSFviY0K54ODg8gdrgFQhm4dWPCznPlAjmY3BI', 'MWxHblXivScsAkn3_HjZ7Q', NULL, '2020-01-03 18:33:44', '2020-01-03 18:33:44'),
(4, 'App\\Models\\User', 2, 'https://updates.push.services.mozilla.com/wpush/v2/gAAAAABeMYeShhJg1BqHvERDvxA0Y8rPXOibYyVXkt_FpmLDEY9-vkAiTq3Gt3G2fLnT5cPRgO4ppWZtmVo2Fbzwe3wpe21VcQmmNzx_OZKTpNgvIDSRuN1MoE8cTn11NeHGQPRq9jvOkXvwEyk3e1Zbppe9l9S9buTRTgwL1_SzDH-2CsKog3A', 'BBvpdmVMMbOszu5r4VkQ3oLNxSkFBz-pLSvWLX1qNxpP6cKwhMu5edWn9jUdTyFGJGiRxBJZ6OSNHYgMj6-qoGY', 'Ff91VjU6IQD5z1NGlH103Q', NULL, '2020-01-29 06:24:06', '2020-01-29 06:24:06'),
(8, 'App\\Models\\User', 2, 'https://fcm.googleapis.com/fcm/send/d1hcwtpvEg0:APA91bEfdl5lZwfgh67VB3rwvMnZSkQGg86nXqisN9KiyhdstJVVnL3KIMkGlYSkZrkkHRZQ08IiwXfQffSvX1-jahuN68O9y0NVOhz9N_k7JYuf4OxpuMF4ozkq_vv3ZY9pI4uHWlYd', 'BDAd7UytR4NPQowPJfbuKfJpiw5g14larZDPy_PBWM-jP4CbHqYsJzsjlkVSeFq2ExHw3m5_I2qUZnkx0rJd6E8', '0eSale8N8MGJM4CznYlaIg', NULL, '2020-02-02 05:38:16', '2020-02-02 05:38:16'),
(9, 'App\\Models\\User', 2, 'https://fcm.googleapis.com/fcm/send/fuTGXaPzxkM:APA91bELoEfcK4XIiyoVUx9fT_qeJ942mG_WUvL7N3VFd7Kag5rRN1Oh3vnalqsj3sunpsRzTWlc2piMwm-J-YOO5PcoSjcTSRZtlQDpw5jQgV9x_Q99hB2FKjx__faITzIUY0B_PJxv', 'BJqCPhaKNNJWZpYsjjidfQtSMA7NvmJN2_0TtVwqiqyi7QZLcPS-h1Vh3nB_A2W2mwi_jcrc1cTwcfeOwXekGEA', 'NnD7OdWORMvkevIkduI3wQ', NULL, '2020-02-04 23:54:46', '2020-02-04 23:54:46'),
(10, 'App\\Models\\User', 2, 'https://fcm.googleapis.com/fcm/send/fH6bd1eeIf4:APA91bEFUVb_AVJk0nqjKnc_8Z1eaKe6P3LJx8eEI1m_7Ttn0Xm7c1j787RRKYTTiy3hxUVqlW48fbplOAMCREjmiKIKigYbpmGUr_t4k1BxLaAKBtngYkMjSp55MLR2q_otJUq5cIkH', 'BJ70286YmJ3Kwc9w9LOucx6nsyrOiEnc2GtvFe9JW6RWM_pZyuZn3S2Q6-R2VfKD5WLdKYMlpJWfvh-awygkE0A', '6HQ0VAfqqfjkrYcRRysjPg', NULL, '2020-02-05 00:01:10', '2020-02-05 00:01:10'),
(11, 'App\\Models\\User', 2, 'https://fcm.googleapis.com/fcm/send/dufvaXs9iVk:APA91bGMjONaD5b0sr0ZqXoKPk9d26A7M4XaC47X9-8_lFrPbe3xoemAdEScPWLfUOIVbSy7qbxkP6YLEip4LxqwIxrMBnYlM_xsWyIhNgBKUjrGrNywuUniOrTlq3-hpIKiXFzNEAwT', 'BAS3wzzFYFQ9Qmp_uhMOWuO6kT55zTIhDwBjcCvYbQYfdW7bcsYouN_OQYRCkNPIw_fVK0OijPZx8oEMbNzlESg', 'Zuxq8yYbfRQRghsanUzD3Q', NULL, '2020-02-05 00:03:28', '2020-02-05 00:03:28'),
(12, 'App\\Models\\User', 2, 'https://fcm.googleapis.com/fcm/send/fV3LbHFz-1Q:APA91bFUeYR0gWESEAk-R6ow7qov9Fkeq0fA31L1o7RLygCXLyr4m6OIecyLt0-U2aXK6SJeWbG9YktJlZ3Q96LLANiGt5oHnqhTIr2p93YFqAOfj_dS8WpdPVj4wNvHLttNHt1BSHoy', 'BMj4WAMIrC1wbfhRjqGYLzMoOMkO1VULfYArD1MlMtcVaILg7NcOadxeCC6zHR4-89pUn-N8OfeZtd4cvsyfqiA', 'H03giXRc1Xgb4pDl4oKh3Q', NULL, '2020-02-05 01:17:18', '2020-02-05 01:17:18'),
(13, 'App\\Models\\User', 2, 'https://fcm.googleapis.com/fcm/send/fvp-XY3Q6l4:APA91bFx30X2A3vQdC7e_b-AgcCD9ixVqkmmklfiN7TNiklLtCA_ziGAs6tafP-1y1QYaqSpimZw1J2PHa49LKpl8_87qRPlueRYUDKoRQh2Lfs4XPW8WRAyDHH0MnQoMwB7KruF4L7c', 'BM9v9hZMJALgDXL7bMD9H7GwdfdRWj7Cv510bQFF5-xk394U6nTdX_06KAZHUQNBjWpQK8cECbFFUVOJXjBS7MY', '8PFSVtQEgLaH9wkGD3YMOg', NULL, '2020-02-05 01:18:47', '2020-02-05 01:18:47'),
(14, 'App\\Models\\User', 2, 'https://fcm.googleapis.com/fcm/send/do6tl7c-7LU:APA91bHi_3kDdQJqUY49a-593TzhTi8Dc5nnBEnVTKmRxVASKJARChRr6x_LwcT25oBpKLLfil7JfvH4fkPUlGTdM0RujHh_hNFoqXQQyw-buvKAdL_KZ-e2SarXk6uqSh7Kvsey23D1', 'BEi7WVzTdOdio4l5CB9o5wwAzH9Qpt16eR_klBsOijeDmBl6LsQODmFjZxdOexg9Zak-rSrScHAzDyLz1ignsAg', '05mC7IMdY_f5I7B8IzmBbw', NULL, '2020-02-05 01:21:38', '2020-02-05 01:21:38'),
(15, 'App\\Models\\User', 2, 'https://fcm.googleapis.com/fcm/send/d99LqsFYbus:APA91bFXuTCNq5SlCoGzJ4ePy9cViTosBtpMIz1A1U5yBOvPP51axIB9tiZesC0nT8Aw_QSMQ6_KuF0Manx42J-bWZMD52yfIx3fprbzixADcBVOjC1Y_UrVlB-HwVQnmJMogRN2hAAd', 'BPkp9CaJA4iVpExewa2RBJiizE9Apof8KLi5JC7IDlAW_Zj9jYm0GEc31iQCqWFV8XsVqQuC1HFLez3Byd5goVE', '_FJFgpyomU2zJv0aP-vIJA', NULL, '2020-02-05 02:56:36', '2020-02-05 02:56:36'),
(16, 'App\\Models\\User', 2, 'https://fcm.googleapis.com/fcm/send/c9Xuj4cA1ic:APA91bGWhEQCyjwba7GlsgDUr4daB6cZa9f1BwSJe-c-J-al6timUUDljc03wAKEA_mPQTjCosbr_hnb_-Z8MSBog-3Bj7pBvNizjXjhnprwwqyQSPLODeab6_07IkpnzqpVGxpyk3YN', 'BKDxHkYs0kykZu2SA78ISGzyviIhoHGM-uq9scXOR9vMibUx1DdFLx7jtOwcOFRHo_klLAFcntk9y2J5Vc5JbuA', 'KtKsHRw6YamHi1qz8vhlNA', NULL, '2020-02-05 02:59:43', '2020-02-05 02:59:43'),
(17, 'App\\Models\\User', 2, 'https://fcm.googleapis.com/fcm/send/fgyg5uhHMKc:APA91bEK5LVVeg-s3VqqGkFrMCpO7UQQjqQErkcp28uLja83IavUbJgyyOUx_BmMeKInuP_C9GLgK4Q8OoTfurxANfW_YJk4vdoF4VpcFoq4_PJLy905C8ibVQztuXU_NO0h0g661PGg', 'BK2sIMdOWwlRdnWZllJWVywNE__asWnqOQ_KAfCU1BGC4OJr8VVi5S_zv4reOZFdjEdiXhZFkYgUr5NnxnJC6pM', 'YjKpB0IV0OJrmAwfih4EOg', NULL, '2020-02-05 03:02:18', '2020-02-05 03:02:18'),
(18, 'App\\Models\\User', 2, 'https://fcm.googleapis.com/fcm/send/fkbZYxCBi_0:APA91bF3vBm0oJU4-Cf_W5HysUrh3UTcVHfWpb8Cc3cMbARjvC7jAYBH1MlDVuUp_xqfsB7conbrQYcn7OiKRZN5BPV--iMnSyFKGxFR_VV5hic-Rk5oVZJzZw5AZofEkWiyey67prMw', 'BMvGG5uu744B8b8RThSORNUDax1TkRDVFwy8DXbQ9SGhbmvMlsCJau5_PFd_TYjCWDFORsTEEyLW5TDCemdnA_o', 'pu03G7WMllHoxLA9ZaXdzw', NULL, '2020-02-05 03:04:24', '2020-02-05 03:04:24'),
(19, 'App\\Models\\User', 2, 'https://fcm.googleapis.com/fcm/send/cmiCHBFirSw:APA91bFJvuGWLQcGzS5j7D9ygXRFzSTfhhLzplTJmUxud5ecClRK5RGL2R-GWbU_HdRxzbXA-V72RMd0ekw9-Igt3MzEnqFLyxiyqW9LTPYUw10DejeEWunubWdpTGV54csATYBElKtn', 'BKiliMZY4OmOimlsOcu60XRY7qcvUgLdbGiBw6Z0dpbLOiCdJCWMR_67FN0GVu01J6ggc0332INxkR79r2JwfeU', 'RYxUoR30L-xAWQWWA-l5Ew', NULL, '2020-02-05 03:06:59', '2020-02-05 03:06:59'),
(20, 'App\\Models\\User', 2, 'https://fcm.googleapis.com/fcm/send/esn5FVf69VI:APA91bHKcuAZ0qczuQbHtvkMS7-01N_OxAUcvfSh_mrQfgxZxKPmHEQ7W4Pii3R8Xz4EYnoMMYNvGPUhirNA8zkkbuBAmSlXGDZJdESZ6FLm0JvhEG9BPKtHscmVL4LkREkRJpmgUZxH', 'BJFX-bzcdlNxir8DzVT8Whoa6z8r9F9UhaeQtC_xO4wHUPnaYErZxegA_MCgl0JAnjWsnlEKdbIaq5V9T8HUr9U', 'b3Yh_QAeyYtRx_7ZjzieCg', NULL, '2020-02-05 03:09:48', '2020-02-05 03:09:48'),
(21, 'App\\Models\\User', 2, 'https://fcm.googleapis.com/fcm/send/cbmu6mQ9_ww:APA91bE2tFsg3Z6DLNi4mzfrS2SbXqzavgUEwSilRVKrVAdsyWCJY91EKcjviMbMrh8BpOddcoOpAj2m2hKSUzw8dhrxLPJxjnPilJiUuQtvyfhspJrkyM_zFqVyQ78Mu8SbmSaVIp57', 'BGySCcDGGQa-Y6UpsAswsmqvgLrShCY_SuVFN04b_PvSfe7J6W6YAoxp4XiGMMf4A2AcCFQwk-8uzY8SHByGACs', 'EARyX9yz1FGAekZOo0NaJQ', NULL, '2020-02-05 03:17:40', '2020-02-05 03:17:40');

-- --------------------------------------------------------

--
-- Структура таблицы `regions`
--

CREATE TABLE `regions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `regions`
--

INSERT INTO `regions` (`id`, `name`) VALUES
(1, 'Asia'),
(4, 'Europe'),
(6, 'Africa');

-- --------------------------------------------------------

--
-- Структура таблицы `region_tree`
--

CREATE TABLE `region_tree` (
  `region_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `region_tree`
--

INSERT INTO `region_tree` (`region_id`, `parent_id`) VALUES
(1, 0),
(4, 1),
(6, 1);

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
(3, 'Admin', 'steppe.ego@gmail.com', NULL, '$2y$10$2CdWmW8tPwGL6oeYL2SvEOVK/K9VCcP7OcsepAmttT.dbXDqOCvQS', NULL, '2019-12-12 08:37:10', '2019-12-12 08:37:10', 'normal', NULL),
(4, 'John', 'eldorado1485@outlook.co.nz', NULL, '$2y$10$ue86EKQ1wSHmTVBWzHgkn.rAsNfCgCWmLp8NUTbETNqqVq1X4kfbm', NULL, '2020-02-02 05:35:29', '2020-02-02 05:35:29', 'normal', NULL),
(5, 'Jane', 'atabegruslan@gmail.com', NULL, '$2y$10$o9JsqhQ5AWNKZ5ScQH1GtuJfbQ6rsFk1W9//7tWUpTm8cZGktuPpC', NULL, '2020-02-02 05:36:15', '2020-02-02 05:36:15', 'normal', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `action_log`
--
ALTER TABLE `action_log`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_comment` (`commentor_id`);

--
-- Индексы таблицы `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_entry` (`user_id`);

--
-- Индексы таблицы `entry_region`
--
ALTER TABLE `entry_region`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `fcm_tokens`
--
ALTER TABLE `fcm_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

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
-- Индексы таблицы `push_subscriptions`
--
ALTER TABLE `push_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `push_subscriptions_endpoint_unique` (`endpoint`),
  ADD KEY `push_subscriptions_subscribable_type_subscribable_id_index` (`subscribable_type`,`subscribable_id`);

--
-- Индексы таблицы `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `action_log`
--
ALTER TABLE `action_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `entries`
--
ALTER TABLE `entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT для таблицы `entry_region`
--
ALTER TABLE `entry_region`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `fcm_tokens`
--
ALTER TABLE `fcm_tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
-- AUTO_INCREMENT для таблицы `push_subscriptions`
--
ALTER TABLE `push_subscriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `user_comment` FOREIGN KEY (`commentor_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `entries`
--
ALTER TABLE `entries`
  ADD CONSTRAINT `user_entry` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
