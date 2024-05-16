<?php declare(strict_types=1); 
include_once "./Auth/config.php";

if (!isset($_GET['id'])) {
    header("Location: ./imports.php");
}

$id = $_GET['id'];
$sql = mysqli_query($conn, "SELECT * FROM stock_in INNER JOIN products ON stock_in.pid = products.pid WHERE stock_in.pid = '{$id}'");

if ($sql) {
    $fetch = mysqli_fetch_assoc($sql);


    $pname = isset($fetch['pname']) ? $fetch['pname'] : '';
    $powner = isset($fetch['powner']) ? $fetch['powner'] : '';
    $price_per_unit = $fetch['Unit_Price1'];
    $quantity = $fetch['quantity'];
    $date = isset($fetch['date']) ? $fetch['date'] : '';

    $form = '<form action="" method="POST">
                <div class="form-group">
                    <label for="pname">Product Name</label>
                    <input type="text" name="pname" value="' . $pname . '" disabled>
                </div>
                <div class="form-group">
                    <label for="powner">Product Owner</label>
                    <input type="text" name="powner" value="' . $powner . '" disabled>
                </div>
                <div class="form-group">
                    <label for="Unit_Price">Price Per Unit</label>
                    <input type="text" name="Unit_Price1" value="' . $price_per_unit . '" disabled required>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="text" name="quantity" value="' . $quantity . '" required>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" name="date" value="' . $date . '" required>
                </div>
                <button type="submit" name="submit">Export</button>
            </form>';

    if (isset($_POST['submit'])) {

        $quantity =  $_POST['quantity'];
        $date =  $_POST['date'];
        $price_per_unit = $_POST['Unit_Price'];
        $total_price = isset($price_per_unit) && isset($quantity) ? $price_per_unit * $quantity : 0;

        $check = mysqli_query($conn, "SELECT * FROM stock_out WHERE pid = '{$id}'");
        if (mysqli_num_rows($check) > 0) {
            $fetch = mysqli_fetch_assoc($check);
            $new_quantity = $fetch['quantity'] - $quantity;
            $new_total_price = $fetch['total_price'] - $total_price;

            $update_sql = mysqli_query($conn, "UPDATE stock_out SET quantity = '{$new_quantity}', Unit_Price = '{$price_per_unit}', total_price = '{$new_total_price}', `date`='{$date}' WHERE `stock_out_id` = '{$id}'");
            if ($update_sql) {
                echo "Data Exported successfully! <a href='./exports.php'>View Exports</a>";
                header("location:./exports.php");
            } else {
                echo "Error updating stock_out table: " . mysqli_error($conn);
            }
        } else {

            $insert_sql = mysqli_query($conn, "INSERT INTO stock_out(pid, quantity, Unit_Price, total_price, `date`) VALUES ('{$id}', '{$quantity}', '{$price_per_unit}', '{$total_price}', '{$date}')");
            if ($insert_sql) {
                echo "Data Exported successfully! <a href='./exports.php'>View Exports</a>";
                header("location:exports.php");
            } else {
                echo "Error inserting data into stock_out table: " . mysqli_error($conn);
            }
        }
    }
} else {
    echo "Error fetching data: " . mysqli_error($conn);
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1c1c1c;
            margin: 0;
            padding: 0;
        }

        form{
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

        h1 {
            margin-bottom: 20px;
            text-align: center;
            background-color: gray;
            color: wheat;
            margin-bottom: 20px;
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

        button {
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
</head>

<body>
    <h1>Export</h1>
    <form action="" method="POST">
        <?php echo isset($form) ? $form : ''; ?>
    </form>
</body>

</html>