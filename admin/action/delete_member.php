<?php
include('../../database/condb.php');

$m_id = $_GET['id'];

$sql = "UPDATE member SET del_flg = 1 WHERE m_id = '$m_id'";
$result = mysqli_query($conn, $sql);
if ($result) {
    $_SESSION['delete_member'] = $m_id;
    header('location:../member_manage.php');
}
