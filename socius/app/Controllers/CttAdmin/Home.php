<?php namespace App\Controllers\CttAdmin;

use App\Models\Admin;
use App\Models\Adminvariable;
use App\Models\Adminmail;

use CodeIgniter\Controller;

class Home extends Controller
{
	public function __construct()
	{
		$this->admin = new Admin();
		$this->adminvars = new Adminvariable();
		$this->adminmail = new Adminmail();
		$this->uri = new \CodeIgniter\HTTP\URI(current_url()); 
	}
		
	//protected $Adminvariable;
	//category Listing
	public function index()
    {
		$data = $this->adminvars->variables(); //Admin Variable Load
		$session = \Config\Services::session();
		$adminId =	$session->get('adminId');
		if(!empty($adminId))
		{
			$data = $this->adminvars->variables(); //Admin Variable Load
			//Load Page
			echo view('ctt-admin/dashboard/head', $data);
			echo view('ctt-admin/dashboard/sidebar', $data);
			echo view('ctt-admin/dashboard/dashboard', $data);
			echo view('ctt-admin/dashboard/footer', $data);
		}
		else
		{
			return redirect()->to( site_url('ctt-admin/login') );
		}
    }
	//Add category
	public function is_login()
    {
		$data = $this->adminvars->variables(); //Admin Variable Load
		$session = \Config\Services::session();
		$adminId =	$session->get('adminId');
		if(!empty($adminId))
		{
			return redirect()->to( site_url('ctt-admin/dashboard') );
		}
		else
		{
			if($this->request->getVar()) 
			{
				if(isset($_POST['submit']) && $_POST['submit']=='login')
				{
					$email = $this->request->getVar('email');
					$password = $this->request->getVar('password');
					$result = $this->admin->login_check($email,$password);//Check admin id and 
					//print_r($result);exit;
					if(!empty($result))//check result
					{
						if($result->is_active == 0)
						{
							$session->setFlashdata('error_msg', InactiveErrMsg);
							return redirect()->to( site_url('ctt-admin/login') );
						}
						else
						{
							$User_ID = $result->id;//set id
							$User_Type = $result->user_type_id;//set User Type
							$session->set('adminId', $User_ID);
							$session->set('userType', $User_Type);
							return redirect()->to( site_url('ctt-admin/dashboard') );
						}
					}
					else
					{
						//set Error message
						$session->setFlashdata('error_msg', LoginErrMsg);
						//Page Load
						return redirect()->to( site_url('ctt-admin/login') );
					}
				}
			}
			else
			{
				echo view('ctt-admin/adm-login/login',$data);
			}
		}	
    }	
	
	//Function for Admin SignOut
	function signout()
	{
		$session = \Config\Services::session();
		$session->remove('adminId');
		$session->remove('userType');
		return redirect()->to( site_url('ctt-admin/login') );
	}
	
	//Add change pass
	public function changepassword()
    {	
		$data = $this->adminvars->variables(); //Admin Variable Load
		$session = \Config\Services::session();
		$adminId =	$session->get('adminId');
			if($this->request->getVar()) 
			{
				if(isset($_POST['btn_update']) && $_POST['btn_update']=='changepass')
				{
					 $old_password = $this->request->getVar('Old_Password');
					$new_password = $this->request->getVar('New_Password');
					$confirm_password = $this->request->getVar('Confirm_Password');
					
					$result = $this->admin->check_password($old_password);//Check admin id and 
					//print_r($result);exit;
					if(!empty($result))//check result
					{
						if($new_password == $confirm_password)
						{
							$result = $this->admin->update_password($new_password);
							//Update Admin Password
							$session->setFlashdata('success_msg', ChangePasswordMsg);
							return redirect()->to( site_url('ctt-admin/change-password') );
						}
						else
						{
							$session->setFlashdata('error_msg', NotMatchPassMsg);
							return redirect()->to( site_url('ctt-admin/change-password') );
						}
					}
					else
					{
						//set Error message
						$session->setFlashdata('error_msg', NotMatchPassMsg);
						//Page Load
						return redirect()->to( site_url('ctt-admin/change-password') );
					}
				}
			}
		if(!empty($adminId))//check session
		{
			//Load View pages
			echo view('ctt-admin/dashboard/head', $data);
			echo view('ctt-admin/dashboard/sidebar', $data);
			echo view('ctt-admin/adm-login/changepassword', $data);
			echo view('ctt-admin/dashboard/footer', $data);
		}
		else
		{
			echo view('ctt-admin/adm-login/login',$data);
		}
	}

	//Function for Forget Password
	public function forgetpassword()
	{
		$data = $this->adminvars->variables(); //Admin Variable Load
		$session = \Config\Services::session();
		if($this->request->getVar()) 
		{
			if(isset($_POST['submit']) && $_POST['submit']=='forgot')
			{
				$result = $this->admin->admin_email_check($_POST['email']);//Check Admin Email
				//print_r($result);exit;
				if(!empty($result))//Check result
				{
					//Mail send to Admin Staff for reset password
					$email = $this->request->getVar('email');
					//echo $result->admin_name;exit; 
					$this->adminmail->forgetpassemail($email,$result->admin_name); 
					$session->setFlashdata('success_msg', ForgotMsg);
					return redirect()->to( site_url('ctt-admin/login') );
				}
				else
				{
					//Set message in session login error
					$session->setFlashdata('error_msg', LoginErrEmail);
					return redirect()->to( site_url('ctt-admin/forgot-password') );
				}
			}
		}
		echo view('ctt-admin/adm-login/forgetpassword',$data);
	}	
	
	//Function For Reset Password
	public function resetpassword()
	{
		$data = $this->adminvars->variables(); //Admin Variable Load
		$session = \Config\Services::session();
		$segmentRemove = array_filter($this->request->uri->getSegments());
		$segment = array_values($segmentRemove);
		if($this->request->getVar()) 
		{
			if(isset($_POST['submit']) && $_POST['submit']=='reset')
			{
				$new_password = $this->request->getVar('new_password');
				$confirm_password = $this->request->getVar('confirm_password');
				$email = $segment[2];
				$admin_email = base64_decode($email);
				if($new_password == $confirm_password)
				{
					$result = $this->admin->reset_password($new_password,$admin_email);//Reset the password
					
					if($segment[1] == "reset-password") { 
					
					$session->setFlashdata('success_msg', ResetPasswordMsg);
					return redirect()->to( site_url('ctt-admin/login') );
					} 
					if($segment[1] == "create-password") {
					$session->setFlashdata('success_msg', CreatePasswordMsg);
					return redirect()->to( site_url('ctt-admin/login') );
					
					}
					
				}
				else
				{
					//Set error message in session
					
					$session->setFlashdata('error_msg', NotMatchPassMsg);
					return redirect()->to( site_url('ctt-admin/reset-password') );
				}
			}
		}
		$data['passurl'] = $segment[1];	
		echo view('ctt-admin/adm-login/resetpassword',$data);
	}
	
	//Function for Register Key Manager
	public function registerkeymanager()
	{
		$data = $this->adminvars->variables(); //Admin Variable Load
		$session = \Config\Services::session();
		if($this->request->getVar()) 
		{
			if(isset($_POST['submit']) && $_POST['submit']=='signup')
			{
				$result = $this->admin->admin_email_check($_POST['email']);
				if(!empty($result))//Check result
				{
					//Mail send to Admin Staff for create password
					$email = $this->request->getVar('email');
					return redirect()->to( site_url('ctt-admin/create-password/'.base64_encode($email)) );
				}
				else
				{
					//Set message in session login error
					$session->setFlashdata('error_msg', NotRegisterdErrEmail);
					return redirect()->to( site_url('ctt-admin/register') );
				}
			}
		}
		echo view('ctt-admin/adm-login/register',$data);
	}	
	
	
	
}