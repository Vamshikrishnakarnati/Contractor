<?php namespace App\Controllers\CttAdmin;

use App\Models\Admin;
use App\Models\Adminvariable;

use CodeIgniter\Controller;

class Contract extends Controller
{
	public function __construct()
	{
		$this->admin = new Admin();
		$this->adminvars = new Adminvariable();
		$this->uri = new \CodeIgniter\HTTP\URI(current_url()); 
	}
		
	public function contractlisting()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			//print_r($_POST);exit;
			$data = $this->adminvars->variables(); //Admin Variable Load
			$contract_type = $this->request->getVar('contract_type'); 
			$data['QsContract'] = $this->admin->retrive_all_cond_data('*',tbl_contract,'is_delete="0" AND contract_type = "'.$contract_type.'"', 'id','DESC');
			
			echo view('ctt-admin/dashboard/head', $data);
			echo view('ctt-admin/dashboard/sidebar', $data);
			echo view('ctt-admin/adm-contract/adm-contract-listing', $data);
			echo view('ctt-admin/dashboard/footer', $data);
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Add offers
	public function addcontract()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			helper(['form', 'url']);
			if($this->request->getVar()) 
			{
				$contract_type = $this->request->getVar('contract_type'); 
				$data = [
					'contract_type' => $contract_type
					];
				//Insert form data
				$error_code = $this->admin->form_insert(tbl_contract,$data);
				if($error_code != '')
				{
					//Set error message if any error in SQL
					$error_msg = $this->admin->ErrorMessage($error_code, 'contract name', '','');
					$session = \Config\Services::session();
					$session->setFlashdata('error_msg', $error_msg);
					
					$data = $this->adminvars->variables(); //Admin Variable Load
					//Load Page
					
					echo view('ctt-admin/dashboard/head', $data);
					echo view('ctt-admin/dashboard/sidebar', $data);
					echo view('ctt-admin/adm-contract/adm-add-contract', $data);
					echo view('ctt-admin/dashboard/footer', $data);
					
				}
				else
				{
					//Set Flashdata session
					$session = \Config\Services::session();
					$session->setFlashdata('success_msg', MC_AddMsg);
					return redirect()->to( site_url('ctt-admin/contract-listing') );
				}
			}
			else
			{
				$data = $this->adminvars->variables(); //Admin Variable Load
				//Load Page
				echo view('ctt-admin/dashboard/head', $data);
				echo view('ctt-admin/dashboard/sidebar', $data);
				echo view('ctt-admin/adm-contract/adm-add-contract', $data);
				echo view('ctt-admin/dashboard/footer', $data);
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Edit Contract
	public function editcontract()
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
				$contract_type = $this->request->getVar('contract_type');
				$data = [
					'contract_type' => $contract_type,
					'updated_date' => date('Y-m-d'),
					];
				//Insert form data
				$error_code = $this->admin->form_update(tbl_contract,$data,'id',$id);
				if($error_code != '')
				{
					//Set error message if any error in SQL
					$error_msg = $this->admin->ErrorMessage($error_code, 'contract name', '','');
					$session = \Config\Services::session();
					$session->setFlashdata('error_msg', $error_msg);
					
					$data = $this->adminvars->variables(); //Admin Variable Load
					$data['EditData'] = $this->admin->getDataById(tbl_contract, 'id', $id);
					//Load Page
					$data['urisegment'] = $segment[2];
					echo view('ctt-admin/dashboard/head', $data);
					echo view('ctt-admin/dashboard/sidebar', $data);
					echo view('ctt-admin/adm-contract/adm-add-contract', $data);
					echo view('ctt-admin/dashboard/footer', $data);
					
				}
				else
				{
					//Set Flashdata session
					$session = \Config\Services::session();
					$session->setFlashdata('success_msg', MC_UpdateMsg);
					return redirect()->to( site_url('ctt-admin/contract-listing') );
				}
			}
			else
			{
				$data = $this->adminvars->variables(); //Admin Variable Load
				//Load Page
				$data['urisegment'] = $segment[2];
				$data['EditData'] = $this->admin->getDataById(tbl_contract, 'id', $id);
				echo view('ctt-admin/dashboard/head', $data);
				echo view('ctt-admin/dashboard/sidebar', $data);
				echo view('ctt-admin/adm-contract/adm-add-contract', $data);
				echo view('ctt-admin/dashboard/footer', $data);
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Delete Contract
	public function deletecontract()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			$segmentRemove = array_filter($this->request->uri->getSegments());
			$segment = array_values($segmentRemove);
			$id = $segment[2];
			$error_code = $this->admin->deleteRow(tbl_contract,'id',$id);
			if($error_code != "")
			{
				//Set error message if any error in SQL
				$error_msg = $this->admin->ErrorMessage($error_code, 'contract name', '','');
				$session = \Config\Services::session();
				$session->setFlashdata('error_msg', $error_msg);
				return redirect()->to( site_url('ctt-admin/contract-listing') );
			}
			else
			{
				//Set Flashdata session
				$session = \Config\Services::session();
				$session->setFlashdata('success_msg', MC_DeleteMsg);
				return redirect()->to( site_url('ctt-admin/contract-listing') );
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Active Category
	public function activecontract()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			$segmentRemove = array_filter($this->request->uri->getSegments());
			$segment = array_values($segmentRemove);
			$id = $segment[2];
			//Active form data
			$error_code = $this->admin->active_record(tbl_contract,$id);
			if($error_code != "")
			{
				//Set error message if any error in SQL
				$error_msg = $this->admin->ErrorMessage($error_code, 'contract name', '','');
				$session = \Config\Services::session();
				$session->setFlashdata('error_msg', $error_msg);
				return redirect()->to( site_url('ctt-admin/contract-listing') );
			}
			else
			{
				//Set Flashdata session
				$session = \Config\Services::session();
				$session->setFlashdata('success_msg', MC_ActiveMsg);
				return redirect()->to( site_url('ctt-admin/contract-listing') );
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Inactive Contract
	public function inactivecontract()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			$segmentRemove = array_filter($this->request->uri->getSegments());
			$segment = array_values($segmentRemove);
			$id = $segment[2];
			//Inactive form data
			$error_code = $this->admin->inactive_record(tbl_contract,$id);
			if($error_code != "")
			{
				//Set error message if any error in SQL
				$error_msg = $this->admin->ErrorMessage($error_code, 'contract name', '','');
				$session = \Config\Services::session();
				$session->setFlashdata('error_msg', $error_msg);
				return redirect()->to( site_url('ctt-admin/contract-listing') );
			}
			else
			{
				//Set Flashdata session
				$session = \Config\Services::session();
				$session->setFlashdata('success_msg', MC_InactiveMsg);
				return redirect()->to( site_url('ctt-admin/contract-listing') );
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Search Contract
	public function searchcontract()
    {
		// Get search term 
		$contract_type = $_REQUEST['contract_type'];
		
		$QsContract = $this->admin->retrive_all_cond_data('*',tbl_contract,'is_delete="0" AND contract_type LIKE "%'.$contract_type.'%"', 'id','DESC'); 
		// Generate array with skills data 
		$skillData = array(); 
		if(!empty($QsContract)){ 
			foreach($QsContract as $RsContract)
			{
				$data['id'] = $RsContract->id; 
				$data['value'] = $RsContract->contract_type; 
				array_push($skillData, $data); 
			} 
		} 
		 
		// Return results as json encoded array 
		echo json_encode($skillData); 
    }
}