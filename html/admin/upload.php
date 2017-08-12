<?php
include('../configs/dbConfig.php');

require_once('resize_image/resize_image.php');

class Upload {
  
    function __construct() {

    }

	function upload_img(){
		if(isset($_POST['submit'])){
			global $db;
			$msg = '';	
			$max_upload_size = (int)(ini_get('upload_max_filesize'));
			if (count($_FILES["img_files"]) > 0) {
				$folderName = '../images/fullsized/';
				$thumbsFolderName = '../images/thumbs/';

				for ($i = 0; $i < count($_FILES["img_files"]["name"]); $i++) {
					$file_name = $_FILES["img_files"]["name"][$i];
					$file_type = $_FILES["img_files"]["type"][$i];
					$file_size = $_FILES["img_files"]["size"][$i];
					if( isset($file_name) && $file_name != "") {
						if($this->file_size($file_size, $max_upload_size)){
							if($this->file_extension($file_type)){
								$filename = time() . '_' . $file_name;
								$filepath = $folderName . $filename;
								if (!move_uploaded_file($_FILES["img_files"]["tmp_name"][$i], $filepath)) {
									$msg .= "<p class='msg_error'>Failed to upload <strong>" . $filename . "</strong>.</p>";
								} else {
									$sqlUpload = "INSERT INTO images (img_name, description, original) VALUES ('$filename', '$file_name', '1') ";
									$result = mysqli_query($db, $sqlUpload);
									printf("Errormessage: %s\n", $result->error);
									$msg .= "<p class='msg_success'><strong>" . $file_name . "</strong> uploaded successfully.</p>" ;

									$magicianObj = new imageLib($filepath);
									$magicianObj->resizeImage(100, 100);
									$magicianObj->saveImage($thumbsFolderName . $filename, 100);
								}
							}else{
								$msg .= "<p class='msg_error'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
							}
						}else{
							$msg .= "<p class='msg_error'>Uploaded image size is too large, please upload image less then ".intval($max_upload_size)."Mb.</p>";
						}
					}
				}
			} else {
				$msg .= "<p class='msg_error'>Please upload at least one image file.</p>";
			}
		}
		return $msg;
	}

	function file_extension($filetype,$type=array()){
		$ext_arr = array( 'jpg' => 'image/jpeg',
		                   'png' => 'image/png',
		                   'gif' => 'image/gif'
		                   );
		if(!empty($type)){
		    $ext_arr = array_merge($ext_arr,$type);
		}
		$return =false;
		// Allow certain file formats
		if(array_search($filetype, $ext_arr)) {
		    $return =true;
		}
		return $return;
	}

	function file_size($filesize, $max_upload_size){
	    // Check file size
	    $return = false;
	    if ($filesize < $max_upload_size*1000000) {
	      $return = true;
	    }
	    return $return;
  	}

}