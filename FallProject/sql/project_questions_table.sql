CREATE TABLE if not exists `Questions`(
	`ID` int AUTO_INCREMENT NOT NULL,
	`Question` text NOT NULL,
	`OptionA` varchar(255) NOT NULL,
	`OptionB` varchar(255) NOT NULL,
	`VotedA` int(11) NOT NULL DEFAULT '1',
	`VotedB` int(11) NOT NULL DEFAULT '1',
	PRIMARY KEY(`ID`)
	) CHARACTER SET utf8 COLLATE utf8_general_ci;

INSERT INTO `Questions` (`ID`, `Question`, `OptionA`, `OptionB`, `VotedA`, `VotedB`) VALUES(1, 'Do you like cereal?', 'Yes', 'No', 1, 1);
