-- phpMyAdmin SQL Dump
-- version 4.2.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:8889
-- Tiempo de generación: 07-01-2015 a las 01:35:00
-- Versión del servidor: 5.5.38
-- Versión de PHP: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `donporfirio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `config_mailing`
--

CREATE TABLE `config_mailing` (
  `idconfig` tinyint(1) NOT NULL,
  `correo_noreply` text COLLATE utf8_unicode_ci NOT NULL,
  `correo_standard` text COLLATE utf8_unicode_ci NOT NULL,
  `facebook` text COLLATE utf8_unicode_ci NOT NULL,
  `twitter` text COLLATE utf8_unicode_ci NOT NULL,
  `instagram` text COLLATE utf8_unicode_ci NOT NULL,
  `youtube` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `config_mailing`
--

INSERT INTO `config_mailing` (`idconfig`, `correo_noreply`, `correo_standard`, `facebook`, `twitter`, `instagram`, `youtube`) VALUES
(9, 'no-reply@locker.com.mx', 'hola@locker.com.mx', 'www.facebook.com', 'www.twitter.com', 'www.instagram.com', 'www.youtube.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `idcontacto` int(2) NOT NULL,
  `correo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `emisor` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`idcontacto`, `correo`, `emisor`) VALUES
(1, 'gmarcin@eraseunavez.mx', 'noreply@eraseunavez.mx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido_marca`
--

CREATE TABLE `contenido_marca` (
  `id_contenidom` tinyint(1) NOT NULL,
  `link_video` text COLLATE utf8_unicode_ci NOT NULL,
  `tipo` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `contenido_marca`
--

INSERT INTO `contenido_marca` (`id_contenidom`, `link_video`, `tipo`) VALUES
(1, 'http://vimeo.com/82866776', 'v');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datosusuario`
--

CREATE TABLE `datosusuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datosusuario`
--

INSERT INTO `datosusuario` (`idusuario`, `nombre`, `email`, `telefono`, `token`) VALUES
(17, 'Administrador', 'gmarcin@eraseunavez.mx', '', '3426b6eeb6b7cc31439d937386a8fece'),
(20, 'Yelmy Maria Pech Miranda', 'yelmymc@hotmail.com', '9999999999', 'db61549a47e6ee5d8c4c0d244f3f939a'),
(21, 'Manuel Alejandro MÃ©ndez Cervera', 'manuel_amc@outlook.com', '9999580867', 'bcfe4c66c62c46a31f2dd89ef211777e');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `img_proyecto`
--

CREATE TABLE `img_proyecto` (
`id_img_proyecto` int(11) NOT NULL,
  `id_proyecto` int(11) NOT NULL,
  `ruta` text COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  `titulo` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nosotros`
--

CREATE TABLE `nosotros` (
  `id_nosotros` int(11) NOT NULL,
  `link_video` text COLLATE utf8_unicode_ci NOT NULL,
  `tipo` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `nosotros`
--

INSERT INTO `nosotros` (`id_nosotros`, `link_video`, `tipo`) VALUES
(1, 'https://www.youtube.com/watch?v=VwP3RaGlRcs', 'y');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pantallas`
--

CREATE TABLE `pantallas` (
  `id_pantallas` tinyint(1) NOT NULL,
  `link_video1` text COLLATE utf8_unicode_ci NOT NULL,
  `tipo1` text COLLATE utf8_unicode_ci NOT NULL,
  `link_video2` text COLLATE utf8_unicode_ci NOT NULL,
  `tipo2` text COLLATE utf8_unicode_ci NOT NULL,
  `link_video3` text COLLATE utf8_unicode_ci NOT NULL,
  `tipo3` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pantallas`
--

INSERT INTO `pantallas` (`id_pantallas`, `link_video1`, `tipo1`, `link_video2`, `tipo2`, `link_video3`, `tipo3`) VALUES
(1, 'https://www.youtube.com/watch?v=CpaSpWzPlJQ', 'y', 'https://www.youtube.com/watch?v=l57SVlsxG0w', 'y', 'https://www.youtube.com/watch?v=EpVdSo9g_H0', 'y');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
`idpermiso` int(11) NOT NULL,
  `nompermiso` varchar(255) NOT NULL,
  `clavepermiso` varchar(255) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=87 ;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idpermiso`, `nompermiso`, `clavepermiso`, `status`) VALUES
(37, 'Agregar CategorÃ­a', 'AgrCat', 1),
(38, 'Modifcar CategorÃ­a', 'ModCat', 1),
(39, 'Eliminar CategorÃ­a', 'ElimCat', 1),
(40, 'Activar/Desactivar CategorÃ­a', 'AcDcCat', 1),
(41, 'Agregar Slide', 'AgrSlide', 1),
(42, 'Modificar Slide', 'ModSlide', 1),
(43, 'Eliminar Slide', 'ElimSlide', 1),
(44, 'Activar/Desactivar Slide', 'AcDcSlide', 1),
(53, 'Agregar Usuarios', 'AgrUsu', 1),
(54, 'Modificar Usuario', 'ModUsu', 1),
(55, 'Eliminar Usuario', 'EliUsu', 1),
(56, 'Activar/Desactivar Usuario', 'AcDcUsu', 1),
(61, 'Agregar Tipo Usuario', 'AgrTiUs', 1),
(62, 'Modificar Tipo Usuario', 'ModTiUs', 1),
(63, 'Eliminar Tipo Usuario', 'EliTiUs', 1),
(64, 'Activar/Desactivar Tipo Usuario', 'AcDcTiUs', 1),
(65, 'Configuracion', 'conf', 1),
(66, 'Select Tipo usuario', 'SelecTipo', 1),
(67, 'Agregar Proyecto', 'AgrPro', 1),
(68, 'Modificar Proyecto', 'ModPro', 1),
(69, 'Eliminar Proyecto', 'ElimPro', 1),
(70, 'Activar/Desactivar Proyecto', 'AcDcPro', 1),
(71, 'Agregar PublicaciÃ³n', 'AgrPub', 1),
(72, 'Modificar PublicaciÃ³n', 'ModPub', 1),
(73, 'Eliminar PublicaciÃ³n', 'ElimPub', 1),
(74, 'Activar/Desactivar PublicaciÃ³n', 'AcDcPub', 1),
(75, 'Modificar Nosotros', 'ModNos', 1),
(76, 'Ordenar Slides', 'SortTableSlide', 1),
(77, 'Ordenar Proyectos', 'SortTableProy', 1),
(78, 'Ordenar ImÃ¡genes Productos', 'SortImgProy', 1),
(79, 'Agregar Impuesto', 'AgrImp', 1),
(80, 'Eliminar Impuesto', 'ElimImp', 1),
(81, 'Activar Ver Desactivar Impuesto', 'AcDcImp', 1),
(82, 'Ordernar Impuestos', 'SortTableImp', 1),
(83, 'Agregar Proyecto', 'AgrProy', 1),
(84, 'Eliminar Proyecto', 'ElimProy', 1),
(85, 'Activar y Desactivar Proyecto', 'AcDcProy', 1),
(86, 'Editar Proyecto', 'ModProy', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
`id_proyecto` int(11) NOT NULL,
  `titulo` text COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `subtitulo` text COLLATE utf8_unicode_ci NOT NULL,
  `cliente` text COLLATE utf8_unicode_ci NOT NULL,
  `img_principal` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `mostrar` tinyint(1) NOT NULL,
  `orden` int(11) NOT NULL,
  `principal` tinyint(1) NOT NULL,
  `caso_exito` tinyint(1) NOT NULL,
  `link_video` text COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `meta_titulo` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `url_amigable` text COLLATE utf8_unicode_ci NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_modificacion` date NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `redes_sociales`
--

CREATE TABLE `redes_sociales` (
  `id_redes_sociales` tinyint(1) NOT NULL,
  `facebook` text COLLATE utf8_unicode_ci NOT NULL,
  `youtube` text COLLATE utf8_unicode_ci NOT NULL,
  `vimeo` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `redes_sociales`
--

INSERT INTO `redes_sociales` (`id_redes_sociales`, `facebook`, `youtube`, `vimeo`) VALUES
(1, 'https://www.facebook.com/eraseunavezbc', 'https://www.youtube.com/user/EraseunavezMX', 'http://vimeo.com/user9855938');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposusuario`
--

CREATE TABLE `tiposusuario` (
`idtipousuario` int(11) NOT NULL,
  `nomtipousuario` varchar(255) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `tiposusuario`
--

INSERT INTO `tiposusuario` (`idtipousuario`, `nomtipousuario`, `status`) VALUES
(9, 'Administrador', 1),
(10, 'Secretario/a', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuarioxpermiso`
--

CREATE TABLE `tipousuarioxpermiso` (
  `idtipousuario` int(11) NOT NULL,
  `idpermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipousuarioxpermiso`
--

INSERT INTO `tipousuarioxpermiso` (`idtipousuario`, `idpermiso`) VALUES
(10, 37),
(10, 38),
(10, 40),
(10, 41),
(10, 42),
(10, 44),
(10, 45),
(10, 46),
(10, 48),
(10, 49),
(10, 50),
(10, 52),
(9, 37),
(9, 38),
(9, 39),
(9, 40),
(9, 41),
(9, 42),
(9, 43),
(9, 44),
(9, 53),
(9, 54),
(9, 55),
(9, 56),
(9, 61),
(9, 62),
(9, 63),
(9, 64),
(9, 65),
(9, 66),
(9, 67),
(9, 68),
(9, 69),
(9, 70),
(9, 71),
(9, 72),
(9, 73),
(9, 74),
(9, 75),
(9, 76),
(9, 77),
(9, 78),
(9, 79),
(9, 80),
(9, 81),
(9, 82),
(9, 83),
(9, 84),
(9, 85),
(9, 86);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
`idusuario` int(11) NOT NULL,
  `nomusuario` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(5) NOT NULL,
  `idtipousuario` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nomusuario`, `password`, `status`, `idtipousuario`) VALUES
(17, 'admin', '202cb962ac59075b964b07152d234b70', 1, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos_slide`
--

CREATE TABLE `videos_slide` (
`id_video_slide` int(11) NOT NULL,
  `titulo_video` text COLLATE utf8_unicode_ci NOT NULL,
  `nombre_video` text COLLATE utf8_unicode_ci NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_modificacion` date NOT NULL,
  `mostrar` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `orden` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `videos_slide`
--

INSERT INTO `videos_slide` (`id_video_slide`, `titulo_video`, `nombre_video`, `fecha_creacion`, `fecha_modificacion`, `mostrar`, `status`, `orden`) VALUES
(1, 'Video Corto Paisaje', 'beb9d405.mp4', '2015-01-06', '2015-01-06', 0, 0, 1),
(2, 'Comercial Navidad', '771d59dc.mp4', '2015-01-06', '2015-01-06', 0, 0, 2),
(3, 'Gol en el futbol', 'fb6057f1.mp4', '2015-01-07', '2015-01-07', 0, 0, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contenido_marca`
--
ALTER TABLE `contenido_marca`
 ADD PRIMARY KEY (`id_contenidom`);

--
-- Indices de la tabla `img_proyecto`
--
ALTER TABLE `img_proyecto`
 ADD PRIMARY KEY (`id_img_proyecto`,`id_proyecto`);

--
-- Indices de la tabla `nosotros`
--
ALTER TABLE `nosotros`
 ADD PRIMARY KEY (`id_nosotros`);

--
-- Indices de la tabla `pantallas`
--
ALTER TABLE `pantallas`
 ADD PRIMARY KEY (`id_pantallas`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
 ADD PRIMARY KEY (`idpermiso`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
 ADD PRIMARY KEY (`id_proyecto`);

--
-- Indices de la tabla `redes_sociales`
--
ALTER TABLE `redes_sociales`
 ADD PRIMARY KEY (`id_redes_sociales`);

--
-- Indices de la tabla `tiposusuario`
--
ALTER TABLE `tiposusuario`
 ADD PRIMARY KEY (`idtipousuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`idusuario`);

--
-- Indices de la tabla `videos_slide`
--
ALTER TABLE `videos_slide`
 ADD PRIMARY KEY (`id_video_slide`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `img_proyecto`
--
ALTER TABLE `img_proyecto`
MODIFY `id_img_proyecto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `tiposusuario`
--
ALTER TABLE `tiposusuario`
MODIFY `idtipousuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `videos_slide`
--
ALTER TABLE `videos_slide`
MODIFY `id_video_slide` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;