<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require("dbConnect.php");
$myDatabase = get_db();

$postID = $_GET['id'];

?>

<!DOCTYPE html>
<html>
    <?php
    $deleteStmt = "DELETE FROM public.opinion_post WHERE id = '$postID'";
    pg_query($deleteStmt);
    
    echo "<script>window.location = 'openopinion.php' </script>";
    
    ?>
</html>