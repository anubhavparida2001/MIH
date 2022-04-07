<?php require_once "controllerUserData.php"; ?>
<?php
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if ($email != false && $password != false) {
	$sql = "SELECT * FROM usertable WHERE email = '$email'";
	$run_Sql = mysqli_query($con, $sql);
	if ($run_Sql) {
		$fetch_info = mysqli_fetch_assoc($run_Sql);
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Membership</title>
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Noto+Sans:wght@700&family=Poppins:wght@400;500;600&display=swap');

		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			font-family: "Poppins", sans-serif;
		}

		body {
			display: flex;
			align-items: center;
			justify-content: center;
			min-height: 100vh;
			background: linear-gradient(#D5A3FF 0%, #77A5F8 100%);
		}

		.wrapper {
			width: 400px;
			background: #fff;
			border-radius: 16px;
			padding: 30px;
			box-shadow: 10px 10px 15px rgba(0, 0, 0, 0.05);
		}

		.wrapper header {
			height: 55px;
			display: flex;
			align-items: center;
			border: 1px solid #ccc;
			border-radius: 30px;
			position: relative;
		}

		header label {
			height: 100%;
			z-index: 2;
			width: 30%;
			display: flex;
			cursor: pointer;
			font-size: 18px;
			position: relative;
			align-items: center;
			justify-content: center;
			transition: color 0.3s ease;
		}

		#tab-1:checked~header .tab-1,
		#tab-2:checked~header .tab-2,
		#tab-3:checked~header .tab-3 {
			color: #fff;
		}

		header label:nth-child(2) {
			width: 40%;
		}

		header .slider {
			position: absolute;
			height: 85%;
			border-radius: inherit;
			background: linear-gradient(145deg, #D5A3FF 0%, #77A5F8 100%);
			transition: all 0.3s ease;
		}

		#tab-1:checked~header .slider {
			left: 0%;
			width: 90px;
			transform: translateX(5%);
		}

		#tab-2:checked~header .slider {
			left: 50%;
			width: 120px;
			transform: translateX(-50%);
		}

		#tab-3:checked~header .slider {
			left: 100%;
			width: 95px;
			transform: translateX(-105%);
		}

		.wrapper input[type="radio"] {
			display: none;
		}

		.card-area {
			overflow: hidden;
		}

		.card-area .cards {
			display: flex;
			width: 300%;
		}

		.cards .row {
			width: 33.4%;
		}

		.cards .row-1 {
			transition: all 0.3s ease;
		}

		#tab-1:checked~.card-area .cards .row-1 {
			margin-left: 0%;
		}

		#tab-2:checked~.card-area .cards .row-1 {
			margin-left: -33.4%;
		}

		#tab-3:checked~.card-area .cards .row-1 {
			margin-left: -66.8%;
		}

		.row .price-details {
			margin: 20px 0;
			text-align: center;
			padding-bottom: 25px;
			border-bottom: 1px solid #e6e6e6;
		}

		.price-details .price {
			font-size: 65px;
			font-weight: 600;
			position: relative;
			font-family: 'Noto Sans', sans-serif;
		}

		.price-details .price::before,
		.price-details .price::after {
			position: absolute;
			font-weight: 400;
			font-family: "Poppins", sans-serif;
		}

		.price-details .price::before {
			content: "$";
			left: -13px;
			top: 17px;
			font-size: 20px;
		}

		.price-details .price::after {
			content: "/mon";
			right: -33px;
			bottom: 17px;
			font-size: 13px;
		}

		.price-details p {
			font-size: 18px;
			margin-top: 5px;
		}

		.row .features li {
			display: flex;
			font-size: 15px;
			list-style: none;
			margin-bottom: 10px;
			align-items: center;
		}

		.features li i {
			background: linear-gradient(#D5A3FF 0%, #77A5F8 100%);
			background-clip: text;
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
		}

		.features li span {
			margin-left: 10px;
		}

		.wrapper button {
			width: 100%;
			border-radius: 25px;
			border: none;
			outline: none;
			height: 50px;
			font-size: 18px;
			color: #fff;
			cursor: pointer;
			margin-top: 20px;
			background: linear-gradient(145deg, #D5A3FF 0%, #77A5F8 100%);
			transition: transform 0.3s ease;
		}

		.wrapper button:hover {
			transform: scale(0.98);
		}

		.sidebar {
			position: fixed;
			left: 0;
			top: 0;
			height: 100%;
			width: 78px;
			background: #11101D;
			padding: 6px 14px;
			z-index: 99;
			transition: all 0.5s ease;
		}

		.sidebar.open {
			width: 250px;
		}

		.sidebar .logo-details {
			height: 60px;
			display: flex;
			align-items: center;
			position: relative;
		}

		.sidebar .logo-details .icon {
			opacity: 0;
			transition: all 0.5s ease;
		}

		.sidebar .logo-details .logo_name {
			color: #fff;
			font-size: 20px;
			font-weight: 600;
			opacity: 0;
			transition: all 0.5s ease;
		}

		.sidebar.open .logo-details .icon,
		.sidebar.open .logo-details .logo_name {
			opacity: 1;
		}

		.sidebar .logo-details #btn {
			position: absolute;
			top: 50%;
			right: 0;
			transform: translateY(-50%);
			font-size: 22px;
			transition: all 0.4s ease;
			font-size: 23px;
			text-align: center;
			cursor: pointer;
			transition: all 0.5s ease;
		}

		.sidebar.open .logo-details #btn {
			text-align: right;
		}

		.sidebar i {
			color: #fff;
			height: 60px;
			min-width: 50px;
			font-size: 28px;
			text-align: center;
			line-height: 60px;
		}

		.sidebar .nav-list {
			margin-top: 20px;
			height: 100%;
		}

		.sidebar li {
			position: relative;
			margin: 8px 0;
			list-style: none;
		}

		.sidebar li .tooltip {
			position: absolute;
			top: -20px;
			left: calc(100% + 15px);
			z-index: 3;
			background: #fff;
			box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
			padding: 6px 12px;
			border-radius: 4px;
			font-size: 15px;
			font-weight: 400;
			opacity: 0;
			white-space: nowrap;
			pointer-events: none;
			transition: 0s;
		}

		.sidebar li:hover .tooltip {
			opacity: 1;
			pointer-events: auto;
			transition: all 0.4s ease;
			top: 50%;
			transform: translateY(-50%);
		}

		.sidebar.open li .tooltip {
			display: none;
		}

		.sidebar input {
			font-size: 15px;
			color: #FFF;
			font-weight: 400;
			outline: none;
			height: 50px;
			width: 100%;
			width: 50px;
			border: none;
			border-radius: 12px;
			transition: all 0.5s ease;
			background: #1d1b31;
		}

		.sidebar.open input {
			padding: 0 20px 0 50px;
			width: 100%;
		}

		.sidebar .bx-search {
			position: absolute;
			top: 50%;
			left: 0;
			transform: translateY(-50%);
			font-size: 22px;
			background: #1d1b31;
			color: #FFF;
		}

		.sidebar.open .bx-search:hover {
			background: #1d1b31;
			color: #FFF;
		}

		.sidebar .bx-search:hover {
			background: #FFF;
			color: #11101d;
		}

		.sidebar li a {
			display: flex;
			height: 100%;
			width: 100%;
			border-radius: 12px;
			align-items: center;
			text-decoration: none;
			transition: all 0.4s ease;
			background: #11101D;
		}

		.sidebar li a:hover {
			background: #FFF;
		}

		.sidebar li a .links_name {
			color: #fff;
			font-size: 15px;
			font-weight: 400;
			white-space: nowrap;
			opacity: 0;
			pointer-events: none;
			transition: 0.4s;
		}

		.sidebar.open li a .links_name {
			opacity: 1;
			pointer-events: auto;
		}

		.sidebar li a:hover .links_name,
		.sidebar li a:hover i {
			transition: all 0.5s ease;
			color: #11101D;
		}

		.sidebar li i {
			height: 50px;
			line-height: 50px;
			font-size: 18px;
			border-radius: 12px;
		}

		.sidebar li.profile {
			position: fixed;
			height: 60px;
			width: 78px;
			left: 0;
			bottom: -8px;
			padding: 10px 14px;
			background: #1d1b31;
			transition: all 0.5s ease;
			overflow: hidden;
		}

		.sidebar.open li.profile {
			width: 250px;
		}

		.sidebar li .profile-details {
			display: flex;
			align-items: center;
			flex-wrap: nowrap;
		}

		.sidebar li img {
			height: 45px;
			width: 45px;
			object-fit: cover;
			border-radius: 6px;
			margin-right: 10px;
		}

		.sidebar li.profile .name,
		.sidebar li.profile .job {
			font-size: 15px;
			font-weight: 400;
			color: #fff;
			white-space: nowrap;
		}

		.sidebar li.profile .job {
			font-size: 12px;
		}

		.sidebar .profile #log_out {
			position: absolute;
			top: 50%;
			right: 0;
			transform: translateY(-50%);
			background: #1d1b31;
			width: 100%;
			height: 60px;
			line-height: 60px;
			border-radius: 0px;
			transition: all 0.5s ease;
		}

		.sidebar.open .profile #log_out {
			width: 50px;
			background: none;
		}

		.home-section {
			position: relative;
			background: #E4E9F7;
			min-height: 100vh;
			top: 0;
			left: 78px;
			width: calc(100% - 78px);
			transition: all 0.5s ease;
			z-index: 2;
		}

		.sidebar.open~.home-section {
			left: 250px;
			width: calc(100% - 250px);
		}

		.home-section .text {
			display: inline-block;
			color: #11101d;
			font-size: 25px;
			font-weight: 500;
			margin: 18px
		}

		@media (max-width: 420px) {
			.sidebar li .tooltip {
				display: none;
			}
		}

		.container .form form .button {
			background: #6665ee;
			color: #fff;
			font-size: 17px;
			font-weight: 50;
			transition: all 0.3s ease;
		}

		.container .form form .button:hover {
			background: #5757d1;
		}
	</style>
</head>

<body>
	<div class="sidebar">
		<div class="logo-details">
			<i class='images/logo.png'></i>
			<div class="logo_name">MIH</div>
			<i class='bx bx-menu' id="btn"></i>
		</div>
		<ul class="nav-list">
			<li>
				<a href="#">
					<i class='bx bx-arrow-back' id="back"></i>
					<span class="links_name">Go back</span>
				</a>
				<span class="tooltip">back</span>
			</li>
			<li>
				<a href="index.html">
					<i class='bx bx-home'></i>
					<span class="links_name">HOME</span>
				</a>
				<span class="tooltip">HOME</span>
			</li>
			<li>
				<a href="login-user.php">
					<i class='bx bx-user'></i>
					<span class="links_name">LOGIN/REGISTER</span>
				</a>
				<span class="tooltip">LOGIN/REG</span>
			</li>
			<li>
				<a href="#">
					<i class='bx bx-play-circle'></i>
					<span class="links_name">ABOUT US</span>
				</a>
				<span class="tooltip">ABOUT</span>
			</li>
			<li>
				<a href="#">
					<i class='bx bx-pie-chart-alt-2'></i>
					<span class="links_name">PLANNERS</span>
				</a>
				<span class="tooltip">PLANNER</span>
			</li>
			<li>
				<a href="#">
					<i class='bx bx-folder'></i>
					<span class="links_name">BLOG</span>
				</a>
				<span class="tooltip">BLOG</span>
			</li>
			<li>
				<a href="#">
					<i class='bx bx-message-square-detail'></i>
					<span class="links_name">CONTACT US</span>
				</a>
				<span class="tooltip">CONTACT</span>
			</li>
			<li>
				<a href="#">
					<i class='bx bx-heart'></i>
					<span class="links_name">MEMBERSHIP</span>
				</a>
				<span class="tooltip">MEMBER</span>
			</li>
			<li>
				<a href="#">
					<i class='bx bx-cog'></i>
					<span class="links_name">SETTING</span>
				</a>
				<span class="tooltip">Setting</span>
			</li>
			<li class="profile">
				<div class="name_job">
					<div class="name"><?php echo $fetch_info['name'] ?></div>
					<div class="job">USER</div>
				</div>
				<a href="logout-user.php">
					<i class='bx bx-log-out' id="log_out"></i>
				</a>
			</li>
		</ul>
	</div>
	<div class="wrapper">
		<input type="radio" name="slider" id="tab-1">
		<input type="radio" name="slider" id="tab-2" checked>
		<input type="radio" name="slider" id="tab-3">
		<header>
			<label for="tab-1" class="tab-1">Basic</label>
			<label for="tab-2" class="tab-2">Standard</label>
			<label for="tab-3" class="tab-3">Premium</label>
			<div class="slider"></div>
		</header>
		<div class="card-area">
			<div class="cards">
				<div class="row row-1">
					<div class="price-details">
						<span class="price">19</span>
						<p>Basic</p>
					</div>
					<ul class="features">
						<li><i class="fas fa-check"></i><span>100+ Messages Per Day</span></li>
						<li><i class="fas fa-check"></i><span>You can Visit Upto 30+ account a day</span></li>
					</ul>
				</div>
				<div class="row">
					<div class="price-details">
						<span class="price">99</span>
						<p>Standard</p>
					</div>
					<ul class="features">
						<li><i class="fas fa-check"></i><span>300+ Messages Per Day</span></li>
						<li><i class="fas fa-check"></i><span>You can visit upto 90+ account a day</span></li>
					</ul>
				</div>
				<div class="row">
					<div class="price-details">
						<span class="price">49</span>
						<p>Premium</p>
					</div>
					<ul class="features">
						<li><i class="fas fa-check"></i><span>Unlimited Messages Per Day</span></li>
						<li><i class="fas fa-check"></i><span>You can Visit Any Number Account a day</span></li>
					</ul>
				</div>
			</div>
		</div>
		<a href="payment.php"><button>Choose plan</button></a>
	</div>
	<script src="script.js"></script>
</body>

</html>