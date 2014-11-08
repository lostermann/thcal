DROP TABLE thcal;

CREATE TABLE `thcal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `veranstaltung` text NOT NULL,
  `loc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `showtime` time NOT NULL,
  `get_in_band` time NOT NULL,
  `get_in_local_crew` time NOT NULL,
  `rider` text NOT NULL,
  `sound` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `light` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `th` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `bemerkung` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `agentur` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tech_kontakt` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `backline_th` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `bl_rentals` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `micro_rentals` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `xtra_rentals` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `xtra_personal` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO demo VALUES("1","2014-11-01","The Rolling Stones","K","21:30:00","15:00:00","14:00:00","Y","XX","YY","ZZ","Jeder eigenes Hotelzimmer!","Music Productions, UK","Mike Randel","Amps!","Mehr Amps!","30x Shure SM-58","Pyrotechnik, Flammenwerfer","Hostess für Jagger");
INSERT INTO demo VALUES("2","2014-11-15","The Rolling Stones","K","21:30:00","15:00:00","14:00:00","Y","XX","YY","ZZ","Jeder eigenes Hotelzimmer!","Music Productions, UK","Mike Randel","Amps!","Mehr Amps!","30x Shure SM-58","Pyrotechnik, Flammenwerfer"," Hostess für Jagger");
INSERT INTO demo VALUES("3","2014-11-05","Jimi Hendrix","T","20:30:00","17:00:00","17:00:00","Y","YY","XX","AA","Backup-Gitarrist kommt um 6.","Hendrix Booking Inc.","Jimi +49 123 12345678","Drumset","","",""," ");
INSERT INTO demo VALUES("4","2014-11-26","Jazz Café","S","17:00:00","16:30:00","16:00:00","","AA","TT","LL","organisiert vom Mozarteum","","","","","",""," ");
INSERT INTO demo VALUES("5","2014-11-29","Led Zeppelin","K","20:00:00","16:00:00","15:00:00","Y","alle","XX","-","Tour-Abschluss","","","","","","Pyro"," ");



