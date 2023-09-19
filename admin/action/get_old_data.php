<?php
session_start();
include('../../database/condb.php');
$blog_now = $_GET['blog'];

$sql_select = "SELECT * FROM topic 
LEFT JOIN picture ON picture.t_id = topic.t_id
WHERE topic.t_id = '$blog_now' ";
$result_select = mysqli_query($conn, $sql_select);
$row_select = mysqli_fetch_array($result_select);

$_SESSION['title_' . $blog_now] = $row_select['t_name'];
$_SESSION['title_color_' . $blog_now] = $row_select['t_color'];
$_SESSION['title_detail_' . $blog_now] = $row_select['t_detail'];
$_SESSION['title_id_' . $blog_now] = $t_id = $row_select['t_id'];
$_SESSION['title_date_in_' . $blog_now] = $row_select['t_date_in'];
$_SESSION['title_file_' . $blog_now] = $row_select['p_pic'];

header("Location: ../your_blog.php");
