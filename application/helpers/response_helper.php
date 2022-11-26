<?php

if (!function_exists('response')) {
	function response($data, $response_code) 
	{
		http_response_code($response_code);
		header('Content-Type: application/json');
		echo json_encode($data, JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE );
		exit();
	}
}

?>
