-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 11-12-2025 a las 17:10:11
-- Versión del servidor: 12.1.2-MariaDB
-- Versión de PHP: 8.5.0

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
(1, 'Asma en la Era Moderna - Avances y Perspectivas', '<p><strong>Sesi&oacute;n Virtual: Asma en la Era Moderna - Avances y Perspectivas</strong><br>El <strong>asma</strong> representa un importante desaf&iacute;o de salud p&uacute;blica a nivel global, dado que afecta a m&aacute;s de 260 millones de personas. En M&eacute;xico, su prevalencia es una de las m&aacute;s altas en Am&eacute;rica Latina, impacta alrededor de 8.5 millones de habitantes. En este sentido, este trastorno no solo compromete la calidad de vida de los pacientes, tambi&eacute;n supone una carga sustancial sobre los sistemas de salud, lo cual destaca la necesidad de crear estrategias de manejo m&aacute;s eficaces. &nbsp;</p>\n<p>Afortunadamente, las perspectivas terap&eacute;uticas modernas han evolucionado hacia un enfoque personalizado. M&aacute;s all&aacute; de los broncodilatadores y glucocorticoides inhalados, se disponen de terapias biol&oacute;gicas dirigidas a fenotipos espec&iacute;ficos de asma grave, esto permite un mejor control de los casos complejos. Adem&aacute;s, la implementaci&oacute;n de herramientas digitales ha contribuido a optimizar el seguimiento de los pacientes y se traduce en intervenciones tempranas y un manejo m&aacute;s preciso y proactivo. &nbsp;Conectimed le extiende a una cordial invitaci&oacute;n a esta interesante sesi&oacute;n virtual presentada por GSK, en la cual se analizar&aacute;n los enfoques diagn&oacute;sticos y terap&eacute;uticos del asma en la era moderna.&nbsp;</p>\n<p>&nbsp;La ponencia estar&aacute; a cargo de: &nbsp;</p>\n<p><strong>Dra. Karina P&eacute;rez &nbsp;</strong></p>\n<ul>\n    <li>Especialista en Neumolog&iacute;a por el Hospital General de M&eacute;xico &ldquo;Dr. Eduardo Liceaga&rdquo;,&nbsp;</li>\n    <li>avalado por la UNAM Alta Especialidad en Fisiolog&iacute;a Pulmonar por el Hospital General de M&eacute;xico,&nbsp;</li>\n    <li>avalado por la UNAM Certificaci&oacute;n por parte del Consejo Nacional de Neumolog&iacute;a Maestrante en Ciencias M&eacute;dicas,&nbsp;dentro del programa de Ciencias M&eacute;dicas y de la Salud en la UNAM Dr. Marco Polo Mac&iacute;as &nbsp;M&eacute;dico Cirujano por la UNAM Especialidad en Neumolog&iacute;a y Endoscop&iacute;a Tor&aacute;cica por la UNAM&nbsp;</li>\n    <li>Maestr&iacute;a en Ciencias M&eacute;dicas por la UNAM Actualmente es Gerente M&eacute;dico del &aacute;rea de Respiratorio por GlaxoSmithKline M&eacute;xico</li>\n</ul>', 'publicacion:Asma.jpg', 'confirme:Asma.jpg', '2025-11-05', 'https://conectimed721.clickmeeting.com/sesion-virtual-vitaminas-c-y-d-rol-inmunologico', 'https://www.youtube.com/watch?v=rLo1xggMDV4', 1),
(2, 'Perfil Libdico', 'Sesión Virtual: Perfil Lipídico en Cardiología Personalizada  El perfil lipídico se ha consolidado en la actualidad como uno de los marcadores clínicos dentro de la química sanguínea, más relevantes en la práctica médica debido a su elevado valor predictivo en la identificación del riesgo cardiovascular, que sigue siendo una de las principales causas de morbimortalidad a nivel mundial. No obstante, la verdadera utilidad del perfil lipídico no se limita a la obtención de cifras aisladas, sino que requiere un análisis cuidadoso y contextualizado, considerando variables y los hábitos de vida del paciente.  Por ello, la interpretación de los resultados debe hacerse de manera individualizada, evitando aplicar criterios generales de forma indiscriminada. Esta necesidad de personalización en la lectura del perfil lipídico responde a la tendencia actual de la medicina hacia un enfoque más preciso y centrado en el paciente, en el que se busca no solo prevenir la enfermedad, sino también optimizar la toma de decisiones terapéuticas y de seguimiento. Así, el perfil lipídico no solo refleja un estado metabólico, sino que se convierte en un punto de partida para estrategias de prevención y tratamiento individualizadas que buscan reducir de manera efectiva la carga de la enfermedad cardiovascular.  Conectimed le extiende una cordial invitación a la sesión virtual presentada por Similab, donde se proporcionará un marco de referencia actualizado sobre como el perfil lipídico cumple con un roll predictivo en el riesgo cardiaco del paciente.  La ponencia estará a cargo de:  Dr. Ricardo Leopoldo Barajas Campos  Médico Cardiólogo por el Instituto Nacional de Cardiología Ignacio Chávez Alta especialidad en Ecocardiografía por el Instituto Nacional de Ciencias Médicas y Nutrición Salvador Zubirán Especialidad en Terapia Intensiva Cardiovascular por el Instituto Nacional de Cardiología Ignacio Chávez Maestría en Administración de Hospitales por la Universidad de las Américas de Puebla Certificado por el Consejo Mexicano de Cardiología Miembro de la Sociedad Mexicana de Cardiología Médico adscrito del Instituto Nacional de Cardiología', 'publicacion:perfilLimptico.jpg', 'confirme: perfilLimptico.jpg', '2025-11-23', 'https://conectimed721.clickmeeting.com/sesion-virtual-neumonia-intrahospitalaria-consideraciones-terapeuticas', NULL, 1),
(3, 'Omega-3 y Antioxidantes - Realidades y Mitos para una Buena Salud', '<p><strong>Sesi&oacute;n Virtual: Omega-3 y Antioxidantes - Realidades y Mitos para una Buena Salud</strong></p>\n<p>Para el m&eacute;dico actual, integrar estrategias preventivas como el uso de&nbsp;<strong>omega-3</strong>&nbsp;y&nbsp;<strong>antioxidantes&nbsp;</strong>representa un pilar fundamental en el manejo de enfermedades cr&oacute;nicas. Estos nutrientes ofrecen un abordaje terap&eacute;utico basado en evidencia: los omega-3 regulan la inflamaci&oacute;n y mejoran el perfil lip&iacute;dico en patolog&iacute;as cardiovasculares, mientras antioxidantes combaten el estr&eacute;s oxidativo vinculado al envejecimiento y enfermedades neurodegenerativas. Su acci&oacute;n conjunta proporciona un enfoque integral para preservar la salud sist&eacute;mica.</p>\n<p><br />Este binomio adquiere especial relevancia en salud visual, donde act&uacute;an sin&eacute;rgicamente para proteger estructuras oculares. El DHA, componente clave de la retina, optimiza la funci&oacute;n fotoreceptora y previene la degeneraci&oacute;n macular. Antioxidantes como lute&iacute;na y zeaxantina protegen la m&aacute;cula filtrando luz da&ntilde;ina, mientras los omega-3 mejoran la lubricaci&oacute;n ocular en s&iacute;ndrome de ojo seco. As&iacute;, estos nutrientes no solo apoyan la salud general, sino que brindan herramientas cl&iacute;nicas valiosas para preservar la visi&oacute;n, especialmente en adultos mayores y pacientes con riesgo metab&oacute;lico.</p>\n<p><br /><strong>Conectimed</strong>&nbsp;le extiende una cordial invitaci&oacute;n a la sesi&oacute;n virtual presentada por&nbsp;<strong>IOSA Health</strong>&nbsp;y sus productos&nbsp;<strong>i-OMG3&reg;</strong>&nbsp;y&nbsp;<strong>MacuHealt&reg;,&nbsp;</strong>donde sellevar&aacute; a cabo un debate entre profesionales de la salud sobre Omega-3 y antioxidantes, as&iacute; como su uso dentro de la pr&aacute;ctica cl&iacute;nica, aportando as&iacute; nuevas alternativas terap&eacute;uticas. La cita es el pr&oacute;ximo jueves 1&ordm; de octubre, 2025 en punto de las 8 de la noche.</p>\n<div>MODERADOR</div>\n<div><strong>LN Jos&eacute; Manuel &Aacute;vila Mijangos</strong></div>\n<ul dir=\"ltr\">\n<li>Licenciado en Nutrici&oacute;n por la Universidad Tecnol&oacute;gica de M&eacute;xico</li>\n<li>Nutri&oacute;logo con m&aacute;s de 8 a&ntilde;os de experiencia en el &aacute;mbito cl&iacute;nico y deportivo, con un enfoque que combina la nutrici&oacute;n funcional con la cl&iacute;nica y deportiva, trabajando con pacientes que tienen enfermedades cr&oacute;nicas y atletas, para optimizar su salud y rendimiento  </li>\n</ul>\n<div>PONENTES</div>\n<div><strong>LN Karla Maite Tinajar Bernabe</strong></div>\n<ul dir=\"ltr\">\n<li>Licenciada en Nutrici&oacute;n y Ciencias de los Alimentos por la Universidad Iberoamericana</li>\n<li>Diplomada en Nutrici&oacute;n Deportiva</li>\n<li>Especializaci&oacute;n en Salud Digestiva y Nutrici&oacute;n Funcional</li>\n<li>Actualizaci&oacute;n en Nutrici&oacute;n Materno-Infantil<br /><br /></li>\n</ul>\n<div><strong>LN Frida Maria Najera Oaxaca</strong></div>\n<ul dir=\"ltr\">\n<li>Licenciada en nutrici&oacute;n Egresada del Instituto Polit&eacute;cnico Nacional</li>\n<li>Diplomado en nutrici&oacute;n en enfermedades neurol&oacute;gicas por NUTRIVANCE</li>\n<li>Diplomado en nutrici&oacute;n oncol&oacute;gica por el Centro Internacional de Posgrados</li>\n<li>Enfoque en enfermedades cronico degenerativas y alimentaci&oacute;n conscienteE</li>\n</ul>\n<div><strong>LN Abigail Meza Pe&ntilde;afiel</strong></div>\n<ul dir=\"ltr\">\n<li>Licenciada en nutrici&oacute;n egresada de la Universidad Latino en M&eacute;rida</li>\n<li>Socio activo del Colegio Mexicano de Nutri&oacute;logos Cap&iacute;tulo Puebla</li>\n<li>Diplomado en Nutrici&oacute;n Funcional en la Enfermedad Cr&oacute;nico Metab&oacute;lica por el Colegio Mexicano de Nutri&oacute;logos A.C.</li>\n<li>Diplomado en Nutrici&oacute;n Deportiva y Suplementaci&oacute;n Deportiva por el Instituto</li>\n<li>Acad&eacute;mico para Entrenadores Personales y Profesionales de la Salud</li>\n</ul>', 'publicacion:omega3.jpg', 'confirme:omega3.jpg', '2025-11-24', 'https://conectimed721.clickmeeting.com/sesion-virtual-neumonia-intrahospitalaria-consideraciones-terapeuticas', NULL, 1);

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
(1, 1, 2),
(5, 1, 3);

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
(1, 'Miguel', 'Suarez', 'Pluma', 'Profesional de la salud', 'Licenciatura', '12345678', '', 'msuarez@conectimed.com', '1997-02-07', '$2y$12$bxY4ZajFj.h3uexlZjrdAOBKVx6dufBrUudo6UokS3KSsZhGg1sY6', '90850', 'f46631aaeb246c65a835ec1470c7fea3', '2025-12-03 21:22:48');

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
