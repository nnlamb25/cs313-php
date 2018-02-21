<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require("dbConnect.php");
$myDatabase = get_db();

$commentID = $_GET['id'];
$postID = $_GET['postID'];

?>

<!DOCTYPE html>
<html>
    <?php
    if(isset($_SESSION['username']))
    {
        echo 'SET<br>';
        foreach($myDatabase->query('SELECT * FROM public.post_comment;') as $row)
        {
            if($row['id'] == $commentID)
            {
                echo 'HERE<br>';
                foreach($myDatabase->query('SELECT * FROM public.user') as $user)
                {
                    if($_SESSION['isMod'] || ($user['username'] == $_SESSION['username'] && $row['poster_id'] == $user['id']))
                    {
                        echo 'INSIDE<br>';
                        $delete = "DELETE FROM public.post_comment WHERE id = :id";
                        $stmt = $myDatabase->prepare($delete);
                        $stmt->bindValue(':id', $commentID, PDO::PARAM_INT);
                        $stmt->execute();
                        echo 'DONE<br>';
                    }
                }
            }
        }
    }
    echo 'END<br>';
    
    //echo "<script>window.location = 'opinionpost.php?id=$postID' </script>";
    ?>
</html>
