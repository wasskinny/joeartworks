<!DOCTYPE HTML>
<html>
	<?php
		
		include('configs/dbConfig.php');
		
		
		if(isset($_POST)) {
			
			$firstImg = $_POST['imgID'];
			$firstURL = $_POST['imgURL'];
			
		}
		
		$nextImgSQL = "SELECT id, img_name FROM images WHERE id = (SELECT min(id) FROM images WHERE id > " . $firstImg . ")";
		$nextImgQuery = mysqli_query($db, $nextImgSQL);
		
		if($nextImgQuery->num_rows === 0) {
			$firstImgSQL = "SELECT id, img_name FROM images ORDER BY id ASC LIMIT 1";
			$nextImgQuery = mysqli_query($db, $firstImgSQL);
		}

		$nextImgResult = mysqli_fetch_assoc($nextImgQuery);
		$nextImg = $nextImgResult['id'];
		$nextImgName = $nextImgResult['img_name'];
		$nextImgURL = "images/fullsized/" . $nextImgName;
		
		// echo "This is the next image " . $nextImg . "<br />";
				
			
		$previousImgSQL = "SELECT id, img_name FROM images WHERE id = (SELECT max(id) FROM images WHERE id < " . $firstImg . ")";
		$previousImgQuery = mysqli_query($db, $previousImgSQL);
		
		if($previousImgQuery->num_rows === 0) {
			$lastImgSQL = "SELECT id, img_name FROM images ORDER BY id DESC LIMIT 1";
			$previousImgQuery = mysqli_query($db, $lastImgSQL);
		}

		$previousImgResult = mysqli_fetch_assoc($previousImgQuery);
		$previousImg = $previousImgResult['id'];
		$previousImgName = $previousImgResult['img_name'];
		$previousImgURL = "images/fullsized/" . $previousImgName;
		
		// echo "This is the previous image " . $previousImg . "<br />";
		// echo "This is the previous Url " . $previousImgURL . "<br />";
				
					
	?>
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
					<a href="index.php" class="button hidden"><span>Take A Look</span></a>
				</div>
			</header>

		<!-- Main -->
			<div id="preview">
				<div class="inner">
					<div class="image fit">
						<?php echo "<img src='" . $firstURL . "' alt='' />" ?>
					</div>
					<div class="content">
						<?php
						
						// Photo Information
						
						$imageInfoSQL = "SELECT * FROM images ";
						$imageInfoSQL .= "WHERE images.id = " . $firstImg;
						
						// echo "This is the SQL for imageInfoSQL " . $imageInfoSQL . "<br />";

						$imageInfoQuery = mysqli_query($db, $imageInfoSQL);
						$imageInfoResult = mysqli_fetch_assoc($imageInfoQuery);
						
						$imageID = $imageInfoResult['id'];
						$imageName = $imageInfoResult['img_name'];
						$imageTitle = $imageInfoResult['title'];
						$imageDescription = $imageInfoResult['description'];
						
						echo "<div class='titlebox'>";
						echo "<header>";
						echo "	<h2>" . $imageTitle . "</h2>";
						echo "</header>";
						echo "<p>" . $imageDescription . "</p>";
						echo "</div>";
						
						?>
					</div>
				</div>
				
				<form method='post' action='gallery.php'>
					<?php
						
						echo "<input type='hidden' name='imgURL' value='" . $previousImgURL . "' />";
						echo "<input type='hidden' name='imgID' value='" . $previousImg . "' />";
					?>
					<input type="image" class="nav previous" value='&#10094;'></input>
				</form>
				<form method='post' action='gallery.php'>
					<?php
						
						echo "<input type='hidden' name='imgURL' value='" . $nextImgURL . "' />";
						echo "<input type='hidden' name='imgID' value='" . $nextImg . "' />";
					?>				
					<input type="image" class="nav next" value='&#10095;'></input>
				</form>
				
			</div>
			
		<!-- Footer -->
			<footer id="footer">
				<a href="#" class="info fa fa-info-circle"><span>Order</span></a>
				<div class="inner">
					<div class="content">
						<h3>Ordering Information</h3>
						
					</div>
					<div class="copyright">
						<h3>Follow me</h3>
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
							
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