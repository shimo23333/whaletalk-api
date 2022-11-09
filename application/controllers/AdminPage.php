<?php 

class AdminPage extends CI_Controller {


	public function GetWhaleMembers()
	{
		$wid = $this->input->get('wid');

		$this->load->model("whale_model");
		$members = $this->whale_model->get_members($wid);
		response($members, 200);
	}


	public function RemoveWhaleMember()
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
