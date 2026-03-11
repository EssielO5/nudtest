-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 12 juin 2024 à 01:13
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `essiel_foodies`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `name`, `status`, `email`, `email_verified_at`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 0, 'admin@admin.com', '2024-06-06 20:06:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2024-06-06 20:06:56', '2024-06-06 20:06:56');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `menu_id`, `restaurant_id`, `created_at`, `updated_at`) VALUES
(1, 'Boisson', NULL, 1, 3, '2024-06-07 16:55:56', '2024-06-07 16:55:56'),
(2, 'Déjeuné', NULL, 1, 3, '2024-06-07 16:56:17', '2024-06-07 16:56:17');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `name`, `phone`, `status`, `email`, `email_verified_at`, `password`, `created_at`, `updated_at`) VALUES
(200, 'John Doe', NULL, 1, 'client@client.com', '2024-06-06 20:06:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2024-06-06 20:06:56', '2024-06-06 20:06:56');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(120) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `menus`
--

INSERT INTO `menus` (`id`, `name`, `description`, `restaurant_id`, `created_at`, `updated_at`) VALUES
(1, 'Menu Africain', NULL, 3, '2024-06-07 16:55:11', '2024-06-07 16:55:11'),
(2, 'Menu Européen', NULL, 3, '2024-06-07 16:55:34', '2024-06-07 16:55:34');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 200, 3, 'Cc', '2024-06-07 16:51:39', '2024-06-07 16:51:39'),
(2, 200, 3, 'Vous ne répondez pas ?', '2024-06-08 00:03:40', '2024-06-08 00:03:40'),
(3, 200, 5, '', '2024-06-09 21:39:06', '2024-06-09 21:39:06'),
(4, 200, 5, 'Cc', '2024-06-09 21:42:33', '2024-06-09 21:42:33'),
(5, 200, 5, 'comment tu vas ?', '2024-06-09 21:42:46', '2024-06-09 21:42:46'),
(6, 200, 5, 'Je veux du pain', '2024-06-10 12:18:10', '2024-06-10 12:18:10'),
(7, 200, 3, ',sjskek', '2024-06-10 14:06:42', '2024-06-10 14:06:42'),
(8, 3, 200, 'jeujeieà', '2024-06-10 14:07:50', '2024-06-10 14:07:50'),
(9, 200, 3, 'Je veux', '2024-06-10 14:23:27', '2024-06-10 14:23:27');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_04_11_025947_create_restaurants_table', 1),
(5, '2023_04_13_020600_create_clients_table', 1),
(6, '2023_04_13_225201_create_admins_table', 1),
(7, '2024_05_18_070746_create_messages_table', 1),
(8, '2024_05_20_123901_create_menus_table', 1),
(9, '2024_05_20_123907_create_categories_table', 1),
(10, '2024_05_22_094219_create_plats_table', 1),
(11, '2024_05_28_024453_create_orders_table', 1),
(12, '2024_05_29_010548_create_notifications_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('21c47e4a-e0a3-48f6-94db-232dc7094a0b', 'App\\Notifications\\ClientCommandeNotification', 'App\\Models\\Restaurant', 3, '{\"order_id\":1,\"name\":\"John Doe\",\"phone\":\"21345678\",\"adresse\":\"Godomey\",\"montant_total\":\"1500\",\"created_at\":\"2024-06-07T17:58:53.000000Z\",\"message\":\"Vous avez une nouvelle commande\"}', '2024-06-08 01:33:29', '2024-06-07 16:58:53', '2024-06-08 01:33:29'),
('23ec86bb-4444-4132-a409-a89127a7979b', 'App\\Notifications\\RestaurantCreateNotification', 'App\\Models\\Admin', 1, '{\"restaurant_id\":2,\"name\":\"Point Coca\",\"email\":\"pigierbenin@gmail.com\",\"message\":\"Un nouveau restaurant est cr\\u00e9\\u00e9\"}', '2024-06-06 20:22:25', '2024-06-06 20:18:52', '2024-06-06 20:22:25'),
('2f208d5c-ec31-4d7b-98a0-7eff451b7280', 'App\\Notifications\\RestaurantCreateNotification', 'App\\Models\\Admin', 1, '{\"restaurant_id\":9,\"name\":\"TFG\",\"email\":\"tfg@restaurant.com\",\"message\":\"Un nouveau restaurant est cr\\u00e9\\u00e9\"}', NULL, '2024-06-10 12:48:24', '2024-06-10 12:48:24'),
('49025b89-7471-4359-99ae-13cd1e6b2c70', 'App\\Notifications\\RestaurantCreateNotification', 'App\\Models\\Admin', 1, '{\"restaurant_id\":10,\"name\":\"Nouveau\",\"email\":\"nouveau@restaurant.com\",\"message\":\"Un nouveau restaurant est cr\\u00e9\\u00e9\"}', '2024-06-10 14:43:17', '2024-06-10 14:42:07', '2024-06-10 14:43:17'),
('536461dd-3ee3-4d09-8681-205cb77a1f7a', 'App\\Notifications\\ClientCommandeNotification', 'App\\Models\\Restaurant', 3, '{\"order_id\":3,\"name\":\"John Doe\",\"phone\":\"67676700\",\"adresse\":\"akpapka\",\"montant_total\":\"3000\",\"created_at\":\"2024-06-10T15:27:38.000000Z\",\"message\":\"Vous avez une nouvelle commande\"}', NULL, '2024-06-10 14:27:38', '2024-06-10 14:27:38'),
('9ed15608-b509-4574-9d6b-2de3bf638795', 'App\\Notifications\\RestaurantCreateNotification', 'App\\Models\\Admin', 1, '{\"restaurant_id\":3,\"name\":\"Resto Godomey\",\"email\":\"restaurant2@gmail.com\",\"message\":\"Un nouveau restaurant est cr\\u00e9\\u00e9\"}', '2024-06-07 16:47:35', '2024-06-07 16:45:07', '2024-06-07 16:47:35'),
('c60611fe-9729-48ee-803c-8799ed9dd0b5', 'App\\Notifications\\ClientCommandeNotification', 'App\\Models\\Restaurant', 3, '{\"order_id\":2,\"name\":\"zjzi\",\"phone\":\"67676700\",\"adresse\":\"akpapka\",\"montant_total\":\"1500\",\"created_at\":\"2024-06-10T15:09:57.000000Z\",\"message\":\"Vous avez une nouvelle commande\"}', '2024-06-10 14:10:56', '2024-06-10 14:09:57', '2024-06-10 14:10:56');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `plats` text NOT NULL,
  `montant_total` double NOT NULL,
  `method_of_paiement` varchar(255) DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `name`, `phone`, `adresse`, `plats`, `montant_total`, `method_of_paiement`, `client_id`, `restaurant_id`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', '21345678', 'Godomey', 'a:1:{s:6:\"plat_0\";a:4:{i:0;s:13:\"Pain + avocat\";i:1;s:14:\"1717783048.jpg\";i:2;d:1500;i:3;i:1;}}', 1500, NULL, 200, 3, '2024-06-07 16:58:53', '2024-06-07 16:58:53'),
(2, 'zjzi', '67676700', 'akpapka', 'a:1:{s:6:\"plat_0\";a:4:{i:0;s:13:\"Pain + avocat\";i:1;s:14:\"1717783048.jpg\";i:2;d:1500;i:3;i:1;}}', 1500, NULL, 200, 3, '2024-06-10 14:09:57', '2024-06-10 14:09:57'),
(3, 'John Doe', '67676700', 'akpapka', 'a:1:{s:6:\"plat_0\";a:4:{i:0;s:13:\"Pain + avocat\";i:1;s:14:\"1717783048.jpg\";i:2;d:1500;i:3;i:2;}}', 3000, NULL, 200, 3, '2024-06-10 14:27:38', '2024-06-10 14:27:38');

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `plats`
--

CREATE TABLE `plats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` double NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `restaurant_id` int(11) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `plats`
--

INSERT INTO `plats` (`id`, `name`, `description`, `image`, `price`, `status`, `restaurant_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Pain + avocat', NULL, '1717783048.jpg', 1500, 1, 3, 2, '2024-06-07 16:57:28', '2024-06-07 16:57:28');

-- --------------------------------------------------------

--
-- Structure de la table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `phone`, `location`, `longitude`, `latitude`, `description`, `image`, `status`, `email`, `email_verified_at`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Restaurant', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'restaurant@restaurant.com', '2024-06-06 20:06:56', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2024-06-06 20:06:56', '2024-06-08 01:27:49'),
(2, 'Point Coca', NULL, 'PigierBenin', NULL, NULL, NULL, '1717709688.jpg', 1, 'pigierbenin@gmail.com', NULL, '$2y$10$2Lk7FtyyhVDTvcFrTML05OaVKE82ZXMZI9.sQG3CYyjIxFKK9p9qa', '2024-06-06 20:18:52', '2024-06-06 20:34:48'),
(3, 'Resto Godomey', NULL, 'Godomey', NULL, NULL, NULL, '1717813867.jpg', 1, 'restaurant2@gmail.com', NULL, '$2y$10$l9IcfFQ/yk1NcbR5rJnoeOROad9g.zwNFGVZJY/TMmxFOSWHlWd2i', '2024-06-07 16:45:07', '2024-06-08 01:31:07'),
(5, 'Le Thabor', '67676700', 'Calavi', NULL, NULL, NULL, '1717841227.jpg', 1, 'thabor@restaurant.com', NULL, '$2y$10$zfRO2orRiQeTmvZhiTnZj.kQ9mO/VGMpWQ1RjUR1jPff5ZaeoUOwS', '2024-06-08 09:07:07', '2024-06-08 09:07:07'),
(6, 'Times', '67676701', 'Akpakpka', NULL, NULL, NULL, '1717841326.jpg', 1, 'times@restaurant.com', NULL, '$2y$10$h3osg5lhnTrpllp40p7Csu4/ywGxPimIFe.6o9r2vcNSu37g.Ckmq', '2024-06-08 09:08:46', '2024-06-08 09:08:46'),
(7, 'Lagos Buga', '67676702', 'Akpakpka', NULL, NULL, NULL, '1717841418.jpg', 1, 'lagos@restaurant.com', NULL, '$2y$10$wQ..xhLbgW.1QKBg3k/Pn.uWaInhN1Hzjch/sImlzpSvklB4fc4va', '2024-06-08 09:10:18', '2024-06-08 09:10:18'),
(10, 'Nouveau', NULL, 'Togoudo', NULL, NULL, NULL, NULL, 1, 'nouveau@restaurant.com', NULL, '$2y$10$5mDKbi9Bg.aHsj5Vk7sCqOvR84p7K893p/9Vc3ZiM8/g5RLwLdV2W', '2024-06-10 14:42:07', '2024-06-10 14:43:04');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_menu_id_foreign` (`menu_id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_email_unique` (`email`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menus_restaurant_id_foreign` (`restaurant_id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_client_id_foreign` (`client_id`),
  ADD KEY `orders_restaurant_id_foreign` (`restaurant_id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `plats`
--
ALTER TABLE `plats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plats_category_id_foreign` (`category_id`);

--
-- Index pour la table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `restaurants_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `plats`
--
ALTER TABLE `plats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`);

--
-- Contraintes pour la table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`);

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `orders_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`);

--
-- Contraintes pour la table `plats`
--
ALTER TABLE `plats`
  ADD CONSTRAINT `plats_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
