<?php

	#
	# $Id$
	#

	#################################################################

	#
	# create a new image
	# ARE NOT ESCAPED.
	#

	function images_create_image($image){
		
		$image['created'] = time();
		
		#
		# now create the escaped version
		#

		$hash = array();
		foreach ($image as $k => $v){
			$hash[$k] = AddSlashes($v);
		}

		$ret = db_insert('images', $hash);

		if (!$ret['ok']) return $ret;

		#
		# cache the unescaped version
		#

		$image['id'] = $ret['insert_id'];

		cache_set("USER-{$image['id']}", $image);
		return array(
			'ok'	=> 1,
			'image'	=> $image,
		);
		
	}

	#################################################################

	function images_get_by_id($id){

		$image = db_single(db_fetch("SELECT * FROM images WHERE id=".intval($id)));

		cache_set("IMAGE-{$image['id']}", $image);

		return $image;
	}
