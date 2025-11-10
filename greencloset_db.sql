-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-10-2025 a las 04:49:34
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `greencloset_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_usuarios`
--

CREATE TABLE `carrito_usuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `producto_id` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `fecha_agregado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `carrito_usuarios`
--

INSERT INTO `carrito_usuarios` (`id`, `usuario_id`, `producto_id`, `cantidad`, `fecha_agregado`) VALUES
(19, 8, 2, 1, '2025-10-24 04:42:40'),
(20, 11, 8, 1, '2025-10-25 01:46:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(5, 'Abrigos'),
(6, 'Camisas'),
(7, 'Camisetas'),
(8, 'Chaquetas'),
(2, 'Denim'),
(9, 'Faldas'),
(4, 'Ropa de niños'),
(3, 'Sudaderas'),
(1, 'Vestidos'),
(10, 'Zapatos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_pedido`
--

CREATE TABLE `detalles_pedido` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pedido_id` bigint(20) UNSIGNED NOT NULL,
  `producto_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `precio_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalles_pedido`
--

INSERT INTO `detalles_pedido` (`id`, `pedido_id`, `producto_id`, `cantidad`, `precio_unitario`) VALUES
(1, 1, 2, 1, 59.99),
(2, 1, NULL, 1, 129.00),
(3, 1, 3, 1, 69.00),
(4, 2, 6, 1, 75.00),
(5, 2, 7, 1, 29.00),
(6, 3, 10, 1, 69.99),
(7, 4, 2, 1, 59.99),
(8, 4, 3, 1, 69.00),
(9, 4, 4, 1, 19.99),
(10, 5, 2, 1, 59.99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `usuario_id` bigint(20) UNSIGNED NOT NULL,
  `producto_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `favoritos`
--

INSERT INTO `favoritos` (`usuario_id`, `producto_id`) VALUES
(8, 2),
(8, 3),
(8, 4),
(8, 9),
(8, 10),
(8, 11),
(8, 14),
(9, 2),
(9, 5),
(9, 6),
(9, 7),
(9, 8),
(9, 14),
(11, 11),
(11, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes_soporte`
--

CREATE TABLE `mensajes_soporte` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_completo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mensaje` text NOT NULL,
  `leido` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `mensajes_soporte`
--

INSERT INTO `mensajes_soporte` (`id`, `nombre_completo`, `email`, `mensaje`, `leido`, `created_at`, `updated_at`) VALUES
(1, 'manute', 'admin@gmail.com', 'hola como estas', 0, '2025-10-24 09:35:08', '2025-10-24 09:35:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_22_165649_create_categorias_table', 1),
(5, '2025_10_22_165653_create_productos_table', 1),
(6, '2025_10_22_165656_create_pedidos_table', 1),
(7, '2025_10_22_165659_create_detalles_pedido_table', 1),
(8, '2025_10_22_165702_create_favoritos_table', 1),
(9, '2025_10_22_165705_create_carrito_usuarios_table', 1),
(10, '2025_10_24_043011_create_mensajes_soporte_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `direccion_envio` text NOT NULL,
  `fecha_pedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('Procesando','Enviado','Entregado','Cancelado') NOT NULL DEFAULT 'Procesando'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario_id`, `total`, `direccion_envio`, `fecha_pedido`, `estado`) VALUES
(1, NULL, 267.99, 'Dirección: shadow\nCiudad: Cusco\nCódigo Postal: 08000\nTeléfono: +51999999999', '2025-10-23 22:38:15', 'Procesando'),
(2, NULL, 114.00, 'Dirección: shadow\nCiudad: Cusco\nCódigo Postal: 08000\nTeléfono: +51999999999', '2025-10-23 22:41:27', 'Procesando'),
(3, NULL, 79.99, 'Dirección: shadow\nCiudad: Cusco\nCódigo Postal: 08000\nTeléfono: +51999999999', '2025-10-23 22:42:39', 'Entregado'),
(4, 8, 158.98, 'Dirección: cusco\nCiudad: Cusco\nCódigo Postal: 3234656\nTeléfono: 95466546546456456', '2025-10-24 09:03:45', 'Procesando'),
(5, NULL, 69.99, 'Dirección: aE21231\nCiudad: Cusco\nCódigo Postal: 3234656\nTeléfono: 95466546546456456', '2025-10-24 09:04:27', 'Entregado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `precio_oferta` decimal(10,2) DEFAULT NULL,
  `talla` varchar(50) DEFAULT NULL,
  `estado` enum('Nuevo','Como nuevo','Buen estado','Usado') NOT NULL,
  `imagen_url` varchar(255) DEFAULT NULL,
  `categoria_id` bigint(20) UNSIGNED DEFAULT NULL,
  `usuario_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `precio_final` decimal(10,2) GENERATED ALWAYS AS (coalesce(`precio_oferta`,`precio`)) STORED,
  `porcentaje_descuento` decimal(5,2) GENERATED ALWAYS AS (case when `precio_oferta` is not null and `precio` > 0 then (`precio` - `precio_oferta`) / `precio` * 100 else 0 end) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `precio_oferta`, `talla`, `estado`, `imagen_url`, `categoria_id`, `usuario_id`, `fecha_creacion`) VALUES
(2, 'Denim Vintage Lavado Índigo', 'Jeans rectos unisex restaurados con técnica sashiko. Un clásico reinventado.', 89.00, 59.99, '32', 'Buen estado', 'uploads/products/pantalon_mezclilla_azul_clasico.png', 2, NULL, '2025-10-22 17:56:11'),
(3, 'Sudadera Reciclada Bosque Urbano', 'Sudadera unisex fabricada con algodón y poliéster reciclado. Comodidad y sostenibilidad.', 69.00, NULL, 'L', 'Nuevo', 'uploads/products/sudadera_reciclada_bosque_urbano.png', 3, NULL, '2025-10-22 17:56:11'),
(4, 'Polo Beach Partners Niño', 'Polo negro estampado para niño, ideal para días de verano.', 25.00, 19.99, '10', 'Usado', 'uploads/products/placeholder_polo_nino.png', 4, NULL, '2025-10-22 17:56:11'),
(5, 'Abrigo Lana Gris Clásico', 'Elegante abrigo de mezcla de lana en color gris. Perfecto para el invierno.', 180.00, 149.99, 'L', 'Como nuevo', 'uploads/products/abrigo_lana_gris.png', 5, NULL, '2025-10-22 17:56:11'),
(6, 'Camisa Lino Blanca Fresca', 'Camisa de lino 100% natural, color blanco. Ideal para climas cálidos, muy transpirable.', 75.00, NULL, 'M', 'Nuevo', 'uploads/products/camisa_lino_blanca.png', 6, NULL, '2025-10-22 17:56:11'),
(7, 'Camiseta Básica Blanca Algodón', 'Camiseta básica de cuello redondo, 100% algodón orgánico. Un esencial en cualquier armario.', 29.00, NULL, 'S', 'Nuevo', 'uploads/products/camiseta_basica_blanca.png', 7, NULL, '2025-10-22 17:56:11'),
(8, 'Chaqueta Biker Negra Piel Sintética', 'Chaqueta estilo biker con cremalleras y detalles metálicos. Piel sintética de alta calidad.', 95.00, 75.00, 'M', 'Buen estado', 'uploads/products/chaqueta_biker_negra.png', 8, NULL, '2025-10-22 17:56:11'),
(9, 'Falda Plisada Verde Esmeralda Satín', 'Falda midi plisada en un vibrante color verde esmeralda. Tejido satinado con caída elegante.', 65.00, NULL, 'S', 'Como nuevo', 'uploads/products/falda_plisada_verde_esmeralda.png', 9, NULL, '2025-10-22 17:56:11'),
(10, 'Vestido Floral Algodón Verano', 'Vestido ligero de algodón con estampado floral, perfecto para el verano. Corte midi y cintura ajustable.', 85.00, 69.99, 'M', 'Como nuevo', 'uploads/products/vestido_floral_algodon.png', 1, NULL, '2025-10-22 17:56:11'),
(11, 'Zapatos Oxford Marrón Piel', 'Zapatos clásicos estilo Oxford para hombre, fabricados en piel genuina color marrón coñac.', 150.00, NULL, '42', 'Buen estado', 'uploads/products/zapatos_oxford_marron.png', 10, NULL, '2025-10-22 17:56:11'),
(14, 'Violeta asda', 'adawdaw', 1212.00, 121.00, '32', 'Como nuevo', 'uploads/products/p4tL6OH7hZ1iKwmVmIccGho6KD1kJdDH4bDKitlr.jpg', 1, 9, '2025-10-23 23:54:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('wlnkuoLRIRQ9mFMKdmrsOpSfeyfC6zPqPypyVU7J', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQzI4ZGhLdzFUSmxqSlBXSE4zTVBMcUUwd2FmTHZVdU8zRmF4SnFzdCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9mYXZvcml0b3MvaWRzIjt9fQ==', 1761440861);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_completo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `rol` enum('usuario','admin') NOT NULL DEFAULT 'usuario',
  `remember_token` varchar(100) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `ultimo_acceso` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_completo`, `email`, `email_verified_at`, `password_hash`, `rol`, `remember_token`, `fecha_registro`, `ultimo_acceso`) VALUES
(8, 'shadows@gmail.com', 'shadows@gmail.com', NULL, '$2y$12$9xqd1BdaTz2Nx4PFOmxGLuLdhlWZAwWtvpr5m0znXYAXOvVqTTmJ.', 'usuario', 'UzfWACfR77HaqOGRIUfchYcuK8xkGyNiA0gWYKR83gB82Upzb1kTnpCVnfYI', '2025-10-24 00:03:03', '2025-10-24 09:06:53'),
(9, 'admin', 'admin@gmail.com', NULL, '$2y$12$oWMk0AfVPFwVCxINA0ENaeUGm3lr65LRZ8rzGK3J6EzyPlU6mZ972', 'admin', NULL, '2025-10-24 01:29:18', '2025-10-24 01:29:18'),
(11, 'aw adawd', 'awadawd@gmail.com', NULL, '$2y$12$BsWW7E52/4xszxg9NGjC6OManwNS6Qcox/.qibt4ENfo01VxJvAc6', 'usuario', NULL, '2025-10-25 06:36:24', '2025-10-25 06:36:24');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `carrito_usuarios`
--
ALTER TABLE `carrito_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_usuario_producto` (`usuario_id`,`producto_id`),
  ADD KEY `carrito_usuarios_producto_id_foreign` (`producto_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categorias_nombre_unique` (`nombre`);

--
-- Indices de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalles_pedido_pedido_id_foreign` (`pedido_id`),
  ADD KEY `detalles_pedido_producto_id_foreign` (`producto_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`usuario_id`,`producto_id`),
  ADD KEY `favoritos_producto_id_foreign` (`producto_id`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mensajes_soporte`
--
ALTER TABLE `mensajes_soporte`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidos_usuario_id_foreign` (`usuario_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productos_categoria_id_foreign` (`categoria_id`),
  ADD KEY `productos_usuario_id_foreign` (`usuario_id`),
  ADD KEY `productos_precio_final_index` (`precio_final`),
  ADD KEY `productos_porcentaje_descuento_index` (`porcentaje_descuento`),
  ADD KEY `productos_fecha_creacion_index` (`fecha_creacion`);
ALTER TABLE `productos` ADD FULLTEXT KEY `idx_fulltext_busqueda` (`nombre`,`descripcion`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuarios_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito_usuarios`
--
ALTER TABLE `carrito_usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensajes_soporte`
--
ALTER TABLE `mensajes_soporte`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito_usuarios`
--
ALTER TABLE `carrito_usuarios`
  ADD CONSTRAINT `carrito_usuarios_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carrito_usuarios_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD CONSTRAINT `detalles_pedido_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalles_pedido_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favoritos_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `productos_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
