<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);



class Admin extends CI_Controller {


    function __construct(){
        parent::__construct(); // needed when adding a constructor to a controller

       $this->data['Dg_key'] = '8d0eee33c7fb4f37bae96665b23cb34d';
       $this->data['Dg_api_url'] = 'https://api.dg99web.com/user/signup/DGTE010137/';
       $this->data['Dg_agent'] = "DGTE010134";
       $this->data['DG_MD5_KEY'] = "3A810F40C25304D63E33A40D5A2D5952";//md5($Dg_agent.$Dg_key);

			$this->rtn[0] = "帳戶建立";
		  	$this->rtn[1]="参数错误";
		  	$this->rtn[2]="Token验证失败";
		  	$this->rtn[4]="非法操作";
		  	$this->rtn[10]="日期格式错误";
		  	$this->rtn[11]="数据格式错误";
		  	$this->rtn[97]="没有权限";
		  	$this->rtn[98]="操作失败";
		  	$this->rtn[99]="未知错误";
		  	$this->rtn[100]="账号被锁定";
		  	$this->rtn[101]="账号格式错误";
		  	$this->rtn[102]="账号不存在";
		  	$this->rtn[103]="此账号被占用";
		  	$this->rtn[104]="密码格式错误";
		  	$this->rtn[105]="密码错误";
		  	$this->rtn[106]="新旧密码相同";
		  	$this->rtn[107]="会员账号不可用";
		  	$this->rtn[108]="登入失败";
		  	$this->rtn[109]="注册失败";
		  	$this->rtn[113]="传入的代理账号不是代理";
		  	$this->rtn[114]="找不到会员";
		  	$this->rtn[116]="账号已占用";
		  	$this->rtn[117]="找不到会员所属的分公司";
		  	$this->rtn[118]="找不到指定的代理";
		  	$this->rtn[119]="存取款操作时代理点数不足";
		  	$this->rtn[120]="余额不足";
		  	$this->rtn[121]="盈利限制必须大于或等于0";
		  	$this->rtn[150]="免费试玩账号用完";
		  	$this->rtn[300]="系统维护";
		  	$this->rtn[320]="API Key 错误";
		  	$this->rtn[321]="找不到相应的限红组";
		  	$this->rtn[322]="找不到指定的货币类型";
		  	$this->rtn[323]="转账流水号占用";
		  	$this->rtn[324]="转账失败";
		  	$this->rtn[325]="代理状态不可用";
		  	$this->rtn[326]="会员代理没有视频组";
		  	$this->rtn[328]="API 类型找不到";
		  	$this->rtn[329]="会员代理信息不完整";
		  	$this->rtn[400]="客户端IP 受限";
		  	$this->rtn[401]="网络延迟";
		  	$this->rtn[402]="连接关闭";
		  	$this->rtn[403]="客户端来源受限";
		  	$this->rtn[404]="请求的资源不存在";
		  	$this->rtn[405]="请求太频繁";
		  	$this->rtn[406]="请求超时";
		  	$this->rtn[407]="找不到游戏地址";
		  	$this->rtn[500]="空指针异常";
		  	$this->rtn[501]="系统异常";
		  	$this->rtn[502]="系统忙";
		  	$this->rtn[503]="数据操作异常";
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

	    $sql =" select * from member";
	    $query = $this->db->query($sql);
	    $data['memberlist']=$query->result() ;

		$this->load->view('head_view');
		$this->load->view('top_header_view');	
		$this->load->view('slider_view');
		$this->load->view('content_view',$data);
		$this->load->view('footer_view');
	}

	public function apitests()
	{
		//echo '<script>alert("onapitest function");</script>';
		$this->load->view('head_view');
		$this->load->view('top_header_view');
		$this->load->view('slider_view');
		$this->load->view('apitest_view');
		$this->load->view('footer_view');
	}
		//轉賬畫面

	public function trans()
	{
			//載入所有會員資料到$data
		$this->load->database();

		

	    $sql =" select * from member";
	    $query = $this->db->query($sql);
	    $data['memberlist']=$query->result() ;


		//echo '<script>alert("on trans function");</script>';
		$this->load->view('head_view');
		$this->load->view('top_header_view');
		$this->load->view('slider_view');
		$this->load->view('trans_view',$data);
		$this->load->view('footer_view');
	}

/*

2.5 获取会员余额


名称	说明	示例
path	接口地址	
 host/user/getBalance/{agentName} 
method	请求方法	
 POST 
header	请求头信息	
 Content-Type : application/json 
RequestBody	请求参数	
{
    "token":"KEY",
    "member":{"username":"DG66777"}
} 
ResponseBody	接口返回数据	
{
    "codeId":CODE,
    "token":"KEY",
    "member":{"username":"DG66777", "balance":0.0}
} 
remark	接口备注	

*/

	public function getBalance($account){
		//$account = "Ciara423";
       	$this->data['Dg_api_url'] = 'https://api.dg99web.com/user/getBalance/DGTE010137/';
   


    	$member = array(
    					'username' => $account,
    					);

    	$options = array('token' => $this->data['DG_MD5_KEY'], 
							'member' => $member,	

    		);

    	//print_r($options);
    	//echo '<br>'.$account;
//串接API

		$ch = curl_init();
    	$header = array("Content-Type: application/json");
		curl_setopt($ch, CURLOPT_URL,$this->data['Dg_api_url']);		
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, 0);       
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //curl_exec 後，不直接輸出
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($options));  //Post Fields將参數以json包裝後傳出
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

		//執行串接
		if( ! $result = curl_exec($ch)) 
		    { 
		        trigger_error(curl_error($ch)); 
		    } 
		    curl_close($ch); 
		    $rtnvalue= json_decode($result,true); //將回傳的值以json解開
		    //var_dump($result);
		return $rtnvalue['member']['balance'];
		//return $rtnvalue;
	}


/*

2.6 会员存取款


名称	说明	示例
path	接口地址	
 host/account/transfer/{agentName} 
method	请求方法	
 POST 
header	请求头信息	
 Content-Type : application/json 
RequestBody	请求参数	
{
    "token":"KEY",
    "data":"转账流水号",
    "member":{
        "username":"TEST100",
        "amount":1000
    }
} 
ResponseBody	接口返回数据	
{
    "codeId":CODE,
    "token":"KEY",
    "data":"转账流水号",
    "member":{
        "username":"TEST100",
        "balance":1000
    }
} 
remark	接口备注	
Amount 为存取款金额，正数存款负数取款，请确保保留不超过3位小数，否则将收到错误码11
Balance 为转账前余额,
存款金额只允许保留2位小数，否则将收到 codeId :11, 
流水号应限定在35位字符以内 


2.7 确认会员存取款


名称	说明	示例
path	接口地址	
 host/account/checkTransfer/{agentName} 
method	请求方法	
 POST 
header	请求头信息	
 Content-Type : application/json 
RequestBody	请求参数	
{
    "token":"KEY",
    "data":"转账流水号"
} 
ResponseBody	接口返回数据	
{
    "token":"KEY",
    "codeId":CODE
} 
remark	接口备注	
返回数据以codeId=0表示成功, codeId=324表示失败, 请他错误码应再次请求确认

*/

	public function deposit()
	{	//轉入點數到遊戲帳號內

		$this->load->database();

		

	    $sql =" select * from member";
	    $query = $this->db->query($sql);
	    $data['memberlist']=$query->result() ;





       	$this->data['Dg_api_url'] = 'https://api.dg99web.com/account/transfer/DGTE010137/';

       	$amount = $this->input->POST('amount');
       	$accounts = $this->input->POST('accounts');



		$order = 'DG'.time() ;

    	$member = array(
    					'username' => $accounts,
    					'amount' => $amount,
    					);

    	$options = array('token' => $this->data['DG_MD5_KEY'], 
							'data' => $order,
							'member' => $member,	

    		);

    //	print_r($options);
    //	echo '<br>';
//串接API
		$ch = curl_init();
		    $data['balance']=0;

    	$header = array("Content-Type: application/json");
		curl_setopt($ch, CURLOPT_URL,$this->data['Dg_api_url']);		
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, 0);       
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //curl_exec 後，不直接輸出
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($options));  //Post Fields將参數以json包裝後傳出
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

		//執行串接
		if( ! $result = curl_exec($ch)) 
		    { 
		        trigger_error(curl_error($ch)); 
		    } 
		    curl_close($ch); 
		    $rtnvalue= json_decode($result,true); //將回傳的值以json解開
		   // print_r($rtnvalue);

		if ($rtnvalue['codeId'] != 0){
			
		// 回傳的codeid != 0 代表失敗，顯示失敗代碼

			echo '<script>alert("'.$this->rtn[$rtnvalue['codeId']].'");</script>';
		}else{
			echo '<script>alert("轉賬成功");</script>';

       		$this->data['Dg_api_url'] = 'https://api.dg99web.com/account/checkTransfer/DGTE010137/';


    	$options = array('token' => $this->data['DG_MD5_KEY'], 
							'data' => $order,
							'member' => $member,	

    					);

		$cha = curl_init();

    	$header = array("Content-Type: application/json");
		curl_setopt($cha, CURLOPT_URL,$this->data['Dg_api_url']);		
		curl_setopt($cha, CURLOPT_POST, 1);
		curl_setopt($cha, CURLOPT_VERBOSE, 0);       
		curl_setopt($cha, CURLOPT_RETURNTRANSFER, true); //curl_exec 後，不直接輸出
		curl_setopt($cha, CURLOPT_POSTFIELDS,json_encode($options));  //Post Fields將参數以json包裝後傳出
		curl_setopt($cha, CURLOPT_HTTPHEADER, $header);

		if( ! $result = curl_exec($cha)) {
		    $rtnvalue2= json_decode($result,true); //將回傳的值以json解開
		    echo '<br><br>';
		    //print_r($rtnvalue2);
		}



		}

		    $data['balance']=$this->getBalance($accounts);
		    //print_r($this->getBalance($accounts));
		    $data['account']=$accounts ;
		//print_r($data);
		//echo '<script>alert("on trans function");</script>';
		$this->load->view('head_view');
		$this->load->view('top_header_view');
		$this->load->view('slider_view');
		$this->load->view('trans_view',$data);
		$this->load->view('footer_view');





	}	
/*
 抓取注单报表


名称	说明	示例
path	接口地址	
 host/game/getReport/{agentName} 
method	请求方法	
 POST 
header	请求头信息	
 Content-Type : application/json 
RequestBody	请求参数	
{
    "token":"KEY"
} 
ResponseBody	接口返回数据	
{
    "codeId":CODE,
    "token":"KEY",
    "list":注单信息集合
} 
remark	接口备注	
两次请求间隔最小为5秒钟,
单次查询最大数据量1000条,
抓取的单有可能有上次已经抓取过的抓单 


*/

	public function reports()  //表單報表
	{
       	$this->data['Dg_api_url'] = 'https://api.dg99web.com/game/getReport/DGTE010137/';



    	$options = array('token' => $this->data['DG_MD5_KEY']);
    	//print_r($options);
	
//串接API
    	
		$ch = curl_init();

    	$header = array("Content-Type: application/json");
		curl_setopt($ch, CURLOPT_URL,$this->data['Dg_api_url']);		
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, 0);       
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //curl_exec 後，不直接輸出
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($options));  //Post Fields將参數以json包裝後傳出
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

		//執行串接
		if( ! $result = curl_exec($ch)) 
		    { 
		        trigger_error(curl_error($ch)); 
		    } 
		    curl_close($ch); 
		    $rtnvalue= json_decode($result,true); //將回傳的值以json解開

		if ($rtnvalue['codeId'] == 0){
			echo '<script>alert("捉取成功");</script>';

			//echo '<pre>';
		 	//print_r($rtnvalue['list']);
		 	//echo '</pre>';
			$i = 0 ;

		 	//將每筆注單放入資料庫
			$this->load->database();


					//echo '原始資料<pre>';
				 	//print_r($rtnvalue['list']);
				 	//echo '</pre>';
  			foreach($rtnvalue['list'] as $row) {
  				$row['num']= null ;

  				$i++ ;
  				$sql = "select * from `dgbid` where id = ".$row['id'];
  				  				echo '<br>SQL:'.$sql.'<br>';
    			$query = $this->db->query("select * from `dgbid` where id ='".$row['id']."'");
    			if($query->num_rows() == 0){

	    			echo 'data does not exist' ;
  					$this->db->insert('dgbid', $row); 

					echo '<pre>'.$i;
				 	print_r($row);
				 	echo '</pre>';
	    		}else{
	    			echo 'data exist';
	    		}



  			}






		}else{
		// 回傳的codeid != 0 代表失敗，顯示失敗代碼

		}
			
	}


/*

 会员登入


名称	说明	示例
path	接口地址	
 host/user/login/{agentName}/ 
method	请求方法	
 POST 
header	请求头信息	
 Content-Type : application/json 
RequestBody	请求参数	
{
    "token":KEY,
    "lang":"en",
    "member":{
        "username":"会员账号",
        "password":"会员密码"//可以不传,如果密码不同,将自动修改DG数据库保存的密码
    }
} 
ResponseBody	接口返回数据	
{
    "codeId":CODE,
    "token":"登入游戏的Token",
    "list":["flash 登入地址","wap 登入地址","直接打开APP地址"]
} 

*/

	public function login()  //登入
	{
      //var_dump($username = $this->input->POST("accounts"));
       	$this->data['Dg_api_url'] = 'https://api.dg99web.com/user/login/DGTE010137/';



if($this->input->post('accounts'))//username is the name of post variable
{
	//echo $this->input->post('accounts');
}else{

	//echo 'something wrong';
}

	//$field = $this->input->post('accounts');
	//echo 'select value:'.$field ;
    $account = $this->input->post('accounts');
    		//echo '<script>alert("login function '.$account.'");</script>';


	$this->load->database();
	//查詢會員資料
    $sql =" select  *  from member where account='".$account."'";
    //echo "<br>".$sql ;

    $query = $this->db->query($sql);
    $password = "";
foreach ($query->result() as $row)
{
		$password = $row->password;
}


    	$newmember = array(
    					'username' => $account,
    					'password' => $password,
    					);

    	$options = array('token' => $this->data['DG_MD5_KEY'], 
							'lang' => 'EN',
							'member' => $newmember,	

    		);


//串接API
		$ch = curl_init();

    	$header = array("Content-Type: application/json");
		curl_setopt($ch, CURLOPT_URL,$this->data['Dg_api_url']);		
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, 0);       
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //curl_exec 後，不直接輸出
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($options));  //Post Fields將参數以json包裝後傳出
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

		//執行串接
		if( ! $result = curl_exec($ch)) 
		    { 
		        trigger_error(curl_error($ch)); 
		    } 
		    curl_close($ch); 
		    $rtnvalue= json_decode($result,true); //將回傳的值以json解開

		if ($rtnvalue['codeId'] == 0){
			echo '<script>alert("帳戶已登入");</script>';


		 //print_r($rtnvalue);

		}else{
		// 回傳的codeid != 0 代表失敗，顯示失敗代碼

			echo '<script>alert("'.$this->rtn[$rtnvalue['codeId']].'");</script>';

		}




		$this->load->view('head_view');
		$this->load->view('top_header_view');	
		$this->load->view('slider_view');
		$this->load->view('login_view',$rtnvalue);
		$this->load->view('footer_view');



	}
/*
2.1 注册新会员


名称	说明	示例
path	接口地址	
host/user/signup/{agentName}/ 
method	请求方法	
 POST 
header	请求头信息	
Content-Type : application/json
RequestBody	请求参数	
{
    "token":KEY,
    "data":"目标限红组",
    "member":{
        "password":"MD5",
        "currencyName":"Currency",
        "winLimit":1000
    }
} 
ResponseBody	接口返回数据	
{
    "codeId":CODE,
    "token":"KEY",
    "data":"实际限红组"
} 
remark	接口备注	
会员注册默认分配限红组A
会员注册货种需代理有对应币种, 注册成功后将不可修改
WinLimit 为会员单日可赢取金额,0 表示无限制
会员账号不应小于4位，以字母开头 "[a-zA-Z0-9_]{3,}"
账号登入密码请先MD5加密，服务端会直接将存入的密码写入数据库
分公司为测试状态时仅注册测试币会员,正式状态该接口拒绝注册测试币会员 

    	*/

	public function newmember()
	{
	//	echo'<script>alert("in newmember");</script>';

	$this->load->database();
	//查詢目前總會員數
    $sql =" select *  from member";
    $query = $this->db->query($sql);
    $data['membercount']=$query->num_rows();

    //print_r($query->result());
		//echo'<script>alert("in '.$query->num_rows().'");</script>';
    	//設定dg api 註冊會員帳號 
    	
       	$this->data['Dg_api_url'] = 'https://api.dg99web.com/user/signup/DGTE010137/';

		//預設三十組會員名稱及帳號
		$tmpname = array("王測測","高村瑭","何菁侯","涂燊治","潘熒姿","彭誼莛","夏塵際","湯玓珀","游杭勝","蔡慰勁","葉煌辛","古勵舜","藍漳勛","方越鈞","古茹焜","鄒右柳","石理庚","紀人亦","何莞瑋","沈兒庸","姜絃鈺","曹陳猷","古煜烜","倪蕓謙","張師福","紀彤堡","梁莆堯","錢屹定","蘇望丘","葉煒戎","倪玠");
		$e_tmpname = array("test1234","Ciara423","Natalia1","Ian12345","Tyson123","Marie123","Kelvin12","Audrey12","Hannah12","Della123","Maya1234","Joe12345","Kelsey12","Robert12","Cristian","Lillian1","Kylee123","Kenyatta","Nia12345","Howard12","Sydney12","Cassidy1","Nancy123","Donovan1","Allie123","Japheth1","Anna1234","Jack1234","Brady123","Carlos12","Sarai123");
	    $currencyName = 'TWD';
    	$winLimit = 1000 ;


    	//API 参數陣列
    	$newmember = array(
    					'username' => $e_tmpname[$query->num_rows()],
    					'password' => md5('testuserpass'),
    					'currencyName' => $currencyName,
    					'winLimit' => $winLimit,
    					);

    	$options = array('token' => $this->data['DG_MD5_KEY'], 
							'data' => 'A',
							'member' => $newmember,	

    		);
    	//print_r($options);
//串接API
		$ch = curl_init();

    	$header = array("Content-Type: application/json");
		curl_setopt($ch, CURLOPT_URL,$this->data['Dg_api_url']);		
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, 0);       
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //curl_exec 後，不直接輸出
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($options));  //Post Fields將参數以json包裝後傳出
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

		//執行串接
		if( ! $result = curl_exec($ch)) 
		    { 
		        trigger_error(curl_error($ch)); 
		    } 
		    curl_close($ch); 
		    $rtnvalue= json_decode($result,true); //將回傳的值以json解開

		// 回傳的codeid == 0 代表成功，在本地資料庫建立並保存
		if ($rtnvalue['codeId'] == 0){
			echo '<script>alert("帳戶建立");</script>';

		    $sql =" INSERT INTO `member` (`num`, `name`, `account`, `password`) VALUES (NULL, '".$tmpname[$query->num_rows()]."', '".$e_tmpname[$query->num_rows()]."', 'testuserpass')";
		    $query = $this->db->query($sql);

		 redirect (base_url('Admin/index'));

		}else{
		// 回傳的codeid != 0 代表失敗，顯示失敗代碼
			echo '<script>alert("'.$rtnvalue['codeId'].':'.$this->rtn[$rtnvalue['codeId']].'");</script>';


		}// end of else
		} // end of function
}//end of class
