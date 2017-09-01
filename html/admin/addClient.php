<!DOCTYPE html>
<html>
	
	<?php
		include_once 'head.php';
		include_once ('../configs/dbConfig.php');
		
		
		
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
					</tr>
					</thead>

					<form name="addClient" action="$myFileName">
						<?php
							echo '<tr>';
								echo "<input type='hidden' name='newClientID' value=''/>";
								echo "<td><input type='text' name='newClientSal' value=''></input></td>";
								echo "<td><input type='text' name='newClientFName' value=''></input></td>";
								echo "<td><input type='text' name='newClientMiddle' value=''></input></td>";
								echo "<td><input type='text' name='newClientLName' value=''></input></td>";
								echo "<td><input type='text' name='newClientSuffix' value=''></input></td>";
								echo "<td><input type='email' name='newClientEmail' value=''></input></td>";
								echo "<td><input type='text' name='newClientPhone' value=''></input></td>";
								echo "<td><input type='text' name='newClientAltPhone' value=''></input></td>";
								echo "<td><input type='date' name='newClientCreated' value='" . date('Y-m-d H:i:s') . "'></input></td>";
								echo "<td><button class='w3-button' type='submit'>Submit</button>";
							echo '</tr>';
					
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
								echo "<td><input type='hidden' name='newClientID' value='" . $clientID . "'/></td>";
								echo "<td><input type='text' name='newClientSal' value='" . $clientSal . "'></input></td>";
								echo "<td><input type='text' name='newClientFName' value='" . $clientFName . "'></input></td>";
								echo "<td><input type='text' name='newClientMiddle' value='" . $clientMiddle . "'></input></td>";
								echo "<td><input type='text' name='newClientLName' value='" . $clientLName . "'></input></td>";
								echo "<td><input type='text' name='newClientSuffix' value='" . $clientSuffix . "'></input></td>";
								echo "<td><input type='email' name='newClientEmail' value='" . $clientEmail . "'></input></td>";
								echo "<td><input type='text' name='newClientPhone' value='" . $clientPhone . "'></input></td>";
								echo "<td><input type='text' name='newClientAltPhone' value='" . $clientAltPhone . "'></input></td>";
								echo "<td><input type='now()' name='newClientCreated' value='" . $clientCreated . "'></input></td>";
								echo "<td><button class='w3-button' type='submit'>Submit</button>";
							echo '</tr>';
							
						}
					?>
				</form>
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