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
    <?php
    require_once (__DIR__ . '/_html_header.php');
    ?>

<table class="table">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Action</th>
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
            <td><a href="admin.php?clientComplete=<?= $waitingClient['id'] ?>" class="btn btn-success">Client finished</a></td>
        </tr>
        <?
    }
    ?>
    </tbody>
</table>
</body>
</html>
