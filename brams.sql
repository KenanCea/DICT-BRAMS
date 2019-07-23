-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 23, 2019 at 05:17 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=229 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activitylogs`
--

INSERT INTO `activitylogs` (`id`, `log`, `created_at`, `updated_at`, `user_id`) VALUES
(197, 'Created new account Kenan', '2019-07-23 04:48:08', '2019-07-23 04:48:08', 3),
(198, 'Kenan has been activated', '2019-07-23 04:48:48', '2019-07-23 04:48:48', 12),
(199, 'Added #1 1 Purok 1, Kenan', '2019-07-23 04:51:19', '2019-07-23 04:51:19', 12),
(200, 'Added Cea, Kenan to #1 1 Purok 1, Kenan', '2019-07-23 04:51:43', '2019-07-23 04:51:43', 12),
(201, 'Updated #1 1 Purok 1, Kenan', '2019-07-23 04:52:09', '2019-07-23 04:52:09', 12),
(202, 'Added official Dunn Mirc to the position Punong Barangay, Kenan', '2019-07-23 04:53:19', '2019-07-23 04:53:19', 12),
(203, 'Updated official Captain Pacdal Position: Punong Barangay, Kenan', '2019-07-23 04:54:34', '2019-07-23 04:54:34', 12),
(204, 'Added official Pacdal Kagawad to the position Barangay Kagawad, Pacdal', '2019-07-23 04:55:29', '2019-07-23 04:55:29', 12),
(205, 'Added official Pacdal Kagawad to the position Barangay Kagawad, Pacdal', '2019-07-23 04:55:44', '2019-07-23 04:55:44', 12),
(206, 'Added official Pacdal Kagawad to the position Barangay Kagawad, Pacdal', '2019-07-23 04:55:55', '2019-07-23 04:55:55', 12),
(207, 'Added official Pacdal Kagawad to the position Barangay Kagawad, Pacdal', '2019-07-23 04:56:07', '2019-07-23 04:56:07', 12),
(208, 'Added official Pacdal Kagawad to the position Barangay Kagawad, Pacdal', '2019-07-23 04:56:18', '2019-07-23 04:56:18', 12),
(209, 'Added official Pacdal Kagawad to the position Barangay Kagawad, Pacdal', '2019-07-23 04:56:33', '2019-07-23 04:56:33', 12),
(210, 'Added official Pacdal Kagawad to the position Barangay Kagawad, Pacdal', '2019-07-23 04:56:44', '2019-07-23 04:56:44', 12),
(211, 'Added official Pacdal Treasurer to the position Barangay Treasurer, Pacdal', '2019-07-23 04:57:05', '2019-07-23 04:57:05', 12),
(212, 'Added official Pacdal Secretary to the position Barangay Secretary, Pacdal', '2019-07-23 04:57:25', '2019-07-23 04:57:25', 12),
(213, 'Updated official Captain Gibraltar Position: Punong Barangay, Gibraltar', '2019-07-23 04:58:55', '2019-07-23 04:58:55', 12),
(214, 'Updated official Gibraltar Kagawad Position: Barangay Kagawad, Gibraltar', '2019-07-23 04:59:02', '2019-07-23 04:59:02', 12),
(215, 'Updated official Gibraltar Kagawad Position: Barangay Kagawad, Gibraltar', '2019-07-23 04:59:06', '2019-07-23 04:59:06', 12),
(216, 'Updated official Gibraltar Kagawad Position: Barangay Kagawad, Gibraltar', '2019-07-23 04:59:12', '2019-07-23 04:59:12', 12),
(217, 'Updated official Gibraltar Kagawad Position: Barangay Kagawad, Gibraltar', '2019-07-23 04:59:17', '2019-07-23 04:59:17', 12),
(218, 'Updated official Gibraltar Kagawad Position: Barangay Kagawad, Gibraltar', '2019-07-23 04:59:22', '2019-07-23 04:59:22', 12),
(219, 'Updated official Gibraltar Kagawad Position: Barangay Kagawad, Gibraltar', '2019-07-23 04:59:27', '2019-07-23 04:59:27', 12),
(220, 'Updated official Gibraltar Kagawad Position: Barangay Kagawad, Gibraltar', '2019-07-23 04:59:32', '2019-07-23 04:59:32', 12),
(221, 'Updated official Gibraltar Treasurer Position: Barangay Treasurer, Gibraltar', '2019-07-23 04:59:36', '2019-07-23 04:59:36', 12),
(222, 'Updated official Gibraltar Secretary Position: Barangay Secretary, Gibraltar', '2019-07-23 04:59:41', '2019-07-23 04:59:41', 12),
(223, 'Updated Rossevelt, Thomas of #1 1 Purok 1, Gibraltar', '2019-07-23 05:00:44', '2019-07-23 05:00:44', 12),
(224, 'Issued Barangay Clearance to Rossevelt, Thomas', '2019-07-23 05:01:24', '2019-07-23 05:01:24', 12),
(225, 'Archived #1 1 Purok 1, Gibraltar and the Inhabitants residing in', '2019-07-23 05:14:02', '2019-07-23 05:14:02', 12),
(226, 'Restored #1 1 Purok 1, Gibraltar', '2019-07-23 05:14:08', '2019-07-23 05:14:08', 12),
(227, 'Restored Rossevelt, Thomas of #1 1 Purok 1, Gibraltar', '2019-07-23 05:14:17', '2019-07-23 05:14:17', 12),
(228, 'Issued Barangay Clearance to Ketchup, Thomas', '2019-07-23 05:16:12', '2019-07-23 05:16:12', 12);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangays`
--

INSERT INTO `barangays` (`id`, `municipality`, `province`, `region`, `zip_code`, `type_barangay`, `created_at`, `updated_at`, `user_id`) VALUES
(9, 'Baguio', 'Benguet', 'CAR', '2600', 'Rural', '2019-07-23 04:48:08', '2019-07-23 04:48:08', 12);

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

-- --------------------------------------------------------

--
-- Table structure for table `barangay_clearances`
--

DROP TABLE IF EXISTS `barangay_clearances`;
CREATE TABLE IF NOT EXISTS `barangay_clearances` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `control_no` int(11) NOT NULL,
  `ctc_no` int(11) NOT NULL,
  `purpose_of_clearance` enum('Local Employment','Foreign Employment','Travel Abroad','Loan Purpose','Open Account','Trycicle Franchise','Postal ID','Police Clearance','NBI Clearance','License Renewal (Firearms/Drivers)','Application for Valid ID') COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `sex` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `barangay_clearances_inhabitant_id_foreign` (`inhabitant_id`),
  KEY `barangay_clearances_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangay_clearances`
--

INSERT INTO `barangay_clearances` (`id`, `control_no`, `ctc_no`, `purpose_of_clearance`, `official_receipt_no`, `last_name`, `first_name`, `middle_name`, `house_no`, `purok`, `street`, `date_of_birth`, `citizenship`, `placeOfBirth_native`, `created_at`, `updated_at`, `inhabitant_id`, `user_id`, `sex`) VALUES
(14, 12311, 2211, 'Travel Abroad', 12211, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-23 05:01:24', '2019-07-23 05:01:24', 20042, 12, NULL),
(15, 1231, 1221, 'Travel Abroad', 21121, 'Ketchup', 'Thomas', 'Freisner', '2', 1, 'Corner St', '1999-01-01', 'Filipino', 'America', '2019-07-23 05:16:12', '2019-07-23 05:16:12', NULL, 12, 'Male');

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
  `remarks` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `households_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1057 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `households`
--

INSERT INTO `households` (`id`, `house_no`, `purok`, `street`, `solo_parent`, `solo_parent_others`, `dateOfSurvey`, `placeOfOrigin`, `ethnic_group`, `email_address`, `mobile_no`, `telephone_no`, `dialects`, `status_of_ownership_house`, `status_of_ownership_house_others`, `status_of_ownership_lot`, `status_of_ownership_lot_others`, `type_of_dwelling`, `type_of_dwelling_structure`, `lighting_source`, `sources_of_info`, `sources_of_info_others`, `communication_services`, `communication_services_others`, `means_of_transportation`, `means_of_transportation_others`, `archive`, `created_at`, `updated_at`, `deleted_at`, `Total_family_income`, `Final_family_income`, `user_id`, `remarks`) VALUES
(1056, '1', 1, '1', NULL, NULL, NULL, '1ad', 'N/A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2019-07-23 04:51:18', '2019-07-23 05:14:08', NULL, NULL, NULL, 12, 'Burned');

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
) ENGINE=InnoDB AUTO_INCREMENT=20043 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inhabitants`
--

INSERT INTO `inhabitants` (`id`, `last_name`, `first_name`, `middle_name`, `relation_to_the_head`, `sex`, `date_of_birth`, `placeOfBirth_native`, `civil_status`, `religion`, `schooling`, `Highest_educational_attainment`, `Final_family_income`, `Total_family_income`, `status_of_residency`, `date_settled_in_barangay`, `citizenship`, `ethnicGroup`, `registeredVoterOfTheBrgy`, `blood_type`, `disability`, `dissability_others`, `remarks`, `specific_job_description`, `gen_job_description`, `employment_status`, `job_category`, `employment_category`, `estimated_monthly_income_cash`, `estimated_monthly_income_kind`, `childs_parent_guardian`, `bcg`, `dpi1`, `dpi2`, `dpi3`, `opd1`, `opd2`, `opd3`, `measles`, `others1`, `others2`, `others3`, `weight`, `height`, `date_measured_height_weight`, `dewormed`, `received_vitaminA`, `ip`, `archive`, `created_at`, `updated_at`, `deleted_at`, `household_id`, `user_id`) VALUES
(20042, 'Rossevelt', 'Thomas', 'Faun', 'The Head', 'Male', '2000-01-01', 'Baguio', 'Single', 'None', NULL, NULL, NULL, NULL, 'Permanent', NULL, 'American', NULL, NULL, NULL, NULL, NULL, 'household has been Burned', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2019-07-23 04:51:43', '2019-07-23 05:14:17', NULL, 1056, 12);

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `officials`
--

INSERT INTO `officials` (`id`, `position`, `name`, `start_term`, `end_term`, `created_at`, `updated_at`, `user_id`) VALUES
(31, 'Punong Barangay', 'Captain Gibraltar', '2019-01-01', '2022-02-02', '2019-07-23 04:53:19', '2019-07-23 04:58:55', 12),
(32, 'Barangay Kagawad', 'Gibraltar Kagawad', '2019-01-01', '2022-01-01', '2019-07-23 04:55:29', '2019-07-23 04:59:02', 12),
(33, 'Barangay Kagawad', 'Gibraltar Kagawad', '2019-01-01', '2022-01-01', '2019-07-23 04:55:44', '2019-07-23 04:59:06', 12),
(34, 'Barangay Kagawad', 'Gibraltar Kagawad', '2019-01-01', '2022-01-01', '2019-07-23 04:55:55', '2019-07-23 04:59:12', 12),
(35, 'Barangay Kagawad', 'Gibraltar Kagawad', '2019-01-01', '2022-01-01', '2019-07-23 04:56:07', '2019-07-23 04:59:17', 12),
(36, 'Barangay Kagawad', 'Gibraltar Kagawad', '2019-01-01', '2022-01-01', '2019-07-23 04:56:18', '2019-07-23 04:59:22', 12),
(37, 'Barangay Kagawad', 'Gibraltar Kagawad', '2019-01-01', '2022-01-01', '2019-07-23 04:56:33', '2019-07-23 04:59:27', 12),
(38, 'Barangay Kagawad', 'Gibraltar Kagawad', '2019-01-01', '2022-01-01', '2019-07-23 04:56:44', '2019-07-23 04:59:32', 12),
(39, 'Barangay Treasurer', 'Gibraltar Treasurer', '2019-01-01', '2022-01-01', '2019-07-23 04:57:05', '2019-07-23 04:59:36', 12),
(40, 'Barangay Secretary', 'Gibraltar Secretary', '2019-01-01', '2022-01-01', '2019-07-23 04:57:25', '2019-07-23 04:59:41', 12);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `logo`, `roles`, `disable`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'Admin', 'admin@gmail.com', '2019-05-24 23:44:36', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '1560923711.jpeg', 'admin', 0, NULL, '2019-05-24 23:44:56', '2019-06-19 05:55:12', NULL),
(12, 'Gibraltar', 'example@gmail.com', '2019-07-23 04:48:48', '$2y$10$lA7ujjNKq1qLuU51qc5QN.4b3na2NFI1LvJ/lRBi1t.r4erOIrWrq', '1563857925.png', 'user', 0, 'BaH0DZK0u5aubrmwA29TG0BmWN1A6JBWVoqJvyWWql6aYcyRgdry0ibNjA5B', '2019-07-23 04:48:04', '2019-07-23 04:58:46', NULL);

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
