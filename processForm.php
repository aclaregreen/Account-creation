<html>

<head>
    <title>
        Contact Form
    </title>
</head>

<body>
    <form method="post" action="processForm.php">
        First name: <input name="fname" type="text"><br>
        Last name: <input name="lname" type="text"><br>
        Email: <input name="email" type="text"><br>
        Password: <input name="pass" type="text"><br>
        Confirm Password: <input name="pass2" type="text"><br>
        <input type="submit" value="Submit"><br>
    </form>

    <?php
    function checkPass($password)
    {
        if (strlen($password) < 8) {
            return false;
        } else if (!preg_match("/[A-Z]/", $password)) {
            return false;
        } else if (!preg_match("/[a-z]/", $password)) {
            return false;
        } else if (!preg_match("/[0-9]/", $password)) {
            return false;
        } else if (!preg_match("/[\W_]/", $password)) {
            return false;
        } else {
            return true;
        }
    }


    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $pass2 = $_POST["pass2"];

    if ($fname == null or $lname == null or $email == null or $pass == null or $pass2 == null) {
        echo "All fields are required<br>";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "invalid email<br>";
    } else if ($pass != $pass2) {
        echo "Passwords must match<br>";
    } else if (!checkPass($pass)) {
        echo "Password does not meet the requirements<br>";
    } else {
        $data = "First Name: $fname\nLast Name: $lname\nEmail: $email\nPassword: $pass\n";
        $file = fopen("data.txt", "a");
        if ($file) {
            fwrite($file, $data);
            fclose($file);
            echo "Account created<br>";
        } else {
            echo "Failed to save data<br>";
        }
    }
    ?>
</body>

</html>