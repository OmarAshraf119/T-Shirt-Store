<?php
if (!session_id()) {
  session_start();
}
//connect to the database
$conn = mysqli_connect("localhost", "root", "") 
  or die ("Connection error.");

$conn->select_db("store");

if (isset($_POST['qty'])) {
  $qty = $_POST['qty'];
}
if (isset($_POST['products_prodnum'])) {
  $prodnum = $_POST['products_prodnum'];
}
if (isset($_POST['modified_hidden'])) {
   $modified_hidden = $_POST['modified_hidden'];
}
if (isset($_POST['modified_quan'])) {
  $modified_quan = $_POST['modified_quan'];
}
$sess = session_id();
$action = $_REQUEST['action'];

switch ($action) {
  case "add":
    $query = "SELECT * FROM carttemp WHERE(carttemp_sess='$sess' AND carttemp_prodnum='$prodnum') ";
    $results = mysqli_query($conn,$query)
        or die(mysql_error($conn));
    $rows = mysqli_num_rows($results);
    if($rows<1)    
        $query = "INSERT INTO carttemp (
                  carttemp_sess, 
                  carttemp_quan, 
                  carttemp_prodnum)
                  VALUES ('$sess','$qty','$prodnum')";
    else{
        $row = mysqli_fetch_array($results);
        extract($row);
        $query ="UPDATE carttemp SET carttemp_quan='$qty' WHERE (carttemp_hidden='$carttemp_hidden');";
    
    }
        
        $message = "Item added.";
    break;

  case "change":
    $query = "UPDATE carttemp
              SET carttemp_quan = '$modified_quan'
	             WHERE carttemp_hidden = '$modified_hidden'";
    $message = "Quantity changed.";
    break;

  case "delete":
    $query = "DELETE FROM carttemp 
              WHERE carttemp_hidden = '$modified_hidden'";
    $message = "Item deleted";
    break;

  case "empty":
    $query = "DELETE FROM carttemp WHERE carttemp_sess = '$sess'";
    $message = "Cart emptied.";
    break;

}

$results = mysqli_query($conn,$query)
  or die(mysql_error($conn));
echo "<script type='text/javascript'>alert('".$message."');
window.location='cart.php';
</script>";

?>
