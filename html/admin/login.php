<html>

<?php 

    // First we execute our common code to connection to the database and start the session 
    require("common.php"); 
     
    // This variable will be used to re-display the user's username to them in the 
    // login form if they fail to enter the correct password.  It is initialized here 
    // to an empty value, which will be shown if the user has not submitted the form. 
    $submitted_username = ''; 
     
    // This if statement checks to determine whether the login form has been submitted 
    // If it has, then the login code is run, otherwise the form is displayed 
    if(!empty($_POST)) 
    { 
        // This query retreives the user's information from the database using 
        // their username. 
        $query = " 
            SELECT 
                id, 
                username, 
                password, 
                salt, 
                email 
            FROM users 
            WHERE 
                username = :username 
        "; 
         
        // The parameter values 
        $query_params = array( 
            ':username' => $_POST['username'] 
        ); 
         
        try 
        { 
            // Execute the query against the database 
            $stmt = $db1->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            // Note: On a production website, you should not output $ex->getMessage(). 
            // It may provide an attacker with helpful information about your code.  
            die("Failed to run query: " . $ex->getMessage()); 
        } 
         
        // This variable tells us whether the user has successfully logged in or not. 
        // We initialize it to false, assuming they have not. 
        // If we determine that they have entered the right details, then we switch it to true. 
        $login_ok = false; 
         
        // Retrieve the user data from the database.  If $row is false, then the username 
        // they entered is not registered. 
        $row = $stmt->fetch(); 
        if($row) 
        { 
            // Using the password submitted by the user and the salt stored in the database, 
            // we now check to see whether the passwords match by hashing the submitted password 
            // and comparing it to the hashed version already stored in the database. 
            $check_password = hash('sha256', $_POST['password'] . $row['salt']); 
            for($round = 0; $round < 65536; $round++) 
            { 
                $check_password = hash('sha256', $check_password . $row['salt']); 
            } 
             
            if($check_password === $row['password']) 
            { 
                // If they do, then we flip this to true 
                $login_ok = true; 
            } 
        } 
         
        // If the user logged in successfully, then we send them to the private members-only page 
        // Otherwise, we display a login failed message and show the login form again 
        if($login_ok) 
        { 
            // Here I am preparing to store the $row array into the $_SESSION by 
            // removing the salt and password values from it.  Although $_SESSION is 
            // stored on the server-side, there is no reason to store sensitive values 
            // in it unless you have to.  Thus, it is best practice to remove these 
            // sensitive values first. 
            unset($row['salt']); 
            unset($row['password']); 
             
            // This stores the user's data into the session at the index 'user'. 
            // We will check this index on the private members-only page to determine whether 
            // or not the user is logged in.  We can also use it to retrieve 
            // the user's details. 
            $_SESSION['user'] = $row; 
             
            // Redirect the user to the private members-only page. 
            header("Location: home.php"); 
            die("Redirecting to: home.php"); 
        } 
        else 
        { 
            // Tell the user they failed 
            print("Login Failed."); 
             
            // Show them their username again so all they have to do is enter a new 
            // password.  The use of htmlentities prevents XSS attacks.  You should 
            // always use htmlentities on user submitted values before displaying them 
            // to any users (including the user that submitted them).  For more information: 
            // http://en.wikipedia.org/wiki/XSS_attack 
            $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); 
        } 
    } 
     
?> 

<head>
	<title>Joe's ArtWorks - Admin</title>
	<meta name="author" content="(c)Joes ArtWorks, LLP / Linn Thomas"
	<meta name="viewport" content="width=device-width, initial-scale=1">
		
	<link rel="stylesheet" href="css/w3.css">
	<link rel="stylesheet" href="css/mystyles.css">
	
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous">
	  
 	</script>
		
</head>

<?php
	
	include("styleSet.php")

?>

<body>
	<div class="w3-main" >
			<div class="<?php echo $adminHeaderClass ?>">
				
				<div class="w3-container">
					<h1>Joe's ArtWorks Administration</h1>
				</div>
				
			</div>
			<div class="w3-container">
				<h1>Login</h1> 
					<button onclick="document.getElementById('id01').style.display='block'" class="w3-button w3-green w3-large">Login</button>
		
					<div id="id01" class="w3-modal">
						<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width: 600px">
							<div class="w3-center">
							<br>
							<span onclick="document.getElementById('id01').style.display='none'" class="w3-botton w3-xlarge w3-hover-red w3-display-topright" title="Close Login">&times;</span>
							<!-- <img src="" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top"> -->
							</div>
							<form action="login.php" method="post" class"w3-container"> 
								<div class="w3-section w3-center">
									<label>Username</label> 
									<input class="w3-input w3-border w3-magin-bottom" type="text" name="username" value="<?php echo $submitted_username; ?>" required /> 
									<label>Password</label> 
									<input class="w3-input w3-border" type="password" name="password" value="" required/> 
									<button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Login</button>
									<input class="w3-check w3-margin-top" type="checkbox" checked="checked"> Remember me
						<!-- <input type="submit" value="Login" /> -->
								</div>
							</form> 
							<div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
								<button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
								<!-- <span class="w3-right w3-padding w3-hide-small">Forgot <a href="#">password?</a></span> -->
      						</div>
						</div>
					</div>		
			</div>
	</div>
<?php include 'foot.php'; ?>

</body>
</html>