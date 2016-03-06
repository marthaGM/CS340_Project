DROP TABLE IF EXISTS `pSong`;
DROP TABLE IF EXISTS `playlist`;
DROP TABLE IF EXISTS `song`;
DROP TABLE IF EXISTS `artist`;
DROP TABLE IF EXISTS `user`;


CREATE TABLE `user` (
  `uname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`uname`),
  UNIQUE KEY (`uname`,`email`)
) ENGINE=InnoDB; 

CREATE TABLE `artist` (
`artist_id` int(11) NOT NULL AUTO_INCREMENT ,
`fname` varchar(255) NOT NULL,
`lname` varchar(255),
PRIMARY KEY(`artist_id`),
UNIQUE KEY(`fname`, `lname`)
)ENGINE = InnoDB;

CREATE TABLE `song` (
  `song_id` int(11) NOT NULL AUTO_INCREMENT,
  `song_name` varchar(255) NOT NULL,
  `genre` varchar(255),
  `album_name` varchar(255),
  `artist_id` int(11),
  PRIMARY KEY (`song_id`),
  FOREIGN KEY (`artist_id`) REFERENCES `artist` (`artist_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB; 

CREATE TABLE `playlist` (
  `playlist_id` int(11) NOT NULL AUTO_INCREMENT,
  `pname` varchar(255) NOT NULL,
  `uname` varchar(255),
  PRIMARY KEY (`playlist_id`),
  FOREIGN KEY (`uname`) REFERENCES `user` (`uname`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB; 

CREATE TABLE pSong (
`pid` int(11),
`sid` int(11),
PRIMARY KEY(`pid`, `sid`),
FOREIGN KEY(`pid`) REFERENCES `playlist`(`playlist_id`),
FOREIGN KEY(`sid`) REFERENCES `song`(`song_id`)
)ENGINE = InnoDB;


INSERT INTO `artist`(fname, lname)
VALUES("Michael", "Jackson");

INSERT INTO `artist`(fname, lname)
VALUES("Taylor", "Swift");

INSERT INTO `artist`(fname, lname)
VALUES("James", "Taylor");


INSERT INTO `user` (uname, email) VALUES
("Martha", "martha@abc.com");

INSERT INTO `user` (uname, email) VALUES
("Andrew", "andrew@abc.com");


INSERT INTO `song` (song_name, genre, album_name, artist_id) VALUES
("Beat It", "Dance Rock", "Thriller", 1);

INSERT INTO `song` (song_name, genre, album_name, artist_id) VALUES
("Bad Blood", "Pop", "1989", 2);

INSERT INTO `song` (song_name, genre, album_name, artist_id) VALUES
("Fire & Rain", "Folk Rock", "Sweet Baby James", 3);


INSERT INTO `playlist` (pname, uname) VALUES
("Martha's Playlist", "Martha");

INSERT INTO `playlist` (pname, uname) VALUES
("Andrew's Playlist", "Andrew");


INSERT INTO `pSong` (pid, sid) VALUES
(1,1);

INSERT INTO `pSong` (pid, sid) VALUES
(2,2);