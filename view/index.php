<?php
session_start();
require_once(__DIR__ . './../controller/AuthController.php');

$auth = new AuthController();

$response = "";

if ( !empty($_POST) && isset($_POST) && count($_POST) > 0) {
    $response = $auth->register($_POST);
    flash('msg', $response);
}
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
            <label for="name">Name</label>
            <input type="text" name="name" id="name">
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="name">
        </div>

        <div>
            <label for="password">password</label>
            <input type="password" name="password" id="password">
        </div>

        <div>
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password">
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