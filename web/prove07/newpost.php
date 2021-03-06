<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require("dbConnect.php");
$myDatabase = get_db();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Open Opinion</title>
        <link rel="stylesheet" type="text/css" href="openopinion.css">
    </head>
    <body>
        <div id="header">
            <a class="link" href="openopinion.php"><h1>Open Opinion</h1></a>
            <?php
            
            if(isset($_SESSION['username']))
            {
                echo $_SESSION['username'] . ' • <a href="login.php">Switch Users</a> •  <a href="logout.php">Logout</a>';
            }
            else
            {
                echo "<script>window.location = 'login.php' </script>";
            }
            
            ?>
        </div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text" size="70" name="title" value="" placeholder="Enter an interesting and descriptive title" style="font-size: 16px; margin: 15px 0px 0px 30px;width: 70%"><br><br>
            <textarea rows="10" cols="70" name="post" value="" placeholder="Enter post description" style="font-size: 14px; margin-left: 30px;width: 70%"></textarea><br><br>
            <input type="submit" name="" value="submit" style="margin-left: 30px;font-size: 18px;">
        </form>
        
        <?php
        
        if (isset($_POST['title']) && $_POST['title'] != '' && isset($_POST['post']) && $_POST['post'] != '')
        {
            $postTitle = htmlspecialchars($_POST['title']);
            $postContent = htmlspecialchars($_POST['post']);
            
            foreach ($myDatabase->query("SELECT * FROM public.user") as $user)
            {
                if ($user['username'] == $_SESSION['username'])
                {
                    $userid = $user['id'];
                    break;
                }
            }
            
            $query = 'INSERT INTO public.opinion_post(poster_id, post_title, post_text, votes_agree, votes_disagree, changed_minds, date_posted)
            VALUES (:userid, :title, :text, 1, 0, 0, NOW())';
            $stmt = $myDatabase->prepare($query);
            $stmt->bindValue(':userid', $userid, PDO::PARAM_INT);
            $stmt->bindValue(':title', $postTitle, PDO::PARAM_STR);
            $stmt->bindValue(':text', $postContent, PDO::PARAM_STR);
            $stmt->execute();
            echo "<script>window.location = 'openopinion.php' </script>";
        }
        
        ?>
    </body>
</html>