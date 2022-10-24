CREATE TABLE `libro` (
  `cod_libro` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `n_pag` int(11) NOT NULL,
  `fecha_edicion` date NOT NULL,
  `cod_editorial` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`cod_libro`),
  KEY `cod_editorial` (`cod_editorial`,`id_categoria`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `libro_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `libro_ibfk_3` FOREIGN KEY (`cod_editorial`) REFERENCES `editorial` (`cod_editorial`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
SELECT * FROM biblioteca.categoria;