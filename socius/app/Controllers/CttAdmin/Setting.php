<?php namespace App\Controllers\CttAdmin;

use App\Models\Admin;
use App\Models\Adminvariable;

use CodeIgniter\Controller;

class Setting extends Controller
{
	public function __construct()
	{
		$this->admin = new Admin();
		$this->adminvars = new Adminvariable();
		$this->uri = new \CodeIgniter\HTTP\URI(current_url()); 
	}
	
	 public function SettingListing()
    {
		$data = $this->adminvars->variables(); //Admin Variable Load
		$data['QsSetting'] = $this->admin->retrive_all_cond_data('*',tbl_setting,'is_active=1', 'id','ASC');
		//print_r($data['QsSetting']);
		//exit();
		
		//Load view Pages
		echo view('ctt-admin/dashboard/head', $data);
		echo view('ctt-admin/dashboard/sidebar', $data);
		echo view('ctt-admin/adm-setting/adm-setting-listing', $data);
		echo view('ctt-admin/dashboard/footer', $data);
    }
	 
	public function EditSetting()
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
				$parameter_value = $this->admin->HtmlAddSlash($_POST['parameter_value']);
				$data = [
						'parameter_value' => $parameter_value,
						'updated_date' => date('Y-m-d H:i:s')
					];
				//Insert form data
				$error_code = $this->admin->form_update(tbl_setting,$data,'id',$id);
				if($error_code != '')
				{
					//Set error message if any error in SQL
					$session->setFlashdata('error_msg', $error_code);
					
					$data = $this->adminvars->variables(); //Admin Variable Load
					//Load Page
					$data['urisegment'] = $segment[2];
					$data['EditData'] = $this->admin->getDataById(tbl_setting, 'id', $id);
					echo view('ctt-admin/dashboard/head', $data);
					echo view('ctt-admin/dashboard/sidebar', $data);
					echo view('ctt-admin/adm-setting/adm-add-setting', $data);
					echo view('ctt-admin/dashboard/footer', $data);
				}
				else
				{
					//Set Flashdata session
					$session->setFlashdata('success_msg', ST_UpdateMsg);
					return redirect()->to( site_url('ctt-admin/setting-listing') );
				} 
			}
			else
			{
				$data = $this->adminvars->variables(); //Admin Variable Load
				//Load Page
				$data['urisegment'] = $segment[2];
				$data['EditData'] = $this->admin->getDataById(tbl_setting, 'id', $id);
				echo view('ctt-admin/dashboard/head', $data);
				echo view('ctt-admin/dashboard/sidebar', $data);
				echo view('ctt-admin/adm-setting/adm-add-setting', $data);
				echo view('ctt-admin/dashboard/footer', $data);
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
	} 
	
}	
	

?>