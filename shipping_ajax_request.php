<?php 

error_reporting(E_ALL);
	session_start();
        require_once('essentials/config.php');
        $email = $_SESSION['email'];
	{ ?>
                
                <form  method="post" action="shipping_to_home.php" enctype="multipart/form-data" class="checkout-form">
                <div class="row">
                    <div class="col-lg-12">
                        <h4>Enter Shipping Address</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="fir">First Name<span>*</span></label>
                                <input type="text" id="fir">
                            </div>
                            <div class="col-lg-12">
                                <label for="street">Street Address<span>*</span></label>
                                <input type="text" id="street" class="street-first">
                               
                            </div>
                            <div class="col-lg-6">
                                <label for="town">City<span>*</span></label>
                                <input type="text" id="town">
                            </div>
                            <div class="col-lg-6">
                                <label for="zip">ZIP Code</label>
                                <input type="text" id="zip">
                            </div>
                            <div class="col-lg-6">
                            <label for="State">State<span>*</span></label>
                <select name="state" class="custom-select d-block w-100" id="State" required>
                  <option value="">Choose...</option>
                  <option>Yangon</option>
                  <option>Mandalay</option>
                  <option>Naypyitaw</option>
                  <option>Bangkok</option>
                  <option>PhueKhet</option>
                  <option>Pattaya</option>
                </select>
              </div>
                            <div class="col-lg-6">
                                <label for="phone">Phone<span>*</span></label>
                                <input type="number" name="phone" class="form-control" placeholder="+91" type="text" id="phone">
                            </div>
                        </div>
                    </div>
                    <input type="submit" name="submit" value="Save Address" class="btn btn-primary pull-right" style="margin-left: 4px">
                        <a href="home.php" class="btn btn-outline-primary pull-right">Back</a>
                     </form>
                </div>
            </form>


		 <h3>Confirm Shipping Address</h3>
	    				<div class="panel-body">
                        <form method="post" action="shipping_to_home.php" enctype="multipart/form-data">

                         <label for="lastName">Full Name</label>
                        <input type="text" name="name" class="form-control" id="lastName" placeholder="" value="" required>
                        <div class="invalid-feedback">
                        Valid last name is required.
                        </div>

                        <label for="lastName">Address</label>
                        <input type="text" name="street" class="form-control" id="lastName" placeholder="" value="" required>
                        <div class="invalid-feedback">
                        Valid last name is required.
                        </div>
                        
                      <div class="row">

              <div class="col-md-4 mb-3">
                <label for="state">State</label>
                <select name="state" class="custom-select d-block w-100" id="state" required>
                  <option value="">Choose...</option>
                  <option>Yangon</option>
                  <option>Mandalay</option>
                  <option>Naypyitaw</option>
                  <option>Bangkok</option>
                  <option>PhueKhet</option>
                  <option>Pattaya</option>
                </select>
                <div class="invalid-feedback">
                  Please provide a valid state.
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <input type="text" name="zip" class="form-control" id="zip" placeholder="" required>
                <div class="invalid-feedback">
                  Zip code required.
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
            <label for="zip">City</label>
                <input type="text" name="city" class="form-control" id="zip" placeholder="" required>
                <div class="invalid-feedback">
                  Zip code required.
                </div>
        </div>
                <div class="col-md-6 mb-3">
                <label for="zip">Phone</label>
                <input type="text" name="phone" class="form-control" id="zip" placeholder="" required>
                <div class="invalid-feedback">
                  Zip code required.
                </div>
        </div>
</div>
                      
		
<?php	} ?>





