<!DOCTYPE html>
<html>
	
	<?php
		include_once 'head.php';
		include_once ('../configs/dbConfig.php');
		
		if(!empty($_POST)) {
			
			if(isset($_POST["isDeleted"])) {
				
				$deleteClientID = $_POST["newClientID"];
				
				$deleteClientSQL = "DELETE from clients ";
				$deleteClientSQL .= "WHERE ID = '" . $deleteClientID . "' ";
				
				echo $deleteClientSQL . "<br />";
				
				$deleteClientResult = mysqli_query($db, $deleteClientSQL) or die (mysqli_error($db));
				
			} else {
			
			$isClicked = $_POST["isClicked"];
			$newClientID = $_POST["newClientID"];
			$newClientSal = $_POST["newClientSal"];
			$newClientFName = $_POST["newClientFName"];
			$newClientMiddle = $_POST["newClientMiddle"];
			$newClientLName = $_POST["newClientLName"];
			$newClientSuffix = $_POST["newClientSuffix"];
			$newClientEmail = $_POST["newClientEmail"];
			$newClientPhone = $_POST["newClientPhone"];
			$newClientAltPhone = $_POST["newClientAltPhone"];
			$newClientCreated = $_POST["newClientCreated"];
			
			// I need to check to see if this user information exists
			
			$newRecordSQL = "INSERT into clients ";
			// $newRecordSQL .= "(ID, ";
			$newRecordSQL .= "(Sal, ";
			$newRecordSQL .= "FName, ";
			$newRecordSQL .= "Middle, ";
			$newRecordSQL .= "LName, ";
			$newRecordSQL .= "Suffix, ";
			$newRecordSQL .= "Email, ";
			$newRecordSQL .= "Phone, ";
			$newRecordSQL .= "2Phone, ";
			$newRecordSQL .= "Created";
			$newRecordSQL .= ") ";
			$newRecordSQL .= "VALUES ";
			// $newRecordSQL .= "('" . $newClientID . "', ";
			$newRecordSQL .= "('" . $newClientSal . "', ";
			$newRecordSQL .= "'" . $newClientFName . "', ";
			$newRecordSQL .= "'" . $newClientMiddle . "', ";
			$newRecordSQL .= "'" . $newClientLName . "', ";
			$newRecordSQL .= "'" . $newClientSuffix . "', ";
			$newRecordSQL .= "'" . $newClientEmail . "', ";
			$newRecordSQL .= "'" . $newClientPhone . "', ";
			$newRecordSQL .= "'" . $newClientAltPhone . "', ";
			$newRecordSQL .= "'" . $newClientCreated . "' ";
			$newRecordSQL .= ") ";
			$newRecordSQL .= "ON DUPLICATE KEY UPDATE ";
			$newRecordSQL .= "Sal='" . $newClientSal . "', ";
			$newRecordSQL .= "FName='" . $newClientFName . "', ";
			$newRecordSQL .= "Middle='" . $newClientMiddle . "', ";
			$newRecordSQL .= "LName='" . $newClientLName . "', ";
			$newRecordSQL .= "Suffix='" . $newClientSuffix . "', ";
			$newRecordSQL .= "Email='" . $newClientEmail . "', ";
			$newRecordSQL .= "Phone='" . $newClientPhone . "', ";
			$newRecordSQL .= "2Phone='" . $newClientAltPhone . "'";
			
			
			echo $newRecordSQL . "</br>";
			
			$newRecordResult = mysqli_query($db, $newRecordSQL) or die (mysqli_error($db));
			
			}
			
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
					<h1>Client Maintenance</h1>
				</div>
			</div>
			<div class="w3-container">
				<?php
					
					$myFileName = basename($_SERVER["SCRIPT_FILENAME"]);
					
					// echo "This is my file name " . $myFileName . "<br />";
					
					// Retrieve existing client information from database
					
					$getClientSQL = "SELECT ";
					$getClientSQL .= "ID, ";
					$getClientSQL .= "Sal, ";
					$getClientSQL .= "FName, ";
					$getClientSQL .= "Middle, ";
					$getClientSQL .= "LName, ";
					$getClientSQL .= "Email, ";
					$getClientSQL .= "Phone, ";
					$getClientSQL .= "2Phone, ";
					$getClientSQL .= "Suffix, ";
					$getClientSQL .= "Created  ";
					$getClientSQL .= "FROM ";
					$getClientSQL .= "clients  ";
					
					// echo $getClientSQL;
					
					$getClientResult = mysqli_query($db, $getClientSQL) 
						or die(mysqli_error($db));
										
					
				?>
				<div class="w3-responsive">
				<table class="w3-table-all">
					<thead>
					<tr class="w3-light-grey">
						<th>ID</th>
						<th>Salutation</th>
						<th>First Name</th>
						<th>Middle</th>
						<th>Last Name</th>
						<th>Suffix</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Alt Phone</th>
						<th>Date Created</th>
						<th></th>
						<th>Delete</th>
					</tr>
					</thead>
						<?php  // Add Client information
						echo "<form name='addClient' action='" . $myFileName . "' method='post'>";
							echo '<tr>';
								echo "<input type='hidden' name='isClicked' value=1 />";
								echo "<td><input type='hidden' name='newClientID' id='newClientID' value=''/></td>";
								echo "<td><input type='text' name='newClientSal' value=''></input></td>";
								echo "<td><input type='text' name='newClientFName' value='' required></input></td>";
								echo "<td><input type='text' name='newClientMiddle' value=''></input></td>";
								echo "<td><input type='text' name='newClientLName' value=''></input></td>";
								echo "<td><input type='text' name='newClientSuffix' value=''></input></td>";
								echo "<td><input type='email' name='newClientEmail' value=''></input></td>";
								echo "<td><input type='text' name='newClientPhone' value=''></input></td>";
								echo "<td><input type='text' name='newClientAltPhone' value=''></input></td>";
								echo "<td><input type='date' name='newClientCreated' value='" . date('Y-m-d') . "'></input></td>";
								echo "<td><button type='submit' class='w3-button'>Submit</button></td>";
							echo '</tr>';
						echo "</form>";
						
						// Show existing Clients
						
						while ($clientRow = mysqli_fetch_array($getClientResult)) {
							
							$clientID = $clientRow['ID'];
							$clientSal = $clientRow['Sal'];
							$clientFName = $clientRow['FName'];
							$clientMiddle = $clientRow['Middle'];
							$clientLName = $clientRow['LName'];
							$clientEmail = $clientRow['Email'];
							$clientPhone = $clientRow['Phone'];
							$clientAltPhone = $clientRow['2Phone'];
							$clientSuffix = $clientRow['Suffix'];
							$clientCreated = $clientRow['Created'];
						
							
							echo '<tr>';
								echo "<td><button type='' onclick='openClientModal(" . $clientID . ")'>" . $clientID . "</button></td>";
								echo "<form name='editClient' action='" . $myFileName . "' method='post'>";
								echo "<input type='hidden' name='isClicked' value=1 />";
								echo "<input type='hidden' name='newClientID' value='" . $clientID . "'/></td>";					
								echo "<td><input type='text' name='newClientSal' value='" . $clientSal . "'></td>";
								echo "<td><input type='text' name='newClientFName' value='" . $clientFName . "'></td>";
								echo "<td><input type='text' name='newClientMiddle' value='" . $clientMiddle . "'></td>";
								echo "<td><input type='text' name='newClientLName' value='" . $clientLName . "'></td>";
								echo "<td><input type='text' name='newClientSuffix' value='" . $clientSuffix . "'></td>";
								echo "<td><input type='email' name='newClientEmail' value='" . $clientEmail . "'></td>";
								echo "<td><input type='text' name='newClientPhone' value='" . $clientPhone . "'></td>";
								echo "<td><input type='text' name='newClientAltPhone' value='" . $clientAltPhone . "'></td>";
								echo "<td><input type='date' name='newClientCreated' value='" . $clientCreated . "'></td>";
								echo "<td><button class='w3-button' type='submit'>Submit</button></td>";
								echo "</form>";
								echo "<td>";
									echo "<form name='deleteClient' action='" . $myFileName . "' method='post'>";
									echo "<input type='hidden' name='newClientID' value='" . $clientID . "'>";
									echo "<input type='hidden' name='isDeleted' value=1>";
									echo "<button class='w3-button w3-red' type='submit'>&times;</button>";
									echo "</form>";
								echo "</td>";
							echo '</tr>';
							
							// Address Modal
							
																	
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
											
											echo "<div id='" . $clientsID . "' class='w3-modal'>";
												echo "<div class='w3-modal-content'>";
													echo "<div class='w3-container'>";
														echo "<span onclick='closeClientModal(" . $clientsID . ")' class='w3-button w3-display-topright'>&times;</span>";
														echo "<p> Addresses for " . $clientsID ." " . $clientFName . " " . $clientLName . "</p>";
															echo "<div class='w3-container'>";
																		echo "<div class='w3-container w3-cell-row'>";
																			echo "<div class='w3-container w3-cell w3-border w3-round-small' style='width:50%'>";
																				echo "Address ID";
																			echo "</div>";
																			echo "<div class='w3-container w3-cell w3-border w3-round-small' style='width:50%'>";
																				echo $addID;
																			echo "</div>";
																		echo "</div>";
																		echo "<div class='w3-container w3-cell-row'>";
																			echo "<div class='w3-container w3-cell w3-border w3-round-small' style='width:50%'>";
																				echo "Street 1";
																			echo "</div>";
																			echo "<div class='w3-container w3-cell w3-border w3-round-small' style='width:50%'>";
																				echo $addStreet1;
																			echo "</div>";
																		echo "</div>";
																		echo "<div class='w3-container w3-cell-row'>";
																			echo "<div class='w3-container w3-cell w3-border w3-round-small' style='width:50%'>";
																				echo "Street 2";
																			echo "</div>";
																			echo "<div class='w3-container w3-cell w3-border w3-round-small' style='width:50%'>";
																				echo $addStreet2;
																			echo "</div>";
																		echo "</div>";
																		echo "<div class='w3-container w3-cell-row'>";
																			echo "<div class='w3-container w3-cell w3-border w3-round-small' style='width:50%'>";
																				echo "City";
																			echo "</div>";
																			echo "<div class='w3-container w3-cell w3-border w3-round-small' style='width:50%'>";
																				echo $addCity;
																			echo "</div>";
																		echo "</div>";
																		echo "<div class='w3-container w3-cell-row'>";
																			echo "<div class='w3-container w3-cell w3-border w3-round-small' style='width:50%'>";
																				echo "State";
																			echo "</div>";
																			echo "<div class='w3-container w3-cell w3-border w3-round-small' style='width:50%'>";
																				echo $addState;
																			echo "</div>";
																		echo "</div>";
																		echo "<div class='w3-container w3-cell-row'>";
																			echo "<div class='w3-container w3-cell w3-border w3-round-small' style='width:50%'>";
																				echo "Zip Code";
																			echo "</div>";
																			echo "<div class='w3-container w3-cell w3-border w3-round-small' style='width:50%'>";
																				echo $addZip;
																			echo "</div>";
																		echo "</div>";
																		echo "<div class='w3-container w3-cell-row'>";
																			echo "<div class='w3-container w3-cell w3-border w3-round-small' style='width:50%'>";
																				echo "Country";
																			echo "</div>";
																			echo "<div class='w3-container w3-cell w3-border w3-round-small' style='width:50%'>";
																				echo $addCountry;
																			echo "</div>";
																		echo "</div>";												
																echo "</div>";
													echo "<p></p>";			
														echo "<div class='w3-container'>";
															echo "<div class='w3-container w3-cell-row'>";
																echo "<div class='w3-container w3-cell'>";
																	echo "Add Address";
																echo "</div>";
																echo "<div class='w3-container w3-cell'>";
																echo "</div>";
																echo "<div class='w3-container w3-cell'>";
																	echo "Delete Address";
																echo "</div>";
															echo "</div>";
														echo "</div>";
															
													echo "</div>";
												echo "</div>";
											echo "</div>";

											
										}
										
															
													
						}	
					echo "</table>";
					echo "</div>";
	
					?>
				<!-- </table> -->
				</div>
				</div>
			</div>	
			<div class="w3-container">
				
			</div>
		</div>
		
	</body>
	<footer>
	<?php
		

		include_once 'functions.php';
		include_once 'foot.php';
	?>
	</footer>
</html>