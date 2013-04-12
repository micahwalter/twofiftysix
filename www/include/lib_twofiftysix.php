<?php

	loadlib("http");
	
	########################################################################

	function twofiftysix_is_server_running(){

		$url = $GLOBALS['cfg']['twofiftysix_pony_server'];
		$rsp = http_get($url);
		
		if ((! $rsp['ok']) && ($rsp['code'] == 0)){
			return 0;
		}

		$data = json_decode($rsp['body'], 'as hash');

		if (! $data){
			return 0;
		}

		if (! isset($data['status'])){
			return 0;
		}

		return 1;
	}

	########################################################################

	function twofiftysix_create_random_dot_image(){

		$url = $GLOBALS['cfg']['twofiftysix_pony_server'] . "random";
		$rsp = http_get($url);
		
		if ((! $rsp['ok']) && ($rsp['code'] == 0)){
			return 0;
		}

		$data = json_decode($rsp['body'], 'as hash');

		if (! $data){
			return 0;
		}

		if (! isset($data['status'])){
			return 0;
		}

		return $data;
	}
	
?>