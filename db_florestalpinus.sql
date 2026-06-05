# Host: mysql.florestalpinus.com  (Version 11.4.9-MariaDB-log)
# Date: 2026-06-05 14:01:56
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "configuracoes"
#

CREATE TABLE `configuracoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chave` varchar(100) NOT NULL,
  `valor` text DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `chave` (`chave`),
  UNIQUE KEY `chave_2` (`chave`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

#
# Data for table "configuracoes"
#

INSERT INTO `configuracoes` VALUES (1,'email_orcamentos','filipedj@hotmail.com','E-mail para receber orçamentos','2026-06-04 23:35:39','2026-06-05 00:28:54');

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

#
# Data for table "orçamentos"
#

INSERT INTO `orçamentos` VALUES (5,'teste','41544545','teste@outloo.com','pinus','asdad','asdasd','asdasd','2026-05-29 11:41:58'),(15,'FILIPE VIEIRA LUCARELLI','51984111661','filipedj@hotmail.com','International Pallets','ddddd','Porto Alegre','ssss','2026-06-05 13:20:41'),(16,'Filipe Lucarelli','51984111661','filipe.lucarelli@gmail.com','Pine Fences','sssss','Porto Alegre','qqqq','2026-06-05 13:23:27'),(17,'Filipe Lucarelli','51984111661','filipe.lucarelli@gmail.com','Pine Fences','sssss','Porto Alegre','qqqq','2026-06-05 13:23:32'),(18,'FILIPE VIEIRA LUCARELLI','51984111661','filipedj@hotmail.com','International Pallets','sssss','Porto Alegre','aaaaaaaaaaaaaaaaaa','2026-06-05 13:23:55'),(19,'FILIPE VIEIRA LUCARELLI','51984111661','filipedj@hotmail.com','Wood Chips','aaaaaaaaaaaa','Porto Alegre','wwwwwwwwww','2026-06-05 13:26:56'),(20,'FILIPE VIEIRA LUCARELLI','51984111661','filipedj@hotmail.com','Paletes Internacionais','ssss','Porto Alegre','zazaza','2026-06-05 13:40:18'),(21,'FILIPE VIEIRA LUCARELLI','51984111661','filipedj@hotmail.com','International Pallets','450','Alabama','Quero um orçamento ','2026-06-05 13:41:34');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

#
# Data for table "produtos"
#

INSERT INTO `produtos` VALUES (2,'Cercas de Pinus','Pine Fences','Tábuas para cercas produzidas para o mercado internacional.\r\n\r\n* 15 mm de espessura\r\n* 140 mm de largura\r\n* 1830 mm de comprimento\r\n* Outras bitolas sob consulta','Fence boards produced for international markets.\r\n\r\n* 15 mm thickness\r\n* 140 mm width\r\n* 1830 mm length\r\nOther dimensions upon request','Exportação','1780627200.jpeg','2026-06-04 23:40:00'),(3,'Paletes Internacionais','International Pallets','Paletes produzidos para Europa e Emirados Árabes.\r\n\r\n* Produção sob demanda\r\n* Programação de 60 a 120 dias\r\n* Entregas mensais conforme a demanda','Pallets produced for Europe and the United Arab Emirates.\r\n\r\n* Production on demand\r\n* Scheduling from 60 to 120 days\r\n* Monthly delivery according to demand','Exportação','1780629613.jpeg','2026-06-05 00:20:13'),(4,'Cavaco','Wood Chips','Vendido para fábricas de MDF e indústrias de geração de energia por biomassa.\r\n\r\n* Uso industrial\r\n* MDF\r\n* Biomassa','Sold to MDF factories and biomass energy generation industries.\r\n\r\n* Industrial use\r\n* MDF\r\n* Biomass','Mercado Interno','1780629875.jpeg','2026-06-05 00:24:35'),(5,'Serragem','Sawdust','Material vendido para fábricas de pellets.\r\n\r\n* Subproduto industrial\r\n* Aproveitamento da madeira\r\n* Fornecimento sob demanda','Material sold to pellet factories.\r\n\r\n* Industrial by-product\r\n* Wood utilization\r\n* Supply on demand','Mercado Interno','1780629957.jpeg','2026-06-05 00:25:57'),(6,'Casca de Pinus','Pine Bark','Produto destinado principalmente à jardinagem e paisagismo.\r\n\r\n* Jardinagem\r\n* Paisagismo\r\n* Aproveitamento sustentável','Product mainly intended for gardening and landscaping.\r\n\r\n* Gardening\r\n* Landscaping\r\n* Sustainable utilization','Mercado Interno','1780630096.jpeg','2026-06-05 00:28:16');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

#
# Data for table "usuarios"
#

INSERT INTO `usuarios` VALUES (1,'Administrador','admin@florestalpinus.com','$2b$12$Kgu5LQBAtbEKzpTLnzPFHeUjoIDDl3ouMA7.Km6ct3a9owSs0b8JG',1,'2026-05-28 21:11:00');
