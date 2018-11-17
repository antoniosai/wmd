-- Adminer 4.6.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `bahan_baku`;
CREATE TABLE `bahan_baku` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int(11) NOT NULL DEFAULT '0',
  `satuan_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_bahan_baku_satuan` (`satuan_id`),
  CONSTRAINT `FK_bahan_baku_satuan` FOREIGN KEY (`satuan_id`) REFERENCES `satuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `bahan_baku` (`id`, `nama`, `stok`, `satuan_id`) VALUES
(1,	'Ayam',	0,	2),
(2,	'Kangkung',	0,	2),
(4,	'Mie',	0,	2),
(5,	'Alpukat',	41,	1),
(6,	'Test',	100,	3);

DROP TABLE IF EXISTS `bahan_baku_keluar`;
CREATE TABLE `bahan_baku_keluar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tranksaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `bahan_baku_masuk`;
CREATE TABLE `bahan_baku_masuk` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `bahan_baku_menu`;
CREATE TABLE `bahan_baku_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL,
  `bahan_baku_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_bahan_baku_menu_menu` (`menu_id`),
  KEY `FK_bahan_baku_menu_bahan_baku` (`bahan_baku_id`),
  CONSTRAINT `FK_bahan_baku_menu_bahan_baku` FOREIGN KEY (`bahan_baku_id`) REFERENCES `bahan_baku` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_bahan_baku_menu_menu` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `info_restaurant_pusat`;
CREATE TABLE `info_restaurant_pusat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `tentang` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `info_restaurant_pusat` (`id`, `nama`, `foto`, `email`, `alamat`, `tentang`) VALUES
(1,	'Warung Mas Dori',	'/images/logo.jpg',	'wmd@gmail.com',	'Jl. Terusan Pembangunan',	'Konten Tentang');

DROP TABLE IF EXISTS `kategori_menu`;
CREATE TABLE `kategori_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `kategori_menu` (`id`, `nama`) VALUES
(1,	'Makanan'),
(2,	'Minuman'),
(3,	'Paket');

DROP TABLE IF EXISTS `meja`;
CREATE TABLE `meja` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `no_meja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kapasitas` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `meja` (`id`, `no_meja`, `kapasitas`) VALUES
(117,	'Meja 1',	4),
(118,	'Meja 2',	4),
(119,	'Meja 3',	4),
(120,	'Meja 4',	4),
(121,	'Meja 5',	4),
(122,	'Meja 6',	4),
(123,	'Meja 7',	4),
(124,	'Meja 8',	4),
(125,	'Meja 9',	4),
(126,	'Meja 10',	4),
(127,	'Meja 11',	4),
(128,	'Meja 12',	4),
(129,	'Meja 13',	4),
(130,	'Meja 14',	4),
(131,	'Meja 15',	4),
(132,	'Meja 16',	4),
(133,	'Meja 17',	4),
(134,	'Meja 18',	4),
(135,	'Meja 19',	4),
(136,	'Meja 20',	4),
(137,	'Meja 21',	4),
(138,	'Meja 22',	4),
(139,	'Meja 23',	4),
(140,	'Meja 24',	4),
(141,	'Meja 25',	4),
(142,	'Meja 26',	4),
(143,	'Meja 27',	4),
(144,	'Meja 28',	4),
(145,	'Meja 29',	4);

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kategori_id` int(10) unsigned NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_menu_kategori_menu` (`kategori_id`),
  CONSTRAINT `FK_menu_kategori_menu` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `menu` (`id`, `kategori_id`, `nama`, `foto`, `deskripsi`, `harga`) VALUES
(5,	1,	'Mie Ayam',	'images/menu/5-images_mie_Mie_ayam_15-mie-ayam-bakso.jpg',	'Mie Ayam',	10000),
(6,	2,	'Jus Alpukat',	'images/menu/6-maxresdefault.jpg',	NULL,	8000),
(7,	2,	'Jus Mangga',	'images/menu/835-Jus-Mangg.jpg',	NULL,	10000);

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_resets_table',	1),
(3,	'2018_09_09_124030_create_menus_table',	1),
(4,	'2018_09_09_124328_create_category_menus_table',	1),
(5,	'2018_09_09_125523_create_bahan_bakus_table',	1),
(6,	'2018_09_09_132449_create_satuans_table',	1),
(7,	'2018_09_09_133450_bahan_baku_menu',	2),
(8,	'2018_09_09_210721_create_bahan_baku_keluars_table',	3),
(9,	'2018_09_09_210747_create_bahan_baku_masuks_table',	3),
(10,	'2018_09_09_211810_create_orders_table',	3),
(11,	'2018_09_09_212215_info_restaurant',	4),
(12,	'2018_09_10_172334_create_permission_tables',	4),
(13,	'2016_06_01_000001_create_oauth_auth_codes_table',	5),
(14,	'2016_06_01_000002_create_oauth_access_tokens_table',	5),
(15,	'2016_06_01_000003_create_oauth_refresh_tokens_table',	5),
(16,	'2016_06_01_000004_create_oauth_clients_table',	5),
(17,	'2016_06_01_000005_create_oauth_personal_access_clients_table',	5),
(18,	'2018_09_11_234332_create_order_temps_table',	6),
(19,	'2018_09_11_234905_create_mejas_table',	6),
(20,	'2018_09_13_110817_create_penunjungs_table',	7),
(21,	'2018_09_13_110909_create_pengunjungs_table',	7),
(22,	'2018_09_14_151121_meja_table',	7);

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(3,	'App\\User',	1),
(3,	'App\\User',	4),
(3,	'App\\User',	5),
(2,	'App\\User',	6),
(3,	'App\\User',	7);

DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('0ffff029b89e5e254792a0a6650174ab06a98eee59d1a716acb60cb7ff32487fb2d28e20ceb5254e',	1,	1,	'nApp',	'[]',	1,	'2018-09-11 11:27:24',	'2018-09-11 11:27:24',	'2019-09-11 11:27:24'),
('83d142892a8e179960853d90519bc08481983500fd95c6a3d8c4129ecf9caeb9a4528d403eae841d',	1,	1,	'nApp',	'[]',	1,	'2018-09-11 11:22:17',	'2018-09-11 11:22:17',	'2019-09-11 11:22:17'),
('c562bbc26baa8a1cb6a733dd5d089b6c3f3bfaaeb840abaf678d040fed2fdc2c765d56416950c95f',	1,	1,	'nApp',	'[]',	1,	'2018-09-11 11:22:32',	'2018-09-11 11:22:32',	'2019-09-11 11:22:32'),
('ee5569ba23d7f8a2781889f7ad2c257285c39529b1bed40d717afc73091a5a181c99148529d29c7b',	1,	1,	'nApp',	'[]',	1,	'2018-09-11 11:27:48',	'2018-09-11 11:27:48',	'2019-09-11 11:27:48');

DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1,	NULL,	'Laravel Personal Access Client',	'FQfkh6Q9RuJvTKcjoKmc59eqPv72POmMliynqps8',	'http://localhost',	1,	0,	0,	'2018-09-11 10:57:36',	'2018-09-11 10:57:36'),
(2,	NULL,	'Laravel Password Grant Client',	'UCCMOrpLJxCrJ26OcIdql50X5ctC7FCRV6ZQilJp',	'http://localhost',	0,	1,	0,	'2018-09-11 10:57:36',	'2018-09-11 10:57:36'),
(3,	1,	'admin',	'BnEHsypDeY9fE1W6niWvkOU9lgABBXI3XTUMrOrI',	'http://www.wmd.dev/',	0,	0,	1,	'2018-09-11 12:11:05',	'2018-09-11 12:11:50');

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1,	1,	'2018-09-11 10:57:36',	'2018-09-11 10:57:36');

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL,
  `order_temp_id` int(10) unsigned NOT NULL,
  `qty` int(10) unsigned NOT NULL,
  `subtotal` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_order_order_temp` (`order_temp_id`),
  KEY `FK_order_menu` (`menu_id`),
  CONSTRAINT `FK_order_menu` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_order_order_temp` FOREIGN KEY (`order_temp_id`) REFERENCES `order_temp` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `order` (`id`, `menu_id`, `order_temp_id`, `qty`, `subtotal`, `created_at`, `updated_at`) VALUES
(115,	7,	93,	1,	10000,	'2018-09-30 03:09:37',	'2018-09-30 03:09:37');

DROP TABLE IF EXISTS `order_temp`;
CREATE TABLE `order_temp` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_pengunjung` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_nota` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meja_id` int(10) unsigned DEFAULT NULL,
  `status` enum('diajukan','dimasak','disajikan','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'diajukan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_order_temp_meja` (`meja_id`),
  CONSTRAINT `FK_order_temp_meja` FOREIGN KEY (`meja_id`) REFERENCES `meja` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `order_temp` (`id`, `nama_pengunjung`, `no_nota`, `total`, `meja_id`, `status`, `created_at`, `updated_at`) VALUES
(17,	'Antonio',	'test',	'0',	117,	'diajukan',	'2018-09-14 09:09:05',	'2018-09-14 09:09:05'),
(93,	'Yalzan',	'WMD-300918',	'10000',	119,	'selesai',	'2018-09-30 03:09:37',	'2018-09-30 03:35:29');

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `pengunjungs`;
CREATE TABLE `pengunjungs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `penunjungs`;
CREATE TABLE `penunjungs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(5,	'kasir',	'web',	'2018-09-10 17:50:36',	'2018-09-10 17:50:37'),
(6,	'info-restaurant',	'web',	'2018-09-10 17:50:53',	'2018-09-10 17:50:53'),
(7,	'dapur',	'web',	'2018-09-22 17:24:23',	'2018-09-22 17:24:24'),
(8,	'dashboard',	'web',	'2018-09-10 17:50:53',	'2018-09-10 17:50:53'),
(9,	'menu',	'web',	'2018-09-22 17:24:59',	'2018-09-22 17:25:00'),
(10,	'bahan-baku',	'web',	'2018-09-22 17:25:11',	'2018-09-22 17:25:12'),
(11,	'kepegawaian',	'web',	'2018-09-22 17:25:23',	'2018-09-22 17:25:41'),
(12,	'pengunjung',	'web',	'2018-09-22 17:25:39',	'2018-09-22 17:25:39'),
(13,	'laporan',	'web',	'2018-09-22 17:33:49',	'2018-09-22 17:33:49');

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1,	'kasir',	'web',	'2018-09-11 13:35:37',	'2018-09-11 13:35:41'),
(2,	'dapur',	'web',	'2018-09-11 13:35:48',	'2018-09-11 13:35:49'),
(3,	'admin',	'web',	'2018-09-11 13:35:54',	'2018-09-11 13:35:55');

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(5,	1),
(7,	2),
(5,	3),
(6,	3),
(7,	3),
(8,	3),
(9,	3),
(10,	3),
(11,	3),
(12,	3),
(13,	3);

DROP TABLE IF EXISTS `satuan`;
CREATE TABLE `satuan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `satuan` (`id`, `nama`) VALUES
(1,	'kg'),
(2,	'g'),
(3,	'Pcs');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `foto`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `kelamin`, `email`, `username`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'Administrator',	NULL,	'Enhaka Residence Blok C7',	'Garut',	'1996-09-09',	'L',	'admin@mail.com',	'admin',	'2018-09-10 17:37:12',	'$2y$10$3AstsrfUxW1TejXbdGSgj.1RtFxQ7X/qYkirDdj6EgWB6vWRfvqma',	'Ohrju8nhkr3F0Q7Hd81rAqmjXOY0zS9TBcbL5MyDQKNAtoX4Ut9ScqyIvmEJ',	'2018-09-10 17:37:19',	'2018-09-11 11:16:36'),
(4,	'Antonio Saiful Islam',	NULL,	'Enhaka Residence Blok C7',	'Garut',	'1996-09-09',	'L',	'finallyantonio@gmail.com',	'antoniosai',	NULL,	'$2y$10$qq42ATCqcQ75Tk.ZbQ3ohu9rI/3AlMxsu4O2KsaDjvgKkwLuZgkGW',	NULL,	'2018-09-13 00:23:54',	'2018-09-13 00:38:49'),
(5,	'Achmad Yalzan',	NULL,	'Garut',	'Garut',	'1995-12-11',	'L',	'codeone@gmail.com',	'codeone',	NULL,	'$2y$10$WEn26Qvd/2z4zLfyiP.LAOw2BVhfVgGgA9J.4JgsJLk0LBjx4CqkS',	NULL,	'2018-09-13 03:29:12',	'2018-09-13 03:29:12'),
(6,	'Dapur',	NULL,	'WMD',	'Garut',	'1996-09-09',	'L',	'dapur@wmd.com',	'dapur',	NULL,	'$2y$10$/GH4FOH98OIhhr2mSxBcZOMPvPseQ26h0xjAhTvJsFn2hgQO7gIbC',	'qBeLv1PzLRcaGTd2QpBsF8whz5LpKr3TPJFDLBJA9wknYRPf6FxmvRMUAbFX',	'2018-09-13 03:34:55',	'2018-09-22 15:30:31'),
(7,	'Admin WMD',	'images/user/3-logo.jpg',	'Garut',	'Garut',	'2018-08-28',	'L',	'wmdgarut@gmail.com',	'wmd',	NULL,	'$2y$10$v5VzUjnm.7k9/L8/p9d8DOzf2KV.zq/CmqcdVLnR2eg6EgTZORDHG',	'jqKqwrTS8I6lPuyeiZDK7OZdiO2YwlmNGGl2ByQdb7wY6gT5toqBiTUlxJrw',	'2018-09-27 06:39:42',	'2018-09-27 06:39:42');

-- 2018-09-30 03:41:13