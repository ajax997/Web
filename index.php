<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/model/Function.php');
$func = new Functions();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>HiHiHi Cinema.vn</title>

		<!-- Loading third party fonts -->
		<link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700|" rel="stylesheet" type="text/css">
		<link href="fonts/font-awesome.min.css" rel="stylesheet" type="text/css">

		<!-- Loading main css file -->
		<link rel="stylesheet" href="style.css">
		
		<!--[if lt IE 9]>
		<script src="js/ie-support/html5.js"></script>
		<script src="js/ie-support/respond.js"></script>
		<![endif]-->

	</head>


	<body>
		

		<div id="site-content">
			<header class="site-header">
				<div class="container">
					<a href="index.php" id="branding">
						<img src="images/logo.png" alt="" class="logo">
						<div class="logo-copy">
							<h1 class="site-title">HiHiHiCinema</h1>
							<small class="site-description">Xem phim thật dễ dàng</small>
						</div>
					</a> <!-- #branding -->

					<div class="main-navigation">
						<button type="button" class="menu-toggle"><i class="fa fa-bars"></i></button>
						<ul class="menu">
							<li class="menu-item current-menu-item"><a href="index.php">Trang chủ</a></li>
							<li class="menu-item"><a href="#"></a>Hệ thống rạp</li>
							<li class="menu-item"><a href="#">Phim đang chiếu</a></li>
							<li class="menu-item"><a href="#">Phim sắp chiếu</a></li>
							<li class="menu-item"><a href="#">Thanh toán</a></li>
						</ul> <!-- .menu -->

						<form action="#" class="search-form">
							<input type="text" placeholder="Tìm kiếm phim...">
							<button><i class="fa fa-search"></i></button>
						</form>
					</div> <!-- .main-navigation -->
					<div class="mobile-navigation"></div>
				</div>
			</header>
			<main class="main-content">
				<div class="container">
					<div class="page">
						<div class="row">
							<div class="col-md-9">
								<div class="slider">
									<ul class="slides">
                                        <?php
                                        $movies = $func->get_all_movies();

                                        foreach ($movies as $movie) {

                                            $data = json_decode(json_encode($movie), true);
                                            ?>
                                            <li><a href="movie-details.php?movie_id=<?=$data['id']?>"><img src="<?="admin/".$data['cover_image']?>"></a></li>
                                            <?php
                                        }
                                        ?>
									</ul>
								</div>
							</div>
							<div class="col-md-3">
								<div class="row">
									<div class="col-sm-6 col-md-12">
										<div class="latest-movie">
											<a href="#"><img src="dummy/thumb-1.jpg"></a>
											<center><p>Cuộc chiến vô cực - Avengers</p></center>
										</div>
										
									</div>
								</div>
							</div>
						</div> <!-- .row -->
						<div class="row">
                            <?php
                            foreach ($movies as $movie) {
                                $data = json_decode(json_encode($movie), true);
                                ?>
                                <div class="col-sm-6 col-md-3">
                                    <div class="latest-movie">
                                        <a href="movie-details.php?movie_id=<?=$data['id']?>"><img src="<?="admin/".$data['poster']?>"></a>

                                    </div>
                                </div>
                                <?php
                            }
                            ?>
						</div> <!-- .row -->
						
						
						</div>
					</div>
				</div> <!-- .container -->
			</main>
			<footer class="site-footer">
				<div class="container">
					<div class="row">
						<div class="col-md-2">
							<div class="widget">
								<h3 class="widget-title">Về chúng tôi</h3>
								<p>Công ty CP HiHiHiCinema.vn </p>
							</div>
						</div>
						<div class="col-md-2">
							<div class="widget">
								<h3 class="widget-title">Trung tâm trợ giúp</h3>
								<ul class="no-bullet">
									<li><a href="#">082099823</a></li>
									<li><a href="#">Địa chỉ: 113 Nguyễn Hữu Thọ, Q7</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-2">
							<div class="widget">
								<h3 class="widget-title">Tuyển dụng</h3>
								<ul class="no-bullet">
									<li><a href="#">Tuyển nhân viên văn phòng</a></li>
									<li><a href="#">Tuyển dụng nhân viên bán vé và quản lý rạp</a></li>
									<li><a href="#">Tuyển dụng nhân viên kĩ thuật (phần cứng, thiết bị, phần mềm)</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-2">
							<div class="widget">
								<h3 class="widget-title">Mạng xã hội</h3>
								<ul class="no-bullet">
									<li><a href="#">Facebook</a></li>
									<li><a href="#">Twitter</a></li>
									<li><a href="#">Google+</a></li>
									<li><a href="#">Pinterest</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-2">
							<div class="widget">
								<h3 class="widget-title">Nhận thông tin mới nhất từ HiHiHiCinema.vn</h3>
								<form action="#" class="subscribe-form">
									<input type="text" placeholder="Email Address">
								</form>
							</div>
						</div>
					</div> <!-- .row -->

					<div class="colophon">Copyright 2018 thichxemphim.vn, Designed by tqhauit. All rights reserved</div>
				</div> <!-- .container -->

			</footer>
		</div>
		<!-- Default snippet for navigation -->
		


		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/plugins.js"></script>
		<script src="js/app.js"></script>
		
	</body>

</html>

