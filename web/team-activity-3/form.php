<!DOCTYPE html>
<html>
    <head>
        <title>Form</title>
    </head>
    <body>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            Name: <input type="text" name="name"><br>
            E-mail: <input type="email" name="email"><br><br>
            <input type="radio" name="major"
            <?php if (isset($major) && $major=="Computer Science") echo "checked";?>
            value="Computer Science">Computer Science <br>
            <input type="radio" name="major"
            <?php if (isset($major) && $major=="Web Development") echo "checked";?>
            value="Web Development">Web Development <br>
            <input type="radio" name="major"
            <?php if (isset($major) && $major=="Software Engineering") echo "checked";?>
            value="Software Engineering">Software Engineering <br><br>
            <h3>Where have you visited?</h3>
            <input type="checkbox" name="countries[]" value="North America">North America<br>
            <input type="checkbox" name="countries[]" value="South America">South America<br>
            <input type="checkbox" name="countries[]" value="Europe">Europe<br>
            <input type="checkbox" name="countries[]" value="Asia">Asia<br>
            <input type="checkbox" name="countries[]" value="Australia">Australia<br>
            <input type="checkbox" name="countries[]" value="Africa">Africa<br>
            <input type="checkbox" name="countries[]" value="Antarctica">Antarctica<br><br>
            <textarea placeholder="Please leave us your comments!" rows="5" cols="45" name="comments"></textarea><br>
            <input type="submit" name="submit" value="submit"><br>
        </form>
        
        <?php
        $name = $_POST["name"];
        $email = $_POST["email"];
        $major = $_POST["comments"];
        $countries = $_POST["countries"];
        
            echo "<h2>Your Profile</h2><br>$name<br>$email<br>$major<br>$comments<br>";
        
            foreach ($countries as $country=>$value) {
                echo "Country: ".$value."<br>";
            }
        ?>
    </body>

</html>