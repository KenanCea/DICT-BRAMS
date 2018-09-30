-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: brams
-- ------------------------------------------------------
-- Server version	5.7.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `admin_id` int(7) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`admin_id`),
  KEY `fk_brgy_id_idx` (`barangay_id`),
  CONSTRAINT `fk_brgy_id` FOREIGN KEY (`barangay_id`) REFERENCES `barangay profile` (`barangay_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barangay clearance`
--

DROP TABLE IF EXISTS `barangay clearance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barangay clearance` (
  `form_id_clearance` int(7) NOT NULL AUTO_INCREMENT,
  `control_no_clearance` int(11) NOT NULL,
  `businessaddress_clearance` varchar(50) CHARACTER SET latin1 NOT NULL,
  `businesstradename_clearance` varchar(50) CHARACTER SET latin1 NOT NULL,
  `purpose_brgy_clearance` varchar(50) CHARACTER SET latin1 NOT NULL,
  `date_issued_clearance` date NOT NULL,
  `brgy_official_receipt_no_clearance` int(11) NOT NULL,
  `ctc_no_clearance` int(11) NOT NULL,
  `ctc_issued_on_clearance` date NOT NULL,
  `ctc_issuedat_clearance` date NOT NULL,
  `mem_id` int(7) NOT NULL,
  `official_no` int(7) NOT NULL,
  PRIMARY KEY (`form_id_clearance`),
  KEY `fk_mem_id_idx` (`mem_id`),
  KEY `fk_official_id_clr_idx` (`official_no`),
  CONSTRAINT `fk_form_id_clr` FOREIGN KEY (`form_id_clearance`) REFERENCES `form` (`form_id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_mem_id_clr` FOREIGN KEY (`mem_id`) REFERENCES `member` (` mem_id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_official_id_clr` FOREIGN KEY (`official_no`) REFERENCES `official` (`official_no`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barangay clearance`
--

LOCK TABLES `barangay clearance` WRITE;
/*!40000 ALTER TABLE `barangay clearance` DISABLE KEYS */;
/*!40000 ALTER TABLE `barangay clearance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barangay id card`
--

DROP TABLE IF EXISTS `barangay id card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barangay id card` (
  `form_id_card` int(11) NOT NULL AUTO_INCREMENT,
  `control_no_card` varchar(45) CHARACTER SET latin1 NOT NULL,
  `date_applied_card` date NOT NULL,
  `amount_paid_card` double NOT NULL,
  `brg_OR_ no_card` int(11) NOT NULL,
  `date_card_issued_card` date NOT NULL,
  `year_applied` date NOT NULL,
  `contact_person_card` int(11) NOT NULL,
  `address_contact_person_card` varchar(50) CHARACTER SET latin1 NOT NULL,
  `cp#_contact_person_card` int(11) NOT NULL,
  `cp#_cardholder_card` int(11) NOT NULL,
  `mem_id` int(7) NOT NULL,
  `official_no` int(7) NOT NULL,
  PRIMARY KEY (`form_id_card`),
  KEY `fk_mem_id_idx` (`mem_id`),
  KEY `fk_official_no_id_idx` (`official_no`),
  CONSTRAINT `fk_form_id_id_card` FOREIGN KEY (`form_id_card`) REFERENCES `form` (`form_id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_mem_id_id_card` FOREIGN KEY (`mem_id`) REFERENCES `member` (` mem_id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_official_no_id_card` FOREIGN KEY (`official_no`) REFERENCES `official` (`official_no`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barangay id card`
--

LOCK TABLES `barangay id card` WRITE;
/*!40000 ALTER TABLE `barangay id card` DISABLE KEYS */;
/*!40000 ALTER TABLE `barangay id card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barangay profile`
--

DROP TABLE IF EXISTS `barangay profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barangay profile` (
  `barangay_id` int(7) NOT NULL AUTO_INCREMENT,
  `barangay_name_barangay` varchar(45) CHARACTER SET latin1 NOT NULL,
  `province_barangay` varchar(45) CHARACTER SET latin1 NOT NULL,
  `muni_city_barangay` varchar(45) CHARACTER SET latin1 NOT NULL,
  `region_barangay` varchar(45) CHARACTER SET latin1 NOT NULL,
  `legal_basis_barangay` varchar(45) CHARACTER SET latin1 NOT NULL,
  `date_legal_basis` date NOT NULL,
  `date_ratification` date NOT NULL,
  `mother_barangay` varchar(45) CHARACTER SET latin1 NOT NULL,
  `old_name` varchar(45) CHARACTER SET latin1 NOT NULL,
  `type_barangay` enum('rural','urban','tribal') CHARACTER SET latin1 NOT NULL,
  `boundaries_north` double NOT NULL,
  `boundaries_east` double NOT NULL,
  `boundaries_west` double NOT NULL,
  `boundaries_south` double NOT NULL,
  `totalland_area_sqkm` double NOT NULL,
  `totalland_area_hec` double NOT NULL,
  `distance_municipal_city` double NOT NULL,
  `province_capitol` varchar(45) CHARACTER SET latin1 NOT NULL,
  `national_highway` varchar(45) CHARACTER SET latin1 NOT NULL,
  `landform_type` varchar(45) CHARACTER SET latin1 NOT NULL,
  `landform_percentage` int(3) NOT NULL,
  `official_no` int(7) NOT NULL,
  `hhold_id` int(7) NOT NULL,
  `account_id` int(7) NOT NULL,
  PRIMARY KEY (`barangay_id`),
  KEY `fk_official_no_profile_idx` (`official_no`),
  KEY `fk_hhold_household_profile_idx` (`hhold_id`),
  KEY `fk_account_id_profile_idx` (`account_id`),
  CONSTRAINT `fk_account_id_profile` FOREIGN KEY (`account_id`) REFERENCES `official account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_hhold_household_profile` FOREIGN KEY (`hhold_id`) REFERENCES `household` (`hhold_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_official_no_profile` FOREIGN KEY (`official_no`) REFERENCES `official` (`official_no`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barangay profile`
--

LOCK TABLES `barangay profile` WRITE;
/*!40000 ALTER TABLE `barangay profile` DISABLE KEYS */;
/*!40000 ALTER TABLE `barangay profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barangay_certificate`
--

DROP TABLE IF EXISTS `barangay_certificate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barangay_certificate` (
  `form_id_cert` int(7) NOT NULL AUTO_INCREMENT,
  `control_no_cert` varchar(45) CHARACTER SET latin1 NOT NULL,
  `purpose_brgy_cert` varchar(45) CHARACTER SET latin1 NOT NULL,
  `barangay_date_issued_certcertificatecol` date NOT NULL,
  `ctc_no_cert` int(11) NOT NULL,
  `ctc_issued_at_cert` varchar(30) CHARACTER SET latin1 NOT NULL,
  `ctc_issued_on_cert` date NOT NULL,
  `official_receipt_no_cert` int(11) NOT NULL,
  `amount_paid_cert` varchar(45) CHARACTER SET latin1 NOT NULL,
  `mem_id` int(7) NOT NULL,
  `official_no` int(7) NOT NULL,
  PRIMARY KEY (`form_id_cert`),
  KEY `form_id` (`form_id_cert`),
  KEY `form_idx` (`form_id_cert`),
  KEY `fk_mem_id_idx` (`mem_id`),
  KEY `fk_official_no_idx` (`official_no`),
  CONSTRAINT `fk_form_id` FOREIGN KEY (`form_id_cert`) REFERENCES `form` (`form_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_mem_id` FOREIGN KEY (`mem_id`) REFERENCES `member` (` mem_id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_official_no` FOREIGN KEY (`official_no`) REFERENCES `official` (`official_no`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barangay_certificate`
--

LOCK TABLES `barangay_certificate` WRITE;
/*!40000 ALTER TABLE `barangay_certificate` DISABLE KEYS */;
/*!40000 ALTER TABLE `barangay_certificate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bridge in kilometers`
--

DROP TABLE IF EXISTS `bridge in kilometers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bridge in kilometers` (
  `Kilo_id` int(7) NOT NULL AUTO_INCREMENT,
  `Admin_level_type_land_use_kilo` varchar(20) CHARACTER SET latin1 NOT NULL,
  `Admin_level_national_kilo` double NOT NULL,
  `Admin_level_provincial_kilo` double NOT NULL,
  `Admin_level_city/Mun_kilo` double NOT NULL,
  `Admin_level_barangay_kilo` double NOT NULL,
  `Admin_level_totalkilometer_kilo` double NOT NULL,
  `Admin_level_operational_kilo` varchar(45) CHARACTER SET latin1 NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`Kilo_id`),
  KEY `fk_barangay_id_bk_idx` (`barangay_id`),
  CONSTRAINT `fk_barangay_id_bk` FOREIGN KEY (`barangay_id`) REFERENCES `barangay profile` (`barangay_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bridge in kilometers`
--

LOCK TABLES `bridge in kilometers` WRITE;
/*!40000 ALTER TABLE `bridge in kilometers` DISABLE KEYS */;
/*!40000 ALTER TABLE `bridge in kilometers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bridge in meters`
--

DROP TABLE IF EXISTS `bridge in meters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bridge in meters` (
  `meter_id` int(7) NOT NULL AUTO_INCREMENT,
  `type_land_use` double NOT NULL,
  `Admin_level_national_meter` double NOT NULL,
  `Admin_level_provincial_meter` double NOT NULL,
  `Admin_level_city/Mun_meter` double NOT NULL,
  `Admin_level_barangay_meter` double NOT NULL,
  `Admin_level_totalmeter_meter` double NOT NULL,
  `Admin_level_operational_meter` varchar(45) CHARACTER SET latin1 NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`meter_id`),
  KEY `fk_barangay_id_bm_idx` (`barangay_id`),
  CONSTRAINT `fk_barangay_id_bm` FOREIGN KEY (`barangay_id`) REFERENCES `barangay profile` (`barangay_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bridge in meters`
--

LOCK TABLES `bridge in meters` WRITE;
/*!40000 ALTER TABLE `bridge in meters` DISABLE KEYS */;
/*!40000 ALTER TABLE `bridge in meters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `business clearance`
--

DROP TABLE IF EXISTS `business clearance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `business clearance` (
  `form_id_clearance_busclearance` int(7) NOT NULL AUTO_INCREMENT,
  `control_no_busclearance` int(11) NOT NULL,
  `business_address_busclearance` varchar(50) CHARACTER SET latin1 NOT NULL,
  `business_trade_name_busclearance` varchar(50) CHARACTER SET latin1 NOT NULL,
  `business_application_busclearance` enum('new','renewal') CHARACTER SET latin1 NOT NULL,
  `kind_ business_busclearance` varchar(50) CHARACTER SET latin1 NOT NULL,
  `line_of_business_busclearance` varchar(15) CHARACTER SET latin1 NOT NULL,
  `business_approv_disaprov_busclearance` enum('approval','disapproval') CHARACTER SET latin1 NOT NULL,
  `reasons_approv_disapprove_busclearance` varchar(20) CHARACTER SET latin1 NOT NULL,
  `date_issued_busclearance` date NOT NULL,
  `ctc_no_busclearance` int(11) NOT NULL,
  `ctc_issued_on_busclearance` date NOT NULL,
  `ctc_issued_at_busclearance` date NOT NULL,
  `brgy_official_receipt_no_busclearance` int(11) NOT NULL,
  `date_OfficialReceipt_busclearancel` date NOT NULL,
  `total_amt_paid_busclearance` double NOT NULL,
  `business_Industry` enum('Agriculture','Construction','Electricity/gas and water','wholesale','retail, and trade','Transport','storage','communications','Community','Social and personal services','Financing',' Insurance','Real States','Manufacturing','Mining') CHARACTER SET latin1 NOT NULL,
  `mem_id` int(7) NOT NULL,
  `official_no` int(7) NOT NULL,
  PRIMARY KEY (`form_id_clearance_busclearance`),
  KEY `fk_mem_id_idx` (`mem_id`),
  KEY `fk_offial_no_idx` (`official_no`),
  CONSTRAINT `fk_form_id_busclearance` FOREIGN KEY (`form_id_clearance_busclearance`) REFERENCES `form` (`form_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mem_id_busclearance` FOREIGN KEY (`mem_id`) REFERENCES `member` (` mem_id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_official_no_busclearance` FOREIGN KEY (`official_no`) REFERENCES `official` (`official_no`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `business clearance`
--

LOCK TABLES `business clearance` WRITE;
/*!40000 ALTER TABLE `business clearance` DISABLE KEYS */;
/*!40000 ALTER TABLE `business clearance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `communication`
--

DROP TABLE IF EXISTS `communication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `communication` (
  `com_id` int(7) NOT NULL AUTO_INCREMENT,
  `type_communication` varchar(20) CHARACTER SET latin1 NOT NULL,
  `totalProvider` double NOT NULL,
  `name/s_of_company` varchar(45) CHARACTER SET latin1 NOT NULL,
  `numberHouseholdServed` int(3) NOT NULL,
  `barangay_id` int(7) NOT NULL,
  `mem_id` int(7) NOT NULL,
  PRIMARY KEY (`com_id`),
  KEY `fk_barangay_id_comm_idx` (`barangay_id`),
  KEY `fk_mem_id_comm_idx` (`mem_id`),
  CONSTRAINT `fk_barangay_id_comm` FOREIGN KEY (`barangay_id`) REFERENCES `barangay profile` (`barangay_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_mem_id_comm` FOREIGN KEY (`mem_id`) REFERENCES `member` (` mem_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `communication`
--

LOCK TABLES `communication` WRITE;
/*!40000 ALTER TABLE `communication` DISABLE KEYS */;
/*!40000 ALTER TABLE `communication` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distribution of land use`
--

DROP TABLE IF EXISTS `distribution of land use`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `distribution of land use` (
  `land_id` int(7) NOT NULL AUTO_INCREMENT,
  `landuse_type` varchar(20) CHARACTER SET latin1 NOT NULL,
  `landarea_sqm` double NOT NULL,
  `landarea_hec` double NOT NULL,
  `percentage_of_population` double NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`land_id`),
  KEY `fk_barangay_id_distribution_of_land_idx` (`barangay_id`),
  CONSTRAINT `fk_barangay_id_distribution_of_land` FOREIGN KEY (`barangay_id`) REFERENCES `barangay profile` (`barangay_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distribution of land use`
--

LOCK TABLES `distribution of land use` WRITE;
/*!40000 ALTER TABLE `distribution of land use` DISABLE KEYS */;
/*!40000 ALTER TABLE `distribution of land use` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `education`
--

DROP TABLE IF EXISTS `education`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `education` (
  `building_id` int(7) NOT NULL AUTO_INCREMENT,
  `no_pre_school_building` int(3) NOT NULL,
  `no_primary_building` int(3) NOT NULL,
  `no_secondary_building` int(3) NOT NULL,
  `no_vocational_building` int(3) NOT NULL,
  `no_college_building` int(3) NOT NULL,
  `no_post_graduate_building` int(3) NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`building_id`),
  KEY `fk_baangay_id_educ_idx` (`barangay_id`),
  CONSTRAINT `fk_baangay_id_educ` FOREIGN KEY (`barangay_id`) REFERENCES `barangay profile` (`barangay_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `education`
--

LOCK TABLES `education` WRITE;
/*!40000 ALTER TABLE `education` DISABLE KEYS */;
/*!40000 ALTER TABLE `education` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employment`
--

DROP TABLE IF EXISTS `employment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employment` (
  `emp_id` int(7) NOT NULL AUTO_INCREMENT,
  `employment_status` varchar(20) CHARACTER SET latin1 NOT NULL,
  `general_job _description` enum('permanent','contractual','temporary','self-employed','retired','unknown status') CHARACTER SET latin1 NOT NULL,
  `job_category` enum('private','government','self-employed','overseas') CHARACTER SET latin1 NOT NULL,
  `employment_category` varchar(20) CHARACTER SET latin1 NOT NULL,
  `monthly_income_cash` double NOT NULL,
  `mem_id` int(7) NOT NULL,
  PRIMARY KEY (`emp_id`),
  KEY `fk_mem_id_empl_idx` (`mem_id`),
  CONSTRAINT `fk_mem_id_empl` FOREIGN KEY (`mem_id`) REFERENCES `member` (` mem_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employment`
--

LOCK TABLES `employment` WRITE;
/*!40000 ALTER TABLE `employment` DISABLE KEYS */;
/*!40000 ALTER TABLE `employment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `environment info`
--

DROP TABLE IF EXISTS `environment info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `environment info` (
  `env_id` int(7) NOT NULL AUTO_INCREMENT,
  `food_service` enum('Market',' sari-sari store',' Ambulant vendor') CHARACTER SET latin1 NOT NULL,
  `food_service_others` varchar(30) CHARACTER SET latin1 NOT NULL,
  `kind_Of_food_storage` enum('Fresh','Dried','Processed') CHARACTER SET latin1 NOT NULL,
  `kind_Of_food_storage_others` varchar(30) CHARACTER SET latin1 NOT NULL,
  `garbage_disposal_date` date NOT NULL,
  `water_storage_facility` varchar(20) CHARACTER SET latin1 NOT NULL,
  `household_storage` enum('elevated','cabinet/shelves') CHARACTER SET latin1 NOT NULL,
  `household_storage_others` varchar(30) CHARACTER SET latin1 NOT NULL,
  `toilet_facilities` enum('Flush with Septic','Flush with Sewer','Water Sealed','Pit privy') CHARACTER SET latin1 NOT NULL,
  `drainage_facilities` enum('open drainage','blind drainage','no drainage') CHARACTER SET latin1 NOT NULL,
  `garbage_disposal` enum('collection system','communal pit','backyard pit','open dump','composting','burning') CHARACTER SET latin1 NOT NULL,
  `garbage_disposal_others` varchar(30) CHARACTER SET latin1 NOT NULL,
  `hhold_id` int(7) NOT NULL,
  PRIMARY KEY (`env_id`),
  KEY `fk_hhold_id_envinfo_idx` (`hhold_id`),
  CONSTRAINT `fk_hhold_id_envinfo` FOREIGN KEY (`hhold_id`) REFERENCES `household` (`hhold_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `environment info`
--

LOCK TABLES `environment info` WRITE;
/*!40000 ALTER TABLE `environment info` DISABLE KEYS */;
/*!40000 ALTER TABLE `environment info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filed case`
--

DROP TABLE IF EXISTS `filed case`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `filed case` (
  `form_id_case` int(7) NOT NULL AUTO_INCREMENT,
  `id serial case_num` varchar(20) CHARACTER SET latin1 NOT NULL,
  `control_no_case` int(11) NOT NULL,
  `respondent_case` varchar(50) CHARACTER SET latin1 NOT NULL,
  `nature_of_case` varchar(50) CHARACTER SET latin1 NOT NULL,
  `complainant_case` varchar(50) CHARACTER SET latin1 NOT NULL,
  `date_filed_case` date NOT NULL,
  `action_taken_on_settled_case` enum('Arbitration',' Conciliation','Mediation') CHARACTER SET latin1 NOT NULL,
  `action_taken_on_unsettled_case` enum('Repudiation','Withdrawn','Pending case','case dismissed','case certified','referred to concerned agencies') CHARACTER SET latin1 NOT NULL,
  `remarks_case` varchar(30) CHARACTER SET latin1 NOT NULL,
  `form_id` int(7) NOT NULL,
  `mem_id` int(7) NOT NULL,
  PRIMARY KEY (`form_id_case`),
  KEY `fk_form_id_filedcase_idx` (`form_id`),
  KEY `fk_mem_id_filedcase_idx` (`mem_id`),
  CONSTRAINT `fk_form_id_filedcase` FOREIGN KEY (`form_id`) REFERENCES `form` (`form_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_mem_id_filedcase` FOREIGN KEY (`mem_id`) REFERENCES `member` (` mem_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filed case`
--

LOCK TABLES `filed case` WRITE;
/*!40000 ALTER TABLE `filed case` DISABLE KEYS */;
/*!40000 ALTER TABLE `filed case` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form`
--

DROP TABLE IF EXISTS `form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form` (
  `form_id` int(7) NOT NULL AUTO_INCREMENT,
  `name_form` varchar(45) CHARACTER SET latin1 NOT NULL,
  `official_no` int(11) NOT NULL,
  `mem_id` int(7) NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`form_id`),
  KEY `fk_official_no_form_idx` (`official_no`),
  KEY `fk_mem_id_form_idx` (`mem_id`),
  KEY `fk_barangay_id_form_idx` (`barangay_id`),
  CONSTRAINT `fk_barangay_id_form` FOREIGN KEY (`barangay_id`) REFERENCES `barangay profile` (`barangay_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_mem_id_form` FOREIGN KEY (`mem_id`) REFERENCES `member` (` mem_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_official_no_form` FOREIGN KEY (`official_no`) REFERENCES `official` (`official_no`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form`
--

LOCK TABLES `form` WRITE;
/*!40000 ALTER TABLE `form` DISABLE KEYS */;
/*!40000 ALTER TABLE `form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `garage certificate`
--

DROP TABLE IF EXISTS `garage certificate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `garage certificate` (
  `form_id_garage` int(7) NOT NULL AUTO_INCREMENT,
  `control_no_garage` int(11) NOT NULL,
  `designated_of_garage` enum('yes','no') CHARACTER SET latin1 NOT NULL,
  `location_garage` varchar(50) CHARACTER SET latin1 NOT NULL,
  `engine_number_garage` varchar(30) CHARACTER SET latin1 NOT NULL,
  `body_number_garage` int(15) NOT NULL,
  `lto_OR_number_garage` varchar(50) CHARACTER SET latin1 NOT NULL,
  `garage_photo` blob NOT NULL,
  `date_issued_garage` date NOT NULL,
  `barangay_Official_receipt_no_garage` int(30) NOT NULL,
  `amount_paid_garage` double NOT NULL,
  `ctc_no_garage` int(11) NOT NULL,
  `ctc_issued_on_garage` date NOT NULL,
  `ctc_issued_at_garage` varchar(50) CHARACTER SET latin1 NOT NULL,
  `form_id` int(7) NOT NULL,
  `mem_id` int(7) NOT NULL,
  `account_id` int(7) NOT NULL,
  PRIMARY KEY (`form_id_garage`),
  KEY `fk_form_id_garagecert_idx` (`form_id`),
  KEY `fk_mem_id_garagecert_idx` (`mem_id`),
  KEY `fk_account_id_garagecert_idx` (`account_id`),
  CONSTRAINT `fk_account_id_garagecert` FOREIGN KEY (`account_id`) REFERENCES `official account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_form_id_garagecert` FOREIGN KEY (`form_id`) REFERENCES `form` (`form_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_mem_id_garagecert` FOREIGN KEY (`mem_id`) REFERENCES `member` (` mem_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `garage certificate`
--

LOCK TABLES `garage certificate` WRITE;
/*!40000 ALTER TABLE `garage certificate` DISABLE KEYS */;
/*!40000 ALTER TABLE `garage certificate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `garbage fee`
--

DROP TABLE IF EXISTS `garbage fee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `garbage fee` (
  `garb_id_garbfee` int(7) NOT NULL AUTO_INCREMENT,
  ` datePaid_garbfee` date NOT NULL,
  `brgy_OR_garbfee` int(7) NOT NULL,
  `total_amt_paid_garbfee` double NOT NULL,
  `city_OR_garbfee` int(7) NOT NULL,
  `amt_pd_citytreasurer_garbfee` double NOT NULL,
  `application_payment` double NOT NULL,
  `account_id` int(7) NOT NULL,
  `form_id` int(7) NOT NULL,
  `mem_id` int(7) NOT NULL,
  PRIMARY KEY (`garb_id_garbfee`),
  KEY `fk_account_id_garbagefee_idx` (`account_id`),
  KEY `fk_form_id_garbagefee_idx` (`form_id`),
  KEY `fk_mem_id_garbagefee_idx` (`mem_id`),
  CONSTRAINT `fk_account_id_garbagefee` FOREIGN KEY (`account_id`) REFERENCES `official account` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_form_id_garbagefee` FOREIGN KEY (`form_id`) REFERENCES `form` (`form_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_mem_id_garbagefee` FOREIGN KEY (`mem_id`) REFERENCES `member` (` mem_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `garbage fee`
--

LOCK TABLES `garbage fee` WRITE;
/*!40000 ALTER TABLE `garbage fee` DISABLE KEYS */;
/*!40000 ALTER TABLE `garbage fee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `health facilities`
--

DROP TABLE IF EXISTS `health facilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `health facilities` (
  `health_facility_id` int(11) NOT NULL AUTO_INCREMENT,
  `healthfacilities_type` varchar(30) CHARACTER SET latin1 NOT NULL,
  `numberOfType` int(7) NOT NULL,
  `numberOfPatientsServed` int(7) NOT NULL,
  `otherSpecify` varchar(20) CHARACTER SET latin1 NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`health_facility_id`),
  KEY `fk_barangay_id_healthfaci_idx` (`barangay_id`),
  CONSTRAINT `fk_barangay_id_healthfaci` FOREIGN KEY (`barangay_id`) REFERENCES `barangay profile` (`barangay_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `health facilities`
--

LOCK TABLES `health facilities` WRITE;
/*!40000 ALTER TABLE `health facilities` DISABLE KEYS */;
/*!40000 ALTER TABLE `health facilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `health info`
--

DROP TABLE IF EXISTS `health info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `health info` (
  `health_id` int(7) NOT NULL AUTO_INCREMENT,
  `common_illness` enum('Diarrhea','mumps','chickenpox','UTI') CHARACTER SET latin1 NOT NULL,
  `common_illness_others` varchar(30) CHARACTER SET latin1 NOT NULL,
  ` facilities/services` enum('government hospital','private hospital','health center','private doctor','hilot') CHARACTER SET latin1 NOT NULL,
  ` disability` enum('yes','no') CHARACTER SET latin1 NOT NULL,
  ` disability_yes` enum('total blindness of one eyes','total blindness of both eyes','missing one or both arms','mongoloid','cleff palate','Poor eyesight','hunchback','paralyzed legs','paralyzed arms','speech disorder','autistic','fractured vertebrate column','paralyzed from neck down','hydrocephalus','deaf','mute and deaf','inablity to walk alone','deformity','polio','mental impairment','celebral','palsy','epileptic','dwarfism','others') CHARACTER SET latin1 NOT NULL,
  `pregnancy` enum('yes','no') CHARACTER SET latin1 NOT NULL,
  ` family_planning` enum('yes','no') CHARACTER SET latin1 NOT NULL,
  `family_planning_yes` enum('condom','diaphragm','body temperature','injectibles','iud','ligation','pills','rhythm','mucus','natural','vasectomy','withdrawal') CHARACTER SET latin1 NOT NULL,
  `go/ngo assistance` enum('yes','no') CHARACTER SET latin1 NOT NULL,
  `go/ngo-assistance_yes` varchar(50) CHARACTER SET latin1 NOT NULL,
  `mem_d` int(7) NOT NULL,
  `hhold_id` int(7) NOT NULL,
  `child_id` int(7) NOT NULL,
  PRIMARY KEY (`health_id`),
  KEY `fk_mem_id_healthinfo_idx` (`mem_d`),
  KEY `fk_hhold_id_healthinfo_idx` (`hhold_id`),
  KEY `fk_child_id_healthinfo_idx` (`child_id`),
  CONSTRAINT `fk_child_id_healthinfo` FOREIGN KEY (`child_id`) REFERENCES `immunized children` (`child_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_hhold_id_healthinfo` FOREIGN KEY (`hhold_id`) REFERENCES `household` (`hhold_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_mem_id_healthinfo` FOREIGN KEY (`mem_d`) REFERENCES `member` (` mem_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `health info`
--

LOCK TABLES `health info` WRITE;
/*!40000 ALTER TABLE `health info` DISABLE KEYS */;
/*!40000 ALTER TABLE `health info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `house distribution`
--

DROP TABLE IF EXISTS `house distribution`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `house distribution` (
  `housDist_id` int(7) NOT NULL AUTO_INCREMENT,
  `total_hhold_3yrs` double NOT NULL,
  `ave_hhold_3yrs` double NOT NULL,
  `ave_hhold_income_3yrs` double NOT NULL,
  `barangay_id` int(7) NOT NULL,
  `hhold_id` int(7) NOT NULL,
  PRIMARY KEY (`housDist_id`),
  KEY `fk_hhold_id_housdist_idx` (`hhold_id`),
  KEY `fk_barangay_id_housdist_idx` (`barangay_id`),
  CONSTRAINT `fk_barangay_id_housdist` FOREIGN KEY (`barangay_id`) REFERENCES `barangay profile` (`barangay_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_hhold_id_housdist` FOREIGN KEY (`hhold_id`) REFERENCES `household` (`hhold_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `house distribution`
--

LOCK TABLES `house distribution` WRITE;
/*!40000 ALTER TABLE `house distribution` DISABLE KEYS */;
/*!40000 ALTER TABLE `house distribution` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `household`
--

DROP TABLE IF EXISTS `household`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `household` (
  `hhold_id` int(7) NOT NULL AUTO_INCREMENT,
  `hhold_number` int(3) NOT NULL,
  `solo_parent` enum('yes','no') CHARACTER SET latin1 NOT NULL,
  `solo_parent_yes` enum('death of spouse',' imprisonment of spouse at least 1 year','mental/physical incapacity of house','legal or de facto separation from spouse for at least 1 year','Abandonment of spouse for at least 1 year','Unmarried mother/father who preferred to keep the child instead of others carrying him/her','Any other person who solely provides parental care and support to a child provided he/she is duly licensed foster parent of DSWD','Any family member who assumes the responsibility as head of the family as a result of death','abandonment','absence for at least one year') CHARACTER SET latin1 NOT NULL,
  `solo_parent_others` varchar(30) CHARACTER SET latin1 NOT NULL,
  `purok_hhold` int(2) NOT NULL,
  `street` varchar(50) CHARACTER SET latin1 NOT NULL,
  `barangay` varchar(30) CHARACTER SET latin1 NOT NULL,
  `sources_of_info` enum('Television','radio','Newspaper') CHARACTER SET latin1 NOT NULL,
  `sources_of_info_specify_others` varchar(30) CHARACTER SET latin1 NOT NULL,
  `communication_services` enum('cell sites','internet','telephone','postal services') CHARACTER SET latin1 NOT NULL,
  `communication_services_others` varchar(30) CHARACTER SET latin1 NOT NULL,
  `energy source` enum('electricity','solar','petromax','kerosene') CHARACTER SET latin1 NOT NULL,
  `means_of_transportation` enum('PU jeep',' taxi','tricycle','PU bus','private car') CHARACTER SET latin1 NOT NULL,
  `house_pic` blob NOT NULL,
  `born_alive_reg` int(2) NOT NULL,
  `date_born_reg` date NOT NULL,
  `born_alive_unreg` int(2) NOT NULL,
  `date_born_unreg` date NOT NULL,
  `born_dead_reg` int(2) NOT NULL,
  `date_dead_reg` date NOT NULL,
  `born_dead_unreg` int(2) NOT NULL,
  `date_dead_unreg` date NOT NULL,
  `still_birth_reg` int(2) NOT NULL,
  `date_sbirth_reg` date NOT NULL,
  `still_birth_unreg` int(2) NOT NULL,
  `date_sbirth_unreg` date NOT NULL,
  `no_dead_child` int(2) NOT NULL,
  `cause of death_ch` varchar(50) CHARACTER SET latin1 NOT NULL,
  `no_of death_ad` int(2) NOT NULL,
  `cause_of_death` varchar(50) CHARACTER SET latin1 NOT NULL,
  `mem_id` int(7) NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`hhold_id`),
  KEY `fk_mem_id_hhold_idx` (`mem_id`),
  KEY `fk_barangay_id_hhold_idx` (`barangay_id`),
  CONSTRAINT `fk_barangay_id_hhold` FOREIGN KEY (`barangay_id`) REFERENCES `barangay profile` (`barangay_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_mem_id_hhold` FOREIGN KEY (`mem_id`) REFERENCES `member` (` mem_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `household`
--

LOCK TABLES `household` WRITE;
/*!40000 ALTER TABLE `household` DISABLE KEYS */;
/*!40000 ALTER TABLE `household` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `housing`
--

DROP TABLE IF EXISTS `housing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `housing` (
  `houseNo` int(7) NOT NULL AUTO_INCREMENT,
  `status_of_ownership_house` enum('owned','rented','temporary','caretaker') CHARACTER SET latin1 NOT NULL,
  `status_of_ownership_lot` enum('semi-permanent','owned','rented',' permanent','concrete','caretaker') CHARACTER SET latin1 NOT NULL,
  `type_of_dwelling_structure` enum('permanent','concrete','semi-permanent','temporary') CHARACTER SET latin1 NOT NULL,
  `hhold_id` int(7) NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`houseNo`),
  KEY `fk_hhold_id_housing_idx` (`hhold_id`),
  KEY `fk_barangay_id_housing_idx` (`barangay_id`),
  CONSTRAINT `fk_barangay_id_housing` FOREIGN KEY (`barangay_id`) REFERENCES `barangay profile` (`barangay_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_hhold_id_housing` FOREIGN KEY (`hhold_id`) REFERENCES `household` (`hhold_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `housing`
--

LOCK TABLES `housing` WRITE;
/*!40000 ALTER TABLE `housing` DISABLE KEYS */;
/*!40000 ALTER TABLE `housing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `immunized children`
--

DROP TABLE IF EXISTS `immunized children`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `immunized children` (
  `child_id` int(7) NOT NULL AUTO_INCREMENT,
  `type_immunized_children` enum('Vitamin A',' Deworm',' Hep B','MMR1','BCG','MMr2') CHARACTER SET latin1 NOT NULL,
  `penta` enum('6th week','10th week','14th week') CHARACTER SET latin1 NOT NULL,
  `opv` enum('6th week','10th week','14th week') CHARACTER SET latin1 NOT NULL,
  `ipv` enum('6th week','10th week','14th week') CHARACTER SET latin1 NOT NULL,
  `pcv_13` enum('6th week','10th week','14th week') CHARACTER SET latin1 NOT NULL,
  `health_id` int(7) NOT NULL,
  `mem_id` int(7) NOT NULL,
  PRIMARY KEY (`child_id`),
  KEY `fk_health_id_immunchild_idx` (`health_id`),
  KEY `fk_mem_id_immunchild_idx` (`mem_id`),
  CONSTRAINT `fk_health_id_immunchild` FOREIGN KEY (`health_id`) REFERENCES `health info` (`health_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_mem_id_immunchild` FOREIGN KEY (`mem_id`) REFERENCES `member` (` mem_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `immunized children`
--

LOCK TABLES `immunized children` WRITE;
/*!40000 ALTER TABLE `immunized children` DISABLE KEYS */;
/*!40000 ALTER TABLE `immunized children` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member` (
  ` mem_id` int(7) NOT NULL AUTO_INCREMENT,
  `family_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `first_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  `middle_name` varchar(50) CHARACTER SET latin1 NOT NULL,
  ` relation_to_head` varchar(45) CHARACTER SET latin1 NOT NULL,
  `sex` enum('female','male') CHARACTER SET latin1 NOT NULL,
  `placeOfBirth` varchar(50) CHARACTER SET latin1 NOT NULL,
  `dateOfBirth` varchar(20) CHARACTER SET latin1 NOT NULL,
  `email_add` varchar(20) CHARACTER SET latin1 NOT NULL,
  `mobile_no` int(15) NOT NULL,
  `telephone_no` int(15) NOT NULL,
  `civilStatus` enum('single','married','widow','separated','common-law','complicated') CHARACTER SET latin1 NOT NULL,
  `citizenship` varchar(30) CHARACTER SET latin1 NOT NULL,
  ` religion` varchar(30) CHARACTER SET latin1 NOT NULL,
  `schooling` varchar(50) CHARACTER SET latin1 NOT NULL,
  `Highest_educational_attainment` varchar(30) CHARACTER SET latin1 NOT NULL,
  ` familyIncome` int(11) NOT NULL,
  `statusOfResidency` enum('permanent','live-in relative','boarder','buss resident','moved out','deceased') CHARACTER SET latin1 NOT NULL,
  `ethnicGroup` varchar(50) CHARACTER SET latin1 NOT NULL,
  `height` double NOT NULL,
  ` weight` double NOT NULL,
  `bloodType` enum('A','B','O','AB') CHARACTER SET latin1 NOT NULL,
  ` registeredVoterOfTheBrgy` enum('yes','no') CHARACTER SET latin1 NOT NULL,
  ` mem_pic` blob NOT NULL,
  `previousResidence` int(11) NOT NULL,
  ` no._of_months_and_year_living_in_this_brgy` int(3) NOT NULL,
  ` reason_you_left_in_previous_brgy` varchar(250) CHARACTER SET latin1 NOT NULL,
  ` reason_you_came_in_this_brgy` varchar(250) CHARACTER SET latin1 NOT NULL,
  `until_when_you_stay_in_this_brgy` int(3) NOT NULL,
  `who_accompanied_you_to_transfer_here` varchar(50) CHARACTER SET latin1 NOT NULL,
  `hhold_id` int(7) NOT NULL,
  PRIMARY KEY (` mem_id`),
  KEY `fk_hhold_id_member_idx` (`hhold_id`),
  CONSTRAINT `fk_hhold_id_member` FOREIGN KEY (`hhold_id`) REFERENCES `household` (`hhold_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `official`
--

DROP TABLE IF EXISTS `official`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `official` (
  `official_no` int(7) NOT NULL AUTO_INCREMENT,
  `position` int(20) NOT NULL,
  `start_term` date NOT NULL,
  `end_term` date NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`official_no`),
  KEY `fk_barangay_id_official_idx` (`barangay_id`),
  CONSTRAINT `fk_barangay_id_official` FOREIGN KEY (`barangay_id`) REFERENCES `barangay profile` (`barangay_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `official`
--

LOCK TABLES `official` WRITE;
/*!40000 ALTER TABLE `official` DISABLE KEYS */;
/*!40000 ALTER TABLE `official` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `official account`
--

DROP TABLE IF EXISTS `official account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `official account` (
  `account_id` int(7) NOT NULL AUTO_INCREMENT,
  `username_official` varchar(15) CHARACTER SET latin1 NOT NULL,
  `password_official` varchar(255) CHARACTER SET latin1 NOT NULL,
  `date_registered_official` date NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`account_id`),
  KEY `fk_account_id_offiacc_idx` (`account_id`),
  KEY `fk_barangay_id_offiacc_idx` (`barangay_id`),
  CONSTRAINT `fk_barangay_id_offiacc` FOREIGN KEY (`barangay_id`) REFERENCES `barangay profile` (`barangay_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `official account`
--

LOCK TABLES `official account` WRITE;
/*!40000 ALTER TABLE `official account` DISABLE KEYS */;
/*!40000 ALTER TABLE `official account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pet vaccine`
--

DROP TABLE IF EXISTS `pet vaccine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pet vaccine` (
  `pet_id` int(7) NOT NULL AUTO_INCREMENT,
  `control_number_pet` int(11) NOT NULL,
  `nameOfPet` varchar(10) CHARACTER SET latin1 NOT NULL,
  ` kindOfPet` varchar(10) CHARACTER SET latin1 NOT NULL,
  `breedOfPet` varchar(15) CHARACTER SET latin1 NOT NULL,
  ` dateOfVaccine` date NOT NULL,
  `amountPaid_vaccinated_pet` double NOT NULL,
  `officialReceipt_vaccination_pet` int(7) NOT NULL,
  `registrationStatus` enum('yes','no') CHARACTER SET latin1 NOT NULL,
  ` reg_official_receipt_no` int(7) NOT NULL,
  `dateOfRegistration` date NOT NULL,
  ` amountPaid_registered_pet` double NOT NULL,
  `official_no` int(7) NOT NULL,
  `mem_id` int(7) NOT NULL,
  PRIMARY KEY (`pet_id`),
  KEY `fk_official_no_pet_idx` (`official_no`),
  KEY `fk_mem_id_pet_idx` (`mem_id`),
  CONSTRAINT `fk_mem_id_pet` FOREIGN KEY (`mem_id`) REFERENCES `member` (` mem_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_official_no_pet` FOREIGN KEY (`official_no`) REFERENCES `official` (`official_no`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pet vaccine`
--

LOCK TABLES `pet vaccine` WRITE;
/*!40000 ALTER TABLE `pet vaccine` DISABLE KEYS */;
/*!40000 ALTER TABLE `pet vaccine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `school`
--

DROP TABLE IF EXISTS `school`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `school` (
  `school_id` int(7) NOT NULL AUTO_INCREMENT,
  ` pre_school` enum('graduate','undergraduate','currently enrolled') CHARACTER SET latin1 NOT NULL,
  `primary_elementary` enum('graduate','undergraduate','currently enrolled') CHARACTER SET latin1 NOT NULL,
  `secondary_highschool` enum('graduate','undergraduate','currently enrolled') CHARACTER SET latin1 NOT NULL,
  `vocational` enum('graduate','undergraduate','currently enrolled') CHARACTER SET latin1 NOT NULL,
  `college` enum('graduate','undergraduate','currently enrolled') CHARACTER SET latin1 NOT NULL,
  `post_graduate` enum('graduate','undergraduate','currently enrolled') CHARACTER SET latin1 NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`school_id`),
  KEY `fk_barangay_id_sch_idx` (`barangay_id`),
  CONSTRAINT `fk_barangay_id_sch` FOREIGN KEY (`barangay_id`) REFERENCES `barangay profile` (`barangay_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school`
--

LOCK TABLES `school` WRITE;
/*!40000 ALTER TABLE `school` DISABLE KEYS */;
/*!40000 ALTER TABLE `school` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sport`
--

DROP TABLE IF EXISTS `sport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sport` (
  `sport_building_id` int(7) NOT NULL AUTO_INCREMENT,
  `num_covered_courts` int(2) NOT NULL,
  `num_gymnasium` int(2) NOT NULL,
  `num_park_plaza` int(2) NOT NULL,
  `other_sport_facilities` varchar(50) CHARACTER SET latin1 NOT NULL,
  `other_sport_facilities_num` int(2) NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`sport_building_id`),
  KEY `fk_barangay_id_sport_idx` (`barangay_id`),
  CONSTRAINT `fk_barangay_id_sport` FOREIGN KEY (`barangay_id`) REFERENCES `barangay profile` (`barangay_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sport`
--

LOCK TABLES `sport` WRITE;
/*!40000 ALTER TABLE `sport` DISABLE KEYS */;
/*!40000 ALTER TABLE `sport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `water supply source`
--

DROP TABLE IF EXISTS `water supply source`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `water supply source` (
  ` water_id` int(7) NOT NULL AUTO_INCREMENT,
  `level1` enum('deepwell public','spring','deepwell private') CHARACTER SET latin1 NOT NULL,
  `level2` enum('deepwell public','spring','deepwell private') CHARACTER SET latin1 NOT NULL,
  `level3` enum('deepwell public','spring','deepwell private') CHARACTER SET latin1 NOT NULL,
  `hhold_id` int(7) NOT NULL,
  PRIMARY KEY (` water_id`),
  KEY `fk_hhold_id_water_idx` (`hhold_id`),
  CONSTRAINT `fk_hhold_id_water` FOREIGN KEY (`hhold_id`) REFERENCES `household` (`hhold_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `water supply source`
--

LOCK TABLES `water supply source` WRITE;
/*!40000 ALTER TABLE `water supply source` DISABLE KEYS */;
/*!40000 ALTER TABLE `water supply source` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-05 15:52:23
