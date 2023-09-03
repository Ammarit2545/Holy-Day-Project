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
session_start();
include('../database/condb.php');

$active = array();
$active[5] = "active";

$page = 'Create Blog';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../image/icon/logo.png">
    <title>
        Soft UI Dashboard by Creative Tim
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <link href="css/create_blog.css" rel="stylesheet" />
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
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">

                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h1 class="accordion-header" id="headingOne" hidden>
                                    <!-- <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> -->
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" data-bs-toggle="tooltip" data-bs-placement="left" title="ข้อมูลส่วนตัวของคุณ">
                                        <h2>Your Information</h2>
                                    </button>
                                </h1>

                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-xl-8 mb-xl-0 mb-4">
                                                <div class="card bg-transparent shadow-xl">
                                                    <div class="overflow-hidden position-relative border-radius-xl" style="background-image: url('../assets/img/curved-images/curved14.jpg');">
                                                        <span class="mask bg-gradient-dark"></span>
                                                        <div class="card-body position-relative z-index-1 p-3">
                                                            <i class="fas fa-wifi text-white p-2"></i>
                                                            <h5 class="text-white mt-4 mb-5 pb-2"><?= $_SESSION["fname"] . ' ' . $_SESSION["lname"]  ?></h5>
                                                            <div class="d-flex">
                                                                <div class="d-flex">
                                                                    <div class="me-4">
                                                                        <p class="text-white text-sm opacity-8 mb-0">Email</p>
                                                                        <h6 class="text-white mb-0"><?= $_SESSION["email"] ?></h6>
                                                                    </div>
                                                                    <div>
                                                                        <p class="text-white text-sm opacity-8 mb-0">Role</p>
                                                                        <h6 class="text-white mb-0">
                                                                            <?php
                                                                            $role_id = $_SESSION["role_id"];
                                                                            $sql_role = "SELECT r_name FROM role WHERE r_id = '$role_id' AND del_flg = '0'";
                                                                            $result_role = mysqli_query($conn, $sql_role);
                                                                            $row_role = mysqli_fetch_array($result_role);
                                                                            if ($row_role['r_name'] != NULL) {
                                                                                echo $row_role['r_name'];
                                                                            } else {
                                                                                echo 'not found role id ' . $role_id;
                                                                            }
                                                                            ?>
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                                <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                                                                    <!-- <img class="w-60 mt-2" src="../assets/img/logos/mastercard.png" alt="logo"> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="card-header mx-4 p-3 text-center">
                                                                <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                                                    <i class="fas fa-landmark opacity-10"></i>
                                                                </div>
                                                            </div>
                                                            <div class="card-body pt-0 p-3 text-center">
                                                                <h6 class="text-center mb-0">Your Blog</h6>
                                                                <span class="text-xs">All Block Do You Have</span>
                                                                <hr class="horizontal dark my-3">
                                                                <h5 class="mb-0">
                                                                    <?php
                                                                    $e_id = $_SESSION["id"];
                                                                    $sql_t = "SELECT COUNT(t_id) AS count FROM topic WHERE e_id = '$e_id' AND del_flg = '0'";
                                                                    $result_t = mysqli_query($conn, $sql_t);
                                                                    $row_t = mysqli_fetch_array($result_t);
                                                                    if ($row_t['count'] != NULL) {
                                                                        echo $row_t['count'];
                                                                    }
                                                                    // elseif($row_t['count'] == 0){
                                                                    //     echo 'Don\'t Have Your Blog';
                                                                    // }
                                                                    else {
                                                                        echo 'not found';
                                                                    }
                                                                    ?>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-6 mt-md-0 mt-4">
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
                                </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr>

                        <h1 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" data-bs-toggle="tooltip" data-bs-placement="left" title="ข้อมูลส่วนตัวของคุณ">
                                <h2>Create Your Blog</h2>
                            </button>
                        </h1>

                        <div class="col-md-12 mb-lg-0 mb-4">
                            <div class="card mt-4">
                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-6 d-flex align-items-center">
                                            <h6 class="mb-0">Your Title</h6>
                                        </div>
                                        <div class="col-6 text-end">

                                            <label for="titleFile" style="cursor: pointer; color: white;">
                                                <!-- <i class="fas fa-pencil-alt ms-auto cursor-pointer w-5 mb-0 p-4" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit BG" style="color : white"></i> -->
                                                <i class="fas fa-file w-5 mb-0 p-4 ms-auto cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Change Background" aria-hidden="true" style="color:gray"></i>
                                            </label>
                                            <label for="titleColor" style="cursor: pointer; color: white;">
                                                <!-- <i class="fa fa-color w-5 mb-0 p-4" aria-hidden="true"></i> -->
                                                <i class="fa fa-paint-brush w-5 mb-0 p-4" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="top" title="Change Color Text" style="color:gray"></i>
                                            </label>
                                            <a class="btn bg-gradient-dark mb-0" href="javascript:;"><i class="fas fa-desktop"></i>&nbsp;&nbsp;See Demo Web</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row">
                                        <!-- <div class="col-md mb-md-0 mb-4">
                                            <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                                <i class="fa fa-book w-5 mb-0 p-4" aria-hidden="true"></i>
                                                <input type="text" class="form-control mb-0 mr-1">
                                                <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer w-5 mb-0 p-4" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Card"></i>
                                            </div>
                                        </div> -->
                                        <div class="col-md-12 mb-md-0 mb-4">
                                            <style>
                                                /* Hide the input background and border */
                                                .invisible-input {
                                                    border: none;
                                                    background-color: transparent;
                                                    /* Set background color to transparent */
                                                    color: transparent;
                                                    font-size: 1.5rem;
                                                    /* Adjust font size as needed */
                                                    font-weight: bold;
                                                    /* Make it bold like an h4 */
                                                    color: white;
                                                    text-shadow: 0 0 3px black;
                                                }

                                                /* Show the placeholder text */
                                                .invisible-input::placeholder {
                                                    border: none;
                                                    background-color: transparent;
                                                    color: initial;
                                                    color: white;
                                                    text-shadow: 0 0 3px black;
                                                    /* Change this to the desired placeholder text color */
                                                }

                                                /* Show the text value in white when input has a value */
                                                .invisible-input:not(:placeholder-shown) {
                                                    text-shadow: 0 0 3px black;
                                                    border: none;
                                                    background-color: transparent;
                                                    <?php if (isset($_SESSION['title_color'])) { ?>color: <?= $_SESSION['title_color'] ?>;
                                                    <?php } else { ?>color: white;
                                                    /* Default text color */
                                                    <?php } ?>
                                                    /* Change this to the desired text color */
                                                }


                                                #image_bg_back {
                                                    background: url('<?= $_SESSION['title_file'] ?>');
                                                    background-color: gray;
                                                    background-size: 100%;
                                                }

                                                #icon-title {
                                                    text-shadow: 0 0 3px black;
                                                    color: white;
                                                }
                                            </style>
                                            <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row" style="background-color: gray;" id="image_bg_back">
                                                <i class="fa fa-book w-5 mb-0 p-4" aria-hidden="true" style="text-shadow: 0 0 3px black; color:white"></i>

                                                <input type="text" name="title" id="titleInput" class="invisible-input form-control mb-0 mr-1" placeholder="Your Title" value="<?php if (isset($_SESSION['title'])) {
                                                                                                                                                                                    echo $_SESSION['title'];
                                                                                                                                                                                } ?>" data-bs-toggle="tooltip" data-bs-placement="left" title="หัวข้อหลัก" required>


                                                <!-- <div style="background-color: gray;">
                                                    
                                                    <label for="titleFile" style="cursor: pointer; color: white;">
                                                     
                                                        <i class="fas fa-file w-5 mb-0 p-4 ms-auto cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Change Background" aria-hidden="true" style="text-shadow: 0 0 3px black; color:white"></i>
                                                    </label>
                                                    <label for="titleColor" style="cursor: pointer; color: white;">
                                                        <i class="fa fa-paint-brush w-5 mb-0 p-4" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="top" title="Change Color Text" style="text-shadow: 0 0 3px black; color:white"></i>
                                                    </label>
                                                </div> -->

                                                <!-- Your file input remains unchanged -->
                                                <form id="upload_image" action="action/upload_image_title.php" method="POST" enctype="multipart/form-data">
                                                    <input type="file" class="invisible-input form-control" id="titleFile" name="title_file" placeholder="Your File" style="display: none;" required hidden>
                                                </form>
                                                <input type="color" class="invisible-input form-control w-0" id="titleColor" name="title_color" placeholder="Your Title" value="<?php if (isset($_SESSION['title_color'])) {
                                                                                                                                                                                    echo $_SESSION['title_color'];
                                                                                                                                                                                } ?>" required hidden>
                                                <script>
                                                    // When a file is selected, trigger the form submission
                                                    $('#titleFile').on('change', function() {
                                                        $('#upload_image').submit();
                                                    });
                                                </script>
                                                <script>
                                                    $(document).ready(function() {
                                                        // Listen for changes in the color input field
                                                        $('#titleColor').on('input', function() {
                                                            var selectedColor = $(this).val();
                                                            $('#titleInput').css('color', selectedColor);
                                                        });
                                                    });
                                                </script>

                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-md-0 mb-4" hidden>
                                            <div class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row" id="image_bg_back">


                                            </div>
                                        </div>
                                        <script>
                                            const inputs = document.querySelectorAll('.invisible-input');

                                            inputs.forEach(input => {
                                                input.addEventListener('input', function() {
                                                    if (this.value.trim() !== '') {
                                                        this.classList.add('has-content');
                                                        updateSession(this);
                                                    } else {
                                                        this.classList.remove('has-content');
                                                    }
                                                });
                                            });

                                            function updateSession(input) {
                                                const name = input.getAttribute('name');
                                                const value = input.value;

                                                // Create an AJAX request to update the session based on input name
                                                const xhr = new XMLHttpRequest();
                                                xhr.open('POST', 'action/update-session.php'); // Use the same PHP script for all inputs
                                                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                                                // Send the data as a single string in the request body
                                                const data = `name=${encodeURIComponent(name)}&value=${encodeURIComponent(value)}`;
                                                xhr.send(data);

                                                // Handle the response if needed
                                                xhr.onload = function() {
                                                    if (xhr.status === 200) {
                                                        const response = JSON.parse(xhr.responseText);
                                                        console.log(response.message); // You can handle the response here
                                                    } else {
                                                        console.error('Error:', xhr.statusText);
                                                    }
                                                };
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>



                <!-- <div class="col-lg-4">
                    <div class="card h-100">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="mb-0">Invoices</h6>
                                </div>
                                <div class="col-6 text-end">
                                    <button class="btn btn-outline-primary btn-sm mb-0">View All</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3 pb-0">
                            <ul class="list-group">
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark font-weight-bold text-sm">March, 01, 2020</h6>
                                        <span class="text-xs">#MS-415646</span>
                                    </div>
                                    <div class="d-flex align-items-center text-sm">
                                        $180
                                        <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i class="fas fa-file-pdf text-lg me-1"></i> PDF</button>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="text-dark mb-1 font-weight-bold text-sm">February, 10, 2021</h6>
                                        <span class="text-xs">#RV-126749</span>
                                    </div>
                                    <div class="d-flex align-items-center text-sm">
                                        $250
                                        <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i class="fas fa-file-pdf text-lg me-1"></i> PDF</button>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="text-dark mb-1 font-weight-bold text-sm">April, 05, 2020</h6>
                                        <span class="text-xs">#FB-212562</span>
                                    </div>
                                    <div class="d-flex align-items-center text-sm">
                                        $560
                                        <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i class="fas fa-file-pdf text-lg me-1"></i> PDF</button>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="text-dark mb-1 font-weight-bold text-sm">June, 25, 2019</h6>
                                        <span class="text-xs">#QW-103578</span>
                                    </div>
                                    <div class="d-flex align-items-center text-sm">
                                        $120
                                        <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i class="fas fa-file-pdf text-lg me-1"></i> PDF</button>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="text-dark mb-1 font-weight-bold text-sm">March, 01, 2019</h6>
                                        <span class="text-xs">#AR-803481</span>
                                    </div>
                                    <div class="d-flex align-items-center text-sm">
                                        $300
                                        <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><i class="fas fa-file-pdf text-lg me-1"></i> PDF</button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="row">
                <div class="col-md-12 mt-4">
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="mb-0">Your Sub Title</h6>
                                </div>
                                <div class="col-6 text-end">
                                    <a class="btn bg-gradient-dark mb-0" href="javascript:;"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add New Card</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-4 p-3">
                            <ul class="list-group">
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">Oliver Liam</h6>
                                        <span class="mb-2 text-xs">Company Name: <span class="text-dark font-weight-bold ms-sm-2">Viking Burrito</span></span>
                                        <span class="mb-2 text-xs">Email Address: <span class="text-dark ms-sm-2 font-weight-bold">oliver@burrito.com</span></span>
                                        <span class="text-xs">VAT Number: <span class="text-dark ms-sm-2 font-weight-bold">FRB1235476</span></span>
                                    </div>
                                    <div class="ms-auto text-end">
                                        <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                        <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">Lucas Harper</h6>
                                        <span class="mb-2 text-xs">Company Name: <span class="text-dark font-weight-bold ms-sm-2">Stone Tech Zone</span></span>
                                        <span class="mb-2 text-xs">Email Address: <span class="text-dark ms-sm-2 font-weight-bold">lucas@stone-tech.com</span></span>
                                        <span class="text-xs">VAT Number: <span class="text-dark ms-sm-2 font-weight-bold">FRB1235476</span></span>
                                    </div>
                                    <div class="ms-auto text-end">
                                        <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                        <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                                    </div>
                                </li>
                                <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">Ethan James</h6>
                                        <span class="mb-2 text-xs">Company Name: <span class="text-dark font-weight-bold ms-sm-2">Fiber Notion</span></span>
                                        <span class="mb-2 text-xs">Email Address: <span class="text-dark ms-sm-2 font-weight-bold">ethan@fiber.com</span></span>
                                        <span class="text-xs">VAT Number: <span class="text-dark ms-sm-2 font-weight-bold">FRB1235476</span></span>
                                    </div>
                                    <div class="ms-auto text-end">
                                        <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                        <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-5 mt-4">
                    <div class="card h-100 mb-4">
                        <div class="card-header pb-0 px-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="mb-0">Your Transaction's</h6>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end align-items-center">
                                    <i class="far fa-calendar-alt me-2"></i>
                                    <small>23 - 30 March 2020</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-4 p-3">
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Newest</h6>
                            <ul class="list-group">
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-down"></i></button>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Netflix</h6>
                                            <span class="text-xs">27 March 2020, at 12:30 PM</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                                        - $ 2,500
                                    </div>
                                </li>
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></button>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Apple</h6>
                                            <span class="text-xs">27 March 2020, at 04:30 AM</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                        + $ 2,000
                                    </div>
                                </li>
                            </ul>
                            <h6 class="text-uppercase text-body text-xs font-weight-bolder my-3">Yesterday</h6>
                            <ul class="list-group">
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></button>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Stripe</h6>
                                            <span class="text-xs">26 March 2020, at 13:45 PM</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                        + $ 750
                                    </div>
                                </li>
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></button>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">HubSpot</h6>
                                            <span class="text-xs">26 March 2020, at 12:30 PM</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                        + $ 1,000
                                    </div>
                                </li>
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></button>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Creative Tim</h6>
                                            <span class="text-xs">26 March 2020, at 08:30 AM</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                        + $ 2,500
                                    </div>
                                </li>
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-icon-only btn-rounded btn-outline-dark mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-exclamation"></i></button>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Webflow</h6>
                                            <span class="text-xs">26 March 2020, at 05:00 AM</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center text-dark text-sm font-weight-bold">
                                        Pending
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> -->
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