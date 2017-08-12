<!DOCTYPE html>
<html>
	
	<head>
	
	<?php
		include_once ('head.php');
		include_once ('../configs/dbConfig.php');
		
		require '../configs/siteSet.php';
		require 'functions.php';
 		
		include ('upload.php');
		$obj = New Upload();
		if(isset($_POST['submit'])) {
			$msg = $obj->upload_img();
		}
		
	?>
	
	</head>
	
	<body>
		
		<div class="w3-sidebar w3-bar-block w3-collapse w3-card-2" sytle="width:200px;" id="adminSidebar">
			<button class="w3-bar-item w3-button w3-hide-large" onclick="w3_close()">Close &times;</button>
			<a href="index.php" class="w3-bar-item w3-button">Return to Admin &times;</a>
			<a href="editPhotos.php" class="w3-bar-item w3-button">Edit Gallery</a>
			<a href="addClient.php" class="w3-bar-item w3-button">Add Client</a>
			<a href="editClient.php" class="w3-bar-item w3-button">Edit Client</a>
		</div>
		
		<div class="w3-main" style="margin-left:200px">
		<!-- Header Div -->
			<div class="<?php echo $adminHeaderClass ?>">
				<button class="<?php echo $adminHeaderButtonClass ?>" onclick="w3_open()">&#9776;</button>
				<div class="w3-container">
					<h1>Add Photos</h1>
				</div>
			</div> <!-- End of Head Div -->
		<!-- Body Div -->
			<div>
				
				<div class="w3-container">
							
					<form name="upload_img" class="w3-container" enctype="multipart/form-data" method="post">
						<input class="w3-input w3-border" type="file" name="img_files[]" id="img_file" multiple="multiple" />
						<input name="submit" class="w3-input w3-border" type="submit" value="Go!" />
					</form>
				</div>
				<div class="w3-container">
					<?php if( isset($msg) && $msg != '') {
						?> <div class="msg" id="notification"><?php print_r($msg); ?> </div> <?php 
					} ?>
				</div>
				<div class="w3-container"> <!-- Some kind of divider... -->
				</div>
				<div>
					<div class="w3-container">
						<?php
						
							$sqlImages =  "SELECT * FROM images ";
							$sqlImages .= "LEFT JOIN categories on images.category_id=categories.id";
							$sqlImages .= ";";
						
							$sqlLoadImages = mysqli_query($db, $sqlImages);
							$imageCount = 0;
						
							while ($row = mysqli_fetch_array($sqlLoadImages,MYSQLI_ASSOC)) {
							
								$imgID = $row["id"];
								$imgName = $row["img_name"];
								$imgCategory = $row["category"];
								
								echo "<a href='" . $path_to_images.$imgName . "'><img class='mySlides' src='" . $path_to_thumbs.$imgName . "'></a>";								
							}	
						?>	
					</div>
				</div>
			</div>   <!-- End of Body Div -->
		
		</div>
		
		<?php
			// include_once 'functions.php';
			include_once 'foot.php';
		?>
	</body>
</html>