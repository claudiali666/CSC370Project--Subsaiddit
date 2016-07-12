CREATE TABLE `User` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `reputation` int(11) unsigned NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name_UNIQUE` (`user_name`)
) 

CREATE TABLE `Posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_title` varchar(1024) NOT NULL,
  `post_URL` varchar(1024) DEFAULT NULL,
  `up_vote` int(11) DEFAULT '0',
  `down_vote` int(11) DEFAULT '0',
  `post_published` datetime NOT NULL,
  `post_edited` datetime NOT NULL,
  `post_subsaidit` varchar(100) DEFAULT NULL,
  `post_user` int(11) DEFAULT NULL,
  `post_subsaiddits_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`post_id`),
  FOREIGN KEY (`post_subsaiddits_id`) REFERENCES `Subsaiddits` (`subsaiddits_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  FOREIGN KEY (`post_user`) REFERENCES `User` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) 

CREATE TABLE `Comment` (
  `comment_Id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_upvote` int(11) NOT NULL,
  `comment_downvote` int(11) NOT NULL,
  `comment_text` varchar(500) NOT NULL,
  `comment_time` datetime NOT NULL,
  `comment_user_Id` int(11) DEFAULT NULL,
  `comment_post_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`comment_Id`),
   FOREIGN KEY (`comment_post_id`) REFERENCES `Posts` (`post_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  FOREIGN KEY (`comment_user_Id`) REFERENCES `User` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE
) 

CREATE TABLE `Subsaiddits` (
  `subsaiddits_id` int(11) NOT NULL AUTO_INCREMENT,
  `subsaiddits_is_default` blob NOT NULL,
  `subsaiddits_created_time` datetime NOT NULL,
  `subsaiddits_description` varchar(300) NOT NULL,
  `subsaiddits_title` varchar(45) NOT NULL,
  `subsaiddits_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`subsaiddits_id`),
  FOREIGN KEY (`subsaiddits_user_id`) REFERENCES `User` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE
) 

CREATE TABLE `Friends` (
  `user_ID` int(11) NOT NULL,
  `user_Friend` int(11) NOT NULL,
   PRIMARY KEY (`user_ID`,`user_Friend`)
) 

CREATE TABLE `favourite` (
  `user_ID` int(11) NOT NULL,
  `post_ID` int(11) NOT NULL,
  `favourite_post` varchar(1) NOT NULL,
  PRIMARY KEY (`user_ID`,`post_ID`)
) 

CREATE TABLE `subscribe` (
  `subsaid_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`subsaid_id`,`user_id`)
) 