<!DOCTYPE HTML>
<!--
	Radius by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
	Adapted by Linn Thomas to retrieve images dynamically
-->
<?php
				
	//Include database configuration file
	include('configs/dbConfig.php');
	include('configs/siteSet.php');
						
?>

<html>
	<head>
		<title>Joe's Art Works</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="css/main.css" />
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<div class="inner">
					<div class="content">
						<h1>Joe's Art Works</h1>
						<!-- <h2></h2>  -->
						<a href="#" class="button big alt"><span>Let's Go</span></a>
					</div>
					<a href="#" class="button hidden"><span>Let's Go</span></a>
				</div>
			</header>

		<!-- Main -->
			<div id="main">
				<div class="inner">
					<div class="columns">
						
								
						<?php
						
							//Get images from database
							
							$mainGallerySQL  = "SELECT * FROM images ";
							$mainGallerySQL .= "LEFT JOIN categories on images.category_id=categories.id";
								
								$mainGalleryResult = mysqli_query($db, $mainGallerySQL) or die('Unable to execute query. '. mysqli_error($db));
								$imageCount = 0;
								
								if($mainGalleryResult->num_rows > 0) {
									
									while ($row = $mainGalleryResult->fetch_assoc()){
										
										$imageThumbURL = 'images/thumbs/'.$row["img_name"];
										$imageURL = 'images/fullsized/'.$row["img_name"];
										
										$imgID = $row["id"];
										$imgName = $row["img_name"];
										$imgDescription = $row["description"];
										
										echo "<form id='subImageForm' action='gallery.php' method='post'>";
										echo "<input type='hidden' name='imgID' value='" . $imgID . "' />";
										echo "<input type='hidden' name='imgURL' value='" . $imageURL . "' />";
										echo "<div class='image fit' id='selectImage'>";
										echo "<input class='image' type='image' src='" . $imageThumbURL . "' alt='' />";
										echo "</div>";
										echo "</form>";
									}
								}

										
						?>
						
						
						
					</div>
				</div>
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
						&copy; Untitled. Design: <a href="https://templated.co">TEMPLATED</a>. Images: <a href="https://unsplash.com/">Unsplash</a>.
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