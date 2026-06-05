# Host: localhost  (Version 5.5.5-10.4.32-MariaDB)
# Date: 2026-06-04 23:19:40
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "orçamentos"
#

CREATE TABLE `orçamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `produto` varchar(100) DEFAULT NULL,
  `quantidade` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `mensagem` text DEFAULT NULL,
  `data_envio` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

#
# Structure for table "produtos"
#

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `nome_en` varchar(100) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `descricao_en` text DEFAULT NULL,
  `mercado` varchar(50) DEFAULT 'Mercado Interno',
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

#
# Structure for table "usuarios"
#

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `pode_gerenciar_usuarios` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
