-- --------------------------------------------------------
-- Host                          :127.0.0.1
-- Server version                :5.5.25 - MySQL Community Server (GPL)
-- Server OS                     :Win32
-- HeidiSQL Version              :7.0.0.4259
-- Created                       :2013-03-20 18:48:00
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table hackerspace.members
DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `JoinDate` date DEFAULT NULL,
  `FirstName` varchar(245) DEFAULT NULL,
  `LastName` varchar(245) DEFAULT NULL,
  `MemberType` varchar(45) DEFAULT NULL,
  `email` varchar(245) DEFAULT NULL,
  `Phone` varchar(45) DEFAULT NULL,
  `Notes` longtext,
  `Active` int(10) unsigned NOT NULL DEFAULT '0',
  `Deleted` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table hackerspace.members: 4 rows
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` (`ID`, `JoinDate`, `FirstName`, `LastName`, `MemberType`, `email`, `Phone`, `Notes`, `Active`, `Deleted`) VALUES
	(1, '2013-03-20', 'Ekim Emre', 'Yardımlı', 'Founding Member', 'kunfukedisi@gmail.com', ' 886', 'testing', 1, 0),
	(2, '2013-03-20', '', '', 'Founder', '', '', '', 0, 1),
	(3, '2013-02-01', 'Melinda', '', 'Guest', '', '', 'Came once only', 0, 0),
	(4, '2013-01-01', 'Fishing', 'Jack', 'Member', 'jack@jack.com', '1234567890', 'no notes here yet...', 0, 0),
	(5, '2013-03-01', 'John', 'Doe', 'Founder', 'john@doe.com', '', '', 1, 0);
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
