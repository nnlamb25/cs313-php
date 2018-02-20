<?php

function get_db()
{
    $user = 'bruigbiqkmqflz';
    $password = 'f16ade2ac40bc9bc38241e497207d16178f08200e4d2e4820c893760733dd068';
    $host = 'ec2-54-235-240-126.compute-1.amazonaws.com';
    $dbname = 'd9odltre339tgq';
    
    try 
    {
        $myDatabase = new PDO("pgsql:host=".$host."; dbname=".$dbname, $user, $password);
        $myDatabase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo "Connection Failed: " . $e->getMessage();
    }
    
    return $myDatabase
}

?>