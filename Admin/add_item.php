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

$stmt = $con->prepare('INSERT INTO meds(name,quantity,price) VALUES(?,?,?)');
if ($stmt) {
    $stmt->bind_param('sii',$_POST['product_name'],$_POST['quantity'],$_POST['price']);
    $stmt->execute();
    if($con->affected_rows === 0){
        echo "Order Unsucceful, Please try again!";
    }
    if($con->errno == 1062){
        echo "Product with same name already exists";
    }
    else{ header('Location: inventory.php'); }
    $stmt->close();
} else {
    echo $con->error;
}
?>