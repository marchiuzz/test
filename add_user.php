<?php
declare(strict_types=1);

require_once (__DIR__ . '/Classes/WaitingClient.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_button']) && !empty($_POST['submit_button'])){
    $client = new WaitingClient();
    $client->setName($_POST['name']);
    $client->setTimeStarted(date("Y-m-d H:i:s"));

    if($client->save()){
        echo "Success";
    } else {
        echo "Error";
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Client</title>
</head>
<body>
<?php
require_once (__DIR__ . '/_html_header.php');
?>

<form method="post" target="">
    <label for="name">Your name:</label>
    <input type="text" id="name" name="name" value="" placeholder="First Name" autocomplete="off"/>
    <input type="submit" id="submit_button" name="submit_button" value="Submit Form">
</form>
</body>
</html>


