<?php
  
$user = 'root';
$password = '12345'; 
  
// Database name is gfg
$database = 'login'; 
  
// Server is localhost with
// port number 3308
$servername='localhost';
$mysqli = new mysqli($servername, $user, 
                $password, $database);
  
// Checking for connections
if ($mysqli->connect_error) {
    die('Connect Error (' . 
    $mysqli->connect_errno . ') '. 
    $mysqli->connect_error);
}
  
// SQL query to select data from database
$sql = "SELECT * FROM meds ORDER BY id DESC ";
$result = $mysqli->query($sql);
$mysqli->close(); 
?>
// HTML code to display data in tabular format
<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="UTF-8">
    <title>Meds Details</title>  
</head>
  
<body>
    <section>
        <h1>Meds Details</h1>
        <!-- TABLE CONSTRUCTION-->
        <table>
            <tr>
                <th>SlNO</th>
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