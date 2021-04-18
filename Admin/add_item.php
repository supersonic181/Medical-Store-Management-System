<?php
session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '12345';
$DATABASE_NAME = 'medical';

$con = mysqli_connect($DATABASE_HOST,$DATABASE_USER,$DATABASE_PASS,$DATABASE_NAME);
if (mysqli_connect_errno() ) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
if ($stmt = $con->prepare('SELECT * FROM meds WHERE id=?')) {
    $stmt->bind_param('i',$_POST['product_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    if($result->num_rows == 0){
        echo "No Product found with given Product ID";
        exit();
    }
    if($_POST['quantity'] > $product['quantity']){
        echo "Quantity requested higher than in stock";
        exit();
    }

    $total_price = $_POST['quantity'] * $product['price'];
}

$stmt = $con->prepare('INSERT INTO orders(name,quantity,price) VALUES(?,?,?)');
if ($stmt) {
    $stmt->bind_param('sii',$_POST['product_name'],$_POST['quantity'],$_POST['price'],$total_price);
    $stmt->execute();
    if($con->affected_rows === 0){
        echo "Order Unsucceful, Please try again!";
    }
    header('Location: view_order.php');
    $stmt->close();
} else {
    echo $con->error;
}
?>