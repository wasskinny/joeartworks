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

				<div class="content">
					<form class="" action="addClient.php" method="post">
					<div class="w3-row-padding">
						<div class="w3-third">
							<label>Prefix</label>
							<select class="w3-select <?php echo $adminSelectClass ?>" name="salutation">
									<option value="0" disabled selected>Please Select</option>
									<option value="1">Mr.</option>
									<option value="2">Mrs.</option>
									<option value="3">Miss</option>
									<option value="4">Ms.</option>
									<option value="5">Dr.</option>
									<option value="6">Other</option>
							</select>
						</div>
					</div>
					<div class="w3-row-padding">
						<div class="w3-third">
							<label>First Name</label>
							<input class="w3-input w3-border w3-round" value="" name="fname" />
						</div>
						<div class="w3-third">
							<label>Middle</label>
							<input class="w3-input w3-border w3-round" value="" name="fname" />
						</div>
						<div class="w3-third">
							<label>Last Name</label>
							<input class="w3-input w3-border w3-round" value="" name="fname" />
						</div>
					</div>
					<div class="w3-row-padding">
						<div class="w3-third">
							<label>First Name</label>
							<input class="w3-input w3-border w3-round" value="" name="fname" />
						</div>
					</div>
				</div>
			</div>


<input type='text' name='newCatName' value='Add Category'>

<!-- Admin Page Template -->
<!DOCTYPE html>
<html>
	
	<head>
	
	<?php
		include_once ('head.php');
		include_once ('../configs/dbConfig.php');
		
		require '../configs/siteSet.php';
		require 'functions.php';
 		
		
		
	?>
	
	</head>
	
	<body>
		
		<div class="w3-sidebar w3-bar-block w3-collapse w3-card-2" sytle="width:200px;" id="adminSidebar">
			<button class="w3-bar-item w3-button w3-hide-large" onclick="w3_close()">Close &times;</button>
			<div w3-include-html="menu.html">
			</div>
		</div>
		
		<div class="w3-main" style="margin-left:200px">
		<!-- Header Div -->
			<div class="<?php echo $adminHeaderClass ?>">
				<button class="<?php echo $adminHeaderButtonClass ?>" onclick="w3_open()">&#9776;</button>
				<div class="w3-container">
					<!-- Header -->
				</div>
			</div> <!-- End of Head Div -->
		<!-- Body Div -->
			<div class="w3-container">

			</div>   <!-- End of Body Div -->
		</div>
		
		<?php
			// include_once 'functions.php';
			include_once 'foot.php';
		?>
	</body>
</html>

echo "<div id='" . $clientID . "' class='w3-modal'>";
								echo "<div class='w3-modal-content'>";
									echo "<div class='w3-container'>";
										echo "<span onclick='closeClientModal(" . $clientID . ")' class='w3-button w3-display-topright'>&times;</span>";
										echo "<p> Addresses for " . $clientID ." " . $clientFName . " " . $clientLName . "</p>";
										
										$clientAddressSQL = "SELECT `clients`.`ID` AS `clientsID`, ";
										$clientAddressSQL .= "`addresses`.`ID` AS `addID`, `addresses`.*, ";
										$clientAddressSQL .= "`client_addresses`.`ID` AS `clientAddId`, `client_addresses`.* ";
										$clientAddressSQL .= "FROM `clients` ";
										$clientAddressSQL .= "LEFT JOIN `client_addresses` ON `client_addresses`.`client_id` = `clients`.`ID` ";
										$clientAddressSQL .= "LEFT JOIN `addresses` ON `client_addresses`.`address_id` = `addresses`.`ID` ";
										$clientAddressSQL .= "WHERE `clients`.`ID` = " . $clientID;
										
										// echo $clientAddressSQL;
										
										$clientAddressResult = mysqli_query($db, $clientAddressSQL) or die (mysqli_error($db));
										
										while ($clientAddressRow = mysqli_fetch_array($clientAddressResult)) {
											
											$addID = $clientAddressRow["addID"];
											$clientsID = $clientAddressRow["clientsID"];
											$clientAddID = $clientAddressRow["clientAddId"];
											$addStreet1 = $clientAddressRow["Street1"];
											$addStreet2 = $clientAddressRow["Street2"];
											$addCity = $clientAddressRow["City"];
											$addState = $clientAddressRow["State"];
											$addZip = $clientAddressRow["ZIP"];
											$addCountry = $clientAddressRow["Country"];
											
											echo "<table class='w3-table'>";
												echo "<tr>";
													echo "<td>";
														echo "Address ID";
													echo "</td>";
													echo "<td>";
														echo $addID;
													echo "</td>";
												echo "</tr>";
												echo "<tr>";
													echo "<td>";
														echo "Street 1";
													echo "</td>";
													echo "<td>";
														echo $addStreet1;
													echo "</td>";
												echo "</tr>";
												echo "<tr>";
													echo "<td>";
														echo "Street 2";
													echo "</td>";
													echo "<td>";
														echo $addStreet2;
													echo "</td>";
												echo "</tr>";
												echo "<tr>";
													echo "<td>";
														echo "City";
													echo "</td>";
													echo "<td>";
														echo $addCity;
													echo "</td>";
												echo "</tr>";
												echo "<tr>";
													echo "<td>";
														echo "State";
													echo "</td>";
													echo "<td>";
														echo $addState;
													echo "</td>";
												echo "</tr>";
												echo "<tr>";
													echo "<td>";
														echo "Zip Code";
													echo "</td>";
													echo "<td>";
														echo $addZip;
													echo "</td>";
												echo "</tr>";
												echo "<tr>";
													echo "<td>";
														echo "Country";
													echo "</td>";
													echo "<td>";
														echo $addCountry;
													echo "</td>";
												echo "</tr>";												
											echo "</table>";
											
										}
										
									echo "</div>";
								echo "</div>";
							echo "</div>";

