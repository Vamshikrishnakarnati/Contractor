<?php namespace App\Controllers\CttAdmin;

use App\Models\Admin;
use App\Models\Adminvariable;

use CodeIgniter\Controller;

class Industry extends Controller
{
	public function __construct()
	{
		$this->admin = new Admin();
		$this->adminvars = new Adminvariable();
		$this->uri = new \CodeIgniter\HTTP\URI(current_url()); 
	}
		
	public function industrylisting()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			//print_r($_POST);exit;
			$data = $this->adminvars->variables(); //Admin Variable Load
			$industry_name = $this->request->getVar('industry_name'); 
			$data['QsIndustry'] = $this->admin->retrive_all_cond_data('*',tbl_industry,'is_delete="0" AND industry_name = "'.$industry_name.'"', 'id','DESC');
			
			echo view('ctt-admin/dashboard/head', $data);
			echo view('ctt-admin/dashboard/sidebar', $data);
			echo view('ctt-admin/adm-industry/adm-industry-listing', $data);
			echo view('ctt-admin/dashboard/footer', $data);
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Add offers
	public function addindustry()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			helper(['form', 'url']);
			if($this->request->getVar()) 
			{
				$industry_name = $this->request->getVar('industry_name'); 
				$data = [
					'industry_name' => $industry_name
					];
				//Insert form data
				$error_code = $this->admin->form_insert(tbl_industry,$data);
				if($error_code != '')
				{
					//Set error message if any error in SQL
					$error_msg = $this->admin->ErrorMessage($error_code, 'industry name', '','');
					$session = \Config\Services::session();
					$session->setFlashdata('error_msg', $error_msg);
					
					$data = $this->adminvars->variables(); //Admin Variable Load
					//Load Page
					
					echo view('ctt-admin/dashboard/head', $data);
					echo view('ctt-admin/dashboard/sidebar', $data);
					echo view('ctt-admin/adm-industry/adm-add-industry', $data);
					echo view('ctt-admin/dashboard/footer', $data);
					
				}
				else
				{
					//Set Flashdata session
					$session = \Config\Services::session();
					$session->setFlashdata('success_msg', MI_AddMsg);
					return redirect()->to( site_url('ctt-admin/industry-listing') );
				}
			}
			else
			{
				$data = $this->adminvars->variables(); //Admin Variable Load
				//Load Page
				echo view('ctt-admin/dashboard/head', $data);
				echo view('ctt-admin/dashboard/sidebar', $data);
				echo view('ctt-admin/adm-industry/adm-add-industry', $data);
				echo view('ctt-admin/dashboard/footer', $data);
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Edit Industry
	public function editindustry()
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
				$industry_name = $this->request->getVar('industry_name');
				$data = [
					'industry_name' => $industry_name,
					'updated_date' => date('Y-m-d'),
					];
				//Insert form data
				$error_code = $this->admin->form_update(tbl_industry,$data,'id',$id);
				if($error_code != '')
				{
					//Set error message if any error in SQL
					$error_msg = $this->admin->ErrorMessage($error_code, 'industry name', '','');
					$session = \Config\Services::session();
					$session->setFlashdata('error_msg', $error_msg);
					
					$data = $this->adminvars->variables(); //Admin Variable Load
					$data['EditData'] = $this->admin->getDataById(tbl_industry, 'id', $id);
					//Load Page
					$data['urisegment'] = $segment[2];
					echo view('ctt-admin/dashboard/head', $data);
					echo view('ctt-admin/dashboard/sidebar', $data);
					echo view('ctt-admin/adm-industry/adm-add-industry', $data);
					echo view('ctt-admin/dashboard/footer', $data);
					
				}
				else
				{
					//Set Flashdata session
					$session = \Config\Services::session();
					$session->setFlashdata('success_msg', MI_UpdateMsg);
					return redirect()->to( site_url('ctt-admin/industry-listing') );
				}
			}
			else
			{
				$data = $this->adminvars->variables(); //Admin Variable Load
				//Load Page
				$data['urisegment'] = $segment[2];
				$data['EditData'] = $this->admin->getDataById(tbl_industry, 'id', $id);
				echo view('ctt-admin/dashboard/head', $data);
				echo view('ctt-admin/dashboard/sidebar', $data);
				echo view('ctt-admin/adm-industry/adm-add-industry', $data);
				echo view('ctt-admin/dashboard/footer', $data);
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Delete Industry
	public function deleteindustry()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			$segmentRemove = array_filter($this->request->uri->getSegments());
			$segment = array_values($segmentRemove);
			$id = $segment[2];
			$data['delete_image'] = $this->admin->getDataById(tbl_industry, 'id', $id);
			$img_name = $data['delete_image']->offer_image;
			if($img_name){
				$data = $this->adminvars->variables(); 
				$prev_file_path = MI_ImagePath.$img_name;
				if(file_exists($prev_file_path))
				{
					unlink($prev_file_path);
				}
			}
			$error_code = $this->admin->deleteRow(tbl_industry,'id',$id);
			if($error_code != "")
			{
				//Set error message if any error in SQL
				$error_msg = $this->admin->ErrorMessage($error_code, 'industry name', '','');
				$session = \Config\Services::session();
				$session->setFlashdata('error_msg', $error_msg);
				return redirect()->to( site_url('ctt-admin/industry-listing') );
			}
			else
			{
				//Set Flashdata session
				$session = \Config\Services::session();
				$session->setFlashdata('success_msg', MI_DeleteMsg);
				return redirect()->to( site_url('ctt-admin/industry-listing') );
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Active Category
	public function activeindustry()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			$segmentRemove = array_filter($this->request->uri->getSegments());
			$segment = array_values($segmentRemove);
			$id = $segment[2];
			//Active form data
			$error_code = $this->admin->active_record(tbl_industry,$id);
			if($error_code != "")
			{
				//Set error message if any error in SQL
				$error_msg = $this->admin->ErrorMessage($error_code, 'industry name', '','');
				$session = \Config\Services::session();
				$session->setFlashdata('error_msg', $error_msg);
				return redirect()->to( site_url('ctt-admin/industry-listing') );
			}
			else
			{
				//Set Flashdata session
				$session = \Config\Services::session();
				$session->setFlashdata('success_msg', MI_ActiveMsg);
				return redirect()->to( site_url('ctt-admin/industry-listing') );
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Inactive Industry
	public function inactiveindustry()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			$segmentRemove = array_filter($this->request->uri->getSegments());
			$segment = array_values($segmentRemove);
			$id = $segment[2];
			//Inactive form data
			$error_code = $this->admin->inactive_record(tbl_industry,$id);
			if($error_code != "")
			{
				//Set error message if any error in SQL
				$error_msg = $this->admin->ErrorMessage($error_code, 'industry name', '','');
				$session = \Config\Services::session();
				$session->setFlashdata('error_msg', $error_msg);
				return redirect()->to( site_url('ctt-admin/industry-listing') );
			}
			else
			{
				//Set Flashdata session
				$session = \Config\Services::session();
				$session->setFlashdata('success_msg', MI_InactiveMsg);
				return redirect()->to( site_url('ctt-admin/industry-listing') );
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Search Industry
	public function searchindustry()
    {
		// Get search term 
		$industry_name = $_REQUEST['industry_name'];
		
		$QsIndustry = $this->admin->retrive_all_cond_data('*',tbl_industry,'is_delete="0" AND industry_name LIKE "%'.$industry_name.'%"', 'id','DESC'); 
		// Generate array with skills data 
		$skillData = array(); 
		if(!empty($QsIndustry)){ 
			foreach($QsIndustry as $RsIndustry)
			{
				$data['id'] = $RsIndustry->id; 
				$data['value'] = $RsIndustry->industry_name; 
				array_push($skillData, $data); 
			} 
		} 
		 
		// Return results as json encoded array 
		echo json_encode($skillData); 
    }
}