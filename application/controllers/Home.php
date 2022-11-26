<?php 

class Home extends CI_Controller {


	public function GetWhaleInfo()
	{
		$wid = $this->input->get('wid');

		$this->load->model("whale_model");
		$info = $this->whale_model->get_by_wid($wid);
		response($info, 200);
	}


	public function AddWhale()
	{
		$uid = $this->input->get('uid');
		$wid = $this->input->get('wid');

		// 確認使用者存在
		$this->load->model("account_model");
		$account = $this->account_model->get_by_uid($uid);
		if (!$account) {
			response('帳號不存在', 500);
		}

		// 確認鯨語存在
		$this->load->model("whale_model");
		$whale = $this->whale_model->get_by_wid($wid);
		if (!$whale) {
			response('鯨語不存在', 500);
		}

		// 確認還沒加入過
		$member = $this->whale_model->get_join($wid, $uid);
		if ($member) {
			response('已加入', 500);
		}

		// 加入
		try {
			$this->whale_model->join($wid, $uid);
		} catch (Exception $e){
			response("加入失敗", 500);
		}

		response(TRUE, 200);
	}

	
	public function RemoveWhale()
	{
		$uid = $this->input->get('uid');
		$wid = $this->input->get('wid');

		$this->load->model("whale_model");

		try {
			$this->whale_model->leave($wid, $uid);
		} catch (Exception $e){
			response("移除失敗", 500);
		}

		response(TRUE, 200);
	}


	public function UpdateWhale()
	{
		$wid  = $this->input->get('wid');
		$name = $this->input->get('name');

		$this->load->model("whale_model");

		try {
			$data = array('name' => $name);
			$this->whale_model->update($wid, $data);
		} catch (Exception $e){
			response("儲存失敗", 500);
		}

		response(TRUE, 200);
	}
}

?>
