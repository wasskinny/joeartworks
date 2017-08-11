<script>
			
	function w3_open() {
		document.getElementById("adminSidebar").style.display = "block";
	}
			
	function w3_close() {
		document.getElementById("adminSidebar").style.display = "none";
	}
	
	function openAddPhoto() {
		document.getElementById('addOnePhoto').style.display = "block";
	}
	
	function closeAddPhoto() {
		document.getElementById('addOnePhoto').style.display = "none";
	}
	
	function photomodal($photocount) {
		$modalID = $photocount;
		document.getElementById($modalID).style.display = "block";
	}
	
	function closePhotoModal($photocount) {
		$modalID = $photocount;
		document.getElementById($modalID).style.display = "none";
	}
	
	
	
	
		
</script>

<?php
	
	function createThumbnail($filename) {
		
		require '../configs/siteSet.php';
		
		if(preg_match('/[.](jpg)$/', $filename)) {
			$im = imagecreatefromjpeg($path_to_images . $filename);
		} else if (preg_match('/[.](gif)$/', $filename)) {
			$im = imagecreatedfromgif($path_to_images . $filename);
		} else if (preg_match('/[.](png)$/', $filename)) {
			$im = imagecreatedfrompng($path_to_images . $filename);
		}
		
		$ox = imagesx($im);
		$oy = imagesy($im);
		
		$nx = $final_width_of_thumb;
		$ny = floor($oy * ($final_width_of_thumb / $ox));
		
		$nm = imagecreatetruecolor($nx, $ny);
		
		imagecopyresized($nm, $im, 0,0,0,0,$nx,$ny,$ox,$oy);
		
		if(!file_exists($path_to_thumbs)) {
			if(!mkdir($path_to_thumbs)) {
				die("There was a problem.  Please try again!");
			}
		}
		
		imagejpeg($nm, $path_to_thumbs_directory . $filename);
			$tn = '<img src="' . $path_to_thumbs . $filename . '" alt="image" />';
			$tn .= '<br />Congratulations. Your file has been successfully uploaded, and a      thumbnail has been created.';
			
			echo $tn;
	}
?>