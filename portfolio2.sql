-- REMPLI
-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 18 sep. 2020 à 21:36
-- Version du serveur :  10.4.8-MariaDB
-- Version de PHP :  7.3.10

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `portfolio2`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`) VALUES
(1, 'PHP', 'slug-php'),
(2, 'Javascript', 'slug-javascript'),
(3, 'React', 'slug-react'),
(4, 'Symphony', 'slug-symfony'),
(5, 'autre', 'slug-autre'),
(6, 'Design', 'slug-design'),
(7, 'HTML&amp;CSS', 'HTML&amp;CSS-Slug'),
(8, 'Node Js', 'Node-js-slug');

-- --------------------------------------------------------

--
-- Structure de la table `commentary`
--

CREATE TABLE `commentary` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `author_id` int(10) UNSIGNED DEFAULT NULL,
  `content` text NOT NULL,
  `date_commentary` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `name`, `size`, `post_id`) VALUES
(106, 'facture1.jpg', 100194, 63),
(107, 'facture2.jpg', 108400, 63),
(108, 'facture3.jpg', 158374, 63),
(109, 'facture4.jpg', 128958, 63),
(110, 'facture5.jpg', 106630, 63),
(118, 'form2.jpg', 257536, 65),
(119, 'form3.jpg', 258410, 65),
(120, 'form4.jpg', 260955, 65),
(121, 'galerie-zoo2.jpg', 297047, 66),
(122, 'galerie-zoo3.jpg', 420580, 66),
(123, 'galerie-zoo4.jpg', 288401, 66),
(124, 'galerie-zoo.jpg', 508172, 66),
(125, 'portfolio-flexbox3.jpg', 375227, 67),
(126, 'portfolio-flexbox4.jpg', 421306, 67),
(127, 'portfolio-flexbox.jpg', 121449, 67),
(128, 'portfolio-flexbox1.jpg', 125418, 67),
(129, 'portfolio-flexbox2.jpg', 155311, 67),
(130, 'symbnb.jpg', 162987, 68),
(131, 'symbnb1.jpg', 149288, 68),
(132, 'symbnb2.jpg', 128854, 68),
(133, 'symbnb3.jpg', 126868, 68),
(134, 'symbnb4.jpg', 193888, 68),
(135, 'symbnb5.jpg', 131579, 68),
(136, 'symbnb6.jpg', 137302, 68),
(137, 'symbnb7.jpg', 148508, 68),
(138, 'symbnb8.jpg', 225853, 68),
(146, 'neon.jpg', 193132, 102),
(147, 'games.jpg', 110485, 103),
(148, 'games1.jpg', 72856, 103),
(149, 'games2.jpg', 89882, 103),
(150, 'games3.jpg', 89882, 103),
(151, 'games4.jpg', 82174, 103),
(152, 'alan-react1.jpg', 227638, 104),
(153, 'alan-react2.jpg', 130274, 104),
(154, 'alan-react3.jpg', 203291, 104),
(155, 'alan-react4.jpg', 280120, 104),
(156, 'alan-react.jpg', 122427, 104),
(157, 'shop.jpg', 132906, 105),
(158, 'shop1.jpg', 82770, 105),
(159, 'shop2.jpg', 149742, 105),
(160, 'shop3.jpg', 72942, 105),
(166, 'form-connex-inscript.jpg', 229649, 107),
(167, 'form-connex-inscript1.jpg', 227575, 107),
(168, 'calendar.jpg', 113585, 108),
(169, 'calendar2.jpg', 102054, 108),
(170, 'calendar3.jpg', 99761, 108),
(171, 'bonneteau.jpg', 222368, 109),
(172, 'bonneteau1.jpg', 222783, 109),
(173, 'bonneteau2.jpg', 212278, 109),
(174, 'alan-react5.jpg', 198588, 104),
(185, 'youtube-like1.jpg', 135186, 113),
(186, 'youtube-like3.jpg', 153196, 113),
(187, 'youtube-like4.jpg', 122867, 113),
(188, 'youtube-like.jpg', 137092, 113),
(189, 'persona-futaba.jpg', 239578, 114),
(190, 'persona-makoto.jpg', 135378, 114),
(191, 'persona-morgana.jpg', 132424, 114),
(192, 'persona-team.jpg', 1183496, 114),
(193, 'persona-team(115).jpg', 1183496, 115),
(194, 'placeholder2.png', 1651, 115);

-- --------------------------------------------------------

--
-- Structure de la table `logo`
--

CREATE TABLE `logo` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) NOT NULL,
  `size` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `logo`
--

INSERT INTO `logo` (`id`, `name`, `size`, `post_id`) VALUES
(92, 'React.js_128x128.png', 4948, 63),
(93, 'symfony(b)_128x128(63).png', 1688, 63),
(95, 'api-platform.png', 19247, 63),
(98, 'HTML_128x128.png', 3654, 65),
(99, 'CSS_128x128.png', 5150, 65),
(100, 'HTML_128x128(66).png', 3654, 66),
(101, 'CSS_128x128(66).png', 5150, 66),
(102, 'javascript_128x128.png', 4010, 66),
(103, 'HTML_128x128(67).png', 3654, 67),
(104, 'CSS_128x128(67).png', 5150, 67),
(105, 'javascript_128x128(67).png', 4010, 67),
(106, 'symfony(b)_128x128.png', 1688, 68),
(107, 'composer_128x128.png', 20304, 68),
(108, 'doctrine_128x128.png', 11619, 68),
(110, 'html_128x128(102).png', 3654, 102),
(111, 'css_128x128(102).png', 5150, 102),
(112, 'react.js_128x128(103).png', 4948, 103),
(113, 'nodejs_128x128.png', 6947, 103),
(115, 'mongodb.png', 9229, 103),
(116, 'react.js_128x128(104).png', 4948, 104),
(117, 'alan.png', 13887, 104),
(118, 'nodejs_128x128(104).png', 6947, 104),
(119, 'nodejs_128x128(105).png', 6947, 105),
(123, 'html_128x128(107).png', 3654, 107),
(124, 'css_128x128(107).png', 5150, 107),
(125, 'javascript_128x128(107).png', 4010, 107),
(126, 'html_128x128(108).png', 3654, 108),
(127, 'css_128x128(108).png', 5150, 108),
(128, 'php_128x128.png', 19438, 108),
(129, 'html_128x128(109).png', 3654, 109),
(130, 'css_128x128(109).png', 5150, 109),
(131, 'php_128x128(109).png', 19438, 109),
(135, 'react.js_128x128(113).png', 4948, 113),
(136, 'nodejs_128x128(113).png', 6947, 113),
(137, 'moviedb_128x128.png', 4406, 113),
(138, 'mysql_128x128.png', 7687, 108),
(139, 'c_sharp.png', 15234, 114),
(140, 'c++.png', 14965, 114),
(141, 'c++(115).png', 14965, 115);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `created_at` datetime NOT NULL,
  `author_id` int(10) UNSIGNED NOT NULL,
  `likes` int(11) DEFAULT NULL,
  `isLiked` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `title`, `picture`, `slug`, `content`, `created_at`, `author_id`, `likes`, `isLiked`) VALUES
(63, 'Application de gestion de facture', 'facture.jpg', 'application-de-gestion-de-facture', 'Front en React avec CRUD d\'un client, CRUD d\'une facture d\'un client, et gestion de l\'ensemble des factures\r\nBack en Symfony et Api-platform.\r\nLe design est entièrement fait avec bootstrap, mais la qualité visuelle n\'est pas de tout l\'objectif de l\'application.', '2020-09-11 20:20:55', 31, 0, 0),
(65, 'Formulaire Stylis&eacute;', 'form.jpg', 'formulaire-stylis&eacute;', 'Formulaire de contact design.\r\nUniquement en HTML et en CSS (animations et transitions)', '2020-09-11 21:44:03', 31, 0, 0),
(66, 'Galerie d\'images (avec fen&ecirc;tre modale)', 'galerie-zoo.jpg', 'galerie-d\'images-(avec-fen&ecirc;tre-modale)', 'Galerie d\'images avec fenêtre modale de l\'images sélectionnée.\r\nFait en CSS et Javascript uniquement, la galerie est entièrement responsive et\r\nchaque images possède un effet de hover et lors du click de celle-ci, un fenêtre\r\nmodale l\'affiche en grand format avec son nom.', '2020-09-11 22:29:13', 31, 0, 0),
(67, 'Portfolio flexbox', 'portfolio-flexbox3.jpg', 'portfolio-flexbox', 'Portfolio (permet la pr&eacute;sentation d\'items multiple)\r\nCr&eacute;&eacute; en CSS et Javascript, le portfolio est enti&egrave;rement responsive gr&acirc;ce &agrave; Flexbox.\r\nLors de la s&eacute;lection d\'un des items, un description et divers info s\'affiche dynamiquement (javascript)', '2020-09-11 22:59:25', 31, 0, 0),
(68, 'Airbnb-like (location de vacances)', 'symbnb.jpg', 'airbnb-like-(location-de-vacances)', '<p>&nbsp;qsdfqsdf</p>\r\n\r\n<div class=\"__code\" style=\"background-color:#282a36; color:#f8f8f2; font-family:Consolas,\'Courier New\',monospace; font-size:15px; font-weight:normal; line-height:20px; white-space:pre\">\r\n<div><span style=\"color:#ff79c6\">RewriteCond</span><span style=\"color:#f8f8f2\">&nbsp;</span><span style=\"color:#f1fa8c\">%{REQUEST_FILENAME}</span><span style=\"color:#f8f8f2\">&nbsp;</span><span style=\"color:#f1fa8c\">!-f</span></div>\r\n\r\n<div><span style=\"color:#ff79c6\">RewriteRule</span><span style=\"color:#f8f8f2\">&nbsp;</span><span style=\"color:#f1fa8c\">^(.*)$</span><span style=\"color:#f8f8f2\">&nbsp;</span><span style=\"color:#f1fa8c\">index.php</span><span style=\"color:#f8f8f2\">&nbsp;[QSA,L]</span></div>\r\n</div>\r\n\r\n<h2>Test de qualit&eacute;<strong>??? aLORS</strong></h2>\r\n', '2020-09-12 21:00:26', 31, 0, 0),
(102, 'Effet N&eacute;on', 'neon.jpg', 'effet-n&eacute;on', '<h2>Effet de style en Css</h2>\r\n\r\n<hr />\r\n<p>L&#39;objectif de cet effet est de mettre en avant <strong>un titre</strong> ou <strong>une partie de texte</strong> dans son site internet.</p>\r\n\r\n<p>Lors du survol du titre, l&#39;effet &quot;n&eacute;on&quot; s&#39;intensifie et r&eacute;fl&eacute;chit sur le background.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2020-09-14 11:48:40', 31, 0, 0),
(103, 'CRUD avec React &amp; MongoDB', 'games.jpg', 'crud-avec-react-&amp;-mongodb', '<p>qdsfsdfsdf</p>\r\n', '2020-09-13 21:38:51', 31, 0, 0),
(104, 'Application vocale de lecteur de news avec React', 'alan-react.jpg', 'application-vocale-de-lecteur-de-news-avec-react', '<h3><strong>DESCRIPTION :</strong></h3>\r\n\r\n<p style=\"margin-left:40px\">Application qui permet de Contr&ocirc;ler vocalement diff&eacute;rentes instructions qui vont ammener &agrave; l&#39;affichage de news (articles de journaux) en fonction de la demande.</p>\r\n\r\n<p style=\"margin-left:40px\">Diff&eacute;rentes commandes permettent d&#39;afficher differentes news (par th&egrave;mes).</p>\r\n\r\n<p style=\"margin-left:40px\">Les news seront lus si le demande en est faite &agrave; l&#39;assitant vocal.</p>\r\n\r\n<hr />\r\n<h4><strong><u>Outils utilis&eacute;s en front :</u></strong></h4>\r\n\r\n<p style=\"margin-left:40px\">L&#39;application est cr&eacute;&eacute;e avec <strong>React</strong>.</p>\r\n\r\n<p style=\"margin-left:40px\">J&#39;ai aussi utilis&eacute; <strong>mat&eacute;rial-ui</strong> pour d&eacute;velopper plus rapidement certain composants, <strong>classnames</strong> pour aider au style, et <strong>words-to-numbers</strong> qui convertir un nombre sous forme de cha&icirc;ne de carat&egrave;re en un number (wordsToNumbers(&#39;one hundred&#39;); //100)</p>\r\n\r\n<hr />\r\n<h4><strong><u>Outils utilis&eacute;s en back :</u></strong></h4>\r\n\r\n<p style=\"margin-left:40px\">J&#39;ai utilis&eacute; <em><strong>Alan studio</strong></em> (API ALAN Studio =&gt; <a href=\"https://studio.alan.app/projects\">https://studio.alan.app/projects</a>) qui est une intelligence Artificielle de contr&ocirc;le vocal. Le code qui permet la gestion des diff&eacute;rentes commandes vocale est directement h&eacute;berger dans un projet sur le site de l&#39;application. (Les diff&eacute;rentes commandes sont &eacute;crites en javascript)</p>\r\n\r\n<p style=\"margin-left:40px\">Et pour les news, j&#39;ai utilis&eacute; <em><strong>NewsAp</strong></em>i (API qui permet de r&eacute;cup des articles de nouveaut&eacute; de diff&eacute;rentes sources =&gt; <a href=\"https://newsapi.org/\">https://newsapi.org/)</a></p>\r\n', '2020-09-14 11:36:40', 31, 0, 0),
(105, 'Shop avec Node JS', 'shop.jpg', 'shop-avec-node-js', '&lt;p&gt;qsdfsdfsdf&lt;/p&gt;\r\n', '2020-09-13 21:39:49', 31, 0, 0),
(107, 'Formulaire connexion&amp;inscription', 'form-connex-inscript.jpg', 'formulaire-connexion&amp;inscription', '<p>qdsfsdfsdf</p>\r\n', '2020-09-13 22:37:58', 31, 0, 0),
(108, 'Agenda en Php et POO', 'calendar.jpg', 'agenda-en-php-et-poo', '<h3><strong>Application</strong> qui sert de <strong>calendrier et d&#39;agenda</strong>.</h3>\r\n\r\n<p>Elle permet de visualiser <strong>jours/mois/ann&eacute;es</strong>, mais surtout permet dynamiquement de <strong>cr&eacute;er ou de supprimer des &eacute;v&eacute;nements ou rendez-vous &agrave; la date souhait&eacute;e</strong>.</p>\r\n\r\n<p>Pour cela un bouton d&#39;ajout (bouton bleu en haut &agrave; gauche) permet de cr&eacute;er un &eacute;venement qu&#39;il est possible de modifier ou de supprimer.</p>\r\n\r\n<p>L&#39;agenda est r&eacute;li&eacute; &agrave; <strong>une base de donn&eacute;e</strong> administr&eacute;e en Mysql, et elle est g&eacute;r&eacute;e par des classes appell&eacute;es Calendrier, Evenement et Formulaire.</p>\r\n', '2020-09-14 11:30:10', 31, 0, 0),
(109, 'Jeu du bonneteau en PHP', 'bonneteau.jpg', 'jeu-du-bonneteau-en-php', '<h3><u>Jeu dU bonneteau revisit&eacute;.</u></h3>\r\n\r\n<p>Voici une repr&eacute;sentation <strong>&quot;un peu imagin&eacute;e&quot;</strong> du <strong>c&eacute;l&egrave;bre jeu de bonneteau</strong>, qui consite &agrave; trouver une carte sur les trois pr&eacute;sent&eacute;es face de dos, et ainsi remporter sa mise. Le jeu est enti&egrave;rement d&eacute;velopper <strong>en php &quot;proc&eacute;dural&quot; (pas de POO)</strong>, le but &eacute;tait de le faire fonctionner vite! Il n&#39;en reste pas moins qu&#39;il &eacute;tait amusant &agrave; d&eacute;velopper.</p>\r\n\r\n<hr />\r\n<p>J&#39;ai laiss&eacute; le tableau de debug, car il reste un bug que je n&#39;ai pas encore identifier mais il ne g&ecirc;ne en rien l&#39;&eacute;xp&eacute;rience.</p>\r\n', '2020-09-14 11:37:28', 31, 0, 0),
(113, 'Youtube-like avec React et Movie-DB ', 'youtube-like.jpg', 'youtube-like-avec-react-et-movie-db-', '<h2>Lecteur de trailer vid&eacute;o avec React</h2>\r\n\r\n<p><u>Description:</u></p>\r\n\r\n<p>L&#39;application permet (via un champ de recherche) de trouver un trailer vid&eacute;o et sa description.</p>\r\n\r\n<p>Une s&eacute;lection de 5 recommandations est ajout&eacute;e dynamiquement (en fonction du nom de la recherche).</p>\r\n\r\n<hr />\r\n<p><u>Outils utilis&eacute;s:</u></p>\r\n\r\n<p><strong>React</strong> pour le front, et la librairie axios pour les requ&ecirc;tes HTTP.</p>\r\n\r\n<p><strong>Api MovieDB</strong> qui permet de r&eacute;cup&eacute;rer les trailers vid&eacute;o</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2020-09-15 19:36:15', 31, 0, 0),
(114, 'Persona 5', 'persona-ann.jpg', 'persona-5', '&lt;p&gt;qsdfqsdfsqdfsdffsdq&lt;/p&gt;\r\n', '2020-09-17 22:34:38', 31, 0, 0),
(115, 'Ma r&eacute;alisation !', 'maison_plage.jpg', 'ma-r&eacute;alisation-!', '<h3>En cours de r&eacute;daction.</h3>\r\n', '2020-09-18 20:36:05', 11, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `post_category`
--

CREATE TABLE `post_category` (
  `post_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `post_category`
--

INSERT INTO `post_category` (`post_id`, `category_id`) VALUES
(63, 3),
(63, 4),
(65, 7),
(66, 2),
(66, 7),
(67, 2),
(67, 7),
(68, 4),
(102, 7),
(103, 3),
(103, 8),
(104, 3),
(104, 8),
(105, 8),
(107, 2),
(107, 7),
(108, 1),
(108, 7),
(109, 1),
(109, 7),
(113, 3),
(113, 8),
(114, 1),
(115, 1),
(115, 7);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(60) NOT NULL,
  `role` enum('user','visitor','admin') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'Baudelaire', 'baudelaire@email.com', '6fd4c29cbd6a758bce1acf991aa9f32e69ced155', 'user'),
(2, 'Rimbaud', 'rimbaud@email.com', '6fd4c29cbd6a758bce1acf991aa9f32e69ced155', 'user'),
(3, 'Victor Hugo', 'vhugo@email.com', '3edb6ce6e328ea8639a3a357c7c6997775ab52ea', 'user'),
(4, 'Jacques Prevert', 'j.prevert@email.com', '713f55ba75af01593dc4e845a8c0dcb9fbb45a88', 'user'),
(5, 'Janis Joplin', 'j.joplin@email.com', '713f55ba75af01593dc4e845a8c0dcb9fbb45a88', 'user'),
(6, 'Dolores Oriordan', 'd.oriordan@email.com', '713f55ba75af01593dc4e845a8c0dcb9fbb45a88', 'user'),
(7, 'Jimi Hendrix', 'j.hendrix@email.com', '713f55ba75af01593dc4e845a8c0dcb9fbb45a88', 'user'),
(8, 'Kurt Cobain', 'k.cobain@gmail.com', '$2y$10$tdDZQGVloGL80SX9tJ2LVuDcstwzT7YeGwWIPb/uzjZJEYEylcL/e', 'user'),
(9, 'Freddie Mercury', 'f.mercury@email.com', '713f55ba75af01593dc4e845a8c0dcb9fbb45a88', 'user'),
(10, 'Jim Morrison', 'j.Morrison@email.com', '713f55ba75af01593dc4e845a8c0dcb9fbb45a88', 'user'),
(11, 'admin(ancien)', 'admin@admin.fr', '$2y$10$aJXmMZ.kHwioXKhrjyQaxuwKkVVCaj9PMjqMVtpFSvIOenGiJI.8O', 'user'),
(28, 'essai', 'essai@essai.fr', '$2y$10$xKAQU.EPSV.34rPh4bId0uhgrErXjU3TYEr9O22KcEJc/Urax.moa', 'visitor'),
(31, 'jeremie', 'jeremiegenetdev@gmail.com', '$2y$10$dX/tpu6Shpgi3JjrWXFCr.YffS2ZpU31leVuEDKoyJD9cWtf1BtBS', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentary`
--
ALTER TABLE `commentary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Commentary_Post` (`post_id`),
  ADD KEY `fk_Commentary_User` (`author_id`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Image_Post` (`post_id`);

--
-- Index pour la table `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Logo_Post` (`post_id`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Post_User` (`author_id`);

--
-- Index pour la table `post_category`
--
ALTER TABLE `post_category`
  ADD PRIMARY KEY (`post_id`,`category_id`),
  ADD KEY `fk_Post_category_Category` (`category_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `commentary`
--
ALTER TABLE `commentary`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT pour la table `logo`
--
ALTER TABLE `logo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentary`
--
ALTER TABLE `commentary`
  ADD CONSTRAINT `fk_Commentary_Post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Commentary_User` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `fk_Image_Post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `logo`
--
ALTER TABLE `logo`
  ADD CONSTRAINT `fk_Logo_Post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_Post_User` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `post_category`
--
ALTER TABLE `post_category`
  ADD CONSTRAINT `fk_Post_category_Category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Post_category_Post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
