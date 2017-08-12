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
								
							$images = scandir($path_to_thumbs);
							$ignore = Array(".","..",".DS_Store");
									
									
							$photocount = 0;
								
							foreach($images as $curimg) {
									
								if(!in_array($curimg, $ignore)) {
											
									if($photocount%4 == 0) {
										echo '<div class="w3-row-padding w3-margin-top">';
									}
											
									echo '<div class="w3-quarter">';
									echo '<div class="w3-card-4">';
											
									echo "<img src='".$path_to_thumbs.$curimg."' style='width:100%' alt='' onclick='photomodal(".$photocount.")' class='w3-hover-opacity' />";
									echo '<div id="'.$photocount.'" class="w3-modal w3-animate-zoom" onclick="closePhotoModal('.$photocount.')" align="center">';
									echo "<img class='w3-modal-content' src='" . $path_to_images.$curimg."' />";
									echo '</div>';
									echo '<div class="w3-container">';
									echo '<h4></h4>';
									echo '</div>';
									echo '</div>';
									echo '</div>';
											
									if($photocount%4 == 3) {
										echo "</div>";
									}
											
									$photocount++;
																				
								}
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