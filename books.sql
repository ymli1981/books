/*
SQLyog Trial v11.4 (32 bit)
MySQL - 5.6.21-log : Database - asset.zhoukoup.com
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`asset.zhoukoup.com` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `asset.zhoukoup.com`;

/*Table structure for table `rbac_actionlog` */

DROP TABLE IF EXISTS `rbac_actionlog`;

CREATE TABLE `rbac_actionlog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `source` int(10) unsigned NOT NULL COMMENT '行为来源 (与config.php的配置进行关联)',
  `user_id` int(10) unsigned NOT NULL COMMENT '管理员ID',
  `data` text NOT NULL COMMENT '行为内容',
  `modified` int(10) unsigned DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态 (0已删除,1正常)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

/*Data for the table `rbac_actionlog` */

insert  into `rbac_actionlog`(`id`,`source`,`user_id`,`data`,`modified`,`status`) values (49,0,1,'月流水添加,自增id为35',1494554039,1),(48,0,1,'月流水添加,自增id为34',1494470534,1),(47,0,1,'月流水添加,自增id为33',1494470454,1),(46,0,1,'月流水添加,自增id为32',1494470399,1),(45,0,1,'月流水添加,自增id为31',1494470166,1),(44,0,1,'月流水添加,自增id为30',1494470141,1),(43,0,1,'月流水添加,自增id为29',1494470096,1),(42,0,1,'月流水添加,自增id为28',1494469873,1),(41,0,1,'添加资金配置,自增id为17',1494324750,1),(40,0,1,'添加资金配置,自增id为16',1494324531,1),(39,0,1,'添加资金配置,自增id为15',1494324386,1),(38,0,1,'添加资金形态,自增id为16',1494324152,1),(37,0,1,'添加资金配置,自增id为14',1494324074,1),(36,0,1,'添加资金配置,自增id为13',1494323983,1),(35,0,1,'添加资金配置,自增id为12',1494323865,1),(34,0,1,'添加资金形态,自增id为15',1494323607,1),(33,0,1,'添加资金形态,自增id为14',1494322295,1),(32,0,1,'添加资金形态,自增id为13',1494322243,1),(31,0,1,'添加资金形态,自增id为12',1494322196,1),(30,0,1,'添加资金形态,自增id为11',1494322009,1),(50,0,1,'月流水添加,自增id为75',1513214506,1),(51,0,1,'月流水添加,自增id为76',1513214758,1),(52,0,1,'月流水添加,自增id为77',1513215909,1),(53,0,1,'月流水删除,自增id为77',1513215974,1);

/*Table structure for table `rbac_asset_allocation` */

DROP TABLE IF EXISTS `rbac_asset_allocation`;

CREATE TABLE `rbac_asset_allocation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `asset_name` varchar(35) NOT NULL DEFAULT '' COMMENT '配置项目',
  `alias` varchar(50) NOT NULL DEFAULT '' COMMENT '别名',
  `number` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '钱数',
  `accounted_for` decimal(10,4) unsigned NOT NULL DEFAULT '0.0000' COMMENT '占比',
  `earnings` decimal(10,4) unsigned NOT NULL DEFAULT '0.0000' COMMENT '收益率/预估收益率',
  `start_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '起息日期',
  `end_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '到期日期',
  `earnings_number` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '到期收益',
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '添加时间',
  `money_form_id` int(11) NOT NULL COMMENT '资金形态',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '0 已结束  1 进行中',
  `is_delete` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1 正常 0 删除',
  `color` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1 红色（赚） 0 绿（亏）',
  `remark` text COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `rbac_asset_allocation` */

insert  into `rbac_asset_allocation`(`id`,`asset_name`,`alias`,`number`,`accounted_for`,`earnings`,`start_date`,`end_date`,`earnings_number`,`update_date`,`create_date`,`money_form_id`,`status`,`is_delete`,`color`,`remark`) values (12,'定期存款','','60000.00','0.0000','0.0300','2016-09-20 00:00:45','2019-09-20 23:55:45','0.00','2017-05-09 17:57:45','2017-05-09 17:57:45',15,1,1,1,'兴业银行'),(13,'理财通余额','','100301.18','0.0000','0.0400','2017-04-20 00:00:53','2020-12-31 23:55:10','0.00','2017-05-09 17:59:43','2017-05-09 17:59:43',11,1,1,1,'理财通货币基金'),(14,'支付宝余额','','121090.12','0.0000','0.0400','2017-04-20 23:55:51','2020-12-31 23:55:51','0.00','2017-05-09 18:01:14','2017-05-09 18:01:14',12,1,1,1,'蚂蚁聚宝总额'),(15,'股票','','5540.00','0.0000','0.0100','2017-04-20 00:00:23','2020-12-31 23:00:23','0.00','2017-05-09 18:06:26','2017-05-09 18:06:26',16,1,1,1,'买入雏鹰农牧 500股，宁波海运400股，总投入5540。不计盈亏'),(16,'存金宝','','300.00','0.0000','0.0300','2017-04-20 15:00:07','2017-05-31 18:50:07','0.00','2017-05-09 18:08:51','2017-05-09 18:08:51',14,1,1,1,'存金宝买入，不计盈亏'),(17,'基金','','14959.45','0.0000','0.0300','2017-04-20 15:00:29','2017-05-31 18:50:29','0.00','2017-05-09 18:12:30','2017-05-09 18:12:30',13,1,1,1,'投资总金额14959.45，不计盈亏');

/*Table structure for table `rbac_auth` */

DROP TABLE IF EXISTS `rbac_auth`;

CREATE TABLE `rbac_auth` (
  `node_id` int(11) NOT NULL COMMENT '节点ID',
  `role_id` int(11) NOT NULL COMMENT '角色ID',
  UNIQUE KEY `nid_rid` (`node_id`,`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='角色与节点对应表';

/*Data for the table `rbac_auth` */

insert  into `rbac_auth`(`node_id`,`role_id`) values (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(18,2),(19,1),(20,1),(21,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1);

/*Table structure for table `rbac_balance_payments` */

DROP TABLE IF EXISTS `rbac_balance_payments`;

CREATE TABLE `rbac_balance_payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 收入  0 支出',
  `created` date NOT NULL DEFAULT '0000-00-00' COMMENT '时间',
  `num` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `desc` text NOT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

/*Data for the table `rbac_balance_payments` */

insert  into `rbac_balance_payments`(`id`,`type`,`created`,`num`,`desc`) values (28,1,'2017-05-10','99.00','副业'),(29,1,'2017-05-11','81.00','华厦恒生基金收益到账'),(30,0,'2017-05-10','10.00','上下班地铁通勤'),(31,0,'2017-05-11','10.00','上下班地铁通勤'),(32,1,'2017-05-11','11.68','理财通余额收益'),(33,1,'2017-05-11','12.96','支付宝余额收益'),(34,1,'2017-05-11','5.00','京东购物好评返现'),(35,0,'2017-05-12','2.00','早饭'),(41,0,'2017-10-11','6.00','早餐'),(42,1,'2017-10-11','0.50','测试'),(43,1,'2017-10-11','0.50','测试'),(44,1,'2017-10-11','0.50','测试'),(45,1,'2017-10-11','0.50','测试'),(46,0,'2017-10-01','1.00','1'),(47,1,'2017-10-11','2.00','测试收入'),(48,0,'2017-10-11','2.00','测试支出'),(49,1,'2017-09-11','100.00','12'),(50,1,'2017-12-11','100.00','12'),(51,1,'2017-12-11','100.00','12'),(52,1,'2017-12-11','100.00','12'),(53,1,'2017-12-11','100.00','12'),(54,1,'2017-12-11','100.00','12'),(55,1,'2017-12-11','100.00','12'),(56,1,'2017-12-11','100.00','12'),(57,1,'2017-12-11','100.00','12'),(58,1,'2017-12-11','100.00','12'),(59,1,'2017-09-11','10000.00','5'),(60,1,'2017-09-11','10000.00','5'),(61,1,'2017-09-11','10000.00','5'),(62,1,'2017-09-11','10000.00','5'),(63,1,'2017-09-11','10000.00','5'),(64,1,'2017-09-11','10000.00','5'),(65,1,'2017-09-11','10000.00','5'),(66,1,'2017-10-21','123.00','没有'),(67,1,'2017-10-21','123.00','没有'),(68,1,'2017-10-21','123.00','没有'),(69,1,'2017-10-21','250.00','??'),(70,1,'2017-10-21','250.00','??'),(71,1,'2017-10-21','250.00','??'),(72,1,'2017-10-21','250.00','??'),(73,1,'2017-10-21','250.00','??'),(74,1,'2017-10-21','250.00','??'),(75,0,'2017-12-14','18.50','早餐'),(76,1,'2017-12-14','7.00','小业务'),(78,1,'2017-12-14','5.00','测试手机端');

/*Table structure for table `rbac_menu` */

DROP TABLE IF EXISTS `rbac_menu`;

CREATE TABLE `rbac_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL COMMENT '导航名称',
  `node_id` int(11) DEFAULT NULL COMMENT '节点ID',
  `p_id` int(11) DEFAULT NULL COMMENT '导航父id',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` int(11) DEFAULT '1' COMMENT '状态(1:正常,0:停用)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='菜单表';

/*Data for the table `rbac_menu` */

insert  into `rbac_menu`(`id`,`title`,`node_id`,`p_id`,`sort`,`status`) values (1,'系统设置',NULL,NULL,9,1),(2,'节点管理',5,1,2,1),(3,'导航管理',1,1,1,1),(4,'人员管理',14,1,4,1),(5,'角色管理',9,1,3,1),(6,'资金',0,NULL,1,1),(7,'总资本',23,6,1,1),(8,'收支管理',0,NULL,3,1),(9,'月流水',33,8,3,1),(14,'月收支',32,8,1,1),(16,'仪表盘',0,NULL,0,1),(17,'仪表盘',24,16,0,1),(18,'系统设置',0,16,1,1),(19,'资金形态',25,18,0,1),(20,'资本配置',20,6,2,1),(21,'对账单',22,6,3,1);

/*Table structure for table `rbac_money` */

DROP TABLE IF EXISTS `rbac_money`;

CREATE TABLE `rbac_money` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(50) DEFAULT NULL COMMENT '账户',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '类型 0 现金 1 定期 2 活期',
  `money` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '余额',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 正常 0 删除',
  `remark` text COMMENT '备注',
  `create` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `withdrawal_pass` varchar(100) DEFAULT '' COMMENT '取款密码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `rbac_money` */

/*Table structure for table `rbac_money_form` */

DROP TABLE IF EXISTS `rbac_money_form`;

CREATE TABLE `rbac_money_form` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '资金形态名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 启用  0 禁用',
  `info` text COMMENT '说明',
  `create` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `rbac_money_form` */

insert  into `rbac_money_form`(`id`,`name`,`status`,`info`,`create`) values (11,'余额(理财通)',1,'微信理财通','2017-05-09 17:26:49'),(12,'余额(支付宝)',1,'支付宝-余额宝','2017-05-09 17:29:56'),(13,'基金(蚂蚁聚宝)',1,'蚂蚁聚宝基金','2017-05-09 17:30:43'),(14,'存金宝(蚂蚁聚宝)',1,'蚂蚁聚宝/存金宝','2017-05-09 17:31:35'),(15,'银行存款',1,'各银行的存款总计','2017-05-09 17:53:27'),(16,'股票',1,'投入总资金，不计盈亏【同花顺】','2017-05-09 18:02:32');

/*Table structure for table `rbac_monthly_budget` */

DROP TABLE IF EXISTS `rbac_monthly_budget`;

CREATE TABLE `rbac_monthly_budget` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `budget` decimal(10,0) unsigned NOT NULL DEFAULT '0' COMMENT '预算',
  `spent` decimal(10,0) unsigned DEFAULT '0' COMMENT '花费',
  `remain` decimal(10,0) unsigned DEFAULT '0' COMMENT '剩余',
  `month` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `rbac_monthly_budget` */

/*Table structure for table `rbac_node` */

DROP TABLE IF EXISTS `rbac_node`;

CREATE TABLE `rbac_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dirc` varchar(20) NOT NULL COMMENT '目录',
  `cont` varchar(10) NOT NULL COMMENT '控制器',
  `func` varchar(50) NOT NULL COMMENT '方法',
  `memo` varchar(50) DEFAULT NULL COMMENT '备注',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态(1:正常,0:停用)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `d_c_f` (`dirc`,`cont`,`func`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COMMENT='节点表';

/*Data for the table `rbac_node` */

insert  into `rbac_node`(`id`,`dirc`,`cont`,`func`,`memo`,`status`) values (1,'manage','menu','index','导航管理',1),(2,'manage','menu','edit','导航修改',1),(3,'manage','menu','delete','导航删除',1),(4,'manage','menu','add','导航新增',1),(5,'manage','node','index','节点管理',1),(6,'manage','node','add','节点新增',1),(7,'manage','node','delete','节点删除',1),(8,'manage','node','edit','节点修改',1),(9,'manage','role','index','角色管理',1),(10,'manage','role','action','角色赋权',1),(11,'manage','role','delete','角色删除',1),(12,'manage','role','edit','角色修改',1),(13,'manage','role','add','角色新增',1),(14,'manage','member','index','人员管理',1),(15,'manage','member','edit','人员修改',1),(16,'manage','member','delete','人员删除',1),(17,'manage','member','add','人员新增',1),(18,'product','index','index','测试用节点',1),(19,'group','group','index','用户组',1),(20,'bank','bank','index','财务配置',1),(21,'bank','bank','add','新增',1),(22,'bank','reconcilia','index','对账单',1),(23,'bank','money','index','总资本',1),(24,'dashboard','dashboard','index','仪表盘',1),(25,'dashboard','setting','index','资金形态',1),(26,'dashboard','setting','add','添加资金形态',1),(27,'dashboard','setting','status','修改状态',1),(28,'dashboard','setting','del','删除',1),(29,'bank','bank','del','删除',1),(30,'bank','bank','confirm_earnings','确认收益',1),(31,'bank','bank','detail','查看',1),(32,'income','income','index','收支',1),(33,'income','income','account_checking','流水',1),(34,'income','income','del','流水删除',1);

/*Table structure for table `rbac_role` */

DROP TABLE IF EXISTS `rbac_role`;

CREATE TABLE `rbac_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(25) NOT NULL COMMENT '角色名',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态(1:正常,0停用)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `rolename` (`rolename`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='角色表';

/*Data for the table `rbac_role` */

insert  into `rbac_role`(`id`,`rolename`,`status`) values (1,'管理员',1),(2,'角色测试',1);

/*Table structure for table `rbac_user` */

DROP TABLE IF EXISTS `rbac_user`;

CREATE TABLE `rbac_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `nickname` varchar(20) NOT NULL COMMENT '昵称',
  `email` varchar(25) NOT NULL COMMENT 'Email',
  `role_id` int(11) DEFAULT NULL COMMENT '角色ID',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态(1:正常,0:停用)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='用户表';

/*Data for the table `rbac_user` */

insert  into `rbac_user`(`id`,`username`,`password`,`nickname`,`email`,`role_id`,`status`) values (1,'admin','e10adc3949ba59abbe56e057f20f883e','Boss','lhf2008@yeah.net',1,1),(2,'用户测试','e10adc3949ba59abbe56e057f20f883e','用户测试','lihuafeng@rhbboby.com',2,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
