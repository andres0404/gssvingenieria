/*
SQLyog Community v9.30 
MySQL - 5.5.16-log : Database - gssv_ingenieria
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`gssv_ingenieria` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `gssv_ingenieria`;

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id_cli` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `raz_social` varchar(40) DEFAULT NULL,
  `nit` varchar(10) DEFAULT NULL,
  `img` varchar(30) DEFAULT NULL,
  `url_web` varchar(40) DEFAULT NULL,
  `url_facebook` varchar(60) DEFAULT NULL,
  `mostrar_idx` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_cli`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `clientes` */

insert  into `clientes`(`id_cli`,`raz_social`,`nit`,`img`,`url_web`,`url_facebook`,`mostrar_idx`) values (1,'Razon S.A.','000000','envato.jpg','#','#',0),(2,'Razon 2 S.A.','000000','designmodo.jpg','#','#',0),(3,'Razon 3 S.A.','000000','themeforest.jpg','#','#',0),(4,'Razon 4','000000','creative-market.jpg','#','#',0),(5,'Ecopetrol','000000','ecopetrol.png','#','#',1),(6,'Colsubsidio','000000','colsubsidio.jpg','#','#',1),(7,'Mazuren','000000','mazuren.png','#','#',1),(8,'El Corral','000000','elcorral.jpg','#','#',1);

/*Table structure for table `comp_elemento` */

DROP TABLE IF EXISTS `comp_elemento`;

CREATE TABLE `comp_elemento` (
  `id_comp_e` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_elemen` bigint(20) unsigned DEFAULT NULL,
  `comp_subtitulo` varchar(50) DEFAULT NULL,
  `comp_img` varchar(50) DEFAULT NULL,
  `comp_texto` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id_comp_e`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `comp_elemento` */

insert  into `comp_elemento`(`id_comp_e`,`id_elemen`,`comp_subtitulo`,`comp_img`,`comp_texto`) values (1,4,'Este es nuestro proyecto estelar','ejecutivo.jpg','<p>Use this area to describe your project (Usa esta area para describir tu proyecto). Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p><p><strong>Want these icons in this portfolio item sample?</strong>You can download 60 of them for free, courtesy of <a href=\"https://getdpd.com/cart/hoplink/18076?referrer=bvbo4kax5k8ogc\">RoundIcons.com</a>, or you can purchase the 1500 icon set <a href=\"https://getdpd.com/cart/hoplink/18076?referrer=bvbo4kax5k8ogc\">here</a>.</p><ul class=\"list-inline\"><li>Date: July 2014</li><li>Client: Round Icons</li><li>Category: Graphic Design</li></ul>');

/*Table structure for table `comp_seccion` */

DROP TABLE IF EXISTS `comp_seccion`;

CREATE TABLE `comp_seccion` (
  `id_compl_s` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_seccion` bigint(20) unsigned DEFAULT NULL,
  `txt_head` varchar(700) DEFAULT NULL,
  `txt_foot` varchar(700) DEFAULT NULL,
  PRIMARY KEY (`id_compl_s`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `comp_seccion` */

insert  into `comp_seccion`(`id_compl_s`,`id_seccion`,`txt_head`,`txt_foot`) values (1,4,NULL,'<p class=\"large text-muted\">\"Escoge un trabajo que te guste, y nunca tendrás que trabajar ni un solo día de tu vida\"<br> <div style=\"text-align: right;\">Confucio</div></p><p class=\"large text-muted\">\"Estamos aqu&iacute; para dar un mordisco al universo. Si no ¿para que otra cosa podemos estar aqui?\"<br> <div style=\"text-align: right;\">Steve Jobs</div></p>');

/*Table structure for table `contactenos` */

DROP TABLE IF EXISTS `contactenos`;

CREATE TABLE `contactenos` (
  `id_contact` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `mensaje` varchar(700) DEFAULT NULL,
  `hora_envio` time DEFAULT NULL,
  `fecha_envio` date DEFAULT NULL,
  `eviado` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_contact`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `contactenos` */

insert  into `contactenos`(`id_contact`,`nombre`,`email`,`telefono`,`mensaje`,`hora_envio`,`fecha_envio`,`eviado`) values (1,'Este es mi nombre','askjsdsd','312513.151','safdksjdhfla sdgfluagd flYWDFOAL EGFADG A','18:08:27','2015-11-07',NULL),(2,'Este es mi nombre','askjsdsd','312513.151','safdksjdhfla sdgfluagd flYWDFOAL EGFADG A','18:09:56','2015-11-07',NULL),(3,'Este es mi nombre','askjsdsd','312513.151','safdksjdhfla sdgfluagd flYWDFOAL EGFADG A','18:10:38','2015-11-07',NULL),(4,'Andres Silva Vega','elandrew2000@hotmail','3565102','sdf egsfhg ','18:11:12','2015-11-07',NULL),(5,'Andres Silva','ela@hotm.com','','Esto es un mensaje correcto','02:18:18','2015-11-08',NULL),(6,'Andres Silva','elandr@hotmail.com','','Esto es mi mensaje para ustedes','04:42:42','2015-11-10',NULL);

/*Table structure for table `elem_contacto` */

DROP TABLE IF EXISTS `elem_contacto`;

CREATE TABLE `elem_contacto` (
  `id_contacto` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_elem` bigint(20) DEFAULT NULL,
  `url_facebook` varchar(60) DEFAULT NULL,
  `url_twitter` varchar(60) DEFAULT NULL,
  `url_linkedin` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id_contacto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `elem_contacto` */

insert  into `elem_contacto`(`id_contacto`,`id_elem`,`url_facebook`,`url_twitter`,`url_linkedin`) values (1,15,'https://www.facebook.com/santiago.silva.3914207?fref=ts',NULL,NULL);

/*Table structure for table `elementos` */

DROP TABLE IF EXISTS `elementos`;

CREATE TABLE `elementos` (
  `id_elemen` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_seccion` bigint(20) unsigned DEFAULT NULL,
  `img` varchar(60) DEFAULT NULL,
  `titulo` varchar(50) DEFAULT NULL,
  `texto` varchar(500) DEFAULT NULL,
  `estado` smallint(5) unsigned DEFAULT NULL,
  `orden` smallint(5) unsigned DEFAULT NULL,
  `complemento` smallint(5) unsigned DEFAULT NULL COMMENT 'Si el elemento tiene complemento',
  PRIMARY KEY (`id_elemen`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `elementos` */

insert  into `elementos`(`id_elemen`,`id_seccion`,`img`,`titulo`,`texto`,`estado`,`orden`,`complemento`) values (1,1,'fa fa-shopping-cart fa-stack-1x fa-inverse','Diseño estructural','Planos calculados de las ideas de sus arquitectos.',1,10,0),(2,1,'fa fa-laptop fa-stack-1x fa-inverse','Documentación en la nube','Disponga de la documentacion generada por nosotros en la nube.',1,20,0),(3,1,'fa fa-lock fa-stack-1x fa-inverse','Gestión de permisos','Gestión de permisos ante el IDU y entregamos su proyecto listo para ser contruido.',1,30,0),(4,2,'dreams-preview.png','Iconos redondos','esto es un texto asi y there',1,10,1),(5,2,'golden.png','Startup Framework','Diseño Web y de todo un poco',1,20,1),(6,2,'treehouse.png','Treehouse','Website Design',1,30,1),(7,2,'golden.png','Golden','Website Design',1,40,1),(8,2,'escape.png','Escape','Website Design',1,50,1),(9,2,'dreams.png','Dreams','Website Design',1,60,1),(10,3,'1.jpg','Our Humble Beginnings','Esto es un texto asi y asi',0,10,0),(11,3,'2.jpg','Valores','Adoptamos y compartimos valores de calidad, <b>responsabilidad</b>, <b>orden</b>, <b>respeto</b> y <b>pasión</b> en el desarrollo de nuestras labores técnicas y sociales',1,20,0),(12,3,'3.jpg','Visión','Queremos ser una referencia de proyectos de infraestructura y superestructura en aspectos de calidad, técnica y colaboración en el desarrollo de proyectos',1,30,0),(13,3,'4.jpg','Misión','Tenemos como misión prestar un servicio de ingeniería civil, enfocado en el diseño de estructuras de concreto, metal, mampostería, madera o cualquier otro material que pueda ser utilizado para el desarrollo de su proyecto, de manera responsable y ejemplar, demostrando así nuestro profesionalismo, técnica, calidad y compromiso con los clientes y el medio ambiente',1,40,0),(14,4,'1.jpg','Santiago todero','Contador, diseñdor, mensajero',1,10,0),(15,4,'2.jpg','Santiago Silva','CEO',1,20,0),(16,4,'3.jpg','Santiago de los tintos','Lider de greca',1,30,0),(17,2,'dreams-preview.png','Esto es un titulo','Es el nuevo panel yea',1,70,1);

/*Table structure for table `general` */

DROP TABLE IF EXISTS `general`;

CREATE TABLE `general` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tit_pagina` varchar(50) DEFAULT NULL,
  `img_path` varchar(30) DEFAULT NULL,
  `logo` varchar(30) DEFAULT NULL,
  `nom_empresa` varchar(30) DEFAULT NULL,
  `lema` varchar(60) DEFAULT NULL,
  `img_index` varchar(30) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `latitud` decimal(10,7) unsigned DEFAULT NULL,
  `longitud` decimal(10,7) unsigned DEFAULT NULL,
  `ciudad` varchar(30) DEFAULT NULL,
  `url_web` varchar(60) DEFAULT NULL,
  `url_facebook` varchar(60) DEFAULT NULL,
  `url_twitter` varchar(60) DEFAULT NULL,
  `url_linkedin` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `general` */

insert  into `general`(`id`,`tit_pagina`,`img_path`,`logo`,`nom_empresa`,`lema`,`img_index`,`email`,`telefono`,`celular`,`direccion`,`latitud`,`longitud`,`ciudad`,`url_web`,`url_facebook`,`url_twitter`,`url_linkedin`) values (1,'GSSV Ingenieria S.A.S','img/logos','gssv_mini_blanco.png','GSSV Ingenieria S.A.S','Tome una desición responsable|SOMOS PASIÓN POR CONSTRUIRES','','santiasilva@gmail.co','1 (57) 4318880','3102220000','','0.0000000','0.0000000','Bogota, Colombia','https://www.facebook.com/santiago.silva.3914207?fref=ts','https://www.facebook.com/santiago.silva.3914207?fref=ts','https://www.facebook.com/santiago.silva.3914207?fref=ts','');

/*Table structure for table `secciones` */

DROP TABLE IF EXISTS `secciones`;

CREATE TABLE `secciones` (
  `id_seccion` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom_seccion` varchar(30) DEFAULT NULL,
  `subtitulo` varchar(100) DEFAULT NULL,
  `estado` smallint(5) unsigned DEFAULT NULL,
  `orden` smallint(5) unsigned DEFAULT NULL,
  `img_path` varchar(20) DEFAULT NULL COMMENT 'carpeta donde estan imagenes de seccion',
  `icono` varchar(20) DEFAULT NULL COMMENT 'icono para el administrador',
  PRIMARY KEY (`id_seccion`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `secciones` */

insert  into `secciones`(`id_seccion`,`nom_seccion`,`subtitulo`,`estado`,`orden`,`img_path`,`icono`) values (1,'servicios','Lo que hacemos',1,10,'','fa-trophy'),(2,'proyectos','Entérese porque nuestros clientes vuelven con nosotros',1,20,'img/portfolio/','fa-clipboard'),(3,'nosotros','Tenemos una trayectoria de 2 años en el mercado',1,30,'img/about/','fa-puzzle-piece'),(4,'nuestro increible equipo','profesionales listos para afrontar retos',1,40,'img/team/','fa-graduation-cap'),(5,'contactenos','Estamos atentos a responder sus duda, su retroalimentación nos hace crecer',1,50,NULL,'fa-phone');

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id_usu` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  `ident` varchar(10) DEFAULT NULL,
  `permiso` smallint(5) unsigned DEFAULT NULL COMMENT 'permisos bit a bit (bitwise)',
  `correo` varchar(20) DEFAULT NULL,
  `clave` varchar(50) DEFAULT NULL COMMENT 'sha1',
  `estado` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_usu`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id_usu`,`nombre`,`ident`,`permiso`,`correo`,`clave`,`estado`) values (1,'Santiago Silva','00',16,'elandrew@hotmail.com','862e080e8159e989e4d4ac618d4ff3cd6f7f3b9c',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
