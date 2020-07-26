-- gxc55311.z_users definition

CREATE TABLE `z_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_phone` varchar(100) DEFAULT NULL,
  `user_address` varchar(100) DEFAULT NULL,
  `user_balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_username` (`user_username`)
) ENGINE=InnoDB AUTO_INCREMENT=1006 DEFAULT CHARSET=latin1;


-- gxc55311.z_admins definition

CREATE TABLE `z_admins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_phone` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`admin_id`),
  CONSTRAINT `z_admins_fk` FOREIGN KEY (`admin_id`) REFERENCES `z_users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1002 DEFAULT CHARSET=latin1;


-- gxc55311.z_candidates definition

CREATE TABLE `z_candidates` (
  `candidate_id` int(11) NOT NULL,
  `candidate_first_name` varchar(100) DEFAULT NULL,
  `candidate_last_name` varchar(100) DEFAULT NULL,
  `candidate_default_cv` varchar(1000) DEFAULT NULL,
  `candidate_category` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`candidate_id`),
  KEY `candidate_id_fk` (`candidate_id`),
  CONSTRAINT `candidate_id_fk` FOREIGN KEY (`candidate_id`) REFERENCES `z_users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- gxc55311.z_employers definition

CREATE TABLE `z_employers` (
  `employer_id` int(11) NOT NULL,
  `employer_name` varchar(100) DEFAULT NULL,
  `employer_description` varchar(1000) DEFAULT NULL,
  `employer_representative` varchar(100) DEFAULT NULL,
  `employer_category` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`employer_id`),
  KEY `employer_id_fk` (`employer_id`),
  CONSTRAINT `employer_id_fk` FOREIGN KEY (`employer_id`) REFERENCES `z_users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- gxc55311.z_job_categories definition

CREATE TABLE `z_job_categories` (
  `job_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_category_name` varchar(100) NOT NULL,
  `job_category_employer_id` int(11) NOT NULL,
  PRIMARY KEY (`job_category_id`),
  KEY `z_job_categories_fk` (`job_category_employer_id`),
  CONSTRAINT `z_job_categories_fk` FOREIGN KEY (`job_category_employer_id`) REFERENCES `z_employers` (`employer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=latin1;


-- gxc55311.z_jobs definition

CREATE TABLE `z_jobs` (
  `job_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_title` varchar(100) DEFAULT NULL,
  `job_location` varchar(100) DEFAULT NULL,
  `job_type` varchar(100) DEFAULT NULL,
  `job_description` varchar(1000) DEFAULT NULL,
  `job_status` varchar(100) DEFAULT NULL,
  `job_number_of_positions` int(10) unsigned DEFAULT NULL,
  `job_employer_id` int(11) NOT NULL,
  PRIMARY KEY (`job_id`),
  KEY `z_jobs_employer_id_fk` (`job_employer_id`),
  CONSTRAINT `z_jobs_employer_id_fk` FOREIGN KEY (`job_employer_id`) REFERENCES `z_employers` (`employer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1013 DEFAULT CHARSET=latin1;


-- gxc55311.z_z_jobs_z_job_categories definition

CREATE TABLE `z_z_jobs_z_job_categories` (
  `job_id` int(11) NOT NULL,
  `job_category_id` int(11) NOT NULL,
  UNIQUE KEY `job_job_category_un` (`job_id`,`job_category_id`),
  KEY `job_id_fk1` (`job_id`),
  KEY `job_category_id_fk2` (`job_category_id`),
  CONSTRAINT `job_category_id_fk2` FOREIGN KEY (`job_category_id`) REFERENCES `z_job_categories` (`job_category_id`),
  CONSTRAINT `job_id_fk1` FOREIGN KEY (`job_id`) REFERENCES `z_jobs` (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- gxc55311.z_payment_methods definition

CREATE TABLE `z_payment_methods` (
  `payment_method_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_method_user_id` int(11) NOT NULL,
  PRIMARY KEY (`payment_method_id`),
  KEY `z_payment_methods_fk` (`payment_method_user_id`),
  CONSTRAINT `z_payment_methods_fk` FOREIGN KEY (`payment_method_user_id`) REFERENCES `z_users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1036 DEFAULT CHARSET=latin1;


-- gxc55311.z_payments definition

CREATE TABLE `z_payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_amount` decimal(10,2) NOT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_method_id` int(11) NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `payment_method_id_fk` (`payment_method_id`),
  CONSTRAINT `payment_method_id_fk` FOREIGN KEY (`payment_method_id`) REFERENCES `z_payment_methods` (`payment_method_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=latin1;


-- gxc55311.z_applications definition

CREATE TABLE `z_applications` (
  `application_candidate_id` int(11) NOT NULL,
  `application_job_id` int(11) NOT NULL,
  `application_date` date NOT NULL,
  `application_cv` varchar(1000) DEFAULT NULL,
  `application_status` varchar(100) DEFAULT NULL,
  UNIQUE KEY `z_candidates_z_jobs_un` (`application_candidate_id`,`application_job_id`),
  KEY `candidate_id_fk_1` (`application_candidate_id`),
  KEY `job_id_fk_2` (`application_job_id`),
  CONSTRAINT `candidate_id_fk_1` FOREIGN KEY (`application_candidate_id`) REFERENCES `z_candidates` (`candidate_id`),
  CONSTRAINT `job_id_fk_2` FOREIGN KEY (`application_job_id`) REFERENCES `z_jobs` (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- gxc55311.z_credit_cards definition

CREATE TABLE `z_credit_cards` (
  `cc_payment_method_id` int(11) NOT NULL,
  `cc_number` char(16) DEFAULT NULL,
  `cc_type` varchar(100) DEFAULT NULL,
  `cc_holder_name` varchar(100) DEFAULT NULL,
  `cc_expiration_date` date DEFAULT NULL,
  `cc_cvv` char(3) DEFAULT NULL,
  PRIMARY KEY (`cc_payment_method_id`),
  KEY `cc_id_fk` (`cc_payment_method_id`),
  CONSTRAINT `z_credit_cards_fk` FOREIGN KEY (`cc_payment_method_id`) REFERENCES `z_payment_methods` (`payment_method_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- gxc55311.z_paps definition

CREATE TABLE `z_paps` (
  `pap_payment_method_id` int(11) NOT NULL,
  `pap_transit_number` mediumint(8) unsigned DEFAULT NULL,
  `pap_institution_number` smallint(5) unsigned DEFAULT NULL,
  `pap_account_number` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`pap_payment_method_id`),
  KEY `pap_id_fk` (`pap_payment_method_id`),
  CONSTRAINT `z_paps_fk` FOREIGN KEY (`pap_payment_method_id`) REFERENCES `z_payment_methods` (`payment_method_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;