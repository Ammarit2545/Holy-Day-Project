<?php
session_start();
include('database/condb.php');

if (isset($_GET['id'])) {
	$id_test = $_GET['id'];
}
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
							<h2>สิ่งที่มีความสำคัญสำหรับผู้นับถือศาสนานั้นมีหลายอย่าง </h2>
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
									<h3>การบรรลุความเสมอภาค</h3>
									<p>
										วันสำคัญทางศาสนาช่วยให้ผู้นับถือศาสนามีโอกาสที่จะมีการพัฒนาตนเองในทางศีลธรรมและจิตใจ ซึ่งทำให้พวกเขามีโอกาสสร้างความสัมพันธ์ที่เข้มแข็งกับพระเจ้าและชาวศาสนาคนอื่นๆในชุมชนของพวกเขา
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
									<h3>การเคารพและสืบทอดความเชื่อ</h3>
									<p>
										วันสำคัญทางศาสนาเป็นโอกาสในการสืบทอดความเชื่อศาสนาจากพระบรมราชาอันยิ่งใหญ่ไปสู่รุ่นหลัง โดยการเป็นตัวอย่างในการรักษาความเคารพและการปฏิบัติตามพระราชาาณเทวดาและบทความศักดิ์สิทธิ์
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
									<h3>การสร้างชุมชนและความผูกพัน</h3>
									<p>
										วันสำคัญทางศาสนาสร้างโอกาสในการรวมกลุ่มของผู้นับถือศาสนาเข้าร่วมกันในพิธีกรรมและพิธีกรรมทางศาสนา ซึ่งเสริมสร้างความผูกพันและสร้างชุมชนที่มีความสามัคคี
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
									<h3>การสืบทอดประเพณีและประเพณี</h3>
									<p>
										วันสำคัญทางศาสนาเป็นโอกาสในการสืบทอดประเพณีและพิธีกรรมทางศาสนาจากรุ่นที่แล้วไปสู่รุ่นใหม่ ซึ่งมีบทบาทสำคัญในการรักษาและสืบทอดความเชื่อทางศาสนา
									</p>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>


			<!-- Section 5 -->
			<div class="section-5-container section-container" id="section-5">
				<div class="container">
					<div class="row">
						<div class="col section-5 section-description wow fadeIn">
							<h2>วันสำคัญต่างๆที่น่าสนใจ</h2>
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
						  AND (topic.t_private != 0 OR topic.t_private = 1)
						  AND picture.del_flg = 0 ORDER BY topic.t_id ASC LIMIT 3";
						$result_topic = mysqli_query($conn, $sql_topic);

						while ($row_topic = mysqli_fetch_array($result_topic)) {
						?>
							<a href="page_viewer.php?blog=<?= $row_topic['t_id'] ?> ">
								<div class="col-md-4 section-5-box wow fadeInUp">
									<div class="section-5-box-image"><img src="admin/<?= $row_topic['p_pic'] ?>" alt="portfolio-1"></div>
									<h3><a href="page_viewer.php?blog=<?= $row_topic['t_id'] ?> "><?= $row_topic['t_name']  ?></a> <i class="fas fa-angle-right"></i></h3>
									<div class="section-5-box-date"><i class="far fa-calendar"></i> June 2019</div>
									<p><?= mb_substr($row_topic['t_detail'], 0, 100, 'UTF-8') ?></p>

								</div>
							</a>
						<?php
						}
						?>
					</div>
				</div>
			</div>

			<!-- Section 6 -->
			<div class="section-6-container section-container section-container-image-bg" id="section-6">
				<div class="container">
					<div class="row">
						<div class="col section-6 section-description wow fadeIn">
							<h2>ขอบคุณที่ไว้ใจเรา</h2>
							<div class="divider-1 wow fadeInUp"><span></span></div>
							<p>หากคุณต้องการข้อมูลที่เป็นประโยชน์ เว็บไซต์เรามีข้อมูลที่เตรียมพร้อมเพื่อคุณเสมอ</p>
						</div>
					</div>
					<div class="row">
						
						
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