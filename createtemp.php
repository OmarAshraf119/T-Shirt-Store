<?php 
//connect to the database
$conn = mysqli_connect("localhost", "root", "") 
  or die ("Connection error.");

$conn->select_db("store");

//Define the temp table
$query = "CREATE TABLE carttemp(
          carttemp_hidden INT(10) NOT NULL AUTO_INCREMENT,
          carttemp_sess CHAR(50) NOT NULL,
          carttemp_prodnum CHAR(5) NOT NULL,
          carttemp_quan INT(3) NOT NULL,
          PRIMARY KEY (carttemp_hidden),
          KEY(carttemp_sess))";

$temp = mysqli_query($conn,$query)
  or die(mysqli_error($conn));
echo "Temporary cart table created successfully!";
?>
