<?php
declare(strict_types=1);

require_once (__DIR__ . '/Classes/DB.php');

$sql = [];

$sql[] = "
CREATE TABLE `finished_visitors` (
  `id` int(6) UNSIGNED NOT NULL,
  `visitor_id` int(6) UNSIGNED NOT NULL,
  `time_finished` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;";
$sql[] = "CREATE TABLE `visitors` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `time_started` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;";

$sql[] = "ALTER TABLE `finished_visitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitor_id` (`visitor_id`);";

$sql[] = "ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);";

$sql[] = "ALTER TABLE `finished_visitors`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;";

$sql[] = "ALTER TABLE `visitors`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;";

$sql[] = "ALTER TABLE `finished_visitors`
  ADD CONSTRAINT `finished_visitors_ibfk_1` FOREIGN KEY (`visitor_id`) REFERENCES `visitors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
";


$db = new DB();
try {

    foreach ($sql as $query) {
        $db->getConnection()->prepare($query)->execute();
    }

    echo "Success";
} catch (Exception $exception) {
    echo $exception->getMessage();
}