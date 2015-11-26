CREATE TABLE `floor_activities_comments` (
  `floor_activities_comments_id` int(11) NOT NULL AUTO_INCREMENT,
  `folio_id` int(11) NOT NULL,
  `date` int(10) DEFAULT NULL,
  `employee_id` int(3) DEFAULT NULL,
  `comments` text,
  PRIMARY KEY (`floor_activities_comments_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

CREATE TABLE `floor_activities_folio` (
  `floor_activities_folio_id` int(11) NOT NULL AUTO_INCREMENT,
  `folio_id` int(11) NOT NULL,
  `leader_employee_id` int(3) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `priority` int(2) DEFAULT '1',
  `time_start` int(12) DEFAULT NULL,
  `time_end` int(12) DEFAULT NULL,
  PRIMARY KEY (`floor_activities_folio_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

CREATE TABLE `sistema_gascomb`.`floor_activities_timecontrol` (
  `floor_activities_timecontrol_id` INT NOT NULL AUTO_INCREMENT,
  `folio_id` INT NULL,
  `employee_id` INT NULL,
  `time` INT(12) NULL,
  `code` VARCHAR(100) NULL,
  `comments` TEXT NULL,
  PRIMARY KEY (`floor_activities_timecontrol_id`));

CREATE TABLE `sistema_gascomb`.`floor_activities_employees` (
  `floor_activities_employees_id` INT NOT NULL AUTO_INCREMENT,
  `folio_id` INT NOT NULL,
  `employee_id` INT NOT NULL,
  `status` INT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`floor_activities_employees_id`));

CREATE TABLE `sistema_gascomb`.`floor_activities_details_control` (
  `floor_activities_details_control_id` INT NOT NULL AUTO_INCREMENT,
  `folio_id` INT NULL,
  `floor_activity_id` INT NULL,
  `employee_id` INT NULL,
  `status` INT(1) NOT NULL DEFAULT 0,
  `time_start` int(12) DEFAULT NULL,
  `comments_id` INT NULL,
  PRIMARY KEY (`floor_activities_details_control_id`));

CREATE TABLE `sistema_gascomb`.`floor_activities_extensions` (
  `floor_activities_extensions_id` INT(11) NOT NULL AUTO_INCREMENT,
  `extensions_comments` TEXT NOT NULL,
  `status` INT(1) NOT NULL,
  `date_request` INT(12) NULL DEFAULT NULL,
  `approval_date` INT(12) NULL DEFAULT NULL,
  `applicant_employee` INT(3) NULL DEFAULT NULL,
  `employee_responsible` INT(3) NULL DEFAULT NULL,
  `responsible_agency` TEXT NULL,
  PRIMARY KEY (`floor_activities_extensions_id`));


