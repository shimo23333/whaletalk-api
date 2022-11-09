<?php

/**
 * class Whale_model
 */
class Whale_model extends CI_Model {


    /**
     * 取得使用者有加入的 Whale
     *
     * @param string $uid       使用者 uid
     * @return array
     */
    public function get_list_by_account($uid)
    {
        $this->db->select('whale.*');
		$this->db->join('whale_member', 'whale_member.wid = whale.wid');
        $this->db->where('whale_member.uid', $uid);
        return $this->db->get('whale')->result_array();
    }


    /**
     * 取得鯨語資料
     *
     * @param string $wid WID
     * @return array
     */
    public function get_by_wid($wid)
    {
        $this->db->where('wid', $wid);
        $results = $this->db->get('whale')->result_array();
        return isset($results[0]) ? $results[0] : NULL;
    }


	/**
     * 取得鯨語單一使用者
     *
     * @param string $wid WID
	 * @param string $uid UID
     * @return array
     */
	public function get_join($wid, $uid)
	{
		$this->db->where('wid', $wid);
		$this->db->where('uid', $uid);
		$results = $this->db->get('whale_member')->result_array();
        return isset($results[0]) ? $results[0] : NULL;
	}


	/**
     * 取得鯨語全部使用者
     *
     * @param string $wid WID
     * @return array
     */
	public function get_members($wid)
	{
		$this->db->select('account.*, whale_member.is_admin');
		$this->db->join('whale_member', 'whale_member.uid = account.uid');
        $this->db->where('whale_member.wid', $wid);
        return $this->db->get('account')->result_array();
	}


	/**
     * 更新使用者權限
     *
     * @param string $wid WID
     * @return array
     */
	public function update_member($wid, $uid, $is_admin)
	{
        $this->db->where('whale_member.wid', $wid);
		$this->db->where('whale_member.uid', $uid);
		$data = array('is_admin' => $is_admin);
        return $this->db->update('whale_member', $data);
	}


	/**
     * 使用者加入鯨語
     *
     * @param string $wid WID
	 * @param string $uid UID
     * @return array
     */
	public function join($wid, $uid)
	{
		$is_admin = TRUE; 

		$data = array(
            'wid'  => $wid,
            'uid'  => $uid,
            'is_admin'  => $is_admin
        );

        return $this->db->insert('whale_member', $data);
	}


	/**
     * 使用者離開鯨語
     *
     * @param string $wid WID
	 * @param string $uid UID
     * @return array
     */
	public function leave($wid, $uid)
	{
		$this->db->where('wid', $wid);
		$this->db->where('uid', $uid);
        return $this->db->delete('whale_member');
	}


    /**
     * 修改
     *
     * @param int $wid WID
	 * @param array $data 修改參數
     * @return bool
     */
    public function update($wid, $data)
    {
        $this->db->where('wid', $wid);
        return $this->db->update('whale', $data);
    }
}


?>
