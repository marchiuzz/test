<?php
declare(strict_types=1);

require_once (__DIR__ . '/Classes/Visitor.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_button']) && !empty($_POST['submit_button'])){

    $name = trim($_POST['name']);

    if(empty($name)){
        $error = "Name field is empty";
    }

    if(strlen($name) < 3){
        $error = "Minimum 3 characters";
    }

    if(!isset($error)){
        $client = new Visitor();
        $client->setName($name);
        $client->setTimeStarted(date("Y-m-d H:i:s"));

        if($client->save()){
            header("Location: waiting_list.php");
        } else {
            echo "Error";
        }
    } else {
        echo $error;
    }

}

?>
<?php
require_once (__DIR__ . '/_html_header.php');
?>

<form method="post" target="" role="form">
    <div class="form-group">
        <label for="name">Your name</label>
        <input type="text" class="form-control" id="name" name="name" value="" placeholder="Your name?" required>
    </div>
    <input type="submit" class="btn btn-primary" id="submit_button" name="submit_button" value="Submit">
</form>


</body>
</html>


