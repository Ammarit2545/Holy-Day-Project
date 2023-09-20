<?php
if (isset($_SESSION["role_id"])) {
    header("location:admin/");
}
?>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Sidebar -->
<nav class="sidebar">

    <!-- close sidebar menu -->
    <div class="dismiss">
        <i class="fas fa-arrow-left"></i>
    </div>

    <div class="logo">
        <h3>
            <a href="index.php">Bootstrap 4 Template with Sidebar Menu</a>
        </h3>
    </div>

    <ul class="list-unstyled menu-elements">
        <?php
        $count_con = 1;

        $sql_con = "SELECT * FROM sub_topic WHERE t_id = '$t_id' AND del_flg = 0;";
        $result_con = mysqli_query($conn, $sql_con);
        while ($row_con = mysqli_fetch_array($result_con)) {

            if ($count_con == 1) {  ?>
                <li class="active">
                    <a class="scroll-link" href="#top-content"><i class="fas fa-home"></i> Home</a>
                </li>
                <li>
                    <a  href="listview_page.php"><i class="fas fa-plane"></i> กลับสู่หน้าหลัก</a>
                </li>
                <li>
                    <a  href="edit_member.php"><i class="fas fa-user"></i> แก้ไขข้อมูลส่วนตัว</a>
                </li>
                <li>
                    <a class="scroll-link" href="#<?= $row_con['st_id'] ?>"><i class="fas fa-home"></i> <?= $row_con['st_main'] ?></a>
                </li>
            <?php
                $count_con++;
            } else {
            ?>
                <li>
                    <a class="scroll-link" href="#<?= $row_con['st_id'] ?>"><i class="fas fa-book"></i> <?= $row_con['st_main'] ?></a>
                </li>

                <?php
                $count_con++;
            }
                ?><?php
                } ?>

                <?php if (isset($_SESSION["email"])) { ?>
                    <li>
                        <a href="#" id="logout-link">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                <?php
                } else {
                ?>
                    <li>
                        <a href="admin/sign-in.php"><i class="fas fa-sign-in-alt"></i>Sign In</a>
                    </li>
                <?php
                } ?>
                <li>
                    <a href="#otherSections" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" role="button" aria-controls="otherSections">
                        <i class="fas fa-sync"></i>Other sections
                    </a>
                    <ul class="collapse list-unstyled" id="otherSections">
                        <li>
                            <a class="scroll-link" href="#section-3">Our projects</a>
                        </li>
                        <li>
                            <a class="scroll-link" href="#section-4">We think that...</a>
                        </li>
                    </ul>
                </li>
    </ul>

    <!-- <div class="to-top">
					<a class="btn btn-primary btn-customized-3" href="#" role="button">
	                    <i class="fas fa-arrow-up"></i> Top
	                </a>
				</div> -->

    <div class="dark-light-buttons">
        <a class="btn btn-primary btn-customized-4 btn-customized-dark" href="#" role="button">Dark</a>
        <a class="btn btn-primary btn-customized-4 btn-customized-light" href="#" role="button">Light</a>
    </div>

</nav>
<!-- End sidebar -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the logout link element
        const logoutLink = document.getElementById("logout-link");

        // Add a click event listener to the logout link
        logoutLink.addEventListener("click", function(event) {
            event.preventDefault(); // Prevent the link from navigating

            // Show the Swal confirmation dialog
            Swal.fire({
                title: "Logout",
                text: "Are you sure you want to logout?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, Logout",
                cancelButtonText: "Cancel",
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user confirms, navigate to the logout page
                    window.location.href = "action/sign-out.php";
                }
            });
        });
    });
</script>