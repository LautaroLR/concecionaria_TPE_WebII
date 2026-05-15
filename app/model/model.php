<?php
require_once 'config.php';

class Model {
    protected $db;

    public function __construct() {
        try {
            $this->db = new PDO(
                "mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DB.";charset=utf8", 
                MYSQL_USER, MYSQL_PASS
            );
            $this->_deploy();
        } catch (Exception $e) {
            die("Error al conectar a la base de datos: " . $e->getMessage());
        }
    }

    /**
     * Revisa si hay tablas en la base de datos. 
     * Si no hay ninguna, ejecuta el SQL de creación y volcado.
     */
    private function _deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        
        if (count($tables) == 0) {
            // El SQL que copiaste de phpMyAdmin
            $sql = <<<END
                -- Estructura de tabla para la tabla `categorias`
                CREATE TABLE `categorias` (
                  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
                  `nombre` varchar(50) NOT NULL,
                  `descripcion` text DEFAULT NULL,
                  `activo` tinyint(1) NOT NULL DEFAULT 1,
                  `imagen_url` varchar(255) DEFAULT NULL,
                  PRIMARY KEY (`id_categoria`),
                  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

                -- Volcado de datos para la tabla `categorias`
                INSERT INTO `categorias` (`id_categoria`, `nombre`, `descripcion`, `activo`) VALUES
                (1, 'Sedán', 'Automóviles de 4 puertas, baúl separado', 1),
                (2, 'SUV', 'Vehículos deportivos utilitarios', 1),
                (3, 'Hatchback', 'Autos compactos de 5 puertas', 1),
                (4, 'Pickup', 'Camionetas con caja de carga', 1);

                -- Estructura de tabla para la tabla `vehiculos`
                CREATE TABLE `vehiculos` (
                  `id_vehiculo` int(11) NOT NULL AUTO_INCREMENT,
                  `id_categoria` int(11) NOT NULL,
                  `marca` varchar(50) NOT NULL,
                  `modelo` varchar(80) NOT NULL,
                  `anio` int(4) NOT NULL,
                  `precio` decimal(12,2) NOT NULL,
                  `kilometros` int(11) DEFAULT 0,
                  `combustible` enum('Nafta','Diesel','Eléctrico','Híbrido','GNC') NOT NULL,
                  `transmision` enum('Manual','Automática') NOT NULL,
                  `imagen_url` varchar(255) DEFAULT NULL,
                  `disponible` tinyint(1) NOT NULL DEFAULT 1,
                  `fecha_ingreso` datetime NOT NULL DEFAULT current_timestamp(),
                  PRIMARY KEY (`id_vehiculo`),
                  KEY `fk_vehiculos_categorias_idx` (`id_categoria`),
                  CONSTRAINT `fk_vehiculos_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON UPDATE CASCADE
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

                -- Volcado de datos para la tabla `vehiculos`
                INSERT INTO `vehiculos` (`id_vehiculo`, `id_categoria`, `marca`, `modelo`, `anio`, `precio`, `kilometros`, `combustible`, `transmision`, `imagen_url`, `disponible`, `fecha_ingreso`) VALUES
                (1, 1, 'Toyota', 'Corolla', 2022, 21500000.00, 15000, 'Nafta', 'Automática', 'https://images.unsplash.com/photo-1494976388531-d1058494cdd8?q=80&w=400&h=200&fit=crop', 1, '2026-05-05 19:42:33'),
                (2, 2, 'Ford', 'EcoSport', 2021, 18900000.00, 28000, 'Diesel', 'Manual', NULL, 1, '2026-05-05 19:42:33'),
                (3, 3, 'Volkswagen', 'Golf', 2023, 23400000.00, 5000, 'Nafta', 'Automática', NULL, 1, '2026-05-05 19:42:33'),
                (4, 4, 'Toyota', 'Hilux', 2020, 31200000.00, 45000, 'Diesel', 'Manual', NULL, 1, '2026-05-05 19:42:33');
            END;
            
            $this->db->exec($sql);
        }
    }
}