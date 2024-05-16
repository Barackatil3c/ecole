<?php declare(strict_types=1); 
include "./Auth/config.php";

$sql = mysqli_query($conn, " SELECT * FROM products ");
$tbody = '';
if ($sql ==  true) {
    $num_rows = mysqli_num_rows($sql);

    if ($num_rows > 0) {
        $a = 0;
        while ($fetch = mysqli_fetch_assoc($sql)) {
            $a++;
            $tbody .= '<tr>
                            <td>' . $a . '</td>
                            <td>' . $fetch['pname'] . '</td>
                            <td>' . $fetch['powner'] . '</td>
                            <td><a href="./p_update.php?id=' . $fetch['pid'] . '">Update</a></td>
                            <td><a href="./p_delete.php?id=' . $fetch['pid'] . '">Delete</a></td>
                            <td><a href="./i_add.php?id=' . $fetch['pid'] . '">Import</a></td>
                        </tr>';
        }
    } else {
        $tbody .= '<tr> <td> No Products </td> </tr>';
    }
} else {
    echo " Not selected ";
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Page</title>
    <!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

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
            color: white;
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

<body>

    <!-- Navbar -->
    <div class="navbar">
        <h1>WELCOME</h1>
        <a href="./index.php"><i class="fas fa-home">Home</i></a>
        <a href="./imports.php"><i class="fas fa-box-open">Stockin</i></a>
        <a href="./exports.php"><i class="fas fa-file-import">Stockout</i></a>
        <a href="./report.php"><i class="far fa-chart-bar">Report</i></a>
        <a href="./Auth/logout.php"><i class="fas fa-door-open">Logout</i></a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <header>
            <h1>ECOLE PRIMAIRE SAINT ANNE</h1>
        </header>

        <h2>List of Products and its Brand</h2>
        <a href="./p_add.php">Add</a>
        <table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Product Name</th>
                    <th>Product Brand</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $tbody; ?>
            </tbody>
        </table>
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</body>

</html>
