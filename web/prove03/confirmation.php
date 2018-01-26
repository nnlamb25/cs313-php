<?php

$name = htmlspecialchars($_POST["name"]);
$address = htmlspecialchars($_POST["address"]);
$city = htmlspecialchars($_POST["city"]);
$state = htmlspecialchars($_POST["state"]);
$zip = htmlspecialchars($_POST["zip"]);

session_start();

$_SESSION["name"] = $name;
$_SESSION["address"] = $address;
$_SESSION["city"] = $city;
$_SESSION["state"] = $state;
$_SESSION["zip"] = $zip;

$total = $_SESSION["drone1"] * 2899 + $_SESSION["drone2"] * 1699 + $_SESSION["drone3"] * 1649 + 
         $_SESSION["drone4"] * 999 + $_SESSION["drone5"] * 499 + $_SESSION["drone6"] * 49 + 
         $_SESSION["battery1"] * 399 + $_SESSION["battery2"] * 249 + $_SESSION["battery3"] * 99 + 
         $_SESSION["charger1"] * 79 + $_SESSION["charger2"] * 79;

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
                    <table style="margin: 10px 25px 5px 15px;">
                        <?php 

                        if ($_SESSION["drone1"] > 0)
                        {
                            echo '<tr id="drone1">
                                <td class="preview"><img src="drone1.jpg" alt="drone1"></td>
                                <td class="dName">Ultra X7</td>
                                <td class="description">No opinions answered oh felicity is resolved hastened. Produced it friendly my if opinions humoured. Enjoy is wrong folly no taken. It sufficient instrument insipidity simplicity at interested. Law pleasure attended differed mrs fat and formerly.  Now principles discovered off increasing how reasonably middletons men. Add seems out man met plate court sense. His joy she worth truth given. All year feet led view went sake.</td>
                                <td class="price">$2899 x</td>
                                <td class="quantity"><input disabled type="number" name="drone1" class="num" value="'.$_SESSION["drone1"].'"
                                                                           style="width: 30px; margin: 2px 0px 0px 5px; background-color: rgb(201, 201, 201);">
                                </td>
                                </tr>';
                        }
                        if ($_SESSION["drone2"] > 0)
                        {                        
                            echo '<tr id="drone2">
                                <td class="preview"><img src="drone2.jpg" alt="drone2"></td>
                                <td class="dName">Viper 3</td>
                                <td class="description">On recommend tolerably my belonging or am. Mutual has cannot beauty indeed now sussex merely you. It possible no husbands jennings ye offended packages pleasant he. Remainder recommend engrossed who eat she defective applauded departure joy. Get dissimilar not introduced day her apartments. Fully as taste he mr do smile abode every.</td>
                                <td class="price">$1699 x</td>
                                <td class="quantity"><input disabled type="number" name="drone2" class="num" value="'.$_SESSION["drone2"].'"
                                                                           style="width: 30px; margin: 2px 0px 0px 5px; background-color: rgb(201, 201, 201);">                         
                                </td>
                                </tr>';
                        }
                        if ($_SESSION["drone3"] > 0)
                        {
                            echo '<tr id="drone3">
                                <td class="preview"><img src="drone3.jpg" alt="drone3"></td>
                                <td class="dName">Phantom</td>
                                <td class="description">She who arrival end how fertile enabled. Brother she add yet see minuter natural smiling article painted. Themselves at dispatched interested insensible am be prosperous reasonably it. In either so spring wished. Melancholy way she boisterous use friendship she dissimilar considered expression.</td>
                                <td class="price">$1649 x</td>
                                <td class="quantity"><input disabled type="number" name="drone3" class="num" value="'.$_SESSION["drone3"].'"
                                                                           style="width: 30px; margin: 2px 0px 0px 5px; background-color: rgb(201, 201, 201);">
                                </td>
                                </tr>';
                        }
                        if ($_SESSION["drone4"] > 0)
                        {
                            echo '<tr id="drone4">
                                <td class="preview"><img src="drone4.jpg" alt="drone4"></td>
                                <td class="dName">XLR 8</td>
                                <td class="description">How promotion excellent curiosity yet attempted happiness. Lay prosperous impression had conviction. For every delay death ask style.</td>
                                <td class="price">$999 x</td>
                                <td class="quantity"><input disabled type="number" name="drone4" class="num" value="'.$_SESSION["drone4"].'"
                                                                           style="width: 30px; margin: 2px 0px 0px 5px; background-color: rgb(201, 201, 201);">
                                </td>
                                </tr>';
                        }
                        if ($_SESSION["drone5"] > 0)
                        {
                            echo '<tr id="drone5">
                                <td class="preview"><img src="drone5.jpg" alt="drone5"></td>
                                <td class="dName">Rover 9</td>
                                <td class="description">Oh acceptance apartments up sympathize astonished delightful. Waiting him new lasting towards. Continuing melancholy especially so to. Me unpleasing impossible in attachment announcing so astonished. What ask leaf may nor upon door. Tended remain my do stairs. Oh smiling amiable am so visited cordial in offices hearted.</td>
                                <td class="price">$449 x</td>
                                <td class="quantity"><input disabled type="number" name="drone5" class="num" value="'.$_SESSION["drone5"].'"
                                                                           style="width: 30px; margin: 2px 0px 0px 5px; background-color: rgb(201, 201, 201);">
                                </td>
                                </tr>';
                        }
                        if ($_SESSION["drone6"] > 0)
                        {
                            echo '<tr id="drone6">
                                <td class="preview"><img src="drone6.jpg" alt="drone6"></td>
                                <td class="dName">Mach 10</td>
                                <td class="description">Attigerint quapropter immortalem co ab falsitatem et perspicuum cavillandi. Bitavi obvium ﻿tam fusius doctus age certum nos ens dat. Attendamus aliquandiu quamprimum ex sequuturum persuadeam effectibus ob. Porro nulli sed quare prona rum locis vulgo. Existere interire figmenta ad machinae ii repetere. Sequuturum ad at voluptatem complector</td>
                                <td class="price">$49 x</td>
                                <td class="quantity"><input type="number" name="drone6" class="num" value="'.$_SESSION["drone6"].'" style="width: 50px; margin-left: 5px;">
                                <input type="submit" name="submit" value="Update Item" style="margin-bottom: 32px; font-size: 25px;">                                </td>
                            </tr>';
                        }
                        if ($_SESSION["battery1"] > 0)
                        {
                            echo '<tr id="battery1">
                                <td class="preview"><img src="battery1.jpg" alt="battery1"></td>
                                <td class="dName">Ultra Watt</td>
                                <td class="description">Excludat an dedissem reperiri authorem is de existant ad. Sap dum lus deveniri existere incedere revocari. Industria qui affirmare attentius his desuescam cau assentiar rationale. Fundamenta mem facultatem describere vox dem appellatur ima.</td>
                                <td class="price">$399 x</td>
                                <td class="quantity"><input disabled type="number" name="battery1" class="num" value="'.$_SESSION["battery1"].'"
                                                                           style="width: 30px; margin: 2px 0px 0px 5px; background-color: rgb(201, 201, 201);">
                                </td>
                                </tr>';
                        }
                        if ($_SESSION["battery2"] > 0)
                        {
                            echo '<tr id="battery2">
                                <td class="preview"><img src="battery2.jpeg" alt="battery2"></td>
                                <td class="dName">Super Watt</td>
                                <td class="description">Quaerendum quaecunque falsitatis ii persuaderi ei procederet. Me ipsamet sentire co admonet referam ex gi perduci. Me communibus de cogitantem ex conflantur. Halitus deludat suppono petitis im humanae et.</td>
                                <td class="price">$249 x</td>
                                <td class="quantity"><input disabled type="number" name="battery2" class="num" value="'.$_SESSION["battery2"].'"
                                                                           style="width: 30px; margin: 2px 0px 0px 5px; background-color: rgb(201, 201, 201);">
                                </td>
                                </tr>';
                        }
                        if ($_SESSION["battery3"] > 0)
                        {
                            echo '<tr id="battery3">
                                <td class="preview"><img src="battery3.jpg" alt="battery3"></td>
                                <td class="dName">Mega Watt</td>
                                <td class="description">Admonitus distincte jam est cogitatio succedens opinantem archetypi. Ita geometriam sub parentibus pensitatis pro. Progressus ut inchoandum abducendam eo dulcedinem exponantur quaerantur. Co im contingit existeret at confidere. Cognoscam nam jam cunctaque qui importare. Cum numeri ero sensus facere regula accepi.</td>
                                <td class="price">$99 x</td>
                                <td class="quantity"><input disabled type="number" name="battery3" class="num" value="'.$_SESSION["battery3"].'"
                                                                           style="width: 30px; margin: 2px 0px 0px 5px; background-color: rgb(201, 201, 201);">
                                </td>
                                </tr>';
                        }
                        if ($_SESSION["charger1"] > 0)
                        {
                            echo '<tr id="charger1">
                            <td class="preview"><img src="charger2.jpg" alt="charger2"></td>
                            <td class="dName">Full Charger</td>
                            <td class="description">Facit mea sonum usu fit adhuc lus. Accepit creasse brachia de corpore corpori de. Pendent hac cum sed usu minimum colores. Ingenio vim colores istarum cui equidem. </td>
                            <td class="price">$79 x</td>
                            <td class="quantity"><input disabled type="number" name="charger1" class="num" value="'.$_SESSION["charger1"].'"
                                                                           style="width: 30px; margin: 2px 0px 0px 5px; background-color: rgb(201, 201, 201);">
                            </td>
                            </tr>';
                        }
                        if ($_SESSION["charger2"] > 0)
                        {
                            echo '<tr id="charger2">
                                <td class="preview"><img src="charger2.jpg" alt="charger2"></td>
                                <td class="dName">Full Charger</td>
                                <td class="description">Facit mea sonum usu fit adhuc lus. Accepit creasse brachia de corpore corpori de. Pendent hac cum sed usu minimum colores. Ingenio vim colores istarum cui equidem. </td>
                                <td class="price">$79 x</td>
                                <td class="quantity"><input disabled type="number" name="charger2" class="num" value="'.$_SESSION["charger2"].'"
                                                                           style="width: 30px; margin: 2px 0px 0px 5px; background-color: rgb(201, 201, 201);">
                                </td>
                                </tr>';
                        }
                        
                        echo '<h2 style="margin-left: 25px;">Total: $'.$total.'</h2>';
                        
                        ?>
                    </table>
                    <div style="border-top: 1px solid black;">
                        <?php
                            
                        echo '<h2 style="margin-left: 25px;">'.$name.'</h2>';
                        echo '<h3 style="margin: -15px 0px -25px 25px;">Address:</h3>
                            <h4 style="margin-left: 30px;"><i>'.$address.'<br>'.$city.', '.$state.' '.$zip.'</i></h4>';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>