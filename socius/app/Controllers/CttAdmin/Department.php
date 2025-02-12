<?php namespace App\Controllers\CttAdmin;

use App\Models\Admin;
use App\Models\Adminvariable;

use CodeIgniter\Controller;

class Department extends Controller
{
	public function __construct()
	{
		$this->admin = new Admin();
		$this->adminvars = new Adminvariable();
		$this->uri = new \CodeIgniter\HTTP\URI(current_url()); 
	}
		
	public function departmentlisting()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			//print_r($_POST);exit;
			$data = $this->adminvars->variables(); //Admin Variable Load
			$department_name = $this->request->getVar('department_name'); 
			$data['QsDepartment'] = $this->admin->retrive_all_cond_data('*',tbl_department,'is_delete="0" AND department_name = "'.$department_name.'"', 'id','DESC');
			
			echo view('ctt-admin/dashboard/head', $data);
			echo view('ctt-admin/dashboard/sidebar', $data);
			echo view('ctt-admin/adm-department/adm-department-listing', $data);
			echo view('ctt-admin/dashboard/footer', $data);
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Add offers
	public function adddepartment()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			helper(['form', 'url']);
			if($this->request->getVar()) 
			{
				$department_name = $this->request->getVar('department_name'); 
				$department_code = $this->request->getVar('department_code');
				$data = [
					'department_name' => $department_name,
					'department_code' => $department_code
					];
				//Insert form data
				$error_code = $this->admin->form_insert(tbl_department,$data);
				if($error_code != '')
				{
					//Set error message if any error in SQL
					$error_msg = $this->admin->ErrorMessage($error_code, 'department name', '','');
					$session = \Config\Services::session();
					$session->setFlashdata('error_msg', $error_msg);
					
					$data = $this->adminvars->variables(); //Admin Variable Load
					//Load Page
					
					echo view('ctt-admin/dashboard/head', $data);
					echo view('ctt-admin/dashboard/sidebar', $data);
					echo view('ctt-admin/adm-department/adm-add-department', $data);
					echo view('ctt-admin/dashboard/footer', $data);
					
				}
				else
				{
					//Set Flashdata session
					$session = \Config\Services::session();
					$session->setFlashdata('success_msg', MD_AddMsg);
					return redirect()->to( site_url('ctt-admin/department-listing') );
				}
			}
			else
			{
				$data = $this->adminvars->variables(); //Admin Variable Load
				//Load Page
				echo view('ctt-admin/dashboard/head', $data);
				echo view('ctt-admin/dashboard/sidebar', $data);
				echo view('ctt-admin/adm-department/adm-add-department', $data);
				echo view('ctt-admin/dashboard/footer', $data);
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Edit Department
	public function editdepartment()
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
				$department_name = $this->request->getVar('department_name');
				$department_code = $this->request->getVar('department_code');
				$data = [
					'department_name' => $department_name,
					'department_code' => $department_code,
					'updated_date' => date('Y-m-d'),
					];
				//Insert form data
				$error_code = $this->admin->form_update(tbl_department,$data,'id',$id);
				if($error_code != '')
				{
					//Set error message if any error in SQL
					$error_msg = $this->admin->ErrorMessage($error_code, 'department name', '','');
					$session = \Config\Services::session();
					$session->setFlashdata('error_msg', $error_msg);
					
					$data = $this->adminvars->variables(); //Admin Variable Load
					$data['EditData'] = $this->admin->getDataById(tbl_department, 'id', $id);
					//Load Page
					$data['urisegment'] = $segment[2];
					echo view('ctt-admin/dashboard/head', $data);
					echo view('ctt-admin/dashboard/sidebar', $data);
					echo view('ctt-admin/adm-department/adm-add-department', $data);
					echo view('ctt-admin/dashboard/footer', $data);
					
				}
				else
				{
					//Set Flashdata session
					$session = \Config\Services::session();
					$session->setFlashdata('success_msg', MD_UpdateMsg);
					return redirect()->to( site_url('ctt-admin/department-listing') );
				}
			}
			else
			{
				$data = $this->adminvars->variables(); //Admin Variable Load
				//Load Page
				$data['urisegment'] = $segment[2];
				$data['EditData'] = $this->admin->getDataById(tbl_department, 'id', $id);
				echo view('ctt-admin/dashboard/head', $data);
				echo view('ctt-admin/dashboard/sidebar', $data);
				echo view('ctt-admin/adm-department/adm-add-department', $data);
				echo view('ctt-admin/dashboard/footer', $data);
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Delete Department
	public function deletedepartment()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			$segmentRemove = array_filter($this->request->uri->getSegments());
			$segment = array_values($segmentRemove);
			$id = $segment[2];
			$error_code = $this->admin->deleteRow(tbl_department,'id',$id);
			if($error_code != "")
			{
				//Set error message if any error in SQL
				$error_msg = $this->admin->ErrorMessage($error_code, 'department name', '','');
				$session = \Config\Services::session();
				$session->setFlashdata('error_msg', $error_msg);
				return redirect()->to( site_url('ctt-admin/department-listing') );
			}
			else
			{
				//Set Flashdata session
				$session = \Config\Services::session();
				$session->setFlashdata('success_msg', MD_DeleteMsg);
				return redirect()->to( site_url('ctt-admin/department-listing') );
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Active Category
	public function activedepartment()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			$segmentRemove = array_filter($this->request->uri->getSegments());
			$segment = array_values($segmentRemove);
			$id = $segment[2];
			//Active form data
			$error_code = $this->admin->active_record(tbl_department,$id);
			if($error_code != "")
			{
				//Set error message if any error in SQL
				$error_msg = $this->admin->ErrorMessage($error_code, 'department name', '','');
				$session = \Config\Services::session();
				$session->setFlashdata('error_msg', $error_msg);
				return redirect()->to( site_url('ctt-admin/department-listing') );
			}
			else
			{
				//Set Flashdata session
				$session = \Config\Services::session();
				$session->setFlashdata('success_msg', MD_ActiveMsg);
				return redirect()->to( site_url('ctt-admin/department-listing') );
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Inactive Department
	public function inactivedepartment()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			$segmentRemove = array_filter($this->request->uri->getSegments());
			$segment = array_values($segmentRemove);
			$id = $segment[2];
			//Inactive form data
			$error_code = $this->admin->inactive_record(tbl_department,$id);
			if($error_code != "")
			{
				//Set error message if any error in SQL
				$error_msg = $this->admin->ErrorMessage($error_code, 'department name', '','');
				$session = \Config\Services::session();
				$session->setFlashdata('error_msg', $error_msg);
				return redirect()->to( site_url('ctt-admin/department-listing') );
			}
			else
			{
				//Set Flashdata session
				$session = \Config\Services::session();
				$session->setFlashdata('success_msg', MD_InactiveMsg);
				return redirect()->to( site_url('ctt-admin/department-listing') );
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Search Department
	public function searchdepartment()
    {
		// Get search term 
		$department_name = $_REQUEST['department_name'];
		
		$QsDepartment = $this->admin->retrive_all_cond_data('*',tbl_department,'is_delete="0" AND department_name LIKE "%'.$department_name.'%"', 'id','DESC'); 
		// Generate array with skills data 
		$skillData = array(); 
		if(!empty($QsDepartment)){ 
			foreach($QsDepartment as $RsDepartment)
			{
				$data['id'] = $RsDepartment->id; 
				$data['value'] = $RsDepartment->department_name; 
				array_push($skillData, $data); 
			} 
		} 
		 
		// Return results as json encoded array 
		echo json_encode($skillData); 
    }
}