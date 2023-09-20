<?php
session_start();
include('database/condb.php');
?>
<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Edit User - Holy Day</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500&display=swap">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/media-queries.css">

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="image/icon/logo.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <style>
        #bounce-item {
            color: gray;
            transition: transform 0.3s;
            /* Add a smooth transition effect */
        }

        #bounce-item:hover {
            transform: scale(1.1);
            /* Scale to 1.1 times on hover */
        }
    </style>

</head>

<body>

    <!-- Wrapper -->
    <div class="wrapper">

        <!-- Sidebar -->
        <?php include('bar/slidebar_contect.php'); ?>
        <!-- End sidebar -->

        <!-- Dark overlay -->
        <div class="overlay"></div>

        <!-- Content -->
        <div class="content">

            <!-- open sidebar menu -->
            <a class="btn btn-primary btn-customized open-menu" href="#" role="button">
                <i class="fas fa-align-left"></i> <span>Menu</span>
            </a>
            <style>
                /* Set the video container to cover the entire top-content */
                .video-container {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    overflow: hidden;
                }

                /* Set the video to cover the entire video container */
                #bgVideo {
                    min-width: 100%;
                    min-height: 100%;
                    width: auto;
                    height: auto;
                    z-index: -1;
                    /* Place the video behind other content */
                    object-fit: cover;
                    /* Maintain video aspect ratio and cover the container */
                }

                /* Add a semi-transparent overlay */
                .overlay {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(255, 255, 255, 0.4);
                    /* Adjust the alpha (4th value) to control the opacity */
                    z-index: -1;
                    /* Place the overlay behind the video */
                }

                /* Style the content on top of the video as needed */
                .container {
                    position: relative;
                    /* Ensure content is positioned relative to the container */
                    z-index: 1;
                    /* Place content on top of the video */
                    /* Add other styles as needed */
                }
            </style>

            <!-- Top content -->
            <div class="top-content section-container" id="top-content">
                <div class="video-container">
                    <video autoplay loop muted playsinline poster="video-poster.jpg" id="bgVideo">
                        <source src="media/video/Buddha.mp4" type="video/mp4">
                        <!-- Add more video sources for different formats (WebM, Ogg) if needed -->
                        Your browser does not support the video tag.
                    </video>
                    <!-- Add the semi-transparent overlay -->
                    <div class="overlay"></div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                            <h1 class="wow fadeIn">Holy<strong>Day</strong></h1>
                            <div class="description wow fadeInLeft">
                                <p>
                                    วันสำคัญทางศาสนา หมายถึง วันที่มีเหตุการณ์สำคัญบางอย่างเกิดขึ้น ส่วนใหญ่จะเป็นวันที่เกี่ยวข้องกับความเชื่อต่างๆซึ่งจะกำหนดเอาวันที่มีเหตุการณ์พิเศษเกิดขึ้นในช่วงนั้นเป็นหลัก
                                    <a href="#"><strong>HolyDay</strong></a>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <h1>แก้ไขข้อมูลส่วนตัว</h1>
            <br>
            <hr><br>
            <div class="container">
                <form id="profile-form" class="row g-3 needs-validation" action="action/edit_member.php" method="POST" novalidate>
                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">ชื่อจริง</label>
                        <input type="text" class="form-control" id="validationCustom01" name="fname" value="<?= $_SESSION['fname'] ?>" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">นามสกุลจริง</label>
                        <input type="text" class="form-control" id="validationCustom02" name="lname" value="<?= $_SESSION['lname'] ?>" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Email</label>
                        <input type="email" class="form-control" id="validationCustom02" name="email" value="<?= $_SESSION['email'] ?>" readonly disabled>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    คุณต้องการเปลี่ยน Password หรือไม่?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <center>
                                        <div class="col-md-6">
                                            <label for="validationCustom02" class="form-label">Old Password</label>
                                            <input type="password" name="passwordold" class="form-control" id="validationCustom02" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="validationCustom02" class="form-label">New Password</label>
                                            <input type="password" name="password" class="form-control" id="validationCustom02" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="validationCustom02" class="form-label">Confrim Password</label>
                                            <input type="password" name="passwordcon" class="form-control" id="validationCustom02" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="col-12 mt-4">
                        <button class="btn btn-primary" type="submit" id="submit-button">บันทึกข้อมูล</button>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                const form = document.getElementById("profile-form");
                                const submitButton = document.getElementById("submit-button");

                                form.addEventListener("submit", function(e) {
                                    e.preventDefault(); // Prevent the default form submission

                                    // Display SweetAlert confirmation dialog
                                    Swal.fire({
                                        title: "ยืนยันการบันทึกข้อมูล?",
                                        text: "คุณต้องการที่จะบันทึกข้อมูลนี้หรือไม่?",
                                        icon: "question",
                                        showCancelButton: true,
                                        confirmButtonColor: "#3085d6",
                                        cancelButtonColor: "#d33",
                                        confirmButtonText: "บันทึก",
                                        cancelButtonText: "ยกเลิก",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // If the user clicks "บันทึก" in the dialog, submit the form
                                            form.submit();
                                        }
                                    });
                                });
                            });
                        </script>

                    </div>
                </form>
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
    <?php if (isset($_SESSION['Error'])) {
        if ($_SESSION['Error'] != NULL) {
    ?>
            <script>
                let timerInterval
                Swal.fire({
                    title: '<?= $_SESSION['Error'] ?>',
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
        }
        unset($_SESSION['Error']);
    } ?>
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