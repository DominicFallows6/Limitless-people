-- MySQL dump 10.13  Distrib 5.6.30, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: truepeople
-- ------------------------------------------------------
-- Server version	5.6.30-0ubuntu0.14.04.1

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
-- Table structure for table `business`
--

DROP TABLE IF EXISTS `business`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `business` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `business_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `unique_id` char(32) CHARACTER SET utf8 NOT NULL,
  `default_days_leave` decimal(4,2) NOT NULL,
  `leave_start_date` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `leave_end_date` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `business`
--

LOCK TABLES `business` WRITE;
/*!40000 ALTER TABLE `business` DISABLE KEYS */;
INSERT INTO `business` VALUES (1,'Trueshopping','','2015-12-29 07:18:16','2015-12-29 07:18:16','c64cf3ff-ce90-11e5-9e3d-08002746',32.00,'','');
/*!40000 ALTER TABLE `business` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `business_announcements`
--

DROP TABLE IF EXISTS `business_announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `business_announcements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `announcements_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `announcements_content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `business_announcements_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `business_announcements`
--

LOCK TABLES `business_announcements` WRITE;
/*!40000 ALTER TABLE `business_announcements` DISABLE KEYS */;
/*!40000 ALTER TABLE `business_announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `holiday_requests`
--

DROP TABLE IF EXISTS `holiday_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `holiday_requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `requested_date` date NOT NULL,
  `date_of_return` date NOT NULL,
  `duration` decimal(4,2) NOT NULL,
  `authorised_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `holiday_requests_user_id_index` (`user_id`),
  KEY `holiday_requests_authorised_by_index` (`authorised_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `holiday_requests`
--

LOCK TABLES `holiday_requests` WRITE;
/*!40000 ALTER TABLE `holiday_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `holiday_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `idea_comments`
--

DROP TABLE IF EXISTS `idea_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `idea_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idea_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `idea_comment` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `idea_comments`
--

LOCK TABLES `idea_comments` WRITE;
/*!40000 ALTER TABLE `idea_comments` DISABLE KEYS */;
INSERT INTO `idea_comments` VALUES (1,1,67,'ngngn','2016-05-23 11:23:45','2016-05-23 11:23:45');
/*!40000 ALTER TABLE `idea_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `idea_likes`
--

DROP TABLE IF EXISTS `idea_likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `idea_likes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ideas_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `idea_likes`
--

LOCK TABLES `idea_likes` WRITE;
/*!40000 ALTER TABLE `idea_likes` DISABLE KEYS */;
INSERT INTO `idea_likes` VALUES (1,1,67);
/*!40000 ALTER TABLE `idea_likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `idea_status`
--

DROP TABLE IF EXISTS `idea_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `idea_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idea_status_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `idea_status`
--

LOCK TABLES `idea_status` WRITE;
/*!40000 ALTER TABLE `idea_status` DISABLE KEYS */;
INSERT INTO `idea_status` VALUES (1,'Live and active'),(2,'Closed');
/*!40000 ALTER TABLE `idea_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ideas`
--

DROP TABLE IF EXISTS `ideas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ideas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idea_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `idea_status_id` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ideas`
--

LOCK TABLES `ideas` WRITE;
/*!40000 ALTER TABLE `ideas` DISABLE KEYS */;
INSERT INTO `ideas` VALUES (1,'this is a test','<p>bfdb</p>','2016-05-23 11:13:47','2016-05-23 11:13:47',1,67);
/*!40000 ALTER TABLE `ideas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_100000_create_password_resets_table',1),('2016_05_23_124356_add_business_logo',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organisation_units`
--

DROP TABLE IF EXISTS `organisation_units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organisation_units` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `organisation_unit_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `organisation_unit_slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `business_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `organisation_units_organisation_unit_name_unique` (`organisation_unit_name`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organisation_units`
--

LOCK TABLES `organisation_units` WRITE;
/*!40000 ALTER TABLE `organisation_units` DISABLE KEYS */;
INSERT INTO `organisation_units` VALUES (1,'Information Technology','information-technology',1),(2,'Commercial','commercial',1),(3,'Translation','translation',1),(4,'Bathrooom','bathroom',1),(5,'Heating','heating',1),(6,'Customer Pre-Sales','customer-pre-sales',1),(7,'LED and Solar','led-and-solar',1),(8,'Customer Experience','customer-experience',1),(9,'Finance','finance',1),(10,'Business Administration','business-administration',1),(11,'Human Resource','human-resource',1),(12,'Warehouse','warehouse',1),(13,'Logistics and Purchasing','logistics-and-purchasing',1),(14,'Quality','quality',1);
/*!40000 ALTER TABLE `organisation_units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organisation_units_unit_locations`
--

DROP TABLE IF EXISTS `organisation_units_unit_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organisation_units_unit_locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `organisation_units_id` int(10) unsigned NOT NULL,
  `unit_locations_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organisation_units_unit_locations`
--

LOCK TABLES `organisation_units_unit_locations` WRITE;
/*!40000 ALTER TABLE `organisation_units_unit_locations` DISABLE KEYS */;
INSERT INTO `organisation_units_unit_locations` VALUES (1,1,1,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `organisation_units_unit_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('james.firminger@trueshopping.co.uk','d0ef79309163d15d50bcd00bbfb6d1ab204392db65717adef102164a5a328c25','2016-05-23 14:09:34');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit_locations`
--

DROP TABLE IF EXISTS `unit_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unit_locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `building_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `building_address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `business_id` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `unit_location_slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit_locations`
--

LOCK TABLES `unit_locations` WRITE;
/*!40000 ALTER TABLE `unit_locations` DISABLE KEYS */;
INSERT INTO `unit_locations` VALUES (1,'T1','Top of the Court',1,'2015-11-25 03:26:16','2015-11-25 03:26:16','top-of-the-court'),(2,'T2','Mezzanine',1,'2015-11-25 03:26:16','2015-11-25 03:26:16','mezzanine'),(3,'T3','Bottom of the Court',1,'2015-11-25 03:26:16','2015-11-25 03:26:16','bottom-of-the-court');
/*!40000 ALTER TABLE `unit_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `remember_token` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `superior_id` int(11) NOT NULL,
  `profile_pic` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `job_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nickname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `organisation_unit_id` int(10) unsigned NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_first_name_index` (`first_name`),
  KEY `users_surname_index` (`surname`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'aaron@trueshopping.co.uk','Aaron','Ashworth','$2y$10$1Eqx6VoWqGSBqDDtHTeJTuZWSEyDJjMvTQl2xABJTR0dyCN3pPiMq','aaron@trueshopping.co.uk','2016-05-23 11:06:35','2016-05-23 11:06:35','',0,50,'','','',1,NULL),(2,'abbie.broadbent@trueshopping.co.uk','Abbie','Broadbent','$2y$10$3sNEP57nfSzIFGX0e13vLuur5IKGOcP8s2.QxpQdq6LfAPL4SeXuO','abbie.broadbent@trueshopping.co.uk','2016-05-23 11:06:35','2016-05-23 11:06:35','',0,131,'','','',9,NULL),(3,'adam.mitchard@trueshopping.co.uk','Adam','Mitchard','$2y$10$ZLAug34.3rsJT/n7w2mwG.TSE.KLjg13KZ3O2bKgC0YYXMlS12Ia6','adam.mitchard@trueshopping.co.uk','2016-05-23 11:06:35','2016-05-23 11:12:39','l1XKeANAc70eUkJp8qXITLvIlBHOWJwrXbEP1H29V5tPMS5HbavBIJ2CmKHY',0,39,'/images/avatars/581938_10153708191190867_3412693267857860004_n.jpg','','',1,NULL),(4,'agnieszka.kulaj@trueshopping.co.uk','Agnieszka','Kulaj','$2y$10$7UnoTQI7WppwOrySMNFohecWwMfJU2H/BvfKKhgD6m9JJ/bw/roDq','agnieszka.kulaj@trueshopping.co.uk','2016-05-23 11:06:36','2016-05-23 11:06:36','',0,23,'','','',12,NULL),(5,'alanh@trueshopping.co.uk','Alan','Hall','$2y$10$axIEoaMAF/U627QKKcpUQ.4yCObEdXV6ogE9WtiMctn9c9bo4NQn2','alanh@trueshopping.co.uk','2016-05-23 11:06:36','2016-05-23 11:06:36','',0,50,'','','',1,NULL),(6,'aleksandra.bartyzel@trueshopping.co.uk','Aleksandra','Bartyzel','$2y$10$eN4B1jTKsq.4XBZF9gg4QeaVOqEACoADmEsXCFmov37Ms4U94ShOK','aleksandra.bartyzel@trueshopping.co.uk','2016-05-23 11:06:36','2016-05-23 11:06:36','',0,131,'','','',9,NULL),(7,'alex.harrison@trueshopping.co.uk','Alex','Harrison','$2y$10$uJoABPdUtSo3KCJawafIFunAtOsISaeIlPP47rKNTk8kCSGhiBLpy','alex.harrison@trueshopping.co.uk','2016-05-23 11:06:36','2016-05-23 11:06:36','',0,150,'','','',13,NULL),(8,'ali.whitehead@trueshopping.co.uk','Ali','Whitehead','$2y$10$TMtOV/imrdo8aqgeUfYZJ.JQzT0Brqxa4/12y22lYkL3DYibYaOv6','ali.whitehead@trueshopping.co.uk','2016-05-23 11:06:36','2016-05-23 11:06:36','',0,152,'','','',2,NULL),(9,'alison.holden@trueshopping.co.uk','Alison','Holden','$2y$10$11j2.VGOYNtCte5oksBiUeIFN7OGv7AuxtYEvRI3T3jGVVtN4qOfG','alison.holden@trueshopping.co.uk','2016-05-23 11:06:36','2016-05-23 11:06:36','',0,121,'','','',10,NULL),(10,'allister.stringer@trueshopping.co.uk','Allister','Stringer','$2y$10$QoFZ4XMoiq8DgO6jAqP9y.oA11HiGgUgvVEeCSkMooWZocJQM5sOG','allister.stringer@trueshopping.co.uk','2016-05-23 11:06:36','2016-05-23 11:06:36','',0,23,'','','',12,NULL),(11,'allyson.shanks@trueshopping.co.uk','Allyson','Shanks','$2y$10$On6wPJNeBqZp6wRze2lOYe8hfzcKczNpi6vwSJGCujeUIF8WGzDUO','allyson.shanks@trueshopping.co.uk','2016-05-23 11:06:37','2016-05-23 11:06:37','',0,22,'','','',8,NULL),(12,'andrea@trueshopping.co.uk','Andrea','Horsham','$2y$10$eoK6/m9UasEvn7XMYoiDRO5iL5xYdlTO7Mapux8aJ3JyBepoS.CIu','andrea@trueshopping.co.uk','2016-05-23 11:06:37','2016-05-23 11:06:37','',0,131,'','','',9,NULL),(13,'andrew.collinge@trueshopping.co.uk','Andrew','Collinge','$2y$10$sau.rL7N5tnoWy7wPPckY.MarV.bhIsmV/q7QwTzcJEuM/8VL.AXm','andrew.collinge@trueshopping.co.uk','2016-05-23 11:06:37','2016-05-23 11:06:37','',0,156,'','','',7,NULL),(14,'andrew.craddock@trueshopping.co.uk','Andrew','Craddock','$2y$10$.HwzKj7Dpm8L4oJ7t6fSu.ciJEPNDVTSARLxYrWn4utcZd5RnurkC','andrew.craddock@trueshopping.co.uk','2016-05-23 11:06:37','2016-05-23 11:06:37','',0,23,'','','',12,NULL),(15,'andrew.duffy@trueshopping.co.uk','Andrew','Duffy','$2y$10$5GHFTnj4EkS7vXRHJ.xI0OI7XQ3CFgun8.1SyF.73al5L8Pjs1aQ2','andrew.duffy@trueshopping.co.uk','2016-05-23 11:06:37','2016-05-23 11:06:37','',0,36,'','','',8,NULL),(16,'andrew.lockett@trueshopping.co.uk','Andrew','Lockett','$2y$10$nEvsN3kgTTDWE3bwQiNqIu.cojgYQOdEpWkppOzH2ToS7SJZJsrTO','andrew.lockett@trueshopping.co.uk','2016-05-23 11:06:37','2016-05-23 11:06:37','',0,59,'','','',4,NULL),(17,'andrew.ramsbottom@trueshopping.co.uk','Andrew','Ramsbottom','$2y$10$x8qy3z0rAJws5cOOjZgd.utSrCDopR52nfuKDADG/GLq0R67lrsky','andrew.ramsbottom@trueshopping.co.uk','2016-05-23 11:06:37','2016-05-23 11:06:37','',0,39,'','','',1,NULL),(18,'andrew.thomas@trueshopping.co.uk','Andrew','Thomas','$2y$10$es36Wap0Y0Qf3XFTmkgyBeCqKJ51WgW65Nx9g30hWyshU4996GBNG','andrew.thomas@trueshopping.co.uk','2016-05-23 11:06:37','2016-05-23 11:06:37','',0,140,'','','',5,NULL),(19,'andy.carr@trueshopping.co.uk','Andy','Carr','$2y$10$q41fWzCakyczAMCjrMfTPur3Jb3prUbvtqoeQGMLKN/EstgqVStNO','andy.carr@trueshopping.co.uk','2016-05-23 11:06:37','2016-05-23 11:06:37','',0,150,'','','',12,NULL),(20,'andy.christie@trueshopping.co.uk','Andy','Christie','$2y$10$qVLelH9y6v0WF.YCQTYZsOP6d8913mpyhSw8MvzSCFW8qKBLSnuY2','andy.christie@trueshopping.co.uk','2016-05-23 11:06:37','2016-05-23 11:06:37','',0,23,'','','',12,NULL),(21,'andy.hunt@trueshopping.co.uk','Andy','Hunt','$2y$10$0/St1LuCWqo0XcUHLXbwCuXgYpbttGy7IdDmlRB2zcJyL5.Ezc0O2','andy.hunt@trueshopping.co.uk','2016-05-23 11:06:37','2016-05-23 11:06:37','',0,7,'','','',13,NULL),(22,'enette.wraight@trueshopping.co.uk','Enette','Wraight','$2y$10$k6k7nsvfOmZpGQA37M2q6uBg/a0Aud3Z0Kz2ZJxGoS5L5ZoQ49exW','enette.wraight@trueshopping.co.uk','2016-05-23 11:06:38','2016-05-23 11:06:38','',0,36,'','','',8,NULL),(23,'antony.swainston@trueshopping.co.uk','Antony','Swainston','$2y$10$Y7h3dVADXjKigFfsaR0ukO9x4mb0ib0YId2HYp8JmKMi6Ij7GAZT6','antony.swainston@trueshopping.co.uk','2016-05-23 11:06:38','2016-05-23 11:06:38','',0,19,'','','',12,NULL),(24,'bev.mitchell@trueshopping.co.uk','Bev','Mitchell','$2y$10$.vNWvK0vwk54TP8mIC8z/uIcdTPCYdZ88kzbT509Pb6DMTf0j90C6','bev.mitchell@trueshopping.co.uk','2016-05-23 11:06:38','2016-05-23 11:06:38','',0,1,'','','',1,NULL),(25,'bilal.kouki@trueshopping.co.uk','Bilal','Kouki ','$2y$10$ihvnE52E0p0Psod2EDXThOth06n2m.R25u4A6IrP/5/n/EukH8V8G','bilal.kouki@trueshopping.co.uk','2016-05-23 11:06:38','2016-05-23 11:06:38','',0,101,'','','',5,NULL),(26,'callum.krzysik@trueshopping.co.uk','Callum','Krzysik','$2y$10$VhokvqYTwMJeqFSNssMkx.V.H7O2R5M2ZusFvcLpw698ATOXLMU6u','callum.krzysik@trueshopping.co.uk','2016-05-23 11:06:38','2016-05-23 11:06:38','',0,38,'','','',6,NULL),(27,'carmen.fernandez-romero@trueshopping.co.uk','Carmen','Fernandez - Romero','$2y$10$FznVF5u1QltBJ1g3PZNOwOwus99U8/db.O0aWJInHiYr/CaH1/gG2','carmen.fernandez-romero@trueshopping.co.uk','2016-05-23 11:06:38','2016-05-23 11:06:38','',0,15,'','','',8,NULL),(28,'carole.mcginty@trueshopping.co.uk','Carole','McGinty','$2y$10$AOj.oObTzGsh/UEcauBCo.AtndzOfpckwhk8u5z6F0s7ovY26pK2u','carole.mcginty@trueshopping.co.uk','2016-05-23 11:06:38','2016-05-23 11:06:38','',0,22,'','','',8,NULL),(29,'charles.bannister@trueshopping.co.uk','Charles','Bannister','$2y$10$w79X1BoMd0GoO90rIUkGu.OqLLVU5P9CrTsAQjjkNxwun2vNLy2y.','charles.bannister@trueshopping.co.uk','2016-05-23 11:06:38','2016-05-23 11:06:38','',0,156,'','','',7,NULL),(30,'chloe.pye@trueshopping.co.uk','Chloe','Pye','$2y$10$lE7eLZYA.8U/9HN7pMeQTOOTC83b.H5dC.s3Zm0EuL3WYR/rFk9eW','chloe.pye@trueshopping.co.uk','2016-05-23 11:06:38','2016-05-23 11:06:38','',0,38,'','','',6,NULL),(31,'chris.hiam@trueshopping.co.uk','Chris','Hiam','$2y$10$oP8hdFB8MPa5YDoOFJ4sd.1K5fKJJxD8cLuS4s2Kn8oAJa3GkqXKO','chris.hiam@trueshopping.co.uk','2016-05-23 11:06:38','2016-05-23 11:06:38','',0,140,'','','',5,NULL),(32,'chris.lawton@trueshopping.co.uk','Chris','Lawton','$2y$10$aXK2Sci6EiqwCbdEaOe5K.U3jE8mB/b5/5lDfdGYDTvR0SKpmuuDO','chris.lawton@trueshopping.co.uk','2016-05-23 11:06:38','2016-05-23 11:06:38','',0,156,'','','',2,NULL),(33,'chris.taylor@trueshopping.co.uk','Chris','Taylor','$2y$10$GSSvztjFIj.aesgeVrwmXOx5bNnQbPAgUoIfCFGLVxoGUypMiZ6AW','chris.taylor@trueshopping.co.uk','2016-05-23 11:06:38','2016-05-23 11:06:38','',0,23,'','','',12,NULL),(34,'christine.frey@trueshopping.co.uk','Chritine','Frey','$2y$10$52QBROVwjHZowZ19poNzpuE31jXoIctUwNAeKSPUc62nrxjjUweWy','christine.frey@trueshopping.co.uk','2016-05-23 11:06:39','2016-05-23 11:06:39','',0,8,'','','',2,NULL),(35,'claire.ruth@trueshopping.co.uk','Claire','Ruth','$2y$10$HOYbbTejBLtcPVexy98zyeas9DSrRSC3qxuFL6gLd8my/vzGDrX5W','claire.ruth@trueshopping.co.uk','2016-05-23 11:06:39','2016-05-23 11:06:39','',0,62,'','','',4,NULL),(36,'clare.poole@trueshopping.co.uk','Clare','Poole','$2y$10$L6SgZin2PYrVPXC4eYICeereL.v2WtOimglixXVpBvOF0mDE2tHJq','clare.poole@trueshopping.co.uk','2016-05-23 11:06:39','2016-05-23 11:06:39','',0,150,'','','',8,NULL),(37,'colette.adams@trueshopping.co.uk','Colette','Adams','$2y$10$.SQ/jGU41zh5YTLNEu6.6uI/.h7S7foBIqSI82OLr9j5E0tmaBZku','colette.adams@trueshopping.co.uk','2016-05-23 11:06:39','2016-05-23 11:06:39','',0,62,'','','',4,NULL),(38,'craig.fletcher@trueshopping.co.uk','Craig','Fletcher','$2y$10$YOiDLUxeD1MqVimVt3kQ/.22GsydwlyJ9eQAADwQbA/UcylSiY33m','craig.fletcher@trueshopping.co.uk','2016-05-23 11:06:39','2016-05-23 11:06:39','',0,8,'','','',6,NULL),(39,'craig.stewartwight@trueshopping.co.uk','Craig','Wight','$2y$10$4gYP8dqFBQHR70d6/vL45.7BwC9Ja.0OEHywVLjoUQZ0CoQ.FvxK.','craig.stewartwight@trueshopping.co.uk','2016-05-23 11:06:39','2016-05-23 11:06:39','',0,50,'','','',1,NULL),(40,'dan.morgan@trueshopping.co.uk','Daniel','Morgan','$2y$10$hwWG.FRs.1t04Z0O8jmm9OzY/i3y25lwEJzJq2gKANMvNtkji8ZuK','dan.morgan@trueshopping.co.uk','2016-05-23 11:06:39','2016-05-23 11:06:39','',0,38,'','','',6,NULL),(41,'daniel.wondolowski@trueshopping.co.uk','Daniel','Wondolowski','$2y$10$czjGlAeuKGBOH.4ZrhVdLuNZTb6NMphkKLce41nqxCKt/ET0n.02i','daniel.wondolowski@trueshopping.co.uk','2016-05-23 11:06:39','2016-05-23 11:06:39','',0,59,'','','',4,NULL),(42,'darren.carruthers@trueshopping.co.uk','Darren','Carruthers','$2y$10$OwsUwtAWwU7movxi2MocvOGQnFtkk5G6Lla8i9VZyCydNTau2ITFi','darren.carruthers@trueshopping.co.uk','2016-05-23 11:06:39','2016-05-23 11:06:39','',0,104,'','','',4,NULL),(43,'darren.clegg@trueshopping.co.uk','Darren','Clegg','$2y$10$Xf.VOdOi9n8otT8OUotJ6eBgukK.3T7RbMU7R946q6ctdVMXD.p/e','darren.clegg@trueshopping.co.uk','2016-05-23 11:06:39','2016-05-23 11:06:39','',0,156,'','','',7,NULL),(44,'daryl.bielby@trueshopping.co.uk','Daryl','Bielby','$2y$10$9mQpsnP8Ci61VUbLao2YAuxwiuqJFgCfr91mAuIQH0kmodZIU7tFi','daryl.bielby@trueshopping.co.uk','2016-05-23 11:06:39','2016-05-23 11:06:39','',0,19,'','','',12,NULL),(45,'david.tabron@trueshopping.co.uk','David','Tabron','$2y$10$VGYv7chjrKKwjCJV1tfGFuKFZG56iTBHC.v9ucl3eKjBMbH8QjK2S','david.tabron@trueshopping.co.uk','2016-05-23 11:06:40','2016-05-23 11:06:40','',0,1,'','','',1,NULL),(46,'dean.sharpley@trueshopping.co.uk','Dean','Sharpley','$2y$10$2ZtflEHeUT/d9S89uj2Fy.cq6z3tBMvTtSE5xV5r.0SaSDs2EFBOq','dean.sharpley@trueshopping.co.uk','2016-05-23 11:06:40','2016-05-23 11:06:40','',0,19,'','','',12,NULL),(47,'elizabeth.frost@trueshopping.co.uk','Elizabeth','Frost','$2y$10$uRK5h0Bjay0EI9PM2EgwbOo6dRXrIaoDO2AgUHCDZjdI1l3PbuX5a','elizabeth.frost@trueshopping.co.uk','2016-05-23 11:06:40','2016-05-23 11:06:40','',0,38,'','','',6,NULL),(48,'elodie.perrier@trueshopping.co.uk','Elodie','Perrier','$2y$10$xfkks9rxd/J88b301Kmj3uKHL.I5a7YVUhP/VlukhEMj5quekfTmK','elodie.perrier@trueshopping.co.uk','2016-05-23 11:06:40','2016-05-23 11:06:40','',0,8,'','','',2,NULL),(49,'emma.meikleham@trueshopping.co.uk','Emma','Meikleham','$2y$10$0PBHd3vU4RwBFyYVyp562O/.cacfXdyfh3EotgnxRTozjR5LLPZsi','emma.meikleham@trueshopping.co.uk','2016-05-23 11:06:40','2016-05-23 11:06:40','',0,22,'','','',8,NULL),(50,'erik.knudsen@trueshopping.co.uk','Erik','Knudsen','$2y$10$Am/U6QbR7eX/64PcLTHrKewISXkRQ23Ug/nuNadJ31OqCHSjfNFvO','erik.knudsen@trueshopping.co.uk','2016-05-23 11:06:40','2016-05-23 11:06:40','',0,152,'','','',1,NULL),(51,'estelle.dimarcq@trueshopping.co.uk','Estelle','Dimarq','$2y$10$csKd09kXprcbfNd7kJPNBO0QwuK1RD8eza/sXxg9VDrVir7iQhkCm','estelle.dimarcq@trueshopping.co.uk','2016-05-23 11:06:40','2016-05-23 11:06:40','',0,62,'','','',4,NULL),(52,'femke.futter@trueshopping.co.uk','Femke','Futter','$2y$10$kZYsSjVHxjr2MeYpVZ5ttO4sQnLV77SGAISpk1Ft6ZMXrV7aciJUC','femke.futter@trueshopping.co.uk','2016-05-23 11:06:40','2016-05-23 11:06:40','',0,15,'','','',8,NULL),(53,'florian.maier@trueshopping.co.uk','Florian','Maier','$2y$10$AA3kIu8nm8qslenPtO9HzOxsBmM/aJLW3yFUmO/4k1PIVRRyeO.6S','florian.maier@trueshopping.co.uk','2016-05-23 11:06:40','2016-05-23 11:06:40','',0,101,'','','',5,NULL),(54,'francesca.riley@trueshopping.co.uk','Francesca','Riley','$2y$10$ASywycU5nJglx.YNp5BNzOnKiPPUs/f5FailsyhDkOjbIL6vzmfRy','francesca.riley@trueshopping.co.uk','2016-05-23 11:06:40','2016-05-23 11:06:40','',0,38,'','','',6,NULL),(55,'gary.tattersall@trueshopping.co.uk','Gary','Tattersall','$2y$10$rRd/IsTk7mcMy9q4w6NWyuAn7CmeEMKVl85yZnTx66Zt5meE0Llgm','gary.tattersall@trueshopping.co.uk','2016-05-23 11:06:40','2016-05-23 11:06:40','',0,150,'','','',13,NULL),(56,'gemma.lee@trueshopping.co.uk','Gemma','Lee','$2y$10$cPnXO6dk0pD0gK7aryd80uuwisZUd6nr/pk.MKIu7tG1a0t3hsq7C','gemma.lee@trueshopping.co.uk','2016-05-23 11:06:40','2016-05-23 11:06:40','',0,22,'','','',8,NULL),(57,'george.brown@trueshopping.co.uk','George','Brown','$2y$10$.sT5optiwwg0oCytLs3M6.n7btjrvOAXqYKt1vrQjJr6xkWGDkRCG','george.brown@trueshopping.co.uk','2016-05-23 11:06:41','2016-05-23 11:06:41','',0,156,'','','',7,NULL),(58,'heidi.martin@trueshopping.co.uk','Heidi','Martin','$2y$10$zOYqor6lemDxUEaAQSRghuQtX2ybvkuLqIm3pSJh8YyROwFkNzxH2','heidi.martin@trueshopping.co.uk','2016-05-23 11:06:41','2016-05-23 11:06:41','',0,101,'','','',5,NULL),(59,'ian.johnson@trueshopping.co.uk','Ian','Johnson','$2y$10$kx2tF78jDp2WDLXPL0ZWKeOErVcVxQ1/HctUVGt4XIO704cy8g73u','ian.johnson@trueshopping.co.uk','2016-05-23 11:06:41','2016-05-23 11:06:41','',0,151,'','','',4,NULL),(60,'ian.obrien@trueshopping.co.uk','Ian','O\'Brien','$2y$10$VS6Z9BZcKWxypdxxKkUVweKR4QT0ptIbc89IVkC2qTObTDeSHRNCO','ian.obrien@trueshopping.co.uk','2016-05-23 11:06:41','2016-05-23 11:06:41','',0,62,'','','',4,NULL),(61,'inga.burg@trueshopping.co.uk','Inga','Burg','$2y$10$gk9uFF93NA2SYGsCwegvHOkdFr05J6mVtrFnx2fXien0xO3sj5WQi','inga.burg@trueshopping.co.uk','2016-05-23 11:06:41','2016-05-23 11:06:41','',0,101,'','','',5,NULL),(62,'jack.hutchinson@trueshopping.co.uk','Jack','Hutchinson','$2y$10$YWdz/g1C0xoInhFjKS4ENOHk0a8XZR4NnUa3.oL.XF8jrSJFfH8cW','jack.hutchinson@trueshopping.co.uk','2016-05-23 11:06:41','2016-05-23 11:06:41','',0,151,'','','',4,NULL),(63,'jade.burnie@trueshopping.co.uk','Jade','Burnie','$2y$10$a2/eZ22i9HiiOgZHBrF93OMm1dDZzaORtXW7HqVGk43tAwVMEW2Lm','jade.burnie@trueshopping.co.uk','2016-05-23 11:06:41','2016-05-23 11:06:41','',0,7,'','','',13,NULL),(64,'jake.holt@trueshopping.co.uk','Jake','Holt','$2y$10$u4zCO2xdQpTA9qWOqAjhU.mngUETccLq1YRtEv.8NPzbdFgd/gmuu','jake.holt@trueshopping.co.uk','2016-05-23 11:06:41','2016-05-23 11:06:41','',0,36,'','','',8,NULL),(65,'jake@trueshopping.co.uk','Jake','Watson','$2y$10$jYOHSEZPjcL.a/S/mL1ntuC33U6Oi5y8SSGdhMmKk751ACqh3Lo2i','jake@trueshopping.co.uk','2016-05-23 11:06:41','2016-05-23 11:06:41','',0,36,'','','',1,NULL),(66,'james.burton@trueshopping.co.uk','James','Burton','$2y$10$5HsouSJbNWAhWQqPGR/iPeOwVJ40TlLVfFGOeJpWpQ0162Vcs4e1e','james.burton@trueshopping.co.uk','2016-05-23 11:06:41','2016-05-23 11:06:41','',0,8,'','','',2,NULL),(67,'james.firminger@trueshopping.co.uk','James','Firminger','$2y$10$Ak9Y00y5hDOgmDssLnxmTO7sYWAq0ONaZuINxLDftHBo6hgrP/QvG','james.firminger@trueshopping.co.uk','2016-05-23 11:06:41','2016-05-23 15:09:20','e0P9dwznZgj3szqusCfYsLntXPTurwm0pfrYhSgIEsF7jgwcP2qwfLoURNm3',1,5,'/images/avatars/581938_10153708191190867_3412693267857860004_n.jpg','Senior Developer','Firmy',1,''),(68,'james.oates@trueshopping.co.uk','James','Oates','$2y$10$miaT/.NqOt9dixbRykYIvu6IhbO.DbzSJU1264rL1U641OUmcknlu','james.oates@trueshopping.co.uk','2016-05-23 11:06:42','2016-05-23 11:06:42','',0,1,'','','',1,NULL),(69,'james.stansfield@trueshopping.co.uk','James','Stansfield','$2y$10$dcKtrQG6z.GX9p1yrL9WY.4HEOCuXjMdZvkMK1NUB7VHlL81Nfrv.','james.stansfield@trueshopping.co.uk','2016-05-23 11:06:42','2016-05-23 11:06:42','',0,19,'','','',12,NULL),(70,'james.todd@trueshopping.co.uk','James','Todd','$2y$10$BjXVKqd2U9.mE28Uum7vheKWikcwRREzsKgXheJNaQFf/QdzNRDv.','james.todd@trueshopping.co.uk','2016-05-23 11:06:42','2016-05-23 11:06:42','',0,38,'','','',6,NULL),(71,'jamie.chorley@trueshopping.co.uk','Jamie','Chorley','$2y$10$PHsODtUmaC9KAav.1FL6puHIkjgSos3mS7jiKoOWm6jK9gQyYT8Jm','jamie.chorley@trueshopping.co.uk','2016-05-23 11:06:42','2016-05-23 11:06:42','',0,101,'','','',5,NULL),(72,'jason.lockyer@trueshopping.co.uk','Jason','Lockyer','$2y$10$dNlrYkDA4OTzKpv6rOwLO.OrdZ0dGdHJDctC69.NIB7gA8PfS4B5y','jason.lockyer@trueshopping.co.uk','2016-05-23 11:06:42','2016-05-23 11:06:42','',0,23,'','','',12,NULL),(73,'jayne.sandersonbrown@summ.it','Jayne','Sanderson Brown','$2y$10$XaPxC6Ahw4duqFFdQLFBb.6I4aLcXeHYohuUPVLJgfvIwMGgKQeBi','jayne.sandersonbrown@summ.it','2016-05-23 11:06:42','2016-05-23 11:06:42','',0,73,'','','',11,NULL),(74,'jeff.whitfield@trueshopping.co.uk','Jeff','Whitfield','$2y$10$2Wlr3Btl570nXO2/ILNquuwDoducdDFkej11wbxvIsAHsZR2W/mPm','jeff.whitfield@trueshopping.co.uk','2016-05-23 11:06:42','2016-05-23 11:06:42','',0,8,'','','',2,NULL),(75,'john.lawless@trueshopping.co.uk','John','Lawless','$2y$10$CJiyIle91WLJvtnrnqA.IOHhyXSEsJJCRrKUR3s.ySRjVrE./9Sr.','john.lawless@trueshopping.co.uk','2016-05-23 11:06:42','2016-05-23 11:06:42','',0,140,'','','',5,NULL),(76,'jonathan.crossley@trueshopping.co.uk','Jonathan','Crossley','$2y$10$B3fLBRPfzMqS1gOrzidaDe18bcVLGi5P.JhzJn3B3CKAcxn2qynYa','jonathan.crossley@trueshopping.co.uk','2016-05-23 11:06:42','2016-05-23 11:06:42','',0,22,'','','',8,NULL),(77,'joseph.miles@trueshopping.co.uk','Joesph','Miles','$2y$10$tVqQ/7RKjr7bJJIiuFRps.S/.QRgC9glWIhQvLXr0gaqWQ/OOoOkG','joseph.miles@trueshopping.co.uk','2016-05-23 11:06:42','2016-05-23 11:06:42','',0,38,'','','',6,NULL),(78,'josh.farrar@trueshopping.co.uk','Josh','Farrar','$2y$10$.6dAKpfmkwh9WFasvvhWZ.5J4LpCnmaNGFdumIQw5u4146Nj2sb/S','josh.farrar@trueshopping.co.uk','2016-05-23 11:06:42','2016-05-23 11:06:42','',0,23,'','','',12,NULL),(79,'judith.stotan@trueshopping.co.uk','Judith','Stotan','$2y$10$dR0gMYzU5UGC18hBHA/jEuts92/3GBZVytgCe4NFV4RSB94hn8AN.','judith.stotan@trueshopping.co.uk','2016-05-23 11:06:42','2016-05-23 11:06:42','',0,15,'','','',8,NULL),(80,'julia.geyer@trueshopping.co.uk','Julia','Geyer','$2y$10$ybVnOY3kZWKBZA6Kizk39OT96IvzgBEJLqlI7DcZKdkIsI7GwpqnW','julia.geyer@trueshopping.co.uk','2016-05-23 11:06:43','2016-05-23 11:06:43','',0,101,'','','',5,NULL),(81,'julia.neubauer@trueshopping.co.uk','Julia','Neubauer','$2y$10$fIuaj65nSSX1SRxy/G17ouZG6qwhzTYdX7ifLJfEfDi.0SUdCoZcm','julia.neubauer@trueshopping.co.uk','2016-05-23 11:06:43','2016-05-23 11:06:43','',0,8,'','','',2,NULL),(82,'karolina.zielony@trueshopping.co.uk','Karolina','Zielony','$2y$10$cOdAsA3/d3maW68HLYRSYecXX87aD4rXWjEVIW55meGp/XM520LCO','karolina.zielony@trueshopping.co.uk','2016-05-23 11:06:43','2016-05-23 11:06:43','',0,8,'','','',2,NULL),(83,'kathryn.isherwood@trueshopping.co.uk','Kathryn','Isherwood','$2y$10$QJSAtiN2LvEARSKJWFAdI.S7QDoV5nWtu3DbvDxndsWgItxXd4DpK','kathryn.isherwood@trueshopping.co.uk','2016-05-23 11:06:43','2016-05-23 11:06:43','',0,64,'','','',8,NULL),(84,'katrin.mueller@trueshopping.co.uk','Katrin','Mueller','$2y$10$/40.zJbxgP1caaDKegerwO4kcm43wN9P1YU2X6FltSj/bX73wITGq','katrin.mueller@trueshopping.co.uk','2016-05-23 11:06:43','2016-05-23 11:06:43','',0,101,'','','',5,NULL),(85,'kevin.varley@trueshopping.co.uk','Kevin','Varley','$2y$10$r5FvaIPqhM1WgUcCY2Rx0u12JSxGcCq.Y.xScJG6IoL/xVIQ65NQe','kevin.varley@trueshopping.co.uk','2016-05-23 11:06:43','2016-05-23 11:06:43','',0,1,'','','',1,NULL),(86,'kim.isherwood@trueshopping.co.uk','Kim ','Isherwood','$2y$10$57pfaET09PRCqyBdwr9E2.1Glzgp8mBA.R6HqiL3kuof4JYZ7km3W','kim.isherwood@trueshopping.co.uk','2016-05-23 11:06:43','2016-05-23 11:06:43','',0,64,'','','',8,NULL),(87,'kristin.kirjakowa@trueshopping.co.uk','Kristin','Kirjakowa','$2y$10$ItSsmGh48OjAyKP9O1mCDuNTVJGVQPguHYKXgHkB5mIxmJI03JgXG','kristin.kirjakowa@trueshopping.co.uk','2016-05-23 11:06:43','2016-05-23 11:06:43','',0,38,'','','',8,NULL),(88,'kristina.calder@trueshopping.co.uk','Kristina','Calder','$2y$10$9LjtZxyvPr5HF9YC5m3Wd.69UpMPVrMg7qrmjFta0N1ivEHhLMYSS','kristina.calder@trueshopping.co.uk','2016-05-23 11:06:43','2016-05-23 11:06:43','',0,101,'','','',5,NULL),(89,'laura.lee@trueshopping.co.uk','Laura','Lee','$2y$10$GRz.PvJ8sHJTCd3Yb.Q9Je0t59l5TGF3WR4ArKe32alxHrrSz8DEC','laura.lee@trueshopping.co.uk','2016-05-23 11:06:43','2016-05-23 11:06:43','',0,131,'','','',9,NULL),(90,'lauren.snaith@trueshopping.co.uk','Lauren','Snaith','$2y$10$nJb3VWHL064zTMQiE0amVOBCcHe/zn71WwWy/BGdTb1sHozuQmqAy','lauren.snaith@trueshopping.co.uk','2016-05-23 11:06:43','2016-05-23 11:06:43','',0,59,'','','',4,NULL),(91,'lauren.wood@trueshopping.co.uk','Lauren','Wood','$2y$10$NTsNpCGKFzyDmch91z8xGegiqDShjOvQg0USLXIqDxUvfwyWUhkQ.','lauren.wood@trueshopping.co.uk','2016-05-23 11:06:43','2016-05-23 11:06:43','',0,22,'','','',8,NULL),(92,'liz.tabron@trueshopping.co.uk','Liz','Tabron','$2y$10$/mMSwxDOEUqsjjPnOGwOj.k/R4dYkMI6xq1Zj/KBympVoRkt.mvxO','liz.tabron@trueshopping.co.uk','2016-05-23 11:06:44','2016-05-23 11:06:44','',0,62,'','','',4,NULL),(93,'loren.kelley@trueshopping.co.uk','Loren','Kelley','$2y$10$OxVI4GlOwoAMgwlhGZlZLeuGiMzRAz43q3iQgd.5zB6qyG7LnfSeO','loren.kelley@trueshopping.co.uk','2016-05-23 11:06:44','2016-05-23 11:06:44','',0,131,'','','',9,NULL),(94,'lorenzo.piovesan@trueshopping.co.uk','Lorenzo','Piovesan','$2y$10$1VKgmuziu4/2UbHZFD6XtuudLPy5IxOefO5X7ldKxBHtFNBhQGIzS','lorenzo.piovesan@trueshopping.co.uk','2016-05-23 11:06:44','2016-05-23 11:06:44','',0,15,'','','',8,NULL),(95,'louise.wareing@trueshopping.co.uk','Louise','Wareing','$2y$10$rJC23vLiZMcuFKFjAjxvJu6.KbJvF6h8T8.9s84D6h22lOOWtY87i','louise.wareing@trueshopping.co.uk','2016-05-23 11:06:44','2016-05-23 11:06:44','',0,7,'','','',13,NULL),(96,'lucas.jannes@trueshopping.co.uk','Lucas','Jannes','$2y$10$C/PeZOGGRj7cYzTWd1SWCu4qetZUVeMhUygC/alX/aqZL8AOvDOau','lucas.jannes@trueshopping.co.uk','2016-05-23 11:06:44','2016-05-23 11:06:44','',0,15,'','','',8,NULL),(97,'lucy.cavill@summ.it','Lucy','Cavill','$2y$10$O2FMfQkOXGO5NCVrvOHq0urm3zN8/kfEF5pZeGpBwfVxBjBHTmJLm','lucy.cavill@summ.it','2016-05-23 11:06:44','2016-05-23 11:06:44','',0,97,'','','',11,NULL),(98,'luke.hirons@trueshopping.co.uk','Luke','Hirons','$2y$10$52WPOMzUPyRdJdQYtToAbOz9wUEM6BTuT5gmUFQXs2LomPsvnpZzq','luke.hirons@trueshopping.co.uk','2016-05-23 11:06:44','2016-05-23 11:06:44','',0,154,'','','',10,NULL),(99,'luke.purcell@trueshopping.co.uk','Luke','Purcell','$2y$10$A9iRfsBEebo14zG8LFNEC.pc/xlCH8s2ZkMKefbD95D49JGKcRgLq','luke.purcell@trueshopping.co.uk','2016-05-23 11:06:44','2016-05-23 11:06:44','',0,38,'','','',6,NULL),(100,'manon.payton@hudsonreed.com','Manon','Payton','$2y$10$t3czk5jBVrmWqdHiE8/Dc.rUjBMepxWNWkcjECvo7efcE7TqeZIAu','manon.payton@hudsonreed.com','2016-05-23 11:06:44','2016-05-23 11:06:44','',0,62,'','','',4,NULL),(101,'marek.kokocki@trueshopping.co.uk','Marek ','Kokocki','$2y$10$pqzCupHWjDQEhYY6PWtu2.5on1nXYypSUGx6f/dcwJIJVp7wSoBuG','marek.kokocki@trueshopping.co.uk','2016-05-23 11:06:44','2016-05-23 11:06:44','',0,152,'','','',5,NULL),(102,'mark.duxbury@trueshopping.co.uk','Mark','Duxbury','$2y$10$ipnhn/EDu1pZ906S7v8bHuuwm3dik/29/5S55BkOarIGnnKaBqBcm','mark.duxbury@trueshopping.co.uk','2016-05-23 11:06:44','2016-05-23 11:06:44','',0,156,'','','',7,NULL),(103,'mark.skelton@trueshopping.co.uk','Mark','Skelton','$2y$10$M5qwr/wxKfp/lDhv4DIvfOYojHxjvLbHlE6vG5FbQQoS8.LGajvJi','mark.skelton@trueshopping.co.uk','2016-05-23 11:06:44','2016-05-23 11:06:44','',0,1,'','','',1,NULL),(104,'mark.wignall@trueshopping.co.uk','Mark','Wignall','$2y$10$/4xw0uZpcQ6ObympB.6fAezeK0eqvDQdo4akFc1wj0JNShUnXflgu','mark.wignall@trueshopping.co.uk','2016-05-23 11:06:45','2016-05-23 11:06:45','',0,150,'','','',14,NULL),(105,'martin.horrigan@trueshopping.co.uk','Martin','Horrigan','$2y$10$s5qE8vnmn4VwuX3J17PJ7eg5X1ts.cojh0OgzpAWsYQWNVP9Pd1qm','martin.horrigan@trueshopping.co.uk','2016-05-23 11:06:45','2016-05-23 11:06:45','',0,150,'','','',8,NULL),(106,'matthew.clark@trueshopping.co.uk','Matthew','Clark','$2y$10$/5wfkcIAHQpGaYeUbNQ4WeYqrHEAyRlbkZdn1gElC8yPk3iF93yNK','matthew.clark@trueshopping.co.uk','2016-05-23 11:06:45','2016-05-23 11:06:45','',0,104,'','','',14,NULL),(107,'melanie.lewis@trueshopping.co.uk','Melanie','Lewis','$2y$10$DvBTrMd5o8hIMfCYgwbZuOOI62ONrFgE2umOiwq1s3ddeM5iLyC5i','melanie.lewis@trueshopping.co.uk','2016-05-23 11:06:45','2016-05-23 11:06:45','',0,38,'','','',6,NULL),(108,'michelle.jackson@trueshopping.co.uk','Michelle','Jackson','$2y$10$fhhhS9ZGSeYv9iaKLQg3AejXfu4nXxV2/PRUeFgobjW/uMqS3/7SG','michelle.jackson@trueshopping.co.uk','2016-05-23 11:06:45','2016-05-23 11:06:45','',0,22,'','','',8,NULL),(109,'mike.bowley@trueshopping.co.uk','Mike','Bowley','$2y$10$mf9I6sXZtiCUdzyhAKLiSu3vyQaJYEIJQsLkugqZgimCxCVYUJOEe','mike.bowley@trueshopping.co.uk','2016-05-23 11:06:45','2016-05-23 11:06:45','',0,23,'','','',12,NULL),(110,'mike.jackson@trueshopping.co.uk','Mike','Jackson','$2y$10$VShtfI5gEv/IDX2VYmf0xObzdXNkVXXyvQSKBL5dbbPf8R6aXkLYG','mike.jackson@trueshopping.co.uk','2016-05-23 11:06:45','2016-05-23 11:06:45','',0,8,'','','',2,NULL),(111,'mirnesa.kadric-mustajbasic@trueshopping.co.uk','Mirnesa','Kadric - Mustajbasic','$2y$10$Grstqr0l2qF14pj4akif1uAUxL7QFCr2DKil/qAAb0owkjESjKJiu','mirnesa.kadric-mustajbasic@trueshopping.co.uk','2016-05-23 11:06:45','2016-05-23 11:06:45','',0,15,'','','',8,NULL),(112,'nadia.alibegum@trueshopping.co.uk','Nadia','Ali Begum','$2y$10$0QCsJbZBeSafWN/IyeCTmumEb4Dj.qiCOoAB/rHIhvSHHKOs.jYHC','nadia.alibegum@trueshopping.co.uk','2016-05-23 11:06:45','2016-05-23 11:06:45','',0,64,'','','',8,NULL),(113,'natalie.siquilini@trueshopping.co.uk','Natalie','Siquilini','$2y$10$zGdbUYnneYcXPiA03ghyU.L0MdtdSqkDTDju7r/vfFonmtEqzuwrm','natalie.siquilini@trueshopping.co.uk','2016-05-23 11:06:45','2016-05-23 11:06:45','',0,15,'','','',8,NULL),(114,'natalie.booth@trueshopping.co.uk','Natalie','Booth','$2y$10$/mUBZRea8Z4TQ7nfqHhHl.SOxdcgn3fK.x7X4ku0Ab7n3HDN.nP66','natalie.booth@trueshopping.co.uk','2016-05-23 11:06:45','2016-05-23 11:06:45','',0,19,'','','',12,NULL),(115,'nathalie.lecomte@trueshopping.co.uk','Nathalie','Lecomte','$2y$10$3H66RFFWudLlZ6T8vwW/8uP8kf0QJCw5.W1n5yqJGKLHhDXU5KPLy','nathalie.lecomte@trueshopping.co.uk','2016-05-23 11:06:45','2016-05-23 11:06:45','',0,62,'','','',4,NULL),(116,'naveed.raza@trueshopping.co.uk','Naveed','Raza','$2y$10$XaY0TfkKWJZH7zmNOwFr1.mEPOdJt7FVGVhSPh/ffJgUjHM5tB66W','naveed.raza@trueshopping.co.uk','2016-05-23 11:06:46','2016-05-23 11:06:46','',0,62,'','','',4,NULL),(117,'nick.hosker@trueshopping.co.uk','Nick','Hosker','$2y$10$23J44chpKUMUf1jJ9C9fpOuNZXONE4qohf3oFJCn8qzRdoNEykdae','nick.hosker@trueshopping.co.uk','2016-05-23 11:06:46','2016-05-23 11:06:46','',0,121,'','','',10,NULL),(118,'nicola.harper@trueshopping.co.uk','Nicola','Harper','$2y$10$SeE89FYiW8vWuZ708g24uuodhvq7ozN8xSkK5FsuQ/ZM8xEl2JrTW','nicola.harper@trueshopping.co.uk','2016-05-23 11:06:46','2016-05-23 11:06:46','',0,38,'','','',6,NULL),(119,'olivia.mccormick@trueshopping.co.uk','Olivia','McCormick','$2y$10$0Rh2Yrbi8yO2NRNHc5afTuJRDvMsZiYCRjsc7OAIQONuACxWbYzUK','olivia.mccormick@trueshopping.co.uk','2016-05-23 11:06:46','2016-05-23 11:06:46','',0,7,'','','',13,NULL),(120,'paola.moscoso@trueshopping.co.uk','Paola','Moscoso','$2y$10$kA1YL.qDR3ZGUBFiRK85t.2aMfSLaX2oiHNleQC70WfXu7/YKMp9C','paola.moscoso@trueshopping.co.uk','2016-05-23 11:06:46','2016-05-23 11:06:46','',0,101,'','','',5,NULL),(121,'peter.lilley@trueshopping.co.uk','Peter','Lilley','$2y$10$fnd5bswkIYViVTWEM7NF8O.4doLzMMM4Ssq/hk7F7FxTK8cryxIoO','peter.lilley@trueshopping.co.uk','2016-05-23 11:06:46','2016-05-23 11:06:46','',0,121,'','','',10,NULL),(122,'peter.marsden@trueshopping.co.uk','Peter','Marsden','$2y$10$pWn1qZUkgqLwPqIm724i6uVBHG5OWHYpeAmD8ASy/cE7BgG9uAStC','peter.marsden@trueshopping.co.uk','2016-05-23 11:06:46','2016-05-23 11:06:46','',0,19,'','','',12,NULL),(123,'phil.o\'sullivan@trueshopping.co.uk','Phil','O\'Sullivan','$2y$10$RWT7c.cd239jaQCapo25XOzhOmI.f8PjMJaBdrHCuGw18lRxSnhM2','phil.o\'sullivan@trueshopping.co.uk','2016-05-23 11:06:46','2016-05-23 11:06:46','',0,104,'','','',14,NULL),(124,'phil.holliday@trueshopping.co.uk','Phil','Holliday','$2y$10$DpgU6/hMkvl1JlbxsbivKubPy3WcyPnmjnImPqeRLDg4UZY6D9WGq','phil.holliday@trueshopping.co.uk','2016-05-23 11:06:46','2016-05-23 11:06:46','',0,101,'','','',5,NULL),(125,'qasim.hussain@trueshopping.co.uk','Qasim','Hussain','$2y$10$bF3kmvtGabW28snFyODkk.Lrx6uLK/qOXX21MjI09HLzdtRUM8TIK','qasim.hussain@trueshopping.co.uk','2016-05-23 11:06:46','2016-05-23 11:06:46','',0,38,'','','',6,NULL),(126,'rachel.hughes@trueshopping.co.uk','Rachel','Hughes','$2y$10$vu8JTHLS5V9wKjtRl04C8OGxjwaELHgzxDQhChCYEsDlTdvctzBeq','rachel.hughes@trueshopping.co.uk','2016-05-23 11:06:46','2016-05-23 11:06:46','',0,50,'','','',1,NULL),(127,'rachel.sharp@trueshopping.co.uk','Rachel','Sharp','$2y$10$2GFU4CG/3vacgGILIiMK9e5RVnJEChMP8JI0Ng7cpVll3x6kuo2.O','rachel.sharp@trueshopping.co.uk','2016-05-23 11:06:46','2016-05-23 11:06:46','',0,131,'','','',9,NULL),(128,'raza.ali@trueshopping.co.uk','Raza','Ali','$2y$10$lgeGVl0SO6n/.QCQZdgW7uVsvRgt64TU0/LlO74UkQgBSIEt8PTDu','raza.ali@trueshopping.co.uk','2016-05-23 11:06:47','2016-05-23 11:06:47','',0,62,'','','',4,NULL),(129,'becky.henderson@trueshopping.co.uk','Becky ','Henderson','$2y$10$iblbXfZ1JXBJKhpXsko5FOzvqis/siDVJj7OyJZWb/c826UByzvT2','becky.henderson@trueshopping.co.uk','2016-05-23 11:06:47','2016-05-23 11:06:47','',0,55,'','','',13,NULL),(130,'richard.ianson@trueshopping.co.uk','Richard','I\'Anson','$2y$10$ydAR0xEaRbeAh0951hobEe.Rr8v6IZJiQbqiVSBGgFLdqCwppPY2.','richard.ianson@trueshopping.co.uk','2016-05-23 11:06:47','2016-05-23 11:06:47','',0,104,'','','',14,NULL),(131,'richard.kellett@trueshopping.co.uk','Richard','Kellett','$2y$10$B4bIov.qG/Ohv5Lqp6yEG.FvYI1GCkQfIKUoNLaq4R0C6v0J4U.H6','richard.kellett@trueshopping.co.uk','2016-05-23 11:06:47','2016-05-23 11:06:47','',0,117,'','','',9,NULL),(132,'rob.ashworth@trueshopping.co.uk','Rob','Ashworth','$2y$10$el3zHI9QUZVnICTEJenCjObKINuE8nsfXgVpI4pudWeHBDogg0wSm','rob.ashworth@trueshopping.co.uk','2016-05-23 11:06:47','2016-05-23 11:06:47','',0,8,'','','',2,NULL),(133,'rory.holliday@trueshopping.co.uk','Rory','Holliday','$2y$10$6PcxW57ULPNmc8up6T1reOUpIPDbyCTt16h8XoPuY7vgULvUY6JKS','rory.holliday@trueshopping.co.uk','2016-05-23 11:06:47','2016-05-23 11:06:47','',0,64,'','','',8,NULL),(134,'salvador.rodriguez@trueshopping.co.uk','Salvador','Rodriquez','$2y$10$VXaZEwdshWaEtcl0KRdX6eSxdtkF2RXtJzBk.kCUGNOBPd14UwZ7O','salvador.rodriguez@trueshopping.co.uk','2016-05-23 11:06:47','2016-05-23 11:06:47','',0,104,'','','',14,NULL),(135,'sanodiya.khan@trueshopping.co.uk','Sanodiya','Khan','$2y$10$qFDHEX9OwAWDQcLNMhG.wO9EIgDFlgklWQvfeVqEP07G05LhuoYiq','sanodiya.khan@trueshopping.co.uk','2016-05-23 11:06:47','2016-05-23 11:06:47','',0,38,'','','',6,NULL),(136,'sara.nazurally@trueshopping.co.uk','Sara','Nazurally','$2y$10$ARUZ3yU6c39SN1bKFHp6u.uvnX7MXRhCL5U3196KJSYEYjGZFeBju','sara.nazurally@trueshopping.co.uk','2016-05-23 11:06:47','2016-05-23 11:06:47','',0,22,'','','',8,NULL),(137,'sean.watson@trueshopping.co.uk','Sean','Watson','$2y$10$z2tjtIfxoXmbZ2WRVVpCjOakxoMvRs65meCmS4Rc77h92yyaZ/o1.','sean.watson@trueshopping.co.uk','2016-05-23 11:06:47','2016-05-23 11:06:47','',0,5,'','','',1,NULL),(138,'seb.parkinson@trueshopping.co.uk','Seb','Parkinson','$2y$10$gnzeSI/WVgiDy4wSeFkqa.jWS4dYzu/hgm8PAsP269.NVVysnSe5m','seb.parkinson@trueshopping.co.uk','2016-05-23 11:06:47','2016-05-23 11:06:47','',0,156,'','','',2,NULL),(139,'shaun.craig@trueshopping.co.uk','Shaun','Craig','$2y$10$yeoM.VgDzrZL0RExO2WbJutdCjoBWLRwvde3LlhPz33wbLxpXviJ2','shaun.craig@trueshopping.co.uk','2016-05-23 11:06:47','2016-05-23 11:06:47','',0,104,'','','',14,NULL),(140,'shaun.mengella@trueshopping.co.uk','Shaun','Mengella','$2y$10$0oYdhI6FK1M6jUsqZIsLbeUzx0jZcUsjOVM4X3N7Yn/LzsZLcBig.','shaun.mengella@trueshopping.co.uk','2016-05-23 11:06:48','2016-05-23 11:06:48','',0,101,'','','',5,NULL),(141,'simon.osbaldeston@trueshopping.co.uk','Simon','Osbaleston','$2y$10$Dl2rbzcZ4Td0PVsHeGBAP.ZODRSvsYjs5e55TS1DJ49lRofak71oa','simon.osbaldeston@trueshopping.co.uk','2016-05-23 11:06:48','2016-05-23 11:06:48','',0,74,'','','',2,NULL),(142,'sjacques@trueshopping.co.uk','Stephen','Jacques','$2y$10$Fgvx3CNf7DUqTQ4oHjfs8.880PJfl3Gqa61PYliSShO4zoKlcO9SC','sjacques@trueshopping.co.uk','2016-05-23 11:06:48','2016-05-23 11:06:48','',0,151,'','','',4,NULL),(143,'sofia.alibegum@trueshopping.co.uk','Sofia','Ali Begum','$2y$10$MQiFqmBHSHQM2p8hoRvzTOgr5Tgvlk4fHw3RKb/UfCtUQQ5WKxeFi','sofia.alibegum@trueshopping.co.uk','2016-05-23 11:06:48','2016-05-23 11:06:48','',0,64,'','','',8,NULL),(144,'sonia.williams@trueshopping.co.uk','Sonia','Williams','$2y$10$D4Rv550Vm2MbOyA8WVrnz.6EkIKVIJF6zd0rnLApRwyldxj81as4i','sonia.williams@trueshopping.co.uk','2016-05-23 11:06:48','2016-05-23 11:06:48','',0,50,'','','',1,NULL),(145,'steve.cunliffe@trueshopping.co.uk','Steve','Cunliffe','$2y$10$nRDymsrcu/XuUpxnXsR7eu8MbEw04EAYttxrEAStNnzNpjQF0suCG','steve.cunliffe@trueshopping.co.uk','2016-05-23 11:06:48','2016-05-23 11:06:48','',0,145,'','','',10,NULL),(146,'stu@trueshopping.co.uk','Stuart','Batterham','$2y$10$l1UfU/4XJkheAy6uAL/TXO0QMhza448xvZkTbutwHVvi/HCNjrPby','stu@trueshopping.co.uk','2016-05-23 11:06:48','2016-05-23 11:06:48','',0,74,'','','',2,NULL),(147,'stuart.mills@trueshopping.co.uk','Stuart','Mills','$2y$10$lnNrz5b9hRnfivfADu9fv.ZVzrHh4WpJBI4REL3SMTzq/CGnYt40a','stuart.mills@trueshopping.co.uk','2016-05-23 11:06:48','2016-05-23 11:06:48','',0,152,'','','',7,NULL),(148,'suheb-ul.alam@trueshopping.co.uk','Suheb','Ul Alam','$2y$10$tm9a31nt8k4BcEM32f618u2juZch4E0lVLaTwZitQ1YxDWneL3TDC','suheb-ul.alam@trueshopping.co.uk','2016-05-23 11:06:49','2016-05-23 11:06:49','',0,22,'','','',8,NULL),(149,'susan.bailey@trueshopping.co.uk','Susan','Bailey','$2y$10$4zUFsTbVN33D9gc26viO5u4D.aqxhLcSuYjAQZAPe5Sc4qgIuhwhy','susan.bailey@trueshopping.co.uk','2016-05-23 11:06:49','2016-05-23 11:06:49','',0,19,'','','',12,NULL),(150,'tim.wright@trueshopping.co.uk','Tim','Wright','$2y$10$4AuXBcSwbLIAQ/Vw3JaQmuHhjkqh5SD/kEvrREgSxVwcHaXNkfNBa','tim.wright@trueshopping.co.uk','2016-05-23 11:06:49','2016-05-23 11:06:49','',0,117,'','','',12,NULL),(151,'tom.fothergill@trueshopping.co.uk','Tom','Fothergill','$2y$10$dnN6TL7SYiXTRu8atItNqeqsV.SDST7ku6exXWONdoG2wXxLU9d0q','tom.fothergill@trueshopping.co.uk','2016-05-23 11:06:49','2016-05-23 11:06:49','',0,152,'','','',4,NULL),(152,'tom.jones@trueshopping.co.uk','Tom','Jones','$2y$10$wd7g7FQwVzarK1jbR0QYkutoSRFfdSoT.5ELFJEBp3NdQIY3wy5Wi','tom.jones@trueshopping.co.uk','2016-05-23 11:06:49','2016-05-23 11:06:49','',0,121,'','','',10,NULL),(153,'tom.reilly@trueshopping.co.uk','Tom','Reilly','$2y$10$4npW3LbDWVXQPx3Jz359peAVwBAqKGqgO/T8XX59lAZCIltstOlP.','tom.reilly@trueshopping.co.uk','2016-05-23 11:06:49','2016-05-23 11:06:49','',0,23,'','','',12,NULL),(154,'tommy.gaboreau@trueshopping.co.uk','Tommy','Gaboreau','$2y$10$rdVcymahArsxb5vgeiW6W.AKXSCfCF5JXyFsfhtHq.KCdOnkYpply','tommy.gaboreau@trueshopping.co.uk','2016-05-23 11:06:49','2016-05-23 11:06:49','',0,117,'','','',10,NULL),(155,'toni.procter@trueshopping.co.uk','Toni','Procter','$2y$10$BNWPhwkxZNVRJwM7EbICNub.6SlaEKUjTE5BPQPIN5KdRJKpMT09W','toni.procter@trueshopping.co.uk','2016-05-23 11:06:49','2016-05-23 11:06:49','',0,1,'','','',1,NULL),(156,'tony.speight@trueshopping.co.uk','Tony','Speight','$2y$10$c9cNkFU9I5831yLP7CnqWeIXvDS62cll/pzVh8xvKC5EHM7KNj82i','tony.speight@trueshopping.co.uk','2016-05-23 11:06:49','2016-05-23 11:06:49','',0,8,'','','',2,NULL),(157,'tracey.greenwood@trueshopping.co.uk','Tracey','Greenwood','$2y$10$ebctdnegFbjCSyJPBgt3QuvKVC9AKQ1FcERMqTOdbXPQJROHx9eP2','tracey.greenwood@trueshopping.co.uk','2016-05-23 11:06:49','2016-05-23 11:06:49','',0,104,'','','',14,NULL),(158,'vigny.efoloko@trueshopping.co.uk','Vigny','Efoloko','$2y$10$lvL3FzOdnOf8xJYQsDcrS.S94s4nO6Q9fi9Xal.5QM05nyoEBvVF.','vigny.efoloko@trueshopping.co.uk','2016-05-23 11:06:49','2016-05-23 11:06:49','',0,15,'','','',8,NULL),(159,'wendy.sutcliffe@trueshopping.co.uk','Wendy','Sutcliffe','$2y$10$XIYD7crdvwPZ3IWY3DEOb.9.EKNywOGXlLtlptecb2btJtdMmcVjy','wendy.sutcliffe@trueshopping.co.uk','2016-05-23 11:06:50','2016-05-23 11:06:50','',0,101,'','','',5,NULL),(160,'wieke.meering@trueshopping.co.uk','Wieke','Meering','$2y$10$9EVvpk1.MJIdAsQ9nV1Ht.AaqCI2dt.7BFFxF0EbcVJzH23v.UuNi','wieke.meering@trueshopping.co.uk','2016-05-23 11:06:50','2016-05-23 11:06:50','',0,62,'','','',4,NULL),(161,'yassime.mohamed@trueshopping.co.uk','Yassime','Mohamed','$2y$10$xsP5/IGJrYBL0WNCjzEt1uAC4jG3jP8Fr5uF9CdeYEvqWbs/Z4ena','yassime.mohamed@trueshopping.co.uk','2016-05-23 11:06:50','2016-05-23 11:06:50','',0,15,'','','',8,NULL),(162,'zishan.khan@trueshopping.co.uk','Zishan','Khan','$2y$10$rJZtoUTA/KGsE4QzkeNRe.YF7DqXkMtJtEtS7q/g3mOHRAc9klGMq','zishan.khan@trueshopping.co.uk','2016-05-23 11:06:50','2016-05-23 11:06:50','',0,5,'','','',1,NULL),(163,'ian.crossley@trueshopping.co.uk','Ian','Crossley','$2y$10$VWQLEsv3tcVNKibhy7gQ3u2LnVmRxhpWCpPNsZqc0acP3iJpVMfTG','ian.crossley@trueshopping.co.uk','2016-05-23 11:06:50','2016-05-23 11:06:50','',0,5,'','','',1,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-23 18:41:05
