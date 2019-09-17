<?php
declare(strict_types=1);

require_once (__DIR__ . '/Classes/WaitingClient.php');

$waitingClients = (new WaitingClient())->GetAllWaitingClients();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Waiting List</title>
</head>
<body>
<?php
require_once (__DIR__ . '/_html_header.php');
?>

<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Waiting From</th>
    </tr>
    <?php

    foreach ($waitingClients as $waitingClient) {
        //todo: Nekuriu kiekvienam foreach naujo objekto, kad nebutu papildomu mysql query, nes jau visa info turim $waitingClients
        ?>
        <tr>
            <td><?= $waitingClient['id'] ?></td>
            <td><?= $waitingClient['name'] ?></td>
            <td><?= $waitingClient['time_started'] ?></td>
        </tr>
    <?
    }
    ?>
</table>
</body>
</html>
