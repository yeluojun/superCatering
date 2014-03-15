-- MySQL dump 10.13  Distrib 5.6.14, for Win64 (x86_64)
--
-- Host: localhost    Database: super_waimai
-- ------------------------------------------------------
-- Server version	5.6.14-enterprise-commercial-advanced

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
-- Table structure for table `dish_list`
--

DROP TABLE IF EXISTS `dish_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dish_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phote` varchar(30) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `price` varchar(20) DEFAULT NULL,
  `mark` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dish_list`
--

LOCK TABLES `dish_list` WRITE;
/*!40000 ALTER TABLE `dish_list` DISABLE KEYS */;
INSERT INTO `dish_list` VALUES (1,'./dish_photo/maixiangji_1.jpg','汉堡','1元',NULL),(2,'./dish_photo/maixiangji_2.jpg','汉堡','2元',NULL),(3,'./dish_photo/maixiangji_3.jpg','汉堡','3元',NULL),(4,'./dish_photo/maixiangji_4.jpg','汉堡','4元',NULL),(5,'./dish_photo/maixiangji_5.jpg','汉堡','5元',NULL),(6,'./dish_photo/maixiangji_6.jpg','汉堡','6元',NULL);
/*!40000 ALTER TABLE `dish_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `like_relation`
--

DROP TABLE IF EXISTS `like_relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `like_relation` (
  `student_id` int(11) DEFAULT NULL,
  `merchant_id` int(11) DEFAULT NULL,
  `time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `like_relation`
--

LOCK TABLES `like_relation` WRITE;
/*!40000 ALTER TABLE `like_relation` DISABLE KEYS */;
/*!40000 ALTER TABLE `like_relation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `merchant_list`
--

DROP TABLE IF EXISTS `merchant_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `merchant_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `mark` int(11) DEFAULT NULL,
  `merchant_1` int(11) DEFAULT NULL,
  `merchant_2` int(11) DEFAULT NULL,
  `merchant_3` int(11) DEFAULT NULL,
  `merchant_4` int(11) DEFAULT NULL,
  `merchant_5` int(11) DEFAULT NULL,
  `merchant_6` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `merchant_list`
--

LOCK TABLES `merchant_list` WRITE;
/*!40000 ALTER TABLE `merchant_list` DISABLE KEYS */;
INSERT INTO `merchant_list` VALUES (1,'sunkuo','13826480235',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `merchant_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pruchase_list`
--

DROP TABLE IF EXISTS `pruchase_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pruchase_list` (
  `student_id` int(11) DEFAULT NULL,
  `merchant_id` int(11) DEFAULT NULL,
  `time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pruchase_list`
--

LOCK TABLES `pruchase_list` WRITE;
/*!40000 ALTER TABLE `pruchase_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `pruchase_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_list`
--

DROP TABLE IF EXISTS `user_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `school` varchar(40) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_list`
--

LOCK TABLES `user_list` WRITE;
/*!40000 ALTER TABLE `user_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_list` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-03-15 22:12:58
