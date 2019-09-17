<?php
declare(strict_types=1);

require_once (__DIR__ . '/Classes/DB.php');

$sql = '
CREATE TABLE `clients` (
  `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `time_started` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;
CREATE TABLE `finished_clients` (
  `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `client_id` varchar(200) CHARACTER SET utf8 NOT NULL,
  `time_finished` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;
';

$db = new DB();

try {
    $db->getConnection()->prepare($sql)->execute();
    echo "Success";
} catch (Exception $exception) {
    echo $exception->getMessage();
}