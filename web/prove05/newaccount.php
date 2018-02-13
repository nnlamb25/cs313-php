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
                
                $createUser = 'CREATE USER :username WITH PASSWORD ":password"';
                $createUserStmt = $myDatabase->prepare($createUser);
                $createUserStmt->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
                $createUserStmt->bindValue(':password', $_POST['password'], PDO::PARAM_STR);
                $createUserStmt->execute();
                
                $access = 'GRANT SELECT, INSERT, UPDATE ON public.opinion_post, public.post_comment TO :username';
                $accessStmt = $myDatabase->prepare($access);
                $accessStmt->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
                $accessStmt->bindValue(':password', $_POST['password'], PDO::PARAM_STR);
                $accessStmt->execute();
                
                echo "<script>window.location = 'openopinion.php' </script>";
            }
        }
        ?>
        
    </body>
</html>