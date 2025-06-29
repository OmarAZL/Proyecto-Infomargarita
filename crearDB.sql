DROP TABLE IF EXISTS `tbl_sitioshistoricos`;
CREATE TABLE IF NOT EXISTS `tbl_sitioshistoricos` (
  `id_SitiosHistoricos` int NOT NULL AUTO_INCREMENT,
  `Nombre_Sitio` text CHARACTER SET utf16 COLLATE utf16_spanish_ci NOT NULL,
  `fecha_creacion` date NOT NULL,
  `Historia` text CHARACTER SET utf16 COLLATE utf16_spanish_ci NOT NULL,
  `CodCiudad` int NOT NULL,
  `CodParroquia` int NOT NULL,
  PRIMARY KEY (`id_SitiosHistoricos`),
  KEY `CodCiudad` (`CodCiudad`),
  KEY `CodParroquia` (`CodParroquia`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tbl_sitioshistoricos`
--

INSERT INTO `tbl_sitioshistoricos` (`id_SitiosHistoricos`, `Nombre_Sitio`, `fecha_creacion`, `Historia`, `CodCiudad`, `CodParroquia`) VALUES
(1, 'Castillo San Carlos de Borromeo', '1684-01-01', 'El Castillo San Carlos de Borromeo es una fortaleza colonial ubicada en la Bahía de Pampatar, en la Isla Margarita, Venezuela. Fue construida para proteger la zona de los ataques de piratas y corsarios. Se completó en 1684, después de haber sido destruida y reconstruida. Hoy en día, funciona como museo y es un importante atractivo turístico. ', 330, 709);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tarifariosh`
--

DROP TABLE IF EXISTS `tbl_tarifariosh`;
CREATE TABLE IF NOT EXISTS `tbl_tarifariosh` (
  `id_tarifariosh` int NOT NULL AUTO_INCREMENT,
  `descripciontf` text NOT NULL,
  `Montotf` int NOT NULL,
  `id_Sitiohistorico` int NOT NULL,
  PRIMARY KEY (`id_tarifariosh`),
  KEY `id_Sitiohistorico` (`id_Sitiohistorico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


--
-- Filtros para la tabla `tbl_sitioshistoricos`
--
ALTER TABLE `tbl_sitioshistoricos`
  ADD CONSTRAINT `tbl_sitioshistoricos_ibfk_1` FOREIGN KEY (`CodParroquia`) REFERENCES `tbl_parroquia` (`Cod_Parroquia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_sitioshistoricos_ibfk_2` FOREIGN KEY (`CodCiudad`) REFERENCES `tbl_ciudad` (`Cod_Ciudad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_tarifariosh`
--
ALTER TABLE `tbl_tarifariosh`
  ADD CONSTRAINT `tbl_tarifariosh_ibfk_1` FOREIGN KEY (`id_Sitiohistorico`) REFERENCES `tbl_sitioshistoricos` (`id_SitiosHistoricos`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
