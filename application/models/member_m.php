<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_m extends CI_Model {

  // 會員列表
  function memberlist()
  {
    $sql =" select * from member";
    $query = $this->db->query($sql);
    return($query->num_rows() > 0) ? $query->result(): NULL;
  }

  // 會員數目

  function memberCOUNT()
  {
    $sql =" select count(*) from member";
    $query = $this->db->query($sql);
    return($query->num_rows() > 0) ? $query->result(): NULL;
  }  

}

/* End of file member_m.php */
/* Location: ./video/models/member_m.php */