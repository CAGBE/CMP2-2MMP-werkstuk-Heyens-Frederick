CREATE TABLE `comments` (
  `commentID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `movieID` int(11) NOT NULL,
  `author` text NOT NULL,
  `content` text NOT NULL,
  `pubdate` datetime NOT NULL COMMENT 'Time the comment was published',
  PRIMARY KEY (`commentID`)
) DEFAULT CHARSET=utf8;

INSERT INTO `comments` (`commentID`, `movieID`, `author`, `content`, `pubdate`)
VALUES
  (1,1,'Magnolia-Fan','Crude, inappropriate, and extremely funny. If there\'s ever a movie that you should watch with your drinking friends and not with a date or family, this is the one! It has jokes about bodily functions, innuendoes, and more, and I haven\'t laughed this hard at a movie for a long time. Call me immature, but I like this type of stuff, ones that actually have substance behind the crude jokes (not like Old School).','2013-04-07 12:26:37');

CREATE TABLE `movies` (
  `movieID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) NOT NULL DEFAULT '',
  `director` varchar(191) NOT NULL DEFAULT '' COMMENT 'e.g. Quentin Tarantino',
  `reviewerID` int(11) NOT NULL COMMENT 'user ID of the review author (see table `reviewers`)',
  `review` text NOT NULL,
  `rating` enum('0','1','2','3','4','5') NOT NULL DEFAULT '0' COMMENT 'Rating from 0 to 5. note: ENUMs are always strings! Don’t forget to use quotes in your queries.',
  `pubdate` datetime NOT NULL COMMENT 'time when the review was first published',
  `updated` datetime NOT NULL COMMENT 'time when the review was last updated',
  `imdbURL` varchar(191) NOT NULL DEFAULT '' COMMENT 'link to the IMDb page for this movie, e.g. http://www.imdb.com/title/tt2608732/',
  PRIMARY KEY (`movieID`)
) DEFAULT CHARSET=utf8;

INSERT INTO `movies` (`movieID`, `title`, `director`, `reviewerID`, `review`, `rating`, `pubdate`, `updated`, `imdbURL`)
VALUES
  (1,'Jay and Silent Bob Strike Back','Kevin Smith',1,'This movie’s got George Carlin, Carrie Fisher, Will Ferrell, _Dawson_, Chris Rock, Morris Day and the Times, Mark Hamill, and then some. Need I say more?\n\n![Hollywood had it coming.](http://i.imgur.com/2FWLFcc.png)\n\nHere’s a quick test:\n\n* Are you easily offended?\n* Does the mention of various body parts upset you?\n\nIf you answered _yes_ to either question, Jay and Silent Bob Strike Back is not your movie.\n\nIf you answered _no_, sit back and enjoy the ride!','5','2013-04-02 13:33:37','2013-04-02 13:33:37','http://www.imdb.com/title/tt0261392/');

CREATE TABLE `reviewers` (
  `reviewerID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'Full name of the reviewer, e.g. John Smith.',
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'e.g. john.smith@student.arteveldehs.be',
  `passwordHash` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'MD5 hash of the user’s password',
  PRIMARY KEY (`reviewerID`),
  KEY `email` (`email`)
) DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `reviewers` (`reviewerID`, `name`, `email`, `passwordHash`)
VALUES
  (1,'Mathias Bynens','mathias.bynens@arteveldehs.be','423a1b65854de1ee9f94139d68babc42');
