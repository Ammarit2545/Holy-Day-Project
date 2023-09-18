<?php
session_start();
include('../../database/condb.php');

$topic = $_GET['topic'];
$title_page  = $_GET['page'];
echo $_GET['topic'];

if (isset($_GET['topic'])) {
    $count_sub = 1;
    while (isset($_SESSION['sub_title_' . $topic . '_' . $count_sub])) {
        $count_sub++;
    }

    echo '<br>Sub : ' . $count_sub;

    $_SESSION['sub_title_id_' . $topic . '_' . $count_sub] = '* เพิ่มชื่อหัวข้อย่อย';
    $_SESSION['sub_title_' . $topic . '_' . $count_sub] = '* เพิ่มชื่อหัวข้อย่อย';
    $_SESSION['sub_title_detail_' . $topic . '_' . $count_sub] = '* เพิ่มชื่อหัวข้อย่อย';
    $_SESSION['sub_title_section_' . $topic . '_' . $count_sub] = 1;

    if (isset($_SESSION['sub_title_id_' . $topic . '_' . $count_sub])) {
        $t_id = $_SESSION['title_id_' . $topic];
        $sql_insert = "INSERT INTO sub_topic (st_main, st_detail, t_id,st_date_in,st_type_sec) VALUES ('* เพิ่มชื่อหัวข้อย่อย','* เพิ่มชื่อหัวข้อย่อย',$t_id,NOW(),1)";
        $result_insert = mysqli_query($conn, $sql_insert);
        if ($result_insert) {
            $_SESSION['sub_title_id_' . $topic . '_' . $count_sub] = mysqli_insert_id($conn);
            $_SESSION['add_sub'] = 0;
            // Use the variables in the header function
            header("Location: ../$title_page?blog=$topic");
        } else {
            $_SESSION['add_sub'] = 1;
            // Use the variables in the header function
            header("Location: ../$title_page?blog=$topic");
        }
    } else {
        $_SESSION['add_sub'] = 1;
        // Use the variables in the header function
        header("Location: ../$title_page?blog=$topic");
    }
}
