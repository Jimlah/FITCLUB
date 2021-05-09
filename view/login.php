<?php
session_start();
require_once(__DIR__ . './../controller/AuthController.php');

$auth = new AuthController();


if ( !empty($_POST) && isset($_POST) && count($_POST) > 0) {
    $response = $auth->login($_POST);
}

$class = $auth->showLogin();
$response = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?= alert('msg') ?>
    <form action="" method="post">
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="name">
        </div>

        <div>
            <label for="password">password</label>
            <input type="password" name="password" id="password">
        </div>

        <div>
           <button type="submit">Submit</button>
        </div>
    </form>
</body>

</html>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
<?= remove_session('msg')?>
</script>