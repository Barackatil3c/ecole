<?php 

include_once "./Auth/config.php";

if(!isset($_GET['id'])){
    header("Location: ./index.php");
}
$id = $_GET['id'];

$sql = mysqli_query($conn, " DELETE FROM stock_in WHERE pid = '{$id}' " );
if($sql == true){
   echo " Record Deleted!";
   header("Location: ./imports.php");
}else{
    echo " Not Deleted! ";
}


?>