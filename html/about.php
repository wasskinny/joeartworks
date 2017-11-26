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
	            	<a href="index.php">Home</a>
	            	&lozf;
	            	<a href="purchase.php">Purchase</a>
	            	&lozf;
	            	<a href="clientLogin.php">Client Login</a>
	            	&lozf;
	            	<a href="admin/">Admin</a>
            	</nav>
        	</div>
        </div>
        <div id="contentwrap">
        	<div id="content">
	        	<!-- Main -->
				<div class="aboutTitle">Joe Schacher</div>
				<div class="aboutBody">Joe Schacher is an Idaho native, born in 1960.  Joe has predominantly worked in wood and stone to produce three-dimensional art.  A hand injury caused Joe to change art mediums in 2016 and now he is primarily practicing in watercolors.  Joe enjoys trying to capture God’s creation in all its colors and dimensions.  The LCSC Center for Arts and History Juried Watercolor Competition is the first public showing of his work.
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