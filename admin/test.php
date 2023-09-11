<?php
session_start();

$count_blog = 1;

$t_name = $_SESSION['title_' . $count_blog];
$title_color = isset($_SESSION['title_color_' . $count_blog]) ? $_SESSION['title_color_' . $count_blog] : null;
$title_detail = isset($_SESSION['title_detail_' . $count_blog]) ? $_SESSION['title_detail_' . $count_blog] : null;
$title_file = isset($_SESSION['title_file_' . $count_blog]) ? $_SESSION['title_file_' . $count_blog] : null;

echo "t_name: " . $t_name . "<br>";
echo "title_color: " . $title_color . "<br>";
echo "title_detail: " . $title_detail . "<br>";
echo "title_file: " . $title_file . "<br>";

echo $_SESSION['title_now'];

echo $_SESSION['title_id_1'];


?>