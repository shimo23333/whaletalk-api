<?php

/**
 * class Account_model
 */
class Account_model extends CI_Model {


    /**
     * 用 email 取得使用者資訊
     *
     * @param string $email email
     * @return array
     */
    public function get_by_email($email)
    {
        $this->db->where('email', $email);
        $results = $this->db->get('account')->result_array();
        return isset($results[0]) ? $results[0] : NULL;
    }


	/**
     * 用 uid 取得使用者資訊
     *
     * @param int $uid UID
     * @return array
     */
	public function get_by_uid($uid)
	{
		$this->db->where('uid', $uid);
        $results = $this->db->get('account')->result_array();
        return isset($results[0]) ? $results[0] : NULL;
	}


	/**
     * 修改
     *
     * @param int $uid UID
	 * @param array $data 修改參數
     * @return bool
     */
    public function update($uid, $data)
    {
        $this->db->where('uid', $uid);
        return $this->db->update('account', $data);
    }


    /**
     * 刪除會員
     *
     * @param int $uid UID
     * @return bool
     */
    public function delete($uid)
    {
        $this->db->where('uid', $uid);
        return $this->db->delete('account');
    }


    /**
     * 取得使用者IP
     *
     * @return string
     */
    public function get_client_ip() 
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }


    /**
     * 用 Google 登入資料註冊會員
     */
    public function register_by_google_data($email, $name, $picture) 
    {
        // 記錄從 google 傳來的資料
        $data = array(
            'email'   => $email,
            'name'    => $name,
            'picture' => $picture,
            'last_login_at' => date("Y-m-d H:i:s"),
            'uid'     => $this->create_uid()
        );

        return $this->db->insert('account', $data);
    }


    /**
     * 更新 Google 會員資料
     */
    public function update_by_google_data($email, $name, $picture)
    {
        $data = array(
            'picture' => $picture
        );

        $this->db->where('email', $email);
        return $this->db->update('account', $data);
    }


    /**
     * 產生 UID
     */
    public function create_uid()
    {
        return uniqid();
    }
}


?>
