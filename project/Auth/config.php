<?php  declare(strict_types=1); 

    session_start();

    $conn = mysqli_connect("localhost","root","","saint_anne");

    if(!$conn){
        echo "Not connected!";
    }

    if(!isset($_SESSION['uid'])){
        header("Location: ./Auth/login.php ");
    }

?>