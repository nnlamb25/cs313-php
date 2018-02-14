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
                
                echo '<h1>MADE IT THIS FAR</h1><br>';
                try
                {
                    $createUser = 'CREATE USER :username WITH PASSWORD :password';
                    echo '<h1>1</h1><br>';
                    $createUserStmt = $myDatabase->prepare($createUser);
                    echo '<h1>2</h1><br>';
                    $createUserStmt->bindValue(':username', $_POST['username']);
                    echo '<h1>3</h1><br>';
                    $createUserStmt->bindValue(':password', $_POST['password'], PDO::PARAM_STR);
                    echo '<h1>4</h1><br>';
                    $createUserStmt->execute();
                }
                catch(PDOException $e)
                {
                    echo "Error creating user: " . $e->getMessage();
                }
                
                try
                {
                    $crt = "CREATE USER please_work WITH PASSWORD 'password'";
                    $crtSt = $myDatabase->prepare($crt);
                    $crtSt->execute();
                }
                catch(PDOException $e)
                {
                    echo "Error creating user: " . $e->getMessage();
                }
                
                echo '<h1>NOW WE ARE THIS FAR</h1><br>';
                
                
                $access = 'GRANT SELECT, INSERT, UPDATE ON public.opinion_post, public.post_comment TO :username';
                echo '<h1>5</h1><br>';
                $accessStmt = $myDatabase->prepare($access);
                echo '<h1>6</h1><br>';
                $accessStmt->bindValue(':username', $_POST['username']);
                echo '<h1>7</h1><br>';
                $accessStmt->execute();
                
                echo '<h1>MADE IT TO THE END</h1><br>';
                
                echo "<script>window.location = 'openopinion.php' </script>";
            }
        }
        ?>
        
    </body>
</html>