<!DOCTYPE html>
<html>
    <head>
        <title>Form</title>
    </head>
    <body>
        <form action="" method="post">
            Name: <input type="text" name="name"><br>
            E-mail: <input type="email" name="email"><br>
            <input type="radio" name="major"
            <?php if (isset($major) && $major=="Computer Science") echo "checked";?>
            value="Computer Science">Computer Science
            <input type="radio" name="gender"
            <?php if (isset($major) && $major=="Web Development") echo "checked";?>
            value="Web Development">Web Development
            <input type="radio" name="major"
            <?php if (isset($major) && $major=="Software Engineering") echo "checked";?>
            value="Software Engineering">Software Engineering
        </form>
    </body>

</html>