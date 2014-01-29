
CREATE TABLE IF NOT EXISTS `cards` (
  `card_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(60) DEFAULT NULL,
  `name` varchar(60) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`card_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cards_sent` (
  `hash` varchar(32) NOT NULL,
  `email_from` varchar(150) NOT NULL,
  `email_to` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `card_id` int(11) NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `addr_added` varchar(15) NOT NULL,
  UNIQUE KEY `hash` (`hash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
