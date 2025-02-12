<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

use CodeIgniter\Model;

class Android extends Model
{
	//function for insert form data in to database
	function form_insert($tablename,$data)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table($tablename);
		try
		{
			$insert	 = $builder->insert($data);
		}
		catch (\Exception $e)
		{
			$error_msg = $db->error();
		}
		//echo $db->getLastQuery();exit;
		if($error_msg['code'] != '0')
		{
			return $error_msg['code'];
		}
		else
		{
			return $insert;
		}
	}
	//function for insert form data in to database
	function form_insert_id($tablename,$data)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table($tablename);
		try
		{
			$insert	 = $builder->insert($data);
			$insert_id = $db->insertID();
		}
		catch (\Exception $e)
		{
			$error_msg = $db->error();
		}
		if(!empty($error_msg))
		{
			return $error_msg['code'];
		}
		else
		{
			return $insert_id;
		}
	}
	//Function to update
	function form_update($tablename,$data,$fildname,$id)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table($tablename);
		$builder =	$builder->where($fildname, $id);
		try
		{
			$update	 =	$builder->update($data);
		}
		catch (\Exception $e)
		{
			$error_msg = $db->error();
		}
		//echo $db->getLastQuery();exit;
		if($error_msg['code'] != '0')
		{
			return $error_msg['code'];
		}
		else
		{
			return $update;
		}
	}
	//function for retrive all data with conditions
	public function retrive_all_cond_data($selects, $tablename, $cond, $order_by_column, $order_by)
	{
		if(empty($cond))
		{
			$cond = "1=1";
		}
		$db      = \Config\Database::connect();
		$builder = $db->table($tablename);
		$builder = $builder->select($selects);
		$builder = $builder->where($cond);
		$builder = $builder->orderBy($order_by_column, $order_by);
		$query   = $builder->get();
		//echo $db->getLastQuery();exit;
		if($builder->countAll() > 0)
		{
			$row = $query->getResult();
		}
		$error_msg = $db->error();
		//print_r($error_msg);exit;
		if($error_msg['code'] != '0')
		{
			return $error_msg['code'];
		}
		else
		{
			return $row;
		}
	}
	//function for retrive one row data with id
	public function getRecordByField($tablename, $column, $id)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table($tablename);
		$builder = $builder->where($column, $id);
		$query   = $builder->get();
		//echo $db->getLastQuery();exit;
		if($builder->countAll() > 0)
		{
			$row = $query->getRow();
		}
		$error_msg = $db->error();
		//print_r($error_msg);exit;
		if($error_msg['code'] != '0')
		{
			return $error_msg['code'];
		}
		else
		{
			return $row;
		}
	}
	//function for Delete Single Row
	function deleteRow($tablename,$fildname,$id)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table($tablename);
		try
		{
			$delete	 = $builder->delete([$fildname => $id]);
		}
		catch (\Exception $e)
		{
			$error_msg = $db->error();
		}
		if($error_msg['code'] != '0')
		{
			return $error_msg['code'];
		}
		else
		{
			return $delete;
		}
	}
	//function for Delete Single Row
	function active_record($tablename,$id)
	{
		$db = \Config\Database::connect();
		$data = [
				'is_active' => 1,
				];
		$adminModel = new User();
		$active = $adminModel->form_update($tablename,$data,'id',$id);
		$error_msg = $db->error();
		if($error_msg['code'] != '0')
		{
			return $error_msg['code'];
		}
		else
		{
			return $active;
		}
	}
	//function for Delete Single Row
	function inactive_record($tablename,$id)
	{
		$db = \Config\Database::connect();
		$data = [
				'is_active' => 0,
				];
		$adminModel = new User();
		$inactive = $adminModel->form_update($tablename,$data,'id',$id);
		$error_msg = $db->error();
		if($error_msg['code'] != '0')
		{
			return $error_msg['code'];
		}
		else
		{
			return $inactive;
		}
	}
	//function for Delete Single Row
	function delete_record($tablename,$id)
	{
		$db = \Config\Database::connect();
		$data = [
				'is_delete' => 1,
				];
		$adminModel = new User();
		$delete = $adminModel->form_update($tablename,$data,'id',$id);
		$error_msg = $db->error();
		if($error_msg['code'] != '0')
		{
			return $error_msg['code'];
		}
		else
		{
			return $delete;
		}
	}
	
	//Function for Update admin_pwd
	function reset_password($new_password,$user_email)
	{
		$db      = \Config\Database::connect();
		$form_array = [
		'password' => MD5($new_password)
		];
		$userModel = new User();
		$query = $userModel->form_update(tbl_user,$form_array,'user_email',$user_email);
		$error_msg = $db->error();
		if($error_msg['code'] != '0')
		{
			return $error_msg['code'];
		}
		else
		{
			return $query;
		}
	}
	//function for clean all specila charachter for slug
	function clean($string) 
	{
		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

		return preg_replace('/[^A-Za-z0-9\-]/', '', strtolower($string)); // Removes special chars.
	}
	//function for Htmlentities addslashes
	function HtmlAddSlash($string) 
	{
		$StringValue = htmlentities(addslashes($string), ENT_QUOTES);
		return $StringValue;
	}
	//function for HtmlEntityDecode Stripslashes
	function HtmlStripSlash($string) 
	{
		$StringValue = html_entity_decode(stripslashes($string));
		return $StringValue;
	}
	//function for clean all specila charachter for slug
	function replacespaceshyphens($string)
	{
		return $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	}
	// Function for Error Message Get
	function ErrorMessage($error_code, $current_lable, $reference_page,$error_msg)
	{
		if($error_code == 1451)
		{
			return "You are not allowed to delete this ".$current_lable.".Beacuse This ".$current_lable." record entry in ".$reference_page." page.";
		}
		if($error_code == 1064)
		{
			return "This table does not exist in database!";
		}
		if($error_code == 1062)
		{
			return "This ".$current_lable." already exist!";
		}
		if($error_code == 1146)
		{
			return "This table does not exist in database!";
		}
		if($error_code == 1054)
		{
			return "This table field did not match!";
		}
		else
		{
			return $error_msg;
		}
	}
	//Function for showing data in day , week, month, Year
	function calendarDate($task_date, $show_date, $repeat_id)
	{
		$token = 0;
		if($task_date <= $show_date)
		{
			$token = 1;
			//None Only For Today
			if($repeat_id == 1)
			{
				$token = 0;
				return $token;
			}
			//Repeat Day
			if($repeat_id == 2)
			{
				return $token;
			}
			//Repeat Week
			if($repeat_id == 3)
			{
				$dateval = date('D', strtotime($task_date));
				$dateshow = date('D', strtotime($show_date));
				if($dateval == $dateshow)
				{
					return $token;
				}
			}
			//Repeat Month
			if($repeat_id == 4)
			{	
				$begin = new \DateTime($task_date);
				$end = new \DateTime($show_date); 
				$end = $end->modify( '+1 day' ); 
				$interval = new \DateInterval('P1M');
				$daterange = new \DatePeriod($begin, $interval ,$end);
				foreach($daterange as $date){
					if($date->format("Y-m-d") == $show_date)
					{
						return $token;
						break;
					}
				}
			}
			//Repeat Year
			if($repeat_id == 5)
			{	
				$begin = new \DateTime($task_date);
				$end = new \DateTime($show_date);
				$end = $end->modify( '+1 day' ); 
				$interval = new \DateInterval('P1Y');
				$daterange = new \DatePeriod($begin, $interval ,$end);
				foreach($daterange as $date)
				{
					if($date->format("Y-m-d") == $show_date)
					{
						return $token;
						break;
					}
				}
			}
		}
		else
		{
			return $token;
		}
	}
	
	// Function for Site Date Format
	function site_date_format($date)
	{
		$date_value = (($date != '') && ($date != '0000-00-00') && ($date != '1970-01-01') && ($date != '1970-01-01 00:00:00') && ($date != '0000-00-00 00:00:00')) ? date("D M d, Y",strtotime($date)) : '';
		return $date_value;
	}
		
	//Generate A random Encryption Key
	function createEncryptionKey()
	{
		// $key will be assigned a 32-byte (256-bit) random key
		$createKey = \CodeIgniter\Encryption\Encryption::createKey(32);
		// Get a hex-encoded representation of the key:
		$key = bin2hex($createKey);
		return $key;
	}
	//Encrypt the plaintext to ciphertext
	function encryptText($plainText, $key)
	{
		// Encryption Initialize
		$encrypter = \Config\Services::encrypter();
		$cipherText = bin2hex($encrypter->encrypt($plainText, $key));
		return $cipherText;
	}
	//Encrypt the ciphertext to plaintext
	function decryptText($cipherText, $key)
	{
		// Encryption Initialize
		$encrypter = \Config\Services::encrypter();
		//Convert Cipher Text hexa to binary
		$convertText = hex2bin($cipherText);
		$plainText = $encrypter->decrypt($convertText, $key);
		return $plainText;
	}
	
	//function for retrive all data with conditions Limit
	function retrive_all_cond_data_limit($selects, $tablename, $cond, $order_by_column, $order_by,$limit1,$limit2)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table($tablename);
		$builder = $builder->select($selects);
		if(!empty($cond))
		$builder = $builder->where($cond);
		if(!empty($order_by_column) && !empty($order_by))
		$builder = $builder->orderBy($order_by_column, $order_by);
		if($limit2 != '')
		{
			$builder = $builder->limit($limit2,$limit1);
		}
		$query = $builder->get();
		//echo $db->getLastQuery();//exit;
		if($builder->countAll() > 0)
		{
			$row = $query->getResult();
		}
		$error_msg = $db->error();
		if($error_msg['code'] != '0')
		{
			return $error_msg['code'];
		}
		else
		{
			return $row;
		}
	}
	
	//For Numeric
	function getNUID($num)
	{
		$d=date ("d");
		$m=date ("m");
		$y=date ("Y");
		$t=time();
		$dmt=$d+$m+$y+$t;    
		$ran= rand(0,10000000);
		$dmtran= $dmt+$ran;
		$sort=substr($dmtran, $num); // if you want sort length code.
		return $sort;
	}
	
	//function for retrive all data with conditions
	public function retrive_all_cond_data_distinct($selects, $tablename, $cond, $order_by_column, $order_by)
	{
		if(empty($cond))
		{
			$cond = "1=1";
		}
		$db      = \Config\Database::connect();
		$builder = $db->table($tablename);
		$builder = $builder->select($selects);
		$builder = $builder->where($cond);
		$builder = $builder->orderBy($order_by_column, $order_by);
		$builder = $builder->distinct();
		$query   = $builder->get();
		//echo $db->getLastQuery();exit;
		if($builder->countAll() > 0)
		{
			$row = $query->getResult();
		}
		$error_msg = $db->error();
		//print_r($error_msg);exit;
		if($error_msg['code'] != '0')
		{
			return $error_msg['code'];
		}
		else
		{
			return $row;
		}
	}
	
	//function for retrive all data two table union
	public function retrive_all_cond_data_union($selects, $tablename1, $tablename2, $cond1, $cond2, $order_by_column, $order_by)
	{
		// #1 SubQueries no.1 -------------------------------------------
		$db      = \Config\Database::connect();
		$query = $db->query("SELECT $selects FROM $tablename1 WHERE $cond1 UNION ALL SELECT $selects FROM $tablename2 WHERE $cond2 ORDER BY $order_by_column $order_by");
		//echo $db->getLastQuery();exit;
		$row = $query->getResult();
		return $row;
	}
	
	//function for retrive all data Multiple tables union
	public function retrive_all_cond_data_multiple_union($tableArray, $typeArray, $cond, $order_by_column, $order_by)
	{
		$db      = \Config\Database::connect();
		$query = $db->query("SELECT $typeArray[0] FROM $tableArray[0] WHERE $cond UNION ALL SELECT $typeArray[1] FROM $tableArray[1] WHERE $cond UNION ALL SELECT $typeArray[2] FROM $tableArray[2] WHERE $cond UNION ALL SELECT $typeArray[3] FROM $tableArray[3] WHERE $cond UNION ALL SELECT $typeArray[4] FROM $tableArray[4] WHERE $cond UNION ALL SELECT $typeArray[5] FROM $tableArray[5] WHERE $cond UNION ALL SELECT $typeArray[6] FROM $tableArray[6] WHERE $cond UNION ALL SELECT $typeArray[7] FROM $tableArray[7] WHERE $cond UNION ALL SELECT $typeArray[8] FROM $tableArray[8] WHERE $cond UNION ALL SELECT $typeArray[9] FROM $tableArray[9] WHERE $cond UNION ALL SELECT $typeArray[10] FROM $tableArray[10] WHERE $cond UNION ALL SELECT $typeArray[11] FROM $tableArray[11] WHERE $cond ORDER BY $order_by_column $order_by");
		//echo $db->getLastQuery();exit;
		$row = $query->getResult();
		return $row;
	}
	
	//Function for password Check
	function check_password($old_password)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table(tbl_user);
		$builder = $builder->where('password',MD5($old_password));
		$query = $builder->get();
		if($builder->countAll() > 0)
		{
			$row = $query->getRow();
		}
		$error_msg = $db->error();
		if($error_msg['code'] != '0')
		{
			return $error_msg['code'];
		}
		else
		{
			return $row;
		}
	}
	
	
	
	//Function for Update password
	function update_password($new_password)
	{
		$db      = \Config\Database::connect();
		$session = \Config\Services::session();
		$userId = $session->get('userId');
		$form_array = array(
		'password' => MD5($new_password)
		); 
		$userModel = new User();
		$query = $userModel->form_update(tbl_user,$form_array,'id',$userId);
		$error_msg = $db->error();
		if($error_msg['code'] != '0')
		{
			return $error_msg['code'];
		}
		else
		{
			return $query;
		}
	}
	
	//function for check available counts
	public function check_available_count($selects,$tablename,$cond,$column_check)
	{
		$db      = \Config\Database::connect();
		$session = \Config\Services::session();
		$UserPackageDetails = $session->get('UserPackageDetails');
		$Access = 'is_'.$column_check;
		$AccessCount = $column_check.'_count';
		$AllowedCount = $UserPackageDetails[$AccessCount];
		$HasAccess = $UserPackageDetails[$Access];
		$builder = $db->table($tablename);
		$builder = $builder->select($selects);
		$builder = $builder->where($cond);
		$TotalCount = $builder->countAllResults();
		//echo $db->getLastQuery();exit;
		if($HasAccess == 1)
		{
			if($TotalCount >= $AllowedCount)
			{
				return 1;
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}
	
	public function randomPassword($length) 
	{
		$chars = "1234567890-!abcdef";
		return substr(str_shuffle($chars),0,$length);
	}
	
	//Get Alphanumeric captcha code
	function getToken($length)
	{
		$token = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet.= "0123456789";
		$max = strlen($codeAlphabet);

		for ($i=0; $i < $length; $i++) {
		$token .= $codeAlphabet[random_int(0, $max-1)];
		}
		return $token;
	}
	//function for retrive one row data with id
	public function getDataById($tablename, $column, $id)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table($tablename);
		$builder = $builder->where($column, $id);
		$query   = $builder->get();
		//echo $db->getLastQuery();exit;
		if($builder->countAll() > 0)
		{
			$row = $query->getRow();
		}
		$error_msg = $db->error();
		//print_r($error_msg);exit;
		if($error_msg['code'] != '0')
		{
			return $error_msg['code'];
		}
		else
		{
			return $row;
		}
	}
	
	//Function for Login check
	function user_email_check($tablename,$email)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table($tablename);
		$builder = $builder->where('user_email', $email);
		$query   = $builder->get();
		//echo $db->getLastQuery();exit;
		if($builder->countAll() > 0)
		{
			$row = $query->getRow();
		}
		$error_msg = $this->db->error();
		if($error_msg['code'] != '0')
		{
			return $error_msg['code'];
		}
		else
		{
			return $row;
		}
	}
	
	function format_telephone($phone_number)
	{
		$cleaned = preg_replace('/[^[:digit:]]/', '', $phone_number);
		preg_match('/(\d{3})(\d{3})(\d{4})/', $cleaned, $matches);
		return "{$matches[1]} {$matches[2]} {$matches[3]}";
	}
	
	public function generaterandom($length) 
	{
		$chars = "1234567890";
		return substr(str_shuffle($chars),0,$length);
	}
	
		//Function for Login check
	function login_check($user_id,$password)
	{
		$db      = \Config\Database::connect();
		$where = "(user_email = '".$user_id."' OR user_phone = '".$user_id."')";
		$builder = $db->table(tbl_user);
		$builder = $builder->select('*');
		$builder = $builder->where($where);
		$builder = $builder->where('password',MD5($password));
		$query = $builder->get();
		
		//echo $db->getLastQuery();exit;
		if($builder->countAll() > 0)
		{
			$row = $query->getRow();
		}
		$error_msg = $db->error();
		//print_r($row);exit;
		if($error_msg['code'] != '0')
		{
			return $error_msg['code'];
		}
		else
		{
			return $row;
		}
	}
	

	//Function for mpin Check
	function check_mpin($userId,$old_mpin)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table(tbl_mpin);
		$builder = $builder->where('user_id',$userId);
		$builder = $builder->where('m_pin',$old_mpin);
		$query = $builder->get();
		if($builder->countAll() > 0)
		{
			$row = $query->getRow();
		}
		$error_msg = $db->error();
		if($error_msg['code'] != '0')
		{
			return $error_msg['code'];
		}
		else
		{
			return $row;
		}
	}
}
?>