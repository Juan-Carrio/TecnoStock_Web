-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-10-2026 a las 02:45:42
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
-- Base de datos: `tecnostockdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `producto_id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `precio_publico` decimal(12,2) NOT NULL,
  `costo` decimal(12,2) NOT NULL,
  `ventas_mes` int(11) NOT NULL,
  `proveedor` varchar(150) NOT NULL,
  `plazo_reposicion` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`producto_id`, `nombre`, `precio_publico`, `costo`, `ventas_mes`, `proveedor`, `plazo_reposicion`, `cantidad`) VALUES
(1, 'Mouse', 50000.00, 42000.00, 34, 'El pepe', 28, 14),
(2, 'Teclado', 75000.00, 60000.00, 12, 'Cholito', 31, 34),
(3, 'Mouse Logitech G203', 35000.00, 22000.00, 18, 'Logitech', 7, 25),
(4, 'Teclado Redragon Kumara K552', 85000.00, 59000.00, 12, 'Redragon', 10, 15),
(5, 'Auriculares HyperX Cloud II', 145000.00, 105000.00, 8, 'HyperX', 14, 10),
(6, 'Monitor Samsung 24', 220000.00, 165000.00, 9, 'Samsung', 15, 12),
(7, 'Monitor LG UltraGear 27', 385000.00, 290000.00, 5, 'LG', 20, 8),
(8, 'SSD Kingston 480GB', 55000.00, 37000.00, 22, 'Kingston', 7, 30),
(9, 'SSD Samsung 1TB NVMe', 125000.00, 89000.00, 14, 'Samsung', 12, 18),
(10, 'RAM Kingston 8GB DDR4', 42000.00, 28000.00, 25, 'Kingston', 7, 35),
(11, 'RAM Corsair 16GB DDR4', 78000.00, 54000.00, 16, 'Corsair', 10, 20),
(12, 'Procesador Ryzen 5 5600G', 195000.00, 148000.00, 9, 'AMD', 15, 12),
(13, 'Procesador Intel i5 12400F', 235000.00, 180000.00, 7, 'Intel', 15, 10),
(14, 'Placa RTX 4060', 580000.00, 465000.00, 4, 'MSI', 20, 6),
(15, 'Placa RX 7600', 495000.00, 390000.00, 5, 'ASUS', 20, 8),
(16, 'Motherboard ASUS B550M', 165000.00, 120000.00, 10, 'ASUS', 12, 14),
(17, 'Fuente Corsair 650W', 115000.00, 79000.00, 13, 'Corsair', 10, 20),
(18, 'Gabinete Gamer RGB', 95000.00, 62000.00, 11, 'Redragon', 10, 16),
(19, 'Webcam Logitech C920', 110000.00, 78000.00, 9, 'Logitech', 7, 15),
(20, 'Microfono HyperX SoloCast', 135000.00, 96000.00, 8, 'HyperX', 14, 12),
(21, 'Mousepad Gamer XL', 18000.00, 9000.00, 28, 'Redragon', 5, 40),
(22, 'Parlantes Genius 2.0', 42000.00, 27000.00, 15, 'Genius', 7, 22);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`producto_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `producto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
