<?php
	
	include('../configs/dbConfig.php');
	include('upload.php');
	$obj = New Upload();
	
	if(isset($_POST['submit'])){
		$msg = $obj->upload_img();
	}
?>

<!DOCTYPE html>
<html>
	<head>
	
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="author" content="Joes Art Works">
		<link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="../css/styles.css" type="text/css" />
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		
	</head>
	
	<body>
		<div class="container">
			<div class="row">
				<div class="heading_wrapper">
					
					<?php
						if( isset($msg) && $msg != '') {
					?>
						<div class="msg" id="notification">
							<?php print_r($msg); ?>
						</div>				
					<?php	} ?>
					
						<div class="col-md-12">
							<div class="heading">
								<h2>Upload Multiple Images and Generate Thumbnails </h2>
							</div>
						</div>
				</div>
				<div class="content_wrapper">
					<div class="col-md-6 col-md-offset-3">
						<div class="content">
							<form name="upload_img" method="post" enctype="multipart/form-data">
								<div class="upload_field">
									<div class-"upload_img">
										<input class="image" name="img_files[]" type="file" multiple="multiple">
										<span class="add_more custom_span btn btn-primary">Add More</span>
									</div>
								</div>
								<input class="submit btn btn-success col-md-offset-3" name="submit" type="submit" value="Upload">
							</form>
						</div>
					</div>
				</div>
			</div>							
		</div>
		
		<script>
			$(document).ready(function() {
				$(".add_more").click(function() {
					$('.upload_field').append('<div class="upload_img">
						<input class="image" name="img_files[]" type="file" multiple="multiple"
						<span class="remove custom_span btn btn-danger" >Remove</span>
						</div>');
				});
				$('.content').on('click', '.remove', function() {
					$(this).parent("div.upload_img").remove();
				});
				
				var msg = "<?php if(isset($msg)){ echo $msg; } ?>";
				
				if( msg !=''){
					$("#notification").html(msg);
					if ( $( "#notification p" ).length ) {
						$( "#notification p" ).slideDown("slow");
						setTimeout(function() { $("#notification p").slideUp("slow"); }, 8000);
				}
				if ( $( "#notification ul" ).length ) {
					$("#notification ul").slideDown("slow");
					setTimeout(function(){ $("#notificaiton ul").slideUp("slow"); }, 8000);
				}
				}
			});
		</script>
	</body>
</html>