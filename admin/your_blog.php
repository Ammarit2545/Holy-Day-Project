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

$e_id = $_SESSION['id'];

$active = array();
$active[1] = "active";

$page = 'Your Blog';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../image/icon/logo.png">
  <title>
    บทความ - HolyDay
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

  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"></script>


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="sweetalert2.all.min.js"></script>
  <script src="sweetalert2.min.js"></script>
  <link rel="stylesheet" href="sweetalert2.min.css">
</head>

<body class="g-sidenav-show  bg-gray-100">


  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var myToast = new bootstrap.Toast(document.querySelector('.toast'));
      myToast.show();
    });
  </script>

  <!-- <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="..." class="rounded me-2" alt="...">
      <strong class="me-auto">Bootstrap</strong>
      <small>11 mins ago</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      Hello, world! This is a toast message.
    </div>
  </div> -->

  <!-- Start SideBar  -->

  <?php include('bar/sidebar.php'); ?>

  <!-- End SideBar  -->

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <?php include('bar/navbar.php'); ?>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Your Blog</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">

                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Topic</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Sub Topic</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Watch</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date Release</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ปุ่มดำเนินการ</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                    $sql_blog = "SELECT topic.t_id,topic.t_name,topic.t_detail ,topic.t_color,topic.t_date_in,topic.t_update,topic.t_private,topic.t_watch,picture.p_pic FROM topic 
                    LEFT JOIN picture ON picture.t_id = topic.t_id
                    WHERE topic.del_flg = 0 AND topic.e_id = '$e_id' AND t_test = 0 ORDER BY topic.t_date_in DESC";
                    $result_blog = mysqli_query($conn, $sql_blog);
                    while ($row_blog = mysqli_fetch_array($result_blog)) {
                      $t_id = $row_blog['t_id'];

                      // sub id -------------------------------------------------------------------------
                      $i = 1;

                      while (isset($_SESSION['sub_title_id_' . $t_id . '_' . $i])) {

                        // $_SESSION['sub_title_id_' . $t_id . '_' . $i] != $row_sub_blog['st_id'];
                        // $_SESSION['sub_title_' . $t_id . '_' . $i] != $row_sub_blog['st_main'];
                        // $_SESSION['sub_title_detail_' . $t_id . '_' . $i] != $row_sub_blog['st_detail'];
                        // $_SESSION['sub_title_section_' . $t_id . '_' . $i] != $row_sub_blog['st_type_sec'];
                        // $_SESSION['title_date_in_' . $t_id . '_' . $i] != $row_sub_blog['st_date_in'];
                        // $_SESSION['sub_title_pic_' . $t_id . '_' . $i] != $row_sub_blog['p_pic'];

                        if (
                          isset($_SESSION['sub_title_id_' . $t_id . '_' . $i]) &&
                          isset($_SESSION['sub_title_' . $t_id . '_' . $i]) &&
                          isset($_SESSION['sub_title_detail_' . $t_id . '_' . $i]) &&
                          isset($_SESSION['sub_title_section_' . $t_id . '_' . $i]) &&
                          isset($_SESSION['title_date_in_' . $t_id . '_' . $i]) &&
                          isset($_SESSION['sub_title_pic_' . $t_id . '_' . $i])
                        ) {
                          $id_sub = $_SESSION['sub_title_id_' . $t_id . '_' . $i];
                          $sql_sub_blog = "SELECT *
                          FROM sub_topic 
                          LEFT JOIN picture ON picture.st_id = sub_topic.st_id
                          WHERE sub_topic.del_flg = 0 AND sub_topic.st_id = '$id_sub'";
                          $result_sub_blog = mysqli_query($conn, $sql_sub_blog);
                          $row_sub_blog = mysqli_fetch_array($result_sub_blog);

                          if (


                            $_SESSION['sub_title_id_' . $t_id . '_' . $i] != $row_sub_blog['st_id'] ||
                            $_SESSION['sub_title_' . $t_id . '_' . $i] != $row_sub_blog['st_main'] ||
                            $_SESSION['sub_title_detail_' . $t_id . '_' . $i] != $row_sub_blog['st_detail'] ||
                            $_SESSION['sub_title_section_' . $t_id . '_' . $i] != $row_sub_blog['st_type_sec'] ||
                            $_SESSION['title_date_in_' . $t_id . '_' . $i] != $row_sub_blog['st_date_in'] ||
                            $_SESSION['sub_title_pic_' . $t_id . '_' . $i] != $row_sub_blog['p_pic']
                          ) {
                    ?>
                            <script>
                              Swal.fire({
                                title: '<?= $row_blog['t_name'] ?> มีการแก้ไข',
                                text: "คุณต้องการบันทึกข้อมูลใหม่หรือไม่!",
                                icon: 'question',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'บันทึก!',
                                cancelButtonText: 'ดูข้อมูลเดิม', // Add a third button with custom text
                                showDenyButton: true, // Show the third button
                                denyButtonText: 'ยกเลิก' // Customize the third button text
                              }).then((result) => {
                                if (result.isConfirmed) {
                                  // Redirect to save_edit_blog.php if the user confirms
                                  window.location.href = 'action/save_edit_blog.php?blog=<?= $t_id ?>';
                                } else if (result.isDenied) {
                                  // Redirect to a different action when the user clicks the third button
                                  window.location.href = 'action/get_old_data.php?blog=<?= $t_id ?>';
                                } else {
                                  // Redirect to edit_blog.php if the user cancels
                                  window.location.href = 'edit_blog.php?blog=<?= $t_id ?>';
                                }
                              });
                            </script>


                          <?php
                          }
                        }
                        $i++;
                      }

                      // sub id -------------------------------------------------------------------------

                      if (
                        isset($_SESSION['title_' . $t_id]) &&
                        isset($_SESSION['title_color_' . $t_id]) &&
                        isset($_SESSION['title_detail_' . $t_id]) &&
                        isset($_SESSION['title_id_' . $t_id]) &&
                        isset($_SESSION['title_date_in_' . $t_id]) &&
                        isset($_SESSION['title_file_' . $t_id])
                      ) {
                        if (
                          $row_blog['t_name'] != $_SESSION['title_' . $t_id] ||
                          $row_blog['t_color'] != $_SESSION['title_color_' . $t_id] ||
                          $row_blog['t_detail'] != $_SESSION['title_detail_' . $t_id] ||
                          $row_blog['t_id'] != $_SESSION['title_id_' . $t_id] ||
                          $row_blog['t_date_in'] != $_SESSION['title_date_in_' . $t_id] ||
                          $row_blog['p_pic'] != $_SESSION['title_file_' . $t_id]
                        ) {
                          ?>
                          <script>
                            Swal.fire({
                              title: '<?= $row_blog['t_name'] ?> มีการแก้ไข',
                              text: "คุณต้องการบันทึกข้อมูลใหม่หรือไม่!",
                              icon: 'question',
                              showCancelButton: true,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#d33',
                              confirmButtonText: 'บันทึก!',
                              cancelButtonText: 'ดูข้อมูลเดิม', // Add a third button with custom text
                              showDenyButton: true, // Show the third button
                              denyButtonText: 'ยกเลิก' // Customize the third button text
                            }).then((result) => {
                              if (result.isConfirmed) {
                                // Redirect to save_edit_blog.php if the user confirms
                                window.location.href = 'action/save_edit_blog.php?blog=<?= $t_id ?>';
                              } else if (result.isDenied) {
                                // Redirect to a different action when the user clicks the third button
                                window.location.href = 'action/get_old_data.php?blog=<?= $t_id ?>';
                              } else {
                                // Redirect to edit_blog.php if the user cancels
                                window.location.href = 'edit_blog.php?blog=<?= $t_id ?>';
                              }
                            });
                          </script>


                      <?php
                        }
                      }
                      ?>
                      <tr>
                          <td>
                            <div class="d-flex px-2 py-1">
                              <div>
                                <img src="<?= $row_blog['p_pic'] ?>" class="avatar avatar-sm me-3" alt="user1">
                              </div>
                              <div class="d-flex flex-column justify-content-center">
                                <a href="page_viewer.php?blog=<?= $row_blog['t_id'] ?>">
                                  <h6 class="mb-0 text-sm"><?= $row_blog['t_name'] ?></h6>
                               
                                <p class="text-xs text-secondary mb-0">
                                  <?php
                                  if ($row_blog['t_update'] != NULL) {
                                    echo $row_blog['t_update'];
                                  } else {
                                    echo 'ไม่มีวันที่';
                                  }
                                  ?>
                                </p>
                              </div>
                            </div>
                          </td>
                        <td>
                          <?php
                          $t_id = $row_blog['t_id'];
                          $sql_sub_blog = "SELECT COUNT(st_id) AS st_count FROM sub_topic WHERE t_id = '$t_id' AND del_flg = 0";
                          $result_sub_blog = mysqli_query($conn, $sql_sub_blog);
                          $row_sub_blog = mysqli_fetch_array($result_sub_blog);
                          ?>
                          <p class="text-xs font-weight-bold mb-0"><?= $row_sub_blog['st_count'] ?></p>
                          <p class="text-xs text-secondary mb-0">หัวข้อย่อย</p>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0" style="color :  <?php
                                                                                    if ($row_blog['t_watch'] == 0) {
                                                                                      echo 'red';
                                                                                    } ?>">
                            <?php
                            if ($row_blog['t_watch'] == 0) {
                              echo 'ไม่มียอดเข้าชม';
                            } elseif ($row_blog['t_watch'] != NULL) {
                              echo $row_blog['t_watch'];
                            } else {
                            } ?>
                          </p>
                          <p class="text-xs text-secondary mb-0">ครั้ง</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <a href="action/change_status.php?blog=<?= $t_id ?>">
                            <span class="badge badge-sm bg-gradient-<?php
                                                                    if ($row_blog['t_private'] != NULL && $row_blog['t_private'] != '1') {
                                                                      echo 'danger';
                                                                    } else {
                                                                      echo 'success';
                                                                    }
                                                                    ?>">
                              <?php
                              if ($row_blog['t_private'] != NULL && $row_blog['t_private'] != '1') {
                                echo 'Private';
                              } else {
                                echo 'Public';
                              }
                              ?>
                            </span>
                          </a>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold"> <?php
                                                                                  if ($row_blog['t_update'] != NULL) {
                                                                                    echo $row_blog['t_update'];
                                                                                  } else {
                                                                                    echo 'ไม่มีวันที่';
                                                                                  }
                                                                                  ?></span>
                        </td>
                        <td class="align-middle  text-center">


                          <a href="edit_blog.php?blog=<?= $row_blog['t_id'] ?>" class="text-secondary font-weight-bold text-xs mr-4" data-toggle="tooltip" data-original-title="Edit user">
                            Edit
                          </a>

                          <a href="#" class="text-danger font-weight-bold text-xs ml-4 delete-blog<?= $row_blog['t_id'] ?>" data-blogid="<?= $t_id ?>" data-toggle="tooltip" data-original-title="Delete Blog" style="margin-left: 7%;">
                            Delete
                          </a>
                          <script>
                            document.addEventListener("DOMContentLoaded", function() {
                              // Find all elements with class "delete-blog"
                              const deleteLinks = document.querySelectorAll('.delete-blog<?= $row_blog['t_id'] ?>');

                              // Attach a click event listener to each link
                              deleteLinks.forEach(link => {
                                link.addEventListener('click', function(e) {
                                  e.preventDefault();

                                  // Get the blog ID from the data-blogid attribute
                                  const blogId = this.getAttribute('data-blogid');

                                  // Show a SweetAlert confirmation dialog
                                  Swal.fire({
                                    title: 'คุณต้องการลบหรือไม่?',
                                    text: 'หัวข้อ "<?= $row_blog['t_name'] ?>" จะไม่แสดงอีกต่อไป!',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#d33',
                                    cancelButtonColor: '#3085d6',
                                    confirmButtonText: 'Yes, delete it!'
                                  }).then((result) => {
                                    if (result.isConfirmed) {
                                      // If the user confirms, redirect to the delete URL
                                      window.location.href = `action/delete_public.php?blog=${blogId}`;
                                    }
                                  });
                                });
                              });
                            });
                          </script>

                        </td>
                      </tr>

                    <?php
                    }  ?>


                    <?php if (isset($_SESSION['delete-blog'])) {  ?>
                      asdasdsadsad
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

                    <!-- <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">John Michael</h6>
                            <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">Manager</p>
                        <p class="text-xs text-secondary mb-0">Organization</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success">Online</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/team-3.jpg" class="avatar avatar-sm me-3" alt="user2">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Alexa Liras</h6>
                            <p class="text-xs text-secondary mb-0">alexa@creative-tim.com</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">Programator</p>
                        <p class="text-xs text-secondary mb-0">Developer</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">11/01/19</span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/team-4.jpg" class="avatar avatar-sm me-3" alt="user3">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Laurent Perrier</h6>
                            <p class="text-xs text-secondary mb-0">laurent@creative-tim.com</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">Executive</p>
                        <p class="text-xs text-secondary mb-0">Projects</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success">Online</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">19/09/17</span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/team-3.jpg" class="avatar avatar-sm me-3" alt="user4">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Michael Levi</h6>
                            <p class="text-xs text-secondary mb-0">michael@creative-tim.com</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">Programator</p>
                        <p class="text-xs text-secondary mb-0">Developer</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success">Online</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">24/12/08</span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user5">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Richard Gran</h6>
                            <p class="text-xs text-secondary mb-0">richard@creative-tim.com</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">Manager</p>
                        <p class="text-xs text-secondary mb-0">Executive</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">04/10/21</span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../assets/img/team-4.jpg" class="avatar avatar-sm me-3" alt="user6">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Miriam Eric</h6>
                            <p class="text-xs text-secondary mb-0">miriam@creative-tim.com</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">Programtor</p>
                        <p class="text-xs text-secondary mb-0">Developer</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">14/09/20</span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td>
                    </tr> -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Projects table</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Project</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Budget</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Completion</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div>
                            <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm rounded-circle me-2" alt="spotify">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Spotify</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">$2,500</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">working</span>
                      </td>
                      <td class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="me-2 text-xs font-weight-bold">60%</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                        <button class="btn btn-link text-secondary mb-0">
                          <i class="fa fa-ellipsis-v text-xs"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div>
                            <img src="../assets/img/small-logos/logo-invision.svg" class="avatar avatar-sm rounded-circle me-2" alt="invision">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Invision</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">$5,000</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">done</span>
                      </td>
                      <td class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="me-2 text-xs font-weight-bold">100%</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                        <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-xs"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div>
                            <img src="../assets/img/small-logos/logo-jira.svg" class="avatar avatar-sm rounded-circle me-2" alt="jira">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Jira</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">$3,400</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">canceled</span>
                      </td>
                      <td class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="me-2 text-xs font-weight-bold">30%</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="30" style="width: 30%;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                        <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-xs"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div>
                            <img src="../assets/img/small-logos/logo-slack.svg" class="avatar avatar-sm rounded-circle me-2" alt="slack">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Slack</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">$1,000</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">canceled</span>
                      </td>
                      <td class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="me-2 text-xs font-weight-bold">0%</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0" style="width: 0%;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                        <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-xs"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div>
                            <img src="../assets/img/small-logos/logo-webdev.svg" class="avatar avatar-sm rounded-circle me-2" alt="webdev">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Webdev</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">$14,000</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">working</span>
                      </td>
                      <td class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="me-2 text-xs font-weight-bold">80%</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="80" style="width: 80%;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                        <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-xs"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div>
                            <img src="../assets/img/small-logos/logo-xd.svg" class="avatar avatar-sm rounded-circle me-2" alt="xd">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Adobe XD</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">$2,300</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">done</span>
                      </td>
                      <td class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="me-2 text-xs font-weight-bold">100%</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                        <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v text-xs"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div> -->
      <?php include('bar/footer.php'); ?>
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
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
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

  <?php if (isset($_SESSION['success'])) {
    if ($_SESSION['success'] != NULL) { ?>
      <script>
        let timerInterval
        Swal.fire({
          title: 'บันทึก <?= $_SESSION['success'] ?> เสร็จสิ้น!',
          html: 'ปิดอัตโนมัติภายใน 2 วินาที',
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
      unset($_SESSION['success']);
    }
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>