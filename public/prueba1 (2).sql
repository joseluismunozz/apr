-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2020 a las 06:38:34
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prueba1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cupondepago`
--

CREATE TABLE `cupondepago` (
  `idcupondepago` int(10) NOT NULL,
  `idvivienda` int(10) NOT NULL,
  `idvalor` int(10) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idfactura` int(10) UNSIGNED NOT NULL,
  `estado` varchar(45) NOT NULL,
  `totalCobrado` bigint(20) NOT NULL,
  `estadodepago` varchar(45) NOT NULL,
  `idvivienda` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicion`
--

CREATE TABLE `medicion` (
  `idmedicion` int(10) UNSIGNED NOT NULL,
  `idvivienda` int(10) UNSIGNED NOT NULL,
  `idinscriptor` bigint(20) UNSIGNED NOT NULL DEFAULT 2,
  `valordemedicion` bigint(20) UNSIGNED NOT NULL,
  `fechadeingreso` date NOT NULL,
  `estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medicion`
--

INSERT INTO `medicion` (`idmedicion`, `idvivienda`, `idinscriptor`, `valordemedicion`, `fechadeingreso`, `estado`) VALUES
(1, 1, 2, 82399, '2020-11-02', 'activo'),
(2, 2, 2, 86790, '2020-11-02', 'activo'),
(3, 2, 2, 4958, '2020-11-02', 'activo'),
(4, 1, 2, 789324, '2020-11-02', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2020_10_11_051242_create_sessions_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `idpago` int(10) UNSIGNED NOT NULL,
  `idfactura` int(10) UNSIGNED NOT NULL,
  `Fecha` date NOT NULL,
  `valorpagado` bigint(20) NOT NULL,
  `estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('duegix@gmail.com', '$2y$10$egmazIoQtVfVrl.ahYSgc.UvPF97OvBdoHaweRbGm3.cFrKkO3GEu', '2020-11-15 08:10:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `representantedevivienda`
--

CREATE TABLE `representantedevivienda` (
  `idrepresentante` int(10) UNSIGNED NOT NULL,
  `idvivienda` int(10) UNSIGNED NOT NULL,
  `rut` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `representantedevivienda`
--

INSERT INTO `representantedevivienda` (`idrepresentante`, `idvivienda`, `rut`, `nombre`, `telefono`, `email`, `estado`) VALUES
(1, 1, '19.648.119-2', 'diego', '945768768', 'duegix@gmail.com', 'activo'),
(2, 2, '19.486.813-8', 'jose luis', '565566', 'joseluismunozzuniga@gmail.com', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saldodiferenciado`
--

CREATE TABLE `saldodiferenciado` (
  `idsaldodiferenciado` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `monto` bigint(20) NOT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `estado` varchar(45) NOT NULL,
  `idvivienda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `saldodiferenciado`
--

INSERT INTO `saldodiferenciado` (`idsaldodiferenciado`, `descripcion`, `monto`, `tipo`, `estado`, `idvivienda`) VALUES
(1, 'agregado desde mantenedor', 10000, 'haber', 'activo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('DtaJ0E0Uu8ekmXAkMzqKUeqSqUbu26pS8eWMoiF3', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieEZYVUNURDNRdW5oc0lJVHZTN2pScmNoNDNGU3QzU3ZkTm9CejVGdyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo2NToiaHR0cDovL2xvY2FsaG9zdDo4MDgwL2FndWElMjBwb3RhYmxlJTIwcnVyYWwvYXByL3B1YmxpYy9kYXNoYm9hcmQiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo2NDoiaHR0cDovL2xvY2FsaG9zdDo4MDgwL2FndWElMjBwb3RhYmxlJTIwcnVyYWwvYXByL3B1YmxpYy9tZWRpY2lvbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1605389264),
('oTeEosO0U6VgWliT9jJRuDx06I7JCipA2NUeHKBU', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.198 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSUkyQTJYR1JSTVB1TExjN0VLYWdmbnJkYXVLTU9FenNOUWZnQ0JNVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODA4MC9hZ3VhJTIwcG90YWJsZSUyMHJ1cmFsL2Fwci9wdWJsaWMvc2FsZG9kaWZlcmVuY2lhZG8iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1605397577);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subsidio`
--

CREATE TABLE `subsidio` (
  `idsubsidio` int(10) UNSIGNED NOT NULL,
  `porcentajededescuento` varchar(3) NOT NULL,
  `tipodesubsidio` varchar(45) NOT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `subsidio`
--

INSERT INTO `subsidio` (`idsubsidio`, `porcentajededescuento`, `tipodesubsidio`, `estado`, `descripcion`) VALUES
(1, '10', 'estatal', 'inactivo', 'subsidio por garantia estatal'),
(2, '100', 'empresarial para convenio', 'activo', 'subsidio total'),
(3, '250', 'falso', 'activo', 'prueba'),
(4, '100', 'prueba', 'activo', 'prueba');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Rol` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'socio'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `Rol`) VALUES
(2, 'diego', 'duegix@gmail.com', NULL, '$2y$10$NxgNouxGGrQfX6NEkw/6Ne4JmWxlGqLOqUoeBfkkuFvonGdy1lkz6', NULL, NULL, 'VLrUJn3ZxcjGfwou1K1kigYeRN3TRKL1gjAEjEHm7oDVL7hQ53HJOgZp2Gb3', NULL, NULL, '2020-10-19 13:05:17', '2020-10-19 13:05:17', 'administrador general');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valorm3`
--

CREATE TABLE `valorm3` (
  `idValorM3` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `estado` varchar(45) NOT NULL,
  `precio` double UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `valorm3`
--

INSERT INTO `valorm3` (`idValorM3`, `nombre`, `descripcion`, `estado`, `precio`) VALUES
(1, 'jaksh', 'kajhsd|', 'inactivo', 123),
(2, 'jaksh', 'kajhsd|', 'inactivo', 123),
(3, 'kajhgd', 'kjahdkj|', 'inactivo', 2345),
(4, 'diego', 'ajdkal', 'inactivo', 134),
(5, 'diego', 'ajdkal', 'inactivo', 134),
(6, 'carlos', '23oij', 'inactivo', 1234),
(7, 'cesar', '1234', 'inactivo', 3242),
(8, 'akjsl', 'lqkhje1|', 'inactivo', 23),
(9, 'lkdsjl', 'lkahjdlj', 'inactivo', 123),
(10, 'jsdlj', 'owiu39||', 'inactivo', 9724),
(11, 'ksjhdfh', 'ksdjhadkj', 'inactivo', 123),
(12, 'invierno', 'costo por periodo trimestral invernal', 'inactivo', 800),
(13, 'verano', 'periodo trimestral de verano', 'activo', 700),
(14, 'reajuste ipc 2020', 'nuevo valor por m3 correspondiente al ajuste de ipc', 'activo', 1000),
(15, 'persona natural', 'valor para personas naturales sin convenios ni giros facturables', 'activo', 1100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vivienda`
--

CREATE TABLE `vivienda` (
  `idvivienda` int(10) UNSIGNED NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `idsubsidio` int(10) UNSIGNED NOT NULL,
  `numeromedidor` bigint(20) NOT NULL,
  `estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vivienda`
--

INSERT INTO `vivienda` (`idvivienda`, `direccion`, `idsubsidio`, `numeromedidor`, `estado`) VALUES
(1, 'las rosas 899 quillon', 2, 1234, 'activo'),
(2, 'asa', 4, 2345, 'activo'),
(6, 'lasjkladlj', 3, 12345, 'activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cupondepago`
--
ALTER TABLE `cupondepago`
  ADD PRIMARY KEY (`idcupondepago`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idfactura`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `medicion`
--
ALTER TABLE `medicion`
  ADD PRIMARY KEY (`idmedicion`),
  ADD KEY `idinscriptoe_idx` (`idinscriptor`),
  ADD KEY `idviviendamedicion_idx` (`idvivienda`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`idpago`),
  ADD KEY `idfactura1_idx` (`idfactura`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `representantedevivienda`
--
ALTER TABLE `representantedevivienda`
  ADD PRIMARY KEY (`idrepresentante`);

--
-- Indices de la tabla `saldodiferenciado`
--
ALTER TABLE `saldodiferenciado`
  ADD PRIMARY KEY (`idsaldodiferenciado`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `subsidio`
--
ALTER TABLE `subsidio`
  ADD PRIMARY KEY (`idsubsidio`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `valorm3`
--
ALTER TABLE `valorm3`
  ADD PRIMARY KEY (`idValorM3`);

--
-- Indices de la tabla `vivienda`
--
ALTER TABLE `vivienda`
  ADD PRIMARY KEY (`idvivienda`),
  ADD UNIQUE KEY `numeromedidor` (`numeromedidor`),
  ADD KEY `idsubsidio_idx` (`idsubsidio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cupondepago`
--
ALTER TABLE `cupondepago`
  MODIFY `idcupondepago` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idfactura` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medicion`
--
ALTER TABLE `medicion`
  MODIFY `idmedicion` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `idpago` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `representantedevivienda`
--
ALTER TABLE `representantedevivienda`
  MODIFY `idrepresentante` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `saldodiferenciado`
--
ALTER TABLE `saldodiferenciado`
  MODIFY `idsaldodiferenciado` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `subsidio`
--
ALTER TABLE `subsidio`
  MODIFY `idsubsidio` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `valorm3`
--
ALTER TABLE `valorm3`
  MODIFY `idValorM3` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `vivienda`
--
ALTER TABLE `vivienda`
  MODIFY `idvivienda` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `medicion`
--
ALTER TABLE `medicion`
  ADD CONSTRAINT `idinscriptoe` FOREIGN KEY (`idinscriptor`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `idfactura1` FOREIGN KEY (`idfactura`) REFERENCES `factura` (`idfactura`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `vivienda`
--
ALTER TABLE `vivienda`
  ADD CONSTRAINT `idsubsidio` FOREIGN KEY (`idsubsidio`) REFERENCES `subsidio` (`idsubsidio`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
