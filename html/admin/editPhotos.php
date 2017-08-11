<!DOCTYPE html>
<html>
	
	<?php
		include 'head.php';
		include '../configs/dbConfig.php';
		include '../configs/siteSet.php';
	?>
	
	<body>
		<div class="w3-sidebar w3-bar-block w3-collapse w3-card-2" sytle="width:200px;" id="adminSidebar">
			<button class="w3-bar-item w3-button w3-hide-large" onclick="w3_close()">Close &times;</button>
			<a href="index.php" class="w3-bar-item w3-button">Return to Admin &times;</a>
			<a href="addPhotos.php" class="w3-bar-item w3-button">Add Photos</a>
			<a href="addClient.php" class="w3-bar-item w3-button">Add Client</a>
			<a href="editClient.php" class="w3-bar-item w3-button">Edit Client</a>
		</div>
		
		<div class="w3-main" style="margin-left:200px">
			<div class="<?php echo $adminHeaderClass ?>">
				<button class="<?php echo $adminHeaderButtonClass ?>" onclick="w3_open()">&#9776;</button>
				<div class="w3-container">
					<h1>Edit Photo Gallery</h1>
				</div>
			</div>
			<div class="w3-container"
				<div class="w3-container">	
					<?php

						// Query database
						$sqlFind = 'SELECT `img_name` FROM `images`';
						$result = mysqli_query($db, $sqlFind);
						$dbase = []; // create empty array
		
						while ($row = mysqli_fetch_row($result))
							array_push($dbase, $row[0]);
		
							// Check files
							$files1 = scandir($path_to_thumbs, 1);
							$files2 = scandir($path_to_images, 1);
							$ignore = Array(".","..",".DS_Store");
							
							if ( $files1 !== false ) {
								foreach ($files1 as $i => $value) {
									
									if (in_array($value, $dbase)) {
										
									echo $value . " Is in the database and the thumb directory <br/>";
        						
        							} else {
										if (!in_array($value, $ignore)) {
										echo $value . " Is not in the database <br/>";
										unlink ($path_to_thumbs.$value);
										}
        						    }
    							}
								} else {
									echo 0;
								}
							if ( $files2 !== false ) {
								foreach ($files2 as $j => $value2) {
									
									if (in_array($value2, $dbase)) {
										echo $value2 . " Is in the database and the Images directory <br />";
									} else {
										if (!in_array($value2, $ignore)) {
											echo $value2 . " Is not in the database... removing from directory <br />";
											unlink ($path_to_images.$value2);
										}
									} 
								} 
								} else {
									echo 0;
								}
												
					?>
					
				</div>
			</div>
		</div>
		
		<?php
			include 'functions.php';	
		?>
	</body>
</html>