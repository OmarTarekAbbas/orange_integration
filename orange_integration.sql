/*
Navicat MySQL Data Transfer

Source Server         : localhost_7.3
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : orange_integration

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-11-30 11:44:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `countries`
-- ----------------------------
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of countries
-- ----------------------------

-- ----------------------------
-- Table structure for `messages`
-- ----------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MTBody` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `MTURL` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ShortnedURL` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TaqarubURL` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TaqarubResponse` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(10) unsigned NOT NULL,
  `service_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `time` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_user_id_foreign` (`user_id`),
  KEY `messages_service_id_foreign` (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of messages
-- ----------------------------

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2019_08_19_092640_create_countries_table', '1');
INSERT INTO `migrations` VALUES ('2', '2019_08_19_092640_create_messages_table', '1');
INSERT INTO `migrations` VALUES ('3', '2019_08_19_092640_create_operators_table', '1');
INSERT INTO `migrations` VALUES ('4', '2019_08_19_092640_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('5', '2019_08_19_092640_create_services_table', '1');
INSERT INTO `migrations` VALUES ('6', '2019_08_19_092640_create_users_table', '1');
INSERT INTO `migrations` VALUES ('7', '2019_08_20_121104_rename_column_messages', '1');
INSERT INTO `migrations` VALUES ('8', '2020_11_25_094317_create_orange_notifies_table', '2');
INSERT INTO `migrations` VALUES ('9', '2020_11_25_095023_create_orange_webs_table', '2');
INSERT INTO `migrations` VALUES ('10', '2020_11_25_095630_create_orange_subscribes_table', '2');
INSERT INTO `migrations` VALUES ('11', '2020_11_25_124329_create_orange_ussds_table', '2');
INSERT INTO `migrations` VALUES ('12', '2020_11_26_133243_create_provisions_table', '3');

-- ----------------------------
-- Table structure for `operators`
-- ----------------------------
DROP TABLE IF EXISTS `operators`;
CREATE TABLE `operators` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `channel` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `operators_country_id_foreign` (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of operators
-- ----------------------------

-- ----------------------------
-- Table structure for `orange_notifies`
-- ----------------------------
DROP TABLE IF EXISTS `orange_notifies`;
CREATE TABLE `orange_notifies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `req` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `response` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `msisdn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notification_result` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of orange_notifies
-- ----------------------------
INSERT INTO `orange_notifies` VALUES ('1', '<?xml version=\"1.0\" encoding=\"utf-8\" ?>\r\n    <soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">\r\n    <soapenv:Body>\r\n        <ns1:Notification xmlns:ns1=\"http://tempuri.org/\">\r\n            <ns1:Action>OPERATORSUBSCRIBE</ns1:Action>\r\n            <ns1:MSISDN>201272033505</ns1:MSISDN>\r\n            <ns1:ServiceID>1000003886</ns1:ServiceID>\r\n        </ns1:Notification>\r\n    </soapenv:Body>\r\n</soapenv:Envelope>', '<?xml version = \"1.0\" encoding =\"utf-8\"?>\n        <soap:Envelope\n            xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\"\n            xmlns:xsi = \"http://www.w3.org/2001/XMLSchema-instance\"\n            xmlns:xsd = \"http://www.w3.org/2001/XMLSchema\">\n            <soap:Body>\n                <NotificationResponse\n                    xmlns=\"http://tempuri.org/\">\n                    <NotificationResult>200</NotificationResult>\n                </NotificationResponse>\n            </soap:Body>\n        </soap:Envelope>', 'OPERATORSUBSCRIBE', '201272033505', '1000003886', '200', '2020-11-29 09:38:49', '2020-11-29 09:38:49');

-- ----------------------------
-- Table structure for `orange_subscribes`
-- ----------------------------
DROP TABLE IF EXISTS `orange_subscribes`;
CREATE TABLE `orange_subscribes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `msisdn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL COMMENT '0-notactive 1-active',
  `orange_notify_id` int(11) NOT NULL COMMENT 'orange_webs_id / orange_notifies_id',
  `table_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of orange_subscribes
-- ----------------------------
INSERT INTO `orange_subscribes` VALUES ('1', '201212513414', '1', '2', 'orange_ussds', '2020-11-29 09:26:36', '2020-11-29 09:28:23');
INSERT INTO `orange_subscribes` VALUES ('2', '201272033505', '1', '1', 'orange_notifies', '2020-11-29 09:38:49', '2020-11-29 09:38:49');
INSERT INTO `orange_subscribes` VALUES ('3', '201208138169', '0', '2', 'orange_webs', '2020-11-29 10:47:23', '2020-11-29 10:55:35');

-- ----------------------------
-- Table structure for `orange_ussds`
-- ----------------------------
DROP TABLE IF EXISTS `orange_ussds`;
CREATE TABLE `orange_ussds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `req` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `response` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `msisdn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `host` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of orange_ussds
-- ----------------------------
INSERT INTO `orange_ussds` VALUES ('1', '{\"Accept\":\"text\\/html\",\"User-Language\":\"ar\",\"User-MSISDN\":\"tel:+201212513414\",\"User-SessionId\":\"23112020215558mln\",\"Host\":\"10.240.14.156:80\",\"Connection\":\"close\",\"Content-Length\":\"0\",\"User-Agent\":\"PostmanRuntime\\/7.26.8\",\"Postman-Token\":\"2e8274fe-e8a9-4583-a1e5-9b50906cd861\",\"Accept-Encoding\":\"gzip, deflate, br\"}', '<?xml version=\"1.0\" encoding=\"UTF - 8\" ?><html><head><meta name=\"nav\" content=\"end\"></head><body>سوف يتم الاشتراك قريبا</body></html>', 'ar', '201212513414', '23112020215558mln', '10.240.14.156:80', '2020-11-29 09:26:36', '2020-11-29 09:26:36');
INSERT INTO `orange_ussds` VALUES ('2', '{\"Accept\":\"text\\/html\",\"User-Language\":\"ar\",\"User-MSISDN\":\"tel:+201212513414\",\"User-SessionId\":\"23112020215558mln\",\"Host\":\"10.240.14.156:80\",\"Connection\":\"close\",\"Content-Length\":\"0\",\"User-Agent\":\"PostmanRuntime\\/7.26.8\",\"Postman-Token\":\"fc3576e3-cfac-4c64-8611-b728e0e86196\",\"Accept-Encoding\":\"gzip, deflate, br\"}', '<?xml version=\"1.0\" encoding=\"UTF - 8\" ?><html><head><meta name=\"nav\" content=\"end\"></head><body>سوف يتم الاشتراك قريبا</body></html>', 'ar', '201212513414', '23112020215558mln', '10.240.14.156:80', '2020-11-29 09:28:22', '2020-11-29 09:28:22');

-- ----------------------------
-- Table structure for `orange_webs`
-- ----------------------------
DROP TABLE IF EXISTS `orange_webs`;
CREATE TABLE `orange_webs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `req` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `response` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `spId` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sp_password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_stamp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calling_party_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selfcare_command` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `on_bearer_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `on_result_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of orange_webs
-- ----------------------------
INSERT INTO `orange_webs` VALUES ('1', '<?xml version=\'1.0\' encoding=\'UTF-8\'?>\n<soap:Envelope xmlns:soap=\'http://www.w3.org/2003/05/soap-envelope\' xmlns:asp=\'http://smsgwpusms/wsdls/Mobinil/ASP_XML.wsdl\'>\n<soap:Header>\n<RequestSOAPHeader xmlns=\'http://www.huawei.com.cn/schema/common/v2_1\'>\n<spId>000812</spId>\n<spPassword>2a61d552f3488b8adbfa70908c794a02</spPassword>\n<timeStamp>20201129104722</timeStamp>\n</RequestSOAPHeader>\n</soap:Header>\n<soap:Body>\n<asp:AspActionRequest>\n<CC_Service_Number>2142</CC_Service_Number>\n<CC_Calling_Party_Id>201208138169</CC_Calling_Party_Id>\n<ON_Selfcare_Command>Subscribe</ON_Selfcare_Command>\n<ON_Bearer_Type>SMS</ON_Bearer_Type>\n</asp:AspActionRequest>\n</soap:Body>\n</soap:Envelope>', '<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n        <soapenv:Envelope\n        xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\"\n        xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">\n        <soapenv:Body>\n        <ns1:AspActionResult\n        xmlns:ns1=\"http://smsgwpusms/wsdls/Mobinil/ASP_XML.wsdl\">\n        <ON_Result_Code>0</ON_Result_Code>\n        <ON_Bearer_Type>SMS</ON_Bearer_Type>\n        </ns1:AspActionResult>\n        </soapenv:Body>\n        </soapenv:Envelope>', '000812', '2a61d552f3488b8adbfa70908c794a02', '20201129104722', '2142', '201208138169', 'Subscribe', 'SMS', '0', '2020-11-29 10:47:23', '2020-11-29 10:47:23');
INSERT INTO `orange_webs` VALUES ('2', '<?xml version=\'1.0\' encoding=\'UTF-8\'?>\n<soap:Envelope xmlns:soap=\'http://www.w3.org/2003/05/soap-envelope\' xmlns:asp=\'http://smsgwpusms/wsdls/Mobinil/ASP_XML.wsdl\'>\n<soap:Header>\n<RequestSOAPHeader xmlns=\'http://www.huawei.com.cn/schema/common/v2_1\'>\n<spId>000812</spId>\n<spPassword>4a783f46ee0c7caa9c496172ceb8a5dc</spPassword>\n<timeStamp>20201129105535</timeStamp>\n</RequestSOAPHeader>\n</soap:Header>\n<soap:Body>\n<asp:AspActionRequest>\n<CC_Service_Number>2142</CC_Service_Number>\n<CC_Calling_Party_Id>201208138169</CC_Calling_Party_Id>\n<ON_Selfcare_Command>Unsubscribe</ON_Selfcare_Command>\n<ON_Bearer_Type>SMS</ON_Bearer_Type>\n</asp:AspActionRequest>\n</soap:Body>\n</soap:Envelope>', '<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n        <soapenv:Envelope\n        xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\"\n        xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">\n        <soapenv:Body>\n        <ns1:AspActionResult\n        xmlns:ns1=\"http://smsgwpusms/wsdls/Mobinil/ASP_XML.wsdl\">\n        <ON_Result_Code>0</ON_Result_Code>\n        <ON_Bearer_Type>SMS</ON_Bearer_Type>\n        </ns1:AspActionResult>\n        </soapenv:Body>\n        </soapenv:Envelope>', '000812', '4a783f46ee0c7caa9c496172ceb8a5dc', '20201129105535', '2142', '201208138169', 'Unsubscribe', 'SMS', '0', '2020-11-29 10:55:35', '2020-11-29 10:55:35');

-- ----------------------------
-- Table structure for `password_resets`
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for `provisions`
-- ----------------------------
DROP TABLE IF EXISTS `provisions`;
CREATE TABLE `provisions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `req` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `response` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `spId` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `spPassword` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timeStamp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transactionId` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `msisdn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serviceId` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operationType` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdTime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `msg` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `resultCode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of provisions
-- ----------------------------
INSERT INTO `provisions` VALUES ('1', '<?xml version=\'1.0\' encoding=\'UTF-8\'?>\n<soapenv:Envelope xmlns:soapenv=\'http://schemas.xmlsoap.org/soap/envelope/\' xmlns:sen=\'http://eaidev.mobinil.com/MEAI_OnlineServices/webServices/ESchool/sendProvisionMsg_WSDL\'>\n   <soapenv:Header>\n      <v2:RequestSOAPHeader>\n         <v2:spId>000812</v2:spId>\n         <v2:spPassword>4f1748ea3fe637646ec3b50cf8cbd7d0</v2:spPassword>\n         <v2:timeStamp>20201129110908</v2:timeStamp>\n      </v2:RequestSOAPHeader>\n   </soapenv:Header>\n   <soapenv:Body>\n      <sen:sendProvisionMsg>\n         <transactionId>350000012020112911090845589</transactionId>\n         <sourceId>bob</sourceId>\n         <msisdn>201208138169</msisdn>\n         <serviceId>2142</serviceId>\n         <operationType>setUserInfo</operationType>\n         <createdTime>20201129110908</createdTime>\n         <msg><![CDATA[<?xml version=\'1.0\' encoding=\'UTF-8\'?><userInfo> <userType>1</userType>  <areaCode>23</areaCode>  <nickName>Terry</nickName>  <name>    <firstName>xx</firstName>    <middleName>yy</middleName>    <lastName>zz</lastName>  </name></userInfo>]]></msg>\n         <callBackData>abc</callBackData>\n         <extensionInfo>\n            <item>\n               <key>k1</key>\n               <value>value0</value>\n            </item>\n            <item>\n               <key>k2</key>\n               <value>value1</value>\n            </item>\n         </extensionInfo>\n      </sen:sendProvisionMsg>\n   </soapenv:Body>\n</soapenv:Envelope>', '<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n        <soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:sen=\"http://eaidev.mobinil.com/MEAI_OnlineServices/webServices/ESchool/sendProvisionMsg_WSDL\">\n   <soapenv:Header/>\n   <soapenv:Body>\n      <sen:sendProvisionMsgResponse>\n         <resultCode>00000000</resultCode>\n         <resultDescription>Success</resultDescription>\n         <msg><![CDATA[<?xml version=\"1.0\" encoding=\"UTF-8\"?><userInfo>  <userType>1</userType>  <areaCode>23</areaCode>  <nickName>Terry</nickName>  <name>    <firstName>xx</firstName>    <middleName>yy</middleName>    <lastName>zz</lastName>  </name></userInfo>]]></msg>\n         <extensionInfo>\n            <item>\n               <key>k1</key>\n               <value>value0</value>\n            </item>\n            <item>\n               <key>k2</key>\n               <value>value1</value>\n            </item>\n         </extensionInfo>\n      </sen:sendProvisionMsgResponse>\n   </soapenv:Body>\n</soapenv:Envelope>', '000812', '4f1748ea3fe637646ec3b50cf8cbd7d0', '20201129110908', '350000012020112911090845589', '201208138169', '2142', 'setUserInfo', '20201129110908', '<![CDATA[<?xml version=\'1.0\' encoding=\'UTF-8\'?><userInfo> <userType>1</userType>  <areaCode>23</areaCode>  <nickName>Terry</nickName>  <name>    <firstName>xx</firstName>    <middleName>yy</middleName>    <lastName>zz</lastName>  </name></userInfo>]]>', '00000000', '2020-11-29 11:09:08', '2020-11-29 11:09:08');

-- ----------------------------
-- Table structure for `services`
-- ----------------------------
DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operator_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `size` int(11) NOT NULL DEFAULT 800,
  `ExURL` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'http://ivas.mobi',
  PRIMARY KEY (`id`),
  KEY `services_operator_id_foreign` (`operator_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of services
-- ----------------------------

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'emad', 'super_admin@ivas.com', '$2y$10$TzQ40fe.6ThJZL66xOgbWeSUP7pb3xx3PMTvPG.kFTaz6IZ5dpwp2', '1', null, null, null);
