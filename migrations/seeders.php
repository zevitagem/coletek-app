<?php

$queries = [];

$queries[] = 'ALTER TABLE `actions` ADD PRIMARY KEY (`id`);';
$queries[] = 'ALTER TABLE `registers` ADD PRIMARY KEY (`id`);';
$queries[] = 'ALTER TABLE `status` ADD PRIMARY KEY (`id`);';
$queries[] = 'ALTER TABLE `people` ADD PRIMARY KEY (`id`);';
$queries[] = 'ALTER TABLE `unities` ADD PRIMARY KEY (`id`);';
$queries[] = 'ALTER TABLE `migrations` ADD PRIMARY KEY (`id`);';

$queries[] = 'ALTER TABLE `actions` MODIFY `id` int NOT NULL AUTO_INCREMENT;';
$queries[] = 'ALTER TABLE `registers` MODIFY `id` int NOT NULL AUTO_INCREMENT;';
$queries[] = 'ALTER TABLE `status` MODIFY `id` int NOT NULL AUTO_INCREMENT;';
$queries[] = 'ALTER TABLE `people` MODIFY `id` int NOT NULL AUTO_INCREMENT;';
$queries[] = 'ALTER TABLE `unities` MODIFY `id` int NOT NULL AUTO_INCREMENT;';
$queries[] = 'ALTER TABLE `migrations` MODIFY `id` int NOT NULL AUTO_INCREMENT;';

$queries[] = "INSERT INTO `actions` (`id`, `description`, `active`) VALUES
(1, 'Importação de unidades', 1),
(2, 'Importação de cargos', 1),
(3, 'Importação de setores', 1),
(4, 'Importação de pessoas', 1),
(5, 'Importação de cursos', 1),
(6, 'Importação de matriculas', 1),
(7, 'Certificados em lote', 1);";

$queries[] = "INSERT INTO `status` (`id`, `description`, `active`) VALUES
(1, 'EM_ANDAMENTO', 1),
(2, 'PROCESSADO', 1),
(3, 'CANCELADO', 1);";

$queries[] = "INSERT INTO `people` (`id`, `name`) VALUES
(1, 'ANNA'),
(2, 'JOSE'),
(3, 'LIVIA');";

$queries[] = "INSERT INTO `unities` (`id`, `description`, `active`) VALUES
(1, 'Nordeste', 1),
(2, 'Rio de Janeiro', 1),
(3, 'Interior', 1);";
