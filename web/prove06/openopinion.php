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
            <h1>Open Opinion</h1>
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
        
        <form id="search" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"method="post">
        
            <input id="search_btn" type="submit" name="search" value="Search"> <input size="40" type="text" name="postSearch" placeholder="Search for a Post">
            
        </form>
        
        <?php
        
        if(isset($_SESSION['username']))
        {
            echo '<br><a href="newpost.php" style="color: black;text-decoration: none;margin-left: 20px;padding: 5px;background-color: #78b0e2;border-radius: 4px;">New Post</a>';
        }
        
        if(isset($_POST["postSearch"]))
        {
            $search = htmlspecialchars($_POST["postSearch"]);
            foreach ($myDatabase->query("SELECT * FROM public.opinion_post WHERE post_title like '%$search%';") as $row)
            {
                echo '<div class="post_link"><a class="link" href="opinionpost.php?id=' . $row['id']. '">' . $row['post_title'] . '</div>';
            }
        }
        else
        {
            foreach ($myDatabase->query('SELECT * FROM public.opinion_post;') as $row)
            {
                echo '<div class="post_link"><a class="link" href="opinionpost.php?id=' . $row['id']. '">' . $row['post_title'] . '</div>';
            }
        }
        
        ?>

        
    </body>
</html>