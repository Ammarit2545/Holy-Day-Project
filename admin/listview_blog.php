<!--
=========================================================
* Soft UI Dashboard - v1.0.7
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2023 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<?php
// Increase the maximum execution time and memory limit
ini_set('max_execution_time', 300); // 5 minutes
ini_set('memory_limit', '256M'); // 256 megabytes

session_start();
include('../database/condb.php');

$active = array();
$active[5] = "active";

$page = 'Create Blog';

$e_id = $_SESSION['id'];
$count_blog = 1;

// Create a prepared statement for inserting topics
$sql_insert_topic = "INSERT INTO topic (t_name, t_detail, t_color, t_date_in, e_id, t_test) VALUES (?, ?, ?, NOW(), ?, 1)";
$stmt_insert_topic = mysqli_prepare($conn, $sql_insert_topic);

while (!isset($_SESSION['title_1'])) {
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

                    $sub_pic_count = 1;
                    $sql_pic = "SELECT p_pic FROM picture WHERE st_id = '$st_id' AND del_flg = 0";
                    $result_pic = mysqli_query($conn, $sql_pic);
                    if (mysqli_num_rows($result_pic) > 0) {
                        $row_pic = mysqli_fetch_array($result_pic);
                        $_SESSION['sub_title_pic_' . $count_blog . '_' . $sub_title_count] = $row_pic['p_pic'];
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
                        mysqli_stmt_bind_param($stmt, "i", $st_id_insert);
                        mysqli_stmt_execute($stmt);
                        $result_sub_top = mysqli_stmt_get_result($stmt);
                        $row_st = mysqli_fetch_array($result_sub_top);

                        $_SESSION['sub_title_id_' . $count_blog . '_' . $i] = $row_st['st_id'];
                        $_SESSION['sub_title_' . $count_blog . '_' . $i] = $row_st['st_main'];
                        $_SESSION['sub_title_detail_' . $count_blog . '_' . $i] = $row_st['st_detail'];
                        $_SESSION['sub_title_section_' . $count_blog . '_' . $i] = $row_st['st_type_sec'];
                    }
                }
            }
        } else {
            break;
        }
        $count_blog++;
    }

    if ($row_topic === null) {
        if (!isset($_SESSION['sub_title_id_' . $count_blog . '_1'])) {
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

                $_SESSION['sub_title_id_' . $count_blog . '_' . $i] = null;
                $_SESSION['sub_title_' . $count_blog . '_' . $i] = $st_name;
                $_SESSION['sub_title_detail_' . $count_blog . '_' . $i] = $st_detail;
                $_SESSION['sub_title_section_' . $count_blog . '_' . $i] = $sec_type;
                $_SESSION['title_date_in_' . $count_blog] = date('Y-m-d H:i:s');
            }
        }
        break;
    }
}

$count_blog = 1;
if (!isset($_SESSION['title_1'])) {
    $_SESSION['title_now'] = 1;
} else {
    while (isset($_SESSION['title_' . $count_blog])) {
        $_SESSION['title_now'] = $count_blog;

        if (!isset($_SESSION['title_id_' . $count_blog])) {
            echo '<br>' . $count_blog;
            // Title doesn't exist, insert a new record
            $t_name = $_SESSION['title_' . $count_blog];
            $title_color = isset($_SESSION['title_color_' . $count_blog]) ? $_SESSION['title_color_' . $count_blog] : null;
            $title_detail = isset($_SESSION['title_detail_' . $count_blog]) ? $_SESSION['title_detail_' . $count_blog] : null;
            $title_file = isset($_SESSION['title_file_' . $count_blog]) ? $_SESSION['title_file_' . $count_blog] : null;
            $_SESSION['title_date_in_' . $count_blog] = date('Y-m-d H:i:s');

            mysqli_stmt_bind_param($stmt_insert_topic, "sssi", $t_name, $title_detail, $title_color, $e_id);
            mysqli_stmt_execute($stmt_insert_topic);

            $last_inserted_id = mysqli_insert_id($conn);

            if ($title_file) {
                $sql_insert_pic = "INSERT INTO picture (p_pic, p_date_in, t_id) VALUES (?, NOW(), ?)";
                $stmt_pic = mysqli_prepare($conn, $sql_insert_pic);
                mysqli_stmt_bind_param($stmt_pic, "si", $title_file, $last_inserted_id);
                mysqli_stmt_execute($stmt_pic);
                mysqli_stmt_close($stmt_pic);
            }

            if ($last_inserted_id > 0) {
                $_SESSION['title_id_' . $count_blog] = $last_inserted_id;
            } else {
                // Insertion failed
            }

            for ($i = 1; $i <= 4; $i++) {
                $last_inserted_id;

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

                $sql_insert_st = "INSERT INTO sub_topic (st_main, st_detail, st_date_in, t_id, st_type_sec) VALUES (?, ?, NOW(), ?, ?)";
                $stmt_insert_st = mysqli_prepare($conn, $sql_insert_st);
                mysqli_stmt_bind_param($stmt_insert_st, "ssii", $st_name, $st_detail, $last_inserted_id, $sec_type);
                mysqli_stmt_execute($stmt_insert_st);

                $last_sub_topic_id = mysqli_insert_id($conn);

                $_SESSION['sub_title_id_' . $count_blog . '_' . $i] = $last_sub_topic_id;
                $_SESSION['sub_title_' . $count_blog . '_' . $i] = $st_name;
                $_SESSION['sub_title_detail_' . $count_blog . '_' . $i] = $st_detail;
                $_SESSION['sub_title_section_' . $count_blog . '_' . $i] = $sec_type;
            }
        } else {
            // Title exists, update existing record
            $title_id = $_SESSION['title_id_' . $count_blog];
            $t_name = $_SESSION['title_' . $count_blog];
            $title_color = isset($_SESSION['title_color_' . $count_blog]) ? $_SESSION['title_color_' . $count_blog] : null;
            $title_detail = isset($_SESSION['title_detail_' . $count_blog]) ? $_SESSION['title_detail_' . $count_blog] : null;
            $title_file = isset($_SESSION['title_file_' . $count_blog]) ? $_SESSION['title_file_' . $count_blog] : null;

            $sql_sub_top = "SELECT * FROM topic WHERE t_id = ? AND del_flg = 0";
            $stmt = mysqli_prepare($conn, $sql_sub_top);
            mysqli_stmt_bind_param($stmt, "i", $title_id);
            mysqli_stmt_execute($stmt);
            $result_sub_top = mysqli_stmt_get_result($stmt);
            $row_topic = mysqli_fetch_array($result_sub_top);

            $sql_update_topic = "UPDATE topic SET t_name=?,t_detail=?,t_color=? WHERE t_id = ?";
            $stmt_update_topic = mysqli_prepare($conn, $sql_update_topic);
            mysqli_stmt_bind_param($stmt_update_topic, "sssi", $t_name, $title_detail, $title_color, $title_id);
            mysqli_stmt_execute($stmt_update_topic);
            mysqli_stmt_close($stmt_update_topic);

            $_SESSION['title_date_in_' . $count_blog] = $row_topic['t_date_in'];

            // Check if a picture is associated with the title
            if ($title_file) {
                // Check if a picture already exists for the title
                $sql_pic = "SELECT * FROM picture WHERE t_id = ? AND del_flg = 0";
                $stmt_pic = mysqli_prepare($conn, $sql_pic);
                mysqli_stmt_bind_param($stmt_pic, "i", $title_id);
                mysqli_stmt_execute($stmt_pic);
                $result_pic = mysqli_stmt_get_result($stmt_pic);
                $row_pic = mysqli_fetch_array($result_pic);

                if ($row_pic) {
                    // Update existing picture record
                    $sql_update_pic = "UPDATE picture SET p_pic=?, p_update=NOW() WHERE t_id = ?";
                    $stmt_update_pic = mysqli_prepare($conn, $sql_update_pic);
                    mysqli_stmt_bind_param($stmt_update_pic, "si", $title_file, $title_id);
                    mysqli_stmt_execute($stmt_update_pic);
                    mysqli_stmt_close($stmt_update_pic);
                } else {
                    // Insert a new picture record
                    $sql_insert_pic = "INSERT INTO picture (p_pic, p_date_in, t_id) VALUES (?, NOW(), ?)";
                    $stmt_insert_pic = mysqli_prepare($conn, $sql_insert_pic);
                    mysqli_stmt_bind_param($stmt_insert_pic, "si", $title_file, $title_id);
                    mysqli_stmt_execute($stmt_insert_pic);
                    mysqli_stmt_close($stmt_insert_pic);
                }

                // Close the result set for the picture query
                mysqli_free_result($result_pic);
            }

            // Now, update the sub-topics (if any)
            $sub_title_count = 1;

            $sql_st = "SELECT * FROM sub_topic WHERE t_id = ? AND del_flg = 0";
            $stmt_st = mysqli_prepare($conn, $sql_st);
            mysqli_stmt_bind_param($stmt_st, "i", $title_id);
            mysqli_stmt_execute($stmt_st);
            $result_st = mysqli_stmt_get_result($stmt_st);

            if (mysqli_num_rows($result_st) > 0) {
                while ($row_st = mysqli_fetch_array($result_st)) {
                    // Check if session variables are set for sub-topics
                    if (isset($_SESSION['sub_title_id_' . $count_blog . '_' . $sub_title_count])) {
                        $st_id = $_SESSION['sub_title_id_' . $count_blog . '_' . $sub_title_count];
                        $st_main = $_SESSION['sub_title_' . $count_blog . '_' . $sub_title_count];
                        $st_detail = $_SESSION['sub_title_detail_' . $count_blog . '_' . $sub_title_count];
                        $st_type_sec = $_SESSION['sub_title_section_' . $count_blog . '_' . $sub_title_count];

                        // Update sub-topic using prepared statement
                        $sql_st_update = "UPDATE sub_topic SET st_main=?, st_detail=?, st_update=NOW() WHERE st_id = ?";
                        $stmt_update_st = mysqli_prepare($conn, $sql_st_update);
                        mysqli_stmt_bind_param($stmt_update_st, "ssi", $st_main, $st_detail, $st_id);
                        mysqli_stmt_execute($stmt_update_st);
                        mysqli_stmt_close($stmt_update_st);

                        $sub_pic_count = 1;
                        $sql_pic = "SELECT * FROM picture WHERE st_id = ? AND del_flg = 0";
                        $stmt_pic = mysqli_prepare($conn, $sql_pic);
                        mysqli_stmt_bind_param($stmt_pic, "i", $st_id);
                        mysqli_stmt_execute($stmt_pic);
                        $result_pic = mysqli_stmt_get_result($stmt_pic);

                        while ($row_pic = mysqli_fetch_array($result_pic)) {
                            if (isset($_SESSION['sub_title_pic_' . $count_blog . '_' . $sub_title_count . '_' . $sub_pic_count])) {
                                $p_pic = $_SESSION['sub_title_pic_' . $count_blog . '_' . $sub_title_count . '_' . $sub_pic_count];

                                // Update picture using prepared statement
                                $sql_pic_update = "UPDATE picture SET p_pic=?, p_update=NOW() WHERE st_id = ?";
                                $stmt_update_pic = mysqli_prepare($conn, $sql_pic_update);
                                mysqli_stmt_bind_param($stmt_update_pic, "si", $p_pic, $st_id);
                                mysqli_stmt_execute($stmt_update_pic);
                                mysqli_stmt_close($stmt_update_pic);
                            }
                            $sub_pic_count++;
                        }
                    }
                    $sub_title_count++;
                }
            }
            // Close prepared statements and database connection if necessary
            mysqli_stmt_close($stmt_st);
        }
        $count_blog++;
    }
}

mysqli_close($conn);

// header("Location: edit_profile.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../image/icon/logo.png">
    <title>
        Listview Blog - HolyDay
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-100">

    <!-- Start SideBar  -->

    <?php include('bar/sidebar.php'); ?>

    <!-- End SideBar  -->

    </aside>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <?php include('bar/navbar.php'); ?>
        <!-- End Navbar -->
        <div class="container-fluid">
            <!-- <div class="row">
                <div class="col-md">
                    <div class="row">
                        <div class="col-md-6 mb-xl-0 mb-4">
                            <div class="card bg-transparent shadow-xl">
                                <div class="overflow-hidden position-relative border-radius-xl" style="background-image: url('../assets/img/curved-images/curved14.jpg');">
                                    <span class="mask bg-gradient-dark"></span>
                                    <div class="card-body position-relative z-index-1 p-3">
                                        <i class="fas fa-wifi text-white p-2"></i>
                                        <h5 class="text-white mt-4 mb-5 pb-2">

                                        </h5>
                                        <div class="d-flex">
                                            <div class="d-flex">
                                                <div class="me-4">
                                                    <p class="text-white text-sm opacity-8 mb-0">Card Holder</p>
                                                    <h6 class="text-white mb-0">Jack Peterson</h6>
                                                </div>
                                                <div>
                                                    <p class="text-white text-sm opacity-8 mb-0">Expires</p>
                                                    <h6 class="text-white mb-0">11/22</h6>
                                                </div>
                                            </div>
                                            <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                                                <img class="w-60 mt-2" src="../assets/img/logos/mastercard.png" alt="logo">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header mx-4 p-3 text-center">
                                            <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                                <i class="fas fa-landmark opacity-10"></i>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0 p-3 text-center">
                                            <h6 class="text-center mb-0">Salary</h6>
                                            <span class="text-xs">Belong Interactive</span>
                                            <hr class="horizontal dark my-3">
                                            <h5 class="mb-0">+$2000</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-md-0 mt-4">
                                    <div class="card">
                                        <div class="card-header mx-4 p-3 text-center">
                                            <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                                <i class="fab fa-paypal opacity-10"></i>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0 p-3 text-center">
                                            <h6 class="text-center mb-0">Paypal</h6>
                                            <span class="text-xs">Freelance Payment</span>
                                            <hr class="horizontal dark my-3">
                                            <h5 class="mb-0">$455.00</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="row">
                <div class="col-md mt-4">
                    <div class="card">
                        <div class="card-header pb-0 px-3">
                            <h6 class="mb-0 mr-4" style="display: inline-block;">Your Blog</h6>
                            <a href="create_blog.php?blog=<?= $count_blog ?>" class="btn btn-primary ml-4" style="display: inline-block;"><i class="fa fa-plus"></i></a>
                        </div>
                        <div class="card-body pt-4 p-3">
                            <ul class="list-group">
                                <?php if (isset($_SESSION['title_1'])) {
                                    $count_all_blog = 1;
                                    while (isset($_SESSION['title_' . $count_all_blog])) {
                                ?>
                                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                            <div class="d-flex flex-column">

                                                <h6 class="mb-3 text-sm"><?= $_SESSION['title_' . $count_all_blog] ?></h6>
                                                <!-- <span class="text-xs">หมายเลข : <span class="text-dark ms-sm-2 font-weight-bold"><?= $_SESSION['title_id_' . $count_all_blog] ?></span></span> -->
                                                <span class="mb-2 text-xs">Sub Title : <span class="text-dark font-weight-bold ms-sm-2">
                                                        <?php
                                                        $sub_title = 1;
                                                        while (isset($_SESSION['sub_title_' . $count_all_blog . '_' . $sub_title])) {
                                                            $sub_title++;
                                                        }
                                                        $sub_title -= 1;

                                                        if ($sub_title == 0) {
                                                            echo 'ไม่มีหัวข้อย่อย';
                                                        } else {
                                                            echo $sub_title . ' หัวข้อย่อย';
                                                        }
                                                        ?>
                                                    </span></span>
                                                <span class="mb-2 text-xs">วันที่สร้าง : <span class="text-dark ms-sm-2 font-weight-bold"><?= $_SESSION['title_date_in_' . $count_all_blog] ?></span></span>

                                            </div>
                                            <div class="ms-auto text-end">
                                                <!-- <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="rememberMe<?= $_SESSION['title_id_' . $count_all_blog] ?>" checked>
                                                    <label class="form-check-label" for="rememberMe<?= $_SESSION['title_id_' . $count_all_blog] ?>" id="checked_pub<?= $_SESSION['title_id_' . $count_all_blog] ?>"></label>
                                                </div>

                                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                                <script>
                                                    $(document).ready(function() {
                                                        // Function to update the label text based on the checkbox state
                                                        function updateLabel() {
                                                            var isChecked = $("#rememberMe<?= $_SESSION['title_id_' . $count_all_blog] ?>").is(":checked");
                                                            var label = isChecked ? "public" : "private";
                                                            $("#checked_pub<?= $_SESSION['title_id_' . $count_all_blog] ?>").text(label);
                                                        }

                                                        // Initial update
                                                        updateLabel();

                                                        // Bind a change event to the checkbox
                                                        $("#rememberMe<?= $_SESSION['title_id_' . $count_all_blog] ?>").change(function() {
                                                            updateLabel();
                                                        });
                                                    });
                                                </script> -->

                                                <button class="btn btn-link text-success text-gradient px-3 mb-0" id="public-button-<?= $count_all_blog ?>" data-blogid="<?= $_SESSION['title_id_' . $count_all_blog] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="แสดงสู่สาธารณะ">
                                                    <i class="fa fa-group"></i> Public
                                                </button>

                                                <script>
                                                    // Add an event listener to the "Delete" button
                                                    document.getElementById('public-button-<?= $count_all_blog ?>').addEventListener('click', function() {
                                                        // Get the blog ID from the data-blogid attribute
                                                        var blogId = this.getAttribute('data-blogid');

                                                        // Show a SweetAlert confirmation dialog
                                                        Swal.fire({
                                                            title: 'คุณแน่ใจที่จะแสดงแบบสาธารณะหรือไม่?',
                                                            text: 'หัวข้อ \"<?= $_SESSION['title_' . $count_all_blog] ?>\" จะแสดงในหน้าเว็บหลัก',
                                                            icon: 'question',
                                                            showCancelButton: true,
                                                            confirmButtonColor: '#3085d6',
                                                            cancelButtonColor: '#d33',
                                                            confirmButtonText: 'Yes, Show it!'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                // Redirect to "delete_blog.php" with the blog ID parameter
                                                                window.location.href = "action/public_blog.php?blog=" + blogId + "&session=" + <?= $count_all_blog ?>;
                                                            }
                                                        });
                                                    });
                                                </script>

                                                <!-- <button class="btn btn-link text-primary text-gradient px-3 mb-0" id="delete-button-<?= $count_all_blog ?>" data-blogid="<?= $_SESSION['title_id_' . $count_all_blog] ?>">
                                                    <i class="far fa-trash-alt me-2"></i>Private
                                                </button> -->


                                                <button class="btn btn-link text-danger text-gradient px-3 mb-0" id="delete-button-<?= $count_all_blog ?>" data-blogid="<?= $_SESSION['title_id_' . $count_all_blog] ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="ลบรายการ">
                                                    <i class="far fa-trash-alt me-2"></i>Delete
                                                </button>

                                                <script>
                                                    // Add an event listener to the "Delete" button
                                                    document.getElementById('delete-button-<?= $count_all_blog ?>').addEventListener('click', function() {
                                                        // Get the blog ID from the data-blogid attribute
                                                        var blogId = this.getAttribute('data-blogid');

                                                        // Show a SweetAlert confirmation dialog
                                                        Swal.fire({
                                                            title: 'คุณแน่ใจที่จะลบหรือไม่?',
                                                            text: 'หัวข้อ \"<?= $_SESSION['title_' . $count_all_blog] ?>\" จะถูกลบ!',
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: '#d33',
                                                            cancelButtonColor: '#3085d6',
                                                            confirmButtonText: 'Yes, delete it!'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                // Redirect to "delete_blog.php" with the blog ID parameter
                                                                window.location.href = "action/delete_blog.php?blog=" + blogId + "&session=" + <?= $count_all_blog ?>;
                                                            }
                                                        });
                                                    });
                                                </script>
                                                <a class="btn btn-link text-dark px-3 mb-0" href="create_blog.php?blog=<?= $count_all_blog ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="แก้ไข"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                                            </div>
                                        </li>
                                    <?php
                                        $count_all_blog++;
                                    }
                                } else {
                                    ?>
                                    <center>
                                        <h4>ไม่มีข้อมูล</h4>
                                        <br>
                                    </center>
                                <?php
                                } ?>

                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer pt-3  ">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                © <script>
                                    document.write(new Date().getFullYear())
                                </script>,
                                made with <i class="fa fa-heart"></i> by
                                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                                for a better web.
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>
    <div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="fa fa-cog py-2"> </i>
        </a>
        <div class="card shadow-lg ">
            <div class="card-header pb-0 pt-3 ">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">Soft UI Configurator</h5>
                    <p>See our dashboard options.</p>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0">
                <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">Sidebar Colors</h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-start">

                        <span class="badge filter bg-gradient-primary " data-color="primary" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-warning active" data-color="warning" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
                    </div>
                </a>
                <!-- Sidenav Type -->
                <div class="mt-3">
                    <h6 class="mb-0">Sidenav Type</h6>
                    <p class="text-sm">Choose between 2 different sidenav types.</p>
                </div>
                <div class="d-flex">
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2 active" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
                </div>
                <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                <!-- Navbar Fixed -->
                <div class="mt-3">
                    <h6 class="mb-0">Navbar Fixed</h6>
                </div>
                <div class="form-check form-switch ps-0">
                    <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
                </div>
                <hr class="horizontal dark my-sm-4">
                <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/soft-ui-dashboard">Free Download</a>
                <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/license/soft-ui-dashboard">View documentation</a>
                <div class="w-100 text-center">
                    <a class="github-button" href="https://github.com/creativetimofficial/soft-ui-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/soft-ui-dashboard on GitHub">Star</a>
                    <h6 class="mt-3">Thank you for sharing!</h6>
                    <a href="https://twitter.com/intent/tweet?text=Check%20Soft%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/soft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($_SESSION['delete-blog'])) {  ?>
        <script>
            let timerInterval
            Swal.fire({
                title: 'ทำการลบ \"<?= $_SESSION['delete-blog'] ?>\" เสร็จสิ้น!',
                html: 'ปิดการแจ้งเตือนอัตโนมัติใน <b></b> ',
                timer: 3000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('I was closed by the timer')
                }
            })
        </script>

    <?php
        unset($_SESSION['delete-blog']);
    } ?>

    <?php if (isset($_SESSION['show-blog'])) {  ?>
        <script>
            Swal.fire({
                title: 'แสดง \"<?= $_SESSION['show-blog'] ?>\" เสร็จสิ้น!',
                html: 'ปิดการแจ้งเตือนอัตโนมัติใน <b></b> ',
                timer: 3000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('I was closed by the timer')
                }
            })
        </script>

    <?php
        unset($_SESSION['show-blog']);
    } ?>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>

</html>