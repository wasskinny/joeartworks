<!DOCTYPE html>

<html lang="en">
	
	<?php
				
	//Include database configuration file
	include('configs/dbConfig.php');
	include('configs/siteSet.php');
						
	?>

	<head>
		<meta charset="utf-8">
		<title>Joes Artworks</title>
		<meta name="description" content="Joe's Artworks">
		<meta name="author" content="Linn Thomas">
		<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		
		<link rel="stylesheet" href="css/styles.css">
		
		
	</head>
	<body>
		<div id="wrapper">
        	<div id="headerwrap">
				<div id="header">
            		<img src="assets/Title.png" />
        		</div>
        	</div>
        <div id="navigationwrap">
        	<div id="navigation">
            	<nav class="frontmenu">
	            	<a href="about.php">About</a>
	            	&lozf;
	            	<a href="purchase.php">Purchase</a>
	            	&lozf;
	            	<a href="idontknow.php">More Stuff</a>
	            	&lozf;
	            	<a href="admin/">Admin</a>
            	</nav>
        	</div>
        </div>
        <div id="contentwrap">
        	<div id="content">
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

           	</div>
        </div>
    </div>

	</body>
	<footer id="wrapper">
		<div id="footerwrap">
			<div id="footer">
		 		<div class="footer">&copy;2017 Joe's Artworks, LLC.</div>
			</div>
		</div>	
	</footer>
</html>