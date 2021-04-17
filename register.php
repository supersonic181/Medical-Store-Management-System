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

if ( !isset($_POST['username'], $_POST['emailid'], $_POST['password']) ){
    exit('Please fill both the username and password fields!');
}
$stmt = $con->prepare('INSERT INTO customers(username,password,email) VALUES(?,?,?)');
if ($stmt) {
    $stmt->bind_param('sss',$_POST['username'],$_POST['password'],$_POST['emailid']);
    $stmt->execute();
    if($stmt->affected_rows > 0) {
        echo "Registration Successful";
        header('Location: index.html'); 
    } else {
        echo 'incorrent username';
    }
    $stmt->close();
} else {
    echo $con->error ;
}
?>