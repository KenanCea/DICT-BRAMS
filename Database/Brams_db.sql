-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: brams_db
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
-- Table structure for table `health_info`
--

DROP TABLE IF EXISTS `health_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `health_info` (
  `health_id` int(7) NOT NULL,
  `common_illness` varchar(50) NOT NULL,
  `facilities/services` enum('government hospital','private hospital','health center','private doctor','hilot') NOT NULL,
  `disability` enum('Yes','No') NOT NULL,
  `pregnancy` enum('Yes','No') NOT NULL,
  `family_planning` enum('Yes','No') NOT NULL,
  `family_planning_yes` enum('condom','diaphragm','body temperature','injectibles','iud','ligation','pills','rhythm','mucus','natural','vasectomy','withdrawal') NOT NULL,
  `go/go_assistance` enum('Yes','No') NOT NULL,
  `go/ngo_assistance_yes` varchar(30) NOT NULL,
  `name_of_dead_person` varchar(30) NOT NULL,
  `cause_of_death` varchar(30) NOT NULL,
  `date_of_death` date NOT NULL,
  `born_alive_registered` int(2) NOT NULL,
  `born_alive_unregistered` int(2) NOT NULL,
  `born_dead_registered` int(2) NOT NULL,
  `born_dead_unregistered` int(2) NOT NULL,
  `still_birth_registered` int(2) NOT NULL,
  `still_birth_unregistered` int(2) NOT NULL,
  PRIMARY KEY (`health_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `health_info`
--

LOCK TABLES `health_info` WRITE;
/*!40000 ALTER TABLE `health_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `health_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `house_distribution`
--

DROP TABLE IF EXISTS `house_distribution`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `house_distribution` (
  `housDist_id` int(7) NOT NULL,
  `total_hhold_3yrs` int(3) NOT NULL,
  `ave_hhold_3yrs` double NOT NULL,
  `ave_hhold_income_3yrs` double NOT NULL,
  PRIMARY KEY (`housDist_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `house_distribution`
--

LOCK TABLES `house_distribution` WRITE;
/*!40000 ALTER TABLE `house_distribution` DISABLE KEYS */;
/*!40000 ALTER TABLE `house_distribution` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member` (
  `mem_id` int(7) NOT NULL,
  `family_name` varchar(45) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `middle_name` varchar(45) NOT NULL,
  `relation_to_head` enum('head','aunt','brother-in-law','daughter-in-law','daughter','father','grandfather','grandmother','house helper','husband','mother','son','son-in-law','sister-in-law','tenant','uncle','wife','common law wife','niece','nephew') NOT NULL,
  `sex` enum('female','male') NOT NULL,
  `placeOfBirth` varchar(45) NOT NULL,
  `dateOfBirth` varchar(45) NOT NULL,
  `email_add` varchar(20) NOT NULL,
  `mobile_no` int(25) NOT NULL,
  `telephone_no` int(15) NOT NULL,
  `civilStatus` enum('single','married','widow','separated','common-law','complicated') NOT NULL,
  `citizenship` varchar(30) NOT NULL,
  `religion` varchar(30) NOT NULL,
  `schooling` varchar(75) NOT NULL,
  `highest_educational_attainment` varchar(45) NOT NULL,
  `familyIncome` int(11) NOT NULL,
  `statusOfResidency` enum('permanent','live-in relative','boarder','buss resident','moved out','deceased dialect') NOT NULL,
  `ethnicGroup` varchar(45) NOT NULL,
  `height` double NOT NULL,
  `weight` double NOT NULL,
  `bloodType` enum('A','B','O','AB') NOT NULL,
  `registeredVoterOfTheBrgy` enum('yes','no') NOT NULL,
  `mem_pic` blob NOT NULL,
  `previousResidence` varchar(45) NOT NULL,
  `No._of_months_and_year_living_in_this_brgy` int(3) NOT NULL,
  `reason_you_left_in_previous_brgy` varchar(250) NOT NULL,
  `reason_you_came_in_this_barangay` varchar(250) NOT NULL,
  `until_when_you_stay_in_this_brgy` int(3) NOT NULL,
  `who_accompanied_you_to_transfer_here` varchar(45) NOT NULL,
  PRIMARY KEY (`mem_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `official_account`
--

DROP TABLE IF EXISTS `official_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `official_account` (
  `account_id` int(7) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(16) NOT NULL,
  `date_registered` date NOT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `official_account`
--

LOCK TABLES `official_account` WRITE;
/*!40000 ALTER TABLE `official_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `official_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `officials`
--

DROP TABLE IF EXISTS `officials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `officials` (
  `official_no` int(7) NOT NULL,
  `position` int(20) NOT NULL,
  `start_term` date NOT NULL,
  `end_term` date NOT NULL,
  PRIMARY KEY (`official_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `officials`
--

LOCK TABLES `officials` WRITE;
/*!40000 ALTER TABLE `officials` DISABLE KEYS */;
/*!40000 ALTER TABLE `officials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pet_vaccine`
--

DROP TABLE IF EXISTS `pet_vaccine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pet_vaccine` (
  `pet_id` int(7) NOT NULL,
  `nameOfPet` varchar(10) NOT NULL,
  `kindOfPet` varchar(10) NOT NULL,
  `breedOfPet` varchar(15) NOT NULL,
  `dateOfVaccine` date NOT NULL,
  `amountPaid` double NOT NULL,
  `officialReceipt` int(7) NOT NULL,
  `registrationStatus` enum('Yes','No') NOT NULL,
  `reg_official_receipt_no` int(7) NOT NULL,
  `dateOfRegistration` date NOT NULL,
  PRIMARY KEY (`pet_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pet_vaccine`
--

LOCK TABLES `pet_vaccine` WRITE;
/*!40000 ALTER TABLE `pet_vaccine` DISABLE KEYS */;
/*!40000 ALTER TABLE `pet_vaccine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `school`
--

DROP TABLE IF EXISTS `school`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `school` (
  `school_id` int(7) NOT NULL,
  `pre_school` enum('graduate','undergraduate','currently enrolled') NOT NULL,
  `primary_elementary` enum('graduate','undergraduate','currently enrolled') NOT NULL,
  `secondary_highschool` enum('graduate','undergraduate','currently enrolled') NOT NULL,
  `vocational` enum('graduate','undergraduate','currently enrolled') NOT NULL,
  `college` enum('graduate','undergraduate','currently enrolled') NOT NULL,
  `post_graduate` enum('graduate','undergraduate','currently enrolled') NOT NULL,
  PRIMARY KEY (`school_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school`
--

LOCK TABLES `school` WRITE;
/*!40000 ALTER TABLE `school` DISABLE KEYS */;
/*!40000 ALTER TABLE `school` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `water_supply_source`
--

DROP TABLE IF EXISTS `water_supply_source`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `water_supply_source` (
  `water_id` int(7) NOT NULL,
  `level1` enum('deepwell public','spring','deepwell private') NOT NULL,
  `level2` enum('deepwell public','spring','deepwell private') NOT NULL,
  `level3` enum('deepwell public','spring','deepwell private') NOT NULL,
  PRIMARY KEY (`water_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `water_supply_source`
--

LOCK TABLES `water_supply_source` WRITE;
/*!40000 ALTER TABLE `water_supply_source` DISABLE KEYS */;
/*!40000 ALTER TABLE `water_supply_source` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-21  1:08:44
