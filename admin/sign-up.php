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
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../image/icon/logo.png">
  <title>
    Sign Up - HolyDay
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="">
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">กฏของเว็บไซต์</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>
          <p>ข้อมูลส่วนตัว:</p>
          ผู้ใช้ต้องกรอกข้อมูลส่วนตัวที่ถูกต้องและเป็นปัจจุบัน เช่น ชื่อ, ที่อยู่, อีเมล, และหมายเลขโทรศัพท์ (หากจำเป็น).
          เว็บไซต์ต้องระบุว่าข้อมูลส่วนตัวของผู้ใช้จะถูกใช้เพื่อวัตถุประสงค์ใด และต้องปฏิบัติตามข้อกำหนด GDPR (General Data Protection Regulation) หรือกฏระเบียบคุ้มครองข้อมูลส่วนบุคคลที่เกี่ยวข้อง.

          <p> การล็อกอินและรักษาความปลอดภัย:</p>
          การสร้างบัญชีผู้ใช้ควรมีการล็อกอินด้วยชื่อผู้ใช้และรหัสผ่าน เพื่อรักษาความปลอดภัยของข้อมูล.
          ระบบควรมีมาตรการรักษาความปลอดภัยเพื่อป้องกันการเข้าถึงข้อมูลโดยไม่ได้รับอนุญาต.

          <p> การสื่อสาร:</p>
          การสื่อสารระหว่างผู้ใช้ควรเป็นที่เคารพและสร้างสรรค์ ห้ามใช้ภาษาหยาบคายหรือไม่เหมาะสม.
          หากเว็บไซต์มีระบบสนทนาหรือบอร์ดการสนทนา ควรมีกฎหรือมาตรการเพื่อป้องกันการแสดงความเกียจคร้านและการรุมเร้า.

          <p>การลิงก์ไปยังเว็บไซต์อื่น:</p>
          หากมีการลิงก์ไปยังเว็บไซต์อื่น ควรระบุว่าเว็บไซต์นี้ไม่รับผิดชอบต่อเนื้อหาและนโยบายความเป็นส่วนตัวของเว็บไซต์อื่น ๆ.

          <p>การใช้คุกกี้ (Cookies):</p>
          หากใช้คุกกี้เพื่อเก็บข้อมูลการใช้งาน ควรแจ้งให้ผู้ใช้ทราบและให้ตัวเลือกในการยอมรับหรือปฏิเสธคุกกี้.

          <p>ลิขสิทธิ์และลิขสิทธิ์ทางปัญญา:</p>
          สิทธิ์ทางปัญญาที่เกี่ยวกับเนื้อหาบนเว็บไซต์ต้องถูกคุ้มครอง และผู้ใช้ต้องเคารพลิขสิทธิ์ของผู้อื่น.
          ห้ามเผยแพร่หรือนำเนื้อหาของเว็บไซต์ไปใช้งานเพื่อวัตถุประสงค์ที่ไม่ถูกต้อง.

          <p>ข้อผิดพลาดและปัญหาเทคนิค:</p>
          การแจ้งข้อผิดพลาดหรือปัญหาเทคนิคควรทำได้ง่ายๆ และเว็บไซต์ควรให้การสนับสนุนเพื่อแก้ไขปัญหาที่เกิดขึ้น.

          <p> การปรับปรุงและการเปลี่ยนแปลง:</p>
          การปรับปรุงนโยบายและกฏของเว็บไซต์ควรมีการแจ้งให้ผู้ใช้ทราบ และผู้ใช้ควรตรวจสอบอย่างเป็นประจำ.

          <p> การลบบัญชี:</p>
          ผู้ใช้ควรมีสิทธิ์ในการลบบัญชีของตนเองจากเว็บไซต์เมื่อต้องการ.

          <p>การคุ้มครองเด็ก:</p>
          หากเว็บไซต์เหมาะสำหรับเด็ก ควรมีมาตรการเพื่อคุ้มครองเด็กและข้อมูลส่วนตัวของเด็ก.

          <p> การละเมิดกฎและการปรับสภาพ:</p>
          หากผู้ใช้ละเมิดกฎและกติกา เว็บไซต์ควรมีสิทธิ์ในการระงับบัญชีผู้ใช้หรือกระทำการอื่น ๆ ตามที่กำหนดไว้ในกฎ.
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
        </div>
      </div>
    </div>
  </div>
  <!-- Navbar -->
  <!-- <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
    <div class="container">
      <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="../pages/dashboard.html">
        Soft UI Dashboard
      </a>
      <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon mt-2">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </span>
      </button>
      <div class="collapse navbar-collapse" id="navigation">
        <ul class="navbar-nav mx-auto ms-xl-auto me-xl-7">
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="../pages/dashboard.html">
              <i class="fa fa-chart-pie opacity-6  me-1"></i>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-2" href="../pages/profile.html">
              <i class="fa fa-user opacity-6  me-1"></i>
              Profile
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-2" href="../pages/sign-up.html">
              <i class="fas fa-user-circle opacity-6  me-1"></i>
              Sign Up
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-2" href="../pages/sign-in.html">
              <i class="fas fa-key opacity-6  me-1"></i>
              Sign In
            </a>
          </li>
        </ul>
        <li class="nav-item d-flex align-items-center">
          <a class="btn btn-round btn-sm mb-0 btn-outline-white me-2" target="_blank" href="https://www.creative-tim.com/builder?ref=navbar-soft-ui-dashboard">Online Builder</a>
        </li>
        <ul class="navbar-nav d-lg-block d-none">
          <li class="nav-item">
            <a href="https://www.creative-tim.com/product/soft-ui-dashboard" class="btn btn-sm btn-round mb-0 me-1 bg-gradient-light">Free download</a>
          </li>
        </ul>
      </div>
    </div>
  </nav> -->
  <!-- End Navbar -->
  <main class="main-content  mt-0">
    <section class="min-vh-100 mb-8">
      <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('../assets/img/curved-images/curved14.jpg');">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5 text-center mx-auto">
              <h1 class="text-white mb-2 mt-5">ยินดีต้อนรับ!</h1>
              <p class="text-lead text-white">กรอกข้อมูลลงทะเบียน เพื่อทำการสมัครบัญชีผู้ใช้</p>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10">
          <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
              <div class="card-header text-center pt-4">
                <h5>ลงทะเบียน </h5>
              </div>
              <div class="row">

                <!-- <div class="col-3 ms-auto px-1">
                    <a class="btn btn-outline-light w-100" href="javascript:;">
                      <svg width="24px" height="32px" viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink32">
                        <g id="Artboard" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g id="facebook-3" transform="translate(3.000000, 3.000000)" fill-rule="nonzero">
                            <circle fill="#3C5A9A" cx="29.5091719" cy="29.4927506" r="29.4882047"></circle>
                            <path d="M39.0974944,9.05587273 L32.5651312,9.05587273 C28.6886088,9.05587273 24.3768224,10.6862851 24.3768224,16.3054653 C24.395747,18.2634019 24.3768224,20.1385313 24.3768224,22.2488655 L19.8922122,22.2488655 L19.8922122,29.3852113 L24.5156022,29.3852113 L24.5156022,49.9295284 L33.0113092,49.9295284 L33.0113092,29.2496356 L38.6187742,29.2496356 L39.1261316,22.2288395 L32.8649196,22.2288395 C32.8649196,22.2288395 32.8789377,19.1056932 32.8649196,18.1987181 C32.8649196,15.9781412 35.1755132,16.1053059 35.3144932,16.1053059 C36.4140178,16.1053059 38.5518876,16.1085101 39.1006986,16.1053059 L39.1006986,9.05587273 L39.0974944,9.05587273 L39.0974944,9.05587273 Z" id="Path" fill="#FFFFFF"></path>
                          </g>
                        </g>
                      </svg>
                    </a>
                  </div> -->
                <!-- <center>
                  <div class="col-3">
                    <a class="btn btn-outline-light " href="javascript:;">
                      <img src="../image/icon/line.png" alt="Line Login" style="border-radius: 20%; width: 50px;">
                    </a>
                  </div>
                </center>
                <div class="mt-2 position-relative text-center">
                  <p class="text-sm font-weight-bold mb-2 text-secondary text-border d-inline z-index-2 bg-white px-3">
                    or
                  </p>
                </div> -->
              </div>
              <div class="card-body">
                <form action="../action/sign-up.php" method="POST">
                  <div class="row mb-3">
                    <div class="col-md-6  mb-3">
                      <input type="text" class="form-control" placeholder="ชื่อจริง" aria-label="Name" aria-describedby="email-addon" name="fname" required>
                    </div>
                    <div class="col-md-6">
                      <input type="text" class="form-control" placeholder="นามสกุลจริง" aria-label="Name" aria-describedby="email-addon" name="lname" required>
                    </div>
                  </div>
                  <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon" name="email" required>
                  </div>
                  <div class="mb-3">
                    <input type="password" class="form-control" placeholder="รหัสผ่าน" aria-label="Password" aria-describedby="password-addon" name="password" required>
                  </div>
                  <div class="form-check form-check-info text-left">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked required>
                    <label class="form-check-label" for="flexCheckDefault">
                      ฉันยอมรับ <a href="javascript:;" class="text-dark font-weight-bolder" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">กฏของเว็บไซต์</a>
                      <!-- Button trigger modal -->
                      <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Launch demo modal
                      </button> -->


                    </label>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">ลงทะเบียน</button>
                  </div>
                  <p class="text-sm mt-3 mb-0">มีบัญชีผู้ใช้อยู่แล้ว? <a href="sign-in.php" class="text-dark font-weight-bolder">เข้าสู่ระบบ</a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <?php include('bar/footer.php'); ?>
    <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  </main>
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