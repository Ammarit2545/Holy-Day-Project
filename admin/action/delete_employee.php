<?php
include('../../database/condb.php');

$e_id = $_GET['id'];

$sql = "UPDATE employee SET del_flg = 1 WHERE e_id = '$e_id'";
$result = mysqli_query($conn, $sql);
if ($result) {
    $_SESSION['delete_employee'] = $e_id;
    header('location:../employee_manage.php');
}
