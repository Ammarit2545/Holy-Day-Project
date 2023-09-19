<?php
session_start();
include('../../database/condb.php');

$blog_now = $_GET['blog'];
$status;

$sql_select = "SELECT t_private FROM topic WHERE t_id = '$blog_now'";
$result_select = mysqli_query($conn, $sql_select);
$row_select = mysqli_fetch_array($result_select);

$t_private = $row_select['t_private'];

if ($t_private == 0 || $t_private  == NULL) {
    $status = 1;
} else {
    $status = 0;
}

// Update the "topic" table
$sql = "UPDATE topic SET t_private = ? ,t_update = NOW() WHERE t_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ii", $status, $blog_now);
$result = mysqli_stmt_execute($stmt);
if ($result) {
    echo 'adasd';
}

header('Location:../your_blog.php');