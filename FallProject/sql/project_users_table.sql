CREATE TABLE if not exists `Users`(
	`ID` int(11) AUTO_INCREMENT NOT NULL,
	`username` varchar(30) NOT NULL UNIQUE,
	`password` varchar(60) NOT NULL,
	PRIMARY KEY (`ID`)
	) CHARACTER SET utf8 COLLATE utf8_general_ci
