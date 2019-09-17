<?php
declare(strict_types=1);

require_once (__DIR__ . '/Classes/WaitingClient.php');

$waitingClients = (new WaitingClient())->GetAllWaitingClients();
?>

<?
require_once (__DIR__ . '/_html_header.php');
?>

<table class="table">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Waiting From</th>
    </tr>
    </thead>
    <tbody>
    <?php

    foreach ($waitingClients as $waitingClient) {
        //todo: Nekuriu kiekvienam foreach naujo objekto, kad nebutu papildomu mysql query, nes jau visa info turim $waitingClients
        ?>
        <tr>
            <td scope="row"><?= $waitingClient['id'] ?></td>
            <td><?= $waitingClient['name'] ?></td>
            <td><?= $waitingClient['time_started'] ?></td>
        </tr>
    <?
    }
    ?>
    </tbody>
</table>
</body>
</html>
