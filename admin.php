<?php
declare(strict_types=1);

require_once (__DIR__ . '/Classes/WaitingClient.php');

$waitingClients = (new WaitingClient())->GetAllWaitingClients(1);

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['clientComplete'])){
    $clientId = (int)$_GET['clientComplete'];
    $waitingClient = new WaitingClient($clientId);
    if($waitingClient->destroy()){
        header("Location: admin.php");
    } else {
        echo "Error";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Waiting List</title>
</head>
<body>
<table>
    <?php
    require_once (__DIR__ . '/_html_header.php');
    ?>

    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Action</th>
    </tr>
    <?php

    foreach ($waitingClients as $waitingClient) {
        //todo: Nekuriu kiekvienam foreach naujo objekto, kad nebutu papildomu mysql query, nes jau visa info turim $waitingClients
        ?>
        <tr>
            <td><?= $waitingClient['id'] ?></td>
            <td><?= $waitingClient['name'] ?></td>
            <td><a href="admin.php?clientComplete=<?= $waitingClient['id'] ?>">Client finished</a></td>
        </tr>
        <?
    }
    ?>
</table>
</body>
</html>
