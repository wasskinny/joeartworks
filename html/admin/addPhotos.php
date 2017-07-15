<!DOCTYPE html>
<html>
	
	<?php
		include_once ('head.php');
		include_once ('../configs/dbConfig.php');
		/* include ('upload.php'); */
		if(isset($_POST['submit'])) {
			$msg = $obj->upload_img();
		}
	?>
	
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
				<button onclick="openAddPhoto()" class="w3-button">Add One Photo</button>
				<div id="addOnePhoto" class="w3-modal">
					<div class="w3-modal-content">
						<div class="w3-container">
							<span onclick="closeAddPhoto()" class="w3-button w3-display-topright">&times;</span>
							<div>
								<p>Add code for uploading photos</p>
							</div>
						</div>
					</div>
				</div>
				
			</div> <!-- End of Body Div -->
		
		</div>
		
		<?php
			include_once 'functions.php';
			include_once 'foot.php';
		?>
	</body>
</html>