-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.6.41 - MySQL Community Server (GPL)
-- Операционная система:         Win32
-- HeidiSQL Версия:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица bitrix.lateness
CREATE TABLE IF NOT EXISTS `lateness` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы bitrix.lateness: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `lateness` DISABLE KEYS */;
/*!40000 ALTER TABLE `lateness` ENABLE KEYS */;

-- Дамп структуры для таблица bitrix.profile
CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `offset` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы bitrix.profile: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` (`id`, `login`, `name`, `last_name`, `offset`) VALUES
	(1, 'testuser', 'first', 'user', '+0300');
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;

-- Дамп структуры для таблица bitrix.workday
CREATE TABLE IF NOT EXISTS `workday` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_stop` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы bitrix.workday: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `workday` DISABLE KEYS */;
/*!40000 ALTER TABLE `workday` ENABLE KEYS */;

-- Дамп структуры для таблица bitrix.workday_pause
CREATE TABLE IF NOT EXISTS `workday_pause` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `workday_id` int(11) NOT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_stop` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы bitrix.workday_pause: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `workday_pause` DISABLE KEYS */;
/*!40000 ALTER TABLE `workday_pause` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
