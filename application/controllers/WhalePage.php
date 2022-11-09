<?php 

class WhalePage extends CI_Controller {


	public function GetList()
	{
		$uid = $this->input->get('uid');
		
		$this->load->model("Whale_model");
		$list = $this->Whale_model->get_list_by_account($uid);
		response($list, 200);
	}


	public function AddWhale()
	{
		$uid = $this->input->get('uid');
		$wid = $this->input->get('wid');

		// 確認使用者存在
		$this->load->model("Account_model");
		$account = $this->Account_model->get_by_uid($uid);
		if (!$account) {
			response('帳號不存在', 500);
		}

		// 確認鯨語存在
		$this->load->model("Whale_model");
		$whale = $this->Whale_model->get_by_wid($wid);
		if (!$whale) {
			response('鯨語不存在', 500);
		}

		// 確認還沒加入過
		$member = $this->Whale_model->get_join($wid, $uid);
		if ($member) {
			response('已加入', 500);
		}

		// 加入
		try {
			$this->Whale_model->join($wid, $uid);
		} catch (Exception $e){
			response("加入失敗", 500);
		}

		response(TRUE, 200);
	}

	
	public function RemoveWhale()
	{
		$uid = $this->input->get('uid');
		$wid = $this->input->get('wid');

		$this->load->model("Whale_model");

		try {
			$this->Whale_model->leave($wid, $uid);
		} catch (Exception $e){
			response("移除失敗", 500);
		}

		response(TRUE, 200);
	}
}

?>
