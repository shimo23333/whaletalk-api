<?php

/**
 * class Message_model
 */
class Message_model extends CI_Model {


    /**
     * 取得 Whale 歷史訊息
     *
	 * @param string $wid       鯨語 wid
     * @param string $uid       使用者 uid
     * @return array
     */
    public function get_list($wid, $uid)
    {
        $this->db->select('message.*');
        $this->db->where('wid', $wid);
		$this->db->where('uid', $uid);
        return $this->db->get('message')->result_array();
    }


    /**
     * 新增訊息
     *
     * @param string $wid WID
     * @return array
     */
    public function add($wid, $uid, $type, $content, $repeat_time = null)
    {
        $data = array(
            'wid'  			=> $wid,
			'uid'  			=> $uid,
			'type'  		=> $wid,
            'content'  		=> $content,
            'repeat_time'   => $repeat_time
        );

        return $this->db->insert('message', $data);
    }


	/**
     * 更新訊息
     *
     * @param string $id ID
     * @return array
     */
	public function update($id, $type, $content, $repeat_time = null)
	{
        $this->db->where('id', $id);
		$data = array(
			'type' => $type,
			'content' => $content,
			'repeat_time' => $repeat_time
		);
        return $this->db->update('message', $data);
	}


	/**
     * 刪除
     *
     * @param string $id ID
     * @return array
     */
	public function remove($id)
	{
		$this->db->where('id', $id);
        return $this->db->delete('message');
	}

}


?>
