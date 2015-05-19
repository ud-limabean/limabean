#USDA Limabean Data Interface

## The project

### Toward a Better Bean: Improving genetic, genomic, breeding, and crop management resources for lima bean to benefit the Mid-Atlantic Region

- [Project Website ](http://sites.udel.edu/limabean)

## Code repository
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

-- populate from old
INSERT INTO `div_users` VALUES (8,'bmearns','4afe4118294e4c9a56d8c1c0dc10164359718246','2015-02-27 12:52:31','2015-02-27 12:52:31',NULL,'admin'),(9,'joeDoe','247e2f24a6294b309dd7a9b8bd8aa81f3deec467','2015-02-27 13:16:12','2015-03-12 16:29:43',NULL,'user'),(10,'randy','915da9dd49834219c0f266f29df845a515e7e156','2015-03-25 13:28:38','2015-03-25 13:28:38',NULL,'user'),(11,'tevans','f97f5d212a740588974d7dffed5dbe128d807458','2015-03-25 13:58:42','2015-03-25 13:58:42',NULL,'user'),(12,'joeKempista','f698c85144a961035aae5b827578ff91ec8f0f33','2015-03-27 10:43:50','2015-03-27 10:43:50',NULL,'user');/*!40000 ALTER TABLE `div_users` ENABLE KEYS */;

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

INSERT INTO `div_field_ownerships` VALUES (20,30,8),(21,31,8),(22,6,9),(23,48,8),(24,49,9),(25,2,10),(26,6,11),(27,6,11),(28,42,11),(29,5,12),(30,19,12),(31,31,9);


/* probably don't need this, since can keep div_lb_users and deleted div_users */
-- mysqldump -t -u limabean  -pUZ-mUN5lbt bbagbv2pilot div_users
COMMIT;
```
## Code references

Based on [CakePHP](http://www.cakephp.org) - The rapid development PHP framework
