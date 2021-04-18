<?php
session_start();
if(!isset($_SESSION['loggedin'])){
    header('Location: index.html');
    exit;
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '12345';
$DATABASE_NAME = 'medical';

$con = mysqli_connect($DATABASE_HOST,$DATABASE_USER,$DATABASE_PASS,$DATABASE_NAME);
if (mysqli_connect_errno() ) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$stmt = $con->prepare('SELECT id,product_name,quantity,total_price from orders WHERE user_id = ?');
$stmt->bind_param('i',$_SESSION['id']);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
?>


<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="UTF-8">
    <title>Meds Details</title>  
</head>
  
<body>
    <section>
        <h1>Order Details</h1>
        <a href="home.php">Home</a>
        <table>
            <tr>
                <th>Id</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price(Rs.)</th>
            </tr>
            <?php   // LOOP TILL END OF DATA 
                while($rows=$result->fetch_assoc())
                {
             ?>
            <tr>
                <!--FETCHING DATA FROM EACH 
                    ROW OF EVERY COLUMN-->
                <td><?php echo $rows['id'];?></td>
                <td><?php echo $rows['product_name'];?></td>
                <td><?php echo $rows['quantity'];?></td>
                <td><?php echo $rows['total_price'];?></td>
            </tr>
            <?php
                }
             ?>
        </table>
    </section>
</body>
  
</html>