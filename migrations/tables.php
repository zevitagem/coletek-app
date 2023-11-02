<?php

$queries = [];

$queries[] = "CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$queries[] = "CREATE TABLE `setores` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$queries[] = "CREATE TABLE `user_setores` (
  `setor_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$queries[] = "CREATE TABLE `migrations` (
  `id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$queries[] = 'ALTER TABLE `users` ADD PRIMARY KEY (`id`);';
$queries[] = 'ALTER TABLE `setores` ADD PRIMARY KEY (`id`);';

$queries[] = 'ALTER TABLE `users` MODIFY `id` int NOT NULL AUTO_INCREMENT;';
$queries[] = 'ALTER TABLE `setores` MODIFY `id` int NOT NULL AUTO_INCREMENT;';
