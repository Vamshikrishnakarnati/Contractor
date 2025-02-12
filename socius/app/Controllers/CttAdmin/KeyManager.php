<?php namespace App\Controllers\CttAdmin;

use App\Models\Admin;
use App\Models\Adminvariable;
use App\Models\Adminmail;

use CodeIgniter\Controller;

class KeyManager extends Controller
{
	public function __construct()
	{
		$this->admin = new Admin();
		$this->adminvars = new Adminvariable();
		$this->adminmail = new Adminmail();
		$this->uri = new \CodeIgniter\HTTP\URI(current_url()); 
	}
		
	public function keymanagerlisting()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			//print_r($_POST);exit;
			$data = $this->adminvars->variables(); //Admin Variable Load
			$admin_name = $this->request->getVar('admin_name'); 
			$data['QsKeyManager'] = $this->admin->retrive_all_cond_data('*',tbl_admin,'is_delete="0" AND admin_name = "'.$admin_name.'" AND user_type_id != 1', 'id','DESC');
			
			echo view('ctt-admin/dashboard/head', $data);
			echo view('ctt-admin/dashboard/sidebar', $data);
			echo view('ctt-admin/adm-key-manager/adm-key-manager-listing', $data);
			echo view('ctt-admin/dashboard/footer', $data);
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Add offers
	public function addkeymanager()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			helper(['form', 'url']);
			if($this->request->getVar()) 
			{
				$admin_name = $this->request->getVar('admin_name'); 
				$admin_id  = $this->request->getVar('admin_id');
				$admin_email  = $this->request->getVar('admin_email');
				$admin_phone  = $this->request->getVar('admin_phone');
				$data = [
					'user_type_id' => 2,
					'admin_name' => $admin_name,
					'admin_id ' => $admin_id, 
					'admin_email' => $admin_email, 
					'admin_phone' => $admin_phone, 
					];
			
				$error_code = $this->admin->form_insert(tbl_admin,$data);
				if($error_code != '')
				{
					$error_msg = $this->admin->ErrorMessage($error_code, 'key manager', '','');
					$session = \Config\Services::session();
					$session->setFlashdata('error_msg', $error_msg);
					
					$data = $this->adminvars->variables(); 
					
					echo view('ctt-admin/dashboard/head', $data);
					echo view('ctt-admin/dashboard/sidebar', $data);
					echo view('ctt-admin/adm-key-manager/adm-add-key-manager', $data);
					echo view('ctt-admin/dashboard/footer', $data);
				}
				else
				{
					$this->adminmail->RegistrationSuccessful($admin_name,$admin_id,$admin_email,$admin_phone); 
					$session = \Config\Services::session();
					$session->setFlashdata('success_msg', MKM_AddMsg);
					return redirect()->to( site_url('ctt-admin/key-manager-listing') );
				}
			}
			else
			{
				$data = $this->adminvars->variables();
				
				echo view('ctt-admin/dashboard/head', $data);
				echo view('ctt-admin/dashboard/sidebar', $data);
				echo view('ctt-admin/adm-key-manager/adm-add-key-manager', $data);
				echo view('ctt-admin/dashboard/footer', $data);
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Edit KeyManager
	public function editkeymanager()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		$segmentRemove = array_filter($this->request->uri->getSegments());
		$segment = array_values($segmentRemove);
		if(!empty($adminId))
		{
			$id = $segment[2];
			if($this->request->getVar()) 
			{
				$admin_name = $this->request->getVar('admin_name'); 
				$admin_id  = $this->request->getVar('admin_id');
				$admin_email  = $this->request->getVar('admin_email');
				$admin_phone  = $this->request->getVar('admin_phone');
				$data = [
					'admin_name' => $admin_name,
					'admin_id ' => $admin_id, 
					'admin_email' => $admin_email, 
					'admin_phone' => $admin_phone, 
					'updated_date' => date('Y-m-d'),
					];
				//Insert form data
				$error_code = $this->admin->form_update(tbl_admin,$data,'id',$id);
				if($error_code != '')
				{
					//Set error message if any error in SQL
					$error_msg = $this->admin->ErrorMessage($error_code, 'key manager', '','');
					$session = \Config\Services::session();
					$session->setFlashdata('error_msg', $error_msg);
					
					$data = $this->adminvars->variables(); //Admin Variable Load
					$data['EditData'] = $this->admin->getDataById(tbl_admin, 'id', $id);
					//Load Page
					$data['urisegment'] = $segment[2];
					echo view('ctt-admin/dashboard/head', $data);
					echo view('ctt-admin/dashboard/sidebar', $data);
					echo view('ctt-admin/adm-key-manager/adm-add-key-manager', $data);
					echo view('ctt-admin/dashboard/footer', $data);
					
				}
				else
				{
					//Set Flashdata session
					$session = \Config\Services::session();
					$session->setFlashdata('success_msg', MKM_UpdateMsg);
					return redirect()->to( site_url('ctt-admin/key-manager-listing') );
				}
			}
			else
			{
				$data = $this->adminvars->variables(); //Admin Variable Load
				//Load Page
				$data['urisegment'] = $segment[2];
				$data['EditData'] = $this->admin->getDataById(tbl_admin, 'id', $id);
				echo view('ctt-admin/dashboard/head', $data);
				echo view('ctt-admin/dashboard/sidebar', $data);
				echo view('ctt-admin/adm-key-manager/adm-add-key-manager', $data);
				echo view('ctt-admin/dashboard/footer', $data);
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Delete KeyManager
	public function deletekeymanager()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			$segmentRemove = array_filter($this->request->uri->getSegments());
			$segment = array_values($segmentRemove);
			$id = $segment[2];
			$error_code = $this->admin->deleteRow(tbl_admin,'id',$id);
			if($error_code != "")
			{
				//Set error message if any error in SQL
				$error_msg = $this->admin->ErrorMessage($error_code, 'key manager', '','');
				$session = \Config\Services::session();
				$session->setFlashdata('error_msg', $error_msg);
				return redirect()->to( site_url('ctt-admin/key-manager-listing') );
			}
			else
			{
				//Set Flashdata session
				$session = \Config\Services::session();
				$session->setFlashdata('success_msg', MKM_DeleteMsg);
				return redirect()->to( site_url('ctt-admin/key-manager-listing') );
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }

	//Search KeyManager
	public function searchkeymanager()
    {
		// Get search term 
		$admin_name = $_REQUEST['admin_name'];
		
		$QsKeyManager = $this->admin->retrive_all_cond_data('*',tbl_admin,'is_delete="0" AND admin_name LIKE "%'.$admin_name.'%" AND user_type_id != 1', 'id','DESC'); 
		// Generate array with skills data 
		$skillData = array(); 
		if(!empty($QsKeyManager)){ 
			foreach($QsKeyManager as $RsKeyManager)
			{
				$data['id'] = $RsKeyManager->id; 
				$data['value'] = $RsKeyManager->admin_name; 
				array_push($skillData, $data); 
			} 
		} 
		 
		// Return results as json encoded array 
		echo json_encode($skillData); 
    }
}