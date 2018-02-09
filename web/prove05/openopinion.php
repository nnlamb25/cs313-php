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
            <h1>Open Opinion</h1>
        </div>
        
        <form id="search" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"method="post">
        
            Search: <input width="300px" type="text" name="postSearch" placeholder="Search for a Post">
            <input type="submit" name="search" value="Search">
        </form>
        
        <?php
        
        if(isset($_POST["postSearch"]))
        {
            foreach ($myDatabase->query("SELECT * FROM public.opinion_post WHERE post_title like '%". $_POST["postSearch"] . "%';") as $row)
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