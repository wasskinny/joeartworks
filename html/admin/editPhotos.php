<!DOCTYPE html>
<html>
	
	<?php
		include 'head.php';
		include '../configs/dbConfig.php';
		include '../configs/siteSet.php';
		
		if (isset($_POST["newID"])) {
		
			$newID = $_POST["newID"];
			$newDescription = $_POST["newDescription"];
			
			$newSQL =  "UPDATE images SET ";
			$newSQL .= "Description = '" . $newDescription . "' ";
			$newSQL .= "WHERE Id = '" . $newID . "'";
			
			$updateResult = mysqli_query($db, $newSQL);
		
		}
	?>
	
	<body>
		<div class="w3-sidebar w3-bar-block w3-collapse w3-card-2" sytle="width:200px;" id="adminSidebar">
			<button class="w3-bar-item w3-button w3-hide-large" onclick="w3_close()">Close &times;</button>
			<a href="home.php" class="w3-bar-item w3-button">Return to Admin &times;</a>
			<a href="addPhotos.php" class="w3-bar-item w3-button">Add Photos</a>
			<a href="addClient.php" class="w3-bar-item w3-button">Add Client</a>
			<a href="editClient.php" class="w3-bar-item w3-button">Edit Client</a>
			<a href="register.php" class="w3-bar-item w3-button">Register Admins</a>
			<a href="logout.php" class="w3-bar-item w3-button">Log Out</a>
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
							
							// Check for Thumbnails in Database
							if ( $files1 !== false ) {
								foreach ($files1 as $i => $value) {
									
									if (in_array($value, $dbase)) {
										
									// echo $value . " Is in the database and the thumb directory <br/>";
        						
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
							// Check for Images in Database	
							if ( $files2 !== false ) {
								foreach ($files2 as $j => $value2) {
									
									if (in_array($value2, $dbase)) {
										// echo $value2 . " Is in the database and the Images directory <br />";
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
							// Check for Database entries with no full images pictures
							if ( $dbase !== false ) {
								foreach ($dbase as $k => $value3) {
									if (in_array($value3, $files2)) {
										// echo $value3 . " Is in Database and Images <br />";
									} else {
										echo "Removing " . $value3 . " from database <br />";
										$sqlRemove = "DELETE from images where img_name = '$value3'";
										$result = mysqli_query($db, $sqlRemove);
									}
								}
							}
							
							// Check for Database entries with no thumbnails
							if ( $dbase !== false ) {
								foreach ($dbase as $k => $value3) {
									if (in_array($value3, $files1)) {
										// echo $value3 . " Is in Database and Thumbnails <br />";
									} else {
										echo "Removing " . $value3 . " from database <br />";
										$sqlRemove = "DELETE from images where img_name = '$value3'";
										$result = mysqli_query($db, $sqlRemove);
									}
								}
							}

												
					?>
					
				</div>
				<div class="w3-container">
					<!-- Image Gallery for Editing Images and Quantities -->
					<!-- Add photos pulls images from thumb directory and links to full
						This gallery and slideshow will be pulled from the database -->
						
					<?php
						
						$sqlImages =  "SELECT * FROM images ";
						$sqlImages .= "LEFT JOIN categories on images.category_id=categories.id";
						$sqlImages .= ";";
						
						$sqlLoadImages = mysqli_query($db, $sqlImages);
						$imageCount = 0;
						
						while ($row = mysqli_fetch_array($sqlLoadImages,MYSQLI_ASSOC)) {
							
								$imgID = $row["id"];
								$imgName = $row["img_name"];
								$imgDescription = $row["description"];
								$imgCategory = $row["category"];
											
								if($imageCount%4 == 0) {
										echo '<div class="w3-row-padding w3-margin-top">';
									}
											
									echo '<div class="w3-quarter">';
									echo '<div class="w3-card-4 w3-center">';										
									echo "<img src='".$path_to_thumbs.$imgName."' class='middle' alt='" . $imgDescription . "' onclick='photomodal(".$imgID.")' class='w3-hover-opacity' /><br />";
									echo "<span class='w3-small'>" . $imgDescription . "</span>";
									echo "</div>";
									echo '<div id="'.$imgID.'" class="w3-modal w3-animate-zoom"  align="center">';
									echo "<div class='w3-modal-content' >";
										// echo "<div class='w3-card'>";
											echo "<header class='w3-container" . $adminHeaderClass . "'>";
												echo '<span onclick="closePhotoModal('.$imgID.')" class="w3-button w3-display-topright">&times;</span>';
												echo "<p>" . $imgDescription . "</p>";
											echo "</header>";
											echo "<div class='w3-container'>";
											echo "<img src='" . $path_to_images.$imgName . "' style='width:80%'/>";
											echo "</div>";
											echo "<form class='w3-container w3-light-grey' name='updatePhotos' action='editPhotos.php' method='post'>";
											echo "<input type='hidden' name='newID' value='" . $imgID . "'>";
											echo "<label>Description</label>";
											echo "<input class='w3-input w3-round-1' type='text' name='newDescription' value='" . $imgDescription . "' />";
											echo "<button class='w3-submit w3-btn w3-green'>Submit</button>";
											
											echo "</form>";
									echo "</div>";
									echo '</div>';
									echo '</div>';
									
																			
								if($imageCount%4 == 3) {
										echo "</div>";
									}
											
								$imageCount++;
																											
						}	
							
						
							
					?>
					
					
				</div>
			</div>
		</div>
		
		<?php
			include 'foot.php';
			include 'functions.php';	
		?>
	</body>
</html>