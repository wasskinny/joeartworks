<!DOCTYPE html>
<html>
	
	<?php
		include 'head.php';
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
					<p>Add stuff here....</p>
				</div>
			</div>
		</div>
		
		<?php
			include 'functions.php';	
		?>
	</body>
</html>