<?php
defined('BASEPATH') OR exit('No direct script access allowed');


define("Dg_key", "8d0eee33c7fb4f37bae96665b23cb34d");
define("Dg_MD5_KEY", md5("DGTE0101348d0eee33c7fb4f37bae96665b23cb34d=");
define("Dg_api_url", "https://api.dg99web.com");
define("Dg_agent",'DGTE010134');	

class Dg {
	var $CI;
	var $timeout=4;	//curl允許等待秒數
	public function __construct(){	
		$this->CI =&get_instance();
		//$this->CI->load -> model("sysAdmin/game_account_model", "game_account", true);
		//$this->CI->load -> model("sysAdmin/wallet_model", "wallet", true);
		
	}

	
	public function create_account($u_id,$u_password,$mem_num,$gamemaker_num=3){	//創建遊戲帳號

    $token = dg_key ;
    $data = 'A';
    $username = $this->input->post('username');
    $password = $this->input->post('papasswordge');

    $currencyName = 'TWD';
    $winLimit = 1000 ;


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, Dg_api_url);
curl_setopt($ch, CURLOPT_POST, true); // 啟用POST
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query( array( "a"=>"123", "b"=>"321") )); 
curl_exec($ch); 
curl_close($ch);


    

/*

		$parameter=array();
		$sqlStr="select * from `games_account` where `u_id`=?  and `mem_num`=? and `gamemaker_num`=?";
		$parameter[':u_id']=trim($u_id);
		$parameter[':mem_num']=$mem_num;
		$parameter[':gamemaker_num']=$gamemaker_num;
		$row=$this->CI->game_account->sqlRow($sqlStr,$parameter);
*/

//		if($row==NULL){	//無帳號才呼叫api
			$real_param = http_build_query(array('agent' => Dg_agent,
												 'password'=>$u_password,
												 'vipHandicaps'=>12,
												 'orHandicaps'=>'3,4,5',
												 'orHallRebate'=>0));
			$data = base64_encode($this->encryptText($real_param));
			$sign = $this->getSignCode($data);	
			$ch = curl_init(Dg_api_url.http_build_query(array('data' => $data, 'sign' => $sign, 'propertyId' => ALLBET_PROPERTY_ID)));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_TIMEOUT,$this->timeout); 
			$output = json_decode(curl_exec($ch));
			$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			$curl_errno = curl_errno($ch);
			curl_close($ch);
			if(!$curl_errno){
				if($http_code===200 && $output->error_code=='OK'){
					//把帳號寫入資料庫
					$colSql="u_id,u_password,mem_num,gamemaker_num";
					$upSql="INSERT INTO `games_account` (".sqlInsertString($colSql,0).") VALUES (".sqlInsertString($colSql,1).")";
					$parameter=array();
					$parameter[':u_id']=trim($u_id);
					$parameter[':u_password']=$this->CI->encryption->encrypt($u_password);	//密碼加密
					$parameter[':mem_num']=$mem_num;
					$parameter[':gamemaker_num']=$gamemaker_num;
					$this->CI->game_account->sqlExc($upSql,$parameter);
					return NULL;
				}else{
					return $output->error_code.':'.$output->message;
				}	
			}else{
				return '系統繁忙中，請稍候再試';
			}
		}else{
//			return '會員已有此類型帳號';	
		}
	}
	
	public function get_balance($u_id,$u_password){	//餘額查詢
		$real_param = http_build_query(array('random' => mt_rand(),
											 'client'=>$u_id,
											 'password'=>$u_password));
		$data = base64_encode($this->encryptText($real_param));
		$sign = $this->getSignCode($data);	
		$ch = curl_init(ALLBET_API_URL."/get_balance?".http_build_query(array('data' => $data, 'sign' => $sign, 'propertyId' => ALLBET_PROPERTY_ID)));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT,$this->timeout); 
		$output = json_decode(curl_exec($ch));
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$curl_errno = curl_errno($ch);
		curl_close($ch);
		if(!$curl_errno){
			if($http_code===200 && $output->error_code=='OK'){
				return $output->balance;
			}else{
				return '--';	
			}
		}else{
			//超時處理
			return '--';	
		}
	}
	
	
	public function deposit($u_id,$amount,$mem_num,$gamemaker_num=3){	//轉入點數到遊戲帳號內
		$real_param = http_build_query(array('agent' => ALLBET_Agent, 
											 'random' => mt_rand(),
											 'sn'=>ALLBET_PROPERTY_ID.time().mt_rand(111,999),	//共20碼
											 'client'=>$u_id,
											 'operFlag'=>1,	//1=存入;0=提出
											 'credit'=>$amount));
		$data = base64_encode($this->encryptText($real_param));
		$sign = $this->getSignCode($data);	
		$ch = curl_init(ALLBET_API_URL."/agent_client_transfer?".http_build_query(array('data' => $data, 'sign' => $sign, 'propertyId' => ALLBET_PROPERTY_ID)));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT,$this->timeout); 
		$output = json_decode(curl_exec($ch));
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$curl_errno = curl_errno($ch);
		curl_close($ch);
		if(!$curl_errno){
			if($http_code===200 && $output->error_code=='OK'){
				$parameter=array();
				$colSql="mem_num,kind,less_point,makers_num,buildtime";
				$sqlStr="INSERT INTO `member_wallet` (".sqlInsertString($colSql,0).")";
				$sqlStr.=" VALUES (".sqlInsertString($colSql,1).")";
				$parameter[":mem_num"]=$mem_num;
				$parameter[":kind"]=3;	//轉入遊戲
				$parameter[":less_point"]=$amount;
				$parameter[":makers_num"]=$gamemaker_num;
				$parameter[":buildtime"]=now();
				$this->CI->wallet->sqlExc($sqlStr,$parameter);
				return NULL;
			}else{
				return $output->error_code;
			}
		}else{
			//超時處理
			return '系統繁忙中，請稍候再試';
		}
	}
	
	
	public function withdrawal($u_id,$amount,$mem_num,$gamemaker_num=3){	//遊戲點數轉出
		$real_param = http_build_query(array('agent' => ALLBET_Agent, 
											 'random' => mt_rand(),
											 'sn'=>ALLBET_PROPERTY_ID.time().mt_rand(111,999),	//共20碼
											 'client'=>$u_id,
											 'operFlag'=>0,	//1=存入;0=提出
											 'credit'=>$amount));
		$data = base64_encode($this->encryptText($real_param));
		$sign = $this->getSignCode($data);	
		$ch = curl_init(ALLBET_API_URL."/agent_client_transfer?".http_build_query(array('data' => $data, 'sign' => $sign, 'propertyId' => ALLBET_PROPERTY_ID)));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT,$this->timeout); 
		$output = json_decode(curl_exec($ch));
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$curl_errno = curl_errno($ch);
		curl_close($ch);
		if(!$curl_errno){
			if($http_code===200 && $output->error_code=='OK'){
				$parameter=array();
				$colSql="mem_num,kind,add_point,makers_num,buildtime";
				$sqlStr="INSERT INTO `member_wallet` (".sqlInsertString($colSql,0).")";
				$sqlStr.=" VALUES (".sqlInsertString($colSql,1).")";
				$parameter[":mem_num"]=$mem_num;
				$parameter[":kind"]=4;	//遊戲轉出
				$parameter[":add_point"]=$amount;
				$parameter[":makers_num"]=$gamemaker_num;
				$parameter[":buildtime"]=now();
				$this->CI->wallet->sqlExc($sqlStr,$parameter);
				return NULL;
			}else{
				return $output->error_code;	
			}
		}else{
			return '系統繁忙中，請稍候再試';
		}
	}
	
	public function forward_game($u_id,$u_password){	//登入遊戲
		$real_param = http_build_query(array('random' => mt_rand(),
											 'client'=>$u_id,
											 'password'=>$u_password,'language'=>'zh_TW'));
		$data = base64_encode($this->encryptText($real_param));
		$sign = $this->getSignCode($data);	
		$ch = curl_init(ALLBET_API_URL."/forward_game?".http_build_query(array('data' => $data, 'sign' => $sign, 'propertyId' => ALLBET_PROPERTY_ID)));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT,$this->timeout);
		$output = json_decode(curl_exec($ch));
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$curl_errno = curl_errno($ch);
		curl_close($ch);
		if(!$curl_errno){
			if($http_code===200 && $output->error_code=='OK'){
				return $output->gameLoginUrl;	//回傳遊戲連結
			}else{
				return $output->error_code;	
			}
		}else{
			return '系統繁忙中，請稍候再試';
		}
	}
	
	public function reporter($u_id,$sTime,$eTime,$pageIndex=1,$pageSize=20){	//個別會員
		$real_param = http_build_query(array('random' => mt_rand(),
											 'client'=>trim($u_id),
											 'startTime'=>$sTime,
											 'endTime'=>$eTime,
											 'pageIndex'=>$pageIndex,
											 'pageSize'=>$pageSize));
		$data = base64_encode($this->encryptText($real_param));
		$sign = $this->getSignCode($data);	
		$ch = curl_init(ALLBET_API_URL."/client_betlog_query?".http_build_query(array('data' => $data, 'sign' => $sign, 'propertyId' => ALLBET_PROPERTY_ID)));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT,15);
		$output = json_decode(curl_exec($ch));
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$curl_errno = curl_errno($ch);
		curl_close($ch);
		if(!$curl_errno){
			if($http_code===200 && $output->error_code=='OK'){
				return $output->page;
			}else{
				return $output->error_code;	
			}	
		}else{
			return '系統繁忙中，請稍候再試';
		}
	}
	
	
	public function reporter_all($sTime,$eTime){	//群撈報表
		$real_param = http_build_query(array('random' => mt_rand(),
											 'startTime'=>$sTime,
											 'endTime'=>$eTime));
		$data = base64_encode($this->encryptText($real_param));
		$sign = $this->getSignCode($data);	
		$ch = curl_init(ALLBET_API_URL."/betlog_pieceof_histories_in30days?".http_build_query(array('data' => $data, 'sign' => $sign, 'propertyId' => ALLBET_PROPERTY_ID)));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT,15);
		$output = json_decode(curl_exec($ch));
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$curl_errno = curl_errno($ch);
		curl_close($ch);
		if(!$curl_errno){
			if($http_code===200 && $output->error_code=='OK'){
				return $output->histories;
			}else{
				return $output->error_code;	
			}	
		}else{
			return '系統繁忙中，請稍候再試';
		}
	}
	
	public function check($u_id,$u_password){
		$real_param = http_build_query(array('random' => mt_rand(),
											 'username'=>$u_id,
											 'password'=>$u_password
											 ));
		$data = base64_encode($this->encryptText($real_param));
		$sign = $this->getSignCode($data);	
		$ch = curl_init(ALLBET_API_URL."/check?".http_build_query(array('data' => $data, 'sign' => $sign, 'propertyId' => ALLBET_PROPERTY_ID)));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT,$this->timeout); 
		$output = json_decode(curl_exec($ch));
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$curl_errno = curl_errno($ch);
		curl_close($ch);
		print_r($output);
		print_r($http_code);
		if(!$curl_errno){
			if($http_code===200 && $output->error_code=='OK'){
				
			}
		}
	}
	
	
	public function getIdenCode(){
		return 	ALLBET_IDEN_CODE;
	}
	
	private function getSignCode($data){
		$to_sign = $data.ALLBET_MD5_KEY;
		return base64_encode(md5($to_sign, TRUE));	
	}
	
	
	private function pkcs5Pad($text, $blocksize) {
	    $pad = $blocksize - (strlen($text) % $blocksize);
	    return $text . str_repeat(chr($pad), $pad);
	}

	private function pkcs5Unpad($text) {
	    $pad = ord($text{strlen($text)-1});
	    if ($pad > strlen($text)) return false;
	    if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) return false;
	    return substr($text, 0, -1 * $pad);
	}

	private function encryptText($plain_text) {
	    $padded = $this->pkcs5Pad($plain_text, mcrypt_get_block_size(MCRYPT_TRIPLEDES, MCRYPT_MODE_CBC));
		return mcrypt_encrypt(MCRYPT_TRIPLEDES, base64_decode(ALLBET_DES_KEY), $padded, MCRYPT_MODE_CBC, base64_decode("AAAAAAAAAAA="));
	}

	private function decryptText($cipher_text) {
	    $plain_text = mcrypt_decrypt(MCRYPT_TRIPLEDES, base64_decode(ALLBET_DES_KEY), $cipher_text, MCRYPT_MODE_CBC, base64_decode("AAAAAAAAAAA="));
	    return $this->pkcs5Pad($plain_text);
	}
	
	
	//定義投注類型
	public function get_betType(){
		//百家樂
		$betType['1001']='莊';
		$betType['1002']='閒';
		$betType['1003']='和';
		$betType['1004']='大';
		$betType['1005']='小';
		$betType['1006']='莊對';
		$betType['1007']='閒對';
		//龍虎
		$betType['2001']='龍';
		$betType['2002']='虎';
		$betType['2003']='和';
		//骰寶
		$betType['3001']='小';
		$betType['3002']='單';
		$betType['3003']='雙';
		$betType['3004']='大';
		$betType['3005']='圍一';
		$betType['3006']='圍二';
		$betType['3007']='圍三';
		$betType['3008']='圍四';
		$betType['3009']='圍五';
		$betType['3010']='圍六';
		$betType['3011']='全圍';
		$betType['3012']='對1';
		$betType['3013']='對2';
		$betType['3014']='對3';
		$betType['3015']='對4';
		$betType['3016']='對5';
		$betType['3017']='對6';
		$betType['3018']='和值：4';
		$betType['3019']='和值：5';
		$betType['3020']='和值：6';
		$betType['3021']='和值：7';
		$betType['3022']='和值：8';
		$betType['3023']='和值：9';
		$betType['3024']='和值：10';
		$betType['3025']='和值：11';
		$betType['3026']='和值：12';
		$betType['3027']='和值：13';
		$betType['3028']='和值：14';
		$betType['3029']='和值：15';
		$betType['3030']='和值：16';
		$betType['3031']='和值：17';
		$betType['3033']='牌九式：12';
		$betType['3034']='牌九式：13';
		$betType['3035']='牌九式：14';
		$betType['3036']='牌九式：15';
		$betType['3037']='牌九式：16';
		$betType['3038']='牌九式：23';
		$betType['3039']='牌九式：24';
		$betType['3040']='牌九式：25';
		$betType['3041']='牌九式：26';
		$betType['3042']='牌九式：34';
		$betType['3043']='牌九式：35';
		$betType['3044']='牌九式：36';
		$betType['3045']='牌九式：45';
		$betType['3046']='牌九式：46';
		$betType['3047']='牌九式：56';
		$betType['3048']='單骰：1';
		$betType['3049']='單骰：2';
		$betType['3050']='單骰：3';
		$betType['3051']='單骰：4';
		$betType['3052']='單骰：5';
		$betType['3053']='單骰：6';
		//輪盤
		$betType['4001']='小';
		$betType['4002']='雙';
		$betType['4003']='紅';
		$betType['4004']='黑';
		$betType['4005']='單';
		$betType['4006']='大';
		$betType['4007']='第一打';
		$betType['4008']='第二打';
		$betType['4009']='第三打';
		$betType['4010']='第一列';
		$betType['4011']='第二列';
		$betType['4012']='第三列';
		for($i=0;$i<37;$i++){
			$betType[("4013"+$i)]='直接注：'.$i;
		}
		$betType['4050']='三數：(0/1/2)';
		$betType['4051']='三數：(0/2/3)';
		$betType['4052']='四數：(0/1/2/3)';
		for($i=0;$i<3;$i++){
			$betType[("4053"+$i)]='分注：(0/'.($i+1).')';
		}
		$betType["4056"]='分注：(1/2)';
		$betType["4057"]='分注：(2/3)';
		$betType["4058"]='分注：(4/5)';
		$betType["4059"]='分注：(5/6)';
		$betType["4060"]='分注：(7/8)';
		$betType["4061"]='分注：(8/9)';
		$betType["4062"]='分注：(10/11)';
		$betType["4063"]='分注：(11/12)';
		$betType["4064"]='分注：(13/14)';
		$betType["4065"]='分注：(14/15)';
		
		
		return $betType;	
	}
	
	//百家 & 龍虎開牌結果
	public function get_gameResult(){
		for($i=1;$i<=13;$i++){
			$sTitle['1'.str_pad($i,2,'0',STR_PAD_LEFT)]='黑桃'.str_pad($i,2,'0',STR_PAD_LEFT);
		}
		for($i=1;$i<=13;$i++){
			$sTitle['2'.str_pad($i,2,'0',STR_PAD_LEFT)]='紅桃'.str_pad($i,2,'0',STR_PAD_LEFT);
		}
		for($i=1;$i<=13;$i++){
			$sTitle['3'.str_pad($i,2,'0',STR_PAD_LEFT)]='梅花'.str_pad($i,2,'0',STR_PAD_LEFT);
		}
		for($i=1;$i<=13;$i++){
			$sTitle['4'.str_pad($i,2,'0',STR_PAD_LEFT)]='方塊'.str_pad($i,2,'0',STR_PAD_LEFT);
		}
		return $sTitle;
	}
	
}
?>