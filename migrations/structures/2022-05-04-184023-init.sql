SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';
SET NAMES utf8mb4;

CREATE TABLE `first` (
`id` varchar(128) NOT NULL,
`num` int NOT NULL,
`another_one` datetime NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `second`;
CREATE TABLE `second` (
`id` int NOT NULL AUTO_INCREMENT,
`first` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
`wtf` float NOT NULL,
PRIMARY KEY (`id`),
KEY `first` (`first`),
CONSTRAINT `second_ibfk_1` FOREIGN KEY (`first`) REFERENCES `first` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

