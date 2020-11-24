<!DOCTYPE html>
<html>
	<head>
		<title>Cinema XXI Virtual</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="./assets/js/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<script src="./assets/js/jquery.min.js"></script>
		<script src="./assets/js/popper.min.js"></script>
		<script src="./assets/js/bootstrap.min.js"></script>
		<script src="./assets/js/login.js"></script>
		<link href="https://fonts.googleapis.com/css?family=Karla:400,400i,700,700i&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/animate.min.css">
		<link rel="stylesheet" href="../css/magnific-popup.css">
		<link rel="stylesheet" href="../fontawesome/css/all.min.css">
		<link rel="stylesheet" href="../css/dripicons.css">
		<link rel="stylesheet" href="../css/slick.css">
		<link rel="stylesheet" href="../css/default.css">
		<link rel="stylesheet" href="../css/style.0.1.css">
		<link rel="stylesheet" href="../css/responsive.css">


	</head>
	<body>
		<header id="home" class="header-area">
			<div id="header-sticky" class="menu-area">
				<div class="container">
					<div class="second-menu">
						<div class="row align-items-center">
							<div class="col-xl-3 col-lg-3">
								<div class="logo">
									<img src="../img/logo all.png" alt="logo" height="30px">
								</div>
							</div>
							<div class="col-xl-6 col-lg-9">
								<div class="responsive"><i class="icon dripicons-align-right"></i></div>
								<div class="main-menu text-right text-xl-center">
									<nav id="mobile-menu">
										<ul>
											<li class="has-sub">
												<a href="../index.php">Home</a>
											</li>
											<li class="has-sub">
												<a href="../about.php">Theaters</a>
											</li>
											<li class="has-sub">
												<a href="../video-chat/">Now Playing</a>
											</li>
											<li class="has-sub">
												<a href="../shop.php">Shop</a>
											</li>
											<!--<li class="has-sub">
												 <a href="../contact.php">Contact</a>
											</li>-->
										</ul>
									</nav>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<main>

			<section id="parallax" class="slider-area breadcrumb-area d-flex align-items-center justify-content-center fix" style="background-image:url(../img/xxi front.jpg)">
				<div class="container">
					<div class="row">
						 <div class="col-lg-8 col-sm-12">
								<div class="slider-content second-slider-content">
									<!--
									 <ul data-animation="fadeInUp animated" data-delay=".2s">
											<li><i class="fas fa-map-marker-alt"></i> Waterfront Hotel, London</li>
											<li><i class="far fa-clock"></i>  5 - 7 June 2019, </li>
											<li><i class="fal fa-building"></i>  Edition </li>
									 </ul>
								 -->
									 <h2 data-animation="fadeInUp animated" data-delay=".4s">Movie<br>Theaters<br>XXI Cafe & Lounge</h2>
									 <!--
									 <div class="conterdown wow fadeInDown animated" data-animation="fadeInDown animated" data-delay=".2s" countdown data-date="Jan 1 2020 00:00:00">
											<div class="timer">
												 <div class="timer-outer bdr1">
														<span class="days" data-days>0</span>
														<div class="smalltext">Days</div>
														<div class="value-bar"></div>
												 </div>
												 <div class="timer-outer bdr2">
														<span class="hours" data-hours>0</span>
														<div class="smalltext">Hours</div>
												 </div>
												 <div class="timer-outer bdr3">
														<span class="minutes" data-minutes>0</span>
														<div class="smalltext">Minutes</div>
												 </div>
												 <div class="timer-outer bdr4">
														<span class="seconds" data-seconds>0</span>
														<div class="smalltext">Seconds</div>
												 </div>
												 <p id="time-up"></p>
											</div>
									 </div>
								 -->
								</div>
						 </div>
						 <div class="col-lg-4 col-sm-12">
								<div class="booking-form mt-50 align-items-center justify-content-center wow fadeInLeft" data-animation="fadeInLeft" data-delay=".2s">
									<br>
									<br>
									 <h2>Watch Now!</h2>
									 <form>
										 <br><br>
											<div class="form-outer">
												 <div class="icon"><i class="fal fa-user"></i></div>
												 <input type="text" id="loginName" name="name" placeholder="Enter your name"/>
											</div>
											<br><br><br>
											<div class="form-outer">
												 <div class="icon"><i class="fal fa-envelope"></i></div>
												 <input type="email" id="loginEmail" name="email" placeholder="Enter your email"/>
											</div>

											<input type="text" id="roomname" name="roomname" class="form-control" value="<?php
												if(isset($_GET["roomname"]))
												{
													echo $_GET["roomname"];
												}
												else
												{
													echo "Lobby";
												}
												?>" hidden>
											<input type="text" id="room" name="room" class="form-control" value="<?php
												if(isset($_GET["room"]))
												{
													echo $_GET["room"];
												}
												else
												{
													echo "115c7be9-1450-4dc9-b7f5-6c35364bdb8c";
												}
												?>" hidden>
											<input type="text" id="loginIsLobby" name="lobby" class="form-control" value="<?php
												if(isset($_GET["roomname"]))
												{
													echo "false";
												}
												else
												{
													echo "true";
												}
												?>" hidden>
											<!--
											<div class="form-outer">
												 <div class="icon"><i class="far fa-phone"></i></div>
												 <input type="text" placeholder="Enter your phone"/>
											</div>
											<div class="form-outer">
												 <div class="icon"><i class="fal fa-list"></i></div>
												 <select id="select">
														<option selected="selected">Select your seat</option>
														<option>one</option>
														<option>two</option>
														<option>three</option>
														<option>four</option>
														<option >five</option>
												 </select>
											</div>
										--><br><br><br>
											<div class="text-center">
												 <a href="#" class="btn" id="loginToRoom">Watch Movie</a>
											</div>
									 </form>
								</div>
						 </div>
					</div>
				</div>
			</section>


			<div class="event fix pb-120 mt-40">
				<div class="section-t team-t paroller" data-paroller-factor="0.15" data-paroller-factor-lg="0.15" data-paroller-factor-md="0.15" data-paroller-factor-sm="0.15" data-paroller-type="foreground" data-paroller-direction="horizontal">
					<h2>Movie</h2>
				</div>
				<div class="row justify-content-center">
					<div class="col-xl-6 col-lg-8">
						<div class="section-title text-center mb-80">
							<span class="wow fadeInUp animated" data-animation="fadeInUp animated" data-delay=".2s">Movie</span>
							<h2 class="wow fadeInUp animated" data-animation="fadeInUp animated" data-delay=".2s">Schedule</h2>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-lg-12 ">
							<nav class="wow fadeInDown animated" data-animation="fadeInDown animated" data-delay=".2s">
								<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
									<a class="nav-item nav-link active show" id="nav-home-tab" data-toggle="tab" href="#one" role="tab" aria-selected="true">
										<img src="../img/t-icon.png" alt="img" class="drk-icon">
										<img src="../img/t-w-icon1.png" alt="img" class="lgt-icon">
										<div class="nav-content">
											 <strong>Now Playing</strong>
											 <h5>Desember 2020</h5>
										</div>
									</a>
									<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#two" role="tab" aria-selected="false">
										<img src="../img/t-icon.png" alt="img" class="drk-icon">
										<img src="../img/t-w-icon1.png" alt="img" class="lgt-icon">
										<div class="nav-content">
											 <strong>Theaters</strong>
											 <h5>Desember 2020</h5>
										</div>
									</a>
									<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#three" role="tab" aria-selected="false">
										<img src="../img/t-icon.png" alt="img" class="drk-icon">
										<img src="../img/t-w-icon1.png" alt="img" class="lgt-icon">
										<div class="nav-content">
											 <strong>Up Coming</strong>
											 <h5>Desember 2020</h5>
										</div>
									</a>
								</div>
							</nav>
							<div class="tab-content py-3 px-3 px-sm-0 wow fadeInDown animated" data-animation="fadeInDown animated" data-delay=".2s" id="nav-tabContent">
								<div class="tab-pane fade active show" id="one" role="tabpanel" aria-labelledby="nav-home-tab">
									<?php
										include "webminar.php";
									 ?>
								</div>
								<div class="tab-pane fade" id="two" role="tabpanel" aria-labelledby="nav-profile-tab">
									<?php
										include "livemusic.php";
									 ?>
								</div>
								<div class="tab-pane fade" id="three" role="tabpanel" aria-labelledby="nav-contact-tab">
									<?php
										include "conference.php";
									 ?>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</main>

		<div class="modal" id="newRoomModal" role="dialog" aria-labelledby="newRoomModalLabel" aria-hidden="true" style="background-color:rgba(0, 0, 0, 0.6);">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="newRoomModalLabel">Create New Room</h5>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="email">Room Name : </label>
							<input type="text" id="newRoomNameInput" name="newroom" class="form-control">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">Close</button>
						<button type="button" class="btn btn-primary" id="loginCreateRoom">Create</button>
					</div>
				</div>
			</div>
		</div>

		<?php
			include '../footer.php';
		?>

		<script src="../js/vendor/modernizr-3.5.0.min.js"></script>
		<script src="../js/vendor/jquery-1.12.4.min.js"></script>
		<script src="../js/popper.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/one-page-nav-min.js"></script>
		<script src="../js/slick.min.js"></script>
		<script src="../js/ajax-form.js"></script>
		<script src="../js/paroller.js"></script>
		<script src="../js/wow.min.js"></script>
		<script src="../js/parallax.min.js"></script>
		<script src="../js/jquery.waypoints.min.js"></script>
		<script src="../js/jquery.counterup.min.js"></script>
		<script src="../js/jquery.scrollUp.min.js"></script>
		<script src="../js/jquery.magnific-popup.min.js"></script>
		<script src="../js/element-in-view.js"></script>
		<script src="../js/isotope.pkgd.min.js"></script>
		<script src="../js/imagesloaded.pkgd.min.js"></script>
		<script src="../js/main.js"></script>

	</body>
</html>
<script src="./assets/js/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="./assets/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="./assets/js/jquery.min.js"></script>
