<?php

// configuration
include 'essentials/config.php';

$data = json_decode(file_get_contents("php://input"));

$row = $data->row;
$rowperpage = $data->rowperpage;

// selecting posts
$query = 'SELECT product.*,order_detail.product_id, SUM(order_detail.units) AS TotalQuantity
            FROM product 
            LEFT JOIN order_detail 
            ON product.id = order_detail.product_id
            GROUP BY order_detail.product_id
            ORDER BY TotalQuantity DESC limit '.$row.','.$rowperpage;
$result = mysqli_query($connect,$query);

$response_arr = array();

while($datarow = mysqli_fetch_assoc($result)){
 
    $id = $datarow['id'];
    $name = $datarow['name'];
    $price = $datarow['cost'];
    $file = $datarow['file'];
    $qty = $datarow['qty'];

 
    $response_arr[] = array('id'=>$id,'name'=>$name,'cost'=>$price,'file'=>$file,'qty'=>$qty);
 
}

if(count($response_arr) > 0)
echo json_encode($response_arr);
exit;