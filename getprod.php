<?php
  if(!isset($_SESSION)) 
    session_start(); 

//connect to the database
$conn = mysqli_connect("localhost", "root", "") 
  or die ("Connection error.");

$conn->select_db("store");

//get our variable passed through the URL
$prodid = $_REQUEST['prodid'];

//get information on the specific product we want
$query = "SELECT * FROM products WHERE PNUM='$prodid'";
$results = mysqli_query($conn,$query)
  or die(mysqli_error($conn));
$row = mysqli_fetch_array($results);
extract($row);
$PVIEWS++;
$query2 = "UPDATE `products` SET `PVIEWS` = '$PVIEWS' WHERE `products`.`PNUM` = '$PNUM'";
$update = mysqli_query($conn,$query2)
    or die(mysqli_error($conn));
?>
<html>
<head>
<title><?php echo $PNAME; ?></title>
</head>
<body>
<div align="center">
<table cellpadding="5" width="80%">
  <tr>
    <td><?php echo('<img src="'.$PIMG.'" height="100%" width="100%"<br>'); ?></td>
    <td><strong><?php echo $PNAME; ?></strong><br>
      <?php echo $PDESC; ?><br \>
      <br>Product Number: <?php echo $PNUM; ?>
      <br>Price: <?php echo $PPRICE; ?> LE.<br>
      <form method="POST" action="modcart.php?action=add">
        Quantity: <input type="text" name="qty" size="2" value="1"><br>
        
        <input type="hidden" name="products_prodnum" 
          value="<?php echo $PNUM ?>">
        <input type="submit" name="Submit" value="Add to cart">
      </form>

      <form method="POST" action="cart.php">
        <input type="submit" name="Submit" value="View cart">
      </form>
    </td>
  </tr>
</table>
<hr width="200">
<p><a href="Store.php">Go back to the main page</a></p>
</div>
</body>
</html>
