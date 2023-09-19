<?php
session_start();
include('../../database/condb.php'); // Replace with the actual path to your database connection
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // The form has been submitted via POST
    // Your code to process the form data goes here
}
// รับข้อมูลที่ส่งมาจากหน้าแก้ไข
$e_fname = $_POST['e_fname'];
$e_lname = $_POST['e_lname'];
$e_email = $_POST['e_email'];
$e_password = $_POST['e_password'];
$r_id = $_POST['r_id'];

//เข้ารหัส Password ด้วย Sha512
$password = hash('sha512', $e_password);
// Check if the updated role name already exists
$check_sql = "SELECT e_email FROM `employee` WHERE `e_email` = '$e_email'";
$check_result = mysqli_query($conn, $check_sql);

if (mysqli_num_rows($check_result) > 0) {
    // The role name already exists
    $_SESSION['edit_employee_error'] =  $e_email;
    header('Location:../employee_manage.php');
    exit();
}

// สร้างคำสั่ง SQL เพื่ออัพเดตข้อมูล
$sql = "INSERT INTO employee (e_fname,e_lname,e_email,e_password,r_id,e_date_in) VALUE ('$e_fname' ,'$e_lname' ,'$e_email' ,'$password','$r_id' ,NOW())";
$result = mysqli_query($conn, $sql);

if ($result) {
    $_SESSION['edit_employee'] = $e_email;
    header('Location:../employee_manage.php');
    exit();
} else {
    $_SESSION['edit_employee_error'] = "ไม่สามารถเพิ่มได้";
    header('Location:../employee_manage.php');
    exit();
}
