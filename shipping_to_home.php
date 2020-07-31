<?php
        session_start();
        include('essentials/config.php');
        $name = $_POST['name'];
        $street = $_POST['street'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $zip = $_POST['zip'];
        $phone = $_POST['phone'];
        

        $email = $_SESSION['email'];

        $sql = "INSERT INTO shipping(full_name, email, store_id, phone, status, shipping_type, street_address, state, city, zipcode, created_date, modified_date, shipping_time)
                VALUES('$name', '$email', 0, '$phone', 'register', 'home', '$street', '$state', '$city', '$zip', NOW(), NOW(), NOW())";

       mysqli_query($connect,$sql);

       

       $query = "SELECT * FROM shipping WHERE email = '$email' ORDER BY shipping_id DESC LIMIT 0,1";
                $result = mysqli_query($connect,$query);
                  while($row = mysqli_fetch_assoc($result)){
                    $id = $row['shipping_id'];
    echo "<script>window.location='payment_info.php?id=$id'</script>";
}
       ?>