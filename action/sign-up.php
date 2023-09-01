

<?php
session_start();
include '../database/condb.php';

$email = $_POST['email'];
$password = $_POST['password'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];

//เข้ารหัส Password ด้วย Sha512
$password = hash('sha512', $password);

$sql = "SELECT * FROM member WHERE m_email = '$email' ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
// echo($row);

if ($row > 0) {
    $_SESSION['add_data_alert'] = 3;
    header("location:../admin/sign-up.php");
} else {
    echo $email . " -ไม่มี";

    $sql = "INSERT INTO member(m_email, m_password, m_fname, m_lname ,m_date_in) 
        VALUES ('$email','$password','$fname','$lname',NOW())";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['add_data_alert'] = 4;
        header("location:../admin/sign-in.php");
    } else {
        $_SESSION['add_data_alert'] = 3;
        header("location:../admin/sign-up.php");
    }

    mysqli_close($conn);
}

?>