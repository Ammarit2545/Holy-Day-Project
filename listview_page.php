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

	<title>Main - Holy Day</title>

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
		<?php include('bar/sidebar.php'); ?>
		<!-- End sidebar -->

		<!-- Dark overlay -->
		<div class="overlay"></div>

		<!-- Content -->
		<div class="content">

			<!-- open sidebar menu -->
			<a class="btn btn-primary btn-customized open-menu" href="#" role="button">
				<i class="fas fa-align-left"></i> <span>Menu</span>
			</a>

			<!-- Top content -->
			<div class="top-content section-container" id="top-content">
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

			<!-- Section 1 -->
			<div class="section-1-container section-container" id="section-1">
				<div class="container">
					<div class="row">
						<div class="col section-1 section-description wow fadeIn">
							<h2>วันสำคัญต่างๆ</h2>
							<div class="divider-1 wow fadeInUp"><span></span></div>
						</div>
					</div>
					<div class="row">
						<?php
						$count_topic = 0;
						$sql_select = "SELECT * FROM topic 
						LEFT JOIN picture ON picture.t_id = topic.t_id
						Where topic.del_flg = 0 AND topic.t_test = 0 AND picture.del_flg = 0";
						$result_select = mysqli_query($conn, $sql_select);
						while ($row_select = mysqli_fetch_array($result_select)) {
							$count_topic++;
						?>
							<a href="page_viewer.php?blog=<?= $row_select['t_id'] ?>" id="bounce-item">
								<div class="col-md-4 section-1-box wow fadeInUp m-4">
									<div class="row">
										<div class="card" style="width: 100%;">
											<img src="admin/<?= $row_select['p_pic'] ?>" class="card-img-top" alt="...">
											<div class="card-body">
												<h5 class="card-title"><?= $row_select['t_name'] ?></h5>
												<p class="card-text"><?= mb_substr($row_select['t_detail'], 0, 100, 'UTF-8') ?> ....</p>
												<hr>
												<a href="page_viewer.php?blog=<?= $row_select['t_id'] ?>" class="btn btn-primary">ดูเพิ่มเติม</a>
											</div>
										</div>
									</div>
								</div>
							</a>
						<?php

						} ?>

						<!-- <div class="col-md-4 section-1-box wow fadeInDown">
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
						</div> -->
					</div>
				</div>
			</div>

			<!-- Section 2 -->
			<div class="section-2-container section-container section-container-gray-bg" id="section-2">
				<div class="container">
					<div class="row">
						<div class="col section-2 section-description wow fadeIn">
						</div>
					</div>
					<div class="row">
						<div class="col-8 section-2-box wow fadeInLeft">
							<h3>ทำไมถึงต้องมีวันสำคัญทางศาสนา?</h3>
							<p class="medium-paragraph">
								วันสำคัญทางศาสนามักจะมีบทบาทสำคัญในการกำหนดและรักษาความเชื่อทางศาสนา โดยมีเป้าหมายหลักคือเป็นช่วงเวลาที่สถานีและชี้ทางให้คนที่นับถือศาสนานั้นตระหนักถึงความสำคัญของความเชื่อ
							</p>
							<p>
								วันสำคัญในพระพุทธศาสนา เป็นวันที่มีเหตุการณ์ที่สำคัญ อันเนื่องด้วยพระรัตนตรัย คือพระพุทธเจ้า, พระธรรมคำสั่งสอนของพระพุทธเจ้า และพระสงฆ์สาวกของพระพุทธเจ้า เหตุการณ์ที่สำคัญดังกล่าว เป็นประโยชน์เกื้อกูลแก่พุทธศาสนิกชนทุกหมู่เหล่า คือบริษัท ๔ ได้แก่ ภิกษุ ภิกษุณี อุบาสก และอุบาสิกา ให้น้อมรำลึกถึงคุณของพระรัตนตรัยในหลักที่สำคัญ เพื่อนำไปประพฤติปฏิบัติ เพื่อจรรโลงให้พระพุทธศาสนา ดำรงคงอยู่สถิตสถาพร เป็นคุณประโยชน์อันยิ่งใหญ่แก่ตนเองและแก่สัตว์โลกทั้งปวง ซึ่งมิใช่จำกัดอยู่เพียงมนุษยชาติเท่านั้น
							</p>
							<!-- <p>
								การสร้างความสันติสันต่อ: บางวันสำคัญทางศาสนาถูกออกแบบมาเพื่อสร้างความสันติและความสัมพันธ์ดีในชุมชน การเชื่อฟังการวางแผนและการนำบางเรื่องมาอภิปรายในวันสำคัญอาจช่วยให้คนรู้สึกว่าพวกเขามีส่วนร่วมในการบูรณาการชีวิตร่วมกัน.


							</p>
							<p>
								การรักษาความเชื่อ: วันสำคัญทางศาสนามักจะเป็นโอกาสที่ช่วยในการรักษาและส่งเสริมความเชื่อทางศาสนาของผู้นับถือ การตระหนักถึงพิธีกรรม การบูรณาการ และข้อความทางศาสนาสามารถกระตุ้นความเชื่อและความกรุณาในการปฏิบัติตามคำสอนของศาสนา.


							</p>
							<p>
								การปฏิบัติศาสนา: วันสำคัญทางศาสนาสามารถเป็นโอกาสสำหรับการปฏิบัติศาสนาและทำพิธีกรรมทางศาสนาที่สำคัญ นี้อาจรวมถึงการนมัสการและการสวดมนต์ เช่น การบูรณาการคริสต์มาสในคริสต์ศาสนา การปฏิบัติศาสนาในวันสำคัญช่วยให้ผู้นับถือรู้สึกว่าพวกเขาได้รับการเชื่อมต่อกับศาสนาของพวกเขาอย่างสมบูรณ์และอย่างถูกต้อง.


							</p>
							<p>
								การสืบทอดความเชื่อ: วันสำคัญทางศาสนามักเป็นโอกาสสำหรับการสืบทอดความเชื่อระหว่างรุ่นสู่รุ่น ผ่านพิธีกรรมและปฏิบัติศาสนาที่ได้รับมาตรฐาน นี่อาจช่วยในการรักษาความเชื่อและความสัมพันธ์ทางศาสนาในครอบครัวและชุมชน.

								รวมถึงเหตุผลด้านบน มีแนวคิดอื่นๆ อีกหลายประการที่เป็นที่ยอมรับในสังคมที่มีความหลากหลายทางศาสนา วันสำคัญทางศาสนาสามารถสร้างความเชื่อมั่นและความเข้าใจระหว่างกลุ่มคนที่นับถือศาสนาเดียวกัน และช่วยให้คนรู้เรื่องเกี่ยวกับประวัติและความสำคัญของศาสนาของพวกเขามากขึ้น ดังนั้น วันสำคัญทางศาสนามีบทบาทสำคัญในการเสริมสร้างความเชื่อและความเข้าใจในศาสนาและชุมชนที่นับถือศาสนานั้น.
							</p> -->
						</div>
						<div class="col-4 section-2-box wow fadeInUp">
							<img src="assets/img/about-us.jpg" alt="about-us">
						</div>
					</div>
				</div>
			</div>

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
								<i class="fas fa-envelope"></i> ติดต่อเรา
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