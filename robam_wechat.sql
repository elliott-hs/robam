/*
SQLyog Ultimate v11.24 (32 bit)
MySQL - 5.7.14-log : Database - robam_wechat
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`robam_wechat` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `robam_wechat`;

/*Table structure for table `robam_action` */

DROP TABLE IF EXISTS `robam_action`;

CREATE TABLE `robam_action` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '行为唯一标识',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '行为说明',
  `remark` char(140) NOT NULL DEFAULT '' COMMENT '行为描述',
  `rule` text NOT NULL COMMENT '行为规则',
  `log` text NOT NULL COMMENT '日志规则',
  `type` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='系统行为表';

/*Data for the table `robam_action` */

LOCK TABLES `robam_action` WRITE;

insert  into `robam_action`(`id`,`name`,`title`,`remark`,`rule`,`log`,`type`,`status`,`update_time`) values (1,'user_login','用户登录','积分+10，每天一次','table:member|field:score|condition:uid={$self} AND status>-1|rule:score+10|cycle:24|max:1;','[user|get_nickname]在[time|time_format]登录了后台',1,1,1387181220),(2,'add_article','发布文章','积分+5，每天上限5次','table:member|field:score|condition:uid={$self}|rule:score+5|cycle:24|max:5','',2,0,1380173180),(3,'review','评论','评论积分+1，无限制','table:member|field:score|condition:uid={$self}|rule:score+1','',2,1,1383285646),(4,'add_document','发表文档','积分+10，每天上限5次','table:member|field:score|condition:uid={$self}|rule:score+10|cycle:24|max:5','[user|get_nickname]在[time|time_format]发表了一篇文章。\r\n表[model]，记录编号[record]。',2,0,1386139726),(5,'add_document_topic','发表讨论','积分+5，每天上限10次','table:member|field:score|condition:uid={$self}|rule:score+5|cycle:24|max:10','',2,0,1383285551),(6,'update_config','更新配置','新增或修改或删除配置','','',1,1,1383294988),(7,'update_model','更新模型','新增或修改模型','','',1,1,1383295057),(8,'update_attribute','更新属性','新增或更新或删除属性','','',1,1,1383295963),(9,'update_channel','更新导航','新增或修改或删除导航','','',1,1,1383296301),(10,'update_menu','更新菜单','新增或修改或删除菜单','','',1,1,1383296392),(11,'update_category','更新分类','新增或修改或删除分类','','',1,1,1383296765);

UNLOCK TABLES;

/*Table structure for table `robam_action_log` */

DROP TABLE IF EXISTS `robam_action_log`;

CREATE TABLE `robam_action_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `action_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '行为id',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '执行用户id',
  `action_ip` bigint(20) NOT NULL COMMENT '执行行为者ip',
  `model` varchar(50) NOT NULL DEFAULT '' COMMENT '触发行为的表',
  `record_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '触发行为的数据id',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '日志备注',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '执行行为的时间',
  PRIMARY KEY (`id`),
  KEY `action_ip_ix` (`action_ip`),
  KEY `action_id_ix` (`action_id`),
  KEY `user_id_ix` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=161 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='行为日志表';

/*Data for the table `robam_action_log` */

LOCK TABLES `robam_action_log` WRITE;

insert  into `robam_action_log`(`id`,`action_id`,`user_id`,`action_ip`,`model`,`record_id`,`remark`,`status`,`create_time`) values (1,1,1,2130706433,'member',1,'admin在2017-02-04 16:49登录了后台',1,1486198196),(2,1,2,2130706433,'member',2,'test在2017-02-04 16:54登录了后台',1,1486198456),(3,1,1,2130706433,'member',1,'admin在2017-02-04 16:54登录了后台',1,1486198487),(4,1,2,2130706433,'member',2,'test在2017-02-04 16:55登录了后台',1,1486198533),(5,1,1,2130706433,'member',1,'admin在2017-02-04 17:09登录了后台',1,1486199365),(6,1,2,2130706433,'member',2,'test在2017-02-04 17:26登录了后台',1,1486200393),(7,1,1,2130706433,'member',1,'admin在2017-02-04 17:26登录了后台',1,1486200411),(8,1,1,2130706433,'member',1,'admin在2017-02-06 09:09登录了后台',1,1486343399),(9,1,3,2130706433,'member',3,'test2在2017-02-06 09:13登录了后台',1,1486343628),(10,1,1,2130706433,'member',1,'admin在2017-02-06 09:17登录了后台',1,1486343879),(11,1,1,2130706433,'member',1,'admin在2017-02-06 11:19登录了后台',1,1486351161),(12,1,1,2130706433,'member',1,'管理员在2017-02-06 12:00登录了后台',1,1486353638),(13,10,1,2130706433,'Menu',2,'操作url：/index.php?s=/admin/menu/edit.html',1,1486353942),(14,10,1,2130706433,'Menu',43,'操作url：/index.php?s=/admin/menu/edit.html',1,1486353970),(15,10,1,2130706433,'Menu',93,'操作url：/index.php?s=/admin/menu/edit.html',1,1486353978),(16,10,1,2130706433,'Menu',93,'操作url：/index.php?s=/admin/menu/edit.html',1,1486353997),(17,10,1,2130706433,'Menu',93,'操作url：/index.php?s=/admin/menu/edit.html',1,1486354029),(18,10,1,2130706433,'Menu',122,'操作url：/index.php?s=/admin/menu/add.html',1,1486354093),(19,10,1,2130706433,'Menu',122,'操作url：/index.php?s=/admin/menu/edit.html',1,1486354112),(20,10,1,2130706433,'Menu',123,'操作url：/index.php?s=/admin/menu/add.html',1,1486354163),(21,10,1,2130706433,'Menu',123,'操作url：/index.php?s=/admin/menu/edit.html',1,1486354173),(22,1,1,2130706433,'member',1,'管理员在2017-02-06 17:52登录了后台',1,1486374741),(23,1,1,2130706433,'member',1,'管理员在2017-02-13 17:14登录了后台',1,1486977290),(24,1,10,2130706433,'member',10,'望山在2017-02-13 17:22登录了后台',1,1486977721),(25,1,10,2130706433,'member',10,'望山在2017-02-13 17:22登录了后台',1,1486977745),(26,1,10,2130706433,'member',10,'望山在2017-02-13 17:24登录了后台',1,1486977859),(27,1,10,2130706433,'member',10,'望山在2017-02-13 17:31登录了后台',1,1486978267),(28,1,10,2130706433,'member',10,'望山在2017-02-13 17:31登录了后台',1,1486978317),(29,1,10,2130706433,'member',10,'望山在2017-02-14 08:52登录了后台',1,1487033577),(30,1,10,2130706433,'member',10,'望山在2017-02-14 08:53登录了后台',1,1487033628),(31,1,10,2130706433,'member',10,'望山在2017-02-14 08:57登录了后台',1,1487033833),(32,1,10,2130706433,'member',10,'望山在2017-02-14 08:58登录了后台',1,1487033924),(33,1,10,2130706433,'member',10,'望山在2017-02-14 08:59登录了后台',1,1487033993),(34,1,10,2130706433,'member',10,'望山在2017-02-14 09:00登录了后台',1,1487034010),(35,1,10,2130706433,'member',10,'望山在2017-02-14 09:00登录了后台',1,1487034025),(36,1,10,2130706433,'member',10,'望山在2017-02-14 09:01登录了后台',1,1487034100),(37,1,10,2130706433,'member',10,'望山在2017-02-14 10:13登录了后台',1,1487038429),(38,1,10,2130706433,'member',10,'望山在2017-02-14 10:16登录了后台',1,1487038580),(39,1,10,2130706433,'member',10,'望山在2017-02-14 10:19登录了后台',1,1487038768),(40,1,10,2130706433,'member',10,'望山在2017-02-14 10:20登录了后台',1,1487038805),(41,1,10,2130706433,'member',10,'望山在2017-02-14 10:20登录了后台',1,1487038848),(42,1,10,2130706433,'member',10,'望山在2017-02-14 10:21登录了后台',1,1487038875),(43,1,10,2130706433,'member',10,'望山在2017-02-14 10:34登录了后台',1,1487039690),(44,1,10,2130706433,'member',10,'望山在2017-02-14 10:35登录了后台',1,1487039731),(45,1,10,2130706433,'member',10,'望山在2017-02-14 11:26登录了后台',1,1487042772),(46,1,10,2130706433,'member',10,'望山在2017-02-14 11:26登录了后台',1,1487042775),(47,1,10,2130706433,'member',10,'望山在2017-02-15 14:07登录了后台',1,1487138862),(48,1,10,2130706433,'member',10,'望山在2017-02-16 08:58登录了后台',1,1487206718),(49,1,10,2130706433,'member',10,'望山在2017-02-17 08:50登录了后台',1,1487292634),(50,1,10,2130706433,'member',10,'望山在2017-02-17 09:07登录了后台',1,1487293658),(51,1,1,2130706433,'member',1,'管理员在2017-02-17 09:34登录了后台',1,1487295288),(52,1,10,2130706433,'member',10,'望山在2017-02-17 09:42登录了后台',1,1487295743),(53,1,10,2130706433,'member',10,'望山在2017-02-17 10:15登录了后台',1,1487297743),(54,1,10,2130706433,'member',10,'望山在2017-02-20 09:44登录了后台',1,1487555072),(55,1,10,2130706433,'member',10,'望山在2017-02-20 09:45登录了后台',1,1487555111),(56,1,10,2130706433,'member',10,'望山在2017-02-20 09:46登录了后台',1,1487555168),(57,1,10,2130706433,'member',10,'望山在2017-02-20 09:47登录了后台',1,1487555244),(58,1,10,2130706433,'member',10,'望山在2017-02-20 09:48登录了后台',1,1487555296),(59,1,10,2130706433,'member',10,'望山在2017-02-20 09:56登录了后台',1,1487555780),(60,1,10,2130706433,'member',10,'望山在2017-02-20 14:58登录了后台',1,1487573904),(61,1,1,2130706433,'member',1,'管理员在2017-02-20 16:58登录了后台',1,1487581110),(62,1,10,2130706433,'member',10,'望山在2017-02-20 17:17登录了后台',1,1487582238),(63,1,11,2130706433,'member',11,'张麻子在2017-02-20 17:17登录了后台',1,1487582263),(64,1,1,2130706433,'member',1,'管理员在2017-02-20 17:18登录了后台',1,1487582313),(65,10,1,2130706433,'Menu',17,'操作url：/index.php?m=Admin&c=Menu&a=edit',1,1487582478),(66,10,1,2130706433,'Menu',17,'操作url：/index.php?m=Admin&c=Menu&a=edit',1,1487582493),(67,10,1,2130706433,'Menu',124,'操作url：/index.php?m=Admin&c=Menu&a=add',1,1487582573),(68,10,1,2130706433,'Menu',124,'操作url：/index.php?m=Admin&c=Menu&a=edit',1,1487582585),(69,10,1,2130706433,'Menu',17,'操作url：/index.php?m=Admin&c=Menu&a=edit',1,1487582814),(70,10,1,2130706433,'Menu',16,'操作url：/index.php?m=Admin&c=Menu&a=edit',1,1487582828),(71,10,1,2130706433,'Menu',68,'操作url：/index.php?m=Admin&c=Menu&a=edit',1,1487582853),(72,10,1,2130706433,'Menu',122,'操作url：/index.php?m=Admin&c=Menu&a=edit',1,1487637526),(73,10,1,2130706433,'Menu',125,'操作url：/index.php?m=Admin&c=Menu&a=add',1,1487637889),(74,10,1,2130706433,'Menu',0,'操作url：/index.php?m=Admin&c=Menu&a=del&id=123',1,1487638083),(75,10,1,2130706433,'Menu',122,'操作url：/index.php?m=Admin&c=Menu&a=edit',1,1487638123),(76,10,1,2130706433,'Menu',122,'操作url：/index.php?m=Admin&c=Menu&a=edit',1,1487638179),(77,10,1,2130706433,'Menu',0,'操作url：/index.php?m=Admin&c=Menu&a=del&id=125',1,1487639032),(78,10,1,2130706433,'Menu',126,'操作url：/index.php?m=Admin&c=Menu&a=add',1,1487639234),(79,10,1,2130706433,'Menu',127,'操作url：/index.php?m=Admin&c=Menu&a=add',1,1487639304),(80,10,1,2130706433,'Menu',126,'操作url：/index.php?m=Admin&c=Menu&a=edit',1,1487639426),(81,10,1,2130706433,'Menu',126,'操作url：/index.php?m=Admin&c=Menu&a=edit',1,1487639445),(82,10,1,2130706433,'Menu',128,'操作url：/index.php?m=Admin&c=Menu&a=add',1,1487639579),(83,10,1,2130706433,'Menu',128,'操作url：/index.php?m=Admin&c=Menu&a=edit',1,1487639628),(84,10,1,2130706433,'Menu',128,'操作url：/index.php?m=Admin&c=Menu&a=edit',1,1487639676),(85,10,1,2130706433,'Menu',128,'操作url：/index.php?m=Admin&c=Menu&a=edit',1,1487639728),(86,10,1,2130706433,'Menu',128,'操作url：/index.php?m=Admin&c=Menu&a=edit',1,1487639755),(87,10,1,2130706433,'Menu',128,'操作url：/index.php?m=Admin&c=Menu&a=edit',1,1487639813),(88,10,1,2130706433,'Menu',128,'操作url：/index.php?m=Admin&c=Menu&a=edit',1,1487639850),(89,10,1,2130706433,'Menu',0,'操作url：/index.php?m=Admin&c=Menu&a=del&id=122',1,1487639910),(90,10,1,2130706433,'Menu',2,'操作url：/index.php?m=Admin&c=Menu&a=edit',1,1487640024),(91,10,1,2130706433,'Menu',129,'操作url：/index.php?m=Admin&c=Menu&a=add',1,1487640048),(92,10,1,2130706433,'Menu',129,'操作url：/index.php?m=Admin&c=Menu&a=edit',1,1487640071),(93,10,1,2130706433,'Menu',124,'操作url：/index.php?m=Admin&c=Menu&a=edit',1,1487640398),(94,10,1,2130706433,'Menu',130,'操作url：/index.php?m=Admin&c=Menu&a=add',1,1487640550),(95,10,1,2130706433,'Menu',130,'操作url：/index.php?m=Admin&c=Menu&a=edit',1,1487640600),(96,10,1,2130706433,'Menu',131,'操作url：/index.php?m=Admin&c=Menu&a=add',1,1487640680),(97,10,1,2130706433,'Menu',132,'操作url：/index.php?m=Admin&c=Menu&a=add',1,1487640831),(98,10,1,2130706433,'Menu',0,'操作url：/index.php?m=Admin&c=Menu&a=del&id=131',1,1487641003),(99,10,1,2130706433,'Menu',128,'操作url：/index.php?m=Admin&c=Menu&a=edit',1,1487641060),(100,1,1,2130706433,'member',1,'管理员在2017-02-21 10:06登录了后台',1,1487642768),(101,9,1,2130706433,'channel',0,'操作url：/index.php?m=Admin&c=Channel&a=del&id=1',1,1487642960),(102,9,1,2130706433,'channel',0,'操作url：/index.php?m=Admin&c=Channel&a=del&id=2',1,1487642969),(103,9,1,2130706433,'channel',0,'操作url：/index.php?m=Admin&c=Channel&a=del&id=3',1,1487642972),(104,10,1,2130706433,'Menu',130,'操作url：/index.php?m=Admin&c=Menu&a=edit',1,1487643358),(105,10,1,2130706433,'Menu',133,'操作url：/index.php?m=Admin&c=Menu&a=add',1,1487647750),(106,10,1,2130706433,'Menu',128,'操作url：/index.php/admin/menu/edit.html',1,1487672877),(107,10,1,2130706433,'Menu',134,'操作url：/index.php/admin/menu/add.html',1,1487673766),(108,10,1,2130706433,'Menu',18,'操作url：/index.php/admin/menu/edit.html',1,1487673815),(109,10,1,2130706433,'Menu',134,'操作url：/index.php/admin/menu/edit.html',1,1487673830),(110,10,1,2130706433,'Menu',134,'操作url：/index.php/admin/menu/edit.html',1,1487673988),(111,1,1,2130706433,'member',1,'管理员在2017-02-23 15:09登录了后台',1,1487833753),(112,1,10,2130706433,'member',10,'望山在2017-02-23 17:06登录了后台',1,1487840763),(113,1,1,2130706433,'member',1,'管理员在2017-02-23 17:07登录了后台',1,1487840831),(114,10,1,2130706433,'Menu',128,'操作url：/index.php/admin/menu/edit.html',1,1487841775),(115,1,10,2130706433,'member',10,'望山在2017-02-23 17:29登录了后台',1,1487842140),(116,10,1,2130706433,'Menu',132,'操作url：/index.php/admin/menu/edit.html',1,1487896827),(117,1,1,2130706433,'member',1,'管理员在2017-02-24 09:19登录了后台',1,1487899189),(118,10,1,2130706433,'Menu',128,'操作url：/index.php/admin/menu/edit.html',1,1487922928),(119,10,1,2130706433,'Menu',128,'操作url：/index.php/admin/menu/edit.html',1,1487923630),(120,10,1,2130706433,'Menu',128,'操作url：/index.php/admin/menu/edit.html',1,1487923718),(121,1,10,2130706433,'member',10,'望山在2017-02-24 17:18登录了后台',1,1487927887),(122,10,1,2130706433,'Menu',135,'操作url：/index.php/admin/menu/add.html',1,1487928336),(123,10,1,2130706433,'Menu',135,'操作url：/index.php/admin/menu/edit.html',1,1487928363),(124,1,10,2130706433,'member',10,'望山在2017-02-26 21:40登录了后台',1,1488116401),(125,1,1,2130706433,'member',1,'管理员在2017-02-26 21:49登录了后台',1,1488116981),(126,1,1,2130706433,'member',1,'管理员在2017-03-21 08:30登录了后台',1,1490056238),(127,10,1,2130706433,'Menu',136,'操作url：/index.php/admin/menu/add.html',1,1490060712),(128,10,1,2130706433,'Menu',1,'操作url：/index.php/admin/menu/edit.html',1,1490066794),(129,10,1,2130706433,'Menu',1,'操作url：/index.php/admin/menu/edit.html',1,1490066904),(130,10,1,2130706433,'Menu',137,'操作url：/index.php/admin/menu/add.html',1,1490066980),(131,10,1,2130706433,'Menu',0,'操作url：/index.php/admin/menu/del/id/137.html',1,1490067024),(132,10,1,2130706433,'Menu',138,'操作url：/index.php/admin/menu/add.html',1,1490080541),(133,10,1,2130706433,'Menu',138,'操作url：/index.php/admin/menu/edit.html',1,1490080567),(134,10,1,2130706433,'Menu',139,'操作url：/index.php/admin/menu/add.html',1,1490080690),(135,10,1,2130706433,'Menu',140,'操作url：/index.php/admin/menu/add.html',1,1490081114),(136,1,1,2130706433,'member',1,'管理员在2017-03-23 15:38登录了后台',1,1490254704),(137,1,1,2130706433,'member',1,'管理员在2017-03-28 20:24登录了后台',1,1490703875),(138,1,1,2130706433,'member',1,'管理员在2017-03-31 16:50登录了后台',1,1490950214),(139,10,1,2130706433,'Menu',141,'操作url：/index.php/admin/menu/add.html',1,1490950566),(140,1,1,2130706433,'member',1,'管理员在2017-04-04 13:47登录了后台',1,1491284835),(141,1,11,2130706433,'member',11,'孙勇在2017-04-04 14:18登录了后台',1,1491286729),(142,10,1,2130706433,'Menu',139,'操作url：/index.php/admin/menu/edit.html',1,1491287488),(143,10,1,2130706433,'Menu',68,'操作url：/index.php/admin/menu/edit.html',1,1491287526),(144,10,1,2130706433,'Menu',142,'操作url：/index.php/admin/menu/add.html',1,1491287740),(145,10,1,2130706433,'Menu',142,'操作url：/index.php/admin/menu/edit.html',1,1491287779),(146,10,1,2130706433,'Menu',143,'操作url：/index.php/admin/menu/add.html',1,1491288158),(147,10,1,2130706433,'Menu',143,'操作url：/index.php/admin/menu/edit.html',1,1491288187),(148,10,1,2130706433,'Menu',144,'操作url：/index.php/admin/menu/add.html',1,1491289249),(149,10,1,2130706433,'Menu',145,'操作url：/index.php/admin/menu/add.html',1,1491289282),(150,10,1,2130706433,'Menu',146,'操作url：/index.php/admin/menu/add.html',1,1491289449),(151,10,1,2130706433,'Menu',147,'操作url：/index.php/admin/menu/add.html',1,1491305349),(152,10,1,2130706433,'Menu',148,'操作url：/index.php/admin/menu/add.html',1,1491305393),(153,10,1,2130706433,'Menu',149,'操作url：/index.php/admin/menu/add.html',1,1491362565),(154,10,1,2130706433,'Menu',149,'操作url：/index.php/admin/menu/edit.html',1,1491362588),(155,10,1,2130706433,'Menu',150,'操作url：/index.php/admin/menu/add.html',1,1491363444),(156,10,1,2130706433,'Menu',151,'操作url：/index.php/admin/menu/add.html',1,1491363466),(157,10,1,2130706433,'Menu',0,'操作url：/index.php/admin/menu/del/id/142.html',1,1491368698),(158,1,1,2130706433,'member',1,'管理员在2017-04-05 14:26登录了后台',1,1491373580),(159,1,1,2130706433,'member',1,'管理员在2017-04-06 17:20登录了后台',1,1491470436),(160,1,10,2130706433,'member',10,'望山在2017-04-06 17:22登录了后台',1,1491470539);

UNLOCK TABLES;

/*Table structure for table `robam_addons` */

DROP TABLE IF EXISTS `robam_addons`;

CREATE TABLE `robam_addons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL COMMENT '插件名或标识',
  `title` varchar(20) NOT NULL DEFAULT '' COMMENT '中文名',
  `description` text COMMENT '插件描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `config` text COMMENT '配置',
  `author` varchar(40) DEFAULT '' COMMENT '作者',
  `version` varchar(20) DEFAULT '' COMMENT '版本号',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '安装时间',
  `has_adminlist` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否有后台列表',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='插件表';

/*Data for the table `robam_addons` */

LOCK TABLES `robam_addons` WRITE;

insert  into `robam_addons`(`id`,`name`,`title`,`description`,`status`,`config`,`author`,`version`,`create_time`,`has_adminlist`) values (15,'EditorForAdmin','后台编辑器','用于增强整站长文本的输入和显示',1,'{\"editor_type\":\"2\",\"editor_wysiwyg\":\"1\",\"editor_height\":\"500px\",\"editor_resize_type\":\"1\"}','thinkphp','0.1',1383126253,0),(2,'SiteStat','站点统计信息','统计站点的基础信息',1,'{\"title\":\"\\u7cfb\\u7edf\\u4fe1\\u606f\",\"width\":\"1\",\"display\":\"1\",\"status\":\"0\"}','thinkphp','0.1',1379512015,0),(3,'DevTeam','开发团队信息','开发团队成员信息',1,'{\"title\":\"OneThink\\u5f00\\u53d1\\u56e2\\u961f\",\"width\":\"2\",\"display\":\"1\"}','thinkphp','0.1',1379512022,0),(4,'SystemInfo','系统环境信息','用于显示一些服务器的信息',1,'{\"title\":\"\\u7cfb\\u7edf\\u4fe1\\u606f\",\"width\":\"2\",\"display\":\"1\"}','thinkphp','0.1',1379512036,0),(5,'Editor','前台编辑器','用于增强整站长文本的输入和显示',1,'{\"editor_type\":\"2\",\"editor_wysiwyg\":\"1\",\"editor_height\":\"300px\",\"editor_resize_type\":\"1\"}','thinkphp','0.1',1379830910,0),(6,'Attachment','附件','用于文档模型上传附件',1,'null','thinkphp','0.1',1379842319,1),(9,'SocialComment','通用社交化评论','集成了各种社交化评论插件，轻松集成到系统中。',1,'{\"comment_type\":\"1\",\"comment_uid_youyan\":\"\",\"comment_short_name_duoshuo\":\"\",\"comment_data_list_duoshuo\":\"\"}','thinkphp','0.1',1380273962,0);

UNLOCK TABLES;

/*Table structure for table `robam_attachment` */

DROP TABLE IF EXISTS `robam_attachment`;

CREATE TABLE `robam_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `title` char(30) NOT NULL DEFAULT '' COMMENT '附件显示名',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '附件类型',
  `source` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '资源ID',
  `record_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '关联记录ID',
  `download` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下载次数',
  `size` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '附件大小',
  `dir` int(12) unsigned NOT NULL DEFAULT '0' COMMENT '上级目录ID',
  `sort` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `idx_record_status` (`record_id`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='附件表';

/*Data for the table `robam_attachment` */

LOCK TABLES `robam_attachment` WRITE;

UNLOCK TABLES;

/*Table structure for table `robam_attribute` */

DROP TABLE IF EXISTS `robam_attribute`;

CREATE TABLE `robam_attribute` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '字段名',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '字段注释',
  `field` varchar(100) NOT NULL DEFAULT '' COMMENT '字段定义',
  `type` varchar(20) NOT NULL DEFAULT '' COMMENT '数据类型',
  `value` varchar(100) NOT NULL DEFAULT '' COMMENT '字段默认值',
  `remark` varchar(100) NOT NULL DEFAULT '' COMMENT '备注',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示',
  `extra` varchar(255) NOT NULL DEFAULT '' COMMENT '参数',
  `model_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '模型id',
  `is_must` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否必填',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `validate_rule` varchar(255) NOT NULL,
  `validate_time` tinyint(1) unsigned NOT NULL,
  `error_info` varchar(100) NOT NULL,
  `validate_type` varchar(25) NOT NULL,
  `auto_rule` varchar(100) NOT NULL,
  `auto_time` tinyint(1) unsigned NOT NULL,
  `auto_type` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `model_id` (`model_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='模型属性表';

/*Data for the table `robam_attribute` */

LOCK TABLES `robam_attribute` WRITE;

insert  into `robam_attribute`(`id`,`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) values (1,'uid','用户ID','int(10) unsigned NOT NULL ','num','0','',0,'',1,0,1,1384508362,1383891233,'',0,'','','',0,''),(2,'name','标识','char(40) NOT NULL ','string','','同一根节点下标识不重复',1,'',1,0,1,1383894743,1383891233,'',0,'','','',0,''),(3,'title','标题','char(80) NOT NULL ','string','','文档标题',1,'',1,0,1,1383894778,1383891233,'',0,'','','',0,''),(4,'category_id','所属分类','int(10) unsigned NOT NULL ','string','','',0,'',1,0,1,1384508336,1383891233,'',0,'','','',0,''),(5,'description','描述','char(140) NOT NULL ','textarea','','',1,'',1,0,1,1383894927,1383891233,'',0,'','','',0,''),(6,'root','根节点','int(10) unsigned NOT NULL ','num','0','该文档的顶级文档编号',0,'',1,0,1,1384508323,1383891233,'',0,'','','',0,''),(7,'pid','所属ID','int(10) unsigned NOT NULL ','num','0','父文档编号',0,'',1,0,1,1384508543,1383891233,'',0,'','','',0,''),(8,'model_id','内容模型ID','tinyint(3) unsigned NOT NULL ','num','0','该文档所对应的模型',0,'',1,0,1,1384508350,1383891233,'',0,'','','',0,''),(9,'type','内容类型','tinyint(3) unsigned NOT NULL ','select','2','',1,'1:目录\r\n2:主题\r\n3:段落',1,0,1,1384511157,1383891233,'',0,'','','',0,''),(10,'position','推荐位','smallint(5) unsigned NOT NULL ','checkbox','0','多个推荐则将其推荐值相加',1,'1:列表推荐\r\n2:频道页推荐\r\n4:首页推荐',1,0,1,1383895640,1383891233,'',0,'','','',0,''),(11,'link_id','外链','int(10) unsigned NOT NULL ','num','0','0-非外链，大于0-外链ID,需要函数进行链接与编号的转换',1,'',1,0,1,1383895757,1383891233,'',0,'','','',0,''),(12,'cover_id','封面','int(10) unsigned NOT NULL ','picture','0','0-无封面，大于0-封面图片ID，需要函数处理',1,'',1,0,1,1384147827,1383891233,'',0,'','','',0,''),(13,'display','可见性','tinyint(3) unsigned NOT NULL ','radio','1','',1,'0:不可见\r\n1:所有人可见',1,0,1,1386662271,1383891233,'',0,'','regex','',0,'function'),(14,'deadline','截至时间','int(10) unsigned NOT NULL ','datetime','0','0-永久有效',1,'',1,0,1,1387163248,1383891233,'',0,'','regex','',0,'function'),(15,'attach','附件数量','tinyint(3) unsigned NOT NULL ','num','0','',0,'',1,0,1,1387260355,1383891233,'',0,'','regex','',0,'function'),(16,'view','浏览量','int(10) unsigned NOT NULL ','num','0','',1,'',1,0,1,1383895835,1383891233,'',0,'','','',0,''),(17,'comment','评论数','int(10) unsigned NOT NULL ','num','0','',1,'',1,0,1,1383895846,1383891233,'',0,'','','',0,''),(18,'extend','扩展统计字段','int(10) unsigned NOT NULL ','num','0','根据需求自行使用',0,'',1,0,1,1384508264,1383891233,'',0,'','','',0,''),(19,'level','优先级','int(10) unsigned NOT NULL ','num','0','越高排序越靠前',1,'',1,0,1,1383895894,1383891233,'',0,'','','',0,''),(20,'create_time','创建时间','int(10) unsigned NOT NULL ','datetime','0','',1,'',1,0,1,1383895903,1383891233,'',0,'','','',0,''),(21,'update_time','更新时间','int(10) unsigned NOT NULL ','datetime','0','',0,'',1,0,1,1384508277,1383891233,'',0,'','','',0,''),(22,'status','数据状态','tinyint(4) NOT NULL ','radio','0','',0,'-1:删除\r\n0:禁用\r\n1:正常\r\n2:待审核\r\n3:草稿',1,0,1,1384508496,1383891233,'',0,'','','',0,''),(23,'parse','内容解析类型','tinyint(3) unsigned NOT NULL ','select','0','',0,'0:html\r\n1:ubb\r\n2:markdown',2,0,1,1384511049,1383891243,'',0,'','','',0,''),(24,'content','文章内容','text NOT NULL ','editor','','',1,'',2,0,1,1383896225,1383891243,'',0,'','','',0,''),(25,'template','详情页显示模板','varchar(100) NOT NULL ','string','','参照display方法参数的定义',1,'',2,0,1,1383896190,1383891243,'',0,'','','',0,''),(26,'bookmark','收藏数','int(10) unsigned NOT NULL ','num','0','',1,'',2,0,1,1383896103,1383891243,'',0,'','','',0,''),(27,'parse','内容解析类型','tinyint(3) unsigned NOT NULL ','select','0','',0,'0:html\r\n1:ubb\r\n2:markdown',3,0,1,1387260461,1383891252,'',0,'','regex','',0,'function'),(28,'content','下载详细描述','text NOT NULL ','editor','','',1,'',3,0,1,1383896438,1383891252,'',0,'','','',0,''),(29,'template','详情页显示模板','varchar(100) NOT NULL ','string','','',1,'',3,0,1,1383896429,1383891252,'',0,'','','',0,''),(30,'file_id','文件ID','int(10) unsigned NOT NULL ','file','0','需要函数处理',1,'',3,0,1,1383896415,1383891252,'',0,'','','',0,''),(31,'download','下载次数','int(10) unsigned NOT NULL ','num','0','',1,'',3,0,1,1383896380,1383891252,'',0,'','','',0,''),(32,'size','文件大小','bigint(20) unsigned NOT NULL ','num','0','单位bit',1,'',3,0,1,1383896371,1383891252,'',0,'','','',0,'');

UNLOCK TABLES;

/*Table structure for table `robam_auth_extend` */

DROP TABLE IF EXISTS `robam_auth_extend`;

CREATE TABLE `robam_auth_extend` (
  `group_id` mediumint(10) unsigned NOT NULL COMMENT '用户id',
  `extend_id` mediumint(8) unsigned NOT NULL COMMENT '扩展表中数据的id',
  `type` tinyint(1) unsigned NOT NULL COMMENT '扩展类型标识 1:栏目分类权限;2:模型权限',
  UNIQUE KEY `group_extend_type` (`group_id`,`extend_id`,`type`),
  KEY `uid` (`group_id`),
  KEY `group_id` (`extend_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组与分类的对应关系表';

/*Data for the table `robam_auth_extend` */

LOCK TABLES `robam_auth_extend` WRITE;

insert  into `robam_auth_extend`(`group_id`,`extend_id`,`type`) values (1,1,1),(1,1,2),(1,2,1),(1,2,2),(1,3,1),(1,3,2),(1,4,1),(1,37,1);

UNLOCK TABLES;

/*Table structure for table `robam_auth_group` */

DROP TABLE IF EXISTS `robam_auth_group`;

CREATE TABLE `robam_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组id,自增主键',
  `module` varchar(20) NOT NULL COMMENT '用户组所属模块',
  `type` tinyint(4) NOT NULL COMMENT '组类型',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '用户组中文名称',
  `description` varchar(80) NOT NULL DEFAULT '' COMMENT '描述信息',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户组状态：为1正常，为0禁用,-1为删除',
  `rules` varchar(500) NOT NULL DEFAULT '' COMMENT '用户组拥有的规则id，多个规则 , 隔开',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `robam_auth_group` */

LOCK TABLES `robam_auth_group` WRITE;

insert  into `robam_auth_group`(`id`,`module`,`type`,`title`,`description`,`status`,`rules`) values (1,'admin',1,'默认用户组','',1,'1,2,3,4,5,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,79,80,81,82,83,84,86,87,88,89,90,91,92,93,94,95,100,102,103,107,108,109,110,195,205,206,207,208,209,210,212,213,214,215,216'),(2,'admin',1,'测试用户','测试用户',-1,'1,2,5,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,79,80,82,83,84,88,89,90,91,92,93,96,97,100,102,103,195'),(3,'admin',1,'系统管理员','',-1,'');

UNLOCK TABLES;

/*Table structure for table `robam_auth_group_access` */

DROP TABLE IF EXISTS `robam_auth_group_access`;

CREATE TABLE `robam_auth_group_access` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '用户组id',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `robam_auth_group_access` */

LOCK TABLES `robam_auth_group_access` WRITE;

insert  into `robam_auth_group_access`(`uid`,`group_id`) values (2,2);

UNLOCK TABLES;

/*Table structure for table `robam_auth_rule` */

DROP TABLE IF EXISTS `robam_auth_rule`;

CREATE TABLE `robam_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键',
  `module` varchar(20) NOT NULL COMMENT '规则所属module',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1-url;2-主菜单',
  `name` char(80) NOT NULL DEFAULT '' COMMENT '规则唯一英文标识',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '规则中文描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有效(0:无效,1:有效)',
  `condition` varchar(300) NOT NULL DEFAULT '' COMMENT '规则附加条件',
  PRIMARY KEY (`id`),
  KEY `module` (`module`,`status`,`type`)
) ENGINE=MyISAM AUTO_INCREMENT=220 DEFAULT CHARSET=utf8;

/*Data for the table `robam_auth_rule` */

LOCK TABLES `robam_auth_rule` WRITE;

insert  into `robam_auth_rule`(`id`,`module`,`type`,`name`,`title`,`status`,`condition`) values (1,'admin',2,'Admin/Index/index','首页',1,''),(2,'admin',2,'Admin/Article/mydocument','商品',1,''),(3,'admin',2,'Admin/User/index','渠道商',1,''),(4,'admin',2,'Admin/Addons/index','扩展',1,''),(5,'admin',2,'Admin/Config/group','系统',1,''),(7,'admin',1,'Admin/article/add','新增',1,''),(8,'admin',1,'Admin/article/edit','编辑',1,''),(9,'admin',1,'Admin/article/setStatus','改变状态',1,''),(10,'admin',1,'Admin/article/update','保存',1,''),(11,'admin',1,'Admin/article/autoSave','保存草稿',1,''),(12,'admin',1,'Admin/article/move','移动',1,''),(13,'admin',1,'Admin/article/copy','复制',1,''),(14,'admin',1,'Admin/article/paste','粘贴',1,''),(15,'admin',1,'Admin/article/permit','还原',1,''),(16,'admin',1,'Admin/article/clear','清空',1,''),(17,'admin',1,'Admin/article/index','文档列表',1,''),(18,'admin',1,'Admin/article/recycle','回收站',1,''),(19,'admin',1,'Admin/User/addaction','新增用户行为',1,''),(20,'admin',1,'Admin/User/editaction','编辑用户行为',1,''),(21,'admin',1,'Admin/User/saveAction','保存用户行为',1,''),(22,'admin',1,'Admin/User/setStatus','变更行为状态',1,''),(23,'admin',1,'Admin/User/changeStatus?method=forbidUser','禁用会员',1,''),(24,'admin',1,'Admin/User/changeStatus?method=resumeUser','启用会员',1,''),(25,'admin',1,'Admin/User/changeStatus?method=deleteUser','删除会员',1,''),(26,'admin',1,'Admin/User/index','用户列表',1,''),(27,'admin',1,'Admin/User/action','用户行为',1,''),(28,'admin',1,'Admin/AuthManager/changeStatus?method=deleteGroup','删除',1,''),(29,'admin',1,'Admin/AuthManager/changeStatus?method=forbidGroup','禁用',1,''),(30,'admin',1,'Admin/AuthManager/changeStatus?method=resumeGroup','恢复',1,''),(31,'admin',1,'Admin/AuthManager/createGroup','新增',1,''),(32,'admin',1,'Admin/AuthManager/editGroup','编辑',1,''),(33,'admin',1,'Admin/AuthManager/writeGroup','保存用户组',1,''),(34,'admin',1,'Admin/AuthManager/group','授权',1,''),(35,'admin',1,'Admin/AuthManager/access','访问授权',1,''),(36,'admin',1,'Admin/AuthManager/user','成员授权',1,''),(37,'admin',1,'Admin/AuthManager/removeFromGroup','解除授权',1,''),(38,'admin',1,'Admin/AuthManager/addToGroup','保存成员授权',1,''),(39,'admin',1,'Admin/AuthManager/category','分类授权',1,''),(40,'admin',1,'Admin/AuthManager/addToCategory','保存分类授权',1,''),(41,'admin',1,'Admin/AuthManager/index','权限管理',1,''),(42,'admin',1,'Admin/Addons/create','创建',1,''),(43,'admin',1,'Admin/Addons/checkForm','检测创建',1,''),(44,'admin',1,'Admin/Addons/preview','预览',1,''),(45,'admin',1,'Admin/Addons/build','快速生成插件',1,''),(46,'admin',1,'Admin/Addons/config','设置',1,''),(47,'admin',1,'Admin/Addons/disable','禁用',1,''),(48,'admin',1,'Admin/Addons/enable','启用',1,''),(49,'admin',1,'Admin/Addons/install','安装',1,''),(50,'admin',1,'Admin/Addons/uninstall','卸载',1,''),(51,'admin',1,'Admin/Addons/saveconfig','更新配置',1,''),(52,'admin',1,'Admin/Addons/adminList','插件后台列表',1,''),(53,'admin',1,'Admin/Addons/execute','URL方式访问插件',1,''),(54,'admin',1,'Admin/Addons/index','插件管理',1,''),(55,'admin',1,'Admin/Addons/hooks','钩子管理',1,''),(56,'admin',1,'Admin/model/add','新增',1,''),(57,'admin',1,'Admin/model/edit','编辑',1,''),(58,'admin',1,'Admin/model/setStatus','改变状态',1,''),(59,'admin',1,'Admin/model/update','保存数据',1,''),(60,'admin',1,'Admin/Model/index','模型管理',1,''),(61,'admin',1,'Admin/Config/edit','编辑',1,''),(62,'admin',1,'Admin/Config/del','删除',1,''),(63,'admin',1,'Admin/Config/add','新增',1,''),(64,'admin',1,'Admin/Config/save','保存',1,''),(65,'admin',1,'Admin/Config/group','网站设置',1,''),(66,'admin',1,'Admin/Config/index','配置管理',1,''),(67,'admin',1,'Admin/Channel/add','新增',1,''),(68,'admin',1,'Admin/Channel/edit','编辑',1,''),(69,'admin',1,'Admin/Channel/del','删除',1,''),(70,'admin',1,'Admin/Channel/index','导航管理',1,''),(71,'admin',1,'Admin/Category/edit','编辑',1,''),(72,'admin',1,'Admin/Category/add','新增',1,''),(73,'admin',1,'Admin/Category/remove','删除',1,''),(74,'admin',1,'Admin/Category/index','分类管理',1,''),(75,'admin',1,'Admin/file/upload','上传控件',-1,''),(76,'admin',1,'Admin/file/uploadPicture','上传图片',-1,''),(77,'admin',1,'Admin/file/download','下载',-1,''),(94,'admin',1,'Admin/AuthManager/modelauth','模型授权',1,''),(79,'admin',1,'Admin/article/batchOperate','导入',1,''),(80,'admin',1,'Admin/Database/index?type=export','备份数据库',1,''),(81,'admin',1,'Admin/Database/index?type=import','还原数据库',1,''),(82,'admin',1,'Admin/Database/export','备份',1,''),(83,'admin',1,'Admin/Database/optimize','优化表',1,''),(84,'admin',1,'Admin/Database/repair','修复表',1,''),(86,'admin',1,'Admin/Database/import','恢复',1,''),(87,'admin',1,'Admin/Database/del','删除',1,''),(88,'admin',1,'Admin/User/add','新增用户',1,''),(89,'admin',1,'Admin/Attribute/index','属性管理',1,''),(90,'admin',1,'Admin/Attribute/add','新增',1,''),(91,'admin',1,'Admin/Attribute/edit','编辑',1,''),(92,'admin',1,'Admin/Attribute/setStatus','改变状态',1,''),(93,'admin',1,'Admin/Attribute/update','保存数据',1,''),(95,'admin',1,'Admin/AuthManager/addToModel','保存模型授权',1,''),(96,'admin',1,'Admin/Category/move','移动',-1,''),(97,'admin',1,'Admin/Category/merge','合并',-1,''),(98,'admin',1,'Admin/Config/menu','后台菜单管理',-1,''),(99,'admin',1,'Admin/Article/mydocument','内容',-1,''),(100,'admin',1,'Admin/Menu/index','菜单管理',1,''),(101,'admin',1,'Admin/other','其他',-1,''),(102,'admin',1,'Admin/Menu/add','新增',1,''),(103,'admin',1,'Admin/Menu/edit','编辑',1,''),(104,'admin',1,'Admin/Think/lists?model=article','文章管理',-1,''),(105,'admin',1,'Admin/Think/lists?model=download','下载管理',1,''),(106,'admin',1,'Admin/Think/lists?model=config','配置管理',1,''),(107,'admin',1,'Admin/Action/actionlog','行为日志',1,''),(108,'admin',1,'Admin/User/updatePassword','修改密码',1,''),(109,'admin',1,'Admin/User/updateNickname','修改昵称',1,''),(110,'admin',1,'Admin/action/edit','查看行为日志',1,''),(205,'admin',1,'Admin/think/add','新增数据',1,''),(111,'admin',2,'Admin/article/index','文档列表',-1,''),(112,'admin',2,'Admin/article/add','新增',-1,''),(113,'admin',2,'Admin/article/edit','编辑',-1,''),(114,'admin',2,'Admin/article/setStatus','改变状态',-1,''),(115,'admin',2,'Admin/article/update','保存',-1,''),(116,'admin',2,'Admin/article/autoSave','保存草稿',-1,''),(117,'admin',2,'Admin/article/move','移动',-1,''),(118,'admin',2,'Admin/article/copy','复制',-1,''),(119,'admin',2,'Admin/article/paste','粘贴',-1,''),(120,'admin',2,'Admin/article/batchOperate','导入',-1,''),(121,'admin',2,'Admin/article/recycle','回收站',-1,''),(122,'admin',2,'Admin/article/permit','还原',-1,''),(123,'admin',2,'Admin/article/clear','清空',-1,''),(124,'admin',2,'Admin/User/add','新增用户',-1,''),(125,'admin',2,'Admin/User/action','用户行为',-1,''),(126,'admin',2,'Admin/User/addAction','新增用户行为',-1,''),(127,'admin',2,'Admin/User/editAction','编辑用户行为',-1,''),(128,'admin',2,'Admin/User/saveAction','保存用户行为',-1,''),(129,'admin',2,'Admin/User/setStatus','变更行为状态',-1,''),(130,'admin',2,'Admin/User/changeStatus?method=forbidUser','禁用会员',-1,''),(131,'admin',2,'Admin/User/changeStatus?method=resumeUser','启用会员',-1,''),(132,'admin',2,'Admin/User/changeStatus?method=deleteUser','删除会员',-1,''),(133,'admin',2,'Admin/AuthManager/index','权限管理',-1,''),(134,'admin',2,'Admin/AuthManager/changeStatus?method=deleteGroup','删除',-1,''),(135,'admin',2,'Admin/AuthManager/changeStatus?method=forbidGroup','禁用',-1,''),(136,'admin',2,'Admin/AuthManager/changeStatus?method=resumeGroup','恢复',-1,''),(137,'admin',2,'Admin/AuthManager/createGroup','新增',-1,''),(138,'admin',2,'Admin/AuthManager/editGroup','编辑',-1,''),(139,'admin',2,'Admin/AuthManager/writeGroup','保存用户组',-1,''),(140,'admin',2,'Admin/AuthManager/group','授权',-1,''),(141,'admin',2,'Admin/AuthManager/access','访问授权',-1,''),(142,'admin',2,'Admin/AuthManager/user','成员授权',-1,''),(143,'admin',2,'Admin/AuthManager/removeFromGroup','解除授权',-1,''),(144,'admin',2,'Admin/AuthManager/addToGroup','保存成员授权',-1,''),(145,'admin',2,'Admin/AuthManager/category','分类授权',-1,''),(146,'admin',2,'Admin/AuthManager/addToCategory','保存分类授权',-1,''),(147,'admin',2,'Admin/AuthManager/modelauth','模型授权',-1,''),(148,'admin',2,'Admin/AuthManager/addToModel','保存模型授权',-1,''),(149,'admin',2,'Admin/Addons/create','创建',-1,''),(150,'admin',2,'Admin/Addons/checkForm','检测创建',-1,''),(151,'admin',2,'Admin/Addons/preview','预览',-1,''),(152,'admin',2,'Admin/Addons/build','快速生成插件',-1,''),(153,'admin',2,'Admin/Addons/config','设置',-1,''),(154,'admin',2,'Admin/Addons/disable','禁用',-1,''),(155,'admin',2,'Admin/Addons/enable','启用',-1,''),(156,'admin',2,'Admin/Addons/install','安装',-1,''),(157,'admin',2,'Admin/Addons/uninstall','卸载',-1,''),(158,'admin',2,'Admin/Addons/saveconfig','更新配置',-1,''),(159,'admin',2,'Admin/Addons/adminList','插件后台列表',-1,''),(160,'admin',2,'Admin/Addons/execute','URL方式访问插件',-1,''),(161,'admin',2,'Admin/Addons/hooks','钩子管理',-1,''),(162,'admin',2,'Admin/Model/index','模型管理',-1,''),(163,'admin',2,'Admin/model/add','新增',-1,''),(164,'admin',2,'Admin/model/edit','编辑',-1,''),(165,'admin',2,'Admin/model/setStatus','改变状态',-1,''),(166,'admin',2,'Admin/model/update','保存数据',-1,''),(167,'admin',2,'Admin/Attribute/index','属性管理',-1,''),(168,'admin',2,'Admin/Attribute/add','新增',-1,''),(169,'admin',2,'Admin/Attribute/edit','编辑',-1,''),(170,'admin',2,'Admin/Attribute/setStatus','改变状态',-1,''),(171,'admin',2,'Admin/Attribute/update','保存数据',-1,''),(172,'admin',2,'Admin/Config/index','配置管理',-1,''),(173,'admin',2,'Admin/Config/edit','编辑',-1,''),(174,'admin',2,'Admin/Config/del','删除',-1,''),(175,'admin',2,'Admin/Config/add','新增',-1,''),(176,'admin',2,'Admin/Config/save','保存',-1,''),(177,'admin',2,'Admin/Menu/index','菜单管理',-1,''),(178,'admin',2,'Admin/Channel/index','导航管理',-1,''),(179,'admin',2,'Admin/Channel/add','新增',-1,''),(180,'admin',2,'Admin/Channel/edit','编辑',-1,''),(181,'admin',2,'Admin/Channel/del','删除',-1,''),(182,'admin',2,'Admin/Category/index','分类管理',-1,''),(183,'admin',2,'Admin/Category/edit','编辑',-1,''),(184,'admin',2,'Admin/Category/add','新增',-1,''),(185,'admin',2,'Admin/Category/remove','删除',-1,''),(186,'admin',2,'Admin/Category/move','移动',-1,''),(187,'admin',2,'Admin/Category/merge','合并',-1,''),(188,'admin',2,'Admin/Database/index?type=export','备份数据库',-1,''),(189,'admin',2,'Admin/Database/export','备份',-1,''),(190,'admin',2,'Admin/Database/optimize','优化表',-1,''),(191,'admin',2,'Admin/Database/repair','修复表',-1,''),(192,'admin',2,'Admin/Database/index?type=import','还原数据库',-1,''),(193,'admin',2,'Admin/Database/import','恢复',-1,''),(194,'admin',2,'Admin/Database/del','删除',-1,''),(195,'admin',2,'Admin/other','其他',1,''),(196,'admin',2,'Admin/Menu/add','新增',-1,''),(197,'admin',2,'Admin/Menu/edit','编辑',-1,''),(198,'admin',2,'Admin/Think/lists?model=article','应用',-1,''),(199,'admin',2,'Admin/Think/lists?model=download','下载管理',-1,''),(200,'admin',2,'Admin/Think/lists?model=config','应用',-1,''),(201,'admin',2,'Admin/Action/actionlog','行为日志',-1,''),(202,'admin',2,'Admin/User/updatePassword','修改密码',-1,''),(203,'admin',2,'Admin/User/updateNickname','修改昵称',-1,''),(204,'admin',2,'Admin/action/edit','查看行为日志',-1,''),(206,'admin',1,'Admin/think/edit','编辑数据',1,''),(207,'admin',1,'Admin/Menu/import','导入',1,''),(208,'admin',1,'Admin/Model/generate','生成',1,''),(209,'admin',1,'Admin/Addons/addHook','新增钩子',1,''),(210,'admin',1,'Admin/Addons/edithook','编辑钩子',1,''),(211,'admin',1,'Admin/Article/sort','文档排序',1,''),(212,'admin',1,'Admin/Config/sort','排序',1,''),(213,'admin',1,'Admin/Menu/sort','排序',1,''),(214,'admin',1,'Admin/Channel/sort','排序',1,''),(215,'admin',1,'Admin/Category/operate/type/move','移动',1,''),(216,'admin',1,'Admin/Category/operate/type/merge','合并',1,''),(217,'admin',2,'Admin/j','任务',1,''),(218,'admin',2,'Admin/1','奖励',1,''),(219,'admin',2,'Admin/order/index','订单',1,'');

UNLOCK TABLES;

/*Table structure for table `robam_category` */

DROP TABLE IF EXISTS `robam_category`;

CREATE TABLE `robam_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `name` varchar(30) NOT NULL COMMENT '标志',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `list_row` tinyint(3) unsigned NOT NULL DEFAULT '10' COMMENT '列表每页行数',
  `meta_title` varchar(50) NOT NULL DEFAULT '' COMMENT 'SEO的网页标题',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `template_index` varchar(100) NOT NULL COMMENT '频道页模板',
  `template_lists` varchar(100) NOT NULL COMMENT '列表页模板',
  `template_detail` varchar(100) NOT NULL COMMENT '详情页模板',
  `template_edit` varchar(100) NOT NULL COMMENT '编辑页模板',
  `model` varchar(100) NOT NULL DEFAULT '' COMMENT '关联模型',
  `type` varchar(100) NOT NULL DEFAULT '' COMMENT '允许发布的内容类型',
  `link_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '外链',
  `allow_publish` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许发布内容',
  `display` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '可见性',
  `reply` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许回复',
  `check` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '发布的文章是否需要审核',
  `reply_model` varchar(100) NOT NULL DEFAULT '',
  `extend` text NOT NULL COMMENT '扩展设置',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '数据状态',
  `icon` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类图标',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COMMENT='分类表';

/*Data for the table `robam_category` */

LOCK TABLES `robam_category` WRITE;

insert  into `robam_category`(`id`,`name`,`title`,`pid`,`sort`,`list_row`,`meta_title`,`keywords`,`description`,`template_index`,`template_lists`,`template_detail`,`template_edit`,`model`,`type`,`link_id`,`allow_publish`,`display`,`reply`,`check`,`reply_model`,`extend`,`create_time`,`update_time`,`status`,`icon`) values (1,'blog','博客',0,0,10,'','','','','','','','2','2,1',0,0,1,0,0,'1','',1379474947,1382701539,1,0),(2,'default_blog','默认分类',1,1,10,'','','','','','','','2','2,1,3',0,1,1,0,1,'1','',1379475028,1386839751,1,31);

UNLOCK TABLES;

/*Table structure for table `robam_channel` */

DROP TABLE IF EXISTS `robam_channel`;

CREATE TABLE `robam_channel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '频道ID',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级频道ID',
  `title` char(30) NOT NULL COMMENT '频道标题',
  `url` char(100) NOT NULL COMMENT '频道连接',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '导航排序',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `target` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '新窗口打开',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `robam_channel` */

LOCK TABLES `robam_channel` WRITE;

UNLOCK TABLES;

/*Table structure for table `robam_config` */

DROP TABLE IF EXISTS `robam_config`;

CREATE TABLE `robam_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置名称',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置类型',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '配置说明',
  `group` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置分组',
  `extra` varchar(255) NOT NULL DEFAULT '' COMMENT '配置值',
  `remark` varchar(100) NOT NULL COMMENT '配置说明',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `value` text NOT NULL COMMENT '配置值',
  `sort` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`),
  KEY `type` (`type`),
  KEY `group` (`group`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

/*Data for the table `robam_config` */

LOCK TABLES `robam_config` WRITE;

insert  into `robam_config`(`id`,`name`,`type`,`title`,`group`,`extra`,`remark`,`create_time`,`update_time`,`status`,`value`,`sort`) values (1,'WEB_SITE_TITLE',1,'网站标题',1,'','网站标题前台显示标题',1378898976,1379235274,1,'robam',0),(2,'WEB_SITE_DESCRIPTION',2,'网站描述',1,'','网站搜索引擎描述',1378898976,1379235841,1,'dsf ',1),(3,'WEB_SITE_KEYWORD',2,'网站关键字',1,'','网站搜索引擎关键字',1378898976,1381390100,1,'robam,老板',8),(4,'WEB_SITE_CLOSE',4,'关闭站点',1,'0:关闭,1:开启','站点关闭后其他用户不能访问，管理员可以正常访问',1378898976,1379235296,1,'1',1),(9,'CONFIG_TYPE_LIST',3,'配置类型列表',4,'','主要用于数据解析和页面表单的生成',1378898976,1379235348,1,'0:数字\r\n1:字符\r\n2:文本\r\n3:数组\r\n4:枚举',2),(10,'WEB_SITE_ICP',1,'网站备案号',1,'','设置在网站底部显示的备案号，如“沪ICP备12007941号-2',1378900335,1379235859,1,'',9),(11,'DOCUMENT_POSITION',3,'文档推荐位',2,'','文档推荐位，推荐到多个位置KEY值相加即可',1379053380,1379235329,1,'1:列表页推荐\r\n2:频道页推荐\r\n4:网站首页推荐',3),(12,'DOCUMENT_DISPLAY',3,'文档可见性',2,'','文章可见性仅影响前台显示，后台不收影响',1379056370,1379235322,1,'0:所有人可见\r\n1:仅注册会员可见\r\n2:仅管理员可见',4),(13,'COLOR_STYLE',4,'后台色系',1,'default_color:默认\r\nblue_color:紫罗兰','后台颜色风格',1379122533,1379235904,1,'default_color',10),(20,'CONFIG_GROUP_LIST',3,'配置分组',4,'','配置分组',1379228036,1384418383,1,'1:基本\r\n2:内容\r\n3:用户\r\n4:系统',4),(21,'HOOKS_TYPE',3,'钩子的类型',4,'','类型 1-用于扩展显示内容，2-用于扩展业务处理',1379313397,1379313407,1,'1:视图\r\n2:控制器',6),(22,'AUTH_CONFIG',3,'Auth配置',4,'','自定义Auth.class.php类配置',1379409310,1379409564,1,'AUTH_ON:1\r\nAUTH_TYPE:2',8),(23,'OPEN_DRAFTBOX',4,'是否开启草稿功能',2,'0:关闭草稿功能\r\n1:开启草稿功能\r\n','新增文章时的草稿功能配置',1379484332,1379484591,1,'1',1),(24,'DRAFT_AOTOSAVE_INTERVAL',0,'自动保存草稿时间',2,'','自动保存草稿的时间间隔，单位：秒',1379484574,1386143323,1,'60',2),(25,'LIST_ROWS',0,'后台每页记录数',2,'','后台数据每页显示记录数',1379503896,1380427745,1,'10',10),(26,'USER_ALLOW_REGISTER',4,'是否允许用户注册',3,'0:关闭注册\r\n1:允许注册','是否开放用户注册',1379504487,1379504580,1,'1',3),(27,'CODEMIRROR_THEME',4,'预览插件的CodeMirror主题',4,'3024-day:3024 day\r\n3024-night:3024 night\r\nambiance:ambiance\r\nbase16-dark:base16 dark\r\nbase16-light:base16 light\r\nblackboard:blackboard\r\ncobalt:cobalt\r\neclipse:eclipse\r\nelegant:elegant\r\nerlang-dark:erlang-dark\r\nlesser-dark:lesser-dark\r\nmidnight:midnight','详情见CodeMirror官网',1379814385,1384740813,1,'ambiance',3),(28,'DATA_BACKUP_PATH',1,'数据库备份根路径',4,'','路径必须以 / 结尾',1381482411,1381482411,1,'./Data/',5),(29,'DATA_BACKUP_PART_SIZE',0,'数据库备份卷大小',4,'','该值用于限制压缩后的分卷最大长度。单位：B；建议设置20M',1381482488,1381729564,1,'20971520',7),(30,'DATA_BACKUP_COMPRESS',4,'数据库备份文件是否启用压缩',4,'0:不压缩\r\n1:启用压缩','压缩备份文件需要PHP环境支持gzopen,gzwrite函数',1381713345,1381729544,1,'1',9),(31,'DATA_BACKUP_COMPRESS_LEVEL',4,'数据库备份文件压缩级别',4,'1:普通\r\n4:一般\r\n9:最高','数据库备份文件的压缩级别，该配置在开启压缩时生效',1381713408,1381713408,1,'9',10),(32,'DEVELOP_MODE',4,'开启开发者模式',4,'0:关闭\r\n1:开启','是否开启开发者模式',1383105995,1383291877,1,'1',11),(33,'ALLOW_VISIT',3,'不受限控制器方法',0,'','',1386644047,1386644741,1,'0:article/draftbox\r\n1:article/mydocument\r\n2:Category/tree\r\n3:Index/verify\r\n4:file/upload\r\n5:file/download\r\n6:user/updatePassword\r\n7:user/updateNickname\r\n8:user/submitPassword\r\n9:user/submitNickname\r\n10:file/uploadpicture',0),(34,'DENY_VISIT',3,'超管专限控制器方法',0,'','仅超级管理员可访问的控制器方法',1386644141,1386644659,1,'0:Addons/addhook\r\n1:Addons/edithook\r\n2:Addons/delhook\r\n3:Addons/updateHook\r\n4:Admin/getMenus\r\n5:Admin/recordList\r\n6:AuthManager/updateRules\r\n7:AuthManager/tree',0),(35,'REPLY_LIST_ROWS',0,'回复列表每页条数',2,'','',1386645376,1387178083,1,'10',0),(36,'ADMIN_ALLOW_IP',2,'后台允许访问IP',4,'','多个用逗号分隔，如果不配置表示不限制IP访问',1387165454,1387165553,1,'',12),(37,'SHOW_PAGE_TRACE',4,'是否显示页面Trace',4,'0:关闭\r\n1:开启','是否显示页面Trace信息',1387165685,1387165685,1,'1',1);

UNLOCK TABLES;

/*Table structure for table `robam_document` */

DROP TABLE IF EXISTS `robam_document`;

CREATE TABLE `robam_document` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `name` char(40) NOT NULL DEFAULT '' COMMENT '标识',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '标题',
  `category_id` int(10) unsigned NOT NULL COMMENT '所属分类',
  `description` char(140) NOT NULL DEFAULT '' COMMENT '描述',
  `root` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '根节点',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属ID',
  `model_id` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '内容模型ID',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '内容类型',
  `position` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '推荐位',
  `link_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '外链',
  `cover_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '封面',
  `display` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '可见性',
  `deadline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '截至时间',
  `attach` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '附件数量',
  `view` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '浏览量',
  `comment` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '评论数',
  `extend` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '扩展统计字段',
  `level` int(10) NOT NULL DEFAULT '0' COMMENT '优先级',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '数据状态',
  PRIMARY KEY (`id`),
  KEY `idx_category_status` (`category_id`,`status`),
  KEY `idx_status_type_pid` (`status`,`uid`,`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='文档模型基础表';

/*Data for the table `robam_document` */

LOCK TABLES `robam_document` WRITE;

insert  into `robam_document`(`id`,`uid`,`name`,`title`,`category_id`,`description`,`root`,`pid`,`model_id`,`type`,`position`,`link_id`,`cover_id`,`display`,`deadline`,`attach`,`view`,`comment`,`extend`,`level`,`create_time`,`update_time`,`status`) values (1,1,'','OneThink1.0正式版发布',2,'大家期待的OneThink正式版发布',0,0,2,2,0,0,1,1,0,0,8,0,0,0,1387260660,1487295351,1);

UNLOCK TABLES;

/*Table structure for table `robam_document_article` */

DROP TABLE IF EXISTS `robam_document_article`;

CREATE TABLE `robam_document_article` (
  `id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文档ID',
  `parse` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '内容解析类型',
  `content` text NOT NULL COMMENT '文章内容',
  `template` varchar(100) NOT NULL DEFAULT '' COMMENT '详情页显示模板',
  `bookmark` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收藏数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文档模型文章表';

/*Data for the table `robam_document_article` */

LOCK TABLES `robam_document_article` WRITE;

insert  into `robam_document_article`(`id`,`parse`,`content`,`template`,`bookmark`) values (1,0,'<h1>\r\n	OneThink1.0正式版发布&nbsp;\r\n</h1>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<strong>OneThink是一个开源的内容管理框架，基于最新的ThinkPHP3.2版本开发，提供更方便、更安全的WEB应用开发体验，采用了全新的架构设计和命名空间机制，融合了模块化、驱动化和插件化的设计理念于一体，开启了国内WEB应用傻瓜式开发的新潮流。&nbsp;</strong> \r\n</p>\r\n<h2>\r\n	主要特性：\r\n</h2>\r\n<p>\r\n	1. 基于ThinkPHP最新3.2版本。\r\n</p>\r\n<p>\r\n	2. 模块化：全新的架构和模块化的开发机制，便于灵活扩展和二次开发。&nbsp;\r\n</p>\r\n<p>\r\n	3. 文档模型/分类体系：通过和文档模型绑定，以及不同的文档类型，不同分类可以实现差异化的功能，轻松实现诸如资讯、下载、讨论和图片等功能。\r\n</p>\r\n<p>\r\n	4. 开源免费：OneThink遵循Apache2开源协议,免费提供使用。&nbsp;\r\n</p>\r\n<p>\r\n	5. 用户行为：支持自定义用户行为，可以对单个用户或者群体用户的行为进行记录及分享，为您的运营决策提供有效参考数据。\r\n</p>\r\n<p>\r\n	6. 云端部署：通过驱动的方式可以轻松支持平台的部署，让您的网站无缝迁移，内置已经支持SAE和BAE3.0。\r\n</p>\r\n<p>\r\n	7. 云服务支持：即将启动支持云存储、云安全、云过滤和云统计等服务，更多贴心的服务让您的网站更安心。\r\n</p>\r\n<p>\r\n	8. 安全稳健：提供稳健的安全策略，包括备份恢复、容错、防止恶意攻击登录，网页防篡改等多项安全管理功能，保证系统安全，可靠、稳定的运行。&nbsp;\r\n</p>\r\n<p>\r\n	9. 应用仓库：官方应用仓库拥有大量来自第三方插件和应用模块、模板主题，有众多来自开源社区的贡献，让您的网站“One”美无缺。&nbsp;\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<strong>&nbsp;OneThink集成了一个完善的后台管理体系和前台模板标签系统，让你轻松管理数据和进行前台网站的标签式开发。&nbsp;</strong> \r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<h2>\r\n	后台主要功能：\r\n</h2>\r\n<p>\r\n	1. 用户Passport系统\r\n</p>\r\n<p>\r\n	2. 配置管理系统&nbsp;\r\n</p>\r\n<p>\r\n	3. 权限控制系统\r\n</p>\r\n<p>\r\n	4. 后台建模系统&nbsp;\r\n</p>\r\n<p>\r\n	5. 多级分类系统&nbsp;\r\n</p>\r\n<p>\r\n	6. 用户行为系统&nbsp;\r\n</p>\r\n<p>\r\n	7. 钩子和插件系统\r\n</p>\r\n<p>\r\n	8. 系统日志系统&nbsp;\r\n</p>\r\n<p>\r\n	9. 数据备份和还原\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	&nbsp;[ 官方下载：&nbsp;<a href=\"http://www.onethink.cn/download.html\" target=\"_blank\">http://www.onethink.cn/download.html</a>&nbsp;&nbsp;开发手册：<a href=\"http://document.onethink.cn/\" target=\"_blank\">http://document.onethink.cn/</a>&nbsp;]&nbsp;\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<strong>OneThink开发团队 2013</strong> \r\n</p>','',0);

UNLOCK TABLES;

/*Table structure for table `robam_document_download` */

DROP TABLE IF EXISTS `robam_document_download`;

CREATE TABLE `robam_document_download` (
  `id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文档ID',
  `parse` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '内容解析类型',
  `content` text NOT NULL COMMENT '下载详细描述',
  `template` varchar(100) NOT NULL DEFAULT '' COMMENT '详情页显示模板',
  `file_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件ID',
  `download` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下载次数',
  `size` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文档模型下载表';

/*Data for the table `robam_document_download` */

LOCK TABLES `robam_document_download` WRITE;

UNLOCK TABLES;

/*Table structure for table `robam_file` */

DROP TABLE IF EXISTS `robam_file`;

CREATE TABLE `robam_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文件ID',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '原始文件名',
  `savename` char(20) NOT NULL DEFAULT '' COMMENT '保存名称',
  `savepath` char(30) NOT NULL DEFAULT '' COMMENT '文件保存路径',
  `ext` char(5) NOT NULL DEFAULT '' COMMENT '文件后缀',
  `mime` char(40) NOT NULL DEFAULT '' COMMENT '文件mime类型',
  `size` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `location` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '文件保存位置',
  `create_time` int(10) unsigned NOT NULL COMMENT '上传时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_md5` (`md5`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文件表';

/*Data for the table `robam_file` */

LOCK TABLES `robam_file` WRITE;

UNLOCK TABLES;

/*Table structure for table `robam_hooks` */

DROP TABLE IF EXISTS `robam_hooks`;

CREATE TABLE `robam_hooks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '钩子名称',
  `description` text NOT NULL COMMENT '描述',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `addons` varchar(255) NOT NULL DEFAULT '' COMMENT '钩子挂载的插件 ''，''分割',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `robam_hooks` */

LOCK TABLES `robam_hooks` WRITE;

insert  into `robam_hooks`(`id`,`name`,`description`,`type`,`update_time`,`addons`) values (1,'pageHeader','页面header钩子，一般用于加载插件CSS文件和代码',1,0,''),(2,'pageFooter','页面footer钩子，一般用于加载插件JS文件和JS代码',1,0,'ReturnTop'),(3,'documentEditForm','添加编辑表单的 扩展内容钩子',1,0,'Attachment'),(4,'documentDetailAfter','文档末尾显示',1,0,'Attachment,SocialComment'),(5,'documentDetailBefore','页面内容前显示用钩子',1,0,''),(6,'documentSaveComplete','保存文档数据后的扩展钩子',2,0,'Attachment'),(7,'documentEditFormContent','添加编辑表单的内容显示钩子',1,0,'Editor'),(8,'adminArticleEdit','后台内容编辑页编辑器',1,1378982734,'EditorForAdmin'),(13,'AdminIndex','首页小格子个性化显示',1,1382596073,'SiteStat,SystemInfo,DevTeam'),(14,'topicComment','评论提交方式扩展钩子。',1,1380163518,'Editor'),(16,'app_begin','应用开始',2,1384481614,'');

UNLOCK TABLES;

/*Table structure for table `robam_member` */

DROP TABLE IF EXISTS `robam_member`;

CREATE TABLE `robam_member` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `nickname` char(16) NOT NULL DEFAULT '' COMMENT '姓名',
  `sex` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '性别',
  `birthday` date NOT NULL DEFAULT '0000-00-00' COMMENT '生日',
  `qq` char(10) NOT NULL DEFAULT '' COMMENT 'qq号',
  `score` mediumint(8) NOT NULL DEFAULT '0' COMMENT '用户积分',
  `openid` varchar(125) NOT NULL COMMENT '微信相关信息,账户1:N微信账号',
  `login` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登录次数',
  `reg_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `last_login_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '会员状态',
  `type` varchar(64) NOT NULL DEFAULT '0' COMMENT '用户类型 1:设计师 2:C类客户',
  `company` varchar(128) NOT NULL DEFAULT '' COMMENT '公司名称',
  `area` varchar(64) NOT NULL DEFAULT '' COMMENT '所属区域',
  `bank_name` varchar(128) NOT NULL DEFAULT '' COMMENT '银行名称',
  `bank_open_name` varchar(128) NOT NULL DEFAULT '' COMMENT '开户行名称',
  `bank_card` varchar(64) NOT NULL DEFAULT '' COMMENT '银行卡号',
  `update_time` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`uid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='会员表';

/*Data for the table `robam_member` */

LOCK TABLES `robam_member` WRITE;

insert  into `robam_member`(`uid`,`nickname`,`sex`,`birthday`,`qq`,`score`,`openid`,`login`,`reg_ip`,`reg_time`,`last_login_ip`,`last_login_time`,`status`,`type`,`company`,`area`,`bank_name`,`bank_open_name`,`bank_card`,`update_time`) values (1,'管理员',0,'0000-00-00','',140,'',26,0,1486198171,2130706433,1491470436,1,'0','','','','','',NULL),(10,'望山',0,'0000-00-00','',60,'2',42,0,0,2130706433,1491470539,1,'C类客户','','相城区','','','',1491471377),(11,'孙勇',0,'0000-00-00','',20,'2',2,0,0,2130706433,1491286729,1,'C类客户','中国移动苏州分公司','吴江区','工商银行','红中','23434545645456',1490066665),(12,'系统管理员',0,'0000-00-00','',0,'',0,0,0,0,0,1,'0','','','','','',NULL),(2,'王华',0,'0000-00-00','',0,'',0,0,0,0,0,1,'设计师','京东方光科技有限公司','张家港市','农业银行','发财','101010292374937494',1490066595);

UNLOCK TABLES;

/*Table structure for table `robam_menu` */

DROP TABLE IF EXISTS `robam_menu`;

CREATE TABLE `robam_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `url` char(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `hide` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否隐藏',
  `tip` varchar(255) NOT NULL DEFAULT '' COMMENT '提示',
  `group` varchar(50) DEFAULT '' COMMENT '分组',
  `is_dev` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否仅开发者模式可见',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=152 DEFAULT CHARSET=utf8;

/*Data for the table `robam_menu` */

LOCK TABLES `robam_menu` WRITE;

insert  into `robam_menu`(`id`,`title`,`pid`,`sort`,`url`,`hide`,`tip`,`group`,`is_dev`) values (1,'首页',0,1,'Index/index',0,'','',0),(2,'文档',0,2,'Article/mydocument',1,'','',0),(3,'文档列表',2,0,'article/index',1,'','内容',0),(4,'新增',3,0,'article/add',0,'','',0),(5,'编辑',3,0,'article/edit',0,'','',0),(6,'改变状态',3,0,'article/setStatus',0,'','',0),(7,'保存',3,0,'article/update',0,'','',0),(8,'保存草稿',3,0,'article/autoSave',0,'','',0),(9,'移动',3,0,'article/move',0,'','',0),(10,'复制',3,0,'article/copy',0,'','',0),(11,'粘贴',3,0,'article/paste',0,'','',0),(12,'导入',3,0,'article/batchOperate',0,'','',0),(13,'回收站',2,0,'article/recycle',1,'','内容',0),(14,'还原',13,0,'article/permit',0,'','',0),(15,'清空',13,0,'article/clear',0,'','',0),(16,'渠道商',0,3,'User/index',0,'','',0),(17,'用户列表',16,0,'User/index',0,'','用户管理',0),(18,'新增用户',17,0,'User/add',0,'添加新用户','用户列表',0),(19,'用户行为',16,0,'User/action',1,'','行为管理',0),(20,'新增用户行为',19,0,'User/addaction',0,'','',0),(21,'编辑用户行为',19,0,'User/editaction',0,'','',0),(22,'保存用户行为',19,0,'User/saveAction',0,'\"用户->用户行为\"保存编辑和新增的用户行为','',0),(23,'变更行为状态',19,0,'User/setStatus',0,'\"用户->用户行为\"中的启用,禁用和删除权限','',0),(24,'禁用会员',19,0,'User/changeStatus?method=forbidUser',0,'\"用户->用户信息\"中的禁用','',0),(25,'启用会员',19,0,'User/changeStatus?method=resumeUser',0,'\"用户->用户信息\"中的启用','',0),(26,'删除会员',19,0,'User/changeStatus?method=deleteUser',0,'\"用户->用户信息\"中的删除','',0),(27,'权限管理',16,0,'AuthManager/index',1,'','用户管理',0),(28,'删除',27,0,'AuthManager/changeStatus?method=deleteGroup',0,'删除用户组','',0),(29,'禁用',27,0,'AuthManager/changeStatus?method=forbidGroup',0,'禁用用户组','',0),(30,'恢复',27,0,'AuthManager/changeStatus?method=resumeGroup',0,'恢复已禁用的用户组','',0),(31,'新增',27,0,'AuthManager/createGroup',0,'创建新的用户组','',0),(32,'编辑',27,0,'AuthManager/editGroup',0,'编辑用户组名称和描述','',0),(33,'保存用户组',27,0,'AuthManager/writeGroup',0,'新增和编辑用户组的\"保存\"按钮','',0),(34,'授权',27,0,'AuthManager/group',0,'\"后台 \\ 用户 \\ 用户信息\"列表页的\"授权\"操作按钮,用于设置用户所属用户组','',0),(35,'访问授权',27,0,'AuthManager/access',0,'\"后台 \\ 用户 \\ 权限管理\"列表页的\"访问授权\"操作按钮','',0),(36,'成员授权',27,0,'AuthManager/user',0,'\"后台 \\ 用户 \\ 权限管理\"列表页的\"成员授权\"操作按钮','',0),(37,'解除授权',27,0,'AuthManager/removeFromGroup',0,'\"成员授权\"列表页内的解除授权操作按钮','',0),(38,'保存成员授权',27,0,'AuthManager/addToGroup',0,'\"用户信息\"列表页\"授权\"时的\"保存\"按钮和\"成员授权\"里右上角的\"添加\"按钮)','',0),(39,'分类授权',27,0,'AuthManager/category',0,'\"后台 \\ 用户 \\ 权限管理\"列表页的\"分类授权\"操作按钮','',0),(40,'保存分类授权',27,0,'AuthManager/addToCategory',0,'\"分类授权\"页面的\"保存\"按钮','',0),(41,'模型授权',27,0,'AuthManager/modelauth',0,'\"后台 \\ 用户 \\ 权限管理\"列表页的\"模型授权\"操作按钮','',0),(42,'保存模型授权',27,0,'AuthManager/addToModel',0,'\"分类授权\"页面的\"保存\"按钮','',0),(43,'扩展',0,7,'Addons/index',1,'','',0),(44,'插件管理',43,1,'Addons/index',0,'','扩展',0),(45,'创建',44,0,'Addons/create',0,'服务器上创建插件结构向导','',0),(46,'检测创建',44,0,'Addons/checkForm',0,'检测插件是否可以创建','',0),(47,'预览',44,0,'Addons/preview',0,'预览插件定义类文件','',0),(48,'快速生成插件',44,0,'Addons/build',0,'开始生成插件结构','',0),(49,'设置',44,0,'Addons/config',0,'设置插件配置','',0),(50,'禁用',44,0,'Addons/disable',0,'禁用插件','',0),(51,'启用',44,0,'Addons/enable',0,'启用插件','',0),(52,'安装',44,0,'Addons/install',0,'安装插件','',0),(53,'卸载',44,0,'Addons/uninstall',0,'卸载插件','',0),(54,'更新配置',44,0,'Addons/saveconfig',0,'更新插件配置处理','',0),(55,'插件后台列表',44,0,'Addons/adminList',0,'','',0),(56,'URL方式访问插件',44,0,'Addons/execute',0,'控制是否有权限通过url访问插件控制器方法','',0),(57,'钩子管理',43,2,'Addons/hooks',0,'','扩展',0),(58,'模型管理',68,3,'Model/index',0,'','系统设置',0),(59,'新增',58,0,'model/add',0,'','',0),(60,'编辑',58,0,'model/edit',0,'','',0),(61,'改变状态',58,0,'model/setStatus',0,'','',0),(62,'保存数据',58,0,'model/update',0,'','',0),(63,'属性管理',68,0,'Attribute/index',1,'网站属性配置。','',0),(64,'新增',63,0,'Attribute/add',0,'','',0),(65,'编辑',63,0,'Attribute/edit',0,'','',0),(66,'改变状态',63,0,'Attribute/setStatus',0,'','',0),(67,'保存数据',63,0,'Attribute/update',0,'','',0),(68,'系统',0,13,'Config/group',0,'','',0),(69,'网站设置',68,1,'Config/group',0,'','系统设置',0),(70,'配置管理',68,4,'Config/index',0,'','系统设置',0),(71,'编辑',70,0,'Config/edit',0,'新增编辑和保存配置','',0),(72,'删除',70,0,'Config/del',0,'删除配置','',0),(73,'新增',70,0,'Config/add',0,'新增配置','',0),(74,'保存',70,0,'Config/save',0,'保存配置','',0),(75,'菜单管理',68,5,'Menu/index',0,'','系统设置',0),(76,'导航管理',68,6,'Channel/index',0,'','系统设置',0),(77,'新增',76,0,'Channel/add',0,'','',0),(78,'编辑',76,0,'Channel/edit',0,'','',0),(79,'删除',76,0,'Channel/del',0,'','',0),(80,'分类管理',68,2,'Category/index',0,'','系统设置',0),(81,'编辑',80,0,'Category/edit',0,'编辑和保存栏目分类','',0),(82,'新增',80,0,'Category/add',0,'新增栏目分类','',0),(83,'删除',80,0,'Category/remove',0,'删除栏目分类','',0),(84,'移动',80,0,'Category/operate/type/move',0,'移动栏目分类','',0),(85,'合并',80,0,'Category/operate/type/merge',0,'合并栏目分类','',0),(86,'备份数据库',68,0,'Database/index?type=export',0,'','数据备份',0),(87,'备份',86,0,'Database/export',0,'备份数据库','',0),(88,'优化表',86,0,'Database/optimize',0,'优化数据表','',0),(89,'修复表',86,0,'Database/repair',0,'修复数据表','',0),(90,'还原数据库',68,0,'Database/index?type=import',0,'','数据备份',0),(91,'恢复',90,0,'Database/import',0,'数据库恢复','',0),(92,'删除',90,0,'Database/del',0,'删除备份文件','',0),(93,'其他',0,5,'other',1,'','',0),(96,'新增',75,0,'Menu/add',0,'','系统设置',0),(98,'编辑',75,0,'Menu/edit',0,'','',0),(104,'下载管理',102,0,'Think/lists?model=download',0,'','',0),(105,'配置管理',102,0,'Think/lists?model=config',0,'','',0),(106,'行为日志',16,0,'Action/actionlog',1,'','行为管理',0),(108,'修改密码',16,0,'User/updatePassword',1,'','',0),(109,'修改昵称',16,0,'User/updateNickname',1,'','',0),(110,'查看行为日志',106,0,'action/edit',1,'','',0),(112,'新增数据',58,0,'think/add',1,'','',0),(113,'编辑数据',58,0,'think/edit',1,'','',0),(114,'导入',75,0,'Menu/import',0,'','',0),(115,'生成',58,0,'Model/generate',0,'','',0),(116,'新增钩子',57,0,'Addons/addHook',0,'','',0),(117,'编辑钩子',57,0,'Addons/edithook',0,'','',0),(118,'文档排序',3,0,'Article/sort',1,'','',0),(119,'排序',70,0,'Config/sort',1,'','',0),(120,'排序',75,0,'Menu/sort',1,'','',0),(121,'排序',76,0,'Channel/sort',1,'','',0),(129,'商品',0,2,'Goods/index',0,'','',0),(124,'订单',0,9,'orders/index',0,'','',0),(128,'类别奖励',16,0,'agent/categoryRate',0,'','奖励维护',0),(126,'用户列表',122,0,'Task/index',0,'','渠道商',0),(127,'奖励维护',122,0,'Reward/index',0,'','奖励',0),(130,'商品列表',129,0,'goods/index',0,'','商品管理',0),(133,'修改商品',130,0,'goods/edit',0,'','',0),(132,'订单列表',124,0,'orders/index',0,'','订单管理',0),(134,'指标设置',17,0,'agent/task',0,'','用户列表',0),(135,'任务明细',17,0,'agent/taskdetail',1,'','用户列表',0),(136,'编辑用户',17,0,'user/edit',0,'','用户列表',0),(138,'公告',0,11,'notice/index',0,'','',0),(139,'设置',0,12,'marketing/index',0,'','',0),(140,'商城首页',139,0,'marketing/index',0,'','首页管理',0),(141,'价格管理',139,0,'active/price',0,'','价格管理',0),(143,'公告列表',138,0,'notice/index',0,'','公告管理',0),(144,' 新增公告',138,0,'notice/add',1,'','公告管理',0),(145,'修改公告',138,0,'notice/edit',1,'','公告管理',0),(146,'删除公告',138,0,'notice/del',1,'','公告管理',0),(147,'活动添加',141,0,'active/add',1,'','活动添加',0),(148,'活动修改',141,0,'active/edit',1,'','活动修改',0),(149,'区域列表',139,0,'city/index',0,'','区域管理',0),(150,'新增区域',149,0,'City/add',1,'','',0),(151,'编辑区域',149,0,'City/edit',1,'','',0);

UNLOCK TABLES;

/*Table structure for table `robam_model` */

DROP TABLE IF EXISTS `robam_model`;

CREATE TABLE `robam_model` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '模型ID',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '模型标识',
  `title` char(30) NOT NULL DEFAULT '' COMMENT '模型名称',
  `extend` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '继承的模型',
  `relation` varchar(30) NOT NULL DEFAULT '' COMMENT '继承与被继承模型的关联字段',
  `need_pk` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '新建表时是否需要主键字段',
  `field_sort` text NOT NULL COMMENT '表单字段排序',
  `field_group` varchar(255) NOT NULL DEFAULT '1:基础' COMMENT '字段分组',
  `attribute_list` text NOT NULL COMMENT '属性列表（表的字段）',
  `template_list` varchar(100) NOT NULL DEFAULT '' COMMENT '列表模板',
  `template_add` varchar(100) NOT NULL DEFAULT '' COMMENT '新增模板',
  `template_edit` varchar(100) NOT NULL DEFAULT '' COMMENT '编辑模板',
  `list_grid` text NOT NULL COMMENT '列表定义',
  `list_row` smallint(2) unsigned NOT NULL DEFAULT '10' COMMENT '列表数据长度',
  `search_key` varchar(50) NOT NULL DEFAULT '' COMMENT '默认搜索字段',
  `search_list` varchar(255) NOT NULL DEFAULT '' COMMENT '高级搜索的字段',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `engine_type` varchar(25) NOT NULL DEFAULT 'MyISAM' COMMENT '数据库引擎',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='文档模型表';

/*Data for the table `robam_model` */

LOCK TABLES `robam_model` WRITE;

insert  into `robam_model`(`id`,`name`,`title`,`extend`,`relation`,`need_pk`,`field_sort`,`field_group`,`attribute_list`,`template_list`,`template_add`,`template_edit`,`list_grid`,`list_row`,`search_key`,`search_list`,`create_time`,`update_time`,`status`,`engine_type`) values (1,'document','基础文档',0,'',1,'{\"1\":[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"22\"]}','1:基础','','','','','id:编号\r\ntitle:标题:article/index?cate_id=[category_id]&pid=[id]\r\ntype|get_document_type:类型\r\nlevel:优先级\r\nupdate_time|time_format:最后更新\r\nstatus_text:状态\r\nview:浏览\r\nid:操作:[EDIT]&cate_id=[category_id]|编辑,article/setstatus?status=-1&ids=[id]|删除',0,'','',1383891233,1384507827,1,'MyISAM'),(2,'article','文章',1,'',1,'{\"1\":[\"3\",\"24\",\"2\",\"5\"],\"2\":[\"9\",\"13\",\"19\",\"10\",\"12\",\"16\",\"17\",\"26\",\"20\",\"14\",\"11\",\"25\"]}','1:基础,2:扩展','','','','','id:编号\r\ntitle:标题:article/edit?cate_id=[category_id]&id=[id]\r\ncontent:内容',0,'','',1383891243,1387260622,1,'MyISAM'),(3,'download','下载',1,'',1,'{\"1\":[\"3\",\"28\",\"30\",\"32\",\"2\",\"5\",\"31\"],\"2\":[\"13\",\"10\",\"27\",\"9\",\"12\",\"16\",\"17\",\"19\",\"11\",\"20\",\"14\",\"29\"]}','1:基础,2:扩展','','','','','id:编号\r\ntitle:标题',0,'','',1383891252,1387260449,1,'MyISAM');

UNLOCK TABLES;

/*Table structure for table `robam_orders` */

DROP TABLE IF EXISTS `robam_orders`;

CREATE TABLE `robam_orders` (
  `order_id` varchar(24) COLLATE utf8_unicode_ci NOT NULL COMMENT '订单号',
  `address_id` int(11) DEFAULT NULL COMMENT '地址ID',
  `user_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户id',
  `price_order` float(11,2) DEFAULT NULL COMMENT '订单总金额',
  `price_express` float(11,2) NOT NULL DEFAULT '0.00' COMMENT '快递金额',
  `reward_money` float(11,2) NOT NULL COMMENT '提成总金额',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '修改时间',
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '订单备注',
  `pay_type` tinyint(1) NOT NULL COMMENT '付款方式：0.货到付款 1.微信支付 2.支付宝支付,3.网银支付',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '订单状态：1.下单（未支付） 2.下单（货到付款） 3.订单完成',
  `sends` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '送货时间',
  PRIMARY KEY (`order_id`),
  KEY `address_id` (`address_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `robam_orders` */

LOCK TABLES `robam_orders` WRITE;

insert  into `robam_orders`(`order_id`,`address_id`,`user_id`,`price_order`,`price_express`,`reward_money`,`create_time`,`update_time`,`remark`,`pay_type`,`status`,`sends`) values ('ROBAM022609485961469',1,'11',400.00,0.00,40.00,1488116939,1488121184,NULL,0,3,''),('ROBAM022609512796863',1,'11',600.00,0.00,60.00,1488117087,1491470086,NULL,0,3,''),('ROBAM022610494861367',1,'11',800.00,0.00,80.00,1488120588,1488121379,NULL,0,3,''),('ROBAM022610513466044',1,'11',200.00,0.00,20.00,1488120694,1488120694,NULL,0,2,''),('ROBAM022611174791124',2,'11',100.00,0.00,10.00,1488122267,1488122267,NULL,0,1,''),('ROBAM040402185303597',NULL,'11',200.00,0.00,20.00,1491286733,1491286733,NULL,0,1,''),('ROBAM040605222454597',1,'10',100.00,0.00,10.00,1491470543,1491470543,NULL,0,1,''),('ROBAM040610540341048',1,'10',100.00,0.00,10.00,1491490443,1491490443,NULL,0,1,''),('ROBAM040610592202608',1,'10',100.00,0.00,10.00,1491490762,1491490762,NULL,0,1,'');

UNLOCK TABLES;

/*Table structure for table `robam_orders_detail` */

DROP TABLE IF EXISTS `robam_orders_detail`;

CREATE TABLE `robam_orders_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `order_id` varchar(24) COLLATE utf8_unicode_ci NOT NULL COMMENT '订单编号',
  `category_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT '品类',
  `goods_id` int(11) NOT NULL COMMENT '商品id',
  `goods_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '商品名称',
  `thumb` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '缩略图',
  `fuel_name` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '燃料',
  `color_name` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '颜色',
  `unit_price` float(11,2) DEFAULT '0.00' COMMENT '单价',
  `sell_num` float(11,0) DEFAULT '0' COMMENT '销售数量',
  `reward_rate` float(11,2) DEFAULT NULL COMMENT '提成比例',
  `reward_money` float(11,2) DEFAULT NULL COMMENT '提成金额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='订单详情表';

/*Data for the table `robam_orders_detail` */

LOCK TABLES `robam_orders_detail` WRITE;

insert  into `robam_orders_detail`(`id`,`order_id`,`category_name`,`goods_id`,`goods_name`,`thumb`,`fuel_name`,`color_name`,`unit_price`,`sell_num`,`reward_rate`,`reward_money`) values (1,'ROBAM022609485961469','灶具',1,'测试商品1','/Uploads/Picture/2017-02-21/58ac06e04fc2a.jpg','液化气','白色',100.00,4,10.00,40.00),(2,'ROBAM022609512796863','灶具',1,'测试商品1','/Uploads/Picture/2017-02-21/58ac06e04fc2a.jpg','天然气','白色',100.00,6,10.00,60.00),(20,'ROBAM022610494861367','灶具',1,'测试商品1','/Uploads/Picture/2017-02-21/58ac06e04fc2a.jpg','天然气','红色',100.00,4,10.00,40.00),(21,'ROBAM022610494861367','灶具',1,'测试商品1','/Uploads/Picture/2017-02-21/58ac06e04fc2a.jpg','天然气','白色',100.00,4,10.00,40.00),(22,'ROBAM022610513466044','灶具',1,'测试商品1','/Uploads/Picture/2017-02-21/58ac06e04fc2a.jpg','液化气','红色',100.00,2,10.00,20.00),(23,'ROBAM022611174791124','灶具',1,'测试商品1','/Uploads/Picture/2017-02-21/58ac06e04fc2a.jpg','天然气','红色',100.00,1,10.00,10.00),(24,'ROBAM040402185303597','灶具',1,'测试商品1','/Uploads/Picture/2017-02-21/58ac06e04fc2a.jpg','天然气','',100.00,2,10.00,20.00),(25,'ROBAM040605222454597','灶具',1,'测试商品1','/Uploads/Picture/2017-02-21/58ac06e04fc2a.jpg','天然气','',100.00,1,10.00,10.00),(26,'ROBAM040610540341048','灶具',1,'测试商品1','/Uploads/Picture/2017-02-21/58ac06e04fc2a.jpg','液化气',NULL,100.00,1,10.00,10.00),(27,'ROBAM040610592202608','灶具',1,'测试商品1','/Uploads/Picture/2017-02-21/58ac06e04fc2a.jpg','天然气','',100.00,1,10.00,10.00);

UNLOCK TABLES;

/*Table structure for table `robam_orders_pay` */

DROP TABLE IF EXISTS `robam_orders_pay`;

CREATE TABLE `robam_orders_pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `payment_type` int(11) NOT NULL DEFAULT '1' COMMENT '付款类型：1预付款，2尾款，3全款',
  `payments_id` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '微信支付号',
  `pay_platform` varchar(20) COLLATE utf8_unicode_ci DEFAULT '1' COMMENT '支付平台：1微信，2货到付款',
  `trade_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '第三方交易号',
  `trade_status` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '交易状态',
  `total_fee` float(11,2) DEFAULT NULL COMMENT '交易金额',
  `notify_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '校验码',
  `notify_time` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '通知发送时间',
  `buyer_account` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '支付账户',
  `pay_time` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '支付时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='订单支付表';

/*Data for the table `robam_orders_pay` */

LOCK TABLES `robam_orders_pay` WRITE;

UNLOCK TABLES;

/*Table structure for table `robam_picture` */

DROP TABLE IF EXISTS `robam_picture`;

CREATE TABLE `robam_picture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id自增',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '路径',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片链接',
  `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

/*Data for the table `robam_picture` */

LOCK TABLES `robam_picture` WRITE;

insert  into `robam_picture`(`id`,`path`,`url`,`md5`,`sha1`,`status`,`create_time`) values (1,'/Uploads/Picture/2017-02-17/58a653733f028.jpg','','5efe9ed84dae448b42e3c0d5fc9a8355','ca45e6c0e2641759febfa84150d1417215502b8a',1,1487295346),(2,'/Uploads/Picture/2017-02-21/58abf66c35a2a.jpg','','cf49aa97b842af7c81dd60f046ac998a','b0fe16339be513ce0a2ee48cceb46cc9b8e5a21a',1,1487664748),(3,'/Uploads/Picture/2017-02-21/58abf8e7e63bb.jpg','','4d9add8ea23b1b29a7957c964b970a63','32060e71128a62a06b62889eb77e39bdabdfe4e2',1,1487665383),(4,'/Uploads/Picture/2017-02-21/58abf9849b779.jpg','','d2bdf564057e124a5d528cf791f21ee1','b43fe20331a59d0897180e774296f1e1830e2e6c',1,1487665540),(5,'/Uploads/Picture/2017-02-21/58abf9bd6b495.jpg','','21ab6073f521a315e69efbb40fd67d50','1cc4e5d5035dc7dda002ad62cbaee7913d6f1dbf',1,1487665597),(6,'/Uploads/Picture/2017-02-21/58ac06e04fc2a.jpg','','5687026b9771dbde9e811c4b45a7419d','e0751bf48057fb2390ba64a5925ddcf4a34ad1b3',1,1487668960),(7,'/Uploads/Picture/2017-03-21/58d0d5ed52dc9.JPG','','7a5ff5dc6b6c19d962c4d3c62baae19e','ace68f6f5740eb479cbb51e31e9b25857ea496fe',1,1490081260),(8,'/Uploads/Picture/2017-03-21/58d0d61a43061.JPG','','9cc89d351ee13c8bd3eb19c7e2b67377','ee80e0f2bc56c81937f734dd35646b3d00d4dcb5',1,1490081306),(9,'/Uploads/Picture/2017-03-21/58d0e3fd7a44f.JPG','','7123437021598163f8e94785ecdfdf43','0808aa81f4c66814cb904cc13118c4362550da4d',1,1490084861),(10,'/Uploads/Picture/2017-03-21/58d0e4219f0a6.JPG','','c747c5a083f03efe55fe904e8ee88f14','814bef893cd289caa522aa4b7a884eb7bbfb2d1b',1,1490084897),(11,'/Uploads/Picture/2017-03-21/58d0ee0fe87b9.JPG','','3392c8be5bd507123287bb1e97e2ed49','fa269211b76daeda7c8364b74a23ee42d952811e',1,1490087439),(12,'/Uploads/Picture/2017-03-23/58d37c1da5b06.jpg','','1eb51c04fc69486351051f97e737677d','30632a24fcccd078cf52db83c6d5e9b5ac56548a',1,1490254877),(13,'/Uploads/Picture/2017-03-23/58d37c24b9903.jpg','','7b06dcfc34186faf12ae314b3a719c7a','773e97e2e8c693b90b7a0e379340ac4c9fc4dbed',1,1490254884),(14,'/Uploads/Picture/2017-03-23/58d37c2fe3f4a.jpg','','904d374d4e44b811210196d873552b88','c2b6b7d273f252e30bceeede49ebe5dd5e14ce16',1,1490254895),(15,'/Uploads/Picture/2017-03-23/58d37c3553417.jpg','','b17183192da72c966a13b2f4b0455b37','027756ce157228233de342b626fa317dc9251304',1,1490254901),(16,'/Uploads/Picture/2017-03-23/58d37c39de3c4.JPG','','f66e527099c3fb6a68de3fa291eb7854','f48bc97f418807a43fa80c8b6bfb039fe40219bc',1,1490254905),(17,'/Uploads/Picture/2017-03-23/58d37c3eceec7.JPG','','bf5a71cf38217d289c1056ec9b651956','bdfa36027ad5861ef1e7eaace9d4931e65ef961e',1,1490254910),(18,'/Uploads/Picture/2017-03-23/58d37c4b4e310.JPG','','5d81179e06f30028da95cae0b48a5362','9d5b344a0336704af96ada2d94b7892ee50d9e48',1,1490254923),(19,'/Uploads/Picture/2017-03-23/58d37c51810f3.JPG','','b2b935112482252eb8bdf779dda57054','d5d03d0bd69b3ea59925b912b080c4ed03319b12',1,1490254929),(20,'/Uploads/Picture/2017-03-23/58d37c58372da.JPG','','16bc097e6ca6a177bd8101088d30c6c4','bb25b57335583a1308ad234dc352c5b5bad93810',1,1490254936),(21,'/Uploads/Picture/2017-03-23/58d37c5e42fb4.JPG','','1f62318f1705602babf0eafcb368a05c','8d0df29391c606e85f8311ad250e923ea0d38799',1,1490254941),(22,'/Uploads/Picture/2017-03-24/58d46e91240f7.jpg','','ea821e40dadfe1012e046573a4cc2227','2a71121b5e9a2114df29a003f16f2e365fbfe51f',1,1490316945),(23,'/Uploads/Picture/2017-03-24/58d46f7e87cfa.jpg','','7b93896ad60bfce88cb34bab136bb62f','27a3cf327311d4082e3e00cfc95d27c95ab5375c',1,1490317182),(24,'/Uploads/Picture/2017-03-24/58d471b5002a9.jpg','','04aa7b5d4232b0757a9e4a39dc6b9cb9','856162bcd70452cf69bf692f0a0f87fdde436900',1,1490317748),(25,'/Uploads/Picture/2017-03-24/58d471ba8a6d7.JPG','','d2a653086017055055e13e50af55a598','6c32a83dc219cffcf01d826a8c7874b38b306e1a',1,1490317754),(26,'/Uploads/Picture/2017-03-24/58d471bee06d0.JPG','','32d2d84bc5305aa32bdcd249bf0e8089','34f71a4b2a5a36e59486154991cfba117dbcd21c',1,1490317758),(27,'/Uploads/Picture/2017-03-24/58d471d51f21e.png','','b456ecc415b410a2b7b8afc6284c645b','1edaf067a5c6d2692a1027d0c715d8bdd9c145b6',1,1490317781),(28,'/Uploads/Picture/2017-03-24/58d471dc01718.JPG','','3cf05b00efdfc831936e607f12c6e9c2','f4318692097c806211ce88ef6fbca4094ea4ffca',1,1490317787);

UNLOCK TABLES;

/*Table structure for table `robam_shop_active` */

DROP TABLE IF EXISTS `robam_shop_active`;

CREATE TABLE `robam_shop_active` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL COMMENT '主题',
  `type` tinyint(1) NOT NULL COMMENT '类型 1:一口价 2:优惠',
  `price_active` float(20,2) DEFAULT NULL COMMENT '价格|优惠',
  `game_start` int(11) DEFAULT NULL COMMENT '活动开始时间',
  `game_end` int(11) DEFAULT NULL COMMENT '活动结束时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `robam_shop_active` */

LOCK TABLES `robam_shop_active` WRITE;

insert  into `robam_shop_active`(`id`,`title`,`type`,`price_active`,`game_start`,`game_end`,`status`,`create_time`,`update_time`) values (1,'劳动节优惠活动',2,12.00,1491275580,1491361980,1,1488122297,1491362057),(2,'油烟机第二批批量修改价格',1,22221.00,1482798720,1485390720,1,1491356529,1491362085),(3,'傲世轻物',1,1000.00,1485822720,1486081920,1,1491356667,1491362308);

UNLOCK TABLES;

/*Table structure for table `robam_shop_active_goods` */

DROP TABLE IF EXISTS `robam_shop_active_goods`;

CREATE TABLE `robam_shop_active_goods` (
  `active_id` int(11) NOT NULL COMMENT '活动id',
  `item_id` int(11) NOT NULL COMMENT '商品id',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`active_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `robam_shop_active_goods` */

LOCK TABLES `robam_shop_active_goods` WRITE;

insert  into `robam_shop_active_goods`(`active_id`,`item_id`,`status`,`create_time`,`update_time`) values (2,1,1,1491362085,1491362085),(3,1,1,1491362308,1491362308);

UNLOCK TABLES;

/*Table structure for table `robam_shop_address` */

DROP TABLE IF EXISTS `robam_shop_address`;

CREATE TABLE `robam_shop_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '收货人姓名',
  `phone` varchar(11) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '收货人电话',
  `area` varchar(128) COLLATE utf8_unicode_ci NOT NULL COMMENT '城市',
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '收货人地址',
  `is_default` int(11) NOT NULL DEFAULT '0' COMMENT '是否默认：1是，0否',
  `status` int(11) DEFAULT '1' COMMENT '状态，1有效，0删除',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='收货地址表';

/*Data for the table `robam_shop_address` */

LOCK TABLES `robam_shop_address` WRITE;

insert  into `robam_shop_address`(`id`,`user_id`,`name`,`phone`,`area`,`address`,`is_default`,`status`,`create_time`,`update_time`) values (1,'10','张珊','15995850157','南京','白塔犀利22号',1,1,11,NULL),(2,'10','张申','15995850152','苏州','男',0,1,1488122297,1488122297),(3,'11','王华','15995850157','南京','水电费',1,1,1491286768,1491286768),(4,'10','顽固啊','15995850156','常熟市','132343',0,1,1491471475,1491471475);

UNLOCK TABLES;

/*Table structure for table `robam_shop_cart` */

DROP TABLE IF EXISTS `robam_shop_cart`;

CREATE TABLE `robam_shop_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(128) NOT NULL,
  `category_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `goods_name` varchar(128) NOT NULL,
  `thumb` varchar(256) NOT NULL,
  `num` int(11) NOT NULL,
  `price_sales` float(11,2) NOT NULL,
  `fuel_name` varchar(128) NOT NULL,
  `color_name` varchar(128) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0:清空 1:正常',
  `reward_rate` float(11,2) DEFAULT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `robam_shop_cart` */

LOCK TABLES `robam_shop_cart` WRITE;

insert  into `robam_shop_cart`(`id`,`user_id`,`category_id`,`goods_id`,`goods_name`,`thumb`,`num`,`price_sales`,`fuel_name`,`color_name`,`status`,`reward_rate`,`create_time`,`update_time`) values (14,'10',2,1,'测试商品1','/Uploads/Picture/2017-02-21/58ac06e04fc2a.jpg',4,100.00,'天然气','红色',0,10.00,1488120147,1488120147),(15,'10',2,1,'测试商品1','/Uploads/Picture/2017-02-21/58ac06e04fc2a.jpg',4,100.00,'天然气','白色',0,10.00,1488120151,1488120151),(16,'10',2,1,'测试商品1','/Uploads/Picture/2017-02-21/58ac06e04fc2a.jpg',1,100.00,'液化气',NULL,0,10.00,1491490430,1491490430);

UNLOCK TABLES;

/*Table structure for table `robam_shop_category` */

DROP TABLE IF EXISTS `robam_shop_category`;

CREATE TABLE `robam_shop_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `name` varchar(64) NOT NULL COMMENT '分类名称',
  `reward_rate` float(11,2) NOT NULL COMMENT '奖励百分百',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `robam_shop_category` */

LOCK TABLES `robam_shop_category` WRITE;

insert  into `robam_shop_category`(`id`,`name`,`reward_rate`,`status`,`create_time`,`update_time`) values (1,'油烟机',12.00,1,1487925084,1487998923),(2,'灶具',5.00,1,1487925084,1487998923),(3,'消毒柜',5.00,1,1487925084,1487998923),(4,'电烤箱',5.00,1,1487925084,1487998923),(5,'蒸汽炉',5.00,1,1487925084,1487998923),(6,'微波炉',5.00,1,1487925084,1487998923),(7,'洗碗机',5.00,1,1487925084,1487998923),(8,'净水器',5.00,1,1487925084,1487998923),(9,'其他',5.00,1,1487925084,1487998923);

UNLOCK TABLES;

/*Table structure for table `robam_shop_city` */

DROP TABLE IF EXISTS `robam_shop_city`;

CREATE TABLE `robam_shop_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(64) NOT NULL DEFAULT '苏州',
  `area` varchar(64) NOT NULL,
  `sends` varchar(64) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_tiem` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `robam_shop_city` */

LOCK TABLES `robam_shop_city` WRITE;

insert  into `robam_shop_city`(`id`,`city`,`area`,`sends`,`status`,`create_tiem`,`update_time`) values (1,'苏州','工业园区','1,2,3',1,1,1491367464),(2,'苏州','吴中区','3,4,5',1,0,1491368661),(3,'苏州','姑苏区','2,3',1,0,1491471510),(4,'苏州','相城区','2,3',1,0,1491470641),(5,'苏州','虎丘区','2,3',1,0,1491470647),(6,'苏州','常熟市','2,3',1,0,1491470653),(7,'苏州','昆山市','2,3',1,0,1491470659),(8,'苏州','张家港市','2,3',1,0,1491470665),(9,'苏州','太仓市','2,3',1,0,1491470672),(10,'苏州','吴江区','2,3',1,0,1491471346);

UNLOCK TABLES;

/*Table structure for table `robam_shop_goods` */

DROP TABLE IF EXISTS `robam_shop_goods`;

CREATE TABLE `robam_shop_goods` (
  `goods_id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '商品名称',
  `category_id` int(11) DEFAULT NULL COMMENT '产品分类',
  `cover` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '封面图',
  `thumb` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '缩略图',
  `scenegraph` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '场景图',
  `description` text COLLATE utf8_unicode_ci COMMENT '描述',
  `price_market` float(20,0) DEFAULT '0' COMMENT '市场价',
  `price_sales` float(20,0) NOT NULL COMMENT '销售价',
  `reward_rate` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '提成',
  `outlink` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '外链',
  `sort_id` int(11) DEFAULT '1' COMMENT '燃料',
  `fuel` varchar(128) COLLATE utf8_unicode_ci DEFAULT '0' COMMENT '颜色',
  `color` varchar(128) COLLATE utf8_unicode_ci DEFAULT '' COMMENT '推荐商品，以逗号相隔',
  `status` tinyint(1) DEFAULT '2' COMMENT '2 在售商品 1 待售商品 0 下架商品',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(11) DEFAULT '0' COMMENT '修改时间',
  `price_game` float(20,0) DEFAULT NULL COMMENT '活动价格',
  `game_start` int(11) DEFAULT NULL COMMENT '活动开始时间',
  `game_end` int(11) DEFAULT NULL COMMENT '活动结束时间',
  PRIMARY KEY (`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='商品明细表';

/*Data for the table `robam_shop_goods` */

LOCK TABLES `robam_shop_goods` WRITE;

insert  into `robam_shop_goods`(`goods_id`,`goods_name`,`category_id`,`cover`,`thumb`,`scenegraph`,`description`,`price_market`,`price_sales`,`reward_rate`,`outlink`,`sort_id`,`fuel`,`color`,`status`,`create_time`,`update_time`,`price_game`,`game_start`,`game_end`) values (1,'测试商品1',2,NULL,'/Uploads/Picture/2017-02-21/58ac06e04fc2a.jpg',NULL,'<ul class=\"f-side-ul\" style=\"font-size:medium;font-family:\'PingFang SC\', PingHei, STHeitiSC-Light, \'Myriad Set Pro\', \'Lucida Grande\', \'Helvetica Neue\', Helvetica, \'microsoft yahei\', SimHei, tahoma, Arial, Verdana, sans-serif;vertical-align:baseline;text-align:center;background-color:#FFFFFF;\">\r\n	<li style=\"font-style:inherit;font-weight:inherit;font-size:inherit;font-family:inherit;vertical-align:baseline;\">\r\n		<h2 style=\"font-style:inherit;font-weight:inherit;font-size:24px;font-family:inherit;vertical-align:baseline;color:#555555;text-align:left;\">\r\n			尺寸参数\r\n		</h2>\r\n	</li>\r\n	<li style=\"font-style:inherit;font-weight:inherit;font-size:inherit;font-family:inherit;vertical-align:baseline;\">\r\n		<span style=\"font-style:inherit;font-weight:inherit;font-size:16px;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#777777;\">额定热负荷</span><span style=\"font-style:inherit;font-weight:inherit;font-size:16px;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#777777;\">热效率</span><span style=\"font-style:inherit;font-weight:inherit;font-size:16px;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#777777;\">净重</span><span style=\"font-style:inherit;font-weight:inherit;font-size:16px;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#777777;\">外形尺寸（长x宽x高)</span><span style=\"font-style:inherit;font-weight:inherit;font-size:16px;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#777777;\">挖孔尺寸(长x宽-倒角)</span><span style=\"font-style:inherit;font-weight:inherit;font-size:16px;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#777777;\">电源电压及频率</span><span style=\"font-style:inherit;font-weight:inherit;font-size:16px;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#777777;\">面板材质</span><span style=\"font-style:inherit;font-weight:inherit;font-size:16px;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#777777;\">灶眼数</span><span style=\"font-style:inherit;font-weight:inherit;font-size:16px;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#777777;\">点火方式</span><span style=\"font-style:inherit;font-weight:inherit;font-size:16px;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#777777;\">进风方式</span><span style=\"font-style:inherit;font-weight:inherit;font-size:16px;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#777777;\">能效等级</span><span style=\"font-style:inherit;font-weight:inherit;font-size:16px;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#777777;\">适用气源</span><span style=\"font-style:inherit;font-weight:inherit;font-size:16px;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#777777;\">燃气接口</span> \r\n	</li>\r\n	<li style=\"font-style:inherit;font-weight:inherit;font-size:inherit;font-family:inherit;vertical-align:baseline;\">\r\n		<span style=\"font-style:inherit;font-weight:inherit;font-size:16px;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#777777;\">4.0kw (T/Y)</span><span style=\"font-style:inherit;font-weight:inherit;font-size:16px;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#777777;\">63%（T/Y）</span><span style=\"font-style:inherit;font-weight:inherit;font-size:16px;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#777777;\">10.8kg</span><span style=\"font-style:inherit;font-weight:inherit;font-size:16px;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#777777;\">780×450×162mm</span><span style=\"font-style:inherit;font-weight:inherit;font-size:16px;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#777777;\">703x403 4xR15mm</span><span style=\"font-style:inherit;font-weight:inherit;font-size:16px;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#777777;\">220V／50Hz</span><span style=\"font-style:inherit;font-weight:inherit;font-size:16px;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#777777;\">不锈钢</span><span style=\"font-style:inherit;font-weight:inherit;font-size:16px;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#777777;\">2</span><span style=\"font-style:inherit;font-weight:inherit;font-size:16px;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#777777;\">电子脉冲式</span><span style=\"font-style:inherit;font-weight:inherit;font-size:16px;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#777777;\">全进风</span><span style=\"font-style:inherit;font-weight:inherit;font-size:16px;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#777777;\">一级</span><span style=\"font-style:inherit;font-weight:inherit;font-size:16px;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#777777;\">液化石油气、天然气、人工燃气</span><span style=\"font-style:inherit;font-weight:inherit;font-size:16px;line-height:inherit;font-family:inherit;vertical-align:baseline;color:#777777;\">Φ9.5mm燃气专用橡胶管(G1/2\'英寸燃气专用金属软管)</span> \r\n	</li>\r\n</ul>',120,100,'10',NULL,1,'1,2',NULL,2,1487669026,1491297990,12,1491211560,1491470760);

UNLOCK TABLES;

/*Table structure for table `robam_shop_goods_fuel` */

DROP TABLE IF EXISTS `robam_shop_goods_fuel`;

CREATE TABLE `robam_shop_goods_fuel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fuel_name` varchar(128) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `robam_shop_goods_fuel` */

LOCK TABLES `robam_shop_goods_fuel` WRITE;

insert  into `robam_shop_goods_fuel`(`id`,`fuel_name`,`status`) values (1,'天然气',1),(2,'液化气',1);

UNLOCK TABLES;

/*Table structure for table `robam_shop_home` */

DROP TABLE IF EXISTS `robam_shop_home`;

CREATE TABLE `robam_shop_home` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banner` text NOT NULL COMMENT '轮播图',
  `hot` text NOT NULL COMMENT '热销产品',
  `start` text NOT NULL COMMENT '明星产品',
  `status` tinyint(4) NOT NULL COMMENT '状态',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='首页';

/*Data for the table `robam_shop_home` */

LOCK TABLES `robam_shop_home` WRITE;

insert  into `robam_shop_home`(`id`,`banner`,`hot`,`start`,`status`,`create_time`,`update_time`) values (1,'{\"1\":{\"thumb\":\"\\/Uploads\\/Picture\\/2017-03-24\\/58d46f7e87cfa.jpg\",\"thumb_link\":\"http:\\/\\/www.baidu.com\"},\"2\":{\"thumb\":\"\\/Uploads\\/Picture\\/2017-03-23\\/58d37c2fe3f4a.jpg\",\"thumb_link\":\"1\"},\"3\":{\"thumb\":\"\\/Uploads\\/Picture\\/2017-03-24\\/58d471b5002a9.jpg\",\"thumb_link\":\"1\"}}','{\"1\":{\"thumb\":\"\\/Uploads\\/Picture\\/2017-03-23\\/58d37c24b9903.jpg\",\"thumb_link\":\"1\"},\"2\":{\"thumb\":\"\\/Uploads\\/Picture\\/2017-03-24\\/58d471d51f21e.png\",\"thumb_link\":\"1\"},\"3\":{\"thumb\":\"\\/Uploads\\/Picture\\/2017-03-24\\/58d471dc01718.JPG\",\"thumb_link\":\"1\"},\"4\":{\"thumb\":\"\\/Uploads\\/Picture\\/2017-03-23\\/58d37c58372da.JPG\",\"thumb_link\":\"1\"},\"5\":{\"thumb\":\"\\/Uploads\\/Picture\\/2017-03-23\\/58d37c58372da.JPG\",\"thumb_link\":\"1\"},\"6\":{\"thumb\":\"\\/Uploads\\/Picture\\/2017-03-23\\/58d37c5e42fb4.JPG\",\"thumb_link\":\"1\"}}','{\"1\":{\"thumb\":\"\\/Uploads\\/Picture\\/2017-03-24\\/58d471ba8a6d7.JPG\",\"thumb_link\":\"1\"},\"2\":{\"thumb\":\"\\/Uploads\\/Picture\\/2017-03-24\\/58d471bee06d0.JPG\",\"thumb_link\":\"1\"}}',1,1490088839,1491368911);

UNLOCK TABLES;

/*Table structure for table `robam_shop_notice` */

DROP TABLE IF EXISTS `robam_shop_notice`;

CREATE TABLE `robam_shop_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(128) NOT NULL DEFAULT '0' COMMENT '用户id 0:系统公告，面向全部用户',
  `title` varchar(128) NOT NULL COMMENT '消息标题',
  `msg` text NOT NULL COMMENT '消息内容',
  `is_read` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否阅读',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `robam_shop_notice` */

LOCK TABLES `robam_shop_notice` WRITE;

insert  into `robam_shop_notice`(`id`,`user_id`,`title`,`msg`,`is_read`,`status`,`create_time`,`update_time`) values (1,'0','您的服务单已经完成333','您好,您提交的服务单276054390已经处理完成，可以点击已解决之后进行评论；如果还有其他疑问,请您选择\"未解决\"，我们会尽快回复.',1,0,1487317512,1491291458),(2,'0','系统消息','第一季度大力推广油烟机，提成比例可上调',1,1,1487317512,1491291515);

UNLOCK TABLES;

/*Table structure for table `robam_shop_task` */

DROP TABLE IF EXISTS `robam_shop_task`;

CREATE TABLE `robam_shop_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(128) NOT NULL COMMENT '用户id',
  `year` int(4) NOT NULL COMMENT '年度',
  `season` char(1) NOT NULL COMMENT '季度 1,2,3,4',
  `task` varchar(128) NOT NULL COMMENT '任务指标',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `robam_shop_task` */

LOCK TABLES `robam_shop_task` WRITE;

insert  into `robam_shop_task`(`id`,`user_id`,`year`,`season`,`task`,`status`,`create_time`,`update_time`) values (1,'10',2017,'1','20000.00',1,1487676667,1488010238),(2,'10',2017,'2','20000.00',1,1,1488010238),(3,'10',2017,'3','20000.00',1,1,1488010238),(6,'10',2017,'4','20000.00',1,1487676962,1488010238),(7,'11',2017,'1','{\"100\":\"1\",\"110\":\"10\"}',1,1487677151,1490079134),(8,'11',2017,'2','{\"200\":\"2\",\"220\":\"20\"}',1,1487677314,1490079134),(9,'11',2017,'3','{\"300\":\"3\",\"330\":\"30\"}',1,1487677314,1490079134),(10,'11',2017,'4','{\"400\":\"4\",\"440\":\"40\"}',1,1487677314,1490079134),(11,'11',2017,'5','{\"500\":\"5\",\"550\":\"50\"}',1,1490078442,1490079134),(12,'16',2017,'1','{\"100\":\"2\",\"200\":\"2\"}',1,0,1491446588),(13,'16',2017,'2','{\"23\":\"3\",\"44\":\"5\"}',1,0,1491446588),(14,'16',2017,'3','{\"2\":\"3\",\"3\":\"4\"}',1,0,1491446588),(15,'16',2017,'4','{\"100\":\"1\"}',1,0,1491446588),(16,'16',2017,'5','{\"3\":\"3\"}',1,0,1491446588);

UNLOCK TABLES;

/*Table structure for table `robam_ucenter_admin` */

DROP TABLE IF EXISTS `robam_ucenter_admin`;

CREATE TABLE `robam_ucenter_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '管理员用户ID',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '管理员状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员表';

/*Data for the table `robam_ucenter_admin` */

LOCK TABLES `robam_ucenter_admin` WRITE;

UNLOCK TABLES;

/*Table structure for table `robam_ucenter_app` */

DROP TABLE IF EXISTS `robam_ucenter_app`;

CREATE TABLE `robam_ucenter_app` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '应用ID',
  `title` varchar(30) NOT NULL COMMENT '应用名称',
  `url` varchar(100) NOT NULL COMMENT '应用URL',
  `ip` char(15) NOT NULL COMMENT '应用IP',
  `auth_key` varchar(100) NOT NULL COMMENT '加密KEY',
  `sys_login` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '同步登陆',
  `allow_ip` varchar(255) NOT NULL COMMENT '允许访问的IP',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '应用状态',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='应用表';

/*Data for the table `robam_ucenter_app` */

LOCK TABLES `robam_ucenter_app` WRITE;

UNLOCK TABLES;

/*Table structure for table `robam_ucenter_member` */

DROP TABLE IF EXISTS `robam_ucenter_member`;

CREATE TABLE `robam_ucenter_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` char(16) NOT NULL COMMENT '账号',
  `password` char(32) NOT NULL COMMENT '密码',
  `email` char(32) NOT NULL COMMENT '用户邮箱',
  `mobile` char(15) NOT NULL COMMENT '用户手机',
  `reg_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `reg_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '注册IP',
  `last_login_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_login_ip` bigint(20) NOT NULL DEFAULT '0' COMMENT '最后登录IP',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) DEFAULT '0' COMMENT '用户状态',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='用户表';

/*Data for the table `robam_ucenter_member` */

LOCK TABLES `robam_ucenter_member` WRITE;

insert  into `robam_ucenter_member`(`id`,`username`,`password`,`email`,`mobile`,`reg_time`,`reg_ip`,`last_login_time`,`last_login_ip`,`update_time`,`status`) values (1,'Administrator','74ed9a836b249807a21ee82485ab7f51','suongyongct@boe.com.cn','15995850157',1486198171,2130706433,1491470436,2130706433,1486198171,1),(10,'test','74ed9a836b249807a21ee82485ab7f51','122333@qq.com','1626622',1486359759,2130706433,1491470539,2130706433,1491471377,1),(11,'sunyong','74ed9a836b249807a21ee82485ab7f51','173058129@qq.com','1995850157',1487582188,2130706433,1491286729,2130706433,1490066665,1),(2,'admin','74ed9a836b249807a21ee82485ab7f51','test@test.com','1599111111',1487582981,2130706433,0,0,1487582981,1),(16,'wanghua','74ed9a836b249807a21ee82485ab7f51','1111123666642@qq.com','15995555772',1490059744,2130706433,0,0,1490066595,1);

UNLOCK TABLES;

/*Table structure for table `robam_ucenter_setting` */

DROP TABLE IF EXISTS `robam_ucenter_setting`;

CREATE TABLE `robam_ucenter_setting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '设置ID',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置类型（1-用户配置）',
  `value` text NOT NULL COMMENT '配置数据',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='设置表';

/*Data for the table `robam_ucenter_setting` */

LOCK TABLES `robam_ucenter_setting` WRITE;

UNLOCK TABLES;

/*Table structure for table `robam_url` */

DROP TABLE IF EXISTS `robam_url`;

CREATE TABLE `robam_url` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '链接唯一标识',
  `url` char(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `short` char(100) NOT NULL DEFAULT '' COMMENT '短网址',
  `status` tinyint(2) NOT NULL DEFAULT '2' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_url` (`url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='链接表';

/*Data for the table `robam_url` */

LOCK TABLES `robam_url` WRITE;

UNLOCK TABLES;

/*Table structure for table `robam_userdata` */

DROP TABLE IF EXISTS `robam_userdata`;

CREATE TABLE `robam_userdata` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `type` tinyint(3) unsigned NOT NULL COMMENT '类型标识',
  `target_id` int(10) unsigned NOT NULL COMMENT '目标id',
  UNIQUE KEY `uid` (`uid`,`type`,`target_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `robam_userdata` */

LOCK TABLES `robam_userdata` WRITE;

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
