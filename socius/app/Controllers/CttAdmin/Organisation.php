<?php namespace App\Controllers\CttAdmin;

use App\Models\Admin;
use App\Models\Adminvariable;

use CodeIgniter\Controller;

class Organisation extends Controller
{
	public function __construct()
	{
		$this->admin = new Admin();
		$this->adminvars = new Adminvariable();
		$this->uri = new \CodeIgniter\HTTP\URI(current_url()); 
	}
		
	public function organisationlisting()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			//print_r($_POST);exit;
			$data = $this->adminvars->variables(); //Admin Variable Load
			$company_name = $this->request->getVar('company_name'); 
			$data['QsOrganisation'] = $this->admin->retrive_all_cond_data('*',tbl_organisation,'is_delete="0" AND company_name = "'.$company_name.'"', 'id','DESC');
			
			echo view('ctt-admin/dashboard/head', $data);
			echo view('ctt-admin/dashboard/sidebar', $data);
			echo view('ctt-admin/adm-organisation/adm-organisation-listing', $data);
			echo view('ctt-admin/dashboard/footer', $data);
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Add offers
	public function addorganisation()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			//print_r($_POST);exit;
			helper(['form', 'url']);
			if($this->request->getVar()) 
			{
				$validated = $this->validate([
					'company_logo' => [
						'uploaded[company_logo]',
						'mime_in[company_logo,image/jpg,image/jpeg,image/gif,image/png]',
						'max_size[company_logo,4096]',
					],
				]);
				
				$company_name = $this->admin->HtmlAddSlash($_POST['company_name']); 
				$landline = $this->admin->HtmlAddSlash($_POST['landline']); 
				$mobile = $this->admin->HtmlAddSlash($_POST['mobile']); 
				$corporate_address = $this->admin->HtmlAddSlash($_POST['corporate_address']); 
				$correspondence_address = $this->admin->HtmlAddSlash($_POST['correspondence_address']); 
				$email = $this->admin->HtmlAddSlash($_POST['email']); 
				$contact_name = $this->admin->HtmlAddSlash($_POST['contact_name']); 
				$contact_mobile = $this->admin->HtmlAddSlash($_POST['contact_mobile']); 
				$contact_email = $this->admin->HtmlAddSlash($_POST['contact_email']); 
				$company_type = $this->admin->HtmlAddSlash($_POST['company_type']); 
				$organisation_id = $this->admin->HtmlAddSlash($_POST['organisation_id']); 
				$industry_id = $_POST['industry_id']; 
				
				if($validated) 
				{
					$avatar = $this->request->getFile('company_logo');
					$newName = $avatar->getRandomName();
					
					$data = [
					'company_name' => $company_name,
					'company_logo' => $newName,
					'landline' => $landline,
					'mobile' => $mobile,
					'email' => $email,
					'corporate_address' => $corporate_address,
					'correspondence_address' =>  $correspondence_address,
					'contact_name' =>  $contact_name,
					'contact_mobile' =>  $contact_mobile,
					'contact_email' =>  $contact_email,
					'company_type' =>  $company_type,
					'industry_id' =>  $industry_id,
					'organisation_id' =>  $organisation_id
					];
					//print_r($data);exit;
					//Insert form data
					$last_insert_id = $this->admin->form_insert_id(tbl_organisation,$data);
					$db      = \Config\Database::connect();
					$error_code = $db->error();
				}
				if($error_code['code'] != '0')
				{
					//Set error message if any error in SQL
					$error_msg = $this->admin->ErrorMessage($error_code, 'Company Name', '','');
					$session = \Config\Services::session();
					$session->setFlashdata('error_msg', $error_msg);
					
					$data = $this->adminvars->variables(); //Admin Variable Load
					//Load Page
					
					echo view('ctt-admin/dashboard/head', $data);
					echo view('ctt-admin/dashboard/sidebar', $data);
					echo view('ctt-admin/adm-organisation/adm-add-organisation', $data);
					echo view('ctt-admin/dashboard/footer', $data);
					
				}
				else
				{
					$avatar->move(MediaUpload. 'company_logo', $newName);
					$Div_count = $_POST['divs'];
					$InsertData = explode(",",$Div_count);
					foreach($InsertData as $SizeData)
					{
						$sbu_name = $_POST['sbu_name_'.$SizeData];
						$location = $_POST['location_'.$SizeData];
						
						$sbu_data = [
						'company_id' => $last_insert_id,
						'sbu_name' => $sbu_name,
						'location' => $location
						];
						$this->admin->form_insert(tbl_sbu,$sbu_data);
					}
					//Set Flashdata session
					$session = \Config\Services::session();
					$session->setFlashdata('success_msg', MO_AddMsg);
					return redirect()->to( site_url('ctt-admin/organisation-listing') );
				}
			}
			else
			{
				$data = $this->adminvars->variables(); //Admin Variable Load
				//Load Page
				echo view('ctt-admin/dashboard/head', $data);
				echo view('ctt-admin/dashboard/sidebar', $data);
				echo view('ctt-admin/adm-organisation/adm-add-organisation', $data);
				echo view('ctt-admin/dashboard/footer', $data);
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	public function AddMoreOrganisation()
	{
		$data = $this->adminvars->variables();
		$DivId = $_POST['div_name'];
		?>
		<div class="row" id="set_<?php echo $DivId; ?>">
			<div class="form-group col-md-5">
				<label class="control-label" for="sbu_name_<?php echo $DivId; ?>"><?=$data['MO_SBU_Name'];?> <span class="text-danger"></span></label>
				<div class="mb-2">
					<input type="text" class="form-control" id="sbu_name_<?php echo $DivId; ?>" name="sbu_name_<?php echo $DivId; ?>" placeholder="Enter SBU Name" maxlength="50"/>
				</div>
			</div>
			<div class="form-group col-md-5">
				<label class="control-label" for="location_<?php echo $DivId; ?>"><?=$data['MO_Location'];?> <span class="text-danger"></span></label>
				<div class="mb-2">
					<input type="text" class="form-control" id="location_<?php echo $DivId; ?>" name="location_<?php echo $DivId; ?>" placeholder="Enter Location" maxlength="100"/>
				</div>
			</div>
			<div class="col-md-2">
				<label class="control-label" style="color: #fff;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
				<button type="button" onclick="return removerow('<?php echo $DivId; ?>');" class="btn btn-danger add_button" name="btn_submit" >- Remove</button>
			</div>
		</div>
		
		<?php
	}
	//Edit Industry
	public function editOrganisation()
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
				$avatar = $this->request->getFile('company_logo');
				if(!empty($avatar) && $avatar != '')
				{
					$validated = $this->validate([
						'company_logo' => [
							'uploaded[company_logo]',
							'mime_in[company_logo,image/jpg,image/jpeg,image/gif,image/png]',
							'max_size[company_logo,4096]',
						],
					]);
					if($validated) 
					{
						$newName = $avatar->getRandomName();
						$avatar->move(MediaUpload. 'company_logo', $newName);
					}
				}
				else
				{
					$newName = $this->request->getVar('hidden_image');
				}
				$company_name = $this->admin->HtmlAddSlash($_POST['company_name']); 
				$landline = $this->admin->HtmlAddSlash($_POST['landline']); 
				$mobile = $this->admin->HtmlAddSlash($_POST['mobile']); 
				$corporate_address = $this->admin->HtmlAddSlash($_POST['corporate_address']); 
				$correspondence_address = $this->admin->HtmlAddSlash($_POST['correspondence_address']); 
				$email = $this->admin->HtmlAddSlash($_POST['email']); 
				$contact_name = $this->admin->HtmlAddSlash($_POST['contact_name']); 
				$contact_mobile = $this->admin->HtmlAddSlash($_POST['contact_mobile']); 
				$contact_email = $this->admin->HtmlAddSlash($_POST['contact_email']); 
				$company_type = $this->admin->HtmlAddSlash($_POST['company_type']); 
				$organisation_id = $this->admin->HtmlAddSlash($_POST['organisation_id']); 
				$industry_id = $_POST['industry_id'];
				$data = [
					'company_name' => $company_name,
					'company_logo' => $newName,
					'landline' => $landline,
					'mobile' => $mobile,
					'email' => $email,
					'corporate_address' => $corporate_address,
					'correspondence_address' =>  $correspondence_address,
					'contact_name' =>  $contact_name,
					'contact_mobile' =>  $contact_mobile,
					'contact_email' =>  $contact_email,
					'company_type' =>  $company_type,
					'industry_id' =>  $industry_id,
					'organisation_id' =>  $organisation_id
					];
				//Insert form data
				$error_code = $this->admin->form_update(tbl_organisation,$data,'id',$id);
				if($error_code != '')
				{
					//Set error message if any error in SQL
					$error_msg = $this->admin->ErrorMessage($error_code, 'organisation name', '','');
					$session = \Config\Services::session();
					$session->setFlashdata('error_msg', $error_msg);
					
					$data = $this->adminvars->variables(); //Admin Variable Load
					$data['EditData'] = $this->admin->getDataById(tbl_organisation, 'id', $id);
					//Load Page
					$data['urisegment'] = $segment[2];
					echo view('ctt-admin/dashboard/head', $data);
					echo view('ctt-admin/dashboard/sidebar', $data);
					echo view('ctt-admin/adm-organisation/adm-add-organisation', $data);
					echo view('ctt-admin/dashboard/footer', $data);
					
				}
				else
				{
					$DeleteSBU = $this->admin->retrive_all_cond_data('*',tbl_sbu,"is_delete='0' AND company_id='".$id."'", 'id','DESC');
					foreach($DeleteSBU as $RsDeleteSBU)
					{
						$this->admin->deleteRow(tbl_sbu,'company_id',$RsDeleteSBU->id);
					}
					$Div_count = $_POST['divs'];
					$InsertData = explode(",",$Div_count);
					foreach($InsertData as $SizeData)
					{
						$sbu_name = $_POST['sbu_name_'.$SizeData];
						$location = $_POST['location_'.$SizeData];
						
						$sbu_data = [
						'company_id' => $id,
						'sbu_name' => $sbu_name,
						'location' => $location
						];
						$this->admin->form_insert(tbl_sbu,$sbu_data);
					}
					//Set Flashdata session
					$session = \Config\Services::session();
					$session->setFlashdata('success_msg', MO_UpdateMsg);
					return redirect()->to( site_url('ctt-admin/organisation-listing') );
				}
			}
			else
			{
				$data = $this->adminvars->variables(); //Admin Variable Load
				//Load Page
				$data['urisegment'] = $segment[2];
				$data['EditData'] = $this->admin->getDataById(tbl_organisation, 'id', $id);
				$data['QsSBU'] = $this->admin->retrive_all_cond_data('*',tbl_sbu,"is_delete='0' AND company_id='".$id."'", 'id','ASC');
				echo view('ctt-admin/dashboard/head', $data);
				echo view('ctt-admin/dashboard/sidebar', $data);
				echo view('ctt-admin/adm-organisation/adm-add-organisation', $data);
				echo view('ctt-admin/dashboard/footer', $data);
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Delete Organisation
	public function deleteorganisation()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			$segmentRemove = array_filter($this->request->uri->getSegments());
			$segment = array_values($segmentRemove);
			$id = $segment[2];
			$this->admin->deleteRow(tbl_sbu,'company_id',$id);
			$data['delete_image'] = $this->admin->getDataById(tbl_organisation, 'id', $id);
			$img_name = $data['delete_image']->company_logo;
			if($img_name){
				$data = $this->adminvars->variables(); 
				$prev_file_path = MO_ImagePath.$img_name;
				if(file_exists($prev_file_path))
				{
					unlink($prev_file_path);
				}
			}
			$error_code = $this->admin->deleteRow(tbl_organisation,'id',$id);
			if($error_code != "")
			{
				//Set error message if any error in SQL
				$error_msg = $this->admin->ErrorMessage($error_code, 'organisation name', '','');
				$session = \Config\Services::session();
				$session->setFlashdata('error_msg', $error_msg);
				return redirect()->to( site_url('ctt-admin/organisation-listing') );
			}
			else
			{
				//Set Flashdata session
				$session = \Config\Services::session();
				$session->setFlashdata('success_msg', MO_DeleteMsg);
				return redirect()->to( site_url('ctt-admin/organisation-listing') );
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Active Category
	public function activeorganisation()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			$segmentRemove = array_filter($this->request->uri->getSegments());
			$segment = array_values($segmentRemove);
			$id = $segment[2];
			//Active form data
			$error_code = $this->admin->active_record(tbl_organisation,$id);
			if($error_code != "")
			{
				//Set error message if any error in SQL
				$error_msg = $this->admin->ErrorMessage($error_code, 'organisation name', '','');
				$session = \Config\Services::session();
				$session->setFlashdata('error_msg', $error_msg);
				return redirect()->to( site_url('ctt-admin/organisation-listing') );
			}
			else
			{
				//Set Flashdata session
				$session = \Config\Services::session();
				$session->setFlashdata('success_msg', MO_ActiveMsg);
				return redirect()->to( site_url('ctt-admin/organisation-listing') );
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Inactive Industry
	public function inactiveorganisation()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			$segmentRemove = array_filter($this->request->uri->getSegments());
			$segment = array_values($segmentRemove);
			$id = $segment[2];
			//Inactive form data
			$error_code = $this->admin->inactive_record(tbl_organisation,$id);
			if($error_code != "")
			{
				//Set error message if any error in SQL
				$error_msg = $this->admin->ErrorMessage($error_code, 'organisation name', '','');
				$session = \Config\Services::session();
				$session->setFlashdata('error_msg', $error_msg);
				return redirect()->to( site_url('ctt-admin/organisation-listing') );
			}
			else
			{
				//Set Flashdata session
				$session = \Config\Services::session();
				$session->setFlashdata('success_msg', MO_InactiveMsg);
				return redirect()->to( site_url('ctt-admin/organisation-listing') );
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Search Industry
	public function searchorganisation()
    {
		// Get search term 
		$company_name = $_REQUEST['company_name'];
		
		$QsOrganisation = $this->admin->retrive_all_cond_data('*',tbl_organisation,'is_delete="0" AND company_name LIKE "%'.$company_name.'%"', 'id','DESC'); 
		// Generate array with skills data 
		$skillData = array(); 
		if(!empty($QsOrganisation)){ 
			foreach($QsOrganisation as $RsOrganisation)
			{
				$data['id'] = $RsOrganisation->id; 
				$data['value'] = $RsOrganisation->company_name; 
				array_push($skillData, $data); 
			} 
		} 
		 
		// Return results as json encoded array 
		echo json_encode($skillData); 
    }
	// Function for Delete Image
	public function deleteimage()
	{
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		$id = $_POST['id'];//Get Id From URL
		$data['delete_image'] = $this->admin->getDataById(tbl_organisation, 'id', $id);
		$img_name = $data['delete_image']->company_logo;
		if($img_name){
			$data = $this->adminvars->variables(); 
			$prev_file_path = MO_ImagePath.$img_name;
			
			if(file_exists($prev_file_path))
			{
				unlink($prev_file_path );
			}
		}
		//Delete Image From Folder
		$form_data = array(
			'company_logo'=> ''
		);
		
		$error_code = $this->admin->form_update(tbl_organisation,$form_data,'id',$id);
		?>
		<div class="mb-2">
			<input type="file" class="form-control" id="company_logo" name="company_logo" accept="image/png,image/jpg,image/jpeg">
		</div>	
		<?php
	}
}