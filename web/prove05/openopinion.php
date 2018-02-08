<?php
session_start();

$user = 'bruigbiqkmqflz';
$password = 'f16ade2ac40bc9bc38241e497207d16178f08200e4d2e4820c893760733dd068';
$host = 'ec2-54-235-240-126.compute-1.amazonaws.com';
$dbname = 'd9odltre339tgq';

try {
    $myDatabase = new PDO("pgsql:host=".$host."; dbname=".$dbname, $user, $pass);
    $myDatabase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connected successfully";
}
catch(PDOException $e)
{
    echo "Connection Failed: " . $e->getMessage();
}

//$myDatabase = new PDO('pgsql:host=ec2-54-235-240-126.compute-1.amazonaws.com;dbname=d9odltre339tgq', $user, $password);
//$dbconn = pg_connect("host=ec2-54-235-240-126.compute-1.amazonaws.com port=5432 dbname=d9odltre339tgq user=$user password=$password")



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
        </div>
        
        <?php
        echo $host;
        ?>

        
    </body>
</html>