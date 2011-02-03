/*
SQLyog Community Edition- MySQL GUI v8.03 
MySQL - 5.1.41 : Database - trackstar
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `authassignment` */

DROP TABLE IF EXISTS `authassignment`;

CREATE TABLE `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`),
  CONSTRAINT `FK_itemname_authitem` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `authassignment` */

insert  into `authassignment`(`itemname`,`userid`,`bizrule`,`data`) values ('admin','1',NULL,'N;');
insert  into `authassignment`(`itemname`,`userid`,`bizrule`,`data`) values ('member','2','return isset($params[\"project\"]) && $params[\"project\"]->isUserInRole(\"member\");','N;');

/*Table structure for table `authitem` */

DROP TABLE IF EXISTS `authitem`;

CREATE TABLE `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  `update_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `authitem` */

insert  into `authitem`(`name`,`type`,`description`,`bizrule`,`data`,`update_user_id`) values ('admin',2,'',NULL,'N;',NULL);
insert  into `authitem`(`name`,`type`,`description`,`bizrule`,`data`,`update_user_id`) values ('adminManagement',1,'access to the application administration functionality',NULL,'N;',NULL);
insert  into `authitem`(`name`,`type`,`description`,`bizrule`,`data`,`update_user_id`) values ('createIssue',0,'create a new issue',NULL,'N;',NULL);
insert  into `authitem`(`name`,`type`,`description`,`bizrule`,`data`,`update_user_id`) values ('createProject',0,'create a new project',NULL,'N;',NULL);
insert  into `authitem`(`name`,`type`,`description`,`bizrule`,`data`,`update_user_id`) values ('createUser',0,'create a new user',NULL,'N;',NULL);
insert  into `authitem`(`name`,`type`,`description`,`bizrule`,`data`,`update_user_id`) values ('deleteIssue',0,'delete an issue from a project',NULL,'N;',NULL);
insert  into `authitem`(`name`,`type`,`description`,`bizrule`,`data`,`update_user_id`) values ('deleteProject',0,'delete a pro-ject',NULL,'N;',NULL);
insert  into `authitem`(`name`,`type`,`description`,`bizrule`,`data`,`update_user_id`) values ('deleteUser',0,'remove a user from a project',NULL,'N;',NULL);
insert  into `authitem`(`name`,`type`,`description`,`bizrule`,`data`,`update_user_id`) values ('member',2,'',NULL,'N;',NULL);
insert  into `authitem`(`name`,`type`,`description`,`bizrule`,`data`,`update_user_id`) values ('owner',2,'',NULL,'N;',NULL);
insert  into `authitem`(`name`,`type`,`description`,`bizrule`,`data`,`update_user_id`) values ('reader',2,'',NULL,'N;',NULL);
insert  into `authitem`(`name`,`type`,`description`,`bizrule`,`data`,`update_user_id`) values ('readIssue',0,'read issue information',NULL,'N;',NULL);
insert  into `authitem`(`name`,`type`,`description`,`bizrule`,`data`,`update_user_id`) values ('readProject',0,'read project information',NULL,'N;',NULL);
insert  into `authitem`(`name`,`type`,`description`,`bizrule`,`data`,`update_user_id`) values ('readUser',0,'read user profile information',NULL,'N;',NULL);
insert  into `authitem`(`name`,`type`,`description`,`bizrule`,`data`,`update_user_id`) values ('updateIssue',0,'update issue information',NULL,'N;',NULL);
insert  into `authitem`(`name`,`type`,`description`,`bizrule`,`data`,`update_user_id`) values ('updateProject',0,'update project information',NULL,'N;',NULL);
insert  into `authitem`(`name`,`type`,`description`,`bizrule`,`data`,`update_user_id`) values ('updateUser',0,'update a users information',NULL,'N;',NULL);

/*Table structure for table `authitemchild` */

DROP TABLE IF EXISTS `authitemchild`;

CREATE TABLE `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `FK_child_authitem` (`child`),
  CONSTRAINT `FK_child_authitem` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_parent_authitem` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `authitemchild` */

insert  into `authitemchild`(`parent`,`child`) values ('admin','adminManagement');
insert  into `authitemchild`(`parent`,`child`) values ('member','createIssue');
insert  into `authitemchild`(`parent`,`child`) values ('owner','createProject');
insert  into `authitemchild`(`parent`,`child`) values ('owner','createUser');
insert  into `authitemchild`(`parent`,`child`) values ('member','deleteIssue');
insert  into `authitemchild`(`parent`,`child`) values ('owner','deleteProject');
insert  into `authitemchild`(`parent`,`child`) values ('owner','deleteUser');
insert  into `authitemchild`(`parent`,`child`) values ('admin','member');
insert  into `authitemchild`(`parent`,`child`) values ('owner','member');
insert  into `authitemchild`(`parent`,`child`) values ('admin','owner');
insert  into `authitemchild`(`parent`,`child`) values ('admin','reader');
insert  into `authitemchild`(`parent`,`child`) values ('member','reader');
insert  into `authitemchild`(`parent`,`child`) values ('owner','reader');
insert  into `authitemchild`(`parent`,`child`) values ('reader','readIssue');
insert  into `authitemchild`(`parent`,`child`) values ('reader','readProject');
insert  into `authitemchild`(`parent`,`child`) values ('reader','readUser');
insert  into `authitemchild`(`parent`,`child`) values ('member','updateIssue');
insert  into `authitemchild`(`parent`,`child`) values ('owner','updateProject');
insert  into `authitemchild`(`parent`,`child`) values ('owner','updateUser');

/*Table structure for table `tbl_column` */

DROP TABLE IF EXISTS `tbl_column`;

CREATE TABLE `tbl_column` (
  `column_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`column_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_column` */

insert  into `tbl_column`(`column_id`,`name`) values (1,'New');
insert  into `tbl_column`(`column_id`,`name`) values (2,'In progress');
insert  into `tbl_column`(`column_id`,`name`) values (3,'To be verified');
insert  into `tbl_column`(`column_id`,`name`) values (4,'Done');

/*Table structure for table `tbl_comment` */

DROP TABLE IF EXISTS `tbl_comment`;

CREATE TABLE `tbl_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `issue_id` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comment_issue` (`issue_id`),
  KEY `FK_comment_author` (`create_user_id`),
  CONSTRAINT `FK_comment_author` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_comment_issue` FOREIGN KEY (`issue_id`) REFERENCES `tbl_issue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_comment` */

insert  into `tbl_comment`(`id`,`content`,`issue_id`,`create_time`,`create_user_id`,`update_time`,`update_user_id`) values (1,'de merge vao master cai da\r\n',2,'2011-01-27 23:10:42',1,'2011-01-27 23:10:42',1);

/*Table structure for table `tbl_issue` */

DROP TABLE IF EXISTS `tbl_issue`;

CREATE TABLE `tbl_issue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `requester_id` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  `column_id` int(11) unsigned DEFAULT NULL,
  `sprint_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_issue_project` (`project_id`),
  KEY `FK_issue_owner` (`owner_id`),
  KEY `FK_issue_requester` (`requester_id`),
  CONSTRAINT `FK_issue_owner` FOREIGN KEY (`owner_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_issue_project` FOREIGN KEY (`project_id`) REFERENCES `tbl_project` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_issue_requester` FOREIGN KEY (`requester_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_issue` */

insert  into `tbl_issue`(`id`,`name`,`description`,`project_id`,`type_id`,`status_id`,`owner_id`,`requester_id`,`create_time`,`create_user_id`,`update_time`,`update_user_id`,`column_id`,`sprint_id`) values (1,'Allow drag n drop task','',1,2,0,2,2,'2011-01-27 23:09:01',1,'2011-02-03 19:55:49',1,NULL,NULL);
insert  into `tbl_issue`(`id`,`name`,`description`,`project_id`,`type_id`,`status_id`,`owner_id`,`requester_id`,`create_time`,`create_user_id`,`update_time`,`update_user_id`,`column_id`,`sprint_id`) values (2,'Adding sprint planning screen, allow drag task from Product backlog to Sprint backlog','',1,2,0,1,1,'2011-01-27 23:10:25',1,'2011-02-03 19:55:45',1,NULL,NULL);
insert  into `tbl_issue`(`id`,`name`,`description`,`project_id`,`type_id`,`status_id`,`owner_id`,`requester_id`,`create_time`,`create_user_id`,`update_time`,`update_user_id`,`column_id`,`sprint_id`) values (3,'Click on task title to inline edit task title',' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec lobortis facilisis varius. Donec non odio vel enim imperdiet venenatis a eu nibh. Nulla sodales magna faucibus leo tempor adipiscing. Sed euismod hendrerit est eu aliquam. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec quis blandit enim. Morbi accumsan lobortis iaculis. Cras ac risus mauris, sit amet ullamcorper lacus. Vestibulum ullamcorper ornare imperdiet. Vivamus sagittis fermentum lorem, a posuere ante hendrerit a. Pellentesque blandit pulvinar fermentum. Nunc accumsan augue in quam lobortis vitae rhoncus tortor ullamcorper. Nullam ut nisi vel elit bibendum rutrum. Mauris et nulla ante, eu malesuada nisi. Proin iaculis ultricies neque, vitae pellentesque risus fringilla vitae. Vestibulum lobortis purus non eros accumsan laoreet. Etiam cursus velit condimentum nunc lobortis ac commodo metus convallis. Morbi cursus diam at enim posuere ut aliquet velit lacinia.',1,1,0,1,1,'2011-01-30 11:33:28',1,'2011-02-03 19:55:46',1,NULL,NULL);
insert  into `tbl_issue`(`id`,`name`,`description`,`project_id`,`type_id`,`status_id`,`owner_id`,`requester_id`,`create_time`,`create_user_id`,`update_time`,`update_user_id`,`column_id`,`sprint_id`) values (4,'Adding popup dialog to add/edit a task','The Yii application is divided into several subdomains, or each subdomain has its own Yii application.  A user should be able to log in to any subdomain and be logged in to another subdomain and the root domain.',1,2,0,2,2,'2011-01-31 18:45:25',1,'2011-02-03 19:55:51',1,NULL,NULL);
insert  into `tbl_issue`(`id`,`name`,`description`,`project_id`,`type_id`,`status_id`,`owner_id`,`requester_id`,`create_time`,`create_user_id`,`update_time`,`update_user_id`,`column_id`,`sprint_id`) values (5,'Adding toolbar to add sub action buttons for each screen','',1,0,0,1,1,'2011-02-03 19:58:35',1,'2011-02-03 19:58:35',1,NULL,NULL);
insert  into `tbl_issue`(`id`,`name`,`description`,`project_id`,`type_id`,`status_id`,`owner_id`,`requester_id`,`create_time`,`create_user_id`,`update_time`,`update_user_id`,`column_id`,`sprint_id`) values (6,'Adding sprint task board to allow drag n drop tasks between columns','',1,0,0,1,1,'2011-02-03 19:59:33',1,'2011-02-03 19:59:33',1,NULL,NULL);
insert  into `tbl_issue`(`id`,`name`,`description`,`project_id`,`type_id`,`status_id`,`owner_id`,`requester_id`,`create_time`,`create_user_id`,`update_time`,`update_user_id`,`column_id`,`sprint_id`) values (7,'Adding popup dialog to add/edit column for each project','',1,0,0,1,1,'2011-02-03 20:00:16',1,'2011-02-03 20:00:16',1,NULL,NULL);
insert  into `tbl_issue`(`id`,`name`,`description`,`project_id`,`type_id`,`status_id`,`owner_id`,`requester_id`,`create_time`,`create_user_id`,`update_time`,`update_user_id`,`column_id`,`sprint_id`) values (8,'Adding collapsible button to open/close a column','',1,0,0,1,1,'2011-02-03 20:00:56',1,'2011-02-03 20:00:56',1,NULL,NULL);
insert  into `tbl_issue`(`id`,`name`,`description`,`project_id`,`type_id`,`status_id`,`owner_id`,`requester_id`,`create_time`,`create_user_id`,`update_time`,`update_user_id`,`column_id`,`sprint_id`) values (9,'Initialing project\'s task by importing from Excel file','',1,0,0,1,1,'2011-02-03 20:02:25',1,'2011-02-03 20:02:25',1,NULL,NULL);
insert  into `tbl_issue`(`id`,`name`,`description`,`project_id`,`type_id`,`status_id`,`owner_id`,`requester_id`,`create_time`,`create_user_id`,`update_time`,`update_user_id`,`column_id`,`sprint_id`) values (10,'Clicking on username to change assignee for a task','',1,0,0,1,1,'2011-02-03 20:02:50',1,'2011-02-03 20:02:50',1,NULL,NULL);
insert  into `tbl_issue`(`id`,`name`,`description`,`project_id`,`type_id`,`status_id`,`owner_id`,`requester_id`,`create_time`,`create_user_id`,`update_time`,`update_user_id`,`column_id`,`sprint_id`) values (11,'Clicking on time to change estimation for task','',1,0,0,1,1,'2011-02-03 20:03:19',1,'2011-02-03 20:03:19',1,NULL,NULL);
insert  into `tbl_issue`(`id`,`name`,`description`,`project_id`,`type_id`,`status_id`,`owner_id`,`requester_id`,`create_time`,`create_user_id`,`update_time`,`update_user_id`,`column_id`,`sprint_id`) values (12,'Clicking on task type to change','',1,0,0,1,1,'2011-02-03 20:03:34',1,'2011-02-03 20:03:34',1,NULL,NULL);
insert  into `tbl_issue`(`id`,`name`,`description`,`project_id`,`type_id`,`status_id`,`owner_id`,`requester_id`,`create_time`,`create_user_id`,`update_time`,`update_user_id`,`column_id`,`sprint_id`) values (13,'Adding collapsible button to open/close a task body which include other sections as comments, attachments','',1,0,0,1,1,'2011-02-03 20:04:11',1,'2011-02-03 20:04:11',1,NULL,NULL);
insert  into `tbl_issue`(`id`,`name`,`description`,`project_id`,`type_id`,`status_id`,`owner_id`,`requester_id`,`create_time`,`create_user_id`,`update_time`,`update_user_id`,`column_id`,`sprint_id`) values (14,'User can add comment on a task','',1,0,0,1,1,'2011-02-03 20:04:37',1,'2011-02-03 20:04:37',1,NULL,NULL);
insert  into `tbl_issue`(`id`,`name`,`description`,`project_id`,`type_id`,`status_id`,`owner_id`,`requester_id`,`create_time`,`create_user_id`,`update_time`,`update_user_id`,`column_id`,`sprint_id`) values (15,'User can upload an attachment file to a task','',1,0,0,1,1,'2011-02-03 20:04:51',1,'2011-02-03 20:04:51',1,NULL,NULL);
insert  into `tbl_issue`(`id`,`name`,`description`,`project_id`,`type_id`,`status_id`,`owner_id`,`requester_id`,`create_time`,`create_user_id`,`update_time`,`update_user_id`,`column_id`,`sprint_id`) values (16,'Adding button to mark finish a task','',1,0,0,1,1,'2011-02-03 20:06:04',1,'2011-02-03 20:06:04',1,NULL,NULL);
insert  into `tbl_issue`(`id`,`name`,`description`,`project_id`,`type_id`,`status_id`,`owner_id`,`requester_id`,`create_time`,`create_user_id`,`update_time`,`update_user_id`,`column_id`,`sprint_id`) values (17,'Adding burn down chart ','',1,0,0,1,1,'2011-02-03 20:06:16',1,'2011-02-03 20:06:16',1,NULL,NULL);
insert  into `tbl_issue`(`id`,`name`,`description`,`project_id`,`type_id`,`status_id`,`owner_id`,`requester_id`,`create_time`,`create_user_id`,`update_time`,`update_user_id`,`column_id`,`sprint_id`) values (18,'User can highlight own tasks by filtering task by username','',1,0,0,1,1,'2011-02-03 20:07:25',1,'2011-02-03 20:07:38',1,NULL,NULL);
insert  into `tbl_issue`(`id`,`name`,`description`,`project_id`,`type_id`,`status_id`,`owner_id`,`requester_id`,`create_time`,`create_user_id`,`update_time`,`update_user_id`,`column_id`,`sprint_id`) values (19,'Adding daskboard to overview project\'s member action','',1,0,0,1,1,'2011-02-03 20:08:18',1,'2011-02-03 20:08:18',1,NULL,NULL);
insert  into `tbl_issue`(`id`,`name`,`description`,`project_id`,`type_id`,`status_id`,`owner_id`,`requester_id`,`create_time`,`create_user_id`,`update_time`,`update_user_id`,`column_id`,`sprint_id`) values (20,'Adding poker game to estimate a task','',1,0,0,1,1,'2011-02-03 20:08:57',1,'2011-02-03 20:08:57',1,NULL,NULL);
insert  into `tbl_issue`(`id`,`name`,`description`,`project_id`,`type_id`,`status_id`,`owner_id`,`requester_id`,`create_time`,`create_user_id`,`update_time`,`update_user_id`,`column_id`,`sprint_id`) values (21,'User can tweet about what user are doing (do not use Twitter)','',1,0,0,1,1,'2011-02-03 20:10:07',1,'2011-02-03 20:10:07',1,NULL,NULL);

/*Table structure for table `tbl_project` */

DROP TABLE IF EXISTS `tbl_project`;

CREATE TABLE `tbl_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_project` */

insert  into `tbl_project`(`id`,`name`,`description`,`create_time`,`create_user_id`,`update_time`,`update_user_id`) values (1,'Track Star','','2011-01-27 23:06:11',1,'2011-01-27 23:06:11',1);

/*Table structure for table `tbl_project_column` */

DROP TABLE IF EXISTS `tbl_project_column`;

CREATE TABLE `tbl_project_column` (
  `column_id` int(11) unsigned NOT NULL,
  `project_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`column_id`,`project_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_project_column` */

insert  into `tbl_project_column`(`column_id`,`project_id`) values (1,1);
insert  into `tbl_project_column`(`column_id`,`project_id`) values (2,1);

/*Table structure for table `tbl_project_user_assignment` */

DROP TABLE IF EXISTS `tbl_project_user_assignment`;

CREATE TABLE `tbl_project_user_assignment` (
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`project_id`,`user_id`),
  KEY `FK_user_project` (`user_id`),
  CONSTRAINT `FK_project_user` FOREIGN KEY (`project_id`) REFERENCES `tbl_project` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_user_project` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_project_user_assignment` */

insert  into `tbl_project_user_assignment`(`project_id`,`user_id`,`create_time`,`create_user_id`,`update_time`,`update_user_id`) values (1,1,NULL,NULL,NULL,NULL);
insert  into `tbl_project_user_assignment`(`project_id`,`user_id`,`create_time`,`create_user_id`,`update_time`,`update_user_id`) values (1,2,NULL,NULL,NULL,NULL);

/*Table structure for table `tbl_project_user_role` */

DROP TABLE IF EXISTS `tbl_project_user_role`;

CREATE TABLE `tbl_project_user_role` (
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role` varchar(64) NOT NULL,
  PRIMARY KEY (`project_id`,`user_id`,`role`),
  KEY `FK_user_id` (`user_id`),
  KEY `FK_role_name` (`role`),
  CONSTRAINT `FK_project_id` FOREIGN KEY (`project_id`) REFERENCES `tbl_project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_role_name` FOREIGN KEY (`role`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_user_id` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tbl_project_user_role` */

insert  into `tbl_project_user_role`(`project_id`,`user_id`,`role`) values (1,1,'admin');
insert  into `tbl_project_user_role`(`project_id`,`user_id`,`role`) values (1,2,'member');

/*Table structure for table `tbl_sprint` */

DROP TABLE IF EXISTS `tbl_sprint`;

CREATE TABLE `tbl_sprint` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `sort` tinyint(4) DEFAULT NULL,
  `project_id` int(11) NOT NULL,
  `status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_sprint` */

insert  into `tbl_sprint`(`id`,`name`,`start_date`,`end_date`,`sort`,`project_id`,`status`) values (1,'Sprint 1','0000-00-00 00:00:00','0000-00-00 00:00:00',1,1,NULL);
insert  into `tbl_sprint`(`id`,`name`,`start_date`,`end_date`,`sort`,`project_id`,`status`) values (2,'Sprint 2','0000-00-00 00:00:00','0000-00-00 00:00:00',2,1,NULL);
insert  into `tbl_sprint`(`id`,`name`,`start_date`,`end_date`,`sort`,`project_id`,`status`) values (3,'Sprint 3','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,1,NULL);

/*Table structure for table `tbl_sys_message` */

DROP TABLE IF EXISTS `tbl_sys_message`;

CREATE TABLE `tbl_sys_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_sys_message` */

insert  into `tbl_sys_message`(`id`,`message`,`create_time`,`create_user_id`,`update_time`,`update_user_id`) values (1,'Welcome to Trackstar','2011-01-27 23:05:37',1,'2011-01-27 23:05:37',1);

/*Table structure for table `tbl_user` */

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(256) NOT NULL,
  `username` varchar(256) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`id`,`email`,`username`,`password`,`last_login_time`,`create_time`,`create_user_id`,`update_time`,`update_user_id`) values (1,'banana@rua.com','banana','e10adc3949ba59abbe56e057f20f883e','2011-01-31 23:20:54','2011-01-26 18:24:40',NULL,NULL,NULL);
insert  into `tbl_user`(`id`,`email`,`username`,`password`,`last_login_time`,`create_time`,`create_user_id`,`update_time`,`update_user_id`) values (2,'orange@rua.com','orange','e10adc3949ba59abbe56e057f20f883e','2011-02-03 21:55:41','2011-01-27 23:07:17',1,'2011-01-27 23:07:17',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
