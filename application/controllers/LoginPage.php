<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginPage extends CI_Controller {

	public function login()
	{
		// 取得傳入參數
		$email = $this->input->get("email");
		$name = $this->input->get("name");
		$picture = $this->input->get("picture");

		
		// 取得是否有該使用者資料
		$this->load->model("Account_model");
		$account_data = $this->Account_model->get_by_email($email);


		if ($account_data == null)
		{
			// 沒有，註冊
			$this->Account_model->register_by_google_data($email, $name, $picture);
			$account_data = $this->Account_model->get_by_email($email);
		}
		else {

			// 有，更新google資料
			$this->Account_model->update_by_google_data($email, $name, $picture);
			$account_data = $this->Account_model->get_by_email($email);
		}


		// 回傳該使用者的各種資料
		response($account_data, 200);
	}
	
}
