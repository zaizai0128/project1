/*
SQLyog Ultimate v11.24 (64 bit)
MySQL - 5.6.12-log : Database - lagou
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`lagou` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `lagou`;

/*Table structure for table `lg_admin` */

DROP TABLE IF EXISTS `lg_admin`;

CREATE TABLE `lg_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码',
  `gid` int(11) NOT NULL DEFAULT '1' COMMENT '用户组',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态1开启0关闭',
  `create_time` int(11) NOT NULL COMMENT '注册时间',
  `login_time` int(11) NOT NULL COMMENT '登陆时间',
  `login_ip` int(11) NOT NULL COMMENT '登陆ip',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `lg_admin` */

insert  into `lg_admin`(`id`,`username`,`password`,`gid`,`status`,`create_time`,`login_time`,`login_ip`) values (1,'zaizai','e10adc3949ba59abbe56e057f20f883e',1,1,0,1414985836,2130706433);

/*Table structure for table `lg_company` */

DROP TABLE IF EXISTS `lg_company`;

CREATE TABLE `lg_company` (
  `id` int(11) unsigned NOT NULL COMMENT '企业id',
  `name` varchar(50) NOT NULL COMMENT '企业名称',
  `short_name` varchar(20) NOT NULL COMMENT '企业简称',
  `tel` varchar(20) NOT NULL COMMENT '企业电话',
  `email` varchar(100) NOT NULL COMMENT '企业邮箱',
  `logo` varchar(255) NOT NULL COMMENT '企业logo',
  `web` varchar(255) NOT NULL COMMENT '企业网站',
  `city` varchar(10) NOT NULL COMMENT '所在城市',
  `scale` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '公司规模人数',
  `stage` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '发展阶段',
  `desc` text NOT NULL COMMENT '公司介绍',
  `one_desc` varchar(50) NOT NULL COMMENT '一句话介绍公司',
  `state` tinyint(3) NOT NULL DEFAULT '0' COMMENT '状态1已认证0禁用-1未验证2未认证',
  `step` tinyint(4) NOT NULL DEFAULT '0' COMMENT '注册步骤',
  `trade` varchar(20) NOT NULL COMMENT '公司领域',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='公司表';

/*Data for the table `lg_company` */

insert  into `lg_company`(`id`,`name`,`short_name`,`tel`,`email`,`logo`,`web`,`city`,`scale`,`stage`,`desc`,`one_desc`,`state`,`step`,`trade`) values (1,'北京布袋谷科技有限公司-宋明伟','布袋谷','18701500429','247678652@qq.com','/Uploads/Company/Logo/1.JPEG','www.budaigu.com','北京',0,0,'宋明伟的小公司','小吃货',1,5,'移动互联网'),(2,'没有','','18612666432','247678652@qq.com','','','',0,0,'','',-1,5,''),(3,'大家好','大家好','18612666432','247678652@qq.com','/Uploads/Company/Logo/3.JPEG','www.baidu.com','北京',0,0,'','恩恩额',2,5,'O2O,电子商务');

/*Table structure for table `lg_company_jobcate` */

DROP TABLE IF EXISTS `lg_company_jobcate`;

CREATE TABLE `lg_company_jobcate` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `company_id` int(11) NOT NULL COMMENT '公司id',
  `cate_id` int(11) NOT NULL COMMENT '职位id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `lg_company_jobcate` */

/*Table structure for table `lg_company_tag` */

DROP TABLE IF EXISTS `lg_company_tag`;

CREATE TABLE `lg_company_tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `company_id` int(11) unsigned NOT NULL COMMENT '企业id',
  `tag_id` int(11) unsigned NOT NULL COMMENT '标签id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=243 DEFAULT CHARSET=utf8 COMMENT='公司和标签的中间表';

/*Data for the table `lg_company_tag` */

insert  into `lg_company_tag`(`id`,`company_id`,`tag_id`) values (236,1,3),(237,1,8),(238,1,13),(239,1,14),(240,1,18),(241,1,20),(242,1,34);

/*Table structure for table `lg_education` */

DROP TABLE IF EXISTS `lg_education`;

CREATE TABLE `lg_education` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `rid` int(11) unsigned NOT NULL COMMENT '简历id',
  `school` varchar(50) NOT NULL COMMENT '学校名称',
  `education` varchar(20) NOT NULL COMMENT '学历',
  `professional` varchar(30) NOT NULL COMMENT '专业',
  `begin_time` varchar(20) NOT NULL COMMENT '开始时间',
  `end_time` varchar(20) NOT NULL COMMENT '结束时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='教育背景表';

/*Data for the table `lg_education` */

insert  into `lg_education`(`id`,`rid`,`school`,`education`,`professional`,`begin_time`,`end_time`) values (1,2,'辽宁医学院','本科','护理','2012','2008');

/*Table structure for table `lg_hopejob` */

DROP TABLE IF EXISTS `lg_hopejob`;

CREATE TABLE `lg_hopejob` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `rid` int(11) NOT NULL COMMENT '简历id',
  `city` varchar(10) NOT NULL COMMENT '期望工作城市',
  `nature` varchar(20) NOT NULL COMMENT '工作性质',
  `job` varchar(20) NOT NULL COMMENT '职位',
  `salary` varchar(20) NOT NULL COMMENT '薪资',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `lg_hopejob` */

insert  into `lg_hopejob`(`id`,`rid`,`city`,`nature`,`job`,`salary`) values (1,2,'北京','全职','PHP','5k-10k');

/*Table structure for table `lg_job` */

DROP TABLE IF EXISTS `lg_job`;

CREATE TABLE `lg_job` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '职位id',
  `company_id` int(11) unsigned NOT NULL COMMENT '公司id',
  `name` varchar(50) NOT NULL COMMENT '职位名称',
  `branch` varchar(50) NOT NULL COMMENT '所属部门',
  `salary_high` float NOT NULL COMMENT '最高薪资',
  `salary_low` float NOT NULL COMMENT '最低薪资',
  `city` varchar(10) NOT NULL COMMENT '职位所在城市',
  `work_year` varchar(10) NOT NULL DEFAULT '0' COMMENT '工作经验',
  `edu` varchar(10) NOT NULL DEFAULT '0' COMMENT '学历',
  `nature` varchar(10) NOT NULL DEFAULT '0' COMMENT '工作性质',
  `welfare` varchar(100) NOT NULL COMMENT '福利，职位诱惑',
  `desc` text NOT NULL COMMENT '职位描述',
  `state` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态1正常0关闭',
  `address` varchar(50) NOT NULL COMMENT '职位所在地址',
  `email` varchar(50) NOT NULL COMMENT '接收简历的邮箱',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `modify_time` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='职位表';

/*Data for the table `lg_job` */

insert  into `lg_job`(`id`,`company_id`,`name`,`branch`,`salary_high`,`salary_low`,`city`,`work_year`,`edu`,`nature`,`welfare`,`desc`,`state`,`address`,`email`,`create_time`,`modify_time`) values (1,1,'333333333','啊啊',3,2,'上海','不限','不限','全职','阿黑哥范德萨','上浮空间的发短信说风格',1,'菊花怪副队长','',0,0),(2,1,'333333333','技术',3,2,'北京','1年以下','本科','全职','好职位','非常非常好的职位,任你来选',1,'北京昌平区','',1415431133,0);

/*Table structure for table `lg_job_category` */

DROP TABLE IF EXISTS `lg_job_category`;

CREATE TABLE `lg_job_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '职位分类id',
  `pid` int(11) unsigned NOT NULL COMMENT '父id',
  `name` varchar(30) NOT NULL COMMENT '职位分类名称',
  `path` varchar(255) NOT NULL COMMENT '路径',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COMMENT='职位类别表';

/*Data for the table `lg_job_category` */

insert  into `lg_job_category`(`id`,`pid`,`name`,`path`) values (1,0,'技术','0'),(2,0,'产品','0'),(3,0,'设计','0'),(4,0,'运营','0'),(5,0,'市场与销售','0'),(6,0,'职能','0'),(7,1,'前端开发','0_1'),(8,7,'HTML5','0_1_7'),(9,7,'Javascript','0_1_7'),(10,7,'UI','0_1_7'),(11,1,'后端开发','0_1'),(12,11,'PHP','0_1_11'),(13,11,'JAVA','0_1_11'),(14,11,'C','0_1_11'),(15,11,'C++','0_1_11'),(16,11,'后端其他开发','0_11_11'),(18,1,'移动开发','0_1'),(19,18,'IOS','0_1_18'),(20,18,'WP','0_1_18'),(21,18,'Android','0_1_18'),(22,2,'产品经理','0_2'),(23,22,'产品助理','0_2_22'),(24,3,'视觉设计','0_3'),(25,24,'视觉设计师','0_3_24'),(26,3,'交互设计','0_3'),(27,26,'交互设计师','0_3_26'),(28,4,'运营','0_4'),(29,28,'用户运营','0_4_28'),(30,28,'产品运营','0_4_28'),(31,4,'编辑','0_4'),(32,31,'副编辑','0_4_31'),(33,31,'主编辑','0_4_31'),(34,5,'市场与营销','0_5'),(35,34,'市场营销','0_5_34'),(36,5,'公关','0_5'),(37,36,'媒介经理','0_5_36'),(38,5,'销售','0_5'),(39,38,'销售专员','0_5_38'),(40,38,'销售经理','0_5_38'),(41,6,'人力资源','0_6'),(42,41,'人力资源','0_6_41'),(43,41,'招聘','0_6_41'),(44,6,'行政','0_6'),(45,44,'助力','0_6_44'),(46,44,'前台','0_6_44'),(47,6,'财务','0_6'),(48,47,'会计','0_6_47'),(49,47,'出纳','0_6_47'),(50,6,'法务','0_6'),(51,50,'律师','0_6_50'),(52,50,'法务','0_6_50');

/*Table structure for table `lg_product` */

DROP TABLE IF EXISTS `lg_product`;

CREATE TABLE `lg_product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '产品id',
  `company_id` int(11) unsigned NOT NULL COMMENT '公司id',
  `name` varchar(30) NOT NULL COMMENT '产品名称',
  `image` varchar(255) NOT NULL COMMENT '产品图片',
  `link` varchar(255) NOT NULL COMMENT '产品链接',
  `desc` text NOT NULL COMMENT '产品介绍',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='公司产品表';

/*Data for the table `lg_product` */

insert  into `lg_product`(`id`,`company_id`,`name`,`image`,`link`,`desc`) values (7,2,'清风','/Uploads/Company/Product/1_myfiles1.JPEG','budaigu.com','仔仔的第一个个人项目'),(15,1,'拉勾网','/Uploads/Company/Product/1_myfiles1.JPEG','lagou.me','仔仔的第一个项目');

/*Table structure for table `lg_project` */

DROP TABLE IF EXISTS `lg_project`;

CREATE TABLE `lg_project` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `rid` int(11) unsigned NOT NULL COMMENT '简历id',
  `name` varchar(30) NOT NULL COMMENT '项目名称',
  `job` varchar(30) NOT NULL COMMENT '职务',
  `begin_yeartime` varchar(20) NOT NULL COMMENT '开始年份',
  `begin_monthtime` varchar(20) NOT NULL COMMENT '开始月份',
  `end_yeartime` varchar(20) NOT NULL COMMENT '结束年份',
  `end_monthtime` varchar(20) NOT NULL COMMENT '结束月份',
  `description` text NOT NULL COMMENT '项目介绍',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='项目经验表';

/*Data for the table `lg_project` */

insert  into `lg_project`(`id`,`rid`,`name`,`job`,`begin_yeartime`,`begin_monthtime`,`end_yeartime`,`end_monthtime`,`description`) values (1,2,'无','无','2014','01','至今','至今','呜呜呜呜');

/*Table structure for table `lg_resume` */

DROP TABLE IF EXISTS `lg_resume`;

CREATE TABLE `lg_resume` (
  `id` int(11) unsigned NOT NULL COMMENT '简历id',
  `name` varchar(30) NOT NULL COMMENT '真实姓名',
  `sex` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '0女1男',
  `education` varchar(10) NOT NULL COMMENT '学历',
  `work_year` varchar(20) NOT NULL COMMENT '工作年限',
  `phone` varchar(11) NOT NULL COMMENT '手机号',
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `now_state` varchar(20) NOT NULL COMMENT '目前状态',
  `image` varchar(50) NOT NULL COMMENT '头像',
  `introduction` text NOT NULL COMMENT '个人介绍',
  `deliver` tinyint(2) NOT NULL DEFAULT '0' COMMENT '投递设置0在线1附件',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `modify_time` int(11) NOT NULL COMMENT '更新时间',
  `annex` varchar(50) NOT NULL COMMENT '附件简历文件地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='简历表';

/*Data for the table `lg_resume` */

insert  into `lg_resume`(`id`,`name`,`sex`,`education`,`work_year`,`phone`,`email`,`now_state`,`image`,`introduction`,`deliver`,`create_time`,`modify_time`,`annex`) values (1,'jingjing',0,'本科','2年','18612666432','247678652@qq.com','我目前正在职，正考虑换个新环境','1.jpeg','',0,0,1415372604,''),(2,'王征',0,'本科','2年','18612666432','247678652@qq.com','我目前已离职，可快速到岗','2.jpeg','西IIIIIIii',0,0,1415283851,''),(3,'',1,'','','','','','','',0,0,0,'');

/*Table structure for table `lg_send` */

DROP TABLE IF EXISTS `lg_send`;

CREATE TABLE `lg_send` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户id',
  `company_id` int(11) unsigned NOT NULL COMMENT '企业id',
  `job_id` int(11) unsigned NOT NULL COMMENT '职位id',
  `send_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '投递类型0在线1附件',
  `state1` tinyint(4) NOT NULL DEFAULT '0' COMMENT '第一步状态0未完成1完成',
  `state1_time` int(11) NOT NULL COMMENT '第一步状态完成时间',
  `state2` tinyint(4) NOT NULL DEFAULT '0' COMMENT '第二步',
  `state2_time` int(11) NOT NULL,
  `state3` tinyint(4) NOT NULL DEFAULT '0' COMMENT '第三步',
  `state3_time` int(11) NOT NULL,
  `state4` tinyint(4) NOT NULL DEFAULT '0' COMMENT '第四步0未操作1面试-1不合格',
  `state4_time` int(11) NOT NULL,
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='简历投递表';

/*Data for the table `lg_send` */

/*Table structure for table `lg_show_works` */

DROP TABLE IF EXISTS `lg_show_works`;

CREATE TABLE `lg_show_works` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `rid` int(11) unsigned NOT NULL COMMENT '简历id',
  `link` varchar(100) NOT NULL COMMENT '作品外连',
  `description` varchar(100) NOT NULL COMMENT '作品说明',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='作品展示表';

/*Data for the table `lg_show_works` */

insert  into `lg_show_works`(`id`,`rid`,`link`,`description`) values (1,2,'www.baidu.com','百度');

/*Table structure for table `lg_tag` */

DROP TABLE IF EXISTS `lg_tag`;

CREATE TABLE `lg_tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '标签id',
  `name` varchar(11) NOT NULL COMMENT '标签名称',
  `state` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态1开启0关闭',
  `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '类别:0自定义1薪酬激励2员工福利3员工关怀4其他',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COMMENT='公司标签表';

/*Data for the table `lg_tag` */

insert  into `lg_tag`(`id`,`name`,`state`,`type`) values (1,'年终分红',1,1),(2,'绩效奖金',1,1),(3,'股票期权',1,1),(4,'专项奖金',1,1),(5,'年底双薪',1,1),(6,'五险一金',1,2),(7,'通讯津贴',1,2),(8,'交通补助',1,2),(9,'带薪年假',1,2),(10,'免费班车',1,3),(11,'节日礼物',1,3),(12,'年度旅游',1,3),(13,'弹性工作',1,3),(14,'定期体检',1,3),(15,'午餐津贴',1,3),(16,'岗位晋升',1,4),(17,'技能培训',1,4),(18,'管理规范',1,4),(19,'扁平管理',1,4),(20,'领导好',1,4),(21,'美女多',1,4),(22,'帅哥多',1,4),(31,'哈哈哈',1,0),(32,'嘻嘻嘻',1,0),(33,'ko',1,0),(34,'宋小宝',1,0),(35,'明明',1,0),(36,'仔仔',1,0);

/*Table structure for table `lg_team` */

DROP TABLE IF EXISTS `lg_team`;

CREATE TABLE `lg_team` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'team_id',
  `company_id` int(11) unsigned NOT NULL COMMENT '企业id',
  `name` varchar(30) NOT NULL COMMENT '姓名',
  `position` varchar(30) NOT NULL COMMENT '职位',
  `weibo` varchar(50) NOT NULL COMMENT '微博',
  `desc` text NOT NULL COMMENT '简介',
  `image` varchar(255) NOT NULL COMMENT '头像',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='公司团队表';

/*Data for the table `lg_team` */

insert  into `lg_team`(`id`,`company_id`,`name`,`position`,`weibo`,`desc`,`image`) values (28,1,'宋明伟','创始人兼CEO','','神一样的男子','/Uploads/Company/Team/1_myfiles0.png'),(29,2,'仔仔','白吃饱','','疯了一样的女子','/Uploads/Company/Team/1_myfiles1.png');

/*Table structure for table `lg_trade` */

DROP TABLE IF EXISTS `lg_trade`;

CREATE TABLE `lg_trade` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '行业id',
  `name` varchar(30) NOT NULL COMMENT '行业名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='行业领域表';

/*Data for the table `lg_trade` */

insert  into `lg_trade`(`id`,`name`) values (1,'移动互联网'),(2,'电子商务'),(3,'社交'),(4,'企业服务'),(5,'O2O'),(6,'教育'),(7,'文化艺术'),(8,'游戏'),(9,'在线旅游'),(10,'金融互联网'),(11,'健康医疗'),(12,'生活服务'),(13,'硬件'),(14,'搜索'),(15,'运动体育'),(16,'云计算\\大数据'),(17,'移动广告'),(18,'社会化营销'),(19,'视频多媒体'),(20,'媒体'),(21,'智能家居'),(22,'智能电视'),(23,'分类信息'),(24,'招聘');

/*Table structure for table `lg_user_col` */

DROP TABLE IF EXISTS `lg_user_col`;

CREATE TABLE `lg_user_col` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `job_id` int(11) NOT NULL COMMENT '职位id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `lg_user_col` */

/*Table structure for table `lg_user_send` */

DROP TABLE IF EXISTS `lg_user_send`;

CREATE TABLE `lg_user_send` (
  `id` int(11) NOT NULL COMMENT 'id',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `job_id` int(11) NOT NULL COMMENT '职位id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `lg_user_send` */

/*Table structure for table `lg_users` */

DROP TABLE IF EXISTS `lg_users`;

CREATE TABLE `lg_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '个人1 企业2',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `login_time` int(11) NOT NULL COMMENT '登录时间',
  `login_ip` int(11) NOT NULL COMMENT '登陆ip',
  `verify` varchar(32) NOT NULL DEFAULT '0' COMMENT '用户唯一验证',
  `state` tinyint(4) DEFAULT '0' COMMENT '-1禁用0未激活1正常',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户主表';

/*Data for the table `lg_users` */

insert  into `lg_users`(`id`,`username`,`password`,`type`,`create_time`,`login_time`,`login_ip`,`verify`,`state`) values (1,'jingjing','e10adc3949ba59abbe56e057f20f883e',2,0,0,0,'0',0),(3,'247678652@qq.com','e10adc3949ba59abbe56e057f20f883e',2,1415286416,0,0,'7e6ad223a0b2bc209aa91eccf088f58b',1);

/*Table structure for table `lg_work_history` */

DROP TABLE IF EXISTS `lg_work_history`;

CREATE TABLE `lg_work_history` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `rid` int(11) unsigned NOT NULL COMMENT '简历id',
  `company` varchar(50) NOT NULL COMMENT '公司名称',
  `job` varchar(20) NOT NULL COMMENT '职位名称',
  `begin_yeartime` varchar(20) NOT NULL COMMENT '开始年份',
  `begin_monthtime` varchar(20) NOT NULL COMMENT '开始月份',
  `end_yeartime` varchar(20) NOT NULL COMMENT '结束年份',
  `end_monthtime` varchar(20) NOT NULL COMMENT '结束月份',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='工作经历表';

/*Data for the table `lg_work_history` */

insert  into `lg_work_history`(`id`,`rid`,`company`,`job`,`begin_yeartime`,`begin_monthtime`,`end_yeartime`,`end_monthtime`) values (1,2,'华图教育','行政','2014','02','2014','06');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
