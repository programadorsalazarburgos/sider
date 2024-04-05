-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 01-02-2018 a las 00:12:29
-- Versión del servidor: 5.6.35
-- Versión de PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `sider`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barrios`
--

CREATE TABLE `barrios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_barrio` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comuna_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `barrios`
--

INSERT INTO `barrios` (`id`, `nombre_barrio`, `comuna_id`, `created_at`, `updated_at`) VALUES
(1, 'Paseo de Los Almendros', 5, NULL, NULL),
(2, 'Fepicol', 7, NULL, NULL),
(3, 'Yira Castro', 13, NULL, NULL),
(4, 'Lili', 17, NULL, NULL),
(5, 'El Gran Limonar - Cataya', 17, NULL, NULL),
(6, 'Parcelaciones Pance', 22, NULL, NULL),
(7, 'Los Andes B - La Riviera', 5, NULL, NULL),
(8, 'Santa Anita - La Selva', 17, NULL, NULL),
(9, 'Urbanización San Joaquin', 17, NULL, NULL),
(10, 'Potrero Grande', 21, NULL, NULL),
(11, 'San Luís II', 6, NULL, NULL),
(12, 'Sector Puente del Comercio', 6, NULL, NULL),
(13, 'El Pondaje', 13, NULL, NULL),
(14, 'Bosques del Limonar', 17, NULL, NULL),
(15, 'Ciudadela Pasoancho', 17, NULL, NULL),
(16, 'La Sultana', 20, NULL, NULL),
(17, 'Pízamos III - Las Dalias', 21, NULL, NULL),
(18, 'Valle Grande', 21, NULL, NULL),
(19, 'Torres de Comfandi', 5, NULL, NULL),
(20, 'Villa del Prado - El Guabito', 5, NULL, NULL),
(21, 'Fonaviemcali', 6, NULL, NULL),
(22, 'Urbanización Calimio', 6, NULL, NULL),
(23, 'El Ingenio', 17, NULL, NULL),
(24, 'Los Portales - Nuevo Rey', 17, NULL, NULL),
(25, 'Cañaverales - Los Samanes', 17, NULL, NULL),
(26, 'El Limonar', 17, NULL, NULL),
(27, 'Cañaveral', 19, NULL, NULL),
(28, 'Ciudadela del Río', 21, NULL, NULL),
(29, 'Calima', 4, NULL, NULL),
(30, 'Planta de Tratamiento', 21, NULL, NULL),
(31, 'Urbanización Río Lili', 22, NULL, NULL),
(32, 'Lleras Restrepo II Etapa', 13, NULL, NULL),
(33, 'Marroquín III', 13, NULL, NULL),
(34, 'Los Lagos', 13, NULL, NULL),
(35, 'Sector Laguna del Pondaje', 13, NULL, NULL),
(36, 'Puerta del Sol', 14, NULL, NULL),
(37, 'Mojica', 15, NULL, NULL),
(38, 'El Morichal', 15, NULL, NULL),
(39, 'Caney', 17, NULL, NULL),
(40, 'Mayapan - Las Vegas', 17, NULL, NULL),
(41, 'Las Quintas de Don Simón', 17, NULL, NULL),
(42, 'Prados del Limonar', 17, NULL, NULL),
(43, 'Sector Meléndez', 18, NULL, NULL),
(44, 'Terrón Colorado', 1, NULL, NULL),
(45, 'Vista Hermosa', 1, NULL, NULL),
(46, 'Santa Rita', 2, NULL, NULL),
(47, 'Santa Teresita', 2, NULL, NULL),
(48, 'Arboledas', 2, NULL, NULL),
(49, 'Normandía', 2, NULL, NULL),
(50, 'Juanambú', 2, NULL, NULL),
(51, 'Centenario', 2, NULL, NULL),
(52, 'Granada', 2, NULL, NULL),
(53, 'Versalles', 2, NULL, NULL),
(54, 'San Vicente', 2, NULL, NULL),
(55, 'Santa Mónica ', 2, NULL, NULL),
(56, 'Prados del Norte', 2, NULL, NULL),
(57, 'La Flora', 2, NULL, NULL),
(58, 'La Campiña', 2, NULL, NULL),
(59, 'La Paz', 2, NULL, NULL),
(60, 'El Bosque', 2, NULL, NULL),
(61, 'Menga', 2, NULL, NULL),
(62, 'Ciudad Los Alamos', 2, NULL, NULL),
(63, 'Chipichape', 2, NULL, NULL),
(64, 'Brisas de los Alamos', 2, NULL, NULL),
(65, 'El Nacional', 3, NULL, NULL),
(66, 'El Peñón', 3, NULL, NULL),
(67, 'San Antonio', 3, NULL, NULL),
(68, 'San Cayetano', 3, NULL, NULL),
(69, 'Los Libertadores', 3, NULL, NULL),
(70, 'San Juan Bosco', 3, NULL, NULL),
(71, 'Santa Rosa', 3, NULL, NULL),
(72, 'La Merced', 3, NULL, NULL),
(73, 'San Pascual', 3, NULL, NULL),
(74, 'El Calvario', 3, NULL, NULL),
(75, 'San Pedro', 3, NULL, NULL),
(76, 'San Nicolas', 3, NULL, NULL),
(77, 'El Hoyo', 3, NULL, NULL),
(78, 'El Piloto', 3, NULL, NULL),
(79, 'Navarro - La Chanca', 3, NULL, NULL),
(80, 'Jorge Isaacs', 4, NULL, NULL),
(81, 'Santander', 4, NULL, NULL),
(82, 'Porvenir', 4, NULL, NULL),
(83, 'Las Delicias', 4, NULL, NULL),
(84, 'Manzanares', 4, NULL, NULL),
(85, 'Salomia', 4, NULL, NULL),
(86, 'Fátima', 4, NULL, NULL),
(87, 'Sultana - Berlín - San Francisco ', 4, NULL, NULL),
(88, 'Popular', 4, NULL, NULL),
(89, 'Ignacio Rengifo', 4, NULL, NULL),
(90, 'Guillermo Valencia', 4, NULL, NULL),
(91, 'La Isla', 4, NULL, NULL),
(92, 'Marco Fidel Suárez', 4, NULL, NULL),
(93, 'Evaristo García', 4, NULL, NULL),
(94, 'La Esmeralda', 4, NULL, NULL),
(95, 'Bolivariano', 4, NULL, NULL),
(96, 'Olaya Herrera', 4, NULL, NULL),
(97, 'Unidad Residencial Bueno Madrid', 4, NULL, NULL),
(98, 'Flora Industrial', 4, NULL, NULL),
(99, 'Industria de Licores', 4, NULL, NULL),
(100, 'El Sena', 5, NULL, NULL),
(101, 'Los Andes', 5, NULL, NULL),
(102, 'Los Guayacanes', 5, NULL, NULL),
(103, 'Chiminangos Segunda Etapa', 5, NULL, NULL),
(104, 'Chiminangos Primera Etapa', 5, NULL, NULL),
(105, 'Metropolitano del Norte', 5, NULL, NULL),
(106, 'San Luis', 6, NULL, NULL),
(107, 'Jorge Eliecer Gaitán', 6, NULL, NULL),
(108, 'Paso del Comercio', 6, NULL, NULL),
(109, 'Los Alcázares', 6, NULL, NULL),
(110, 'Petecuy Primera Etapa', 6, NULL, NULL),
(111, 'Petecuy Segunda Etapa', 6, NULL, NULL),
(112, 'La Rivera Primera Etapa', 6, NULL, NULL),
(113, 'Los Guaduales', 6, NULL, NULL),
(114, 'Petecuy Tercera Etapa', 6, NULL, NULL),
(115, 'Ciudadela Floralia', 6, NULL, NULL),
(116, 'Alfonso López P. 1a. Etapa', 7, NULL, NULL),
(117, 'Alfonso López P. 2a. Etapa', 7, NULL, NULL),
(118, 'Alfonso López P. 3a. Etapa', 7, NULL, NULL),
(119, 'Puerto Nuevo', 7, NULL, NULL),
(120, 'Puerto Mallarino', 7, NULL, NULL),
(121, 'Urbanización El Ángel del Hogar', 7, NULL, NULL),
(122, 'Siete de Agosto', 7, NULL, NULL),
(123, 'Los Pinos', 7, NULL, NULL),
(124, 'San Marino', 7, NULL, NULL),
(125, 'Las Ceibas', 7, NULL, NULL),
(126, 'Base Aérea', 7, NULL, NULL),
(127, 'Parque de la Caña', 7, NULL, NULL),
(128, 'Primitivo Crespo', 8, NULL, NULL),
(129, 'Simón Bolívar', 8, NULL, NULL),
(130, 'Saavedra Galindo', 8, NULL, NULL),
(131, 'Uribe Uribe', 8, NULL, NULL),
(132, 'Santa Mónica Popular', 8, NULL, NULL),
(133, 'La Floresta', 8, NULL, NULL),
(134, 'Benjamín Herrera', 8, NULL, NULL),
(135, 'Municipal', 8, NULL, NULL),
(136, 'Industrial', 8, NULL, NULL),
(137, 'El Troncal', 8, NULL, NULL),
(138, 'Las Américas', 8, NULL, NULL),
(139, 'Atanasio Girardot', 8, NULL, NULL),
(140, 'Santa Fe', 8, NULL, NULL),
(141, 'Chapinero', 8, NULL, NULL),
(142, 'Villa Colombia', 8, NULL, NULL),
(143, 'EL Trébol', 8, NULL, NULL),
(144, 'La Base', 8, NULL, NULL),
(145, 'Urbanización La Nueva Base', 8, NULL, NULL),
(146, 'Alameda', 9, NULL, NULL),
(147, 'Bretaña', 9, NULL, NULL),
(148, 'Junín', 9, NULL, NULL),
(149, 'Guayaquil', 9, NULL, NULL),
(150, 'Aranjuez', 9, NULL, NULL),
(151, 'Manuel María Buenaventura', 9, NULL, NULL),
(152, 'Santa Mónica Belalcázar', 9, NULL, NULL),
(153, 'Belalcázar', 9, NULL, NULL),
(154, 'Sucre', 9, NULL, NULL),
(155, 'Barrio Obrero', 9, NULL, NULL),
(156, 'El Dorado', 10, NULL, NULL),
(157, 'El Guabal', 10, NULL, NULL),
(158, 'La Libertad', 10, NULL, NULL),
(159, 'Santa Elena', 10, NULL, NULL),
(160, 'Las Acacias', 10, NULL, NULL),
(161, 'Santo Domingo', 10, NULL, NULL),
(162, 'Jorge Zawadsky', 10, NULL, NULL),
(163, 'Olímpico', 10, NULL, NULL),
(164, 'Cristóbal Colón', 10, NULL, NULL),
(165, 'La Selva', 10, NULL, NULL),
(166, 'Barrio Departamental', 10, NULL, NULL),
(167, 'Pasoancho', 10, NULL, NULL),
(168, 'Panamericano', 10, NULL, NULL),
(169, 'Colseguros Andes', 10, NULL, NULL),
(170, 'San Cristobal', 10, NULL, NULL),
(171, 'Las Granjas', 10, NULL, NULL),
(172, 'San Judas Tadeo I Etapa', 10, NULL, NULL),
(173, 'San Judas Tadeo II Etapa', 10, NULL, NULL),
(174, 'San Carlos', 11, NULL, NULL),
(175, 'Maracaibo', 11, NULL, NULL),
(176, 'La Independencia', 11, NULL, NULL),
(177, 'La Esperanza', 11, NULL, NULL),
(178, 'Urbanización Boyacá', 11, NULL, NULL),
(179, 'El Jardín', 11, NULL, NULL),
(180, 'La Fortaleza', 11, NULL, NULL),
(181, 'El Recuerdo', 11, NULL, NULL),
(182, 'Aguablanca', 11, NULL, NULL),
(183, 'El Prado', 11, NULL, NULL),
(184, '20 de Julio', 11, NULL, NULL),
(185, 'Prados de Oriente', 11, NULL, NULL),
(186, 'Los Sauces', 11, NULL, NULL),
(187, 'Villa del Sur', 11, NULL, NULL),
(188, 'José Holguín Garcés', 11, NULL, NULL),
(189, 'León XIII', 11, NULL, NULL),
(190, 'José María Córdoba', 11, NULL, NULL),
(191, 'San Pedro Claver', 11, NULL, NULL),
(192, 'Los Conquistadores', 11, NULL, NULL),
(193, 'La Gran Colombia', 11, NULL, NULL),
(194, 'San Benito', 11, NULL, NULL),
(195, 'Primavera', 11, NULL, NULL),
(196, 'Villanueva', 12, NULL, NULL),
(197, 'Asturias', 12, NULL, NULL),
(198, 'Eduardo Santos', 12, NULL, NULL),
(199, 'Alfonso Barberena A.', 12, NULL, NULL),
(200, 'El Paraiso', 12, NULL, NULL),
(201, 'Fenalco Kennedy', 12, NULL, NULL),
(202, 'Nueva Floresta', 12, NULL, NULL),
(203, 'Julio Rincón', 12, NULL, NULL),
(204, 'Doce de Octubre', 12, NULL, NULL),
(205, 'El Rodeo', 12, NULL, NULL),
(206, 'Sindical', 12, NULL, NULL),
(207, 'Bello Horizonte', 12, NULL, NULL),
(208, 'Ulpiano Lloreda', 13, NULL, NULL),
(209, 'El Vergel', 13, NULL, NULL),
(210, 'El Poblado I', 13, NULL, NULL),
(211, 'El Poblado II', 13, NULL, NULL),
(212, 'Los Comuneros Segunda Etapa', 13, NULL, NULL),
(213, 'Ricardo Balcázar', 13, NULL, NULL),
(214, 'Omar Torrijos', 13, NULL, NULL),
(215, 'El Diamante', 13, NULL, NULL),
(216, 'Lleras Restrepo', 13, NULL, NULL),
(217, 'Villa del Lago', 13, NULL, NULL),
(218, 'Los Robles', 13, NULL, NULL),
(219, 'Rodrigo Lara Bonilla', 13, NULL, NULL),
(220, 'Charco Azul', 13, NULL, NULL),
(221, 'Villablanca', 13, NULL, NULL),
(222, 'Calipso', 13, NULL, NULL),
(223, 'Alfonso Bonilla Aragón', 14, NULL, NULL),
(224, 'Alirio Mora Beltrán', 14, NULL, NULL),
(225, 'Manuela Beltrán', 14, NULL, NULL),
(226, 'Las Orquídeas', 14, NULL, NULL),
(227, 'José Manuel Marroquín Segunda Etapa', 14, NULL, NULL),
(228, 'José Manuel Marroquín Primera Etapa', 14, NULL, NULL),
(229, 'El Retiro', 15, NULL, NULL),
(230, 'Comuneros I', 15, NULL, NULL),
(231, 'Laureano Gómez', 15, NULL, NULL),
(232, 'El Vallado', 15, NULL, NULL),
(233, 'Mariano Ramos', 16, NULL, NULL),
(234, 'República de Israel', 16, NULL, NULL),
(235, 'Unión de Vivienda Popular', 16, NULL, NULL),
(236, 'Antonio Nariño', 16, NULL, NULL),
(237, 'Brisas del Limonar', 16, NULL, NULL),
(238, 'La Playa', 17, NULL, NULL),
(239, 'Primero de Mayo', 17, NULL, NULL),
(240, 'Ciudadela Comfandi', 17, NULL, NULL),
(241, 'Ciudad Universitaria', 17, NULL, NULL),
(242, 'Buenos Aires', 18, NULL, NULL),
(243, 'Barrio Caldas', 18, NULL, NULL),
(244, 'Los Chorros', 18, NULL, NULL),
(245, 'Meléndez', 18, NULL, NULL),
(246, 'Los Farallones', 18, NULL, NULL),
(247, 'Francisco Eladio Ramirez', 18, NULL, NULL),
(248, 'Prados del Sur', 18, NULL, NULL),
(249, 'Horizontes', 18, NULL, NULL),
(250, 'Mario Correa Rengifo', 18, NULL, NULL),
(251, 'Lourdes', 18, NULL, NULL),
(252, 'Colinas del Sur', 18, NULL, NULL),
(253, 'Alférez Real', 18, NULL, NULL),
(254, 'Nápoles', 18, NULL, NULL),
(255, 'El Jordán', 18, NULL, NULL),
(256, 'Cuarteles Napoles', 18, NULL, NULL),
(257, 'El Refugio', 19, NULL, NULL),
(258, 'La Cascada', 19, NULL, NULL),
(259, 'El Lido', 19, NULL, NULL),
(260, 'Urbanización Tequendama', 19, NULL, NULL),
(261, 'Barrio Eucarístico', 19, NULL, NULL),
(262, 'San Fernando Nuevo', 19, NULL, NULL),
(263, 'Urbanización Nueva Granada', 19, NULL, NULL),
(264, 'Santa Isabel', 19, NULL, NULL),
(265, 'Bellavista', 19, NULL, NULL),
(266, 'San Fernando Viejo', 19, NULL, NULL),
(267, 'Miraflores', 19, NULL, NULL),
(268, '3 de Julio', 19, NULL, NULL),
(269, 'El Cedro', 19, NULL, NULL),
(270, 'Champagñat', 19, NULL, NULL),
(271, 'Urbanización Colseguros', 19, NULL, NULL),
(272, 'Los Cambulos', 19, NULL, NULL),
(273, 'El Mortiñal', 19, NULL, NULL),
(274, 'Urbanización Militar', 19, NULL, NULL),
(275, 'Cuarto de Legua - Guadalupe', 19, NULL, NULL),
(276, 'Nueva Tequendama ', 19, NULL, NULL),
(277, 'Camino Real - Joaquín Borrero Sinisterra', 19, NULL, NULL),
(278, 'Camino Real - Los Fundadores', 19, NULL, NULL),
(279, 'El Cortijo', 20, NULL, NULL),
(280, 'Belisario Caicedo', 20, NULL, NULL),
(281, 'Siloé', 20, NULL, NULL),
(282, 'Lleras Camargo', 20, NULL, NULL),
(283, 'Belén', 20, NULL, NULL),
(284, 'Brisas de Mayo', 20, NULL, NULL),
(285, 'Tierra Blanca', 20, NULL, NULL),
(286, 'Pueblo Joven', 20, NULL, NULL),
(287, 'Pízamos I', 21, NULL, NULL),
(288, 'Pízamos II', 21, NULL, NULL),
(289, 'Calimio Desepaz', 21, NULL, NULL),
(290, 'El Remanso', 21, NULL, NULL),
(291, 'Los Líderes', 21, NULL, NULL),
(292, 'Desepaz Invicali', 21, NULL, NULL),
(293, 'Compartir', 21, NULL, NULL),
(294, 'Ciudad Talanga', 21, NULL, NULL),
(295, 'Urbanización Ciudad Jardín', 22, NULL, NULL),
(296, 'Sector Patio Bonito', 1, NULL, NULL),
(297, 'Aguacatal', 1, NULL, NULL),
(298, 'Urbanización La Merced', 2, NULL, NULL),
(299, 'Vipasa', 2, NULL, NULL),
(300, 'Urbanización La Flora', 2, NULL, NULL),
(301, 'Altos de Menga', 2, NULL, NULL),
(302, 'Area en desarrollo - Parque del Amor', 2, NULL, NULL),
(303, 'La Alianza', 4, NULL, NULL),
(304, 'Los Parques - Barranquilla', 5, NULL, NULL),
(305, 'Villa del Sol', 5, NULL, NULL),
(306, 'Alto Nápoles ', 18, NULL, NULL),
(307, 'Santa Barbara', 19, NULL, NULL),
(308, 'Unidad Residencial El Coliseo', 19, NULL, NULL),
(309, 'U.D. Alberto Galindo -  Plaza de Toros', 19, NULL, NULL),
(310, 'Villamercedes I - Villa Luz - Las Garzas', 21, NULL, NULL),
(311, 'Sector Asprosocial-Diamante', 13, NULL, NULL),
(312, 'Los Naranjos I', 14, NULL, NULL),
(313, 'Promociones Populares B', 14, NULL, NULL),
(314, 'Los Naranjos II', 14, NULL, NULL),
(315, 'Ciudad Cordoba', 15, NULL, NULL),
(316, 'Área desocupada', 16, NULL, NULL),
(317, 'Ciudad 2000', 16, NULL, NULL),
(318, 'La Alborada', 16, NULL, NULL),
(319, 'Ciudad Capri', 17, NULL, NULL),
(320, 'La Hacienda', 17, NULL, NULL),
(321, 'El Gran Limonar', 17, NULL, NULL),
(322, 'Unicentro Cali', 17, NULL, NULL),
(323, 'Sector Alto de Los Chorros', 18, NULL, NULL),
(324, 'Polvorines', 18, NULL, NULL),
(325, 'Sector Alto Jordán', 18, NULL, NULL),
(326, 'Altos de Santa Isabel -  La Morelia', 19, NULL, NULL),
(327, 'Tejares - Cristales', 19, NULL, NULL),
(328, 'Unidad Residencial Santiago de Cali', 19, NULL, NULL),
(329, 'Cañaveralejo - Seguros Patria', 19, NULL, NULL),
(330, 'Pampa Linda', 19, NULL, NULL),
(331, 'Sector Cañaveralejo Guadalupe Antigua', 19, NULL, NULL),
(332, 'Carabineros', 20, NULL, NULL),
(333, 'Venezuela - Urbanización Cañaveralejo', 20, NULL, NULL),
(334, 'Ciudad Campestre', 22, NULL, NULL),
(335, 'Club Campestre', 22, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficiarios`
--

CREATE TABLE `beneficiarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `grupo_id` int(10) UNSIGNED DEFAULT NULL,
  `fecha_inscripcion` date NOT NULL,
  `no_ficha` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `programa_id` int(10) UNSIGNED NOT NULL,
  `modalidad` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `punto_atencion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombres_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_documento_beneficiario` int(11) NOT NULL,
  `no_documento_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexo_beneficiario` int(11) NOT NULL,
  `fecha_nac_beneficiario` date NOT NULL,
  `edad_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pais_id` int(10) UNSIGNED NOT NULL,
  `departamento_id` int(10) UNSIGNED NOT NULL,
  `municipio_id` int(10) UNSIGNED NOT NULL,
  `direccion_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estrato_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comuna_id` int(10) UNSIGNED NOT NULL,
  `barrio_id` int(10) UNSIGNED NOT NULL,
  `corregimiento_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vereda_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado_civil_beneficiario` int(11) NOT NULL,
  `hijos_beneficiario` int(11) NOT NULL,
  `cantidad_hijos_beneficiario` int(11) NOT NULL,
  `tipo_sangre_beneficiario` int(11) NOT NULL,
  `ocupacion_beneficiario` int(11) NOT NULL,
  `otra_ocupacion_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `escolaridad_beneficiario` int(11) NOT NULL,
  `cultura_beneficiario` int(11) NOT NULL,
  `otra_cultura_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discapacidad_beneficiario` int(11) NOT NULL,
  `discapacidad_select_beneficiario` int(11) NOT NULL,
  `otra_discapacidad_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enfermedad_permanente_beneficiario` int(11) NOT NULL,
  `enfermedad_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medicamentos_permanente_beneficiario` int(11) NOT NULL,
  `medicamentos_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seguridad_social_beneficiario` int(11) NOT NULL,
  `salud_sgsss_beneficiario` int(11) DEFAULT NULL,
  `nombre_seguridad_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombres_acudiente` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos_acudiente` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_doc_acudiente` int(11) NOT NULL,
  `documento_acudiente` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexo_acudiente` int(11) NOT NULL,
  `fecha_nac_acudiente` date NOT NULL,
  `edad_acudiente` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono_acudiente` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo_acudiente` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parentesco_acudiente` int(11) NOT NULL,
  `otro_parentesco_acudiente` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunas`
--

CREATE TABLE `comunas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_comuna` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zona_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comunas`
--

INSERT INTO `comunas` (`id`, `nombre_comuna`, `zona_id`, `created_at`, `updated_at`) VALUES
(1, 'comuna 1', 3, '2017-12-08 22:03:43', '2017-12-08 22:34:27'),
(2, 'comuna 2', 2, '2017-12-09 22:38:00', '2017-12-09 22:38:00'),
(3, 'comuna 3', 2, NULL, NULL),
(4, 'comuna 4', 2, NULL, NULL),
(5, 'comuna 5', 2, NULL, NULL),
(6, 'comuna 6', 2, NULL, NULL),
(7, 'comuna 7', 2, NULL, NULL),
(8, 'comuna 8', 2, NULL, NULL),
(9, 'comuna 9', 2, NULL, NULL),
(10, 'comuna 10', 2, NULL, NULL),
(11, 'comuna 11', 2, NULL, NULL),
(12, 'comuna 12', 2, NULL, NULL),
(13, 'comuna 13', 2, NULL, NULL),
(14, 'comuna 14', 2, NULL, NULL),
(15, 'comuna 15', 2, NULL, NULL),
(16, 'comuna 16', 2, NULL, NULL),
(17, 'comuna 17', 2, NULL, NULL),
(18, 'comuna 18', 2, NULL, NULL),
(19, 'comuna 19', 2, NULL, NULL),
(20, 'comuna 20', 2, NULL, NULL),
(21, 'comuna 21', 2, NULL, NULL),
(22, 'comuna22', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_departamento` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pais_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombre_departamento`, `pais_id`, `created_at`, `updated_at`) VALUES
(1, 'Bogota D.C', 1, NULL, NULL),
(2, 'Antioquia', 1, NULL, NULL),
(3, 'Valle del Cauca', 1, NULL, NULL),
(4, 'Atlantico', 1, NULL, NULL),
(5, 'Bolivar', 1, NULL, NULL),
(6, 'Norte de Santander', 1, NULL, NULL),
(7, 'Tolima', 1, NULL, NULL),
(8, 'Santander', 1, NULL, NULL),
(9, 'Cundinamarca', 1, NULL, NULL),
(10, 'Risaralda', 1, NULL, NULL),
(11, 'Magdalena', 1, NULL, NULL),
(12, 'Meta', 1, NULL, NULL),
(13, 'Cesar', 1, NULL, NULL),
(14, 'Narino', 1, NULL, NULL),
(15, 'Cordova', 1, NULL, NULL),
(16, 'Caldas', 1, NULL, NULL),
(17, 'Huila', 1, NULL, NULL),
(18, 'Quindio', 1, NULL, NULL),
(19, 'Cauca', 1, NULL, NULL),
(20, 'Sucre', 1, NULL, NULL),
(21, 'La Guajira', 1, NULL, NULL),
(22, 'Boyaca', 1, NULL, NULL),
(23, 'Caqueta', 1, NULL, NULL),
(24, 'Casanare', 1, NULL, NULL),
(25, 'Choco', 1, NULL, NULL),
(26, 'Arauca', 1, NULL, NULL),
(27, 'San Andres y Providencia', 1, NULL, NULL),
(28, 'Guaviare', 1, NULL, NULL),
(29, 'Putumayo', 1, NULL, NULL),
(30, 'Amazonas', 1, NULL, NULL),
(31, 'Vichada', 1, NULL, NULL),
(32, 'Vaupes', 1, NULL, NULL),
(33, 'Guainia', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escenarios`
--

CREATE TABLE `escenarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipoescenario_id` int(10) UNSIGNED NOT NULL,
  `nombre_escenario` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sede_id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo_grupo` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `sede_id` int(10) UNSIGNED NOT NULL,
  `observaciones` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `programa_id` int(10) UNSIGNED DEFAULT NULL,
  `grado_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario_grupos`
--

CREATE TABLE `horario_grupos` (
  `id` int(10) UNSIGNED NOT NULL,
  `grupo_id` int(10) UNSIGNED NOT NULL,
  `dia` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instituciones`
--

CREATE TABLE `instituciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_institucion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo_dane` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_rector` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barrio_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `instituciones`
--

INSERT INTO `instituciones` (`id`, `nombre_institucion`, `codigo_dane`, `telefono`, `direccion`, `nombre_rector`, `barrio_id`, `created_at`, `updated_at`) VALUES
(3, 'ISAIAS GAMBOA', '176001004973', '8829099', 'AVENIDA 4 OESTE #12-05', 'ISAIAS GAMBOA', 44, '2018-01-31 22:15:36', '2018-01-31 22:15:36'),
(4, 'JOSE HOLGUIN GARCES', '176001008669', '5728942322', 'AVENIDA 4A OESTE #23-108', 'JOSE HOLGUIN GARCES', 44, '2018-01-31 22:19:37', '2018-01-31 22:19:37'),
(5, 'LUIS FERNANDO CAICEDO', '176001008766', '5728944316', 'AVENIDA 5A OESTE #47A-04', 'LUIS FERNANDO CAICEDO', 296, '2018-01-31 22:24:17', '2018-01-31 22:24:17'),
(6, 'BRISAS DE LOS ALAMOS', '17600100167203', '6650489', 'Av 2 BN Calle 72N', 'BRISAS DE LOS ALAMOS', 64, '2018-01-31 22:29:07', '2018-01-31 22:29:07'),
(7, 'REPUBLICA DE FRANCIA', '17600100167202', '6651433', 'CALLE 62N #2BN-00', 'REPUBLICA DE FRANCIA', 62, '2018-01-31 22:34:51', '2018-01-31 22:34:51'),
(8, 'REPUBLICA DEL BRASIL', '17600100167204', '6650489', 'CALLE 43 #7-03', 'REPUBLICA DEL BRASIL', 58, '2018-01-31 22:36:39', '2018-01-31 22:36:39'),
(9, 'NORMAL SUPERIOR LOS FARALLONES', '176001002253', '5587300', 'CARRERA 22 #2-65 OESTE', 'NORMAL SUPERIOR LOS FARALLONES', 69, '2018-01-31 22:44:25', '2018-01-31 22:44:25'),
(10, 'REPUBLICA DE ISRAEL', '176001005091', '4422485', 'CARRERA 3 # 43-49', 'CARRERA 3 # 43-49', 83, '2018-02-01 00:24:55', '2018-02-01 00:24:55'),
(11, 'JOSE ANTONIO GALAN', '176001003195', '3798853', 'CALLE 41 #3N-11', 'JOSE ANTONIO GALAN', 88, '2018-02-01 00:26:05', '2018-02-01 00:26:05'),
(12, 'LA MERCED', '176001001699', '3827677', 'CALLE 47 #4E-30', 'LA MERCED', 85, '2018-02-01 00:27:02', '2018-02-01 00:27:02'),
(13, 'VEINTE DE JULIO', '176001030796', '4437061', 'CARRERA 5 NORTE #33 -01', 'VEINTE DE JULIO', 87, '2018-02-01 00:27:58', '2018-02-01 00:27:58'),
(14, 'SANTO TOMÁS(CASD )', '176001040079', '4455489', 'CALLE 33 # 2N-11', 'SANTO TOMÁS(CASD )', 87, '2018-02-01 00:53:09', '2018-02-01 00:53:09'),
(15, 'INEM JORGE ISAACS', '17600104007904', '3374746', 'CALLE 30 # 5-88', 'INEM JORGE ISAACS', 82, '2018-02-01 00:54:37', '2018-02-01 00:54:37'),
(16, 'GUILLERMO VALENCIA', '176001001656', '4466502', 'CARRERA 7N #45A-08', 'GUILLERMO VALENCIA', 88, '2018-02-01 00:56:00', '2018-02-01 00:56:00'),
(17, 'CELMIRA BUENO DE OREJUELA', '176001020065', '4470928', 'CALLE 62B #1A9 - 250', 'CELMIRA BUENO DE OREJUELA', 103, '2018-02-01 00:57:17', '2018-02-01 00:57:17'),
(18, 'SIMON RODRIGUEZ', '176001001729', '6943892', 'CARRERA 1DBIS #49-98', 'SIMON RODRIGUEZ', 100, '2018-02-01 00:58:05', '2018-02-01 00:58:05'),
(19, 'PEDRO ANTONIO MOLINA', '176001007875', '4405332', 'CARRERA 1 A 10 #71 -00', 'PEDRO ANTONIO MOLINA', 106, '2018-02-01 00:59:17', '2018-02-01 00:59:17'),
(21, 'JUAN BAUTISTA DE LA SALLE', '176001004001', '6629986', 'CALLE 74 #9-19', 'JUAN BAUTISTA DE LA SALLE', 119, '2018-02-01 01:03:37', '2018-02-01 01:03:37'),
(22, 'VICENTE BORRERO COSTA', '176001001664', '6565620', 'CALLE 76 CARRERA 7 S OO EQ', 'VICENTE BORRERO COSTA', 118, '2018-02-01 01:04:52', '2018-02-01 01:04:52'),
(23, 'SIETE DE AGOSTO', '176001005970', '6565750', 'CALLE 72 11C27', 'SIETE DE AGOSTO', 122, '2018-02-01 01:05:48', '2018-02-01 01:05:48'),
(24, 'MANUEL MARIA MALLARINO', '176001008723', '3797428', 'CARRERA 7 L BIS #63-00', 'MANUEL MARIA MALLARINO', 125, '2018-02-01 01:09:10', '2018-02-01 01:09:10'),
(25, 'ALFONSO LOPEZ PUMAREJO', '17600100166403', '6565620', 'CALLE 84 CARRERA 7 ABIS EQ', 'ALFONSO LOPEZ PUMAREJO', 116, '2018-02-01 01:10:04', '2018-02-01 01:10:04'),
(26, 'SANTA  FE', '176001006071', '3719880', 'CALLE 34 #17B 41', 'SANTA  FE', 140, '2018-02-01 01:12:29', '2018-02-01 01:12:29'),
(27, 'EVARISTO GARCIA', '176001004329', '4415856', 'CALLE 32 #17-41', 'EVARISTO GARCIA', 130, '2018-02-01 01:13:24', '2018-02-01 01:13:24'),
(28, 'JUAN DE AMPUDIA', '176001003586', '3809395', 'CARRERA 12 #57-13', 'JUAN DE AMPUDIA', 144, '2018-02-01 01:15:09', '2018-02-01 01:15:09'),
(29, 'LAS AMERICAS', '176001022360', '4103225', 'CARRERA 12 #38-58', 'LAS AMERICAS', 138, '2018-02-01 01:16:37', '2018-02-01 01:16:37'),
(30, 'VILLACOLOMBIA', '176001001800', '4423864', 'CARRERA 12E #48-36', 'VILLACOLOMBIA', 142, '2018-02-01 01:20:15', '2018-02-01 01:20:15'),
(31, 'JOSE MANUEL SAAVEDRA GALINDO', '176001001826', '4431819', 'CARRERA 11 A #28-25', 'JOSE MANUEL SAAVEDRA GALINDO', 134, '2018-02-01 01:22:24', '2018-02-01 01:22:24'),
(32, 'ALBERTO CARVAJAL BORRERO', '176001001681', '4413443', 'CARRERA 14 #58-00', 'ALBERTO CARVAJAL BORRERO', 143, '2018-02-01 01:23:18', '2018-02-01 01:23:18'),
(33, 'REPUBLICA DE ARGENTINA', '176001005368', '8853626', 'CARRERA 11D #23-49', 'REPUBLICA DE ARGENTINA', 155, '2018-02-01 01:25:34', '2018-02-01 01:25:34'),
(34, 'ANTONIO JOSE CAMACHO', '176001001753', '5582689', 'CARRERA 16 #12-00', 'ANTONIO JOSE CAMACHO', 149, '2018-02-01 01:26:26', '2018-02-01 01:26:26'),
(35, 'ALFREDO VASQUEZ COBO', '176001001702', '3741844', 'CALLE 15A #22A-37', 'ALFREDO VASQUEZ COBO', 150, '2018-02-01 01:27:16', '2018-02-01 01:27:16'),
(36, 'JOSE MARIA VIVAS BALACAZAR', '176001001796', '3351363', 'CALLE 14 #48A-32', 'JOSE MARIA VIVAS BALACAZAR', 165, '2018-02-01 01:28:45', '2018-02-01 01:28:45'),
(37, 'ANEXA JOAQUIN DE CAICEDO Y CUERO', '176001005716', '3352383', 'CARRERA 35 #15-33', 'ANEXA JOAQUIN DE CAICEDO Y CUERO', 170, '2018-02-01 01:30:05', '2018-02-01 01:30:05'),
(38, 'NORMAL. SUPERIOR SANTIAGO DE CALI', '176001004531', '3356233', 'CARRERA 33A #12-60', 'NORMAL. SUPERIOR SANTIAGO DE CALI', 169, '2018-02-01 01:33:27', '2018-02-01 01:33:27'),
(39, 'RAFAEL NAVIA VARON', '176001020359', '5547094', 'CALLE 11 #45-46', 'RAFAEL NAVIA VARON', 166, '2018-02-01 01:34:58', '2018-02-01 01:34:58'),
(40, 'JOSE MARIA CARBONELL', '176001007166', '4854534', 'CALLE 13 #32-88', 'JOSE MARIA CARBONELL', 169, '2018-02-01 01:36:08', '2018-02-01 01:36:08'),
(41, 'JOAQUIN DE CAICEDO Y CUERO', '17600100453102', '3351810', 'CARRERA 36A #12C-00', 'JOAQUIN DE CAICEDO Y CUERO', 169, '2018-02-01 01:38:03', '2018-02-01 01:38:03'),
(42, 'CARLOS HOLGUIN LLOREDA', '176001008642', '3362316', 'CARRERA 40 #18- 85', 'CARLOS HOLGUIN LLOREDA', 157, '2018-02-01 01:39:19', '2018-02-01 01:39:19'),
(43, 'BOYACA', '176001008791', '3355548', 'Cra 24a # 26b-64', 'BOYACA', 178, '2018-02-01 01:50:14', '2018-02-01 01:50:14'),
(44, 'VILLA DEL SUR', '176001005121', '3369561', 'Calle 30A # 41E 99', 'VILLA DEL SUR', 187, '2018-02-01 01:52:11', '2018-02-01 01:52:11'),
(45, 'FRANCISCO DE PAULA SANTANDER', '176001006119', '3352352', 'Cl 27  # 31 A 60', 'FRANCISCO DE PAULA SANTANDER', 179, '2018-02-01 01:52:55', '2018-02-01 01:52:55'),
(46, 'DIEZ DE MAYO', '176001002881', '3345871', 'CARRERA 25A #26A-13', 'DIEZ DE MAYO', 182, '2018-02-01 01:53:52', '2018-02-01 01:53:52'),
(47, 'CIUDAD MODELO', '176001005805', '3341837', 'Cra 35  # 34C 21', 'CIUDAD MODELO', 193, '2018-02-01 01:54:59', '2018-02-01 01:54:59'),
(48, 'CIUDAD DE CALI', '176001005341', '3351417', 'calle 30 N. 25-00', 'CIUDAD DE CALI', 185, '2018-02-01 01:56:02', '2018-02-01 01:56:02'),
(49, 'AGUSTIN NIETO CABALLERO', '176001029411', '3367287', 'Cll  26e No.  44   00', 'AGUSTIN NIETO CABALLERO', 179, '2018-02-01 01:57:17', '2018-02-01 01:57:17'),
(50, 'JULIO CAICEDO Y TELLEZ', '176001003951', '44388583', 'CALLE 59 #  24-00', 'JULIO CAICEDO Y TELLEZ', 202, '2018-02-01 01:58:45', '2018-02-01 01:58:45'),
(51, 'MARICE  SINISTERRA', '176001002989', '4453459', 'CALLE 39 #25A-43', 'MARICE  SINISTERRA', 205, '2018-02-01 01:59:49', '2018-02-01 01:59:49'),
(52, 'JUAN XX III', '176001003918', '4452548', 'CARRERA 28C # 50-17', 'JUAN XX III', 206, '2018-02-01 02:00:57', '2018-02-01 02:00:57'),
(53, 'HERNANDO NAVIA VARON', '176001002555', '4438995', 'CRA 26 P # 50 39', 'HERNANDO NAVIA VARON', 202, '2018-02-01 02:01:45', '2018-02-01 02:01:45'),
(54, 'EVA RIASCOS PLATA', '176001002911', '4102294', 'TRANSVERSAL 25D #26-69', 'EVA RIASCOS PLATA', 196, '2018-02-01 02:02:35', '2018-02-01 02:02:35'),
(55, 'JESUS VILLAFAÑE FRANCO', '176001024273', '4266898', 'TRANS. 72W No,72-08', 'JESUS VILLAFAÑE FRANCO', 33, '2018-02-01 02:12:45', '2018-02-01 02:12:45'),
(56, 'BARTOLOME LOBOGUERRERO', '176001003161', '6633288', 'Calle 71 No. 25A-15', 'BARTOLOME LOBOGUERRERO', 32, '2018-02-01 02:13:46', '2018-02-01 02:13:46'),
(57, 'SANTA ROSA', '176001025946', '4374631', 'CALLE 72 N  No. 28-130', 'SANTA ROSA', 211, '2018-02-01 02:14:23', '2018-02-01 02:14:23'),
(58, 'LUZ HAYDEE GUERRERO', '176001032063', '4371539', 'CRA 28E 2 #72S-02', 'LUZ HAYDEE GUERRERO', 218, '2018-02-01 02:14:55', '2018-02-01 02:14:55'),
(59, 'HUMBERTO JORDAN MAZUERA', '176001020693', '6635160', 'DIAG.70B1 No. 22B Bis-', 'HUMBERTO JORDAN MAZUERA', 213, '2018-02-01 02:15:28', '2018-02-01 02:15:28'),
(60, 'EL DIAMANTE', '176001007115', '4269327', 'CRA.31 No. 41-00', 'EL DIAMANTE', 215, '2018-02-01 02:16:04', '2018-02-01 02:16:04'),
(61, 'MONSEÑOR RAMON ARCILA', '176001027001', '4224459', 'DIAG. 26K T 83-24', 'MONSEÑOR RAMON ARCILA', 227, '2018-02-01 02:17:08', '2018-02-01 02:17:08'),
(62, 'LA ANUNCIACION', '176001014359', '4042061', 'CRA 26A#74-00', 'LA ANUNCIACION', 224, '2018-02-01 02:18:07', '2018-02-01 02:18:07'),
(63, 'CIUDAD CORDOBA', '176001015975', '3384701', 'CALLE 50 No. 49C-100', 'CIUDAD CORDOBA', 315, '2018-02-01 02:18:56', '2018-02-01 02:18:56'),
(64, 'GABRIELA MISTRAL', '176001017374', '3900731', 'CALLE 95 CARRERA 27 D 96-06', 'GABRIELA MISTRAL', 223, '2018-02-01 02:20:47', '2018-02-01 02:20:47'),
(65, 'CARLOS HOLGUIN MALLARINO', '176001028872', '4363757', 'CALLE 92 No. 28D-4-13', 'CARLOS HOLGUIN MALLARINO', 230, '2018-02-01 02:21:34', '2018-02-01 02:21:34'),
(66, 'GABRIEL GARCIA MARQUEZ', '176001016491', '4364394', 'CRA 32 Q Calle 49 ESQUINA', 'GABRIEL GARCIA MARQUEZ', 230, '2018-02-01 02:22:08', '2018-02-01 02:22:08'),
(67, 'RODRIGO LLOREDA CAICEDO', '176001040119', '3320875', 'CALLE  41  #  51A - 30', 'RODRIGO LLOREDA CAICEDO', 233, '2018-02-01 02:22:57', '2018-02-01 02:22:57'),
(68, 'CARLOS HOLMES TRUJILLO', '176001007131', '4043170', 'CALLE 46 CRA 40', 'CARLOS HOLMES TRUJILLO', 234, '2018-02-01 02:23:44', '2018-02-01 02:23:44'),
(69, 'LIBARDO MADRID VALDERRAMA', '176001006356', '3283422', 'CARRERA 41H #39 - 73', 'LIBARDO MADRID VALDERRAMA', 235, '2018-02-01 02:24:33', '2018-02-01 02:24:33'),
(70, 'DONALD RODRIGO TAFUR', '176001028970', '3377731', 'CARRERA 43B #40-11', 'DONALD RODRIGO TAFUR', 234, '2018-02-01 02:25:33', '2018-02-01 02:25:33'),
(71, 'CRISTOBAL COLON', '176001004256', '4022710', 'CARRERA 47A #44-62', 'CRISTOBAL COLON', 233, '2018-02-01 02:26:14', '2018-02-01 02:26:14'),
(72, 'I.T.I COMUNA 17', '176001032055', '3161021', 'CRA 53 # 18 A-25', 'I.T.I COMUNA 17', 25, '2018-02-01 02:27:52', '2018-02-01 02:27:52'),
(73, 'I.T.I COMUNA 18', '17600103205502', '3318530', 'CARRERA  56  #  13F - 40', 'I.T.I COMUNA 18', 239, '2018-02-01 02:28:54', '2018-02-01 02:28:54'),
(74, 'JUAN PABLO II', '176001004515', '3235783', 'calle 1A  # 78-23', 'JUAN PABLO II', 248, '2018-02-01 02:29:40', '2018-02-01 02:29:40'),
(75, 'LA ESPERANZA', '176001014138', '3332019', 'CARRERA 94 No1A-71 OESTE', 'LA ESPERANZA', 325, '2018-02-01 02:30:21', '2018-02-01 02:30:21'),
(76, 'ALVARO ECHEVERRI PEREA', '176001011163', '3331918', 'CARRERA 93 OE No2A-00', 'ALVARO ECHEVERRI PEREA', 43, '2018-02-01 02:31:27', '2018-02-01 02:31:27'),
(77, 'POLITECNICO MUNICIPAL DE CALI', '176001013310', '5523616', 'CARRERA 62 No2-28', 'POLITECNICO MUNICIPAL DE CALI', 330, '2018-02-01 02:32:15', '2018-02-01 02:32:15'),
(78, 'LICEO DEPARTAMENTAL', '176001001745', '5141725', 'CARRERA 37A No8-38', 'LICEO DEPARTAMENTAL', 261, '2018-02-01 02:32:48', '2018-02-01 02:32:48'),
(79, 'CIUDADELA DESEPAZ', '176001030788', '4200125', 'CARRERA 23 No 120G- 16', 'CIUDADELA DESEPAZ', 289, '2018-02-01 02:33:50', '2018-02-01 02:33:50'),
(80, 'JUANA DE CAICEDO Y CUERO', '176001004981', '5535068', 'CALLE 8 #52-16 OESTE', 'JUANA DE CAICEDO Y CUERO', 279, '2018-02-01 02:39:12', '2018-02-01 02:39:12'),
(82, 'SANTA LIBRADA', '176001001818', '8858838', 'CALLE 7 #B14A-106', 'SANTA LIBRADA', 70, '2018-02-01 03:08:53', '2018-02-01 03:08:53'),
(83, 'SANTA CECILIA', '176001001672', '6642088', 'CALLE 61AN # 2GN-62', 'SANTA CECILIA', 62, '2018-02-01 03:10:56', '2018-02-01 03:10:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_qty` int(11) NOT NULL,
  `item_tax` int(11) NOT NULL,
  `item_status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `item_name`, `item_code`, `item_price`, `item_qty`, `item_tax`, `item_status`, `created_at`) VALUES
(1, 'hjkh', 'jkhjkhk', 'jkhjkhkj', 54, 4, 0, '2018-01-15 15:42:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_12_04_174655_entrust_setup_tables', 2),
(4, '2017_12_06_155325_alter_users_table', 3),
(5, '2017_12_07_054102_create_table_role_user_bd', 4),
(6, '2017_12_07_144932_create_programas_table', 5),
(7, '2017_12_08_153512_create_zonas_table', 6),
(8, '2017_12_08_163228_create_comunas_table', 7),
(9, '2017_12_08_181334_create_barrios_table', 8),
(10, '2017_12_08_195558_create_instituciones_table', 9),
(11, '2017_12_09_195711_create_sedes_table', 10),
(12, '2017_12_09_205817_create_tipoescenarios_table', 11),
(13, '2017_12_09_223922_create_escenarios_table', 12),
(15, '2017_12_12_031145_create_grupos_table', 13),
(17, '2017_12_14_140339_create_horario_grupos_table', 14),
(18, '2017_12_16_171021_create_paises_table', 15),
(19, '2017_12_16_181026_create_departamentos_table', 16),
(21, '2017_12_16_181746_create_municipios_table', 17),
(24, '2017_12_18_155316_create_beneficiarios_table', 18),
(25, '2017_12_18_211423_create_poblacional_beneficiarios_table', 19),
(26, '2017_12_31_025915_alter_grupos_table', 20),
(27, '2018_01_15_144823_create_items_table', 21),
(28, '2018_01_17_213230_create_productos_table', 22),
(47, '2018_01_20_152727_create_tipo_documento_table', 25),
(50, '2018_01_19_212247_create_tbl_gen_corregimientos_table', 27),
(51, '2018_01_19_212436_create_tbl_gen_veredas_table', 27),
(55, '2018_01_20_160409_create_personas_table', 28),
(56, '2018_01_20_160902_create_escolaridad_table', 29),
(57, '2018_01_20_161250_create_escolaridad_estado_table', 30),
(58, '2018_01_20_161458_create_eps_table', 31),
(59, '2018_01_20_161706_create_etnia_table', 32),
(60, '2018_01_20_161845_create_grupo_poblacional_table', 33),
(61, '2018_01_20_162004_create_ocupacion_table', 34),
(62, '2018_01_20_162204_create_parentesco_table', 35),
(63, '2018_01_20_162337_create_salud_regimen_table', 36),
(64, '2018_01_20_162634_create_discapacidad_table', 37),
(65, '2018_01_20_161846_create_grupo_poblacional_table', 38),
(66, '2018_01_20_164352_create_persona_x_grupo_poblacional', 39),
(67, '2018_01_20_164956_create_dv_persona_x_discapacidad', 40),
(68, '2018_01_20_165324_create_dv_persona_x_ocupacion', 41),
(69, '2018_01_20_165541_create_tbl_dv_ficha', 42),
(70, '2018_01_20_165542_create_tbl_dv_ficha', 43),
(71, '2018_01_20_174652_create_tbl_cm_ficha', 44),
(72, '2018_01_20_180204_create_tbl_estado_civil', 44),
(73, '2018_01_20_180941_create_tbl_poblacional_beneficiarios', 45),
(74, '2018_01_20_180205_create_tbl_estado_civil', 46),
(75, '2018_01_20_181822_alter_table_persona', 47),
(76, '2018_01_23_221032_create_tbl_gen_asistencias_table', 48),
(77, '2018_01_23_221033_create_tbl_gen_asistencias_table', 49),
(78, '2018_01_25_075835_create_tbl_cm_grados_table', 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_municipio` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departamento_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id`, `nombre_municipio`, `departamento_id`, `created_at`, `updated_at`) VALUES
(1, 'Bogota', 1, NULL, NULL),
(2, 'Medellin', 2, NULL, NULL),
(3, 'Bello', 2, NULL, NULL),
(4, 'Envigado', 2, NULL, NULL),
(5, 'Apartado', 2, NULL, NULL),
(6, 'Turbo', 2, NULL, NULL),
(7, 'Rionegro', 2, NULL, NULL),
(8, 'Caucasia', 2, NULL, NULL),
(9, 'Caldas', 2, NULL, NULL),
(10, 'Chigorodo', 2, NULL, NULL),
(11, 'Copacabana', 2, NULL, NULL),
(12, 'La Estrella', 2, NULL, NULL),
(13, 'Necocli', 2, NULL, NULL),
(14, 'Carepa', 2, NULL, NULL),
(15, 'Marinilla', 2, NULL, NULL),
(16, 'La Ceja', 2, NULL, NULL),
(17, 'Girardota', 2, NULL, NULL),
(18, 'La Estrella', 2, NULL, NULL),
(19, 'Necocli', 2, NULL, NULL),
(20, 'La Ceja', 2, NULL, NULL),
(21, 'El Bagre', 2, NULL, NULL),
(22, 'Marinilla', 2, NULL, NULL),
(23, 'Sabaneta', 2, NULL, NULL),
(24, 'Carepa', 2, NULL, NULL),
(25, 'Girardota', 2, NULL, NULL),
(26, 'Barbosa', 2, NULL, NULL),
(27, 'Andes', 2, NULL, NULL),
(28, 'Yarumal', 2, NULL, NULL),
(29, 'El Carmen de Viboral', 2, NULL, NULL),
(30, 'Guarne', 2, NULL, NULL),
(31, 'Puerto Berrio', 2, NULL, NULL),
(32, 'Urrao', 2, NULL, NULL),
(33, 'Sonson', 2, NULL, NULL),
(34, 'Segovia', 2, NULL, NULL),
(35, 'Taraza', 2, NULL, NULL),
(36, 'Santa Rosa de Osos', 2, NULL, NULL),
(37, 'Arboletes', 2, NULL, NULL),
(38, 'Caceres', 2, NULL, NULL),
(39, 'San Pedro de Uraba', 2, NULL, NULL),
(40, 'Ciudad Bolivar', 2, NULL, NULL),
(41, 'Amaga', 2, NULL, NULL),
(42, 'Zaragoza', 2, NULL, NULL),
(43, 'El Santuario', 2, NULL, NULL),
(44, 'Ituango', 2, NULL, NULL),
(45, 'Dabeiba', 2, NULL, NULL),
(46, 'Santa Barbara', 2, NULL, NULL),
(47, 'Santa Fe de Antioquia', 2, NULL, NULL),
(48, 'Remedios', 2, NULL, NULL),
(49, 'Fredonia', 2, NULL, NULL),
(50, 'San Pedro', 2, NULL, NULL),
(51, 'Concordia', 2, NULL, NULL),
(52, 'San Juan de Uraba', 2, NULL, NULL),
(53, 'Nechi', 2, NULL, NULL),
(54, 'Amalfi', 2, NULL, NULL),
(55, 'Abejorral', 2, NULL, NULL),
(56, 'Frontino', 2, NULL, NULL),
(57, 'Yolombo', 2, NULL, NULL),
(58, 'San Vicente', 2, NULL, NULL),
(59, 'Salgar', 2, NULL, NULL),
(60, 'San Roque', 2, NULL, NULL),
(61, 'La Union', 2, NULL, NULL),
(62, 'Don Matias', 2, NULL, NULL),
(63, 'Valdivia', 2, NULL, NULL),
(64, 'Canasgordas', 2, NULL, NULL),
(65, 'Betulia', 2, NULL, NULL),
(66, 'Puerto Nare', 2, NULL, NULL),
(67, 'Mutata1', 2, NULL, NULL),
(68, 'Tamesis', 2, NULL, NULL),
(69, 'Puerto Triunfo', 2, NULL, NULL),
(70, 'Penol', 2, NULL, NULL),
(71, 'San Carlos', 2, NULL, NULL),
(72, 'Narino', 2, NULL, NULL),
(73, 'Cocorna', 2, NULL, NULL),
(74, 'Yondo', 2, NULL, NULL),
(75, 'Anori', 2, NULL, NULL),
(76, 'Jardin', 2, NULL, NULL),
(77, 'San Rafael', 2, NULL, NULL),
(78, 'Venecia', 2, NULL, NULL),
(79, 'Sopetran', 2, NULL, NULL),
(80, 'Titiribi', 2, NULL, NULL),
(81, 'Jerico', 2, NULL, NULL),
(82, 'Angostura', 2, NULL, NULL),
(83, 'Ebejico', 2, NULL, NULL),
(84, 'San Jeronimo', 2, NULL, NULL),
(85, 'Santo Domingo', 2, NULL, NULL),
(86, 'Vegachi', 2, NULL, NULL),
(87, 'Gomez Plata', 2, NULL, NULL),
(88, 'San Luis', 2, NULL, NULL),
(89, 'Betania', 2, NULL, NULL),
(90, 'Argelia', 2, NULL, NULL),
(91, 'Granada', 2, NULL, NULL),
(92, 'Campamento', 2, NULL, NULL),
(93, 'Cisneros', 2, NULL, NULL),
(94, 'Peque', 2, NULL, NULL),
(95, 'Liborina', 2, NULL, NULL),
(96, 'Briceno', 2, NULL, NULL),
(97, 'Entrerrios', 2, NULL, NULL),
(98, 'Uramita', 2, NULL, NULL),
(99, 'Pueblorrico', 2, NULL, NULL),
(100, 'Sabanalarga', 2, NULL, NULL),
(101, 'Yali', 2, NULL, NULL),
(102, 'Caicedo', 2, NULL, NULL),
(103, 'Angelopolis', 2, NULL, NULL),
(104, 'Maceo', 2, NULL, NULL),
(105, 'Montebello', 2, NULL, NULL),
(106, 'Anza', 2, NULL, NULL),
(107, 'San Andres de Cuerquia', 2, NULL, NULL),
(108, 'Tarso', 2, NULL, NULL),
(109, 'La Pintada', 2, NULL, NULL),
(110, 'Buritica', 2, NULL, NULL),
(111, 'Heliconia', 2, NULL, NULL),
(112, 'San Francisco', 2, NULL, NULL),
(113, 'Valparaiso', 2, NULL, NULL),
(114, 'Guadalupe', 2, NULL, NULL),
(115, 'Belmira', 2, NULL, NULL),
(116, 'Guatape', 2, NULL, NULL),
(117, 'Toledo', 2, NULL, NULL),
(118, 'Caramanta', 2, NULL, NULL),
(119, 'Vigia del Fuerte', 2, NULL, NULL),
(120, 'Armenia', 2, NULL, NULL),
(121, 'Caracoli', 2, NULL, NULL),
(122, 'Hispania', 2, NULL, NULL),
(123, 'Concepcion', 2, NULL, NULL),
(124, 'Giraldo', 2, NULL, NULL),
(125, 'Carolina', 2, NULL, NULL),
(126, 'Alejandria', 2, NULL, NULL),
(127, 'Murindo', 2, NULL, NULL),
(128, 'San Jose de La Montana', 2, NULL, NULL),
(129, 'Olaya', 2, NULL, NULL),
(130, 'Abriaqui', 2, NULL, NULL),
(131, 'Cali', 3, NULL, NULL),
(132, 'Buenaventura', 3, NULL, NULL),
(133, 'Palmira', 3, NULL, NULL),
(134, 'Tulua', 3, NULL, NULL),
(135, 'Cartago', 3, NULL, NULL),
(136, 'Guadalajara de Buga', 3, NULL, NULL),
(137, 'Jamundi', 3, NULL, NULL),
(138, 'Yumbo', 3, NULL, NULL),
(139, 'Candelaria', 3, NULL, NULL),
(140, 'Florida', 3, NULL, NULL),
(141, 'El Cerrito', 3, NULL, NULL),
(142, 'Pradera', 3, NULL, NULL),
(143, 'Florida', 3, NULL, NULL),
(144, 'El Cerrito', 3, NULL, NULL),
(145, 'Pradera', 3, NULL, NULL),
(146, 'Sevilla', 3, NULL, NULL),
(147, 'Zarzal', 3, NULL, NULL),
(148, 'Dagua', 3, NULL, NULL),
(149, 'Roldanillo', 3, NULL, NULL),
(150, 'Guacari', 3, NULL, NULL),
(151, 'La Union', 3, NULL, NULL),
(152, 'Caicedonia', 3, NULL, NULL),
(153, 'Bugalagrande', 3, NULL, NULL),
(154, 'Ansermanuevo', 3, NULL, NULL),
(155, 'Ginebra', 3, NULL, NULL),
(156, 'Trujillo', 3, NULL, NULL),
(157, 'Andalucia', 3, NULL, NULL),
(158, 'Alcala', 3, NULL, NULL),
(159, 'Riofrio', 3, NULL, NULL),
(160, 'Toro', 3, NULL, NULL),
(161, 'Restrepo', 3, NULL, NULL),
(162, 'San Pedro', 3, NULL, NULL),
(163, 'Yotoco', 3, NULL, NULL),
(164, 'Darien', 3, NULL, NULL),
(165, 'Bolivar', 3, NULL, NULL),
(166, 'Obando', 3, NULL, NULL),
(167, 'La Victoria', 3, NULL, NULL),
(168, 'La Cumbre', 3, NULL, NULL),
(169, 'El aguila', 3, NULL, NULL),
(170, 'El Dovio', 3, NULL, NULL),
(171, 'El Cairo', 3, NULL, NULL),
(172, 'Versalles', 3, NULL, NULL),
(173, 'Argelia', 3, NULL, NULL),
(174, 'Barranquilla', 3, NULL, NULL),
(175, 'Soledad', 3, NULL, NULL),
(176, 'Malambo', 3, NULL, NULL),
(177, 'Baranoa', 3, NULL, NULL),
(178, 'Galapa', 3, NULL, NULL),
(179, 'Puerto Colombia', 3, NULL, NULL),
(180, 'Sabanagrande', 3, NULL, NULL),
(181, 'Santo Tomas', 3, NULL, NULL),
(182, 'Palmar de Varela', 3, NULL, NULL),
(183, 'Luruaco', 3, NULL, NULL),
(184, 'Repelon', 3, NULL, NULL),
(185, 'Campo de La Cruz', 3, NULL, NULL),
(186, 'Ponedera', 3, NULL, NULL),
(187, 'Juan de Acosta', 3, NULL, NULL),
(188, 'Polonuevo', 3, NULL, NULL),
(189, 'Manati', 3, NULL, NULL),
(190, 'Santa Lucia', 3, NULL, NULL),
(191, 'Candelaria', 3, NULL, NULL),
(192, 'Tubara', 3, NULL, NULL),
(193, 'Suan', 3, NULL, NULL),
(194, 'Piojo', 3, NULL, NULL),
(195, 'Barranquilla', 4, NULL, NULL),
(196, 'Soledad', 4, NULL, NULL),
(197, 'Malambo', 4, NULL, NULL),
(198, 'Baranoa', 4, NULL, NULL),
(199, 'Galapa', 4, NULL, NULL),
(200, 'Puerto Colombia', 4, NULL, NULL),
(201, 'Sabanagrande', 4, NULL, NULL),
(202, 'Santo Tomas', 4, NULL, NULL),
(203, 'Palmar de Varela', 4, NULL, NULL),
(204, 'Luruaco', 4, NULL, NULL),
(205, 'Campo de La Cruz', 4, NULL, NULL),
(206, 'Ponedera', 4, NULL, NULL),
(207, 'Juan de Acosta', 4, NULL, NULL),
(208, 'Polonuevo', 4, NULL, NULL),
(209, 'Manati', 4, NULL, NULL),
(210, 'Santa Lucia', 4, NULL, NULL),
(211, 'Candelaria', 4, NULL, NULL),
(212, 'Tubara,Suan', 4, NULL, NULL),
(213, 'Piojo', 4, NULL, NULL),
(214, 'Cartagena de Indias', 5, NULL, NULL),
(215, 'Magangue', 5, NULL, NULL),
(216, 'Turbaco', 5, NULL, NULL),
(217, 'Arjona', 5, NULL, NULL),
(218, 'Maria La Baja', 5, NULL, NULL),
(219, 'Santa Cruz de Mompox', 5, NULL, NULL),
(220, 'Santa Rosa del Sur', 5, NULL, NULL),
(221, 'San Juan Nepomuceno', 5, NULL, NULL),
(222, 'San Pablo', 5, NULL, NULL),
(223, 'Pinillos', 5, NULL, NULL),
(224, 'San Jacinto', 5, NULL, NULL),
(225, 'Rio Viejo', 5, NULL, NULL),
(226, 'Calamar', 5, NULL, NULL),
(227, 'Achi', 5, NULL, NULL),
(228, 'Morales', 5, NULL, NULL),
(229, 'Simiti', 5, NULL, NULL),
(230, 'Santa Rosa', 5, NULL, NULL),
(231, 'Villanueva', 5, NULL, NULL),
(232, 'Montecristo', 5, NULL, NULL),
(233, 'Arenal del Sur', 5, NULL, NULL),
(234, 'San Estanislao', 5, NULL, NULL),
(235, 'Barranco de Loba', 5, NULL, NULL),
(236, 'San Martin de Loba', 5, NULL, NULL),
(237, 'Turbana', 5, NULL, NULL),
(238, 'Cordoba', 5, NULL, NULL),
(239, 'San Fernando', 5, NULL, NULL),
(240, 'Santa Catalina', 5, NULL, NULL),
(241, 'Clemencia', 5, NULL, NULL),
(242, 'Hatillo de Loba', 5, NULL, NULL),
(243, 'Altos del Rosario', 5, NULL, NULL),
(244, 'Zambrano', 5, NULL, NULL),
(245, 'Cicuco', 5, NULL, NULL),
(246, 'Talaigua Nuevo', 5, NULL, NULL),
(247, 'San Jacinto del Cauca', 5, NULL, NULL),
(248, 'Arroyohondo', 5, NULL, NULL),
(249, 'Regidor', 5, NULL, NULL),
(250, 'Soplaviento', 5, NULL, NULL),
(251, 'El Guamo', 5, NULL, NULL),
(252, 'Cantagallo', 5, NULL, NULL),
(253, 'El Penon', 5, NULL, NULL),
(254, 'San Jose de Cucuta', 6, NULL, NULL),
(255, 'Ocana', 6, NULL, NULL),
(256, 'Villa del Rosario', 6, NULL, NULL),
(257, 'Los Patios', 6, NULL, NULL),
(258, 'Pamplona', 6, NULL, NULL),
(259, 'Tibu', 6, NULL, NULL),
(260, 'Abrego', 6, NULL, NULL),
(261, 'Sardinata', 6, NULL, NULL),
(262, 'El Zulia', 6, NULL, NULL),
(263, 'Teorama', 6, NULL, NULL),
(264, 'Toledo', 6, NULL, NULL),
(265, 'Convencion', 6, NULL, NULL),
(266, 'El Carmen', 6, NULL, NULL),
(267, 'Chinacota', 6, NULL, NULL),
(268, 'San Calixto', 6, NULL, NULL),
(269, 'La Esperanza', 6, NULL, NULL),
(270, 'El Tarra', 6, NULL, NULL),
(271, 'Cachira', 6, NULL, NULL),
(272, 'Chitaga', 6, NULL, NULL),
(273, 'Hacari', 6, NULL, NULL),
(274, 'Salazar de Las Palmas', 6, NULL, NULL),
(275, 'Arboledas', 6, NULL, NULL),
(276, 'Puerto Santander', 6, NULL, NULL),
(277, 'Cucutilla', 6, NULL, NULL),
(278, 'La Playa', 6, NULL, NULL),
(279, 'Ragonvalia', 6, NULL, NULL),
(280, 'Bochalema', 6, NULL, NULL),
(281, 'Gramalote', 6, NULL, NULL),
(282, 'Labateca', 6, NULL, NULL),
(283, 'Silos', 6, NULL, NULL),
(284, 'Villa Caro', 6, NULL, NULL),
(285, 'Pamplonita', 6, NULL, NULL),
(286, 'Bucarasica', 6, NULL, NULL),
(287, 'Herran', 6, NULL, NULL),
(288, 'San Cayetano', 6, NULL, NULL),
(289, 'Durania', 6, NULL, NULL),
(290, 'Mutiscua', 6, NULL, NULL),
(291, 'Lourdes', 6, NULL, NULL),
(292, 'Santiago', 6, NULL, NULL),
(293, 'Cacota', 6, NULL, NULL),
(294, 'Ibague', 7, NULL, NULL),
(295, 'Espinal', 7, NULL, NULL),
(296, 'Chaparral', 7, NULL, NULL),
(297, 'Libano', 7, NULL, NULL),
(298, 'Guamo', 7, NULL, NULL),
(299, 'Ortega', 7, NULL, NULL),
(300, 'Mariquita', 7, NULL, NULL),
(301, 'Melgar', 7, NULL, NULL),
(302, 'Fresno', 7, NULL, NULL),
(303, 'Planadas', 7, NULL, NULL),
(304, 'Coyaima', 7, NULL, NULL),
(305, 'Flandes', 7, NULL, NULL),
(306, 'Purificacion', 7, NULL, NULL),
(307, 'Honda', 7, NULL, NULL),
(308, 'Rioblanco', 7, NULL, NULL),
(309, 'Natagaima', 7, NULL, NULL),
(310, 'Ataco', 7, NULL, NULL),
(311, 'Rovira', 7, NULL, NULL),
(312, 'Cajamarca', 7, NULL, NULL),
(313, 'Lerida', 7, NULL, NULL),
(314, 'San Luis', 7, NULL, NULL),
(315, 'Venadillo', 7, NULL, NULL),
(316, 'San Antonio', 7, NULL, NULL),
(317, 'Saldana', 7, NULL, NULL),
(318, 'Icononzo', 7, NULL, NULL),
(319, 'Villahermosa', 7, NULL, NULL),
(320, 'Cunday', 7, NULL, NULL),
(321, 'Palocabildo', 7, NULL, NULL),
(322, 'Falan,Dolores', 7, NULL, NULL),
(323, 'Herveo', 7, NULL, NULL),
(324, 'Coello', 7, NULL, NULL),
(325, 'Alvarado', 7, NULL, NULL),
(326, 'Carmen de Apicala', 7, NULL, NULL),
(327, 'Ambalema', 7, NULL, NULL),
(328, 'Casabianca', 7, NULL, NULL),
(329, 'Santa Isabel', 7, NULL, NULL),
(330, 'Roncesvalles', 7, NULL, NULL),
(331, 'Villarrica', 7, NULL, NULL),
(332, 'Valle de San Juan', 7, NULL, NULL),
(333, 'Piedras', 7, NULL, NULL),
(334, 'Alpujarra', 7, NULL, NULL),
(335, 'Murillo', 7, NULL, NULL),
(336, 'Suarez', 7, NULL, NULL),
(337, 'Bucaramanga', 8, NULL, NULL),
(338, 'Floridablanca', 8, NULL, NULL),
(339, 'Barrancabermeja', 8, NULL, NULL),
(340, 'Giron', 8, NULL, NULL),
(341, 'Piedecuesta', 8, NULL, NULL),
(342, 'Cimitarra', 8, NULL, NULL),
(343, 'San Vicente de Chucuri', 8, NULL, NULL),
(344, 'Puerto Wilches', 8, NULL, NULL),
(345, 'Lebrija', 8, NULL, NULL),
(346, 'Rionegro', 8, NULL, NULL),
(347, 'Socorro', 8, NULL, NULL),
(348, 'Barbosa', 8, NULL, NULL),
(349, 'Sabana de Torres', 8, NULL, NULL),
(350, 'Velez,Malaga', 8, NULL, NULL),
(351, 'El Carmen de Chucuri', 8, NULL, NULL),
(352, 'Landazuri', 8, NULL, NULL),
(353, 'Puente Nacional', 8, NULL, NULL),
(354, 'Bolivar', 8, NULL, NULL),
(355, 'El Playon', 8, NULL, NULL),
(356, 'Curiti', 8, NULL, NULL),
(357, 'Charala', 8, NULL, NULL),
(358, 'Oiba', 8, NULL, NULL),
(359, 'Los Santos', 8, NULL, NULL),
(360, 'Suaita', 8, NULL, NULL),
(361, 'Mogotes', 8, NULL, NULL),
(362, 'San Andres', 8, NULL, NULL),
(363, 'Zapatoca', 8, NULL, NULL),
(364, 'Sucre', 8, NULL, NULL),
(365, 'Simacota', 8, NULL, NULL),
(366, 'La Belleza', 8, NULL, NULL),
(367, 'Aratoca', 8, NULL, NULL),
(368, 'Barichara', 8, NULL, NULL),
(369, 'Coromoro', 8, NULL, NULL),
(370, 'Villanueva', 8, NULL, NULL),
(371, 'Guaca', 8, NULL, NULL),
(372, 'Tona', 8, NULL, NULL),
(373, 'Puerto Parra', 8, NULL, NULL),
(374, 'Florian', 8, NULL, NULL),
(375, 'Cerrito', 8, NULL, NULL),
(376, 'Capitanejo', 8, NULL, NULL),
(377, 'Concepcion', 8, NULL, NULL),
(378, 'Matanza', 8, NULL, NULL),
(379, 'Molagavita', 8, NULL, NULL),
(380, 'Onzaga', 8, NULL, NULL),
(381, 'La Paz', 8, NULL, NULL),
(382, 'El Penon', 8, NULL, NULL),
(383, 'Guadalupe', 8, NULL, NULL),
(384, 'Betulia', 8, NULL, NULL),
(385, 'Carcasi', 8, NULL, NULL),
(386, 'Gambita', 8, NULL, NULL),
(387, 'Chipata', 8, NULL, NULL),
(388, 'Ocamonte', 8, NULL, NULL),
(389, 'San Jose de Miranda', 8, NULL, NULL),
(390, 'Albania', 8, NULL, NULL),
(391, 'Santa Helena del Opon', 8, NULL, NULL),
(392, 'Pinchote', 8, NULL, NULL),
(393, 'Guavata', 8, NULL, NULL),
(394, 'Contratacion', 8, NULL, NULL),
(395, 'Enciso', 8, NULL, NULL),
(396, 'San Benito', 8, NULL, NULL),
(397, 'Paramo', 8, NULL, NULL),
(398, 'Surata', 8, NULL, NULL),
(399, 'Jesus Maria', 8, NULL, NULL),
(400, 'Chima', 8, NULL, NULL),
(401, 'Charta', 8, NULL, NULL),
(402, 'Galan', 8, NULL, NULL),
(403, 'San Joaquin', 8, NULL, NULL),
(404, 'Palmar', 8, NULL, NULL),
(405, 'Confines', 8, NULL, NULL),
(406, 'Macaravita', 8, NULL, NULL),
(407, 'Encino', 8, NULL, NULL),
(408, 'San Miguel', 8, NULL, NULL),
(409, 'Palmas del Socorro', 8, NULL, NULL),
(410, 'Hato', 8, NULL, NULL),
(411, 'Vetas', 8, NULL, NULL),
(412, 'Santa Barbara', 8, NULL, NULL),
(413, 'El Guacamayo', 8, NULL, NULL),
(414, 'Guapota', 8, NULL, NULL),
(415, 'Aguada', 8, NULL, NULL),
(416, 'Cepita', 8, NULL, NULL),
(417, 'Cabrera', 8, NULL, NULL),
(418, 'California', 8, NULL, NULL),
(419, 'Jordan', 8, NULL, NULL),
(420, 'Soacha', 9, NULL, NULL),
(421, 'Fusagasuga', 9, NULL, NULL),
(422, 'Facatativa', 9, NULL, NULL),
(423, 'Chia', 9, NULL, NULL),
(424, 'Zipaquira', 9, NULL, NULL),
(425, 'Girardot', 9, NULL, NULL),
(426, 'Mosquera', 9, NULL, NULL),
(427, 'Madrid', 9, NULL, NULL),
(428, 'Funza', 9, NULL, NULL),
(429, 'Cajica', 9, NULL, NULL),
(430, 'Villa de San Diego de Ubate', 9, NULL, NULL),
(431, 'Guaduas,Sibate', 9, NULL, NULL),
(432, 'La Mesa', 9, NULL, NULL),
(433, 'Pacho', 9, NULL, NULL),
(434, 'Villeta', 9, NULL, NULL),
(435, 'Tocancipa', 9, NULL, NULL),
(436, 'La Calera', 9, NULL, NULL),
(437, 'Silvania', 9, NULL, NULL),
(438, 'Sopo', 9, NULL, NULL),
(439, 'Tabio', 9, NULL, NULL),
(440, 'El Colegio', 9, NULL, NULL),
(441, 'Cota', 9, NULL, NULL),
(442, 'Choconta', 9, NULL, NULL),
(443, 'Tenjo', 9, NULL, NULL),
(444, 'Cogua', 9, NULL, NULL),
(445, 'Tocaima', 9, NULL, NULL),
(446, 'Villapinzon', 9, NULL, NULL),
(447, 'Caparrapi', 9, NULL, NULL),
(448, 'Caqueza', 9, NULL, NULL),
(449, 'Yacopi', 9, NULL, NULL),
(450, 'Puerto Salgar', 9, NULL, NULL),
(451, 'Suesca', 9, NULL, NULL),
(452, 'Nilo', 9, NULL, NULL),
(453, 'Viota', 9, NULL, NULL),
(454, 'El Rosal', 9, NULL, NULL),
(455, 'Anolaima', 9, NULL, NULL),
(456, 'La Vega', 9, NULL, NULL),
(457, 'Subachoque', 9, NULL, NULL),
(458, 'Guasca', 9, NULL, NULL),
(459, 'San Antonio del Tequendama', 9, NULL, NULL),
(460, 'Fomeque', 9, NULL, NULL),
(461, 'Ubala', 9, NULL, NULL),
(462, 'Agua de Dios', 9, NULL, NULL),
(463, 'Arbelaez', 9, NULL, NULL),
(464, 'Guacheta', 9, NULL, NULL),
(465, 'Anapoima', 9, NULL, NULL),
(466, 'Nemocon', 9, NULL, NULL),
(467, 'Choachi', 9, NULL, NULL),
(468, 'Pasca', 9, NULL, NULL),
(469, 'Simijaca', 9, NULL, NULL),
(470, 'Gachancipa', 9, NULL, NULL),
(471, 'Gacheta', 9, NULL, NULL),
(472, 'San Bernardo', 9, NULL, NULL),
(473, 'Sasaima', 9, NULL, NULL),
(474, 'Cachipay', 9, NULL, NULL),
(475, 'La Palma', 9, NULL, NULL),
(476, 'Medina', 9, NULL, NULL),
(477, 'Sesquile', 9, NULL, NULL),
(478, 'San Juan de Rio Seco', 9, NULL, NULL),
(479, 'Susa', 9, NULL, NULL),
(480, 'Lenguazaque', 9, NULL, NULL),
(481, 'Bojaca', 9, NULL, NULL),
(482, 'Carmen de Carupa', 9, NULL, NULL),
(483, 'Junin,Chipaque', 9, NULL, NULL),
(484, 'San Francisco', 9, NULL, NULL),
(485, 'Quipile', 9, NULL, NULL),
(486, 'Ricaurte', 9, NULL, NULL),
(487, 'Une', 9, NULL, NULL),
(488, 'Apulo', 9, NULL, NULL),
(489, 'Nocaima', 9, NULL, NULL),
(490, 'Vergara', 9, NULL, NULL),
(491, 'Tausa', 9, NULL, NULL),
(492, 'Tena', 9, NULL, NULL),
(493, 'Paratebueno', 9, NULL, NULL),
(494, 'Cucunuba', 9, NULL, NULL),
(495, 'La Pena', 9, NULL, NULL),
(496, 'Ubaque', 9, NULL, NULL),
(497, 'Granada', 9, NULL, NULL),
(498, 'Macheta', 9, NULL, NULL),
(499, 'Guatavita', 9, NULL, NULL),
(500, 'Fosca', 9, NULL, NULL),
(501, 'Quetame', 9, NULL, NULL),
(502, 'Alban', 9, NULL, NULL),
(503, 'Gachala', 9, NULL, NULL),
(504, 'Nimaima', 9, NULL, NULL),
(505, 'Paime', 9, NULL, NULL),
(506, 'Pandi', 9, NULL, NULL),
(507, 'San Cayetano', 9, NULL, NULL),
(508, 'Fuquene', 9, NULL, NULL),
(509, 'Zipacon', 9, NULL, NULL),
(510, 'El Penon', 9, NULL, NULL),
(511, 'Supata', 9, NULL, NULL),
(512, 'utica', 9, NULL, NULL),
(513, 'Tibacuy', 9, NULL, NULL),
(514, 'Topaipi', 9, NULL, NULL),
(515, 'Guayabetal', 9, NULL, NULL),
(516, 'Sutatausa', 9, NULL, NULL),
(517, 'Quebradanegra', 9, NULL, NULL),
(518, 'Cabrera', 9, NULL, NULL),
(519, 'Manta', 9, NULL, NULL),
(520, 'Viani', 9, NULL, NULL),
(521, 'Chaguani', 9, NULL, NULL),
(522, 'Venecia', 9, NULL, NULL),
(523, 'Gama', 9, NULL, NULL),
(524, 'Guayabal de Siquima', 9, NULL, NULL),
(525, 'Gutierrez', 9, NULL, NULL),
(526, 'Tibirita', 9, NULL, NULL),
(527, 'Puli', 9, NULL, NULL),
(528, 'Jerusalen', 9, NULL, NULL),
(529, 'Bituima', 9, NULL, NULL),
(530, 'Guataqui', 9, NULL, NULL),
(531, 'Villagomez', 9, NULL, NULL),
(532, 'Narino', 9, NULL, NULL),
(533, 'Beltran', 9, NULL, NULL),
(534, 'Pereira', 10, NULL, NULL),
(535, 'Santa Rosa de Cabal', 10, NULL, NULL),
(536, 'La Virginia', 10, NULL, NULL),
(537, 'Belen de Umbria', 10, NULL, NULL),
(538, 'Marsella', 10, NULL, NULL),
(539, 'Santuario', 10, NULL, NULL),
(540, 'Mistrato', 10, NULL, NULL),
(541, 'Pueblo Rico', 10, NULL, NULL),
(542, 'Santa Marta', 11, NULL, NULL),
(543, 'Zona Bananera', 11, NULL, NULL),
(544, 'Baranoa', 11, NULL, NULL),
(545, 'El Banco', 11, NULL, NULL),
(546, 'Zona Bananera', 11, NULL, NULL),
(547, 'El Banco', 11, NULL, NULL),
(548, 'Plato', 11, NULL, NULL),
(549, 'Pivijay', 11, NULL, NULL),
(550, 'Aracataca', 11, NULL, NULL),
(551, 'Ariguani', 11, NULL, NULL),
(552, 'Sitionuevo', 11, NULL, NULL),
(553, 'Guamal', 11, NULL, NULL),
(554, 'Puebloviejo', 11, NULL, NULL),
(555, 'Santa Ana', 11, NULL, NULL),
(556, 'El Reten', 11, NULL, NULL),
(557, 'San Sebastian de Buenavista', 11, NULL, NULL),
(558, 'El Pinon', 11, NULL, NULL),
(559, 'Chivolo', 11, NULL, NULL),
(560, 'Nueva Granada', 11, NULL, NULL),
(561, 'Sabanas de San angel', 11, NULL, NULL),
(562, 'Pijino del Carmen', 11, NULL, NULL),
(563, 'Tenerife', 11, NULL, NULL),
(564, 'Algarrobo', 11, NULL, NULL),
(565, 'Santa Barbara de Pinto', 11, NULL, NULL),
(566, 'Concordia', 11, NULL, NULL),
(567, 'San Zenon', 11, NULL, NULL),
(568, 'Remolino', 11, NULL, NULL),
(569, 'Zapayan', 11, NULL, NULL),
(570, 'Salamina', 11, NULL, NULL),
(571, 'Cerro San Antonio', 11, NULL, NULL),
(572, 'Villavicencio', 12, NULL, NULL),
(573, 'Acacias', 12, NULL, NULL),
(574, 'Granada', 12, NULL, NULL),
(575, 'Puerto Lopez', 12, NULL, NULL),
(576, 'La Macarena', 12, NULL, NULL),
(577, 'San Martin', 12, NULL, NULL),
(578, 'Vista Hermosa', 12, NULL, NULL),
(579, 'Puerto Rico', 12, NULL, NULL),
(580, 'Puerto Gaitan', 12, NULL, NULL),
(581, 'Cumaral', 12, NULL, NULL),
(582, 'Puerto Concordia', 12, NULL, NULL),
(583, 'La Uribe', 12, NULL, NULL),
(584, 'Fuente de Oro', 12, NULL, NULL),
(585, 'Mesetas', 12, NULL, NULL),
(586, 'Puerto Lleras', 12, NULL, NULL),
(587, 'San Juan de Arama', 12, NULL, NULL),
(588, 'San Carlos de Guaroa', 12, NULL, NULL),
(589, 'Cubarral', 12, NULL, NULL),
(590, 'San Juanito', 12, NULL, NULL),
(591, 'Valledupar', 13, NULL, NULL),
(592, 'Agustin Codazzi', 13, NULL, NULL),
(593, 'Agustin Codazzi', 13, NULL, NULL),
(594, 'Chimichagua', 13, NULL, NULL),
(595, 'Bosconia', 13, NULL, NULL),
(596, 'El Copey', 13, NULL, NULL),
(597, 'Chiriguana', 13, NULL, NULL),
(598, 'La Jagua de Ibirico', 13, NULL, NULL),
(599, 'La Paz', 13, NULL, NULL),
(600, 'El Paso', 13, NULL, NULL),
(601, 'San Alberto', 13, NULL, NULL),
(602, 'Astrea', 13, NULL, NULL),
(603, 'San Martin', 13, NULL, NULL),
(604, 'Pueblo Bello', 13, NULL, NULL),
(605, 'Pelaya', 13, NULL, NULL),
(606, 'Pailitas', 13, NULL, NULL),
(607, 'La Gloria', 13, NULL, NULL),
(608, 'Rio de Oro', 13, NULL, NULL),
(609, 'Tamalameque', 13, NULL, NULL),
(610, 'Becerril', 13, NULL, NULL),
(611, 'San Diego', 13, NULL, NULL),
(612, 'Gonzalez', 13, NULL, NULL),
(613, 'Pasto', 14, NULL, NULL),
(614, 'Tumaco', 14, NULL, NULL),
(615, 'Ipiales', 14, NULL, NULL),
(616, 'Samaniego', 14, NULL, NULL),
(617, 'Tuquerres', 14, NULL, NULL),
(618, 'Cumbal', 14, NULL, NULL),
(619, 'Barbacoas', 14, NULL, NULL),
(620, 'La Union', 14, NULL, NULL),
(621, 'Olaya Herrera', 14, NULL, NULL),
(622, 'El Charco', 14, NULL, NULL),
(623, 'Sandona', 14, NULL, NULL),
(624, 'Buesaco', 14, NULL, NULL),
(625, 'Santacruz', 14, NULL, NULL),
(626, 'Alban', 14, NULL, NULL),
(627, 'Pupiales', 14, NULL, NULL),
(628, 'San Lorenzo', 14, NULL, NULL),
(629, 'San Pablo', 14, NULL, NULL),
(630, 'La Cruz', 14, NULL, NULL),
(631, 'Taminango', 14, NULL, NULL),
(632, 'Roberto Payan', 14, NULL, NULL),
(633, 'Guachucal', 14, NULL, NULL),
(634, 'Magui Payan', 14, NULL, NULL),
(635, 'Los Andes', 14, NULL, NULL),
(636, 'Santa Barbara', 14, NULL, NULL),
(637, 'Ricaurte', 14, NULL, NULL),
(638, 'San Bernardo', 14, NULL, NULL),
(639, 'El Tambo', 14, NULL, NULL),
(640, 'El Tablon', 14, NULL, NULL),
(641, 'Policarpa', 14, NULL, NULL),
(642, 'Guaitarilla', 14, NULL, NULL),
(643, 'Cordoba', 14, NULL, NULL),
(644, 'Potosi', 14, NULL, NULL),
(645, 'Leiva', 14, NULL, NULL),
(646, 'Providencia', 14, NULL, NULL),
(647, 'Cumbitara', 14, NULL, NULL),
(648, 'La Florida', 14, NULL, NULL),
(649, 'El Rosario', 14, NULL, NULL),
(650, 'Francisco Pizarro', 14, NULL, NULL),
(651, 'Tangua,Consaca', 14, NULL, NULL),
(652, 'Yacuanquer', 14, NULL, NULL),
(653, 'Colon', 14, NULL, NULL),
(654, 'Mallama', 14, NULL, NULL),
(655, 'Ancuya', 14, NULL, NULL),
(656, 'Puerres', 14, NULL, NULL),
(657, 'La Tola', 14, NULL, NULL),
(658, 'Ospina', 14, NULL, NULL),
(659, 'Iles', 14, NULL, NULL),
(660, 'Imues', 14, NULL, NULL),
(661, 'Sapuyes', 14, NULL, NULL),
(662, 'Arboleda', 14, NULL, NULL),
(663, 'San Pedro de Cartago', 14, NULL, NULL),
(664, 'El Penol', 14, NULL, NULL),
(665, 'Aldana', 14, NULL, NULL),
(666, 'Contadero', 14, NULL, NULL),
(667, 'Belen', 14, NULL, NULL),
(668, 'La Llanada', 14, NULL, NULL),
(669, 'Gualmatan', 14, NULL, NULL),
(670, 'Narino', 14, NULL, NULL),
(671, 'Monteria', 15, NULL, NULL),
(672, 'Tierralta', 15, NULL, NULL),
(673, 'Cerete', 15, NULL, NULL),
(674, 'Sahagun', 15, NULL, NULL),
(675, 'Montelibano', 15, NULL, NULL),
(676, 'Cienaga de Oro', 15, NULL, NULL),
(677, 'Chinu', 15, NULL, NULL),
(678, 'Ayapel', 15, NULL, NULL),
(679, 'San Pelayo', 15, NULL, NULL),
(680, 'Puerto Libertador', 15, NULL, NULL),
(681, 'Valencia', 15, NULL, NULL),
(682, 'Pueblo Nuevo', 15, NULL, NULL),
(683, 'San Bernardo del Viento', 15, NULL, NULL),
(684, 'San Antero', 15, NULL, NULL),
(685, 'San Carlos', 15, NULL, NULL),
(686, 'Monitos', 15, NULL, NULL),
(687, 'Puerto Escondido', 15, NULL, NULL),
(688, 'Buenavista', 15, NULL, NULL),
(689, 'Los Cordobas', 15, NULL, NULL),
(690, 'Canalete', 15, NULL, NULL),
(691, 'Cotorra', 15, NULL, NULL),
(692, 'Purisima', 15, NULL, NULL),
(693, 'Momil', 15, NULL, NULL),
(694, 'Chima', 15, NULL, NULL),
(695, 'Manizales', 16, NULL, NULL),
(696, 'La Dorada', 16, NULL, NULL),
(697, 'Riosucio', 16, NULL, NULL),
(698, 'Chinchina', 16, NULL, NULL),
(699, 'Villamaria', 16, NULL, NULL),
(700, 'Anserma', 16, NULL, NULL),
(701, 'Neira', 16, NULL, NULL),
(702, 'Pensilvania', 16, NULL, NULL),
(703, 'Samana', 16, NULL, NULL),
(704, 'Manzanares', 16, NULL, NULL),
(705, 'Supia', 16, NULL, NULL),
(706, 'Aguadas', 16, NULL, NULL),
(707, 'Salamina', 16, NULL, NULL),
(708, 'Palestina', 16, NULL, NULL),
(709, 'Pacora', 16, NULL, NULL),
(710, 'Marquetalia', 16, NULL, NULL),
(711, 'Aranzazu', 16, NULL, NULL),
(712, 'Filadelfia', 16, NULL, NULL),
(713, 'Belalcazar', 16, NULL, NULL),
(714, 'Risaralda', 16, NULL, NULL),
(715, 'Victoria', 16, NULL, NULL),
(716, 'Marmato', 16, NULL, NULL),
(717, 'San Jose', 16, NULL, NULL),
(718, 'Norcasia', 16, NULL, NULL),
(719, 'La Merced', 16, NULL, NULL),
(720, 'Marulanda', 16, NULL, NULL),
(721, 'Neiva', 17, NULL, NULL),
(722, 'Pitalito', 17, NULL, NULL),
(723, 'Garzon', 17, NULL, NULL),
(724, 'La Plata', 17, NULL, NULL),
(725, 'Campoalegre', 17, NULL, NULL),
(726, 'San Agustin', 17, NULL, NULL),
(727, 'Gigante', 17, NULL, NULL),
(728, 'Palermo', 17, NULL, NULL),
(729, 'Acevedo', 17, NULL, NULL),
(730, 'Isnos', 17, NULL, NULL),
(731, 'Algeciras', 17, NULL, NULL),
(732, 'Timana', 17, NULL, NULL),
(733, 'Aipe', 17, NULL, NULL),
(734, 'Guadalupe', 17, NULL, NULL),
(735, 'Tarqui', 17, NULL, NULL),
(736, 'Suaza', 17, NULL, NULL),
(737, 'Tello', 17, NULL, NULL),
(738, 'Pital', 17, NULL, NULL),
(739, 'La Argentina', 17, NULL, NULL),
(740, 'Colombia', 17, NULL, NULL),
(741, 'Iquira', 17, NULL, NULL),
(742, 'Palestina', 17, NULL, NULL),
(743, 'Saladoblanco', 17, NULL, NULL),
(744, 'Santa Maria', 17, NULL, NULL),
(745, 'Baraya', 17, NULL, NULL),
(746, 'Tesalia', 17, NULL, NULL),
(747, 'Agrado', 17, NULL, NULL),
(748, 'Teruel', 17, NULL, NULL),
(749, 'Yaguara', 17, NULL, NULL),
(750, 'Villavieja', 17, NULL, NULL),
(751, 'Hobo', 17, NULL, NULL),
(752, 'Paicol', 17, NULL, NULL),
(753, 'Altamira', 17, NULL, NULL),
(754, 'Elias', 17, NULL, NULL),
(755, 'Armenia', 18, NULL, NULL),
(756, 'Calarca', 18, NULL, NULL),
(757, 'Montenegro', 18, NULL, NULL),
(758, 'La Tebaida', 18, NULL, NULL),
(759, 'Circasia', 18, NULL, NULL),
(760, 'Filandia', 18, NULL, NULL),
(761, 'Genova', 18, NULL, NULL),
(762, 'Salento', 18, NULL, NULL),
(763, 'Pijao', 18, NULL, NULL),
(764, 'Cordoba', 18, NULL, NULL),
(765, 'Buenavista', 18, NULL, NULL),
(766, 'Popayan', 19, NULL, NULL),
(767, 'El Tambo', 19, NULL, NULL),
(768, 'Puerto Tejada', 19, NULL, NULL),
(769, 'Bolivar', 19, NULL, NULL),
(770, 'La Vega', 19, NULL, NULL),
(771, 'Caloto', 19, NULL, NULL),
(772, 'Piendamo', 19, NULL, NULL),
(773, 'Cajibio', 19, NULL, NULL),
(774, 'Miranda', 19, NULL, NULL),
(775, 'Patia', 19, NULL, NULL),
(776, 'Paez', 19, NULL, NULL),
(777, 'Silvia', 19, NULL, NULL),
(778, 'Caldono', 19, NULL, NULL),
(779, 'Timbio', 19, NULL, NULL),
(780, 'Guapi', 19, NULL, NULL),
(781, 'Corinto', 19, NULL, NULL),
(782, 'Inza', 19, NULL, NULL),
(783, 'Buenos Aires', 19, NULL, NULL),
(784, 'Toribio', 19, NULL, NULL),
(785, 'Argelia', 19, NULL, NULL),
(786, 'Morales', 19, NULL, NULL),
(787, 'Balboa', 19, NULL, NULL),
(788, 'Timbiqui', 19, NULL, NULL),
(789, 'Almaguer', 19, NULL, NULL),
(790, 'Lopez', 19, NULL, NULL),
(791, 'Suarez', 19, NULL, NULL),
(792, 'Mercaderes', 19, NULL, NULL),
(793, 'Totoro', 19, NULL, NULL),
(794, 'Sotara', 19, NULL, NULL),
(795, 'Purace Coconuco', 19, NULL, NULL),
(796, 'Jambalo', 19, NULL, NULL),
(797, 'Villa Rica', 19, NULL, NULL),
(798, 'San Sebastian', 19, NULL, NULL),
(799, 'Rosas', 19, NULL, NULL),
(800, 'La Sierra', 19, NULL, NULL),
(801, 'Santa Rosa', 19, NULL, NULL),
(802, 'Sucre', 19, NULL, NULL),
(803, 'Piamonte', 19, NULL, NULL),
(804, 'Florencia', 19, NULL, NULL),
(805, 'Sincelejo', 20, NULL, NULL),
(806, 'Corozal', 20, NULL, NULL),
(807, 'San Marcos', 20, NULL, NULL),
(808, 'San Onofre', 20, NULL, NULL),
(809, 'Sampues', 20, NULL, NULL),
(810, 'Santiago de Tolu', 20, NULL, NULL),
(811, 'San Benito Abad', 20, NULL, NULL),
(812, 'Sucre,Ovejas', 20, NULL, NULL),
(813, 'Tolu Viejo', 20, NULL, NULL),
(814, 'Galeras', 20, NULL, NULL),
(815, 'San Pedro', 20, NULL, NULL),
(816, 'Guaranda', 20, NULL, NULL),
(817, 'Morroa', 20, NULL, NULL),
(818, 'San Juan de Betulia', 20, NULL, NULL),
(819, 'Palmito', 20, NULL, NULL),
(820, 'Covenas', 20, NULL, NULL),
(821, 'Caimito', 20, NULL, NULL),
(822, 'La Union', 20, NULL, NULL),
(823, 'El Roble', 20, NULL, NULL),
(824, 'Buenavista', 20, NULL, NULL),
(825, 'Coloso', 20, NULL, NULL),
(826, 'Riohacha', 21, NULL, NULL),
(827, 'Uribia', 21, NULL, NULL),
(828, 'Maicao', 21, NULL, NULL),
(829, 'Manaure', 21, NULL, NULL),
(830, 'Barrancas', 21, NULL, NULL),
(831, 'Villanueva', 21, NULL, NULL),
(832, 'Dibulla', 21, NULL, NULL),
(833, 'Albania', 21, NULL, NULL),
(834, 'Urumita', 21, NULL, NULL),
(835, 'Distraccion', 21, NULL, NULL),
(836, 'El Molino', 21, NULL, NULL),
(837, 'Tunja', 22, NULL, NULL),
(838, 'Sogamoso', 22, NULL, NULL),
(839, 'Duitama', 22, NULL, NULL),
(840, 'Chiquinquira', 22, NULL, NULL),
(841, 'Puerto Boyaca', 22, NULL, NULL),
(842, 'Paipa', 22, NULL, NULL),
(843, 'Moniquira', 22, NULL, NULL),
(844, 'Samaca', 22, NULL, NULL),
(845, 'Aquitania', 22, NULL, NULL),
(846, 'Garagoa', 22, NULL, NULL),
(847, 'Nobsa', 22, NULL, NULL),
(848, 'Ventaquemada', 22, NULL, NULL),
(849, 'Santa Rosa de Viterbo', 22, NULL, NULL),
(850, 'Combita,Saboya', 22, NULL, NULL),
(851, 'Tibasosa', 22, NULL, NULL),
(852, 'Raquira', 22, NULL, NULL),
(853, 'Villa de Leyva', 22, NULL, NULL),
(854, 'Chita', 22, NULL, NULL),
(855, 'Ramiriqui', 22, NULL, NULL),
(856, 'Toca', 22, NULL, NULL),
(857, 'Otanche', 22, NULL, NULL),
(858, 'Pauna', 22, NULL, NULL),
(859, 'Socota', 22, NULL, NULL),
(860, 'Muzo', 22, NULL, NULL),
(861, 'Guateque', 22, NULL, NULL),
(862, 'Umbita', 22, NULL, NULL),
(863, 'Pesca', 22, NULL, NULL),
(864, 'Tibana', 22, NULL, NULL),
(865, 'Miraflores', 22, NULL, NULL),
(866, 'Soata', 22, NULL, NULL),
(867, 'Tuta', 22, NULL, NULL),
(868, 'Sotaquira', 22, NULL, NULL),
(869, 'Siachoque', 22, NULL, NULL),
(870, 'Boavita', 22, NULL, NULL),
(871, 'Quipama', 22, NULL, NULL),
(872, 'Maripi', 22, NULL, NULL),
(873, 'Guican', 22, NULL, NULL),
(874, 'Socha', 22, NULL, NULL),
(875, 'Turmeque', 22, NULL, NULL),
(876, 'Jenesano', 22, NULL, NULL),
(877, 'Tasco', 22, NULL, NULL),
(878, 'Motavita', 22, NULL, NULL),
(879, 'Chitaraque', 22, NULL, NULL),
(880, 'Cubara', 22, NULL, NULL),
(881, 'San Luis de Gaceno', 22, NULL, NULL),
(882, 'Guayata', 22, NULL, NULL),
(883, 'Sutamarchan', 22, NULL, NULL),
(884, 'Nuevo Colon', 22, NULL, NULL),
(885, 'Chiquiza', 22, NULL, NULL),
(886, 'Soraca', 22, NULL, NULL),
(887, 'Buenavista', 22, NULL, NULL),
(888, 'San Jose de Pare', 22, NULL, NULL),
(889, 'Tota,Gameza', 22, NULL, NULL),
(890, 'El Cocuy', 22, NULL, NULL),
(891, 'Chiscas', 22, NULL, NULL),
(892, 'Labranzagrande', 22, NULL, NULL),
(893, 'Mongua', 22, NULL, NULL),
(894, 'Paz de Rio', 22, NULL, NULL),
(895, 'Cienega', 22, NULL, NULL),
(896, 'Togui', 22, NULL, NULL),
(897, 'Arcabuco', 22, NULL, NULL),
(898, 'Zetaquira', 22, NULL, NULL),
(899, 'Boyaca', 22, NULL, NULL),
(900, 'Chivata', 22, NULL, NULL),
(901, 'Mongui', 22, NULL, NULL),
(902, 'Floresta', 22, NULL, NULL),
(903, 'San Mateo', 22, NULL, NULL),
(904, 'Jerico', 22, NULL, NULL),
(905, 'Macanal', 22, NULL, NULL),
(906, 'Tenza', 22, NULL, NULL),
(907, 'Santa Maria', 22, NULL, NULL),
(908, 'San Miguel de Sema', 22, NULL, NULL),
(909, 'Cucaita', 22, NULL, NULL),
(910, 'Sutatenza', 22, NULL, NULL),
(911, 'Somondoco', 22, NULL, NULL),
(912, 'Cerinza', 22, NULL, NULL),
(913, 'Coper', 22, NULL, NULL),
(914, 'Campohermoso', 22, NULL, NULL),
(915, 'Caldas', 22, NULL, NULL),
(916, 'El Espino', 22, NULL, NULL),
(917, 'Sachica', 22, NULL, NULL),
(918, 'Tipacoque', 22, NULL, NULL),
(919, 'Chinavita', 22, NULL, NULL),
(920, 'Susacon', 22, NULL, NULL),
(921, 'Topaga', 22, NULL, NULL),
(922, 'La Uvita', 22, NULL, NULL),
(923, 'Viracacha', 22, NULL, NULL),
(924, 'Paez', 22, NULL, NULL),
(925, 'Covarachia', 22, NULL, NULL),
(926, 'La Capilla', 22, NULL, NULL),
(927, 'Pachavita', 22, NULL, NULL),
(928, 'Gachantiva', 22, NULL, NULL),
(929, 'Rondon', 22, NULL, NULL),
(930, 'Sora', 22, NULL, NULL),
(931, 'Tinjaca', 22, NULL, NULL),
(932, 'Oicata', 22, NULL, NULL),
(933, 'Sativanorte', 22, NULL, NULL),
(934, 'Briceno', 22, NULL, NULL),
(935, 'Paya', 22, NULL, NULL),
(936, 'Corrales', 22, NULL, NULL),
(937, 'Beteitiva', 22, NULL, NULL),
(938, 'Pajarito', 22, NULL, NULL),
(939, 'Tutaza', 22, NULL, NULL),
(940, 'Chivor', 22, NULL, NULL),
(941, 'Guacamayas', 22, NULL, NULL),
(942, 'Iza,Cuitiva', 22, NULL, NULL),
(943, 'San Eduardo', 22, NULL, NULL),
(944, 'Berbeo', 22, NULL, NULL),
(945, 'Panqueba', 22, NULL, NULL),
(946, 'La Victoria', 22, NULL, NULL),
(947, 'Tunungua', 22, NULL, NULL),
(948, 'Pisba', 22, NULL, NULL),
(949, 'Sativasur', 22, NULL, NULL),
(950, 'Busbanza', 22, NULL, NULL),
(951, 'Florencia', 23, NULL, NULL),
(952, 'San Vicente del Caguan', 23, NULL, NULL),
(953, 'Puerto Rico', 23, NULL, NULL),
(954, 'Cartagena del Chaira', 23, NULL, NULL),
(955, 'La Montanita', 23, NULL, NULL),
(956, 'El Doncello', 23, NULL, NULL),
(957, 'Solano', 23, NULL, NULL),
(958, 'El Paujil', 23, NULL, NULL),
(959, 'San Jose del Fragua', 23, NULL, NULL),
(960, 'Milan', 23, NULL, NULL),
(961, 'Curillo', 23, NULL, NULL),
(962, 'Valparaiso', 23, NULL, NULL),
(963, 'Belen de los Andaquies', 23, NULL, NULL),
(964, 'Albania', 23, NULL, NULL),
(965, 'Morelia', 23, NULL, NULL),
(966, 'Yopal', 24, NULL, NULL),
(967, 'Aguazul', 24, NULL, NULL),
(968, 'Tauramena', 24, NULL, NULL),
(969, 'Monterrey', 24, NULL, NULL),
(970, 'Trinidad', 24, NULL, NULL),
(971, 'Mani', 24, NULL, NULL),
(972, 'Hato Corozal', 24, NULL, NULL),
(973, 'Nunchia', 24, NULL, NULL),
(974, 'Pore', 24, NULL, NULL),
(975, 'Orocue', 24, NULL, NULL),
(976, 'San Luis de Palenque', 24, NULL, NULL),
(977, 'Tamara', 24, NULL, NULL),
(978, 'Sabanalarga', 24, NULL, NULL),
(979, 'Recetor', 24, NULL, NULL),
(980, 'Chameza', 24, NULL, NULL),
(981, 'Sacama', 24, NULL, NULL),
(982, 'La Salina', 24, NULL, NULL),
(983, 'Quibdo', 25, NULL, NULL),
(984, 'Alto Baudo', 25, NULL, NULL),
(985, 'Istmina', 25, NULL, NULL),
(986, 'Medio Atrato', 25, NULL, NULL),
(987, 'Riosucio1', 25, NULL, NULL),
(988, 'Belen de Bajira', 25, NULL, NULL),
(989, 'Condoto', 25, NULL, NULL),
(990, 'Medio San Juan', 25, NULL, NULL),
(991, 'Litoral de San Juan', 25, NULL, NULL),
(992, 'Carmen del Atrato', 25, NULL, NULL),
(993, 'Medio Baudo', 25, NULL, NULL),
(994, 'Acandi', 25, NULL, NULL),
(995, 'Lloro', 25, NULL, NULL),
(996, 'Bojaya', 25, NULL, NULL),
(997, 'Certegui', 25, NULL, NULL),
(998, 'Bahia Solano', 25, NULL, NULL),
(999, 'Bagado', 25, NULL, NULL),
(1000, 'Union Panamericana', 25, NULL, NULL),
(1001, 'Rio Iro', 25, NULL, NULL),
(1002, 'Rio Quito', 25, NULL, NULL),
(1003, 'Novita', 25, NULL, NULL),
(1004, 'Nuqui', 25, NULL, NULL),
(1005, 'Atrato', 25, NULL, NULL),
(1006, 'Carmen del Darien', 25, NULL, NULL),
(1007, 'San Jose del Palmar', 25, NULL, NULL),
(1008, 'Sipi', 25, NULL, NULL),
(1009, 'Arauca', 26, NULL, NULL),
(1010, 'Tame', 26, NULL, NULL),
(1011, 'Saravena', 26, NULL, NULL),
(1012, 'Arauquita', 26, NULL, NULL),
(1013, 'Fortul', 26, NULL, NULL),
(1014, 'Puerto Rondon', 26, NULL, NULL),
(1015, 'Providencia', 27, NULL, NULL),
(1016, 'San Andres', 27, NULL, NULL),
(1017, 'San Jose del Guaviare', 28, NULL, NULL),
(1018, 'El Retorno', 28, NULL, NULL),
(1019, 'Miraflores', 28, NULL, NULL),
(1020, 'Calamar', 28, NULL, NULL),
(1021, 'Puerto Asis', 29, NULL, NULL),
(1022, 'Valle del Guamuez', 29, NULL, NULL),
(1023, 'Orito,Mocoa', 29, NULL, NULL),
(1024, 'San Miguel', 29, NULL, NULL),
(1025, 'Villa Garzon', 29, NULL, NULL),
(1026, 'Puerto Caicedo', 29, NULL, NULL),
(1027, 'Santiago', 29, NULL, NULL),
(1028, 'Colon', 29, NULL, NULL),
(1029, 'Leticia', 30, NULL, NULL),
(1030, 'Puerto Narino', 30, NULL, NULL),
(1031, 'El Encanto', 30, NULL, NULL),
(1032, 'Tarapaca', 30, NULL, NULL),
(1033, 'La Chorrera', 30, NULL, NULL),
(1034, 'Puerto Santander', 30, NULL, NULL),
(1035, 'Miriti-Parana', 30, NULL, NULL),
(1036, 'Puerto Arica', 30, NULL, NULL),
(1037, 'Puerto Alegria', 30, NULL, NULL),
(1038, 'La Victoria', 30, NULL, NULL),
(1039, 'Cumaribo', 31, NULL, NULL),
(1040, 'Puerto Carreno', 31, NULL, NULL),
(1041, 'La Primavera', 31, NULL, NULL),
(1042, 'Santa Rosalia', 31, NULL, NULL),
(1043, 'Mitu', 32, NULL, NULL),
(1044, 'Pacoa', 32, NULL, NULL),
(1045, 'Caruru', 32, NULL, NULL),
(1046, 'Yavarate', 32, NULL, NULL),
(1047, 'Taraira', 32, NULL, NULL),
(1048, 'Papunaua', 32, NULL, NULL),
(1049, 'Inirida', 33, NULL, NULL),
(1050, 'Barranco Minas', 33, NULL, NULL),
(1051, 'San Felipe', 33, NULL, NULL),
(1052, 'Morichal', 33, NULL, NULL),
(1053, 'La Guadalupe', 33, NULL, NULL),
(1054, 'Santander de Quilichao', 19, NULL, NULL),
(1055, 'Padilla', 19, NULL, NULL),
(1056, 'Armero', 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id` int(10) UNSIGNED NOT NULL,
  `iso` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_pais` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `iso`, `nombre_pais`, `created_at`, `updated_at`) VALUES
(1, 'CO', 'Colombia', NULL, NULL),
(2, 'AX', 'Islas Gland', NULL, NULL),
(3, 'AL', 'Albania', NULL, NULL),
(4, 'DE', 'Alemania', NULL, NULL),
(5, 'AD', 'Andorra', NULL, NULL),
(6, 'AO', 'Angola', NULL, NULL),
(7, 'AI', 'Anguilla', NULL, NULL),
(8, 'AQ', 'Antártida', NULL, NULL),
(9, 'AG', 'Antigua y Barbuda', NULL, NULL),
(10, 'AN', 'Antillas Holandesas', NULL, NULL),
(11, 'SA', 'Arabia Saudí', NULL, NULL),
(12, 'DZ', 'Argelia', NULL, NULL),
(13, 'AR', 'Argentina', NULL, NULL),
(14, 'AM', 'Armenia', NULL, NULL),
(15, 'AW', 'Aruba', NULL, NULL),
(16, 'AU', 'Australia', NULL, NULL),
(17, 'AT', 'Austria', NULL, NULL),
(18, 'AZ', 'Azerbaiyán', NULL, NULL),
(19, 'BS', 'Bahamas', NULL, NULL),
(20, 'BH', 'Bahréin', NULL, NULL),
(21, 'BD', 'Bangladesh', NULL, NULL),
(22, 'BB', 'Barbados', NULL, NULL),
(23, 'BY', 'Bielorrusia', NULL, NULL),
(24, 'BE', 'Bélgica', NULL, NULL),
(25, 'BZ', 'Belice', NULL, NULL),
(26, 'BJ', 'Benin', NULL, NULL),
(27, 'BM', 'Bermudas', NULL, NULL),
(28, 'BT', 'Bhután', NULL, NULL),
(29, 'BO', 'Bolivia', NULL, NULL),
(30, 'BA', 'Bosnia y Herzegovina', NULL, NULL),
(31, 'BW', 'Botsuana', NULL, NULL),
(32, 'BV', 'Isla Bouvet', NULL, NULL),
(33, 'BR', 'Brasil', NULL, NULL),
(34, 'BN', 'Brunéi', NULL, NULL),
(35, 'BG', 'Bulgaria', NULL, NULL),
(36, 'BF', 'Burkina Faso', NULL, NULL),
(37, 'BI', 'Burundi', NULL, NULL),
(38, 'CV', 'Cabo Verde', NULL, NULL),
(39, 'KY', 'Islas Caimán', NULL, NULL),
(40, 'KH', 'Camboya', NULL, NULL),
(41, 'CM', 'Camerún', NULL, NULL),
(42, 'CA', 'Canadá', NULL, NULL),
(43, 'CF', 'República Centroafricana', NULL, NULL),
(44, 'TD', 'Chad', NULL, NULL),
(45, 'CZ', 'República Checa', NULL, NULL),
(46, 'CL', 'Chile', NULL, NULL),
(47, 'CN', 'China', NULL, NULL),
(48, 'CY', 'Chipre', NULL, NULL),
(49, 'CX', 'Isla de Navidad', NULL, NULL),
(50, 'VA', 'Ciudad del Vaticano', NULL, NULL),
(51, 'CC', 'Islas Cocos', NULL, NULL),
(52, 'AF', 'Afganistán', NULL, NULL),
(53, 'KM', 'Comoras', NULL, NULL),
(54, 'CD', 'República Democrática del Congo', NULL, NULL),
(55, 'CG', 'Congo', NULL, NULL),
(56, 'CK', 'Islas Cook', NULL, NULL),
(57, 'KP', 'Corea del Norte', NULL, NULL),
(58, 'KR', 'Corea del Sur', NULL, NULL),
(59, 'CI', 'Costa de Marfil', NULL, NULL),
(60, 'CR', 'Costa Rica', NULL, NULL),
(61, 'HR', 'Croacia', NULL, NULL),
(62, 'CU', 'Cuba', NULL, NULL),
(63, 'DK', 'Dinamarca', NULL, NULL),
(64, 'DM', 'Dominica', NULL, NULL),
(65, 'DO', 'República Dominicana', NULL, NULL),
(66, 'EC', 'Ecuador', NULL, NULL),
(67, 'EG', 'Egipto', NULL, NULL),
(68, 'SV', 'El Salvador', NULL, NULL),
(69, 'AE', 'Emiratos Árabes Unidos', NULL, NULL),
(70, 'ER', 'Eritrea', NULL, NULL),
(71, 'SK', 'Eslovaquia', NULL, NULL),
(72, 'SI', 'Eslovenia', NULL, NULL),
(73, 'ES', 'España', NULL, NULL),
(74, 'UM', 'Islas ultramarinas de Estados Unidos', NULL, NULL),
(75, 'US', 'Estados Unidos', NULL, NULL),
(76, 'EE', 'Estonia', NULL, NULL),
(77, 'ET', 'Etiopía', NULL, NULL),
(78, 'FO', 'Islas Feroe', NULL, NULL),
(79, 'PH', 'Filipinas', NULL, NULL),
(80, 'FI', 'Finlandia', NULL, NULL),
(81, 'FJ', 'Fiyi', NULL, NULL),
(82, 'FR', 'Francia', NULL, NULL),
(83, 'GA', 'Gabón', NULL, NULL),
(84, 'GM', 'Gambia', NULL, NULL),
(85, 'GE', 'Georgia', NULL, NULL),
(86, 'GS', 'Islas Georgias del Sur y Sandwich del Sur', NULL, NULL),
(87, 'GH', 'Ghana', NULL, NULL),
(88, 'GI', 'Gibraltar', NULL, NULL),
(89, 'GD', 'Granada', NULL, NULL),
(90, 'GR', 'Grecia', NULL, NULL),
(91, 'GL', 'Groenlandia', NULL, NULL),
(92, 'GP', 'Guadalupe', NULL, NULL),
(93, 'GU', 'Guam', NULL, NULL),
(94, 'GT', 'Guatemala', NULL, NULL),
(95, 'GF', 'Guayana Francesa', NULL, NULL),
(96, 'GN', 'Guinea', NULL, NULL),
(97, 'GQ', 'Guinea Ecuatorial', NULL, NULL),
(98, 'GW', 'Guinea-Bissau', NULL, NULL),
(99, 'GY', 'Guyana', NULL, NULL),
(100, 'HT', 'Haití', NULL, NULL),
(101, 'HM', 'Islas Heard y McDonald', NULL, NULL),
(102, 'HN', 'Honduras', NULL, NULL),
(103, 'HK', 'Hong Kong', NULL, NULL),
(104, 'HU', 'Hungría', NULL, NULL),
(105, 'IN', 'India', NULL, NULL),
(106, 'ID', 'Indonesia', NULL, NULL),
(107, 'IR', 'Irán', NULL, NULL),
(108, 'IQ', 'Iraq', NULL, NULL),
(109, 'IE', 'Irlanda', NULL, NULL),
(110, 'IS', 'Islandia', NULL, NULL),
(111, 'IL', 'Israel', NULL, NULL),
(112, 'IT', 'Italia', NULL, NULL),
(113, 'JM', 'Jamaica', NULL, NULL),
(114, 'JP', 'Japón', NULL, NULL),
(115, 'JO', 'Jordania', NULL, NULL),
(116, 'KZ', 'Kazajstán', NULL, NULL),
(117, 'KE', 'Kenia', NULL, NULL),
(118, 'KG', 'Kirguistán', NULL, NULL),
(119, 'KI', 'Kiribati', NULL, NULL),
(120, 'KW', 'Kuwait', NULL, NULL),
(121, 'LA', 'Laos', NULL, NULL),
(122, 'LS', 'Lesotho', NULL, NULL),
(123, 'LV', 'Letonia', NULL, NULL),
(124, 'LB', 'Líbano', NULL, NULL),
(125, 'LR', 'Liberia', NULL, NULL),
(126, 'LY', 'Libia', NULL, NULL),
(127, 'LI', 'Liechtenstein', NULL, NULL),
(128, 'LT', 'Lituania', NULL, NULL),
(129, 'LU', 'Luxemburgo', NULL, NULL),
(130, 'MO', 'Macao', NULL, NULL),
(131, 'MK', 'ARY Macedonia', NULL, NULL),
(132, 'MG', 'Madagascar', NULL, NULL),
(133, 'MY', 'Malasia', NULL, NULL),
(134, 'MW', 'Malawi', NULL, NULL),
(135, 'MV', 'Maldivas', NULL, NULL),
(136, 'ML', 'Malí', NULL, NULL),
(137, 'MT', 'Malta', NULL, NULL),
(138, 'FK', 'Islas Malvinas', NULL, NULL),
(139, 'MP', 'Islas Marianas del Norte', NULL, NULL),
(140, 'MA', 'Marruecos', NULL, NULL),
(141, 'MH', 'Islas Marshall', NULL, NULL),
(142, 'MQ', 'Martinica', NULL, NULL),
(143, 'MU', 'Mauricio', NULL, NULL),
(144, 'MR', 'Mauritania', NULL, NULL),
(145, 'YT', 'Mayotte', NULL, NULL),
(146, 'MX', 'México', NULL, NULL),
(147, 'FM', 'Micronesia', NULL, NULL),
(148, 'MD', 'Moldavia', NULL, NULL),
(149, 'MC', 'Mónaco', NULL, NULL),
(150, 'MN', 'Mongolia', NULL, NULL),
(151, 'MS', 'Montserrat', NULL, NULL),
(152, 'MZ', 'Mozambique', NULL, NULL),
(153, 'MM', 'Myanmar', NULL, NULL),
(154, 'NA', 'Namibia', NULL, NULL),
(155, 'NR', 'Nauru', NULL, NULL),
(156, 'NP', 'Nepal', NULL, NULL),
(157, 'NI', 'Nicaragua', NULL, NULL),
(158, 'NE', 'Níger', NULL, NULL),
(159, 'NG', 'Nigeria', NULL, NULL),
(160, 'NU', 'Niue', NULL, NULL),
(161, 'NF', 'Isla Norfolk', NULL, NULL),
(162, 'NO', 'Noruega', NULL, NULL),
(163, 'NC', 'Nueva Caledonia', NULL, NULL),
(164, 'NZ', 'Nueva Zelanda', NULL, NULL),
(165, 'OM', 'Omán', NULL, NULL),
(166, 'NL', 'Países Bajos', NULL, NULL),
(167, 'PK', 'Pakistán', NULL, NULL),
(168, 'PW', 'Palau', NULL, NULL),
(169, 'PS', 'Palestina', NULL, NULL),
(170, 'PA', 'Panamá', NULL, NULL),
(171, 'PG', 'Papúa Nueva Guinea', NULL, NULL),
(172, 'PY', 'Paraguay', NULL, NULL),
(173, 'PE', 'Perú', NULL, NULL),
(174, 'PN', 'Islas Pitcairn', NULL, NULL),
(175, 'PF', 'Polinesia Francesa', NULL, NULL),
(176, 'PL', 'Polonia', NULL, NULL),
(177, 'PT', 'Portugal', NULL, NULL),
(178, 'PR', 'Puerto Rico', NULL, NULL),
(179, 'QA', 'Qatar', NULL, NULL),
(180, 'GB', 'Reino Unido', NULL, NULL),
(181, 'RE', 'Reunión', NULL, NULL),
(182, 'RW', 'Ruanda', NULL, NULL),
(183, 'RO', 'Rumania', NULL, NULL),
(184, 'RU', 'Rusia', NULL, NULL),
(185, 'EH', 'Sahara Occidental', NULL, NULL),
(186, 'SB', 'Islas Salomón', NULL, NULL),
(187, 'WS', 'Samoa', NULL, NULL),
(188, 'AS', 'Samoa Americana', NULL, NULL),
(189, 'KN', 'San Cristóbal y Nevis', NULL, NULL),
(190, 'SM', 'San Marino', NULL, NULL),
(191, 'PM', 'San Pedro y Miquelón', NULL, NULL),
(192, 'VC', 'San Vicente y las Granadinas', NULL, NULL),
(193, 'SH', 'Santa Helena', NULL, NULL),
(194, 'LC', 'Santa Lucía', NULL, NULL),
(195, 'ST', 'Santo Tomé y Príncipe', NULL, NULL),
(196, 'SN', 'Senegal', NULL, NULL),
(197, 'CS', 'Serbia y Montenegro', NULL, NULL),
(198, 'SC', 'Seychelles', NULL, NULL),
(199, 'SL', 'Sierra Leona', NULL, NULL),
(200, 'SG', 'Singapur', NULL, NULL),
(201, 'SY', 'Siria', NULL, NULL),
(202, 'SO', 'Somalia', NULL, NULL),
(203, 'LK', 'Sri Lanka', NULL, NULL),
(204, 'SZ', 'Suazilandia', NULL, NULL),
(205, 'ZA', 'Sudáfrica', NULL, NULL),
(206, 'SD', 'Sudán', NULL, NULL),
(207, 'SE', 'Suecia', NULL, NULL),
(208, 'CH', 'Suiza', NULL, NULL),
(209, 'SR', 'Surinam', NULL, NULL),
(210, 'SJ', 'Svalbard y Jan Mayen', NULL, NULL),
(211, 'TH', 'Tailandia', NULL, NULL),
(212, 'TW', 'Taiwán', NULL, NULL),
(213, 'TZ', 'Tanzania', NULL, NULL),
(214, 'TJ', 'Tayikistán', NULL, NULL),
(215, 'IO', 'Territorio Británico del Océano Índico', NULL, NULL),
(216, 'TF', 'Territorios Australes Franceses', NULL, NULL),
(217, 'TL', 'Timor Oriental', NULL, NULL),
(218, 'TG', 'Togo', NULL, NULL),
(219, 'TK', 'Tokelau', NULL, NULL),
(220, 'TO', 'Tonga', NULL, NULL),
(221, 'TT', 'Trinidad y Tobago', NULL, NULL),
(222, 'TN', 'Túnez', NULL, NULL),
(223, 'TC', 'Islas Turcas y Caicos', NULL, NULL),
(224, 'TM', 'Turkmenistán', NULL, NULL),
(225, 'TR', 'Turquía', NULL, NULL),
(226, 'TV', 'Tuvalu', NULL, NULL),
(227, 'UA', 'Ucrania', NULL, NULL),
(228, 'UG', 'Uganda', NULL, NULL),
(229, 'UY', 'Uruguay', NULL, NULL),
(230, 'UZ', 'Uzbekistán', NULL, NULL),
(231, 'VU', 'Vanuatu', NULL, NULL),
(232, 'VE', 'Venezuela', NULL, NULL),
(233, 'VN', 'Vietnam', NULL, NULL),
(234, 'VG', 'Islas Vírgenes Británicas', NULL, NULL),
(235, 'VI', 'Islas Vírgenes de los Estados Unidos', NULL, NULL),
(236, 'WF', 'Wallis y Futuna', NULL, NULL),
(237, 'YE', 'Yemen', NULL, NULL),
(238, 'DJ', 'Yibuti', NULL, NULL),
(239, 'ZM', 'Zambia', NULL, NULL),
(240, 'ZW', 'Zimbabue', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenantId` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `tenantId`, `created_at`, `updated_at`) VALUES
(1, 'ver-roles', 'ver-roles', 'ver-roles', '5467829281', NULL, NULL),
(2, 'crear-roles', 'crear-roles', 'crear-roles', '5467829281', NULL, NULL),
(3, 'editar-roles', 'eliminar-roles', 'eliminar-roles', '5467829281', NULL, NULL),
(4, 'eliminar-roles', 'eliminar-roles', 'eliminar-roles', '5467829281', NULL, NULL),
(5, 'generar-permisos', 'generar-permisos', 'generar-permisos', '5467829281', NULL, NULL),
(6, 'ver-usuarios', 'ver-usuarios', 'ver-usuarios', '5467829281', NULL, NULL),
(7, 'crear-usuarios', 'crear-usuarios', 'crear-usuarios', '5467829281', NULL, NULL),
(8, 'editar-usuarios', 'editar-usuarios', 'editar-usuarios', '5467829281', NULL, NULL),
(9, 'cambiar-password', 'cambiar-password', 'cambiar-password', '5467829281', NULL, NULL),
(10, 'eliminar-usuarios', 'eliminar-usuarios', 'eliminar-usuarios', '5467829281', NULL, NULL),
(11, 'ver-programas', 'ver-programas', 'ver-programas', '5467829281', NULL, NULL),
(12, 'crear-programas', 'crear-programas', 'crear-programas', '5467829281', NULL, NULL),
(13, 'editar-programas', 'editar-programas', 'editar-programas', '5467829281', NULL, NULL),
(14, 'eliminar-programas', 'eliminar-programas', 'eliminar-programas', '5467829281', NULL, NULL),
(15, 'ver-zonas', 'ver-zonas', 'ver-zonas', '5467829281', NULL, NULL),
(16, 'crear-zonas', 'crear-zonas', 'crear-zonas', '5467829281', NULL, NULL),
(17, 'editar-zonas', 'editar-zonas', 'editar-zonas', '5467829281', NULL, NULL),
(18, 'eliminar-zonas', 'eliminar-zonas', 'eliminar-zonas', '5467829281', NULL, NULL),
(19, 'ver-comunas', 'ver-comunas', 'ver-comunas', '5467829281', NULL, NULL),
(20, 'crear-comunas', 'crear-comunas', 'crear-comunas', '5467829281', NULL, NULL),
(21, 'editar-comunas', 'editar-comunas', 'editar-comunas', '5467829281', NULL, NULL),
(22, 'eliminar-comunas', 'eliminar-comunas', 'eliminar-comunas', '5467829281', NULL, NULL),
(23, 'ver-barrios', 'ver-barrios', 'ver-barrios', '5467829281', NULL, NULL),
(24, 'crear-barrios', 'crear-barrios', 'crear-barrios', '5467829281', NULL, NULL),
(25, 'editar-barrios', 'editar-barrios', 'editar-barrios', '5467829281', NULL, NULL),
(26, 'eliminar-barrios', 'eliminar-barrios', 'eliminar-barrios', '5467829281', NULL, NULL),
(27, 'ver-grados', 'ver-grados', 'ver-grados', '5467829281', NULL, NULL),
(28, 'crear-grados', 'crear-grados', 'crear-grados', '5467829281', NULL, NULL),
(29, 'editar-grados', 'editar-grados', 'editar-grados', '5467829281', NULL, NULL),
(30, 'eliminar-grados', 'eliminar-grados', 'eliminar-grados', '5467829281', NULL, NULL),
(31, 'ver-instituciones', 'ver-instituciones', 'ver-instituciones', '5467829281', NULL, NULL),
(32, 'crear-instituciones', 'crear-instituciones', 'crear-instituciones', '5467829281', NULL, NULL),
(33, 'editar-instituciones', 'editar-instituciones', 'editar-instituciones', '5467829281', NULL, NULL),
(34, 'eliminar-instituciones', 'eliminar-instituciones', 'eliminar-instituciones', '5467829281', NULL, NULL),
(35, 'ver-sedes', 'ver-sedes', 'ver-sedes', '5467829281', NULL, NULL),
(36, 'crear-sedes', 'crear-sedes', 'crear-sedes', '5467829281', NULL, NULL),
(37, 'editar-sedes', 'editar-sedes', 'editar-sedes', '5467829281', NULL, NULL),
(38, 'eliminar-sedes', 'eliminar-sedes', 'eliminar-sedes', '5467829281', NULL, NULL),
(39, 'ver-beneficiarios', 'ver-beneficiarios', 'ver-beneficiarios', '5467829281', NULL, NULL),
(40, 'crear-beneficiarios', 'crear-beneficiarios', 'crear-beneficiarios', '5467829281', NULL, NULL),
(41, 'editar-beneficiarios', 'editar-beneficiarios', 'editar-beneficiarios', '5467829281', NULL, NULL),
(42, 'eliminar-beneficiarios', 'eliminar-beneficiarios', 'eliminar-beneficiarios', '5467829281', NULL, NULL),
(43, 'ver-grupos', 'ver-grupos', 'ver-grupos', '5467829281', NULL, NULL),
(44, 'crear-grupos', 'crear-grupos', 'crear-grupos', '5467829281', NULL, NULL),
(45, 'editar-grupos', 'editar-grupos', 'editar-grupos', '5467829281', NULL, NULL),
(46, 'eliminar-grupos', 'eliminar-grupos', 'eliminar-grupos', '5467829281', NULL, NULL),
(47, 'crear-beneficiario-grupo', 'crear-beneficiario-grupo', 'crear-beneficiario-grupo', '5467829281', NULL, NULL),
(48, 'ver-georreferenciación', 'ver-georreferenciación', 'ver-georreferenciación', '5467829281', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(3, 1),
(3, 7),
(1, 8),
(2, 8),
(1, 9),
(3, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poblacional_beneficiarios`
--

CREATE TABLE `poblacional_beneficiarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `ficha_id` int(10) UNSIGNED NOT NULL,
  `grupo_pcs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas`
--

CREATE TABLE `programas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_programa` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion_programa` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `programas`
--

INSERT INTO `programas` (`id`, `nombre_programa`, `descripcion_programa`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Deporvida', 'El programa DEPORVIDA busca aprovechar al máximo el tiempo libre de los niños, adolescentes y jóvenes caleños desarrollando habilidades sociales orientadas hacia la promoción de la convivencia y prevención de violencia, brindándoles una variada oferta de 22 disciplinas deportivas para todos los gustos y preferencias bajo la implementación de un modelo pedagógico que utiliza el deporte como herramienta de transformación social.  \r\n\r\nSegún sus características las diferentes disciplinas deportivas que se ofrecen, se agrupan de la siguiente manera:\r\n\r\nDeportes de invasión: Futbol, Futbol sala, Baloncesto, Rugby\r\n\r\nDeportes de combate: Boxeo, Lucha, Taekwondo, Karate Do, Judo, Esgrima\r\n\r\nDeportes de tiempo y marca: Natación, Patinaje, Atletismo\r\n\r\nDeportes de arte y precisión: Gimnasia, Porrismo, Ajedrez, Baile deportivo\r\n\r\nDeportes de cancha dividida: Tenis de campo, Tenis de mesa, Voleibol\r\n\r\nDeportes de Campo y Bate: Beisbol\r\n\r\nDeporte adaptado: Discapacidad\r\n\r\nAdicionalmente el programa ofrece iniciación y formación en actividades conexas al deporte para que los niños tengan la posibilidad de disfrutar el deporte desde otro campo de acción como:\r\n\r\nJuzgamiento: Para aprender a ser árbitros\r\n\r\nReportería deportiva: Comenzando con instrucción en fotografía.\r\n\r\nEl programa se encuentra presente en 475 escenarios de las 22 comunas y 15 corregimientos del municipio.\r\n\r\nUsuarios\r\nEl programa atiende a 36.000 niños, niñas, adolescentes y jóvenes con edades entre los 6 y los 17 años, con los  siguientes beneficios:\r\n\r\nPermite a los niños utilizar su tiempo libre en actividades divertidas y enriquecedoras (pueden escoger entre 22 disciplinas deportivas diferentes, de acuerdo a sus preferencias y la cercanía del escenario deportivo donde se practican).\r\n\r\nEl programa brinda además la posibilidad de que los niños de las diferentes comunas y corregimientos interactúen entre si y se integren con el fin de afianzar los lazos de convivencia, amistad y sana competencia en los Festiv', 'programa/1512708658-deporvida1.png', '2017-12-07 21:32:40', '2018-01-08 05:09:49'),
(2, 'Vivir Sin Limites', 'DEPORVIDA se desarrolla en las 22 comunas y los 15 corregimientos de la ciudad de Santiago de Cali. Es totalmente gratuito, se atiende una población objetivo entre  6 a 17 años de edad. Estos escenarios deportivos son en los parques, unidades recreativas, canchas multiplex etc… haciendo recuperación de espacios  y zonas consideradas de alto riesgo, en la actualidad estos escenarios  son administrados por presidentes de J.A.C. la secretaria del deportes', 'programa/1512708771-vertigo.png', '2017-12-08 01:00:04', '2017-12-08 09:52:52'),
(3, 'Deporvida', 'DEPORVIDA se desarrolla en las 22 comunas y los 15 corregimientos de la ciudad de Santiago de Cali. Es totalmente gratuito, se atiende una población objetivo entre  6 a 17 años de edad. Estos escenarios deportivos son en los parques, unidades recreativas, canchas multiplex etc… haciendo recuperación de espacios  y zonas consideradas de alto riesgo, en la actualidad estos escenarios  son administrados por presidentes de J.A.C. la secretaria del deportes', 'programa/1512708859-deporte.png', '2017-12-08 01:09:02', '2017-12-08 09:54:19'),
(4, 'Vivir Sin Limites', 'DEPORVIDA se desarrolla en las 22 comunas y los 15 corregimientos de la ciudad de Santiago de Cali. Es totalmente gratuito, se atiende una población objetivo entre  6 a 17 años de edad. Estos escenarios deportivos son en los parques, unidades recreativas, canchas multiplex etc… haciendo recuperación de espacios  y zonas consideradas de alto riesgo, en la actualidad estos escenarios  son administrados por presidentes de J.A.C. la secretaria del deportes', 'programa/1512708902-deporvida1.png', '2017-12-08 01:09:18', '2017-12-08 09:55:02'),
(5, 'Deporvida', 'DEPORVIDA se desarrolla en las 22 comunas y los 15 corregimientos de la ciudad de Santiago de Cali. Es totalmente gratuito, se atiende una población objetivo entre  6 a 17 años de edad. Estos escenarios deportivos son en los parques, unidades recreativas, canchas multiplex etc… haciendo recuperación de espacios  y zonas consideradas de alto riesgo, en la actualidad estos escenarios  son administrados por presidentes de J.A.C. la secretaria del deportes', 'programa/1512708917-deporte.png', '2017-12-08 01:09:32', '2017-12-08 09:55:18'),
(6, 'Vivir Sin Limites', 'DEPORVIDA se desarrolla en las 22 comunas y los 15 corregimientos de la ciudad de Santiago de Cali. Es totalmente gratuito, se atiende una población objetivo entre  6 a 17 años de edad. Estos escenarios deportivos son en los parques, unidades recreativas, canchas multiplex etc… haciendo recuperación de espacios  y zonas consideradas de alto riesgo, en la actualidad estos escenarios  son administrados por presidentes de J.A.C. la secretaria del deportes', 'programa/1512708955-vertigo.png', '2017-12-08 01:09:45', '2017-12-08 09:55:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenantId` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `tenantId`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'ADMIN', 'admintrador sider', '5467829281', NULL, NULL),
(6, 'superadmin', 'superadmin', 'superadmin', '5467829281', '2017-12-07 05:49:56', '2017-12-07 05:49:56'),
(7, 'monitor', 'monitor', 'monitor', '5467829281', NULL, NULL),
(8, 'secretario', 'secretario', 'secretario', '5467829281', '2018-01-27 03:53:58', '2018-01-27 03:53:58'),
(9, 'VENDEDOR', 'VENDEDOR', 'VENDEDOR', '546782333', '2018-01-31 04:48:32', '2018-01-31 04:48:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 7, NULL, NULL),
(2, 6, 1, NULL, NULL),
(3, 7, 6, NULL, NULL),
(4, 8, 1, NULL, NULL),
(5, 9, 1, NULL, NULL),
(6, 10, 1, NULL, NULL),
(8, 12, 1, NULL, NULL),
(9, 14, 1, NULL, NULL),
(10, 18, 1, NULL, NULL),
(11, 19, 6, NULL, NULL),
(12, 20, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE `sedes` (
  `id` int(10) UNSIGNED NOT NULL,
  `institucion_id` int(10) UNSIGNED NOT NULL,
  `literal` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_sede` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono_sede` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo_sede` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sedes`
--

INSERT INTO `sedes` (`id`, `institucion_id`, `literal`, `nombre_sede`, `direccion`, `telefono_sede`, `correo_sede`) VALUES
(27, 8, '', 'REPUBLICA DEL BRASIL SEDE MENGA', 'CALLE 53 AN # 8-27', NULL, 'institucional@iesantaceciliacali.edu.co'),
(28, 26, '', 'CROYDON', 'Cra 16 No. 42-52', '411102', NULL),
(29, 26, '', 'RICARDO NIETO', 'CRA  17  calle 36 esquina', '411801', NULL),
(30, 32, '', 'ABRAHAM DOMINGUEZ', 'Cra 14 No 57-16', '489868', NULL),
(31, 36, '', 'JOSE MARIA VIVAS BALACAZAR', 'Calle 14  No. 48A- 32', '3075348', 'ie_vivasbalcazar@ievivasbalcazarcali.edu.co'),
(32, 72, '', 'I.T.I COMUNA 17', 'CRA 53 # 18 A-25', '3161021', 'ie_ticomuna17@yahoo.com'),
(33, 74, '', 'PORTETE DE TARQUI', 'calle 1A oeste carrera 73', '3231730', NULL),
(34, 74, '', 'ALVARO ESCOBAR NAVIA', 'CARRERA 73D No1B-65', '3232143', NULL),
(35, 74, '', 'TEMPLO DEL SABER', 'CALLE 2C OESTENo75-10', '3233551', NULL),
(36, 74, '', 'JUAN PABLO II', 'calle 1A  # 78-23', '3235783', 'institucional@iejuanpablocali.edu.co'),
(37, 45, '', 'LEON XIII', 'Calle 35 Cra. 29B', '3253255', NULL),
(38, 43, '', 'UNIDAD  LA INDEPENDENCIA', 'cra 39 #29c-30', '3262241', NULL),
(39, 45, '', 'SAN PEDRO', 'Cra 31 Dg #31-10', '3265413', NULL),
(40, 49, '', 'ANTONIO RICAURTE', 'Cll         26B  Cra 46', '3267965', NULL),
(41, 71, '', 'CRISTOBAL COLON', 'CLL 44 CRA 47A-16', '3274972', 'iecristobalcolon@iecristobalcoloncali.edu.co'),
(42, 69, '', 'PABLO NERUDA', 'CRA 39B No. 38-44', '3277066', NULL),
(43, 67, '', 'LUIS ENRIQUE MONTOYA', 'CARRERA 46 C No 38 A 50', '3277588', NULL),
(44, 67, '', 'MICAELA CASTRO BORRERO', 'CARRERA 46C  No 38A 39', '3280105', NULL),
(45, 70, '', 'ALEJANDRO MONTAÑO', 'CALLE 38 CRRA 41 H', '3281963', NULL),
(46, 67, '', 'RODRIGO LLOREDA CAICEDO', 'CALLE 38a No. 47A-45', '3283404', 'institucional@ierodrigolloredacali.edu.co'),
(47, 77, '', 'CELIMO RUEDA', 'CARRERA 73 No 3-94', '3309595', NULL),
(48, 77, '', 'BUENOS AIRES', 'CARRERA 73 No 3-94', '3309595', NULL),
(49, 73, '', 'LUIS CARLOS ROJAS GARCES', 'CARRERA  56  #  13F - 40', '3318530', NULL),
(50, 67, '', 'PRIMITIVO CRESPO', 'CALLE  41  #  51A - 30', '3320875', NULL),
(51, 75, '', 'MONSEÑOR LUIS ADRIANO DIAZ', 'CARRERA 94CNo2-131', '3325191', NULL),
(52, 76, '', 'RUFINO JOSE CUERVO', 'CALLE 4 No92-04', '3325710', NULL),
(53, 75, '', 'MAGDALENA ORTEGA DE NARIÑO.', 'CALLE 4 OESTE No94-56', '3326804', NULL),
(54, 75, '', 'LA ESPERANZA', 'CARRERA 94 No1A-71 OESTE', '3332019', 'admin@ielaesperanzacali.edu.co'),
(55, 49, '', 'JOSE MARIA VIVAS BALCAZAR', 'Cra      36    No.  26b 28', '3344663', NULL),
(56, 42, '', 'JARDIN INFANTIL N° 2', 'Cra      42A  No. 14B 15', '3344750', NULL),
(57, 36, '', 'SANTO DOMINGO', 'Cra. 47  No. 13C- 00', '3346130', NULL),
(58, 42, '', 'SANTA ELENA', 'Calle  23  No  32-79', '3347584', NULL),
(59, 39, '', 'PANAMERICANA', 'Calle 12 A  No. 48A- 12', '3348024', NULL),
(60, 36, '', 'FERNANDO VELASCO', 'Calle 23  No. 44A- 16', '3350110', NULL),
(61, 37, '', 'ANEXA JOAQUIN DE CAICEDO Y CUERO', 'Cra       36     No, 12C 00', '3351889', NULL),
(62, 43, '', 'BOYACA', 'calle 26 cra 33 esquina', '3352730', 'ie_boyaca@ieboyacacali.edu.co'),
(63, 43, '', 'SANTO DOMINGO SABIO', 'Cra 24a # 26b-64', '3355548', NULL),
(64, 37, '', 'GENERAL CARLOS ALBAN', 'Calle 18A # 24-65', '3359253', NULL),
(65, 45, '', 'C.I DE E. JOSE VICENTE CONCHA', 'Cra 30A # 30A27', '3366942', NULL),
(66, 44, '', 'SUSANA VINASCO', 'Cra 33A Calle 31', '3367289', NULL),
(67, 45, '', 'JULIO ARBOLEDA', 'Calle 35E #30-24', '3367292', NULL),
(68, 40, '', 'ISABEL DE CASTILLA', 'Cra. 33 No. 15-82', '3368548', NULL),
(69, 42, '', 'REPUBLICA DE COSTA RICA', 'Calle 14c # 41a-05', '3372822', NULL),
(70, 48, '', 'EL RECUERDO', 'Cra 27 # 29-25', '3374312', NULL),
(71, 40, '', 'HONORIO VILLEGAS', 'Cra. 35 A  No. 13A-20', '3374623', NULL),
(72, 71, '', 'BIENESTAR SOCIAL', 'CRA 47B # 45-74', '3377969', NULL),
(73, 68, '', 'CARLOS HOLMES TRUJILLO', 'CRA. 44 No. 43 ESQUINA', '3377970', 'ie_holmestrujillo@ieholmestrujillocali.edu.co'),
(74, 70, '', 'ANTONIO NARIÑO', 'CARRERA 40 A # 38 -38', '3382468', NULL),
(75, 63, '', 'ENRRIQUE OLAYA HERRERA', 'CALLE 51 No. 40A -08', '3384202', NULL),
(76, 63, '', 'CIUDAD CORDOBA', 'CALLE 50 No. 49C-100', '3384701', 'institucional@ieciudadcordobacali.edu.co'),
(77, 68, '', 'CRISTO MAESTRO', 'CALLE 44 CRA 41F', '3384737', NULL),
(78, 77, '', 'JOHN F. KENNEDY', 'CARRERA 68C  No 3-83', '3390161', NULL),
(79, 37, '', 'SAN ROQUE', 'Cra. 32A   No. 15A 59', '3904740', NULL),
(80, 77, '', 'GENERAL SANTANDER', 'CALLE 5 No70-150', '3911481', NULL),
(81, 68, '', 'POLICARPA SALAVARRIETA', 'CALLE 44 CRA 40 C', '4020247', NULL),
(82, 69, '', 'PRIMERO DE MAYO', 'Cr 37 Clle 39', '4020590', NULL),
(83, 61, '', 'PUERTA DEL SOL IV y V', 'CALLE 108 DIAG 28G', '4035485', NULL),
(84, 70, '', 'JOSE MARIA CARBONELL', 'CALLE 39 # 39 D 83', '4038046', NULL),
(85, 15, '', 'CECILIA MUÑOZ RICAURTE', 'Cra 8 N Calle 77 Floralia', '4041265', NULL),
(86, 68, '', 'LIZANDRO FRANKY', 'CALLE 46 CRA 40', '4043170', NULL),
(87, 64, '', 'ISAIAS H. IBARRA', 'Calle 112 - Cra 27 F', '4046838', NULL),
(88, 64, '', 'ELIAS SALAZAR GARCIA', 'Cra 26 I Calle 106', '4053780', NULL),
(89, 62, '', 'LOS NARANJOS', 'CRA. 26G 3 CALLE 78 ESQ.', '4225399', NULL),
(90, 64, '', 'GABRIELA MISTRAL', 'clle 95 cra 27D Esquina', '4226871', 'institucional@iegabrielamistralcali.edu.co'),
(91, 62, '', 'PUERTA DEL SOL', 'CALLE 84 No. 26C-04', '4238701', NULL),
(92, 65, '', 'CARLOS HOLGUIN MALLARINO', 'Cra 30a  Calle 55a', '4263307', 'institucional@ieholguinmallarinocali.edu.co'),
(93, 64, '', 'DAMASO ZAPATA', 'CALLE 92 No  98C-12', '4263451', NULL),
(94, 55, '', 'JESUS VILLAFAÑE FRANCO', 'CLL 72P #TRASV 72S', '4266119', NULL),
(95, 55, '', 'OMAIRA SANCHEZ', 'TRANS. 72W No,72-08', '4266898', NULL),
(96, 66, '', 'ALFONSO BONILLA NAAR', 'CLL 57 No 33-11', '4267044', NULL),
(97, 19, '', 'INMACULADA CONCEPCION', 'Calle 73A # 1A-14-21', '4329054', NULL),
(98, 19, '', 'TRES DE JULIO', 'Calle 70C # Carrera 1F', '4331059', NULL),
(99, 66, '', 'GABRIEL GARCIA MARQUEZ', 'CRA 29B N. 54-00', '4360011', 'institucional@iegabrielgmarquezcali.edu.co'),
(100, 65, '', 'NIÑO JESUS DE ATOCHA', 'Calle 83 # 28 E-3-05', '4363757', NULL),
(101, 65, '', 'MIGUEL DE POMBO', 'CALLE 92 No. 28D-4-13', '4363757', NULL),
(102, 66, '', 'JOSE RAMON BEJARANO', 'CRA 32 Q Calle 49 ESQUINA', '4364394', NULL),
(103, 59, '', 'MIGUEL CAMACHO PEREA', 'CRA. 28A No. 72F-09', '4369956', NULL),
(104, 58, '', 'RODRIGO LLOREDA CAICEDO', 'CRA. 30 No. 44A-21', '4374779', NULL),
(105, 57, '', 'SANTA ROSA', 'Calle 72x Cra 28- 3- 35', '4376659', 'institucional@iesantarosacali.edu.co'),
(106, 60, '', 'JUAN PABLO II', 'CRA.33 No. 42C- 09', '4376986', NULL),
(107, 50, '', 'JULIO CAICEDO Y TELLEZ', 'calle 59 N. 24E-40', '4380308', 'institucional@iejuliocaicedocali.edu.co'),
(108, 50, '', 'FRANCISCO DE PAULA SANTANDER', 'CRA 26  50-53', '4380430', NULL),
(109, 18, '', 'MARIO LLOREDA', 'Carrera 1D # 51-16', '4394705', NULL),
(110, 19, '', 'SAN JORGE', 'Carrera 1-i # 74-23', '4402626', NULL),
(111, 19, '', 'ATANASIO GIRARDOT', 'Calle 70B Carrera 1A3', '4404968', NULL),
(112, 19, '', 'SAN LUIS', 'Carrera 1B3 Calle 72', '4405926', NULL),
(113, 15, '', 'LAS AMERICAS', 'Cl 82 Cra 3 AN', '4408876', NULL),
(114, 19, '', 'LOS VENCEDORES', 'Carrera 1A4 # 72D-19', '4409924', NULL),
(115, 15, '', 'PABLO EMILIO CAICEDO', 'Carrera 5N Diagonal 7N-39', '4409947', NULL),
(116, 27, '', 'SAVEDRA GALINDO', 'Cra 17 F T 31-00', '4411578', NULL),
(117, 29, '', 'LAS AMERICAS', 'Cra. 12 38- 64', '4411728', 'administrador@ielasamericascali.edu.co'),
(118, 29, '', 'RAFAEL URIBE URIBE', 'Cra. 12  38 64', '4411728', NULL),
(119, 28, '', 'JUAN DE AMPUDIA', 'Cra 12  57-13', '4411750', 'institucionjuandeampudia@yahoo.es'),
(120, 14, '', 'SANTO TOMAS DE AQUINO', 'Calle 32 # 2N-11', '4412310', NULL),
(121, 48, '', 'GENERAL ALFREDO VASQUEZ COBO', 'DG 23B #T 25-25', '4412402', NULL),
(122, 50, '', 'BATALLA DE CARABOBO', 'Calle 51 # 16-00', '4412610', NULL),
(123, 30, '', 'SANTISIMA TRINIDAD', 'Calle 48 12 -84', '4413226', NULL),
(124, 29, '', 'GABRIEL MONTAÑO', 'CALLE 39 11C-00', '4415263', NULL),
(125, 27, '', 'EVARISTO GARCIA', 'CLL32 No.17-41', '4415856', 'institucional@ieevariascosplatacali.edu.co'),
(126, 14, '', 'JORGE ISAACS', 'Calle 30 No 5- 33', '4415858', NULL),
(127, 13, '', 'JOSE IGNACIO RENJIFO SALCEDO', 'Calle 41 # 5N-23', '4415933', NULL),
(128, 28, '', 'ONCE DE NOVIEMBRE', 'Cra 11 d 52 09', '4415958', NULL),
(129, 52, '', 'JUAN XX III', 'CALLE 46 # 28F31', '4416028', 'iejuan23@iejuan23cali.edu.co'),
(130, 52, '', 'BELLO HORIZONTE', 'CALLE 36A # 27A30', '4416028', NULL),
(131, 31, '', 'NUESTRA SEÑORA DE FATIMA', 'Cra 10 No 28-10', '4416363', NULL),
(132, 16, '', 'VEINTIUNO DE SEPTIEMBRE', 'Cra 8 Nor No 43 N -03', '4416463', NULL),
(133, 27, '', 'FERNANDO DE ARAGON', 'CLL 28 A  # DIG 20-00', '4416465', NULL),
(134, 26, '', 'ESTADO DE PUERTO RICO', 'Cra 17 No 33 D-10', '4416951', NULL),
(135, 30, '', 'VILLACOLOMBIA', 'CRA 12 E # 48-36', '4421486', 'IE_VILLACOLOMBIA@IEVILLACOLOMBIACALI.'),
(136, 54, '', 'EVA RIASCOS PLATA', 'T 25 DG 26-69', '4422177', 'institucional@ieevaristogarciacali.edu.co'),
(137, 59, '', 'VILLA BLANCA', 'DIAG. 72F No. 28A-05', '4423336', NULL),
(138, 11, '', 'JOSE ANTONIO GALAN', 'calle 41 # 3N-11', '4425387', 'ie_joseagalan@iejoseagalancali.edu.co'),
(139, 19, '', 'JORGE ELIECER GAITAN', 'Carrera 2C # 71-00', '4428886', NULL),
(140, 30, '', 'REPUBLICA DE COLOMBIA', 'Calle 53 12E 11', '4431712', NULL),
(141, 27, '', 'JOSE HILARIO LOPEZ', 'Calle 27 No 17G -19', '4433116', NULL),
(142, 32, '', 'CACIQUE GUATAVITA', 'Calle 54 No 15A-20', '4434235', NULL),
(143, 28, '', 'JARDIN INFANTIL NACIONAL No. 1', 'CLL 58 # 11B-48', '4437530', NULL),
(144, 50, '', 'JARDIN INFANTIL MI BOSQUESITO', 'CALLE 57 #24A 03', '4442237', NULL),
(145, 53, '', 'FRAY JOSE IGNACIO ORTIZ', 'CRA 26N 52-58', '4445597', NULL),
(146, 54, '', 'HERNANDO CAICEDO', 'T 29 # D27A-00', '4445988', NULL),
(147, 53, '', 'SATELITE RODRIGO LLOREDA CAICEDO', 'TRAS 30 # 28-123', '4452075', NULL),
(148, 10, '', 'MANUEL SANTIAGO VALLECILLA', 'Calle 43 B No 4 B-33', '4452193', NULL),
(149, 10, '', 'REPUBLICA DE ISRAEL', 'Cra 3 No 43-49', '4452425', 'pagador@ierdeisraelcali.edu.co'),
(150, 52, '', 'NIÑO JESUS DE PRAGA', 'CRA 28C #44-90', '4452548', NULL),
(151, 10, '', 'SAN  JOSE', 'CRA 2 # 40-00', '4452940', NULL),
(152, 29, '', 'NUESTRA SEÑORA DE LORETO', 'calle 39 carrera 8', '4458815', NULL),
(153, 52, '', 'JULIO RINCON', 'CALLE 70 CRA 28 EBIS', '4458897', NULL),
(154, 12, '', 'SAN VICENTE DE PAUL', 'Carrera 2B # 45-46', '4462009', NULL),
(155, 12, '', 'SAN PEDRO ALEJANDRINO', 'Carrera 4E # 46-04', '4462657', NULL),
(156, 12, '', 'CENDOE', 'Calle 44A # 4B-00', '4465988', NULL),
(157, 11, '', 'RAFAEL ZAMORANO', 'Carrera 1A # 45A-55', '4466532', NULL),
(158, 15, '', 'CAMILO TORRES', 'Cra 9 No 56BN 57', '4467856', NULL),
(159, 17, '', 'MARIANO OSPINA PEREZ', 'Calle 67 # Carrera 2', '4467997', NULL),
(160, 15, '', 'FRAY DOMINGO DE LAS CASAS', 'Cl 65 No 6N - 40', '4468353', NULL),
(161, 11, '', 'ANDRES SANIN (ya no existe)', 'Calle 46BN #4N-52', '4469447', NULL),
(162, 17, '', 'CELMIRA BUENO DE OREJUELA', 'Calle 62B # 1A9-250', '4470928', 'cbo133@gmail.com'),
(163, 15, '', 'CENTRO EDUCATIVO DEL NORTE', 'Cra 4 Note No 51AN-33', '4472878', NULL),
(164, 12, '', 'LA MERCED', 'Calle 47 # 4E-30', '4478582', 'institucional@ielamercedcali.edu.co'),
(165, 61, '', 'MONSEÑOR RAMON ARCILA', 'DG. 26I3 # T80A-18', '4483128', 'admin@ieramonarcilacali.edu.co'),
(166, 61, '', 'ALFONSO REYES ECHANDIA', 'DIAG. 26P-16  T105-04', '4483536', NULL),
(167, 61, '', 'RAUL SILVA HOLGUIN', 'DIAG. 26K T 83-24', '4483633', NULL),
(168, 51, '', 'ASTURIAS', 'CRA 24 B # 43-40', '4485469', NULL),
(169, 13, '', 'CRISTINA SERRANO DE LOURIDO', 'cra 5a N # 33 - 00', '4487516', NULL),
(170, 30, '', 'LICEO PARQUE INFANTIL ( T)', 'Cra. 12 E 49 50', '4489713', NULL),
(171, 14, '', 'SANTO TOMÁS(CASD )', 'Calle 34 # 3N-15', '4489805', 'IE_SANTOTOMAS@iesantotomascali.edu.co'),
(172, 26, '', 'BAJO PALACE', 'CLL 34 CRA 19 ESQUINA', '4489821', NULL),
(173, 26, '', 'MANUEL REBOLLEDO', 'Cra 17F Dg 23', '4489821', NULL),
(174, 18, '', 'MARIA PANESSO', 'Calle 46 C # 3-00', '4495861', NULL),
(175, 80, '', 'ANTONIA SANTOS', 'CRA 38C OESTE # 3A-00', '5133904', NULL),
(176, 80, '', 'SIMON BOLIVAR', 'CALLE 1 OESTE No 42 A 94', '5521244', NULL),
(177, 77, '', 'VEINTICINCO DE JULIO', 'CALLE 6A No59A51', '5526407', NULL),
(178, 80, '', 'LUIS ALBERTO ROSALES', 'CRA 51B CALLE 6H OESTE-2', '5546003', NULL),
(179, 9, '', 'SALVADOR IGLESIAS', 'Cl 2 A # 22- 70', '5560120', NULL),
(180, 9, '', 'MANUEL SINISTERRA PATIÑO', 'CRA 14 OESTE  CALLE 3', '5560314', NULL),
(181, 82, '', 'EUSTAQUIO PALACIOS', 'Cra 17 # 14-36', '5561100', NULL),
(182, 9, '', 'MARTIN RESTREPO MEJIA', 'Cra 22 oeste # 2-65', '5561227', NULL),
(183, 9, '', 'LOS CRISTALES', 'Calle 11C  OESTE# 24C-22', '5570673', NULL),
(184, 9, '', 'MARIA PERLAZA', 'Calle 5 Oeste # 18-02', '5572602', NULL),
(185, 34, '', 'J. I.  DIVINO SALVADOR', 'Cra 15  # 6-110', '5574175', NULL),
(186, 34, '', 'OLGA LUCIA LLOREDA', 'Cra 23A No 13B -11', '5574175', NULL),
(187, 34, '', 'REPUBLICA DEL PERU', 'Calle 9E No 23 -02', '5574790', NULL),
(188, 34, '', 'MARCO FIDEL SUAREZ', 'Cra 16 # 6-61', '5580059', NULL),
(189, 78, '', 'LA GRAN COLOMBIA (ESCUELA)', 'CARRERA 24 No 7-74', '5580066', NULL),
(190, 78, '', 'LA PRESENTACION', 'CARRERA 30NoD29-06', '5583141', NULL),
(191, 9, '', 'CLUB NOEL', 'CR 3 # 22-95', '5586557', NULL),
(192, 9, '', 'NORMAL SUPERIOR LOS FARALLONES', 'Cra 22Oeste # 2- 65', '5587300', 'institucional@ienormalsfarallonescali.edu.co'),
(193, 24, '', 'LOS PINOS', 'Calle 69 A  Cra 7 Bis', '6560607', NULL),
(194, 59, '', 'HUMBERTO JORDAN MAZUERA', 'CRA 26 I #  D71A-25', '6561290', 'ie_humbertojordan@iehumbertojordancali.edu.co'),
(195, 24, '', 'LAURA VICUÑA', 'Cra. 7 L bis  63 07', '6561532', NULL),
(196, 22, '', 'JOSE MARIA VILLEGAS', 'Calle 82 cra. 7D', '6562150', NULL),
(197, 23, '', 'UNI. VECINAL SIETE DE AGOSTO', 'Calle 71 No Dg 17-20', '6624862', NULL),
(198, 25, '', 'LOS FARALLONES', 'CRA 7J # 72-10', '6626864', NULL),
(199, 22, '', 'PRESBITERO ELOY VALENZUELA', 'Calle 74  No. 7Pbis 46', '6629908', NULL),
(200, 22, '', 'ALFONSO LOPEZ PUMAREJO', 'Calle 84 Cra. 7 A bis', '6629908', NULL),
(201, 24, '', 'CARLOS HOLGUIN SARDI', 'Cra. 7 d bisz  64 - 00', '6629915', NULL),
(202, 21, '', 'JUAN BAUTISTA DE LA SALLE', 'CLL 74 # 9-19', '6629944', 'ie_juanbautista@iejuanbautistacali.edu.co'),
(203, 23, '', 'ANA MARIA VERNAZA', 'Calle 72 B No. 8B- 32', '6629959', NULL),
(204, 25, '', 'PURIFICACION TRUJILLO', 'Calle 73 Cra 7 bis', '6629967', NULL),
(205, 21, '', 'MANUEL MARIA MALLARINO', 'Cra. 9A  No. 78-14', '6629986', NULL),
(206, 25, '', 'RAFAEL POMBO', 'Cra. 7 R bis 72 124', '6631112', NULL),
(207, 23, '', 'ELEAZAR LIBREROS', 'CLL 72 B 8 b-32', '6632148', NULL),
(208, 56, '', 'BARTOLOME LOBOGUERRERO', 'clle 71 #26e-25', '6632481', 'admin@iebartolomeloboguerrerocali.edu.co'),
(209, 56, '', 'ENRIQUE OLAYA HERRERA', 'Calle 71 No. 25A-15', '6633288', NULL),
(210, 8, '', 'REPUBLICA DEL BRASIL', 'Cl 43N # 7N - 03', '6646107', 'institucional@iesantaceciliacali.edu.co'),
(211, 6, '', 'BRISAS DE LOS ALAMOS', 'Av 2 BN Calle 72N', '6650489', 'institucional@iesantaceciliacali.edu.co'),
(212, 7, '', 'REPUBLICA DE FRANCIA', 'Cl 62N # 2BN -00', '6651433', 'institucional@iesantaceciliacali.edu.co'),
(213, 25, '', 'CENTRAL PROVIVIENDA', 'CLL 72 A # 7C BIS 10', '6699983', NULL),
(214, 31, '', 'BENJAMIN HERRERA', 'Calle 26 No 12-34', '6812489', NULL),
(215, 39, '', 'FRANCISCO MONTES IDROBO', 'Calle 12  No.  46- 40', '6834712', NULL),
(216, 82, '', 'EL PILOTO', 'Cra 4 Norte No 24-40', '8801914', NULL),
(217, 35, '', 'NUESTRA SRA DE LOS REMEDIOS', 'Cra 17d # 18-46', '8809287', NULL),
(218, 33, '', 'JOSE MARIA CORDOBA', 'Calle 18 # 8a-15', '8818662', NULL),
(219, 82, '', 'REPUBLICA DE MEXICO', 'Calle 20 No 5-65', '8818718', NULL),
(220, 4, '', 'MARICE SINISTERRA', 'CL 30 BIS OESTE # 4A-00', '8829009', 'colegiojoseholguingarces@iejosehgarcescali.edu.'),
(221, 4, '', 'JOSÉ ACEVEDO Y GOMEZ', 'AV 5  OESTE # 30-164', '8829095', 'colegiojoseholguingarces@iejosehgarcescali.edu.'),
(222, 3, '', 'ALEJANDRO CABAL POMBO', 'Cl 26 Oeste No 8-17', '8829099', 'institucional@ieisaiasgamboacali.edu.co'),
(223, 3, '', 'ISAIAS GAMBOA', 'Av 4 Oeste No 12--05', '8829377', 'institucional@ieisaiasgamboacali.edu.co'),
(224, 4, '', 'ANA MARIA  LLOREDA', 'CALLE 26 -AV 4 OESTE', '8829555', 'colegiojoseholguingarces@iejosehgarcescali.edu.'),
(225, 82, '', 'LUIS CARLOS PEÑA', 'Cale 7 No 14-36', '8834918', NULL),
(226, 33, '', 'SEBASTIAN DE BELALCAZAR', 'Calle 17 No 14 -57', '8835409', NULL),
(227, 82, '', 'SANTIAGO DE CALI', 'Calle 7 No 7-74', '8841307', NULL),
(228, 33, '', 'POLICARPA SALAVARRIETA', 'Carrera 11 # 22a-30', '8853626', NULL),
(229, 82, '', 'SANTA LIBRADA', 'Cl 7 # 14A - 106', '8858838', 'admin@iesantalibradacali.edu.co'),
(230, 9, '', 'DIVINA PROVIDENCIA', 'CLL 4 OESTE  CRA 3 ESQ', '8933097', NULL),
(231, 82, '', 'CARLOS A. SARDI GARCES', 'Cra 5 # 2-69', '8936880', NULL),
(232, 4, '', 'VILLA DEL MAR  8', 'Av. 8 Oeste # 30C-40', '8941908', 'colegiojoseholguingarces@iejosehgarcescali.edu.'),
(233, 3, '', 'INMACULADA', 'CL 10 OESTE # 5-45', '8944201', 'institucional@ieisaiasgamboacali.edu.co'),
(234, 5, '', 'CECILIA CABALLERO DE LOPEZ', 'Av. 5 Oeste No 34-100', '8944316', 'institucional@ieluisfcaicedocali.edu.co'),
(235, 5, '', 'LUIS FERNANDO CAICEDO', 'Av. 5 Oeste No 47A  04', '8944361', 'institucional@ieluisfcaicedocali.edu.co'),
(236, 4, '', 'ULPIANO LLOREDA', 'AV 4B OESTE # 25-08', '8944826', 'colegiojoseholguingarces@iejosehgarcescali.edu.'),
(237, 50, '', 'ESTHER ZORRILLA', 'CALLE 59 #  24-00', '44388583', NULL),
(238, 38, '', 'NORMAL. SUPERIOR SANTIAGO DE CALI', 'CRA 33 A  No.12- 60', '336479798', 'secretariaacademica@iensantiagodecalicali.edu.c'),
(239, 18, '', 'SIMON RODRIGUEZ', 'CARRERA 1D BIS # 49-98', '446231134', 'institucional@iesimonrodriguezcali.edu.co'),
(240, 9, '', 'FRANCISCO JOSE DE CALDAS', 'Cra 4 Oeste # 12A - 59', '893189101', NULL),
(241, 44, '', 'VILLA DEL SUR', 'Calle 30A # 41E 99', '3369561', 'institucional@ievilladelsurcali.edu.co'),
(242, 22, '', 'VICENTE BORRERO COSTA', 'Calle 76  Kra 7S - 00 esquina', '6565620', NULL),
(243, 22, '', 'CARLOS VILLAFAÑE', 'Cra. 7 bis Calle 81', '-2146826273', NULL),
(244, 13, '', 'VEINTE DE JULIO', 'cra 5a N # 33 - 01', '4444382', 'ie_veintedejulio@ieveintedejuliocali.edu.co'),
(245, 23, '', 'SIETE DE AGOSTO', 'Calle 72 No 11C-27', '6629458', 'ie_sietedeagosto@iesietedeagostocali.edu.co'),
(246, 14, '', 'ADAN CORDOVEZ CORDOBA', 'Cra 5 A No 34 - 31', '4416455', NULL),
(247, 14, '', 'MANUELA BELTRAN', 'Cra 2 No 34-23', '4411541', NULL),
(248, 57, '', 'JOSE CARDONA HOYOS', 'CALLE 72 N  No. 28-130', '4374631', NULL),
(249, 83, '', 'SANTA CECILIA', 'Calle 61A N # 26GN - 62', '6653521', 'institucional@iesantaceciliacali.edu.co'),
(250, 26, '', 'SANTA  FE', 'CLL 34 No. 17B-41', '4434820', NULL),
(251, 33, '', 'REPUBLICA DE ARGENTINA', 'CRA 11D No. 23-49', '8818619', 'ie_rargentina@ierargentinacali.edu.co'),
(252, 39, '', 'RAFAEL NAVIA VARON', 'Calle 11 No. 46-40', '5529902', 'institucional@ienaviavaroncali.edu.co'),
(253, 77, '', 'POLITECNICO MUNICIPAL DE CALI', 'CARRERA 62 No2-28', '5523616', 'institucional@iepolitecnicocali.edu.co'),
(254, 19, '', 'PEDRO ANTONIO MOLINA', 'Carrera 1A10 # 71-00', '4405332', 'institucional@iepedroamolinacali.edu.co'),
(255, 51, '', 'MARICE  SINISTERRA', 'Calle  39 # 25 A -43', '4436501', 'institucional@iemaricesinisterracali.edu.co'),
(256, 51, '', 'FENALCO ASTURIAS', 'CALLE 44 CRA 25A', '-2146826273', NULL),
(257, 24, '', 'MANUEL MARIA MALLARINO', 'carrea 7  L bis 63-00', '6630083', 'institucional@iemanuelmallarinocali.edu.co'),
(258, 58, '', 'LUZ HAYDEE GUERRERO', 'CRA 28E 2 #72S-02', '4371539', 'ieluzhayde@ieluzhaydeecali.edu.co'),
(259, 78, '', 'LICEO DEPARTAMENTAL', 'CARRERA 37A No8-38', '5141725', 'administrador@ieliceodepartamentalcali.edu.co'),
(260, 69, '', 'LIBARDO MADRID VALDERRAMA', 'CRA 41 H No 39-73', '-2146826273', 'institucional@ielibardomadridcali.edu.co'),
(261, 69, '', 'ANGELICA SIERRA', 'CLL40 CRA 41 F ESQUINA', '-2146826273', NULL),
(262, 62, '', 'LA ANUNCIACION', 'CRA 26A#74-00', '-2146826273', 'institucional@ielaanunciacioncali.edu.co'),
(263, 80, '', 'JUANA DE CAICEDO Y CUERO', 'CALLE 1 OESTE No50-85', '5512344', 'institucional@iejuanadecaicedocali.edu.co'),
(264, 80, '', 'MULTIPROPOSITO', 'CALLE 56 OESTE N. 7-190', '5135947', 'institucional@iemultipropositocali.edu.co'),
(265, 80, '', 'JORGE ELIECER GONZALEZ RUBIO', 'CALLE 8 OESTE No 52-16', '5525068', NULL),
(266, 80, '', 'REPUBLICA DE PANAMA', 'DIAG 48 No 12-06 OESTE', '-2146826273', NULL),
(267, 52, '', 'CIUDAD DE CALI', 'CALLE 46 # 28F31', '-2146826273', NULL),
(268, 52, '', 'SAN BUENAVENTURA', 'DG 29B # 29-30', '-2146826273', NULL),
(269, 40, '', 'JOSE MARIA CARBONELL', 'Calle 13  No. 32-88', '3261525', 'institucional@iejosemcarbonellcali.edu.co'),
(270, 31, '', 'JOSE MANUEL SAAVEDRA GALINDO', 'CRA 11A NO. 28-25', '4431819', 'ie_saavedragalindo@iesaavedragalindocali.edu.c'),
(271, 4, '', 'JOSE HOLGUIN GARCES', 'Av. 4 Oeste No 23-108', '8942322', 'colegiojoseholguingarces@iejosehgarcescali.edu.'),
(272, 37, '', 'JOAQUIN DE CAICEDO Y CUERO', 'Cra 35 N. 15-33', '3352201', 'rectoria@ieluisfcaicedocali.edu.co'),
(273, 37, '', 'SATE JOAQUIN DE CAICEDO Y CUERO\nCAMILO TORRES', 'Cra 24 3 10a-98', '3352201', NULL),
(274, 3, '', 'JOSE CELESTINO MUTIS', 'Av. 7 B Oeste Cl 18-02', '8829099', 'institucional@ieisaiasgamboacali.edu.co'),
(275, 15, '', 'INEM JORGE ISAACS', 'cra 5n # 61-142', '4470128', 'rectoria@ieinemcali.edu.co'),
(276, 59, '', 'CHARCO AZUL', 'DIAG.70B1 No. 22B Bis-', '6635160', NULL),
(277, 53, '', 'HERNANDO NAVIA VARON', 'CRA 26 P # 50 39', '4438995', 'pag_hernandonavia@iehernandonaviacali.edu.co'),
(278, 16, '', 'GUILLERMO VALENCIA', 'Cra 7 Norte No 45A08', '4465000', 'sedepresbiten@gmail.com'),
(279, 16, '', 'ABSALON FERNANDEZDE SOTO', 'Cra 8N # 46BN -11', '821320', NULL),
(280, 16, '', 'PRESBITERO ANGEL PIEDRAHITA', 'Cra 8 norte No 51N 35', '471491', NULL),
(281, 45, '', 'FRANCISCO DE PAULA SANTANDER', 'Cl 27  # 31 A 60', '3352352', 'institucional@iefranciscopsantandercali.edu.co'),
(282, 54, '', 'ALFONSO BARBERENA', 'CALLE 33C CRA 25 BIS', NULL, NULL),
(283, 60, '', 'EL DIAMANTE', 'CRA.31 No. 41-00', '4269327', NULL),
(284, 70, '', 'DONALD RODRIGO TAFUR', 'CRA 43B No 40-11', NULL, 'iedonaldrodrigo@iedonaldrodrigocali.edu.co'),
(285, 70, '', 'FRANCISCO J. RUIZ', 'CALLE 38 # 43 B 16', NULL, NULL),
(286, 46, '', 'DIEZ DE MAYO', 'Cra. 25A  # 26 A 13', '3250556', 'institucional@iediezdemayocali.edu.co'),
(287, 46, '', 'REPUBLICA DE ITALIA', 'Cra. 24 Calle 26', NULL, NULL),
(288, 71, '', 'ANTONIA SANTOS', 'CRA 43 # 43-04', NULL, NULL),
(289, 71, '', 'JOSE JOAQUIN JARAMILLO', 'CRA 44A # 44-64', NULL, NULL),
(290, 79, '', 'CIUDADELA DESEPAZ', 'CARRERA 23 No 120G- 16', '4200125', 'ie_ciudadeladesepaz@ieciudadeladesepazcali.ed'),
(291, 47, '', 'CIUDAD MODELO', 'Cra 40B  Calle 31C', '3917392', 'ieciudadmodelo@ieciudadmodelocali.edu.co'),
(292, 47, '', 'LA PRIMAVERA', 'Cra 35  # 34C 21', '3341837', NULL),
(293, 48, '', 'CIUDAD DE CALI', 'calle 30 N. 25-00', '-2146826273', 'institucional@ieciudaddecalicali.edu.co'),
(294, 42, '', 'CARLOS HOLGUIN LLOREDA', 'CRA 40 No. 18-85', '3344750', 'institucional@iecarlosholguinlloredacali.edu.co'),
(295, 34, '', 'ANTONIO JOSE CAMACHO', 'CRA 16 No. 12-00', '5586763', 'institucional@ieantoniojcamachocali.edu.co'),
(296, 76, '', 'ALVARO ECHEVERRI PEREA', 'Calle 4 No 92-04', NULL, 'institucional@iealvaroecheverricali.edu.co'),
(297, 76, '', 'LUIS EDUARDO NIETO CABALLERO', 'CARRERA 92 No4-119', '3324786', NULL),
(298, 76, '', 'EDUARDO RIASCOS GRUESO', 'CARRERA 93 OE No2A-00', '3331918', NULL),
(299, 35, '', 'ALFREDO VASQUEZ COBO', 'CLL 15A No.22A37', '8897615', 'institucional@ieavasquezcobocali.edu.co'),
(300, 35, '', 'REPUBLICA DEL ECUADOR', 'Calle 16 No 18A -54', '8858661', NULL),
(301, 25, '', 'ALFONSO LOPEZ PUMAREJO', 'carrera 7s bis calle 72 y 73', '6621330', 'ie_alfonsopumarejo@iealfonsopumarejocali.edu.c'),
(302, 32, '', 'ALBERTO CARVAJAL BORRERO', 'CRA 14 CLL58-00', '4437206', 'institucional@iealbertocarvajalcali.edu.co'),
(303, 49, '', 'AGUSTIN NIETO CABALLERO', 'Cra      37    No.  26C- 51', '3352344', 'institucional@ieagustinncaballerocali.edu.co'),
(304, 49, '', 'MARINO RENGIFO SALCEDO', 'Cll         26e No.  44   00', '3367287', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cm_ficha`
--

CREATE TABLE `tbl_cm_ficha` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_persona_beneficiario` int(10) UNSIGNED NOT NULL,
  `grupo_id` int(10) UNSIGNED DEFAULT NULL,
  `fecha_inscripcion` date NOT NULL,
  `no_ficha` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modalidad` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `punto_atencion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hijos_beneficiario` int(11) NOT NULL,
  `cantidad_hijos_beneficiario` int(11) DEFAULT NULL,
  `ocupacion_beneficiario` int(11) NOT NULL,
  `otra_ocupacion_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `escolaridad_id` int(11) NOT NULL,
  `cultura_beneficiario` int(11) NOT NULL,
  `otra_cultura_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discapacidad_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discapacidad_select_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otra_discapacidad_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enfermedad_permanente_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enfermedad_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medicamentos_permanente_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `medicamentos_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seguridad_social_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salud_sgsss_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_seguridad_beneficiario` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_persona_acudiente` int(11) NOT NULL,
  `parentesco_acudiente` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otro_parentesco_acudiente` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenantId` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cm_grados`
--

CREATE TABLE `tbl_cm_grados` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_grado` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_cm_grados`
--

INSERT INTO `tbl_cm_grados` (`id`, `nombre_grado`, `created_at`, `updated_at`) VALUES
(1, 'primero', '2018-01-25 16:22:39', '2018-01-25 16:22:39'),
(2, 'segundo', '2018-01-25 16:22:52', '2018-01-25 16:22:52'),
(3, 'TERCERO', '2018-01-25 17:45:56', '2018-01-25 17:45:56'),
(4, 'CUARTO', '2018-01-25 17:46:04', '2018-01-25 17:46:04'),
(5, 'QUINTO', '2018-01-25 17:46:09', '2018-01-25 17:46:09'),
(6, 'SEXTO', '2018-01-25 17:46:15', '2018-01-25 17:46:15'),
(7, 'SEPTIMO', '2018-01-25 17:46:25', '2018-01-25 17:46:25'),
(8, 'OCTAVO', '2018-01-25 17:46:32', '2018-01-25 17:46:32'),
(9, 'NOVENO', '2018-01-25 17:46:38', '2018-01-25 17:46:38'),
(10, 'DECIMO', '2018-01-25 17:46:45', '2018-01-25 17:46:45'),
(11, 'ONCE', '2018-01-25 17:46:51', '2018-01-25 17:46:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_ficha`
--

CREATE TABLE `tbl_dv_ficha` (
  `id_ficha` int(10) UNSIGNED NOT NULL,
  `anno` date NOT NULL,
  `fecha_registro` date NOT NULL,
  `id_persona_beneficiario` int(10) UNSIGNED NOT NULL,
  `id_escolaridad_nivel` int(10) UNSIGNED NOT NULL,
  `id_escolaridad_estado` int(10) UNSIGNED NOT NULL,
  `id_etnia` int(10) UNSIGNED NOT NULL,
  `id_persona_acudiente` int(10) UNSIGNED NOT NULL,
  `id_persona_acudiente_parentesco` int(10) UNSIGNED NOT NULL,
  `id_persona_vive_con_parentesco` int(10) UNSIGNED NOT NULL,
  `enfermedad_padece_si` enum('si','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `enfermedad_padece_nombre` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `medicamentos_toma_si` enum('si','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `medicamentos_toma_nombre` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salud_afiliado` enum('si','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_salud_regimen` int(10) UNSIGNED NOT NULL,
  `id_eps` int(10) UNSIGNED NOT NULL,
  `participado_antes_si` enum('si','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `participado_antes_meses` int(11) NOT NULL,
  `participado_antes_annos` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_persona_x_discapacidad`
--

CREATE TABLE `tbl_dv_persona_x_discapacidad` (
  `id_persona_x_discapacidad` int(10) UNSIGNED NOT NULL,
  `id_persona` int(10) UNSIGNED NOT NULL,
  `id_discapacidad` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dv_persona_x_ocupacion`
--

CREATE TABLE `tbl_dv_persona_x_ocupacion` (
  `tbl_persona_x_ocupacion` int(10) UNSIGNED NOT NULL,
  `id_persona` int(10) UNSIGNED NOT NULL,
  `id_ocupacion` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_asistencias`
--

CREATE TABLE `tbl_gen_asistencias` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha_asistencia` date NOT NULL,
  `grupo_id` int(10) UNSIGNED DEFAULT NULL,
  `ficha_id` int(10) UNSIGNED DEFAULT NULL,
  `observaciones` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asistencia` tinyint(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_corregimientos`
--

CREATE TABLE `tbl_gen_corregimientos` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_gen_corregimientos`
--

INSERT INTO `tbl_gen_corregimientos` (`id`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'la minga', NULL, NULL),
(2, 'villa nueva', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_discapacidad`
--

CREATE TABLE `tbl_gen_discapacidad` (
  `id_discapacidad` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_documento_tipo`
--

CREATE TABLE `tbl_gen_documento_tipo` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion_2` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_gen_documento_tipo`
--

INSERT INTO `tbl_gen_documento_tipo` (`id`, `descripcion`, `descripcion_2`, `created_at`, `updated_at`) VALUES
(1, 'Cédula de ciudadanía', 'CC', NULL, NULL),
(2, 'Registro civil', 'RC', NULL, NULL),
(3, 'Tarjeta de identidad', 'TI', NULL, NULL),
(4, 'Cédula de extrangería', 'CE', NULL, NULL),
(5, 'Pasaporte', 'PS', NULL, NULL),
(6, 'Sin información', 'NN', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_eps`
--

CREATE TABLE `tbl_gen_eps` (
  `id_eps` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_escolaridad_estado`
--

CREATE TABLE `tbl_gen_escolaridad_estado` (
  `id_escolaridad_estado` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_escolaridad_nivel`
--

CREATE TABLE `tbl_gen_escolaridad_nivel` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_gen_escolaridad_nivel`
--

INSERT INTO `tbl_gen_escolaridad_nivel` (`id`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Educación inicial', NULL, NULL),
(2, 'Preescolar', NULL, NULL),
(3, 'Primaria', NULL, NULL),
(4, 'Secundaria', NULL, NULL),
(5, 'Técnico', NULL, NULL),
(6, 'Tecnológico', NULL, NULL),
(7, 'Universitario', NULL, NULL),
(8, 'Posgrado', NULL, NULL),
(9, 'Ninguno', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_estado_civil`
--

CREATE TABLE `tbl_gen_estado_civil` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_gen_estado_civil`
--

INSERT INTO `tbl_gen_estado_civil` (`id`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Casado', NULL, NULL),
(2, 'Soltero', NULL, NULL),
(3, 'Unión Libre', NULL, NULL),
(4, 'Viudo', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_etnia`
--

CREATE TABLE `tbl_gen_etnia` (
  `id_etnia` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_grupo_poblacional`
--

CREATE TABLE `tbl_gen_grupo_poblacional` (
  `id_grupo_poblacional` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_ocupacion`
--

CREATE TABLE `tbl_gen_ocupacion` (
  `id_ocupacion` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` enum('si','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_parentesco`
--

CREATE TABLE `tbl_gen_parentesco` (
  `id_persona_parentesco` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_persona`
--

CREATE TABLE `tbl_gen_persona` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_primero` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_segundo` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_primero` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_segundo` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_documento_tipo` int(10) UNSIGNED NOT NULL,
  `documento` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexo` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono_fijo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono_movil` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo_electronico` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_procedencia_pais` int(10) UNSIGNED DEFAULT NULL,
  `id_procedencia_departamento` int(10) UNSIGNED DEFAULT NULL,
  `id_procedencia_municipio` int(10) UNSIGNED DEFAULT NULL,
  `id_residencia_corregimiento` int(10) UNSIGNED DEFAULT NULL,
  `id_residencia_vereda` int(10) UNSIGNED DEFAULT NULL,
  `id_residencia_barrio` int(10) UNSIGNED DEFAULT NULL,
  `residencia_direccion` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `residencia_estrato` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sangre_tipo` enum('O+','O-','A+','A-','B+','B-','AB+','AB-') COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_estado_civil` int(10) UNSIGNED DEFAULT NULL,
  `tenantId` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_gen_persona`
--

INSERT INTO `tbl_gen_persona` (`id`, `nombre_primero`, `nombre_segundo`, `apellido_primero`, `apellido_segundo`, `id_documento_tipo`, `documento`, `sexo`, `fecha_nacimiento`, `telefono_fijo`, `telefono_movil`, `correo_electronico`, `id_procedencia_pais`, `id_procedencia_departamento`, `id_procedencia_municipio`, `id_residencia_corregimiento`, `id_residencia_vereda`, `id_residencia_barrio`, `residencia_direccion`, `residencia_estrato`, `sangre_tipo`, `id_estado_civil`, `tenantId`) VALUES
(1, 'hjljk', 'hjhkjhk', 'kjhk', 'hkjhk', 1, '2333', '1', '2018-01-09', '87897', '89798798', 'jhjkh@gmail.com', 1, 3, 131, 1, 1, 44, 'jkhjh', '6', 'O-', 1, ''),
(2, 'llll', 'jkhkjh', 'kjhkjh', 'kjhjkh', 1, '865675', '1', '2018-01-01', '87897', '78678678', 'jkhkjh@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(3, 'manuelito2', 'jj', 'jj', 'jj', 2, '908908', '1', '2018-01-08', '878', '88', 'jbkkkj@gmail.com', 1, 3, 131, 1, 1, 44, 'jkjhj', '7', 'O+', 1, ''),
(4, 'andres', 's', 's', 's', 1, '87987', '1', '2018-01-08', '8979', '687', 'mnlkkjl@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(5, 'johan', 'andres', 'salazar', 'burbano', 1, '1727273737', '2', '2018-01-26', '6267267', '65765765', 'johan123@gmail.com', 1, 3, 1, 1, 1, 44, 'calle 12344', '2', 'O+', 1, ''),
(6, 'andres', 'daniel', 'sanchez', 'burgos', 1, '9289289383', '1', '2018-01-26', '267267267', '765675765', 'andres@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(7, 'jkhj', 'jkhkjh', 'jkhjkh', 'jkhjkh', 2, '87897', '1', '2018-01-03', '987987', '8978798', 'jhkjh@gmail.com', 1, 3, 131, 1, 1, 44, 'jkhkjjhk', '3', 'O+', 2, ''),
(8, 'hkjjhjk', 'kjhhjjk', 'hjkjhjk', 'jhkjhkj', 1, '987987987', '1', '2018-01-11', '897897', '98789798', '9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(9, 'jkhj', 'jkhkjh', 'jkhjkh', 'jkhjkh', 2, '87897', '1', '2018-01-03', '987987', '8978798', 'jhkjh@gmail.com', 1, 3, 131, 1, 1, 44, 'jkhkjjhk', '3', 'O+', 2, ''),
(10, 'hkjjhjk', 'kjhhjjk', 'hjkjhjk', 'jhkjhkj', 1, '987987987', '1', '2018-01-11', '897897', '98789798', '9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(11, 'jkhj', 'jkhkjh', 'jkhjkh', 'jkhjkh', 2, '87897', '1', '2018-01-03', '987987', '8978798', 'jhkjh@gmail.com', 1, 3, 131, 1, 1, 44, 'jkhkjjhk', '3', 'O+', 2, ''),
(12, 'hkjjhjk', 'kjhhjjk', 'hjkjhjk', 'jhkjhkj', 1, '987987987', '1', '2018-01-11', '897897', '98789798', '9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(13, 'jkhj', 'jkhkjh', 'jkhjkh', 'jkhjkh', 2, '87897', '1', '2018-01-03', '987987', '8978798', 'jhkjh@gmail.com', 1, 3, 131, 1, 1, 44, 'jkhkjjhk', '3', 'O+', 2, ''),
(14, 'hkjjhjk', 'kjhhjjk', 'hjkjhjk', 'jhkjhkj', 1, '987987987', '1', '2018-01-11', '897897', '98789798', '9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(15, 'jkhj', 'jkhkjh', 'jkhjkh', 'jkhjkh', 2, '87897', '1', '2018-01-03', '987987', '8978798', 'jhkjh@gmail.com', 1, 3, 1, 1, 1, 44, 'jkhkjjhk', '3', 'O+', 2, ''),
(16, 'hkjjhjk', 'kjhhjjk', 'hjkjhjk', 'jhkjhkj', 1, '987987987', '1', '2018-01-11', '897897', '98789798', '9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(17, 'jkl', 'jkhkjjh', 'jkhjkh', 'kjhkjh', 2, '98098', '1', '2018-01-01', '8908', '9080980', 'jkhjkhk@GMAIL.COM', 1, 3, 131, 1, 1, 44, 'JKHJKH', '6', 'O-', 1, ''),
(18, 'JHKJ', 'JKH', 'JKHKJH', 'KJHKJH', 1, '9878798', '1', '2018-01-01', '89789798', '9878979', 'KJHKJHJKQ@GMAIL.COM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(19, 'ljhjh', 'jkhkjh', 'kjhkjh', 'kjhkjhk', 1, '89797987', '1', '2018-01-09', '8976767', '8768768', 'jkhjkhjk@gmail.com', 1, 3, 131, 1, 1, 44, 'lkhkjhkj', '2', 'O+', 1, ''),
(20, 'kljkljlk', 'ljkhkgkhg', 'jkhhkhjk', 'kjhkhkj', 1, '89789789', '1', '2018-01-09', '8798798', '09787987', 'lkjjhlkjkljl@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(21, 'ljhjh', 'jkhkjh', 'kjhkjh', 'kjhkjhk', 1, '89797987', '1', '2018-01-09', '8976767', '8768768', 'jkhjkhjk@gmail.com', 1, 3, 1, 1, 1, 44, 'lkhkjhkj', '2', 'O+', 1, ''),
(22, 'kljkljlk', 'ljkhkgkhg', 'jkhhkhjk', 'kjhkhkj', 1, '89789789', '1', '2018-01-09', '8798798', '09787987', 'lkjjhlkjkljl@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(23, 'ljhjh', 'jkhkjh', 'kjhkjh', 'kjhkjhk', 1, '89797987', '1', '2018-01-09', '8976767', '8768768', 'jkhjkhjk@gmail.com', 1, 3, 131, 1, 1, 44, 'lkhkjhkj', '2', 'O+', 1, ''),
(24, 'kljkljlk', 'ljkhkgkhg', 'jkhhkhjk', 'kjhkhkj', 1, '89789789', '1', '2018-01-09', '8798798', '09787987', 'lkjjhlkjkljl@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(25, 'ljhjh', 'jkhkjh', 'kjhkjh', 'kjhkjhk', 1, '89797987', '1', '2018-01-09', '8976767', '8768768', 'jkhjkhjk@gmail.com', 1, 3, 131, 1, 1, 44, 'lkhkjhkj', '2', 'O+', 1, ''),
(26, 'kljkljlk', 'ljkhkgkhg', 'jkhhkhjk', 'kjhkhkj', 1, '89789789', '1', '2018-01-09', '8798798', '09787987', 'lkjjhlkjkljl@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(27, 'ljhjh', 'jkhkjh', 'kjhkjh', 'kjhkjhk', 1, '89797987', '1', '2018-01-09', '8976767', '8768768', 'jkhjkhjk@gmail.com', 1, 3, 131, 1, 1, 44, 'lkhkjhkj', '2', 'O+', 1, ''),
(28, 'kljkljlk', 'ljkhkgkhg', 'jkhhkhjk', 'kjhkhkj', 1, '89789789', '1', '2018-01-09', '8798798', '09787987', 'lkjjhlkjkljl@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(29, 'ljhjh', 'jkhkjh', 'kjhkjh', 'kjhkjhk', 1, '89797987', '1', '2018-01-09', '8976767', '8768768', 'jkhjkhjk@gmail.com', 1, 3, 131, 1, 1, 44, 'lkhkjhkj', '2', 'O+', 1, ''),
(30, 'kljkljlk', 'ljkhkgkhg', 'jkhhkhjk', 'kjhkhkj', 1, '89789789', '1', '2018-01-09', '8798798', '09787987', 'lkjjhlkjkljl@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(31, 'ljhjh', 'jkhkjh', 'kjhkjh', 'kjhkjhk', 1, '89797987', '1', '2018-01-09', '8976767', '8768768', 'jkhjkhjk@gmail.com', 1, 3, 131, 1, 1, 44, 'lkhkjhkj', '2', 'O+', 1, ''),
(32, 'kljkljlk', 'ljkhkgkhg', 'jkhhkhjk', 'kjhkhkj', 1, '89789789', '1', '2018-01-09', '8798798', '09787987', 'lkjjhlkjkljl@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(33, 'ljhjh', 'jkhkjh', 'kjhkjh', 'kjhkjhk', 1, '89797987', '1', '2018-01-09', '8976767', '8768768', 'jkhjkhjk@gmail.com', 1, 3, 131, 1, 1, 44, 'lkhkjhkj', '2', 'O+', 1, ''),
(34, 'kljkljlk', 'ljkhkgkhg', 'jkhhkhjk', 'kjhkhkj', 1, '89789789', '1', '2018-01-09', '8798798', '09787987', 'lkjjhlkjkljl@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(35, 'ljhjh', 'jkhkjh', 'kjhkjh', 'kjhkjhk', 1, '89797987', '1', '2018-01-09', '8976767', '8768768', 'jkhjkhjk@gmail.com', 1, 3, 131, 1, 1, 44, 'lkhkjhkj', '2', 'O+', 1, ''),
(36, 'kljkljlk', 'ljkhkgkhg', 'jkhhkhjk', 'kjhkhkj', 1, '89789789', '1', '2018-01-09', '8798798', '09787987', 'lkjjhlkjkljl@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(37, 'ljhjh', 'jkhkjh', 'kjhkjh', 'kjhkjhk', 1, '89797987', '1', '2018-01-09', '8976767', '8768768', 'jkhjkhjk@gmail.com', 1, 3, 131, 1, 1, 44, 'lkhkjhkj', '2', 'O+', 1, ''),
(38, 'kljkljlk', 'ljkhkgkhg', 'jkhhkhjk', 'kjhkhkj', 1, '89789789', '1', '2018-01-09', '8798798', '09787987', 'lkjjhlkjkljl@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(39, 'ljhjh', 'jkhkjh', 'kjhkjh', 'kjhkjhk', 1, '89797987', '1', '2018-01-09', '8976767', '8768768', 'jkhjkhjk@gmail.com', 1, 3, 131, 1, 1, 44, 'lkhkjhkj', '2', 'O+', 1, ''),
(40, 'kljkljlk', 'ljkhkgkhg', 'jkhhkhjk', 'kjhkhkj', 1, '89789789', '1', '2018-01-09', '8798798', '09787987', 'lkjjhlkjkljl@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(41, 'ljhjh', 'jkhkjh', 'kjhkjh', 'kjhkjhk', 1, '89797987', '1', '2018-01-09', '8976767', '8768768', 'jkhjkhjk@gmail.com', 1, 3, 131, 1, 1, 44, 'lkhkjhkj', '2', 'O+', 1, ''),
(42, 'kljkljlk', 'ljkhkgkhg', 'jkhhkhjk', 'kjhkhkj', 1, '89789789', '1', '2018-01-09', '8798798', '09787987', 'lkjjhlkjkljl@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(43, 'ljhjh', 'jkhkjh', 'kjhkjh', 'kjhkjhk', 1, '89797987', '1', '2018-01-09', '8976767', '8768768', 'jkhjkhjk@gmail.com', 1, 3, 131, 1, 1, 44, 'lkhkjhkj', '2', 'O+', 1, ''),
(44, 'kljkljlk', 'ljkhkgkhg', 'jkhhkhjk', 'kjhkhkj', 1, '89789789', '1', '2018-01-09', '8798798', '09787987', 'lkjjhlkjkljl@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(45, 'ljhjh', 'jkhkjh', 'kjhkjh', 'kjhkjhk', 1, '89797987', '1', '2018-01-09', '8976767', '8768768', 'jkhjkhjk@gmail.com', 1, 3, 131, 1, 1, 44, 'lkhkjhkj', '2', 'O+', 1, ''),
(46, 'kljkljlk', 'ljkhkgkhg', 'jkhhkhjk', 'kjhkhkj', 1, '89789789', '1', '2018-01-09', '8798798', '09787987', 'lkjjhlkjkljl@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(47, 'ljhjh', 'jkhkjh', 'kjhkjh', 'kjhkjhk', 1, '89797987', '1', '2018-01-09', '8976767', '8768768', 'jkhjkhjk@gmail.com', 1, 3, 131, 1, 1, 44, 'lkhkjhkj', '2', 'O+', 1, ''),
(48, 'kljkljlk', 'ljkhkgkhg', 'jkhhkhjk', 'kjhkhkj', 1, '89789789', '1', '2018-01-09', '8798798', '09787987', 'lkjjhlkjkljl@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(49, 'KHKJHJK', 'JKJKHKJ', 'JKHKJJHJK', 'KJHKJH', 1, '89678686', '1', '2018-01-03', '897897', '87897897', 'JKHKJHKJHJK@GMAIL.COM', 1, 3, 131, 1, 1, 44, 'JKHJKHKJ', '9', 'O+', 1, ''),
(50, 'JHKJHJK', 'KJHKJHKH', 'KJHKJHKJ', 'KJHKJH', 2, '989080', '1', '2018-01-01', '987987', '9879879', 'JHKHJKHKJ@GMAIL.COM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(51, 'IOHH', 'JKHKJH', 'JKHJKH', 'JKHKJH', 1, '90809809', '1', '2018-01-13', '897987', '897987', 'GKJGKJGK@GMAIL.COM', 1, 3, 131, 1, 1, 44, 'LHJKJH', '7', 'O+', 1, ''),
(52, 'iugg', 'jkhjkh', 'kjhkjh', 'kjhkj', 1, '897897', '1', '2018-01-09', '90709', '98789', 'jkhjhQ@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(53, 'IOHH', 'JKHKJH', 'JKHJKH', 'JKHKJH', 1, '90809809', '1', '2018-01-13', '897987', '897987', 'GKJGKJGK@GMAIL.COM', 1, 3, 131, 1, 1, 44, 'LHJKJH', '7', 'O+', 1, ''),
(54, 'iugg', 'jkhjkh', 'kjhkjh', 'kjhkj', 1, '897897', '1', '2018-01-09', '90709', '98789', 'jkhjhQ@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(55, 'IOHH', 'JKHKJH', 'JKHJKH', 'JKHKJH', 1, '90809809', '1', '2018-01-13', '897987', '897987', 'GKJGKJGK@GMAIL.COM', 1, 3, 131, 1, 1, 44, 'LHJKJH', '7', 'O+', 1, ''),
(56, 'iugg', 'jkhjkh', 'kjhkjh', 'kjhkj', 1, '897897', '1', '2018-01-09', '90709', '98789', 'jkhjhQ@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(57, 'IOHH', 'JKHKJH', 'JKHJKH', 'JKHKJH', 1, '90809809', '1', '2018-01-13', '897987', '897987', 'GKJGKJGK@GMAIL.COM', 1, 3, 131, 1, 1, 44, 'LHJKJH', '7', 'O+', 1, ''),
(58, 'iugg', 'jkhjkh', 'kjhkjh', 'kjhkj', 1, '897897', '1', '2018-01-09', '90709', '98789', 'jkhjhQ@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(59, 'IOHH', 'JKHKJH', 'JKHJKH', 'JKHKJH', 1, '90809809', '1', '2018-01-13', '897987', '897987', 'GKJGKJGK@GMAIL.COM', 1, 3, 131, 1, 1, 44, 'LHJKJH', '7', 'O+', 1, ''),
(60, 'iugg', 'jkhjkh', 'kjhkjh', 'kjhkj', 1, '897897', '1', '2018-01-09', '90709', '98789', 'jkhjhQ@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(61, 'IOHH', 'JKHKJH', 'JKHJKH', 'JKHKJH', 1, '90809809', '1', '2018-01-13', '897987', '897987', 'GKJGKJGK@GMAIL.COM', 1, 3, 131, 1, 1, 44, 'LHJKJH', '7', 'O+', 1, ''),
(62, 'iugg', 'jkhjkh', 'kjhkjh', 'kjhkj', 1, '897897', '1', '2018-01-09', '90709', '98789', 'jkhjhQ@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(63, 'IOHH', 'JKHKJH', 'JKHJKH', 'JKHKJH', 1, '90809809', '1', '2018-01-13', '897987', '897987', 'GKJGKJGK@GMAIL.COM', 1, 3, 131, 1, 1, 44, 'LHJKJH', '7', 'O+', 1, ''),
(64, 'iugg', 'jkhjkh', 'kjhkjh', 'kjhkj', 1, '897897', '1', '2018-01-09', '90709', '98789', 'jkhjhQ@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(65, 'kjkljklj', 'jlkjlkjlkj', 'kljlkjlk', 'jlkjlkjlk', 1, '89798798', '1', '2018-01-02', '8687687', '876876', 'hkjhkjhQ@gmail.com', 1, 3, 131, 1, 1, 44, 'jkhkjh', '6', 'O-', 2, ''),
(66, 'kjlkjlk', 'jlkjlkj', 'lkjlkjl', 'jkljlkj', 2, '8978798', '2', '2018-01-01', '897987', '2222', 'jhjkhk@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(67, 'kljklj', 'kljkljlk', 'kljlkj', 'kjlkj', 1, '9889798', '1', '2018-01-08', '978789', '897897', 'jhjhkjh@gmail.com', 1, 3, 131, 1, 1, 44, 'KR 12 A BIS B SUR 23', '2', 'O+', 1, ''),
(68, 'kjklj', 'kljklj', 'kljklj', 'kljklj', 1, '989089089809', '1', '2018-01-01', '9890', '908908', 'kjlkjlkQ@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(69, 'NATALIA', 'kjhkjh', 'hkjhkj', 'jhkjhk', 1, '87897897', '1', '2018-01-03', '8897', '7897987', 'hjkhjkh@gmai.com', 1, 3, 131, 1, 1, 44, 'AC 12', '2', 'O+', 1, '5467829281'),
(70, 'khkjhjkh', 'jhjkhkj', 'kjhjkhkjh', 'kjhkjhkjh', 2, '8978798', '1', '2018-01-09', '879879222', '87897', 'jhkjhkjh@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(71, 'JHJKH', 'KJHKJH', 'JKHKJH', 'KJHKJ', 1, '98798798', '1', '2018-01-02', '987897', '897987', 'johan@gmail.com', 1, 3, 131, 1, 1, 44, 'CL 12', '2', 'O+', 1, ''),
(72, 'kljkljkl', 'kljlkj', 'lkjklj', 'kljlkj', 1, '989089080', '1', '2018-01-08', '798798', '8767868', 'jhhjgjhgQ@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, ''),
(73, 'DANIEL', 'ANDRES', 'JKHKJH', 'KJHKJ', 1, '98798798', '1', '2018-01-02', '987897', '897987', 'johan@gmail.com', 1, 3, 131, 1, 1, 44, 'CL 12', '2', 'O+', 1, '5467829281'),
(74, 'kljkljkl', 'kljlkj', 'lkjklj', 'kljlkj', 1, '989089080', '1', '2018-01-08', '798798', '8767868', 'jhhjgjhgQ@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'O+', NULL, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_persona_x_grupo_poblacional`
--

CREATE TABLE `tbl_gen_persona_x_grupo_poblacional` (
  `id_persona_x_grupo_social` int(10) UNSIGNED NOT NULL,
  `id_persona` int(10) UNSIGNED NOT NULL,
  `id_grupo_poblacional` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_salud_regimen`
--

CREATE TABLE `tbl_gen_salud_regimen` (
  `tbl_regimen_salud` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_gen_veredas`
--

CREATE TABLE `tbl_gen_veredas` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `corregimiento_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tbl_gen_veredas`
--

INSERT INTO `tbl_gen_veredas` (`id`, `descripcion`, `corregimiento_id`, `created_at`, `updated_at`) VALUES
(1, 'el placer', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoescenarios`
--

CREATE TABLE `tipoescenarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_tipo_escenario` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `primer_nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `segundo_nombre` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primer_apellido` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `segundo_apellido` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_documento` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_documento` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono_movil` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono_fijo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenantId` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `primer_nombre`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `segundo_nombre`, `primer_apellido`, `segundo_apellido`, `tipo_documento`, `numero_documento`, `direccion`, `fecha_nacimiento`, `telefono_movil`, `telefono_fijo`, `tenantId`) VALUES
(1, 'johan', 'johan@gmail.com', '$2y$10$p6C8zvqzSj7DRlOUR6MlxuvQIYWmMEBlERSXdnG1gasBY.a2.Y.kC', 'irGVtc0JyCLfqJ3inGyvddXGuRD0xKVX408lSOfnNVDIEvmVBOjboPt7gArj', '2017-12-04 23:11:19', '2017-12-07 19:34:22', 'fabricio', 'salazar', 'burgos', '2', '7682768', 'iuoiuo', '2017-11-26', '313567543', '8888', '5467829281'),
(6, 'rrrrrrrrr', 'johanjhgjgj@gmail.com', '$2y$10$68K/3EjGFFAY1dMsTADvS.CwgixlDtMq7b63.QjrcW.WEfLb8eFfy', 'CFAREGsUm8z4IY9cMAlx4w0kt6Vw2nc4Y4JQlPt7TlEusABQy5', '2018-01-05 20:12:20', '2018-01-18 06:25:05', 'jkhjkh', 'hkjhjk', 'jkhkjhkj', '1', '878979222', '8789798', '2018-01-18', '7678678', '76786876', '5467333'),
(7, 'manuel', 'joasdsadhan@gmail.com', '$2y$10$5hTqQtsP86yc3cXlNyQLPuEIg5wx41VSRDvuPK3L04usNsevmg/ra', 'O43craLeHsntAvnWFzfADPACK9BiAqzCUGlm84dGXZNlnCXsPo', '2018-01-05 20:22:21', '2018-01-10 10:19:36', 'jkhjkhjk', 'jkhkjh', 'jkhjkhkj', '2', '897897897', 'kljkl', '2018-01-06', '89789', '87897', '5467829281'),
(8, 'kljlkj', 'kjlkjlk@gmail.com', '$2y$10$POhc3j6Xkwd43MTFSx1UruYEEGzXJEaSvjNE01zWVtovXHcaZtBEe', 'GsUUWzvL34n7yPZwZzclL6EuNwOQhQUfXNEb5maY92achViowa', '2018-01-17 03:51:17', '2018-01-17 03:51:17', 'kljklj', 'kljk', 'kl', '1', '6786876', '8678686', '2018-01-02', '8797987', '8979798', '5467829281'),
(9, 'ttttt', 'lhlkhjl@gmail.com', '$2y$10$EoM2/qSoYoZjQJ0TdLPZ7ul7UWMSRP2Qfr4CoGPbYNaNneaeFgL7.', 'LJRfghybAilfLI151MuMhcqQiShQY6Hi0hKKPgWlbUqto7VNZR', '2018-01-17 19:50:45', '2018-01-17 21:03:33', 'uuuuuu', 'aaaaaa', 'uuuuu', '2', '7678687687', 'CALLE 2', '2017-12-30', '78676786', '78678678687', '5467829281'),
(10, 'ytyutuy', 'ghgj@gmail.com', '$2y$10$bLJ3F.U4yQecWubPEiwYW.oYaHrVqGTdl.YKagBWs4EdAAM32Rbua', 'z2tjpBbz22wMYnIbsxdlIUYzRWxpxaApMoPjjXKxn8yoM0Yn3C', '2018-01-17 22:13:55', '2018-01-17 22:13:55', 'uytuyt', 'uytuyt', 'uytuytu', '1', '78876786876', '76786', '2018-08-01', '786786', '7868768', '5467829281'),
(12, '7686876876', 'uyiuyQ@gmail.com', '$2y$10$HLxNZSdUvtsBO/OW/TreBOlWo6nJmmamSGuBNIfcF57IRBS/hALRy', 'TPQIdyLWL8egtYafhZhw0GSZFxqS7BKEOHckVacyNt5Mv5Oflq', '2018-01-18 01:43:11', '2018-01-18 01:43:11', '786786876', '786786876', '768768768', '1', '7687686', '76868', '2018-08-01', '7867868', '89789789', '5467829281'),
(14, 'hgjhgjh', 'hghjgjh@gmail.com', '$2y$10$N19rfus6CWz8F/6wVSShPOkuLMrgdSDX6uEs4RfEhD6JDyMReA9Hu', 'LlT0q09DYIivG4QMuyGGE4DdXLprLAaFMT0TqxdFmKDq6pf852', '2018-01-18 01:51:34', '2018-01-31 21:07:39', 'hggjghj', 'hjgjh', 'hjgjhg', '1', '7867868768', 'CALLE 2', '2018-01-01', '786876786', '7678687678', '5467829281'),
(15, 'kljkljk', '8jkhkjh@gmail.com', '$2y$10$fmwSOmoQU/Qewch40HoV2ePbqQjLIcjcBr6QpJut31YmTEnEw6OiS', '3q7qJBcF5qs9WbZ4gWdyoeScggLTbwzp2bj3ra2B99zyKCr1nN', '2018-01-25 10:50:06', '2018-01-25 10:50:06', 'jkljlk', 'jlkjlkj', 'kljlkjl', '1', '8978979', 'jhkjhjkhk', '2018-10-01', '89789798', '987987987', '5467829281'),
(16, 'kjkjlkj', 'kjkljlkjQ@gmail.com', '$2y$10$T3VSOlEsX4WSqySQrp797uJ2TnUVlA9jyC5X1o4Fl0JdX5A7XrQfG', 'AjO8IIX2UhBVA6cxExiBs7at9oMtqJCYE95sCgMChXg5QhaJ8h', '2018-01-25 10:52:20', '2018-01-25 10:52:20', 'kjklj', 'kljlkjl', 'kjlkj', '1', '876786786', '87987987', '2018-11-01', '98897', '87987987', '5467829281'),
(18, 'jkhkjhkjh', 'jhjkhkjhkQ@gmail.com', '$2y$10$zZuNUHtzMa12Og4h1WVpEOBIH/KLc4wjf1.Q/aanKuXccPMuchTLy', '2prOAIM0Z42XuGmnTNm3hpGzJHtTtYQZMZkTRUKu6Wwq6hRXRs', '2018-01-25 10:54:35', '2018-01-25 10:54:35', 'jhkjhkjhkj', 'kjhjkhkjh', 'jhkjhkjhk', '1', '987897897', 'jhjkhjkh', '2018-09-01', '87897', '87987987', '5467829281'),
(19, 'ooooooo', 'kjkljkljlQ@gmail.com', '$2y$10$3MV3nPbE/5wF4BvwhxAcnOKML2gJbwKlEjVcCMfGo3QLg5Rs1sa0S', 'HLknLAjXBTVk0GHPIq6xz3wGZI9fkiGYcg3tMnQ3LNOFl3Q5oK', '2018-01-25 17:59:17', '2018-01-25 18:06:19', 'oooo', 'ooo', 'oooo', '2', '987897987', 'kjjkhk', '2018-01-08', '8979879', '87987987', '5467829281'),
(20, 'prueba', 'prueba@gmail.com', '$2y$10$/TmtsHfhJldLcvLUfTlIN.ZvfkCK3JhCmjvyadK6geCPUF0y677we', 'i0wVZptQ1Hr1Q76AQwqYRWO76WCXu8ttJ0kew3cpdcqV4oy3CX', '2018-01-31 21:00:59', '2018-01-31 21:00:59', 'prueba', 'prueba', 'prueba', '1', '987987987', 'prueba', '2018-02-01', '98908', '908098', '5467829281');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

CREATE TABLE `zonas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_zona` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `zonas`
--

INSERT INTO `zonas` (`id`, `nombre_zona`, `created_at`, `updated_at`) VALUES
(2, 'Norte', '2017-12-08 21:01:30', '2017-12-08 21:01:30'),
(3, 'Sur', '2017-12-08 21:12:18', '2017-12-08 21:12:18'),
(4, 'zona 8', '2018-01-05 20:16:58', '2018-01-05 20:16:58');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `barrios`
--
ALTER TABLE `barrios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barrios_comuna_id_foreign` (`comuna_id`);

--
-- Indices de la tabla `beneficiarios`
--
ALTER TABLE `beneficiarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiarios_grupo_id_foreign` (`grupo_id`),
  ADD KEY `beneficiarios_programa_id_foreign` (`programa_id`),
  ADD KEY `beneficiarios_pais_id_foreign` (`pais_id`),
  ADD KEY `beneficiarios_departamento_id_foreign` (`departamento_id`),
  ADD KEY `beneficiarios_municipio_id_foreign` (`municipio_id`),
  ADD KEY `beneficiarios_comuna_id_foreign` (`comuna_id`),
  ADD KEY `beneficiarios_barrio_id_foreign` (`barrio_id`);

--
-- Indices de la tabla `comunas`
--
ALTER TABLE `comunas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comunas_zona_id_foreign` (`zona_id`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departamentos_pais_id_foreign` (`pais_id`);

--
-- Indices de la tabla `escenarios`
--
ALTER TABLE `escenarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `escenarios_tipoescenario_id_foreign` (`tipoescenario_id`),
  ADD KEY `escenarios_sede_id_foreign` (`sede_id`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grupos_user_id_foreign` (`user_id`),
  ADD KEY `grupos_sede_id_foreign` (`sede_id`),
  ADD KEY `grupos_programa_id_foreign` (`programa_id`);

--
-- Indices de la tabla `horario_grupos`
--
ALTER TABLE `horario_grupos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `horario_grupos_grupo_id_foreign` (`grupo_id`);

--
-- Indices de la tabla `instituciones`
--
ALTER TABLE `instituciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instituciones_barrio_id_foreign` (`barrio_id`);

--
-- Indices de la tabla `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `municipios_departamento_id_foreign` (`departamento_id`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indices de la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `poblacional_beneficiarios`
--
ALTER TABLE `poblacional_beneficiarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `poblacional_beneficiarios_ficha_id_foreign` (`ficha_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `programas`
--
ALTER TABLE `programas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indices de la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sedes_institucion_id_foreign` (`institucion_id`);

--
-- Indices de la tabla `tbl_cm_ficha`
--
ALTER TABLE `tbl_cm_ficha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_cm_ficha_id_persona_beneficiario_foreign` (`id_persona_beneficiario`),
  ADD KEY `tbl_cm_ficha_grupo_id_foreign` (`grupo_id`);

--
-- Indices de la tabla `tbl_cm_grados`
--
ALTER TABLE `tbl_cm_grados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_dv_ficha`
--
ALTER TABLE `tbl_dv_ficha`
  ADD PRIMARY KEY (`id_ficha`),
  ADD KEY `tbl_dv_ficha_id_persona_beneficiario_foreign` (`id_persona_beneficiario`),
  ADD KEY `tbl_dv_ficha_id_escolaridad_nivel_foreign` (`id_escolaridad_nivel`),
  ADD KEY `tbl_dv_ficha_id_escolaridad_estado_foreign` (`id_escolaridad_estado`),
  ADD KEY `tbl_dv_ficha_id_etnia_foreign` (`id_etnia`),
  ADD KEY `tbl_dv_ficha_id_persona_acudiente_foreign` (`id_persona_acudiente`),
  ADD KEY `tbl_dv_ficha_id_persona_acudiente_parentesco_foreign` (`id_persona_acudiente_parentesco`),
  ADD KEY `tbl_dv_ficha_id_persona_vive_con_parentesco_foreign` (`id_persona_vive_con_parentesco`),
  ADD KEY `tbl_dv_ficha_id_salud_regimen_foreign` (`id_salud_regimen`),
  ADD KEY `tbl_dv_ficha_id_eps_foreign` (`id_eps`);

--
-- Indices de la tabla `tbl_dv_persona_x_discapacidad`
--
ALTER TABLE `tbl_dv_persona_x_discapacidad`
  ADD PRIMARY KEY (`id_persona_x_discapacidad`),
  ADD KEY `tbl_dv_persona_x_discapacidad_id_persona_foreign` (`id_persona`),
  ADD KEY `tbl_dv_persona_x_discapacidad_id_discapacidad_foreign` (`id_discapacidad`);

--
-- Indices de la tabla `tbl_dv_persona_x_ocupacion`
--
ALTER TABLE `tbl_dv_persona_x_ocupacion`
  ADD PRIMARY KEY (`tbl_persona_x_ocupacion`),
  ADD KEY `tbl_dv_persona_x_ocupacion_id_persona_foreign` (`id_persona`),
  ADD KEY `tbl_dv_persona_x_ocupacion_id_ocupacion_foreign` (`id_ocupacion`);

--
-- Indices de la tabla `tbl_gen_asistencias`
--
ALTER TABLE `tbl_gen_asistencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_gen_asistencias_grupo_id_foreign` (`grupo_id`),
  ADD KEY `tbl_gen_asistencias_ficha_id_foreign` (`ficha_id`);

--
-- Indices de la tabla `tbl_gen_corregimientos`
--
ALTER TABLE `tbl_gen_corregimientos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_gen_discapacidad`
--
ALTER TABLE `tbl_gen_discapacidad`
  ADD PRIMARY KEY (`id_discapacidad`);

--
-- Indices de la tabla `tbl_gen_documento_tipo`
--
ALTER TABLE `tbl_gen_documento_tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_gen_eps`
--
ALTER TABLE `tbl_gen_eps`
  ADD PRIMARY KEY (`id_eps`);

--
-- Indices de la tabla `tbl_gen_escolaridad_estado`
--
ALTER TABLE `tbl_gen_escolaridad_estado`
  ADD PRIMARY KEY (`id_escolaridad_estado`);

--
-- Indices de la tabla `tbl_gen_escolaridad_nivel`
--
ALTER TABLE `tbl_gen_escolaridad_nivel`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_gen_estado_civil`
--
ALTER TABLE `tbl_gen_estado_civil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_gen_etnia`
--
ALTER TABLE `tbl_gen_etnia`
  ADD PRIMARY KEY (`id_etnia`);

--
-- Indices de la tabla `tbl_gen_grupo_poblacional`
--
ALTER TABLE `tbl_gen_grupo_poblacional`
  ADD PRIMARY KEY (`id_grupo_poblacional`);

--
-- Indices de la tabla `tbl_gen_ocupacion`
--
ALTER TABLE `tbl_gen_ocupacion`
  ADD PRIMARY KEY (`id_ocupacion`);

--
-- Indices de la tabla `tbl_gen_parentesco`
--
ALTER TABLE `tbl_gen_parentesco`
  ADD PRIMARY KEY (`id_persona_parentesco`);

--
-- Indices de la tabla `tbl_gen_persona`
--
ALTER TABLE `tbl_gen_persona`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_gen_persona_id_documento_tipo_foreign` (`id_documento_tipo`),
  ADD KEY `tbl_gen_persona_id_procedencia_pais_foreign` (`id_procedencia_pais`),
  ADD KEY `tbl_gen_persona_id_procedencia_departamento_foreign` (`id_procedencia_departamento`),
  ADD KEY `tbl_gen_persona_id_procedencia_municipio_foreign` (`id_procedencia_municipio`),
  ADD KEY `tbl_gen_persona_id_residencia_corregimiento_foreign` (`id_residencia_corregimiento`),
  ADD KEY `tbl_gen_persona_id_residencia_vereda_foreign` (`id_residencia_vereda`),
  ADD KEY `tbl_gen_persona_id_residencia_barrio_foreign` (`id_residencia_barrio`),
  ADD KEY `tbl_gen_persona_id_estado_civil_foreign` (`id_estado_civil`);

--
-- Indices de la tabla `tbl_gen_persona_x_grupo_poblacional`
--
ALTER TABLE `tbl_gen_persona_x_grupo_poblacional`
  ADD PRIMARY KEY (`id_persona_x_grupo_social`),
  ADD KEY `tbl_gen_persona_x_grupo_poblacional_id_persona_foreign` (`id_persona`),
  ADD KEY `tbl_gen_persona_x_grupo_poblacional_id_grupo_poblacional_foreign` (`id_grupo_poblacional`);

--
-- Indices de la tabla `tbl_gen_salud_regimen`
--
ALTER TABLE `tbl_gen_salud_regimen`
  ADD PRIMARY KEY (`tbl_regimen_salud`);

--
-- Indices de la tabla `tbl_gen_veredas`
--
ALTER TABLE `tbl_gen_veredas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_gen_veredas_corregimiento_id_foreign` (`corregimiento_id`);

--
-- Indices de la tabla `tipoescenarios`
--
ALTER TABLE `tipoescenarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `zonas`
--
ALTER TABLE `zonas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `barrios`
--
ALTER TABLE `barrios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=336;
--
-- AUTO_INCREMENT de la tabla `beneficiarios`
--
ALTER TABLE `beneficiarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `comunas`
--
ALTER TABLE `comunas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de la tabla `escenarios`
--
ALTER TABLE `escenarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `horario_grupos`
--
ALTER TABLE `horario_grupos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `instituciones`
--
ALTER TABLE `instituciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT de la tabla `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1057;
--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;
--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT de la tabla `poblacional_beneficiarios`
--
ALTER TABLE `poblacional_beneficiarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `programas`
--
ALTER TABLE `programas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `sedes`
--
ALTER TABLE `sedes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;
--
-- AUTO_INCREMENT de la tabla `tbl_cm_ficha`
--
ALTER TABLE `tbl_cm_ficha`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `tbl_cm_grados`
--
ALTER TABLE `tbl_cm_grados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `tbl_dv_ficha`
--
ALTER TABLE `tbl_dv_ficha`
  MODIFY `id_ficha` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_dv_persona_x_discapacidad`
--
ALTER TABLE `tbl_dv_persona_x_discapacidad`
  MODIFY `id_persona_x_discapacidad` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_dv_persona_x_ocupacion`
--
ALTER TABLE `tbl_dv_persona_x_ocupacion`
  MODIFY `tbl_persona_x_ocupacion` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_gen_asistencias`
--
ALTER TABLE `tbl_gen_asistencias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `tbl_gen_corregimientos`
--
ALTER TABLE `tbl_gen_corregimientos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tbl_gen_discapacidad`
--
ALTER TABLE `tbl_gen_discapacidad`
  MODIFY `id_discapacidad` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_gen_documento_tipo`
--
ALTER TABLE `tbl_gen_documento_tipo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `tbl_gen_eps`
--
ALTER TABLE `tbl_gen_eps`
  MODIFY `id_eps` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_gen_escolaridad_estado`
--
ALTER TABLE `tbl_gen_escolaridad_estado`
  MODIFY `id_escolaridad_estado` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_gen_escolaridad_nivel`
--
ALTER TABLE `tbl_gen_escolaridad_nivel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `tbl_gen_estado_civil`
--
ALTER TABLE `tbl_gen_estado_civil`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tbl_gen_etnia`
--
ALTER TABLE `tbl_gen_etnia`
  MODIFY `id_etnia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_gen_grupo_poblacional`
--
ALTER TABLE `tbl_gen_grupo_poblacional`
  MODIFY `id_grupo_poblacional` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_gen_ocupacion`
--
ALTER TABLE `tbl_gen_ocupacion`
  MODIFY `id_ocupacion` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_gen_parentesco`
--
ALTER TABLE `tbl_gen_parentesco`
  MODIFY `id_persona_parentesco` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_gen_persona`
--
ALTER TABLE `tbl_gen_persona`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT de la tabla `tbl_gen_persona_x_grupo_poblacional`
--
ALTER TABLE `tbl_gen_persona_x_grupo_poblacional`
  MODIFY `id_persona_x_grupo_social` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_gen_salud_regimen`
--
ALTER TABLE `tbl_gen_salud_regimen`
  MODIFY `tbl_regimen_salud` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tbl_gen_veredas`
--
ALTER TABLE `tbl_gen_veredas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `tipoescenarios`
--
ALTER TABLE `tipoescenarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `zonas`
--
ALTER TABLE `zonas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `barrios`
--
ALTER TABLE `barrios`
  ADD CONSTRAINT `barrios_comuna_id_foreign` FOREIGN KEY (`comuna_id`) REFERENCES `comunas` (`id`);

--
-- Filtros para la tabla `beneficiarios`
--
ALTER TABLE `beneficiarios`
  ADD CONSTRAINT `beneficiarios_barrio_id_foreign` FOREIGN KEY (`barrio_id`) REFERENCES `barrios` (`id`),
  ADD CONSTRAINT `beneficiarios_comuna_id_foreign` FOREIGN KEY (`comuna_id`) REFERENCES `comunas` (`id`),
  ADD CONSTRAINT `beneficiarios_departamento_id_foreign` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`),
  ADD CONSTRAINT `beneficiarios_grupo_id_foreign` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`),
  ADD CONSTRAINT `beneficiarios_municipio_id_foreign` FOREIGN KEY (`municipio_id`) REFERENCES `municipios` (`id`),
  ADD CONSTRAINT `beneficiarios_pais_id_foreign` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`),
  ADD CONSTRAINT `beneficiarios_programa_id_foreign` FOREIGN KEY (`programa_id`) REFERENCES `programas` (`id`);

--
-- Filtros para la tabla `comunas`
--
ALTER TABLE `comunas`
  ADD CONSTRAINT `comunas_zona_id_foreign` FOREIGN KEY (`zona_id`) REFERENCES `zonas` (`id`);

--
-- Filtros para la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD CONSTRAINT `departamentos_pais_id_foreign` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`);

--
-- Filtros para la tabla `escenarios`
--
ALTER TABLE `escenarios`
  ADD CONSTRAINT `escenarios_sede_id_foreign` FOREIGN KEY (`sede_id`) REFERENCES `sedes` (`id`),
  ADD CONSTRAINT `escenarios_tipoescenario_id_foreign` FOREIGN KEY (`tipoescenario_id`) REFERENCES `tipoescenarios` (`id`);

--
-- Filtros para la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `grupos_programa_id_foreign` FOREIGN KEY (`programa_id`) REFERENCES `programas` (`id`),
  ADD CONSTRAINT `grupos_sede_id_foreign` FOREIGN KEY (`sede_id`) REFERENCES `sedes` (`id`),
  ADD CONSTRAINT `grupos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `horario_grupos`
--
ALTER TABLE `horario_grupos`
  ADD CONSTRAINT `horario_grupos_grupo_id_foreign` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`);

--
-- Filtros para la tabla `instituciones`
--
ALTER TABLE `instituciones`
  ADD CONSTRAINT `instituciones_barrio_id_foreign` FOREIGN KEY (`barrio_id`) REFERENCES `barrios` (`id`);

--
-- Filtros para la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `municipios_departamento_id_foreign` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`);

--
-- Filtros para la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `poblacional_beneficiarios`
--
ALTER TABLE `poblacional_beneficiarios`
  ADD CONSTRAINT `poblacional_beneficiarios_ficha_id_foreign` FOREIGN KEY (`ficha_id`) REFERENCES `tbl_cm_ficha` (`id`);

--
-- Filtros para la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD CONSTRAINT `sedes_institucion_id_foreign` FOREIGN KEY (`institucion_id`) REFERENCES `instituciones` (`id`);

--
-- Filtros para la tabla `tbl_cm_ficha`
--
ALTER TABLE `tbl_cm_ficha`
  ADD CONSTRAINT `tbl_cm_ficha_grupo_id_foreign` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`),
  ADD CONSTRAINT `tbl_cm_ficha_id_persona_beneficiario_foreign` FOREIGN KEY (`id_persona_beneficiario`) REFERENCES `tbl_gen_persona` (`id`);

--
-- Filtros para la tabla `tbl_dv_ficha`
--
ALTER TABLE `tbl_dv_ficha`
  ADD CONSTRAINT `tbl_dv_ficha_id_eps_foreign` FOREIGN KEY (`id_eps`) REFERENCES `tbl_gen_eps` (`id_eps`),
  ADD CONSTRAINT `tbl_dv_ficha_id_escolaridad_estado_foreign` FOREIGN KEY (`id_escolaridad_estado`) REFERENCES `tbl_gen_escolaridad_estado` (`id_escolaridad_estado`),
  ADD CONSTRAINT `tbl_dv_ficha_id_escolaridad_nivel_foreign` FOREIGN KEY (`id_escolaridad_nivel`) REFERENCES `tbl_gen_escolaridad_nivel` (`id`),
  ADD CONSTRAINT `tbl_dv_ficha_id_etnia_foreign` FOREIGN KEY (`id_etnia`) REFERENCES `tbl_gen_etnia` (`id_etnia`),
  ADD CONSTRAINT `tbl_dv_ficha_id_persona_acudiente_foreign` FOREIGN KEY (`id_persona_acudiente`) REFERENCES `tbl_gen_persona` (`id`),
  ADD CONSTRAINT `tbl_dv_ficha_id_persona_acudiente_parentesco_foreign` FOREIGN KEY (`id_persona_acudiente_parentesco`) REFERENCES `tbl_gen_parentesco` (`id_persona_parentesco`),
  ADD CONSTRAINT `tbl_dv_ficha_id_persona_beneficiario_foreign` FOREIGN KEY (`id_persona_beneficiario`) REFERENCES `tbl_gen_persona` (`id`),
  ADD CONSTRAINT `tbl_dv_ficha_id_persona_vive_con_parentesco_foreign` FOREIGN KEY (`id_persona_vive_con_parentesco`) REFERENCES `tbl_gen_parentesco` (`id_persona_parentesco`),
  ADD CONSTRAINT `tbl_dv_ficha_id_salud_regimen_foreign` FOREIGN KEY (`id_salud_regimen`) REFERENCES `tbl_gen_salud_regimen` (`tbl_regimen_salud`);

--
-- Filtros para la tabla `tbl_dv_persona_x_discapacidad`
--
ALTER TABLE `tbl_dv_persona_x_discapacidad`
  ADD CONSTRAINT `tbl_dv_persona_x_discapacidad_id_discapacidad_foreign` FOREIGN KEY (`id_discapacidad`) REFERENCES `tbl_gen_discapacidad` (`id_discapacidad`),
  ADD CONSTRAINT `tbl_dv_persona_x_discapacidad_id_persona_foreign` FOREIGN KEY (`id_persona`) REFERENCES `tbl_gen_persona` (`id`);

--
-- Filtros para la tabla `tbl_dv_persona_x_ocupacion`
--
ALTER TABLE `tbl_dv_persona_x_ocupacion`
  ADD CONSTRAINT `tbl_dv_persona_x_ocupacion_id_ocupacion_foreign` FOREIGN KEY (`id_ocupacion`) REFERENCES `tbl_gen_ocupacion` (`id_ocupacion`),
  ADD CONSTRAINT `tbl_dv_persona_x_ocupacion_id_persona_foreign` FOREIGN KEY (`id_persona`) REFERENCES `tbl_gen_persona` (`id`);

--
-- Filtros para la tabla `tbl_gen_asistencias`
--
ALTER TABLE `tbl_gen_asistencias`
  ADD CONSTRAINT `tbl_gen_asistencias_ficha_id_foreign` FOREIGN KEY (`ficha_id`) REFERENCES `tbl_cm_ficha` (`id`),
  ADD CONSTRAINT `tbl_gen_asistencias_grupo_id_foreign` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`);

--
-- Filtros para la tabla `tbl_gen_persona`
--
ALTER TABLE `tbl_gen_persona`
  ADD CONSTRAINT `tbl_gen_persona_id_estado_civil_foreign` FOREIGN KEY (`id_estado_civil`) REFERENCES `tbl_gen_estado_civil` (`id`),
  ADD CONSTRAINT `tbl_gen_persona_id_documento_tipo_foreign` FOREIGN KEY (`id_documento_tipo`) REFERENCES `tbl_gen_documento_tipo` (`id`),
  ADD CONSTRAINT `tbl_gen_persona_id_procedencia_departamento_foreign` FOREIGN KEY (`id_procedencia_departamento`) REFERENCES `departamentos` (`id`),
  ADD CONSTRAINT `tbl_gen_persona_id_procedencia_municipio_foreign` FOREIGN KEY (`id_procedencia_municipio`) REFERENCES `municipios` (`id`),
  ADD CONSTRAINT `tbl_gen_persona_id_procedencia_pais_foreign` FOREIGN KEY (`id_procedencia_pais`) REFERENCES `paises` (`id`),
  ADD CONSTRAINT `tbl_gen_persona_id_residencia_barrio_foreign` FOREIGN KEY (`id_residencia_barrio`) REFERENCES `barrios` (`id`),
  ADD CONSTRAINT `tbl_gen_persona_id_residencia_corregimiento_foreign` FOREIGN KEY (`id_residencia_corregimiento`) REFERENCES `tbl_gen_corregimientos` (`id`),
  ADD CONSTRAINT `tbl_gen_persona_id_residencia_vereda_foreign` FOREIGN KEY (`id_residencia_vereda`) REFERENCES `tbl_gen_veredas` (`id`);

--
-- Filtros para la tabla `tbl_gen_persona_x_grupo_poblacional`
--
ALTER TABLE `tbl_gen_persona_x_grupo_poblacional`
  ADD CONSTRAINT `tbl_gen_persona_x_grupo_poblacional_id_grupo_poblacional_foreign` FOREIGN KEY (`id_grupo_poblacional`) REFERENCES `tbl_gen_grupo_poblacional` (`id_grupo_poblacional`),
  ADD CONSTRAINT `tbl_gen_persona_x_grupo_poblacional_id_persona_foreign` FOREIGN KEY (`id_persona`) REFERENCES `tbl_gen_persona` (`id`);

--
-- Filtros para la tabla `tbl_gen_veredas`
--
ALTER TABLE `tbl_gen_veredas`
  ADD CONSTRAINT `tbl_gen_veredas_corregimiento_id_foreign` FOREIGN KEY (`corregimiento_id`) REFERENCES `tbl_gen_corregimientos` (`id`);