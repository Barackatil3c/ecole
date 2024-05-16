<?php  declare(strict_types=1); 


include "./Auth/config.php";

if(!isset($_GET['id'])){
    header("Location: ./imports.php");
}
$id = $_GET['id'];
 
$sql = mysqli_query($conn, " SELECT * FROM stock_in INNER JOIN products ON stock_in.pid = products.pid WHERE stock_in_id = '{$id}' " );
if($sql == true){
    $fetch = mysqli_fetch_assoc($sql);
    $form = '<form action="" method="POST">
                <div>
                    <label for="uname">Product Name</label>
                    <input type="text" name="pname" value="'.$fetch['pname'].'" disabled >
                </div>
                <div>
                    <label for="pass">Product Brand </label>
                    <input type="text" name="powner" value="'.$fetch['powner'].'" disabled >
                </div>
                <div>
                    <label for="pass">Quantity</label>
                    <input type="text" name="quantity" value="'.$fetch['quantity'].'" >
                </div>
                <div>
                    <label for="pass">Price Per Unit</label>
                    <input type="text" name="Unit_Price1" value="'.$fetch['Unit_Price1'].'"  >
                </div>
                <div>
                <label for="pass">Date</label>
                <input type="date" name="date" value="'.$fetch['date'].'" >
            </div>
                <button type="submit" name="submit">Update</button>
            </form>';
}

if(isset($_POST['submit'])){
    $quantity = $_POST['quantity'];
    $price_per_unit = $_POST['Unit_Price1'];
    $date = $_POST['date'];
    $total_price = $quantity * $price_per_unit;

    $sql = mysqli_query($conn, " UPDATE stock_in SET Unit_Price1 = '{$price_per_unit}', total_price = '{$total_price}', `date` = '{$date}', quantity= '{$quantity}'  WHERE pid = '{$id}' " );
    if($sql == true){
        echo " Record Updated! <a href='./imports.php'>View Imports</a> ";
    }else{
        echo "Not Updated!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Update</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: pink;
            margin: 0;
            padding: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #1c1c1c;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            color: wheat;

        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: transparent;
            color: wheat;
        }

        button {
            background-color: grey;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: pink;
            color: black;
        }
    </style>
</head>
<body>
    <form action="" method="POST">
        <h1>Update Stock In</h1>
        <?php echo $form; ?>
    </form>
</body>
</html>
