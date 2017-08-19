<?php 

    // First we execute our common code to connection to the database and start the session 
    require("common.php"); 
     
    // At the top of the page we check to see whether the user is logged in or not 
    if(empty($_SESSION['user'])) 
    { 
        // If they are not, we redirect them to the login page. 
        header("Location: login.php"); 
         
        // Remember that this die statement is absolutely critical.  Without it, 
        // people can view your members-only content without logging in. 
        die("Redirecting to login.php"); 
    } 
     
    // Everything below this point in the file is secured by the login system 
     
    // We can retrieve a list of members from the database using a SELECT query. 
    // In this case we do not have a WHERE clause because we want to select all 
    // of the rows from the database table. 
    $query = " 
        SELECT 
            id, 
            username, 
            email 
        FROM users 
    "; 
     
    try 
    { 
        // These two statements run the query against your database table. 
        $stmt = $db1->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) 
    { 
        // Note: On a production website, you should not output $ex->getMessage(). 
        // It may provide an attacker with helpful information about your code.  
        die("Failed to run query: " . $ex->getMessage()); 
    } 
         
    // Finally, we can retrieve all of the found rows into an array using fetchAll 
    $rows = $stmt->fetchAll(); 
?> 

<!DOCTYPE html>
<html>
	
	<head>
	
	<?php
		// include_once ('head.php');
		include_once ('../configs/dbConfig.php');
		
		require '../configs/siteSet.php';
		require 'functions.php';
		require 'styleSet.php';
 	?>
 	<title>Joe's ArtWorks - Admin</title>
	<meta name="author" content="(c)Joes ArtWorks, LLP / Linn Thomas"
	<meta name="viewport" content="width=device-width, initial-scale=1">
		
	<link rel="stylesheet" href="css/w3.css">
	<link rel="stylesheet" href="css/mystyles.css">
	
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous">
	  
 	</script>
		
</head>
	
	<body>
		
		<div class="w3-sidebar w3-bar-block w3-collapse w3-card-2" sytle="width:200px;" id="adminSidebar">
			<button class="w3-bar-item w3-button w3-hide-large" onclick="w3_close()">Close &times;</button>
			<a href="home.php" class="w3-bar-item w3-button">Return to Admin &times;</a>
			<a href="addPhotos.php" class="w3-bar-item w3-button">Add Photos</a>
			<a href="editPhotos.php" class="w3-bar-item w3-button">Edit Gallery</a>
			<a href="addClient.php" class="w3-bar-item w3-button">Add Client</a>
			<a href="editClient.php" class="w3-bar-item w3-button">Edit Client</a>
			<a href="register.php" class="w3-bar-item w3-button">Register Admins</a>
			<a href="editAdmin.php" class="w3-bar-item w3-button">Edit Admins</a>
			<br />
			<a href="logout.php" class="w3-bar-item w3-button">Log Out</a>
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
				<h1>Memberlist</h1> 
					<table> 
						<tr> 
							<th>ID</th> 
							<th>Username</th> 
							<th>E-Mail Address</th> 
    					</tr> 
						<?php foreach($rows as $row): ?> 
						<tr> 
							<td><?php echo $row['id']; ?></td> <!-- htmlentities is not needed here because $row['id'] is always an integer --> 
							<td><?php echo htmlentities($row['username'], ENT_QUOTES, 'UTF-8'); ?></td> 
							<td><?php echo htmlentities($row['email'], ENT_QUOTES, 'UTF-8'); ?></td> 
        				</tr> 
						<?php endforeach; ?> 
					</table> 
			</div>   <!-- End of Body Div -->
		</div>
		
		<?php
			// include_once 'functions.php';
			include_once 'foot.php';
		?>
	</body>
</html>

