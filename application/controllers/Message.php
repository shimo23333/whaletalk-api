<?php 

class Message extends CI_Controller {

	public function GetMyList()
	{
		$wid  = $this->input->get('wid');
		$uid  = $this->input->get('uid');

		$this->load->model("message_model");
		$messages = $this->message_model->get_list($wid, $uid);
		response($messages, 200);
	}

	public function GetList()
	{
		$wid  = $this->input->get('wid');
		$sts  = $this->input->get('sts');
		$ste  = $this->input->get('ste');

		$this->load->model("message_model");
		$messages = $this->message_model->get_list($wid, null, $sts, $ste);
		response($messages, 200);
	}

	public function Get()
	{
		$id  = $this->input->get('id');

		$this->load->model("message_model");
		$msg = $this->message_model->get_by_id($id);
		response($msg, 200);
	}


	public function Add()
	{
		$wid  = $this->input->get('wid');
		$uid  = $this->input->get('uid');
		$type  = $this->input->get('type');
		$content  = $this->input->get('content');
		$schedule_time  = $this->input->get('schedule_time');

		$this->load->model("message_model");
		try {
			$this->message_model->add($wid, $uid, $type, $content, $schedule_time);
		} catch (Exception $e){
			response("新增失敗", 500);
		}
		response(TRUE, 200);
	}


	public function Update()
	{
		$id  = $this->input->get('id');
		$type  = $this->input->get('type');
		$content  = $this->input->get('content');
		$time  = $this->input->get('time');

		$this->load->model("message_model");
		try {
			$this->message_model->update($id, $type, $content, $time);
		} catch (Exception $e){
			response("更新失敗", 500);
		}
		response(TRUE, 200);
	}


	public function Remove()
	{
		$id  = $this->input->get('id');

		$this->load->model("message_model");
		$msg = $this->message_model->get_by_id($id);
		if ($msg['type'] == 2) {
			unlink($msg['content']);
		}

		try {
			$this->message_model->remove($id);
		} catch (Exception $e){
			response("刪除失敗", 500);
		}
		response(TRUE, 200);
	}


	public function UploadVoice()
	{
		if (isset($_FILES['audio'])) {
			$audio = $_FILES['audio'];
			
			$msg = "";
			$fileName = uniqid('v-', true).".mp3";
			$filePath = "uploads/voice/".$fileName;
			if (move_uploaded_file($_FILES['audio']['tmp_name'], $filePath)) {
				$msg = "File is valid, and was successfully uploaded.\n";
			} else {
				$msg = "Possible file upload attack!\n";
			}

			response(array('voice'=> $filePath), 200);
		}
		else {
			response('檔案錯誤', 500);
		}
	}
}

?>
