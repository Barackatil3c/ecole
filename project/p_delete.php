<?php 

include_once "./Auth/config.php";

if(!isset($_GET['id'])){
    header("Location: ./index.php");
}
$id = $_GET['id'];

$sql = mysqli_query($conn, " DELETE FROM stock_in WHERE pid = '{$id}' " );
if($sql == true){
    $sql = mysqli_query($conn, " DELETE FROM stock_out WHERE pid = '{$id}' " );
    if($sql == true){
        $sql = mysqli_query($conn, "DELETE FROM products WHERE pid = '{$id}' " );
        if($sql == true){
            header("Location: ./index.php");
        }
    }else{
        $sql = mysqli_query($conn, "DELETE FROM products WHERE pid = '{$id}' " );
        if($sql == true){
            header("Location: ./index.php");
        }
    }
    
}else{
    $sql = mysqli_query($conn, "DELETE FROM products WHERE pid = '{$id}' " );
        if($sql == true){
            header("Location: ./index.php");
        }
}


?>