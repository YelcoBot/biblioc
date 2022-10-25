USE biblioteca;
DROP TABLE IF EXISTS `libro_autor`;
DROP TABLE IF EXISTS `libro`;
CREATE TABLE `libro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `n_pag` int(11) NOT NULL,
  `fecha_edicion` date NOT NULL,
  `archivo` varchar(200),
  `id_editorial` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`id_editorial`) REFERENCES `editorial` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 DEFAULT CHARSET = utf8 COLLATE = utf8_spanish2_ci;
CREATE TABLE `libro_autor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_libro` int NOT NULL,
  `id_autor` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_libro`) REFERENCES `libro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`id_autor`) REFERENCES `autor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_spanish2_ci;
TRUNCATE TABLE `biblioteca`.`user`;
TRUNCATE TABLE `biblioteca`.`rol`;
INSERT INTO `biblioteca`.`rol` VALUES (1,'Administrador',_binary '1',_binary '\0','2022-10-24 20:24:38','2022-10-24 21:12:08');
INSERT INTO `biblioteca`.`rol` VALUES (2,'Estudiante',_binary '1',_binary '1','2022-10-24 20:24:38','2022-10-24 21:12:08');
ALTER TABLE `biblioteca`.`user`
ADD COLUMN `id_rol` INT NOT NULL
AFTER `estado`;
ALTER TABLE `biblioteca`.`user`
ADD FOREIGN KEY (`id_rol`) REFERENCES `biblioteca`.`rol` (`id`);
ALTER TABLE `biblioteca`.`rol` 
ADD COLUMN `defecto` BINARY NOT NULL AFTER `estado`;