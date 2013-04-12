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

