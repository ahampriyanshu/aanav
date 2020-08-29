<?php
require_once('essentials/config.php');
echo"<br>";
if(isset($_REQUEST["term"])){
    
            $result = mysqli_query($connect,"SELECT * FROM product WHERE name LIKE '%".$_REQUEST["term"]."%' LIMIT 8");
            
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    echo "<a href='product.php?id=". $row['id']."' ><p><img src='uploads/". $row['file'] 
                    . "'width='30px' height='40px'>&emsp;" . $row['name'] . "</p></a>";
                }
            } else{
                echo "<a><p style='color:red; font-weight:bold;' >No matches found</p></a>";
            }
        }
?>