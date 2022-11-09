<?php 

class UserPage extends CI_Controller {


	public function GetInfo()
	{
		$uid = $this->input->get('uid');

		$this->load->model("Account_model");
		$account = null;

		try {
			$account = $this->Account_model->get_by_uid($uid);
		} catch (Exception $e){
			response("取得失敗", 500);
		}
		
		if (!$account) {
			response("找不到使用者", 401);
		}

		response($account, 200);
	}


	public function UpdateInfo()
	{
		$uid  = $this->input->get('uid');
		$name = $this->input->get('name'); 

		$this->load->model("Account_model");

		try {
			$data = array('name' => $name);
			$this->Account_model->update($uid, $data);
		} catch (Exception $e){
			response("更新失敗", 500);
		}

		response(TRUE, 200);
	}


	public function UpdateWhaleMemberAuth()
	{
		$uid  = $this->input->get('uid');
		$wid  = $this->input->get('wid');
		$auth = $this->input->get('auth');

		$this->load->model("whale_model");

		try {
			$this->whale_model->update_member($wid, $uid, $auth);
		} catch (Exception $e){
			response("更新失敗", 500);
		}

		response(TRUE, 200);
	}
}

?>
