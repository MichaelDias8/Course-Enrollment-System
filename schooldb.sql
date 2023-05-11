CREATE DATABASE  IF NOT EXISTS `schooldb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `schooldb`;
-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: localhost    Database: schooldb
-- ------------------------------------------------------
-- Server version	8.0.31

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
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administrator` (
  `adminID` char(6) NOT NULL,
  `password` varchar(20) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  PRIMARY KEY (`adminID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrator`
--

LOCK TABLES `administrator` WRITE;
/*!40000 ALTER TABLE `administrator` DISABLE KEYS */;
INSERT INTO `administrator` VALUES ('101000','admin?okay','Frey','May'),('102000','123Ash321','Ashley','William');
/*!40000 ALTER TABLE `administrator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `antirequisite`
--

DROP TABLE IF EXISTS `antirequisite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `antirequisite` (
  `course1` char(4) NOT NULL,
  `course2` char(4) NOT NULL,
  PRIMARY KEY (`course1`,`course2`),
  KEY `course2` (`course2`),
  CONSTRAINT `antirequisite_ibfk_1` FOREIGN KEY (`course1`) REFERENCES `course` (`courseID`) ON DELETE CASCADE,
  CONSTRAINT `antirequisite_ibfk_2` FOREIGN KEY (`course2`) REFERENCES `course` (`courseID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `antirequisite`
--

LOCK TABLES `antirequisite` WRITE;
/*!40000 ALTER TABLE `antirequisite` DISABLE KEYS */;
/*!40000 ALTER TABLE `antirequisite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course` (
  `courseID` char(4) NOT NULL,
  `courseName` varchar(40) NOT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `profFirstName` varchar(20) DEFAULT NULL,
  `profLastName` varchar(20) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `addby` char(6) DEFAULT NULL,
  `belongto` char(3) DEFAULT NULL,
  PRIMARY KEY (`courseID`),
  KEY `course_ibfk_1` (`addby`),
  CONSTRAINT `course_ibfk_1` FOREIGN KEY (`addby`) REFERENCES `administrator` (`adminID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
INSERT INTO `course` VALUES ('1001','PSYCHOL1000','2023-09-08','2024-04-08','Mike','Alkinson','An intro to various branches of psychological fields and their applications','101000','101'),('1312','COMPSCI4417B','2024-01-09','2024-04-08','Dan','Lizotte',' Management and analysis of unstructured data, with a focus on text data, for example transaction logs, news text, article abstracts, and microblogs.',NULL,'130'),('1401','PHILO2080','2023-09-08','2024-04-08','James','Hildebrand','A study of some main problems in legal philosophy. Emphasis is given to actual law, e.g. criminal law and contracts, as a background to questions of law\'s nature. ','101000','321'),('2323','PHILO2032G','2024-01-08','2024-04-08','Christopher','Smeenk',' Astronauts age more slowly. Time can have a beginning. Space and time are curved. All these surprising claims are consequences of Einstein','101000','321'),('2400','COMPSCI2142A','2023-09-09','2023-12-09','Mike','Katchabaw','An intro to computation and mathematics of computer science','101000','130'),('2402','COMPSCI2210A','2023-09-08','2023-12-08','Alex','Brandt','Advanced data structures and algorithms','102000','130'),('3003','COMPSCI3121B','2024-01-08','2024-04-08','Charles','Ling',' An introduction to artificial intelligence, focused on its application to informatics and analytics.','101000','130'),('3010','MATH2155A','2023-09-08','2023-12-08','Don','Patrick','An intro to discrete math','101000','301'),('3457','COMPSCI3350B','2024-01-09','2024-04-08','Alex','Brandt','Topics include: semiconductor technologies, gates and circuits, buses, semiconductor memories, peripheral interfaces, I/O techniques, A/D conversion, standards, RISC.','101000','130');
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `daysofweek`
--

DROP TABLE IF EXISTS `daysofweek`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `daysofweek` (
  `courseID` char(4) NOT NULL,
  `weekday` varchar(12) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  PRIMARY KEY (`courseID`,`weekday`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `daysofweek`
--

LOCK TABLES `daysofweek` WRITE;
/*!40000 ALTER TABLE `daysofweek` DISABLE KEYS */;
INSERT INTO `daysofweek` VALUES ('1001','Monday','12:30:00','15:30:00'),('1312','Thursday','14:30:00','16:30:00'),('1312','Tuesday','15:30:00','16:30:00'),('1401','Wednesday','18:30:00','21:30:00'),('2323','Tuesday','17:30:00','19:30:00'),('2331','Friday','10:30:00','11:30:00'),('2331','Wednesday','12:30:00','14:30:00'),('2400','Tuesday','10:30:00','12:30:00'),('2400','Wednesday','10:30:00','11:30:00'),('2402','Thursday','14:30:00','15:30:00'),('2402','Tuesday','13:30:00','15:30:00'),('3010','Monday','08:30:00','10:30:00'),('3010','Thursday','08:30:00','09:30:00'),('3457','Monday','09:30:00','11:30:00'),('3457','Wednesday','10:30:00','11:30:00');
/*!40000 ALTER TABLE `daysofweek` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dropcourse`
--

DROP TABLE IF EXISTS `dropcourse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dropcourse` (
  `studentID` char(9) NOT NULL,
  `courseID` char(4) NOT NULL,
  `dropDate` date NOT NULL,
  PRIMARY KEY (`courseID`,`studentID`),
  KEY `studentID` (`studentID`),
  CONSTRAINT `dropcourse_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `course` (`courseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `dropcourse_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dropcourse`
--

LOCK TABLES `dropcourse` WRITE;
/*!40000 ALTER TABLE `dropcourse` DISABLE KEYS */;
INSERT INTO `dropcourse` VALUES ('100004353','1001','2023-09-08'),('100004353','3010','2023-10-08');
/*!40000 ALTER TABLE `dropcourse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enrollcourse`
--

DROP TABLE IF EXISTS `enrollcourse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enrollcourse` (
  `studentID` char(9) NOT NULL,
  `courseID` char(4) NOT NULL,
  PRIMARY KEY (`courseID`,`studentID`),
  KEY `studentID` (`studentID`),
  CONSTRAINT `enrollcourse_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `course` (`courseID`) ON DELETE RESTRICT,
  CONSTRAINT `enrollcourse_ibfk_2` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enrollcourse`
--

LOCK TABLES `enrollcourse` WRITE;
/*!40000 ALTER TABLE `enrollcourse` DISABLE KEYS */;
INSERT INTO `enrollcourse` VALUES ('100000000','2402'),('100000000','3010'),('100004353','1001'),('123456789','1001'),('123456789','2323'),('777777777','2323'),('777777777','2400'),('777777777','2402'),('777777777','3010'),('777777777','3457');
/*!40000 ALTER TABLE `enrollcourse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modifycourse`
--

DROP TABLE IF EXISTS `modifycourse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `modifycourse` (
  `courseID` char(4) NOT NULL,
  `adminID` char(6) NOT NULL,
  `modifyDate` date NOT NULL,
  PRIMARY KEY (`courseID`,`adminID`),
  KEY `adminID` (`adminID`),
  CONSTRAINT `modifycourse_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `course` (`courseID`) ON DELETE RESTRICT,
  CONSTRAINT `modifycourse_ibfk_2` FOREIGN KEY (`adminID`) REFERENCES `administrator` (`adminID`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modifycourse`
--

LOCK TABLES `modifycourse` WRITE;
/*!40000 ALTER TABLE `modifycourse` DISABLE KEYS */;
INSERT INTO `modifycourse` VALUES ('1001','102000','2023-08-15');
/*!40000 ALTER TABLE `modifycourse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prerequisite`
--

DROP TABLE IF EXISTS `prerequisite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prerequisite` (
  `requiredCourse` char(4) NOT NULL,
  `wishCourse` char(4) NOT NULL,
  PRIMARY KEY (`requiredCourse`,`wishCourse`),
  KEY `wishCourse` (`wishCourse`),
  CONSTRAINT `prerequisite_ibfk_1` FOREIGN KEY (`requiredCourse`) REFERENCES `course` (`courseID`) ON DELETE CASCADE,
  CONSTRAINT `prerequisite_ibfk_2` FOREIGN KEY (`wishCourse`) REFERENCES `course` (`courseID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prerequisite`
--

LOCK TABLES `prerequisite` WRITE;
/*!40000 ALTER TABLE `prerequisite` DISABLE KEYS */;
/*!40000 ALTER TABLE `prerequisite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student` (
  `studentID` char(9) NOT NULL,
  `username` varchar(7) NOT NULL,
  `password` varchar(20) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `faculty` varchar(50) DEFAULT NULL,
  `module` varchar(50) DEFAULT NULL,
  `degree` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`studentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES ('100000000','mchi141','!123Mine','Master','Chief','Science','Specialization in Computer Science','Four year Bachelor'),('100004353','capture','GlaDoS123','Chell','Aperture','Science','Specialization in Computer Science','Four year Bachelor'),('123456789','wwit230','Chemistry!','Walter','White','Science','Honors specialization in Chemistry','Four year Honors Bachelor'),('777777777','credfld','raccoon?','Chris','Redfield','Social Science','Major in Psychology','Three year Bachelor');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subject` (
  `subjectID` char(3) NOT NULL,
  `subjectName` varchar(30) NOT NULL,
  `leaderFirstname` varchar(20) DEFAULT NULL,
  `leaderLastname` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`subjectID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject`
--

LOCK TABLES `subject` WRITE;
/*!40000 ALTER TABLE `subject` DISABLE KEYS */;
INSERT INTO `subject` VALUES ('101','Psychology','Mike','Alkinson'),('123','Spanish','Montoya','Descalzi'),('130','Computer science','Ken','Brown'),('301','Mathematics','Don','Patrick'),('321','Philosophy','Carolyn ','McLeod');
/*!40000 ALTER TABLE `subject` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-11 13:27:48
