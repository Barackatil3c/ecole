<?php declare(strict_types=1); 

session_start();
$conn = mysqli_connect("localhost", "root", "", "saint_anne");

if (!$conn) {
    echo "Not connected!";
}

if (isset($_SESSION['uid'])) {
    header("Location: ../index.php ");
}

if (isset($_POST['submit'])) {
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    $check = mysqli_query($conn, " SELECT * FROM users WHERE uname = '{$uname}' ");
    if (mysqli_num_rows($check) > 0) {
        echo " Username already exist!";
    } else {
        $sql = mysqli_query($conn, "INSERT INTO users(uname, pass) VALUES('{$uname}','{$pass}') ");
        if ($sql == true) {
            $query = mysqli_query($conn, " SELECT * FROM users WHERE uname = '{$uname}' AND `pass` = '{$pass}'");
            $fetch = mysqli_fetch_assoc($query);
            $_SESSION['uid'] = $fetch['uid'];
            header("Location: ../index.php");
        } else {
            echo "Not inserted";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGN UP</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: black;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 400px;
        margin: 50px auto;
        background-color: #1c1c1c;
        color: wheat;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .container h2 {
        margin-bottom: 20px;
        text-align: center;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .form-group input {
        width: 95%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: transparent;
        color: antiquewhite;
    }

    .form-group button {
        width: 100%;
        padding: 10px;
        background-color: pink;
        border: none;
        color: black;
        border-radius: 4px;
        cursor: pointer;
    }

    .form-group button:hover {
        background-color: #0056b3;
    }

    .form-group a {
        display: block;
        text-align: center;
        margin-top: 10px;
        color: pink;
        text-decoration: none;
    }

    .form-group a:hover {
        text-decoration: underline;
    }
</style>
</head>

<body>
    <div class="container">
        <h2>Sign Up</h2>
        <form action="" method="POST" id="signupForm">
            <div class="form-group">
                <label for="uname">Username</label>
                <input type="text" name="uname" id="uname" required>
            </div>
            <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" name="pass" id="pass" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Sign Up</button>
            </div>
        </form>
        <div class="form-group">
            <a href="./login.php">Already have an account? Log in</a>
        </div>
    </div>
</body>

</html>