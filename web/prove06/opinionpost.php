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
            $_SESSION['postid'] = $post['id'];
            echo '<div id="post_title"><h2>' . $post['post_title'] . '</h2></div>';
            echo '<div id="post_wrapper"><div id="post"><p>' . $post['post_text'] . '</p></div></div>';
            foreach ($myDatabase->query("SELECT * FROM public.user WHERE id='". $post['poster_id'] . "';") as $user)
            {
                echo '<div id="post_submitter"><i>' . $user['username'] . '</i>';
            }
            
            $usrID;
            if(isset($_SESSION['username']))
            {
                foreach($myDatabase->query('SELECT * FROM public.user') as $user)
                {
                    if($user['username'] == $_SESSION['username'])
                    {
                        $usrID = $user['id'];
                        break;
                    }
                }

                if($usrID == $post['poster_id'] || $_SESSION['isMod'])
                {
                       echo ' - <a href="deletepost.php?id=' . $post['id']. '" style="font-size: 10px;"> delete</a>';
                }
            }
            
            echo '<br><br>';
            
            if (isset($_SESSION['username']))
            {
                echo '<a style="color: black;text-decoration: none;padding: 5px;background-color: #78b0e2;border-radius: 4px;" href="postreply.php">Reply</a>';
            }
            
            echo '</div><div id="comments">';
            foreach ($myDatabase->query("SELECT * FROM public.post_comment WHERE post_id='" . $post['id'] . "' AND reply_to_comment_id IS NULL ORDER BY date_commented DESC;") as $comment)
            {
                echo '<div class="comment">';
                foreach ($myDatabase->query("SELECT * FROM public.user WHERE id='" . $comment['poster_id'] . "';") as $user)
                {
                    echo '<div class="commenter">' . $user['username'] . '</div>';
                    if(isset($_SESSION['username']) && $user['username'] == $_SESSION['username'])
                    {
                        $usrID = $user['id'];
                        break;
                    }
                }
                if (isset($_SESSION['username']))
                {
                    if($usrID == $comment['poster_id'] || $_SESSION['isMod'])
                    {
                        echo ' - <a href="deletecomment.php?id=' . $comment['id']. '" style="font-size: 10px;"> delete</a>';
                    }
                
                    echo '<br><br><a style="text-size: 12px;color: black;text-decoration: none;padding: 3px;background-color: #78b0e2;border-radius: 2px;" href="commentreply.php?id='. $comment['id'] . '&postID=' . $postID . '>Reply</a>';
                }
                else
                {
                    echo '<div class="comment_text">' . $comment['comment_text'];
                }
                
                echo '</div>';
                
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