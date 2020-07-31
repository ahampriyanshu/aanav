<?php

include 'essentials/config.php';

$data = json_decode(file_get_contents("php://input"));

$search = $data->searchText;

$sel = mysqli_query($connect,"select * from product where name like '%".$search."%' limit 6");
$data = array();

while ($row = mysqli_fetch_array($sel)) {
    $data[] = array("name"=>$row['name'],"file"=>$row['file'],"id"=>$row['id']);
}

echo json_encode($data);
