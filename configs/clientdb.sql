
CREATE TABLE `clients` (
  `ID` smallint(6) NOT NULL AUTO_INCREMENT,
  `Sal` varchar(7),
  `FName` varchar(125),
  `Middle` varchar(125),
  `LName` varchar(125),	
  `Suffix` varchar(12),
  `Email` varchar(125),
  `Phone` varchar(125),
  `2Phone` varchar(125),
  `Orders` smallint(6),
  `Username` varchar(48),
  `password_id` smallint(6),
  `Created` DATE,
  PRIMARY KEY (`ID`)
 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `addresses` (
	`ID` SMALLINT(6) NOT NULL AUTO_INCREMENT,
	`Street1` VARCHAR(125),
	`Street2` VARCHAR(125),
	`City` VARCHAR(60),
	`State` VARCHAR(60),
	`ZIP` VARCHAR(11),
	`Country` VARCHAR(60),
	PRIMARY KEY (`ID`)
	
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `client_addresses` (
	`ID` SMALLINT(6) NOT NULL AUTO_INCREMENT,
	`client_id` SMALLINT(6),
	`address_id` SMALLINT(6),
	PRIMARY KEY (`ID`)
	
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `orders` (
	`ID` SMALLINT(6) NOT NULL AUTO_INCREMENT,
	`Created` DATE,
	`Shipped` DATE,
	`client_id` SMALLINT(6),
	`ship_address_id` SMALLINT(6),
	`bill_address_id` SMALLINT(6),
	`product_id` SMALLINT(6),
	PRIMARY KEY (`ID`)
	
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `client_addresses` ADD FOREIGN KEY (`client_id`) REFERENCES clients (`ID`) ON DELETE CASCADE;
ALTER TABLE `client_addresses` ADD FOREIGN KEY (`address_id`) REFERENCES addresses (`ID`) ON DELETE CASCADE;
ALTER TABLE `orders` ADD FOREIGN KEY (`client_id`) REFERENCES clients (`ID`) ON DELETE CASCADE;
ALTER TABLE `orders` ADD FOREIGN KEY (`ship_address_id`) REFERENCES addresses (`ID`);
ALTER TABLE `orders` ADD FOREIGN KEY (`bill_address_id`) REFERENCES addresses (`ID`);
// ALTER TABLE `orders` ADD FOREIGN KEY (`product_id`) REFERENCES images (`ID`);



