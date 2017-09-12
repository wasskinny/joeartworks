<!DOCTYPE html>
<html>
	
	<?php
		include_once 'head.php';
		include_once ('../configs/dbConfig.php');
		
		if(!empty($_POST)) {
			
			if(isset($_POST["isDeleted"])) {
				
				$deleteClientID = $_POST["newClientID"];
				
				$deleteClientSQL = "DELETE from Clients ";
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
						<?php
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
						
							echo "<form name='editClient' action='" . $myFileName . "' method='post'>";
							echo '<tr>';
								echo "<input type='hidden' name='isClicked' value=1 />";
								echo "<input type='hidden' name='newClientID' value='" . $clientID . "'/></td>";
								echo "<td>" . $clientID . "</td>";
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
							
						}
					?>
				
				</table>
				</div>
			</div>	
			<div class="w3-container">
				
			</div>
		</div>
		
	</body>
	<?php
		include_once 'functions.php';
		include_once 'foot.php';
	?>

</html>