<?php
session_start();
include('../database/condb.php');
// require_once('line_login.php');
if (!isset($_SESSION['role_id'])) {
    $log_id = $_SESSION["log_id"];
    echo $log_id;

    $sql = "UPDATE `log_member` SET `lm_date_out`= NOW() WHERE lm_id = '$log_id'";
    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    session_destroy();
    $_SESSION['logout'] = 1;
    echo "<script> alert(' ออกจากระบบเสร็จสิ้นแล้ว '); </script>";
    header("location:../index.php");
}
 elseif (isset($_SESSION['role_id'])) {
    $log_id = $_SESSION['log_id'];
    echo $log_id;

    $sql = "UPDATE `log_employee` SET `le_date_out`= NOW() WHERE le_id = '$log_id'";
    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    session_destroy();
    $_SESSION['logout'] = 1;
    echo "<script> alert(' ออกจากระบบเสร็จสิ้นแล้ว '); </script>";
    header("location:../index.php");
} 
// elseif (isset($_SESSION['profile'])) {
//     $profile = $_SESSION['profile'];
//     $line = new LineLogin();
//     $line->revoke($profile->access_token);
//     session_destroy();
//     header("location:../index.php");

// }
