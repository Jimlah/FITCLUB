<?php
session_start();
require_once(__DIR__ . './../controller/AuthController.php');

$auth = new AuthController();

if (!empty($_POST) && isset($_POST) && count($_POST) > 0) {
    $response = $auth->register($_POST);
    flash('msg', $response);
}

$classes = $auth->showRegister();
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
            <label for="firstname">Firstname</label>
            <input type="text" name="firstname" id="firstname">
        </div>
        <div>
            <label for="lastname">Lastname</label>
            <input type="text" name="lastname" id="lastname">
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
            <label for="password1">confirm password</label>
            <input type="password" name="password1" id="password1">
        </div>

        <div>
            <label for="class">Class</label>
            <select name="class" id="class">
                <?php foreach ($classes as $class){?>
                    <option value="<?= $class['id']?>"><?= $class['name']?></option>
                <?php }?>
            </select>
        </div>

        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
</body>

</html>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    <?= remove_session('msg') ?>
</script>