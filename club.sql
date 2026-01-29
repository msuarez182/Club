-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 28-01-2026 a las 14:57:25
-- Versión del servidor: 10.6.24-MariaDB-cll-lve
-- Versión de PHP: 8.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `club`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sv`
--

CREATE TABLE `sv` (
  `id` bigint(20) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descripcion` longtext NOT NULL,
  `img_publicacion` varchar(255) NOT NULL,
  `img_confirme` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `link_plataforma` varchar(200) NOT NULL,
  `link_video` mediumtext DEFAULT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sv`
--

INSERT INTO `sv` (`id`, `titulo`, `descripcion`, `img_publicacion`, `img_confirme`, `fecha`, `link_plataforma`, `link_video`, `status`) VALUES
(1, 'Asma en la Era Moderna - Avances y Perspectivas', '<p><strong>Sesi&oacute;n Virtual: Asma en la Era Moderna - Avances y Perspectivas</strong><br>El <strong>asma</strong> representa un importante desaf&iacute;o de salud p&uacute;blica a nivel global, dado que afecta a m&aacute;s de 260 millones de personas. En M&eacute;xico, su prevalencia es una de las m&aacute;s altas en Am&eacute;rica Latina, impacta alrededor de 8.5 millones de habitantes. En este sentido, este trastorno no solo compromete la calidad de vida de los pacientes, tambi&eacute;n supone una carga sustancial sobre los sistemas de salud, lo cual destaca la necesidad de crear estrategias de manejo m&aacute;s eficaces. &nbsp;</p>\n<p>Afortunadamente, las perspectivas terap&eacute;uticas modernas han evolucionado hacia un enfoque personalizado. M&aacute;s all&aacute; de los broncodilatadores y glucocorticoides inhalados, se disponen de terapias biol&oacute;gicas dirigidas a fenotipos espec&iacute;ficos de asma grave, esto permite un mejor control de los casos complejos. Adem&aacute;s, la implementaci&oacute;n de herramientas digitales ha contribuido a optimizar el seguimiento de los pacientes y se traduce en intervenciones tempranas y un manejo m&aacute;s preciso y proactivo. &nbsp;Conectimed le extiende a una cordial invitaci&oacute;n a esta interesante sesi&oacute;n virtual presentada por GSK, en la cual se analizar&aacute;n los enfoques diagn&oacute;sticos y terap&eacute;uticos del asma en la era moderna.&nbsp;</p>\n<p>&nbsp;La ponencia estar&aacute; a cargo de: &nbsp;</p>\n<p><strong>Dra. Karina P&eacute;rez &nbsp;</strong></p>\n<ul>\n    <li>Especialista en Neumolog&iacute;a por el Hospital General de M&eacute;xico &ldquo;Dr. Eduardo Liceaga&rdquo;,&nbsp;</li>\n    <li>avalado por la UNAM Alta Especialidad en Fisiolog&iacute;a Pulmonar por el Hospital General de M&eacute;xico,&nbsp;</li>\n    <li>avalado por la UNAM Certificaci&oacute;n por parte del Consejo Nacional de Neumolog&iacute;a Maestrante en Ciencias M&eacute;dicas,&nbsp;dentro del programa de Ciencias M&eacute;dicas y de la Salud en la UNAM Dr. Marco Polo Mac&iacute;as &nbsp;M&eacute;dico Cirujano por la UNAM Especialidad en Neumolog&iacute;a y Endoscop&iacute;a Tor&aacute;cica por la UNAM&nbsp;</li>\n    <li>Maestr&iacute;a en Ciencias M&eacute;dicas por la UNAM Actualmente es Gerente M&eacute;dico del &aacute;rea de Respiratorio por GlaxoSmithKline M&eacute;xico</li>\n</ul>', 'publicacionAsma.jpg', 'confirmeAsma.jpg', '2025-11-05', 'https://conectimed721.clickmeeting.com/sesion-virtual-vitaminas-c-y-d-rol-inmunologico', 'https://www.youtube.com/watch?v=YfvNoLSGMQI', 1),
(2, 'Perfil Libdico', '<p><strong>Sesi&oacute;n Virtual: Perfil Lip&iacute;dico en Cardiolog&iacute;a Personalizada</strong></p>\n<p>El perfil lip&iacute;dico se ha consolidado en la actualidad como uno de los marcadores cl&iacute;nicos dentro de la qu&iacute;mica sangu&iacute;nea, m&aacute;s relevantes en la pr&aacute;ctica m&eacute;dica debido a su elevado valor predictivo en la identificaci&oacute;n del riesgo cardiovascular, que sigue siendo una de las principales causas de morbimortalidad a nivel mundial. No obstante, la verdadera utilidad del perfil lip&iacute;dico no se limita a la obtenci&oacute;n de cifras aisladas, sino que requiere un an&aacute;lisis cuidadoso y contextualizado, considerando variables y los h&aacute;bitos de vida del paciente. Por ello, la interpretaci&oacute;n de los resultados debe hacerse de manera individualizada, evitando aplicar criterios generales de forma indiscriminada.</p>\n<p>Esta necesidad de personalizaci&oacute;n en la lectura del perfil lip&iacute;dico responde a la tendencia actual de la medicina hacia un enfoque m&aacute;s preciso y centrado en el paciente, en el que se busca no solo prevenir la enfermedad, sino tambi&eacute;n optimizar la toma de decisiones terap&eacute;uticas y de seguimiento. As&iacute;, el perfil lip&iacute;dico no solo refleja un estado metab&oacute;lico, sino que se convierte en un punto de partida para estrategias de prevenci&oacute;n y tratamiento individualizadas que buscan reducir de manera efectiva la carga de la enfermedad cardiovascular.</p>\n<p><strong>Conectimed</strong> le extiende una cordial invitaci&oacute;n a la sesi&oacute;n virtual presentada por Similab, donde se proporcionar&aacute; un marco de referencia actualizado sobre como el perfil lip&iacute;dico cumple con un roll predictivo en el riesgo cardiaco del paciente.</p>\n<p>La ponencia estar&aacute; a cargo de:</p>\n<p><strong>Dr. Ricardo Leopoldo Barajas Campos</strong></p>\n<ul>\n<li>M&eacute;dico Cardi&oacute;logo por el Instituto Nacional de Cardiolog&iacute;a Ignacio Ch&aacute;vez</li>\n<li>Alta especialidad en Ecocardiograf&iacute;a por el Instituto Nacional de Ciencias M&eacute;dicas y Nutrici&oacute;n Salvador Zubir&aacute;n</li>\n<li>Especialidad en Terapia Intensiva Cardiovascular por el Instituto Nacional de Cardiolog&iacute;a Ignacio Ch&aacute;vez</li>\n<li>Maestr&iacute;a en Administraci&oacute;n de Hospitales por la Universidad de las Am&eacute;ricas de Puebla</li>\n<li>Certificado por el Consejo Mexicano de Cardiolog&iacute;a Miembro de la Sociedad Mexicana de Cardiolog&iacute;a M&eacute;dico adscrito del Instituto Nacional de Cardiolog&iacute;a</li>\n</ul>', 'publicacionPerfilLimptico.jpg', 'confirmeperfilLimptico.jpg', '2025-11-23', 'https://conectimed721.clickmeeting.com/sesion-virtual-neumonia-intrahospitalaria-consideraciones-terapeuticas', NULL, 1),
(3, 'Omega-3 y Antioxidantes - Realidades y Mitos para una Buena Salud', '<p><strong>Sesi&oacute;n Virtual: Omega-3 y Antioxidantes - Realidades y Mitos para una Buena Salud</strong></p>\n<p>Para el m&eacute;dico actual, integrar estrategias preventivas como el uso de&nbsp;<strong>omega-3</strong>&nbsp;y&nbsp;<strong>antioxidantes&nbsp;</strong>representa un pilar fundamental en el manejo de enfermedades cr&oacute;nicas. Estos nutrientes ofrecen un abordaje terap&eacute;utico basado en evidencia: los omega-3 regulan la inflamaci&oacute;n y mejoran el perfil lip&iacute;dico en patolog&iacute;as cardiovasculares, mientras antioxidantes combaten el estr&eacute;s oxidativo vinculado al envejecimiento y enfermedades neurodegenerativas. Su acci&oacute;n conjunta proporciona un enfoque integral para preservar la salud sist&eacute;mica.</p>\n<p><br />Este binomio adquiere especial relevancia en salud visual, donde act&uacute;an sin&eacute;rgicamente para proteger estructuras oculares. El DHA, componente clave de la retina, optimiza la funci&oacute;n fotoreceptora y previene la degeneraci&oacute;n macular. Antioxidantes como lute&iacute;na y zeaxantina protegen la m&aacute;cula filtrando luz da&ntilde;ina, mientras los omega-3 mejoran la lubricaci&oacute;n ocular en s&iacute;ndrome de ojo seco. As&iacute;, estos nutrientes no solo apoyan la salud general, sino que brindan herramientas cl&iacute;nicas valiosas para preservar la visi&oacute;n, especialmente en adultos mayores y pacientes con riesgo metab&oacute;lico.</p>\n<p><br /><strong>Conectimed</strong>&nbsp;le extiende una cordial invitaci&oacute;n a la sesi&oacute;n virtual presentada por&nbsp;<strong>IOSA Health</strong>&nbsp;y sus productos&nbsp;<strong>i-OMG3&reg;</strong>&nbsp;y&nbsp;<strong>MacuHealt&reg;,&nbsp;</strong>donde sellevar&aacute; a cabo un debate entre profesionales de la salud sobre Omega-3 y antioxidantes, as&iacute; como su uso dentro de la pr&aacute;ctica cl&iacute;nica, aportando as&iacute; nuevas alternativas terap&eacute;uticas. La cita es el pr&oacute;ximo jueves 1&ordm; de octubre, 2025 en punto de las 8 de la noche.</p>\n<div>MODERADOR</div>\n<div><strong>LN Jos&eacute; Manuel &Aacute;vila Mijangos</strong></div>\n<ul dir=\"ltr\">\n<li>Licenciado en Nutrici&oacute;n por la Universidad Tecnol&oacute;gica de M&eacute;xico</li>\n<li>Nutri&oacute;logo con m&aacute;s de 8 a&ntilde;os de experiencia en el &aacute;mbito cl&iacute;nico y deportivo, con un enfoque que combina la nutrici&oacute;n funcional con la cl&iacute;nica y deportiva, trabajando con pacientes que tienen enfermedades cr&oacute;nicas y atletas, para optimizar su salud y rendimiento  </li>\n</ul>\n<div>PONENTES</div>\n<div><strong>LN Karla Maite Tinajar Bernabe</strong></div>\n<ul dir=\"ltr\">\n<li>Licenciada en Nutrici&oacute;n y Ciencias de los Alimentos por la Universidad Iberoamericana</li>\n<li>Diplomada en Nutrici&oacute;n Deportiva</li>\n<li>Especializaci&oacute;n en Salud Digestiva y Nutrici&oacute;n Funcional</li>\n<li>Actualizaci&oacute;n en Nutrici&oacute;n Materno-Infantil<br /><br /></li>\n</ul>\n<div><strong>LN Frida Maria Najera Oaxaca</strong></div>\n<ul dir=\"ltr\">\n<li>Licenciada en nutrici&oacute;n Egresada del Instituto Polit&eacute;cnico Nacional</li>\n<li>Diplomado en nutrici&oacute;n en enfermedades neurol&oacute;gicas por NUTRIVANCE</li>\n<li>Diplomado en nutrici&oacute;n oncol&oacute;gica por el Centro Internacional de Posgrados</li>\n<li>Enfoque en enfermedades cronico degenerativas y alimentaci&oacute;n conscienteE</li>\n</ul>\n<div><strong>LN Abigail Meza Pe&ntilde;afiel</strong></div>\n<ul dir=\"ltr\">\n<li>Licenciada en nutrici&oacute;n egresada de la Universidad Latino en M&eacute;rida</li>\n<li>Socio activo del Colegio Mexicano de Nutri&oacute;logos Cap&iacute;tulo Puebla</li>\n<li>Diplomado en Nutrici&oacute;n Funcional en la Enfermedad Cr&oacute;nico Metab&oacute;lica por el Colegio Mexicano de Nutri&oacute;logos A.C.</li>\n<li>Diplomado en Nutrici&oacute;n Deportiva y Suplementaci&oacute;n Deportiva por el Instituto</li>\n<li>Acad&eacute;mico para Entrenadores Personales y Profesionales de la Salud</li>\n</ul>', 'publicacionOmega3.jpg', 'confirmeOmega3.jpg', '2025-11-24', 'https://conectimed721.clickmeeting.com/sesion-virtual-neumonia-intrahospitalaria-consideraciones-terapeuticas', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sv_usuario`
--

CREATE TABLE `sv_usuario` (
  `id` bigint(20) NOT NULL,
  `usuarioId` bigint(20) DEFAULT NULL,
  `svId` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sv_usuario`
--

INSERT INTO `sv_usuario` (`id`, `usuarioId`, `svId`) VALUES
(7, 4, 3),
(8, 8, 2),
(9, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido_paterno` varchar(255) NOT NULL,
  `apellido_materno` varchar(255) NOT NULL,
  `tipo_usuario` varchar(30) NOT NULL,
  `nivel_estudios` varchar(255) NOT NULL,
  `cedula` varchar(30) NOT NULL,
  `documento` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `codigo_postal` varchar(10) NOT NULL,
  `token` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido_paterno`, `apellido_materno`, `tipo_usuario`, `nivel_estudios`, `cedula`, `documento`, `correo`, `fecha_nacimiento`, `password`, `codigo_postal`, `token`, `fecha_registro`) VALUES
(1, 'Miguel', 'suarez', 'Pluma', 'Profesional de la salud', 'Licenciatura', '12345678', '', 'msuarez@conectimed.com', '1997-02-07', '$2y$10$OaVvi1c6KziSxU/0uJvmX.IK2FZx0tQ8w77NGAVm0cWDvxygPimLi', '90850', 'a966bba6fcc33540d2b85d214a070eed', '2026-01-25 18:11:07'),
(3, 'Miguel', 'Suarez', 'suarez', 'Paciente', '', '', '', 'correo@correo.com', '2026-01-13', '$2y$10$wTIG.w26fVulpfrYbGNAMOpm0fUqTzMy3Lv7FY4xAXCST1igNtqyK', '90850', '', '2026-01-05 23:06:33'),
(4, 'Jorge', 'Aguilar', 'Hernández', 'Paciente', '', '', '', 'jaguilar@medicable.com.mx', '1997-10-22', '$2y$10$aSNuSk52PYIpEAwWTAguKuoYkRMqUD85VdUvtaiUoZI.arKj3XhA2', '1420', '', '2026-01-27 17:50:52'),
(5, 'moises', 'flores', 'ventura', 'Paciente', '', '', '', 'mflores@medicable.com.mx', '1997-08-26', '$2y$10$B6ikJe6kXWvL6FlK/aj8.u.HTK1AboCHwtvp80k046ueegcb1fJ4m', '09290', '', '2026-01-06 21:34:38'),
(6, 'Luis Alberto ', 'Guadarrama ', 'Omaña', 'Paciente', '', '', '', 'guadarramaomana@gmail.com', '1999-11-13', '$2y$10$9fkzGnIK38PYe1x.i7449.0SBgn02wQMXuQfYU8LJQI0TN0FU5SBO', '04260', '', '2026-01-14 19:07:21'),
(7, 'Berenice', 'Brito', '', 'Otro', '', '', '', 'berebrito27@gmail.com', '1981-09-27', '$2y$10$HtX0VEpcRH3Tv6DtaX9.juAWsn3i4w7NwXaKKjyhKbMz0KRh54JIG', '14370', '', '2026-01-20 01:47:24'),
(8, 'Luis', 'Algo', 'hola', 'Paciente', '', '', '', 'beto_bekman@hotmail.com', '0000-00-00', '$2y$10$vN7ZgzVyv6uFbUfSlV5B4er4rJkpaXBdKOix.mzIsw9xqaAE6exAW', '65456', '', '2026-01-27 17:29:39'),
(9, 'Alejandro', 'Cordero', '', 'Profesional de la salud', 'Nivel Universitario', '11780155', '', 'alexlorien10@gmail.com', '1993-08-14', '$2y$10$Kkh7i8oG8uOm5giCrExifegZAfhzpneckP3ybb3BMD/7pboON.gX.', '57210', '', '2026-01-27 20:51:15'),
(10, 'Gibran', 'Ruiz', 'Puon', 'Profesional de la salud', 'Nivel Universitario', '2015610321', '', 'gruiz@conectimed.com', '1995-02-25', '$2y$10$LwHhi8V/i.jfZEIgjdY3Iecybf2/CRtRucSIsqY0yzzRcTVfNs2TG', '13300', '', '2026-01-27 21:00:35');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sv`
--
ALTER TABLE `sv`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sv_usuario`
--
ALTER TABLE `sv_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sv_id_FK` (`svId`),
  ADD KEY `usuario_id_FK` (`usuarioId`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sv`
--
ALTER TABLE `sv`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sv_usuario`
--
ALTER TABLE `sv_usuario`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `sv_usuario`
--
ALTER TABLE `sv_usuario`
  ADD CONSTRAINT `sv_id_FK` FOREIGN KEY (`svId`) REFERENCES `sv` (`id`),
  ADD CONSTRAINT `usuario_id_FK` FOREIGN KEY (`usuarioId`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
