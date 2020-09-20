<?php

class verify extends queries {

  public function emailVerify(){

    if(isset($_GET['confirmation']) && $_GET['confirmation'] != 0){
        $code = $_GET['confirmation'];
        $status = 1;
        if($this->query("SELECT * FROM customer WHERE code = ? ", [$code])){
            if($this->count() == 1){

                $row = $this->fetch();
                $userId = $row->id;
                if($this->query("UPDATE customer SET status = ? WHERE id = ? ", [$status, $userId])){
                    $this->query("UPDATE customer SET code = 0 WHERE code='$code' ");
                    $_SESSION['emailVerified'] = "Your account has been verified successfully please login";
                    header("location:login.php");

                }

            }
        }
    }

  }

}
