<?php
session_start();
$e_id = $_SESSION['id'];
include('../../database/condb.php');
$blog = $_GET['blog'];
$count = 1;
while (isset($_SESSION['title_' . $count])) {
    $count++;
}
$count -= 1;
$count_pic = 0;

$sql = "SELECT t_name FROM topic WHERE t_id = '$blog'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$t_name = $row['t_name'];

$sql_delete = "UPDATE topic SET del_flg = 1 WHERE t_id = $blog";
$result_topic = mysqli_query($conn, $sql_delete);

if ($result_topic) {
    $sql_sub = "UPDATE sub_topic SET del_flg = 1 WHERE t_id = $blog";
    $result_sub = mysqli_query($conn, $sql_sub);

    if ($result_sub) {
        $sql_delete_pic = "UPDATE picture SET del_flg = 1 WHERE t_id = $blog";
        $result_delete_pic = mysqli_query($conn, $sql_delete_pic);

        $sql_sub = "SELECT st_id  FROM sub_topic WHERE t_id = '$blog'";
        $result_sub = mysqli_query($conn, $sql_sub);

        while ($row = mysqli_fetch_array($result_sub)) {
            $st_id = $row['st_id'];
            $sql_delete_pic_sub = "UPDATE picture SET del_flg = 1 WHERE st_id = '$st_id'";
            $result_delete_pic_sub = mysqli_query($conn, $sql_delete_pic_sub);
        }

        $_SESSION['delete-blog'] = $t_name;
        header('Location:../your_blog.php');
        exit();
    }
}
