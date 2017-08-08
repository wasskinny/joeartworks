<!DOCTYPE html>
<html>
	
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
	
	<style type="text/css">
		<!--
			li{
				list-style-type:none;
				margin-right:10px;
				margin-bottom:10px;
				float:left;
			}

-->
</style></head>
	
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
				<!-- <button class="<?php echo $adminHeaderButtonClass ?>" onclick="w3_open()">&#9776;</button>
				<div class="w3-container">
					<h1>Add Photos</h1>
				</div> -->
			</div> <!-- End of Head Div -->
		<!-- Body Div -->
			<div>
				
								
<!--				
				<button onclick="openAddPhoto()" class="w3-button <?php echo $addPhotoButtonColor ?>">Add One Photo</button>
				<div id="addOnePhoto" class="w3-modal">
					<div class="w3-modal-content"> -->
						<div class="w3-container">
							<span onclick="closeAddPhoto()" class="w3-button w3-display-topright">&times;</span>
							<div class="w3-container <?php echo $addPhotosForm ?>">
								<h2>Upload a photo</h2>
							</div>
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
							<!-- <div class="w3-container w3-third"> -->
							<!-- A gallery pulled from the thumbs directory -->
							<div>
								<ul>
								<?php
								
									$images = scandir($path_to_thumbs);
									$ignore = Array(".","..",".DS_Store");
								
									foreach($images as $curimg) {
									
										if(!in_array($curimg, $ignore)) {
																				
											echo "<li>";
											echo "<img src='".$path_to_thumbs.$curimg."' style='width:150px' alt='' />";
											echo "</li>";
										}
									}
								?>
								</ul>
							</div>
							
								
						</div>
<!--					</div>
				</div> -->
				
			</div> <!-- End of Body Div -->
		
		</div>
		
		<?php
			include_once 'functions.php';
			include_once 'foot.php';
		?>
	</body>
</html>