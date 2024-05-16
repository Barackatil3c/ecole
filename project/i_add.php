<?php  declare(strict_types=1); 


include_once "./Auth/config.php";

$id = $_GET['id'];
$sql = mysqli_query($conn, " SELECT * FROM products WHERE pid = '{$id}' " );

if($sql == true){
    $fetch = mysqli_fetch_assoc($sql);

    $form = '<form action="" method="POST">
                <div>
                    <label for="uname">Product Name</label>
                    <input type="text" name="pname" value="'.$fetch['pname'].'" disabled >
                </div>
                <div>
                    <label for="pass">Product Brand/Type</label>
                    <input type="text" name="powner" value="'.$fetch['powner'].'" disabled >
                </div>
                <div>
                    <label for="pass">Quantity</label>
                    <input type="text" name="quantity" >
                </div>
                <div>
                    <label for="pass">Price Per Unit</label>
                    <input type="text" name="Unit_Price1" >
                </div>
                <div>
                <label for="pass">Date</label>
                <input type="date" name="date" >
            </div>
                <button type="submit" name="submit">Import</button>
            </form>';

}

if(isset($_POST['submit'])){
    $quantity = $_POST['quantity'];
    $price_per_unit = $_POST['Unit_Price1'];
    $date = $_POST['date'];
    $total_price = $quantity * $price_per_unit;

    $check = mysqli_query($conn, " SELECT * FROM stock_in WHERE pid = '{$id}'  " );
    if(mysqli_num_rows($check) > 0){
        $fetch = mysqli_fetch_assoc($check);
        $new_quantity = $fetch['quantity'] + $quantity;
        $new_total_price= $fetch['Total_Price'] + $total_price;

        $sql = mysqli_query($conn, " UPDATE stock_in SET quantity = '{$new_quantity}', total_price ='{$new_total_price}', `date` = '{$date}',Unit_Price1 = '{$price_per_unit}' WHERE pid = '{$id}' " );
        if($sql == true){
            header("location:./imports.php");
        }else{
            echo "Record not updated";
        }
    }else{
        $sql = mysqli_query($conn, " INSERT INTO stock_in(pid,quantity, Unit_Price1, `date`, total_price) VALUES('{$id}','{$quantity}','{$price_per_unit}','{$date}','{$total_price}')  " );
        if($sql == true){
            echo " Record Added! <a href='./imports.php'>View Imports</a> ";
        }else{
            echo "Not Added!";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Product</title>
</head>
<style>
    
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #222222;
    color: #333;
}

.container {
    max-width: 960px;
    margin: 20px auto;
    padding: 20px;
    background-color: #000;
    box-shadow: 0px 106px 42px rgba(0, 0, 0, 0.01),
    0px 59px 36px rgba(0, 0, 0, 0.05), 0px 26px 26px rgba(0, 0, 0, 0.09),
    0px 7px 15px rgba(0, 0, 0, 0.1), 0px 0px 0px rgba(0, 0, 0, 0.1);
    }


h1, h2, h3 {
    margin-bottom: 10px;
}


form {
  max-width: 350px;
  margin: 40px auto;
  padding: 20px;
  color: wheat;
  background-color: #1c1c1c;
  border: 1px solid #ddd;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  border-radius: 7px;
}

label {
    margin-bottom: 5px;
}

input[type="text"],
input[type="number"],
input[type="date"] {
    width: 95%;
    padding: 8px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: transparent;
    color: white;
}

button[type="submit"] {
    padding: 10px 20px;
    background-color: pink;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

.success-message {
    color: #28a745;
    margin-top: 10px;
}

.error-message {
    color: #dc3545;
    margin-top: 10px;
}

/* Responsive styles */
@media (max-width: 768px) {
    .container {
        padding: 10px;
    }

    form {
        max-width: 100%;
    }
}

</style>
<body>
    <a href="index.php">Back Home</a>
    <?php echo $form; ?>
</body>
</html>