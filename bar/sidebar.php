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
		<h3><a href="index.html">Bootstrap 4 Template with Sidebar Menu</a></h3>
	</div>

	<ul class="list-unstyled menu-elements">
		<li class="active">
			<a class="scroll-link" href="#top-content"><i class="fas fa-home"></i> หน้าหลัก</a>
		</li>
		<li>
			<a class="scroll-link" href="listview_page.php"><i class="fas fa-home"></i> ดูวันสำคัญต่างๆ</a>
		</li>
		<li>
			<a class="scroll-link" href="#section-1"><i class="fas fa-cog"></i> What we do</a>
		</li>
		<li>
			<a class="scroll-link" href="#section-2"><i class="fas fa-user"></i> About us</a>
		</li>
		<li>
			<a class="scroll-link" href="#section-5"><i class="fas fa-pencil-alt"></i> Portfolio</a>
		</li>
		<li>
			<a class="scroll-link" href="#section-6"><i class="fas fa-envelope"></i> Contact us</a>
		</li>
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