<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require("dbConnect.php");
$myDatabase = get_db();

$postID = $_SESSION['postid'];

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Opinion Post</title>
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
                echo '<a href="login.php">Login</a> • <a href="newaccount.php">Create an Account</a>';
            }
            
            ?>
        </div>
        <?php
        foreach ($myDatabase->query("SELECT * FROM public.opinion_post WHERE id='". $postID . "';") as $post)
        {
            echo '<div id="post_title"><h2>' . $post['post_title'] . '</h2></div>';
            echo '<div id="post_wrapper"><div id="post"><p>' . $post['post_text'] . '</p></div></div>';
            foreach ($myDatabase->query("SELECT * FROM public.user WHERE id='". $post['poster_id'] . "';") as $user)
            {
                echo '<div id="post_submitter"><i>' . $user['username'] . '</i><br><br>';
            }
        }
        ?>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <textarea rows="6" cols="70" name="reply" value="" placeholder="Enter your reply" style="font-size: 14px; margin-left: 30px;width: 70%"></textarea><br><br>
            <input type="submit" name="" value="submit" style="margin-left: 30px;font-size: 18px;">
        </form>
        
        <?php
        
        if (isset($_POST['reply']) && $_POST['reply'] != '')
        {
            $postReply = htmlspecialchars($_POST['reply']);
            
            foreach ($myDatabase->query("SELECT * FROM public.user") as $user)
            {
                if ($user['username'] == $_SESSION['username'])
                {
                    $userid = $user['id'];
                    break;
                }
            }
            
            $query = 'INSERT INTO public.post_comment(post_id, poster_id, votes_agree, votes_disagree, changed_minds, comment_text, date_commented)
            VALUES (:postid, :posterid, 1, 0, 0, :text, NOW())';
            $stmt = $myDatabase->prepare($query);
            $stmt->bindValue(':postid', $postID, PDO::PARAM_INT);
            $stmt->bindValue(':posterid', $userid, PDO::PARAM_STR);
            $stmt->bindValue(':text', $postReply, PDO::PARAM_STR);
            $stmt->execute();
            echo "<script>window.location = 'opinionpost.php?id=$postID' </script>";
        }
        
        /*
        id SERIAL NOT NULL PRIMARY KEY,
    post_id INT NOT NULL REFERENCES public.opinion_post(id),
    poster_id INT NOT NULL REFERENCES public.user(id),
    votes_agree INT NOT NULL,
    votes_disagree INT NOT NULL,
    changed_minds INT NOT NULL,
    reply_to_comment_id INT REFERENCES public.post_comment(id),
    comment_text  TEXT NOT NULL,
    date_commented DATE NOT NULL
    */
        
        ?>
        
    </body>
</html>