<?php  declare(strict_types=1); 

    session_start();
    $conn = mysqli_connect("localhost","root","","saint_anne");

    if(!$conn){
        echo "Not connected!";
    }

    if(isset($_SESSION['uid'])){
        header("Location: ../index.php ");
    }


    if(isset($_POST['submit'])){
        $uname =  $_POST['uname'];
        $pass =  $_POST['pass'];

        $check = mysqli_query($conn, " SELECT * FROM users WHERE uname = '{$uname}' AND `pass` = '{$pass}' " );
        if(mysqli_num_rows($check) == 1){
            $fetch = mysqli_fetch_assoc($check);
            $_SESSION['uid'] = $fetch['uid'];
            header("Location: ../index.php");
        }else{
            echo "Username or password is incorrect!";
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1c1c1c;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #000;
            color: wheat;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 106px 42px rgba(0, 0, 0, 0.01),
            0px 59px 36px rgba(0, 0, 0, 0.05), 0px 26px 26px rgba(0, 0, 0, 0.09),
            0px 7px 15px rgba(0, 0, 0, 0.1), 0px 0px 0px rgba(0, 0, 0, 0.1);
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
            color: black;
            border: none;
            background-color: pink;
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
        #showPass{
            position: absolute;
            right: 85px;
            bottom: -1px;
            background-color: black;
        }
    </style>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="" method="POST" id="loginForm">
            <div class="form-group">
                <label for="uname">Username</label>
                <input type="text" name="uname" id="uname" required>
            </div>
            <div class="form-group">
                <label for="pass">Password</label>
                <div style="position: relative;">
                    <input type="password" name="pass" id="pass" required>
                    <label for="showPass">Show Password</label>
                    <input type="checkbox" id="showPass" onchange="togglePassword()">
                </div>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Login</button>
            </div>
        </form>
        <div class="form-group">
            <a href="./signup.php">Don't have an account? Sign up</a>
        </div>
    </div>

    <script>
        function togglePassword() {
            var passField = document.getElementById("pass");
            var showPassCheckbox = document.getElementById("showPass");

            if (showPassCheckbox.checked) {
                passField.type = "text";
            } else {
                passField.type = "password";
            }
        }
    </script>
</body>
</html>