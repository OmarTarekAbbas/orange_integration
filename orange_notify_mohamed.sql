-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Dec 09, 2020 at 02:05 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orange_notify`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `MTBody` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `MTURL` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ShortnedURL` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TaqarubURL` text COLLATE utf8mb4_unicode_ci,
  `TaqarubResponse` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(10) UNSIGNED NOT NULL,
  `service_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `time` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_08_19_092640_create_countries_table', 1),
(2, '2019_08_19_092640_create_messages_table', 1),
(3, '2019_08_19_092640_create_operators_table', 1),
(4, '2019_08_19_092640_create_password_resets_table', 1),
(5, '2019_08_19_092640_create_services_table', 1),
(6, '2019_08_19_092640_create_users_table', 1),
(7, '2019_08_20_121104_rename_column_messages', 1),
(8, '2020_11_25_094317_create_orange_notifies_table', 2),
(9, '2020_11_25_095023_create_orange_webs_table', 2),
(10, '2020_11_25_095630_create_orange_subscribes_table', 2),
(11, '2020_11_25_124329_create_orange_ussds_table', 2),
(12, '2020_11_26_133243_create_provisions_table', 3),
(13, '2020_12_09_084008_rename_orange_webs_table', 4),
(14, '2020_12_09_084608_update_data_in_orange_subscribes_table', 4),
(15, '2020_12_09_092217_create_orange_webs_table', 4),
(16, '2020_12_09_092226_create_orange_sms_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `operators`
--

CREATE TABLE `operators` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `channel` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orange_chargings`
--

CREATE TABLE `orange_chargings` (
  `id` int(10) UNSIGNED NOT NULL,
  `req` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `response` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `msisdn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notification_result` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orange_chargings`
--

INSERT INTO `orange_chargings` (`id`, `req`, `response`, `action`, `msisdn`, `service_id`, `notification_result`, `created_at`, `updated_at`) VALUES
(1, '<?xml version=\"1.0\" encoding=\"utf-8\" ?>\r\n    <soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">\r\n    <soapenv:Body>\r\n        <ns1:Notification xmlns:ns1=\"http://tempuri.org/\">\r\n            <ns1:Action>OPERATORSUBSCRIBE</ns1:Action>\r\n            <ns1:MSISDN>201272033505</ns1:MSISDN>\r\n            <ns1:ServiceID>1000003886</ns1:ServiceID>\r\n        </ns1:Notification>\r\n    </soapenv:Body>\r\n</soapenv:Envelope>', '<?xml version = \"1.0\" encoding =\"utf-8\"?>\n        <soap:Envelope\n            xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\"\n            xmlns:xsi = \"http://www.w3.org/2001/XMLSchema-instance\"\n            xmlns:xsd = \"http://www.w3.org/2001/XMLSchema\">\n            <soap:Body>\n                <NotificationResponse\n                    xmlns=\"http://tempuri.org/\">\n                    <NotificationResult>200</NotificationResult>\n                </NotificationResponse>\n            </soap:Body>\n        </soap:Envelope>', 'OPERATORSUBSCRIBE', '201272033505', '1000003886', '200', '2020-11-29 07:38:49', '2020-11-29 07:38:49'),
(2, '<?xml version=\"1.0\" encoding=\"utf-8\" ?>\r\n    <soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">\r\n    <soapenv:Body>\r\n        <ns1:Notification xmlns:ns1=\"http://tempuri.org/\">\r\n            <ns1:Action>OPERATORSUBSCRIBE</ns1:Action>\r\n            <ns1:MSISDN>201272033505</ns1:MSISDN>\r\n            <ns1:ServiceID>1000003886</ns1:ServiceID>\r\n        </ns1:Notification>\r\n    </soapenv:Body>\r\n</soapenv:Envelope>', '<?xml version = \"1.0\" encoding =\"utf-8\"?>\n        <soap:Envelope\n            xmlns:soap=\"http://schemas.xmlsoap.org/soap/envelope/\"\n            xmlns:xsi = \"http://www.w3.org/2001/XMLSchema-instance\"\n            xmlns:xsd = \"http://www.w3.org/2001/XMLSchema\">\n            <soap:Body>\n                <NotificationResponse\n                    xmlns=\"http://tempuri.org/\">\n                    <NotificationResult>200</NotificationResult>\n                </NotificationResponse>\n            </soap:Body>\n        </soap:Envelope>', 'OPERATORSUBSCRIBE', '201272033505', '1000003886', '200', '2020-12-09 10:17:12', '2020-12-09 10:17:12');

-- --------------------------------------------------------

--
-- Table structure for table `orange_sms`
--

CREATE TABLE `orange_sms` (
  `id` int(10) UNSIGNED NOT NULL,
  `msisdn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orange_subscribes`
--

CREATE TABLE `orange_subscribes` (
  `id` int(10) UNSIGNED NOT NULL,
  `msisdn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL COMMENT '0-pending | 1-active | 2- unsub',
  `orange_channel_id` int(11) NOT NULL COMMENT 'orange_webs_id / orange_notifies_id',
  `table_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `free` tinyint(4) NOT NULL COMMENT '1- free  | 0- not free',
  `service_id` int(11) DEFAULT NULL,
  `subscribe_due_date` date DEFAULT NULL,
  `last_charge_id` int(11) DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ussd | web | sms'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orange_subscribes`
--

INSERT INTO `orange_subscribes` (`id`, `msisdn`, `active`, `orange_channel_id`, `table_name`, `created_at`, `updated_at`, `free`, `service_id`, `subscribe_due_date`, `last_charge_id`, `type`) VALUES
(1, '201212513414', 1, 2, 'orange_ussds', '2020-11-29 07:26:36', '2020-11-29 07:28:23', 0, NULL, NULL, NULL, NULL),
(2, '201272033505', 1, 1, 'orange_notifies', '2020-11-29 07:38:49', '2020-11-29 07:38:49', 0, NULL, NULL, NULL, NULL),
(3, '201208138169', 0, 2, 'orange_webs', '2020-11-29 08:47:23', '2020-11-29 08:55:35', 0, NULL, NULL, NULL, NULL),
(4, '201272033505', 1, 2, 'orange_chargings', '2020-12-09 10:17:12', '2020-12-09 10:17:12', 0, 1000003886, '2020-12-09', NULL, 'charging');

-- --------------------------------------------------------

--
-- Table structure for table `orange_sub_unsubs`
--

CREATE TABLE `orange_sub_unsubs` (
  `id` int(10) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orange_sub_unsubs`
--

INSERT INTO `orange_sub_unsubs` (`id`, `req`, `response`, `spId`, `sp_password`, `time_stamp`, `service_number`, `calling_party_id`, `selfcare_command`, `on_bearer_type`, `on_result_code`, `created_at`, `updated_at`) VALUES
(1, '<?xml version=\'1.0\' encoding=\'UTF-8\'?>\n<soap:Envelope xmlns:soap=\'http://www.w3.org/2003/05/soap-envelope\' xmlns:asp=\'http://smsgwpusms/wsdls/Mobinil/ASP_XML.wsdl\'>\n<soap:Header>\n<RequestSOAPHeader xmlns=\'http://www.huawei.com.cn/schema/common/v2_1\'>\n<spId>000812</spId>\n<spPassword>2a61d552f3488b8adbfa70908c794a02</spPassword>\n<timeStamp>20201129104722</timeStamp>\n</RequestSOAPHeader>\n</soap:Header>\n<soap:Body>\n<asp:AspActionRequest>\n<CC_Service_Number>2142</CC_Service_Number>\n<CC_Calling_Party_Id>201208138169</CC_Calling_Party_Id>\n<ON_Selfcare_Command>Subscribe</ON_Selfcare_Command>\n<ON_Bearer_Type>SMS</ON_Bearer_Type>\n</asp:AspActionRequest>\n</soap:Body>\n</soap:Envelope>', '<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n        <soapenv:Envelope\n        xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\"\n        xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">\n        <soapenv:Body>\n        <ns1:AspActionResult\n        xmlns:ns1=\"http://smsgwpusms/wsdls/Mobinil/ASP_XML.wsdl\">\n        <ON_Result_Code>0</ON_Result_Code>\n        <ON_Bearer_Type>SMS</ON_Bearer_Type>\n        </ns1:AspActionResult>\n        </soapenv:Body>\n        </soapenv:Envelope>', '000812', '2a61d552f3488b8adbfa70908c794a02', '20201129104722', '2142', '201208138169', 'Subscribe', 'SMS', '0', '2020-11-29 08:47:23', '2020-11-29 08:47:23'),
(2, '<?xml version=\'1.0\' encoding=\'UTF-8\'?>\n<soap:Envelope xmlns:soap=\'http://www.w3.org/2003/05/soap-envelope\' xmlns:asp=\'http://smsgwpusms/wsdls/Mobinil/ASP_XML.wsdl\'>\n<soap:Header>\n<RequestSOAPHeader xmlns=\'http://www.huawei.com.cn/schema/common/v2_1\'>\n<spId>000812</spId>\n<spPassword>4a783f46ee0c7caa9c496172ceb8a5dc</spPassword>\n<timeStamp>20201129105535</timeStamp>\n</RequestSOAPHeader>\n</soap:Header>\n<soap:Body>\n<asp:AspActionRequest>\n<CC_Service_Number>2142</CC_Service_Number>\n<CC_Calling_Party_Id>201208138169</CC_Calling_Party_Id>\n<ON_Selfcare_Command>Unsubscribe</ON_Selfcare_Command>\n<ON_Bearer_Type>SMS</ON_Bearer_Type>\n</asp:AspActionRequest>\n</soap:Body>\n</soap:Envelope>', '<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n        <soapenv:Envelope\n        xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\"\n        xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">\n        <soapenv:Body>\n        <ns1:AspActionResult\n        xmlns:ns1=\"http://smsgwpusms/wsdls/Mobinil/ASP_XML.wsdl\">\n        <ON_Result_Code>0</ON_Result_Code>\n        <ON_Bearer_Type>SMS</ON_Bearer_Type>\n        </ns1:AspActionResult>\n        </soapenv:Body>\n        </soapenv:Envelope>', '000812', '4a783f46ee0c7caa9c496172ceb8a5dc', '20201129105535', '2142', '201208138169', 'Unsubscribe', 'SMS', '0', '2020-11-29 08:55:35', '2020-11-29 08:55:35'),
(3, '<?xml version=\'1.0\' encoding=\'UTF-8\'?>\n<soap:Envelope xmlns:soap=\'http://www.w3.org/2003/05/soap-envelope\' xmlns:asp=\'http://smsgwpusms/wsdls/Mobinil/ASP_XML.wsdl\'>\n<soap:Header>\n<RequestSOAPHeader xmlns=\'http://www.huawei.com.cn/schema/common/v2_1\'>\n<spId>000812</spId>\n<spPassword>d639cdae6d927c49b53f4823ee8e4475</spPassword>\n<timeStamp>20201209121723</timeStamp>\n</RequestSOAPHeader>\n</soap:Header>\n<soap:Body>\n<asp:AspActionRequest>\n<CC_Service_Number>2142</CC_Service_Number>\n<CC_Calling_Party_Id>201208138169</CC_Calling_Party_Id>\n<ON_Selfcare_Command>Unsubscribe</ON_Selfcare_Command>\n<ON_Bearer_Type>SMS</ON_Bearer_Type>\n</asp:AspActionRequest>\n</soap:Body>\n</soap:Envelope>', '<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n        <soapenv:Envelope\n        xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\"\n        xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\">\n        <soapenv:Body>\n        <ns1:AspActionResult\n        xmlns:ns1=\"http://smsgwpusms/wsdls/Mobinil/ASP_XML.wsdl\">\n        <ON_Result_Code>0</ON_Result_Code>\n        <ON_Bearer_Type>SMS</ON_Bearer_Type>\n        </ns1:AspActionResult>\n        </soapenv:Body>\n        </soapenv:Envelope>', '000812', 'd639cdae6d927c49b53f4823ee8e4475', '20201209121723', '2142', '201208138169', 'Unsubscribe', 'SMS', '0', '2020-12-09 10:17:24', '2020-12-09 10:17:24');

-- --------------------------------------------------------

--
-- Table structure for table `orange_ussds`
--

CREATE TABLE `orange_ussds` (
  `id` int(10) UNSIGNED NOT NULL,
  `req` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `response` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `msisdn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `host` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orange_ussds`
--

INSERT INTO `orange_ussds` (`id`, `req`, `response`, `language`, `msisdn`, `session_id`, `host`, `created_at`, `updated_at`) VALUES
(1, '{\"Accept\":\"text\\/html\",\"User-Language\":\"ar\",\"User-MSISDN\":\"tel:+201212513414\",\"User-SessionId\":\"23112020215558mln\",\"Host\":\"10.240.14.156:80\",\"Connection\":\"close\",\"Content-Length\":\"0\",\"User-Agent\":\"PostmanRuntime\\/7.26.8\",\"Postman-Token\":\"2e8274fe-e8a9-4583-a1e5-9b50906cd861\",\"Accept-Encoding\":\"gzip, deflate, br\"}', '<?xml version=\"1.0\" encoding=\"UTF - 8\" ?><html><head><meta name=\"nav\" content=\"end\"></head><body>سوف يتم الاشتراك قريبا</body></html>', 'ar', '201212513414', '23112020215558mln', '10.240.14.156:80', '2020-11-29 07:26:36', '2020-11-29 07:26:36'),
(2, '{\"Accept\":\"text\\/html\",\"User-Language\":\"ar\",\"User-MSISDN\":\"tel:+201212513414\",\"User-SessionId\":\"23112020215558mln\",\"Host\":\"10.240.14.156:80\",\"Connection\":\"close\",\"Content-Length\":\"0\",\"User-Agent\":\"PostmanRuntime\\/7.26.8\",\"Postman-Token\":\"fc3576e3-cfac-4c64-8611-b728e0e86196\",\"Accept-Encoding\":\"gzip, deflate, br\"}', '<?xml version=\"1.0\" encoding=\"UTF - 8\" ?><html><head><meta name=\"nav\" content=\"end\"></head><body>سوف يتم الاشتراك قريبا</body></html>', 'ar', '201212513414', '23112020215558mln', '10.240.14.156:80', '2020-11-29 07:28:22', '2020-11-29 07:28:22'),
(3, '{\"Accept\":\"text\\/html\",\"User-Language\":\"ar\",\"User-MSISDN\":\"tel:+201212513414\",\"User-SessionId\":\"23112020215558mln\",\"Host\":\"10.240.14.156:80\",\"Connection\":\"close\",\"Content-Length\":\"0\",\"User-Agent\":\"PostmanRuntime\\/7.26.8\",\"Postman-Token\":\"3dcd8946-d266-4eea-9f09-156298bc300c\",\"Accept-Encoding\":\"gzip, deflate, br\"}', '<?xml version=\"1.0\" encoding=\"UTF - 8\" ?><html><head><meta name=\"nav\" content=\"end\"></head><body>سوف يتم الاشتراك قريبا</body></html>', 'ar', '201212513414', '23112020215558mln', '10.240.14.156:80', '2020-12-09 10:17:17', '2020-12-09 10:17:17');

-- --------------------------------------------------------

--
-- Table structure for table `orange_webs`
--

CREATE TABLE `orange_webs` (
  `id` int(10) UNSIGNED NOT NULL,
  `msisdn` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provisions`
--

CREATE TABLE `provisions` (
  `id` int(10) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provisions`
--

INSERT INTO `provisions` (`id`, `req`, `response`, `spId`, `spPassword`, `timeStamp`, `transactionId`, `msisdn`, `serviceId`, `operationType`, `createdTime`, `msg`, `resultCode`, `created_at`, `updated_at`) VALUES
(1, '<?xml version=\'1.0\' encoding=\'UTF-8\'?>\n<soapenv:Envelope xmlns:soapenv=\'http://schemas.xmlsoap.org/soap/envelope/\' xmlns:sen=\'http://eaidev.mobinil.com/MEAI_OnlineServices/webServices/ESchool/sendProvisionMsg_WSDL\'>\n   <soapenv:Header>\n      <v2:RequestSOAPHeader>\n         <v2:spId>000812</v2:spId>\n         <v2:spPassword>4f1748ea3fe637646ec3b50cf8cbd7d0</v2:spPassword>\n         <v2:timeStamp>20201129110908</v2:timeStamp>\n      </v2:RequestSOAPHeader>\n   </soapenv:Header>\n   <soapenv:Body>\n      <sen:sendProvisionMsg>\n         <transactionId>350000012020112911090845589</transactionId>\n         <sourceId>bob</sourceId>\n         <msisdn>201208138169</msisdn>\n         <serviceId>2142</serviceId>\n         <operationType>setUserInfo</operationType>\n         <createdTime>20201129110908</createdTime>\n         <msg><![CDATA[<?xml version=\'1.0\' encoding=\'UTF-8\'?><userInfo> <userType>1</userType>  <areaCode>23</areaCode>  <nickName>Terry</nickName>  <name>    <firstName>xx</firstName>    <middleName>yy</middleName>    <lastName>zz</lastName>  </name></userInfo>]]></msg>\n         <callBackData>abc</callBackData>\n         <extensionInfo>\n            <item>\n               <key>k1</key>\n               <value>value0</value>\n            </item>\n            <item>\n               <key>k2</key>\n               <value>value1</value>\n            </item>\n         </extensionInfo>\n      </sen:sendProvisionMsg>\n   </soapenv:Body>\n</soapenv:Envelope>', '<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n        <soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:sen=\"http://eaidev.mobinil.com/MEAI_OnlineServices/webServices/ESchool/sendProvisionMsg_WSDL\">\n   <soapenv:Header/>\n   <soapenv:Body>\n      <sen:sendProvisionMsgResponse>\n         <resultCode>00000000</resultCode>\n         <resultDescription>Success</resultDescription>\n         <msg><![CDATA[<?xml version=\"1.0\" encoding=\"UTF-8\"?><userInfo>  <userType>1</userType>  <areaCode>23</areaCode>  <nickName>Terry</nickName>  <name>    <firstName>xx</firstName>    <middleName>yy</middleName>    <lastName>zz</lastName>  </name></userInfo>]]></msg>\n         <extensionInfo>\n            <item>\n               <key>k1</key>\n               <value>value0</value>\n            </item>\n            <item>\n               <key>k2</key>\n               <value>value1</value>\n            </item>\n         </extensionInfo>\n      </sen:sendProvisionMsgResponse>\n   </soapenv:Body>\n</soapenv:Envelope>', '000812', '4f1748ea3fe637646ec3b50cf8cbd7d0', '20201129110908', '350000012020112911090845589', '201208138169', '2142', 'setUserInfo', '20201129110908', '<![CDATA[<?xml version=\'1.0\' encoding=\'UTF-8\'?><userInfo> <userType>1</userType>  <areaCode>23</areaCode>  <nickName>Terry</nickName>  <name>    <firstName>xx</firstName>    <middleName>yy</middleName>    <lastName>zz</lastName>  </name></userInfo>]]>', '00000000', '2020-11-29 09:09:08', '2020-11-29 09:09:08'),
(54, '<?xml version=\'1.0\' encoding=\'UTF-8\'?>\n<soapenv:Envelope xmlns:soapenv=\'http://schemas.xmlsoap.org/soap/envelope/\' xmlns:sen=\'http://eaidev.mobinil.com/MEAI_OnlineServices/webServices/ESchool/sendProvisionMsg_WSDL\'>\n   <soapenv:Header>\n      <v2:RequestSOAPHeader>\n         <v2:spId>000812</v2:spId>\n         <v2:spPassword>d85d6a12a9257b448c722657cad9e09a</v2:spPassword>\n         <v2:timeStamp>20201130102049</v2:timeStamp>\n      </v2:RequestSOAPHeader>\n   </soapenv:Header>\n   <soapenv:Body>\n      <sen:sendProvisionMsg>\n         <transactionId>350000012020113010204945266</transactionId>\n         <sourceId>bob</sourceId>\n         <msisdn>201208138169</msisdn>\n         <serviceId>2142</serviceId>\n         <operationType>setUserInfo</operationType>\n         <createdTime>20201130102049</createdTime>\n         <msg><![CDATA[<?xml version=\'1.0\' encoding=\'UTF-8\'?><userInfo> <userType>1</userType>  <areaCode>23</areaCode>  <nickName>Terry</nickName>  <name>    <firstName>xx</firstName>    <middleName>yy</middleName>    <lastName>zz</lastName>  </name></userInfo>]]></msg>\n         <callBackData>abc</callBackData>\n         <extensionInfo>\n            <item>\n               <key>k1</key>\n               <value>value0</value>\n            </item>\n            <item>\n               <key>k2</key>\n               <value>value1</value>\n            </item>\n         </extensionInfo>\n      </sen:sendProvisionMsg>\n   </soapenv:Body>\n</soapenv:Envelope>', '<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n        <soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:sen=\"http://eaidev.mobinil.com/MEAI_OnlineServices/webServices/ESchool/sendProvisionMsg_WSDL\">\n   <soapenv:Header/>\n   <soapenv:Body>\n      <sen:sendProvisionMsgResponse>\n         <resultCode>00000000</resultCode>\n         <resultDescription>Success</resultDescription>\n         <msg><![CDATA[<?xml version=\"1.0\" encoding=\"UTF-8\"?><userInfo>  <userType>1</userType>  <areaCode>23</areaCode>  <nickName>Terry</nickName>  <name>    <firstName>xx</firstName>    <middleName>yy</middleName>    <lastName>zz</lastName>  </name></userInfo>]]></msg>\n         <extensionInfo>\n            <item>\n               <key>k1</key>\n               <value>value0</value>\n            </item>\n            <item>\n               <key>k2</key>\n               <value>value1</value>\n            </item>\n         </extensionInfo>\n      </sen:sendProvisionMsgResponse>\n   </soapenv:Body>\n</soapenv:Envelope>', '000812', 'd85d6a12a9257b448c722657cad9e09a', '20201130102049', '350000012020113010204945266', '201208138169', '2142', 'setUserInfo', '20201130102049', '<![CDATA[<?xml version=\'1.0\' encoding=\'UTF-8\'?><userInfo> <userType>1</userType>  <areaCode>23</areaCode>  <nickName>Terry</nickName>  <name>    <firstName>xx</firstName>    <middleName>yy</middleName>    <lastName>zz</lastName>  </name></userInfo>]]>', '012121', '2020-11-30 08:20:50', '2020-11-30 08:20:50'),
(55, '<?xml version=\'1.0\' encoding=\'UTF-8\'?>\n<soapenv:Envelope xmlns:soapenv=\'http://schemas.xmlsoap.org/soap/envelope/\' xmlns:sen=\'http://eaidev.mobinil.com/MEAI_OnlineServices/webServices/ESchool/sendProvisionMsg_WSDL\'>\n   <soapenv:Header>\n      <v2:RequestSOAPHeader>\n         <v2:spId>000812</v2:spId>\n         <v2:spPassword>afe1c8d2ca93dd9e0c1d33521435ac28</v2:spPassword>\n         <v2:timeStamp>20201209121727</v2:timeStamp>\n      </v2:RequestSOAPHeader>\n   </soapenv:Header>\n   <soapenv:Body>\n      <sen:sendProvisionMsg>\n         <transactionId>350000012020120912172796157</transactionId>\n         <sourceId>bob</sourceId>\n         <msisdn>201208138169</msisdn>\n         <serviceId>2142</serviceId>\n         <operationType>setUserInfo</operationType>\n         <createdTime>20201209121727</createdTime>\n         <msg><![CDATA[<?xml version=\'1.0\' encoding=\'UTF-8\'?><userInfo> <userType>1</userType>  <areaCode>23</areaCode>  <nickName>Terry</nickName>  <name>    <firstName>xx</firstName>    <middleName>yy</middleName>    <lastName>zz</lastName>  </name></userInfo>]]></msg>\n         <callBackData>abc</callBackData>\n         <extensionInfo>\n            <item>\n               <key>k1</key>\n               <value>value0</value>\n            </item>\n            <item>\n               <key>k2</key>\n               <value>value1</value>\n            </item>\n         </extensionInfo>\n      </sen:sendProvisionMsg>\n   </soapenv:Body>\n</soapenv:Envelope>', '<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n        <soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:sen=\"http://eaidev.mobinil.com/MEAI_OnlineServices/webServices/ESchool/sendProvisionMsg_WSDL\">\n   <soapenv:Header/>\n   <soapenv:Body>\n      <sen:sendProvisionMsgResponse>\n         <resultCode>00000000</resultCode>\n         <resultDescription>Success</resultDescription>\n         <msg><![CDATA[<?xml version=\"1.0\" encoding=\"UTF-8\"?><userInfo>  <userType>1</userType>  <areaCode>23</areaCode>  <nickName>Terry</nickName>  <name>    <firstName>xx</firstName>    <middleName>yy</middleName>    <lastName>zz</lastName>  </name></userInfo>]]></msg>\n         <extensionInfo>\n            <item>\n               <key>k1</key>\n               <value>value0</value>\n            </item>\n            <item>\n               <key>k2</key>\n               <value>value1</value>\n            </item>\n         </extensionInfo>\n      </sen:sendProvisionMsgResponse>\n   </soapenv:Body>\n</soapenv:Envelope>', '000812', 'afe1c8d2ca93dd9e0c1d33521435ac28', '20201209121727', '350000012020120912172796157', '201208138169', '2142', 'setUserInfo', '20201209121727', '<![CDATA[<?xml version=\'1.0\' encoding=\'UTF-8\'?><userInfo> <userType>1</userType>  <areaCode>23</areaCode>  <nickName>Terry</nickName>  <name>    <firstName>xx</firstName>    <middleName>yy</middleName>    <lastName>zz</lastName>  </name></userInfo>]]>', '00000000', '2020-12-09 10:17:27', '2020-12-09 10:17:27');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operator_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `size` int(11) NOT NULL DEFAULT '800',
  `ExURL` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'http://ivas.mobi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'emad', 'super_admin@ivas.com', '$2y$10$TzQ40fe.6ThJZL66xOgbWeSUP7pb3xx3PMTvPG.kFTaz6IZ5dpwp2', 1, 'INIk9kcJYlzxdXxj5jdnChal8lFysHj9o1m4YJUYx7YuqUXT3FFmEYIF9WWK', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_user_id_foreign` (`user_id`),
  ADD KEY `messages_service_id_foreign` (`service_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operators`
--
ALTER TABLE `operators`
  ADD PRIMARY KEY (`id`),
  ADD KEY `operators_country_id_foreign` (`country_id`);

--
-- Indexes for table `orange_chargings`
--
ALTER TABLE `orange_chargings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orange_sms`
--
ALTER TABLE `orange_sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orange_subscribes`
--
ALTER TABLE `orange_subscribes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orange_sub_unsubs`
--
ALTER TABLE `orange_sub_unsubs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orange_ussds`
--
ALTER TABLE `orange_ussds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orange_webs`
--
ALTER TABLE `orange_webs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `provisions`
--
ALTER TABLE `provisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_operator_id_foreign` (`operator_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `operators`
--
ALTER TABLE `operators`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orange_chargings`
--
ALTER TABLE `orange_chargings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orange_sms`
--
ALTER TABLE `orange_sms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orange_subscribes`
--
ALTER TABLE `orange_subscribes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orange_sub_unsubs`
--
ALTER TABLE `orange_sub_unsubs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orange_ussds`
--
ALTER TABLE `orange_ussds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orange_webs`
--
ALTER TABLE `orange_webs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provisions`
--
ALTER TABLE `provisions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
