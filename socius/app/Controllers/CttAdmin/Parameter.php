<?php namespace App\Controllers\CttAdmin;

use App\Models\Admin;
use App\Models\Adminvariable;

use CodeIgniter\Controller;

class Parameter extends Controller
{
	public function __construct()
	{
		$this->admin = new Admin();
		$this->adminvars = new Adminvariable();
		$this->uri = new \CodeIgniter\HTTP\URI(current_url()); 
	}
	
	public function ParameterListing()
    {
		$session = \Config\Services::session();
		$data = $this->adminvars->variables();
		$adminId = $session->get('adminId');

		if(!empty($adminId))
		{
			$data['QsParameter'] = $this->admin->retrive_all_cond_data('*',tbl_parameter,'is_active= 1', 'id','ASC');
			$uri = explode('/',$_SERVER['REQUEST_URI']);
			//Load view Pages
			echo view('ctt-admin/dashboard/head', $data);
			echo view('ctt-admin/dashboard/sidebar', $data);
			echo view('ctt-admin/adm-parameter/adm-parameter-listing', $data);
			echo view('ctt-admin/dashboard/footer', $data);
		}	
    }
	
	public function EditParameter()
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
				$parameter_name = $this->admin->HtmlAddSlash($_POST['parameter_name']);
				$data = [
						'parameter_name' => $parameter_name,
						'updated_date' => date('Y-m-d H:i:s')
					];
				//Insert form data
				$error_code = $this->admin->form_update(tbl_parameter,$data,'id',$id);
				if($error_code != '')
				{
					//Set error message if any error in SQL
					$session->setFlashdata('error_msg', $error_code);
					
					$data = $this->adminvars->variables(); //Admin Variable Load
					//Load Page
					$data['urisegment'] = $segment[2];
					$data['EditData'] = $this->admin->getDataById(tbl_parameter, 'id', $id);
					echo view('ctt-admin/dashboard/head', $data);
					echo view('ctt-admin/dashboard/sidebar', $data);
					echo view('ctt-admin/adm-parameter/adm-add-parameter', $data);
					echo view('ctt-admin/dashboard/footer', $data);
				}
				else
				{
					//Set Flashdata session
					$session->setFlashdata('success_msg', MP_UpdateMsg);
					return redirect()->to( site_url('ctt-admin/parameter-listing'));
				} 
			}
			else
			{
				$data = $this->adminvars->variables(); //Admin Variable Load
				//Load Page
				$data['urisegment'] = $segment[2];
				$data['EditData'] = $this->admin->getDataById(tbl_parameter, 'id', $id);
				echo view('ctt-admin/dashboard/head', $data);
				echo view('ctt-admin/dashboard/sidebar', $data);
				echo view('ctt-admin/adm-parameter/adm-add-parameter', $data);
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