CREATE TABLE IF NOT EXISTS `charts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icao` varchar(5) NOT NULL,
  `name` text NOT NULL,
  `charttype` int(11) NOT NULL,
  `link` text,
  `shown` smallint(5) NOT NULL DEFAULT '1',
  `dateadded` date NOT NULL,
  `dateupdated` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

