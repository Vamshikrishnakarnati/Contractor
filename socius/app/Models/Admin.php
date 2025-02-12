<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

use CodeIgniter\Model;

class Admin extends Model
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
		//echo $db->getLastQuery();exit;
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
		$db      = \Config\Database::connect();
		$builder = $db->table($tablename);
		$builder = $builder->select($selects);
		if(!empty($cond))
		$builder = $builder->where($cond);
		if(!empty($order_by_column))
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
	
	
	
	//Function for Login check
	function login_check($user_id,$password)
	{
		$db      = \Config\Database::connect();
		$where = "(admin_email = '".$user_id."' OR admin_id = '".$user_id."')";
		$builder = $db->table(tbl_admin);
		$builder = $builder->select('*');
		$builder = $builder->where($where);
		$builder = $builder->where('admin_pwd',MD5($password));
		$query = $builder->get();
		
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
	function active_record($tablename,$id)
	{
		$db = \Config\Database::connect();
		$data = [
		'is_active' => 1,
		];
			$adminModel = new Admin();
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
		$adminModel = new Admin();
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
	
	//Function for admin_pwd Check
	function check_password($old_password)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table(tbl_admin);
		$builder = $builder->select('*');
		$builder = $builder->where('admin_pwd',MD5($old_password));
		$query = $builder->get();
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
	
	
	//Function for Update admin_pwd
	function update_password($new_password)
	{
		$session = \Config\Services::session();
		$adminId =	$session->get('adminId');
		$data = [
				'admin_pwd' => MD5($new_password)
				];
		$adminModel = new Admin();		
		$query = $adminModel->form_update(tbl_admin,$data,'id',$adminId);
		$error_msg = $this->db->error();
		if($error_msg['code'] != '0')
		{
			return $error_msg['code'];
		}
		else
		{
			return $query;
		}
	}
	
	//Function for Login check
	function admin_email_check($email)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table(tbl_admin);
		$builder = $builder->select('*');
		$builder = $builder->where('admin_email',$email);
		$query = $builder->get();
		//echo $db->getLastQuery();exit;
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
	
	//Function for Update admin_pwd
	function reset_password($new_password,$admin_email)
	{
		$data = [
				'admin_pwd' => MD5($new_password)
				];
		$adminModel = new Admin();		
		
		$query = $adminModel->admin_pass_update(tbl_admin,$data,$admin_email);
		$error_msg = $this->db->error();
		if($error_msg['code'] != '0')
		{
			return $error_msg['code'];
		}
		else
		{
			return $query;
		}
	}
	
	//Function to reset admin password
	function admin_pass_update($tablename,$data,$admin_email)
	{
		$db      = \Config\Database::connect();
		$builder = $db->table($tablename);
		$builder = $builder->select('*');
		$builder = $builder->where('admin_email',$admin_email);
		$update	 =	$builder->update($data);
		$error_msg = $this->db->error();
		if($error_msg['code'] != '0')
		{
			return $error_msg['code'];
		}
		else
		{
			return $update;
		}
	}
	// Function for Error Message Get - Written By Chita on 01-27-2018
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
	//function for retrive all data with conditions Limit
	function retrive_all_cond_data_limit($selects, $tablename, $cond, $order_by_column, $order_by,$limit1,$limit2)
	{
		$db = \Config\Database::connect();
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
	
	public function generaterandom($length) 
	{
		$chars = "1234567890";
		return substr(str_shuffle($chars),0,$length);
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
}
?>