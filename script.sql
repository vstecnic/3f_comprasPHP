create database if not exists `compras`;
USE `compras`;

CREATE TABLE `compras` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `producto` ENUM('comida','limpieza','bazar','perfumeria','otro') NOT NULL,
  `nombre_producto` varchar(50) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `precio_unitario` DECIMAL(10,2),
  `total` DECIMAL(12,2) GENERATED ALWAYS AS (`cantidad` * `precio_unitario`) STORED,
  `notas` varchar(50)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Inserts de ejemplos
INSERT INTO `compras` (`producto`, `nombre_producto`, `cantidad`, `precio_unitario`, `notas`) VALUES
('limpieza', 'Lavandina', 1, 250.00, ''),
('bazar', 'Vasos de vidrio', 4, 300.00, 'Pueden ser de cualquier color');