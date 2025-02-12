<?php namespace App\Controllers\CttAdmin;

use App\Models\Admin;
use App\Models\Adminvariable;

use CodeIgniter\Controller;

class Employee extends Controller
{
	public function __construct()
	{
		$this->admin = new Admin();
		$this->adminvars = new Adminvariable();
		$this->uri = new \CodeIgniter\HTTP\URI(current_url()); 
	}
		
	public function employeelisting()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			//print_r($_POST);exit;
			$data = $this->adminvars->variables(); //Admin Variable Load
			$employee_name = $this->request->getVar('employee_name'); 
			$data['QsEmployee'] = $this->admin->retrive_all_cond_data('*',tbl_employee,'is_delete="0" AND employee_name = "'.$employee_name.'"', 'id','DESC');
			
			echo view('ctt-admin/dashboard/head', $data);
			echo view('ctt-admin/dashboard/sidebar', $data);
			echo view('ctt-admin/adm-employee/adm-employee-listing', $data);
			echo view('ctt-admin/dashboard/footer', $data);
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Add offers
	public function addemployee()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			helper(['form', 'url']);
			if($this->request->getVar()) 
			{
				$organisation_id = $_POST['organisation_id'];
				$sbu_id = $_POST['sbu_id'];
				$employee_name = $this->admin->HtmlAddSlash($_POST['employee_name']);
				$employee_email = $this->admin->HtmlAddSlash($_POST['employee_email']);
				$data = [
					'organisation_id' => $organisation_id,
					'organisation_sbu_id' => $sbu_id,
					'employee_name' => $employee_name,
					'employee_email' => $employee_email
					];
				//Insert form data
				$error_code = $this->admin->form_insert(tbl_employee,$data);
				if($error_code != '')
				{
					//Set error message if any error in SQL
					$error_msg = $this->admin->ErrorMessage($error_code, 'employee name', '','');
					$session = \Config\Services::session();
					$session->setFlashdata('error_msg', $error_msg);
					
					$data = $this->adminvars->variables(); //Admin Variable Load
					//Load Page
					
					echo view('ctt-admin/dashboard/head', $data);
					echo view('ctt-admin/dashboard/sidebar', $data);
					echo view('ctt-admin/adm-employee/adm-add-employee', $data);
					echo view('ctt-admin/dashboard/footer', $data);
					
				}
				else
				{
					//Set Flashdata session
					$session = \Config\Services::session();
					$session->setFlashdata('success_msg', ME_UpdateMsg);
					return redirect()->to( site_url('ctt-admin/employee-listing') );
				}
			}
			else
			{
				$data = $this->adminvars->variables(); //Admin Variable Load
				//Load Page
				echo view('ctt-admin/dashboard/head', $data);
				echo view('ctt-admin/dashboard/sidebar', $data);
				echo view('ctt-admin/adm-employee/adm-add-employee', $data);
				echo view('ctt-admin/dashboard/footer', $data);
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Add Employee Role
	public function addemployeerole()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			helper(['form', 'url']);
			if($this->request->getVar()) 
			{
				
				$organisation_id = $_POST['organisation_id'];
				$sbu_id = $_POST['sbu_id'];
				$employee_name = $this->admin->HtmlAddSlash($_POST['employee_name']);
				$employee_email = $this->admin->HtmlAddSlash($_POST['employee_email']);
				$data = [
					'organisation_id' => $organisation_id,
					'organisation_sbu_id' => $sbu_id,
					'employee_name' => $employee_name,
					'employee_email' => $employee_email
					];
				//Insert form data
				$error_code = $this->admin->form_insert(tbl_employee,$data);
				if($error_code != '')
				{
					//Set error message if any error in SQL
					$error_msg = $this->admin->ErrorMessage($error_code, 'employee name', '','');
					$session = \Config\Services::session();
					$session->setFlashdata('error_msg', $error_msg);
					
					$data = $this->adminvars->variables(); //Admin Variable Load
					//Load Page
					
					echo view('ctt-admin/dashboard/head', $data);
					echo view('ctt-admin/dashboard/sidebar', $data);
					echo view('ctt-admin/adm-employee/adm-add-employee', $data);
					echo view('ctt-admin/dashboard/footer', $data);
					
				}
				else
				{
					//Set Flashdata session
					$session = \Config\Services::session();
					$session->setFlashdata('success_msg', MER_UpdateMsg);
					return redirect()->to( site_url('ctt-admin/employee-listing') );
				}
			}
			else
			{
				$data = $this->adminvars->variables(); //Admin Variable Load
				//Load Page
				echo view('ctt-admin/dashboard/head', $data);
				echo view('ctt-admin/dashboard/sidebar', $data);
				echo view('ctt-admin/adm-employee/adm-employee-role-listing', $data);
				echo view('ctt-admin/dashboard/footer', $data);
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	public function employeerolelisting()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			helper(['form', 'url']);
			if(isset($_POST['btn_submit']) && $_POST['btn_submit'] == 'search') 
			{
				$data = $this->adminvars->variables(); //Admin Variable Load
				$organisation_id = $this->request->getVar('organisation_id'); 
				$sbu_id = $this->request->getVar('sbu_id'); 
				$data['QsEmployee'] = $this->admin->retrive_all_cond_data('*',tbl_employee,'is_delete="0" AND organisation_id = "'.$organisation_id.'" AND organisation_sbu_id = "'.$sbu_id.'"', 'id','DESC');
				
				
				echo view('ctt-admin/dashboard/head', $data);
				echo view('ctt-admin/dashboard/sidebar', $data);
				echo view('ctt-admin/adm-employee/adm-employee-role-listing');
				echo view('ctt-admin/dashboard/footer', $data);
			}
			elseif(isset($_POST['btnsubmit']) && $_POST['btnsubmit'] == 'all') 
			{
				//$organisation_id = $_POST['organisation_id'];
				//$sbu_id = $_POST['sbu_id'];
				$row_ids = explode(',', $_POST['row_ids']);
				for ($x = 0; $x < count($row_ids); $x++) {
					//echo $row_ids[$x].'<br>';
					$row_id = $row_ids[$x];
					$level_id = $_POST['level_'.$row_id];
					$level2_id = $_POST['level2_'.$row_id];
					$department_id = $_POST['department_'.$row_id];
					$area_id = $_POST['area_'.$row_id];
					$role_id = $_POST['role_'.$row_id];
					
					$data = [
					'level_id' => $level_id,
					'level2_id' => $level2_id,
					'department_id' => $department_id,
					'area_id' => $area_id,
					'role_id' => $role_id
					];
					//Update form data
					$error_code = $this->admin->form_update(tbl_employee,$data,'id',$row_id);
				}
				if($error_code != '')
				{
					//Set error message if any error in SQL
					$error_msg = $this->admin->ErrorMessage($error_code, 'employee name', '','');
					$session = \Config\Services::session();
					$session->setFlashdata('error_msg', $error_msg);
					
					$data = $this->adminvars->variables(); //Admin Variable Load
					//Load Page
					
					echo view('ctt-admin/dashboard/head', $data);
					echo view('ctt-admin/dashboard/sidebar', $data);
					echo view('ctt-admin/adm-employee/adm-employee-role-listing', $data);
					echo view('ctt-admin/dashboard/footer', $data);
					
				}
				else
				{
					//Set Flashdata session
					$session = \Config\Services::session();
					$session->setFlashdata('success_msg', MER_UpdateMsg);
					return redirect()->to( site_url('ctt-admin/employeerole-listing') );
				}
				
			}
			elseif(isset($_POST['row_btn_submit'])) 
			{
				//$organisation_id = $_POST['organisation_id'];
				//$sbu_id = $_POST['sbu_id'];
				$row_id = $_POST['row_btn_submit'];
				$level_id = $_POST['level_'.$row_id];
				$level2_id = $_POST['level2_'.$row_id];
				$department_id = $_POST['department_'.$row_id];
				$area_id = $_POST['area_'.$row_id];
				$role_id = $_POST['role_'.$row_id];
				
				$data = [
					'level_id' => $level_id,
					'level2_id' => $level2_id,
					'department_id' => $department_id,
					'area_id' => $area_id,
					'role_id' => $role_id
					];
				//Update form data
				$error_code = $this->admin->form_update(tbl_employee,$data,'id',$row_id);
				if($error_code != '')
				{
					//Set error message if any error in SQL
					$error_msg = $this->admin->ErrorMessage($error_code, 'employee name', '','');
					$session = \Config\Services::session();
					$session->setFlashdata('error_msg', $error_msg);
					
					$data = $this->adminvars->variables(); //Admin Variable Load
					//Load Page
					
					echo view('ctt-admin/dashboard/head', $data);
					echo view('ctt-admin/dashboard/sidebar', $data);
					echo view('ctt-admin/adm-employee/adm-employee-role-listing', $data);
					echo view('ctt-admin/dashboard/footer', $data);
					
				}
				else
				{
					//Set Flashdata session
					$session = \Config\Services::session();
					$session->setFlashdata('success_msg', MER_UpdateMsg);
					return redirect()->to( site_url('ctt-admin/employeerole-listing') );
				}
			}
			else
			{
				$data = $this->adminvars->variables(); //Admin Variable Load
				
				echo view('ctt-admin/dashboard/head', $data);
				echo view('ctt-admin/dashboard/sidebar', $data);
				echo view('ctt-admin/adm-employee/adm-employee-role-listing');
				echo view('ctt-admin/dashboard/footer', $data);
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Edit Employee
	public function editemployee()
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
				$organisation_id = $_POST['organisation_id'];
				$sbu_id = $_POST['sbu_id'];
				$employee_name = $this->admin->HtmlAddSlash($_POST['employee_name']);
				$employee_email = $this->admin->HtmlAddSlash($_POST['employee_email']);
				$data = [
					'organisation_id' => $organisation_id,
					'organisation_sbu_id' => $sbu_id,
					'employee_name' => $employee_name,
					'employee_email' => $employee_email
					];
				//Insert form data
				$error_code = $this->admin->form_update(tbl_employee,$data,'id',$id);
				if($error_code != '')
				{
					//Set error message if any error in SQL
					$error_msg = $this->admin->ErrorMessage($error_code, 'employee name', '','');
					$session = \Config\Services::session();
					$session->setFlashdata('error_msg', $error_msg);
					
					$data = $this->adminvars->variables(); //Admin Variable Load
					$data['EditData'] = $this->admin->getDataById(tbl_employee, 'id', $id);
					//Load Page
					$data['urisegment'] = $segment[2];
					echo view('ctt-admin/dashboard/head', $data);
					echo view('ctt-admin/dashboard/sidebar', $data);
					echo view('ctt-admin/adm-employee/adm-add-employee', $data);
					echo view('ctt-admin/dashboard/footer', $data);
					
				}
				else
				{
					//Set Flashdata session
					$session = \Config\Services::session();
					$session->setFlashdata('success_msg', MER_UpdateMsg);
					return redirect()->to( site_url('ctt-admin/employee-listing') );
				}
			}
			else
			{
				$data = $this->adminvars->variables(); //Admin Variable Load
				//Load Page
				$data['urisegment'] = $segment[2];
				$data['EditData'] = $this->admin->getDataById(tbl_employee, 'id', $id);
				echo view('ctt-admin/dashboard/head', $data);
				echo view('ctt-admin/dashboard/sidebar', $data);
				echo view('ctt-admin/adm-employee/adm-add-employee', $data);
				echo view('ctt-admin/dashboard/footer', $data);
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Delete Employee
	public function deleteemployee()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			$segmentRemove = array_filter($this->request->uri->getSegments());
			$segment = array_values($segmentRemove);
			$id = $segment[2];
			$error_code = $this->admin->deleteRow(tbl_employee,'id',$id);
			if($error_code != "")
			{
				//Set error message if any error in SQL
				$error_msg = $this->admin->ErrorMessage($error_code, 'contract name', '','');
				$session = \Config\Services::session();
				$session->setFlashdata('error_msg', $error_msg);
				return redirect()->to( site_url('ctt-admin/employee-listing') );
			}
			else
			{
				//Set Flashdata session
				$session = \Config\Services::session();
				$session->setFlashdata('success_msg', MER_DeleteMsg);
				return redirect()->to( site_url('ctt-admin/employee-listing') );
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Active Category
	public function activeemployee()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			$segmentRemove = array_filter($this->request->uri->getSegments());
			$segment = array_values($segmentRemove);
			$id = $segment[2];
			//Active form data
			$error_code = $this->admin->active_record(tbl_employee,$id);
			if($error_code != "")
			{
				//Set error message if any error in SQL
				$error_msg = $this->admin->ErrorMessage($error_code, 'contract name', '','');
				$session = \Config\Services::session();
				$session->setFlashdata('error_msg', $error_msg);
				return redirect()->to( site_url('ctt-admin/employee-listing') );
			}
			else
			{
				//Set Flashdata session
				$session = \Config\Services::session();
				$session->setFlashdata('success_msg', MER_ActiveMsg);
				return redirect()->to( site_url('ctt-admin/employee-listing') );
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Inactive Employee
	public function inactiveemployee()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			$segmentRemove = array_filter($this->request->uri->getSegments());
			$segment = array_values($segmentRemove);
			$id = $segment[2];
			//Inactive form data
			$error_code = $this->admin->inactive_record(tbl_employee,$id);
			if($error_code != "")
			{
				//Set error message if any error in SQL
				$error_msg = $this->admin->ErrorMessage($error_code, 'contract name', '','');
				$session = \Config\Services::session();
				$session->setFlashdata('error_msg', $error_msg);
				return redirect()->to( site_url('ctt-admin/employee-listing') );
			}
			else
			{
				//Set Flashdata session
				$session = \Config\Services::session();
				$session->setFlashdata('success_msg', MER_InactiveMsg);
				return redirect()->to( site_url('ctt-admin/employee-listing') );
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Search Employee
	public function searchemployee()
    {
		// Get search term 
		$employee_name = $_REQUEST['employee_name'];
		
		$QsEmployee = $this->admin->retrive_all_cond_data('*',tbl_employee,'is_delete="0" AND employee_name LIKE "%'.$employee_name.'%"', 'id','DESC'); 
		// Generate array with skills data 
		$skillData = array(); 
		if(!empty($QsEmployee)){ 
			foreach($QsEmployee as $RsEmployee)
			{
				$data['id'] = $RsEmployee->id; 
				$data['value'] = $RsEmployee->employee_name; 
				array_push($skillData, $data); 
			} 
		} 
		 
		// Return results as json encoded array 
		echo json_encode($skillData); 
    }
	//Search Employee
	public function getsbu()
    {
		$data = $this->adminvars->variables();
		//echo $data['MO_Select_SBU'];exit;
		// Get search term 
		$organisation_id = $_REQUEST['organisation_id'];
		
		$QsOrgSbu = $this->admin->retrive_all_cond_data('*',tbl_sbu,'is_delete="0" AND company_id = "'.$organisation_id.'"', 'id','DESC'); ?>
		<option value=""><?=$data['MER_Select_SBU'];?></option>
		<?php foreach($QsOrgSbu as $RsOrgSbu){ ?>
		<option value="<?=$RsOrgSbu->id?>"><?=$this->admin->HtmlStripSlash($RsOrgSbu->sbu_name);?></option>
		<?php } 
		
    }
	//Get Department
	public function getdepartment()
    {
		$data = $this->adminvars->variables();
		
		// Get search term 
		$organisation_id = $_REQUEST['organisation_id'];
		$sbu_id = $_REQUEST['sbu_id'];
		$level = $_REQUEST['level'];
		$id = $_REQUEST['id'];
		if($level == 1)
		{
			$QsCentralisedDepartment = $this->admin->retrive_all_cond_data('*',tbl_centralised_department,'is_delete="0" AND sbu_id="'.$sbu_id.'" AND is_value = 1', 'id','DESC');
			?>
			<option value=""><?=$data['MER_Select_Department'];?></option>
			<?php foreach($QsCentralisedDepartment as $RsCentralisedDepartment){ 
			$QsDepartment = $this->admin->getDataById(tbl_department, 'id', $RsCentralisedDepartment->department_id); ?>
			<option value="<?=$QsDepartment->id?>"><?=$this->admin->HtmlStripSlash($QsDepartment->department_name);?></option>
			<?php } 
		}
		elseif($level == 2)
		{
			$QsCentralisedDepartment = $this->admin->retrive_all_cond_data('*',tbl_centralised_department,'is_delete="0" AND sbu_id="'.$sbu_id.'" AND is_value = 1', 'id','DESC');
			?>
			<option value=""><?=$data['MER_Select_Department'];?></option>
			<?php foreach($QsCentralisedDepartment as $RsCentralisedDepartment){ 
			$QsDepartment = $this->admin->getDataById(tbl_department, 'id', $RsCentralisedDepartment->department_id); ?>
			<option value="<?=$QsDepartment->id?>"><?=$this->admin->HtmlStripSlash($QsDepartment->department_name);?></option>
			<?php } 
		}
		else
		{ ?>
			<option value=""><?=$data['MER_Select_Department'];?></option>
		<?php }
    }
	//Search Employee Role
	public function searchemployeerole()
    {
		// Get search term 
		$organisation_id = $_REQUEST['organisation_id'];
		$sbu_id = $_REQUEST['sbu_id'];
		
		$QsEmployee = $this->admin->retrive_all_cond_data('*',tbl_employee,'is_delete="0" AND organisation_id = "'.$organisation_id.'" AND organisation_sbu_id = "'.$sbu_id.'"', 'id','DESC'); 
		// Generate array with skills data 
		$skillData = array(); 
		if(!empty($QsEmployee)){ 
			foreach($QsEmployee as $RsEmployee)
			{
				$data['id'] = $RsEmployee->id; 
				$data['value'] = $RsEmployee->employee_name; 
				array_push($skillData, $data); 
			} 
		} 
		 
		// Return results as json encoded array 
		echo json_encode($skillData); 
    }
}