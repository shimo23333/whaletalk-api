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
        $this->db->order_by('id', 'DESC');
        return $this->db->get('message')->result_array();
    }

    /**
     * 取得 Whale 歷史訊息
     *
     * @param string $id       訊息 id
     * @return array
     */
    public function get_by_id($id)
    {
        $this->db->select('message.*');
        $this->db->where('id', $id);
        $results = $this->db->get('message')->result_array();
        return isset($results[0]) ? $results[0] : NULL;
    }


    /**
     * 新增訊息
     *
     * @param string $wid WID
     * @return array
     */
    public function add($wid, $uid, $type, $content, $schedule_time = null)
    {
        $data = array(
            'wid'  			=> $wid,
			'uid'  			=> $uid,
			'type'  		=> $type,
            'content'  		=> $content,
            'schedule_time' => $schedule_time
        );

        return $this->db->insert('message', $data);
    }


	/**
     * 更新訊息
     *
     * @param string $id ID
     * @return array
     */
	public function update($id, $type, $content, $schedule_time = null)
	{
        $this->db->where('id', $id);
		$data = array(
			'type' => $type,
			'content' => $content,
			'schedule_time' => $schedule_time
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
