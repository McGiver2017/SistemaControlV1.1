-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-02-2018 a las 23:32:37
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemacontrol`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `balances`
--

CREATE TABLE `balances` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo` enum('ingreso','egreso') COLLATE utf8mb4_unicode_ci NOT NULL,
  `monto` decimal(8,2) NOT NULL,
  `saldo_caja` decimal(8,2) NOT NULL,
  `saldo_final` decimal(8,2) NOT NULL,
  `vehiculo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caja_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajas`
--

CREATE TABLE `cajas` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_apertura` date NOT NULL,
  `fecha_cierre` date NOT NULL,
  `monto` decimal(8,2) NOT NULL,
  `estado` enum('Abierto','Cerrado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Abierto',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo_doc` enum('1','6') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '6',
  `num_doc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `razon_social` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conductors`
--

CREATE TABLE `conductors` (
  `id` int(10) UNSIGNED NOT NULL,
  `dni` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brevete` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` enum('libre','en servicio','inactivo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'libre',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalletransportes`
--

CREATE TABLE `detalletransportes` (
  `id` int(10) UNSIGNED NOT NULL,
  `transporte_id` int(10) UNSIGNED NOT NULL,
  `num_doc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_facturas`
--

CREATE TABLE `detalle_facturas` (
  `id` int(10) UNSIGNED NOT NULL,
  `cantidad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio_unitario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `igv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tip_afe_igv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valor_unitario` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valor_venta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `factura_id` int(10) UNSIGNED NOT NULL,
  `producto_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` int(10) UNSIGNED NOT NULL,
  `guia_id` int(10) UNSIGNED NOT NULL,
  `tipo_doc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '01',
  `serie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'FF11',
  `correlativo` int(11) DEFAULT NULL,
  `fecha_emision` date NOT NULL,
  `fecha_vencimiento` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_moneda` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PEN',
  `monto_oper_gravadas` decimal(8,2) NOT NULL,
  `monto_oper_exonerada` int(11) NOT NULL DEFAULT '0',
  `monto_oper_inafectada` int(11) NOT NULL DEFAULT '0',
  `monto_igv` decimal(8,2) NOT NULL,
  `monto_total_venta` decimal(8,2) NOT NULL,
  `legen_cod` int(11) DEFAULT NULL,
  `legen_descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cliente_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `crs_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crs_estado` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_pdf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado_factura` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No enviado',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guias`
--

CREATE TABLE `guias` (
  `id` int(10) UNSIGNED NOT NULL,
  `correlativo` int(11) DEFAULT NULL,
  `transporte_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, '2018_02_09_050257_create_clientes_table', 1),
(4, '2018_02_09_150434_create_proveedors_table', 1),
(5, '2018_02_09_150849_create_conductors_table', 1),
(6, '2018_02_09_210729_create_vehiculos_table', 1),
(7, '2018_02_09_210835_create_productos_table', 1),
(8, '2018_02_12_015053_create_empresas_table', 1),
(9, '2018_02_18_142141_create_transportes_table', 1),
(10, '2018_02_18_162416_create_guias_table', 1),
(11, '2018_02_19_020118_create_facturas_table', 1),
(12, '2018_02_19_020152_create_detalle_facturas_table', 1),
(13, '2018_02_20_191015_create_detalletransportes_table', 1),
(14, '2018_02_21_061001_create_cajas_table', 1),
(15, '2018_02_21_061411_create_balances_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(10) UNSIGNED NOT NULL,
  `cod_producto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unidad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NIU',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedors`
--

CREATE TABLE `proveedors` (
  `id` int(10) UNSIGNED NOT NULL,
  `ruc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `razon_social` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transportes`
--

CREATE TABLE `transportes` (
  `id` int(10) UNSIGNED NOT NULL,
  `ingresos` decimal(8,2) NOT NULL,
  `egresos` decimal(8,2) NOT NULL,
  `fecha_envio` date NOT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modalidad_transporte` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `p_partida` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `p_llegada` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motivo_traslado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'venta',
  `conductor_id` int(10) UNSIGNED NOT NULL,
  `vehiculo_id` int(10) UNSIGNED NOT NULL,
  `proveedor_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombres` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombres`, `apellidos`, `alias`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'grupo', 'alania', 'grupo', 'grupo_alania@hotmail.com', '12345', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` int(10) UNSIGNED NOT NULL,
  `placa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marca` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_certificado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `config_vehicular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` enum('libre','en servicio','inactivo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'libre',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `balances`
--
ALTER TABLE `balances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `balances_caja_id_foreign` (`caja_id`);

--
-- Indices de la tabla `cajas`
--
ALTER TABLE `cajas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `conductors`
--
ALTER TABLE `conductors`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalletransportes`
--
ALTER TABLE `detalletransportes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalletransportes_transporte_id_foreign` (`transporte_id`);

--
-- Indices de la tabla `detalle_facturas`
--
ALTER TABLE `detalle_facturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_facturas_factura_id_foreign` (`factura_id`),
  ADD KEY `detalle_facturas_producto_id_foreign` (`producto_id`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facturas_guia_id_foreign` (`guia_id`),
  ADD KEY `facturas_cliente_id_foreign` (`cliente_id`),
  ADD KEY `facturas_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `guias`
--
ALTER TABLE `guias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guias_transporte_id_foreign` (`transporte_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedors`
--
ALTER TABLE `proveedors`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transportes`
--
ALTER TABLE `transportes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transportes_conductor_id_foreign` (`conductor_id`),
  ADD KEY `transportes_vehiculo_id_foreign` (`vehiculo_id`),
  ADD KEY `transportes_proveedor_id_foreign` (`proveedor_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `balances`
--
ALTER TABLE `balances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cajas`
--
ALTER TABLE `cajas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `conductors`
--
ALTER TABLE `conductors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalletransportes`
--
ALTER TABLE `detalletransportes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_facturas`
--
ALTER TABLE `detalle_facturas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `guias`
--
ALTER TABLE `guias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedors`
--
ALTER TABLE `proveedors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `transportes`
--
ALTER TABLE `transportes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `balances`
--
ALTER TABLE `balances`
  ADD CONSTRAINT `balances_caja_id_foreign` FOREIGN KEY (`caja_id`) REFERENCES `cajas` (`id`);

--
-- Filtros para la tabla `detalletransportes`
--
ALTER TABLE `detalletransportes`
  ADD CONSTRAINT `detalletransportes_transporte_id_foreign` FOREIGN KEY (`transporte_id`) REFERENCES `transportes` (`id`);

--
-- Filtros para la tabla `detalle_facturas`
--
ALTER TABLE `detalle_facturas`
  ADD CONSTRAINT `detalle_facturas_factura_id_foreign` FOREIGN KEY (`factura_id`) REFERENCES `facturas` (`id`),
  ADD CONSTRAINT `detalle_facturas_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `facturas_guia_id_foreign` FOREIGN KEY (`guia_id`) REFERENCES `guias` (`id`),
  ADD CONSTRAINT `facturas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `guias`
--
ALTER TABLE `guias`
  ADD CONSTRAINT `guias_transporte_id_foreign` FOREIGN KEY (`transporte_id`) REFERENCES `transportes` (`id`);

--
-- Filtros para la tabla `transportes`
--
ALTER TABLE `transportes`
  ADD CONSTRAINT `transportes_conductor_id_foreign` FOREIGN KEY (`conductor_id`) REFERENCES `conductors` (`id`),
  ADD CONSTRAINT `transportes_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedors` (`id`),
  ADD CONSTRAINT `transportes_vehiculo_id_foreign` FOREIGN KEY (`vehiculo_id`) REFERENCES `vehiculos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
