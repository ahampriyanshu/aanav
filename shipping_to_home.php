<?php
        session_start();
        include('essentials/config.php');
        $name = $_POST['name'];
        $street = $_POST['street'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $zip = $_POST['zip'];
        $phone = $_POST['phone'];
        $customer = $_SESSION['email'];

        

        $sql = "INSERT INTO shipping(full_name, email, store_id, phone, status, shipping_type, street_address, state, city, zipcode, created_date, modified_date)
                VALUES('$name', '$customer', 0, '$phone', 'register', 'home', '$street', '$state', '$city', '$zip', NOW(), NOW())";

       mysqli_query($connect,$sql);

       

       $query = "SELECT * FROM shipping WHERE email = '$customer' ORDER BY shipping_id DESC LIMIT 0,1";
                $result = mysqli_query($connect,$query);
                  while($row = mysqli_fetch_assoc($result)){
                    $id = $row['shipping_id'];
    echo "<script>window.location='payment.php?id=$id'</script>";
}
       ?>