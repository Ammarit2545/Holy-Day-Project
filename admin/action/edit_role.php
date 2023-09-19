<?php
session_start();
include('../../database/condb.php'); // Replace with the actual path to your database connection

// รับข้อมูลที่ส่งมาจากหน้าแก้ไข
$r_id = $_POST['r_id'];
$r_name = $_POST['r_name'];

// Check if the updated role name already exists
$check_sql = "SELECT r_id FROM `role` WHERE `r_name` = '$r_name'";
$check_result = mysqli_query($conn, $check_sql);

if (mysqli_num_rows($check_result) > 0) {
    // The role name already exists
    $_SESSION['edit_role_error'] =  $r_name;
    header('Location:../role_manage.php');
    exit();
}

// สร้างคำสั่ง SQL เพื่ออัพเดตข้อมูล
$sql = "UPDATE `role` SET `r_name` = '$r_name' ,r_update = NOW() WHERE `r_id` = '$r_id'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $_SESSION['edit_role'] = $r_name;
    header('Location:../role_manage.php');
    exit();
} else {
    $_SESSION['edit_role_error'] = "Failed to update role.";
    header('Location:../role_manage.php');
    exit();
}
?>
