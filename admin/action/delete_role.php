<?php
include('../../database/condb.php');

$r_id = $_GET['r_id'];

$sql = "UPDATE role SET del_flg = 1 WHERE r_id = '$r_id'";
$result = mysqli_query($conn,$sql);
if($result){
header('location:../role_manage.php');
}
