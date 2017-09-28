<!DOCTYPE HTML>
<!--
	Radius by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<?php
	
	if (isset($_POST)) {
		
		$imageID = $_POST["imgID"];
		$imageURL = $_POST["imgURL"];
	}
	
?>
<html>
	<head>
		<title>Photo Detail and Ordering Information</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="css/main.css" />
	</head>
	<body>

		<!-- Header -->
			<header id="header" class="preview">
				<div class="inner">
					<div class="content">
						<h1>Joe's Art Works</h1>
						<h2></h2>
					</div>
					<a href="index.php" class="button hidden"><span>Let's Go</span></a>
				</div>
			</header>

		<!-- Main -->
			<div id="preview">
				<div class="inner">
					<div class="image fit">
						<?php echo "<img src='" . $imageURL . "' alt='' />" ?>
					</div>
					<div class="content">
						<header>
							<h2>Joe's the Man</h2>
						</header>
						<p>Stuff about Joe</p>
					</div>
				</div>
				<a href="detail1.php" class="nav previous"><span class="fa fa-chevron-left"></span></a>
				<a href="detail2.php" class="nav next"><span class="fa fa-chevron-right"></span></a>
			</div>

		<!-- Footer -->
			<footer id="footer">
				<a href="#" class="info fa fa-info-circle"><span>About</span></a>
				<div class="inner">
					<div class="content">
						<h3>Vestibulum hendrerit tortor id gravida</h3>
						<p>In tempor porttitor nisl non elementum. Nulla ipsum ipsum, feugiat vitae vehicula vitae, imperdiet sed risus. Fusce sed dictum neque, id auctor felis. Praesent luctus sagittis viverra. Nulla erat nibh, fermentum quis enim ac, ultrices euismod augue. Proin ligula nibh, pretium at enim eget, tempor feugiat nulla.</p>
					</div>
					<div class="copyright">
						<h3>Follow me</h3>
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
						</ul>
						&copy; Joe's Art Works, LLC.
					</div>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="js/jquery.min.js"></script>
			<script src="js/skel.min.js"></script>
			<script src="js/util.js"></script>
			<script src="js/main.js"></script>

	</body>
</html>