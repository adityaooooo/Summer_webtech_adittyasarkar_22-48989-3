<!DOCTYPE HTML>
<html>
<head>
    <title>PHP Form Validation</title>
    <style>
        .error {color: #ab0c0cff;}
    </style>
</head>
<body>

<?php

$name = $email = $website = $comment = $gender = "";
$nameErr = $emailErr = $websiteErr = $genderErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

   
    if (!empty($_POST["website"])) {
        $website = test_input($_POST["website"]);
        if (!filter_var($website, FILTER_VALIDATE_URL)) {
            $websiteErr = "Invalid URL";
        }
    }

  
    if (!empty($_POST["comment"])) {
        $comment = test_input($_POST["comment"]);
    }

   
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Name: <input type="text" name="name" value="<?php echo $name; ?>">
    <span class="error">* <?php echo $nameErr; ?></span>
    <br><br>

    E-mail: <input type="text" name="email" value="<?php echo $email; ?>">
    <span class="error">* <?php echo $emailErr; ?></span>
    <br><br>

    Website: <input type="text" name="website" value="<?php echo $website; ?>">
    <span class="error"><?php echo $websiteErr; ?></span>
    <br><br>

    Comment: <br>
    <textarea name="comment" rows="5" cols="40"><?php echo $comment; ?></textarea>
    <br><br>

    Gender:
    <input type="radio" name="gender" value="female" <?php if ($gender=="female") echo "checked"; ?>>Female
    <input type="radio" name="gender" value="male" <?php if ($gender=="male") echo "checked"; ?>>Male
    <input type="radio" name="gender" value="other" <?php if ($gender=="other") echo "checked"; ?>>Other
    <span class="error">* <?php echo $genderErr; ?></span>
    <br><br>

    <input type="submit" name="submit" value="Submit">
</form>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && !$nameErr && !$emailErr && !$websiteErr && !$genderErr) {
    echo "<h2>Your Input:</h2>";
    echo "Name: $name<br>";
    echo "Email: $email<br>";
    echo "Website: $website<br>";
    echo "Comment: $comment<br>";
    echo "Gender: $gender<br>";
}
?>

</body>
</html>
