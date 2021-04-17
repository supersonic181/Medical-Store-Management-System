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

$stmt = $con->prepare('SELECT orders.id,meds.name,orders.quantity,orders.price FROM orders LEFT JOIN meds ON orders.product_id = meds.id AND orders.user_id = ?');
$stmt->bind_param('i',$_SESSION['id']);
$stmt->execute();
$stmt->bind_result($id, $name, $quantity, $price);
$stmt->fetch();
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
        <table>
            <tr>
                <th>Id</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price(Rs.)</th>
            </tr>
            <tr>
                <td><?=$id?></td>
                <td><?=$name?></td>
                <td><?=$quantity?></td>
                <td><?=$price?></td>
            </tr>
        </table>
    </section>
</body>
  
</html>