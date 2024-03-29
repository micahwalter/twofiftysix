<?
	#
	# $Id$
	#

	include('include/init.php');
	loadlib("twofiftysix");
	loadlib("artisanal_integers");
	loadlib("images");

	#
	# this is so we can test the logging output
	#

	if ($_GET['log_test']){
		log_error("This is an error!");
		log_fatal("Fatal error!");
	}


	#
	# this is so we can test the HTTP library
	#

	if ($_GET['http_test']){
		$ret = http_get("http://google.com");
	}

	$random_dot_image = twofiftysix_create_random_dot_image();
	
	if ($random_dot_image['status'] == 'ok'){
		$artisanal_integer = artisanal_integers_create('brooklyn');
	}
	
	$image['url'] = $random_dot_image['url'];
	$image['id'] = $artisanal_integer['integer'];
	$image['image_type'] = 'random_dot';
	
	$rsp = images_create_image($image);
	
	#
	# output
	#
	$smarty->assign('rsp', $rsp);
	$smarty->display('page_index.txt');
