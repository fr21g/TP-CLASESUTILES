CREATE TABLE `registro`(
`idarchivo` bigint AUTO_INCREMENT,
`nombre` varchar (50) character set utf8 collate utf8_unicode_ci NOT NULL,
`tipo` varchar (50) NOT NUll,
`descripcion` varchar (100) NOT NULL,
`fechacomprimido` timestamp,
PRIMARY KEY (`idarchivo`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;