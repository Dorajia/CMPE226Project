-- MySQL dump 10.13  Distrib 5.5.52, for Linux (x86_64)
--
-- Host: localhost    Database: eventgo
-- ------------------------------------------------------
-- Server version	5.5.52

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
-- Table structure for table `CALENDAR_Dimension`
--

DROP TABLE IF EXISTS `CALENDAR_Dimension`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CALENDAR_Dimension` (
  `CalendarKey` int(11) NOT NULL AUTO_INCREMENT,
  `FullDate` date NOT NULL,
  `DayOfWeek` varchar(10) NOT NULL,
  `DayOfMonth` varchar(10) NOT NULL,
  `Month` varchar(10) NOT NULL,
  `Quarter` varchar(10) NOT NULL,
  `Year` varchar(10) NOT NULL,
  PRIMARY KEY (`CalendarKey`)
) ENGINE=InnoDB AUTO_INCREMENT=8229 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `CARD_Dimension`
--

DROP TABLE IF EXISTS `CARD_Dimension`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CARD_Dimension` (
  `CardKey` int(11) NOT NULL AUTO_INCREMENT,
  `CardHolder` varchar(40) NOT NULL,
  `CardType` varchar(30) NOT NULL,
  `CardNumber` varchar(30) NOT NULL,
  PRIMARY KEY (`CardKey`)
) ENGINE=InnoDB AUTO_INCREMENT=26011 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `EVENTFEEPerEVENT`
--

DROP TABLE IF EXISTS `EVENTFEEPerEVENT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EVENTFEEPerEVENT` (
  `EventFee` int(11) NOT NULL,
  `RentFee` int(11) NOT NULL,
  `ELocationKey` int(11) NOT NULL,
  `EventKey` int(11) NOT NULL,
  `CalendarKey` int(11) NOT NULL,
  PRIMARY KEY (`ELocationKey`,`EventKey`,`CalendarKey`),
  KEY `EventKey` (`EventKey`),
  KEY `CalendarKey` (`CalendarKey`),
  CONSTRAINT `EVENTFEEPerEVENT_ibfk_1` FOREIGN KEY (`ELocationKey`) REFERENCES `EVENT_LOCATION_Dimension` (`ELocationKey`),
  CONSTRAINT `EVENTFEEPerEVENT_ibfk_2` FOREIGN KEY (`EventKey`) REFERENCES `EVENT_Dimension` (`EventKey`),
  CONSTRAINT `EVENTFEEPerEVENT_ibfk_3` FOREIGN KEY (`CalendarKey`) REFERENCES `CALENDAR_Dimension` (`CalendarKey`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `EVENTFEEPerTYPE`
--

DROP TABLE IF EXISTS `EVENTFEEPerTYPE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EVENTFEEPerTYPE` (
  `EventFee` int(11) NOT NULL,
  `RentFee` int(11) NOT NULL,
  `TypeKey` int(11) NOT NULL,
  `CalendarKey` int(11) NOT NULL,
  `ELocationKey` int(11) NOT NULL,
  PRIMARY KEY (`TypeKey`,`CalendarKey`,`ELocationKey`),
  KEY `CalendarKey` (`CalendarKey`),
  KEY `ELocationKey` (`ELocationKey`),
  CONSTRAINT `EVENTFEEPerTYPE_ibfk_1` FOREIGN KEY (`TypeKey`) REFERENCES `TYPE_Dimension` (`TypeKey`),
  CONSTRAINT `EVENTFEEPerTYPE_ibfk_2` FOREIGN KEY (`CalendarKey`) REFERENCES `CALENDAR_Dimension` (`CalendarKey`),
  CONSTRAINT `EVENTFEEPerTYPE_ibfk_3` FOREIGN KEY (`ELocationKey`) REFERENCES `EVENT_LOCATION_Dimension` (`ELocationKey`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `EVENTNO`
--

DROP TABLE IF EXISTS `EVENTNO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EVENTNO` (
  `NoOfEvent` int(11) NOT NULL,
  `CalendarKey` int(11) NOT NULL,
  `ELocationKey` int(11) NOT NULL,
  `TypeKey` int(11) NOT NULL,
  PRIMARY KEY (`CalendarKey`,`ELocationKey`,`TypeKey`),
  KEY `ELocationKey` (`ELocationKey`),
  KEY `TypeKey` (`TypeKey`),
  CONSTRAINT `EVENTNO_ibfk_1` FOREIGN KEY (`CalendarKey`) REFERENCES `CALENDAR_Dimension` (`CalendarKey`),
  CONSTRAINT `EVENTNO_ibfk_2` FOREIGN KEY (`ELocationKey`) REFERENCES `EVENT_LOCATION_Dimension` (`ELocationKey`),
  CONSTRAINT `EVENTNO_ibfk_3` FOREIGN KEY (`TypeKey`) REFERENCES `TYPE_Dimension` (`TypeKey`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `EVENT_Dimension`
--

DROP TABLE IF EXISTS `EVENT_Dimension`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EVENT_Dimension` (
  `EventKey` int(11) NOT NULL AUTO_INCREMENT,
  `EventID` int(11) NOT NULL,
  `EventFee` int(11) NOT NULL,
  `EventDuration` int(11) NOT NULL,
  `EventType` varchar(30) NOT NULL,
  PRIMARY KEY (`EventKey`)
) ENGINE=InnoDB AUTO_INCREMENT=20001 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `EVENT_LOCATION_Dimension`
--

DROP TABLE IF EXISTS `EVENT_LOCATION_Dimension`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EVENT_LOCATION_Dimension` (
  `ELocationKey` int(11) NOT NULL AUTO_INCREMENT,
  `LocationID` int(11) NOT NULL,
  `City` varchar(30) NOT NULL,
  `ZipCode` varchar(12) NOT NULL,
  `State` varchar(30) NOT NULL,
  `Capacity` int(11) NOT NULL,
  `RentFee` int(11) NOT NULL,
  PRIMARY KEY (`ELocationKey`)
) ENGINE=InnoDB AUTO_INCREMENT=1503 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PARTICIPANTPerEEC`
--

DROP TABLE IF EXISTS `PARTICIPANTPerEEC`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PARTICIPANTPerEEC` (
  `NoOfParticipant` int(11) NOT NULL,
  `ELocationkey` int(11) NOT NULL,
  `EventKey` int(11) NOT NULL,
  `CalendarKey` int(11) NOT NULL,
  PRIMARY KEY (`ELocationkey`,`EventKey`,`CalendarKey`),
  KEY `EventKey` (`EventKey`),
  KEY `CalendarKey` (`CalendarKey`),
  CONSTRAINT `PARTICIPANTPerEEC_ibfk_1` FOREIGN KEY (`ELocationkey`) REFERENCES `EVENT_LOCATION_Dimension` (`ELocationKey`),
  CONSTRAINT `PARTICIPANTPerEEC_ibfk_2` FOREIGN KEY (`EventKey`) REFERENCES `EVENT_Dimension` (`EventKey`),
  CONSTRAINT `PARTICIPANTPerEEC_ibfk_3` FOREIGN KEY (`CalendarKey`) REFERENCES `CALENDAR_Dimension` (`CalendarKey`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PARTICIPANTPerUEC`
--

DROP TABLE IF EXISTS `PARTICIPANTPerUEC`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PARTICIPANTPerUEC` (
  `NoOfParticipant` int(20) NOT NULL,
  `EventKey` int(11) NOT NULL,
  `CalendarKey` int(11) NOT NULL,
  `ULocationKey` int(11) NOT NULL,
  PRIMARY KEY (`EventKey`,`CalendarKey`,`ULocationKey`),
  KEY `CalendarKey` (`CalendarKey`),
  KEY `ULocationKey` (`ULocationKey`),
  CONSTRAINT `PARTICIPANTPerUEC_ibfk_1` FOREIGN KEY (`EventKey`) REFERENCES `EVENT_Dimension` (`EventKey`),
  CONSTRAINT `PARTICIPANTPerUEC_ibfk_2` FOREIGN KEY (`CalendarKey`) REFERENCES `CALENDAR_Dimension` (`CalendarKey`),
  CONSTRAINT `PARTICIPANTPerUEC_ibfk_3` FOREIGN KEY (`ULocationKey`) REFERENCES `USER_LOCATION_Dimension` (`ULocationKey`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PAYMENTPerCTU`
--

DROP TABLE IF EXISTS `PAYMENTPerCTU`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PAYMENTPerCTU` (
  `PaidAmount` int(20) NOT NULL,
  `PayFor` varchar(11) NOT NULL,
  `CalendarKey` int(11) NOT NULL,
  `TypeKey` int(11) NOT NULL,
  `ULocationKey` int(11) NOT NULL,
  PRIMARY KEY (`CalendarKey`,`TypeKey`,`ULocationKey`),
  KEY `TypeKey` (`TypeKey`),
  KEY `ULocationKey` (`ULocationKey`),
  CONSTRAINT `PAYMENTPerCTU_ibfk_1` FOREIGN KEY (`CalendarKey`) REFERENCES `CALENDAR_Dimension` (`CalendarKey`),
  CONSTRAINT `PAYMENTPerCTU_ibfk_2` FOREIGN KEY (`TypeKey`) REFERENCES `TYPE_Dimension` (`TypeKey`),
  CONSTRAINT `PAYMENTPerCTU_ibfk_3` FOREIGN KEY (`ULocationKey`) REFERENCES `USER_LOCATION_Dimension` (`ULocationKey`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PAYMENTPerUCTE`
--

DROP TABLE IF EXISTS `PAYMENTPerUCTE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PAYMENTPerUCTE` (
  `PayAmount` int(20) NOT NULL,
  `PayFor` varchar(10) NOT NULL,
  `TypeKey` int(11) NOT NULL,
  `UserKey` int(11) NOT NULL,
  `CalendarKey` int(11) NOT NULL,
  `ELocationKey` int(11) NOT NULL,
  PRIMARY KEY (`TypeKey`,`UserKey`,`CalendarKey`,`ELocationKey`),
  KEY `UserKey` (`UserKey`),
  KEY `CalendarKey` (`CalendarKey`),
  KEY `ELocationKey` (`ELocationKey`),
  CONSTRAINT `PAYMENTPerUCTE_ibfk_1` FOREIGN KEY (`TypeKey`) REFERENCES `TYPE_Dimension` (`TypeKey`),
  CONSTRAINT `PAYMENTPerUCTE_ibfk_2` FOREIGN KEY (`UserKey`) REFERENCES `USER_Dimension` (`UserKey`),
  CONSTRAINT `PAYMENTPerUCTE_ibfk_3` FOREIGN KEY (`CalendarKey`) REFERENCES `CALENDAR_Dimension` (`CalendarKey`),
  CONSTRAINT `PAYMENTPerUCTE_ibfk_4` FOREIGN KEY (`ELocationKey`) REFERENCES `EVENT_LOCATION_Dimension` (`ELocationKey`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PAYMENT_DETAIL`
--

DROP TABLE IF EXISTS `PAYMENT_DETAIL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PAYMENT_DETAIL` (
  `PaidAmount` int(11) NOT NULL,
  `PaidFor` varchar(10) NOT NULL,
  `PaidTime` time NOT NULL,
  `TransactionID` varchar(11) NOT NULL,
  `UserKey` int(11) NOT NULL,
  `CardKey` int(11) NOT NULL,
  `CalendarKey` int(11) NOT NULL,
  `EventKey` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`TransactionID`,`EventKey`),
  KEY `UserKey` (`UserKey`),
  KEY `CalendarKey` (`CalendarKey`),
  KEY `EventKey` (`EventKey`),
  CONSTRAINT `PAYMENT_DETAIL_ibfk_1` FOREIGN KEY (`UserKey`) REFERENCES `USER_Dimension` (`UserKey`),
  CONSTRAINT `PAYMENT_DETAIL_ibfk_3` FOREIGN KEY (`CalendarKey`) REFERENCES `CALENDAR_Dimension` (`CalendarKey`),
  CONSTRAINT `PAYMENT_DETAIL_ibfk_4` FOREIGN KEY (`EventKey`) REFERENCES `EVENT_Dimension` (`EventKey`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `TYPE_Dimension`
--

DROP TABLE IF EXISTS `TYPE_Dimension`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TYPE_Dimension` (
  `TypeKey` int(11) NOT NULL AUTO_INCREMENT,
  `TypeID` int(11) NOT NULL,
  `TypeName` varchar(30) NOT NULL,
  PRIMARY KEY (`TypeKey`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `USER_Dimension`
--

DROP TABLE IF EXISTS `USER_Dimension`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USER_Dimension` (
  `UserKey` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `UserGender` varchar(10) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `UserCity` varchar(30) DEFAULT NULL,
  `UserAge` int(11) NOT NULL,
  `UserState` varchar(30) DEFAULT NULL,
  `UserZip` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`UserKey`)
) ENGINE=InnoDB AUTO_INCREMENT=7507 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `USER_LOCATION_Dimension`
--

DROP TABLE IF EXISTS `USER_LOCATION_Dimension`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `USER_LOCATION_Dimension` (
  `ULocationKey` int(11) NOT NULL AUTO_INCREMENT,
  `City` varchar(30) NOT NULL,
  `State` varchar(30) NOT NULL,
  `Zipcode` varchar(30) NOT NULL,
  PRIMARY KEY (`ULocationKey`),
  UNIQUE KEY `unique_index` (`City`,`State`,`Zipcode`)
) ENGINE=InnoDB AUTO_INCREMENT=7509 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `card`
--

DROP TABLE IF EXISTS `card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `card` (
  `card_NO` varchar(30) NOT NULL,
  `card_holder` varchar(30) NOT NULL,
  `validate_until` varchar(40) NOT NULL,
  `card_type` varchar(30) NOT NULL,
  `purse_ID` int(11) NOT NULL,
  PRIMARY KEY (`card_NO`,`purse_ID`),
  UNIQUE KEY `card_NO` (`card_NO`),
  KEY `purse_ID` (`purse_ID`),
  CONSTRAINT `card_ibfk_1` FOREIGN KEY (`purse_ID`) REFERENCES `purse` (`purse_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`dora`@`%`*/ /*!50003 TRIGGER `eventgo`.`card_AFTER_INSERT` AFTER INSERT ON `card` FOR EACH ROW
BEGIN
INSERT INTO CARD_Dimension (CardHolder, CardType, CardNumber) values( new.card_holder, new.card_type, new.card_NO);

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `event_attendee`
--

DROP TABLE IF EXISTS `event_attendee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_attendee` (
  `status` varchar(10) NOT NULL DEFAULT 'Active',
  `payment_status` varchar(10) NOT NULL DEFAULT 'Unpaid',
  `user` int(11) NOT NULL,
  `event_ID` int(11) NOT NULL,
  PRIMARY KEY (`user`,`event_ID`),
  KEY `event_attendee_ibfk_2_idx` (`event_ID`),
  CONSTRAINT `event_attendee_ibfk_1` FOREIGN KEY (`user`) REFERENCES `registered_user` (`user_ID`),
  CONSTRAINT `event_attendee_ibfk_2` FOREIGN KEY (`event_ID`) REFERENCES `registered_event` (`event_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`dora`@`%`*/ /*!50003 TRIGGER `eventgo`.`event_attendee_AFTER_INSERT` AFTER INSERT ON `event_attendee` FOR EACH ROW
BEGIN
update purse p, registered_event e set p.balance = p.balance-e.event_fee where e.event_id = new.event_id and p.user = new.user;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`dora`@`%`*/ /*!50003 TRIGGER `eventgo`.`event_attendee_AFTER_UPDATE` AFTER UPDATE ON `event_attendee` FOR EACH ROW
BEGIN
update purse p, registered_event e set p.balance = p.balance+e.event_fee where e.event_id = new.event_id and p.user = new.user and new.payment_status= 'Paid';
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`dora`@`%`*/ /*!50003 TRIGGER `eventgo`.`event_attendee_AFTER_DELETE` AFTER DELETE ON `event_attendee` FOR EACH ROW
BEGIN
update purse p, registered_event e set p.balance = p.balance+e.event_fee where e.event_id = old.event_id and p.user = old.user;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `event_location`
--

DROP TABLE IF EXISTS `event_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_location` (
  `location_ID` int(11) NOT NULL AUTO_INCREMENT,
  `address1` varchar(30) NOT NULL,
  `address2` varchar(30) DEFAULT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `zip_code` varchar(12) NOT NULL,
  `photos` varchar(500) NOT NULL,
  `rent_fee_per_hour` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `Open_hour` varchar(200) NOT NULL DEFAULT 'Mon - Fri 8:00 AM - 6:00 PM',
  `location_name` varchar(100) NOT NULL DEFAULT 'location',
  PRIMARY KEY (`location_ID`),
  UNIQUE KEY `location_ID` (`location_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1503 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`dora`@`%`*/ /*!50003 TRIGGER `eventgo`.`event_location_AFTER_INSERT` AFTER INSERT ON `event_location` FOR EACH ROW
BEGIN
insert into EVENT_LOCATION_Dimension(LocationID,City,ZipCode,State,Capacity,RentFee) values( new.location_ID,new.city,new.zip_code,new.state,new.capacity,new.rent_fee_per_hour);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `event_request`
--

DROP TABLE IF EXISTS `event_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_request` (
  `note` varchar(300) NOT NULL,
  `status` varchar(20) NOT NULL,
  `sender` int(11) NOT NULL,
  `event` int(11) NOT NULL,
  PRIMARY KEY (`sender`,`event`),
  KEY `event` (`event`),
  CONSTRAINT `event_request_ibfk_1` FOREIGN KEY (`sender`) REFERENCES `registered_user` (`user_ID`),
  CONSTRAINT `event_request_ibfk_2` FOREIGN KEY (`event`) REFERENCES `registered_event` (`event_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `event_type`
--

DROP TABLE IF EXISTS `event_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_type` (
  `type_ID` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(30) NOT NULL,
  `type_introduction` varchar(500) NOT NULL,
  PRIMARY KEY (`type_ID`),
  UNIQUE KEY `type_ID` (`type_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`dora`@`%`*/ /*!50003 TRIGGER `eventgo`.`event_type_AFTER_INSERT` AFTER INSERT ON `event_type` FOR EACH ROW
BEGIN
INSERT INTO TYPE_Dimension (TypeID,TypeName) values( new.type_ID, new.type_name);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `group_member`
--

DROP TABLE IF EXISTS `group_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_member` (
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` int(11) NOT NULL,
  `group_ID` int(11) NOT NULL,
  PRIMARY KEY (`user`,`group_ID`),
  KEY `group_ID` (`group_ID`),
  CONSTRAINT `group_member_ibfk_1` FOREIGN KEY (`user`) REFERENCES `registered_user` (`user_ID`),
  CONSTRAINT `group_member_ibfk_2` FOREIGN KEY (`group_ID`) REFERENCES `interest_group` (`group_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `interest_group`
--

DROP TABLE IF EXISTS `interest_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interest_group` (
  `group_ID` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(30) NOT NULL,
  `group_introduction` varchar(300) NOT NULL,
  `related_type` int(11) NOT NULL,
  PRIMARY KEY (`group_ID`),
  UNIQUE KEY `group_ID` (`group_ID`),
  KEY `Group_typeFK1_idx` (`related_type`),
  CONSTRAINT `interest_group_fk1` FOREIGN KEY (`related_type`) REFERENCES `event_type` (`type_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification` (
  `notification_ID` int(11) NOT NULL AUTO_INCREMENT,
  `recommendation` varchar(500) NOT NULL,
  `send_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `receive_group` int(11) NOT NULL,
  PRIMARY KEY (`notification_ID`),
  UNIQUE KEY `notification_ID` (`notification_ID`),
  KEY `notification_fk1_idx` (`receive_group`),
  CONSTRAINT `notification_fk1` FOREIGN KEY (`receive_group`) REFERENCES `interest_group` (`group_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=25009 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary table structure for view `organizer_view`
--

DROP TABLE IF EXISTS `organizer_view`;
/*!50001 DROP VIEW IF EXISTS `organizer_view`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `organizer_view` (
  `event_ID` tinyint NOT NULL,
  `purse_ID` tinyint NOT NULL,
  `card_No` tinyint NOT NULL,
  `rent_fee` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `fee_amount` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `payment_for` varchar(10) NOT NULL,
  `payment_method` varchar(30) NOT NULL,
  `pay_date` datetime NOT NULL,
  `pay_purse` int(11) DEFAULT NULL,
  `event` int(11) DEFAULT NULL,
  `cardNo` varchar(45) NOT NULL,
  `transaction_ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`transaction_ID`),
  KEY `payment_fk3_idx` (`event`),
  KEY `payment_fk1` (`cardNo`),
  KEY `payment_fk2_idx` (`pay_purse`),
  CONSTRAINT `payment_fk1` FOREIGN KEY (`cardNo`) REFERENCES `card` (`card_NO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `payment_fk2` FOREIGN KEY (`pay_purse`) REFERENCES `card` (`purse_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `payment_fk3` FOREIGN KEY (`event`) REFERENCES `registered_event` (`event_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=158552 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `purse`
--

DROP TABLE IF EXISTS `purse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purse` (
  `purse_ID` int(11) NOT NULL AUTO_INCREMENT,
  `balance` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`purse_ID`),
  UNIQUE KEY `purse_ID` (`purse_ID`),
  KEY `user` (`user`),
  CONSTRAINT `purse_ibfk_1` FOREIGN KEY (`user`) REFERENCES `registered_user` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=108006 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `registered_event`
--

DROP TABLE IF EXISTS `registered_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registered_event` (
  `event_ID` int(11) NOT NULL AUTO_INCREMENT,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `capacity` int(11) NOT NULL,
  `event_fee` int(11) NOT NULL DEFAULT '0',
  `need_request` varchar(4) DEFAULT 'No',
  `introduction` varchar(500) NOT NULL,
  `rent_fee` int(11) NOT NULL DEFAULT '0',
  `organizer` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`event_ID`),
  UNIQUE KEY `event_ID` (`event_ID`),
  KEY `organizer` (`organizer`),
  KEY `location` (`location`),
  KEY `type` (`type`),
  CONSTRAINT `registered_event_ibfk_1` FOREIGN KEY (`organizer`) REFERENCES `registered_user` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `registered_event_ibfk_2` FOREIGN KEY (`location`) REFERENCES `event_location` (`location_ID`),
  CONSTRAINT `registered_event_ibfk_3` FOREIGN KEY (`type`) REFERENCES `event_type` (`type_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=20009 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`dora`@`%`*/ /*!50003 TRIGGER `eventgo`.`registered_event_AFTER_UPDATE` AFTER UPDATE ON `registered_event` FOR EACH ROW
BEGIN
insert into EVENT_Dimension(EventID,EventFee,EventDuration,EventType) select new.event_ID,new.event_fee,DATEDIFF(new.start_time, new.end_time),t.type_name from event_type t where new.type = t.type_ID and new.status = 'Complete';
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `registered_user`
--

DROP TABLE IF EXISTS `registered_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registered_user` (
  `user_ID` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('F','M') NOT NULL,
  `password` varchar(30) NOT NULL,
  `email_address` varchar(60) NOT NULL,
  `phone_number` varchar(22) NOT NULL,
  PRIMARY KEY (`user_ID`),
  UNIQUE KEY `email_address` (`email_address`),
  UNIQUE KEY `user_ID` (`user_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8009 DEFAULT CHARSET=latin1 KEY_BLOCK_SIZE=2;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`dora`@`%`*/ /*!50003 TRIGGER `eventgo`.`registered_user_AFTER_INSERT` AFTER INSERT ON `registered_user` FOR EACH ROW
BEGIN
insert into USER_Dimension (UserID,UserGender,FirstName,LastName,UserAge) values(new.user_ID, new.gender,new.first_name, new.last_name, ROUND(datediff(CURDATE(),new.date_of_birth)/365.2425));
insert into purse(user,balance) values (new.user_ID,0);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`dora`@`%`*/ /*!50003 TRIGGER `eventgo`.`registered_user_AFTER_UPDATE` AFTER UPDATE ON `registered_user` FOR EACH ROW
BEGIN
update USER_Dimension set USER_Dimension.UserGender = new.gender, USER_Dimension.UserAge = ROUND(datediff(CURDATE(),new.date_of_birth)/365.2425) where USER_Dimension.UserID=new.User_ID;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Temporary table structure for view `update_event`
--

DROP TABLE IF EXISTS `update_event`;
/*!50001 DROP VIEW IF EXISTS `update_event`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `update_event` (
  `event_ID` tinyint NOT NULL,
  `purse_ID` tinyint NOT NULL,
  `card_No` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `user_address`
--

DROP TABLE IF EXISTS `user_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_address` (
  `address_ID` int(11) NOT NULL AUTO_INCREMENT,
  `address1` varchar(30) NOT NULL,
  `address2` varchar(30) DEFAULT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `zip_code` varchar(30) NOT NULL,
  `user_ID` int(11) NOT NULL,
  PRIMARY KEY (`address_ID`),
  UNIQUE KEY `address_ID` (`address_ID`),
  KEY `user_ID` (`user_ID`),
  CONSTRAINT `user_address_ibfk_1` FOREIGN KEY (`user_ID`) REFERENCES `registered_user` (`user_ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7505 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`dora`@`%`*/ /*!50003 TRIGGER `eventgo`.`user_address_AFTER_INSERT` AFTER INSERT ON `user_address` FOR EACH ROW
BEGIN
update USER_Dimension set USER_Dimension.UserCity = new.city ,USER_Dimension.UserState= new.state, USER_Dimension.UserZip=new.zip_code where USER_Dimension.UserID = new.user_ID;
insert into USER_LOCATION_Dimension (City,State,Zipcode) select * from (select new.city,new.state,new.zip_code) as tmp where not exists(select city,state,zipcode from USER_LOCATION_Dimension where city = new.city and state = new.state and zipcode=new.zip_code);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`dora`@`%`*/ /*!50003 TRIGGER `eventgo`.`user_address_AFTER_UPDATE` AFTER UPDATE ON `user_address` FOR EACH ROW
BEGIN
update USER_Dimension set USER_Dimension.UserCity = new.city ,USER_Dimension.UserState= new.state, USER_Dimension.UserZip=new.zip_code where USER_Dimension.UserID = new.user_ID;
insert into USER_LOCATION_Dimension (City,State,Zipcode) select * from (select new.city,new.state,new.zip_code) as tmp where not exists(select city,state,zipcode from USER_LOCATION_Dimension where city = new.city and state = new.state and zipcode=new.zip_code);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `organizer_view`
--

/*!50001 DROP TABLE IF EXISTS `organizer_view`*/;
/*!50001 DROP VIEW IF EXISTS `organizer_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `organizer_view` AS select `registered_event`.`event_ID` AS `event_ID`,`purse`.`purse_ID` AS `purse_ID`,`card`.`card_NO` AS `card_No`,`registered_event`.`rent_fee` AS `rent_fee` from ((`purse` join `registered_event`) join `card`) where ((`purse`.`user` = `registered_event`.`organizer`) and (`purse`.`purse_ID` = `card`.`purse_ID`)) group by `registered_event`.`event_ID`,`purse`.`purse_ID` order by `registered_event`.`event_ID` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `update_event`
--

/*!50001 DROP TABLE IF EXISTS `update_event`*/;
/*!50001 DROP VIEW IF EXISTS `update_event`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `update_event` AS select `event_attendee`.`event_ID` AS `event_ID`,`card`.`purse_ID` AS `purse_ID`,`card`.`card_NO` AS `card_No` from ((`event_attendee` join `card`) join `purse`) where ((`event_attendee`.`user` = `purse`.`user`) and (`purse`.`purse_ID` = `card`.`purse_ID`)) group by `event_attendee`.`event_ID`,`card`.`purse_ID` order by `event_attendee`.`event_ID` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-12  4:10:48
