<?php
error_reporting(E_ALL);
require_once('essentials/config.php');

if(isset($_REQUEST["term"])){
    
            $result = mysqli_query($connect,"SELECT * FROM product WHERE name LIKE '%".$_REQUEST["term"]."%' LIMIT 8");
            
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    echo "<a href='product.php?id=". $row['id']."' ><p><img src='uploads/". $row['file'] 
                    . "'width='30px' height='40px'>&emsp;" . $row['name'] . "</p></a>";
                }
            } else{
                echo "<p>No matches found</p>";
            }
        }
?>