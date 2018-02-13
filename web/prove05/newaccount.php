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
        
        $userQuery = "SELECT * FROM public.user WHERE username = :username;";
        $statement = $myDatabase->prepare($userQuery);
        $statement->execute(array(':user' => htmlspecialchars($_POST['username'])));
        if (!!$statement->fetch(PDO::FETCH_ASSOC))
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
            echo "<script>window.location = 'openopinion.php' </script>";
        }
        
        /*
        $statement = $myDatabase->prepare("SELECT username FROM public.user WHERE 'username' = :username");
        $statement->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
        $statement->bindValue(':password', $_POST['password'], PDO::PARAM_STR);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if (! $row)
        {
            $query = 'INSERT INTO public.user(username, password, is_mod, date_registered)
            VALUES(:username, :password, false, NOW())';
            $stmt = $myDatabase->prepare($query);
            $stmt->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
            $stmt->bindValue(':password', $_POST['password'], PDO::PARAM_STR);
            $stmt->execute();
            echo "<script>window.location = 'openopinion.php' </script>";
        }
        else
        {   
            $message = "Username already exists.  Enter a unique username.";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
        */
        
        ?>
        
    </body>
</html>