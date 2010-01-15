CREATE TABLE IF NOT EXISTS `#__gtranslate` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `lang` varchar(20) NOT NULL,
  `url` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM CHARACTER SET = `utf8`;