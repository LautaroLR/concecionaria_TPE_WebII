-- --------------------------------------------------------
-- Base de datos: `concesionaria_web2`
-- --------------------------------------------------------
CREATE DATABASE IF NOT EXISTS `concesionaria_web2` 
DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `concesionaria_web2`;

-- --------------------------------------------------------
-- Tabla `categorias` (entidad principal, lado 1 de la relación 1:N)
-- --------------------------------------------------------
CREATE TABLE `categorias` (
  `id_categoria` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `descripcion` TEXT DEFAULT NULL,
  `activo` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_categoria`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Tabla `vehiculos` (entidad dependiente, lado N de la relación 1:N)
-- --------------------------------------------------------
CREATE TABLE `vehiculos` (
  `id_vehiculo` INT(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` INT(11) NOT NULL,
  `marca` VARCHAR(50) NOT NULL,
  `modelo` VARCHAR(80) NOT NULL,
  `anio` INT(4) NOT NULL,
  `precio` DECIMAL(12,2) NOT NULL,
  `kilometros` INT(11) DEFAULT 0,
  `combustible` ENUM('Nafta', 'Diesel', 'Eléctrico', 'Híbrido', 'GNC') NOT NULL,
  `transmision` ENUM('Manual', 'Automática') NOT NULL,
  `imagen_url` VARCHAR(255) DEFAULT NULL,
  `disponible` TINYINT(1) NOT NULL DEFAULT 1,
  `fecha_ingreso` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_vehiculo`),
  KEY `fk_vehiculos_categorias_idx` (`id_categoria`),
  CONSTRAINT `fk_vehiculos_categorias` 
    FOREIGN KEY (`id_categoria`) 
    REFERENCES `categorias` (`id_categoria`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Datos de ejemplo (opcional, para pruebas)
-- --------------------------------------------------------
INSERT INTO `categorias` (`nombre`, `descripcion`) VALUES
('Sedán', 'Automóviles de 4 puertas, baúl separado'),
('SUV', 'Vehículos deportivos utilitarios'),
('Hatchback', 'Autos compactos de 5 puertas'),
('Pickup', 'Camionetas con caja de carga');

INSERT INTO `vehiculos` 
(`id_categoria`, `marca`, `modelo`, `anio`, `precio`, `kilometros`, `combustible`, `transmision`) 
VALUES
(1, 'Toyota', 'Corolla', 2022, 21500000.00, 15000, 'Nafta', 'Automática'),
(2, 'Ford', 'EcoSport', 2021, 18900000.00, 28000, 'Diesel', 'Manual'),
(3, 'Volkswagen', 'Golf', 2023, 23400000.00, 5000, 'Nafta', 'Automática'),
(4, 'Toyota', 'Hilux', 2020, 31200000.00, 45000, 'Diesel', 'Manual');