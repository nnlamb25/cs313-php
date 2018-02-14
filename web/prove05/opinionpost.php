<?php
session_start();

$user = 'bruigbiqkmqflz';
$password = 'f16ade2ac40bc9bc38241e497207d16178f08200e4d2e4820c893760733dd068';
$host = 'ec2-54-235-240-126.compute-1.amazonaws.com';
$dbname = 'd9odltre339tgq';

try {
    $myDatabase = new PDO("pgsql:host=".$host."; dbname=".$dbname, $user, $password);
    $myDatabase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "Connection Failed: " . $e->getMessage();
}

$postID = $_GET['id'];

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
            
            if (isset($_SESSION['username']))
            {
                $_SESSION['postid'] = $post['id'];
                echo '<a style="color: black;text-decoration: none;padding: 5px;background-color: #78b0e2;border-radius: 4px;" href="postreply.php">Reply</a>';
            }
            
            echo '</div><div id="comments">';
            foreach ($myDatabase->query("SELECT * FROM public.post_comment WHERE post_id='" . $post['id'] . "' AND reply_to_comment_id IS NULL;") as $comment)
            {
                echo '<div class="comment">';
                foreach ($myDatabase->query("SELECT * FROM public.user WHERE id='" . $comment['poster_id'] . "';") as $user)
                {
                    echo '<div class="commenter">' . $user['username'] . '</div>';
                }
                if (isset($_SESSION['username']))
                {
                    echo '<div class="comment_text">' . $comment['comment_text'] . '<br><br><a style="text-size: 12px;color: black;text-decoration: none;padding: 3px;background-color: #78b0e2;border-radius: 2px;" href="commentreply.php?id='. $comment['id'] . '">Reply</a></div>';
                }
                else
                {
                    echo '<div class="comment_text">' . $comment['comment_text'] . '</div>';
                }
                
                // How do I continuously nest replys?
                foreach ($myDatabase->query("SELECT * FROM public.post_comment WHERE post_id='" . $post['id'] . "' AND reply_to_comment_id='" . $comment['id'] . "';") as $reply)
                {
                    echo '<div class="comment, reply">';
                    foreach ($myDatabase->query("SELECT * FROM public.user WHERE id='" . $reply['poster_id'] . "';") as $user)
                    {
                        echo '<div class="commenter">' . $user['username'] . '</div>';
                    }
                    echo '<div class="comment_text">' . $reply['comment_text'] . '</div></div>';
                }
                echo '</div><br>';
            }
            echo '</div>';
        }
        ?>
    </body>