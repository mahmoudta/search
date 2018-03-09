CREATE DATABASE  IF NOT EXISTS `search_db` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `search_db`;
-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: localhost    Database: search_db
-- ------------------------------------------------------
-- Server version	5.6.38

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
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents` (
  `R_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`R_id`),
  UNIQUE KEY `R_id_UNIQUE` (`R_id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
INSERT INTO `documents` VALUES (1,'data/doc1.html','THE TREE OF LIFE','\n    THE MASTER said:\n    ‘I have planted the Seed of a Tree,\n    It shall be strangely fed\n    With white dew and with red,\n    And the Gardeners shall be three--\n    Regret, Hope, Memory!’'),(2,'data/doc2.html','MUSIC ON CHRISTMAS MORNING','\n    MUSIC I love--but never strain\n    Could kindle raptures so divine,\n    So grief assuage, so conquer pain,\n    And rouse this pensive heart of mine--\n    As that we hear on Christmas morn,\n    Upon the wintry breezes borne.'),(3,'data/doc3.html','ZUDORA-(from \"Turns and Movies\")','\n  HERE on the pale beach, in the darkness;\n    With the full moon just to rise;\n    They sit alone, and look over the sea,\n    Or into each other\'s eyes. . .\n');
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invertedindex`
--

DROP TABLE IF EXISTS `invertedindex`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invertedindex` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(15) NOT NULL,
  `hits` int(11) DEFAULT '0',
  PRIMARY KEY (`word`),
  UNIQUE KEY `word_UNIQUE` (`word`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=317 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invertedindex`
--

LOCK TABLES `invertedindex` WRITE;
/*!40000 ALTER TABLE `invertedindex` DISABLE KEYS */;
INSERT INTO `invertedindex` VALUES (103,'1820',1),(5,'1841',1),(104,'1849',1),(223,'1889',1),(6,'1901',1),(224,'1973',1),(251,'across',1),(309,'act',1),(146,'ago',1),(222,'aiken',1),(232,'alone',1),(280,'always',1),(137,'angel',1),(30,'angels',2),(101,'anne',1),(71,'answered',1),(266,'anyway',1),(55,'appears',1),(257,'arm',1),(258,'around',1),(110,'assuage',1),(268,'awfully',1),(226,'beach',1),(80,'bear',1),(83,'beautiful',1),(134,'bids',1),(175,'birth',1),(193,'bleed',1),(203,'bless',1),(247,'blind',1),(215,'blood',1),(57,'blossom',1),(211,'bonds',1),(149,'born',1),(120,'borne',1),(128,'break',1),(35,'breatheth',1),(119,'breezes',1),(150,'bring',1),(24,'broke',1),(102,'bronte',1),(4,'buchanan',1),(77,'called',1),(136,'calls',1),(209,'captive',1),(314,'carnal',1),(174,'celebrate',1),(62,'certainly',1),(200,'christ',1),(99,'christmas',1),(185,'claim',1),(315,'cold',1),(184,'come',1),(245,'comes',1),(199,'confess',1),(111,'conquer',1),(221,'conrad',1),(33,'cried',1),(294,'dark',1),(122,'darkness',2),(82,'day',1),(157,'death',1),(132,'deep',1),(170,'delight',1),(304,'demurely',1),(283,'depressed',1),(191,'descends',1),(15,'dew',1),(46,'dim',1),(298,'disenchantment',1),(154,'dispel',1),(65,'divine',2),(287,'door',1),(130,'dreams',1),(279,'drowned',1),(201,'earned',1),(156,'earth',1),(124,'empire',1),(254,'even',1),(31,'eyes',2),(61,'fairer',1),(13,'fed',1),(76,'fit',1),(250,'fizzing',1),(172,'flocks',1),(79,'flower',1),(295,'flowing',1),(290,'footsteps',1),(277,'four',1),(197,'freed',1),(227,'full',1),(210,'galling',1),(17,'gardeners',1),(50,'gather',1),(214,'gave',1),(265,'get',1),(74,'given',2),(44,'gleam',1),(27,'glimmer',1),(143,'glorious',1),(176,'glory',1),(177,'god',1),(291,'going',1),(29,'gold',1),(179,'good',1),(28,'green',1),(67,'greenwood',1),(141,'greet',1),(109,'grief',1),(66,'grows',1),(64,'guard',1),(89,'hair',1),(242,'hand',1),(289,'hard',1),(301,'hate',1),(49,'hath',1),(255,'head',1),(115,'hear',1),(284,'hears',1),(58,'heart',2),(152,'heaven',1),(206,'heavenly',1),(253,'heed',1),(158,'hell',1),(164,'high',1),(178,'highest',1),(81,'hither',1),(297,'hollow',1),(204,'holy',1),(217,'home',1),(20,'hope',1),(126,'hours',1),(275,'husband',1),(316,'ice',1),(272,'impassive',1),(260,'instead',1),(142,'joy',1),(229,'just',1),(125,'keep',1),(107,'kindle',1),(169,'kindled',1),(133,'kindly',1),(183,'king',1),(274,'kissed',1),(311,'kisses',1),(278,'know',1),(56,'last',1),(240,'lazy',1),(216,'lead',1),(63,'leaves',1),(2,'life',1),(151,'light',1),(246,'like',1),(38,'lips',1),(159,'listening',1),(45,'little',1),(34,'liveth',1),(145,'long',1),(233,'look',1),(41,'looks',1),(148,'lord',1),(105,'love',1),(302,'loved',1),(243,'lovely',1),(303,'lowers',1),(7,'master',1),(69,'may',2),(21,'memory',1),(180,'men',1),(308,'might',1),(54,'mighty',1),(47,'million',1),(68,'mine',2),(228,'moon',1),(116,'morn',1),(100,'morning',1),(26,'mould',1),(220,'movies',1),(98,'music',1),(70,'name',1),(90,'never',2),(310,'nice',1),(173,'night',2),(73,'nourish',1),(198,'now',1),(248,'old',1),(39,'open',2),(188,'overthrown',1),(196,'paid',1),(112,'pain',1),(225,'pale',1),(236,'parasol',1),(127,'pass',1),(312,'passionately',1),(252,'pays',1),(181,'peace',1),(114,'pensive',1),(92,'perish',1),(9,'planted',1),(94,'pluck',1),(235,'pokes',1),(187,'power',1),(153,'powers',1),(25,'presently',1),(195,'price',1),(305,'prods',1),(161,'raptured',1),(108,'raptures',1),(16,'red',1),(213,'redeemer',1),(147,'redeeming',1),(19,'regret',1),(140,'rejoice',1),(194,'renounce',1),(155,'rescue',1),(271,'resist',1),(167,'resounding',1),(202,'right',1),(230,'rise',1),(212,'riven',1),(3,'robert',1),(113,'rouse',1),(160,'sacred',1),(8,'said',1),(238,'sand',1),(186,'satan',1),(182,'saviour',1),(244,'says',1),(234,'sea',1),(36,'see',1),(10,'seed',1),(91,'seedless',1),(165,'seem',1),(75,'seemeth',1),(296,'sees',1),(23,'set',1),(11,'shall',2),(59,'shed',1),(306,'shell',1),(288,'shut',1),(299,'sick',1),(281,'sickly',1),(42,'side',1),(239,'sifts',1),(190,'sinful',1),(263,'sing',1),(189,'sinless',1),(231,'sit',1),(261,'sketch',1),(168,'sky',1),(237,'sleepy',1),(256,'slides',1),(131,'slumbers',1),(205,'smile',1),(22,'smiled',1),(52,'smiles',1),(86,'snatch',1),(163,'soars',1),(37,'soft',1),(84,'son',1),(166,'songs',2),(282,'soon',1),(285,'sound',1),(162,'spirit',1),(78,'spiritus',1),(249,'spotlight',1),(208,'spring',1),(286,'stateroom',1),(293,'steadily',1),(123,'still',2),(106,'strain',1),(43,'strange',1),(12,'strangely',1),(85,'stray',1),(273,'submits',1),(192,'suffer',1),(267,'suit',1),(300,'surprise',1),(264,'swell',1),(292,'swiftly',1),(53,'tears',1),(313,'thinks',1),(121,'though',1),(18,'three',1),(72,'thus',1),(96,'till',1),(60,'tis',1),(262,'together',1),(1,'tree',1),(129,'troubled',1),(207,'truth',1),(270,'turn',1),(219,'turns',1),(87,'unaware',1),(117,'upon',1),(138,'voice',1),(259,'waist',1),(135,'wake',1),(171,'watched',1),(95,'wear',1),(144,'welcomed',1),(269,'well',1),(32,'wet',1),(14,'white',1),(241,'whiteness',1),(40,'wide',1),(93,'will',3),(118,'wintry',1),(97,'withers',1),(51,'world',2),(139,'worship',1),(88,'wreath',1),(276,'wrote',1),(48,'years',1),(307,'yes',1),(218,'zudora',1);
/*!40000 ALTER TABLE `invertedindex` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postingfile`
--

DROP TABLE IF EXISTS `postingfile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `postingfile` (
  `fileid` int(11) DEFAULT NULL,
  `hits` int(11) DEFAULT NULL,
  `wordid` int(11) DEFAULT '-1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postingfile`
--

LOCK TABLES `postingfile` WRITE;
/*!40000 ALTER TABLE `postingfile` DISABLE KEYS */;
INSERT INTO `postingfile` VALUES (1,9,1),(1,1,2),(1,1,3),(1,1,4),(1,1,5),(1,1,6),(1,9,7),(1,4,8),(1,1,9),(1,4,10),(1,8,11),(2,1,11),(1,1,12),(1,2,13),(1,1,14),(1,1,15),(1,2,16),(1,1,17),(1,1,18),(1,2,19),(1,2,20),(1,2,21),(1,3,22),(1,2,23),(1,1,24),(1,1,25),(1,1,26),(1,1,27),(1,1,28),(1,1,29),(1,3,30),(2,1,30),(1,2,31),(3,3,31),(1,1,32),(1,2,33),(1,1,34),(1,1,35),(1,2,36),(1,1,37),(1,1,38),(1,1,39),(2,1,39),(1,1,40),(1,1,41),(1,2,42),(1,1,43),(1,1,44),(1,1,45),(1,1,46),(1,1,47),(1,1,48),(1,1,49),(1,1,50),(1,1,51),(2,1,51),(1,1,52),(1,2,53),(1,1,54),(1,1,55),(1,2,56),(1,6,57),(1,1,58),(2,1,58),(1,1,59),(1,1,60),(1,1,61),(1,1,62),(1,1,63),(1,1,64),(1,1,65),(2,2,65),(1,1,66),(1,1,67),(1,1,68),(2,1,68),(1,1,69),(2,1,69),(1,2,70),(1,1,71),(1,1,72),(1,1,73),(1,1,74),(2,1,74),(1,1,75),(1,1,76),(1,1,77),(1,1,78),(1,3,79),(1,2,80),(1,1,81),(1,1,82),(1,1,83),(1,2,84),(1,1,85),(1,1,86),(1,1,87),(1,1,88),(1,2,89),(1,1,90),(2,1,90),(1,1,91),(1,1,92),(1,1,93),(2,2,93),(3,2,93),(1,1,94),(1,1,95),(1,1,96),(1,1,97),(2,3,98),(2,2,99),(2,2,100),(2,1,101),(2,1,102),(2,1,103),(2,1,104),(2,1,105),(2,2,106),(2,1,107),(2,1,108),(2,1,109),(2,1,110),(2,1,111),(2,1,112),(2,1,113),(2,1,114),(2,2,115),(2,2,116),(2,1,117),(2,1,118),(2,1,119),(2,1,120),(2,1,121),(2,2,122),(3,1,122),(2,1,123),(3,1,123),(2,2,124),(2,1,125),(2,1,126),(2,1,127),(2,1,128),(2,1,129),(2,1,130),(2,1,131),(2,1,132),(2,1,133),(2,1,134),(2,2,135),(2,1,136),(2,1,137),(2,1,138),(2,1,139),(2,1,140),(2,1,141),(2,1,142),(2,1,143),(2,1,144),(2,1,145),(2,1,146),(2,1,147),(2,1,148),(2,1,149),(2,1,150),(2,1,151),(2,3,152),(2,1,153),(2,1,154),(2,1,155),(2,3,156),(2,1,157),(2,2,158),(2,1,159),(2,1,160),(2,1,161),(2,1,162),(2,1,163),(2,1,164),(2,1,165),(2,1,166),(3,1,166),(2,1,167),(2,1,168),(2,1,169),(2,1,170),(2,1,171),(2,1,172),(2,1,173),(3,1,173),(2,1,174),(2,1,175),(2,1,176),(2,4,177),(2,1,178),(2,1,179),(2,3,180),(2,2,181),(2,1,182),(2,2,183),(2,1,184),(2,1,185),(2,2,186),(2,1,187),(2,1,188),(2,1,189),(2,1,190),(2,1,191),(2,1,192),(2,1,193),(2,1,194),(2,1,195),(2,1,196),(2,1,197),(2,2,198),(2,1,199),(2,1,200),(2,1,201),(2,1,202),(2,1,203),(2,1,204),(2,1,205),(2,1,206),(2,1,207),(2,1,208),(2,1,209),(2,1,210),(2,1,211),(2,1,212),(2,1,213),(2,1,214),(2,1,215),(2,1,216),(2,1,217),(3,1,218),(3,2,219),(3,1,220),(3,1,221),(3,1,222),(3,1,223),(3,1,224),(3,1,225),(3,1,226),(3,1,227),(3,2,228),(3,2,229),(3,1,230),(3,1,231),(3,1,232),(3,1,233),(3,4,234),(3,1,235),(3,1,236),(3,1,237),(3,1,238),(3,1,239),(3,1,240),(3,1,241),(3,1,242),(3,1,243),(3,1,244),(3,1,245),(3,1,246),(3,1,247),(3,1,248),(3,1,249),(3,1,250),(3,1,251),(3,1,252),(3,1,253),(3,1,254),(3,1,255),(3,1,256),(3,1,257),(3,1,258),(3,1,259),(3,1,260),(3,1,261),(3,2,262),(3,1,263),(3,1,264),(3,1,265),(3,1,266),(3,1,267),(3,1,268),(3,2,269),(3,1,270),(3,1,271),(3,1,272),(3,1,273),(3,1,274),(3,2,275),(3,1,276),(3,1,277),(3,1,278),(3,1,279),(3,1,280),(3,1,281),(3,1,282),(3,1,283),(3,2,284),(3,1,285),(3,1,286),(3,1,287),(3,1,288),(3,1,289),(3,1,290),(3,1,291),(3,1,292),(3,1,293),(3,2,294),(3,2,295),(3,1,296),(3,1,297),(3,1,298),(3,1,299),(3,1,300),(3,1,301),(3,1,302),(3,1,303),(3,1,304),(3,1,305),(3,1,306),(3,1,307),(3,1,308),(3,1,309),(3,1,310),(3,1,311),(3,1,312),(3,1,313),(3,1,314),(3,1,315),(3,1,316);
/*!40000 ALTER TABLE `postingfile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('admin','admin');
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

-- Dump completed on 2018-03-09 19:23:43
