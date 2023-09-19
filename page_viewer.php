<!-- 
    
!!!!!! Warning !!!!!!

- $_SESSION['check_watch'] 
- $_GET['blog];

-->

<?php

session_start();
include('database/condb.php');
// Assuming you have already started the session using session_start()

$blog_now = $_GET['blog'];

if (!isset($_SESSION['check_watch'])) {
    // Update the SQL query with proper syntax
    $sql = "UPDATE topic SET t_watch = t_watch + 1 WHERE t_id = ? AND t_test = 0 AND del_flg = 0";

    // Prepare the SQL statement
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "i", $blog_now); // Assuming $blog_now is an integer; change "i" to the appropriate type if needed

    // Execute the query
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Update successful
        mysqli_stmt_close($stmt);
        $_SESSION['check_watch'] = true; // Set the session variable to prevent further updates
    } else {
        // Handle the error here if the update fails
    }
}

$sql = "SELECT * FROM topic 
    LEFT JOIN picture ON picture.t_id = topic.t_id
    WHERE topic.t_id = '$blog_now' AND topic.t_test = 0 AND topic.del_flg = 0;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$e_id = $row['e_id'];
$t_id = $row['t_id'];

if ($row['t_id'] == NULL) {
    header('location:index.php');
}

// writer
$sql_e = "SELECT * FROM employee 
    LEFT JOIN role ON role.r_id = employee.r_id
    WHERE employee.e_id = '$e_id' AND employee.del_flg = 0 AND role.del_flg = 0;";
$result_e = mysqli_query($conn, $sql_e);
$row_e = mysqli_fetch_array($result_e);



?>
<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= $row['t_name'] ?>- Holy Day</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/media-queries.css">
    <link rel="stylesheet" href="sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="image/icon/logo.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="sweetalert2.all.min.js"></script>

    <!-- Your Custom JavaScript -->
    <script src="your-custom-script.js"></script>

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
            font-size: 120%;
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

        /* Show the placeholder text */
        .invisible-input,
        #title_detail {
            font-weight: lighter;
            border: none;
            background-color: transparent;
            color: initial;
            color: white;
            text-shadow: 0 0 3px black;
            /* Change this to the desired placeholder text color */
        }

        /* Show the text value in white when input has a value */
        .invisible-input:not(:placeholder-shown):not(#title_detail) {
            text-shadow: 0 0 3px black;
            border: none;
            background-color: transparent;
            <?php if ($row['t_color'] != NULL) { ?>color: <?= $row['t_color'] ?>;
            <?php } else { ?>color: white;
            /* Default text color */
            <?php } ?>
            /* Change this to the desired text color */
        }



        #image_bg_back {
            background: url('admin/<?= $row['p_pic'] ?>');
            background-color: gray;
            background-size: 100%;
        }

        #icon-title {
            text-shadow: 0 0 3px black;
            color: white;
        }

        #icon-image {
            /* Set initial properties */
            color: initial-color;
            transform: scale(1);
            transition: color 0.3s ease, transform 0.3s ease;
            /* Add transition for color and transform */
        }

        #icon-image:hover {
            color: white;
            /* Change color on hover */
            transform: scale(1.1);
            /* Scale up on hover */
        }
    </style>


</head>

<body>

    <!-- Wrapper -->
    <div class="wrapper">


        <!-- Dark overlay -->
        <div class="overlay"></div>

        <!-- Content -->
        <div class="content">

            <!-- Footer -->
            <?php include('bar/sidebar_viewer.php'); ?>

            <!-- open sidebar menu -->
            <a class="btn btn-primary btn-customized open-menu" href="#" role="button">
                <i class="fas fa-align-left"></i> <span>Menu</span>
            </a>

            <!-- open sidebar menu -->
            <div style="position: fixed; top: 20px; left: 10px; z-index: 997; box-shadow: 3px 3px 3px rgba(51, 51, 51, 0.2); background-color: black; padding: 20px; border-radius: 20%; color: gray; opacity: 0.8; font-size: 1vw;display:none">

                <!-- <label for="titleFile" style="cursor: pointer; color: white;">
                    <i class="fas fa-file w-5 mb-0 p-4 ms-auto cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Change Background" aria-hidden="true"></i>
                </label>
                <label for="titleColor" style="cursor: pointer; color: white;">
                    <i class="fa fa-paint-brush w-5 mb-0 p-4" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="top" title="Change Color Text"></i>
                </label> -->
                <a for="titleColor" style="cursor: pointer; color: white; text-decoration: none; text-decoration: none;" href="index.php">
                    <i class="fa fa-arrow-left w-5 mb-0 p-4" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="top" title="Back to Page"></i>
                </a>
                </span>
            </div>

            <!-- Top content -->
            <div style="<?php if ($row['p_pic'] != NULL || $row['p_pic'] != '') {

                        ?>background: url('admin/<?= $row['p_pic'] ?>');<?php } else {
                                                                        ?>background-color:gray;<?php
                                                                                            } ?> width: 100%; padding: 60px 0 120px 0; ">
                <div class="container">
                    <div class="row">
                        <div class="col col-md-10 offset-md-1 col-lg-8 offset-lg-2">

                            <h1 class="wow fadeIn text-center">
                                <input readonly type="text" name="title_<?= $blog_now ?>" id="titleInput" class="invisible-input form-control mb-0 mr-1 text-center" placeholder="* Your Title" value="<?= $row['t_name'] ?>" data-bs-toggle="tooltip" data-bs-placement="left" title="หัวข้อหลัก" required>
                            </h1>


                            <div class="description wow fadeInLeft">
                                <p>
                                    <style>
                                        /* CSS to make the textarea auto-resize */
                                        textarea.autosize {
                                            overflow-y: hidden;
                                        }
                                    </style>

                                    <textarea name="title_detail_<?= $blog_now ?>" id="title_detail" class="invisible-input form-control mb-0 mr-1 text-center autosize" placeholder="Your Detail Title" data-bs-toggle="tooltip" data-bs-placement="left" title="รายละเอียดหัวข้อหลัก" required readonly><?= $row['t_detail'] ?></textarea>
                                    <script>
                                        const inputs = document.querySelectorAll('.invisible-input, .invisible-textarea');

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
                                    <script>
                                        $(document).ready(function() {
                                            var textarea = document.getElementById('title_detail');

                                            // Set the height of the textarea to auto
                                            textarea.style.height = 'auto';

                                            // Set the textarea's height to its scrollHeight (content height)
                                            textarea.style.height = (textarea.scrollHeight) + 'px';
                                        });
                                    </script>


                                    <script>
                                        // JavaScript to make the textarea auto-resize
                                        var textarea = document.querySelector('textarea.autosize');

                                        textarea.addEventListener('input', function() {
                                            this.style.height = 'auto';
                                            this.style.height = (this.scrollHeight) + 'px';
                                        });
                                    </script>



                                </p>
                            </div>
                            <!-- <div class="buttons wow fadeInUp">
                                <a class="btn btn-primary btn-customized scroll-link" href="#section-1" role="button">
                                    <i class="fas fa-book-open"></i> Learn More
                                </a>
                                <a class="btn btn-primary btn-customized-2 scroll-link" href="#section-3" role="button">
                                    <i class="fas fa-pencil-alt"></i> Our Projects
                                </a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
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

            <br>
            <br>
            <br>
            <style>
                /* Define the initial and hover styles */
                #bounce-item {
                    display: block;
                    transition: transform 0.3s;
                    /* Add a smooth transition effect */
                    text-decoration: none;
                    /* Remove the underline */
                }

                #bounce-item:hover {
                    transform: scale(1.1);
                    /* Scale the element by 1.1 on hover */
                }
            </style>

            <!-- <a id="bounce-item" data-bs-toggle="tooltip" data-bs-placement="left" title="กดเพื่อเพิ่ม Section ใหม่">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="card" style="box-shadow: 2px 2px 5px black; opacity: 0.5;">
                                <div class="card-body">
                                    <h1 style="font-size: 300%; color: gray; font-weight: bold;">+</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <br><br>
            <button type="button" class="btn btn-primary" id="showModalButton">
                Launch demo modal
            </button> -->

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" width="700px">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="width: 1500px">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Choose Your Section</h5>
                        </div>
                        <div class="modal-body">
                            <h5>#1 Section</h5>
                            <!-- Section 1 Content -->
                            <!-- <d iv class="section-2-container section-container section-container-gray-bg" id="section-2">
                                <div class="container">
                                    <div class="row">
                                        <div class="col section-2 section-description wow fadeIn">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8 section-2-box wow fadeInLeft">
                                            <h3>About Us</h3>
                                            <p class="medium-paragraph" style="font-size:80%">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                                sed do eiusmod tempor incididunt ut labore et. Ut wisi enim ad minim veniam, quis nostrud.
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.
                                            </p>
                                        </div>
                                        <div class="col-4 section-2-box wow fadeInUp">
                                            <img src="assets/img/about-us.jpg" alt="about-us">
                                        </div>
                                    </div>
                                </div>
                            </d> -->
                            <!-- ... -->

                            <button type="button" class="btn btn-primary text-end" data-bs-dismiss="modal" aria-label="Close">Select</button>
                            <!-- ... -->

                            <hr>

                            <h5>#2 Section</h5>
                            <!-- Section 2 Content -->
                            <img src="image/example/Section2.PNG" alt="about-us">
                            <!-- ... -->

                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Select</button>
                        </div>
                        <div class="modal-footer">
                            <!-- Custom Close Button -->
                            <button type="button" id="btn-close-button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- JavaScript to open the modal -->
            <script>
                // Get a reference to the modal element by its ID
                var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));

                // Get a reference to the button that triggers the modal
                var showModalButton = document.getElementById('showModalButton');

                // Get a reference to the "Close" button in the modal
                var closeButton = document.getElementById('btn-close-button');

                // Add a click event listener to open the modal
                showModalButton.addEventListener('click', function() {
                    myModal.show();
                });

                // Add a click event listener to the "Close" button to close the modal
                closeButton.addEventListener('click', function() {
                    myModal.hide();
                });
            </script>




            <div class="modal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Modal body text goes here.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Section 1 -->
            <!-- <div class="section-1-container section-container" id="section-1">
                <div class="container">
                    <div class="row">
                        <div class="col section-1 section-description wow fadeIn">
                            <h2>What We Do</h2>
                            <div class="divider-1 wow fadeInUp"><span></span></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 section-1-box wow fadeInUp">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="section-1-box-icon">
                                        <i class="fas fa-magic"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h3>Branding</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 section-1-box wow fadeInDown">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="section-1-box-icon">
                                        <i class="fas fa-cog"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h3>Web design</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 section-1-box wow fadeInUp">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="section-1-box-icon">
                                        <i class="fab fa-twitter"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h3>Social media</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <?php
            $sub_title = 1;
            $Section_1 = 0;
            $t_id = $row['t_id'];

            $sql_t = "SELECT * FROM sub_topic WHERE t_id = '$t_id' AND del_flg = 0;";
            $result_t = mysqli_query($conn, $sql_t);

            while ($row_t = mysqli_fetch_array($result_t)) {
                $sub_title_section = $row_t['st_type_sec'];

                $sub_title_main =   $row_t['st_main'];
                $detail_sub_title =  $row_t['st_detail'];
                if ($sub_title_section == 1) {
                    $Section_1++;
                    $title_id = $row_t['st_id'];
                    $sql_select_pic = "SELECT p_pic FROM picture WHERE st_id = '$title_id'";
                    $result_pic = mysqli_query($conn, $sql_select_pic);


                    if (mysqli_num_rows($result_pic) > 0) {
                        $row_pic = mysqli_fetch_array($result_pic);  ?>
                        <style>
                            <?php
                            $file_name = $row_pic['p_pic'];
                            ?>@media only screen and (min-width: 767px) {
                                #picture<?= '_' . $blog_now . '_' . $sub_title ?> {
                                    width: 100%;
                                    /* Make the picture element span full width */
                                    padding: 0%;
                                    <?php
                                    if ($row_pic['p_pic'] != NULL) {
                                    ?>background-image: url('admin/<?= $row_pic['p_pic'] ?>');
                                    <?php
                                    } else {
                                    ?>background-image: url('image/example/black.PNG');
                                    <?php
                                    } ?>
                                }
                            }

                            @media only screen and (max-width: 767px) {
                                #picture<?= '_' . $blog_now . '_' . $sub_title ?> {
                                    width: 100%;
                                    /* Make the picture element span full width */
                                    padding: 10%;
                                    <?php
                                    if ($row_pic['p_pic'] != NULL) {
                                    ?>background-image: url('admin/<?= $row_pic['p_pic'] ?>');
                                    <?php
                                    } else {
                                    ?>background-image: url('image/example/black.PNG');
                                    <?php
                                    } ?>
                                }
                            }
                        </style>
                        <?php
                        if (($Section_1 % 2) == 0) { ?>
                            <!-- Section 1 -->
                            <d iv class="<?= $row_t['st_id'] ?>-container section-container section-container-gray-bg" id="<?= $row_t['st_id'] ?>">
                                <div class="container">
                                    <div class="row">
                                        <div class="col <?= $row_t['st_id'] ?> section-description wow fadeIn">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8 <?= $row_t['st_id'] ?>-box wow fadeInLeft">
                                            <h3>
                                                <textarea name="sub_title_<?= $blog_now ?>_<?= $sub_title ?>" id="sub_title_<?= $blog_now ?>_<?= $sub_title ?>" class="sub_title_<?= $blog_now ?>_<?= $sub_title ?>" style="width: 100%; border: none; background-color: transparent; color: black;" readonly><?= htmlentities($sub_title_main) ?></textarea>

                                            </h3>
                                            <p class="medium-paragraph">
                                                <textarea name="sub_title_detail_<?= $blog_now ?>_<?= $sub_title ?>" id="sub_title_detail_<?= $blog_now ?>_<?= $sub_title ?>" class="sub_title_detail_<?= $blog_now ?>_<?= $sub_title ?>" style="width: 100%; border: none; background-color: transparent; color: black;" readonly><?= htmlentities($detail_sub_title) ?></textarea>

                                                <script>
                                                    $(document).ready(function() {
                                                        var textarea = document.getElementById('sub_title_detail_<?= $blog_now ?>_<?= $sub_title ?>');

                                                        // Set the height of the textarea to auto
                                                        textarea.style.height = 'auto';

                                                        // Set the textarea's height to its scrollHeight (content height)
                                                        textarea.style.height = (textarea.scrollHeight) + 'px';
                                                    });
                                                </script>

                                                <script>
                                                    $(document).ready(function() {
                                                        var textarea = document.getElementById('sub_title_<?= $blog_now ?>_<?= $sub_title ?>');

                                                        // Set the height of the textarea to auto
                                                        textarea.style.height = 'auto';

                                                        // Set the textarea's height to its scrollHeight (content height)
                                                        textarea.style.height = (textarea.scrollHeight) + 'px';
                                                    });
                                                </script>
                                            </p>
                                        </div>
                                        <div class="col-md-4 <?= $row_t['st_main'] ?>-box wow fadeInUp" style="border-radius: 3%; display: flex; justify-content: center; align-items: center;" id="picture<?= '_' . $blog_now . '_' . $sub_title ?>">
                                            <label for="picture_blog<?= '_' . $blog_now . '_' . $sub_title ?>" style="cursor: pointer;" id="icon-image">

                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </d>
                        <?php } else { ?>
                            <!-- Section 2 -->
                            <d iv class="<?= $row_t['st_id'] ?>-container section-container section-container-gray-bg" id="<?= $row_t['st_id'] ?>">
                                <div class="container">
                                    <div class="row">
                                        <div class="col <?= $row_t['st_id'] ?> section-description wow fadeIn">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 <?= $row_t['st_id'] ?>-box wow fadeInUp" style="border-radius: 3%; display: flex; justify-content: center; align-items: center;" id="picture<?= '_' . $blog_now . '_' . $sub_title ?>">
                                            <label for="picture_blog<?= '_' . $blog_now . '_' . $sub_title ?>" style="cursor: pointer;" id="icon-image">

                                            </label>

                                        </div>
                                        <div class="col-8 <?= $row_t['st_id'] ?>-box wow fadeInLeft">
                                            <h3>
                                                <textarea readonly name="sub_title_<?= $blog_now ?>_<?= $sub_title ?>" id="sub_title_<?= $blog_now ?>_<?= $sub_title ?>" class="sub_title_<?= $blog_now ?>_<?= $sub_title ?>" style="width: 100%; border: none; background-color: transparent; color: black;"><?= htmlentities($sub_title_main) ?></textarea>

                                            </h3>
                                            <p class="medium-paragraph">
                                                <textarea readonly name="sub_title_detail_<?= $blog_now ?>_<?= $sub_title ?>" id="sub_title_detail_<?= $blog_now ?>_<?= $sub_title ?>" class="sub_title_detail_<?= $blog_now ?>_<?= $sub_title ?>" style="width: 100%; border: none; background-color: transparent; color: black;"><?= htmlentities($detail_sub_title) ?></textarea>

                                                <script>
                                                    $(document).ready(function() {
                                                        var textarea = document.getElementById('sub_title_detail_<?= $blog_now ?>_<?= $sub_title ?>');

                                                        // Set the height of the textarea to auto
                                                        textarea.style.height = 'auto';

                                                        // Set the textarea's height to its scrollHeight (content height)
                                                        textarea.style.height = (textarea.scrollHeight) + 'px';
                                                    });
                                                </script>

                                                <script>
                                                    $(document).ready(function() {
                                                        var textarea = document.getElementById('sub_title_<?= $blog_now ?>_<?= $sub_title ?>');

                                                        // Set the height of the textarea to auto
                                                        textarea.style.height = 'auto';

                                                        // Set the textarea's height to its scrollHeight (content height)
                                                        textarea.style.height = (textarea.scrollHeight) + 'px';
                                                    });
                                                </script>
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </d>
                        <?php
                        }
                    } else { ?>
                        <!-- Section 1 -->
                        <d iv class="<?= $row_t['st_id'] ?>-container section-container section-container-gray-bg" id="<?= $row_t['st_id'] ?>">
                            <div class="container">
                                <div class="row">
                                    <div class="col <?= $row_t['st_id'] ?> section-description wow fadeIn">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8 <?= $row_t['st_id'] ?>-box wow fadeInLeft">
                                        <h3>
                                            <textarea readonly name="sub_title_<?= $blog_now ?>_<?= $sub_title ?>" id="sub_title_<?= $blog_now ?>_<?= $sub_title ?>" class="sub_title_<?= $blog_now ?>_<?= $sub_title ?>" style="width: 100%; border: none; background-color: transparent; color: black;" readonly><?= htmlentities($sub_title_main) ?></textarea>

                                        </h3>
                                        <p class="medium-paragraph">
                                            <textarea readonly name="sub_title_detail_<?= $blog_now ?>_<?= $sub_title ?>" id="sub_title_detail_<?= $blog_now ?>_<?= $sub_title ?>" class="sub_title_detail_<?= $blog_now ?>_<?= $sub_title ?>" style="width: 100%; border: none; background-color: transparent; color: black;" readonly><?= htmlentities($detail_sub_title) ?></textarea>

                                            <script>
                                                $(document).ready(function() {
                                                    var textarea = document.getElementById('sub_title_detail_<?= $blog_now ?>_<?= $sub_title ?>');

                                                    // Set the height of the textarea to auto
                                                    textarea.style.height = 'auto';

                                                    // Set the textarea's height to its scrollHeight (content height)
                                                    textarea.style.height = (textarea.scrollHeight) + 'px';
                                                });
                                            </script>

                                            <script>
                                                $(document).ready(function() {
                                                    var textarea = document.getElementById('sub_title_<?= $blog_now ?>_<?= $sub_title ?>');

                                                    // Set the height of the textarea to auto
                                                    textarea.style.height = 'auto';

                                                    // Set the textarea's height to its scrollHeight (content height)
                                                    textarea.style.height = (textarea.scrollHeight) + 'px';
                                                });
                                            </script>
                                        </p>
                                    </div>
                                    <div class="col-md-4 <?= $row_t['st_main'] ?>-box wow fadeInUp" style="border-radius: 3%; display: flex; justify-content: center; align-items: center;" id="picture<?= '_' . $blog_now . '_' . $sub_title ?>">
                                        <label for="picture_blog<?= '_' . $blog_now . '_' . $sub_title ?>" style="cursor: pointer;" id="icon-image">

                                        </label>
                                    </div>
                                </div>
                            </div>
                        </d>
                    <?php
                    }
                }
                if ($sub_title_section == 2) {  ?>
                    <!-- Section 1 -->
                    <d iv class="<?= $row_t['st_id'] ?>-container section-container section-container-gray-bg" id="<?= $row_t['st_id'] ?>">
                        <div class="container">
                            <div class="row">
                                <div class="col <?= $row_t['st_id'] ?> section-description wow fadeIn">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col <?= $row_t['st_id'] ?>-box wow fadeInLeft">
                                    <h3><?= $sub_title_main  ?></h3>
                                    <p class="medium-paragraph">
                                        <?= $detail_sub_title  ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </d>
                <?php
                }
                ?>
                <script>
                    const textareas_<?= $blog_now ?>_<?= $sub_title ?> = document.querySelectorAll('.sub_title_<?= $blog_now ?>_<?= $sub_title ?>, .sub_title_detail_<?= $blog_now ?>_<?= $sub_title ?>');

                    textareas_<?= $blog_now ?>_<?= $sub_title ?>.forEach(textarea => {
                        textarea.addEventListener('input', function() {
                            if (this.value.trim() !== '') {
                                this.classList.add('has-content');
                                updateSession_<?= $blog_now ?>_<?= $sub_title ?>(this);
                            } else {
                                this.classList.remove('has-content');
                            }
                        });
                    });

                    function updateSession_<?= $blog_now ?>_<?= $sub_title ?>(textarea) {
                        const name = textarea.getAttribute('name');
                        const value = textarea.value;

                        // Create an AJAX request to update the session based on input name
                        const xhr = new XMLHttpRequest();
                        xhr.open('POST', 'action/update-session.php'); // Use the same PHP script for all textareas
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
                <form action="action/upload_image_sub_title.php?blog=<?= $blog_now ?>&sub=<?= $sub_title ?>" method="post" enctype="multipart/form-data" id="uploadFormPic<?= '_' . $blog_now . '_' . $sub_title ?>">

                    <!-- $title_page -->
                    <input readonly type="file" name="sub_title_pic_<?= $blog_now ?>_<?= $sub_title ?>" id="picture_blog<?= '_' . $blog_now . '_' . $sub_title ?>" style="display: none;">
                    <input readonly type="text" name="title_page" id="title_page_<?= $blog_now ?>_<?= $sub_title ?>" value="page_writer.php" style="display: none;">
                </form>
                <script>
                    var pictureBlogInput = document.getElementById('picture_blog<?= '_' . $blog_now . '_' . $sub_title ?>');

                    if (pictureBlogInput) {
                        pictureBlogInput.addEventListener('change', function() {
                            document.getElementById('uploadFormPic<?= '_' . $blog_now . '_' . $sub_title ?>').submit();
                        });
                    }
                </script>
            <?php
                $sub_title++;
            } ?>

            <!-- Section 3 -->
            <!-- <div class="section-3-container section-container" id="section-3">
                <div class="container">

                    <div class="row">
                        <div class="col section-3 section-description wow fadeIn">
                            <h2>Our Projects</h2>
                            <div class="divider-1 wow fadeInUp"><span></span></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 section-3-box wow fadeInLeft">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="section-3-box-icon">
                                        <i class="fas fa-paperclip"></i>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <h3>Ut wisi enim ad minim</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.
                                        Ut wisi enim ad minim veniam, quis nostrud.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 section-3-box wow fadeInLeft">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="section-3-box-icon">
                                        <i class="fas fa-pencil-alt"></i>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <h3>Sed do eiusmod tempor</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.
                                        Ut wisi enim ad minim veniam, quis nostrud.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 section-3-box wow fadeInLeft">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="section-3-box-icon">
                                        <i class="fas fa-cloud"></i>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <h3>Quis nostrud exerci tat</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.
                                        Ut wisi enim ad minim veniam, quis nostrud.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 section-3-box wow fadeInLeft">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="section-3-box-icon">
                                        <i class="fab fa-google"></i>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <h3>Minim veniam quis nostrud</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.
                                        Ut wisi enim ad minim veniam, quis nostrud.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div> -->
            <br><br>
            <!-- Section 4 -->
            <div class="section-4-container section-container section-container-image-bg mt-4" id="section-4">
                <div class="container">
                    <div class="row">
                        <div class="col section-4 section-description wow fadeInLeftBig">
                            <h2>มีวันสำคัญทางศาสนาของไทยอื่นๆอีกมากมาย</h2>
                            <!-- <p>
                                Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut
                                aliquip ex ea commodo consequat. Ut wisi enim ad minim veniam, quis nostrud.
                            </p> -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col section-bottom-button wow fadeInUp">
                            <a class="btn btn-primary btn-customized-2 scroll-link" href="#section-6" role="button">
                                <i class="fas fa-envelope"></i> ข้อมูลผู้เขียน
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 5 -->
            <div class="section-5-container section-container" id="section-5">
                <div class="container">
                    <div class="row">
                        <div class="col section-5 section-description wow fadeIn">
                            <h2>วันสำคัญอื่นๆ</h2>
                            <div class="divider-1 wow fadeInUp"><span></span></div>
                            <p>วันสำคัญทางศาสนาอื่นๆ ที่คุณอาจสนใจ!</p>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        $sql_topic = "SELECT *
						FROM topic
						LEFT JOIN picture ON picture.t_id = topic.t_id
						LEFT JOIN employee ON employee.e_id = topic.e_id
						WHERE topic.del_flg = 0
						  AND topic.t_test = 0
                          AND topic.t_id != $blog_now
						  AND (topic.t_private != 0 OR topic.t_private = 1)
						  AND picture.del_flg = 0 ORDER BY topic.t_id DESC LIMIT 3";
                        $result_topic = mysqli_query($conn, $sql_topic);

                        while ($row_topic = mysqli_fetch_array($result_topic)) {
                        ?>
                            <a href="page_viewer.php?blog=<?=  $row_topic['t_id'] ?> ">
                                <div class="col-md-4 section-5-box wow fadeInUp">
                                    <div class="section-5-box-image"><img src="admin/<?= $row_topic['p_pic'] ?>" alt="portfolio-1"></div>
                                    <h3><a href="page_viewer.php?blog=<?=  $row_topic['t_id'] ?> "><?= $row_topic['t_name']  ?></a> <i class="fas fa-angle-right"></i></h3>
                                    <div class="section-5-box-date"><i class="far fa-calendar"></i> June 2019</div>
                                    <p><?= mb_substr($row_topic['t_detail'], 0, 100, 'UTF-8') ?></p>

                                </div>
                            </a>
                        <?php
                        }
                        ?>
                        <!-- <div class="col-md-4 section-5-box wow fadeInUp">
                            <div class="section-5-box-image"><img src="assets/img/portfolio/1.jpg" alt="portfolio-1"></div>
                            <h3><a href="#">Acme branding</a> <i class="fas fa-angle-right"></i></h3>
                            <div class="section-5-box-date"><i class="far fa-calendar"></i> June 2019</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.</p>
                        </div>
                        <div class="col-md-4 section-5-box wow fadeInDown">
                            <div class="section-5-box-image"><img src="assets/img/portfolio/2.jpg" alt="portfolio-2"></div>
                            <h3><a href="#">Created 150 flyers</a> <i class="fas fa-angle-right"></i></h3>
                            <div class="section-5-box-date"><i class="far fa-calendar"></i> February 2019</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.</p>
                        </div>
                        <div class="col-md-4 section-5-box wow fadeInUp">
                            <div class="section-5-box-image"><img src="assets/img/portfolio/3.jpg" alt="portfolio-3"></div>
                            <h3><a href="#">WordPress design</a> <i class="fas fa-angle-right"></i></h3>
                            <div class="section-5-box-date"><i class="far fa-calendar"></i> November 2018</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.</p>
                        </div> -->
                    </div>
                    <!-- <div class="row">
                        <div class="col section-bottom-button wow fadeInUp">
                            <a class="btn btn-primary btn-customized" href="#" role="button">
                                <i class="fas fa-sync"></i> View All
                            </a>
                        </div>
                    </div> -->
                </div>
            </div>

            <!-- Section 6 -->
            <div class="section-6-container section-container section-container-image-bg" id="section-6">
                <div class="container">
                    <div class="row">
                        <div class="col section-6 section-description wow fadeIn">
                            <h2>Contact Us</h2>
                            <div class="divider-1 wow fadeInUp"><span></span></div>
                            <p>Send us an email using the form below or follow us on our social media channels.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 section-6-box wow fadeInUp" style="color:white">
                            <h3>Writer</h3>
                            <div class="section-6-form">
                                <!-- <form role="form" action="assets/contact.php" method="post"> -->
                                <div class="form-group">
                                    <p id="contact-email">Name : <?= $row_e['e_fname'] . ' ' . $row_e['e_lname'] ?></p>
                                </div>
                                <div class="form-group">
                                    <p id="contact-email">Email : <?= $row_e['e_email'] ?></p>
                                </div>
                                <div class="form-group">
                                    <p id="contact-email">Role : <?= $row_e['r_name'] ?></p>

                                </div>
                                <!-- <div class="form-group">
                                         <p id="contact-email">Tel : <?= $_SESSION["tel"] ?></p>
                                    </div> -->
                                <!-- <button type="submit" class="btn btn-primary btn-customized"><i class="fas fa-paper-plane"></i> Send Message</button> -->
                                <!-- </form> -->
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-1 section-6-box wow fadeInDown">
                            <h3>Follow us</h3>
                            <div class="section-6-social">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-dribbble"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-pinterest"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <?php include('bar/footer.php'); ?>

        </div>
        <!-- End content -->

    </div>
    <!-- End wrapper -->
    <?php if (isset($_SESSION['logout'])) {
    ?>
        <script>
            let timerInterval
            Swal.fire({
                title: 'Logout Successfully',
                html: 'I will close in <b></b> milliseconds.',
                timer: 2000,
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



    <?php } ?>

    <!-- Javascript -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/jquery-migrate-3.0.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="assets/js/jquery.backstretch.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/jquery.waypoints.min.js"></script>
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>