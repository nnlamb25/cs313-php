<?php
session_start();

unset($_SESSION['username']);

?>

<!DOCTYPE html>
<html>
    <?php
    echo "<script>window.location = 'openopinion.php' </script>";
    ?>
</html>