<?php
declare(strict_types=1);

require_once (__DIR__ . '/Classes/Visitor.php');

$waitingVisitors = (new Visitor())->GetAllWaitingClients();
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

    foreach ($waitingVisitors as $visitor) {
        ?>
        <tr>
            <td scope="row"><?= $visitor['id'] ?></td>
            <td><?= $visitor['name'] ?></td>
            <td><?= $visitor['time_started'] ?></td>
        </tr>
    <?
    }
    ?>
    </tbody>
</table>
</body>
</html>
