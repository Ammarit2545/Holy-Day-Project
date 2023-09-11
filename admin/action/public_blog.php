<?php
session_start();
include('../../database/condb.php');
$blog = $_GET['blog'];
$session = $_GET['session'];
$count = 1;
while (isset($_SESSION['title_' . $count])) {
    $count++;
}
$count -= 1;
unset(
    $_SESSION['title_' . $i],
    $_SESSION['title_color_' . $i],
    $_SESSION['title_detail_' . $i],
    $_SESSION['title_id_' . $i],
    $_SESSION['title_file_' . $i]
);
for ($i = $session; $i <= $count; $i++) {
    if ($i == $session) {
        unset(
            $_SESSION['title_' . $i],
            $_SESSION['title_color_' . $i],
            $_SESSION['title_detail_' . $i],
            $_SESSION['title_id_' . $i],
            $_SESSION['title_file_' . $i]
        );
    } else {
        $_SESSION['title_' . ($i - 1)] = $_SESSION['title_' . $i];
        $_SESSION['title_color_' . ($i - 1)] = $_SESSION['title_color_' . $i];
        $_SESSION['title_detail_' . ($i - 1)] = $_SESSION['title_detail_' . $i];
        $_SESSION['title_id_' . ($i - 1)] = $_SESSION['title_id_' . $i];
        $_SESSION['title_file_' . ($i - 1)] = $_SESSION['title_file_' . $i];
        unset(
            $_SESSION['title_' . $i],
            $_SESSION['title_color_' . $i],
            $_SESSION['title_detail_' . $i],
            $_SESSION['title_id_' . $i],
            $_SESSION['title_file_' . $i]
        );
    }
}

$sql = "SELECT t_name FROM topic WHERE t_id = '$blog'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$sql_delete = "UPDATE topic SET t_test = 0 WHERE t_id = $blog";
$result_topic = mysqli_query($conn, $sql_delete);

if ($result_topic) {
    $_SESSION['show-blog'] = $row['t_name'];
    header('Location:../listview_blog.php');
    exit();
}
