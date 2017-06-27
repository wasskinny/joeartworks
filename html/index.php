<html>
	<head>
	
	<!-- My Styles -->
	<link rel="stylesheet" type="text/css" href="./css/styles.css" />
	
	<!-- fancybox CSS Library -->
	<link rel="stylesheet" type="text/css" href="fancybox/dist/jquery.fancybox.css" />
	<!-- JS Library -->
	<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
	<!-- fancybox JS Library -->
	<script src="fancybox/dist/jquery.fancybox.js"></script>
	
	<script type="text/javascript">
		$("[data-fancybox]").fancybox({ });
	</script>
	</head>
	<body>
		<p>Hello World</p>
	
	<div class="container">
		<div class="gallery">
			<?php
				
				//Include database configuration file
				include('../configs/dbConfig.php');
				
				//Get images from database
				$query = $db->query(
					"SELECT * FROM images ORDER BY uploaded_on DESC"
					);
					
				if($query->num_rows > 0){
					while($row = $query->fetch_assoc()){
						$imageThumbURL = 'images/thumb/'.$row["file_name"];
						$imageURL = 'images/'.$row["file_name"];
						
			?>
				
				<a href="<?php echo $imageURL; ?>" data-fancybox="group" data-caption="<?php echo $row["title"]; ?>" >
					<img src="<?php echo $imageThumbURL; ?>" alt="" />
				</a>
			<?php
					}
				} ?>
		</div>
	</div>
	</body>
</html>