<?php
session_start();
include('../database/condb.php');
?>
<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Main - Holy Day</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500&display=swap">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/media-queries.css">

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="../image/icon/logo.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
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

</head>

<body>

    <!-- Wrapper -->
    <div class="wrapper">


        <!-- Dark overlay -->
        <div class="overlay"></div>

        <!-- Content -->
        <div class="content">

            <!-- open sidebar menu -->
            <div style="position: fixed; top: 20px; left: 10px; z-index: 997; box-shadow: 3px 3px 3px rgba(51, 51, 51, 0.2); background-color: black; padding: 20px; border-radius: 20%; color: gray; opacity: 0.8; font-size: 1vw;">
                <!-- <i class="fas fa-align-left"></i> <span style="font-size: 20%;"> -->

                <label for="titleFile" style="cursor: pointer; color: white;">
                    <i class="fas fa-file w-5 mb-0 p-4 ms-auto cursor-pointer" data-bs-toggle="tooltip" data-bs-placement="top" title="Change Background" aria-hidden="true"></i>
                </label>
                <label for="titleColor" style="cursor: pointer; color: white;">
                    <i class="fa fa-paint-brush w-5 mb-0 p-4" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="top" title="Change Color Text"></i>
                </label>
                <a for="titleColor" style="cursor: pointer; color: white; text-decoration: none; text-decoration: none;" href="index.php">
                    <i class="fa fa-arrow-left w-5 mb-0 p-4" aria-hidden="true" data-bs-toggle="tooltip" data-bs-placement="top" title="Back to Page"></i>
                </a>
                </span>
            </div>

            <form id="upload_image" action="action/upload_image_title.php" method="POST" enctype="multipart/form-data">
                <input type="file" class="invisible-input form-control" id="titleFile" name="title_file" placeholder="Your File" style="display: none;" required hidden>
            </form>
            <input type="color" class="invisible-input form-control w-0" id="titleColor" name="title_color" placeholder="Your Title" value="<?php if (isset($_SESSION['title_color'])) {
                                                                                                                                                echo $_SESSION['title_color'];
                                                                                                                                            } ?>" required hidden>

            <!-- Top content -->
            <div style="background: url('<?= $_SESSION['title_file'] ?>'); width: 100%; padding: 60px 0 120px 0; ">
                <div class="container">
                    <div class="row">
                        <div class="col col-md-10 offset-md-1 col-lg-8 offset-lg-2">

                            <h1 class="wow fadeIn text-center">
                                <input type="text" name="title" id="titleInput" class="invisible-input form-control mb-0 mr-1 text-center" placeholder="Your Title" value="<?php if (isset($_SESSION['title'])) {
                                                                                                                                                                                echo $_SESSION['title'];
                                                                                                                                                                            } ?>" data-bs-toggle="tooltip" data-bs-placement="left" title="หัวข้อหลัก" required>
                            </h1>


                            <div class="description wow fadeInLeft">
                                <p>
                                    <textarea type="text" name="title_detail" id="title_detail" class="invisible-input form-control mb-0 mr-1 text-center" placeholder="Your Detail Title" value="<?php if (isset($_SESSION['title_detail'])) {
                                                                                                                                                                                                        echo $_SESSION['title_detail'];
                                                                                                                                                                                                    } ?>" data-bs-toggle="tooltip" data-bs-placement="left" title="รายละเอียดหัวข้อหลัก" required><?= $_SESSION['title_detail'] ?></textarea>
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

            <a href="#" id="bounce-item" data-bs-toggle="tooltip" data-bs-placement="left" title="กดเพื่อเพิ่ม Section ใหม่">
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




            <!-- Section 1 -->
            <div class="section-1-container section-container" id="section-1">
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
            </div>

            <!-- Section 2 -->
            <d iv class="section-2-container section-container section-container-gray-bg" id="section-2">
                <div class="container">
                    <div class="row">
                        <div class="col section-2 section-description wow fadeIn">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8 section-2-box wow fadeInLeft">
                            <h3>About Us</h3>
                            <p class="medium-paragraph">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                sed do eiusmod tempor incididunt ut labore et. Ut wisi enim ad minim veniam, quis nostrud.
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.
                                Ut wisi enim ad minim veniam, quis nostrud.
                                Exerci tation ullamcorper suscipit ut aliquip ex ea commodo consequat.
                                Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl.
                            </p>
                        </div>
                        <div class="col-4 section-2-box wow fadeInUp">
                            <img src="assets/img/about-us.jpg" alt="about-us">
                        </div>
                    </div>
                </div>
            </d>

            <!-- Section 3 -->
            <div class="section-3-container section-container" id="section-3">
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
            </div>

            <!-- Section 4 -->
            <div class="section-4-container section-container section-container-image-bg" id="section-4">
                <div class="container">
                    <div class="row">
                        <div class="col section-4 section-description wow fadeInLeftBig">
                            <h2>We Think That...</h2>
                            <p>
                                Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut
                                aliquip ex ea commodo consequat. Ut wisi enim ad minim veniam, quis nostrud.
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col section-bottom-button wow fadeInUp">
                            <a class="btn btn-primary btn-customized-2 scroll-link" href="#section-6" role="button">
                                <i class="fas fa-envelope"></i> Contact Us
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
                            <h2>Portfolio</h2>
                            <div class="divider-1 wow fadeInUp"><span></span></div>
                            <p>We have completed 486 projects since we started back in 2013. Check them out!</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 section-5-box wow fadeInUp">
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
                        </div>
                    </div>
                    <div class="row">
                        <div class="col section-bottom-button wow fadeInUp">
                            <a class="btn btn-primary btn-customized" href="#" role="button">
                                <i class="fas fa-sync"></i> View All
                            </a>
                        </div>
                    </div>
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
                        <div class="col-md-6 section-6-box wow fadeInUp">
                            <h3>By eMail</h3>
                            <div class="section-6-form">
                                <form role="form" action="assets/contact.php" method="post">
                                    <div class="form-group">
                                        <label class="sr-only" for="contact-email">Email</label>
                                        <input type="text" name="email" placeholder="Email..." class="contact-email form-control" id="contact-email">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="contact-subject">Subject</label>
                                        <input type="text" name="subject" placeholder="Subject..." class="contact-subject form-control" id="contact-subject">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="contact-message">Message</label>
                                        <textarea name="message" placeholder="Message..." class="contact-message form-control" id="contact-message"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-customized"><i class="fas fa-paper-plane"></i> Send Message</button>
                                </form>
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
    <?php
    } ?>
    <!-- Javascript -->
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/jquery-migrate-3.0.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../assets/js/jquery.backstretch.min.js"></script>
    <script src="../assets/js/wow.min.js"></script>
    <script src="../assets/js/jquery.waypoints.min.js"></script>
    <script src="../assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../assets/js/scripts.js"></script>


</body>

</html>