<?php

//if(isset($_GET['id']))
//{


$db = mysqli_connect(env('DB_HOST', 'localhost'),env('DB_USERNAME', 'forge'),env('DB_PASSWORD', ''),env('DB_DATABASE', 'forge')); //keep your db name
$sql = "SELECT Member_Pic FROM tbl_partial_reg WHERE Member_Reg_No = $id";
$sth = $db->query($sql);
$result=mysqli_fetch_array($sth);

echo $result['Member_Pic'];
echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['Member_Pic'] ).'"/>';

//?>