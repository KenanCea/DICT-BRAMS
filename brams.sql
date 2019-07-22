-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 22, 2019 at 03:48 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `brams`
--

-- --------------------------------------------------------

--
-- Table structure for table `activitylogs`
--

DROP TABLE IF EXISTS `activitylogs`;
CREATE TABLE IF NOT EXISTS `activitylogs` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `log` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `activitylogs_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activitylogs`
--

INSERT INTO `activitylogs` (`id`, `log`, `created_at`, `updated_at`, `user_id`) VALUES
(67, 'Added #123 123123 Purok 12312, Camp Allen', '2019-06-18 18:26:18', '2019-06-18 18:26:18', 1),
(68, 'Added #123123 123123 Purok 12312, Camp Allen', '2019-06-18 18:33:56', '2019-06-18 18:33:56', 1),
(69, 'Archived #123123 123123 Purok 12312, Camp Allen and the Inhabitants residing in', '2019-06-18 18:40:30', '2019-06-18 18:40:30', 1),
(70, 'Archived #123 123123 Purok 12312, Camp Allen and the Inhabitants residing in', '2019-06-18 18:40:33', '2019-06-18 18:40:33', 1),
(71, 'Added #123 123 Purok 123, Camp Allen', '2019-06-18 18:41:01', '2019-06-18 18:41:01', 1),
(72, 'Archived #123 123 Purok 123, Camp Allen and the Inhabitants residing in', '2019-06-18 18:58:29', '2019-06-18 18:58:29', 1),
(73, 'Added #123 123 Purok 123, Camp Allen', '2019-06-18 19:07:21', '2019-06-18 19:07:21', 1),
(74, 'Added 12312, 123123 to #123 123 Purok 123, Camp Allen', '2019-06-18 19:40:58', '2019-06-18 19:40:58', 1),
(75, 'Issued Barangay Certificate to 1231231, 12312', '2019-06-18 20:08:02', '2019-06-18 20:08:02', 1),
(76, 'Archived #123 123 Purok 123, Camp Allen and the Inhabitants residing in', '2019-06-18 23:50:30', '2019-06-18 23:50:30', 1),
(77, 'Restored #123 123123 Purok 12312, Camp Allen', '2019-06-19 00:21:42', '2019-06-19 00:21:42', 1),
(78, 'Restored 12312, 123123 of #123 123123 Purok 12312, Camp Allen', '2019-06-19 00:21:52', '2019-06-19 00:21:52', 1),
(88, 'Issued Barangay Clearance to 12312, 123123', '2019-06-19 07:23:23', '2019-06-19 07:23:23', 1),
(89, 'Updated 12312, 123123 of #123 123123 Purok 12312, Camp Allen', '2019-06-20 03:05:24', '2019-06-20 03:05:24', 1),
(90, 'Issued Barangay Clearance to , ', '2019-06-20 22:21:59', '2019-06-20 22:21:59', 1),
(91, 'Added Doe, JOhn to #123 123123 Purok 12312, Camp Allen', '2019-06-20 22:28:17', '2019-06-20 22:28:17', 1),
(92, 'Updated Doe, John of #123 123123 Purok 12312, Camp Allen', '2019-06-20 23:04:37', '2019-06-20 23:04:37', 1),
(93, 'Updated Doe, John of #123 123123 Purok 12312, Camp Allen', '2019-07-21 21:41:41', '2019-07-21 21:41:41', 1),
(94, 'Archived 12312, 123123 of #123 123123 Purok 12312, Camp Allen', '2019-07-21 21:42:28', '2019-07-21 21:42:28', 1),
(95, 'Archived Doe, John of #123 123123 Purok 12312, Camp Allen', '2019-07-21 21:42:35', '2019-07-21 21:42:35', 1),
(96, 'Added Kenan, Cea to #123 123123 Purok 12312, Camp Allen', '2019-07-21 21:44:32', '2019-07-21 21:44:32', 1),
(97, 'Added Moshe, Baby to #123 123123 Purok 12312, Camp Allen', '2019-07-21 21:46:06', '2019-07-21 21:46:06', 1),
(98, 'Added Dulnuan, bbb to #123 123123 Purok 12312, Camp Allen', '2019-07-21 21:55:13', '2019-07-21 21:55:13', 1),
(99, 'Updated Dulnuan, bbb of #123 123123 Purok 12312, Camp Allen', '2019-07-21 21:57:58', '2019-07-21 21:57:58', 1),
(100, 'Updated Dulnuan, bbb of #123 123123 Purok 12312, Camp Allen', '2019-07-21 22:01:23', '2019-07-21 22:01:23', 1),
(101, 'Updated Dulnuan, bbb of #123 123123 Purok 12312, Camp Allen', '2019-07-21 22:05:26', '2019-07-21 22:05:26', 1),
(102, 'Updated Moshe, Baby of #123 123123 Purok 12312, Camp Allen', '2019-07-21 22:08:20', '2019-07-21 22:08:20', 1),
(103, 'Issued Barangay Clearance to Kenan, Cea', '2019-07-21 22:10:03', '2019-07-21 22:10:03', 1),
(104, 'Issued Barangay Clearance to Moshe, Baby', '2019-07-21 22:14:23', '2019-07-21 22:14:23', 1),
(105, 'Issued Barangay Clearance to , ', '2019-07-21 22:40:54', '2019-07-21 22:40:54', 1),
(106, 'Added official John Wick to the position Punong Barangay, Camp Allen', '2019-07-21 23:08:44', '2019-07-21 23:08:44', 1),
(107, 'Added official Jane Doe to the position Barangay Kagawad, Camp Allen', '2019-07-21 23:09:01', '2019-07-21 23:09:01', 1),
(108, 'Added official John Doe to the position Barangay Kagawad, Camp Allen', '2019-07-21 23:09:19', '2019-07-21 23:09:19', 1),
(109, 'Added official Ace Dodge to the position Barangay Kagawad, Camp Allen', '2019-07-21 23:09:38', '2019-07-21 23:09:38', 1),
(110, 'Added official Alala aAde to the position Barangay Kagawad, Camp Allen', '2019-07-21 23:09:56', '2019-07-21 23:09:56', 1),
(111, 'Added official aash ashaa to the position Barangay Kagawad, Camp Allen', '2019-07-21 23:10:14', '2019-07-21 23:10:14', 1),
(112, 'Added official Aall Mirck to the position Barangay Kagawad, Camp Allen', '2019-07-21 23:10:30', '2019-07-21 23:10:30', 1),
(113, 'Added official DUnn Mirc to the position Barangay Kagawad, Camp Allen', '2019-07-21 23:10:47', '2019-07-21 23:10:47', 1),
(114, 'Added official Kaka akma to the position Barangay Treasurer, Camp Allen', '2019-07-21 23:11:05', '2019-07-21 23:11:05', 1),
(115, 'Added official General bato to the position Barangay Secretary, Camp Allen', '2019-07-21 23:11:23', '2019-07-21 23:11:23', 1),
(116, 'Updated Moshe, Baby of #123 123123 Purok 12312, Camp Allen', '2019-07-21 23:11:54', '2019-07-21 23:11:54', 1),
(117, 'Updated Kenan, Cea of #123 123123 Purok 12312, Camp Allen', '2019-07-21 23:18:18', '2019-07-21 23:18:18', 1),
(118, 'Updated Kenan, Cea of #123 123123 Purok 12312, Camp Allen', '2019-07-21 23:18:53', '2019-07-21 23:18:53', 1),
(119, 'Updated Kenan, Cea of #123 123123 Purok 12312, Camp Allen', '2019-07-21 23:19:15', '2019-07-21 23:19:15', 1),
(120, 'Updated Kenan, Cea of #123 123123 Purok 12312, Camp Allen', '2019-07-21 23:19:26', '2019-07-21 23:19:26', 1),
(121, 'Updated Kenan, Cea of #123 123123 Purok 12312, Camp Allen', '2019-07-21 23:19:40', '2019-07-21 23:19:40', 1),
(122, 'Updated Kenan, Cea of #123 123123 Purok 12312, Camp Allen', '2019-07-21 23:20:09', '2019-07-21 23:20:09', 1),
(123, 'Updated Kenan, Cea of #123 123123 Purok 12312, Camp Allen', '2019-07-21 23:20:16', '2019-07-21 23:20:16', 1),
(128, 'Issued Barangay Clearance to Cea, Kenan', '2019-07-22 00:44:10', '2019-07-22 00:44:10', 1),
(131, 'Issued Barangay Clearance to Moshe, Baby', '2019-07-22 01:24:32', '2019-07-22 01:24:32', 1),
(135, 'Updated official Aall Mircka Position: Barangay Kagawad, Camp Allen', '2019-07-22 03:06:08', '2019-07-22 03:06:08', 1),
(136, 'Added official Asd aaww to the position Barangay Kagawad, Camp Allen', '2019-07-22 03:06:45', '2019-07-22 03:06:45', 1),
(139, 'Issued Barangay Clearance to Moshe, Baby', '2019-07-22 03:15:49', '2019-07-22 03:15:49', 1),
(144, 'Added yrewq, QWERTY to #123 123123 Purok 12312, Camp Allen', '2019-07-22 03:36:01', '2019-07-22 03:36:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `barangays`
--

DROP TABLE IF EXISTS `barangays`;
CREATE TABLE IF NOT EXISTS `barangays` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `municipality` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_barangay` enum('Rural','Urban','Tribal') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `barangays_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangays`
--

INSERT INTO `barangays` (`id`, `municipality`, `province`, `region`, `zip_code`, `type_barangay`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Baguio City', 'Benguet', 'CAR', '2600', 'Rural', '2019-05-15 23:41:09', '2019-05-15 23:41:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `barangay_certificates`
--

DROP TABLE IF EXISTS `barangay_certificates`;
CREATE TABLE IF NOT EXISTS `barangay_certificates` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `control_no` int(11) NOT NULL,
  `purpose_certification` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ctc_no` int(11) NOT NULL,
  `official_receipt_no` int(11) NOT NULL,
  `amount_paid` double NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `house_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purok` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `citizenship` enum('Afghan','Albanian','Algerian','American','Andorran','Angolan','Antiguan','Argentine','Armenian','Aruban','Australian','Austrian','Azerbaijani','Bahamian','Bahrainis','Bangladeshis','Barbadian','Basque','Belarusian','Belgian','Belizean','Beninese','Bermudian','Bhutanese','Bolivian','Bosniak','Bosnian','Botswana','Brazilian','Breton','British','British Virgin Islander','Bruneian','Bulgarian','Macedonian Bulgarian','Burkinabé','Burmese','Burundian','Cambodian','Cameroonian','Canadian','Catalan','Cape Verdean','Chadian','Chilean','Chinese','Colombian','Comorian','Congolese','Costa Rican','Croatian','Cuban','Cypriot','Czech','Dane','Greenlander','Djiboutian','Dominican','Dutch','East Timorese','Ecuadorian','Egyptian','Emirati','English','Equatoguinean','Eritrean','Estonian','Ethiopian','Falkland Islander','Faroese','Fijian','Finn','Finnish Swedish','Filipino','French citizen','Gabonese','Gambian','Georgian','German','Baltic German','Ghanaian','Gibraltarian','Greek','Greek Macedonian','Grenadian','Guatemalan','Guianese','Guinean','Guinea-Bissau national','Guyanese','Haitian','Honduran','Hong Konger','Hungarian','Icelander','I-Kiribati','Indian','Indonesian','Iranian','Iraqis','Irish','Israelis','Italian','Ivoirian','Jamaican','Japanese','Jordanian','Kazakh','Kenyan','Korean','Kosovar','Kuwaitis','Kyrgyz','Lao','Latvian','Lebanese','Liberian','Libyan','Liechtensteiner','Lithuanian','Luxembourger','Macao','Macedonian','Malagasy','Malawian','Malaysian','Maldivian','Malians','Maltese','Manx','Marshallese','Mauritanian','Mauritian','Mexicans','Micronesian','Moldovans','Monégasque','Mongolian','Montenegrin','Moroccan','Mozambican','Namibian','Nauran','Nepalese','New Zealander','Nicaraguan','Nigerien','Nigerian','Norwegian','Omani','Pakistanis','Palauan','Palestinian','Panamanian','Papua New Guinean','Paraguayan','Peruvian','Poles','Portuguese','Puerto Rican','Qatari','Quebecer','Réunionnais','Romanian','Russian','Baltic Russian','Rwandan','Saint Kitt','Saint Lucian','Salvadoran','Sammarinese','Samoans','São Tomé and Príncipe','Saudis','Scot','Senegalese','Serbs','Seychellois','Sierra Leonean','Singaporean','Slovak','Slovene','Solomon Islander','Somalis','Somalilander','Sotho','South African','Spaniard','Sri Lankan','Sudanese','Surinamese','Swazi','Swedes','Swiss','Syriac','Syrian','Taiwanese','Tamil','Tajik','Tanzanian','Thai','Tibetan','Tobagonian','Togolese','Tongan','Trinidadian','Tunisian','Turk','Tuvaluan','Ugandan','Ukrainian','Uruguayan','Uzbek','Vanuatuan','Venezuelan','Vietnamese','Vincentian','Welsh','Yemenis','Zambian','Zimbabwean') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `placeOfBirth_native` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `inhabitant_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `barangay_certificates_inhabitant_id_foreign` (`inhabitant_id`),
  KEY `barangay_certificates_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangay_certificates`
--

INSERT INTO `barangay_certificates` (`id`, `control_no`, `purpose_certification`, `ctc_no`, `official_receipt_no`, `amount_paid`, `last_name`, `first_name`, `middle_name`, `house_no`, `purok`, `street`, `date_of_birth`, `citizenship`, `placeOfBirth_native`, `created_at`, `updated_at`, `inhabitant_id`, `user_id`) VALUES
(1, 122312, '123123', 3123123, 1123, 123123, '1231231', '12312', '3123', '123', '1231', '23123', '2019-06-07', 'Afghan', '123123', '2019-06-18 20:08:02', '2019-06-18 20:08:02', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `barangay_clearances`
--

DROP TABLE IF EXISTS `barangay_clearances`;
CREATE TABLE IF NOT EXISTS `barangay_clearances` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `control_no` int(11) NOT NULL,
  `ctc_no` int(11) NOT NULL,
  `purpose_of_clearance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `official_receipt_no` int(11) NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `house_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purok` int(11) DEFAULT NULL,
  `street` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `citizenship` enum('Afghan','Albanian','Algerian','American','Andorran','Angolan','Antiguan','Argentine','Armenian','Aruban','Australian','Austrian','Azerbaijani','Bahamian','Bahrainis','Bangladeshis','Barbadian','Basque','Belarusian','Belgian','Belizean','Beninese','Bermudian','Bhutanese','Bolivian','Bosniak','Bosnian','Botswana','Brazilian','Breton','British','British Virgin Islander','Bruneian','Bulgarian','Macedonian Bulgarian','Burkinabé','Burmese','Burundian','Cambodian','Cameroonian','Canadian','Catalan','Cape Verdean','Chadian','Chilean','Chinese','Colombian','Comorian','Congolese','Costa Rican','Croatian','Cuban','Cypriot','Czech','Dane','Greenlander','Djiboutian','Dominican','Dutch','East Timorese','Ecuadorian','Egyptian','Emirati','English','Equatoguinean','Eritrean','Estonian','Ethiopian','Falkland Islander','Faroese','Fijian','Finn','Finnish Swedish','Filipino','French citizen','Gabonese','Gambian','Georgian','German','Baltic German','Ghanaian','Gibraltarian','Greek','Greek Macedonian','Grenadian','Guatemalan','Guianese','Guinean','Guinea-Bissau national','Guyanese','Haitian','Honduran','Hong Konger','Hungarian','Icelander','I-Kiribati','Indian','Indonesian','Iranian','Iraqis','Irish','Israelis','Italian','Ivoirian','Jamaican','Japanese','Jordanian','Kazakh','Kenyan','Korean','Kosovar','Kuwaitis','Kyrgyz','Lao','Latvian','Lebanese','Liberian','Libyan','Liechtensteiner','Lithuanian','Luxembourger','Macao','Macedonian','Malagasy','Malawian','Malaysian','Maldivian','Malians','Maltese','Manx','Marshallese','Mauritanian','Mauritian','Mexicans','Micronesian','Moldovans','Monégasque','Mongolian','Montenegrin','Moroccan','Mozambican','Namibian','Nauran','Nepalese','New Zealander','Nicaraguan','Nigerien','Nigerian','Norwegian','Omani','Pakistanis','Palauan','Palestinian','Panamanian','Papua New Guinean','Paraguayan','Peruvian','Poles','Portuguese','Puerto Rican','Qatari','Quebecer','Réunionnais','Romanian','Russian','Baltic Russian','Rwandan','Saint Kitt','Saint Lucian','Salvadoran','Sammarinese','Samoans','São Tomé and Príncipe','Saudis','Scot','Senegalese','Serbs','Seychellois','Sierra Leonean','Singaporean','Slovak','Slovene','Solomon Islander','Somalis','Somalilander','Sotho','South African','Spaniard','Sri Lankan','Sudanese','Surinamese','Swazi','Swedes','Swiss','Syriac','Syrian','Taiwanese','Tamil','Tajik','Tanzanian','Thai','Tibetan','Tobagonian','Togolese','Tongan','Trinidadian','Tunisian','Turk','Tuvaluan','Ugandan','Ukrainian','Uruguayan','Uzbek','Vanuatuan','Venezuelan','Vietnamese','Vincentian','Welsh','Yemenis','Zambian','Zimbabwean') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `placeOfBirth_native` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `inhabitant_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `barangay_clearances_inhabitant_id_foreign` (`inhabitant_id`),
  KEY `barangay_clearances_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangay_clearances`
--

INSERT INTO `barangay_clearances` (`id`, `control_no`, `ctc_no`, `purpose_of_clearance`, `official_receipt_no`, `last_name`, `first_name`, `middle_name`, `house_no`, `purok`, `street`, `date_of_birth`, `citizenship`, `placeOfBirth_native`, `created_at`, `updated_at`, `inhabitant_id`, `user_id`) VALUES
(3, 12345, 54321, 'Postal ID', 12345432, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-19 07:23:23', '2019-06-19 07:23:23', 20033, 1),
(4, 123451, 12312, 'asdasd', 12312, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-20 22:21:59', '2019-06-20 22:21:59', NULL, 1),
(5, 1234, 231, 'Postal ID', 12356, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-21 22:10:03', '2019-07-21 22:10:03', 20036, 1),
(6, 1222, 1221, 'asasd', 1211, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-21 22:14:23', '2019-07-21 22:14:23', 20037, 1),
(7, 22211, 12341, 'asdasd', 2111, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-21 22:40:54', '2019-07-21 22:40:54', NULL, 1),
(8, 123, 233, 'POSTAL ID', 123455, 'Cea', 'Kenan', NULL, '1', 1, 'Camp allen st', '2000-01-01', 'Filipino', 'Banaue, Ifugao', '2019-07-22 00:44:10', '2019-07-22 00:44:10', NULL, 1),
(9, 2315, 3214, 'ljhlkj', 3265, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-22 01:24:32', '2019-07-22 01:24:32', 20037, 1),
(10, 12333, 1221, '2113', 1112, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-22 03:15:49', '2019-07-22 03:15:49', 20037, 1);

-- --------------------------------------------------------

--
-- Table structure for table `business_clearances`
--

DROP TABLE IF EXISTS `business_clearances`;
CREATE TABLE IF NOT EXISTS `business_clearances` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `control_no` int(11) NOT NULL,
  `business_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_trade_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_application` enum('New','Renewal') COLLATE utf8mb4_unicode_ci NOT NULL,
  `kind_business` enum('Agriculture','Construction','Electricity/gas and water','Wholesale retail, and trade','Transport, storage communications','Community Social and personal services','Financing Insurance','Real States','Manufacturing','Mining') COLLATE utf8mb4_unicode_ci NOT NULL,
  `line_of_business` enum('Poultry/Livestock','Nurseries/Flower Growing','Breeding Stations','Fishponds/Fishpens','Vineyards/Mussel Farms','Orchards/Vineyards','Vegetable Farms','Supermarkets','Groceries/Dry Goods Stores','Sari-sari Stores','Banks and Financial/Lending Institutions','Auto Supply and Motorports','Distributors, Dealers of Various Products','Gasoline stations','Photo and Record Shops','Jewelry Stores','Pawnshops','General Services/Contractors','Beauty Parlors or Barber shops','Fitness Gyms','Restaurants','Insurance/Dealer in Securities','Furniture Shops','Livestock and Poultry Supplyes Stores','Hardware/Electric Supplies','Videoke Shops','Computer Shops/Internet Cafe','Buy and Sell Stations','Water Refilling Stations','Hotel/Inns','Apartment/Boarding House','Handicraft','Metalcraft','Garments','Ceramics','Food Processing','Mining and Quarrying','Factories','Rice/Corn/Flour/Saw Mills','Junkshops') COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_taken` enum('Approval','Disapproval') COLLATE utf8mb4_unicode_ci NOT NULL,
  `reasons_approv_disapprove` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ctc_no` int(11) NOT NULL,
  `official_receipt_no` int(11) NOT NULL,
  `total_amt_paid` double NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `house_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purok` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `inhabitant_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `business_clearances_inhabitant_id_foreign` (`inhabitant_id`),
  KEY `business_clearances_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `filedcases`
--

DROP TABLE IF EXISTS `filedcases`;
CREATE TABLE IF NOT EXISTS `filedcases` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `control_no` int(11) NOT NULL,
  `respondent` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `case` enum('Collecting sum of money','Estafa','Malicius Mischief','Physical Injury','Physical Injury with Robbery','Theft','Threat','Unjust Vexation','Murder','Rape','Children in Conflict of the law') COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_of_case` enum('Criminal','Civil','Others') COLLATE utf8mb4_unicode_ci NOT NULL,
  `complainant` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `co_complainant` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_taken_on_settled` enum('Arbitration','Conciliation','Mediation') COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_taken_on_unsettled` enum('Repudiation','Withdrawn','Pending case','Case dismissed','Case certified','Referred to concerned agencies') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `inhabitant_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `filedcases_inhabitant_id_foreign` (`inhabitant_id`),
  KEY `filedcases_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `households`
--

DROP TABLE IF EXISTS `households`;
CREATE TABLE IF NOT EXISTS `households` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `house_no` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purok` int(11) NOT NULL,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `solo_parent` enum('No','Death of spouse','Imprisonment of spouse of at least 1 year','Mental/physical incapacity of spouse','Legal or de facto separation from spouse for at least 1 year','Abandonment of spouse for at least 1 year','Unmarried mother/father who preferred to keep the child instead of others carrying him/her','Any other person who solely provides parental care and support to a child provided he/she is duly licensed foster parent of DSWD','Any family member who assumes the responsibility as head of the family as a result of death, abandonment, absence for at least one year','Others') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `solo_parent_others` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dateOfSurvey` date DEFAULT NULL,
  `placeOfOrigin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ethnic_group` enum('Bicol','Bisaya','Boholano','Capizeno','Cuyunon','Ibaloi','Ilonggo','Ifugao','Ilocano','Ivatan','Kalinga','Kankana-ey','Kapangpangan','Maguindanao','Maranao','Masbateno','Pangasinan','Surigaoan','Tagalog','Tausog','Waray','Yakan','Zambagueno/Chavacano','N/A') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_address` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` int(20) DEFAULT NULL,
  `telephone_no` int(20) DEFAULT NULL,
  `dialects` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_of_ownership_house` enum('Owned','Rented','Caretaker','Others') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_of_ownership_house_others` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_of_ownership_lot` enum('Owned','Rented','Caretaker','Others') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_of_ownership_lot_others` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_of_dwelling` enum('Permanent Concrete','Semi Permanent','Temporary') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_of_dwelling_structure` enum('Permanent Concrete','Semi Permanent','Temporary') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lighting_source` enum('Electricity','Solar','Petromax','Kerosene') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sources_of_info` enum('Television','Radio','Newspaper','Others') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sources_of_info_others` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `communication_services` enum('Cell sites/Net','Internet','Telephone','Postal services','Others') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `communication_services_others` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `means_of_transportation` enum('PU jeep',' Taxi','Tricycle','PU bus','Private car','Others') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `means_of_transportation_others` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `archive` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `Total_family_income` double DEFAULT NULL,
  `Final_family_income` double DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `households_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1053 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `households`
--

INSERT INTO `households` (`id`, `house_no`, `purok`, `street`, `solo_parent`, `solo_parent_others`, `dateOfSurvey`, `placeOfOrigin`, `ethnic_group`, `email_address`, `mobile_no`, `telephone_no`, `dialects`, `status_of_ownership_house`, `status_of_ownership_house_others`, `status_of_ownership_lot`, `status_of_ownership_lot_others`, `type_of_dwelling`, `type_of_dwelling_structure`, `lighting_source`, `sources_of_info`, `sources_of_info_others`, `communication_services`, `communication_services_others`, `means_of_transportation`, `means_of_transportation_others`, `archive`, `created_at`, `updated_at`, `deleted_at`, `Total_family_income`, `Final_family_income`, `user_id`) VALUES
(1046, '123', 12312, '123123', 'Imprisonment of spouse of at least 1 year', NULL, '2019-06-04', '123123', 'Bisaya', '123123', 123123, 123123, 'Cebuano', 'Owned', NULL, 'Owned', NULL, 'Permanent Concrete', 'Permanent Concrete', 'Electricity', 'Television', NULL, 'Internet', NULL, 'PU jeep', NULL, 0, '2019-06-18 18:26:18', '2019-06-19 00:21:42', NULL, NULL, NULL, 1),
(1047, '123123', 12312, '123123', 'Death of spouse', NULL, '2019-06-07', '123', 'Bicol', '1312', 123, 123123, 'Bontoc', 'Owned', NULL, 'Owned', NULL, 'Permanent Concrete', 'Permanent Concrete', 'Electricity', 'Television', NULL, 'Internet', NULL, 'PU jeep', NULL, 0, '2019-06-18 18:33:56', '2019-06-18 18:40:30', '2019-06-18 18:40:30', NULL, NULL, 1),
(1048, '123', 123, '123', 'No', NULL, '2019-06-01', '2222', 'N/A', '2222', 123, 222, 'Bicolano', 'Owned', NULL, 'Owned', NULL, 'Permanent Concrete', 'Permanent Concrete', 'Electricity', 'Television', NULL, 'Internet', NULL, 'PU jeep', NULL, 0, '2019-06-18 18:41:01', '2019-06-18 18:58:29', '2019-06-18 18:58:29', NULL, NULL, 1),
(1049, '123', 123, '123', 'No', NULL, '2019-06-06', '123', 'N/A', '123', 123, 123, 'Bicolano', 'Owned', NULL, 'Owned', NULL, 'Permanent Concrete', 'Permanent Concrete', 'Electricity', 'Television', NULL, 'Cell sites/Net', NULL, 'PU jeep', NULL, 0, '2019-06-18 19:07:21', '2019-06-18 23:50:30', '2019-06-18 23:50:30', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `infrastructures`
--

DROP TABLE IF EXISTS `infrastructures`;
CREATE TABLE IF NOT EXISTS `infrastructures` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `national_m_concrete` double NOT NULL,
  `provincial_m_concrete` double NOT NULL,
  `city_m_concrete` double NOT NULL,
  `barangay_m_concrete` double NOT NULL,
  `total_m_concrete` double NOT NULL,
  `operational_m_concrete` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `national_m_steel` double NOT NULL,
  `provincial_m_steel` double NOT NULL,
  `city_m_steel` double NOT NULL,
  `barangay_m_steel` double NOT NULL,
  `total_m_steel` double NOT NULL,
  `operational_m_steel` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `national_m_wooden` double NOT NULL,
  `provincial_m_wooden` double NOT NULL,
  `city_m_wooden` double NOT NULL,
  `barangay_m_wooden` double NOT NULL,
  `total_m_wooden` double NOT NULL,
  `operational_m_wooden` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `national_m_total` double NOT NULL,
  `provincial_m_total` double NOT NULL,
  `city_m_total` double NOT NULL,
  `barangay_m_total` double NOT NULL,
  `total_m_total` double NOT NULL,
  `operational_m_total` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `national_km_concrete` double NOT NULL,
  `provincial_km_concrete` double NOT NULL,
  `city_km_concrete` double NOT NULL,
  `barangay_km_concrete` double NOT NULL,
  `total_km_concrete` double NOT NULL,
  `operational_km_concrete` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `national_km_asphalt` double NOT NULL,
  `provincial_km_asphalt` double NOT NULL,
  `city_km_asphalt` double NOT NULL,
  `barangay_km_asphalt` double NOT NULL,
  `total_km_asphalt` double NOT NULL,
  `operational_km_asphalt` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `national_km_gravel` double NOT NULL,
  `provincial_km_gravel` double NOT NULL,
  `city_km_gravel` double NOT NULL,
  `barangay_km_gravel` double NOT NULL,
  `total_km_gravel` double NOT NULL,
  `operational_km_gravel` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `national_km_earthfill` double NOT NULL,
  `provincial_km_earthfill` double NOT NULL,
  `city_km_earthfill` double NOT NULL,
  `barangay_km_earthfill` double NOT NULL,
  `total_km_earthfill` double NOT NULL,
  `operational_km_earthfill` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `national_km_total` double NOT NULL,
  `provincial_km_total` double NOT NULL,
  `city_km_total` double NOT NULL,
  `barangay_km_total` double NOT NULL,
  `total_km_total` double NOT NULL,
  `operational_km_total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `barangay_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `infrastructures_barangay_id_foreign` (`barangay_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inhabitants`
--

DROP TABLE IF EXISTS `inhabitants`;
CREATE TABLE IF NOT EXISTS `inhabitants` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `last_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relation_to_the_head` enum('The Head','Aunt','Uncle','Brother-in-law','Brother','Daughter-in-law','Daughter','Son','Son-in-law','Sister','Sister-in-law','Father','Mother','Grandfather','Grandmother','Husband','Wife','Tenant','Househelper','Common law wife') COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` enum('Female','Male') COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `placeOfBirth_native` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `civil_status` enum('Single','Married','Widow/er','Separated','Common-law','Complicated') COLLATE utf8mb4_unicode_ci NOT NULL,
  `religion` enum('None','Aglipayan','Anglican','Apostolic Christian','Assembly of God','Baptist','Church of Christ','Born Again Christian','Iglesia ni Cristo','Islam','Saksi ni Jehovah','Seventh Day Adventist','Methodist','Mormons','Pentecost','Protestant','Roman Catholic','Atheist') COLLATE utf8mb4_unicode_ci NOT NULL,
  `schooling` enum('N/A','In School','Out of School','Not yet in school','Graduate') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Highest_educational_attainment` enum('Elementary Graduate','Elementary','High school undergraduate','High school','College undergraduate','College graduate','Vocational','Post Graduate','Pre-school','Not yet attending school') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Final_family_income` int(20) DEFAULT NULL,
  `Total_family_income` int(20) DEFAULT NULL,
  `status_of_residency` enum('Permanent','Live-in relative','Boarder','Buss resident','Moved out','Deceased') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_settled_in_barangay` date DEFAULT NULL,
  `citizenship` enum('Afghan','Albanian','Algerian','American','Andorran','Angolan','Antiguan','Argentine','Armenian','Aruban','Australian','Austrian','Azerbaijani','Bahamian','Bahrainis','Bangladeshis','Barbadian','Basque','Belarusian','Belgian','Belizean','Beninese','Bermudian','Bhutanese','Bolivian','Bosniak','Bosnian','Botswana','Brazilian','Breton','British','British Virgin Islander','Bruneian','Bulgarian','Macedonian Bulgarian','Burkinabé','Burmese','Burundian','Cambodian','Cameroonian','Canadian','Catalan','Cape Verdean','Chadian','Chilean','Chinese','Colombian','Comorian','Congolese','Costa Rican','Croatian','Cuban','Cypriot','Czech','Dane','Greenlander','Djiboutian','Dominican','Dutch','East Timorese','Ecuadorian','Egyptian','Emirati','English','Equatoguinean','Eritrean','Estonian','Ethiopian','Falkland Islander','Faroese','Fijian','Finn','Finnish Swedish','Filipino','French citizen','Gabonese','Gambian','Georgian','German','Baltic German','Ghanaian','Gibraltarian','Greek','Greek Macedonian','Grenadian','Guatemalan','Guianese','Guinean','Guinea-Bissau national','Guyanese','Haitian','Honduran','Hong Konger','Hungarian','Icelander','I-Kiribati','Indian','Indonesian','Iranian','Iraqis','Irish','Israelis','Italian','Ivoirian','Jamaican','Japanese','Jordanian','Kazakh','Kenyan','Korean','Kosovar','Kuwaitis','Kyrgyz','Lao','Latvian','Lebanese','Liberian','Libyan','Liechtensteiner','Lithuanian','Luxembourger','Macao','Macedonian','Malagasy','Malawian','Malaysian','Maldivian','Malians','Maltese','Manx','Marshallese','Mauritanian','Mauritian','Mexicans','Micronesian','Moldovans','Monégasque','Mongolian','Montenegrin','Moroccan','Mozambican','Namibian','Nauran','Nepalese','New Zealander','Nicaraguan','Nigerien','Nigerian','Norwegian','Omani','Pakistanis','Palauan','Palestinian','Panamanian','Papua New Guinean','Paraguayan','Peruvian','Poles','Portuguese','Puerto Rican','Qatari','Quebecer','Réunionnais','Romanian','Russian','Baltic Russian','Rwandan','Saint Kitt','Saint Lucian','Salvadoran','Sammarinese','Samoans','São Tomé and Príncipe','Saudis','Scot','Senegalese','Serbs','Seychellois','Sierra Leonean','Singaporean','Slovak','Slovene','Solomon Islander','Somalis','Somalilander','Sotho','South African','Spaniard','Sri Lankan','Sudanese','Surinamese','Swazi','Swedes','Swiss','Syriac','Syrian','Taiwanese','Tamil','Tajik','Tanzanian','Thai','Tibetan','Tobagonian','Togolese','Tongan','Trinidadian','Tunisian','Turk','Tuvaluan','Ugandan','Ukrainian','Uruguayan','Uzbek','Vanuatuan','Venezuelan','Vietnamese','Vincentian','Welsh','Yemenis','Zambian','Zimbabwean') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ethnicGroup` enum('Bago','Bicol','Bisaya','Boholano','Bontoc','Capizeno','Cuyunon','Ibaloi','Ilonggo','Ifugao','Ilocano','Ivatan','Kalinga','Kankana-ey','Kapangpangan','Maguindanao','Maranao','Masbateno','Pangasinan','Surigaoan','Tagalog','Tausog','Waray','Yakan','Zamboagueno/Chavacano') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registeredVoterOfTheBrgy` enum('Yes','No') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_type` enum('A','B','AB','O','Do not know') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disability` enum('None','Total blindness of one eye','Total blindness of both eye','Missing one or both arms','Mongoloid','Cleff Palate','Malabo ang paningin/poor eyesight','Hunchback','Paralyzed legs','Paralyzed arms','Speech disorder','Authistic','Fractured Vertebrate column','Paralyzed from neck down','Hydrocephalus','Deaf','Mute and Deaf','Inability to walk alone','Deformity','Polio','Mental Impairment','Celebral Palsy','Epileptic','Dwarfism','Others') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dissability_others` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specific_job_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gen_job_description` enum('N/A','Accountant','Architect','Barangay Official','Businessman','Doctor','Engineer','Fireman','Government office worker','IT Worker','Lawyer','Librarian','Manager/Supervisor','Missionary','Nurse','OFW','Pharmacist','Policemen','Priest','Professor/Instructor','Preacher/Pastor','Researcher','Soldier','Seafarer','Teacher','Therapist','Call center agent','Caregiver','Carpenter','Caretaker','Cashier/clerk','Construction worker','Cosmetologist/Beautician','Dispatcher/Barker','Driver','Electrician','Factory Worker','Farmer/Gardener','Helper/Aide','Laborer','Laundrywoman','Machinist','Mechanic','Mason','Mine Worker','Porter','Plumber','Salesperson','Security Guard','Secretary','Service Crew','Student Assistance','Tailor/Sewer/Dressmaker','Technician','Vendor','Volunteer Woker','Welder') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employment_status` enum('Permanent','Contractual','Temporary','Self-employed','Retired','Unknown') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_category` enum('Offical Government and Special Interest','Professional','Technicians and Assoc. Professional','Clerks','Service Workers & Market sales workers','Farmers & Forestry Workers','Trades & related workers','Machine Operators/Assemblers','Laborers & skilled workers','Special Occupations','N/A') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employment_category` enum('Private','Government','Self employed','Overseas') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimated_monthly_income_cash` double DEFAULT NULL,
  `estimated_monthly_income_kind` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `childs_parent_guardian` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bcg` enum('y','n') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dpi1` enum('y','n') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dpi2` enum('y','n') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dpi3` enum('y','n') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opd1` enum('y','n') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opd2` enum('y','n') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opd3` enum('y','n') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `measles` enum('y','n') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `others1` enum('y','n') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `others2` enum('y','n') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `others3` enum('y','n') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `height` double DEFAULT NULL,
  `date_measured_height_weight` date DEFAULT NULL,
  `dewormed` enum('Yes','No') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `received_vitaminA` enum('Yes','No') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `archive` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `household_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `inhabitants_household_id_foreign` (`household_id`),
  KEY `inhabitants_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20040 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inhabitants`
--

INSERT INTO `inhabitants` (`id`, `last_name`, `first_name`, `middle_name`, `relation_to_the_head`, `sex`, `date_of_birth`, `placeOfBirth_native`, `civil_status`, `religion`, `schooling`, `Highest_educational_attainment`, `Final_family_income`, `Total_family_income`, `status_of_residency`, `date_settled_in_barangay`, `citizenship`, `ethnicGroup`, `registeredVoterOfTheBrgy`, `blood_type`, `disability`, `dissability_others`, `remarks`, `specific_job_description`, `gen_job_description`, `employment_status`, `job_category`, `employment_category`, `estimated_monthly_income_cash`, `estimated_monthly_income_kind`, `childs_parent_guardian`, `bcg`, `dpi1`, `dpi2`, `dpi3`, `opd1`, `opd2`, `opd3`, `measles`, `others1`, `others2`, `others3`, `weight`, `height`, `date_measured_height_weight`, `dewormed`, `received_vitaminA`, `ip`, `archive`, `created_at`, `updated_at`, `deleted_at`, `household_id`, `user_id`) VALUES
(20033, '12312', '123123', '12312', 'The Head', 'Male', '2019-06-01', 'ewerwer', 'Separated', 'Apostolic Christian', 'In School', 'Elementary Graduate', 12312, 12312, 'Boarder', '2019-06-06', 'Albanian', 'Bisaya', 'Yes', 'A', 'Total blindness of one eye', NULL, 'ASD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2019-06-18 19:40:58', '2019-07-21 21:42:28', '2019-07-21 21:42:28', 1046, 1),
(20035, 'Doe', 'John', NULL, 'The Head', 'Male', '1989-01-01', 'Baguio', 'Married', 'Assembly of God', 'N/A', 'High school undergraduate', 123456, 12356, 'Permanent', '1989-01-10', 'Filipino', 'Bontoc', 'Yes', 'B', 'Total blindness of one eye', NULL, 'asda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2019-06-20 22:28:17', '2019-07-21 21:42:35', '2019-07-21 21:42:35', 1046, 1),
(20036, 'Kenan', 'Cea', 'Dulnuan', 'Father', 'Male', '1999-09-09', 'Baguio', 'Single', 'Roman Catholic', 'N/A', 'College undergraduate', NULL, NULL, 'Permanent', '2019-01-01', 'Filipino', 'Bontoc', 'Yes', 'A', 'None', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2019-07-21 21:44:31', '2019-07-21 23:20:16', NULL, 1046, 1),
(20037, 'Moshe', 'Baby', NULL, 'Brother', 'Male', '2019-01-01', 'Baguio', 'Single', 'Anglican', 'N/A', 'Not yet attending school', NULL, NULL, 'Permanent', '2019-01-01', 'Filipino', 'Capizeno', 'No', 'A', 'None', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y', NULL, NULL, NULL, 4, 20, NULL, 'Yes', 'Yes', NULL, 0, '2019-07-21 21:46:06', '2019-07-21 21:46:06', NULL, 1046, 1),
(20038, 'Dulnuan', 'bbb', 'ace', 'Father', 'Male', '2019-02-02', 'Baguio', 'Single', 'None', 'N/A', 'Not yet attending school', NULL, NULL, 'Permanent', '2019-02-02', 'Filipino', 'Ifugao', 'No', 'A', 'None', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Cea', 'y', 'y', 'y', 'y', 'y', 'y', 'y', 'y', NULL, NULL, NULL, 3, 12, NULL, 'Yes', 'Yes', NULL, 0, '2019-07-21 21:55:13', '2019-07-21 21:55:13', NULL, 1046, 1),
(20039, 'yrewq', 'QWERTY', NULL, 'Brother', 'Male', '1999-09-09', 'Baguio', 'Single', 'None', NULL, NULL, NULL, NULL, NULL, NULL, 'Afghan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2019-07-22 03:36:01', '2019-07-22 03:36:01', NULL, 1046, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=162 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(139, '2014_10_12_000000_create_users_table', 1),
(140, '2014_10_12_100000_create_password_resets_table', 1),
(141, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(142, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(143, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(144, '2016_06_01_000004_create_oauth_clients_table', 1),
(145, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(146, '2019_04_09_175826_create_barangays_table', 1),
(147, '2019_04_09_180350_create_education_table', 1),
(148, '2019_04_09_180734_create_landuses_table', 1),
(149, '2019_04_09_180940_create_health_facilities_table', 1),
(150, '2019_04_09_181102_create_infrastructures_table', 1),
(151, '2019_04_09_181237_create_communications_table', 1),
(152, '2019_04_09_181522_create_households_table', 1),
(153, '2019_04_09_181808_create_educational_infos_table', 1),
(154, '2019_04_09_181942_create_environment_infos_table', 1),
(155, '2019_04_09_182037_create_health_infos_table', 1),
(156, '2019_04_09_182202_create_inhabitants_table', 1),
(157, '2019_04_09_182937_create_officials_table', 1),
(158, '2019_04_09_194727_create_business_clearances_table', 1),
(159, '2019_04_09_194956_create_barangay_clearances_table', 1),
(160, '2019_04_09_195117_create_barangay_certificates_table', 1),
(161, '2019_04_09_195301_create_filedcases_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `officials`
--

DROP TABLE IF EXISTS `officials`;
CREATE TABLE IF NOT EXISTS `officials` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `position` enum('Punong Barangay','Barangay Kagawad','Barangay Secretary','Barangay Treasurer') COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_term` date NOT NULL,
  `end_term` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `officials_user_id_foreign_idx` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `officials`
--

INSERT INTO `officials` (`id`, `position`, `name`, `start_term`, `end_term`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Punong Barangay', 'John Wick', '2019-01-01', '2022-02-02', '2019-07-21 23:08:44', '2019-07-21 23:08:44', 1),
(2, 'Barangay Kagawad', 'Jane Doe', '2019-01-01', '2022-02-02', '2019-07-21 23:09:01', '2019-07-21 23:09:01', 1),
(3, 'Barangay Kagawad', 'John Doe', '2019-01-01', '2022-02-02', '2019-07-21 23:09:19', '2019-07-21 23:09:19', 1),
(5, 'Barangay Kagawad', 'Alala aAde', '2019-01-01', '2022-02-02', '2019-07-21 23:09:55', '2019-07-21 23:09:55', 1),
(6, 'Barangay Kagawad', 'aash ashaa', '2019-01-01', '2022-02-02', '2019-07-21 23:10:14', '2019-07-21 23:10:14', 1),
(7, 'Barangay Kagawad', 'Aall Mircka', '2019-01-01', '2022-02-02', '2019-07-21 23:10:30', '2019-07-22 03:06:08', 1),
(8, 'Barangay Kagawad', 'DUnn Mirc', '2019-01-01', '2022-02-02', '2019-07-21 23:10:47', '2019-07-21 23:10:47', 1),
(9, 'Barangay Treasurer', 'Kaka akma', '2019-01-01', '2022-02-02', '2019-07-21 23:11:05', '2019-07-21 23:11:05', 1),
(10, 'Barangay Secretary', 'General bato', '2019-01-01', '2022-01-02', '2019-07-21 23:11:23', '2019-07-21 23:11:23', 1),
(16, 'Barangay Kagawad', 'Asd aaww', '2019-01-01', '2022-02-02', '2019-07-22 03:06:45', '2019-07-22 03:06:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'profile.png',
  `roles` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL,
  `disable` int(11) DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `logo`, `roles`, `disable`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Camp Allen', 'campallen@gmail.com', '2019-05-15 23:41:09', '$2y$10$6LPNi77tngI.OiJxgJxsrOg4.U5VroCL7ov7Nk.LD5ndMw/Vo0kLW', '1560909406.png', 'user', 0, 'fgJ1Ptx1xlRbp8W9z7P1fd8T4nRumfNqpzdRCJsMbaKnSDkJlY3cz78SEWce', '2019-05-15 23:41:09', '2019-06-19 01:56:46', NULL),
(3, 'Admin', 'admin@gmail.com', '2019-05-24 23:44:36', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1560923711.jpeg', 'admin', 0, NULL, '2019-05-24 23:44:56', '2019-06-19 05:55:12', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activitylogs`
--
ALTER TABLE `activitylogs`
  ADD CONSTRAINT `activitylogs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barangays`
--
ALTER TABLE `barangays`
  ADD CONSTRAINT `barangays_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `barangay_certificates`
--
ALTER TABLE `barangay_certificates`
  ADD CONSTRAINT `barangay_certificates_inhabitant_id_foreign` FOREIGN KEY (`inhabitant_id`) REFERENCES `inhabitants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barangay_certificates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barangay_clearances`
--
ALTER TABLE `barangay_clearances`
  ADD CONSTRAINT `barangay_clearances_inhabitant_id_foreign` FOREIGN KEY (`inhabitant_id`) REFERENCES `inhabitants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barangay_clearances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `business_clearances`
--
ALTER TABLE `business_clearances`
  ADD CONSTRAINT `business_clearances_inhabitant_id_foreign` FOREIGN KEY (`inhabitant_id`) REFERENCES `inhabitants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `business_clearances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `filedcases`
--
ALTER TABLE `filedcases`
  ADD CONSTRAINT `filedcases_inhabitant_id_foreign` FOREIGN KEY (`inhabitant_id`) REFERENCES `inhabitants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `filedcases_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `households`
--
ALTER TABLE `households`
  ADD CONSTRAINT `households_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `infrastructures`
--
ALTER TABLE `infrastructures`
  ADD CONSTRAINT `infrastructures_barangay_id_foreign` FOREIGN KEY (`barangay_id`) REFERENCES `barangays` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inhabitants`
--
ALTER TABLE `inhabitants`
  ADD CONSTRAINT `inhabitants_household_id_foreign` FOREIGN KEY (`household_id`) REFERENCES `households` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inhabitants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `officials`
--
ALTER TABLE `officials`
  ADD CONSTRAINT `officials_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
