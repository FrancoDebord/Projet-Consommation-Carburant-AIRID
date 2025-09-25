-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.31 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Listage de la structure de la table projet_consommation_carburant. conso_vehicules
CREATE TABLE IF NOT EXISTS `conso_vehicules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `immatriculation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marque` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_chassis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_achat` date DEFAULT NULL,
  `conso_moyenne` decimal(5,2) NOT NULL COMMENT 'Litres / 100 km',
  `type_moteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_carburant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `conso_vehicules_immatriculation_unique` (`immatriculation`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table projet_consommation_carburant.conso_vehicules : ~8 rows (environ)
INSERT INTO `conso_vehicules` (`id`, `immatriculation`, `marque`, `nom`, `numero_chassis`, `date_achat`, `conso_moyenne`, `type_moteur`, `type_carburant`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'RB 9898', 'FORTUNER', 'FORTUNER', '', NULL, 13.00, 'DIESEL', 'ESSENCE', NULL, '2025-09-25 12:32:51', '2025-09-25 12:32:51'),
	(2, 'CD 3203 RB', 'TOYOTA', 'Land Cruiser/ Dr', NULL, NULL, 13.00, 'V8', 'essence', NULL, '2025-09-25 12:43:33', '2025-09-25 12:43:33'),
	(3, 'BJ 8077 RB', 'TOYOTA', 'LEXUS 570', NULL, NULL, 13.00, 'V4', 'essence', NULL, '2025-09-25 12:44:45', '2025-09-25 12:44:45'),
	(4, 'BT 8913 RB', 'TOYOTA', 'Highlander', NULL, NULL, 14.00, 'V4', 'essence', NULL, '2025-09-25 12:45:16', '2025-09-25 12:45:16'),
	(5, 'AX 7315 RB', 'TOYOTA', 'AX 7315 RB', NULL, NULL, 14.00, 'V4', 'essence', NULL, '2025-09-25 12:45:41', '2025-09-25 12:45:41'),
	(6, 'BR 6499 RB', 'TOYOTA', 'BR 6499 RB (Fortuner à essence)', NULL, NULL, 13.00, 'V4', 'essence', NULL, '2025-09-25 12:46:14', '2025-09-25 12:46:14'),
	(7, 'CH 9325 RB', 'TOYOTA', 'CH 9325 RB (Fortuner à gazoil )', NULL, NULL, 13.00, 'V4', 'gaz-oil', NULL, '2025-09-25 12:46:53', '2025-09-25 12:46:53'),
	(8, 'BS 8281 RB', 'TOYOTA', 'BS 8281 RB (Toyota Hilux)', NULL, NULL, 13.00, 'V4', 'essence', NULL, '2025-09-25 12:47:54', '2025-09-25 12:47:54');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
