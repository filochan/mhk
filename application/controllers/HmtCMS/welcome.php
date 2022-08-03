<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);



class Admin extends CI_Controller {


    function __construct(){
        parent::__construct(); // needed when adding a constructor to a controller

    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
			//載入所有會員資料到$data
		$this->load->database();
		echo 'on welcome';
	    $sql =" select * from member";
	    $query = $this->db->query($sql);
	    $data['memberlist']=$query->result_array() ;

	}

}//end of class
