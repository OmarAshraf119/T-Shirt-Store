<?php
$servername = "localhost";
$username = "root";
$password = "";
// Create connection

$conn = mysqli_connect($servername, $username, $password,"store");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['email'])) { 
	    $email = $_POST["email"];
	    $pass = $_POST["psw"];
	    $sql = "SELECT * FROM users WHERE (UPASS = '$pass' AND UEMAIL = '$email')";
		$result = mysqli_query($conn, $sql);
}
		if (mysqli_num_rows($result) > 0) {
			// output data of each row
            if(!isset($_SESSION)) 
            { 
                session_start(); 
            }             
			$row = mysqli_fetch_assoc($result);
            $_SESSION["UFNAME"] = $row["UFNAME"];
            $_SESSION["UID"] = $row["UID"];
            $_SESSION["ULNAME"] = $row["ULNAME"];
            $_SESSION["UEMAIL"] = $row["UEMAIL"];
            $_SESSION["UPASS"] = $row["UPASS"];
            include "page1.php";
        } 
        else {
			echo "<script> alert('Wrong Email or Password');</script>";
            include "signin.html";
		}

		mysqli_close($conn);
  
?>