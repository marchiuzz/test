<?php
declare(strict_types=1);

require_once (__DIR__ . '/Classes/Visitor.php');

$waitingVisitors = (new Visitor())->GetAllWaitingClients(1);

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['clientComplete'])){
    $clientId = (int)$_GET['clientComplete'];
    $waitingClient = new Visitor($clientId);
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

    foreach ($waitingVisitors as $visitor) {
        ?>
        <tr>
            <td scope="row"><?= $visitor['id'] ?></td>
            <td><?= $visitor['name'] ?></td>
            <td><a href="admin.php?clientComplete=<?= $visitor['id'] ?>" class="btn btn-success">Client finished</a></td>
        </tr>
        <?
    }
    ?>
    </tbody>
</table>
</body>
</html>
