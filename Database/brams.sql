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
-- Table structure for table `barangay_profile`
--

DROP TABLE IF EXISTS `barangay_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barangay_profile` (
  `barangay_id` int(7) NOT NULL,
  `baranagay_name` varchar(45) NOT NULL,
  `province` varchar(45) NOT NULL,
  `muni_city` varchar(45) NOT NULL,
  `region` varchar(45) NOT NULL,
  `legal_basis` varchar(45) NOT NULL,
  `date_legal_basis` date NOT NULL,
  `date_ratification` date NOT NULL,
  `mother_barangay` varchar(45) NOT NULL,
  `old_name` varchar(45) NOT NULL,
  `type_barangay` varchar(45) NOT NULL,
  `boundaries_north` int(11) NOT NULL,
  `boundaries_east` int(11) NOT NULL,
  `boundaries_west` int(11) NOT NULL,
  `boundaries_south` int(11) NOT NULL,
  `totalland_area_sqkm` blob NOT NULL,
  `totalland_area_hec` blob NOT NULL,
  `distance_municipal_city` int(11) NOT NULL,
  `province_capitol` varchar(45) NOT NULL,
  `national_highway` varchar(45) NOT NULL,
  `landform_type` varchar(45) NOT NULL,
  `landform_percentage` int(11) NOT NULL,
  PRIMARY KEY (`barangay_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barangay_profile`
--

LOCK TABLES `barangay_profile` WRITE;
/*!40000 ALTER TABLE `barangay_profile` DISABLE KEYS */;
/*!40000 ALTER TABLE `barangay_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bridge_in_kilometers`
--

DROP TABLE IF EXISTS `bridge_in_kilometers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bridge_in_kilometers` (
  `kilo_id` int(7) NOT NULL,
  `type` varchar(45) NOT NULL,
  `national` varchar(45) NOT NULL,
  `provincial` varchar(45) NOT NULL,
  `city/mun` varchar(45) NOT NULL,
  `barangay` varchar(45) NOT NULL,
  `totalmeter` int(11) NOT NULL,
  `operational` varchar(45) NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`kilo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bridge_in_kilometers`
--

LOCK TABLES `bridge_in_kilometers` WRITE;
/*!40000 ALTER TABLE `bridge_in_kilometers` DISABLE KEYS */;
/*!40000 ALTER TABLE `bridge_in_kilometers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bridge_in_meters`
--

DROP TABLE IF EXISTS `bridge_in_meters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bridge_in_meters` (
  `meter_id` int(7) NOT NULL,
  `type` varchar(45) NOT NULL,
  `national` varchar(45) NOT NULL,
  `provincial` varchar(45) NOT NULL,
  `city/mun` varchar(45) NOT NULL,
  `barangay` varchar(45) NOT NULL,
  `totalmeter` int(11) NOT NULL,
  `operational` varchar(45) NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`meter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bridge_in_meters`
--

LOCK TABLES `bridge_in_meters` WRITE;
/*!40000 ALTER TABLE `bridge_in_meters` DISABLE KEYS */;
/*!40000 ALTER TABLE `bridge_in_meters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `communication`
--

DROP TABLE IF EXISTS `communication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `communication` (
  `com_id` int(7) NOT NULL,
  `type` varchar(45) NOT NULL,
  `totalProvider` double NOT NULL,
  `name/s_of_company` varchar(45) NOT NULL,
  `numberHouseholdServed` int(11) NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`com_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `communication`
--

LOCK TABLES `communication` WRITE;
/*!40000 ALTER TABLE `communication` DISABLE KEYS */;
/*!40000 ALTER TABLE `communication` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distribution_of_landuse`
--

DROP TABLE IF EXISTS `distribution_of_landuse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `distribution_of_landuse` (
  `land_id` int(7) NOT NULL,
  `landuse_type` varchar(45) NOT NULL,
  `landarea_sqm` int(11) NOT NULL,
  `landarea_hec` int(11) NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`land_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distribution_of_landuse`
--

LOCK TABLES `distribution_of_landuse` WRITE;
/*!40000 ALTER TABLE `distribution_of_landuse` DISABLE KEYS */;
/*!40000 ALTER TABLE `distribution_of_landuse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employment`
--

DROP TABLE IF EXISTS `employment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employment` (
  `emp_id` int(7) NOT NULL,
  `employment_status` varchar(20) NOT NULL,
  `general_job_description` varchar(20) NOT NULL,
  `job_category` varchar(20) NOT NULL,
  `employment_category` varchar(20) NOT NULL,
  `monthly_income_cash` double NOT NULL,
  `mem_id` int(7) NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employment`
--

LOCK TABLES `employment` WRITE;
/*!40000 ALTER TABLE `employment` DISABLE KEYS */;
/*!40000 ALTER TABLE `employment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `environment_info`
--

DROP TABLE IF EXISTS `environment_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `environment_info` (
  `env_id` int(7) NOT NULL,
  `food_service` varchar(20) NOT NULL,
  `kind_of_food_storage` varchar(20) NOT NULL,
  `garbage_disposal` date NOT NULL,
  `water_storage_facility` varchar(20) NOT NULL,
  `household_storage` varchar(20) NOT NULL,
  `toilet_facilities` varchar(20) NOT NULL,
  `drainage_facilities` varchar(20) NOT NULL,
  `hhold_id` int(7) NOT NULL,
  PRIMARY KEY (`env_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `environment_info`
--

LOCK TABLES `environment_info` WRITE;
/*!40000 ALTER TABLE `environment_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `environment_info` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-20 22:58:04
