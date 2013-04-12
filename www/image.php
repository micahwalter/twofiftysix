<?php

	include("include/init.php");
	loadlib("images");
	
	if ($id = get_int64("id")){
		$image = images_get_by_id($id);
		$GLOBALS['smarty']->assign_by_ref("image", $image);
	}
	
	if (! $image){
		error_404();
	}
	
	$GLOBALS['smarty']->display("page_image.txt");
	exit();	

?>