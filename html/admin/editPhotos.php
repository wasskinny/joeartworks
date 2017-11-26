<!DOCTYPE html>
<html>
	
	<?php
		include 'head.php';
		include '../configs/dbConfig.php';
		include '../configs/siteSet.php';
		
		if (isset($_POST["newID"])) {
		
			$newID = $_POST["newID"];
			$newTitle = $_POST["newTitle"];
			$newDescription = $_POST["newDescription"];
			
			$newSQL =  "UPDATE images SET ";
			$newSQL .= "title = '" . $newTitle . "', ";
			$newSQL .= "Description = '" . $newDescription . "' ";
			$newSQL .= "WHERE Id = '" . $newID . "'";
			
			// echo "New SQL = " . $newSQL . "<br />";
			
			$updateResult = mysqli_query($db, $newSQL);
			
			if (!isset($_POST["imgOriginal"])) {
				
				$imgOriginal = 0;
				
				$imgOriginalSQL = "UPDATE images SET ";
				$imgOriginalSQL .= "original = '" . $imgOriginal . "' ";
				$imgOriginalSQL .= "Where Id = '" . $newID . "' ";
				
				$originalResult = mysqli_query($db, $imgOriginalSQL);
				
			}
					
		}
		
		if (isset($_POST["newCatName"])) {
			
			$newCatName = $_POST["newCatName"];
			
			$newCatNameSQL = "INSERT into categories ";
			$newCatNameSQL .= "(`category`) VALUES ('" . $newCatName . "') ";
			$newCatNameSQL .= "ON DUPLICATE KEY UPDATE category = category";
			
			$newCategoryResult = mysqli_query($db, $newCatNameSQL);
			
			$newCatSQL = "SELECT ID FROM categories ";
			$newCatSQL .= "WHERE Category = '" . $newCatName . "' ";
			
			$updateCatID = mysqli_fetch_array(mysqli_query($db, $newCatSQL));
			$newCategory = $updateCatID['ID'];
			
			$newCatSQL = "UPDATE images SET ";
			$newCatSQL .= "category_id = '" . $newCategory . "' ";
			$newCatSQL .= "WHERE Id = '" . $newID . "'";
			
			$categoryResult = mysqli_query($db, $newCatSQL);
		}
		
		if (isset($_POST["newCategory"])) {
			
			$newCategory = $_POST["newCategory"];
			
			$newCatSQL = "UPDATE image_categories SET ";
			$newCatSQL .= "categories_id = '" . $newCategory . "' ";
			$newCatSQL .= "WHERE Image_id = '" . $newID . "'";
			
			$categoryResult = mysqli_query($db, $newCatSQL);
		}
				
		if (isset($_POST["imgOriginal"])) {
			
			$imgOriginal = $_POST["imgOriginal"];
			
			// echo "This is the imgOriginal " . $imgOriginal ;
			
			$imgOriginalSQL = "UPDATE images SET ";
			$imgOriginalSQL .= "original = '" . $imgOriginal . "' ";
			$imgOriginalSQL .= "WHERE Id= '" . $newID . "' ";
			
			$originalResult = mysqli_query($db, $imgOriginalSQL);
			
		}
		
		if (isset($_POST["delPhoto"])) {
			
			$delSQL = "DELETE from images Where id='" . $newID . "'";
			
			$deleteResult = mysqli_query($db, $delSQL);
			
		}
		
	?>
	
	<body>
		<div class="w3-sidebar w3-bar-block w3-collapse w3-card-2" sytle="width:200px;" id="adminSidebar">
			<button class="w3-bar-item w3-button w3-hide-large" onclick="w3_close()">Close &times;</button>
			<div w3-include-html="menu.html">
			</div>
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
						$result = mysqli_query($db, $sqlFind) or die (mysqli_error($db));
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
										echo $value . " Is not in the database... Removing Thumbnail <br/>";
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
											echo $value2 . " Is not in the database... Removing Image from directory <br />";
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
						
						$sqlImages =  "SELECT * FROM images i ";
						// $sqlImages .= "INNER JOIN image_categories d on i.id = d.image_id ";
						// $sqlImages .= "INNER JOIN categories c on c.ID = d.categories_id"
						$sqlImages .= ";";
						
						$sqlLoadImages = mysqli_query($db, $sqlImages);
						$imageCount = 0;
						
						// $sqlCategories = "SELECT * FROM categories";
						// $sqlLoadCategories = mysqli_query($db, $sqlCategories);
						
						
						while ($row = mysqli_fetch_array($sqlLoadImages,MYSQLI_ASSOC)) {
							
								$imgID = $row["id"];
								$imgName = $row["img_name"];
								$imgTitle = $row["title"];
								$imgDescription = $row["description"];
								$imgOriginal = $row["original"];
								// $imgCategory = $row["category"];
								
								if ($imgOriginal == "1") {
									$imgOriginal = "checked";
								} else {
									$imgOriginal = "";
								}
											
								if($imageCount%4 == 0) {
										echo '<div class="w3-row-padding w3-margin-top">';
									}
											
									echo '<div class="w3-quarter">';
									echo '<div class="w3-card-4 w3-center">';										
									echo "<img src='".$path_to_thumbs.$imgName."' class='middle' alt='" . $imgTitle . "' onclick='photomodal(".$imgID.")' class='w3-hover-opacity' /><br />";
									echo "<span class='w3-small'>" . $imgTitle . "</span>";
									echo "</div>";
									echo '<div id="'.$imgID.'" class="w3-modal w3-animate-zoom"  align="center">';
									echo "<div class='w3-modal-content' >";
										// echo "<div class='w3-card'>";
											echo "<header class='w3-container" . $adminHeaderClass . "'>";
												echo '<span onclick="closePhotoModal('.$imgID.')" class="w3-button w3-display-topright">&times;</span>';
												echo "<p>" . $imgTitle . "</p>";
											echo "</header>";
											echo "<div class='w3-container'>";
												echo "<div class='w3-container w3-grey w3-cell'>";
												echo "<img src='" . $path_to_images.$imgName . "' style='width:250px'/>";
												echo "</div>";
											// echo "</div>";
											echo "<div class='w3-container w3-cell'>";
												echo "<form class='w3-container w3-light-grey' name='updatePhotos' action='editPhotos.php' method='post'>";
												echo "<div class='w3-row w3-border'>";
													echo "<div class='w3-third'>";
														echo "<label class='w3-red'>Delete Photo</label><br />";
														echo "<input class='w3-check' type='checkbox' name='delPhoto' value='delPhoto' >";
													echo "</div>";	
													echo "<div class='w3-third '>";
														echo "<label>Original</label><br />";
														echo "<input class='w3-check' type='checkbox' name='imgOriginal' value='1' " . $imgOriginal . ">";
													echo "</div>";
												echo "</div>";
												echo "<input type='hidden' name='newID' value='" . $imgID . "'>";
												echo "<label>Title</label>";
												echo "<input class='w3-input w3-round-1' type='text' name='newTitle' value='" . $imgTitle . "' />";
												echo "<label>Description</label>";
												echo "<input class='w3-input w3-round-1' type='text' name='newDescription' value='" . $imgDescription . "' />";
												echo "<br />";
												echo "<button class='w3-submit w3-btn w3-green'>Submit</button>";
																						
												echo "</form>";
												echo "<br />";
												
												echo "<div class='w3-row-padding w3-border'>";
													echo "<div class='w3-row w3-border'";
													echo "<div class='w3-third'>";
													// echo "<form id='editCatForm' class='w3-container w3-light-grey w3-form' action='editphots.php' method='post'>";
													echo "<label>Categories</label>";
													echo "</div>";
													echo "<div class='w3-row'>";
												// Retrieve and display categories
												
												$displayCatSQL = "SELECT category FROM images i ";
												$displayCatSQL .= "JOIN image_categories d on i.id = d.image_id ";
												$displayCatSQL .= "JOIN categories c on c.ID = d.categories_id ";
												$displayCatSQL .= "WHERE i.id = " . $imgID;
												$displayCatSQL .= ";";
												
												// echo "displayCatSQL is " . $displayCatSQL . "<br />"; 
												
												$displayCatResult = mysqli_query($db, $displayCatSQL);
												
												while ($catRow = mysqli_fetch_assoc($displayCatResult)) {
													
													$category = $catRow["category"];
													
													echo "<div class='w3-third'>";
													echo "<div class='w3-container'>";
													echo $category;
													echo "</div>";
													echo "</div>";
													
												}
												
													echo "</div>";
												echo "</div>";
											echo "</div>";
											echo "<div class='w3-container'>";
											echo "<p></p>";
											echo "</div>";
											echo "</div>";
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