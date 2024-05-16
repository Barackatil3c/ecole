<?php  declare(strict_types=1); 

include_once "./Auth/config.php";


if(isset($_POST['submit'])){
    $pname = $_POST['pname'];
    $powner = $_POST['powner'];

    $sql = mysqli_query($conn, " INSERT INTO products(pname, powner) VALUES('{$pname}','{$powner}') " );
    if($sql == true){
    header("location:./index.php");
    }else{
        echo "Not INsterted";
    }


}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD PRODUCT</title>
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
    <header>
        Add Product here
    </header><br>
    <a href="./index.php" class="links">< Back</a>
    <form action="" method="POST">
        <div>
            <label for="uname">Product Name</label>
            <input type="text" name="pname" >
        </div>
        <div>
            <label for="pass">Product Brand/Type</label>
            <input type="text" name="powner" >
        </div>
        <button type="submit" class="btn" name="submit">Add</button>
    </form>

</body>
</html>