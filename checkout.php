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
    <title>Check Out</title>
  </head>

  <body class="bg-light">

    <div class="container">
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4 bg-dark" src="Mountainlogo.png" alt="" width="72" height="72">
        <h2>Mountain Store</h2>
      </div>
      <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
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
          </h4><ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed bg-light">
              <div>
                <h6 class="mr-auto my-0">Product name</h6>
              </div><!--<div class="d-flex flex-fill">-->
                <h6 class="ml-auto">Quantity</h6>
                <h6 class="ml-auto" > Price Each </h6><!--</div>-->
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
                          ";
                //get extended price
                $extprice = $PPRICE * $carttemp_quan;
            echo'<li class="list-group-item d-flex justify-content-between lh-condensed">';
              echo'<div>';
                echo'<h6 class="my-0 mr-auto">'.$PNAME.'</h6>';
              echo'</div>';
              echo '<h6 class="text-muted mr-auto ml-auto">'.$carttemp_quan.'</h6>';
              echo'<span class="text-muted">'.$PPRICE.' LE</span>';
                
                        
            echo'</li>';
                 $total = floatval($extprice) + $total;
        }?>
               <li class="list-group-item d-flex justify-content-between">
                    <span>Total</span>
                    <strong><?php echo number_format($total,2); ?> LE</strong>
                    <span><?php 
                                echo "<input type=\"button\" class=\"btn  btn-danger \" name=\"Submit\"                 onclick=\"window.location.href='cart.php'\"value=\"Back To Cart\">
                                      </form>";?></span>
            </li>
        </ul>

          
        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Billing address</h4>
          <form class="needs-validation" novalidate method="post" action="checkout2.php">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" name="firstname"id="firstName" placeholder="" value="" required>
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control"  name="lastname"i d="lastName" placeholder="" value="" required>
                <div class="invalid-feedback">
                  Valid last name is required.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Email <span class="text-muted">(Optional)</span></label>
              <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="mb-3">
              <label for="address">Address</label>
              <input type="text" class="form-control" name="add1" id="address" placeholder="1234 Main St" required>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="mb-3">
              <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
              <input type="text" class="form-control" name="add2" id="address2" placeholder="Apartment or suite">
            </div>

            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="country">Country</label>
                <select class="custom-select d-block w-100" name="country" id="country" required>
                  <option value="">Choose...</option>
                  <option value="us">United States</option>
                </select>
                <div class="invalid-feedback">
                  Please select a valid country.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="state">State</label>
                <select class="custom-select d-block w-100" name="state" id="state" required>
                  <option value="">Choose...</option>
                  <option value="ca">California</option>
                </select>
                <div class="invalid-feedback">
                  Please provide a valid state.
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" name="zip" id="zip" maxlength="5" size="5" placeholder="" required>
                <div class="invalid-feedback">
                  Zip code required.
                </div>
              </div>
            </div>
              <div class="row">
              <div class="col-md-5 mb-3">
                <label for="country">City</label>
                <select class="custom-select d-block w-100" name="city" id="city" required>
                  <option value="">Choose...</option>
                  <option value="Los angeles">Los angeles</option>
                </select>
                <div class="invalid-feedback">
                  Please select a valid city.
                </div>
              </div>
              
              <div class="col-md-3 mb-3">
                <label for="zip">Phone</label>
                <input type="text" class="form-control" name="phone" id="phone" maxlength="12" size="12" placeholder="" required>
                <div class="invalid-feedback">
                    Phone required.
                </div>
              </div>
            </div> 
              <h4 class="mb-3">Shipping address</h4>
             <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" name="shipfirst"id="firstName" placeholder="" value="" required>
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control"  name="shiplast"i d="lastName" placeholder="" value="" required>
                <div class="invalid-feedback">
                  Valid last name is required.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Email <span class="text-muted">(Optional)</span></label>
              <input type="email" class="form-control" name="shipemail" id="email" placeholder="you@example.com">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="mb-3">
              <label for="address">Shipping Address</label>
              <input type="text" class="form-control" name="shipadd1" id="address" placeholder="1234 Main St" required>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="mb-3">
              <label for="address2">Shipping Address 2 <span class="text-muted">(Optional)</span></label>
              <input type="text" class="form-control" name="shipadd2" id="address2" placeholder="Apartment or suite">
            </div>

            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="country">Country</label>
                <select class="custom-select d-block w-100" name="shipcountry" id="country" required>
                  <option value="">Choose...</option>
                  <option value="us">United States</option>
                </select>
                <div class="invalid-feedback">
                  Please select a valid country.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="state">State</label>
                <select class="custom-select d-block w-100" name="shipstate" id="state" required>
                  <option value="">Choose...</option>
                  <option value="ca">California</option>
                </select>
                <div class="invalid-feedback">
                  Please provide a valid state.
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" name="shipzip" id="zip" maxlength="5" size="5" placeholder="" required>
                <div class="invalid-feedback">
                  Zip code required.
                </div>
              </div>
            </div>
             <div class="row">
              <div class="col-md-5 mb-3">
                <label for="country">City</label>
                <select class="custom-select d-block w-100" name="shipcity" id="city" required>
                  <option value="">Choose...</option>
                  <option value="Los angeles">Los angeles</option>
                </select>
                <div class="invalid-feedback">
                  Please select a valid city.
                </div>
              </div>
              
              <div class="col-md-3 mb-3">
                <label for="zip">Phone</label>
                <input type="text" class="form-control" name="shipphone" id="phone" maxlength="12" size="12" placeholder="" required>
                <div class="invalid-feedback">
                    Phone required.
                </div>
              </div>
            </div>  
            <hr class="mb-4">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="same" id="same-address">
              <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
            </div>
            <input type = "hidden" name="total" value="<?php echo $total ?>">
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Send Order</button>
          </form>
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
