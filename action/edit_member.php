<?php
session_start();
include '../database/condb.php';

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$password = $_POST['password'];
$passwordcon = $_POST['passwordcon'];
$passwordold = $_POST['passwordold'];

$id = $_SESSION['id'];

if ($_POST['password'] == NULL || $_POST['passwordcon'] == NULL || $_POST['passwordold'] == NULL) {
    $sql = "UPDATE member SET m_fname ='$fname', m_lname='$lname' WHERE m_id = '$id'";
} else {
    $passwordold = hash('sha512', $passwordold);

    $sql = "SELECT * FROM member WHERE m_id = '$id' AND m_password = '$passwordold' AND del_flg = 0";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0 && $password == $passwordcon) {
        $password = hash('sha512', $password);
        $sql = "UPDATE member SET m_fname ='$fname', m_lname='$lname', m_password = '$password' WHERE m_id = '$id'";
    } else {
        // Handle password validation error
        $_SESSION['Error'] = "รหัสผ่านไม่ถูกต้อง";
        header('location:../edit_member.php');
        exit();
    }
}

$result = mysqli_query($conn, $sql);

if ($result) {
    // Retrieve updated user data
    $sql = "SELECT * FROM member WHERE m_id = '$id' AND del_flg = 0";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // Update session data
        $_SESSION['fname'] = $row['m_fname'];
        $_SESSION['lname'] = $row['m_lname'];
        $_SESSION['Error'] = "บันทึกข้อมูลเสร็จสิ้น";
        // Redirect to edit_member.php
        header('Location: ../edit_member.php');
        exit();
    }
} else {
    // Handle database update error
    $_SESSION['Error'] = "ไม่มามารถบันทึกเข้าสู่ระบบได้";
    header('location:../edit_member.php');
    exit();
}
?>
