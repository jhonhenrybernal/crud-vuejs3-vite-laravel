-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 01-02-2023 a las 22:38:38
-- Versión del servidor: 5.7.36
-- Versión de PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prueba-tecnica-aveonline`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_rol_unique` (`rol`),
  UNIQUE KEY `customers_login_unique` (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=231 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(223, '2014_10_12_000000_create_users_table', 2),
(224, '2014_10_12_100000_create_password_resets_table', 2),
(225, '2019_08_19_000000_create_failed_jobs_table', 2),
(226, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(71, '2023_02_01_153845_create_customers_table', 1),
(227, '2023_02_01_153845_create_products_table', 2),
(228, '2023_02_01_153906_create_roles_table', 2),
(229, '2023_02_01_185557_create_purchase_orders_table', 2),
(230, '2023_02_01_190937_create_purchase_order_products_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `login` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `cost`, `created_at`, `updated_at`) VALUES
(1, 'ABC143', 42, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(2, 'ABC775', 27, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(3, 'ABC769', 18, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(4, 'ABC392', 23, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(5, 'ABC498', 20, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(6, 'ABC604', 35, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(7, 'ABC969', 68, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(8, 'ABC781', 73, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(9, 'ABC164', 61, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(10, 'ABC381', 50, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(11, 'ABC488', 30, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(12, 'ABC063', 13, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(13, 'ABC239', 53, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(14, 'ABC001', 89, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(15, 'ABC105', 46, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(16, 'ABC785', 39, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(17, 'ABC426', 59, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(18, 'ABC885', 94, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(19, 'ABC532', 94, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(20, 'ABC464', 100, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(21, 'ABC650', 86, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(22, 'ABC865', 56, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(23, 'ABC725', 5, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(24, 'ABC081', 77, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(25, 'ABC249', 64, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(26, 'ABC017', 43, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(27, 'ABC681', 48, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(28, 'ABC238', 58, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(29, 'ABC701', 54, '2023-02-02 03:38:24', '2023-02-02 03:38:24'),
(30, 'ABC556', 16, '2023-02-02 03:38:24', '2023-02-02 03:38:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchase_orders`
--

DROP TABLE IF EXISTS `purchase_orders`;
CREATE TABLE IF NOT EXISTS `purchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `cost` int(11) NOT NULL,
  `date_purchase` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_orders_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchase_order_products`
--

DROP TABLE IF EXISTS `purchase_order_products`;
CREATE TABLE IF NOT EXISTS `purchase_order_products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `purchase_orders_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_order_products_purchase_orders_id_foreign` (`purchase_orders_id`),
  KEY `purchase_order_products_product_id_foreign` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Administrador'),
(2, 'Usuario'),
(3, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_rol_unique` (`rol`),
  UNIQUE KEY `users_login_unique` (`login`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `login_verified_at`, `password`, `rol`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2023-02-02 03:38:24', '$2y$10$PHdl194LPpNxs2Z3NYsn6ureWhwx2q77hztoQSZ7yl70N1DivwF82', 1, 'xGjCSGVKQt', '2023-02-02 03:38:24', '2023-02-02 03:38:24');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
