<?php  declare(strict_types=1); 

include_once "./Auth/config.php";

$id = $_GET['id'];

$sql = mysqli_query($conn, " SELECT * FROM products WHERE pid = '{$id}' " );

if($sql == true){
    $fetch = mysqli_fetch_assoc($sql);
    $form = '<form action="" method="POST">
                    <div>
                        <label for="uname">Product Name</label></br>
                        <input type="text" name="pname" value="'.$fetch['pname'].'" ></br>
                    </div>
                    <div>
                        <label for="pass">Product Brand/Type</label></br>
                        <input type="text" name="powner" value="'.$fetch['powner'].'" ></br>
                    </div>
                    <button type="submit" name="submit">Update</button>
                </form>';

}else{
    echo "Not selected!";
}

if(isset($_POST['submit'])){
    $pname = $_POST['pname'];
    $powner = $_POST['powner'];

    $sql = mysqli_query($conn, " UPDATE products SET pname = '{$pname}', powner = '{$powner}' WHERE pid = '{$id}' " );
    if($sql == true){
        header("location:./index.php");
    }else{
        echo "Not updated!";
    }

}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATE PRODUCT</title>
</head>
<style>
    body {
  font-family: Arial, sans-serif;
  background-color: #000;
}

header {
  background-color: pink;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 20px;
  text-align: center;
}

header h1 {
  margin: 0;
}

header a {
  color: white;
  text-decoration: none;
  margin-left: 20px;
}

main {
  padding: 20px;
}

form {
  max-width: 300px;
  margin: 40px auto;
  padding: 20px;
  border: 1px solid #ddd;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  border-radius: 7px;
  color: wheat;
  background-color: #222222;
}

label {
  display: block;
  margin-bottom: 10px;
}

input[type="text"] {
  width: 280px;
  height: 30px;
  margin-bottom: 20px;
  background-color: transparent;
  padding: 10px;
  color: wheat;
  border: 1px solid #ccc;
  border-radius: 40px;
}

.btn {
  background-color: pink;
  color: #878;
  padding: 10px 20px;
  border: none;
  border-radius: 54px;
  cursor: pointer;
  font-size: 16px;
}

.btn:hover {
  background-color: #3e8e41;
}

.btn:active {
  background-color: #2e6c31;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

label,
input[type="text"],
.btn {
  font-size: 16px;
}
.links {
  color: #007bff;
  text-decoration: none;
  transition: color 0.2s ease;
}

.links:hover {
  color: #005bff;
}
</style>
<body>

    <?php echo $form; ?>

</body>
</html>