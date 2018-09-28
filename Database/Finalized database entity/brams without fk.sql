-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 08, 2018 at 06:50 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(7) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `barangay clearance`
--

DROP TABLE IF EXISTS `barangay clearance`;
CREATE TABLE IF NOT EXISTS `barangay clearance` (
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
  PRIMARY KEY (`form_id_clearance`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `barangay id card`
--

DROP TABLE IF EXISTS `barangay id card`;
CREATE TABLE IF NOT EXISTS `barangay id card` (
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
  PRIMARY KEY (`form_id_card`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `barangay profile`
--

DROP TABLE IF EXISTS `barangay profile`;
CREATE TABLE IF NOT EXISTS `barangay profile` (
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
  PRIMARY KEY (`barangay_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `barangay_certificate`
--

DROP TABLE IF EXISTS `barangay_certificate`;
CREATE TABLE IF NOT EXISTS `barangay_certificate` (
  `form_id_cert` int(7) NOT NULL AUTO_INCREMENT,
  `control_no_cert` varchar(45) CHARACTER SET latin1 NOT NULL,
  `purpose_brgy_cert` varchar(45) CHARACTER SET latin1 NOT NULL,
  `barangay_date_issued_cert` date NOT NULL,
  `ctc_no_cert` int(11) NOT NULL,
  `ctc_issued_at_cert` varchar(30) CHARACTER SET latin1 NOT NULL,
  `ctc_issued_on_cert` date NOT NULL,
  `official_receipt_no_cert` int(11) NOT NULL,
  `amount_paid_cert` varchar(45) CHARACTER SET latin1 NOT NULL,
  `mem_id` int(7) NOT NULL,
  `official_no` int(7) NOT NULL,
  PRIMARY KEY (`form_id_cert`),
  KEY `form_id` (`form_id_cert`),
  KEY `form_idx` (`form_id_cert`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bridge in kilometers`
--

DROP TABLE IF EXISTS `bridge in kilometers`;
CREATE TABLE IF NOT EXISTS `bridge in kilometers` (
  `Kilo_id` int(7) NOT NULL AUTO_INCREMENT,
  `Admin_level_type_land_use_kilo` varchar(20) CHARACTER SET latin1 NOT NULL,
  `Admin_level_national_kilo` double NOT NULL,
  `Admin_level_provincial_kilo` double NOT NULL,
  `Admin_level_city/Mun_kilo` double NOT NULL,
  `Admin_level_barangay_kilo` double NOT NULL,
  `Admin_level_totalkilometer_kilo` double NOT NULL,
  `Admin_level_operational_kilo` varchar(45) CHARACTER SET latin1 NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`Kilo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bridge in meters`
--

DROP TABLE IF EXISTS `bridge in meters`;
CREATE TABLE IF NOT EXISTS `bridge in meters` (
  `meter_id` int(7) NOT NULL AUTO_INCREMENT,
  `type_land_use` double NOT NULL,
  `Admin_level_national_meter` double NOT NULL,
  `Admin_level_provincial_meter` double NOT NULL,
  `Admin_level_city/Mun_meter` double NOT NULL,
  `Admin_level_barangay_meter` double NOT NULL,
  `Admin_level_totalmeter_meter` double NOT NULL,
  `Admin_level_operational_meter` varchar(45) CHARACTER SET latin1 NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`meter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `business clearance`
--

DROP TABLE IF EXISTS `business clearance`;
CREATE TABLE IF NOT EXISTS `business clearance` (
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
  PRIMARY KEY (`form_id_clearance_busclearance`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `communication`
--

DROP TABLE IF EXISTS `communication`;
CREATE TABLE IF NOT EXISTS `communication` (
  `com_id` int(7) NOT NULL AUTO_INCREMENT,
  `type_communication` varchar(20) CHARACTER SET latin1 NOT NULL,
  `totalProvider` double NOT NULL,
  `name/s_of_company` varchar(45) CHARACTER SET latin1 NOT NULL,
  `numberHouseholdServed` int(3) NOT NULL,
  `barangay_id` int(7) NOT NULL,
  `mem_id` int(7) NOT NULL,
  PRIMARY KEY (`com_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `distribution of land use`
--

DROP TABLE IF EXISTS `distribution of land use`;
CREATE TABLE IF NOT EXISTS `distribution of land use` (
  `land_id` int(7) NOT NULL AUTO_INCREMENT,
  `landuse_type` varchar(20) CHARACTER SET latin1 NOT NULL,
  `landarea_sqm` double NOT NULL,
  `landarea_hec` double NOT NULL,
  `percentage_of_population` double NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`land_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

DROP TABLE IF EXISTS `education`;
CREATE TABLE IF NOT EXISTS `education` (
  `building_id` int(7) NOT NULL AUTO_INCREMENT,
  `no_pre_school_building` int(3) NOT NULL,
  `no_primary_building` int(3) NOT NULL,
  `no_secondary_building` int(3) NOT NULL,
  `no_vocational_building` int(3) NOT NULL,
  `no_college_building` int(3) NOT NULL,
  `no_post_graduate_building` int(3) NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`building_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employment`
--

DROP TABLE IF EXISTS `employment`;
CREATE TABLE IF NOT EXISTS `employment` (
  `emp_id` int(7) NOT NULL AUTO_INCREMENT,
  `employment_status` varchar(20) CHARACTER SET latin1 NOT NULL,
  `general_job _description` enum('permanent','contractual','temporary','self-employed','retired','unknown status') CHARACTER SET latin1 NOT NULL,
  `job_category` enum('private','government','self-employed','overseas') CHARACTER SET latin1 NOT NULL,
  `employment_category` varchar(20) CHARACTER SET latin1 NOT NULL,
  `monthly_income_cash` double NOT NULL,
  `mem_id` int(7) NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `environment info`
--

DROP TABLE IF EXISTS `environment info`;
CREATE TABLE IF NOT EXISTS `environment info` (
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
  PRIMARY KEY (`env_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `filed case`
--

DROP TABLE IF EXISTS `filed case`;
CREATE TABLE IF NOT EXISTS `filed case` (
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
  PRIMARY KEY (`form_id_case`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

DROP TABLE IF EXISTS `form`;
CREATE TABLE IF NOT EXISTS `form` (
  `form_id` int(7) NOT NULL AUTO_INCREMENT,
  `name_form` varchar(45) CHARACTER SET latin1 NOT NULL,
  `official_no` int(11) NOT NULL,
  `mem_id` int(7) NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `garage certificate`
--

DROP TABLE IF EXISTS `garage certificate`;
CREATE TABLE IF NOT EXISTS `garage certificate` (
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
  PRIMARY KEY (`form_id_garage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `garbage fee`
--

DROP TABLE IF EXISTS `garbage fee`;
CREATE TABLE IF NOT EXISTS `garbage fee` (
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
  PRIMARY KEY (`garb_id_garbfee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `health facilities`
--

DROP TABLE IF EXISTS `health facilities`;
CREATE TABLE IF NOT EXISTS `health facilities` (
  `health_facility_id` int(11) NOT NULL AUTO_INCREMENT,
  `healthfacilities_type` varchar(30) CHARACTER SET latin1 NOT NULL,
  `numberOfType` int(7) NOT NULL,
  `numberOfPatientsServed` int(7) NOT NULL,
  `otherSpecify` varchar(20) CHARACTER SET latin1 NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`health_facility_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `health info`
--

DROP TABLE IF EXISTS `health info`;
CREATE TABLE IF NOT EXISTS `health info` (
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
  PRIMARY KEY (`health_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `house distribution`
--

DROP TABLE IF EXISTS `house distribution`;
CREATE TABLE IF NOT EXISTS `house distribution` (
  `housDist_id` int(7) NOT NULL AUTO_INCREMENT,
  `total_hhold_3yrs` double NOT NULL,
  `ave_hhold_3yrs` double NOT NULL,
  `ave_hhold_income_3yrs` double NOT NULL,
  `barangay_id` int(7) NOT NULL,
  `hhold_id` int(7) NOT NULL,
  PRIMARY KEY (`housDist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `household`
--

DROP TABLE IF EXISTS `household`;
CREATE TABLE IF NOT EXISTS `household` (
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
  PRIMARY KEY (`hhold_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `housing`
--

DROP TABLE IF EXISTS `housing`;
CREATE TABLE IF NOT EXISTS `housing` (
  `houseNo` int(7) NOT NULL AUTO_INCREMENT,
  `status_of_ownership_house` enum('owned','rented','temporary','caretaker') CHARACTER SET latin1 NOT NULL,
  `status_of_ownership_lot` enum('semi-permanent','owned','rented',' permanent','concrete','caretaker') CHARACTER SET latin1 NOT NULL,
  `type_of_dwelling_structure` enum('permanent','concrete','semi-permanent','temporary') CHARACTER SET latin1 NOT NULL,
  `hhold_id` int(7) NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`houseNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `immunized children`
--

DROP TABLE IF EXISTS `immunized children`;
CREATE TABLE IF NOT EXISTS `immunized children` (
  `child_id` int(7) NOT NULL AUTO_INCREMENT,
  `type_immunized_children` enum('Vitamin A',' Deworm',' Hep B','MMR1','BCG','MMr2') CHARACTER SET latin1 NOT NULL,
  `penta` enum('6th week','10th week','14th week') CHARACTER SET latin1 NOT NULL,
  `opv` enum('6th week','10th week','14th week') CHARACTER SET latin1 NOT NULL,
  `ipv` enum('6th week','10th week','14th week') CHARACTER SET latin1 NOT NULL,
  `pcv_13` enum('6th week','10th week','14th week') CHARACTER SET latin1 NOT NULL,
  `health_id` int(7) NOT NULL,
  `mem_id` int(7) NOT NULL,
  PRIMARY KEY (`child_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
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
  PRIMARY KEY (` mem_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `official`
--

DROP TABLE IF EXISTS `official`;
CREATE TABLE IF NOT EXISTS `official` (
  `official_no` int(7) NOT NULL AUTO_INCREMENT,
  `position` varchar(30) NOT NULL,
  `start_term` date NOT NULL,
  `end_term` date NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`official_no`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `official account`
--

DROP TABLE IF EXISTS `official account`;
CREATE TABLE IF NOT EXISTS `official account` (
  `account_id` int(7) NOT NULL AUTO_INCREMENT,
  `username_official` varchar(15) CHARACTER SET latin1 NOT NULL,
  `password_official` varchar(255) CHARACTER SET latin1 NOT NULL,
  `date_registered_official` date NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`account_id`),
  KEY `fk_account_id_offiacc_idx` (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pet vaccine`
--

DROP TABLE IF EXISTS `pet vaccine`;
CREATE TABLE IF NOT EXISTS `pet vaccine` (
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
  PRIMARY KEY (`pet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

DROP TABLE IF EXISTS `school`;
CREATE TABLE IF NOT EXISTS `school` (
  `school_id` int(7) NOT NULL AUTO_INCREMENT,
  ` pre_school` enum('graduate','undergraduate','currently enrolled') CHARACTER SET latin1 NOT NULL,
  `primary_elementary` enum('graduate','undergraduate','currently enrolled') CHARACTER SET latin1 NOT NULL,
  `secondary_highschool` enum('graduate','undergraduate','currently enrolled') CHARACTER SET latin1 NOT NULL,
  `vocational` enum('graduate','undergraduate','currently enrolled') CHARACTER SET latin1 NOT NULL,
  `college` enum('graduate','undergraduate','currently enrolled') CHARACTER SET latin1 NOT NULL,
  `post_graduate` enum('graduate','undergraduate','currently enrolled') CHARACTER SET latin1 NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`school_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sport`
--

DROP TABLE IF EXISTS `sport`;
CREATE TABLE IF NOT EXISTS `sport` (
  `sport_building_id` int(7) NOT NULL AUTO_INCREMENT,
  `num_covered_courts` int(2) NOT NULL,
  `num_gymnasium` int(2) NOT NULL,
  `num_park_plaza` int(2) NOT NULL,
  `other_sport_facilities` varchar(50) CHARACTER SET latin1 NOT NULL,
  `other_sport_facilities_num` int(2) NOT NULL,
  `barangay_id` int(7) NOT NULL,
  PRIMARY KEY (`sport_building_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `water supply source`
--

DROP TABLE IF EXISTS `water supply source`;
CREATE TABLE IF NOT EXISTS `water supply source` (
  ` water_id` int(7) NOT NULL AUTO_INCREMENT,
  `level1` enum('deepwell public','spring','deepwell private') CHARACTER SET latin1 NOT NULL,
  `level2` enum('deepwell public','spring','deepwell private') CHARACTER SET latin1 NOT NULL,
  `level3` enum('deepwell public','spring','deepwell private') CHARACTER SET latin1 NOT NULL,
  `hhold_id` int(7) NOT NULL,
  PRIMARY KEY (` water_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
