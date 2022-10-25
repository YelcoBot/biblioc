CREATE TABLE `prestamo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_pres` date NOT NULL,
  `estado_pres` binary(1) DEFAULT NULL,
  `devuelto` binary(1) DEFAULT NULL,
  `fecha_dev` date DEFAULT NULL,
  `estado_dev` binary(1) DEFAULT NULL,
  `id_libro` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
