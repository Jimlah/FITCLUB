<?php
session_start();
require_once(__DIR__ . './../controller/ClassController.php');

$class = new ClassController();

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
    
</body>

</html>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
<?= remove_session('msg')?>
</script>