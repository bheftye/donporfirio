-- phpMyAdmin SQL Dump
-- version 4.2.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:8889
-- Tiempo de generación: 09-01-2015 a las 00:51:30
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=71 ;

--
-- Volcado de datos para la tabla `img_proyecto`
--

INSERT INTO `img_proyecto` (`id_img_proyecto`, `id_proyecto`, `ruta`, `orden`, `titulo`) VALUES
(41, 27, '7b060a07.jpg', 41, ''),
(40, 27, 'e31d55e3.jpg', 40, ''),
(39, 27, 'de0e384e.jpg', 39, ''),
(38, 26, 'd287abc6.jpg', 38, ''),
(37, 26, '03216386.jpg', 37, ''),
(36, 26, '1d6321b2.jpg', 36, ''),
(35, 26, '7eaeaacb.jpg', 35, ''),
(34, 26, '8058b1f0.jpg', 34, ''),
(33, 26, '4932c02a.jpg', 33, ''),
(32, 26, 'de03b67a.jpg', 32, ''),
(42, 27, 'a4c72aaf.jpg', 42, ''),
(43, 27, '574a5db2.jpg', 43, ''),
(44, 27, '2642ba9d.jpg', 44, ''),
(45, 27, '32b67efa.jpg', 45, ''),
(46, 27, '8cabb5e5.jpg', 46, ''),
(47, 27, 'b40a6af9.jpg', 47, ''),
(48, 28, '6eae9f30.jpg', 48, ''),
(49, 28, '5f945612.jpg', 49, ''),
(50, 28, 'd07ac01e.jpg', 50, ''),
(51, 28, 'ca1c582b.jpg', 51, ''),
(52, 28, 'ada56978.jpg', 52, ''),
(53, 28, 'b8e46314.jpg', 53, ''),
(54, 29, 'efcf7dac.jpg', 54, ''),
(55, 29, '28bbaf08.jpg', 55, ''),
(56, 29, 'df550099.jpg', 56, ''),
(57, 29, 'fa8cc96e.jpg', 57, ''),
(58, 29, '860ef10a.jpg', 58, ''),
(59, 29, 'f894baf3.jpg', 59, ''),
(60, 29, 'd115fbf1.jpg', 60, ''),
(61, 30, 'd982521a.jpg', 61, ''),
(62, 30, 'cf1feb6d.jpg', 62, ''),
(63, 30, '56d762ae.jpg', 63, ''),
(64, 30, '29b62197.jpg', 64, ''),
(65, 30, '4ef728c1.jpg', 65, ''),
(66, 31, 'fa5aceb8.jpg', 66, ''),
(67, 31, '6ee0395f.jpg', 67, ''),
(68, 31, '73176ba1.jpg', 68, ''),
(69, 31, '1379c023.jpg', 69, ''),
(70, 31, '2895dc91.jpg', 70, '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=88 ;

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
(86, 'Editar Proyecto', 'ModProy', 1),
(87, 'Ordenar Tabla de Videoslides', 'SortTableVidSli', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
`id_proyecto` int(11) NOT NULL,
  `titulo_esp` text COLLATE utf8_unicode_ci NOT NULL,
  `titulo_eng` text COLLATE utf8_unicode_ci NOT NULL,
  `subtitulo_esp` text COLLATE utf8_unicode_ci NOT NULL,
  `subtitulo_eng` text COLLATE utf8_unicode_ci NOT NULL,
  `descripcion_esp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `descripcion_eng` longtext COLLATE utf8_unicode_ci NOT NULL,
  `nombre_video` text COLLATE utf8_unicode_ci NOT NULL,
  `nombre_preview` text COLLATE utf8_unicode_ci NOT NULL,
  `nombre_video_hd` text COLLATE utf8_unicode_ci NOT NULL,
  `img_principal` text COLLATE utf8_unicode_ci NOT NULL,
  `orden` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `mostrar` tinyint(1) NOT NULL,
  `meta_titulo_esp` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_descripcion_esp` text COLLATE utf8_unicode_ci NOT NULL,
  `url_amigable` text COLLATE utf8_unicode_ci NOT NULL,
  `fecha_creacion` date NOT NULL,
  `fecha_modificacion` date NOT NULL,
  `behance` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_titulo_eng` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_descripcion_eng` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`id_proyecto`, `titulo_esp`, `titulo_eng`, `subtitulo_esp`, `subtitulo_eng`, `descripcion_esp`, `descripcion_eng`, `nombre_video`, `nombre_preview`, `nombre_video_hd`, `img_principal`, `orden`, `status`, `mostrar`, `meta_titulo_esp`, `meta_descripcion_esp`, `url_amigable`, `fecha_creacion`, `fecha_modificacion`, `behance`, `meta_titulo_eng`, `meta_descripcion_eng`) VALUES
(26, 'SPORTS PACKAGE 2014', 'CBC SPORTS', 'CBC SPORTS', 'SPORTS PACKAGE 2014', '&lt;p&gt;Una vez mas nuestros buenos amigos de Big Studios Inc en Toronto nos invitaron a colaborar en otro magnifico proyecto.&lt;br&gt;&lt;br&gt;Esta vez fuimos comisionados para diseÃ±ar el look de los paquetes graficos tanto para invierno como para verano de CBC Sports. Desarrollamos una serie de ambientes que nos sirvieron para dar vida a estas piezas llenas de energia que celebran el amor por el deporte.&lt;br&gt;&lt;/p&gt;', 'Once again our good friends from Big Studios in Toronto invited us to collaborate with them on another great project.&lt;br&gt;&lt;br&gt;This time we were comisioned to design the look for CBC Sports both Winter and Summer Graphics Package. We developed a series of cool environments and animated this high energy pieces that celebrate the love for sports.&lt;br&gt;', '5a243ee6.mp4', '5a9035dc.mp4', '525cd72a.mp4', '957ec1a6.jpg', 26, 0, 0, 'SPORTS PACKAGE 2014', 'Una vez mas nuestros buenos amigos de Big Studios Inc en Toronto nos invitaron a colaborar en otro magnifico proyecto.\r\n\r\nEsta vez fuimos comisionados para diseÃ±a', 'cbc-sports', '2015-01-08', '2015-01-09', '', 'CBC SPORTS', 'Once again our good friends from Big Studios in Toronto invited us to collaborate with them on another great project.&lt;br&gt;&lt;br&gt;This time we were comis'),
(27, 'LONDON CALLING 2014', 'LONDON CALLING 2014', 'BBC ENTERTAINMENT', 'BBC ENTERTAINMENT', '&lt;p&gt;Fuimos comisionados para desarrollar el nuevo paquete grÃ¡fico para London Calling, inspirado en el Underground de la ciudad de Londres. Generamos una serie completa de ambientes subterrÃ¡neos y utilizamos estos espacios para dar vida a los diferentes elementos que conforman el paquete.&lt;br&gt;&lt;/p&gt;', '&lt;p&gt;We were invited to create the graphics package for BBC&#039;s London Calling inspired in the Underground of London. We generated a series of cg underground environments that we used to give life to the different elements that integrate this cool package.&lt;br&gt;&lt;/p&gt;', '81b42f33.mp4', '5586711c.mp4', '', 'dfb825aa.jpg', 27, 0, 0, 'LONDON CALLING 2014', '&lt;p&gt;Fuimos comisionados para desarrollar el nuevo paquete grÃ¡fico para London Calling, inspirado en el Underground de la ciudad de Londres. Generamos una ', 'london-calling-2014', '2015-01-08', '2015-01-08', '', 'LONDON CALLING 2014', '&lt;p&gt;We were invited to create the graphics package for BBC&#039;s London Calling inspired in the Underground of London. We generated a series of cg undergr'),
(28, 'CONFERENCE OPENING TITLES', 'CONFERENCE OPENING TITLES', 'DH17', 'DH17', '&lt;div&gt;Nuestros amigos de&amp;nbsp;TIPOS LIBRES&amp;nbsp;organizadores de uno de los eventos de diseÃ±o mÃ¡s importantes en MÃ©xico conocido como&amp;nbsp;&quot;DEJANDO HUELLA&quot;, nos invitaron a colaborar con ellos en el desarrollo de la secuencia de tÃ­tulos en su ediciÃ³n No.17&lt;/div&gt;&lt;div&gt;&amp;nbsp;&lt;/div&gt;&lt;div&gt;El&amp;nbsp;DH17&amp;nbsp;tuvo como concepto general la temÃ¡tica&amp;nbsp;&quot;HAY MUCHAS HISTORIAS POR CONTAR&quot;&amp;nbsp;por lo que nos pareciÃ³ interesante que los tÃ­tulos contaran la historia de algo que nos une a todos los creativos y diseÃ±adores sin importar la especialidad. Nuestro proceso creativo.&lt;/div&gt;&lt;div&gt;&amp;nbsp;&lt;/div&gt;&lt;div&gt;La secuencia de entrada, explora el proceso creativo a travÃ©z de diferentes Ã¡ngulos mostrando la diversa manera en que nosotros los creativos podemos atacar un proyecto en busca de una soluciÃ³n grÃ¡fica. Es una historia que nos habla de inpisraciÃ³n, creaciÃ³n y genio creativo para finalizar en el nacimiento de una nueva ediciÃ³n de este gran evento, el&amp;nbsp;DH17.&lt;/div&gt;', '&lt;div&gt;Our friends at TIPOS LIBRES, organize every year one of the top design conferences in Mexico and this year they inveited us to create the opening titles for them.&lt;/div&gt;&lt;div&gt;&amp;nbsp;&lt;/div&gt;&lt;div&gt;This year&#039;s event was based on the concept &quot;THERE ARE MANY STORIES TO TELL&quot;. This is why we found very interesting to play with an idea that all we creatives share... our creative process.&lt;/div&gt;&lt;div&gt;&amp;nbsp;&lt;/div&gt;&lt;div&gt;The opening titles explore the creative process of every designer trough a series of shots and that show different stages of creation and inspiration.&lt;/div&gt;', '7befe482.mp4', '', '', '67539e76.jpg', 28, 0, 0, 'CONFERENCE OPENING TITLES', '&lt;div&gt;Nuestros amigos de&amp;nbsp;TIPOS LIBRES&amp;nbsp;organizadores de uno de los eventos de diseÃ±o mÃ¡s importantes en MÃ©xico conocido como&amp;nbsp;&', 'conference-opening-titles', '2015-01-08', '2015-01-08', '', 'CONFERENCE OPENING TITLES', '&lt;div&gt;Our friends at TIPOS LIBRES, organize every year one of the top design conferences in Mexico and this year they inveited us to create the opening tit'),
(29, 'CINEMATIC TRAILER', 'CINEMATIC TRAILER', 'BBC EARTH + CINEMARK', 'BBC EARTH + CINEMARK', '&lt;p&gt;Creamos para BBC los tÃ­tulos animados que forman parte del trailer oficial para esta nueva e increible serie de documentales que se podrÃ¡n ver en las salas de Cinemark en LatinoamÃ©rica.&lt;br&gt;&lt;/p&gt;', '&lt;p&gt;We created for BBC the animated titles that are included in the official trailer for their upcoming series of incredible documentaries that will hit Latinoamerica on Cinemark.&lt;br&gt;&lt;/p&gt;', 'a35e3627.mp4', '', '', '70ca98e3.jpg', 29, 0, 0, 'CINEMATIC TRAILER', '&lt;p&gt;Creamos para BBC los tÃ­tulos animados que forman parte del trailer oficial para esta nueva e increible serie de documentales que se podrÃ¡n ver en las', 'cinematic-trailer', '2015-01-08', '2015-01-08', '', 'CINEMATIC TRAILER', '&lt;p&gt;We created for BBC the animated titles that are included in the official trailer for their upcoming series of incredible documentaries that will hit La'),
(30, 'NIDO', 'NIDO', 'NIDO', 'NIDO', '&lt;div&gt;En esta maternal pieza creada para el lanzamiento de la promocion de NIDO para el dia de las madres, se buscaba generar una pieza que pareciera intervenida por niÃ±os donde ademÃ¡s se mostrara el regalo incluido debajo de la tapa del producto, de una manera dinÃ¡mica y elegante.&lt;/div&gt;&lt;div&gt;&amp;nbsp;&lt;/div&gt;&lt;div&gt;Desarrollamos tÃ­tulos animados en 2D con tÃ©cnicas tradicionales y generamos los productos 3D realistas integrÃ¡ndolos a un ambiente fotogrÃ¡fico para generar una pieza alegre y llena de vida, con una interesante secuencia de producto&lt;/div&gt;', '&lt;div&gt;This is a piece created to promote the campaign for Mother&#039;s Day. The intention was to give the piece a real feel of kids talking to their moms, which is why we created titles drawn by hand&amp;nbsp; and animated with traditional techniques that mimic a kid style and personalty.&lt;/div&gt;&lt;div&gt;&amp;nbsp;&lt;/div&gt;&lt;div&gt;We also created the CG product animated sequence that shows the gift that comes inside every product.&lt;/div&gt;', '9b2abb2b.mp4', '', '', '5d4f7c81.jpg', 30, 0, 0, 'NIDO', '&lt;div&gt;En esta maternal pieza creada para el lanzamiento de la promocion de NIDO para el dia de las madres, se buscaba generar una pieza que pareciera inter', 'nido', '2015-01-08', '2015-01-08', '', 'NIDO', '&lt;div&gt;This is a piece created to promote the campaign for Mother&#039;s Day. The intention was to give the piece a real feel of kids talking to their moms,'),
(31, 'GAMEDAY GRAPHICS PACKAGE', 'GAMEDAY GRAPHICS PACKAGE', 'CBC SPORTS ', 'CBC SPORTS ', '&lt;p&gt;GAMEDAY es un show de CBC Sports acerca de la NHL y lo que pasa en el mundo del Hockey profesional. Big Studios Inc. nos invito a desarrollamos el paquete grafico para el show.&lt;br&gt;&lt;/p&gt;', '&lt;p&gt;GAMEDAY is a CBC Sports show about the NHL and everything related to the world of professional hockey. Big Studios Inc invited us to create the Graphics Package for the show.&lt;br&gt;&lt;/p&gt;', '482c2daa.mp4', '', '', '129ee070.jpg', 31, 0, 0, 'GAMEDAY GRAPHICS PACKAGE', '&lt;p&gt;GAMEDAY es un show de CBC Sports acerca de la NHL y lo que pasa en el mundo del Hockey profesional. Big Studios Inc. nos invito a desarrollamos el paqu', 'gameday-graphics-package', '2015-01-08', '2015-01-08', '', 'GAMEDAY GRAPHICS PACKAGE', '&lt;p&gt;GAMEDAY is a CBC Sports show about the NHL and everything related to the world of professional hockey. Big Studios Inc invited us to create the Graphic');

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
(9, 86),
(9, 87);

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
  `nombre_video_hd` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `videos_slide`
--

INSERT INTO `videos_slide` (`id_video_slide`, `titulo_video`, `nombre_video`, `nombre_video_hd`) VALUES
(1, 'MOTION DESIGN REEL 2014', '0b80379e.mp4', 'f95ea549.mp4');

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
MODIFY `id_img_proyecto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
MODIFY `id_proyecto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
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