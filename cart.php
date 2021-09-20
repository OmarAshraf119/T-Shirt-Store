<?php 
if (!session_id()) {
  session_start();
}
//connect to the database
$conn = mysqli_connect("localhost", "root", "") 
  or die ("Connection error.");

$conn->select_db("store");

?>
<!doctype html>
<html lang="en">
  <head>
     <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="Mountainlogohead.png" />
    <title>Cart</title>
  </head>

  <body class="bg-light">

    <div class="container">
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4 bg-dark" src="Mountainlogo.png" alt="" width="72" height="72">
        <h2>Mountain Store</h2>
      </div>
      <div class="row">
        <div class="col-md-8 order-md-2 mb-4 mx-auto">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
              <span class="text-muted">Your cart</span>
                <small class="d-flex text-muted"><?php
                $sessid = session_id();

                //display number of products in cart
                $query = "SELECT * FROM carttemp WHERE carttemp_sess = '$sessid'";
                $results = mysqli_query($conn,$query)
                  or die (mysqli_error($conn));
                $rows = mysqli_num_rows($results);
                echo $rows;
                ?> product(s)</small>
           <!--<span class="badge badge-secondary badge-pill">3</span>-->
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed bg-light">
              <div>
                <h6 class="my-0">Product name</h6>
              </div>
              <h6 >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Qty</h6>
              <h6 >&nbsp;&nbsp;&nbsp; Price Each </h6>
              <div> </div> <span ></span>

               </li>
        <?php
            $total =number_format(0,2);
            while ($row = mysqli_fetch_array($results)) {  
                extract($row);
                $prod = "SELECT * FROM products " .
                        "WHERE PNUM='$carttemp_prodnum'";
                $prod2 = mysqli_query($conn,$prod)or die (mysqli_error($conn));
                $prod3 = mysqli_fetch_array($prod2);
                extract($prod3);
                    echo "<td>
                          <form method=\"POST\" action=\"modcart.php?action=change\">
                            <input type=\"hidden\" name=\"modified_hidden\"
                              value=\"$carttemp_hidden\">";
                //get extended price
                $extprice = $PPRICE * $carttemp_quan;
            echo'<li class="list-group-item d-flex justify-content-between lh-condensed">';
              echo'<div>';
                echo'<h6 class="my-0">'.$PNAME.'</h6>';
                //echo'<small class="text-muted">'.$PDESC.'</small>';
              echo'</div>';
              echo"<input type=\"text\" style=\"height:50%; \"name=\"modified_quan\" size=\"2\"
                              value=\"$carttemp_quan\">";
              echo'<span class="text-muted">'.$PPRICE.' LE</span>';
                echo'<div>'.'<input type="submit" class="form-control btn btn-sm btn-outline-warning" value="Edit"></form>';
                 echo "<form method=\"POST\" action=\"modcart.php?action=delete\">
                        <input type=\"hidden\" name=\"modified_hidden\"
                          value=\"$carttemp_hidden\">";
                  echo "<input type=\"submit\" class=\"form-control btn btn-sm btn-outline-danger\" name=\"Submit\"
                          value=\"Delete\">
                        </form>";
            echo'</li>';
                 $total = floatval($extprice) + $total;
        }?>
               <li class="list-group-item d-flex justify-content-between">
                    <span>Total</span>
                    <strong><?php echo number_format($total,2); ?> LE</strong>
                    <span><?php echo "<form method=\"POST\" action=\"modcart.php?action=empty\">
                                        <input type=\"hidden\" name=\"carttemp_hidden\"
                                          value=\"";
                                if (isset($carttemp_hidden)) {
                                  echo $carttemp_hidden;
                                }
                                echo "\">";
                                echo "<input type=\"submit\" class=\"btn  btn-danger \" name=\"Submit\" value=\"Empty Cart\">
                                      </form>";?></span>
            </li>
        </ul>

            <div class=" d-flex justify-content-between">
              <button class="btn  btn-primary  btn-blockname"  onclick="window.location.href='store.php'">Back to Store</button>
          <form   method="POST" action="checkout.php">
                <input type="submit" class="btn  btn-primary  btn-blockname" value="Proceed to Checkout">
                          </form>
    
            </div>
        </div>
        
      </div>

      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2019 Mountain</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="Support.html">Support</a></li>
        </ul>
      </footer>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
  </body>
</html>
