<?php

$count_e_id = 0;
$sql_cont = "SELECT COUNT(t_id) AS count_topic FROM topic WHERE e_id = '$e_id' AND del_flg = 0 AND t_test = 1";
$result_count = mysqli_query($conn, $sql_cont);
$row_count = mysqli_fetch_array($result_count);
$count_e_id = $row_count['count_topic'];

$count_blog = 1;

if ($_SESSION['title_now'] != $count_e_id) {
    while (isset($_SESSION['title_1'])) {
        $sql_topic = "SELECT * FROM topic WHERE e_id = '$e_id' AND del_flg = 0 AND t_test = 1";
        $result_topic = mysqli_query($conn, $sql_topic);
        while ($row_topic = mysqli_fetch_array($result_topic)) {
            if ($row_topic['t_name'] != null) {
                $_SESSION['title_' . $count_blog] = $row_topic['t_name'];
                $_SESSION['title_color_' . $count_blog] = $row_topic['t_color'];
                $_SESSION['title_detail_' . $count_blog] = $row_topic['t_detail'];
                $_SESSION['title_id_' . $count_blog] = $row_topic['t_id'];
                $_SESSION['title_date_in_' . $count_blog] = $row_topic['t_date_in'];
                $t_id = $row_topic['t_id'];

                $sql_pic = "SELECT * FROM picture WHERE t_id = '$t_id' AND del_flg = 0";
                $result_pic = mysqli_query($conn, $sql_pic);
                while ($row_pic = mysqli_fetch_array($result_pic)) {
                    $_SESSION['title_file_' . $count_blog] = $row_pic['p_pic'];
                }
                $sub_title_count = 1;

                $sql_st = "SELECT * FROM sub_topic WHERE t_id = '$t_id' AND del_flg = 0";
                $result_st = mysqli_query($conn, $sql_st);

                if (mysqli_num_rows($result_st) > 0) {
                    // Records found in the initial query
                    while ($row_st = mysqli_fetch_array($result_st)) {
                        $_SESSION['sub_title_id_' . $count_blog . '_' . $sub_title_count] = $row_st['st_id'];
                        $_SESSION['sub_title_' . $count_blog . '_' . $sub_title_count] = $row_st['st_main'];
                        $_SESSION['sub_title_detail_' . $count_blog . '_' . $sub_title_count] = $row_st['st_detail'];
                        $_SESSION['sub_title_section_' . $count_blog . '_' . $sub_title_count] = $row_st['st_type_sec'];
                        $st_id = $row_st['st_id'];
                        // echo $st_id;
                        $sub_pic_count = 1;
                        $sql_pic = "SELECT p_pic FROM picture WHERE st_id = '$st_id' AND del_flg = 0";
                        $result_pic = mysqli_query($conn, $sql_pic);
                        if (mysqli_num_rows($result_pic) > 0) {
                            $row_pic = mysqli_fetch_array($result_pic);
                            $_SESSION['sub_title_pic_' . $count_blog . '_' . $sub_title_count] = $row_pic['p_pic']; // Use $row_pic here
                            $sub_pic_count++;
                        }
                        $sub_title_count++;
                    }
                } else {
                    // No records found, insert new data
                    for ($i = 1; $i <= 4; $i++) {
                        $t_id; // You should set the value of $t_id here.

                        if ($i == 1) {
                            $st_name = 'ประวัติและความสำคัญ';
                            $st_detail = '* เพิ่มข้อมูลของคุณ';
                            $sec_type = 1;
                        } elseif ($i == 2) {
                            $st_name = 'กิจกรรม/พิธีกรรม';
                            $st_detail = '* เพิ่มข้อมูลของคุณ';
                            $sec_type = 1;
                        } elseif ($i == 3) {
                            $st_name = 'บุคคลสำคัญ';
                            $st_detail = '* เพิ่มข้อมูลของคุณ';
                            $sec_type = 1;
                        } elseif ($i == 4) {
                            $st_name = 'ติดต่อและเข้าถึง';
                            $st_detail = '* เพิ่มข้อมูลของคุณ';
                            $sec_type = 1;
                        }

                        $sql_insert = "INSERT INTO sub_topic (st_main, st_detail, st_date_in, t_id, st_type_sec) VALUES ('$st_name', '$st_detail', NOW(),'$t_id','$sec_type')";
                        $result_insert = mysqli_query($conn, $sql_insert);

                        if ($result_insert) {
                            // Get the last inserted ID
                            $st_id_insert = mysqli_insert_id($conn);

                            $sql_sub_top = "SELECT * FROM sub_topic WHERE st_id = ? AND del_flg = 0";
                            $stmt = mysqli_prepare($conn, $sql_sub_top);
                            mysqli_stmt_bind_param($stmt, "i", $st_id_insert); // Assuming 'st_id' is an integer
                            mysqli_stmt_execute($stmt);
                            $result_sub_top = mysqli_stmt_get_result($stmt);
                            $row_st = mysqli_fetch_array($result_sub_top);

                            $_SESSION['sub_title_id_' . $count_blog . '_' . $i] = $row_st['st_id'];
                            $_SESSION['sub_title_' . $count_blog . '_' . $i] = $row_st['st_main']; // Use 'st_name' instead of 'st_main' based on your INSERT query
                            $_SESSION['sub_title_detail_' . $count_blog . '_' . $i] = $row_st['st_detail'];
                            $_SESSION['sub_title_section_' . $count_blog . '_' . $i] = $row_st['st_type_sec'];
                        }
                    }
                }
            } else {
                break; // Break out of the inner while loop
            }
            $count_blog++;
        }

        if ($row_topic === null) {
            break; // Break out of the outer while loop
        }
    }
}
