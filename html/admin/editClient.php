<!DOCTYPE html>
<html>
	
	<?php
		include 'head.php';
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
					<h1>Edit Client Information</h1>
					<p>Add stuff here....</p>
				</div>
			</div>
		</div>
		
		<?php
			include 'foot.php';
			include 'functions.php';	
		?>
	</body>
</html>