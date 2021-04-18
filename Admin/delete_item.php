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
$stmt = $con->prepare('DELETE FROM meds WHERE id=?');
if ($stmt) {
    $stmt->bind_param('i',$_POST['id']);
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