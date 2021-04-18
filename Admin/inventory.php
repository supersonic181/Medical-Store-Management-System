<?php
  
$user = 'root';
$password = '12345'; 
$database = 'medical'; 
$servername='localhost';

$mysqli = new mysqli($servername, $user, 
                $password, $database);
  
if ($mysqli->connect_error) {
    die('Connect Error (' . 
    $mysqli->connect_errno . ') '. 
    $mysqli->connect_error);
}
  
$sql = "SELECT * FROM meds ORDER BY id DESC ";
$result = $mysqli->query($sql);
$mysqli->close(); 
?>


<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="UTF-8">
    <title>Meds Details</title>  
</head>
  
<body>
    <section>
        <h1>Meds Details</h1>
        <a href="home.php">Home</a>
        <form action="add_item.php" method="POST">
            <br><br>
            <label for="product_id_input">Product Name: </label>
            <input type="text" name="product_name" id="product_name_input" required>
            <br>
            <label for="quantity_input">Quantity: </label>
            <input type="number" name="quantity" id="quantity_input" required>
            <br>
            <label for="quantity_input">Price: </label>
            <input type="number" name="price" id="price_input" required>
            <br><br>
            <button type="submit">Add Item</button>
        </form>
        <br>
        <table>
            <tr>
                <th>Product Id</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS-->
            <?php   // LOOP TILL END OF DATA 
                while($rows=$result->fetch_assoc())
                {
             ?>
            <tr>
                <!--FETCHING DATA FROM EACH 
                    ROW OF EVERY COLUMN-->
                <td><?php echo $rows['id'];?></td>
                <td><?php echo $rows['name'];?></td>
                <td><?php echo $rows['quantity'];?></td>
                <td><?php echo $rows['price'];?></td>
            </tr>
            <?php
                }
             ?>
        </table> 
    </section>
</body>
  
</html>