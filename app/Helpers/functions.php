<?php

function menu_active($current,$id1, $id2=null){
	$active = ($id2) ? (($current[0]==$id1) && isset($current[1]) && ($current[1]==$id2)) : ($current[0]==$id1);
	return ($active) ? "active" : "";
}

function ImageUpload($file) {
	// delete_picture($logo, "student-pics");
	$ext = $file->getClientOriginalExtension();
	$ext = 'png';
	$destinationPath = public_path("images/");
	$fileName = "logo". ".$ext";						
	Image::make($file)->widen(200)->save($destinationPath.$fileName);
}