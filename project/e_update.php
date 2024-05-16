<?php declare(strict_types=1); 


include_once "./Auth/config.php";

if (!isset($_GET['id'])) {
    header("Location: ./imports.php");
}
$id = $_GET['id'];

$sql = mysqli_query($conn, " SELECT * FROM stock_out INNER JOIN products ON stock_out.pid = products.pid WHERE stock_out_id = '{$id}' ");
if ($sql == true) {
    $fetch = mysqli_fetch_assoc($sql);
    $form = '<form action="" method="POST">
                <div>
                    <label for="pname">Product Name</label>
                    <input type="text" name="pname" value="' . $fetch['pname'] . '" disabled >
                </div>
                <div>
                    <label for="powner">Product Owner</label>
                    <input type="text" name="powner" value="' . $fetch['powner'] . '" disabled >
                </div>
                <div>
                    <label for="pass">Quantity</label>
                    <input type="text" name="quantity" value="' . $fetch['quantity'] . '" >
                </div>
                <div>
                    <label for="pass">Price Per Unit</label>
                    <input type="text" name="Unit_Price" value="' . $fetch['Unit_Price'] . '"  >
                    </div>
                <div>
                <label for="pass">Date</label>
                <input type="date" name="date" value="' . $fetch['date'] . '" >
            </div>
                <button type="submit" name="submit">Update</button>
            </form>';
}

if (isset($_POST['submit'])) {
    $quantity = $_POST['quantity'];
    $price_per_unit = $_POST['Unit_Price'];
    $date = $_POST['date'];
    $total_price = $quantity * $price_per_unit;

    $sql = mysqli_query($conn, " UPDATE stock_out SET Unit_Price = '{$price_per_unit}', total_price = '{$total_price}', `date` = '{$date}', quantity= '{$quantity}'  WHERE stock_out_id = '{$id}' ");
    if ($sql == true) {
        echo " Record Updated! <a href='./imports.php'>View Imports</a> ";
    } else {
        echo "Not Updated!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Update</title>
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

         label {
            display: block;
            margin-bottom: 5px;
        }

        input {
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
    <h1>Update Stock Out</h1>
    <form action="" method="POST">
        <?php echo $form; ?>
    </form>
</body>

</html>
