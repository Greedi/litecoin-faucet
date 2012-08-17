CREATE TABLE `litecoin`.`instaltc` (
`id` INT( 5 ) NOT NULL AUTO_INCREMENT ,
`ltcaddress` CHAR( 34 ) NOT NULL ,
`salt` CHAR( 10 ) NOT NULL ,
`url` CHAR( 64 ) NOT NULL ,
PRIMARY KEY ( `id` )
) ENGINE = MYISAM ;