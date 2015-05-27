#USDA Limabean Data Interface

## The project

#### Toward a Better Bean: Improving genetic, genomic, breeding, and crop management resources for lima bean to benefit the Mid-Atlantic Region

- [Project Website ](http://sites.udel.edu/limabean)

## Common locations for modificiation
- you will generally be configuring files under the app directory of limabean (production) or limabean-dev (development): /var/www/html/limabean/app, and /var/www/html/limabean-dev/app.  Paths below are relative to this location.
- Model, View, and Controller files are stored in their respective ./Model, ./View, and ./Controller directories
- Front-end files (images, javascript, css, etc.) are under: ./webroot
- Database configuration: ./Config/database.php
- The main URL path configuration file is at: ./Config/routes.php
- Other URL path-foo is in the respective controller file (under ./Controller), or the main controller file: ./Controller/AppController.php (for authenticated), and for non-authenticated (splash page) ./Controller/AppNoAuthController.php
- Main files related to Tom Evan's model: 
-- ./Controller/FieldsController.php::risk() (~line 98)
-- ./View/Fields/risk.ctp
-- ./Model/risk.php (this is where you should start to modify if you are bringing in additional fields from a new data source, like json)

## Database
- The production version of this code runs from an instance of the PANZEA-modified database schema
- The production database is part of the [Maize ATLAS project](http://maizeatlas.org/database.php), specifically referred to as AccreteGB
- The following query modifications were run to enable the Limabean Data Interface on AccreteGB
```SQL
START TRANSACTION;
-- add new id to div_statistic_type.  We are assuming this is 2, autoincrementing from preivous (1)
INSERT INTO `div_statistic_type` (stat_type)
VALUES ('average');

-- add compound unique constraint so that "insert ignore", below, does not produce duplicates

ALTER TABLE div_measurement ADD UNIQUE(`div_field_id`,`div_measurement_parameter_id`,`div_statistic_type_id`,`tom`);

-- insert aggregate values, skips duplicates
INSERT IGNORE INTO `div_measurement`
(`div_obs_unit_id`,`div_field_id`,`div_measurement_parameter_id`, `div_statistic_type_id`, `tom`, `value`)
SELECT `div_obs_unit_id`,`div_field_id`,`div_measurement_parameter_id`, 2 as `div_statistic_type_id`, MIN(`tom`) AS `tom`, AVG(`value`) as value
FROM `div_measurement`
WHERE `div_statistic_type_id` IS NULL
GROUP BY `div_obs_unit_id`, `div_field_id`, `div_measurement_parameter_id`, MONTH(`tom`), YEAR(`tom`);


-- would like to replace it with this. I would be willing to change column names to fit your convention.
DROP TABLE div_users;

CREATE TABLE `div_users` (
  `div_users_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `div_users_acc` int(11) DEFAULT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`div_users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- join table for a many to many relationship between user and field
CREATE TABLE `div_field_ownerships` (
  `div_field_ownerships_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `div_field_id` int(10) unsigned NOT NULL,
  `div_users_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`div_field_ownerships_id`),
  KEY `div_field_id` (`div_field_id`),
  KEY `div_users_id` (`div_users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

ALTER TABLE div_field_ownerships 
ADD CONSTRAINT `field_ownerships_ibfk_1` 
FOREIGN KEY (`div_field_id`) 
REFERENCES `div_field` (`div_field_id`);


ALTER TABLE div_field_ownerships 
ADD CONSTRAINT `field_ownerships_ibfk_2` 
FOREIGN KEY (`div_users_id`) 
REFERENCES `div_users` (`div_users_id`);

COMMIT;
```
## Code references

Based on [CakePHP](http://www.cakephp.org) - The rapid development PHP framework
