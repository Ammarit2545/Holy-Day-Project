<?php
include('../../database/condb.php');

$r_name = $_POST['r_name'];

$sql = "INSERT INTO role (r_name,r_date_in) VALUE ('$r_name' ,NOW())";
$result = mysqli_query($conn,$sql);
if($result){
header('location:../role_manage.php');
}
?>