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
    </body>
</html>