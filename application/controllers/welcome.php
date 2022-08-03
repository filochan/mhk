<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);

class Welcome extends CI_Controller {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{


		$this->load->view('head_view');
		$this->load->view('login_view');
		$this->load->view('footer_view');
	}
	public function logincheck()
	{
		$this->load->database();
		$username = $this->input->post('txtUserName');
		$password = $this->input->post('txtPwd');

	    $sql =" select * from member where account='".$username."' and password='".$password."' and groups=3 ";
	    $query = $this->db->query($sql);

	    $data = $query->result_array();
		//echo '<script>alert("'.count($data).'");</script>';

	    if (count($data) > 0){
	    	//print_r($data[0]);

	    $this->session->set_userdata('num',$data[0]['num']);

	    $this->session->set_userdata('accnum',$data[0]['accnum']);
		//$this->load->view('report_head_view');
		//$this->load->view('report_body_1',$data[0]);
	    redirect(base_url()."welcome/report1/".$data[0]['num']);

		//direct base_url('welcome/report1').'/'.$data[0]['num'];
	    }else{

		$this->load->view('head_view');
		$this->load->view('login_view');
		$this->load->view('footer_view');


	    }


	}	
	public function sporttype($date)
	{

	    $sql =" SELECT * FROM table_1 order by note desc";

	    $query = $this->db->query($sql);
	    //echo $sql ;
	    $data = $query->result_array();
	    
	    return $data ;
	}	
	public function biddata($date)
	{
		//$sporttype=$this->sportdata();
		//$date = date("Y-m-d",'2017-03-29');
		$yesterday = date("Y/m/d",strtotime("-1 day"));
    	$nextdate = date("Y/m/d",strtotime("+2 day"));
    	//$yesterday = '2017-03-28';
    	//$nextdate = '2017-03-30';
    	//echo '昨日yesterday:'.$yesterday;
    	//echo 'nextdate:'.$nextdate;
	    $sql =" SELECT * FROM table_4 WHERE tickettime >= '$yesterday' AND   tickettime <  '$nextdate' order by tickettime desc";
	    $sql = "select * from table_4 where command='' and ticketid <> 0 ";

	    //$sql = " select * from table_4 where tickettime >='2017/04/02'";
	    //echo '<br>sql:'.$sql ;
	    //$query = $this->db->query(“SET NAMES UTF8“);
	    $query = $this->db->query($sql);
	   	//echo $sql;
	    $data = $query->result_array();
	    //echo "<pre>";
	    //print_r($data);
	    //echo "</pre>";
	    $today = date("Y/m/d");
	    if (count($data)==0){
	    }else{
			$sql = "update table_4 set command='$today' where command='' and ticketid <> 0 ";
	  		$query = $this->db->query($sql);
	    }
	    $sql = "select * from table_6 where ticketId <> 0 order by ticketID DESC";
	    $query = $this->db->query($sql);
	    $data = $query ->result_array();
	    	
	    $minticketid = $data[0]['ticketId'];

	    //echo '<pre>';
	    //print_r($data);
	    //echo '</pre>';

	    foreach($data as $row){

	    	//echo trim(substr($row['content'],0,strpos($row['content'],'-')));
	    	if ($row['results']==0){
	    		$unsporttype[trim(substr($row['content'],0,strpos($row['content'],'-')))]++ ;

	    	}else{
	    		$sporttype[trim(substr($row['content'],0,strpos($row['content'],'-')))]++ ;

	    	}
	    }
	    $sporttype['date']=$date ;
	    $unsporttype['date']=$date ;

	    return $data ;
	}
	public function report1($agent)
	{
		$this->load->helper('array');

        $session = $this->session->userdata('num'); //here you can take loginid, email whatever you store in session
        if(!$session)
        {
            redirect(base_url());
        }
		$this->load->database();
		$username = $this->input->post('txtUserName');
		$password = $this->input->post('txtPwd');

	    $sql =" select * from member where num=".$agent;
	    $query = $this->db->query($sql);

	    $data = $query->result_array();
		//echo '<script>alert("'.count($data).'");</script>';

	    if (count($data) > 0){
	    	//print_r($data[0]);

	    $this->session->set_userdata('num',$data[0]['num']);

    	$today = date('Y/m/d');
		//$today = date('Y-m-d','2017-03-29');


    	$bid = $this->biddata($today);

    	$sporttype = $this->sporttype($today);

    	//$unsporttype = $this->unsporttype($today);
    	$sporttype['sport']= $sporttype ;

	    $sql =" select * from member where num=".$agent;
	    $query = $this->db->query($sql);

	    $agents = $query->result_array();
	    $boy['agents']=$agents[0];
	    $boy['amount']=0 ;
	    $boy['eff_amount'] = 0 ;
	    $boy['results'] = 0 ;
	    $boy['total'] = 0 ;
	    $boy['agentamount'] = 0 ;
	    $boy['sql'] = $sql ;
	    
	    //echo '<pre>';
	    //print_r($sporttype);
	    //echo '</pre>';
		
	        	
	    foreach($bid as $row){
	    	 $boy['total']++ ;
	    	$boy['results']=$boy['results']+$row['Results'];
	    	$boy['amount']=$boy['amount']+$row['SysAmount'];
	    	$boy['agentamount']=$boy['agentamount']+$row['L4Amt'];
	    	$boy['eff_amount']=$boy['eff_amount']+$row['EffectiveAmount'];
	    }
	    //echo '<script>alert("'.$agents[0].'");</script>';
	    //print_r($agents[0]);
		$this->load->view('report_head_view',$agents[0]);
		$this->load->view('report_summary_view',$sporttype);
		$this->load->view('report_table_1',$boy);
		$this->load->view('report_body_1');



	    }


	}

	public function test($agent)
	{
		$this->load->helper('array');

        $session = $this->session->userdata('num'); //here you can take loginid, email whatever you store in session
        if(!$session)
        {
            redirect(base_url());
        }
		//echo '<script>alert("report1");</script>';
		$this->load->database();
		$username = $this->input->post('txtUserName');
		$password = $this->input->post('txtPwd');

	    $sql =" select * from member where num=".$agent;
	    $query = $this->db->query($sql);

	    $data = $query->result_array();
		//echo '<script>alert("'.count($data).'");</script>';

	    if (count($data) > 0){
	    	//print_r($data[0]);

	    $this->session->set_userdata('num',$data[0]['num']);

    	$today = date('Y/m/d');
		//$today = date('Y-m-d','2017-03-29');


    	$bid = $this->biddata($today);

    	$sporttype = $this->sporttype($today);

    	//$unsporttype = $this->unsporttype($today);
    	$sporttype['sport']= $sporttype ;



	    $sql =" select * from member where groups=2";
	    $query = $this->db->query($sql);

	    $agents = $query->result_array();
	    $boy['agents']=$agents[0];
	    $boy['amount']=0 ;
	    $boy['eff_amount'] = 0 ;
	    $boy['results'] = 0 ;
	    $boy['total'] = 0 ;
	    $boy['agentamount'] = 0 ;
	    $boy['sql'] = $sql ;
	    
	    //echo '<pre>';
	    //print_r($sporttype);
	    //echo '</pre>';
		
	        	
	    foreach($bid as $row){
	    	 $boy['total']++ ;
	    	$boy['results']=$boy['results']+$row['Results'];
	    	$boy['amount']=$boy['amount']+$row['SysAmount'];
	    	$boy['agentamount']=$boy['agentamount']+$row['L4Amt'];
	    	$boy['eff_amount']=$boy['eff_amount']+$row['EffectiveAmount'];
	    }


		$this->load->view('report_head_view',$data[0]);
		$this->load->view('report_test_view',$sporttype);
		$this->load->view('report_table_1',$boy);
		$this->load->view('report_body_1');



	    }


	}
	public function searchnow(){

		//$startdate = $this->session->userdata('date');
    	$today = date("Y/m/d",strtotime("-1 day"));
		$today = date_create($today);
		$today = date_format($today,"Y/m/d");
		$today = $today ." 23:59:59";

    	$nextdate = date("Y/m/d",strtotime("+1 day"));
		$nextdate = date_create($nextdate);
		$nextdate = date_format($nextdate,"Y/m/d");
		$nextdate = $nextdate ." 00:00:00";

		//$this->session->set_userdata('date',$startdate);
		$this->load->database();
		//$username = $this->input->post('txtUserName');
		//$password = $this->input->post('txtPwd');
		$mem = $this->session->userdata('num');
	    $sql =" select * from member where num=".$mem;
	    $query = $this->db->query($sql);
	    //echo $sql ;
	    $data = $query->result_array();
		//echo '<script>alert("'.count($data).'");</script>';
	    	//print_r($data[0]);


		//$today = date('Y-m-d','2017-03-29');
    	$sql = " select * from table_4_next where TicketTime >='".$today."' and TicketTime <='".$nextdate."' and TicketId <>0" ;
	    $query = $this->db->query($sql);
	   	//echo $sql;
	    $bid = $query->result_array();
    	//echo $sql ;
    	//echo  '<pre>';
    	//print_r($bid);
    	//echo '</pre>';
    	//$bid = $this->search($startdate);
    	$sporttype = $this->sporttype($today);
    	//$unsporttype = $this->unsporttype($today);
    	//$sporttype['unsport']= $unsporttype ;
    	$sporttype['sport']= $sporttype ;

    	$sporttype['date']= $startdate ;

	    //$sql =" select * from member where groups=3";
	    //$query = $this->db->query($sql);
	    //echo $sql ;

	    //$agents = $query->result_array();
	    $boy['agents']=$data[0];
	    $boy['amount']=0 ;
	    $boy['eff_amount'] = 0 ;
	    $boy['results'] = 0 ;
	    $boy['total'] = 0 ;

	    $boy['agentamount'] = 0 ;
	    $boy['sql'] = $sql ;
	    $boy['bids']=$bid ;


	    foreach($bid as $row){
	    	 $boy['total']++ ;
	    	$boy['results']=$boy['results']+$row['Results'];
	    	$boy['amount']=$boy['amount']+$row['SysAmount'];
	    	$boy['agentamount']=$boy['agentamount']+$row['L4Amt'];
	    	$boy['eff_amount']=$boy['eff_amount']+$row['EffectiveAmount'];
	    }

		$this->load->view('report_head_view',$data[0]);
		$this->load->view('report_summary_view',$sporttype);
		$this->load->view('searchnow1',$boy);
		$this->load->view('report_body_1');





	}
	public function searchnow2(){

		//$startdate = $this->session->userdata('date');
    	$today = date("Y/m/d",strtotime("-1 day"));
		$today = date_create($today);
		$today = date_format($today,"Y/m/d");
		$today = $today ." 23:59:59";

    	$nextdate = date("Y/m/d",strtotime("+1 day"));
		$nextdate = date_create($nextdate);
		$nextdate = date_format($nextdate,"Y/m/d");
		$nextdate = $nextdate ." 00:00:00";

		//$this->session->set_userdata('date',$startdate);
		$this->load->database();
		//$username = $this->input->post('txtUserName');
		//$password = $this->input->post('txtPwd');
		$mem = $this->session->userdata('num');
	    $sql =" select * from member where num=".$mem;
	    $query = $this->db->query($sql);
	    //echo $sql ;
	    $data = $query->result_array();
		//echo '<script>alert("'.count($data).'");</script>';
	    	//print_r($data[0]);


		//$today = date('Y-m-d','2017-03-29');
    	$sql = " select * from table_4_next where TicketTime >='".$today."' and TicketTime <='".$nextdate."' and TicketId <>0" ;
	    $query = $this->db->query($sql);
	   	//echo $sql;
	    $bid = $query->result_array();
    	//echo $sql ;
    	//echo  '<pre>';
    	//print_r($bid);
    	//echo '</pre>';
    	//$bid = $this->search($startdate);
    	$sporttype = $this->sporttype($today);
    	//$unsporttype = $this->unsporttype($today);
    	//$sporttype['unsport']= $unsporttype ;
    	$sporttype['sport']= $sporttype ;

    	$sporttype['date']= $startdate ;

	    //$sql =" select * from member where groups=3";
	    //$query = $this->db->query($sql);
	    //echo $sql ;

	    //$agents = $query->result_array();

	    $sql =" select * from member where groups=3";
	    $query = $this->db->query($sql);

	    $agents = $query->result_array();
	    $boy['agents']=$agents[0];
	    $boy['amount']=0 ;
	    $boy['eff_amount'] = 0 ;
	    $boy['results'] = 0 ;
	    $boy['total'] = 0 ;
	    $boy['agentamount'] = 0 ;
	    $boy['sql'] = $sql ;



	    foreach($bid as $row){
	    	 $boy['total']++ ;
	    	$boy['results']=$boy['results']+$row['Results'];
	    	$boy['amount']=$boy['amount']+$row['SysAmount'];
	    	$boy['agentamount']=$boy['agentamount']+$row['L4Amt'];
	    	$boy['eff_amount']=$boy['eff_amount']+$row['EffectiveAmount'];
	    }
		$this->load->view('report_head_view',$data[0]);
		$this->load->view('report_summary_view',$sporttype);
		$this->load->view('searchnow2',$boy);
		$this->load->view('report_body_1');




	}

	public function searchnow3(){

    	$today = date("Y/m/d",strtotime("-1 day"));
		$today = date_create($today);
		$today = date_format($today,"Y/m/d");
		$today = $today ." 23:59:59";

    	$nextdate = date("Y/m/d",strtotime("+1 day"));
		$nextdate = date_create($nextdate);
		$nextdate = date_format($nextdate,"Y/m/d");
		$nextdate = $nextdate ." 00:00:00";

		$this->load->database();
		//$username = $this->input->post('txtUserName');
		//$password = $this->input->post('txtPwd');
		$mem = $this->session->userdata('num');
	    $sql =" select * from member where num=".$mem;
	    $query = $this->db->query($sql);
	    //echo $sql ;
	    $data = $query->result_array();
		//echo '<script>alert("'.count($data).'");</script>';
	    	//print_r($data[0]);


    	//$today = date('Y-m-d');
		//$today = date('Y-m-d','2017-03-29');

    	$sql = " select * from table_4_next where TicketTime >='".$today."' and TicketTime <='".$nextdate."' and TicketId <>0" ;
	    $query = $this->db->query($sql);
	   	//echo $sql;
	    $bid = $query->result_array();
    	$sporttype = $this->sporttype($today);
    	//$unsporttype = $this->unsporttype($today);
    	$sporttype['sport']= $sporttype ;

    	$sporttype['date']= $startdate ;

	    //$sql =" select * from member where groups=3";
	    //$query = $this->db->query($sql);
	    //echo $sql ;

	    //$agents = $query->result_array();
	    $boy['agents']=$data[0];
	    $boy['amount']=0 ;
	    $boy['eff_amount'] = 0 ;
	    $boy['result'] = 0 ;
	    $boy['total'] = 0 ;
	    $boy['agentamount'] = 0 ;
	    $boy['sql'] = $sql ;
	    $boy['bids']=$bid ;


	    foreach($bid as $row){
	    	 $boy['total']++ ;
	    	$boy['result']=$boy['result']+$row['results'];
	    	$boy['amount']=$boy['amount']+$row['SysAmount'];
	    	$boy['agentamount']=$boy['agentamount']+$row['L4Amt'];
	    	$boy['eff_amount']=$boy['eff_amount']+$row['EffectiveAmount'];
	    }
		$this->load->view('report_head_view',$data[0]);
		$this->load->view('report_summary_view',$sporttype);
		$this->load->view('report_table_3',$boy);
		$this->load->view('report_body_1');






	}

	public function searchreport3(){

		$startdate = $this->session->userdata('date');

		$startdate = date_create($startdate);
		$startdate = date_format($startdate,"Y/m/d");
		$this->session->set_userdata('date',$startdate);
		$this->load->database();
		//$username = $this->input->post('txtUserName');
		//$password = $this->input->post('txtPwd');
		$mem = $this->session->userdata('num');
	    $sql =" select * from member where num=".$mem;
	    $query = $this->db->query($sql);
	    //echo $sql ;
	    $data = $query->result_array();
		//echo '<script>alert("'.count($data).'");</script>';
	    	//print_r($data[0]);


    	$today = date('Y-m-d');
		//$today = date('Y-m-d','2017-03-29');

    	$bid = $this->search($startdate);
    	$sporttype = $this->sporttype($today);
    	//$unsporttype = $this->unsporttype($today);
    	//$sporttype['unsport']= $unsporttype ;
    	$sporttype['sport']= $sporttype ;

    	$sporttype['date']= $startdate ;

	    //$sql =" select * from member where groups=3";
	    //$query = $this->db->query($sql);
	    //echo $sql ;

	    //$agents = $query->result_array();
	    $boy['agents']=$data[0];
	    $boy['amount']=0 ;
	    $boy['eff_amount'] = 0 ;
	    $boy['result'] = 0 ;
	    $boy['total'] = 0 ;
	    $boy['agentamount'] = 0 ;
	    $boy['sql'] = $sql ;
	    $boy['bids']=$bid ;


	    foreach($bid as $row){
	    	 $boy['total']++ ;
	    	$boy['result']=$boy['result']+$row['results'];
	    	$boy['amount']=$boy['amount']+$row['SysAmount'];
	    	$boy['agentamount']=$boy['agentamount']+$row['L4Amt'];
	    	$boy['eff_amount']=$boy['eff_amount']+$row['EffectiveAmount'];
	    }
		$this->load->view('report_head_view',$data[0]);
		$this->load->view('report_summary_view',$sporttype);
		$this->load->view('report_table_3',$boy);
		$this->load->view('report_body_1');





	}


	public function search($date){
    	$today = date('Y-m-d');

    	if (strtotime($date) < strtotime($today)){
    		//echo 'small';
	    	$sql =" select * from table_4 where  ticketid <> 0 and command='".$date."' and EffectiveAmount > 0 order by ticketID desc";
	    	//echo '<br>'.$sql ;
    	}

    	if (strtotime($date) == strtotime($today)){
    		//echo 'equal';
	    	$sql =" select * from table_6 where ticketid <> 0 order by ticketID desc";
	    	//echo '<br>'.$sql ;
    	}

    	if (strtotime($date) > strtotime($today)){
    		//echo 'furture';
	    	$sql =" select * from table_6_next where ticketid <> 0  order by ticketID desc";
	    	//echo '<br>'.$sql ;
    	}
    	//echo strtotime($date).'  '.strtotime($today) ;
	   	//$sporttype = $sporttype();
	    $query = $this->db->query($sql);

	    $data = $query->result_array();
	    return $data ;
	}
	public function search2(){

		$startdate = $this->session->userdata('date');
		$startdate = date_create($startdate);
		$startdate = date_format($startdate,"Y/m/d");

		$this->load->database();
		//$username = $this->input->post('txtUserName');
		//$password = $this->input->post('txtPwd');
		$mem = $this->session->userdata('num');
	    $sql =" select * from member where num=".$mem;
	    $query = $this->db->query($sql);
	    //echo $sql ;
	    $data = $query->result_array();
		//echo '<script>alert("'.count($data).'");</script>';
	    	//print_r($data[0]);


    	$today = date('Y-m-d');
		//$today = date('Y-m-d','2017-03-29');

    	$bid = $this->search($startdate);
    	$sporttype = $this->sporttype($today);
    	//$unsporttype = $this->unsporttype($today);
    	//$sporttype['unsport']= $unsporttype ;
    	$sporttype['sport']= $sporttype ;

    	$sporttype['date']= $startdate ;

	    //$sql =" select * from member where groups=3";
	    //$query = $this->db->query($sql);
	    //echo $sql ;

	    //$agents = $query->result_array();

	    $sql =" select * from member where groups=3";
	    $query = $this->db->query($sql);

	    $agents = $query->result_array();
	    $boy['agents']=$agents[0];
	    $boy['amount']=0 ;
	    $boy['eff_amount'] = 0 ;
	    $boy['results'] = 0 ;
	    $boy['total'] = 0 ;
	    $boy['agentamount'] = 0 ;
	    $boy['sql'] = $sql ;



	    foreach($bid as $row){
	    	 $boy['total']++ ;
	    	$boy['results']=$boy['results']+$row['Results'];
	    	$boy['amount']=$boy['amount']+$row['SysAmount'];
	    	$boy['agentamount']=$boy['agentamount']+$row['L4Amt'];
	    	$boy['eff_amount']=$boy['eff_amount']+$row['EffectiveAmount'];
	    }
		$this->load->view('report_head_view',$data[0]);
		$this->load->view('report_summary_view',$sporttype);
		$this->load->view('search_table_2',$boy);
		$this->load->view('report_body_1');

	}



	public function searchall3($today,$nextdate){


    	$today = str_replace('-','/',$today);
    	$nextdate = str_replace('-','/',$nextdate);
    	//echo 'today:'.$today ."<br>";


		//$username = $this->input->post('txtUserName');
		//$password = $this->input->post('txtPwd');
		$mem = $this->session->userdata('num');
	    $sql =" select * from member where num=".$mem;
	    $query = $this->db->query($sql);
	    //echo $sql ;
	    $data = $query->result_array();
		//echo '<script>alert("'.count($data).'");</script>';
	    	//print_r($data[0]);


    	//$today = date('Y-m-d');
		//$today = date('Y-m-d','2017-03-29');




    	$sql = "select * from table_4 where command >='".$today."' and command <='".$nextdate."' and ticketid<>0 ";
	   	//echo $sql;
	   	$query = $this->db->query($sql);
	    $bid = $query->result_array();
    	$sporttype = $this->sporttype($today);
    	//$unsporttype = $this->unsporttype($today);
    	//$sporttype['unsport']= $unsporttype ;
    	$sporttype['sport']= $sporttype ;

	    $boy['startDate'] = $today;
	    $sporttype['nextDate']=$nextdate ;
	    //$sql =" select * from member where groups=3";
	    //$query = $this->db->query($sql);
	    //echo $sql ;

	    //$agents = $query->result_array();
	    $boy['agents']=$data[0];
	    $boy['amount']=0 ;
	    $boy['eff_amount'] = 0 ;
	    $boy['result'] = 0 ;
	    $boy['total'] = 0 ;
	    $boy['agentamount'] = 0 ;
	    $boy['sql'] = $sql ;
	    $boy['bids']=$bid ;

	    $searchbox['searchheight']='110';

	    foreach($bid as $row){
	    	 $boy['total']++ ;
	    	$boy['result']=$boy['result']+$row['results'];
	    	$boy['amount']=$boy['amount']+$row['SysAmount'];
	    	$boy['agentamount']=$boy['agentamount']+$row['L4Amt'];
	    	$boy['eff_amount']=$boy['eff_amount']+$row['EffectiveAmount'];
	    }
		$this->load->view('report_head_view',$data[0]);
		$this->load->view('search_summary',$sporttype);
		$this->load->view('report_table_3',$boy);
		$this->load->view('report_body_1',$searchbox);





	}




	public function searchall2($today,$nextdate){
		//$this->load->library('session');

    	//$today = $this->session->userdata('startDate') ;
    	$today = str_replace('-','/',$today);
    	$nextdate = str_replace('-','/',$nextdate);
    	echo 'today:'.$today ."<br>";
    	//$nextdate = $this->session->userdata('enddate');
    	echo 'nextdate:'.$nextdate ;


		$this->load->database();
		//$username = $this->input->post('txtUserName');
		//$password = $this->input->post('txtPwd');
		$mem = $this->session->userdata('num');
	    $sql =" select * from member where num=".$mem;
	    $query = $this->db->query($sql);
	    //echo $sql ;
	    $data = $query->result_array();
		//echo '<script>alert("'.count($data).'");</script>';
	    	//print_r($data[0]);


    	//$today = date('Y-m-d');
		//$today = date('Y-m-d','2017-03-29');




    	$sql = "select * from table_4 where command >='".$today."' and command <='".$nextdate."' and ticketid<>0 ";
   	    $query = $this->db->query($sql);
	   	//echo $sql;
	    $bid = $query->result_array();
    	$sporttype = $this->sporttype($today);
    	//$unsporttype = $this->unsporttype($today);
    	//$sporttype['unsport']= $unsporttype ;
    	$sporttype['sport']= $sporttype ;

	    $sporttype['startDate'] = $today;
	    $sporttype['nextDate']=$nextdate ;
    	$sporttype['date']= $todays ;

    	$sporttype['enddate']= $nextdates ;

	    $sql =" select * from member where groups=3";
	    $query = $this->db->query($sql);

	    $agents = $query->result_array();

	    //$agents = $query->result_array();
	    $boy['agents']=$agents[0];
	    $boy['amount']=0 ;
	    $boy['eff_amount'] = 0 ;
	    $boy['results'] = 0 ;
	    $boy['total'] = 0 ;
	    $boy['agentamount'] = 0 ;
	    $boy['sql'] = $sql ;
	    $boy['bids']=$bid ;
	    $boy['startDate'] = $today;
	    $boy['nextDate']=$nextdate ;


	    foreach($bid as $row){
	    	 $boy['total']++ ;
	    	$boy['results']=$boy['results']+$row['Results'];
	    	$boy['amount']=$boy['amount']+$row['SysAmount'];
	    	$boy['agentamount']=$boy['agentamount']+$row['L4Amt'];
	    	$boy['eff_amount']=$boy['eff_amount']+$row['EffectiveAmount'];
	    }
	    $searchbox['searchheight']='110';
		$this->load->view('report_head_view',$data[0]);
		$this->load->view('search_summary',$sporttype);
		$this->load->view('searchall_table2',$boy);
		$this->load->view('report_body_1',$searchbox);
	}


	public function searchall(){

		//$this->load->library('session');

 

$date=date('Y-m-d');  //当前日期
$first=1; //$first =1 表示每周星期一为开始日期 0表示每周日为开始日期
$w=date('w',strtotime($date));  //获取当前周的第几天 周日是 0 周一到周六是 1 - 6
$now_start=date('Y/m/d',strtotime("$date -".($w ? $w - $first : 6).' days')); //获取本周开始日期，如果$w是0，则表示周日，减去 6 天
$now_end=date('Y/m/d',strtotime("$now_start +6 days"));  //本周结束日期
$last_start=date('Y/m/d',strtotime("$now_start - 7 days"));  //上周开始日期
$last_end=date('Y/m/d',strtotime("$now_start - 1 days"));  //上周结束日期






		$today = str_replace('-','/',$this->input->post("startDate"));
		$nextday = str_replace('-','/',$this->input->post("endDate"));
		//echo gettype($today);
		if (	$today==''){
			$today = $now_start ;
			//echo '<br>today empty<br>';
		}

		if (	$nextday==''){
			$nextday = $now_end ;
			//echo '<br>today empty<br>';
		}
		//echo ($this->input->post("startDate"))."<br>";
		/*
		if ($today == NULL){
	    	$today = date("Y/m/d",strtotime("-6 day"));
			$today = date_create($today);
			$todays = date_format($today,"Y/m/d");
			$today = $todays ." 23:59:59";
		}
		$this->session->set_userdata('startDate',$todays);

		if ($nextday == NULL){
	    	$nextdate = date("Y/m/d",strtotime("+1 day"));
			$nextdate = date_create($nextdate);
			$nextdates = date_format($nextdate,"Y/m/d");
			$nextdate = $nextdates ." 00:00:00";
		}else{
			$nextdate = $nextday ." 00:00:00";

		}
		$_SESSION['startDate']=$today ;
		$_SESSION['enddate']=$nextdates ;
		$this->session->set_userdata('enddate',$nextdates);

		*/

		$this->load->database();
		//$username = $this->input->post('txtUserName');
		//$password = $this->input->post('txtPwd');
		$mem = $this->session->userdata('num');
	    $sql =" select * from member where num=".$mem;
	    $query = $this->db->query($sql);
	    //echo $sql ;
	    $data = $query->result_array();
		//echo '<script>alert("'.count($data).'");</script>';
	    	//print_r($data[0]);


    	//$today = date('Y-m-d');
		//$today = date('Y-m-d','2017-03-29');
	    //$today=date_create($today);
	    //$nextday=date_create($nextday);

    	$sql = "select * from table_4 where command >='".$today."' and command <='".$nextday."' and ticketid<>0 ";

	    $query = $this->db->query($sql);

	   	//echo $sql."<br>";
	   	//echo "today".$today ;
	    $bid = $query->result_array();
	   	//echo '<br><pre>';
	   	//print_r($bid);
	   	//echo '</pre>';
    	$sporttype = $this->sporttype($today);
    	//$unsporttype = $this->unsporttype($today);
    	//$sporttype['unsport']= $unsporttype ;
    	$sporttype['sport']= $sporttype ;

	    $sporttype['startDate'] = $today;
	    $sporttype['nextDate']=$nextday ;
	    //$sql =" select * from member where groups=3";
	    //$query = $this->db->query($sql);
	    //echo $sql ;

	    //$agents = $query->result_array();
	    $boy['agents']=$data[0];
	    $boy['amount']=0 ;
	    $boy['eff_amount'] = 0 ;
	    $boy['results'] = 0 ;
	    $boy['total'] = 0 ;
	    $boy['agentamount'] = 0 ;
	    $boy['sql'] = $sql ;
	    $boy['bids']=$bid ;
	    $boy['startDate'] = $today;
	    $boy['nextDate']=$nextday ;

	    foreach($bid as $row){
	    	 $boy['total']++ ;
	    	$boy['results']=$boy['results']+$row['Results'];
	    	$boy['amount']=$boy['amount']+$row['SysAmount'];
	    	$boy['agentamount']=$boy['agentamount']+$row['L4Amt'];
	    	$boy['eff_amount']=$boy['eff_amount']+$row['EffectiveAmount'];
	    }
	    $searchbox['searchheight']='110';
		$this->load->view('report_head_view',$data[0]);
		$this->load->view('search_summary',$sporttype);
		$this->load->view('searchall_table1',$boy);
		$this->load->view('report_body_1',$searchbox);
	}
	public function showsearch(){

		$startdate = $this->input->post('startDate');
		$startdate = date_create($startdate);
		$startdate = date_format($startdate,"Y/m/d");
		$this->session->set_userdata('date',$startdate);
		$this->load->database();
		//$username = $this->input->post('txtUserName');
		//$password = $this->input->post('txtPwd');
		$mem = $this->session->userdata('num');
	    $sql =" select * from member where num=".$mem;
	    $query = $this->db->query($sql);
	    //echo $sql ;
	    $data = $query->result_array();
		//echo '<script>alert("'.count($data).'");</script>';
	    	//print_r($data[0]);


    	$today = date('Y-m-d');
		//$today = date('Y-m-d','2017-03-29');

    	$bid = $this->search($startdate);
    	$sporttype = $this->sporttype($today);
    	//$unsporttype = $this->unsporttype($today);
    	//$sporttype['unsport']= $unsporttype ;
    	$sporttype['sport']= $sporttype ;

    	$sporttype['date']= $startdate ;

	    //$sql =" select * from member where groups=3";
	    //$query = $this->db->query($sql);
	    //echo $sql ;

	    //$agents = $query->result_array();
	    $boy['agents']=$data[0];
	    $boy['amount']=0 ;
	    $boy['eff_amount'] = 0 ;
	    $boy['results'] = 0 ;
	    $boy['total'] = 0 ;
	    $boy['agentamount'] = 0 ;
	    $boy['sql'] = $sql ;
	    $boy['bids']=$bid ;


	    foreach($bid as $row){
	    	 $boy['total']++ ;
	    	$boy['results']=$boy['results']+$row['Results'];
	    	$boy['amount']=$boy['amount']+$row['SysAmount'];
	    	$boy['agentamount']=$boy['agentamount']+$row['L4Amt'];
	    	$boy['eff_amount']=$boy['eff_amount']+$row['EffectiveAmount'];
	    }

		$this->load->view('report_head_view',$data[0]);
		$this->load->view('report_summary_view',$sporttype);
		$this->load->view('search_table_1',$boy);
		$this->load->view('report_body_1');
	}
	public function logout()
	{

	    $this->session->unset_userdata('num');
     	redirect(base_url());
	}
	public function report2($mem)
	{

		$this->load->database();
		//$username = $this->input->post('txtUserName');
		//$password = $this->input->post('txtPwd');

	    $sql =" select * from member where num=".$mem;
	    $query = $this->db->query($sql);

	    $data = $query->result_array();
		//echo '<script>alert("'.count($data).'");</script>';
	    	//print_r($data[0]);


    	$today = date('Y/m/d');
		//$today = date('Y-m-d','2017-03-29');

    	$bid = $this->biddata($today);
    	$sporttype = $this->sporttype($today);
    	//$unsporttype = $this->unsporttype($today);
    	//$sporttype['unsport']= $unsporttype ;
    	$sporttype['sport']= $sporttype ;


	    $sql =" select * from member where groups=3";
	    $query = $this->db->query($sql);

	    $agents = $query->result_array();
	    $boy['agents']=$agents[0];
	    $boy['amount']=0 ;
	    $boy['eff_amount'] = 0 ;
	    $boy['result'] = 0 ;
	    $boy['total'] = 0 ;
	    $boy['agentamount'] = 0 ;
	    $boy['sql'] = $sql ;



	    foreach($bid as $row){
	    	 $boy['total']++ ;
	    	$boy['results']=$boy['results']+$row['Results'];
	    	$boy['amount']=$boy['amount']+$row['SysAmount'];
	    	$boy['agentamount']=$boy['agentamount']+$row['L4Amt'];
	    	$boy['eff_amount']=$boy['eff_amount']+$row['EffectiveAmount'];
	    }
		$this->load->view('report_head_view',$data[0]);
		$this->load->view('report_summary_view',$sporttype);
		$this->load->view('report_table_2',$boy);
		$this->load->view('report_body_1');



	    



	}	
	public function report3($mem)
	{

		$this->load->database();
		//$username = $this->input->post('txtUserName');
		//$password = $this->input->post('txtPwd');

	    $sql =" select * from member where num=".$mem;
	    $query = $this->db->query($sql);

	    $data = $query->result_array();
		//echo '<script>alert("'.count($data).'");</script>';
	    //	print_r($data[0]);


    	$today = date('Y-m-d');
		//$today = date('Y-m-d','2017-03-29');

    	$bid = $this->biddata($today);
    	$sporttype = $this->sporttype($today);
    	//$unsporttype = $this->unsporttype($today);
    	//$sporttype['unsport']= $unsporttype ;
    	$sporttype['sport']= $sporttype ;

		$mem = $this->session->userdata('num');

	    $sql =" select * from member where num=".$mem;
	    $query = $this->db->query($sql);

	    $agents = $query->result_array();
	    $boy['agents']=$agents[0];
	    $boy['amount']=0 ;
	    $boy['eff_amount'] = 0 ;
	    $boy['result'] = 0 ;
	    $boy['total'] = 0 ;
	    $boy['agentamount'] = 0 ;
	    $boy['sql'] = $sql ;
	    $boy['bids']=$bid ;


	    foreach($bid as $row){
	    	 $boy['total']++ ;
	    	$boy['result']=$boy['result']+$row['results'];
	    	$boy['amount']=$boy['amount']+$row['SysAmount'];
	    	$boy['agentamount']=$boy['agentamount']+$row['L4Amt'];
	    	$boy['eff_amount']=$boy['eff_amount']+$row['EffectiveAmount'];
	    }
	    //echo "<script>alert(".$data[0]['num'].");</script>";
		$this->load->view('report_head_view',$data[0]);
		$this->load->view('report_summary_view',$sporttype);
		$this->load->view('report_table_3',$boy);
		$this->load->view('report_body_1');


	}	


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */