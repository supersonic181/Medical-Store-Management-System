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
if($_POST['quantity'] < 0 || $_POST['price'] < 0){
    echo "Quantity or Price can't be negative";
    exit();
}
$stmt = $con->prepare('UPDATE meds SET name=?,quantity=?,price=? WHERE id=?');
if ($stmt) {
    $stmt->bind_param('siii',$_POST['product_name'],$_POST['quantity'],$_POST['price'],$_POST['id']);
    $stmt->execute();
    if($con->affected_rows === 0){
        echo "Order Unsucceful, Please try again!";
    }
    else{ 
        header('Location: inventory.php'); 
    }
    $stmt->close();
} else {
    echo $con->error;
}
?>