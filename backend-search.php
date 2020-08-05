 
<?php
   require_once('essentials/config.php');
 
if($connect === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
if(isset($_REQUEST["term"])){
    $search_sql = "SELECT * FROM product WHERE name LIKE ?";
    
    if($stmt = mysqli_prepare($connect, $search_sql)){
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        
        $param_term = $_REQUEST["term"] . '%';
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    echo "<p><a href='product.php?id=". $row['id']."' ><img src='uploads/". $row['file'] . "'width='30' height='40'>&emsp;<strong>" . $row['name'] . "</strong></a></p>";
                }
            } else{
                echo "<p>No matches found</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $search_sql. " . mysqli_error($connect);
        }
    }
     
    mysqli_stmt_close($stmt);
}
 
mysqli_close($connect);
?>