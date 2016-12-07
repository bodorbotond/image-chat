
drop database if exists `image_chat`;

-- Database: `image_chat`
create database if not exists `image_chat` default character set utf8;
use `image_chat`;

create table if not exists `users`(
  `user_id` tinyint(5) unsigned not null auto_increment,
  `user_name` varchar(50) not null unique,
  `e_mail` varchar(50) not null unique,
  `password` varchar(50) not null,
  `first_name` varchar(25),
  `last_name` varchar(25),
  `profile_picture` LONGBLOB,
  primary key(`user_id`)
);
 
create table if not exists `images`(
  `image_id` tinyint(5) unsigned not null auto_increment,
  `image_name` varchar(50) not null default '',
  `image_type` varchar(25) not null default '',
  `image` blob not null,
  `image_size` varchar(25) not null default '',
  primary key(`image_id`)
);
  
create table if not exists `friends`(
  `relation_id` tinyint(5) unsigned not null auto_increment,
  `user_id` tinyint(5) unsigned not null,
  `friend_id` tinyint(5) unsigned not null,
  primary key(`relation_id`),
  constraint `FriendsUserId` foreign key (`user_id`) references `users` (`user_id`), 
  constraint `FriendsFriendId` foreign key (`friend_id`) references `users` (`user_id`)
);
