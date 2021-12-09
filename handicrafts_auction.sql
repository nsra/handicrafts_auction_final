-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2021 at 07:44 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `handicrafts_auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `price` double(19,2) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'PaintingHandicrafts\r\n', 'This category contains products that belong to the craft of painting\r\n', NULL, NULL),
(2, 'PaperHandicrafts', 'This category contains products that belong to the craft of decorating paper\r\n\r\n', NULL, NULL),
(3, 'EmbroideryHandicrafts', 'This category contains products that belong to the craft of embroidery', NULL, NULL),
(4, 'WoolHandicrafts', 'This category contains products that belong to the craft of decorating wools', NULL, NULL),
(5, 'WoodHandicrafts', 'This category contains products that belong to the craft of decorating woods', NULL, NULL),
(6, 'Beadhandicraft', 'This category contains products that belong to the craft of decorating beads', NULL, NULL),
(7, 'NaturalResourcesHandicrafts', 'This category contains products that belong to the craft of using natural resources', NULL, NULL),
(8, 'LeatherHandicrafts', 'This category contains products that belong to the craft of decorating leather', NULL, NULL),
(9, 'PlasticHandicrafts', 'This category contains products that belong to the craft of decorating plastic', NULL, NULL),
(10, 'GlassHandicrafts', 'This category contains products that belong to the craft of decorating glass', NULL, NULL),
(11, 'ClayHandicrafts', 'This category contains products that belong to the craft of decorating clay', NULL, NULL),
(12, 'MetalsHandicrafts', 'This category contains products that belong to the craft of metals', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `path`, `product_id`, `created_at`, `updated_at`) VALUES
(13, 'p2a.jpg', '/storage/uploads/p2a.jpg', 66, '2021-12-08 17:15:44', '2021-12-08 17:15:44'),
(14, 'p2b.jpg', '/storage/uploads/p2b.jpg', 66, '2021-12-08 17:15:44', '2021-12-08 17:15:44'),
(15, 'p3c.jpg', '/storage/uploads/p3c.jpg', 67, '2021-12-08 17:22:56', '2021-12-08 17:22:56'),
(16, 'p3b.jpg', '/storage/uploads/p3b.jpg', 67, '2021-12-08 17:22:56', '2021-12-08 17:22:56'),
(17, 'p3a.jpg', '/storage/uploads/p3a.jpg', 67, '2021-12-08 17:22:56', '2021-12-08 17:22:56'),
(19, 'p4a.jpg', '/storage/uploads/p4a.jpg', 68, '2021-12-08 17:28:25', '2021-12-08 17:28:25'),
(20, 'p4b.jpg', '/storage/uploads/p4b.jpg', 68, '2021-12-08 17:28:25', '2021-12-08 17:28:25'),
(21, 'p5a.jpg', '/storage/uploads/p5a.jpg', 69, '2021-12-08 17:42:58', '2021-12-08 17:42:58'),
(22, 'p5b.jpg', '/storage/uploads/p5b.jpg', 69, '2021-12-08 17:42:58', '2021-12-08 17:42:58'),
(23, 'p5c.jpg', '/storage/uploads/p5c.jpg', 69, '2021-12-08 17:42:58', '2021-12-08 17:42:58'),
(24, 'p61.jpg', '/storage/uploads/p61.jpg', 70, '2021-12-08 17:57:10', '2021-12-08 17:57:10'),
(25, 'p62.jpg', '/storage/uploads/p62.jpg', 70, '2021-12-08 17:57:10', '2021-12-08 17:57:10'),
(26, 'p63.jpg', '/storage/uploads/p63.jpg', 70, '2021-12-08 17:57:10', '2021-12-08 17:57:10'),
(27, 'p7a.jpg', '/storage/uploads/p7a.jpg', 71, '2021-12-08 18:03:46', '2021-12-08 18:03:46'),
(28, 'p7b.jpg', '/storage/uploads/p7b.jpg', 71, '2021-12-08 18:03:46', '2021-12-08 18:03:46'),
(29, 'p7c.jpg', '/storage/uploads/p7c.jpg', 71, '2021-12-08 18:03:46', '2021-12-08 18:03:46'),
(30, 'p8a.jpg', '/storage/uploads/p8a.jpg', 72, '2021-12-08 18:09:18', '2021-12-08 18:09:18'),
(31, 'p8b.jpg', '/storage/uploads/p8b.jpg', 72, '2021-12-08 18:09:18', '2021-12-08 18:09:18'),
(32, 'p9a.jpg', '/storage/uploads/p9a.jpg', 73, '2021-12-08 18:17:58', '2021-12-08 18:17:58'),
(33, 'p9b.jpg', '/storage/uploads/p9b.jpg', 73, '2021-12-08 18:17:58', '2021-12-08 18:17:58'),
(34, 'p10a.jpg', '/storage/uploads/p10a.jpg', 74, '2021-12-08 18:23:21', '2021-12-08 18:23:21'),
(35, 'p10b.jpg', '/storage/uploads/p10b.jpg', 74, '2021-12-08 18:23:22', '2021-12-08 18:23:22');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_10_17_120332_create_orders_table', 1),
(6, '2021_10_17_120418_create_products_table', 1),
(7, '2021_10_17_120429_create_bids_table', 1),
(8, '2021_10_17_120447_create_categories_table', 1),
(9, '2021_10_17_120506_create_images_table', 1),
(10, '2021_11_17_171027_create_products_table', 2),
(11, '2021_11_17_171323_create_bids_table', 3),
(12, '2021_11_17_171427_create_orders_table', 4),
(13, '2021_11_17_171831_create_images_table', 4),
(14, '2021_11_17_174858_create_roles_table', 5),
(15, '2021_11_17_174924_create_permissions_table', 5),
(16, '2021_11_17_175303_create_role_has_permissions_table', 6),
(17, '2021_11_17_180219_add_role_id_to_users_table', 7),
(18, '2021_11_18_161604_add_user_id_to_products_table', 8),
(19, '2021_11_18_181247_add_is-delevered_to_orders_table', 9),
(20, '2021_11_17_175303_create_permission_role_table', 10),
(21, '2021_11_19_192743_add_user_id_to_orders_table', 10),
(22, '2021_11_18_181247_add_is-ordered-by-auction_to_orders_table', 11),
(23, '2021_12_08_080636_create_images_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `price` double(19,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is-ordered-by-auction` tinyint(4) DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('laraveldemo2018@gmail.com', '$2y$10$EwXpHFwaSwiUu9PObP9creXsF9MbiK85Zll2tn9ZOZH1POZflYRMO', '2021-11-17 17:04:07'),
('entesar.2000banna@gmail.com', '$2y$10$dVz5lkF114eS0q2g3asAeet.akUpEjDzPfd/s/yOsFVL4kEFNArN.', '2021-12-06 19:04:26');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `orderNowPrice` double(19,2) NOT NULL,
  `is_delete` tinyint(4) NOT NULL DEFAULT 0,
  `start_auction` timestamp NOT NULL DEFAULT current_timestamp(),
  `end_auction` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 4
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `category_id`, `orderNowPrice`, `is_delete`, `start_auction`, `end_auction`, `created_at`, `updated_at`, `user_id`) VALUES
(66, 'Wool Yarn', '1. Content: 100% Extraordinarily Luxurious Merino wool\r\n2. Specification: 127yd / 116 m ( 1.76 oz / 50 g ), Needle Size: 4-8mm, 1 ball * 50g.\r\n3. Excellent Sourcing: Merino wool is a material derived from Merino sheep and is known for its outstanding characteristics including its excellent softness, gloss and breathability. Merino wool yarn is softer, thinner and warmer than many others.', 4, 84.99, 0, '2021-12-08 17:15:44', '2021-12-31 17:15:44', '2021-12-08 17:15:44', '2021-12-08 17:15:50', 4),
(67, 'Fuyit Natural Wood Slices', 'Natural & Original: Wood Circles are made of natural wood with barks, have a rustic beauty and are in good shape. Some wood bark may fall partially from the slices.\r\nPre-sanded & Polished: Each slice was sanded to make the surface smooth and safe enough for painting, drawing or writing.\r\nEasy to use: Every slice was pre-drilled with a small hole so that you can making personalized hanging ornaments easily with attched twine for home and festival decoration, especially for Christmas tree decoration.', 5, 80.00, 0, '2021-12-08 17:22:56', '2021-12-31 17:22:56', '2021-12-08 17:22:56', '2021-12-08 17:23:03', 4),
(68, 'Best Kit With No Tools Needed', 'Whether you are a jewelry making aficionado or just wanting to start a new hobby, a jewelry making kit is a must-have. These kits come will all the supplies you need to make earrings, necklaces, bracelets, anklets, and more, while also coming in handy when fast, timely repairs are needed.Whether you are a jewelry making aficionado or just wanting to start a new hobby, a jewelry making kit is a must-have. These kits come will all the supplies you need to make earrings, necklaces, bracelets, anklets, and more, while also coming in handy when fast, timely repairs are needed.', 6, 59.99, 0, '2021-12-08 17:28:25', '2021-12-23 17:28:25', '2021-12-08 17:28:25', '2021-12-08 17:28:28', 4),
(69, '4Sets Embroidery Starter Kit with Christmas Pattern', 'Package Include: 1 x plastic embroidery hoop 7.9 inch (20 cm), 3 x Embroidered cloth with pattern, 6 x embroidery needles, 3 x English instructions, 3 x Pack color threads.\r\nBeautiful Christmas Patterns: The Embroidery cloth is with beautiful colored Christmas pattern to make your room more glamorous and full of Christmas atmosphere. You just need to soak the cloth in water directly, the pattern will disappear. So keep the them away from water or any other liquids before you finish it.', 3, 77.99, 0, '2021-12-08 17:42:58', '2021-12-23 17:42:58', '2021-12-08 17:42:58', '2021-12-08 17:43:46', 4),
(70, 'LifeAround2Angels Bath Bombs Gift Set 12 USA made Fizzies', '12 uniquely handcrafted bath bombs. Functional and relaxing. Great Mothers day gifts.\r\nTruly made in California, USA freshly with premium USA natural ingredients - fizzes with colors, will not stain your tub!\r\nTherapeutic and Moisturizing bath bombs, formulated for Normal/Dry skin\r\nDeveloped and Created by us, a bath bomb company with passion\r\nBath Bomb Individually Wrapped. Perfect gift ideas for party favors and wedding. This bath bomb gift sets is on many\'s wish list. Perfect for Fathers Day gifts, birthday gift, gifts for her, spa/bath gifts, for the special one, perfect gifts for mom, wife, girlfriend or women you love.', 2, 129.99, 0, '2021-12-08 17:57:10', '2021-12-23 17:57:10', '2021-12-08 17:57:10', '2021-12-08 17:58:26', 6),
(71, 'Hummingbird Feeder', '✨【VIBRANT BEAUTIFUL COLORS & PATTERN】✨- Attract hummingbirds easily and successfully keeps out insects with the included ant moat and four red flower guards. The different color dotes on the blue glass bottle make it more attractive for birds. Delightful little birds with remarkable flying abilities, hummingbirds are a joy to behold. Lure them to your yard with our hummingbird feeder\r\n💕【EASY TO CLEAN & FILL NECTAR】💕 - Features wide mouth opening with disassembling top & base for easy filling and cleaning. An attached small brush can be used to clean the flower-shaped feeding ports. The clear beautiful glass bottle allows you to more easily see when the food level is low or the unit needs cleaning\r\n💫【100% LEAKPROOF TECHNOLOGY & 40 OZ LARGE CAPACITY】💫- An innovative gasket in the base creates a tight seal to prevent messy leakage. No worry about leaking! Aucied\'s extra-large feeder offers more food for the birds and more viewing time for you with a 40-ounce nectar reservoir. The feeder is ready to hang with a metal hanger to fit most hooks and poles', 10, 110.00, 0, '2021-12-08 18:03:46', '2021-12-23 18:03:46', '2021-12-08 18:03:46', '2021-12-08 18:05:00', 6),
(72, 'Jeevam Clay Products Clay Earthen Cooker with Lid', 'Is Discontinued By Manufacturer ‏ : ‎ No\r\nDate First Available ‏ : ‎ 9 June 2017\r\nManufacturer ‏ : ‎ Jeevam Clay Products\r\nASIN ‏ : ‎ B072K4PTNC\r\nItem part number ‏ : ‎ JVM-3LTR-C0001\r\nManufacturer ‏ : ‎ Jeevam Clay Products\r\nIncluded Components ‏ : ‎ Cooker with lid', 11, 160.00, 0, '2021-12-08 18:09:18', '2021-12-23 18:09:18', '2021-12-08 18:09:18', '2021-12-08 18:09:31', 6),
(73, 'Leather Bound Journal Gift Set', 'Essential Alchemist is an American company that provides a variety of novelty products for customers that care about quality, design, and details. Our products can be collectables or used as gifts during special occasions. It’s also good for personal use and it’s easily portable. Our latest product, the vintage leather bound journal gift set, comes in three different colors to choose from. Don’t wait, join our family now and become an essential alchemist!\r\nWe also want to provide great customer service for everyone. Our customer service team is friendly and responsible, so if you have any questions, concerns or suggestions, feel free to contact us. We would love to hear your valuable feedback.', 8, 199.00, 0, '2021-12-08 18:17:58', '2021-12-23 18:17:58', '2021-12-08 18:17:58', '2021-12-08 18:51:37', 6),
(74, '(200Pcs)100pcs Translucent Plastic Bags/Cellophane Bags ', 'PACK INCLUDE: 100 Packaging Bag with 100 black stickers. does not contain any other decorative items.\r\nMATERIAL : Plastic Translucent Bags. This packaging bag is flat bags don\'t have self adhesive seal function.\r\nUSAGE : Perfect for packaging home-made cookies, candies, pastries, doughnut and more.It also ideal for packing small gifts or accessories. Good choice for gifts.\r\nSIZE:Packaging Bag:8.7*22.8cm,Hand made stickers：10*3cm\r\nClick the Palksky link above to see all of our products', 9, 230.00, 0, '2021-12-08 18:23:21', '2021-12-23 18:23:21', '2021-12-08 18:23:21', '2021-12-08 18:23:52', 6);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL),
(2, 'Craftsman', NULL, NULL),
(3, 'Buyer', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `username`, `email`, `password`, `address`, `mobile`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`, `role_id`) VALUES
(1, 'admin', 'admin', 'admin2022', 'laraveldemo2018@gmail.com', '$2y$10$l9icgrL0l84VOJDsLgRde.ZdHUMBRjr5A.eVNLDrPPH62NuSOBkV2', 'Gaza ElRemal Street', '0592684956', NULL, '5Wur1cSr2PtwgyTZDOXRvylatscciscgDioVsgAiD3QWJpHt1kP5XTza7gHc', NULL, '2021-11-21 09:58:20', 1),
(4, 'entesar', 'elbanna', 'firstcraftsman', 'entesar.2000banna@gmail.com', '$2y$10$rNSVfHwtQ9JOvmlRnEafj.iW0bSjiSk8/1/sSJyu/9QJY1YjLxe2G', 'elreemal', '1234567898', NULL, 'Q3EdQy1WaSzGXKS19qHqwqMeWKbHDivVcyltCFBCW0QWcxrntOLoq9PNLNgT', '2021-11-18 06:35:38', '2021-11-23 08:51:19', 2),
(6, 'sara', 'elbanna', 'secondcraftsman', 'sara.2000banna@gmail.com', '$2y$10$eP6vqOob50mAhongIlR3kenbsujQSbRUq.LqjzkzBHgzM0zZyN4Di', 'remal', '8765432876', NULL, NULL, '2021-11-18 06:56:22', '2021-11-28 04:20:42', 2),
(7, 'rawand', 'ElBanna', 'firstbuyer', 'rawand.2000banna@gmail.com', '$2y$10$x979RXJML3Sq.kayZZ8qgu1GFOXcBsAyQ8FzA0BZNkVXQqev50KQu', 'remal', '1234567899', NULL, NULL, '2021-11-18 13:34:08', '2021-11-18 13:34:08', 3),
(8, 'malak', 'elbanna', 'malak2000', 'malak.2000banna@gmail.com', '$2y$10$Y4a2qwXBGW7juivdRlFbFe2qa9cvb93FwclB7cPx6586RftXFa4IW', 'el remal', '9999999999', NULL, NULL, '2021-11-19 17:38:22', '2021-11-19 17:38:22', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bids_user_id_foreign` (`user_id`),
  ADD KEY `bids_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_product_id_foreign` (`product_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_product_id_foreign` (`product_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_title_unique` (`title`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bids`
--
ALTER TABLE `bids`
  ADD CONSTRAINT `bids_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bids_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
