-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: gogora_db
-- ------------------------------------------------------
-- Server version	8.0.39

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `blacklist`
--

DROP TABLE IF EXISTS `blacklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blacklist` (
  `blacklist_id` int NOT NULL,
  `username` varchar(10) NOT NULL,
  `blacklist_date` datetime NOT NULL,
  `blacklist_status` enum('Blacklisted','Reinstated') NOT NULL,
  `reason` varchar(45) NOT NULL,
  PRIMARY KEY (`blacklist_id`),
  UNIQUE KEY `user_id_UNIQUE` (`blacklist_id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  CONSTRAINT `user_name ` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blacklist`
--

LOCK TABLES `blacklist` WRITE;
/*!40000 ALTER TABLE `blacklist` DISABLE KEYS */;
/*!40000 ALTER TABLE `blacklist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservations` (
  `reservation_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `ride_id` int NOT NULL,
  `reservation_time` datetime NOT NULL,
  `status` enum('Active','Canceled','Completed') NOT NULL,
  `payment_status` enum('Paid','Pending','Not Paid') NOT NULL,
  `total fare` int NOT NULL,
  `payment method` enum('Manual','GCASH') NOT NULL,
  PRIMARY KEY (`reservation_id`),
  KEY `user_id_idx` (`user_id`),
  KEY `ride_id_idx` (`ride_id`),
  CONSTRAINT `ride_id` FOREIGN KEY (`ride_id`) REFERENCES `rides` (`ride_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rides`
--

DROP TABLE IF EXISTS `rides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rides` (
  `ride_id` int NOT NULL AUTO_INCREMENT,
  `plate_number` varchar(6) NOT NULL,
  `route` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  `seats_available` int NOT NULL,
  `ride_type` enum('Jeepney','Service') NOT NULL,
  `departure` datetime NOT NULL,
  `capacity` int NOT NULL,
  `queue` int NOT NULL,
  PRIMARY KEY (`ride_id`),
  UNIQUE KEY `ride_id_UNIQUE` (`ride_id`),
  UNIQUE KEY `plate_number_UNIQUE` (`plate_number`),
  UNIQUE KEY `ride_type_UNIQUE` (`ride_type`),
  UNIQUE KEY `departure_UNIQUE` (`departure`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rides`
--

LOCK TABLES `rides` WRITE;
/*!40000 ALTER TABLE `rides` DISABLE KEYS */;
/*!40000 ALTER TABLE `rides` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `route`
--

DROP TABLE IF EXISTS `route`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `route` (
  `plate_number` varchar(6) NOT NULL,
  `ride_type` enum('Jeepney','Service') NOT NULL,
  `capacity` int NOT NULL,
  `pickup_point` varchar(45) NOT NULL,
  `destination` varchar(45) NOT NULL,
  `departure` datetime NOT NULL,
  PRIMARY KEY (`plate_number`),
  UNIQUE KEY `plate_number_UNIQUE` (`plate_number`),
  KEY `ride_type _idx` (`ride_type`),
  KEY `departure_idx` (`departure`),
  CONSTRAINT `departure` FOREIGN KEY (`departure`) REFERENCES `rides` (`departure`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `plate_number` FOREIGN KEY (`plate_number`) REFERENCES `rides` (`plate_number`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `ride_type ` FOREIGN KEY (`ride_type`) REFERENCES `rides` (`ride_type`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `route`
--

LOCK TABLES `route` WRITE;
/*!40000 ALTER TABLE `route` DISABLE KEYS */;
/*!40000 ALTER TABLE `route` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `firstname` varchar(10) NOT NULL,
  `lastname` varchar(10) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(17) NOT NULL,
  `role` enum('Student','Faculty','Employee') NOT NULL,
  `user_type` enum('Regular','Priority') NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2024-12-09 22:37:19
