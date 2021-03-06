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
            <a href="newaccount.php">Create an Account</a>
        </div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text" size="25" name="username" value="" placeholder="Enter username" style="font-size: 18px; margin: 15px 0px 0px 30px;"><br><br>
            <input type="text" size="25" name="password" value="" placeholder="Enter password" style="font-size: 18px; margin-left: 30px;"><br><br>
            <input type="submit" name="" value="submit" style="margin-left: 30px;">
        </form>
        <?php 
        if (isset($_POST['username']) && $_POST['username'] != '')
        {
            $enteredUserName = htmlspecialchars($_POST['username']);
            $enteredPassword = htmlspecialchars($_POST['password']);
            $userExists = false;
            $isMod = false;

            foreach ($myDatabase->query("SELECT * FROM public.user") as $user)
            {
                if ($user['username'] == $enteredUserName && $user['password'] == $enteredPassword)
                {
                    $userExists = true;
                    $isMod = $user['is_mod'];
                    break;
                }
            }

            if ($userExists)
            {
                $_SESSION['username'] = $enteredUserName;
                $_SESSION['isMod'] = $isMod;
                echo "<script>window.location = 'openopinion.php' </script>";
            }
            else
            {
                $message = "Incorrect username or password";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }
        ?>
    </body>
</html>