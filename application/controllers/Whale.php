<?php 

class Whale extends CI_Controller {


	public function GetList()
	{
		$uid = $this->input->get('uid');
		
		$this->load->model("Whale_model");
		$list = $this->Whale_model->get_list_by_account($uid);
		response($list, 200);
	}


	public function JoinWhale()
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
			response('您已加入過了', 500);
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


	public function UpdateWhale()
	{
		$wid = $this->input->get('wid');
		$name = $this->input->get('name');
		$image = $this->input->get('image');
		
		$this->load->model("Whale_model");
		$list = $this->Whale_model->update(
			$wid,
			array(
				"name" => $name, 
				"image" => $image
			)
		);
		response($list, 200);
	}

	// 上傳圖片
	public function UploadImage()
	{
		$data = $_POST['file'];
		$type = null;

		if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
		    $data = substr($data, strpos($data, ',') + 1);
		    $type = strtolower($type[1]); // jpg, png, gif

		    if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png' ])) {
		        response("不支援的圖片格式", 500);
		    }
		    $data = str_replace( ' ', '+', $data );
		    $data = base64_decode($data);

		    if ($data === false) {
		        response("圖片資料錯誤", 500);
		    }
		} else {
		    response("圖片傳輸資料錯誤", 500);
		}

		$fileName = uniqid('wc-', true).".".$type;
		$filePath = "uploads/whale-image/".$fileName;
		file_put_contents($filePath, $data);
		response(array('image' => $filePath), 200);
	}
}

?>
