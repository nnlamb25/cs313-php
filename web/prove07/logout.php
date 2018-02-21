<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

unset($_SESSION['username']);

?>

<!DOCTYPE html>
<html>
    <?php
    echo "<script>window.location = 'openopinion.php' </script>";
    ?>
</html>