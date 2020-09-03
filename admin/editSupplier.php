<?php
require('header.php');
?>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 login-section-wrapper pl-5 ">
                    <div class="login-wrapper">
                    <h1 class="login-title mb-4">Edit Supplier</h1>
                        <form class="form-horizontal" method="post" action="updateSupplier.php" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $row['supplier_id'] ?>">
                        <div class="form-group">
                                <label for="email">Supplier Title</label>
                                <input type="text" name="name"  value="<?php echo $row['supplier_name'] ?>" class="form-control" id="email" required />
                            </div>
                            <div class="form-group">
                                <label for="email">Supplier Email</label>
                                <input type="text" name="email"  value="<?php echo $row['email'] ?>" class="form-control" id="email" required />
                            </div>
                            <div class="form-group">
                                <label for="email">Supplier Phone</label>
                                <input type="number" name="phone"  value="<?php echo $row['phone'] ?>" class="form-control" id="email" required />
                            </div>
                            <div class="form-group">
                                <label for="email">Supplier Address</label>
                                <input type="text" name="address"  value="<?php echo $row['address'] ?>" class="form-control" id="email" required />
                            </div>
                            <input type="submit" name="submit" id="submit login" class="btn btn-block login-btn" value="Update">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>