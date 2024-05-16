<?php declare(strict_types=1); 

include_once "./Auth/config.php";

$sql = mysqli_query($conn, "SELECT *, stock_in.quantity AS p_in_quantity, 
                                   stock_out.quantity AS p_out_quantity, 
                                   stock_out.total_price AS p_out_total_price, 
                                   stock_in.total_price AS p_in_total_price, 
                                   stock_out.date AS p_out_date, 
                                   stock_in.date AS p_in_date FROM products
                                  INNER JOIN stock_in ON products.pid = stock_in.pid
                                  INNER JOIN stock_out ON products.pid = stock_out.pid ");

$form = '';

if ($sql) {
    $num_rows = mysqli_num_rows($sql);
    if ($num_rows > 0) {
        $a = 0;
        while ($fetch = mysqli_fetch_assoc($sql)) {
            $a++;
            $form .= ' <tr>
                        <td>' . $a . '</td>
                        <td>' . $fetch['pname'] . '</td>
                        <td>' . $fetch['powner'] . '</td>
                        <td>' . $fetch['p_in_quantity'] . '</td>
                        <td>' . $fetch['p_out_quantity'] . '</td>
                        <td>' . $fetch['p_in_total_price'] . '</td>
                        <td>' . $fetch['p_out_total_price'] . '</td>
                        <td>' . $fetch['p_in_date'] . '</td>
                        <td>' . $fetch['p_out_date'] . '</td>
                    </tr>';
        }
    } else {
        $form .= '<tr> <td colspan="9"> No records found! </td> </tr>';
    }
} else {
    $form .= '<tr> <td colspan="9"> Error fetching data! </td> </tr>';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
</head>
<style>
        /* General Styles */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            margin: 0;
            padding: 0;
            background-color: #222222;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            
        }

        h1,
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: grey;
            background-color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
            color: gray;
        }

        th {
            background-color: pink;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f2f2f2;
            color:gray;
        }

        .print-btn {
            display: block;
            width: 100px;
            margin: 0 auto;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: #fff;
            border-radius: 4px;
            text-align: center;
            cursor: pointer;
        }

        .print-btn:hover {
            background-color: #0056b3;
        }

.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: auto;
    height: 100%;
    background-color: black;
    color: pink;
    border-right: 1px solid #ccc;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 80px;
    border-color:  transparent;
    box-shadow: 5px 18px 20px 0px rgb(69 78 64);
}


        .navbar h1 {
            margin: 0;
            font-size: 24px;
            color: wheat;
            font-weight: bold;
            font-family: 'Billabong', sans-serif;
        }

        .navbar a {
            display: block;
            width: 60px;
            height: 60px;
            margin-bottom: 15px; 
            text-decoration: none;
            color: pink;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: background-color 0.3s ease;
            border-radius: 50%;
        }

        .navbar a i {
            font-size: 17px;
        }

        .navbar a:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }

        /* Content Styles */
        .content {
            margin-left: 80px;
            padding: 60px;
        }
    </style>
</head>

<body>
    <a href="./index.php">Back Home</a>
    <h1>STORE Report</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Product Name</th>
                <th>Product Owner</th>
                <th>Import Quantity</th>
                <th>Export Quantity</th>
                <th>TP Import</th>
                <th>TP Export</th>
                <th>Import Date</th>
                <th>Export Date</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $form; ?>
            <tr>
                <td>Total:</td>
                <td colspan="8"><?php echo $num_rows; ?></td>
            </tr>
        </tbody>
    </table>
    <button class="print-btn" onclick="printReport()">Print the Report</button>

    <script>
        function printReport() {
            window.print();
        }
    </script>
</body>

</html>