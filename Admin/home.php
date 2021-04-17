<?php
session_start();

if(!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Admin Panel</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="view_order.php"><i class="fas fa-user-circle"></i>view order</a>
				<a href="product.php"><i class="fas fa-user-circle"></i>Products</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Home Page</h2>
			<p>Welcome back, <?=$_SESSION['name']?>!</p>
		</div>
	</body>
</html>
