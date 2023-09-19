<?php
session_start();
include('../../database/condb.php');

$blog_now = $_GET['blog'];

$title = $_SESSION['title_' . $blog_now];
$title_color = $_SESSION['title_color_' . $blog_now];
$title_detail = $_SESSION['title_detail_' . $blog_now];
$title_id = $_SESSION['title_id_' . $blog_now];
$title_date_in = $_SESSION['title_date_in_' . $blog_now];

$title_file = $_SESSION['title_file_' . $blog_now];

// Update the "topic" table
$sql = "UPDATE picture SET p_pic= ?,p_update= NOW() WHERE t_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "si", $title_file, $title_id);
$result = mysqli_stmt_execute($stmt);


// Update the "topic" table
$sql = "UPDATE topic SET t_name = ?, t_detail = ?, t_color = ?, t_update = NOW() WHERE t_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sssi", $title, $title_detail, $title_color, $title_id);
$result = mysqli_stmt_execute($stmt);

if ($result) {
    $i = 1;
    while (isset($_SESSION['sub_title_id_' . $blog_now . '_' . $i])) {

        $sub_title_id = $_SESSION['sub_title_id_' . $blog_now . '_' . $i];
        $sub_title = $_SESSION['sub_title_' . $blog_now . '_' . $i];
        $sub_title_detail = $_SESSION['sub_title_detail_' . $blog_now . '_' . $i];
        $sub_title_section = $_SESSION['sub_title_section_' . $blog_now . '_' . $i];
        $title_update = $_SESSION['title_date_in_' . $blog_now . '_' . $i];
        $sub_title_pic = $_SESSION['sub_title_pic_' . $blog_now . '_' . $i];

        // Update the "sub_topic" table
        $sql = "UPDATE sub_topic SET st_main = ?, st_detail = ?, st_update = NOW() WHERE st_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssi", $sub_title, $sub_title_detail, $sub_title_id);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            // Update the "sub_topic LT picture" table
            $sql = "UPDATE picture SET p_pic= ?,p_update= NOW() WHERE st_id = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "si", $sub_title_pic, $sub_title_id);
            $result = mysqli_stmt_execute($stmt);
        }

        $i++;
    }

    if ($result) {
        $_SESSION['success'] = $_SESSION['title_' . $blog_now];
        header('location: ../your_blog.php');
    } else {
        // Handle the case where the sub_topic updates fail
        echo "Sub-topic updates failed.";
    }
} else {
    // Handle the case where the topic update fails
    echo "Topic update failed.";
}
