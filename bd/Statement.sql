CREATE TABLE `floor_activities_comments` (
  `floor_activities_comments_id` int(11) NOT NULL AUTO_INCREMENT,
  `folio_id` int(11) NOT NULL,
  `date` int(10) DEFAULT NULL,
  `employee_id` int(3) DEFAULT NULL,
  `comments` text,
  PRIMARY KEY (`floor_activities_comments_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
