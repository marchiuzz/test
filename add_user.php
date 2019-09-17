<?php
declare(strict_types=1);

require_once (__DIR__ . '/Classes/WaitingClient.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_button']) && !empty($_POST['submit_button'])){
    $client = new WaitingClient();
    $client->setName($_POST['name']);
    $client->setTimeStarted(date("Y-m-d H:i:s"));

    if($client->save()){
        header("Location: waiting_list.php");
    } else {
        echo "Error";
    }
}

?>
<?php
require_once (__DIR__ . '/_html_header.php');
?>

<form method="post" target="">
    <div class="form-group">
        <label for="name">Your name</label>
        <input type="text" class="form-control" id="name" name="name" value="" placeholder="Your name?">
    </div>
    <button type="submit" class="btn btn-primary" id="submit_button" name="submit_button">Submit</button>
</form>


</body>
</html>


