-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2025 at 10:14 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoppingcart_advanced`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Member','Admin','Workshop') NOT NULL DEFAULT 'Member',
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `address_street` varchar(255) NOT NULL,
  `address_city` varchar(100) NOT NULL,
  `address_state` varchar(100) NOT NULL,
  `address_zip` varchar(50) NOT NULL,
  `address_country` varchar(100) NOT NULL,
  `registered` datetime NOT NULL DEFAULT current_timestamp(),
  `workshop` int(1) NOT NULL,
  `mol` varchar(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `address_company` varchar(50) NOT NULL,
  `dds` varchar(50) NOT NULL,
  `eik` varchar(50) NOT NULL,
  `speedy` varchar(5) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `password`, `role`, `first_name`, `last_name`, `address_street`, `address_city`, `address_state`, `address_zip`, `address_country`, `registered`, `workshop`, `mol`, `company`, `address_company`, `dds`, `eik`, `speedy`, `tel`, `status`) VALUES
(4, 'h@h.bg', '$2y$10$NB1a/AuooucsFfAqAxAnAuRThBKYv/0Reu6SghlUxSTXWay6VrAie', 'Admin', '', '', '', '', '', '', '', '2024-08-10 17:10:18', 0, '', '', '', '', '', '', '0', ''),
(5, 'h.hristev2005@gmail.com', '$2y$10$RrzT5blGB3chQ/mnTGC5EO1lpPih6gU4P4tOZjluTP6PasihKyx7e', 'Admin', 'Христо', 'Христев', 'Офис 130 - ГОЦЕ ДЕЛЧЕВ - СКЛАД, ул. ПАНАИРСКА ЛИВАДА ПРOДЪЛЖЕНИЕТО НА УЛИЦАТА', 'София', 'f', '100', 'Bulgaria', '2024-08-10 18:45:59', 0, 'Георги Гулев', 'ГЕОРГИ ГУЛЕВ - ГМВ ЕООД', 'гр. Гоце Делчев, ул. ПИРИН, 28', 'BG101712329', '101712329', 'ofis', '0878533806', ''),
(7, 'workshop@gmail.com', '$2y$10$TsYz5Da1RURar0ssOLJrtOc3FlauwTQXFeFqJRvxXudDeJXygInKy', 'Workshop', '', '', '', '', '', '', 'Afghanistan', '2024-09-22 14:21:00', 0, '', '', '', '', '', '', '', ''),
(8, 'hshristev@gmail.bg', '$2y$10$lG8fyCHdPmQ5lTnvBG.mZeAawzznK5MlXH.XLxc4Sm.rWal6jqSXG', 'Workshop', 'Hristo', 'Hristev', '', '', '', '', 'Bulgaria', '2025-02-23 13:53:00', 0, '', '', '', '', '', '', '', ''),
(12, 'user@abv.bg', '$2y$10$ARW2qVH.2wHnWQE7nubsLeKf9b0wIYLy8f2Uo1eB5Ap2xJZs/hNPq', 'Member', '', '', '', '', '', '', '', '2025-04-13 10:13:03', 0, '', '', '', '', '', '', '', ''),
(13, 'hristo@bavc.bg', '$2y$10$JB8baJcnHdDdYO.nsbyKnekqlb3XofM8yncvsvfSvLYxTfaLqnaWu', 'Member', 'hristo', 'hristev', '', '', '', '', '', '2025-04-13 10:25:16', 0, '', '', '', '', '', '', '', ''),
(23, 'f@f.bg', '$2y$10$Wyea2lgxr4Aq8gHVVzKTlOAesYat0Cnc8uLehLhvX3HAr0n4KCJxG', 'Workshop', 'tr', 'tr', ' ', ' ', ' ', ' ', 'Bulgaria', '2025-04-16 23:59:00', 0, 'm', 'f', '', 'd', 'e', 'vrata', '01234', ''),
(24, 'borisbtsenev@gmail.com', '$2y$10$hNuaRuBFVstxPZKAEd4Xk.yG1P3CZtTY2karyHCZKR.DPDJf8dXLi', 'Workshop', 'Борис', 'Ценев', 'Kazichene', ' ', ' ', ' ', 'Bulgaria', '2025-06-20 11:51:00', 0, 'мол', 'фирма', 'адрес', 'BG101712329', '101712329', 'ofis', '0123456789', '');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `parent_id`) VALUES
(4, 'DTCO 4.1', 0),
(5, 'Датчици', 0),
(6, 'Тахографи', 4),
(7, 'Комплекти', 4),
(8, 'KITAS 2+', 5),
(9, 'KITAS 4.0', 5),
(10, 'KITAS 2', 5),
(11, 'Аксесоари ', 4),
(12, 'Аксесоари', 0),
(13, 'Телематика', 12),
(14, 'Архиватори', 12),
(15, 'Терморолки и тахошайби', 12);

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `category_ids` varchar(50) NOT NULL,
  `product_ids` varchar(50) NOT NULL,
  `discount_code` varchar(50) NOT NULL,
  `discount_type` enum('Percentage','Fixed') NOT NULL,
  `discount_value` decimal(7,2) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `category_ids`, `product_ids`, `discount_code`, `discount_type`, `discount_value`, `start_date`, `end_date`) VALUES
(1, '', '', 'YEAR2024', 'Percentage', 5.00, '2024-01-01 00:00:00', '2024-12-31 00:00:00'),
(2, '', '', '5OFF', 'Fixed', 5.00, '2024-01-01 00:00:00', '2034-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `date_uploaded` datetime NOT NULL DEFAULT current_timestamp(),
  `full_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `title`, `caption`, `date_uploaded`, `full_path`) VALUES
(7, 'Subscription Placeholder', '', '2024-01-01 00:00:00', 'uploads/subscription.png'),
(8, '1-tacho.png', '', '2024-06-17 13:04:04', 'uploads/1-tacho.png'),
(9, 'dtco_41_side_mbp1.png', '', '2024-08-10 16:17:25', 'uploads/dtco_41_side_mbp1.png'),
(10, 'dtco_41_side_web.jpg', '', '2024-08-10 16:25:10', 'uploads/dtco_41_side_web.jpg'),
(11, '1381.jpg', '', '2024-08-10 16:42:45', 'uploads/1381.jpg'),
(12, '41978910_cad_100.jpg', '', '2024-08-10 16:42:45', 'uploads/41978910_cad_100.jpg'),
(13, 'cronometru-tachotimer3-pentru-regula-de-1-minut_5560_4_16473302399701.jpg', '', '2024-08-10 16:42:45', 'uploads/cronometru-tachotimer3-pentru-regula-de-1-minut_5560_4_16473302399701.jpg'),
(14, 'digi-battery.png', '', '2024-08-10 16:42:45', 'uploads/digi-battery.png'),
(15, 'dsrc_kabel_web.jpg', '', '2024-08-10 16:42:45', 'uploads/dsrc_kabel_web.jpg'),
(16, 'dsrc_web.jpg', '', '2024-08-10 16:42:45', 'uploads/dsrc_web.jpg'),
(17, 'dtco-30-frontal-mit-papier.jpg', '', '2024-08-10 16:42:45', 'uploads/dtco-30-frontal-mit-papier.jpg'),
(18, 'eumbp1-kit.jpg', '', '2024-08-10 16:42:45', 'uploads/eumbp1-kit.jpg'),
(19, 'workshoptab_ii_seitenansicht_schadow.png', '', '2024-08-10 16:42:45', 'uploads/workshoptab_ii_seitenansicht_schadow.png'),
(20, 'скоби-за-1381.jpg', '', '2024-08-10 16:42:45', 'uploads/скоби-за-1381.jpg'),
(21, 'DTCO_Link_3_hell.png', '', '2025-04-12 17:08:14', 'uploads/DTCO_Link_3_hell.png'),
(22, 'VDOLink_Front_hell.png', '', '2025-04-12 17:08:14', 'uploads/VDOLink_Front_hell.png'),
(23, 'VDOLink_Seite_hell.png', '', '2025-04-12 17:08:14', 'uploads/VDOLink_Seite_hell.png'),
(24, '1-DTCO_41_Seite.jpg', '', '2025-04-16 20:33:18', 'uploads/1-DTCO_41_Seite.jpg'),
(25, '1-dtco-4.1-z1-wo-can.jpg', '', '2025-04-16 20:38:42', 'uploads/1-dtco-4.1-z1-wo-can.jpg'),
(26, '1-1-dtco-4.1-z1-w-can.jpg', '', '2025-04-16 20:43:50', 'uploads/1-1-dtco-4.1-z1-w-can.jpg'),
(27, '1-1-dtco-4.1-z2-wo-can.jpg', '', '2025-04-16 20:46:00', 'uploads/1-1-dtco-4.1-z2-wo-can.jpg'),
(28, '1-1-dtco-4.1-z2-w-can.jpg', '', '2025-04-16 20:47:07', 'uploads/1-1-dtco-4.1-z2-w-can.jpg'),
(29, 'DLK Pro Download Key S 2.jpg', '', '2025-04-16 20:48:13', 'uploads/DLK Pro Download Key S 2.jpg'),
(30, 'DLK_PRO_DOWNLOAeD_KEY_S-1.png', '', '2025-04-16 20:56:21', 'uploads/DLK_PRO_DOWNLOAeD_KEY_S-1.png'),
(31, 'KITAS_4_2185-2000020003_L_18.6mm_0-fc4f5f70-320.png', '', '2025-06-15 18:07:54', 'uploads/KITAS_4_2185-2000020003_L_18.6mm_0-fc4f5f70-320.png'),
(32, 'KITAS_4_2185-2000040003_L_23.8mm_0-b665057f-320.png', '', '2025-06-15 18:13:38', 'uploads/KITAS_4_2185-2000040003_L_23.8mm_0-b665057f-320.png'),
(33, 'KITAS_4_2185-2000050003_L_25mm_0-a498bc6b-320.png', '', '2025-06-15 18:20:04', 'uploads/KITAS_4_2185-2000050003_L_25mm_0-a498bc6b-320.png'),
(34, 'KITAS_4_2185-2000060003_L_33.8mm_0-ef2f9731-320.png', '', '2025-06-15 18:25:58', 'uploads/KITAS_4_2185-2000060003_L_33.8mm_0-ef2f9731-320.png');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `sku` varchar(255) NOT NULL DEFAULT '',
  `price` decimal(7,2) NOT NULL,
  `rrp` decimal(7,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `weight` decimal(7,2) NOT NULL DEFAULT 0.00,
  `url_slug` varchar(255) NOT NULL DEFAULT '',
  `product_status` tinyint(1) NOT NULL DEFAULT 1,
  `subscription` tinyint(1) NOT NULL DEFAULT 0,
  `subscription_period` int(11) NOT NULL DEFAULT 0,
  `subscription_period_type` varchar(50) NOT NULL DEFAULT 'day',
  `serial_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `sku`, `price`, `rrp`, `quantity`, `created`, `weight`, `url_slug`, `product_status`, `subscription`, `subscription_period`, `subscription_period_type`, `serial_number`) VALUES
(7, 'DTCO Mob. Package 24/12V-ADR', '', 'mob-package-adr', 123.00, 0.00, 41, '2024-06-17 18:08:00', 0.00, '', 1, 0, 0, 'day', '2910003214600'),
(8, 'DTCO 1381-7550333013 - 24/12V ADR-Z2, Rel. 4.1 с CAN-R', '<!DOCTYPE html>\r\n<html lang=\"bg\">\r\n<head>\r\n    <meta charset=\"UTF-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <title>DTCO 4.1 Тахограф</title>\r\n    <style>\r\n        #product-description {\r\n            font-family: \'Helvetica Neue\', Arial, sans-serif;\r\n            line-height: 1.7;\r\n            background-color: #f0f4f8;\r\n            margin: 0;\r\n            padding: 20px;\r\n            color: #2d3436;\r\n        }\r\n        #product-description h1, #product-description h2 {\r\n            color: #0984e3;\r\n            text-transform: uppercase;\r\n            letter-spacing: 1px;\r\n            margin-top: 0;\r\n        }\r\n        #product-description h1 {\r\n            font-size: 2.5em;\r\n        }\r\n        #product-description h2 {\r\n            margin-top: 40px;\r\n            font-size: 1.5em;\r\n        }\r\n        #product-description p {\r\n            font-size: 1.1em;\r\n            color: #636e72;\r\n            margin-bottom: 20px;\r\n        }\r\n        #product-description ul {\r\n            list-style: none;\r\n            padding: 0;\r\n            margin-left: 0;\r\n        }\r\n        #product-description ul li {\r\n            background: linear-gradient(135deg, #74b9ff 0%, #a29bfe 100%);\r\n            color: white;\r\n            padding: 10px;\r\n            margin-bottom: 10px;\r\n            border-radius: 5px;\r\n            font-size: 1.1em;\r\n        }\r\n        #product-description .content {\r\n            max-width: 800px;\r\n            margin: auto;\r\n        }\r\n        #product-description .reading-time {\r\n            font-style: italic;\r\n            color: #b2bec3;\r\n            margin-bottom: 20px;\r\n        }\r\n        @media (max-width: 768px) {\r\n            #product-description {\r\n                padding: 10px;\r\n            }\r\n            #product-description h1 {\r\n                font-size: 2em;\r\n            }\r\n            #product-description h2 {\r\n                font-size: 1.3em;\r\n            }\r\n        }\r\n    </style>\r\n</head>\r\n<body>\r\n\r\n    <div id=\"product-description\">\r\n        <div class=\"content\">\r\n            <h1>Изключително интелигентен и сигурен: Какво предлага новият тахограф DTCO 4.1?</h1>\r\n            <p class=\"reading-time\"><strong>Време за четене: 3 минути</strong></p>\r\n\r\n            <p>От въвеждането на дигиталния тахограф през 2006 г., технологиите в това малко устройство се развиват все повече. А от август 2023 г., в новите автомобили на европейските пътища ще бъде интегрирана втората версия на интелигентния тахограф. Това бележи началото на нова ера за тахографите.</p>\r\n\r\n            <p>Но какво точно го прави истински фактор за безопасна и честна конкуренция на европейския единен пазар? Обобщихме най-важните функции:</p>\r\n\r\n            <h2>Записване на данни, предоставяне на данни</h2>\r\n            <p>За първи път в своята стогодишна история, тахографът получава допълнителни контролни функции, определени от законодателите, които надхвърлят обичайното записване на шофьорско време, почивка и скорост. Новият тахограф VDO DTCO 4.1 записва следните данни:</p>\r\n            <ul>\r\n                <li>Идентификация на шофьора и превозното средство</li>\r\n                <li>Пресичане на граници за каботажни пътувания и командировки</li>\r\n                <li>Операции по товарене и разтоварване</li>\r\n                <li>Местоположение на превозното средство</li>\r\n                <li>Работни часове</li>\r\n                <li>Съкратени периоди на почивка, които могат да се вземат последователно два пъти</li>\r\n                <li>И т.н.</li>\r\n            </ul>\r\n\r\n            <h2>Умна свързаност с DTCO 4.1</h2>\r\n            <p>Досега за прочитане на данните за време и почивки беше необходимо мобилно устройство като SmartLink или четец на карти. С втората версия на интелигентния тахограф, свързаността е увеличена още веднъж. Освен интерфейса ITS, който трябва да бъде интегриран в новите тахографи, DTCO 4.1 разполага и с Bluetooth интерфейс.</p>\r\n\r\n            <h2>Надеждни данни чрез максимална защита</h2>\r\n            <p>Умният тахограф осигурява надеждни данни, но колко е сигурен? Управителите на автопаркове могат да си отдъхнат! DTCO 4.1 напълно съответства на високите стандарти за сигурност и защита на личните данни и носи сертификат за сигурност по стандарт ISO/IEC 15408 с ниво на оценка EAL 4+ (Ниво на уверение в оценка). Освен това, вече използва данни от европейската навигационна система Galileo, което в бъдеще ще осигури допълнителна сигурност.</p>\r\n\r\n            <h2>Оптимално позициониране с DTCO 4.1 и Galileo</h2>\r\n            <p>Умният тахограф автоматично разпознава текущото местоположение на търговско превозно средство или дали е пресечена граница чрез европейския сигнал Galileo. Веднага щом операторът на сателитната система Galileo предостави данни за местоположение в автентична форма, това ще осигури допълнителна сигурност на данните. Управителите на автопаркове не трябва да се притесняват: дори и в преходния период, има правна сигурност за всички участващи страни благодарение на наскоро приетия Регламент (ЕС 2023/980) от Европейската комисия.</p>\r\n\r\n            <h2>Повече място за данни</h2>\r\n            <p>Умният тахограф (втора версия) е също толкова готов за бъдещето по отношение на съхранението на данни. Вече е подходящ за новите карти на шофьори с разширена капацитет за съхранение, което не е задължително до края на 2024 г. Събраните данни трябва да бъдат съхранени за 56 дни, вместо първоначалните 28 дни. Независимо от това, новият тахограф може, разбира се, да обработва всички останали поколения на картите на шофьорите, които са в употреба в момента.</p>\r\n        </div>\r\n    </div>\r\n\r\n</body>\r\n</html>\r\n', 'DTCO-1381-7550333013-24V-ADRZ2-4.1 w-CANR', 1030.00, 1.00, -1, '2024-08-10 16:16:00', 1.00, 'dtco-4.1-adr-z2-w/-can', 1, 0, 0, 'day', 'AAA2359680021'),
(9, 'DTCO 1381-7550333014 - 24/12V ADR-Z2, Rel. 4.1  без CAN-R', '<!DOCTYPE html>\r\n<html lang=\"bg\">\r\n<head>\r\n    <meta charset=\"UTF-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n    <title>DTCO 4.1 Тахограф</title>\r\n    <style>\r\n        #product-description {\r\n            font-family: \'Helvetica Neue\', Arial, sans-serif;\r\n            line-height: 1.7;\r\n            background-color: #f0f4f8;\r\n            margin: 0;\r\n            padding: 20px;\r\n            color: #2d3436;\r\n        }\r\n        #product-description h1, #product-description h2 {\r\n            color: #0984e3;\r\n            text-transform: uppercase;\r\n            letter-spacing: 1px;\r\n            margin-top: 0;\r\n        }\r\n        #product-description h1 {\r\n            font-size: 2.5em;\r\n        }\r\n        #product-description h2 {\r\n            margin-top: 40px;\r\n            font-size: 1.5em;\r\n        }\r\n        #product-description p {\r\n            font-size: 1.1em;\r\n            color: #636e72;\r\n            margin-bottom: 20px;\r\n        }\r\n        #product-description ul {\r\n            list-style: none;\r\n            padding: 0;\r\n            margin-left: 0;\r\n        }\r\n        #product-description ul li {\r\n            background: linear-gradient(135deg, #74b9ff 0%, #a29bfe 100%);\r\n            color: white;\r\n            padding: 10px;\r\n            margin-bottom: 10px;\r\n            border-radius: 5px;\r\n            font-size: 1.1em;\r\n        }\r\n        #product-description .content {\r\n            max-width: 800px;\r\n            margin: auto;\r\n        }\r\n        #product-description .reading-time {\r\n            font-style: italic;\r\n            color: #b2bec3;\r\n            margin-bottom: 20px;\r\n        }\r\n        @media (max-width: 768px) {\r\n            #product-description {\r\n                padding: 10px;\r\n            }\r\n            #product-description h1 {\r\n                font-size: 2em;\r\n            }\r\n            #product-description h2 {\r\n                font-size: 1.3em;\r\n            }\r\n        }\r\n    </style>\r\n</head>\r\n<body>\r\n\r\n    <div id=\"product-description\">\r\n        <div class=\"content\">\r\n            <h1>Изключително интелигентен и сигурен: Какво предлага новият тахограф DTCO 4.1?</h1>\r\n            <p class=\"reading-time\"><strong>Време за четене: 3 минути</strong></p>\r\n\r\n            <p>От въвеждането на дигиталния тахограф през 2006 г., технологиите в това малко устройство се развиват все повече. А от август 2023 г., в новите автомобили на европейските пътища ще бъде интегрирана втората версия на интелигентния тахограф. Това бележи началото на нова ера за тахографите.</p>\r\n\r\n            <p>Но какво точно го прави истински фактор за безопасна и честна конкуренция на европейския единен пазар? Обобщихме най-важните функции:</p>\r\n\r\n            <h2>Записване на данни, предоставяне на данни</h2>\r\n            <p>За първи път в своята стогодишна история, тахографът получава допълнителни контролни функции, определени от законодателите, които надхвърлят обичайното записване на шофьорско време, почивка и скорост. Новият тахограф VDO DTCO 4.1 записва следните данни:</p>\r\n            <ul>\r\n                <li>Идентификация на шофьора и превозното средство</li>\r\n                <li>Пресичане на граници за каботажни пътувания и командировки</li>\r\n                <li>Операции по товарене и разтоварване</li>\r\n                <li>Местоположение на превозното средство</li>\r\n                <li>Работни часове</li>\r\n                <li>Съкратени периоди на почивка, които могат да се вземат последователно два пъти</li>\r\n                <li>И т.н.</li>\r\n            </ul>\r\n\r\n            <h2>Умна свързаност с DTCO 4.1</h2>\r\n            <p>Досега за прочитане на данните за време и почивки беше необходимо мобилно устройство като SmartLink или четец на карти. С втората версия на интелигентния тахограф, свързаността е увеличена още веднъж. Освен интерфейса ITS, който трябва да бъде интегриран в новите тахографи, DTCO 4.1 разполага и с Bluetooth интерфейс.</p>\r\n\r\n            <h2>Надеждни данни чрез максимална защита</h2>\r\n            <p>Умният тахограф осигурява надеждни данни, но колко е сигурен? Управителите на автопаркове могат да си отдъхнат! DTCO 4.1 напълно съответства на високите стандарти за сигурност и защита на личните данни и носи сертификат за сигурност по стандарт ISO/IEC 15408 с ниво на оценка EAL 4+ (Ниво на уверение в оценка). Освен това, вече използва данни от европейската навигационна система Galileo, което в бъдеще ще осигури допълнителна сигурност.</p>\r\n\r\n            <h2>Оптимално позициониране с DTCO 4.1 и Galileo</h2>\r\n            <p>Умният тахограф автоматично разпознава текущото местоположение на търговско превозно средство или дали е пресечена граница чрез европейския сигнал Galileo. Веднага щом операторът на сателитната система Galileo предостави данни за местоположение в автентична форма, това ще осигури допълнителна сигурност на данните. Управителите на автопаркове не трябва да се притесняват: дори и в преходния период, има правна сигурност за всички участващи страни благодарение на наскоро приетия Регламент (ЕС 2023/980) от Европейската комисия.</p>\r\n\r\n            <h2>Повече място за данни</h2>\r\n            <p>Умният тахограф (втора версия) е също толкова готов за бъдещето по отношение на съхранението на данни. Вече е подходящ за новите карти на шофьори с разширена капацитет за съхранение, което не е задължително до края на 2024 г. Събраните данни трябва да бъдат съхранени за 56 дни, вместо първоначалните 28 дни. Независимо от това, новият тахограф може, разбира се, да обработва всички останали поколения на картите на шофьорите, които са в употреба в момента.</p>\r\n        </div>\r\n    </div>\r\n\r\n</body>\r\n</html>\r\n', 'DTCO-1381-7550333013-24V-ADRZ2-4.1 w/o-CANR', 1030.00, 0.00, 0, '2024-08-10 16:27:00', 1.00, 'dtco-4.1-adr-z2-w/o-can', 1, 0, 0, 'day', 'AAA2359690021'),
(10, 'DTCO 1381-7550333018 - 24/12V ADR-Z1, Rel. 4.1 с CAN-R', '', 'DTCO-1381-7550333013-24V-ADRZ1-4.1-W/-CANR', 1030.00, 0.00, 0, '2024-08-10 16:37:00', 1.00, 'dtco-4.1-adr-z1-w/-can', 1, 0, 0, 'day', 'AAA2359710021'),
(11, 'DTCO 1381-7550333019 - 24/12V ADR-Z1, Rel. 4.1 без CAN-R', '', 'DTCO-1381-7550333013-24V-ADRZ1-4.1-W/O-CANR', 1030.00, 0.00, 44, '2024-08-10 16:40:00', 1.00, 'dtco-4.1-adr-z1-w/o-can', 1, 0, 0, 'day', 'AAA2359700021'),
(12, 'Кабел за DSRC антена L=3000mm.', '', 'кабел-за-DSRC-антена-L-=-3000', 15.00, 0.00, 0, '2024-08-10 16:54:00', 0.25, 'dsrc-cable-fakra-l-3000-mm', 1, 0, 0, 'day', '2910002041400'),
(13, 'Декоративна капачка за DSRC антена', '', 'капачка-за-DSRC-антена', 15.00, 0.00, 11, '2024-08-10 17:01:00', 0.00, 'dsrc-antenna-cover', 1, 0, 0, 'day', 'AAA2371330021'),
(14, 'DSRC антена', '', 'dsrc-антена', 125.00, 0.00, 0, '2024-08-10 17:11:00', 0.25, 'dsrc-antenna', 1, 0, 0, 'day', 'ААА2335640021'),
(15, 'VDO Link', '<!DOCTYPE html>\r\n<html lang=\"en\">\r\n<head>\r\n  <meta charset=\"UTF-8\" />\r\n  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"/>\r\n  <title>VDO Link – Elevate Your Fleet Management</title>\r\n  <!-- Google Font: Open Sans -->\r\n  <link href=\"https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap\" rel=\"stylesheet\">\r\n  <!-- Font Awesome for Bold Icons -->\r\n  <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css\" \r\n        integrity=\"sha512-aA9e6b4U0h+atbJ6kO0E/2I1gT/uhv2q+N1+E1i3k1rSozy4FT8a7f+AVjPXRUhlOVgC5P9i1C2HJZdRZ9OfIg==\" \r\n        crossorigin=\"anonymous\" referrerpolicy=\"no-referrer\" />\r\n</head>\r\n<body style=\"font-family: \'Open Sans\', sans-serif; background-color: #f5f5f5; color: #333; line-height: 1.6; margin:0; padding:0;\">\r\n  <!-- Header image at the top (DO NOT CHANGE) -->\r\n  <div style=\"text-align: center; padding: 20px; background: #fff;\">\r\n    <img src=\"http://localhost/bg/advanced-shopping-cart-system-php/advanced/uploads/VDO_Link_Visual_in_Truck.jpg\" \r\n         alt=\"VDO Link Poster\" \r\n         style=\"max-width: 100%; height: auto;\">\r\n  </div>\r\n  \r\n  <!-- Poster container -->\r\n  <div style=\"max-width: 1000px; margin: 50px auto 100px auto;background: #fff; border-radius: 8px; padding: 30px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);\">\r\n    <h1 id=\"title_vdo-linl\" style=\"font-size: 2.2rem; color: #0086b1; margin-bottom: 20px; text-align: center; font-weight: 700;\">\r\n      VDO Link – Умно решение за Вашия автопарк\r\n    </h1>\r\n    <p class=\"description\" style=\"font-size: 1.2rem; margin-bottom: 30px; text-align: center;\">\r\n      <!-- You can add a catchy description here -->\r\n    </p>\r\n    \r\n    <!-- Features Grid -->\r\n    <div class=\"features-grid\" style=\"display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;\">\r\n      <!-- Feature 1 -->\r\n      <div class=\"feature-box\" style=\"background: #f9f9f9; border-radius: 8px; padding: 20px; text-align: center; cursor: pointer;\">\r\n        <img src=\"http://localhost/bg/advanced-shopping-cart-system-php/advanced/uploads/plug-and-play.png\" \r\n             alt=\"Plug & Play Icon\" \r\n             style=\"width: 50px; height: auto; margin-bottom: 15px;\">\r\n        <h3 style=\"font-size: 1.5rem; color: #0086b1; font-weight: 700; margin-bottom: 10px;\">Plug & Play</h3>\r\n        <p style=\"font-size: 1rem; margin: 0;\">Лесна за настройка и интеграция телематична система</p>\r\n      </div>\r\n      <!-- Feature 2 -->\r\n      <div class=\"feature-box\" style=\"background: #f9f9f9; border-radius: 8px; padding: 20px; text-align: center; cursor: pointer;\">\r\n        <img src=\"http://localhost/bg/advanced-shopping-cart-system-php/advanced/uploads/location-on-map.png\" \r\n             alt=\"location-on-map\" \r\n             style=\"width: 50px; height: auto; margin-bottom: 15px;\">\r\n        <h3 style=\"font-size: 1.5rem; color: #0086b1; font-weight: 700; margin-bottom: 10px;\">Track & Trace</h3>\r\n        <p style=\"font-size: 1rem; margin: 0;\">Следете шофьорите и превозните средства в реално време за максимална точност и надеждност</p>\r\n      </div>\r\n      <!-- Feature 3 -->\r\n      <div class=\"feature-box\" style=\"background: #f9f9f9; border-radius: 8px; padding: 20px; text-align: center; cursor: pointer;\">\r\n        <img src=\"http://localhost/bg/advanced-shopping-cart-system-php/advanced/uploads/cloud-download.png\" \r\n             alt=\"cloud-download\" \r\n             style=\"width: 50px; height: auto; margin-bottom: 15px;\">\r\n        <h3 style=\"font-size: 1.5rem; color: #0086b1; font-weight: 700; margin-bottom: 10px;\">Автоматично сваляне на данни</h3>\r\n        <p style=\"font-size: 1rem; margin: 0;\">Безпроблемно извличане данни от тахограф и карта на водач</p>\r\n      </div>\r\n    </div>\r\n\r\n    <img src=\"http://localhost/bg/advanced-shopping-cart-system-php/advanced/uploads/VDOLink_Animation.gif\" \r\n         alt=\"VDO Link Poster\" \r\n         style=\"max-width: 100%; height: auto;\">\r\n\r\n    <!-- Advantages Section -->\r\n    <h2 style=\"color: #2eab5c; font-size: 1.8rem; margin-top: 20px; margin-bottom: 10px; border-bottom: 2px solid #2eab5c; display: inline-block; padding-bottom: 5px;\">\r\n      Предимства\r\n    </h2>\r\n    <ul style=\"margin-left: 20px; margin-bottom: 20px; font-size: 1.1rem;\">\r\n      <li style=\"margin: 8px 0;\">Отадалечено сваляне на данни от тахограф и карта на водач</li>\r\n      <li style=\"margin: 8px 0;\">Предназначено за малки и средноголеми автопаркове</li>\r\n      <li style=\"margin: 8px 0;\">Евтина и лесна за употреба телематика</li>\r\n      <li style=\"margin: 8px 0;\">За монтаж или ъпдейт не е нужно автомобилът да посещава сервиз</li>\r\n      <li style=\"margin: 8px 0;\">Конфигурируемо дистанционно сваляне</li>\r\n      <li style=\"margin: 8px 0;\">Автоматичните съобщения гарантират целостта на данните в случай на грешки при предаване</li>\r\n      <li style=\"margin: 8px 0;\">В съответствие с разпоредбите на ЕС за цифрови и интелигентни тахографи</li>\r\n      <li style=\"margin: 8px 0;\">Оптимизирани работни процеси в управлението на автопарка</li>\r\n    </ul>\r\n\r\n    <!-- Compatibility Section -->\r\n    <h2 style=\"color: #2eab5c; font-size: 1.8rem; margin-top: 20px; margin-bottom: 10px; border-bottom: 2px solid #2eab5c; display: inline-block; padding-bottom: 5px;\">\r\n      Съвместимост\r\n    </h2>\r\n    <ul style=\"margin-left: 20px; margin-bottom: 20px; font-size: 1.1rem;\">\r\n      <li style=\"margin: 8px 0;\">Съвместим с DTCO 3.0 и по-нови версии</li>\r\n    </ul>\r\n  </div>\r\n</body>\r\n</html>\r\n', 'vdo-link', 300.00, 0.00, 45, '2025-04-12 17:06:00', 0.25, 'vdolink', 1, 0, 0, 'day', 'AAA2201870421'),
(16, 'DLK PRO DOWNLOADKEY S ', '<style>\r\n  .section {\r\n    color: #0086b1;\r\n    font-size: 1.6rem;\r\n    margin-bottom: 15px;\r\n    text-align: center;\r\n    border-bottom: 2px solid #2eab5c;\r\n    display: inline-block;\r\n    padding-bottom: 5px;\r\n  }\r\n  .features-list {\r\n    list-style: none;\r\n    max-width: 700px;\r\n    margin: 20px auto;\r\n    padding: 0;\r\n    display: block;\r\n  }\r\n  .features-list li {\r\n    font-size: 1rem;\r\n    display: flex;\r\n    align-items: flex-start;\r\n    background: #fff;\r\n    padding: 15px 20px;\r\n    border-radius: 6px;\r\n    box-shadow: 0 2px 8px rgba(0,0,0,0.05);\r\n    width: 100%;\r\n    margin-bottom: 12px;\r\n  }\r\n  .features-list li i {\r\n    color: #2eab5c;\r\n    margin-right: 10px;\r\n    margin-top: 4px;\r\n    font-size: 1.2rem;\r\n  }\r\n</style>\r\n<div class=\"features-section\">\r\n  <h2 class=\"section\">Ключови характеристики</h2>\r\n  <ul class=\"features-list\">\r\n    <li><i class=\"fas fa-check-circle\"></i>За всички цифрови и интелигентни тахографи</li>\r\n    <li><i class=\"fas fa-check-circle\"></i>Plug & Play: просто го включете в 6-пиновия слот и свалете данните</li>\r\n    <li><i class=\"fas fa-check-circle\"></i>Цветен 2.2\" дисплей за бърз преглед</li>\r\n    <li><i class=\"fas fa-check-circle\"></i>Трансфер към компютър чрез USB</li>\r\n\r\n    <li><i class=\"fas fa-check-circle\"></i>Вградена функция за напомняне, статус и история на изтеглянията, капацитет и ниво на заряд</li>\r\n  </ul>\r\n</div>\r\n', 'dlk-pro-downlaodkey-s', 500.00, 0.00, 17, '2025-04-16 20:52:00', 0.00, 'dlk-pro-downlaodkey-s', 1, 0, 0, 'day', 'test'),
(17, 'KITAS 4 2185-2000020003 L=18.6mm ', '<div class=\"product-description\">\r\n  <p>\r\n    Датчикът за тахограф <strong>тип 2185-2000020003</strong> е с дължина <strong>L=18.6мм</strong> и е предназначен за интелигентни тахографи <strong>DTCO 1381 Rel.4.0/4.1</strong>, <strong>SE5000-8</strong> и <strong>Efas-4.5</strong>.\r\n  </p>\r\n\r\n  <p>Ползва се за първоначално вграждане в следните марки превозни средства:</p>\r\n  <ul>\r\n    <li>DAF</li>\r\n    <li>Ford</li>\r\n    <li>MAN</li>\r\n    <li>Iveco</li>\r\n    <li>VanHool</li>\r\n    <li>VDL</li>\r\n    <li>ZF</li>\r\n    <li>и други</li>\r\n  </ul>\r\n\r\n  <p>\r\n    <strong>Неуязвим на външно магнитно поле</strong> съгласно изискване на <strong>Регламент (ЕС) 1266/2009</strong>.\r\n  </p>\r\n\r\n\r\n</div>\r\n', 'kitas-4.0-18.6', 175.00, 0.00, 50, '2025-06-15 18:06:00', 0.00, 'kitas-4.0-18.6', 1, 0, 0, 'day', 'A3C1008690021'),
(18, 'KITAS 4 2185-2000020003 L=23.8mm ', '<div class=\"product-description\">\r\n  <p>\r\n    Датчикът за тахограф <strong>тип 2185-2000020003</strong> е с дължина <strong>L=23.8мм</strong> и е предназначен за интелигентни тахографи <strong>DTCO 1381 Rel.4.0/4.1</strong>, <strong>SE5000-8</strong> и <strong>Efas-4.5</strong>.\r\n  </p>\r\n\r\n  <p>Ползва се за първоначално вграждане в следните марки превозни средства:</p>\r\n  <ul>\r\n    <li>Volvo</li>\r\n    <li>Renault</li>\r\n  </ul>\r\n\r\n  <p>\r\n    <strong>Неуязвим на външно магнитно поле</strong> съгласно изискване на <strong>Регламент (ЕС) 1266/2009</strong>.\r\n  </p>\r\n\r\n\r\n</div>\r\n', 'kitas-4.0-23.8', 175.00, 0.00, 39, '2025-06-15 18:10:00', 0.00, 'kitas-4.0-23.8', 1, 0, 0, 'day', 'A3C1008710021'),
(19, 'KITAS 4 2185-2000050003 L=25mm', '<div class=\"product-description\">\r\n  <p>\r\n    Датчикът за тахограф <strong>тип 2185-2000050003</strong> е с дължина <strong>L=18.6мм</strong> и е предназначен за интелигентни тахографи <strong>DTCO 1381 Rel.4.0/4.1</strong>, <strong>SE5000-8</strong> и <strong>Efas-4.5</strong>.\r\n  </p>\r\n\r\n  <p>Ползва се за първоначално вграждане в следните марки превозни средства:</p>\r\n  <ul>\r\n    <li>Mercedes Actros, Arock</li>\r\n\r\n  </ul>\r\n\r\n  <p>\r\n    <strong>Неуязвим на външно магнитно поле</strong> съгласно изискване на <strong>Регламент (ЕС) 1266/2009</strong>.\r\n  </p>\r\n\r\n\r\n</div>\r\n', 'kitas-4.0-25', 175.00, 0.00, 59, '2025-06-15 18:18:00', 0.00, 'kitas-4.0-25', 1, 0, 0, 'day', 'A3C1008720021'),
(20, 'KITAS 4 2185-2000060003 L=33.8mm', '<div class=\"product-description\">\r\n  <p>\r\n    Датчикът за тахограф <strong>тип 2185-2000060003 </strong> е с дължина <strong>L=33.8мм</strong> и е предназначен за интелигентни тахографи <strong>DTCO 1381 Rel.4.0/4.1</strong>, <strong>SE5000-8</strong> и <strong>Efas-4.5</strong>.\r\n  </p>\r\n\r\n  <p>Ползва се за първоначално вграждане в следните марки превозни средства:</p>\r\n  <ul>\r\n    <li>Alexander Dennis</li>\r\n    <li>Iveco</li>\r\n    <li>Ebusco</li>\r\n    <li>EvoBus</li>\r\n    <li>MAN</li>\r\n    <li>Scania</li>\r\n    <li>Solaris</li>\r\n    <li>Tatra</li>\r\n    <li>VanHool</li>\r\n    <li>Volvo</li>\r\n  </ul>\r\n\r\n  <p>\r\n    <strong>Неуязвим на външно магнитно поле</strong> съгласно изискване на <strong>Регламент (ЕС) 1266/2009</strong>.\r\n  </p>\r\n\r\n\r\n</div>\r\n', 'kitas-4.0-33.8', 175.00, 0.00, 15, '2025-06-15 18:22:00', 0.00, 'kitas-4.0-33.8', 1, 0, 0, 'day', 'A3C1008730021');

-- --------------------------------------------------------

--
-- Table structure for table `products_categories`
--

CREATE TABLE `products_categories` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products_categories`
--

INSERT INTO `products_categories` (`id`, `product_id`, `category_id`) VALUES
(9, 7, 7),
(10, 8, 4),
(11, 8, 7),
(20, 9, 4),
(15, 9, 7),
(21, 10, 4),
(22, 10, 7),
(23, 11, 4),
(24, 11, 7),
(26, 12, 11),
(27, 13, 11),
(28, 14, 11),
(32, 15, 13),
(78, 16, 14),
(96, 17, 9),
(99, 18, 9),
(108, 19, 9),
(107, 20, 9);

-- --------------------------------------------------------

--
-- Table structure for table `products_downloads`
--

CREATE TABLE `products_downloads` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products_downloads`
--

INSERT INTO `products_downloads` (`id`, `product_id`, `file_path`, `position`) VALUES
(1, 6, 'hidden/pdf.pdf', 1),
(6, 15, '/uploads/tacho.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products_media`
--

CREATE TABLE `products_media` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `media_id` int(11) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products_media`
--

INSERT INTO `products_media` (`id`, `product_id`, `media_id`, `position`) VALUES
(16, 7, 18, 1),
(17, 12, 15, 1),
(18, 13, 12, 1),
(19, 14, 16, 1),
(20, 15, 23, 1),
(21, 15, 22, 2),
(22, 15, 21, 3),
(24, 11, 25, 1),
(25, 10, 26, 1),
(26, 9, 27, 1),
(27, 8, 28, 1),
(29, 16, 30, 1),
(30, 17, 31, 1),
(31, 18, 32, 1),
(32, 19, 33, 1),
(33, 20, 34, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products_options`
--

CREATE TABLE `products_options` (
  `id` int(11) NOT NULL,
  `option_name` varchar(255) NOT NULL,
  `option_value` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `price_modifier` enum('add','subtract') NOT NULL,
  `weight` decimal(7,2) NOT NULL,
  `weight_modifier` enum('add','subtract') NOT NULL,
  `option_type` enum('select','radio','checkbox','text','datetime') NOT NULL,
  `required` tinyint(1) NOT NULL,
  `position` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `shipping_type` enum('Single Product','Entire Order') NOT NULL DEFAULT 'Single Product',
  `countries` varchar(255) NOT NULL DEFAULT '',
  `price_from` decimal(7,2) NOT NULL,
  `price_to` decimal(7,2) NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `weight_from` decimal(7,2) NOT NULL DEFAULT 0.00,
  `weight_to` decimal(7,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`id`, `title`, `shipping_type`, `countries`, `price_from`, `price_to`, `price`, `weight_from`, `weight_to`) VALUES
(1, 'Standard', 'Entire Order', '', 0.00, 99999.00, 3.99, 0.00, 99999.00);

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `rate` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `country`, `rate`) VALUES
(1, 'Bulgaria', 20.00);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `txn_id` varchar(255) NOT NULL,
  `payment_amount` decimal(7,2) NOT NULL,
  `payment_status` varchar(30) NOT NULL,
  `created` datetime NOT NULL,
  `payer_email` varchar(255) NOT NULL DEFAULT '',
  `first_name` varchar(100) NOT NULL DEFAULT '',
  `last_name` varchar(100) NOT NULL DEFAULT '',
  `address_street` varchar(255) NOT NULL DEFAULT '',
  `address_city` varchar(100) NOT NULL DEFAULT '',
  `address_state` varchar(100) NOT NULL DEFAULT '',
  `address_zip` varchar(50) NOT NULL DEFAULT '',
  `address_country` varchar(100) NOT NULL DEFAULT '',
  `account_id` int(11) DEFAULT NULL,
  `payment_method` varchar(50) NOT NULL DEFAULT 'website',
  `shipping_method` varchar(255) NOT NULL DEFAULT '',
  `shipping_amount` decimal(7,2) NOT NULL DEFAULT 0.00,
  `discount_code` varchar(50) NOT NULL DEFAULT '',
  `mol` varchar(30) NOT NULL,
  `company` varchar(30) NOT NULL,
  `address_company` varchar(50) NOT NULL,
  `dds` varchar(15) NOT NULL,
  `eik` varchar(15) NOT NULL,
  `speedy` varchar(5) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `tracking_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `txn_id`, `payment_amount`, `payment_status`, `created`, `payer_email`, `first_name`, `last_name`, `address_street`, `address_city`, `address_state`, `address_zip`, `address_country`, `account_id`, `payment_method`, `shipping_method`, `shipping_amount`, `discount_code`, `mol`, `company`, `address_company`, `dds`, `eik`, `speedy`, `tel`, `tracking_no`) VALUES
(1, 'SC66701A0619A1D66256', 126.99, 'Изпратена', '2024-06-17 13:12:00', 'admin@example.com', 'John', 'Doe', '98 High Street', 'New York', 'NY', '10001', 'United States', NULL, 'website', 'Standard', 3.99, '', '', '', '', '', '', '', '', 0),
(2, 'SC66701C6CBF70AD5289', 299.19, 'Приключена', '2024-06-17 13:22:00', 'h.hristev2005@gmail.com', 'John', 'Doe', '98 High Street', 'New York', 'NY', '10001', 'Bulgaria', NULL, 'website', 'Standard', 3.99, '', '', '', '', '', '', '', '', 0),
(3, 'SC667138E066C35A4EFA', 150.59, 'Изпратена', '2024-06-18 09:36:00', 'h.hristeev@gmail.com', 'Hristo', 'Hristev', 'Sofia,Burzaritza Str ,19A', 'Sofia', 'Sofia', '1618', 'Bulgaria', NULL, 'website', 'Express', 7.99, '5OFF', '', '', '', '', '', '', '', 0),
(4, 'SC6671471FC6CFD46F08', 146.59, 'Приключена', '2024-06-18 10:36:00', 'h.hristeev@gmail.com', 'Hristo', 'Hristev', 'Sofia,Burzaritza Str ,19A', 'Sofia', 'Sofia', '1618', 'Bulgaria', NULL, 'website', 'Standard', 3.99, '5OFF', '', '', '', '', '', '', '', 0),
(5, 'SC66714725E3B7D1438F', 146.59, 'В изчакване', '2024-06-18 10:36:00', 'h.hristeev@gmail.com', 'Hristo', 'Hristev', 'Sofia,Burzaritza Str ,19A', 'Sofia', 'Sofia', '1618', 'Bulgaria', NULL, 'website', 'Standard', 3.99, '5OFF', '', '', '', '', '', '', '', 0),
(6, 'SC6671479799C9129D3B', 151.59, 'В изчакване', '2024-06-18 10:38:00', 'h.hristeev@gmail.com', 'Hristo', 'Hristev', 'Sofia,Burzaritza Str ,19A', 'Sofia', 'Sofia', '1618', 'Bulgaria', NULL, 'website', 'Standard', 3.99, '', '', '', '', '', '', '', '', 0),
(7, 'SC66B79D6546993FC75D', 1052.99, 'Completed', '2024-08-10 19:03:33', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Albania', 5, 'website', 'Express', 7.99, '', '', '', '', '', '', '', '', 0),
(8, 'SC66B79F6244C9F272A8', 22.99, 'Completed', '2024-08-10 19:12:02', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Albania', 5, 'website', 'Express', 7.99, '', '', '', '', '', '', '', '', 0),
(9, 'SC66B7A2C865D104F572', 153.99, 'Изпратена', '2024-08-10 19:26:00', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'website', 'Standard', 3.99, '', '', '', '', '', '', '', '', 0),
(10, 'SC66DB6568E8FA962E46', 78.99, 'Приключена', '2024-09-06 22:26:00', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', 'f', 'Afghanistan', 6, 'website', 'Standard', 3.99, '', '', '', '', '', '', '', '', 0),
(11, 'SC66DB661528167A708D', 153.99, 'Изпратена', '2024-09-06 22:29:00', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', 'f', 'Bulgaria', 6, 'website', 'Standard', 3.99, '', '', '', '', '', '', '', '', 0),
(12, 'SC66DC6BD34069F020C5', 153.99, 'В изчакване', '2024-09-07 17:05:55', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'website', 'Standard', 3.99, '', '', '', '', '', '', '', '', 0),
(13, 'SC66DC707F3E369B4A29', 21.99, 'Изпратена', '2024-09-07 17:25:00', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'website', 'Standard', 3.99, '', '', '', '', '', '', '', '', 0),
(14, 'SC66DC70CA54B5E61CAC', 1239.99, 'В изчакване', '2024-09-07 17:27:06', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'website', 'Standard', 3.99, '', '', '', '', '', '', '', '', 0),
(15, 'SC66DC8B328A566E4F63', 21.99, 'В изчакване', '2024-09-07 19:19:46', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'website', 'Standard', 3.99, '', '', '', '', '', '', '', '', 0),
(16, 'SC66DC8CC461037EBE02', 21.99, 'В изчакване', '2024-09-07 19:26:28', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'website', 'Standard', 3.99, '', '', '', '', '', '', '', '', 0),
(17, 'SC66DC8DF5459C798ED3', 153.99, 'В изчакване', '2024-09-07 19:31:33', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'website', 'Standard', 3.99, '', '', '', '', '', '', '', '', 0),
(18, 'SC66DC902A8AC17349A0', 153.99, 'В изчакване', '2024-09-07 19:40:58', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'website', 'Standard', 3.99, '', '', '', '', '', '', '', '', 0),
(19, 'SC66DC91CEE8821319E6', 150.00, 'В изчакване', '2024-09-07 19:47:58', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'website', '', 0.00, '', '', '', '', '', '', '', '', 0),
(20, 'SC66DC95768D25E0DA5F', 150.00, 'В изчакване', '2024-09-07 20:03:34', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'website', '', 0.00, '', '', '', '', '', '', '', '', 0),
(21, 'SC66DC96C01BB06BA3E3', 150.00, 'В изчакване', '2024-09-07 20:09:04', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', '', '', 0),
(22, 'SC66DC96EBD6B4153173', 1236.00, 'Подготвена', '2024-09-07 20:09:00', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', '', '', 0),
(23, 'SC66DC976318BE947D2D', 318.00, 'В изчакване', '2024-09-07 20:11:47', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', '', '', 0),
(24, 'SC66DD55A03DF6033691', 18.00, 'В изчакване', '2024-09-08 09:43:28', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', '', '', 0),
(25, 'SC66DD565D600C353C61', 18.00, 'В изчакване', '2024-09-08 09:46:37', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', '', '', 0),
(26, 'SC66DD570FDCD20E6838', 18.00, 'В изчакване', '2024-09-08 09:49:35', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', '', '', 0),
(27, 'SC66DD589CDF69876E3B', 36.00, 'В изчакване', '2024-09-08 09:56:12', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', '', '', 0),
(28, 'SC66DD58CF0F37133FC8', 36.00, 'В изчакване', '2024-09-08 09:57:03', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', '', '', 0),
(29, 'SC66DD5945827D19DAF9', 18.00, 'В изчакване', '2024-09-08 09:59:01', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', '', '', 0),
(30, 'SC66DD5983C03CBF97EC', 90.00, 'В изчакване', '2024-09-08 10:00:03', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', '', '', 0),
(31, 'SC66DD59CA2DCB753418', 18.00, 'В изчакване', '2024-09-08 10:01:14', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', '', '', 0),
(32, 'SC66DD5A9D90AA211098', 18.00, 'В изчакване', '2024-09-08 10:04:45', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', '', '', 0),
(33, 'SC66DD5BF573CEFDFA8C', 18.00, 'В изчакване', '2024-09-08 10:10:29', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', '', '', 0),
(34, 'SC66DD5D306EC3B0E6C4', 18.00, 'В изчакване', '2024-09-08 10:15:44', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', '', '', 0),
(35, 'SC66DD6132321D06B7FF', 18.00, 'В изчакване', '2024-09-08 10:32:50', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', '', '', 0),
(36, 'SC66DD63A135519C0963', 18.00, 'В изчакване', '2024-09-08 10:43:13', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', '', '', 0),
(37, 'SC66DD63BC9097896AB9', 18.00, 'В изчакване', '2024-09-08 10:43:40', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'Банков превод', '', 0.00, '', '', '', '', '', '', '', '', 0),
(38, 'SC66DD99651D9A984751', 18.00, 'В изчакване', '2024-09-08 14:32:37', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', '', '', 0),
(39, 'SC66DD9CAD301EE3D67E', 18.00, 'В изчакване', '2024-09-08 14:46:37', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 's', 's', 's', 's', 's', '', '', 0),
(40, 'SC66DD9FA1562A6E8D58', 18.00, 'В изчакване', '2024-09-08 14:59:13', 'h.hristev2005@gmail.com', 'f', 'f', 'f', 'f', 'f', '100', 'Bulgaria', 5, 'Банков превод', '', 0.00, '', '', '', '', '', '', '', '', 0),
(41, 'SC66DDA0B7647C348295', 18.00, 'В изчакване', '2024-09-08 15:03:51', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30', 'София', 'f', '100', 'Bulgaria', 5, 'Банков превод', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', '200548212', 'BG200548212', '', '', 0),
(42, 'SC66DDA34D2516C542B8', 18.00, 'В изчакване', '2024-09-08 15:14:53', 'h.hristev2005@gmail.com', 'Христо1121', 'Христев', 'Рачка 30', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', '', '', 0),
(43, 'SC66DDA4A5C709C55B49', 18.00, 'В изчакване', '2024-09-08 15:20:37', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 's', 's', 's', 's', 's', '', '', 0),
(44, 'SC66DDA5582CB7A66836', 18.00, 'В изчакване', '2024-09-08 15:23:36', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', '200548212', 'BG200548212', '', '', 0),
(45, 'SC66DDA84986C55F00E2', 18.00, 'В изчакване', '2024-09-08 15:36:09', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', '200548212', 'BG200548212', 'ofis', '', 0),
(46, 'SC66DDA88B5FB52F33A7', 18.00, 'В изчакване', '2024-09-08 15:37:15', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', '200548212', 'BG200548212', 'vrata', '', 0),
(47, 'SC66DDAAAACAD43A6DE8', 18.00, 'В изчакване', '2024-09-08 15:46:18', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', '200548212', 'BG200548212', 'ofis', '', 0),
(48, 'SC66DDABA3E5E0EDA55F', 18.00, 'В изчакване', '2024-09-08 15:50:27', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', '', 0),
(49, 'SC66DDABBFEE4DA05B6F', 18.00, 'В изчакване', '2024-09-08 15:50:55', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', '', 0),
(50, 'SC66DDAE57561CD2F4C2', 18.00, 'В изчакване', '2024-09-08 16:01:59', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 's', 's', 's', 's', 's', 'ofis', '', 0),
(51, 'SC66DDAE6FE127FCD612', 18.00, 'В изчакване', '2024-09-08 16:02:23', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', '', 0),
(52, 'SC66DDAEAA388F820DD6', 18.00, 'В изчакване', '2024-09-08 16:03:22', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', '200548212', 'BG200548212', 'ofis', '', 0),
(53, 'SC66DDAEEE7935A5D6E5', 18.00, 'В изчакване', '2024-09-08 16:04:30', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', '200548212', 'BG200548212', 'ofis', '', 0),
(54, 'SC66DDAF28E9CC534F50', 18.00, 'В изчакване', '2024-09-08 16:05:28', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Банков превод', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', '200548212', 'BG200548212', 'ofis', '', 0),
(55, 'SC66DDB620A9E4B5A6B8', 18.00, 'В изчакване', '2024-09-08 16:35:12', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', '', 0),
(56, 'SC66DDB9F626DFD91A76', 36.00, 'В изчакване', '2024-09-08 16:51:34', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', '0878533806', 0),
(57, 'SC66DDBA5A005FA8F23B', 18.00, 'В изчакване', '2024-09-08 16:53:14', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', '0878533806', 0),
(58, 'SC66DDBA9E5384FB9C64', 18.00, 'В изчакване', '2024-09-08 16:54:22', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', '0878533806', 0),
(59, 'SC66DDC09111D529E3C3', 18.00, 'В изчакване', '2024-09-08 17:19:45', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', '0878533806', 0),
(60, 'SC66DDC13C340C83B508', 18.00, 'В изчакване', '2024-09-08 17:22:36', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'm', 'i', 'a', '', '', 'ofis', '0878533806', 0),
(61, 'SC66DDC22DCD922583C9', 18.00, 'В изчакване', '2024-09-08 17:26:37', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', '200548212', 'BG200548212', 'ofis', '0878533806', 0),
(62, 'SC66DDC2D1C823139489', 18.00, 'В изчакване', '2024-09-08 17:29:00', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', '200548212', 'BG200548212', 'ofis', '0878533806', 0),
(63, 'SC66DDC632C026DF1ED0', 18.00, 'В изчакване', '2024-09-08 17:43:46', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', '200548212', 'BG200548212', 'ofis', '0878533806', 0),
(64, 'SC66DDC7660B18079432', 18.00, 'В изчакване', '2024-09-08 17:48:54', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', '200548212', 'BG200548212', 'ofis', '0878533806', 0),
(65, 'SC66DDC83373E0496C8F', 18.00, 'В изчакване', '2024-09-08 17:52:19', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', '200548212', 'BG200548212', 'ofis', '0878533806', 0),
(66, 'SC66DDC8D0A79A0FF23F', 18.00, 'В изчакване', '2024-09-08 17:54:56', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', '200548212', 'BG200548212', 'ofis', '0878533806', 0),
(67, 'SC66DDC909A45E22AE3C', 18.00, 'В изчакване', '2024-09-08 17:55:53', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', '200548212', 'BG200548212', 'ofis', '0878533806', 0),
(68, 'SC66DDC9396F39AE0EB2', 18.00, 'В изчакване', '2024-09-08 17:56:41', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', '200548212', 'BG200548212', 'ofis', '0878533806', 0),
(69, 'SC66DDC99ED1D06B98F8', 18.00, 'В изчакване', '2024-09-08 17:58:00', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', '200548212', 'BG200548212', 'ofis', '0878533806', 0),
(70, 'SC66DDC9DF6022D277AC', 18.00, 'В изчакване', '2024-09-08 17:59:27', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', '200548212', 'BG200548212', 'ofis', '0878533806', 0),
(71, 'SC66DDD06E9607D6DE0C', 18.00, 'В изчакване', '2024-09-08 18:27:00', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', '200548212', 'BG200548212', 'ofis', '0878533806', 0),
(72, 'SC66DDD0A292F59F7A74', 18.00, 'Изпратена', '2024-09-08 18:28:00', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', '200548212', 'BG200548212', 'ofis', '0878533806', 0),
(73, 'SC66DDD19B5B5FD99B55', 18.00, 'Изпратена', '2024-09-08 18:32:00', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', '200548212', 'BG200548212', 'ofis', '0878533806', 0),
(74, 'SC66DDD2796823EE5838', 18.00, 'Изпратена', '2024-09-08 18:36:00', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', '0878533806', 0),
(75, 'SC66DDD2D198694ACAD6', 18.00, 'Изпратена', '2024-09-08 18:37:00', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', '0878533806', 0),
(76, 'SC66DDD50810F59EBADC', 18.00, 'Изпратена', '2024-09-08 18:47:00', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', '0878533806', 0),
(77, 'SC66DDD66F0C05D55E19', 18.03, 'Изпратена', '2024-09-08 18:53:00', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', '0878533806', 0),
(78, 'SC66DDDD7DAB609C65E5', 18.00, 'В изчакване', '2024-09-08 19:23:09', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', '200548212', 'BG200548212', 'ofis', '0878533806', 0),
(79, 'SC66DDE8AE75A88B0EF2', 18.00, 'Подготвена', '2024-09-08 20:10:00', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', '200548212', 'BG200548212', 'ofis', '0878533806', 0),
(80, 'SC67BB0D3D18AFC15D98', 18.00, 'В изчакване', '2025-02-23 12:57:49', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', '0878533806', 0),
(81, 'SC67BB0E40C1C5414FFF', 18.00, 'Приключена', '2025-02-23 13:02:00', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', '0878533806', 0),
(82, 'SC67BB16286A70B74C46', 18.00, 'В изчакване', '2025-02-23 13:35:52', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', '0878533806', 0),
(83, 'SC67BB6106A9C24C0FD0', 1236.00, 'В изчакване', '2025-02-23 18:55:18', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Банков превод', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(84, 'SC67BB633926C13DCB21', 18.00, 'В изчакване', '2025-02-23 19:04:41', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(85, 'SC67BB633D6BAFF5DB32', 18.00, 'В изчакване', '2025-02-23 19:04:45', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(86, 'SC67FAD681B5093D4D9C', 260.40, 'В изчакване', '2025-04-12 23:09:21', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(87, 'SC67FAD6C44CE316514B', 18.00, 'В изчакване', '2025-04-12 23:10:28', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', '0878533806', 0),
(88, 'SC67FAD6DF3137DD9124', 260.40, 'В изчакване', '2025-04-12 23:10:55', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', '0878533806', 0),
(89, 'SC67FD7FDE9BF103C3E2', 260.40, 'В изчакване', '2025-04-14 23:36:30', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', '0878533806', 0),
(90, 'SC67FD817F1E19137F92', 18.00, 'В изчакване', '2025-04-14 23:43:27', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', '0878533806', 0),
(91, 'SC67FD8385E805446763', 260.40, 'В изчакване', '2025-04-14 23:52:05', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', '0878533806', 0),
(92, 'SC67FD84521A00050B9F', 260.40, 'В изчакване', '2025-04-14 23:55:30', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Банков превод', '', 0.00, '', '', '', '', '', '', 'ofis', '0878533806', 0),
(93, 'SC67FD85162CE17DA668', 260.40, 'В изчакване', '2025-04-14 23:58:46', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', '0878533806', 0),
(94, 'SC67FD8556261F6FFEDA', 260.40, 'Подготвена', '2025-04-14 23:59:00', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'tr', 'tr', 'tr', '4', '4', 'ofis', '0878533806', 0),
(95, 'SC67FD8740366FC5DC5C', 76.00, 'В изчакване', '2025-04-15 00:08:00', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'tr', 'tr', 'tr', '4', '4', 'ofis', '0878533806', 0),
(96, 'SC67FD89B5C69A5CFD20', 1438.00, 'В изчакване', '2025-04-15 00:18:29', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', 'tr', 'tr', 'tr', '4', '4', 'ofis', '0878533806', 0),
(97, 'SC67FFD3453BE79122BC', 76.00, 'Приключена', '2025-04-16 17:56:00', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', '0878533806', 0),
(98, 'SC68000F6E6AADA77274', 618.00, 'В изчакване', '2025-04-16 22:13:34', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', 'София', 'f', '100', 'Bulgaria', 5, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', '0878533806', 0),
(99, 'SC6800103FD48E0D0F5F', 600.00, 'В изчакване', '2025-04-16 22:17:03', 'hshristev@gmail.com', 'Viktor', 'Hristev', 'gf', 'gf', 'gf', 'gf', 'Bulgaria', 14, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', 'fd', 0),
(100, 'SC680011D71F57290BA9', 600.00, 'В изчакване', '2025-04-16 22:23:51', 'hshristev@gmail.com', 'V', 'H', 'address new', 'Sofia', '4', '4', 'Bulgaria', 15, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', '12', 0),
(101, 'SC680015C5E7E0B8B163', 15.00, 'В изчакване', '2025-04-16 22:40:37', 'hshristev@gmail.com', 'v', 'h', 'ds', '', '', '', '', 17, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', 'f', 0),
(102, 'SC6800160162BACA29B9', 500.00, 'В изчакване', '2025-04-16 22:41:37', 'hshristev@gmail.com', 'v', 'h', 'ds', '', '', '', '', 17, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', 'f', 0),
(103, 'SC680016963EB48D76A6', 15.00, 'В изчакване', '2025-04-16 22:44:06', 'hshristev@gmail.com', 'h', 'h', 'test', '', '', '', '', 18, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', '01234567890', 0),
(104, 'SC680017D171B83A7FBF', 500.00, 'В изчакване', '2025-04-16 22:49:21', 'h@h.nh', 'j', 'j', ' 5', '', '', '', '', 19, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', '4', 0),
(105, 'SC6800187115D51CABE3', 63.33, 'В изчакване', '2025-04-16 22:52:01', 'k@k.bg', 'k', 'k', ' KAzichene', '', '', '', '', 20, 'Наложен платеж', '', 0.00, '', 'Стефан Христев', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'vrata', '0878533806', 0),
(106, 'SC680018DF85F118BA71', 63.33, 'В изчакване', '2025-04-16 22:53:51', 'f@f.bg', 'f', 'f', ' kazi', '', '', '', '', 21, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'vrata', '0878533806', 0),
(107, 'SC680019CBD8FA4DC6DE', 63.33, 'В изчакване', '2025-04-16 22:57:47', 'fd@fd.fd', 'fd', 'fd', ' Kazichene', '', '', '', '', 22, 'Наложен платеж', '', 0.00, '', '', '', '', '', '', 'ofis', '0878533806', 0),
(108, 'SC68001A6E371FD12D91', 500.00, 'В изчакване', '2025-04-16 23:00:30', 'f@f.bg', 'tr', 'tr', 'Kazichene', '', '', '', '', 23, 'Наложен платеж', '', 0.00, '', 'm', 'f', 'a', 'd', 'e', 'vrata', '01234', 0),
(109, 'SC684DDB8E0CE4A479B7', 1180.00, 'В изчакване', '2025-06-14 22:29:02', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахое ЕООД', 'рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(110, 'SC684DDE1A96505635C9', 15.00, 'В изчакване', '2025-06-14 22:39:54', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(111, 'SC684DDF409E215E2070', 600.00, 'В изчакване', '2025-06-14 22:44:48', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', '', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(112, 'SC684DDF5D2331F6EE9D', 1836.00, 'Подготвена', '2025-06-14 22:45:00', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', 'Afghanistan', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(113, 'SC684DE276F0BEBFD728', 618.00, 'В изчакване', '2025-06-14 22:58:30', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(114, 'SC684DE2FDAC5AD63BC3', 600.00, 'В изчакване', '2025-06-14 23:00:45', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(115, 'SC684DE3DAE4CBEF662C', 180.00, 'В изчакване', '2025-06-14 23:04:26', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(116, 'SC684DE57D02EBC96A9A', 1236.00, 'В изчакване', '2025-06-14 23:11:25', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(117, 'SC684DE5B2F055936E54', 1236.00, 'В изчакване', '2025-06-14 23:12:18', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(118, 'SC684DE5CD2505CD3EFB', 600.00, 'В изчакване', '2025-06-14 23:12:45', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(119, 'SC684DE601B6C32CD3EA', 1200.00, 'В изчакване', '2025-06-14 23:13:37', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(120, 'SC684DE63FDDCA909AB9', 600.00, 'В изчакване', '2025-06-14 23:14:39', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(121, 'SC684DE782008E3EF8CE', 600.00, 'В изчакване', '2025-06-14 23:20:02', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(122, 'SC684DE804830F6732F4', 4998.00, 'Приключена', '2025-06-14 23:22:00', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София1', '', '', '', 'Afghanistan', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(123, 'SC684E79BD075317EA33', 3072.00, 'В изчакване', '2025-06-15 09:43:57', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(124, 'SC684E7AB54174E555BA', 180.00, 'В изчакване', '2025-06-15 09:48:05', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(125, 'SC684E7B3C5942730F99', 180.00, 'В изчакване', '2025-06-15 09:50:20', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(126, 'SC684E925A94DF560989', 2016.00, 'В изчакване', '2025-06-15 11:28:58', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(127, 'SC684E93B802A7471BAA', 600.00, 'В изчакване', '2025-06-15 11:34:48', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(128, 'SC684E953F8E701473FA', 1236.00, 'В изчакване', '2025-06-15 11:41:19', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(129, 'SC684E95E50439D0CD3A', 1236.00, 'В изчакване', '2025-06-15 11:44:05', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(130, 'SC684E9621937FE54481', 1236.00, 'В изчакване', '2025-06-15 11:45:05', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(131, 'SC684E9646BC646B1F27', 1030.00, 'В изчакване', '2025-06-15 11:45:42', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(132, 'SC684E96C9A91FBC574A', 600.00, 'В изчакване', '2025-06-15 11:47:53', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(133, 'SC684E975A6194C35912', 450.00, 'В изчакване', '2025-06-15 11:50:18', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(134, 'SC684E984AABDDB610C1', 18.00, 'В изчакване', '2025-06-15 11:54:18', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(135, 'SC684E986C26EA2629F2', 16.20, 'В изчакване', '2025-06-15 11:54:52', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(136, 'SC684E98CD3BF3CC15C0', 1112.40, 'В изчакване', '2025-06-15 11:56:29', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(137, 'SC684E9E3CE267C70F4B', 1112.40, 'В изчакване', '2025-06-15 12:19:40', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(138, 'SC684E9E69B3362ADD5C', 540.00, 'В изчакване', '2025-06-15 12:20:25', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(139, 'SC684E9EC076D4385681', 1112.40, 'В изчакване', '2025-06-15 12:21:52', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(140, 'SC684E9F31A5A25BF873', 540.00, 'В изчакване', '2025-06-15 12:23:45', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(141, 'SC684E9FD24FAD8165D1', 162.00, 'В изчакване', '2025-06-15 12:26:26', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(142, 'SC684EA015B4F90DF9B6', 540.00, 'В изчакване', '2025-06-15 12:27:33', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'с х', 'Тахос ЕООД', 'Рачка 30', 'BG200548212', '200548212', 'ofis', '0878533806', 0),
(143, 'SC684EA0E2DFE0CF6E8C', 3708.00, 'В изчакване', '2025-06-15 12:30:58', 'h.hristev2005@gmail.com', 'Христо', 'Христев', '	Офис 130 - ГОЦЕ ДЕЛЧЕВ - СКЛАД, ул. ПАНАИРСКА ЛИВАДА ПРOДЪЛЖЕНИЕТО НА УЛИЦАТА', '', '', '', '', 5, 'Банков превод', '', 0.00, '', 'Георги Гулев', 'ГЕОРГИ ГУЛЕВ - ГМВ ЕООД ', 'гр. Гоце Делчев, ул. ПИРИН, 28', 'BG    101712329', '200548212', 'ofis', '0878533806', 0),
(144, 'SC684EA172ADBAC50D31', 1112.40, 'В изчакване', '2025-06-15 12:33:22', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'Георги Гулев', 'ГЕОРГИ ГУЛЕВ - ГМВ ЕООД', 'гр. Гоце Делчев, ул. ПИРИН, 28', 'BG    101712329', '200548212', 'ofis', '0878533806', 0),
(145, 'SC684EA333C028A47533', 3708.00, 'В изчакване', '2025-06-15 12:40:51', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', '', 5, 'Банков превод', '', 0.00, '', 'Георги Гулев', 'ГЕОРГИ ГУЛЕВ - ГМВ ЕООД', 'гр. Гоце Делчев, ул. ПИРИН, 28', 'BG    101712329', '200548212', 'ofis', '0878533806', 0),
(146, 'SC684EA392717B538DA8', 3337.20, 'В изчакване', '2025-06-15 12:42:00', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Рачка 30, София', '', '', '', 'Afghanistan', 5, 'Наложен платеж', '', 0.00, '', 'Георги Гулев', 'ГЕОРГИ ГУЛЕВ - ГМВ ЕООД', 'гр. Гоце Делчев, ул. ПИРИН, 28', 'BG    101712329', '200548212', 'Налож', '0878533806', 0),
(147, 'SC684EA405C93C8F79D6', 4417.20, 'В изчакване', '2025-06-15 12:44:00', 'h.hristev2005@gmail.com', 'Виктор', 'Христев', 'Рачка 30, София', '', '', '', 'Afghanistan', 5, 'Наложен платеж', '', 0.00, '', 'Георги Гулев', 'ГЕОРГИ ГУЛЕВ - ГМВ ЕООД', 'гр. Гоце Делчев, ул. ПИРИН, 28', 'BG    101712329', '200548212', 'vrata', '0878533806', 0),
(148, 'SC684EA9482E237B7FA2', 540.00, 'В изчакване', '2025-06-15 13:06:00', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Офис 130 - ГОЦЕ ДЕЛЧЕВ - СКЛАД, ул. ПАНАИРСКА ЛИВАДА ПРOДЪЛЖЕНИЕТО НА УЛИЦАТА', '', '', '', 'Afghanistan', 5, 'Наложен платеж', '', 0.00, '', 'Георги Гулев', 'ГЕОРГИ ГУЛЕВ - ГМВ ЕООД', 'гр. Гоце Делчев, ул. ПИРИН, 28', 'BG    101712329', '200548212', 'ofis', '0878533806', 0),
(149, 'SC684EAA9778F0BCF0D1', 540.00, 'В изчакване', '2025-06-15 13:12:23', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Офис 130 - ГОЦЕ ДЕЛЧЕВ - СКЛАД, ул. ПАНАИРСКА ЛИВАДА ПРOДЪЛЖЕНИЕТО НА УЛИЦАТА', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'Георги Гулев', 'ГЕОРГИ ГУЛЕВ - ГМВ ЕООД', 'гр. Гоце Делчев, ул. ПИРИН, 28', 'BG    101712329', '200548212', 'ofis', '0878533806', 0),
(150, 'SC684EABC3153B0A8802', 540.00, 'В изчакване', '2025-06-15 13:17:23', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Офис 130 - ГОЦЕ ДЕЛЧЕВ - СКЛАД, ул. ПАНАИРСКА ЛИВАДА ПРOДЪЛЖЕНИЕТО НА УЛИЦАТА', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'Георги Гулев', 'ГЕОРГИ ГУЛЕВ - ГМВ ЕООД', 'гр. Гоце Делчев, ул. ПИРИН, 28', 'BG    101712329', '200548212', 'ofis', '0878533806', 0),
(151, 'SC684EAC6BA52AC243F7', 540.00, 'В изчакване', '2025-06-15 13:20:11', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Офис 130 - ГОЦЕ ДЕЛЧЕВ - СКЛАД, ул. ПАНАИРСКА ЛИВАДА ПРOДЪЛЖЕНИЕТО НА УЛИЦАТА', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'Георги Гулев', 'ГЕОРГИ ГУЛЕВ - ГМВ ЕООД', 'гр. Гоце Делчев, ул. ПИРИН, 28', 'BG101712329', '101712329', 'ofis', '0878533806', 0),
(152, 'SC684EAC877B4F9F7B7B', 540.00, 'В изчакване', '2025-06-15 13:20:00', 'h.hristev2005@gmail.com', 'Викотр', 'Христев', '124', '', '', '', '', 5, 'Банков превод', '', 0.00, '', '2', '1', '3', '4', '5', 'vrata', '0878533806', 0),
(153, 'SC684EF1F299771D6147', 1301.40, 'В изчакване', '2025-06-15 18:16:50', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Офис 130 - ГОЦЕ ДЕЛЧЕВ - СКЛАД, ул. ПАНАИРСКА ЛИВАДА ПРOДЪЛЖЕНИЕТО НА УЛИЦАТА', '', '', '', '', 5, 'Банков превод', '', 0.00, '', 'Георги Гулев', 'ГЕОРГИ ГУЛЕВ - ГМВ ЕООД', 'гр. Гоце Делчев, ул. ПИРИН, 28', 'BG101712329', '101712329', 'ofis', '0878533806', 0),
(154, 'SC684EFB1268A1C83A57', 189.00, 'Изпратена', '2025-06-15 18:55:00', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Офис 130 - ГОЦЕ ДЕЛЧЕВ - СКЛАД, ул. ПАНАИРСКА ЛИВАДА ПРOДЪЛЖЕНИЕТО НА УЛИЦАТА', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'Георги Гулев', 'ГЕОРГИ ГУЛЕВ - ГМВ ЕООД', 'гр. Гоце Делчев, ул. ПИРИН, 28', 'BG101712329', '101712329', 'ofis', '0878533806', 2147483647),
(155, 'SC6855170FDB8894A262', 540.00, 'В изчакване', '2025-06-20 10:08:47', 'h.hristev2005@gmail.com', 'Христо', 'Христев', 'Офис 130 - ГОЦЕ ДЕЛЧЕВ - СКЛАД, ул. ПАНАИРСКА ЛИВАДА ПРOДЪЛЖЕНИЕТО НА УЛИЦАТА', '', '', '', '', 5, 'Наложен платеж', '', 0.00, '', 'Георги Гулев', 'ГЕОРГИ ГУЛЕВ - ГМВ ЕООД', 'гр. Гоце Делчев, ул. ПИРИН, 28', 'BG101712329', '101712329', 'ofis', '0878533806', 0),
(156, 'SC6855217285A0AA75CE', 162.00, 'Приключена', '2025-06-20 10:53:00', 'borisbtsenev@gmail.com', 'Борис', 'Ценев', 'Kazichene', '', '', '', '', 24, 'Наложен платеж', '', 0.00, '', 'мол', 'фирма', 'адрес', 'BG101712329', '101712329', 'ofis', '0123456789', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `transactions_items`
--

CREATE TABLE `transactions_items` (
  `id` int(11) NOT NULL,
  `txn_id` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_price` decimal(7,2) NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `item_options` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `transactions_items`
--

INSERT INTO `transactions_items` (`id`, `txn_id`, `item_id`, `item_price`, `item_quantity`, `item_options`) VALUES
(1, 'SC66701A0619A1D66256', 7, 123.00, 1, ''),
(2, 'SC66701C6CBF70AD5289', 7, 147.60, 2, ''),
(3, 'SC667138E066C35A4EFA', 7, 142.60, 1, ''),
(4, 'SC6671471FC6CFD46F08', 7, 142.60, 1, ''),
(5, 'SC66714725E3B7D1438F', 7, 142.60, 1, ''),
(6, 'SC6671479799C9129D3B', 7, 147.60, 1, ''),
(7, 'SC66B79D6546993FC75D', 10, 1030.00, 1, ''),
(8, 'SC66B79D6546993FC75D', 12, 15.00, 1, ''),
(9, 'SC66B79F6244C9F272A8', 13, 15.00, 1, ''),
(10, 'SC66B7A2C865D104F572', 14, 150.00, 1, ''),
(11, 'SC66DB6568E8FA962E46', 13, 15.00, 5, ''),
(12, 'SC66DB661528167A708D', 14, 150.00, 1, ''),
(13, 'SC66DC6BD34069F020C5', 14, 150.00, 1, ''),
(14, 'SC66DC707F3E369B4A29', 13, 18.00, 1, ''),
(15, 'SC66DC70CA54B5E61CAC', 8, 1236.00, 1, ''),
(16, 'SC66DC8B328A566E4F63', 13, 18.00, 1, ''),
(17, 'SC66DC8CC461037EBE02', 13, 18.00, 1, ''),
(18, 'SC66DC8DF5459C798ED3', 14, 150.00, 1, ''),
(19, 'SC66DC902A8AC17349A0', 14, 150.00, 1, ''),
(20, 'SC66DC91CEE8821319E6', 14, 150.00, 1, ''),
(21, 'SC66DC95768D25E0DA5F', 14, 150.00, 1, ''),
(22, 'SC66DC96C01BB06BA3E3', 14, 150.00, 1, ''),
(23, 'SC66DC96EBD6B4153173', 9, 1236.00, 1, ''),
(24, 'SC66DC976318BE947D2D', 14, 150.00, 2, ''),
(25, 'SC66DC976318BE947D2D', 13, 18.00, 1, ''),
(26, 'SC66DD55A03DF6033691', 13, 18.00, 1, ''),
(27, 'SC66DD565D600C353C61', 13, 18.00, 1, ''),
(28, 'SC66DD570FDCD20E6838', 13, 18.00, 1, ''),
(29, 'SC66DD589CDF69876E3B', 13, 18.00, 2, ''),
(30, 'SC66DD58CF0F37133FC8', 13, 18.00, 2, ''),
(31, 'SC66DD5945827D19DAF9', 13, 18.00, 1, ''),
(32, 'SC66DD5983C03CBF97EC', 13, 18.00, 5, ''),
(33, 'SC66DD59CA2DCB753418', 13, 18.00, 1, ''),
(34, 'SC66DD5A9D90AA211098', 13, 18.00, 1, ''),
(35, 'SC66DD5BF573CEFDFA8C', 13, 18.00, 1, ''),
(36, 'SC66DD5D306EC3B0E6C4', 13, 18.00, 1, ''),
(37, 'SC66DD6132321D06B7FF', 13, 18.00, 1, ''),
(38, 'SC66DD63A135519C0963', 13, 18.00, 1, ''),
(39, 'SC66DD63BC9097896AB9', 13, 18.00, 1, ''),
(40, 'SC66DD99651D9A984751', 13, 18.00, 1, ''),
(41, 'SC66DD9CAD301EE3D67E', 13, 18.00, 1, ''),
(42, 'SC66DD9FA1562A6E8D58', 13, 18.00, 1, ''),
(43, 'SC66DDA0B7647C348295', 13, 18.00, 1, ''),
(44, 'SC66DDA34D2516C542B8', 13, 18.00, 1, ''),
(45, 'SC66DDA4A5C709C55B49', 13, 18.00, 1, ''),
(46, 'SC66DDA5582CB7A66836', 13, 18.00, 1, ''),
(47, 'SC66DDA84986C55F00E2', 13, 18.00, 1, ''),
(48, 'SC66DDA88B5FB52F33A7', 13, 18.00, 1, ''),
(49, 'SC66DDAAAACAD43A6DE8', 13, 18.00, 1, ''),
(50, 'SC66DDABA3E5E0EDA55F', 13, 18.00, 1, ''),
(51, 'SC66DDABBFEE4DA05B6F', 13, 18.00, 1, ''),
(52, 'SC66DDAE57561CD2F4C2', 13, 18.00, 1, ''),
(53, 'SC66DDAE6FE127FCD612', 13, 18.00, 1, ''),
(54, 'SC66DDAEAA388F820DD6', 13, 18.00, 1, ''),
(55, 'SC66DDAEEE7935A5D6E5', 13, 18.00, 1, ''),
(56, 'SC66DDAF28E9CC534F50', 13, 18.00, 1, ''),
(57, 'SC66DDB620A9E4B5A6B8', 13, 18.00, 1, ''),
(58, 'SC66DDB9F626DFD91A76', 13, 18.00, 2, ''),
(59, 'SC66DDBA5A005FA8F23B', 13, 18.00, 1, ''),
(60, 'SC66DDBA9E5384FB9C64', 13, 18.00, 1, ''),
(61, 'SC66DDC09111D529E3C3', 13, 18.00, 1, ''),
(62, 'SC66DDC13C340C83B508', 13, 18.00, 1, ''),
(63, 'SC66DDC22DCD922583C9', 13, 18.00, 1, ''),
(64, 'SC66DDC2D1C823139489', 13, 18.00, 1, ''),
(65, 'SC66DDC632C026DF1ED0', 13, 18.00, 1, ''),
(66, 'SC66DDC7660B18079432', 13, 18.00, 1, ''),
(67, 'SC66DDC83373E0496C8F', 13, 18.00, 1, ''),
(68, 'SC66DDC8D0A79A0FF23F', 13, 18.00, 1, ''),
(69, 'SC66DDC909A45E22AE3C', 13, 18.00, 1, ''),
(70, 'SC66DDC9396F39AE0EB2', 13, 18.00, 1, ''),
(71, 'SC66DDC99ED1D06B98F8', 13, 18.00, 1, ''),
(72, 'SC66DDC9DF6022D277AC', 13, 18.00, 1, ''),
(73, 'SC66DDD06E9607D6DE0C', 13, 18.00, 1, ''),
(74, 'SC66DDD0A292F59F7A74', 13, 18.00, 1, ''),
(75, 'SC66DDD19B5B5FD99B55', 13, 18.00, 1, ''),
(76, 'SC66DDD2796823EE5838', 13, 18.00, 1, ''),
(77, 'SC66DDD2D198694ACAD6', 13, 18.00, 1, ''),
(78, 'SC66DDD50810F59EBADC', 13, 18.00, 1, ''),
(79, 'SC66DDD66F0C05D55E19', 13, 18.00, 1, ''),
(80, 'SC66DDDD7DAB609C65E5', 13, 18.00, 1, ''),
(81, 'SC66DDE8AE75A88B0EF2', 13, 18.00, 1, ''),
(82, 'SC67BB0D3D18AFC15D98', 13, 18.00, 1, ''),
(83, 'SC67BB0E40C1C5414FFF', 13, 18.00, 1, ''),
(84, 'SC67BB16286A70B74C46', 13, 18.00, 1, ''),
(85, 'SC67BB6106A9C24C0FD0', 11, 1236.00, 1, ''),
(86, 'SC67BB633926C13DCB21', 13, 18.00, 1, ''),
(87, 'SC67BB633D6BAFF5DB32', 13, 18.00, 1, ''),
(88, 'SC67FAD681B5093D4D9C', 15, 260.40, 1, ''),
(89, 'SC67FAD6C44CE316514B', 13, 18.00, 1, ''),
(90, 'SC67FAD6DF3137DD9124', 15, 260.40, 1, ''),
(91, 'SC67FD7FDE9BF103C3E2', 15, 260.40, 1, ''),
(92, 'SC67FD817F1E19137F92', 13, 18.00, 1, ''),
(93, 'SC67FD8385E805446763', 15, 260.40, 1, ''),
(94, 'SC67FD84521A00050B9F', 15, 260.40, 1, ''),
(95, 'SC67FD85162CE17DA668', 15, 260.40, 1, ''),
(96, 'SC67FD8556261F6FFEDA', 15, 260.40, 1, ''),
(97, 'SC67FD8740366FC5DC5C', 15, 76.00, 1, ''),
(98, 'SC67FD89B5C69A5CFD20', 15, 76.00, 1, ''),
(99, 'SC67FD89B5C69A5CFD20', 13, 18.00, 7, ''),
(100, 'SC67FD89B5C69A5CFD20', 11, 1236.00, 1, ''),
(101, 'SC67FFD3453BE79122BC', 15, 76.00, 1, ''),
(102, 'SC68000F6E6AADA77274', 16, 600.00, 1, ''),
(103, 'SC68000F6E6AADA77274', 13, 18.00, 1, ''),
(104, 'SC6800103FD48E0D0F5F', 16, 600.00, 1, ''),
(105, 'SC680011D71F57290BA9', 16, 600.00, 1, ''),
(106, 'SC680015C5E7E0B8B163', 13, 15.00, 1, ''),
(107, 'SC6800160162BACA29B9', 16, 500.00, 1, ''),
(108, 'SC680016963EB48D76A6', 13, 15.00, 1, ''),
(109, 'SC680017D171B83A7FBF', 16, 500.00, 1, ''),
(110, 'SC6800187115D51CABE3', 15, 63.33, 1, ''),
(111, 'SC680018DF85F118BA71', 15, 63.33, 1, ''),
(112, 'SC680019CBD8FA4DC6DE', 15, 63.33, 1, ''),
(113, 'SC68001A6E371FD12D91', 16, 500.00, 1, ''),
(114, 'SC684DDB8E0CE4A479B7', 11, 1030.00, 1, ''),
(115, 'SC684DDB8E0CE4A479B7', 15, 150.00, 1, ''),
(116, 'SC684DDE1A96505635C9', 13, 15.00, 1, ''),
(117, 'SC684DDF409E215E2070', 16, 500.00, 1, ''),
(118, 'SC684DDF5D2331F6EE9D', 16, 500.00, 1, ''),
(119, 'SC684DDF5D2331F6EE9D', 11, 1030.00, 1, ''),
(120, 'SC684DE276F0BEBFD728', 16, 500.00, 1, ''),
(121, 'SC684DE276F0BEBFD728', 13, 15.00, 1, ''),
(122, 'SC684DE2FDAC5AD63BC3', 16, 500.00, 1, ''),
(123, 'SC684DE3DAE4CBEF662C', 15, 150.00, 1, ''),
(124, 'SC684DE57D02EBC96A9A', 11, 1030.00, 1, ''),
(125, 'SC684DE5B2F055936E54', 11, 1030.00, 1, ''),
(126, 'SC684DE5CD2505CD3EFB', 16, 500.00, 1, ''),
(127, 'SC684DE601B6C32CD3EA', 16, 500.00, 2, ''),
(128, 'SC684DE63FDDCA909AB9', 16, 500.00, 1, ''),
(129, 'SC684DE782008E3EF8CE', 16, 500.00, 1, ''),
(130, 'SC684DE804830F6732F4', 16, 500.00, 2, ''),
(131, 'SC684DE804830F6732F4', 11, 1030.00, 3, ''),
(132, 'SC684DE804830F6732F4', 13, 15.00, 5, ''),
(133, 'SC684E79BD075317EA33', 8, 1030.00, 2, ''),
(134, 'SC684E79BD075317EA33', 16, 500.00, 1, ''),
(135, 'SC684E7AB54174E555BA', 15, 150.00, 1, ''),
(136, 'SC684E7B3C5942730F99', 15, 150.00, 1, ''),
(137, 'SC684E925A94DF560989', 16, 500.00, 1, ''),
(138, 'SC684E925A94DF560989', 8, 1030.00, 1, ''),
(139, 'SC684E925A94DF560989', 15, 150.00, 1, ''),
(140, 'SC684E93B802A7471BAA', 16, 500.00, 1, ''),
(141, 'SC684E953F8E701473FA', 8, 1030.00, 1, ''),
(142, 'SC684E95E50439D0CD3A', 8, 1030.00, 1, ''),
(143, 'SC684E9621937FE54481', 8, 1030.00, 1, ''),
(144, 'SC684E9646BC646B1F27', 8, 1030.00, 1, ''),
(145, 'SC684E96C9A91FBC574A', 16, 500.00, 1, ''),
(146, 'SC684E975A6194C35912', 16, 500.00, 1, ''),
(147, 'SC684E984AABDDB610C1', 13, 15.00, 1, ''),
(148, 'SC684E986C26EA2629F2', 13, 15.00, 1, ''),
(149, 'SC684E98CD3BF3CC15C0', 8, 1030.00, 1, ''),
(150, 'SC684E9E3CE267C70F4B', 8, 1030.00, 1, ''),
(151, 'SC684E9E69B3362ADD5C', 16, 500.00, 1, ''),
(152, 'SC684E9EC076D4385681', 11, 1030.00, 1, ''),
(153, 'SC684E9F31A5A25BF873', 16, 500.00, 1, ''),
(154, 'SC684E9FD24FAD8165D1', 15, 150.00, 1, ''),
(155, 'SC684EA015B4F90DF9B6', 16, 500.00, 1, ''),
(156, 'SC684EA0E2DFE0CF6E8C', 8, 1030.00, 3, ''),
(157, 'SC684EA172ADBAC50D31', 11, 1030.00, 1, ''),
(158, 'SC684EA333C028A47533', 8, 1030.00, 3, ''),
(159, 'SC684EA392717B538DA8', 8, 1030.00, 3, ''),
(160, 'SC684EA405C93C8F79D6', 8, 1030.00, 3, ''),
(161, 'SC684EA405C93C8F79D6', 16, 500.00, 2, ''),
(162, 'SC684EA9482E237B7FA2', 16, 500.00, 1, ''),
(163, 'SC684EAA9778F0BCF0D1', 16, 500.00, 1, ''),
(164, 'SC684EABC3153B0A8802', 16, 500.00, 1, ''),
(165, 'SC684EAC6BA52AC243F7', 16, 500.00, 1, ''),
(166, 'SC684EAC877B4F9F7B7B', 16, 500.00, 1, ''),
(167, 'SC684EF1F299771D6147', 18, 175.00, 1, ''),
(168, 'SC684EF1F299771D6147', 11, 1030.00, 1, ''),
(169, 'SC684EFB1268A1C83A57', 19, 175.00, 1, ''),
(170, 'SC6855170FDB8894A262', 16, 500.00, 1, ''),
(171, 'SC6855217285A0AA75CE', 15, 150.00, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `product_id`, `account_id`, `created`) VALUES
(3, 7, 2, '2024-06-18 11:23:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_categories`
--
ALTER TABLE `products_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`,`category_id`);

--
-- Indexes for table `products_downloads`
--
ALTER TABLE `products_downloads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`,`file_path`);

--
-- Indexes for table `products_media`
--
ALTER TABLE `products_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_options`
--
ALTER TABLE `products_options`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`,`option_name`,`option_value`) USING BTREE;

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `txn_id` (`txn_id`);

--
-- Indexes for table `transactions_items`
--
ALTER TABLE `transactions_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `products_categories`
--
ALTER TABLE `products_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `products_downloads`
--
ALTER TABLE `products_downloads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products_media`
--
ALTER TABLE `products_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `products_options`
--
ALTER TABLE `products_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `transactions_items`
--
ALTER TABLE `transactions_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
