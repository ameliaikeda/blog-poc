create table `users` (
  `id` int unsigned not null auto_increment,
  `username` varchar(64) not null,
  `password` varchar(255) not null,
  `admin` tinyint(1) not null default 0,
  primary key (`id`),
  unique key (`username`)
) Engine=INNODB DEFAULT CHARSET=utf8;

create table `posts` (
  `id` int unsigned not null auto_increment,
  `title` varchar(50) not null,
  `body` text not null,
  `created_at` timestamp,
  primary key (`id`)
);
