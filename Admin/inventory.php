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
    <style>
        .Form_Container {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }
    </style>
</head>
  
<body>
    <section>
        <h1>Meds Details</h1>
        <a href="home.php">Home</a>
        <div class="Form_Container">
            <form action="add_item.php" method="POST">
                <h3>Add Item</h3>
                <br>
                <label for="product_name">Product Name: </label>
                <input type="text" name="product_name" id="product_name_input" required>
                <br>
                <label for="quantity_input">Quantity: </label>
                <input type="number" name="quantity" id="quantity_input" required>
                <br>
                <label for="price_input">Price: </label>
                <input type="number" name="price" id="price_input" required>
                <br><br>
                <button type="submit">Add Item</button>
            </form>
            <form action="update_item.php" method="POST">
                <h3>Update Item</h3>
                <br>
                <label for="product_id">Product Id: </label>
                <input type="number" name="id" id="product_id" required>
                <br>
                <label for="product_name">Product Name: </label>
                <input type="text" name="product_name" id="product_name_input" required>
                <br>
                <label for="quantity_input">Quantity: </label>
                <input type="number" name="quantity" id="quantity_input" required>
                <br>
                <label for="price_input">Price: </label>
                <input type="number" name="price" id="price_input" required>
                <br><br>
                <button type="submit">Update Item</button>
            </form>
            <form action="delete_item.php" method="POST">
                <h3>Delete Item</h3>
                <br>
                <label for="quantity_input">Product ID: </label>
                <input type="number" name="price" id="price_input" required>
                <br><br>
                <button type="submit">Delete Item</button>
            </form>
        </div>
        <br>
        <table>
            <tr>
                <th>Product Id</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
            <?php   // LOOP TILL END OF DATA 
                while($rows=$result->fetch_assoc())
                {
             ?>
            <tr>
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