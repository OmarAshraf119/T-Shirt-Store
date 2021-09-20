<?php
$conn = mysqli_connect("localhost", "root", "") 
  or die ("Connection error.");

$conn->select_db("store");
$firstname = $_POST['FirstName'];
$lastname = $_POST['LastName'];
$email = $_POST['email'];
$psw = $_POST['psw'];
$query = "SELECT * FROM users WHERE(UEMAIL = '$email')";
$results = mysqli_query($conn,$query) or (mysqli_error($conn));
$rows = mysqli_num_rows($results);

if ($rows < 1) {
  //assign new custnum
  $query2 = "INSERT INTO users (
             UFNAME, ULNAME, UEMAIL, UPASS)
             VALUES (
            '$firstname',
            '$lastname',
            '$email',
            '$psw'
           )";
  $insert = mysqli_query($conn,$query2)
    or die(mysqli_error($conn));
  //$custid = mysqli_insert_id($conn);
   
    echo "<script> alert('Email Added');</script>";
    include "page1.php"; 
}    
else{
    echo "<script> alert('This Email Already Exists');</script>";
    include "Signup.html";
}
?>