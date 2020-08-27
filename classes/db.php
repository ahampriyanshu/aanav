<?php

class db {

    public $connect;
    public function __construct()
    {
        try {

            $this->connect = new PDO("mysql:host=localhost;dbname=aanav", 'root', 'Django@1212');

        } catch(PDOException $e){
            echo "Connection error: ". $e->getMessage();
        }
    }

}


?>