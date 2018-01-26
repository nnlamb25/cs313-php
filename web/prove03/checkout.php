<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Checkout</title>
        <link rel="stylesheet" type="text/css" href="drone.css">
    </head>
    <body>
        <div id="document">
        <a href="../assignments.html"><img src="droneFly.png" alt="drone" align="left" width="12%" height="12%" title="CS313 Assignments"></a>
        <div id="header">
            <h1>All About Drones</h1>
        </div>
        <div id="motto">
            <h1>Experience New Heights</h1>
        </div>
        <div id="statement">
            <blockquote><i>"All About Drones has the best selection of drones and drone accessories on the web.  Great place to fill any of your needs to continue your drone hobby or career!" </i><span style="font-size: 14px;"><br /> - General George Washington</span></blockquote>
        </div>
            <div id="content">
                <ul id="menu">
                    <a href="items.php"><li>Browse our selection</li></a>
                    <a href="shoppingCart.php"><li>Shopping Cart</li></a>
                    <li>Learn More</li>
                    <li>Rules and Regulations</li>
                    <li>About Us</li>
                    <li>Contact Us</li>
                </ul>
                <div id="info">
                    <h1 style="margin-left: 20px; color: #00009f;"><i>Checkout</i></h1>
                    <form action="confirmation.php" method="post">
                        <h4 style="margin-left: 45px;">Name: <input style="width: 250px; font-size: 18px;" type="text" name="name"></h4>
                        <h4 style="margin-left: 15px;">Address: <input style="width: 250px; font-size: 18px;" type="text" name="address"></h4>
                        <h4 style="margin-left: 65px;">City: <input style="width: 130px; font-size: 18px; margin-right: 15px;" type="text" name="city">
                        State: <input style="width: 50px; font-size: 18px; margin-right: 15px;" type="text" name="state">
                        Zip: <input style="width: 100px; font-size: 18px;" type="text" name="zip"><br></h4>
                        <input type="submit" name="submit" value="CONFIRM" style="font-size: 30px; height: 50px; width: 80px; padding: 10px; margin: 0px 0px 20px 50px;"><br>
                    </form>
                </div>
            </div>
        </div>
    </body>

</html>