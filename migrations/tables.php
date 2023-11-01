<?php

$queries = [];
$queries[] = "CREATE TABLE `actions` (
  `id` int NOT NULL,
  `description` varchar(50) NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$queries[] = "CREATE TABLE `unities` (
  `id` int NOT NULL,
  `description` varchar(50) NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$queries[] = "CREATE TABLE `people` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$queries[] = "CREATE TABLE `registers` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `people_id` int NOT NULL,
  `unity_id` int NOT NULL,
  `status` smallint NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$queries[] = "CREATE TABLE `status` (
  `id` int NOT NULL,
  `description` varchar(15) NOT NULL,
  `active` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$queries[] = "CREATE TABLE `migrations` (
  `id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
