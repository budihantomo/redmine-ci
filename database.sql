SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `groups` (
  `id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `group_users` (
  `group_id` int(1) unsigned NOT NULL,
  `user_id` int(1) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `permissions` (
  `id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `permission` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `permissions` (`id`, `permission`) VALUES
(1, 'add_project'),
(2, 'edit_project');

CREATE TABLE `projects` (
  `id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(1) unsigned DEFAULT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_public` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `date_created` datetime NOT NULL,
  `date_updated` datetime DEFAULT NULL,
  `identifier` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `roles` (
  `id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Manager'),
(2, 'Developer'),
(3, 'Reporter');

CREATE TABLE `roles_permissions` (
  `role_id` int(1) unsigned NOT NULL,
  `permission_id` int(1) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `settings` (
  `setting` varchar(255) NOT NULL,
  `value` text,
  `updated_on` datetime DEFAULT NULL,
  PRIMARY KEY (`setting`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `settings` (`setting`, `value`, `updated_on`) VALUES
('login_required', '0', '2011-10-12 12:00:00');

CREATE TABLE `users` (
  `id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(30) DEFAULT NULL,
  `hashed_password` char(40) DEFAULT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `email_notification` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_admin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `status` int(1) unsigned NOT NULL DEFAULT '1',
  `last_login_on` datetime DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `login`, `hashed_password`, `firstname`, `lastname`, `email`, `email_notification`, `is_admin`, `status`, `last_login_on`, `created_on`, `updated_on`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Redmine-CI', 'Admin', 'admin@example.net', 1, 1, 1, NULL, '2011-10-12 12:00:00', NULL);
