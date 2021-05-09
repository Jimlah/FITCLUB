<?php
session_start();
require_once(__DIR__ . './../../controller/AuthController.php');

$auth = new AuthController();

$auth->logout();
?>



<?= remove_session('msg')?>