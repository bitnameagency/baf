<?php

	define("ABSPATH", true);
	/*if(file_exists("bitnameagencyframework/config/config.php")){
					
		die("Delete /install.php file for security reason please!");
					
	}*/

$languageSelect = 'tr';


$language['tr'] = [
"mysqltitle" => 'MySQL Bağlantısı',
"DB_HOST" => "DB_HOST",
"DB_USER" => "DB_USER",
"DB_PASS" => "DB_PASS",
"DB_NAME" => "DB_NAME",
"SaveMysqlButton" => "Kontrol Et ve Kaydet",
"stepErrorTitle" => "HATA!",
"stepErrorContent" => "Öncelikle <code>Mysql</code> Bağlantısı Yapınız!",
"MysqlError" => "<code>Mysql</code> bilgileri hatalı. Lütfen tekrar deneyiniz!",
"mysqlSuccess" => "Bağlantı başarılı. Giriş Sayfasına Gidiniz.",

];



if(!isset($_GET['step'])){
	
	header("Location: //".$_SERVER['SERVER_NAME']."/install.php?step=mysql");
	
}elseif($_GET['step'] == "mysql"){
	
	
	if(file_exists("bitnameagencyframework/config/config.php") == false){
	
	$mysqlActive = 'active';
	$title = $language[$languageSelect]['mysqltitle'];
	
	if(isset($_POST['mysqlSave'])){
		
		$DB_HOST = $_POST['DB_HOST'];
		$DB_USER = $_POST['DB_USER'];
		$DB_PASS = $_POST['DB_PASS'];
		$DB_NAME = $_POST['DB_NAME'];
		
		try {
     $db = new PDO("mysql:host=".$DB_HOST.";dbname=".$DB_NAME.";charset=utf8", $DB_USER, $DB_PASS);
		} catch ( PDOException $e ){
			
			$modalError = true;
		
		}
		
		
			
			

		
		if(@$modalError !== true){
			
			$SECURE_KEY_GENERATE = sha1(md5(time().''.rand(111111111,999999999)));
			file_put_contents("bitnameagencyframework/config/config.php", "<?php if (!defined('ABSPATH')){ exit; }
			session_start();
			define('DB_HOST', '".$DB_HOST."');
			define('DB_USER', '".$DB_USER."');
			define('DB_PASS', '".$DB_PASS."');
			define('DB_NAME', '".$DB_NAME."');
			define('SECURE_KEY', '".$SECURE_KEY_GENERATE."');");
			
			
			$sql = "

--
-- Tablo için tablo yapısı `blockUserUser`
--

CREATE TABLE `blockUserUser` (
  `blockUserUserID` int(11) NOT NULL,
  `fromuserKey` varchar(255) NOT NULL,
  `blockuserKey` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Log`
--

CREATE TABLE `Log` (
  `logID` int(11) NOT NULL,
  `dateTime` varchar(255) DEFAULT NULL,
  `userKey` varchar(255) DEFAULT NULL,
  `IP` varchar(255) DEFAULT NULL,
  `browserID` varchar(255) DEFAULT NULL,
  `userAgent` varchar(255) DEFAULT NULL,
  `RequestMethod` varchar(255) DEFAULT NULL,
  `responseCode` varchar(255) DEFAULT NULL,
  `URL` text,
  `Ref` text,
  `GetData` text,
  `PostData` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `logList`
--

CREATE TABLE `logList` (
  `logListID` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `dateTime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `menuSystem`
--

CREATE TABLE `menuSystem` (
  `ID` int(11) NOT NULL,
  `subID` int(11) NOT NULL,
  `itemKey` varchar(255) NOT NULL,
  `itemLink` varchar(255) NOT NULL,
  `itemTarget` varchar(255) NOT NULL,
  `groupKey` varchar(255) NOT NULL,
  `orderInt` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `menuSystem`
--

INSERT INTO `menuSystem` (`ID`, `subID`, `itemKey`, `itemLink`, `itemTarget`, `groupKey`, `orderInt`) VALUES
(1, 0, 'dashboard', '/adminPanel/dashboard', '_self', 'adminpanelmenu', 1),
(2, 3, 'workstation', '/adminPanel/workstation', '_self', 'adminpanelmenu', 3),
(3, 0, 'managements-tools', '#', '_self', 'adminpanelmenu', 2),
(4, 3, 'menusystem', '/adminPanel/menuSystem', '_self', 'adminpanelmenu', 4),
(8, 3, 'languages', '/adminPanel/languages', '_self', 'adminpanelmenu', 5),
(14, 3, 'savedisk', '/adminPanel/savedisk', '_self', 'adminpanelmenu', 6),
(15, 18, 'users', '/adminPanel/users', '_self', 'adminpanelmenu', 11),
(18, 0, 'usersandperms', '#', '_self', 'adminpanelmenu', 10),
(19, 18, 'projects', '/adminPanel/projects', '_self', 'adminpanelmenu', 12),
(20, 18, 'roles', '/adminPanel/roles', '_self', 'adminpanelmenu', 13),
(22, 3, 'loglist', '/adminPanel/loglist', '_self', 'adminpanelmenu', 8),
(23, 3, 'sessionlist', '/adminPanel/sessionlist', '_self', 'adminpanelmenu', 9),
(24, 3, 'routelist', '/adminPanel/routelist', '_self', 'adminpanelmenu', 7),
(25, 0, 'systemoptions', '/adminPanel/systemoptions', '_self', 'adminpanelmenu', 14);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mergeRolePerms`
--

CREATE TABLE `mergeRolePerms` (
  `mergeRolePermID` int(11) NOT NULL,
  `permID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `mergeRolePerms`
--

INSERT INTO `mergeRolePerms` (`mergeRolePermID`, `permID`, `roleID`) VALUES
(43, 12, 2),
(44, 10, 2),
(49, 7, 2),
(51, 9, 2),
(52, 1, 2),
(53, 2, 2),
(55, 8, 2),
(56, 3, 2),
(57, 23, 2),
(58, 22, 2),
(59, 5, 2),
(61, 24, 2),
(62, 6, 2),
(63, 25, 2),
(64, 1, 10),
(66, 3, 10),
(67, 22, 10),
(68, 5, 10),
(69, 6, 10),
(70, 7, 10),
(71, 8, 10),
(72, 9, 10),
(73, 23, 10),
(74, 24, 10),
(75, 25, 10),
(76, 26, 10),
(77, 1, 12),
(78, 2, 12),
(79, 3, 12),
(80, 22, 12),
(81, 5, 12),
(82, 6, 12),
(83, 7, 12),
(84, 8, 12),
(85, 9, 12),
(86, 23, 12),
(87, 24, 12),
(88, 25, 12),
(89, 26, 12),
(91, 2, 10),
(92, 27, 10),
(93, 29, 10),
(94, 30, 10),
(95, 31, 10),
(96, 32, 10),
(97, 34, 10),
(98, 35, 10),
(99, 36, 10);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mergeRolesUser`
--

CREATE TABLE `mergeRolesUser` (
  `mergeRolesUserID` int(11) NOT NULL,
  `userKey` varchar(255) NOT NULL,
  `roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `mergeRolesUser`
--

INSERT INTO `mergeRolesUser` (`mergeRolesUserID`, `userKey`, `roleID`) VALUES
(5, '40c4f2a328c12eaebb2f642455caed5277f18849', 10);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `perms`
--

CREATE TABLE `perms` (
  `permID` int(11) NOT NULL,
  `permKey` varchar(255) NOT NULL,
  `projectKey` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `perms`
--

INSERT INTO `perms` (`permID`, `permKey`, `projectKey`) VALUES
(1, 'login', 'baf'),
(2, 'dashboard', 'baf'),
(3, 'workstation', 'baf'),
(4, 'menusystem', 'baf'),
(5, 'languages', 'baf'),
(6, 'savedisk', 'baf'),
(7, 'users', 'baf'),
(8, 'projects', 'baf'),
(9, 'roles', 'baf'),
(18, 'menusystem', 'baf'),
(19, 'menusystem', 'baf'),
(20, 'menusystem', 'baf'),
(21, 'menusystem', 'baf'),
(22, 'menusystem', 'baf'),
(23, 'filereader', 'baf'),
(24, 'debugstart', 'baf'),
(25, 'userselect', 'baf'),
(26, 'userroles', 'baf'),
(27, 'logout', 'baf'),
(30, 'logdownloader', 'baf'),
(31, 'loglist', 'baf'),
(32, 'sessionlist', 'baf'),
(34, 'search', 'baf'),
(35, 'routelist', 'baf'),
(36, 'systemoptions', 'baf');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `roles`
--

CREATE TABLE `roles` (
  `roleID` int(11) NOT NULL,
  `roleKey` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `roles`
--

INSERT INTO `roles` (`roleID`, `roleKey`) VALUES
(10, 'root');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `roomMessages`
--

CREATE TABLE `roomMessages` (
  `roomMessageID` int(11) NOT NULL,
  `roomID` int(11) NOT NULL,
  `messageData` text NOT NULL,
  `deleting` int(11) NOT NULL,
  `seen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `Rooms`
--

CREATE TABLE `Rooms` (
  `roomID` int(11) NOT NULL,
  `roomName` varchar(255) NOT NULL,
  `roomKey` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `roomUsers`
--

CREATE TABLE `roomUsers` (
  `roomUserID` int(11) NOT NULL,
  `roomID` int(11) NOT NULL,
  `userKey` varchar(255) NOT NULL,
  `moderator` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `saveDisk`
--

CREATE TABLE `saveDisk` (
  `sD_ID` int(11) NOT NULL,
  `sD_unique_key` varchar(255) NOT NULL,
  `sD_path` varchar(255) NOT NULL,
  `sD_path_line` varchar(255) DEFAULT NULL,
  `sD_key` varchar(255) NOT NULL,
  `sD_data` text NOT NULL,
  `viewURL` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `saveDisk`
--

INSERT INTO `saveDisk` (`sD_ID`, `sD_unique_key`, `sD_path`, `sD_path_line`, `sD_key`, `sD_data`, `viewURL`) VALUES
(44, '6a0244cb2331f832d2aa6f85b0afbe30', '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '588', 'adminUserCreate', 'YES', '/adminPanel/savedisk');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `secureSession`
--

CREATE TABLE `secureSession` (
  `sS_ID` int(11) NOT NULL,
  `sessionKey` varchar(255) NOT NULL,
  `sessionSecureKey` varchar(255) NOT NULL,
  `sessionData` text NOT NULL,
  `deletionDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `systemOptions`
--

CREATE TABLE `systemOptions` (
  `optionID` int(11) NOT NULL,
  `optionKey` varchar(255) NOT NULL,
  `optionData` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `systemOptions`
--

INSERT INTO `systemOptions` (`optionID`, `optionKey`, `optionData`) VALUES
(2, 'errorMail', 'false'),
(3, 'defaultLanguage', 'tr'),
(4, 'languageProcessing', 'true'),
(5, 'saveDiskProcessing', 'false'),
(6, 'logSystem', 'true'),
(8, 'htmlCacheTime', '0'),
(9, 'HTMLMinify', 'false'),
(10, 'resetPasswordTime', '3600'),
(11, 'captchaDifficultyLevel', '5'),
(12, 'renderBlock', 'false'),
(13, 'developerMode', 'true'),
(14, 'maintenanceMode', 'true'),
(15, 'heartbeat', '3000'),
(16, 'cronJob', 'true'),
(17, 'FormTokenUsageLimit', '5'),
(28, 'authorizedMail', NULL),
(29, 'MAIL_HOST', NULL),
(30, 'MAIL_PORT', NULL),
(31, 'MAIL_USERNAME', NULL),
(32, 'MAIL_PASSWORD', NULL),
(33, 'MAIL_FROMADRESS', NULL),
(34, 'MAIL_FROMNAME', NULL),
(35, 'MAIL_REPLYADRESS', NULL),
(36, 'MAIL_REPLYNAME', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `translators_lang`
--

CREATE TABLE `translators_lang` (
  `lang_ID` int(11) NOT NULL,
  `lang_code` varchar(255) NOT NULL,
  `lang_flag` varchar(255) NOT NULL,
  `lang_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `translators_lang`
--

INSERT INTO `translators_lang` (`lang_ID`, `lang_code`, `lang_flag`, `lang_name`) VALUES
(1, 'original', 'original.jpg', 'original'),
(2, 'tr', 'noflag.jpg', 'Türkçe');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `translators_sentence`
--

CREATE TABLE `translators_sentence` (
  `ts_ID` int(11) NOT NULL,
  `lang_ID` int(11) NOT NULL,
  `ts_path` varchar(255) NOT NULL,
  `ts_path_line` varchar(255) NOT NULL,
  `ts_key` varchar(255) NOT NULL,
  `ts_unique_key` varchar(255) NOT NULL,
  `ts_sentence` text NOT NULL,
  `viewURL` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `translators_sentence`
--

INSERT INTO `translators_sentence` (`ts_ID`, `lang_ID`, `ts_path`, `ts_path_line`, `ts_key`, `ts_unique_key`, `ts_sentence`, `viewURL`) VALUES
(1, 1, '/bitnameagencyframework/engine/userPermSystem.php', '107', 'role_root', '96be8bc8804f4d482f881f412dbf844f', 'root', '/adminPanel/login'),
(2, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '25', 'title', '8a1ce0368026b6179704921750be650e', 'Hoş geldiniz.', '/adminPanel/login'),
(3, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '26', 'sub', '3ba858542655a29f4131d1d23b02d879', 'Hesabınızda oturum açın ve web sitenizi yönetmeye başlayın.', '/adminPanel/login'),
(4, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '93', 'title', 'fdcdfa0bc369f381d0d86631c9d755fd', 'Bitname F. Giriş Sayfası', '/adminPanel/login'),
(5, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '93', 'description', 'd05aa1c6ba0fcc164d6ad2a675fa7e5b', 'Bitname F. Giriş Sayfası', '/adminPanel/login'),
(6, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '93', 'helptext', 'd5b9706bb3bc1b1549ef7b7b435262b1', 'Yardım', '/adminPanel/login'),
(7, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '93', 'helptexthref', '07e3591055d488333e69b92b8133e66b', 'mailto:destek@bitnameagency.com', '/adminPanel/login'),
(8, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '93', 'aboutustext', '4ea292245804ef657b4e26bf0e6abccd', 'Hakkımızda', '/adminPanel/login'),
(9, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '93', 'aboutustexthref', 'd698bc715b611dde8e42b37dc5d32fed', 'https://bitnameagency.com', '/adminPanel/login'),
(10, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '104', 'usernameplaceholder', 'f80d97ced2abeca6b851e4dc747ab20f', 'Kullanıcı Adı', '/adminPanel/login'),
(11, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '104', 'passwordplaceholder', 'd5c8457ec1df49a7614a01cdc3c67e18', 'Şifre', '/adminPanel/login'),
(12, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '104', 'rememberme', 'fe2bc8b2fd03f37f16245c9f77dcfe99', 'Beni Hatırla', '/adminPanel/login'),
(13, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '104', 'logintext', 'f3feb19cbcd9bf3a4e5deeb3b2eefe90', 'Giriş Yap', '/adminPanel/login'),
(14, 1, '/bitnameagencyframework/engine/captcha.php', '46', 'captchaPlaceholder', '6ee89492786630972807c2320dd828e1', 'Güvenlik Kodunu Giriniz.', '/adminPanel/login'),
(15, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '40', 'sub', '1963876a4a3c4564052febbfb28eeb4d', 'Giriş Başarılı. Yönlendiriliyorsunuz...', '/adminPanel/login'),
(16, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '45', 'title', '87f220efaefa79562fb57f9ccc790cd8', 'Hoş geldiniz', '/adminPanel/login'),
(17, 1, '/bitnameagencyframework/engine/userPermSystem.php', '107', 'baf@login', '0a2eab0036e1e9593bd79d3a5ed9e908', 'baf@login', '/adminPanel/login'),
(18, 1, '/bitnameagencyframework/engine/userPermSystem.php', '107', 'baf', 'd7c5dc160b2aeab115185aafacfdc19a', 'baf', '/adminPanel/login'),
(19, 1, '/bitnameagencyframework/engine/userPermSystem.php', '107', 'baf@dashboard', 'ac8370c73fb6ecad12506cc296aa9215', 'baf@dashboard', '/adminPanel/login'),
(20, 1, '/bitnameagencyframework/engine/userPermSystem.php', '107', 'baf@workstation', '5eb2ae0e5ce2398bbb2d0b4a68b82906', 'baf@workstation', '/adminPanel/login'),
(21, 1, '/bitnameagencyframework/engine/userPermSystem.php', '107', 'baf@menusystem', 'd5c86d9aad2a56f1870bc7eeff297457', 'baf@menusystem', '/adminPanel/login'),
(22, 1, '/bitnameagencyframework/engine/userPermSystem.php', '107', 'baf@languages', '431da775583dc6e673c3a957bf958e03', 'baf@languages', '/adminPanel/login'),
(23, 1, '/bitnameagencyframework/engine/userPermSystem.php', '107', 'baf@savedisk', '852ab4aaf75ae962055daa4299e689f2', 'baf@savedisk', '/adminPanel/login'),
(24, 1, '/bitnameagencyframework/engine/userPermSystem.php', '107', 'baf@users', '52d27073413179b7f9d22939bdf40c7e', 'baf@users', '/adminPanel/login'),
(25, 1, '/bitnameagencyframework/engine/userPermSystem.php', '107', 'baf@projects', '843271123323cfbef31931ea1be58a83', 'baf@projects', '/adminPanel/login'),
(26, 1, '/bitnameagencyframework/engine/userPermSystem.php', '107', 'baf@roles', 'ffda91acfdf0382337f430b768ac5484', 'baf@roles', '/adminPanel/login'),
(27, 1, '/bitnameagencyframework/engine/userPermSystem.php', '107', 'baf@filereader', '4b235ce02e1f06a459bb02537cc7a018', 'baf@filereader', '/adminPanel/login'),
(28, 1, '/bitnameagencyframework/engine/userPermSystem.php', '107', 'baf@debugstart', '3f48504a483cc5dd24a4dbd26f4c66c1', 'baf@debugstart', '/adminPanel/login'),
(29, 1, '/bitnameagencyframework/engine/userPermSystem.php', '107', 'baf@userselect', 'd8f3ffcb7e3021aa958edf1c7ffd9e09', 'baf@userselect', '/adminPanel/login'),
(30, 1, '/bitnameagencyframework/engine/userPermSystem.php', '107', 'baf@userroles', '2bf366bfc8361070d8ffc3677211a2c2', 'baf@userroles', '/adminPanel/login'),
(31, 1, '/bitnameagencyframework/engine/userPermSystem.php', '107', 'baf@logout', 'd106c4e22e2df4687622ef5262e9dea2', 'baf@logout', '/adminPanel/login'),
(32, 1, '/bitnameagencyframework/engine/userPermSystem.php', '107', 'baf@logdownloader', 'ae35270ccb0812ace64a4e8f1a77dab4', 'baf@logdownloader', '/adminPanel/login'),
(33, 1, '/bitnameagencyframework/engine/userPermSystem.php', '107', 'baf@loglist', '336b83dae297cd5bac67ca52716b173b', 'baf@loglist', '/adminPanel/login'),
(34, 1, '/bitnameagencyframework/engine/userPermSystem.php', '107', 'baf@sessionlist', 'aacd76215f859589195941f56808169e', 'baf@sessionlist', '/adminPanel/login'),
(35, 1, '/bitnameagencyframework/engine/userPermSystem.php', '107', 'baf@search', '15b7580bff28106ae2360205bde976fe', 'baf@search', '/adminPanel/login'),
(36, 1, '/bitnameagencyframework/engine/userPermSystem.php', '107', 'baf@routelist', '869ebf7a5572d4d8752f41bb82a7b373', 'baf@routelist', '/adminPanel/login'),
(37, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '134', 'title', 'f2b6fb2b8a4dd6c7f8e5a09eab231ce0', 'Dashboard | BAF', '/adminPanel/dashboard'),
(38, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '135', 'boardWidget', 'e9cc6c5fdbd38e4ee707766dc91fcb37', 'Yönetim Widget', '/adminPanel/dashboard'),
(39, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '136', 'boardWidgetSub', 'e3368481c245744618000f3ab9a96361', 'Kullanımınızı kolaylaştıracak widgetlar.', '/adminPanel/dashboard'),
(40, 1, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID1-dashboard', '12db52d512261f63348da539d2d6adb4', 'dashboard', '/adminPanel/dashboard'),
(41, 1, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID3-managements-tools', '0374a71243f89ee612ee848aeba83838', 'managements-tools', '/adminPanel/dashboard'),
(42, 1, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID2-workstation', 'b27909e899337a5f6dd0b0f93a0aae58', 'workstation', '/adminPanel/dashboard'),
(43, 1, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID4-menusystem', 'bfee8b1242c675626652bf82d4d56c4a', 'menusystem', '/adminPanel/dashboard'),
(44, 1, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID8-languages', '8fcb8a52c6f23a286ce5e6cb3463ff3e', 'languages', '/adminPanel/dashboard'),
(45, 1, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID14-savedisk', '5bf46271a93acaf14399b4875305a7e9', 'savedisk', '/adminPanel/dashboard'),
(46, 1, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID24-routelist', 'bdffa539febf2f38e5e8cd42f91a3372', 'routelist', '/adminPanel/dashboard'),
(47, 1, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID22-loglist', '987a61f4966d8cb5844abe7be2381312', 'loglist', '/adminPanel/dashboard'),
(48, 1, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID23-sessionlist', '8c55ef122ea665c18f364c0e09d69d0e', 'sessionlist', '/adminPanel/dashboard'),
(49, 1, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID18-usersandperms', '54248e376f24e100a55cc12b6c5b72d6', 'usersandperms', '/adminPanel/dashboard'),
(50, 1, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID15-users', '5aa900596e46f3303064c9527edd3337', 'users', '/adminPanel/dashboard'),
(51, 1, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID19-projects', 'b54f44e1ed1f0d6a1fdba2864b1beac4', 'projects', '/adminPanel/dashboard'),
(52, 1, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID20-roles', '5aee6bfee81908dab1e5aa203a506498', 'roles', '/adminPanel/dashboard'),
(53, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '126', 'welcome', '6c2a80a3c57e5006a160aff7cc7e9955', 'Hoşgeldiniz', '/adminPanel/dashboard'),
(54, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '127', 'welcomeSub', '0098922f2a4e617827732dd81f2b55a2', 'Hoşgeldiniz', '/adminPanel/dashboard'),
(55, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '177', 'title', '9236a6e82aba81788661acaf75b9aede', 'Workstation | BAF', '/adminPanel/workstation'),
(56, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '179', 'workstation_title', 'c253e9b02047ee9ed38ce7aec923072d', 'İş Yönetim İstasyonu', '/adminPanel/workstation'),
(57, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '180', 'workstation_title_sub', '357941e0871ff8981c5c02a690300ebe', 'BAF dosyalarınızı buradan aktif/pasif haline getirebilir ve önceliklerini belirleyebilirsiniz.', '/adminPanel/workstation'),
(58, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '181', 'disableButtontext', '990e70eefda39f20e303bc9fa987b3db', 'Etkisizleştir', '/adminPanel/workstation'),
(59, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '182', 'enableButtontext', '1b45d354b40657180bccf5888899a98f', 'Etkinleştir', '/adminPanel/workstation'),
(60, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '183', 'priority', '54cc6543f12b8dc3832f24c2baadedba', 'Öncelik', '/adminPanel/workstation'),
(61, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '184', 'save', 'c895b34b122a99b41e297bd5788b5021', 'Kaydet', '/adminPanel/workstation'),
(62, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '185', 'location', 'be5248c067c4731c6bf7293a6fc6c292', 'Lokasyon:', '/adminPanel/workstation'),
(63, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '186', 'delete', '2bb40f8199d25abf64d3f237224f7078', 'Sil', '/adminPanel/workstation'),
(64, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '187', 'placeholder_title', '4118913ffd699c1f47d08e71e3587a6b', 'Başlık', '/adminPanel/workstation'),
(65, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '188', 'placeholder_desc', '3ea30875a5c6106c867a4a2facb0c5cf', 'Açıklama', '/adminPanel/workstation'),
(66, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '342', 'title', '01efca23b00f6761ad99547bb361e73a', 'MenuSystem | BAF', '/adminPanel/menuSystem'),
(67, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '344', 'menuSelectplaceholder', 'f14deeb306209483377f6434a7c4390d', 'Menü Seçiniz', '/adminPanel/menuSystem'),
(68, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '351', 'sectionTitle', '1d43620b2736c00821496acf0b65f2aa', 'Menü Yönetim Sistemi', '/adminPanel/menuSystem'),
(69, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '352', 'sectionSub', '47532770af2c50996e358a7f9b00d0f3', 'Menü oluşturabilir, düzenleyebilir ve silebilirsiniz. Ayrıca sıralama ve hiyerarşi oluşturabilirsiniz.', '/adminPanel/menuSystem'),
(70, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '353', 'new_menu_placeholder', '8e39c4c63ccca309c2e834ba5c26567f', 'Yeni Menü İsmi', '/adminPanel/menuSystem'),
(71, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '354', 'new_menu_button', '81ca47bdd3cea24e032ad8b8e0cb364b', 'Yeni Menü Oluştur', '/adminPanel/menuSystem'),
(72, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '355', 'selectedMenu', '8a4fdb6013fe08bbc7806f8bd7c38cf1', 'Seçilen Menü', '/adminPanel/menuSystem'),
(73, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '356', 'deleteMenu', '477190b52a220b4c51964f14c4c10bd1', 'Menüyü Sil', '/adminPanel/menuSystem'),
(74, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '357', 'nestable_title', '464546c059e8f0061904272a77729292', 'Menüyü Düzenle', '/adminPanel/menuSystem'),
(75, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '358', 'nestableUpdate_button', '02683b4ae1b622613b5604903995c992', 'Sıralamayı Güncelle', '/adminPanel/menuSystem'),
(76, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '359', 'item_add_title', 'a41bc7a10117ad50234bf7d2ea05d909', 'Yeni Bağlantı Ekle', '/adminPanel/menuSystem'),
(77, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '360', 'itemKey_Placeholder', 'c66885a0591169dbac1c2d54a52f0245', 'itemKey', '/adminPanel/menuSystem'),
(78, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '361', 'itemLink_Placeholder', '2364f8f68acb53a4f6dd285116111f28', 'itemLink', '/adminPanel/menuSystem'),
(79, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '362', 'itemTarget', '25ab6ec0ac6aab7711f247b6fbe717be', 'linkTarget', '/adminPanel/menuSystem'),
(80, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '363', 'item_add_button', '2edd76c56db780125d8b5e37f578afd9', 'Link Ekle', '/adminPanel/menuSystem'),
(81, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '567', 'title', '4e2b0e352bda735de617f906e8a1e138', 'SaveDisk | BAF', '/adminPanel/savedisk'),
(82, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '568', 'sectionTitle', '9e74f5900a52bf03946ab7f4a6cc410d', 'SaveDisk Sistemi', '/adminPanel/savedisk'),
(83, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '569', 'sectionSub', '2c4f90bf1ab2a942e486d09801715398', 'Sistemde panelden değiştirilebilen değişkenler oluşturabilirsiniz.', '/adminPanel/savedisk'),
(84, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '571', 'pathListplaceholder', '249960de539838b3065476c5fb7ef377', 'Dosya Yolunu Seçiniz', '/adminPanel/savedisk'),
(85, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '575', 'lineText', 'f5cdc6cc8308f6faf67e0236a908bb22', 'SATIR', '/adminPanel/savedisk'),
(86, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '576', 'keyText', '17d6e240e6a044b5d6af2d0f3d4e3fe6', 'ANAHTAR', '/adminPanel/savedisk'),
(87, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '577', 'dataText', '0f59839751888044bf9b0e31b4b29534', 'VERİ', '/adminPanel/savedisk'),
(88, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '578', 'actionText', '21b5d3e977ca046b2fed542128b67011', 'AKSİYON', '/adminPanel/savedisk'),
(89, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '803', 'title', '669a0ed5eebe86a99b8df78ce6f10923', 'Roller | BAF', '/adminPanel/roles'),
(90, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '804', 'sectionTitle', 'd017ba566581e6223d6748dd85d23878', 'Roller', '/adminPanel/roles'),
(91, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '805', 'sectionSub', '37c9d74bbfa9cca6d29fa7b2d9a31ccf', 'Sistem rollerini buradan düzenleyebilirsiniz.', '/adminPanel/roles'),
(92, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '806', 'newRoleName_text', 'e24b0365ac39665519bf7608a89a4784', 'Yeni Rol İsmi', '/adminPanel/roles'),
(93, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '807', 'newRoleAddbutton_text', '3564126ec93c948037b2890968866cf7', 'Rol Ekle', '/adminPanel/roles'),
(94, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '809', 'roleSelect_text', 'c29f56b9d79c2f691c99ef790f328aed', 'Rol Seçimi Yapınız.', '/adminPanel/roles'),
(95, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '812', 'selectRoleText', '292091e1900c281b5ce8da50605a7d75', 'Seçilen Rol', '/adminPanel/roles'),
(96, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '813', 'roleDeletebutton_text', 'e70eb21ace6be47c0616ff847c8bee2a', 'Rolü Sil', '/adminPanel/roles'),
(97, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '817', 'emptyPerm_text', 'c78d87eda360b6c7c133884604009b30', 'Yetki Bulunamadı!', '/adminPanel/roles'),
(98, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '821', 'projectsSelect_text', 'e7899ce5f22a3820621dd0c92221e02f', 'Proje Seç', '/adminPanel/roles'),
(99, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '824', 'emptyPerm_text', 'd4c5067d774a8bf26db7235c246d92cb', 'Yetki Bulunamadı!', '/adminPanel/roles'),
(100, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '930', 'title', '1e8babd80243776b26e3bd385a92659a', 'Oturum Listesi | BAF', '/adminPanel/sessionlist'),
(101, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '931', 'sectionTitle', 'ffc2342409ad1e5c87be7003b399c171', 'Oturum Listesi', '/adminPanel/sessionlist'),
(102, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '932', 'sectionSub', '806f149dfeeba61f24e8deb7469378f6', 'Tüm oturumları görüntüleyebilirsiniz.', '/adminPanel/sessionlist'),
(103, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '933', 'sessionListplaceholder', '754e7aff73b9bf21aa171a7b3e7b9417', 'Session Key Seçiniz', '/adminPanel/sessionlist'),
(104, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '935', 'ID_text', '359689b515c5c7c5a7ad68e16d5f3e1a', 'ID', '/adminPanel/sessionlist'),
(105, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '936', 'sessionKey_text', 'e2f4dbb30a8fe0feea06b451163eabe8', 'Oturum Anahtarı', '/adminPanel/sessionlist'),
(106, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '937', 'sessionSecureKey_text', '2693c1fcecc0a961d6e980e43e92fcdb', 'Oturum Gizli Anahtarı', '/adminPanel/sessionlist'),
(107, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '938', 'sessionData_text', '4dbe4fa0aaf406953f9115054e7feca2', 'Oturum Verisi', '/adminPanel/sessionlist'),
(108, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '939', 'sessionDelete_text', 'bc53d35a9c7974be0dfd614fc4a3ea65', 'Oturumu Sil', '/adminPanel/sessionlist'),
(109, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '16', 'emptyTable', '22eccd0b1dafd5a3953d168d56fe2d87', 'Tabloda herhangi bir veri mevcut değil', '/adminPanel/users/datatablelang.json'),
(110, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '17', 'info', '3b97574223ad5245faf89494ace3e0ed', '_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor', '/adminPanel/users/datatablelang.json'),
(111, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '18', 'infoEmpty', '9097cf57698d02283aae9bfcf0154836', 'Kayıt yok', '/adminPanel/users/datatablelang.json'),
(112, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '19', 'infoFiltered', '41de54886284c116dc3606918bae3e03', '(_MAX_ kayıt içerisinden bulunan)', '/adminPanel/users/datatablelang.json'),
(113, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '20', 'infoThousands', 'a7a3d1947b2a2161e9ae38b9c499a526', '.', '/adminPanel/users/datatablelang.json'),
(114, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '21', 'lengthMenu', 'dc36bade3b034d6170e913540dfcb96f', 'Sayfada _MENU_ kayıt göster', '/adminPanel/users/datatablelang.json'),
(115, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '22', 'loadingRecords', 'eb02cbfcf14388dbed2e77b950a68af0', 'Yükleniyor...', '/adminPanel/users/datatablelang.json'),
(116, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '23', 'processing', 'f023504ef7a3ec3273cebd1bb00e2d0d', 'İşleniyor...', '/adminPanel/users/datatablelang.json'),
(117, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '24', 'search', '2f277fd5336def168ac3831aa865f1b0', 'Ara:', '/adminPanel/users/datatablelang.json'),
(118, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '25', 'zeroRecords', '4500231c20459b4fdce3001ea1dc26ba', 'Eşleşen kayıt bulunamadı', '/adminPanel/users/datatablelang.json'),
(119, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '28', 'first', 'd34d86acb486ccebbce19f4856511578', 'İlk', '/adminPanel/users/datatablelang.json'),
(120, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '29', 'last', 'd490df0c69d91368f07751beac659108', 'Son', '/adminPanel/users/datatablelang.json'),
(121, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '30', 'next', '410699359eb224a6b02cc381d8fae681', 'Sonraki', '/adminPanel/users/datatablelang.json'),
(122, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '31', 'previous', '71fa9765d924a64e9281932a97b742a3', 'Önceki', '/adminPanel/users/datatablelang.json'),
(123, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '35', 'sortAscending', 'df0f7b7cafc989de821c10fc204af806', ': artan sütun sıralamasını aktifleştir', '/adminPanel/users/datatablelang.json'),
(124, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '36', 'sortDescending', 'c8c66a6e49d39b4d07d6b16304255cde', ': azalan sütun sıralamasını aktifleştir', '/adminPanel/users/datatablelang.json'),
(125, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '42', '_', '36fb434f7582c3adf2d17b2ae753c6f3', '%d kayıt seçildi', '/adminPanel/users/datatablelang.json'),
(126, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '43', '1', '19ac868aa2962eaec5f893ac11ade9b7', '1 kayıt seçildi', '/adminPanel/users/datatablelang.json'),
(127, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '47', '1', '13638794f7097f0aa13b2308d5906943', '1 hücre seçildi', '/adminPanel/users/datatablelang.json'),
(128, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '48', '_', 'b3d23ea159b16d0c7e0a100ee9172802', '%d hücre seçildi', '/adminPanel/users/datatablelang.json'),
(129, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '52', '1', '7379a8f239c9e933a87cf9b7c730ea1e', '1 sütun seçildi', '/adminPanel/users/datatablelang.json'),
(130, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '53', '_', 'ce76792471d38727e34bddd671302816', '%d sütun seçildi', '/adminPanel/users/datatablelang.json'),
(131, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '58', 'cancel', '6a278b107859e731f55b458ad1330144', 'İptal', '/adminPanel/users/datatablelang.json'),
(132, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '59', 'fillHorizontal', '520708bc24194139928de0fd10b8d590', 'Hücreleri yatay olarak doldur', '/adminPanel/users/datatablelang.json'),
(133, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '60', 'fillVertical', 'aaedd29a9a2cf324218c51452b614155', 'Hücreleri dikey olarak doldur', '/adminPanel/users/datatablelang.json'),
(134, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '61', 'fill', 'e89ddae0401ae5f76e14ef4f3f8a7400', 'Bütün hücreleri <i>%d</i> ile doldur', '/adminPanel/users/datatablelang.json'),
(135, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '65', 'collection', 'b127320e14808e39637fe234bc762e5c', 'Koleksiyon <span class=\"ui-button-icon-primary ui-icon ui-icon-triangle-1-s\"></span>', '/adminPanel/users/datatablelang.json'),
(136, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '66', 'colvis', '91e4899ab811d990f9a9255f8bcae91e', 'Sütun görünürlüğü', '/adminPanel/users/datatablelang.json'),
(137, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '67', 'colvisRestore', '2dc93aaea9cd6577a773761430c235f4', 'Görünürlüğü eski haline getir', '/adminPanel/users/datatablelang.json'),
(138, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '70', '1', '5c78c29bbf3e38c57acff89317095ad1', '1 satır panoya kopyalandı', '/adminPanel/users/datatablelang.json'),
(139, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '71', '_', '8f4d26eaed7a1fd1071c6014d3f9619f', '%ds satır panoya kopyalandı', '/adminPanel/users/datatablelang.json'),
(140, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '73', 'copyTitle', 'dd06d24fbe76a2b3add855f46266d2d7', 'Panoya kopyala', '/adminPanel/users/datatablelang.json'),
(141, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '74', 'csv', '4af4725c11bd15724683298f233e8041', 'CSV', '/adminPanel/users/datatablelang.json'),
(142, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '75', 'excel', '7d648d26e17f3c0d1eb2b96e3b8d99d6', 'Excel', '/adminPanel/users/datatablelang.json'),
(143, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '78', '-1', 'd7d93429e7c696448044530a934b8356', 'Bütün satırları göster', '/adminPanel/users/datatablelang.json'),
(144, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '79', '_', 'd6edb0c08117409bf6ea92c513dafe0b', '%d satır göster', '/adminPanel/users/datatablelang.json'),
(145, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '81', 'pdf', '29e6251595ede2f406642db8a93026e6', 'PDF', '/adminPanel/users/datatablelang.json'),
(146, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '82', 'print', '2f78b35d2e3838dbdf0f68754656d2ca', 'Yazdır', '/adminPanel/users/datatablelang.json'),
(147, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '83', 'copy', 'c541783932630a5c359566fb476ccb81', 'Kopyala', '/adminPanel/users/datatablelang.json'),
(148, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '84', 'copyKeys', 'caebfe363c2bbb9de79a9ee31e36d20f', 'Tablodaki veriyi kopyalamak için CTRL veya u2318 + C tuşlarına basınız. İptal etmek için bu mesaja tıklayın veya escape tuşuna basın.', '/adminPanel/users/datatablelang.json'),
(149, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '88', 'add', 'b5e968b71f6f70f603e8fc1490d7136e', 'Koşul Ekle', '/adminPanel/users/datatablelang.json'),
(150, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '92', '_', '6e995fbb0eac99b9a7eff5649e1dd5f4', 'Arama Oluşturucu (%d)', '/adminPanel/users/datatablelang.json'),
(151, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '94', 'condition', '29cf2056f450be8d34b2f42cbc92eb5c', 'Koşul', '/adminPanel/users/datatablelang.json'),
(152, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '99', 'after', '8bec55287da9e3814863d700d14a9dbd', 'Sonra', '/adminPanel/users/datatablelang.json'),
(153, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '100', 'before', 'bd7d552c743e14a1371524499d215cc0', 'Önce', '/adminPanel/users/datatablelang.json'),
(154, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '101', 'between', '847b7c742cb45feaee7464479d702e93', 'Arasında', '/adminPanel/users/datatablelang.json'),
(155, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '102', 'empty', '38632d7ed5739b48908ffce9317d6178', 'Boş', '/adminPanel/users/datatablelang.json'),
(156, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '103', 'equals', '36e35708e3a2b779456c7c047cdbf6a1', 'Eşittir', '/adminPanel/users/datatablelang.json'),
(157, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '104', 'not', 'b5a50ce32105661f35d2f58fc04630da', 'Değildir', '/adminPanel/users/datatablelang.json'),
(158, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '105', 'notBetween', '929706e1891515ba4bff0e2fb4451e7b', 'Dışında', '/adminPanel/users/datatablelang.json'),
(159, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '106', 'notEmpty', '9e1ee004eb487454a09bf0e1b7494c2e', 'Dolu', '/adminPanel/users/datatablelang.json'),
(160, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '110', 'between', '525c57eec4303109e61ff06b5c817ffa', 'Arasında', '/adminPanel/users/datatablelang.json'),
(161, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '111', 'empty', '71e5f5ae9b251bf542abda6467ddcd78', 'Boş', '/adminPanel/users/datatablelang.json'),
(162, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '112', 'equals', '7c9dfa04949acf27c76a7fb6b3ad1246', 'Eşittir', '/adminPanel/users/datatablelang.json'),
(163, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '113', 'gt', 'fef69c8e1e1f1ac1c49da13e931bc436', 'Büyüktür', '/adminPanel/users/datatablelang.json'),
(164, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '114', 'gte', 'aa28b5968d183b29b6b81e22c838206d', 'Büyük eşittir', '/adminPanel/users/datatablelang.json'),
(165, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '115', 'lt', '3de2ae8500c6457fdf241cd42bb099cb', 'Küçüktür', '/adminPanel/users/datatablelang.json'),
(166, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '116', 'lte', '34297e844ec0ad15d6b23c5d3e712090', 'Küçük eşittir', '/adminPanel/users/datatablelang.json'),
(167, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '117', 'not', '4889ca3e1123784bd1ffd91fda1ebbad', 'Değildir', '/adminPanel/users/datatablelang.json'),
(168, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '118', 'notBetween', '35deba7d3a02d2b53de94e734bd3e8fc', 'Dışında', '/adminPanel/users/datatablelang.json'),
(169, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '119', 'notEmpty', '794274d4b00c15eb5ec4ed51d2b1a51c', 'Dolu', '/adminPanel/users/datatablelang.json'),
(170, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '123', 'contains', '5f7c4edebe57e4e99047cb178f3834b6', 'İçerir', '/adminPanel/users/datatablelang.json'),
(171, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '124', 'empty', '6660916138c098550ec8dd0bd6c20de3', 'Boş', '/adminPanel/users/datatablelang.json'),
(172, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '125', 'endsWith', '62efb2680de7be075a33c3a7e2ad68a8', 'İle biter', '/adminPanel/users/datatablelang.json'),
(173, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '126', 'equals', 'd79492997d5ed50248309044570e07f8', 'Eşittir', '/adminPanel/users/datatablelang.json'),
(174, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '127', 'not', '9fa192622466df7b3b50d313ec17008c', 'Değildir', '/adminPanel/users/datatablelang.json'),
(175, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '128', 'notEmpty', '5ae00a535b498349045e45b4aba57b12', 'Dolu', '/adminPanel/users/datatablelang.json'),
(176, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '129', 'startsWith', '4cfe43c231933e3280b91c3b36d47049', 'İle başlar', '/adminPanel/users/datatablelang.json'),
(177, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '133', 'contains', 'b91eef95920394c73d47484bf8131062', 'İçerir', '/adminPanel/users/datatablelang.json'),
(178, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '134', 'empty', 'c57bc95d6a3832903f2340c12586542e', 'Boş', '/adminPanel/users/datatablelang.json'),
(179, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '135', 'equals', '500aa9813725a21279bd72dc4d333879', 'Eşittir', '/adminPanel/users/datatablelang.json'),
(180, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '136', 'not', '019064c335b376650d648533705e8f5a', 'Değildir', '/adminPanel/users/datatablelang.json'),
(181, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '137', 'notEmpty', 'd90c5d1c6b9061e637768af06a0db73b', 'Dolu', '/adminPanel/users/datatablelang.json'),
(182, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '138', 'without', 'bab316874577c66bc633226d66f2beef', 'Hariç', '/adminPanel/users/datatablelang.json'),
(183, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '141', 'data', '420c794880c6a6f4f51e162c757708e8', 'Veri', '/adminPanel/users/datatablelang.json'),
(184, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '142', 'deleteTitle', 'b23963351f755bd46571165c75840485', 'Filtreleme kuralını silin', '/adminPanel/users/datatablelang.json'),
(185, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '143', 'leftTitle', '5c455042a41e5ccf6f6b32e518efa386', 'Kriteri dışarı çıkart', '/adminPanel/users/datatablelang.json'),
(186, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '144', 'logicAnd', '6fac93706a094f0fc828221a802ee706', 've', '/adminPanel/users/datatablelang.json'),
(187, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '145', 'logicOr', '065dc8d0fa6e674d3db7f3c8988158d7', 'veya', '/adminPanel/users/datatablelang.json'),
(188, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '146', 'rightTitle', 'c02098b687f0657dce2e11c27d7fb0aa', 'Kriteri içeri al', '/adminPanel/users/datatablelang.json'),
(189, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '150', '_', '636717eac9a5258b2e353e6b4aaf6c76', 'Arama Oluşturucu (%d)', '/adminPanel/users/datatablelang.json'),
(190, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '152', 'value', '9ff49e570a50883968c5da7e2cf0c46f', 'Değer', '/adminPanel/users/datatablelang.json'),
(191, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '153', 'clearAll', 'fd0cc032a71fb033ac9f35cbf75bda60', 'Filtreleri Temizle', '/adminPanel/users/datatablelang.json'),
(192, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '157', 'clearMessage', '79c706e65e661a71e80e6b30309b8e8a', 'Hepsini Temizle', '/adminPanel/users/datatablelang.json'),
(193, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '161', '_', '93883516d2b64b3f8fa498377bde5a05', 'Arama Bölmesi (%d)', '/adminPanel/users/datatablelang.json'),
(194, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '165', 'emptyPanes', 'da24d1bc135fc679a8ca35d8444d6612', 'Arama Bölmesi yok', '/adminPanel/users/datatablelang.json'),
(195, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '166', 'loadMessage', '5e4c70ded6398cb05d591c77ccd6fac2', 'Arama Bölmeleri yükleniyor ...', '/adminPanel/users/datatablelang.json'),
(196, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '167', 'title', '7c37f0f9cc0a8787684d0c2e260fe085', 'Etkin filtreler - %d', '/adminPanel/users/datatablelang.json'),
(197, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '177', 'hours', '0464ffa3d4e720ba303d11feb165e2c6', 'Saat', '/adminPanel/users/datatablelang.json'),
(198, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '178', 'minutes', 'c55165b9c47da1fffab07af40b090e52', 'Dakika', '/adminPanel/users/datatablelang.json'),
(199, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '179', 'next', '805ce8610f77a06ecbd07665836883af', 'Sonraki', '/adminPanel/users/datatablelang.json'),
(200, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '180', 'previous', '13d7994f00b79526a2adf5a0f35948a2', 'Önceki', '/adminPanel/users/datatablelang.json'),
(201, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '181', 'seconds', '1459dad6be05c12c2a389e88ce29e8d7', 'Saniye', '/adminPanel/users/datatablelang.json'),
(202, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '182', 'unknown', '62bacd6796db18eb1e128a3a13ae8a4c', 'Bilinmeyen', '/adminPanel/users/datatablelang.json'),
(203, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '185', '6', '3ee25d2ff76e690ed969e4c7aaa9e051', 'Paz', '/adminPanel/users/datatablelang.json'),
(204, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '186', '5', '92c413b1b678049b991ad0cf7c23699b', 'Cmt', '/adminPanel/users/datatablelang.json'),
(205, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '187', '4', '79c8421fe8033b1ad71c4b7dd7e61428', 'Cum', '/adminPanel/users/datatablelang.json'),
(206, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '188', '3', '810b29eb660ddae0acd8b79e0689c9c2', 'Per', '/adminPanel/users/datatablelang.json'),
(207, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '189', '2', 'e484a6c0923e58642d606787a5f23663', 'Çar', '/adminPanel/users/datatablelang.json'),
(208, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '190', '1', '29da5fca280cb92eefd6c6b17498b008', 'Sal', '/adminPanel/users/datatablelang.json'),
(209, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '195', '9', '710ae95fbf6a7013a2459f67e9d881ec', 'Ekim', '/adminPanel/users/datatablelang.json'),
(210, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '196', '8', '388740e46df9b20a5269285cbee60546', 'Eylül', '/adminPanel/users/datatablelang.json'),
(211, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '197', '7', 'd7ef2b274572e106be4501d5bddbc465', 'Ağustos', '/adminPanel/users/datatablelang.json'),
(212, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '198', '6', 'af20e4ee9689723993a28e8475e81a8b', 'Temmuz', '/adminPanel/users/datatablelang.json'),
(213, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '199', '5', '291ed2e86412cbd0a0ec9a09ba6401fa', 'Haziran', '/adminPanel/users/datatablelang.json'),
(214, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '200', '4', 'c8e225efddee88ebe71288e1f1f16313', 'Mayıs', '/adminPanel/users/datatablelang.json'),
(215, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '201', '3', 'b23d8ae236e9079aad7df2a31df1003b', 'Nisan', '/adminPanel/users/datatablelang.json'),
(216, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '202', '2', 'd27540beef891d9be00d8122e9cde639', 'Mart', '/adminPanel/users/datatablelang.json'),
(217, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '203', '11', '27555457e7d02600d61ad3b819e50894', 'Aralık', '/adminPanel/users/datatablelang.json'),
(218, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '204', '10', 'f99013da81c6f4fe3303820075dde6cd', 'Kasım', '/adminPanel/users/datatablelang.json'),
(219, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '205', '1', '0b5038d7a2fb7db719ab0f9265b5d9b2', 'Şubat', '/adminPanel/users/datatablelang.json'),
(220, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '212', 'close', '5682541b930da9ce886dab8e3dbd7018', 'Kapat', '/adminPanel/users/datatablelang.json'),
(221, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '215', 'button', '09a480dd52f513ceee8bb4646cec0b23', 'Yeni', '/adminPanel/users/datatablelang.json'),
(222, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '216', 'submit', '4bea3892965848785acf87a16938282e', 'Kaydet', '/adminPanel/users/datatablelang.json'),
(223, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '217', 'title', '3d3190b1ee20b0dcf90a75c7459647be', 'Yeni kayıt oluştur', '/adminPanel/users/datatablelang.json'),
(224, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '221', 'button', '39d2d3f5532c1ab104820607ae5cb178', 'Düzenle', '/adminPanel/users/datatablelang.json'),
(225, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '222', 'submit', 'd371b379a64574ca44dead981de92e5d', 'Güncelle', '/adminPanel/users/datatablelang.json'),
(226, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '223', 'title', 'fc36cb3ac43086a2452d52d6cb22953b', 'Kaydı düzenle', '/adminPanel/users/datatablelang.json'),
(227, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '227', 'system', '949ce0e1c8433f9bbffc4b611f15f56b', 'Bir sistem hatası oluştu (Ayrıntılı bilgi)', '/adminPanel/users/datatablelang.json'),
(228, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '231', 'info', '9cd787b6632b9dabc193f02a7c941b0a', 'Seçili kayıtlar bu alanda farklı değerler içeriyor. Seçili kayıtların hepsinde bu alana aynı değeri atamak için buraya tıklayın; aksi halde her kayıt bu alanda kendi değerini koruyacak.', '/adminPanel/users/datatablelang.json'),
(229, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '232', 'noMulti', '841dd8b07890ff96bbaef3a35628cb4a', 'Bu alan bir grup olarak değil ancak tekil olarak düzenlenebilir.', '/adminPanel/users/datatablelang.json'),
(230, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '233', 'restore', '16ce59af97a3b2ea2116c599e8ef857a', 'Değişiklikleri geri al', '/adminPanel/users/datatablelang.json'),
(231, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '234', 'title', '899aa9341e490af8da5441d2cf05a4c6', 'Çoklu değer', '/adminPanel/users/datatablelang.json'),
(232, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '238', 'button', '21d2450b4ec32edadfe8173297b03e63', 'Sil', '/adminPanel/users/datatablelang.json'),
(233, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '241', '_', '63de4641ce9668405e4cba0a1c99bdb9', '%d adet kaydı silmek istediğinize emin misiniz?', '/adminPanel/users/datatablelang.json'),
(234, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '242', '1', '814a2995040b336b544204feca2c2374', 'Bu kaydı silmek istediğinizden emin misiniz?', '/adminPanel/users/datatablelang.json'),
(235, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '244', 'submit', '2d4e8698ff9dce3144e7154cd5ecc932', 'Sil', '/adminPanel/users/datatablelang.json'),
(236, 1, '/bitnameagencyframework/resources/helper/adminpanel/datatablelang.php', '245', 'title', 'bede6c9d0fcbe815774b7150608b7ab0', 'Kayıtları sil', '/adminPanel/users/datatablelang.json'),
(237, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '180', 'workstation_title', '08e5b3b88d4da98bf828ae20a0b9eb9b', 'İş Yönetim İstasyonu', '/adminPanel/workstation'),
(238, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '181', 'workstation_title_sub', 'f942d12575c2719c85bc2f62517754e4', 'BAF dosyalarınızı buradan aktif/pasif haline getirebilir ve önceliklerini belirleyebilirsiniz.', '/adminPanel/workstation'),
(239, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '182', 'disableButtontext', 'e279ba5eb9fe95f140d0e40f5cd7069b', 'Etkisizleştir', '/adminPanel/workstation'),
(240, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '183', 'enableButtontext', '75eaa987d0e3a2e3f0cca53d5131cc20', 'Etkinleştir', '/adminPanel/workstation'),
(241, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '184', 'priority', '56bf05745e16cc2eb3d57fcaf6f53905', 'Öncelik', '/adminPanel/workstation'),
(242, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '185', 'save', '4d9304fa04463467edb0b6037a3898b7', 'Kaydet', '/adminPanel/workstation'),
(243, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '186', 'location', '1ea3dbe1ba6a5161933fe2535fe6931e', 'Lokasyon:', '/adminPanel/workstation'),
(244, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '187', 'delete', 'ad5055ab869a8653ae33a565d5b71354', 'Sil', '/adminPanel/workstation'),
(245, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '188', 'placeholder_title', 'b7617e9056e1d82ba6f1769c270a361f', 'Başlık', '/adminPanel/workstation'),
(246, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '189', 'placeholder_desc', '357c867fb6728952d5d834f332d109ff', 'Açıklama', '/adminPanel/workstation'),
(247, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '135', 'logout_text', 'c07ab741a1f3eebf0809930f7ef43a30', 'Çıkış Yap', '/adminPanel/dashboard'),
(248, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '136', 'boardWidget', '8d4b836b24e008517224fedb7264fc59', 'Yönetim Widget', '/adminPanel/dashboard'),
(249, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '137', 'boardWidgetSub', '7d5fea08e58b2130116e0aa0e60700b0', 'Kullanımınızı kolaylaştıracak widgetlar.', '/adminPanel/dashboard'),
(250, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '178', 'title', '82832d420a2f06b058325c41689a610f', 'Workstation | BAF', '/adminPanel/workstation'),
(251, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '179', 'logout_text', '8266dd19f0522e660d92dffbf4e3483d', 'Çıkış Yap', '/adminPanel/workstation'),
(252, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '181', 'workstation_title', 'ed30140d807781cb0dde0f8816d6bae7', 'İş Yönetim İstasyonu', '/adminPanel/workstation'),
(253, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '182', 'workstation_title_sub', '34cbe773c03a8536cd07f558321557bc', 'BAF dosyalarınızı buradan aktif/pasif haline getirebilir ve önceliklerini belirleyebilirsiniz.', '/adminPanel/workstation'),
(254, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '183', 'disableButtontext', '422597d4443271cc2f1de7586c9cb05d', 'Etkisizleştir', '/adminPanel/workstation'),
(255, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '184', 'enableButtontext', '42f924c7c5211a473ee075dd4719e5fb', 'Etkinleştir', '/adminPanel/workstation'),
(256, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '185', 'priority', 'f5dfdd7285749aced50a1d6542e9b929', 'Öncelik', '/adminPanel/workstation'),
(257, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '186', 'save', '2ac3ff5a7c1664d8b934c66ef404c5dc', 'Kaydet', '/adminPanel/workstation'),
(258, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '187', 'location', '102f3c68e6d1ec9e8e5bb6ca7da9a500', 'Lokasyon:', '/adminPanel/workstation'),
(259, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '188', 'delete', '5be042bdeb2dcef77f1263af1d1a645f', 'Sil', '/adminPanel/workstation'),
(260, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '189', 'placeholder_title', '9a5e30a35e231e03ebdee8ec76f34f53', 'Başlık', '/adminPanel/workstation'),
(261, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '190', 'placeholder_desc', '4bc42488e496917991daf9b410bf4a7f', 'Açıklama', '/adminPanel/workstation'),
(262, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '344', 'title', 'cc47768b3a3ddb1607844f04f4ff2dd6', 'MenuSystem | BAF', '/adminPanel/menuSystem'),
(263, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '346', 'menuSelectplaceholder', '989a94669cb4277db78d12d5edf16b0f', 'Menü Seçiniz', '/adminPanel/menuSystem'),
(264, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '353', 'sectionTitle', 'ef480329ac1740abd25b6fd0e459f9bb', 'Menü Yönetim Sistemi', '/adminPanel/menuSystem'),
(265, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '354', 'sectionSub', '2c32bf109b69a1619b476a52a148f33c', 'Menü oluşturabilir, düzenleyebilir ve silebilirsiniz. Ayrıca sıralama ve hiyerarşi oluşturabilirsiniz.', '/adminPanel/menuSystem'),
(266, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '355', 'new_menu_placeholder', 'e1d516660850081f4e417b8cef87f0fd', 'Yeni Menü İsmi', '/adminPanel/menuSystem'),
(267, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '356', 'new_menu_button', '4a2cc07cf9a8debba5677dc2087820ed', 'Yeni Menü Oluştur', '/adminPanel/menuSystem');
INSERT INTO `translators_sentence` (`ts_ID`, `lang_ID`, `ts_path`, `ts_path_line`, `ts_key`, `ts_unique_key`, `ts_sentence`, `viewURL`) VALUES
(268, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '357', 'selectedMenu', '708633541af6c33fb212e5460c6479bf', 'Seçilen Menü', '/adminPanel/menuSystem'),
(269, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '358', 'deleteMenu', '373bbc789193a15e1a9e830624e9df37', 'Menüyü Sil', '/adminPanel/menuSystem'),
(270, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '359', 'nestable_title', '73c30efc13a31641cba1833bf79a0e2b', 'Menüyü Düzenle', '/adminPanel/menuSystem'),
(271, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '360', 'nestableUpdate_button', '60dc9aa13055195296933e4282cb14a4', 'Sıralamayı Güncelle', '/adminPanel/menuSystem'),
(272, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '361', 'item_add_title', '1e53ec8327cfbfb8ab633bc555a1c78c', 'Yeni Bağlantı Ekle', '/adminPanel/menuSystem'),
(273, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '362', 'itemKey_Placeholder', '2cd0c252697348a34db77103fe718c73', 'itemKey', '/adminPanel/menuSystem'),
(274, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '363', 'itemLink_Placeholder', '4401791d2bcbac237d1915370e411b09', 'itemLink', '/adminPanel/menuSystem'),
(275, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '364', 'itemTarget', '6e2a2ac3e65b30acafaf0c6e393406d6', 'linkTarget', '/adminPanel/menuSystem'),
(276, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '365', 'item_add_button', '9e108ead79b3f002e058bba9bee560ac', 'Link Ekle', '/adminPanel/menuSystem'),
(277, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '345', 'logout_text', '5cf2c1e3e96e68b0daa8827d56dbada6', 'Çıkış Yap', '/adminPanel/menuSystem'),
(278, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '347', 'menuSelectplaceholder', '256a58d63177fcf9ddc027d22cbd8e28', 'Menü Seçiniz', '/adminPanel/menuSystem'),
(279, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '354', 'sectionTitle', '619e1f6632d22c3b6104ee29df227afc', 'Menü Yönetim Sistemi', '/adminPanel/menuSystem'),
(280, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '355', 'sectionSub', '4048cd2d810b30ea3a4ea1a6ad216eb1', 'Menü oluşturabilir, düzenleyebilir ve silebilirsiniz. Ayrıca sıralama ve hiyerarşi oluşturabilirsiniz.', '/adminPanel/menuSystem'),
(281, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '356', 'new_menu_placeholder', '50f4c687c7a26c2461a50daa7ad0a585', 'Yeni Menü İsmi', '/adminPanel/menuSystem'),
(282, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '357', 'new_menu_button', '4d3a6a7228661899fa55783c880bd5cf', 'Yeni Menü Oluştur', '/adminPanel/menuSystem'),
(283, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '358', 'selectedMenu', '278447f80ff3db135cdb9e9fffefa285', 'Seçilen Menü', '/adminPanel/menuSystem'),
(284, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '359', 'deleteMenu', '06e985028afbfd7c4b97f12899d1aef2', 'Menüyü Sil', '/adminPanel/menuSystem'),
(285, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '360', 'nestable_title', 'c3fceef0f4e02b0cc4917c5e46d27563', 'Menüyü Düzenle', '/adminPanel/menuSystem'),
(286, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '361', 'nestableUpdate_button', 'd6915f53074d95ed7223b11fd279e5f2', 'Sıralamayı Güncelle', '/adminPanel/menuSystem'),
(287, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '362', 'item_add_title', '884c1686bf300307cd651e961ff05492', 'Yeni Bağlantı Ekle', '/adminPanel/menuSystem'),
(288, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '363', 'itemKey_Placeholder', '92589c8268124b26f55a11200221ed8a', 'itemKey', '/adminPanel/menuSystem'),
(289, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '364', 'itemLink_Placeholder', '649ababc214ff187e534bde89bbb3d1d', 'itemLink', '/adminPanel/menuSystem'),
(290, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '365', 'itemTarget', 'cb0a6d47292dc63f1c6a6120ea9c9786', 'linkTarget', '/adminPanel/menuSystem'),
(291, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '366', 'item_add_button', '5b4830c1f73cc316e660afb1c7e5cf1e', 'Link Ekle', '/adminPanel/menuSystem'),
(292, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '482', 'title', 'cd2a5ec328694a190543401c6e79bca7', 'Languages | BAF', '/adminPanel/languages'),
(293, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '483', 'sectionTitle', 'c30b12180bf7e4b8fc58df9d8abacc1b', 'Dil Yönetim Sistemi', '/adminPanel/languages'),
(294, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '484', 'sectionSub', '2fc6fa1583bbeb4fcbe6d337c3aff171', 'Mevcut dil paketlerini yönetebilir. Yeni dil paketleri oluşturabilirsiniz.', '/adminPanel/languages'),
(295, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '485', 'NewLanguage_placeholder', 'fc7a02801fa1a18a81135ad3ed2b36d5', 'Yeni Dil İsmi', '/adminPanel/languages'),
(296, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '486', 'new_menu_button', 'e6c43fb1634cb8b0c5fa381996d0a6cd', 'Yeni Dil Paketi Oluştur', '/adminPanel/languages'),
(297, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '488', 'languageSelectplaceholder', '904d33622872d232892a696910913b44', 'Dil Paketi Seçiniz', '/adminPanel/languages'),
(298, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '490', 'selectedLanguageText', '0d01090c4c5b625ba59c831b0591faee', 'Seçilen Dil Paketi:', '/adminPanel/languages'),
(299, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '492', 'deleteLanguageText', 'd2a8b391e383881f6a656962d9608c89', 'Dil Paketini Sil', '/adminPanel/languages'),
(300, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '494', 'languageEditbutton_text', 'cc44d8ec0142f32210b68da783f37020', 'Dil Paketini Düzenle', '/adminPanel/languages'),
(301, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '495', 'lang_code_text', '7f68edd4aed32912bc8b7de085e4aa5c', 'Dil Kodu', '/adminPanel/languages'),
(302, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '496', 'lang_flag_text', '0396c9288d9729d9b0b6b618c3a5158f', 'Dil Bayrağı', '/adminPanel/languages'),
(303, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '497', 'lang_name_text', 'bc4f3942ed4c48ce0f5941025fe0f72a', 'Dil İsmi', '/adminPanel/languages'),
(304, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '501', 'lang_update_text', 'bb4974e07849e2e140b31727201da154', 'Kaydet', '/adminPanel/languages'),
(305, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '503', 'PathSelectText', '2fbf8250d563187e984e1a1e66beb923', 'Dosya Yolunu Seçiniz', '/adminPanel/languages'),
(306, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '505', 'backButton', '1b3ef7274025a8a2fb626f510ccd70bf', 'Önceki', '/adminPanel/languages'),
(307, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '506', 'nextButton', '91803072ddf485798bc5424a23503e86', 'Sonraki', '/adminPanel/languages'),
(308, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '509', 'line_text', '16993cce09745931afcdc522bea901a8', 'SATIR', '/adminPanel/languages'),
(309, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '510', 'key_text', '95bf5314ea5d409cbe6a1d4cc2e93d5f', 'ANAHTAR', '/adminPanel/languages'),
(310, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '511', 'action_text', '6a01d9be007069b114d6823218b58850', 'AKSİYON', '/adminPanel/languages'),
(311, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '512', 'sentence_text', '12f2cab1a7b17eae814b3d791802be26', 'CÜMLE', '/adminPanel/languages'),
(312, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '513', 'saveText', '9251f0cac194387487daac8578088b0c', 'Kaydet', '/adminPanel/languages'),
(313, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '514', 'viewURLtext', 'b7e5d335c61f663b010fd9bb3147a72d', 'İlgili URL\'ye Git', '/adminPanel/languages'),
(314, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '515', 'viewCodetext', 'f2d2163604aa658bbe413e0ebc590d3e', 'İlgili Kodu Gör', '/adminPanel/languages'),
(315, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '517', 'debugText', '8be6b7a1aa649922d1fa9fb29cc02e15', 'Hata Ayıklayıcı', '/adminPanel/languages'),
(316, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '518', 'closeText', '84b99a138f8be8ea2de18858b77a7e93', 'Kapat', '/adminPanel/languages'),
(317, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '519', 'startText', 'ff1ae17351b2d565bc460a402381d83b', 'Başlat', '/adminPanel/languages'),
(318, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '520', 'loadingText', 'f5937efb25202e7476f7f4d662c0b747', 'Bekleyiniz...', '/adminPanel/languages'),
(319, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '521', 'successText', 'a4f4bce155e3565b8ed9aae63080ae55', 'Başarılı!', '/adminPanel/languages'),
(320, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '483', 'logout_text', 'd01e0a417e507339704920ed568c75bd', 'Çıkış Yap', '/adminPanel/languages'),
(321, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '484', 'sectionTitle', '2c4db68cb60d9acd7a6642411e453e5b', 'Dil Yönetim Sistemi', '/adminPanel/languages'),
(322, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '485', 'sectionSub', '09107e233b87271aaf056d098f422768', 'Mevcut dil paketlerini yönetebilir. Yeni dil paketleri oluşturabilirsiniz.', '/adminPanel/languages'),
(323, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '486', 'NewLanguage_placeholder', 'c3ddef867ec3256aa15ed19feb806039', 'Yeni Dil İsmi', '/adminPanel/languages'),
(324, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '487', 'new_menu_button', '06a933e2e2cc65e2a1feff7acf4e2bb1', 'Yeni Dil Paketi Oluştur', '/adminPanel/languages'),
(325, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '489', 'languageSelectplaceholder', 'e4279fdad334176f91a5408b23eac07f', 'Dil Paketi Seçiniz', '/adminPanel/languages'),
(326, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '491', 'selectedLanguageText', '998de0f9c196117fefd6bf5bd6153487', 'Seçilen Dil Paketi:', '/adminPanel/languages'),
(327, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '493', 'deleteLanguageText', 'a336c2919675cb83eceecb56f4623f1f', 'Dil Paketini Sil', '/adminPanel/languages'),
(328, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '495', 'languageEditbutton_text', '8c548558cd13b707502d11432bf09db1', 'Dil Paketini Düzenle', '/adminPanel/languages'),
(329, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '496', 'lang_code_text', '39f5a421d7d9a0b4bf66b236a816abf8', 'Dil Kodu', '/adminPanel/languages'),
(330, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '497', 'lang_flag_text', 'c9036f8bba855a93a520d74057b324e4', 'Dil Bayrağı', '/adminPanel/languages'),
(331, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '498', 'lang_name_text', '1cd01364e759da91cc6c06688fbac94d', 'Dil İsmi', '/adminPanel/languages'),
(332, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '502', 'lang_update_text', 'b25699e82ccb2b839a6716e394d726a7', 'Kaydet', '/adminPanel/languages'),
(333, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '504', 'PathSelectText', 'a4e25f482bcde1d41cfdad99d08160a8', 'Dosya Yolunu Seçiniz', '/adminPanel/languages'),
(334, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '506', 'backButton', '87f9510c55e90b4eedef78e0570ba759', 'Önceki', '/adminPanel/languages'),
(335, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '507', 'nextButton', '205467829d31ffb4d59f95f073ad8584', 'Sonraki', '/adminPanel/languages'),
(336, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '510', 'line_text', '4f4fd4d78dec027f5448f15043ee86b5', 'SATIR', '/adminPanel/languages'),
(337, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '511', 'key_text', 'd3fcb81b702b352c41c45d5d168b1241', 'ANAHTAR', '/adminPanel/languages'),
(338, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '512', 'action_text', '7fac9ce645312d234cfb390f7371397f', 'AKSİYON', '/adminPanel/languages'),
(339, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '513', 'sentence_text', '8d237cbfde0ac4a6344446ce86d39411', 'CÜMLE', '/adminPanel/languages'),
(340, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '514', 'saveText', '6d61bf951502fb1b0602763f08cde33f', 'Kaydet', '/adminPanel/languages'),
(341, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '515', 'viewURLtext', '8591313c923ffc5e8216750e146f1a14', 'İlgili URL\'ye Git', '/adminPanel/languages'),
(342, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '516', 'viewCodetext', '0f9c528e72e95624fe612e2b8ecc6fba', 'İlgili Kodu Gör', '/adminPanel/languages'),
(343, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '518', 'debugText', '07f4d66803ceccb2c9092d57fcad4fc3', 'Hata Ayıklayıcı', '/adminPanel/languages'),
(344, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '519', 'closeText', '83989abebb5bf6d53884e52040bc0d02', 'Kapat', '/adminPanel/languages'),
(345, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '520', 'startText', '9d14899bab9dffe0bbd3bba023f0702f', 'Başlat', '/adminPanel/languages'),
(346, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '521', 'loadingText', '9f65892b22eef1a694559ecede6d1736', 'Bekleyiniz...', '/adminPanel/languages'),
(347, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '522', 'successText', '4aee42eb2e3ba663af16612108b7aeb8', 'Başarılı!', '/adminPanel/languages'),
(348, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '479', 'title', 'b5ca907eb1f743156b489daf6c22b161', 'Languages | BAF', '/adminPanel/languages'),
(349, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '480', 'sectionTitle', 'd7dd155186607a2fcb6a6e4c055a167e', 'Dil Yönetim Sistemi', '/adminPanel/languages'),
(350, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '481', 'sectionSub', '5857da0a1120d51602d67863bbea5a89', 'Mevcut dil paketlerini yönetebilir. Yeni dil paketleri oluşturabilirsiniz.', '/adminPanel/languages'),
(351, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '482', 'NewLanguage_placeholder', 'a5aaa5aba947f9d8b629e1128bf7dca1', 'Yeni Dil İsmi', '/adminPanel/languages'),
(352, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '483', 'new_menu_button', 'c7a05df3b4dc3c1d9ce840b09498e7b0', 'Yeni Dil Paketi Oluştur', '/adminPanel/languages'),
(353, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '485', 'languageSelectplaceholder', '0c9bb7f998ae88cf607e1c4bdb8f1491', 'Dil Paketi Seçiniz', '/adminPanel/languages'),
(354, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '487', 'selectedLanguageText', 'a5560aeefdc683b3a8895ba9dd5e2395', 'Seçilen Dil Paketi:', '/adminPanel/languages'),
(355, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '489', 'deleteLanguageText', 'b536cbf9b8b05a5f389569bbff461618', 'Dil Paketini Sil', '/adminPanel/languages'),
(356, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '491', 'languageEditbutton_text', '8a8e6104579703a41804e73e01e69a24', 'Dil Paketini Düzenle', '/adminPanel/languages'),
(357, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '492', 'lang_code_text', '1a08236e9f80607c60bf530157b7feae', 'Dil Kodu', '/adminPanel/languages'),
(358, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '493', 'lang_flag_text', '2bb0a447019bf90d572fd01ef3e9190a', 'Dil Bayrağı', '/adminPanel/languages'),
(359, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '494', 'lang_name_text', 'f2caf14bcea17f7b44ed3c97fadec72a', 'Dil İsmi', '/adminPanel/languages'),
(360, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '498', 'lang_update_text', 'e5f4dc69b2a86afa3e149380e736539b', 'Kaydet', '/adminPanel/languages'),
(361, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '500', 'PathSelectText', 'ecb994ccf2d5d9ca0da5a7e8441215e6', 'Dosya Yolunu Seçiniz', '/adminPanel/languages'),
(362, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '502', 'backButton', 'f02b341ae8afe19049f89d890babeacf', 'Önceki', '/adminPanel/languages'),
(363, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '503', 'nextButton', 'ca8aee93028a9256dcedb0511a9e05a7', 'Sonraki', '/adminPanel/languages'),
(364, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '506', 'line_text', 'ccd5c9b2d21b9eb8c5838e3fde4b98d7', 'SATIR', '/adminPanel/languages'),
(365, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '507', 'key_text', '9246bbf49a6b6227b2634c441486bc90', 'ANAHTAR', '/adminPanel/languages'),
(366, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '508', 'action_text', '3d1970ad00b1d944c86695a479ef7aaa', 'AKSİYON', '/adminPanel/languages'),
(367, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '509', 'sentence_text', 'd31b546a69c0ab7883407824fdac20e3', 'CÜMLE', '/adminPanel/languages'),
(368, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '510', 'saveText', '640944718a1227b7404982e39037db1f', 'Kaydet', '/adminPanel/languages'),
(369, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '511', 'viewURLtext', '3a5ecd83d253f37cf52a9d5017e86b78', 'İlgili URL\'ye Git', '/adminPanel/languages'),
(370, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '512', 'viewCodetext', '8a3701942eecfab7148344dc43824e80', 'İlgili Kodu Gör', '/adminPanel/languages'),
(371, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '514', 'debugText', '7631069c89fb398e12082f3955beeac8', 'Hata Ayıklayıcı', '/adminPanel/languages'),
(372, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '515', 'closeText', '279589411538ab4d054f10bd87473f34', 'Kapat', '/adminPanel/languages'),
(373, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '516', 'startText', 'afcd651eecd53247159ca47646242018', 'Başlat', '/adminPanel/languages'),
(374, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '517', 'loadingText', '642180693a692f7a6aa1354f588248e0', 'Bekleyiniz...', '/adminPanel/languages'),
(375, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '518', 'successText', '03e1ac375a80419ebba5d30ca0843a66', 'Başarılı!', '/adminPanel/languages'),
(376, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '980', 'title', 'bc41d59fbd3e1879127b6dfb99cde00b', 'Rota Listesi | BAF', '/adminPanel/routelist'),
(377, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '981', 'sectionTitle', '5086d9009b88752c82d3aff9990913f9', 'Rota Listesi', '/adminPanel/routelist'),
(378, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '982', 'sectionSub', '3ce12e48d07103cc8072315774fd5045', 'Tüm rotaları görüntüleyebilirsiniz.', '/adminPanel/routelist'),
(379, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '984', 'slugText', '5a7b70217fd72744e32a53ba3a88be0e', 'URL', '/adminPanel/routelist'),
(380, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '985', 'filepathText', '1241ed5105ba01f18a208832d2c4be8e', 'Filepath', '/adminPanel/routelist'),
(381, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '986', 'lineText', '6305a8e15ccbb467cac32fb8126e24ee', 'Satır', '/adminPanel/routelist'),
(382, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '987', 'empty_text', 'b5216cb3d0a6ce2fd6525063397a9087', 'Bulunamadı!', '/adminPanel/routelist'),
(383, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '960', 'title', 'f987db38c7ce7bc2f20ad285a41441f7', 'Arama Sonuçları | BAF', '/adminPanel/search?q='),
(384, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '961', 'sectionTitle', '18ee7eb7769cf0ee78d1626c72760001', 'Arama Sonuçları', '/adminPanel/search?q='),
(385, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '962', 'sectionSub', '57e532c1d497d6a52c0fb64f55939ad7', 'Panel Arama Motoru', '/adminPanel/search?q='),
(386, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '964', 'empty_text', '0032b68be818133f537eb2978d4dc121', 'Bulunamadı!', '/adminPanel/search?q='),
(387, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '20', 'search_text', '8e32a158e4f410153cbc20c750dced60', 'Arama Yap', '/adminPanel/workstation'),
(388, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '21', 'logout_text', '198ed8f221f5fdb810841055c07cd043', 'Çıkış Yap', '/adminPanel/workstation'),
(389, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '33', 'title', 'e71f9a82fef1a92c23f2a1760a4d87a0', 'Hoş geldiniz.', '/adminPanel/workstation'),
(390, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '34', 'sub', '5468c4e194273d8fa5549dd96f02a4e0', 'Hesabınızda oturum açın ve web sitenizi yönetmeye başlayın.', '/adminPanel/workstation'),
(391, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '185', 'title', '0840a342c3a175f64fbce8ac2789ec41', 'Workstation | BAF', '/adminPanel/workstation'),
(392, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '188', 'workstation_title', 'f4f4ad8a9e3b5a09d5e4d7bca27368da', 'İş Yönetim İstasyonu', '/adminPanel/workstation'),
(393, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '189', 'workstation_title_sub', 'af14890f774c2518231fdceda35b4e2f', 'BAF dosyalarınızı buradan aktif/pasif haline getirebilir ve önceliklerini belirleyebilirsiniz.', '/adminPanel/workstation'),
(394, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '190', 'disableButtontext', '8d8bd3b12a3b3ee3b31438c44f66d3ea', 'Etkisizleştir', '/adminPanel/workstation'),
(395, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '191', 'enableButtontext', '85c0670f1427fb8156843b06cd83f031', 'Etkinleştir', '/adminPanel/workstation'),
(396, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '192', 'priority', '9b3491a74009c8139e46213ac3400d12', 'Öncelik', '/adminPanel/workstation'),
(397, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '193', 'save', '2dbda2808d7af9088034a08d2b787348', 'Kaydet', '/adminPanel/workstation'),
(398, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '194', 'location', '29e7c223460244faa9e44a5ce95c76f9', 'Lokasyon:', '/adminPanel/workstation'),
(399, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '195', 'delete', 'b8022b9a0eb0a04c469cca13f84840e2', 'Sil', '/adminPanel/workstation'),
(400, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '196', 'placeholder_title', 'd484eebc6b3306c6d45e09bda99022f4', 'Başlık', '/adminPanel/workstation'),
(401, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '197', 'placeholder_desc', '8a24a5473d04406ec2748e439e7e8aed', 'Açıklama', '/adminPanel/workstation'),
(402, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '142', 'title', '2ed48810ed74461e058976c56168fe22', 'Dashboard | BAF', '/adminPanel/dashboard'),
(403, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '143', 'boardWidget', '6eccb68129843f830d32b07b59c20c60', 'Yönetim Widget', '/adminPanel/dashboard'),
(404, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '144', 'boardWidgetSub', '53968d178a72d36e93f958d677a7e052', 'Kullanımınızı kolaylaştıracak widgetlar.', '/adminPanel/dashboard'),
(405, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '134', 'welcome', 'ce87ad4f4cf98854ea17f2a6730ba176', 'Hoşgeldiniz', '/adminPanel/dashboard'),
(406, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '135', 'welcomeSub', '24623bc0843ed1c6667ce87382e24f68', 'Hoşgeldiniz', '/adminPanel/dashboard'),
(407, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '187', 'title', '11aba5abad3a2444a6fa919876ae499d', 'Workstation | BAF', '/adminPanel/workstation'),
(408, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '190', 'workstation_title', '4fe31a1ca8cde88eb62525d96f591683', 'İş Yönetim İstasyonu', '/adminPanel/workstation'),
(409, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '191', 'workstation_title_sub', 'e612c41610b555eafdffa6a6c4105749', 'BAF dosyalarınızı buradan aktif/pasif haline getirebilir ve önceliklerini belirleyebilirsiniz.', '/adminPanel/workstation'),
(410, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '192', 'disableButtontext', '3f675d7ba6d714569b567abf534c138c', 'Etkisizleştir', '/adminPanel/workstation'),
(411, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '193', 'enableButtontext', '4382cec3331681f7429d04dbdc1d0cc7', 'Etkinleştir', '/adminPanel/workstation'),
(412, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '194', 'priority', '21c5094779983e7dc096000915cad205', 'Öncelik', '/adminPanel/workstation'),
(413, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '195', 'save', '866bdd622753e7138bf57f4b8bac7647', 'Kaydet', '/adminPanel/workstation'),
(414, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '196', 'location', '55e9b8064eb4b2524a1cebf16686ffa1', 'Lokasyon:', '/adminPanel/workstation'),
(415, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '197', 'delete', '96f854e39bf55edc8c37e04568abbd32', 'Sil', '/adminPanel/workstation'),
(416, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '198', 'placeholder_title', '3df6305fa2ad99547f06555045ae5eef', 'Başlık', '/adminPanel/workstation'),
(417, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '199', 'placeholder_desc', 'b2f33ad8859066bfd154e209d5e3324e', 'Açıklama', '/adminPanel/workstation'),
(418, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '191', 'workstation_title', 'de7170976de22ef61c1170922af422d5', 'İş Yönetim İstasyonu', '/adminPanel/workstation'),
(419, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '192', 'workstation_title_sub', 'ff3f5cc0021595a471584f0ea26aef84', 'BAF dosyalarınızı buradan aktif/pasif haline getirebilir ve önceliklerini belirleyebilirsiniz.', '/adminPanel/workstation'),
(420, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '193', 'disableButtontext', '02451b43f199add031aedb2a986f61e1', 'Etkisizleştir', '/adminPanel/workstation'),
(421, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '194', 'enableButtontext', 'eebb2031a6c5c64b529465d1a81e323c', 'Etkinleştir', '/adminPanel/workstation'),
(422, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '195', 'priority', 'bd41870aa30f077d1f60006364a5b51c', 'Öncelik', '/adminPanel/workstation'),
(423, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '196', 'save', '1563883fd71aa9d6fe9df35a5f8c46fd', 'Kaydet', '/adminPanel/workstation'),
(424, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '197', 'location', '504f820becff530c56ce06201e2f21e8', 'Lokasyon:', '/adminPanel/workstation'),
(425, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '198', 'delete', 'f3669294b34888ac54f737a3e8dac986', 'Sil', '/adminPanel/workstation'),
(426, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '199', 'placeholder_title', 'acc39bbec9a153c36d155329a12f7299', 'Başlık', '/adminPanel/workstation'),
(427, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '200', 'placeholder_desc', '9729cf9026f89f55e9fb737b54753f6d', 'Açıklama', '/adminPanel/workstation'),
(428, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '354', 'title', 'e89c7efdcb2fe347ce853236f4d066ce', 'MenuSystem | BAF', '/adminPanel/menuSystem'),
(429, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '356', 'menuSelectplaceholder', 'ece9e5e47d44c91551452a511950314e', 'Menü Seçiniz', '/adminPanel/menuSystem'),
(430, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '363', 'sectionTitle', '0dce3a4f4854f6f8c486347e07840e11', 'Menü Yönetim Sistemi', '/adminPanel/menuSystem'),
(431, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '364', 'sectionSub', '945fe9644596c12399af797020bae7e6', 'Menü oluşturabilir, düzenleyebilir ve silebilirsiniz. Ayrıca sıralama ve hiyerarşi oluşturabilirsiniz.', '/adminPanel/menuSystem'),
(432, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '365', 'new_menu_placeholder', '444014f6fa3ea4ece4ab1a29ec010d73', 'Yeni Menü İsmi', '/adminPanel/menuSystem'),
(433, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '366', 'new_menu_button', 'ec13c4a358038852243635b54e497166', 'Yeni Menü Oluştur', '/adminPanel/menuSystem'),
(434, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '367', 'selectedMenu', '3e7208e7c3c00d0db368979bbdaa9f9e', 'Seçilen Menü', '/adminPanel/menuSystem'),
(435, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '368', 'deleteMenu', '3868be429007da15e8c2fe342dcae8aa', 'Menüyü Sil', '/adminPanel/menuSystem'),
(436, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '369', 'nestable_title', '218221d9b113447635a07256dab1a49a', 'Menüyü Düzenle', '/adminPanel/menuSystem'),
(437, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '370', 'nestableUpdate_button', '1f96fcd0d89f5384125c7f9c06e16ade', 'Sıralamayı Güncelle', '/adminPanel/menuSystem'),
(438, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '371', 'item_add_title', '39c76162bafc22b7a7a1602a264c1706', 'Yeni Bağlantı Ekle', '/adminPanel/menuSystem'),
(439, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '372', 'itemKey_Placeholder', '5c52f1efc0d420374752e78831e68431', 'itemKey', '/adminPanel/menuSystem'),
(440, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '373', 'itemLink_Placeholder', '9352b6d9abfd10e98463395bf04a745d', 'itemLink', '/adminPanel/menuSystem'),
(441, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '374', 'itemTarget', '688b26a131b326334bb481896ee36cea', 'linkTarget', '/adminPanel/menuSystem'),
(442, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '375', 'item_add_button', '080306099056b0b36a5232e703bfd1ed', 'Link Ekle', '/adminPanel/menuSystem'),
(443, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '358', 'menuSelectplaceholder', '5640110fd975fc750290595efb50293c', 'Menü Seçiniz', '/adminPanel/menuSystem'),
(444, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '365', 'sectionTitle', '99bb95d19417db7b4f4286394348f15e', 'Menü Yönetim Sistemi', '/adminPanel/menuSystem'),
(445, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '366', 'sectionSub', '17af4523ffdb20120e0c86e935dfe4b5', 'Menü oluşturabilir, düzenleyebilir ve silebilirsiniz. Ayrıca sıralama ve hiyerarşi oluşturabilirsiniz.', '/adminPanel/menuSystem'),
(446, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '367', 'new_menu_placeholder', '081236f7e7a8da237e2b95e90b3bb982', 'Yeni Menü İsmi', '/adminPanel/menuSystem'),
(447, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '368', 'new_menu_button', '537661b2717e26f0b0e9ea5ca5360bd4', 'Yeni Menü Oluştur', '/adminPanel/menuSystem'),
(448, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '369', 'selectedMenu', 'fe31a4b1fa07b5af456d410d47d75c9b', 'Seçilen Menü', '/adminPanel/menuSystem'),
(449, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '370', 'deleteMenu', 'ae3a93b5b1ce784166dd5baaaa001150', 'Menüyü Sil', '/adminPanel/menuSystem'),
(450, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '371', 'nestable_title', '6e4a021adfed1015a4c6a18735516542', 'Menüyü Düzenle', '/adminPanel/menuSystem'),
(451, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '372', 'nestableUpdate_button', '3a164f9236bcc1985a87808641a32111', 'Sıralamayı Güncelle', '/adminPanel/menuSystem'),
(452, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '373', 'item_add_title', '911fc65c429ff6920ff7af2d9f02e33f', 'Yeni Bağlantı Ekle', '/adminPanel/menuSystem'),
(453, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '374', 'itemKey_Placeholder', 'fd1500fb9081fbe4056f58f37d89094d', 'itemKey', '/adminPanel/menuSystem'),
(454, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '375', 'itemLink_Placeholder', '9c56b62d63c81bf129167973995f4563', 'itemLink', '/adminPanel/menuSystem'),
(455, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '376', 'itemTarget', '8e188e03cae26475cb2ce5aa57afbd4f', 'linkTarget', '/adminPanel/menuSystem'),
(456, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '377', 'item_add_button', '7bc916e0d92ac82f76459bddaa73bf32', 'Link Ekle', '/adminPanel/menuSystem'),
(457, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '493', 'title', '5ae9fc52db719db37e0c5f7e5cd778f2', 'Languages | BAF', '/adminPanel/languages'),
(458, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '494', 'sectionTitle', 'fc86f78ecee6111c2592b9c922c46807', 'Dil Yönetim Sistemi', '/adminPanel/languages'),
(459, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '495', 'sectionSub', '333043dc85c467381ba4f82e2dc45f85', 'Mevcut dil paketlerini yönetebilir. Yeni dil paketleri oluşturabilirsiniz.', '/adminPanel/languages'),
(460, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '496', 'NewLanguage_placeholder', '001604d2bc576ea54e86d5d26d5a42bb', 'Yeni Dil İsmi', '/adminPanel/languages'),
(461, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '497', 'new_menu_button', '313b7b9c9a33585bcf8df7107c0ce5b6', 'Yeni Dil Paketi Oluştur', '/adminPanel/languages'),
(462, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '499', 'languageSelectplaceholder', '9e5725faedfc4fac440116cafffa113f', 'Dil Paketi Seçiniz', '/adminPanel/languages'),
(463, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '501', 'selectedLanguageText', '969b48f0938fc5f1f3a1a102ce9eec44', 'Seçilen Dil Paketi:', '/adminPanel/languages'),
(464, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '503', 'deleteLanguageText', '1454cc8d389c04a193067e2b795b17f1', 'Dil Paketini Sil', '/adminPanel/languages'),
(465, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '505', 'languageEditbutton_text', '111acd96f290fbd9e60fc3c9c4c24a27', 'Dil Paketini Düzenle', '/adminPanel/languages'),
(466, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '506', 'lang_code_text', '519af6aee3927633036a7b80e10f7704', 'Dil Kodu', '/adminPanel/languages'),
(467, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '507', 'lang_flag_text', '6bc50c9a010370b6cf0193956dae475f', 'Dil Bayrağı', '/adminPanel/languages'),
(468, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '508', 'lang_name_text', '42205ecccc568957828d67ab209b41ea', 'Dil İsmi', '/adminPanel/languages'),
(469, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '512', 'lang_update_text', '0256184486f14ac6482b120d667a0882', 'Kaydet', '/adminPanel/languages'),
(470, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '514', 'PathSelectText', 'b78f9e5b58ef6ea41f151ea78d3a7717', 'Dosya Yolunu Seçiniz', '/adminPanel/languages'),
(471, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '516', 'backButton', '00ea29e7a439130b27d120a9097b2bdd', 'Önceki', '/adminPanel/languages'),
(472, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '517', 'nextButton', 'fbac074e1341a812598e090e915b75cf', 'Sonraki', '/adminPanel/languages'),
(473, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '520', 'line_text', 'b2112de858b228bb3008f1c219d46874', 'SATIR', '/adminPanel/languages'),
(474, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '521', 'key_text', 'de9a23ee96a786ee148b87ed8b44f5c9', 'ANAHTAR', '/adminPanel/languages'),
(475, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '522', 'action_text', 'd1b6e2c1758d0f2633fbba51a4c87565', 'AKSİYON', '/adminPanel/languages'),
(476, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '523', 'sentence_text', '465713de333eb294e7df90c4f26bcd90', 'CÜMLE', '/adminPanel/languages'),
(477, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '524', 'saveText', 'ae85d22310f25756ff584a2fd60121b4', 'Kaydet', '/adminPanel/languages'),
(478, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '525', 'viewURLtext', 'a16946b51ccaf97b22ce2b3d504ab462', 'İlgili URL\'ye Git', '/adminPanel/languages'),
(479, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '526', 'viewCodetext', '4f99826fb3dfb6b3ded8a4ea1795c0c8', 'İlgili Kodu Gör', '/adminPanel/languages'),
(480, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '528', 'debugText', 'eef1688d8744d6c4046e67962fc9bacd', 'Hata Ayıklayıcı', '/adminPanel/languages'),
(481, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '529', 'closeText', '6f82cbdac28851925fd040eb4f367663', 'Kapat', '/adminPanel/languages'),
(482, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '530', 'startText', 'bed9d9b57301af9c920a87e08259aadd', 'Başlat', '/adminPanel/languages'),
(483, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '531', 'loadingText', '82f59059938a246edbed676097628462', 'Bekleyiniz...', '/adminPanel/languages'),
(484, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '532', 'successText', '119e9a2600354580a7d7132a8d77caca', 'Başarılı!', '/adminPanel/languages'),
(485, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '496', 'sectionTitle', '1375912101062733c4de3e5b97bb1d09', 'Dil Yönetim Sistemi', '/adminPanel/languages'),
(486, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '497', 'sectionSub', 'a8f0886224caade501742a7569399fb3', 'Mevcut dil paketlerini yönetebilir. Yeni dil paketleri oluşturabilirsiniz.', '/adminPanel/languages'),
(487, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '498', 'NewLanguage_placeholder', '0c002246cb011a1f9ee363f9e98a330b', 'Yeni Dil İsmi', '/adminPanel/languages'),
(488, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '499', 'new_menu_button', '3f9fcf5f221a4a767e37776603de1e21', 'Yeni Dil Paketi Oluştur', '/adminPanel/languages'),
(489, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '501', 'languageSelectplaceholder', 'f264e823006fdda18dd442f23e14b515', 'Dil Paketi Seçiniz', '/adminPanel/languages'),
(490, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '503', 'selectedLanguageText', '411afba8dc8e31ebc138695d53ca5fb0', 'Seçilen Dil Paketi:', '/adminPanel/languages'),
(491, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '505', 'deleteLanguageText', 'f72efd2d69c7c5e10eaf31bbf08dab81', 'Dil Paketini Sil', '/adminPanel/languages'),
(492, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '507', 'languageEditbutton_text', '4da9b940c1fd9a7abfee7f86730e197d', 'Dil Paketini Düzenle', '/adminPanel/languages'),
(493, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '508', 'lang_code_text', '4b55be443cb722d0ee1e93fffc86b7d6', 'Dil Kodu', '/adminPanel/languages'),
(494, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '509', 'lang_flag_text', '87773e2450039d5a6f2537dc2df92b3a', 'Dil Bayrağı', '/adminPanel/languages'),
(495, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '510', 'lang_name_text', '53950fffabbf62d078df6a174e44d073', 'Dil İsmi', '/adminPanel/languages'),
(496, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '514', 'lang_update_text', '6b1256ac4cf941d7c7083ebdb06a955c', 'Kaydet', '/adminPanel/languages'),
(497, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '516', 'PathSelectText', 'b2df9fbe660373d6531c8cbff38452cd', 'Dosya Yolunu Seçiniz', '/adminPanel/languages'),
(498, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '518', 'backButton', '8d474fccbb02709a798dbe25b6652264', 'Önceki', '/adminPanel/languages'),
(499, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '519', 'nextButton', 'bc048f5f3c0c500d7089af62b7658056', 'Sonraki', '/adminPanel/languages'),
(500, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '522', 'line_text', '7008bfe605f411711ea9908d083a5cad', 'SATIR', '/adminPanel/languages'),
(501, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '523', 'key_text', '8a6900843618c7967aafe4bfdbd52cb0', 'ANAHTAR', '/adminPanel/languages'),
(502, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '524', 'action_text', '1e542ed468cf42f5dee912dc9009cc0b', 'AKSİYON', '/adminPanel/languages'),
(503, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '525', 'sentence_text', '9e59cd36f1313250a2ea5c6fc763856a', 'CÜMLE', '/adminPanel/languages'),
(504, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '526', 'saveText', '741e31c1d849dd082e68e879fd7e75e6', 'Kaydet', '/adminPanel/languages'),
(505, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '527', 'viewURLtext', '91b418c8fe14f0491449650a69e3a6a0', 'İlgili URL\'ye Git', '/adminPanel/languages'),
(506, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '528', 'viewCodetext', '086a6aaa6ed8370574402a99c570bbd5', 'İlgili Kodu Gör', '/adminPanel/languages'),
(507, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '530', 'debugText', 'f37aa653a8f9db829c13bd5e488cf059', 'Hata Ayıklayıcı', '/adminPanel/languages'),
(508, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '531', 'closeText', 'b7e4f8886f58e19a11b01bf6385bf6b4', 'Kapat', '/adminPanel/languages'),
(509, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '532', 'startText', '48e398c0a485d66dcde2495ec1f7686e', 'Başlat', '/adminPanel/languages'),
(510, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '533', 'loadingText', 'c31cbb9a2cd118ed81bc50d30db691b8', 'Bekleyiniz...', '/adminPanel/languages'),
(511, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '534', 'successText', '6fd9320f3d1662885a727299616110ce', 'Başarılı!', '/adminPanel/languages'),
(512, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '583', 'title', 'ebb0ea17bed92c0682b18d1fead8fa07', 'SaveDisk | BAF', '/adminPanel/savedisk'),
(513, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '584', 'sectionTitle', 'e12488cdb70cf753bed94af207250fc0', 'SaveDisk Sistemi', '/adminPanel/savedisk'),
(514, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '585', 'sectionSub', 'eae544a734ded94ae846db6f68f8a6f8', 'Sistemde panelden değiştirilebilen değişkenler oluşturabilirsiniz.', '/adminPanel/savedisk'),
(515, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '587', 'pathListplaceholder', 'f1015d3472855c98fda8fc7be9015849', 'Dosya Yolunu Seçiniz', '/adminPanel/savedisk'),
(516, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '591', 'lineText', 'ddb394b12e09dac7939b1cb49ec8f600', 'SATIR', '/adminPanel/savedisk'),
(517, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '592', 'keyText', 'a778a21fe780ece9ecdb31f9fc007fed', 'ANAHTAR', '/adminPanel/savedisk'),
(518, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '593', 'dataText', 'fad5058ef5e2aec5dfc86afb4726061c', 'VERİ', '/adminPanel/savedisk'),
(519, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '594', 'actionText', '483b164c803dc9780c969b1d57787e2d', 'AKSİYON', '/adminPanel/savedisk'),
(520, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '586', 'sectionTitle', 'fa320d3551e885405049412480d033c5', 'SaveDisk Sistemi', '/adminPanel/savedisk'),
(521, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '587', 'sectionSub', '49d7f4bd3a1b8cf4fb60547b0c199cae', 'Sistemde panelden değiştirilebilen değişkenler oluşturabilirsiniz.', '/adminPanel/savedisk'),
(522, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '589', 'pathListplaceholder', 'a72d8eb0a21fe4d201eda83a704fbf25', 'Dosya Yolunu Seçiniz', '/adminPanel/savedisk'),
(523, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '593', 'lineText', 'c6312bd0c43576f06889cbf3c403e96e', 'SATIR', '/adminPanel/savedisk'),
(524, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '594', 'keyText', '7f4ce9f2819d83bb4593d0febe405f7b', 'ANAHTAR', '/adminPanel/savedisk'),
(525, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '595', 'dataText', '246bc98cd189b258387d40bcfd09f14c', 'VERİ', '/adminPanel/savedisk'),
(526, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '596', 'actionText', '4ced310ee896a6bc2dd4840253281065', 'AKSİYON', '/adminPanel/savedisk'),
(527, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '998', 'title', '31f6672e86f76b1824854412e652a8d9', 'Rota Listesi | BAF', '/adminPanel/routelist'),
(528, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '999', 'sectionTitle', '67c28e0682605bb0386064611f8ee14e', 'Rota Listesi', '/adminPanel/routelist'),
(529, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1000', 'sectionSub', 'dd3c86b0363b27a48aeb8aacf8890d48', 'Tüm rotaları görüntüleyebilirsiniz.', '/adminPanel/routelist'),
(530, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1002', 'slugText', '7947f8a62370609bed76d1b225951693', 'URL', '/adminPanel/routelist'),
(531, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1003', 'filepathText', 'e3ad689c1478f6d167188a1a4d12fbf3', 'Filepath', '/adminPanel/routelist'),
(532, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1004', 'lineText', 'fdc3ec35a3fabe2383e537fcb3fe4bcf', 'Satır', '/adminPanel/routelist'),
(533, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1005', 'empty_text', 'fe8a84499875a4a485d3896d61c605b3', 'Bulunamadı!', '/adminPanel/routelist');
INSERT INTO `translators_sentence` (`ts_ID`, `lang_ID`, `ts_path`, `ts_path_line`, `ts_key`, `ts_unique_key`, `ts_sentence`, `viewURL`) VALUES
(534, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '621', 'title', 'b4418f9aee6f9a49e4d0645597cc5ac5', 'Kullanıcılar | BAF', '/adminPanel/users'),
(535, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '624', 'sectionTitle', '27b11704cdc64ff2c9d8e36dac850c1e', 'Kullanıcılar ', '/adminPanel/users'),
(536, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '625', 'sectionSub', '9d0caef55e236125ddcae86f3e3e88a7', 'Sistemdeki tüm üyeleri görüntüleyebilirsiniz.', '/adminPanel/users'),
(537, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '626', 'ID_text', '10140480ebb34cf1b5951ff5c324395e', 'ID', '/adminPanel/users'),
(538, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '627', 'userKey_text', 'a6aaa584370fbce4a00df991bafdf642', 'userKey', '/adminPanel/users'),
(539, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '628', 'loginInput_text', '7a7c4b1f7e7035b5364299c706915ff1', 'Giriş Değeri', '/adminPanel/users'),
(540, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '629', 'action_text', '802c364623249c197c3b6c5b8aee7c49', 'Aksiyon', '/adminPanel/users'),
(541, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '631', 'viewOption_text', '0786c2bd9496c55a2833317cc350fdfe', 'Görüntüle', '/adminPanel/users'),
(542, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '632', 'userOptionempty_text', 'cdc2539b9686e4624e7690b01ad5a69e', 'Veri Bulunamadı!', '/adminPanel/users'),
(543, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '633', 'userSelect_text', '89166535f315a8f5bf6842d5ddd13f82', 'Kullanıcıyı Seç', '/adminPanel/users'),
(544, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '681', 'title', '11d59451a584df59dea1ef44e9c4e318', 'Kullanıcı İşlemleri | BAF', '/adminPanel/userselect?userKey=40c4f2a328c12eaebb2f642455caed5277f18849'),
(545, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '684', 'sectionTitle', '87f7bfef0c42f15a0821b110e35a8e98', 'Kullanıcı İşlemleri', '/adminPanel/userselect?userKey=40c4f2a328c12eaebb2f642455caed5277f18849'),
(546, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '685', 'sectionSub', '7565157650ebc072fd6cf218f797e5b1', 'Kullanıcıyla ilgili düzenlemeler.', '/adminPanel/userselect?userKey=40c4f2a328c12eaebb2f642455caed5277f18849'),
(547, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '688', 'emptyOption', '12458c79079ca2fb8b27ced884177e16', 'Veri Bulunamadı!', '/adminPanel/userselect?userKey=40c4f2a328c12eaebb2f642455caed5277f18849'),
(548, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '689', 'userOptions_text', 'a16ea1deeaac995349ffa370a1a6ad95', 'Tüm Kullanıcı Verileri', '/adminPanel/userselect?userKey=40c4f2a328c12eaebb2f642455caed5277f18849'),
(549, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '690', 'deleteUser_text', '95d65906365c80cd5698e01b2ab00b76', 'Üyeyi Sil', '/adminPanel/userselect?userKey=40c4f2a328c12eaebb2f642455caed5277f18849'),
(550, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '691', 'userBanned_text', '61815e930ebe9b6e8c4f5827ac5bedce', 'Üye Banla', '/adminPanel/userselect?userKey=40c4f2a328c12eaebb2f642455caed5277f18849'),
(551, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '692', 'userBannedClose_text', '6664a7da6cf6b6bd5ea8b478ae3d814d', 'Vazgeç', '/adminPanel/userselect?userKey=40c4f2a328c12eaebb2f642455caed5277f18849'),
(552, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '695', 'bannedDay_placeholder', '8fef601e9eb5a8a3ebbd6b4837f72dd7', 'Kaç gün banlanacak?', '/adminPanel/userselect?userKey=40c4f2a328c12eaebb2f642455caed5277f18849'),
(553, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '696', 'bannedButton', 'acb9a4da8409a60408524c5060513e06', 'Banla', '/adminPanel/userselect?userKey=40c4f2a328c12eaebb2f642455caed5277f18849'),
(554, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '697', 'resetPassword_text', '7f1fc09256569946eefc0c16f5fc38d8', 'Şifre Sıfırla', '/adminPanel/userselect?userKey=40c4f2a328c12eaebb2f642455caed5277f18849'),
(555, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '698', 'Roles_text', 'b79f25512091c147ae94b5505d00a452', 'Roller', '/adminPanel/userselect?userKey=40c4f2a328c12eaebb2f642455caed5277f18849'),
(556, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '699', 'sessions_text', '4aefaa118ee2f3c863091f6867b75c92', 'Oturum Listesi', '/adminPanel/userselect?userKey=40c4f2a328c12eaebb2f642455caed5277f18849'),
(557, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '751', 'title', '3d35e9a41a0cd9692ee73141caa57134', 'Projeler | BAF', '/adminPanel/projects'),
(558, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '754', 'sectionTitle', '99b7333b22df7f8015fd0f77190e6c97', 'Projeler', '/adminPanel/projects'),
(559, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '755', 'sectionSub', 'b05906684855cf48ac2d51ccb20c2793', 'Sistemdeki proje kalıplarını görüntüler.', '/adminPanel/projects'),
(560, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '756', 'newProjectsName_text', '6b663d2e5812a76587689a796162d17c', 'Yeni Proje İsmi', '/adminPanel/projects'),
(561, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '757', 'newProjectAddbutton_text', 'd0a9531dffcbeb56bcce9d33a91f4558', 'Yeni Proje Ekle', '/adminPanel/projects'),
(562, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '760', 'projectSelect_text', '772284b8cd2d037d26e85defdb14cf9d', 'Proje Seçiniz', '/adminPanel/projects'),
(563, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '763', 'selectProject_text', '156157339d8601961d8adc36a435fd1b', 'Seçilen Proje', '/adminPanel/projects'),
(564, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '765', 'projectDeletebutton_text', '48bd90b70796e57abcbb63ef6be04254', 'Projeyi Sil', '/adminPanel/projects'),
(565, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '766', 'newPermAddbutton_text', '26b95267d09e2edfec2753afd7c0eeab', 'Yeni Yetki Ekle', '/adminPanel/projects'),
(566, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '767', 'newKeyName_text', '38fe560fff6a1e51780dc975df8697cc', 'Yetki Key', '/adminPanel/projects'),
(567, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '768', 'permDelete_text', 'b67e0b4729dedcb24f29d4baee587ba1', 'Perm Sil', '/adminPanel/projects'),
(568, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '827', 'title', 'dea26604bc58d776e02e40043835c9c2', 'Roller | BAF', '/adminPanel/roles'),
(569, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '830', 'sectionTitle', '4f2bb4f26d206cb5c14aa6a047ed0b47', 'Roller', '/adminPanel/roles'),
(570, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '831', 'sectionSub', '655ed657f6483079d2bd5d2efa4d5fe0', 'Sistem rollerini buradan düzenleyebilirsiniz.', '/adminPanel/roles'),
(571, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '832', 'newRoleName_text', '9b5ec31263887e8be5010d8992b4aed5', 'Yeni Rol İsmi', '/adminPanel/roles'),
(572, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '833', 'newRoleAddbutton_text', '6a4803d6c92aa3688fb75233b4abf130', 'Rol Ekle', '/adminPanel/roles'),
(573, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '835', 'roleSelect_text', 'fa47a504bda26efee60b6ce1b07b95b7', 'Rol Seçimi Yapınız.', '/adminPanel/roles'),
(574, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '838', 'selectRoleText', '9428209ff3e14562e174df135a54e5d0', 'Seçilen Rol', '/adminPanel/roles'),
(575, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '839', 'roleDeletebutton_text', '82d5c852a03281fc4d6d03ddd7a8be99', 'Rolü Sil', '/adminPanel/roles'),
(576, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '843', 'emptyPerm_text', '6349b6471f5e41b8981f346e8b86cce4', 'Yetki Bulunamadı!', '/adminPanel/roles'),
(577, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '847', 'projectsSelect_text', '83d77de7367fca60f21f49f231467f9d', 'Proje Seç', '/adminPanel/roles'),
(578, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '850', 'emptyPerm_text', '300627209b3982889d3c5792f8bc5fb6', 'Yetki Bulunamadı!', '/adminPanel/roles'),
(579, 1, '/bitnameagencyframework/engine/userPermSystem.php', '107', 'root', '22146232ab73184904a439b88d07d720', 'root', '/adminPanel/userroles?userKey=40c4f2a328c12eaebb2f642455caed5277f18849'),
(580, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '894', 'title', '68b9b324eb303dc7fca949ae0549da74', 'Kullanıcıya Rol Ver | BAF', '/adminPanel/userroles?userKey=40c4f2a328c12eaebb2f642455caed5277f18849'),
(581, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '897', 'sectionTitle', '95db798acde3ee2992dc425b1ba0eb89', 'Kullanıcıya Rol Ver', '/adminPanel/userroles?userKey=40c4f2a328c12eaebb2f642455caed5277f18849'),
(582, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '898', 'sectionSub', '253bdf199f1edcfd400f141d54ed1a27', 'Kullanıcılara buradan rol verebilirsiniz.', '/adminPanel/userroles?userKey=40c4f2a328c12eaebb2f642455caed5277f18849'),
(583, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '903', 'emptyRole_text', '4783500de5ebf47fc907532a8b97ab1c', 'Rol Bulunamadı!', '/adminPanel/userroles?userKey=40c4f2a328c12eaebb2f642455caed5277f18849'),
(584, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '908', 'emptyRole_text', 'a1a10d9fec39878c3037a586a71cac0c', 'Rol Bulunamadı!', '/adminPanel/userroles?userKey=40c4f2a328c12eaebb2f642455caed5277f18849'),
(585, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1008', 'title', 'ff879436c9514683c6ed855c58c814ab', 'Rota Listesi | BAF', '/adminPanel/routelist'),
(586, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1009', 'sectionTitle', '0943473e71812884595de0ea67724961', 'Rota Listesi', '/adminPanel/routelist'),
(587, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1010', 'sectionSub', 'dd229002a3e119d94767ec7fa1a22490', 'Tüm rotaları görüntüleyebilirsiniz.', '/adminPanel/routelist'),
(588, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1012', 'slugText', '490ca8d34e88a3df32cb8054e5a8b2fc', 'URL', '/adminPanel/routelist'),
(589, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1013', 'filepathText', '15b93ebbbb415c8c2d76876ef456672f', 'Filepath', '/adminPanel/routelist'),
(590, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1014', 'lineText', '98c67bb5f534418624412451b5957cfd', 'Satır', '/adminPanel/routelist'),
(591, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1015', 'empty_text', 'bd03fb13344262efabe90f3d2c5132e3', 'Bulunamadı!', '/adminPanel/routelist'),
(592, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '926', 'title', '001745e4a9653c9bdae6716a184e5aeb', 'Log Listesi | BAF', '/adminPanel/loglist'),
(593, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '927', 'sectionTitle', 'b36328d5bbb8422d1b0235a33f754953', 'Log Listesi', '/adminPanel/loglist'),
(594, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '928', 'sectionSub', 'bb482d81094a40ff1b74439368db353d', 'Tüm güvenlik verilerini indirebilirsiniz.', '/adminPanel/loglist'),
(595, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '930', 'dateTimeText', '75d6b16c0b78ef53776d2fcb694bd4e0', 'Log Tarihi', '/adminPanel/loglist'),
(596, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '931', 'downloadURLText', '0fb8e8da91ab377bbb2a98b6a9175d2c', 'İndirme Linki', '/adminPanel/loglist'),
(597, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '932', 'emptyText', '1bcd871b9c8fd5f5e31b8d97a79a082a', 'Veri Yok!', '/adminPanel/loglist'),
(598, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '929', 'sectionTitle', '6f8b68d12bee39480a03ad898c9b53a4', 'Log Listesi', '/adminPanel/loglist'),
(599, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '930', 'sectionSub', 'ffce96d8a993dc561f3906997c8b3cd0', 'Tüm güvenlik verilerini indirebilirsiniz.', '/adminPanel/loglist'),
(600, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '932', 'dateTimeText', 'ce677e55dd2bc365f74923cba74ff7cf', 'Log Tarihi', '/adminPanel/loglist'),
(601, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '933', 'downloadURLText', 'b7b6b834b469476439d788562f51f7ae', 'İndirme Linki', '/adminPanel/loglist'),
(602, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '934', 'emptyText', '2f86f5ebae9c85a12156ac47b2ed3196', 'Veri Yok!', '/adminPanel/loglist'),
(603, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '963', 'sectionTitle', '19ea642ba364b10dbce20d688d7abfbc', 'Oturum Listesi', '/adminPanel/sessionlist'),
(604, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '964', 'sectionSub', '02b0d85d8711f360b573d64c36157baa', 'Tüm oturumları görüntüleyebilirsiniz.', '/adminPanel/sessionlist'),
(605, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '965', 'sessionListplaceholder', 'a536a85efa5acd39502d5863eda166e8', 'Session Key Seçiniz', '/adminPanel/sessionlist'),
(606, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '967', 'ID_text', 'e1e4897c0f0d90f6f5e33ac57445a607', 'ID', '/adminPanel/sessionlist'),
(607, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '968', 'sessionKey_text', '5dda75daa1bd16bdec907945a11aa81d', 'Oturum Anahtarı', '/adminPanel/sessionlist'),
(608, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '969', 'sessionSecureKey_text', 'f731a05927b87c27d8d45cece84ec0de', 'Oturum Gizli Anahtarı', '/adminPanel/sessionlist'),
(609, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '970', 'sessionData_text', 'a08d6397f072f8543f0101354b43eee3', 'Oturum Verisi', '/adminPanel/sessionlist'),
(610, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '971', 'sessionDelete_text', '5601c0240e46fb583a8acd52e9b6eca5', 'Oturumu Sil', '/adminPanel/sessionlist'),
(611, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '992', 'title', 'b81ffb1eb8412959b374d63256a3e257', 'Arama Sonuçları | BAF', '/adminPanel/search?q=asd'),
(612, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '995', 'sectionTitle', '279ea19c9e49e03f78555c17c0a0090f', 'Arama Sonuçları', '/adminPanel/search?q=asd'),
(613, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '996', 'sectionSub', '812f9e70cba5ade536035ea8d5f6ec46', 'Panel Arama Motoru', '/adminPanel/search?q=asd'),
(614, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '998', 'empty_text', 'fa8130304d9b2357d4d72dbff5dfe4a7', 'Bulunamadı!', '/adminPanel/search?q=asd'),
(615, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1014', 'title', '4a79c03ca05f7297ebbee14129de647c', 'Rota Listesi | BAF', '/adminPanel/routelist'),
(616, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1017', 'sectionTitle', 'd41bb0833f0f2cbb17e9d3175b90a103', 'Rota Listesi', '/adminPanel/routelist'),
(617, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1018', 'sectionSub', '2d989906f23edf7b3453fe93a86e0dae', 'Tüm rotaları görüntüleyebilirsiniz.', '/adminPanel/routelist'),
(618, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1020', 'slugText', '5c7a881172c8db70a0bb43ea47fa9ace', 'URL', '/adminPanel/routelist'),
(619, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1021', 'filepathText', '6128a1770cc6d0392d483c7298851574', 'Filepath', '/adminPanel/routelist'),
(620, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1022', 'lineText', 'f40bab4398b1cf19b9694ba1aeb924bc', 'Satır', '/adminPanel/routelist'),
(621, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1023', 'empty_text', '0d7ea1a8fd7f2b866be2aacc59d1324d', 'Bulunamadı!', '/adminPanel/routelist'),
(622, 1, '/bitnameagencyframework/resources/helper/adminpanel/menunestable.php', '47', 'edit-item-button', 'f3870fe7029b33900a21a4fdad76e355', 'Düzenle', '/adminPanel/menuSystem?groupKey=adminpanelmenu'),
(623, 1, '/bitnameagencyframework/resources/helper/adminpanel/menunestable.php', '48', 'delete-item-button', '2f9d86f0e2bdb2a8accecdfcbd1f7c8d', 'Kaldır', '/adminPanel/menuSystem?groupKey=adminpanelmenu'),
(624, 1, '/bitnameagencyframework/resources/helper/adminpanel/menunestable.php', '49', 'collepseNote', 'e1a4cdad27b35345c311641f56ab0f53', 'Not: Görünen adı değiştirmek için dil sayfasında ilgili bölümü değiştiriniz.', '/adminPanel/menuSystem?groupKey=adminpanelmenu'),
(625, 1, '/bitnameagencyframework/resources/helper/adminpanel/menunestable.php', '50', 'Collapse_itemKey', '93beec1eb8bfea11fc0c2fce0a0100c9', 'itemKey', '/adminPanel/menuSystem?groupKey=adminpanelmenu'),
(626, 1, '/bitnameagencyframework/resources/helper/adminpanel/menunestable.php', '51', 'Collapse_itemLink', '082c196f4dd5c62a1971deb496a31f6d', 'itemLink', '/adminPanel/menuSystem?groupKey=adminpanelmenu'),
(627, 1, '/bitnameagencyframework/resources/helper/adminpanel/menunestable.php', '52', 'childrenEditbutton', '447a2d3f2655ebee38a384c41407da95', 'Kaydet', '/adminPanel/menuSystem?groupKey=adminpanelmenu'),
(628, 1, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID25-systemoptions', '3da05fb775258dce655b7819dfec40e3', 'systemoptions', '/adminPanel/menuSystem?groupKey=adminpanelmenu'),
(629, 1, '/bitnameagencyframework/engine/userPermSystem.php', '107', 'baf@systemoptions', '43a5e8dc2f736d664d68c1c56678ba76', 'baf@systemoptions', '/adminPanel/menuSystem'),
(630, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1036', 'title', '57d11b11bcad0a9035c35a289e046d63', 'Sistem Ayarları | BAF', '/adminPanel/systemoptions'),
(631, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1039', 'sectionTitle', '25747642b0f083f7309ae9283973497e', 'Sistem Ayarları', '/adminPanel/systemoptions'),
(632, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1040', 'sectionSub', '389575ab2102eeac82ac46b75492b535', 'Sistem ayarlarını düzenleyebilirsiniz.', '/adminPanel/systemoptions'),
(633, 2, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID1-dashboard', '362e8dc1feb1de360ac9edaeb8fbd0ac', 'Gösterge Paneli', NULL),
(634, 2, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID3-managements-tools', '6c85087942a12d980364f50b4068eda9', 'Yönetim Araçları', NULL),
(635, 2, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID2-workstation', '85270edc203dbc235f20d13573e09829', 'İş İstasyonu', NULL),
(636, 2, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID4-menusystem', 'e0f04ebabfe556910fe04df2a32c1007', 'Menü Düzenle', NULL),
(637, 2, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID8-languages', 'e37860978f0e6071d5fe28f9c5b8d0b8', 'Dil Paketleri', NULL),
(638, 2, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID24-routelist', 'a86cc5c1d63cfc90336c17d52b9f22bf', 'Rota Listesi', NULL),
(639, 2, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID14-savedisk', '32bff3de2f7656c0bd23302debb1b68a', 'Disk Kayıt Sistemi', NULL),
(640, 2, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID22-loglist', 'fa219b5aa75988d6ae0277dae929abb0', 'Log Listesi', NULL),
(641, 2, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID23-sessionlist', 'ff5b07613ca2dddbe2bd2fbda6810da9', 'Oturum Listesi', NULL),
(642, 2, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID18-usersandperms', 'a118b7f16730a8ff254e5704995502ef', 'Kullanıcı ve Rolleri', NULL),
(643, 2, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID15-users', 'a3f83d654199f967efad9dad36eeb113', 'Kullanıcılar', NULL),
(644, 2, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID19-projects', '33f3cde83af6c4b0f91986d017be962e', 'Projeler', NULL),
(645, 2, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID20-roles', 'd7f345ed2882c4f7b82fc545f39207fa', 'Roller', NULL),
(646, 2, '/bitnameagencyframework/engine/menuSystem.php', '104', 'MENUID25-systemoptions', '74e7e7dcdf275e620edcc022e2c0427f', 'Sistem Seçenekleri', NULL),
(647, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1038', 'title', 'ac311a0da0d120b98b4e5fd4c494bf05', 'Sistem Seçenekleri | BAF', '/adminPanel/systemoptions'),
(648, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1041', 'sectionTitle', '8b673b2d7b1e12cee00778e2fe4ea1de', 'Sistem Seçenekleri', '/adminPanel/systemoptions'),
(649, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1042', 'sectionSub', 'e1b23e8b16e55cc8a2d4aab5cd09b4f2', 'Sistem seçeneklerini düzenleyebilirsiniz.', '/adminPanel/systemoptions'),
(650, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1044', 'save_text', 'fba0c94c799352edaad09dbbc37462a2', 'Kaydet', '/adminPanel/systemoptions'),
(651, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1047', 'title', 'a6b57d89c2ea84af308f1ae5fe354190', 'Sistem Seçenekleri | BAF', '/adminPanel/systemoptions'),
(652, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1050', 'sectionTitle', '667a2f0adb28116471d55afcc283e690', 'Sistem Seçenekleri', '/adminPanel/systemoptions'),
(653, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1051', 'sectionSub', '11fa41c219394eaeb876fe74fbb5228a', 'Sistem seçeneklerini düzenleyebilirsiniz.', '/adminPanel/systemoptions'),
(654, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1053', 'save_text', '0d7a95ca9653a18d5aab0021c581ff3f', 'Kaydet', '/adminPanel/systemoptions'),
(655, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1048', 'title', '67b0cbd210f7f68d40fa9b2c132872e7', 'Sistem Seçenekleri | BAF', '/adminPanel/systemoptions?errorMail=false&token=IqtILCvbRkGLbaus0OKuSVUSg8vbds2AuPxe6DSecoKb5WBuW4PAiDmuV8OixNQ9RWw45jKVUU%2BBfuaqfh8C5bXObHKwNXpua6A1BsmpOQW3%2FfiEbsnfdqv2yWNxVBEBSmlcQszT4qYHpiOoy%2BhgBUvPe%2BR%2BeqKLu1lKgK306izBZH63yV%2BLQHXNOOZWNmLD'),
(656, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1051', 'sectionTitle', '31672146ecaf043c815eda4648f07c37', 'Sistem Seçenekleri', '/adminPanel/systemoptions?errorMail=false&token=IqtILCvbRkGLbaus0OKuSVUSg8vbds2AuPxe6DSecoKb5WBuW4PAiDmuV8OixNQ9RWw45jKVUU%2BBfuaqfh8C5bXObHKwNXpua6A1BsmpOQW3%2FfiEbsnfdqv2yWNxVBEBSmlcQszT4qYHpiOoy%2BhgBUvPe%2BR%2BeqKLu1lKgK306izBZH63yV%2BLQHXNOOZWNmLD'),
(657, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1052', 'sectionSub', '611375c208b4a1934524d035a7b5f366', 'Sistem seçeneklerini düzenleyebilirsiniz.', '/adminPanel/systemoptions?errorMail=false&token=IqtILCvbRkGLbaus0OKuSVUSg8vbds2AuPxe6DSecoKb5WBuW4PAiDmuV8OixNQ9RWw45jKVUU%2BBfuaqfh8C5bXObHKwNXpua6A1BsmpOQW3%2FfiEbsnfdqv2yWNxVBEBSmlcQszT4qYHpiOoy%2BhgBUvPe%2BR%2BeqKLu1lKgK306izBZH63yV%2BLQHXNOOZWNmLD'),
(658, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1054', 'save_text', '89d1461fa401ed57e48a16bef7c73b80', 'Kaydet', '/adminPanel/systemoptions?errorMail=false&token=IqtILCvbRkGLbaus0OKuSVUSg8vbds2AuPxe6DSecoKb5WBuW4PAiDmuV8OixNQ9RWw45jKVUU%2BBfuaqfh8C5bXObHKwNXpua6A1BsmpOQW3%2FfiEbsnfdqv2yWNxVBEBSmlcQszT4qYHpiOoy%2BhgBUvPe%2BR%2BeqKLu1lKgK306izBZH63yV%2BLQHXNOOZWNmLD'),
(659, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1051', 'title', 'd73bdea50eb84a92f1002aeb79c27b2f', 'Sistem Seçenekleri | BAF', '/adminPanel/systemoptions'),
(660, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1054', 'sectionTitle', 'f1632cda37efbf36c5d9f08113427003', 'Sistem Seçenekleri', '/adminPanel/systemoptions'),
(661, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1055', 'sectionSub', '925efed486a75bd401b0c08d2cecd1c6', 'Sistem seçeneklerini düzenleyebilirsiniz.', '/adminPanel/systemoptions'),
(662, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '1057', 'save_text', '5a1f4c30e6477c0e1fe98e9feae9dbe4', 'Kaydet', '/adminPanel/systemoptions'),
(663, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '101', 'title', '4a8c3630e376d4bd09fa8ac1f7594b2f', 'Bitname F. Giriş Sayfası', '/adminPanel/sessionlist'),
(664, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '101', 'description', 'c1adee2a0228c1a3cbeaa5b054316fbf', 'Bitname F. Giriş Sayfası', '/adminPanel/sessionlist'),
(665, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '101', 'helptext', '72f3252b95fc57b2666816b6db8e932f', 'Yardım', '/adminPanel/sessionlist'),
(666, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '101', 'helptexthref', '8509f3c6729772f5f425a5fa16ee271c', 'mailto:destek@bitnameagency.com', '/adminPanel/sessionlist'),
(667, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '101', 'aboutustext', '9a0fd51ebeb4382a4da735a07099744a', 'Hakkımızda', '/adminPanel/sessionlist'),
(668, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '101', 'aboutustexthref', '829f6aa87cf4d7759411031f58e78bbf', 'https://bitnameagency.com', '/adminPanel/sessionlist'),
(669, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '112', 'usernameplaceholder', '9099eb72036438abbee0abd0147b61d5', 'Kullanıcı Adı', '/adminPanel/sessionlist'),
(670, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '112', 'passwordplaceholder', 'ddbdd8abe1908275603bb58e82487f49', 'Şifre', '/adminPanel/sessionlist'),
(671, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '112', 'rememberme', '2eab8acced3a406a0edd8534734f77da', 'Beni Hatırla', '/adminPanel/sessionlist'),
(672, 1, '/bitnameagencyframework/resources/controller/adminpanel/adminpanel.php', '112', 'logintext', '57068aa7dc0f6086094f7a4aef560a17', 'Giriş Yap', '/adminPanel/sessionlist');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `userOptions`
--

CREATE TABLE `userOptions` (
  `userOptionsID` int(11) NOT NULL,
  `optionKey` varchar(255) NOT NULL,
  `optionData` text NOT NULL,
  `userKey` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `userSystem`
--

CREATE TABLE `userSystem` (
  `uS_ID` int(11) NOT NULL,
  `userKey` varchar(255) NOT NULL,
  `loginInput` varchar(255) NOT NULL,
  `loginPassword` varchar(255) NOT NULL,
  `bannedDate` date DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `userSystem`
--

INSERT INTO `userSystem` (`uS_ID`, `userKey`, `loginInput`, `loginPassword`, `bannedDate`, `deleted`) VALUES
(1, '40c4f2a328c12eaebb2f642455caed5277f18849', 'root', '83353d597cbad458989f2b1a5c1fa1f9f665c858', NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `workstationSystem`
--

CREATE TABLE `workstationSystem` (
  `ws_IS` int(11) NOT NULL,
  `ws_Title` varchar(255) DEFAULT NULL,
  `ws_Description` varchar(255) DEFAULT NULL,
  `ws_Category` varchar(255) DEFAULT NULL,
  `ws_Path` varchar(255) NOT NULL,
  `ws_Priority` int(11) DEFAULT '10',
  `status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `workstationSystem`
--

INSERT INTO `workstationSystem` (`ws_IS`, `ws_Title`, `ws_Description`, `ws_Category`, `ws_Path`, `ws_Priority`, `status`) VALUES
(29, NULL, NULL, 'engine', 'bitnameagencyframework/engine/menuSystem.php', 10, 0),
(31, NULL, NULL, 'engine', 'bitnameagencyframework/engine/secureSession.php', 994, 0),
(32, NULL, NULL, 'engine', 'bitnameagencyframework/engine/timezone_set.php', 10, 0),
(34, NULL, NULL, 'engine', 'bitnameagencyframework/engine/viewsfunc/viewSystem.php', 1003, 0),
(35, NULL, NULL, 'engine', 'bitnameagencyframework/engine/mvc/controller.php', 997, 0),
(36, NULL, NULL, 'engine', 'bitnameagencyframework/engine/mvc/database.php', 999, 0),
(37, NULL, NULL, 'engine', 'bitnameagencyframework/engine/mvc/index.php', 10, 0),
(38, NULL, NULL, 'engine', 'bitnameagencyframework/engine/mvc/model.php', 998, 0),
(39, NULL, NULL, 'engine', 'bitnameagencyframework/engine/mvc/route.php', 996, 0),
(54, '404 Page', '404 Error sayfası tasarımı', 'pages', 'bitnameagencyframework/pages/Error404.php', 10, 1),
(58, 'Admin panel', 'Etkisizleştirmek ve ya silmek, panelin işlevsiz hale gelmesine neden olabilir. Lütfen dikkat ediniz.', 'pages', 'bitnameagencyframework/pages/adminPanel.php', 10, 1),
(60, NULL, NULL, 'engine', 'bitnameagencyframework/engine/hookSystem.php', 1004, 1),
(61, NULL, NULL, 'engine', 'bitnameagencyframework/engine/mailer/Exception.php', 999, 0),
(62, NULL, NULL, 'engine', 'bitnameagencyframework/engine/mailer/OAuth.php', 999, 0),
(63, NULL, NULL, 'engine', 'bitnameagencyframework/engine/mailer/PHPMailer.php', 999, 0),
(64, NULL, NULL, 'engine', 'bitnameagencyframework/engine/mailer/POP3.php', 999, 0),
(65, NULL, NULL, 'engine', 'bitnameagencyframework/engine/mailer/SMTP.php', 999, 0),
(66, NULL, NULL, 'engine', 'bitnameagencyframework/engine/mailer/Mailer.class.php', 999, 0),
(67, NULL, NULL, 'engine', 'bitnameagencyframework/engine/catchError.php', 1001, 0),
(68, NULL, NULL, 'engine', 'bitnameagencyframework/engine/userPermSystem.php', 993, 0),
(72, 'Test widget ve Alert', '', 'plugins', 'bitnameagencyframework/plugins/adminPanelwidgetAlertTest.php', 10, 1),
(73, NULL, NULL, 'engine', 'bitnameagencyframework/engine/workStation.class.php', 10, 0),
(75, 'Anasayfa', 'Bu sayfa otomatik olarak test amaçlı oluşturulmuştur. Lütfen siliniz.', 'pages', 'bitnameagencyframework/pages/main.php', 10, 1),
(76, NULL, NULL, 'engine', 'bitnameagencyframework/engine/nestable.php', 10, 0),
(77, NULL, NULL, 'engine', 'bitnameagencyframework/engine/FormTokenSecure.php', 1001, 1),
(78, NULL, NULL, 'engine', 'bitnameagencyframework/engine/browserid.php', 10050, 1),
(79, NULL, NULL, 'engine', 'bitnameagencyframework/engine/htmlCache.php', 10, 0),
(80, 'Bakım Modu', 'Sitenin bakım moduna alındığında görünecek sayfa', 'pages', 'bitnameagencyframework/pages/maintenanceMode.php', 10, 1),
(81, NULL, NULL, 'engine', 'bitnameagencyframework/engine/translators.class.php', 10, 1),
(84, NULL, NULL, 'engine', 'bitnameagencyframework/engine/saveDisk.class.php', 10, 0),
(85, NULL, NULL, 'engine', 'bitnameagencyframework/engine/captcha.php', 995, 0),
(86, NULL, NULL, 'engine', 'bitnameagencyframework/engine/logSystem.php', 992, 0),
(87, NULL, NULL, 'engine', 'bitnameagencyframework/engine/mvc/helper.php', 10, 0),
(94, '', '', 'plugins', 'bitnameagencyframework/plugins/adminPanelwallpaper.php', 10, 0),
(97, NULL, NULL, 'engine', 'bitnameagencyframework/engine/realTime.php', 10, 0),
(99, NULL, NULL, 'engine', 'bitnameagencyframework/engine/searchEngine.php', 10, 0),
(1094, NULL, NULL, 'engine', 'bitnameagencyframework/engine/minifierClass/CSS.php', 10, 0),
(1095, NULL, NULL, 'engine', 'bitnameagencyframework/engine/minifierClass/CommentPreserver.php', 10, 0),
(1096, NULL, NULL, 'engine', 'bitnameagencyframework/engine/minifierClass/Compressor.php', 10, 0),
(1097, NULL, NULL, 'engine', 'bitnameagencyframework/engine/minifierClass/HTML.php', 10, 0),
(1098, NULL, NULL, 'engine', 'bitnameagencyframework/engine/minifierClass/JSMin.php', 10, 0),
(1099, NULL, NULL, 'engine', 'bitnameagencyframework/engine/minifierClass/minifier.php', 10, 0);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `blockUserUser`
--
ALTER TABLE `blockUserUser`
  ADD PRIMARY KEY (`blockUserUserID`);

--
-- Tablo için indeksler `Log`
--
ALTER TABLE `Log`
  ADD PRIMARY KEY (`logID`);

--
-- Tablo için indeksler `logList`
--
ALTER TABLE `logList`
  ADD PRIMARY KEY (`logListID`);

--
-- Tablo için indeksler `menuSystem`
--
ALTER TABLE `menuSystem`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `mergeRolePerms`
--
ALTER TABLE `mergeRolePerms`
  ADD PRIMARY KEY (`mergeRolePermID`);

--
-- Tablo için indeksler `mergeRolesUser`
--
ALTER TABLE `mergeRolesUser`
  ADD PRIMARY KEY (`mergeRolesUserID`);

--
-- Tablo için indeksler `perms`
--
ALTER TABLE `perms`
  ADD PRIMARY KEY (`permID`);

--
-- Tablo için indeksler `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleID`),
  ADD UNIQUE KEY `roleKey` (`roleKey`);

--
-- Tablo için indeksler `roomMessages`
--
ALTER TABLE `roomMessages`
  ADD PRIMARY KEY (`roomMessageID`);

--
-- Tablo için indeksler `Rooms`
--
ALTER TABLE `Rooms`
  ADD PRIMARY KEY (`roomID`);

--
-- Tablo için indeksler `roomUsers`
--
ALTER TABLE `roomUsers`
  ADD PRIMARY KEY (`roomUserID`);

--
-- Tablo için indeksler `saveDisk`
--
ALTER TABLE `saveDisk`
  ADD PRIMARY KEY (`sD_ID`);

--
-- Tablo için indeksler `secureSession`
--
ALTER TABLE `secureSession`
  ADD PRIMARY KEY (`sS_ID`);

--
-- Tablo için indeksler `systemOptions`
--
ALTER TABLE `systemOptions`
  ADD PRIMARY KEY (`optionID`);

--
-- Tablo için indeksler `translators_lang`
--
ALTER TABLE `translators_lang`
  ADD PRIMARY KEY (`lang_ID`);

--
-- Tablo için indeksler `translators_sentence`
--
ALTER TABLE `translators_sentence`
  ADD PRIMARY KEY (`ts_ID`);
ALTER TABLE `translators_sentence` ADD FULLTEXT KEY `ts_sentence` (`ts_sentence`);

--
-- Tablo için indeksler `userOptions`
--
ALTER TABLE `userOptions`
  ADD PRIMARY KEY (`userOptionsID`);

--
-- Tablo için indeksler `userSystem`
--
ALTER TABLE `userSystem`
  ADD PRIMARY KEY (`uS_ID`);

--
-- Tablo için indeksler `workstationSystem`
--
ALTER TABLE `workstationSystem`
  ADD PRIMARY KEY (`ws_IS`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `blockUserUser`
--
ALTER TABLE `blockUserUser`
  MODIFY `blockUserUserID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `Log`
--
ALTER TABLE `Log`
  MODIFY `logID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `logList`
--
ALTER TABLE `logList`
  MODIFY `logListID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `menuSystem`
--
ALTER TABLE `menuSystem`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Tablo için AUTO_INCREMENT değeri `mergeRolePerms`
--
ALTER TABLE `mergeRolePerms`
  MODIFY `mergeRolePermID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- Tablo için AUTO_INCREMENT değeri `mergeRolesUser`
--
ALTER TABLE `mergeRolesUser`
  MODIFY `mergeRolesUserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `perms`
--
ALTER TABLE `perms`
  MODIFY `permID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Tablo için AUTO_INCREMENT değeri `roles`
--
ALTER TABLE `roles`
  MODIFY `roleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `roomMessages`
--
ALTER TABLE `roomMessages`
  MODIFY `roomMessageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `Rooms`
--
ALTER TABLE `Rooms`
  MODIFY `roomID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `roomUsers`
--
ALTER TABLE `roomUsers`
  MODIFY `roomUserID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `saveDisk`
--
ALTER TABLE `saveDisk`
  MODIFY `sD_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Tablo için AUTO_INCREMENT değeri `secureSession`
--
ALTER TABLE `secureSession`
  MODIFY `sS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Tablo için AUTO_INCREMENT değeri `systemOptions`
--
ALTER TABLE `systemOptions`
  MODIFY `optionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Tablo için AUTO_INCREMENT değeri `translators_lang`
--
ALTER TABLE `translators_lang`
  MODIFY `lang_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `translators_sentence`
--
ALTER TABLE `translators_sentence`
  MODIFY `ts_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=673;

--
-- Tablo için AUTO_INCREMENT değeri `userOptions`
--
ALTER TABLE `userOptions`
  MODIFY `userOptionsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `userSystem`
--
ALTER TABLE `userSystem`
  MODIFY `uS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `workstationSystem`
--
ALTER TABLE `workstationSystem`
  MODIFY `ws_IS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1100;
COMMIT;

";
			 $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//Error Handling
				$query = $db->exec($sql);

		header("Refresh:0");
			
			
	}
			
			


		
		
	}
	
	
	$content = '
<form method="POST">
  <div class="form-group row">
    <label for="inputPassword" class="col-sm-2 col-form-label">'.$language[$languageSelect]['DB_HOST'].'</label>
    <div class="col-sm-10">
      <input name="DB_HOST" class="form-control" value="localhost">
    </div>
  </div>

	<div class="form-group row mt-2">
    <label for="inputPassword" class="col-sm-2 col-form-label">'.$language[$languageSelect]['DB_USER'].'</label>
    <div class="col-sm-10">
      <input name="DB_USER" type="text" class="form-control"  placeholder="'.$language[$languageSelect]['DB_USER'].'">
    </div>
  </div>

  <div class="form-group row mt-2">
    <label for="staticEmail" class="col-sm-2 col-form-label">'.$language[$languageSelect]['DB_PASS'].'</label>
    <div class="col-sm-10">
      <input name="DB_PASS" type="password" class="form-control" placeholder="'.$language[$languageSelect]['DB_PASS'].'">
    </div>
  </div>

	<div class="form-group row mt-2">
    <label for="inputPassword" class="col-sm-2 col-form-label">'.$language[$languageSelect]['DB_NAME'].'</label>
    <div class="col-sm-10">
      <input name="DB_NAME" type="text" class="form-control"  placeholder="'.$language[$languageSelect]['DB_NAME'].'">
    </div>

	<div class="form-group row mt-2">
	<button name="mysqlSave" class="btn btn-primary btn-lg btn-block">'.$language[$languageSelect]['SaveMysqlButton'].'</button>
	</div>

</div>
</form>

';
	
	}else{
		
	$mysqlActive = 'active';
	$title = $language[$languageSelect]['mysqltitle'];
	$content = '<div class="alert alert-success" role="alert">
	  '.$language[$languageSelect]['mysqlSuccess'].' <br>
	 <a href="../adminPanel/login"> Login </a>
	</div>';
		
	}
	
}else{
	$title = $language[$languageSelect]['stepErrorTitle'];
	$content = '<p class="gradienttext">';

		for($i=0;$i<30;$i++){
			$content .= '| '.$language[$languageSelect]['stepErrorContent'].' | '.$language[$languageSelect]['stepErrorContent'].' | '.$language[$languageSelect]['stepErrorContent'].' |<br>';
		}

	$content .= '</p>';
}

?>
<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link href="//<?php echo $_SERVER['SERVER_NAME']; ?>/bitnameagencyframework/src/install/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link href="//<?php echo $_SERVER['SERVER_NAME']; ?>/bitnameagencyframework/src/install/styles.css" rel="stylesheet" />
		<script src="//<?php echo $_SERVER['SERVER_NAME']; ?>/bitnameagencyframework/src/install/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <title>Bitname Agency Framework Kurulum</title>
    </head>
    <body>
	
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light">Bitname Agency Framework Kurulum</div>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 <?php echo $mysqlActive; ?>" href="/install.php?step=mysql"><?php echo $language[$languageSelect]['mysqltitle']; ?></a>
				</div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
			
                <div class="container-fluid">
                    <h1 class="mt-4 mb-4"><?php echo $title; ?></h1>
						<?php
	
		if(@$modalError == true){
			
			?>
			
		<div class="alert alert-danger" role="alert">
		  <?php echo $language[$languageSelect]['MysqlError']; ?>
		</div>
		
			<?php
			
		}
	
	?>
					<?php echo $content; ?>


                </div>
				
            </div>
        </div>
    </body>
</html>