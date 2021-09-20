<?php 
if (!session_id()) {
  session_start();
}
//connect to the database
$conn = mysqli_connect("localhost", "root", "") 
  or die ("Connection error.");
$conn->select_db("store");

//Let's make the variables easy to access in our queries
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$add1 = $_POST['add1'];
$add2 = $_POST['add2'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$shipfirst = $_POST['shipfirst'];
$shiplast = $_POST['shiplast'];
$shipadd1 = $_POST['shipadd1'];
$shipadd2 = $_POST['shipadd2'];
$shipcity = $_POST['shipcity'];
$shipstate = $_POST['shipstate'];
$shipzip = $_POST['shipzip'];
$shipstate = $_POST['shipstate'];
$shipphone = $_POST['shipphone'];
$shipemail = $_POST['shipemail'];
$total = $_POST['total'];
$sessid = session_id();
$today = date("Y-m-d");

//1) Assign Customer Number to new Customer, or find existing customer number
$query = "SELECT * FROM customers WHERE
          (CFNAME = '$firstname' AND
           CLNAME = '$lastname' AND
           CADD1 = '$add1' AND
           CADD2 = '$add2' AND
           CCITY = '$city')";
$results = mysqli_query($conn,$query)
  or (mysqli_error($conn));
$rows = mysqli_num_rows($results);

if ($rows < 1) {
  //assign new custnum
  $query2 = "INSERT INTO customers (
             CFNAME, CLNAME, CADD1,
             CADD2, CCITY, CSTATE, 
             CZIP, CPHONE, 
             CEMAIL)
             VALUES (
            '$firstname',
            '$lastname',
            '$add1',
            '$add2',
            '$city',
            '$state',
            '$zip',
            '$phone',
            '$email')";
  $insert = mysqli_query($conn,$query2)
    or (mysqli_error($conn));
  $custid = mysqli_insert_id($conn);
}
//If custid exists, we want to make it equal to custnum
//Otherwise we will use the existing custnum
if (isset($custid)) {
  $customers_custnum = $custid;
}
else{ 
        $rows=mysqli_fetch_array($results);
        $customers_custnum = $rows['CNUM'];
    }
//2) Insert Info into ordermain
//determine shipping costs based on order total (25% of total)
$shipping = $total * 0.25;
$query3 = "INSERT INTO ordermain(
           ODATE, O_CNUM,
           SUBTOTAL,SHIPPING,
           shipfirst, shiplast,
           shipadd1, shipadd2,
           shipcity, shipstate,
           shipzip, shipphone,
           shipemail)
           VALUES (
           '$today',
           '$customers_custnum',
           '$total',
           '$shipping',
           '$shipfirst',
           '$shiplast',
           '$shipadd1',
           '$shipadd2',
           '$shipcity',
           '$shipstate',
           '$shipzip',
           '$shipphone',
           '$shipemail');";
$insert = mysqli_query($conn,$query3)
    or die(mysqli_error($conn));
  $orderid = mysqli_insert_id($conn);

//3) Insert Info into orderdet
//find the correct cart information being temporarily stored
$query = "SELECT * FROM carttemp WHERE carttemp_sess='$sessid'";
$results = mysqli_query($conn,$query)
    or (mysqli_error($conn));

//put the data into the database one row at a time
while ($row = mysqli_fetch_array($results)) {
  extract($row);
  $query4 = "INSERT INTO orderdet (
             ONUM, OQTY, PRODNUM)
             VALUES (
             '$orderid',
             '$carttemp_quan',
             '$carttemp_prodnum')";
  $insert4 = mysqli_query($conn,$query4)
    or die(mysqli_error($conn));
}

//4)delete from temporary table
$query = "DELETE FROM carttemp WHERE carttemp_sess='$sessid'";
$delete = mysqli_query($conn,$query)or die(mysqli_error($conn));

echo "SUCCESS";

?>