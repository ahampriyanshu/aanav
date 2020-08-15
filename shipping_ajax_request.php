<?php 
require_once('essentials/config.php');
  
if(isset($_POST['shipping_validation']) && $_POST['shipping_validation'] !='')
	{ ?>
                <form  method="post" action="shipping_home.php" enctype="multipart/form-data" class="checkout-form">
                <div class="row">
                    <div class="col-lg-12">
                        <h4>Enter Shipping Address</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="fir">Full Name<span>*</span></label>
                                <input name="name" type="text" id="fir" required>
                            </div>
                            <div class="col-lg-12">
                                <label for="street">Street Address<span>*</span></label>
                                <input name="street" type="text" id="street" class="street-first" required>
                               
                            </div>
                            <div class="col-lg-6">
                                <label for="town">City<span>*</span></label>
                                <input name="city" type="text" id="town" required>
                            </div>
                            <div class="col-lg-6">
                                <label for="pincode">PINCODE</label>
                                <input name="pincode" pattern="[0-9]{6}" type="text" id="pincode" required>
                            </div>
                            
                            <div class="col-lg-6">
                            <label for="State">State<span>*</span></label>
                <select name="state" class="custom-select d-block w-100" id="State" required>
<option value="Andhra Pradesh">Andhra Pradesh</option>
<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
<option value="Arunachal Pradesh">Arunachal Pradesh</option>
<option value="Assam">Assam</option>
<option value="Bihar">Bihar</option>
<option value="Chandigarh">Chandigarh</option>
<option value="Chhattisgarh">Chhattisgarh</option>
<option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
<option value="Daman and Diu">Daman and Diu</option>
<option value="Delhi">Delhi</option>
<option value="Lakshadweep">Lakshadweep</option>
<option value="Puducherry">Puducherry</option>
<option value="Goa">Goa</option>
<option value="Gujarat">Gujarat</option>
<option value="Haryana">Haryana</option>
<option value="Himachal Pradesh">Himachal Pradesh</option>
<option value="Jammu and Kashmir">Jammu and Kashmir</option>
<option value="Jharkhand">Jharkhand</option>
<option value="Karnataka">Karnataka</option>
<option value="Kerala">Kerala</option>
<option value="Madhya Pradesh">Madhya Pradesh</option>
<option value="Maharashtra">Maharashtra</option>
<option value="Manipur">Manipur</option>
<option value="Meghalaya">Meghalaya</option>
<option value="Mizoram">Mizoram</option>
<option value="Nagaland">Nagaland</option>
<option value="Ladakh">Ladakh</option>
<option value="Odisha">Odisha</option>
<option value="Punjab">Punjab</option>
<option value="Rajasthan">Rajasthan</option>
<option value="Sikkim">Sikkim</option>
<option value="Tamil Nadu">Tamil Nadu</option>
<option value="Telangana">Telangana</option>
<option value="Tripura">Tripura</option>
<option value="Uttar Pradesh">Uttar Pradesh</option>
<option value="Uttarakhand">Uttarakhand</option>
<option value="West Bengal">West Bengal</option>
                </select>
              </div>
                            <div class="col-lg-6">
                                <label for="phone">Phone<span>*</span></label>
                                <input type="text" pattern="[0-9]{10}" name="phone" class="form-control" placeholder="+91" type="text" id="phone" required>
                            </div>
                        </div>
                    </div>
                    <input type="submit" name="submit" value="Proceed To Pay" class="btn btn-success">
                     </form>
                </div>

<?php	} ?>





