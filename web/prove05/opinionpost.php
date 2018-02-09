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

$postID = $_GET['id'];

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Opinion Post</title>
        <link rel="stylesheet" type="text/css" href="openopinion.css">
    </head>
    <body>
        <div id="header">
            <h1>Open Opinion</h1>
        </div>
        <?php
        //$post = $myDatabase->query("SELECT post_text FROM public.opinion_post WHERE id='". $postID . "';");
        foreach ($myDatabase->query("SELECT * FROM public.opinion_post WHERE id='". $postID . "';") as $post)
        {
            echo '<div id="post_title"><h2>' . $post['post_title'] . '</h2></div>';
            echo '<div id="post"><p>' . $post['post_text'] . '</p></div>';
            foreach ($myDatabase->query("SELECT * FROM public.user WHERE id='". $post['poster_id'] . "';") as $user)
            {
                echo '<div id="post_submitter"><i>' . $user['username'] . '</i></div>';
            }
        }
        ?>
    </body>