-- MySQL dump 10.13  Distrib 8.0.25, for Linux (x86_64)
--
-- Host: localhost    Database: sellshopdb
-- ------------------------------------------------------
-- Server version	8.0.25-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brands` (
  `id` int NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(50) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `activity_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=388 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'Abyvita caps',0,'2021-04-11 09:45:05'),(2,'Abyvita syrup',0,'2021-04-11 09:45:05'),(3,'Active Life',0,'2021-04-11 09:45:05'),(4,'Vitaronamin tab (1bx)',0,'2021-04-11 09:45:05'),(5,'Vin C',0,'2021-04-11 09:45:05'),(6,'Citro C (3bxs)',0,'2021-04-11 09:45:05'),(7,'Vitamin B. co tab (2bxs)',0,'2021-04-11 09:45:05'),(8,'Salo apeti syrup',0,'2021-04-11 09:45:05'),(9,'Ronvit drop',0,'2021-04-11 09:45:05'),(10,'Ronvit syrup',0,'2021-04-11 09:45:05'),(11,'Polyfer syrup',0,'2021-04-11 09:45:05'),(12,'Nutramin drop',0,'2021-04-11 09:45:05'),(13,'Nahak',0,'2021-04-11 09:45:05'),(14,'Multivatamin tab (2bxs)',0,'2021-04-11 09:45:05'),(15,'Multivate syrup',0,'2021-04-11 09:45:05'),(16,'Folic acid',0,'2021-04-11 09:45:05'),(17,'Etisala caps',0,'2021-04-11 09:45:05'),(18,'Dynwell syrup',0,'2021-04-11 09:45:05'),(19,'Cyfen',0,'2021-04-11 09:45:05'),(20,'Bx syrup',0,'2021-04-11 09:45:05'),(21,'Basevite drop',0,'2021-04-11 09:45:05'),(22,'Babyvite syrup',0,'2021-04-11 09:45:05'),(23,'Astymin syrup',0,'2021-04-11 09:45:05'),(24,'Aspidyne syrup',0,'2021-04-11 09:45:05'),(25,'Jarifan syrup',0,'2021-04-11 09:45:05'),(26,'Kidivite syrup',0,'2021-04-11 09:45:05'),(27,'Kidics syrup',0,'2021-04-11 09:45:05'),(28,'Leena syrup',0,'2021-04-11 09:45:05'),(29,'Leena caps',0,'2021-04-11 09:45:05'),(30,'Letaron syrup',0,'2021-04-11 09:45:05'),(31,'Apetatrust syrup',0,'2021-04-11 09:45:05'),(32,'Zincofer syrup',0,'2021-04-11 09:45:05'),(33,'Zincovit syrup',0,'2021-04-11 09:45:05'),(34,'Givers syrup',0,'2021-04-11 09:45:05'),(35,'Tres orix B/S',0,'2021-04-11 09:45:05'),(36,'Vigorix syrup',0,'2021-04-11 09:45:05'),(37,'Virol syrup',0,'2021-04-11 09:45:05'),(38,'Foligrow cap',0,'2021-04-11 09:45:05'),(39,'Foligrow syrup',0,'2021-04-11 09:45:05'),(40,'Foliron syrup',0,'2021-04-11 09:45:05'),(41,'Ferum syrup',0,'2021-04-11 09:45:05'),(42,'Feroglobin syrup',0,'2021-04-11 09:45:05'),(43,'Feroglobin cap',0,'2021-04-11 09:45:05'),(44,'Dexorange',0,'2021-04-11 09:45:05'),(45,'City blood tonic',0,'2021-04-11 09:45:05'),(46,'Bioferon syrup',0,'2021-04-11 09:45:05'),(47,'Cirotamin syrup',0,'2021-04-11 09:45:05'),(48,'HB - Ron',0,'2021-04-11 09:45:05'),(49,'Haemogloben Ayrtons',0,'2021-04-11 09:45:05'),(50,'Haemogloben M&G',0,'2021-04-11 09:45:05'),(51,'Haemoglobin syrup',0,'2021-04-11 09:45:05'),(52,'Happyrona syrup',0,'2021-04-11 09:45:05'),(53,'Heptopep',0,'2021-04-11 09:45:05'),(54,'Lista syrup',0,'2021-04-11 09:45:05'),(55,'Citramine tabs',0,'2021-04-11 09:45:05'),(56,'Contreg (anti hist.)',0,'2021-04-11 09:45:05'),(57,'Aboniki Balm',0,'2021-04-11 09:45:05'),(58,'Pinpac gel',0,'2021-04-11 09:45:05'),(59,'Mercy Cream',0,'2021-04-11 09:45:05'),(60,'Chocho Cream',0,'2021-04-11 09:45:05'),(61,'Dermiron Plus',0,'2021-04-11 09:45:05'),(62,'Clodol gel',0,'2021-04-11 09:45:05'),(63,'Ronfit forte (2bxs)',0,'2021-04-11 09:45:05'),(64,'Zudrex (2ks)',0,'2021-04-11 09:45:05'),(65,'Ronamol (1bx)',0,'2021-04-11 09:45:05'),(66,'Ronamol forte (1bx)',0,'2021-04-11 09:45:05'),(67,'Ronamol plus (1bx)',0,'2021-04-11 09:45:05'),(68,'Pofinac tab (5bxs)',0,'2021-04-11 09:45:05'),(69,'Pocomol',0,'2021-04-11 09:45:05'),(70,'Pocopain tab',0,'2021-04-11 09:45:05'),(71,'Parafenac tabs (2bxs)',0,'2021-04-11 09:45:05'),(72,'Paratop (2bxs)',0,'2021-04-11 09:45:05'),(73,'Paingay cap (2bxs)',0,'2021-04-11 09:45:05'),(74,'Fenbase extra (2bxs)',0,'2021-04-11 09:45:05'),(75,'Piritin',0,'2021-04-11 09:45:05'),(76,'Famacap',0,'2021-04-11 09:45:05'),(77,'Eskay para tab (2bxs)',0,'2021-04-11 09:45:05'),(78,'Efpac (3bxs)',0,'2021-04-11 09:45:05'),(79,'Diclo (50mg)',0,'2021-04-11 09:45:05'),(80,'Diclo (50mg) Bucee',0,'2021-04-11 09:45:05'),(81,'Dicloron gel',0,'2021-04-11 09:45:05'),(82,'Dipex (2bxs)',0,'2021-04-11 09:45:05'),(83,'Cafalgin tab',0,'2021-04-11 09:45:05'),(84,'Brufen tab (400mg)',0,'2021-04-11 09:45:05'),(85,'Ayrton para tab (2bxes)',0,'2021-04-11 09:45:05'),(86,'Aspirin',0,'2021-04-11 09:45:05'),(87,'Gebedol',0,'2021-04-11 09:45:05'),(88,'Kwik action (2bxs)',0,'2021-04-11 09:45:05'),(89,'Letamol para tab (2bxs)',0,'2021-04-11 09:45:05'),(90,'Lofnac 100 (2bxs)',0,'2021-04-11 09:45:05'),(91,'Teedar',0,'2021-04-11 09:45:05'),(92,'Efpac jnr syrup',0,'2021-04-11 09:45:05'),(93,'Epanol syrup',0,'2021-04-11 09:45:05'),(94,'Delmol',0,'2021-04-11 09:45:05'),(95,'Brufen syrup',0,'2021-04-11 09:45:05'),(96,'Letamol syrup',0,'2021-04-11 09:45:05'),(97,'Antasil (1box)',0,'2021-04-11 09:45:05'),(98,'Zerocid',0,'2021-04-11 09:45:05'),(99,'Re-zot tab',0,'2021-04-11 09:45:05'),(100,'Re-zot syrup',0,'2021-04-11 09:45:05'),(101,'Nugel',0,'2021-04-11 09:45:05'),(102,'Number 10 (2bxs)',0,'2021-04-11 09:45:05'),(103,'Polygell susp B/S',0,'2021-04-11 09:45:05'),(104,'Polygell susp S/S',0,'2021-04-11 09:45:05'),(105,'Martins (2bxs)',0,'2021-04-11 09:45:05'),(106,'Magacid tab (2bxs)',0,'2021-04-11 09:45:05'),(107,'Magacid susp',0,'2021-04-11 09:45:05'),(108,'Gastron tab (2bxs)',0,'2021-04-11 09:45:05'),(109,'Gastron syrup',0,'2021-04-11 09:45:05'),(110,'Gastron plus B/S',0,'2021-04-11 09:45:05'),(111,'Roxacid',0,'2021-04-11 09:45:05'),(112,'Fumet syrup',0,'2021-04-11 09:45:05'),(113,'Colodium',0,'2021-04-11 09:45:05'),(114,'MMT',0,'2021-04-11 09:45:05'),(115,'Minas (4bxs)',0,'2021-04-11 09:45:05'),(116,'Wormzap tab (1bx)',0,'2021-04-11 09:45:05'),(117,'Wormzap susp (1pk)',0,'2021-04-11 09:45:05'),(118,'Wormzol tab (1bx)',0,'2021-04-11 09:45:05'),(119,'Wormron tab (1bx)',0,'2021-04-11 09:45:05'),(120,'Wormron susp (1pk)',0,'2021-04-11 09:45:05'),(121,'Wormplex 400',0,'2021-04-11 09:45:05'),(122,'Tacizol susp (1pk)',0,'2021-04-11 09:45:05'),(123,'Septrin (b & w)',0,'2021-04-11 09:45:05'),(124,'Stopkof (Adult)',0,'2021-04-11 09:45:05'),(125,'Stopkof (Junior)',0,'2021-04-11 09:45:05'),(126,'Stopkof (Baby)',0,'2021-04-11 09:45:05'),(127,'Salo cold (2bxs)',0,'2021-04-11 09:45:05'),(128,'Samalin (Adult)',0,'2021-04-11 09:45:05'),(129,'Riddles (Adult)',0,'2021-04-11 09:45:05'),(130,'Riddles (Junior)',0,'2021-04-11 09:45:05'),(131,'Riddles (Baby)',0,'2021-04-11 09:45:05'),(132,'Famacold tab',0,'2021-04-11 09:45:05'),(133,'Nasal Drop',0,'2021-04-11 09:45:05'),(134,'Coldrid (2bxs)',0,'2021-04-11 09:45:05'),(135,'Coldrilif cap (2bxs)',0,'2021-04-11 09:45:05'),(136,'Baby plus (Malins)',0,'2021-04-11 09:45:05'),(137,'Inhaler (rub)',0,'2021-04-11 09:45:05'),(138,'Letalin syrup',0,'2021-04-11 09:45:05'),(139,'Malin Adult',0,'2021-04-11 09:45:05'),(140,'Malin jnr',0,'2021-04-11 09:45:05'),(141,'Menthox (Adult)',0,'2021-04-11 09:45:05'),(142,'Menthox (Lozenges)',0,'2021-04-11 09:45:05'),(143,'Taabea',0,'2021-04-11 09:45:05'),(144,'Tinatett Venecare',0,'2021-04-11 09:45:05'),(145,'Imboost Herbal Mixture',0,'2021-04-11 09:45:05'),(146,'Trafan (1bx)',0,'2021-04-11 09:45:05'),(147,'Novamether tab (1bx)',0,'2021-04-11 09:45:05'),(148,'Cartef tab (1bx)',0,'2021-04-11 09:45:05'),(149,'Cartef susp',0,'2021-04-11 09:45:05'),(150,'Artetab susp',0,'2021-04-11 09:45:05'),(151,'Lonart Ds tabs (1bx)',0,'2021-04-11 09:45:05'),(152,'Lonart susp',0,'2021-04-11 09:45:05'),(153,'Lumarel (1bx)',0,'2021-04-11 09:45:05'),(154,'Malar 2 susp',0,'2021-04-11 09:45:05'),(155,'Wellman caps',0,'2021-04-11 09:45:05'),(156,'Wellwoman caps',0,'2021-04-11 09:45:05'),(157,'Cellgevity',0,'2021-04-11 09:45:05'),(158,'Max 357',0,'2021-04-11 09:45:05'),(159,'Spirit',0,'2021-04-11 09:45:05'),(160,'Tetracycline',0,'2021-04-11 09:45:05'),(161,'Plaster roll',0,'2021-04-11 09:45:05'),(162,'G.V paint',0,'2021-04-11 09:45:05'),(163,'Cotton wool (1roll)',0,'2021-04-11 09:45:05'),(164,'Bandage (gauce)',0,'2021-04-11 09:45:05'),(165,'Savlon S/S',0,'2021-04-11 09:45:05'),(166,'Pad (Chrisbill)',0,'2021-04-11 09:45:05'),(167,'Pad (Dechris)',0,'2021-04-11 09:45:05'),(168,'Postino 2',0,'2021-04-11 09:45:05'),(169,'Contra 72',0,'2021-04-11 09:45:05'),(170,'Condoms ',0,'2021-04-11 09:45:05'),(171,'(kiss straw berry)',1,'2021-04-11 09:45:05'),(172,'Condoms (Good Care)',0,'2021-04-11 09:45:05'),(173,'Condoms (kiss)',0,'2021-04-11 09:45:05'),(174,'Levon 2 (1box)',0,'2021-04-11 09:45:05'),(175,'Lydia',0,'2021-04-11 09:45:05'),(176,'Fluconazole (Mycostat)',0,'2021-04-11 09:45:05'),(177,'Pregnancy test (1bx)',0,'2021-04-11 09:45:05'),(178,'Lavender oil',0,'2021-04-11 09:45:05'),(179,'Turmeric oil',0,'2021-04-11 09:45:05'),(180,'Argan oil',0,'2021-04-11 09:45:05'),(181,'Carrot oil',0,'2021-04-11 09:45:05'),(182,'Jojoba oil',0,'2021-04-11 09:45:05'),(183,'Olive oil',0,'2021-04-11 09:45:05'),(184,'Apricot oil',0,'2021-04-11 09:45:05'),(185,'Horse tail',0,'2021-04-11 09:45:05'),(186,'Oregano oil',0,'2021-04-11 09:45:05'),(187,'Fenugreek oil',0,'2021-04-11 09:45:05'),(188,'Vitamine E',0,'2021-04-11 09:45:05'),(189,'Rose oil',0,'2021-04-11 09:45:05'),(190,'Tea tree oil',0,'2021-04-11 09:45:05'),(191,'Apple cidar vinegar',0,'2021-04-11 09:45:05'),(192,'Face mask',0,'2021-04-11 09:45:05'),(193,'Hygra 200',0,'2021-04-11 09:45:05');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_type`
--

DROP TABLE IF EXISTS `category_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cat_type_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_type`
--

LOCK TABLES `category_type` WRITE;
/*!40000 ALTER TABLE `category_type` DISABLE KEYS */;
INSERT INTO `category_type` VALUES (1,'MULTIVITAMINE'),(2,'BLOOD TONICS'),(3,'CATEGORY'),(4,'BLOOD TONICS'),(5,'ANTI HISTAMINE'),(6,'BALMS AND CREAMS'),(7,'PAIN KILLERS (ADULTS)'),(8,'PAIN KILLERS(CHILDREN)'),(9,'STOMACH, DIARRHEA, AND DYSENTERY'),(10,'DEWORMER'),(11,'COLD, COUGH, AND CATAR'),(12,'HERBAL'),(13,'MALARIA'),(14,'FOOD SUPPLEMENTS'),(15,'SORE DRESSING'),(16,'SANITARY PDTS'),(17,'CONDOMS AND CONTRACEPTIVES'),(18,'PREGNANCY TEST AND FEMININE HYGIENE'),(19,'ESSENTIAL OILS'),(20,'OTHERS');
/*!40000 ALTER TABLE `category_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_tb`
--

DROP TABLE IF EXISTS `customer_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_tb` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_name` text NOT NULL,
  `gender` varchar(2) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `digital_address` varchar(25) NOT NULL,
  `email` text NOT NULL,
  `family_size` int NOT NULL,
  `amount_bought` float NOT NULL,
  `city` varchar(50) NOT NULL,
  `suburb` varchar(100) NOT NULL,
  `street_name` varchar(50) NOT NULL,
  `days_to_consume` varchar(11) NOT NULL,
  `buyorder_date` date NOT NULL,
  `other_details` text NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `deleted` int NOT NULL DEFAULT '0',
  `submitting_date` date NOT NULL,
  `activity_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `brand_type` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_tb`
--

LOCK TABLES `customer_tb` WRITE;
/*!40000 ALTER TABLE `customer_tb` DISABLE KEYS */;
INSERT INTO `customer_tb` VALUES (1,'richmond gyam','M','+233202111232','box 365','cc-21e-2321','kjfsk@uihdsf',2,2,'cape coast','amamoma','klnsd','30','2021-06-10','done well',0,0,'0000-00-00','2020-06-22 00:36:53',34),(2,'Richmond NKETIA','M','+233202111232','box 365','cc-21e-2321','kjfsk@uihdsf',2,1,'cape coast','amamoma','klnsd','2','2021-06-13','done well',0,0,'0000-00-00','2020-06-22 00:45:43',57),(5,'richy','M','0248822349','22 ama','cc-332-21','r@gmail.com',4,5,'cape','amamo','hamgl','28','2021-06-01','nothing',1,0,'2021-06-07','2021-06-07 10:53:34',37),(6,'nke richy','M','0292820192','jabd','bdsa','bdjsa',2,4,'cape','rihy','jbdsja','21','2021-06-07','nothingti',0,0,'2021-06-07','2021-06-07 10:56:11',36);
/*!40000 ALTER TABLE `customer_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `groups` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `permissions` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'Adminstrator','1'),(2,'Shop Attendant','2');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grouptb`
--

DROP TABLE IF EXISTS `grouptb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grouptb` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gname` varchar(25) DEFAULT NULL,
  `permissions` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grouptb`
--

LOCK TABLES `grouptb` WRITE;
/*!40000 ALTER TABLE `grouptb` DISABLE KEYS */;
INSERT INTO `grouptb` VALUES (1,'Adminstrator',1),(2,'Shop Attendant',2);
/*!40000 ALTER TABLE `grouptb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_type`
--

DROP TABLE IF EXISTS `item_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `item_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_type`
--

LOCK TABLES `item_type` WRITE;
/*!40000 ALTER TABLE `item_type` DISABLE KEYS */;
INSERT INTO `item_type` VALUES (1,'Syrup'),(2,'Capsule'),(3,'Others');
/*!40000 ALTER TABLE `item_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `group_id` int NOT NULL,
  `uid` int NOT NULL,
  `activity_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (1,'Richmond Nketia Gyamfi','Admin','$2y$10$m0h5S.lMCvYB1wmztGCAQ..jTG1Eax0b1qHpn4r8UjKtUAQtw97VG',1,1,'2020-05-25 17:41:56'),(2,'richmonds nketiah gyamfi','richmondsnketiah','$2y$10$UgjZyYBGObmVP9K5yYK2FelTN9YIgHPzJ2ChfHVQdFiieJqgU4HHC',2,2,'2020-06-20 19:33:37'),(3,'Selina mensah ','Selinamensah','$2y$10$TjYXEh5Io894xfunyzvz4u1s5MgQ3laTfjLV7gQsqkpZLwhEYGAY2',2,3,'2021-04-11 11:04:58'),(4,'richmond nketia ','richmondnketia','$2y$10$TjYXEh5Io894xfunyzvz4u1s5MgQ3laTfjLV7gQsqkpZLwhEYGAY2',1,4,'2021-04-11 11:06:12');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_log`
--

DROP TABLE IF EXISTS `login_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login_log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(25) DEFAULT NULL,
  `logintime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_log`
--

LOCK TABLES `login_log` WRITE;
/*!40000 ALTER TABLE `login_log` DISABLE KEYS */;
INSERT INTO `login_log` VALUES (1,'Admin','2021-06-20 02:36:05'),(2,'Admin','2021-06-21 00:06:36'),(3,'Admin','2021-06-24 12:01:06'),(4,'Admin','2021-06-24 17:08:57'),(5,'Admin','2021-06-24 17:20:29'),(6,'Admin','2021-06-24 22:28:26'),(7,'Admin','2021-06-25 10:23:45');
/*!40000 ALTER TABLE `login_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_tb`
--

DROP TABLE IF EXISTS `sales_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sales_tb` (
  `id` int NOT NULL AUTO_INCREMENT,
  `st_id` int NOT NULL,
  `itemcat_type_id` int NOT NULL,
  `item_type_id` int NOT NULL,
  `brand_id` int NOT NULL,
  `selling_type_id` int NOT NULL,
  `customer_id` int DEFAULT NULL,
  `num_available` varchar(11) NOT NULL,
  `no_purchased` varchar(11) NOT NULL,
  `unit_amount` float NOT NULL,
  `total_amount` float NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `sale_type` tinyint NOT NULL DEFAULT '0',
  `submitting_date` date NOT NULL,
  `activity_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_no` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_tb`
--

LOCK TABLES `sales_tb` WRITE;
/*!40000 ALTER TABLE `sales_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `selling_type`
--

DROP TABLE IF EXISTS `selling_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `selling_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sell_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `selling_type`
--

LOCK TABLES `selling_type` WRITE;
/*!40000 ALTER TABLE `selling_type` DISABLE KEYS */;
INSERT INTO `selling_type` VALUES (1,'Package(s)'),(2,'Box(es)'),(3,'Bag(s)'),(4,'Single(s)');
/*!40000 ALTER TABLE `selling_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_available`
--

DROP TABLE IF EXISTS `stock_available`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stock_available` (
  `id` int NOT NULL AUTO_INCREMENT,
  `itemcat_type_id` int NOT NULL,
  `brand_id` int NOT NULL,
  `item_type_id` int NOT NULL,
  `selling_type_id` int NOT NULL,
  `number_added` varchar(11) NOT NULL,
  `unitcost_price` float NOT NULL,
  `totalcost_price` float NOT NULL,
  `selling_price` float NOT NULL,
  `submitting_date` date NOT NULL,
  `activity_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_available`
--

LOCK TABLES `stock_available` WRITE;
/*!40000 ALTER TABLE `stock_available` DISABLE KEYS */;
/*!40000 ALTER TABLE `stock_available` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_tb`
--

DROP TABLE IF EXISTS `stock_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stock_tb` (
  `id` int NOT NULL AUTO_INCREMENT,
  `itemcat_type_id` int NOT NULL,
  `item_type_id` int NOT NULL,
  `brand_id` int NOT NULL,
  `selling_type_id` int NOT NULL,
  `number_added` varchar(11) NOT NULL,
  `unitcost_price` float NOT NULL,
  `totalcost_price` float NOT NULL,
  `selling_price` float NOT NULL,
  `invoice_no` varchar(15) NOT NULL,
  `supplier_id` int NOT NULL,
  `submitting_date` date NOT NULL,
  `activity_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_tb`
--

LOCK TABLES `stock_tb` WRITE;
/*!40000 ALTER TABLE `stock_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `stock_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suppliers_tb`
--

DROP TABLE IF EXISTS `suppliers_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `suppliers_tb` (
  `id` int NOT NULL AUTO_INCREMENT,
  `suppliers_name` varchar(50) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `email` varchar(150) NOT NULL,
  `business_name` text NOT NULL,
  `address` text NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `submitting_date` date NOT NULL,
  `activity_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suppliers_tb`
--

LOCK TABLES `suppliers_tb` WRITE;
/*!40000 ALTER TABLE `suppliers_tb` DISABLE KEYS */;
INSERT INTO `suppliers_tb` VALUES (1,'ComeDigitalize','0272211222','rnketia25@gmail.com','ComeDigitalize','Cape coast',0,'2021-06-20','2021-06-20 02:42:50');
/*!40000 ALTER TABLE `suppliers_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_session`
--

DROP TABLE IF EXISTS `users_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_session` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `hash` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_session`
--

LOCK TABLES `users_session` WRITE;
/*!40000 ALTER TABLE `users_session` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_tb`
--

DROP TABLE IF EXISTS `users_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_tb` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `other_name` varchar(50) DEFAULT NULL,
  `dob` date NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `group_id` int NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `address` text NOT NULL,
  `city_name` varchar(50) NOT NULL,
  `suburb` varchar(50) DEFAULT NULL,
  `gender` varchar(6) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `submitting_date` date NOT NULL,
  `activity_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_tb`
--

LOCK TABLES `users_tb` WRITE;
/*!40000 ALTER TABLE `users_tb` DISABLE KEYS */;
INSERT INTO `users_tb` VALUES (1,'richmonds','nketiah','gyamfi','2020-06-02','2134356',2,'rnketia25@gmail.com','cape coast','amamoma','north','M',0,'2020-06-02','2021-06-12 16:35:01'),(2,'Richmond','Nketia','Gyamfi','2020-06-02','0202134356',1,'rnketia25@gmail.com','cape coast','amamoma','north','M',0,'2020-06-02','2021-06-12 16:39:17'),(3,'gyamfi','nketia','','2021-06-07','299119212',1,'r@d.com','12ss','acc','dswq','M',0,'2020-06-02','2021-06-12 16:40:11'),(4,'Richmond','Nketia',NULL,'2020-06-02','2134356',1,'rnketia25@gmail.com','cape coast','amamoma','north','M',0,'2020-06-02','2021-06-12 16:41:33');
/*!40000 ALTER TABLE `users_tb` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-29 14:58:06
