-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: localhost    Database: projet_web
-- ------------------------------------------------------
-- Server version	8.0.20

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
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `book` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=601 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book`
--

LOCK TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;
INSERT INTO `book` VALUES (501,'Title1','Author1',NULL),(502,'Title2','Author2',NULL),(503,'Title3','Author3',NULL),(504,'Title4','Author4',NULL),(505,'Title5','Author5',NULL),(506,'Title6','Author6',NULL),(507,'Title7','Author7',NULL),(508,'Title8','Author8',NULL),(509,'Title9','Author9',NULL),(510,'Title10','Author10',NULL),(511,'Title11','Author11',NULL),(512,'Title12','Author12',NULL),(513,'Title13','Author13',NULL),(514,'Title14','Author14',NULL),(515,'Title15','Author15',NULL),(516,'Title16','Author16',NULL),(517,'Title17','Author17',NULL),(518,'Title18','Author18',NULL),(519,'Title19','Author19',NULL),(520,'Title20','Author20',NULL),(521,'Title21','Author21',NULL),(522,'Title22','Author22',NULL),(523,'Title23','Author23',NULL),(524,'Title24','Author24',NULL),(525,'Title25','Author25',NULL),(526,'Title26','Author26',NULL),(527,'Title27','Author27',NULL),(528,'Title28','Author28',NULL),(529,'Title29','Author29',NULL),(530,'Title30','Author30',NULL),(531,'Title31','Author31',NULL),(532,'Title32','Author32',NULL),(533,'Title33','Author33',NULL),(534,'Title34','Author34',NULL),(535,'Title35','Author35',NULL),(536,'Title36','Author36',NULL),(537,'Title37','Author37',NULL),(538,'Title38','Author38',NULL),(539,'Title39','Author39',NULL),(540,'Title40','Author40',NULL),(541,'Title41','Author41',NULL),(542,'Title42','Author42',NULL),(543,'Title43','Author43',NULL),(544,'Title44','Author44',NULL),(545,'Title45','Author45',NULL),(546,'Title46','Author46',NULL),(547,'Title47','Author47',NULL),(548,'Title48','Author48',NULL),(549,'Title49','Author49',NULL),(550,'Title50','Author50',NULL),(551,'Title51','Author51',NULL),(552,'Title52','Author52',NULL),(553,'Title53','Author53',NULL),(554,'Title54','Author54',NULL),(555,'Title55','Author55',NULL),(556,'Title56','Author56',NULL),(557,'Title57','Author57',NULL),(558,'Title58','Author58',NULL),(559,'Title59','Author59',NULL),(560,'Title60','Author60',NULL),(561,'Title61','Author61',NULL),(562,'Title62','Author62',NULL),(563,'Title63','Author63',NULL),(564,'Title64','Author64',NULL),(565,'Title65','Author65',NULL),(566,'Title66','Author66',NULL),(567,'Title67','Author67',NULL),(568,'Title68','Author68',NULL),(569,'Title69','Author69',NULL),(570,'Title70','Author70',NULL),(571,'Title71','Author71',NULL),(572,'Title72','Author72',NULL),(573,'Title73','Author73',NULL),(574,'Title74','Author74',NULL),(575,'Title75','Author75',NULL),(576,'Title76','Author76',NULL),(577,'Title77','Author77',NULL),(578,'Title78','Author78',NULL),(579,'Title79','Author79',NULL),(580,'Title80','Author80',NULL),(581,'Title81','Author81',NULL),(582,'Title82','Author82',NULL),(583,'Title83','Author83',NULL),(584,'Title84','Author84',NULL),(585,'Title85','Author85',NULL),(586,'Title86','Author86',NULL),(587,'Title87','Author87',NULL),(588,'Title88','Author88',NULL),(589,'Title89','Author89',NULL),(590,'Title90','Author90',NULL),(591,'Title91','Author91',NULL),(592,'Title92','Author92',NULL),(593,'Title93','Author93',NULL),(594,'Title94','Author94',NULL),(595,'Title95','Author95',NULL),(596,'Title96','Author96',NULL),(597,'Title97','Author97',NULL),(598,'Title98','Author98',NULL),(599,'Title99','Author99',NULL),(600,'Title100','Author100',NULL);
/*!40000 ALTER TABLE `book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migration_versions` (
  `version` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
INSERT INTO `migration_versions` VALUES ('20200608214510','2020-06-08 21:51:16');
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reset_password_request`
--

DROP TABLE IF EXISTS `reset_password_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reset_password_request` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `hashed_token` varchar(64) DEFAULT NULL,
  `expires_at` datetime NOT NULL,
  `selector` varchar(45) DEFAULT NULL,
  `requested_at` datetime DEFAULT NULL,
  `reset_password_requestcol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reset_password_request`
--

LOCK TABLES `reset_password_request` WRITE;
/*!40000 ALTER TABLE `reset_password_request` DISABLE KEYS */;
INSERT INTO `reset_password_request` VALUES (4,405,'RhOCMExQtmOPKDTym4sAJOZn4sB3rHTAwWl+KaUqE88=','2020-06-11 01:10:53','tthZdT9oJSjxULIJxY1p','2020-06-11 00:10:53',NULL);
/*!40000 ALTER TABLE `reset_password_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_hash` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=461 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (305,'username1','user1@gmail.com','First1','Last1','$argon2id$v=19$m=65536,t=4,p=1$eS5rN21nNXBqL0NqTUhVeg$92AMdOzjG2NJkveoKdNZ1g0WH/mxYI6mclN+Eq2kTKw'),(306,'username2','user2@gmail.com','First2','Last2','$argon2id$v=19$m=65536,t=4,p=1$MFpjMWV5WUplSS5hNlNudg$QvBjdrRJR0UD62WGNGsJVFI8F68oCHGveCcx9PzQBWY'),(307,'username3','user3@gmail.com','First3','Last3','$argon2id$v=19$m=65536,t=4,p=1$TC9VVFUyVlpTVjdPTnVVQQ$DA7X0aTNW5BnQA4cIdsWV5uLLQS/QSLbXh+uGmtakyM'),(308,'username4','user4@gmail.com','First4','Last4','$argon2id$v=19$m=65536,t=4,p=1$SGV5S2pZSE1HUy9XUC4uMA$kso56T4Q8L2DE3ClxMV658F0ge9FY5M3JuCicQ9KXp8'),(309,'username5','user5@gmail.com','First5','Last5','$argon2id$v=19$m=65536,t=4,p=1$LngvSlVWMzlSaVRYN1VWcg$ojfJ6oHmA8vKXERE5kemtcZ8gq0QRFVCm1Xe/9XBnQc'),(310,'username6','user6@gmail.com','First6','Last6','$argon2id$v=19$m=65536,t=4,p=1$MGsyRXpBRko2MnFTWnppeA$CkOha4SBG4Ptb82bDdHRGJ6PHsRRo7dj0IITZUEKOP8'),(311,'username7','user7@gmail.com','First7','Last7','$argon2id$v=19$m=65536,t=4,p=1$VFNaUnlWbkJFbzYuT3FBLg$eTf8Oj4do3CWZfuIivEYRnT6p7YQfHDuKB4MMy0LpjE'),(312,'username8','user8@gmail.com','First8','Last8','$argon2id$v=19$m=65536,t=4,p=1$SUUvZ2JZc3FBNURGVWVqWg$os+qK+1IouyaBRQuxQIktFV7B27n/M64albCJGVWXfo'),(313,'username9','user9@gmail.com','First9','Last9','$argon2id$v=19$m=65536,t=4,p=1$cHdaOS9Ba2s2MmxxbURuaQ$4VaqFKQ4IvMSOMgnicQMODL7CBYh7jM5d0YAGIW0Dyw'),(314,'username10','user10@gmail.com','First10','Last10','$argon2id$v=19$m=65536,t=4,p=1$blJSTERWTnd3b2FEU2tOTw$U/zBFVKGpjIMXqQoeMyUDXb1JLJHp2VL1FG1+5I+SGM'),(315,'username11','user11@gmail.com','First11','Last11','$argon2id$v=19$m=65536,t=4,p=1$eWxvVUhJQk0vM1JqZjVWbA$+Ij4LfUVJRsP7XuHxD57LF7Zsv01+HIiwFXqKIG+bMs'),(316,'username12','user12@gmail.com','First12','Last12','$argon2id$v=19$m=65536,t=4,p=1$aWZsS0Q0S2JDckhnSU1MTw$3GlvxTRd+1TFo3qk8yhW5wUjaeEE3cAuKsJSKSnwaKU'),(317,'username13','user13@gmail.com','First13','Last13','$argon2id$v=19$m=65536,t=4,p=1$VTdMVi9lU2I4bXpsb3dLNQ$sfJFYCF7FEwO1B2q3Gq52dMO06OUWcQL9XZmgLTMQhk'),(318,'username14','user14@gmail.com','First14','Last14','$argon2id$v=19$m=65536,t=4,p=1$azFMVUNKNERRQ1daUXVmNg$2QQeb3pQOFapUyPoqsxtpTZ+yPxbt7vjizFwR6pxvPc'),(319,'username15','user15@gmail.com','First15','Last15','$argon2id$v=19$m=65536,t=4,p=1$UlkzaGxkbVdvRFlsajlMZg$ONqTF/9+SVKO/gwf+uCN23gv8RXAigD41Fz5+BbrVQE'),(320,'username16','user16@gmail.com','First16','Last16','$argon2id$v=19$m=65536,t=4,p=1$cUZFbUJGRUU1ZzJTRGgwbg$ybS22iEumlKWaIv0Vio3PsXk4ukjMA6muRkmm/Fc3fY'),(321,'username17','user17@gmail.com','First17','Last17','$argon2id$v=19$m=65536,t=4,p=1$M0IyV3J3bkREV2xobWg3eA$j2IgTGNW9hC/8H0bRrmg7sveYnAC48gUG3mATeMDVXo'),(322,'username18','user18@gmail.com','First18','Last18','$argon2id$v=19$m=65536,t=4,p=1$Vm9qbWRiZHprellSM1RoZA$4TibB4c+VYw4aK3tPflkxOzDNcNroZ0KgnnvQq9Zw60'),(323,'username19','user19@gmail.com','First19','Last19','$argon2id$v=19$m=65536,t=4,p=1$MHF6M2Z6ZE9xQVFha1EuMA$FGj9svlh2Ex9N3Mz7LGTVmlclDKQPVefJQGvw71c6gk'),(324,'username20','user20@gmail.com','First20','Last20','$argon2id$v=19$m=65536,t=4,p=1$Y04xakVvdnJwRUluU09FQg$KsunqKAM2TXGMFD7Pwy3TjN0kFEND9oA8i71zHvVINs'),(325,'username21','user21@gmail.com','First21','Last21','$argon2id$v=19$m=65536,t=4,p=1$eUdocTZnRFQ1NmFGZnFFTQ$b+3yp4kN/2BvxXZaHA5gM9fYcc8OOZLJgRxWaqPO5Q4'),(326,'username22','user22@gmail.com','First22','Last22','$argon2id$v=19$m=65536,t=4,p=1$a3VqUklPMklFMndwcmNvcQ$z/nE+aXqetBmWP6r77hGhoS9E5ilJtKcsDoVKgJjvuI'),(327,'username23','user23@gmail.com','First23','Last23','$argon2id$v=19$m=65536,t=4,p=1$WjkzQ09oRU9BRmZHdy4ybw$FmVDmZm11xfSFCYRvXZU+6xfAgeeiIsV4dJ7E4g9Sxs'),(328,'username24','user24@gmail.com','First24','Last24','$argon2id$v=19$m=65536,t=4,p=1$TmFXb1QyWjFudnBobUw1cw$batRusXRWVfInz5y4EXfTIH+I66qTjFfxUhLHz4FvTU'),(329,'username25','user25@gmail.com','First25','Last25','$argon2id$v=19$m=65536,t=4,p=1$RGFMN0JZVDdXOVQ2TU5kNg$IQL3iLwW1KpYRMFnaPV6xgHgFAIK4dlXIg/Mnmk5SA4'),(330,'username26','user26@gmail.com','First26','Last26','$argon2id$v=19$m=65536,t=4,p=1$MjJBbi5raHVtMy5Zdmxvdg$POKVkV8SpwugXRm5EmI8Jm3t5NvnHR8IDvLMCJxZMxI'),(331,'username27','user27@gmail.com','First27','Last27','$argon2id$v=19$m=65536,t=4,p=1$UkQ0NnJlMkZHU1pidi4zWg$CLQFk17Ame8jHixjDBE8UnIFFJU4mYMXRx1LJ49jJlU'),(332,'username28','user28@gmail.com','First28','Last28','$argon2id$v=19$m=65536,t=4,p=1$LzBNV2E4RGJiMGVHOWp2WA$6SrK8hCZc7T4r4zxoR/BnYtLEOD/4tzoTQQn8Xg+kvU'),(333,'username29','user29@gmail.com','First29','Last29','$argon2id$v=19$m=65536,t=4,p=1$OXlIbXRlQWdUL0RRc21Bag$e0J9pXDf1SMXnFO/gNxF+Gi7Su6+tKeYJtrtQ8UvGg0'),(334,'username30','user30@gmail.com','First30','Last30','$argon2id$v=19$m=65536,t=4,p=1$OUdyM1QveXFGRWxMaDdWag$cbSuwdzVctRTcMuL1v3ZM20J3U/uKWVuoa5uCz0mpUk'),(335,'username31','user31@gmail.com','First31','Last31','$argon2id$v=19$m=65536,t=4,p=1$RWRaZGxaN0dIZEYvak8uNQ$GxSHG4MYBGnVVMmW42FBn7bJ36jm/SqD8i2E4SLkMbk'),(336,'username32','user32@gmail.com','First32','Last32','$argon2id$v=19$m=65536,t=4,p=1$VVZWcTRqS2FZcVA2ZWd3WQ$KVkkmxDGpediDwqfClIzn0pxUgsIa+GFw0kdlCxHxZM'),(337,'username33','user33@gmail.com','First33','Last33','$argon2id$v=19$m=65536,t=4,p=1$bDZ0b3hqcGlaSDRTL0hETw$gsDVORWHiDEaOUVWQ8Eg10nG2Yb8mY74I6erYkI0DiM'),(338,'username34','user34@gmail.com','First34','Last34','$argon2id$v=19$m=65536,t=4,p=1$ZHJFS2xrZ1Z1dUt5YjVIeQ$KZI5yQXHnvQmnfGKMMiX6hQ5oMW+HoHkRigKkLpB8zI'),(339,'username35','user35@gmail.com','First35','Last35','$argon2id$v=19$m=65536,t=4,p=1$b0M1SEhBWThUVEdjLmROUw$Cbs1LVV4bnyuckcBsFBTavodhrGDc5rDV7hZGL9ZHxU'),(340,'username36','user36@gmail.com','First36','Last36','$argon2id$v=19$m=65536,t=4,p=1$YzBLUmRoTFlwenROM0l5TA$jf5EikrjeeZow0xGivTzDKCdsPsfZKFYC/h/D+LL9So'),(341,'username37','user37@gmail.com','First37','Last37','$argon2id$v=19$m=65536,t=4,p=1$WUtVcEppMEdjNjVLNVpISQ$nV1b+CBdqlvZjtkLyQNacexmv71QCiGikDQMghqU3Ag'),(342,'username38','user38@gmail.com','First38','Last38','$argon2id$v=19$m=65536,t=4,p=1$YWlaTjFMWHdtbTZzMy9ELw$p6KjTrP49BVwME4m+tIrBWeHbNg6oKtC4dP52xYkjOc'),(343,'username39','user39@gmail.com','First39','Last39','$argon2id$v=19$m=65536,t=4,p=1$OHRRYjFXcGpndFZHM096Ng$9K4vtIGnbGuZV7ybbUXKyjmjzsmW7O7FUe3SlZ5MB2U'),(344,'username40','user40@gmail.com','First40','Last40','$argon2id$v=19$m=65536,t=4,p=1$VlFaTHVHQkg0ODhmYVUwaw$tEzg2OFE5mSNbN8wv8hcu18uH9Vkh/RX5m2D/G3a72g'),(345,'username41','user41@gmail.com','First41','Last41','$argon2id$v=19$m=65536,t=4,p=1$dWNDTHMzRENqV0pqdnlrQw$+goiYhddTE8UkXcAx235kQgibx9T2BgG1Lv+Q6fYM0A'),(346,'username42','user42@gmail.com','First42','Last42','$argon2id$v=19$m=65536,t=4,p=1$REhRSk9GSU1FU2tkbWRiVQ$9UFbiwCDs4YCN+h1Ggoh82e8ujIcJmpKPn/u4UP3p+I'),(347,'username43','user43@gmail.com','First43','Last43','$argon2id$v=19$m=65536,t=4,p=1$U1lJVDhZU21lcjlTd0tBUA$t7Mcy0LRS6Y6iF6YeDQJjTMJyDwqUUgeTcwPibaA4LE'),(348,'username44','user44@gmail.com','First44','Last44','$argon2id$v=19$m=65536,t=4,p=1$ZkFqT2FaVWlReVZPSHVQaw$aGGyJWsTBD6e1E6V2TuQ9+SaMOIA8JO8MWG66Ha/XKU'),(349,'username45','user45@gmail.com','First45','Last45','$argon2id$v=19$m=65536,t=4,p=1$NDU5VXVyMWg2Ly4wZm0wTQ$JJqypAfcdTh4kzh/Et9UkZE1/3MqMTSLDQ7wHjzIg+g'),(350,'username46','user46@gmail.com','First46','Last46','$argon2id$v=19$m=65536,t=4,p=1$RDEvSC9KbEFFdmVTajZBZg$0BZnIIgXIhwVP/6X6Kodk/wGcoGnBt1FH/oR1OeWXBk'),(351,'username47','user47@gmail.com','First47','Last47','$argon2id$v=19$m=65536,t=4,p=1$WDNsSVhRR2padk9mVHh3Ug$yDDshXdmC8+Q4ITuTm41AGJEN+evbLv97vdUEF3UEWM'),(352,'username48','user48@gmail.com','First48','Last48','$argon2id$v=19$m=65536,t=4,p=1$TjdQL3Fuem9qL0xTTzlCag$dko/LzAsQmoLTT+rYWdSD3857jVrrY5Otsb+fmXUkGU'),(353,'username49','user49@gmail.com','First49','Last49','$argon2id$v=19$m=65536,t=4,p=1$ZWJCRlF0TUdKMVQwZm9YNw$VB2+OZyz4KdD2fRQnCqK83lHvA33uO6+Aljd1hFhn6g'),(354,'username50','user50@gmail.com','First50','Last50','$argon2id$v=19$m=65536,t=4,p=1$SDVuV1kzSkpaUEo2bS9oaA$i9WN4F1F8qw9Ns64yy1inTLWKcKegns7UP688CGpDtM'),(355,'username51','user51@gmail.com','First51','Last51','$argon2id$v=19$m=65536,t=4,p=1$aktEMXFXdU5Qc3h6Nk5mTQ$xYi79x6AjAW+cNKkk/wgT/G7dR3h+4ketRcb3xatA84'),(356,'username52','user52@gmail.com','First52','Last52','$argon2id$v=19$m=65536,t=4,p=1$bFBmQWh5WkExODMuODNEeA$2asmyhQdp8zNrcDietaBhzbjDCsjw3QhbuMTYNN88Is'),(357,'username53','user53@gmail.com','First53','Last53','$argon2id$v=19$m=65536,t=4,p=1$M3lnV0ptbzRLVnQ3c2E0VA$4DyMvRExEMiv3a0kf0uovAWfcQCedpfh9LB/Z2NSjPM'),(358,'username54','user54@gmail.com','First54','Last54','$argon2id$v=19$m=65536,t=4,p=1$aHVQSzJCb3RYYlZyYTlPeQ$DkzNyijslMBUcjoHGQzk2JHWWlHpdSpPnY79Je6W6+c'),(359,'username55','user55@gmail.com','First55','Last55','$argon2id$v=19$m=65536,t=4,p=1$YUM0OWlvUUcuY1dZSExNQQ$y1wYwqoUrqR51T9bQglagqsi8CHCqErqdqgt8g1LZdc'),(360,'username56','user56@gmail.com','First56','Last56','$argon2id$v=19$m=65536,t=4,p=1$U3VQQmcxY21rMHdVbHhSRw$7k58e6YaebR+smTbt2cMQYGmD/nh3vtHlNMsZDA2474'),(361,'username57','user57@gmail.com','First57','Last57','$argon2id$v=19$m=65536,t=4,p=1$OGZ0dXBrTEcxaGFkTXVGeQ$DEJOPpWVZTqtPNaSKS0nu8tOtp6VV964sDzY2/1HbJU'),(362,'username58','user58@gmail.com','First58','Last58','$argon2id$v=19$m=65536,t=4,p=1$RE90eUptcUtvYWFtZUFTaQ$WiTNcia8H846iMvgeWUjuDTNDUSCXF7bpytEWdnlgRQ'),(363,'username59','user59@gmail.com','First59','Last59','$argon2id$v=19$m=65536,t=4,p=1$YnVCekZCZnpSMGRTaERmNg$Cb0pWgYlD0850pJYWegJU1GL8JWLfOu+1EjzSlYp1ow'),(364,'username60','user60@gmail.com','First60','Last60','$argon2id$v=19$m=65536,t=4,p=1$czVITWdzc2lGeDhCZFlZRA$2r5rkxtRHcXzE0BSZJxX4Dh2oOz4GConQRradMzQ2Bs'),(365,'username61','user61@gmail.com','First61','Last61','$argon2id$v=19$m=65536,t=4,p=1$SjdhSnF2cWtvZTIweU8zRw$Dq17riuslH90gq5Sny2+DNxV8ftwBBvKuwFoU4riV+k'),(366,'username62','user62@gmail.com','First62','Last62','$argon2id$v=19$m=65536,t=4,p=1$bVpBdE9RMnp0YWx3dGFITw$t0KueoyCX+t6rWJjAlyVx+S7pTWQ8qvH3ic1fhFWvMU'),(367,'username63','user63@gmail.com','First63','Last63','$argon2id$v=19$m=65536,t=4,p=1$UC5jcUlIdGVkYTBTLnJjbA$vqrSizNCGKKpn5zj27R+4UMst/uh7TQMZA3pgLuZ9tw'),(368,'username64','user64@gmail.com','First64','Last64','$argon2id$v=19$m=65536,t=4,p=1$bWJqdlpDLzk1Z1VTOG1ZVg$FHAtb4l6BWTAvb+4BvB6mhg+JoWfvQ3ifP5dTKPMsTA'),(369,'username65','user65@gmail.com','First65','Last65','$argon2id$v=19$m=65536,t=4,p=1$dXF6SVRZM1JTbWxQMC5jQg$2oD1K4eHOvlMGzT7QW75vobDcgcarU13bPPlqbpjgPg'),(370,'username66','user66@gmail.com','First66','Last66','$argon2id$v=19$m=65536,t=4,p=1$aFF6aW5ieHpQUWc5RmlVTw$VsE80F8IcMS8BOvmGaSDY5gnCYCkSVaqXx4WK/9iiqk'),(371,'username67','user67@gmail.com','First67','Last67','$argon2id$v=19$m=65536,t=4,p=1$UUxrTHJGNzJ6RzNIVi9uNA$i2PYKGxcZqBeiXXmzNwQv44AZfLnk7oXZGR1SHKTHTM'),(372,'username68','user68@gmail.com','First68','Last68','$argon2id$v=19$m=65536,t=4,p=1$d0tTZkFyR014V2xwWFBoaw$bBZI+zlmhxlWTTj6Wwj0H2OjIiCMXovs9OpgnTiW1n4'),(373,'username69','user69@gmail.com','First69','Last69','$argon2id$v=19$m=65536,t=4,p=1$cGEvNUdVVzdwaUkuNGpFVw$xDxUJmjh/2QJGJ5xrBEykJRyG0vGKozwPPyyKlL0HsU'),(374,'username70','user70@gmail.com','First70','Last70','$argon2id$v=19$m=65536,t=4,p=1$SW5ocFYvbGpYYkFsYUFNSw$wd7t4focUjHuuGNPSSniSjV+MKeXqyCw3WoaIuLWZsM'),(375,'username71','user71@gmail.com','First71','Last71','$argon2id$v=19$m=65536,t=4,p=1$akVrQm52RW83VmI1cFYuSw$VucufjtL7bKRP1fU6CZXybG6JJTWS7KQMTaC8MNDM2A'),(376,'username72','user72@gmail.com','First72','Last72','$argon2id$v=19$m=65536,t=4,p=1$N3c3LkRXc2hUendiTm9Xdw$aqTOlXOBtUJgat7EW/VQ+vHGZTRQl/p5yGpgM1jxkA4'),(377,'username73','user73@gmail.com','First73','Last73','$argon2id$v=19$m=65536,t=4,p=1$Unc1QzJmNFFicTMyd0dGeA$V+gZTd4SW7drH9fwXZ0pClF1DlLxRRrHp/gXAs1t8OE'),(378,'username74','user74@gmail.com','First74','Last74','$argon2id$v=19$m=65536,t=4,p=1$UFo2c3NTaGlvd1BXNnUvMg$HUskIQwTTE+5dGY/TxRvAwkz0SbOC0KQPvpI1EXpkIk'),(379,'username75','user75@gmail.com','First75','Last75','$argon2id$v=19$m=65536,t=4,p=1$REhsVEF1ZjRYTnRmTXNHNg$KJ9kHQTvEN264bXRCN/POJaAE2WeKyZQ7prRNdMvOEs'),(380,'username76','user76@gmail.com','First76','Last76','$argon2id$v=19$m=65536,t=4,p=1$MG4yUDNTYXpMb1l0ZC4zWA$+tJN2yEwG4EAJXQECjLy6AW6h4v00fwOK9QasWWEU9U'),(381,'username77','user77@gmail.com','First77','Last77','$argon2id$v=19$m=65536,t=4,p=1$VEZwQmlmMVFhZTk3YzhuUA$hm5FLUL6dxsoeT/7yf8LWfLEd/aVjlo/eTdx0VQz4xw'),(382,'username78','user78@gmail.com','First78','Last78','$argon2id$v=19$m=65536,t=4,p=1$N3Y4NmZVeVBDRkNPYmFFUg$mbxhETUlru8wfs0EsDgLWS6oCINMlyqt7hASdRExAiE'),(383,'username79','user79@gmail.com','First79','Last79','$argon2id$v=19$m=65536,t=4,p=1$OFd3Zm5tazIzTk8vSFA1TA$mi72O5CRwQsNVFpWaLzFIsGKAAe5rasgsrCVzo8I17k'),(384,'username80','user80@gmail.com','First80','Last80','$argon2id$v=19$m=65536,t=4,p=1$YlNHeHdFZkp0QzlUREhQNQ$Y3JIDy1wwksqqe7qEPX3TiLokbexVYtLzMZISgr1PoI'),(385,'username81','user81@gmail.com','First81','Last81','$argon2id$v=19$m=65536,t=4,p=1$cVFwYS5pV05KalVDOTRBcg$xDUQ412iwK3mWruryXHC8cDvLOjZ4HV2u9tUHeR8kXI'),(386,'username82','user82@gmail.com','First82','Last82','$argon2id$v=19$m=65536,t=4,p=1$STJ6NjVhVU5QUFpGeTNiSQ$0kaFu0bE2NvFQMu5pLn438eAkCR+BVz/baWDGPqeNaE'),(387,'username83','user83@gmail.com','First83','Last83','$argon2id$v=19$m=65536,t=4,p=1$TFVYMmNiWmxtUVlPNmxoTg$LeVeNZJuVUsdhsAwcANkowRV7BtNB/KLTTHb/GpWwKQ'),(388,'username84','user84@gmail.com','First84','Last84','$argon2id$v=19$m=65536,t=4,p=1$MTFPSlZXeWxCZkhSUEQ4ag$IDZJbKcjCa0KW19P7XgLiqoRVOZ4tlWWxPO1EWzbIOw'),(389,'username85','user85@gmail.com','First85','Last85','$argon2id$v=19$m=65536,t=4,p=1$a1ZZNjl2M1kxcVgxYks1Qg$kUmKJNCzSDRcA/UCnFZSA9ZizezTwW9+iIPB8l9ZMlo'),(390,'username86','user86@gmail.com','First86','Last86','$argon2id$v=19$m=65536,t=4,p=1$S0ZUR0x3LmhlRFRQaTkwYg$+LzNOMqzqpIBpjG6p5kEOUcaiB8UbHrycANg8JG9GU0'),(391,'username87','user87@gmail.com','First87','Last87','$argon2id$v=19$m=65536,t=4,p=1$U0NZT3dXckRXWHdhcWlqUg$kaj8R7wI7lOX6/yBWonmfNwUKE7nY6pQ595V8Miii44'),(392,'username88','user88@gmail.com','First88','Last88','$argon2id$v=19$m=65536,t=4,p=1$Mm96U1kwZ00xVXVEWWUvTQ$ec02JxqVven6M8WAKfoSPabJoJOkPqiQvTHIhFm97TU'),(393,'username89','user89@gmail.com','First89','Last89','$argon2id$v=19$m=65536,t=4,p=1$TzVobXhMa2NDQlRqUkloUw$gToeoUT8KJpxTPsiryCdbzhF8BNAbUY7TzdD1tQmIKQ'),(394,'username90','user90@gmail.com','First90','Last90','$argon2id$v=19$m=65536,t=4,p=1$RTd3SDJIRHlaci5pSC9yMw$stQZsNHr++Tt7hLZIFF8PaZyDsf6muNcH5A/JOrQnLM'),(395,'username91','user91@gmail.com','First91','Last91','$argon2id$v=19$m=65536,t=4,p=1$UXNhUFhicUpMRDFkanQ3SQ$D689qtja4k0sgXuPEZR4rnOIp39BqMxxlLridK/vGtk'),(396,'username92','user92@gmail.com','First92','Last92','$argon2id$v=19$m=65536,t=4,p=1$SmdxMkZDTEJBS3JjVTJKZg$XH+K+kLyLMQlNb/0Y6pPbs+Q1rCtv0/g55buHuycYFI'),(397,'username93','user93@gmail.com','First93','Last93','$argon2id$v=19$m=65536,t=4,p=1$cm1CTmQxTzRjZ09MSFh6bw$IHZ0KcrmJUjKEwMyhnTcwJU5wbkb1uF+urDJAf4Ngig'),(398,'username94','user94@gmail.com','First94','Last94','$argon2id$v=19$m=65536,t=4,p=1$enFvaFcvME1kazVrbTVsSA$e23gfiGE2kXYcFOIPTLw/lovj+O8OjA9Sl9N6l89rpI'),(399,'username95','user95@gmail.com','First95','Last95','$argon2id$v=19$m=65536,t=4,p=1$dlBTQUE4eHVpQklETGh3eA$yE4oAXVyuK2GITikqiujEeTheHxzKXZU2RTCE51p8o4'),(400,'username96','user96@gmail.com','First96','Last96','$argon2id$v=19$m=65536,t=4,p=1$MjNSdVBScDRoZVhuMGdTQw$MLFpmaoflfg2eJrwLln/xGLgjfQ5TD2Cm9+lR0JZDX0'),(401,'username97','user97@gmail.com','First97','Last97','$argon2id$v=19$m=65536,t=4,p=1$Q1ZBVks1Ti83SHZrVWtSTQ$zHZd2BAB2tqjK2IkwPhXqkDy1pHhbl7UDkpmZ23x8gk'),(402,'username98','user98@gmail.com','First98','Last98','$argon2id$v=19$m=65536,t=4,p=1$Qmx2ay5nek9FUW5nenEvYw$il8bDt9yfJ4cb9FtBAjRB5pC8NiBWhKIj3wCzm6wVtA'),(403,'username99','user99@gmail.com','First99','Last99','$argon2id$v=19$m=65536,t=4,p=1$cG9tNGlleUF6cXh2ZDZzbA$1xAvTlU5CrCn0h0rQcJrFg4GWwSevfeuJKDvIwLm4AU'),(404,'username100','user100@gmail.com','First100','Last100','$argon2id$v=19$m=65536,t=4,p=1$VUNCSlZaRzJ0N080b0pzQQ$wuu1aBmKAkB/g3diaKDxnT/Y9hS5oxBxZprLLLJvwEM'),(405,'ramizouari','zouari.rami@yahoo.com','Rami','Zouari','$argon2id$v=19$m=65536,t=4,p=1$aXZOLjZKcXk3eTE1OU5wWA$aUavcYO+M4u4agbOyrre7awvV10F+qjCK6GxTcCUcGA'),(406,'ramizouari2','zouari.rami2@yahoo.com','Rami','Zouari','$argon2id$v=19$m=65536,t=4,p=1$eXlERThNRGFvRjRYSGl6NQ$cE6+nlyAroCUpWdYk5P75bBxtMabXz9EjzoRBmXwaWU'),(444,'rz','z.r@yahoo.com','Rami','Zouari','$argon2id$v=19$m=65536,t=4,p=1$QlNZYUVuUUJjZWRGcjJVeA$GUfD4Ohb8aiTxZ3BYWyei0D7o9zowro/H6SSwLnFUJY'),(445,'soussou','souha@zouari.yahoo.com','Souha','Zouari','$argon2id$v=19$m=65536,t=4,p=1$NEZYcE9ZS2wuTzZzLldiLg$n5UfEWBuv6/9iA7XGqLCIss956Q7oAbrRo2E3b5Gy+w'),(448,'narjes_kessentini','narjes.kessentini@yahoo.com','Narjes','Kessentini','$argon2id$v=19$m=65536,t=4,p=1$R0RRT2hvZk9vSW5xMmR0bg$0m5JwKcKyV7B92UHxkvIcrcEfkNgtlJPHKANyzt3wfw'),(458,'C','D@E','A','B','$argon2id$v=19$m=65536,t=4,p=1$Z2xJM283OUlCVnl6VEZPWg$bC6OzUD8z6zQ6rCde+X9X9Y8DhJ0kkDmBXErffNMHw0'),(460,'zr','zouari.rami@yahoo.fr','Rami','Zouari','$argon2id$v=19$m=65536,t=4,p=1$Y25JVWZMV1owOWgwRzFTWg$+ekX7p799yb1qdX8Ht21fxcRIxk+lCuToDp/b0L3tHk');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_book`
--

DROP TABLE IF EXISTS `user_book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_book` (
  `user_id` int NOT NULL,
  `book_id` int NOT NULL,
  PRIMARY KEY (`user_id`,`book_id`),
  KEY `IDX_B164EFF8A76ED395` (`user_id`),
  KEY `IDX_B164EFF816A2B381` (`book_id`),
  CONSTRAINT `FK_B164EFF816A2B381` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_B164EFF8A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_book`
--

LOCK TABLES `user_book` WRITE;
/*!40000 ALTER TABLE `user_book` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_followed_book`
--

DROP TABLE IF EXISTS `user_followed_book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_followed_book` (
  `user_id` int NOT NULL,
  `book_id` int NOT NULL,
  PRIMARY KEY (`user_id`,`book_id`),
  KEY `IDX_B164EFF8A76ED395` (`user_id`),
  KEY `IDX_B164EFF816A2B381` (`book_id`),
  CONSTRAINT `FK_B164EFF816A2B380` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_B164EFF8A76ED392` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_followed_book`
--

LOCK TABLES `user_followed_book` WRITE;
/*!40000 ALTER TABLE `user_followed_book` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_followed_book` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-11 12:11:49
