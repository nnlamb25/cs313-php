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
            <a href="login.php">Login</a>
        </div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text" size="25" name="username" value="" placeholder="Enter a unique username" style="font-size: 18px; margin: 15px 0px 0px 30px;"><br><br>
            <input type="text" size="25" name="password" value="" placeholder="Enter a password" style="font-size: 18px; margin-left: 30px;"><br><br>
            <input type="submit" name="" value="submit" style="margin-left: 30px;">
        </form>
        
        <?php 
        if (isset($_POST['username']) && $_POST['username'] != '')
        {
            $enteredUserName = htmlspecialchars($_POST['username']);
            $userExists = false;

            foreach ($myDatabase->query("SELECT * FROM public.user") as $user)
            {
                if ($user['username'] == $enteredUserName)
                {
                    $userExists = true;
                    break;
                }
            }

            if ($userExists)
            {
                $message = "Username already exists.  Enter a unique username.";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            else
            {
                $query = 'INSERT INTO public.user(username, password, is_mod, date_registered)
                VALUES(:username, :password, false, NOW())';
                $stmt = $myDatabase->prepare($query);
                $stmt->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
                $stmt->bindValue(':password', $_POST['password'], PDO::PARAM_STR);
                $stmt->execute();
                
                $_SESSION['username'] = $enteredUserName;
                
                echo "<script>window.location = 'openopinion.php' </script>";
            }
        }
        ?>
        
    </body>
</html>