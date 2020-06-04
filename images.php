<?php
function resize_image($tempname,$max_resolution){
	
	if (file_exists($tempname)){
		$original_image = imagecreatefromjpeg($tempname);
		
		//resolution
		$original_width = imagesx($original_image);
		$original_height = imagesy($original_image);
		
		//try width first
		$ratio = $max_resolution / $original_width;
		$new_width = $max_resolution;
		$new_height = $original_height * $ratio;
		
		//if that didn't work
		if ($new_height > $max_resolution){
			$ratio = $max_resolution / $original_height;
			$new_height = $max_resolution;
			$new_width = $original_width * $ratio;
		}
		if ($original_image){
			$new_image = imagecreatetruecolor($new_width,$new_height);
			imagecopyresampled($new_image,$original_image,0,0,0,0,$new_width,$new_height,$original_width,$original_height);
			imagejpeg($new_image,$tempname,90);
		}
	}
}

function resize_thumb($thumb,$max_resolution){
	
	if (file_exists($thumb)){
		$original_image = imagecreatefromjpeg($thumb);
		
		//resolution
		$original_width = imagesx($original_image);
		$original_height = imagesy($original_image);
		
		//try width first
		$ratio = $max_resolution / $original_width;
		$new_width = $max_resolution;
		$new_height = $original_height * $ratio;
		
		//if that didn't work
		if ($new_height > $max_resolution){
			$ratio = $max_resolution / $original_height;
			$new_height = $max_resolution;
			$new_width = $original_width * $ratio;
		}
		if ($original_image){
			$new_image = imagecreatetruecolor($new_width,$new_height);
			imagecopyresampled($new_image,$original_image,0,0,0,0,$new_width,$new_height,$original_width,$original_height);
			imagejpeg($new_image,$thumb,90);
		}
	}
}