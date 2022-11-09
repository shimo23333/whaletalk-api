<?php

class MY_Auth_Controller extends CI_Controller {

	public $escape_list = array();
	
	function __construct() 
	{
		parent::__construct();

		// 如果不在不需登入頁面中
		if (!in_array($this->router->fetch_method(), $this->escape_list)) 
		{
			// 取得登入使用者
			$this->load->model('Account_model');
			$account = $this->Account_model->get_login();
			if (!$account)
			{
				$this->response(array("message" => "Not Logged In."), 401);
			}
		}
	}

	public function response($data, $response_code)
	{
		http_response_code($response_code);
		header('Content-Type: application/json');
		echo json_encode($data);
		exit();
	}
}

?>
