<?php namespace App\Controllers\CttAdmin;

use App\Models\Admin;
use App\Models\Adminvariable;

use CodeIgniter\Controller;

class Vendor extends Controller
{
	public function __construct()
	{
		$this->admin = new Admin();
		$this->adminvars = new Adminvariable();
		$this->uri = new \CodeIgniter\HTTP\URI(current_url()); 
	}
		
	public function vendorlisting()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			$data = $this->adminvars->variables(); //Admin Variable Load
			$company_name = $this->request->getVar('company_name'); 
			$data['QsVendor'] = $this->admin->retrive_all_cond_data('*',tbl_vendor,'is_delete="0" AND company_name = "'.$company_name.'"', 'id','DESC');
			
			echo view('ctt-admin/dashboard/head', $data);
			echo view('ctt-admin/dashboard/sidebar', $data);
			echo view('ctt-admin/adm-vendor/adm-vendor-listing', $data);
			echo view('ctt-admin/dashboard/footer', $data);
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Add vendor
	public function addvendor()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			helper(['form', 'url']);
			if($_POST) 
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
						$company_logo_new_name = $avatar->getRandomName();
						$avatar->move(MediaUpload. 'vendor/company_logo', $company_logo_new_name);
					}
				}
				
				$avatar_company_cin = $this->request->getFile('company_cin_no_file');
				if(!empty($avatar_company_cin) && $avatar_company_cin != '')
				{
					$validated_com_cin = $this->validate([
					'company_cin_no_file' => [
						'uploaded[company_cin_no_file]',
						'mime_in[company_cin_no_file,application/pdf,application/x-download,application/msword,application/vnd.ms-office]',
						'max_size[company_cin_no_file,4096]',
						],
					]);
					if($validated_com_cin) 
					{
						$company_cin_new_name = $avatar_company_cin->getRandomName();
						$avatar_company_cin->move(MediaUpload. 'vendor/company_cin', $company_cin_new_name);
					}
				}
				
				$avatar_company_gst = $this->request->getFile('company_gst_no_file');
				if(!empty($avatar_company_gst) && $avatar_company_gst != '')
				{
					$validated_com_gst = $this->validate([
					'company_gst_no_file' => [
						'uploaded[company_gst_no_file]',
						'mime_in[company_gst_no_file,application/pdf,application/x-download,application/msword,application/vnd.ms-office]',
						'max_size[company_gst_no_file,4096]',
						],
					]);
					
					if($validated_com_gst) 
					{
						$company_gst_new_name = $avatar_company_gst->getRandomName();
						$avatar_company_gst->move(MediaUpload. 'vendor/company_gst', $company_gst_new_name);
					}
				}
				
				$avatar_company_turn_over_one = $this->request->getFile('turn_over_one');
				if(!empty($avatar_company_turn_over_one) && $avatar_company_turn_over_one != '')
				{
					$validated_com_turn_over_one = $this->validate([
					'turn_over_one' => [
						'uploaded[turn_over_one]',
						'mime_in[turn_over_one,application/pdf,application/x-download,application/msword,application/vnd.ms-office]',
						'max_size[turn_over_one,4096]',
						],
					]);
					if($validated_com_turn_over_one) 
					{
						$company_turn_over_one_new_name = $avatar_company_turn_over_one->getRandomName();
						$avatar_company_turn_over_one->move(MediaUpload. 'vendor/company_turn_over', $company_turn_over_one_new_name);
					}
				}
				
				$avatar_company_turn_over_two = $this->request->getFile('turn_over_two');
				if(!empty($avatar_company_turn_over_two) && $avatar_company_turn_over_two != '')
				{
					$validated_com_turn_over_two = $this->validate([
					'turn_over_two' => [
						'uploaded[turn_over_two]',
						'mime_in[turn_over_two,application/pdf,application/x-download,application/msword,application/vnd.ms-office]',
						'max_size[turn_over_two,4096]',
						],
					]);
					if($validated_com_turn_over_two) 
					{
						$company_turn_over_two_new_name = $avatar_company_turn_over_two->getRandomName();
						$avatar_company_turn_over_two->move(MediaUpload. 'vendor/company_turn_over', $company_turn_over_two_new_name);
					}
				}
				
				$avatar_company_turn_over_three = $this->request->getFile('turn_over_three');
				if(!empty($avatar_company_turn_over_three) && $avatar_company_turn_over_three != '')
				{
					$validated_com_turn_over_three = $this->validate([
					'turn_over_three' => [
						'uploaded[turn_over_three]',
						'mime_in[turn_over_three,application/pdf,application/x-download,application/msword,application/vnd.ms-office]',
						'max_size[turn_over_three,4096]',
						],
					]);
					if($validated_com_turn_over_three) 
					{
						$company_turn_over_three_new_name = $avatar_company_turn_over_three->getRandomName();
						$avatar_company_turn_over_three->move(MediaUpload. 'vendor/company_turn_over', $company_turn_over_three_new_name);
					}
				}
				
				$company_name = $this->admin->HtmlAddSlash($_POST['company_name']);
				$phone_landline = $this->admin->HtmlAddSlash($_POST['phone_landline']);
				$phone_mobile = $this->admin->HtmlAddSlash($_POST['phone_mobile']); 
				$email = $this->admin->HtmlAddSlash($_POST['email']); 
				$address_corporate = $this->admin->HtmlAddSlash($_POST['address_corporate']); 
				$address_correspondence = $this->admin->HtmlAddSlash($_POST['address_correspondence']); 
				$single_contact_name = $this->admin->HtmlAddSlash($_POST['single_contact_name']); 
				$single_contact_phone = $this->admin->HtmlAddSlash($_POST['single_contact_phone']); 
				$single_contact_email = $this->admin->HtmlAddSlash($_POST['single_contact_email']); 
				$company_type = $this->admin->HtmlAddSlash($_POST['company_type']); 
				$cin_no = $this->admin->HtmlAddSlash($_POST['cin_no']); 
				$gst_no = $this->admin->HtmlAddSlash($_POST['gst_no']); 
				$industries_operating = $this->admin->HtmlAddSlash($_POST['industries_operating']); 
				$state_id  = implode(",", $_POST['state_id']); 
				$areas_of_expertise = $this->admin->HtmlAddSlash($_POST['areas_of_expertise']); 
				$ims_certifications = $this->admin->HtmlAddSlash($_POST['ims_certifications']); 
				$awards_recognitions = $this->admin->HtmlAddSlash($_POST['awards_recognitions']); 
				$technical_collaborations = $this->admin->HtmlAddSlash($_POST['technical_collaborations']); 
				$member_of_industry_association = $this->admin->HtmlAddSlash($_POST['member_of_industry_association']); 
				$turn_over_year_one = date("Y-m-d", strtotime($_POST['turn_over_year_one'])); 
				$turn_over_year_two = date("Y-m-d", strtotime($_POST['turn_over_year_two'])); 
				$turn_over_year_three = date("Y-m-d", strtotime($_POST['turn_over_year_three'])); 
				
				$data = [
					'company_name' => $company_name,
					'company_logo' =>  $company_logo_new_name,
					'phone_landline' => $phone_landline,
					'phone_mobile' => $phone_mobile,
					'email' => $email,
					'address_corporate' => $address_corporate,
					'address_correspondence' => $address_correspondence,
					'single_contact_name' => $single_contact_name,
					'single_contact_phone' => $single_contact_phone,
					'single_contact_email' => $single_contact_email,
					'company_type' => $company_type,
					'cin_no' => $cin_no,
					'company_cin_no_file' => $company_cin_new_name,
					'gst_no' => $gst_no,
					'company_gst_no_file' => $company_gst_new_name,
					'industries_operating' => $industries_operating,
					'state_id' => $state_id,
					'areas_of_expertise' => $areas_of_expertise,
					'ims_certifications' => $ims_certifications,
					'awards_recognitions' => $awards_recognitions,
					'technical_collaborations' => $technical_collaborations,
					'member_of_industry_association' => $member_of_industry_association,
					'turn_over_year_one' => $turn_over_year_one,
					'turn_over_year_two' => $turn_over_year_two,
					'turn_over_year_three' => $turn_over_year_three,
					'turn_over_one' => $company_turn_over_one_new_name,
					'turn_over_two' => $company_turn_over_two_new_name,
					'turn_over_three' => $company_turn_over_three_new_name,
					];
					
				$error_code = $this->admin->form_insert(tbl_vendor,$data);
				if($error_code != '')
				{
					//Set error message if any error in SQL
					$error_msg = $this->admin->ErrorMessage($error_code, 'vendor name', '','');
					$session = \Config\Services::session();
					$session->setFlashdata('error_msg', $error_msg);
					
					$data = $this->adminvars->variables(); //Admin Variable Load
					//Load Page
					
					echo view('ctt-admin/dashboard/head', $data);
					echo view('ctt-admin/dashboard/sidebar', $data);
					echo view('ctt-admin/adm-vendor/adm-add-vendor', $data);
					echo view('ctt-admin/dashboard/footer', $data);
					
				}
				else
				{
					$this->adminmail->VendorRegistrationSuccessfulPayment($admin_name,$admin_id,$admin_email,$admin_phone);
					//Set Flashdata session
					$session = \Config\Services::session();
					$session->setFlashdata('success_msg', MV_AddMsg);
					return redirect()->to( site_url('ctt-admin/vendor-listing') );
				}
			}
			else
			{
				$data = $this->adminvars->variables(); //Admin Variable Load
				//Load Page
				echo view('ctt-admin/dashboard/head', $data);
				echo view('ctt-admin/dashboard/sidebar', $data);
				echo view('ctt-admin/adm-vendor/adm-add-vendor', $data);
				echo view('ctt-admin/dashboard/footer', $data);
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Edit Category
	public function editvendor()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		$segmentRemove = array_filter($this->request->uri->getSegments());
		$segment = array_values($segmentRemove);
		if(!empty($adminId))
		{
			$id = $segment[2];
			if($_POST) 
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
						$company_logo_new_name = $avatar->getRandomName();
						$avatar->move(MediaUpload. 'vendor/company_logo', $company_logo_new_name);
					}
				}
				else
				{
					$company_logo_new_name = $this->admin->HtmlAddSlash($_POST['hidden_company_logo']);
				}
				$avatar_company_cin = $this->request->getFile('company_cin_no_file');
				//print_r($avatar_company_cin);exit;
				if(!empty($avatar_company_cin) && $avatar_company_cin != '')
				{
					//echo "asdfasd";exit;
					$validated_com_cin = $this->validate([
					'company_cin_no_file' => [
						'uploaded[company_cin_no_file]',
						'mime_in[company_cin_no_file,application/pdf,application/x-download,application/msword,application/vnd.ms-office]',
						'max_size[company_cin_no_file,4096]',
						],
					]);
					if($validated_com_cin) 
					{
						$company_cin_new_name = $avatar_company_cin->getRandomName();
						$avatar_company_cin->move(MediaUpload. 'vendor/company_cin', $company_cin_new_name);
					}
					
				}
				else
				{
					$company_cin_new_name = $this->admin->HtmlAddSlash($_POST['hidden_company_cin']);
				}
				
				$avatar_company_gst = $this->request->getFile('company_gst_no_file');
				if(!empty($avatar_company_gst) && $avatar_company_gst != '')
				{
					$validated_com_gst = $this->validate([
					'company_gst_no_file' => [
						'uploaded[company_gst_no_file]',
						'mime_in[company_gst_no_file,application/pdf,application/x-download,application/msword,application/vnd.ms-office]',
						'max_size[company_gst_no_file,4096]',
						],
					]);
					
					if($validated_com_gst) 
					{
						$company_gst_new_name = $avatar_company_gst->getRandomName();
						$avatar_company_gst->move(MediaUpload. 'vendor/company_gst', $company_gst_new_name);
					}
				}
				else
				{
					$company_gst_new_name = $this->admin->HtmlAddSlash($_POST['hidden_company_gst']);
				}
				
				$avatar_company_turn_over_one = $this->request->getFile('turn_over_one');
				if(!empty($avatar_company_turn_over_one) && $avatar_company_turn_over_one != '')
				{
					$validated_com_turn_over_one = $this->validate([
					'turn_over_one' => [
						'uploaded[turn_over_one]',
						'mime_in[turn_over_one,application/pdf,application/x-download,application/msword,application/vnd.ms-office]',
						'max_size[turn_over_one,4096]',
						],
					]);
					if($validated_com_turn_over_one) 
					{
						$company_turn_over_one_new_name = $avatar_company_turn_over_one->getRandomName();
						$avatar_company_turn_over_one->move(MediaUpload. 'vendor/company_turn_over', $company_turn_over_one_new_name);
					}
				}
				else
				{
					$company_turn_over_one_new_name = $this->admin->HtmlAddSlash($_POST['hidden_company_turn_over_one']);
				}
				
				$avatar_company_turn_over_two = $this->request->getFile('turn_over_two');
				if(!empty($avatar_company_turn_over_two) && $avatar_company_turn_over_two != '')
				{
					$validated_com_turn_over_two = $this->validate([
					'turn_over_two' => [
						'uploaded[turn_over_two]',
						'mime_in[turn_over_two,application/pdf,application/x-download,application/msword,application/vnd.ms-office]',
						'max_size[turn_over_two,4096]',
						],
					]);
					if($validated_com_turn_over_two) 
					{
						$company_turn_over_two_new_name = $avatar_company_turn_over_two->getRandomName();
						$avatar_company_turn_over_two->move(MediaUpload. 'vendor/company_turn_over', $company_turn_over_two_new_name);
					}
				}
				else
				{
					$company_turn_over_two_new_name = $this->admin->HtmlAddSlash($_POST['hidden_company_turn_over_two']);
				}
				
				$avatar_company_turn_over_three = $this->request->getFile('turn_over_three');
				if(!empty($avatar_company_turn_over_three) && $avatar_company_turn_over_three != '')
				{
					$validated_com_turn_over_two = $this->validate([
					'turn_over_three' => [
						'uploaded[turn_over_three]',
						'mime_in[turn_over_three,application/pdf,application/x-download,application/msword,application/vnd.ms-office]',
						'max_size[turn_over_three,4096]',
						],
					]);
					if($validated_com_turn_over_two) 
					{
						$company_turn_over_three_new_name = $avatar_company_turn_over_three->getRandomName();
						$avatar_company_turn_over_three->move(MediaUpload. 'vendor/company_turn_over', $company_turn_over_three_new_name);
					}
				}
				else
				{
					$company_turn_over_three_new_name = $this->admin->HtmlAddSlash($_POST['hidden_company_turn_over_three']);
				}
				
				
				$company_name = $this->admin->HtmlAddSlash($_POST['company_name']);
				$phone_landline = $this->admin->HtmlAddSlash($_POST['phone_landline']);
				$phone_mobile = $this->admin->HtmlAddSlash($_POST['phone_mobile']); 
				$email = $this->admin->HtmlAddSlash($_POST['email']); 
				$address_corporate = $this->admin->HtmlAddSlash($_POST['address_corporate']); 
				$address_correspondence = $this->admin->HtmlAddSlash($_POST['address_correspondence']); 
				$single_contact_name = $this->admin->HtmlAddSlash($_POST['single_contact_name']); 
				$single_contact_phone = $this->admin->HtmlAddSlash($_POST['single_contact_phone']); 
				$single_contact_email = $this->admin->HtmlAddSlash($_POST['single_contact_email']); 
				$company_type = $this->admin->HtmlAddSlash($_POST['company_type']); 
				$cin_no = $this->admin->HtmlAddSlash($_POST['cin_no']); 
				$gst_no = $this->admin->HtmlAddSlash($_POST['gst_no']); 
				$industries_operating = $this->admin->HtmlAddSlash($_POST['industries_operating']); 
				$state_id  = implode(",", $_POST['state_id']); 
				$areas_of_expertise = $this->admin->HtmlAddSlash($_POST['areas_of_expertise']); 
				$ims_certifications = $this->admin->HtmlAddSlash($_POST['ims_certifications']); 
				$awards_recognitions = $this->admin->HtmlAddSlash($_POST['awards_recognitions']); 
				$technical_collaborations = $this->admin->HtmlAddSlash($_POST['technical_collaborations']); 
				$member_of_industry_association = $this->admin->HtmlAddSlash($_POST['member_of_industry_association']); 
				$turn_over_year_one = date("Y-m-d", strtotime($_POST['turn_over_year_one'])); 
				$turn_over_year_two = date("Y-m-d", strtotime($_POST['turn_over_year_two'])); 
				$turn_over_year_three = date("Y-m-d", strtotime($_POST['turn_over_year_three'])); 
				
				$data = [
					'company_name' => $company_name,
					'company_logo' =>  $company_logo_new_name,
					'phone_landline' => $phone_landline,
					'phone_mobile' => $phone_mobile,
					'email' => $email,
					'address_corporate' => $address_corporate,
					'address_correspondence' => $address_correspondence,
					'single_contact_name' => $single_contact_name,
					'single_contact_phone' => $single_contact_phone,
					'single_contact_email' => $single_contact_email,
					'company_type' => $company_type,
					'cin_no' => $cin_no,
					'company_cin_no_file' => $company_cin_new_name,
					'gst_no' => $gst_no,
					'company_gst_no_file' => $company_gst_new_name,
					'industries_operating' => $industries_operating,
					'state_id' => $state_id,
					'areas_of_expertise' => $areas_of_expertise,
					'ims_certifications' => $ims_certifications,
					'awards_recognitions' => $awards_recognitions,
					'technical_collaborations' => $technical_collaborations,
					'member_of_industry_association' => $member_of_industry_association,
					'turn_over_year_one' => $turn_over_year_one,
					'turn_over_year_two' => $turn_over_year_two,
					'turn_over_year_three' => $turn_over_year_three,
					'turn_over_one' => $company_turn_over_one_new_name,
					'turn_over_two' => $company_turn_over_two_new_name,
					'turn_over_three' => $company_turn_over_three_new_name,
					'updated_date' => date('Y-m-d'),
					];
				//Insert form data
				$error_code = $this->admin->form_update(tbl_vendor,$data,'id',$id);
				if($error_code != '')
				{
					//Set error message if any error in SQL
					$error_msg = $this->admin->ErrorMessage($error_code, 'vendor name', '','');
					$session = \Config\Services::session();
					$session->setFlashdata('error_msg', $error_msg);
					
					$data = $this->adminvars->variables(); //Admin Variable Load
					$data['EditData'] = $this->admin->getDataById(tbl_vendor, 'id', $id);
					//Load Page
					$data['urisegment'] = $segment[2];
					echo view('ctt-admin/dashboard/head', $data);
					echo view('ctt-admin/dashboard/sidebar', $data);
					echo view('ctt-admin/adm-vendor/adm-add-vendor', $data);
					echo view('ctt-admin/dashboard/footer', $data);
					
				}
				else
				{
					//Set Flashdata session
					$session = \Config\Services::session();
					$session->setFlashdata('success_msg', MV_UpdateMsg);
					return redirect()->to( site_url('ctt-admin/vendor-listing') );
				}
			}
			else
			{
				$data = $this->adminvars->variables(); //Admin Variable Load
				//Load Page
				$data['urisegment'] = $segment[2];
				$data['EditData'] = $this->admin->getDataById(tbl_vendor, 'id', $id);
				echo view('ctt-admin/dashboard/head', $data);
				echo view('ctt-admin/dashboard/sidebar', $data);
				echo view('ctt-admin/adm-vendor/adm-add-vendor', $data);
				echo view('ctt-admin/dashboard/footer', $data);
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	
	public function deletevendor()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			$segmentRemove = array_filter($this->request->uri->getSegments());
			$segment = array_values($segmentRemove);
			$id = $segment[2];
			$data['delete_images'] = $this->admin->getDataById(tbl_vendor, 'id', $id);
			$companylogoname = $data['delete_images']->company_logo;
			$companycinname = $data['delete_images']->company_cin_no_file;
			$companygstname = $data['delete_images']->company_gst_no_file;
			$companyturnovername = $data['delete_images']->turn_over;
			
			if($companylogoname){
				$data = $this->adminvars->variables(); 
				$prev_file_path = MV_CompanyLogoImagePath.$companylogoname;
				if(file_exists($prev_file_path))
				{
					unlink($prev_file_path);
				}
			}

			if($companycinname){
				$data = $this->adminvars->variables(); 
				$prev_file_paths = MV_CompanyCinImagePath.$companycinname;
				if(file_exists($prev_file_paths))
				{
					unlink($prev_file_paths);
				}
			}
			if($companygstname){
				$data = $this->adminvars->variables(); 
				$prev_file_pats = MV_CompanyGstImagePath.$companygstname;
				if(file_exists($prev_file_pats))
				{
					unlink($prev_file_pats);
				}
			}
			if($companyturnovername){
				$data = $this->adminvars->variables(); 
				$prev_filse_pats = MV_CompanyTurnOverImagePath.$companyturnovername;
				if(file_exists($prev_filse_pats))
				{
					unlink($prev_filse_pats);
				}
			}
			$error_code = $this->admin->deleteRow(tbl_vendor,'id',$id);
			if($error_code != "")
			{
				//Set error message if any error in SQL
				$error_msg = $this->admin->ErrorMessage($error_code, 'vendor name', '','');
				$session = \Config\Services::session();
				$session->setFlashdata('error_msg', $error_msg);
				return redirect()->to( site_url('ctt-admin/vendor-listing') );
			}
			else
			{
				//Set Flashdata session
				$session = \Config\Services::session();
				$session->setFlashdata('success_msg', MV_DeleteMsg);
				return redirect()->to( site_url('ctt-admin/vendor-listing') );
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	
	public function DeleteCompanyLogo()
	{
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		$id = $_POST['id'];//Get Id From URL
		$data['delete_image'] = $this->admin->getDataById(tbl_vendor, 'id', $id);
		$img_name = $data['delete_image']->company_logo;
		if($img_name){
			$data = $this->adminvars->variables(); 
			$prev_file_path = MV_CompanyLogoImagePath.$img_name;
			if(file_exists($prev_file_path))
			{
				unlink($prev_file_path );
			}
		}
		//Delete Image From Folder
		$form_data = array(
			'company_logo'=> ''
		);
		
		$error_code = $this->admin->form_update(tbl_vendor,$form_data,'id',$id);
		?>
		<div class="mb-2">
			<input type="file" class="form-control-file" id="company_logo" name="company_logo" accept="image/png,image/jpg,image/jpeg" >
		</div>	
		<?php
	}
		
	public function DeleteCompanyCin()
	{
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		$id = $_POST['id'];//Get Id From URL
		$data['delete_image'] = $this->admin->getDataById(tbl_vendor, 'id', $id);
		$img_name = $data['delete_image']->company_cin_no_file;
		if($img_name){
			$data = $this->adminvars->variables(); 
			$prev_file_path = MV_CompanyCinImagePath.$img_name;
			if(file_exists($prev_file_path))
			{
				unlink($prev_file_path );
			}
		}
		$form_data = array(
			'company_cin_no_file'=> ''
		);
		
		$error_code = $this->admin->form_update(tbl_vendor,$form_data,'id',$id);
		?>
		<div class="mb-2">
			<input type="file" class="form-control-file" id="company_cin_no_file" name="company_cin_no_file" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
		</div>	
		<?php
	}
	
	public function DeleteCompanyGst()
	{
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		$id = $_POST['id'];//Get Id From URL
		$data['delete_image'] = $this->admin->getDataById(tbl_vendor, 'id', $id);
		$img_name = $data['delete_image']->company_gst_no_file;
		if($img_name) {
			$data = $this->adminvars->variables(); 
			$prev_file_path = MV_CompanyGstImagePath.$img_name;
			if(file_exists($prev_file_path))
			{
				unlink($prev_file_path );
			}
		}
		//Delete Image From Folder
		$form_data = array(
			'company_gst_no_file'=> ''
		);
		
		$error_code = $this->admin->form_update(tbl_vendor,$form_data,'id',$id);
		?>
		<div class="mb-2">
			<input type="file" class="form-control-file" id="company_gst_no_file" name="company_gst_no_file"  accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
		</div>	
		<?php
	}
	
	public function DeleteCompanyTurnOverOne()
	{
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		$id = $_POST['id'];//Get Id From URL
		$data['delete_image'] = $this->admin->getDataById(tbl_vendor, 'id', $id);
		$img_name = $data['delete_image']->turn_over_one;
		if($img_name){
			$data = $this->adminvars->variables(); 
			$prev_file_path = MV_CompanyTurnOverImagePath.$img_name;
			if(file_exists($prev_file_path))
			{
				unlink($prev_file_path );
			}
		}
		//Delete Image From Folder
		$form_data = array(
			'turn_over_one'=> ''
		);
		
		$this->admin->form_update(tbl_vendor,$form_data,'id',$id);
		?>
		<div class="mb-2">
			<input type="file" class="form-control-file" id="turn_over_one" name="turn_over_one" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
		</div>	
		<?php
	}
	
	public function DeleteCompanyTurnOverTwo()
	{
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		$id = $_POST['id'];//Get Id From URL
		$data['delete_image'] = $this->admin->getDataById(tbl_vendor, 'id', $id);
		$img_name = $data['delete_image']->turn_over_two;
		if($img_name){
			$data = $this->adminvars->variables(); 
			$prev_file_path = MV_CompanyTurnOverImagePath.$img_name;
			if(file_exists($prev_file_path))
			{
				unlink($prev_file_path );
			}
		}
		//Delete Image From Folder
		$form_data = array(
			'turn_over_two'=> ''
		);
		
		$this->admin->form_update(tbl_vendor,$form_data,'id',$id);
		?>
		<div class="mb-2">
			<input type="file" class="form-control-file" id="turn_over_two" name="turn_over_two" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
		</div>	
		<?php
	}
	
	public function DeleteCompanyTurnOverThree()
	{
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		$id = $_POST['id'];//Get Id From URL
		$data['delete_image'] = $this->admin->getDataById(tbl_vendor, 'id', $id);
		$img_name = $data['delete_image']->turn_over_three;
		if($img_name){
			$data = $this->adminvars->variables(); 
			$prev_file_path = MV_CompanyTurnOverImagePath.$img_name;
			if(file_exists($prev_file_path))
			{
				unlink($prev_file_path );
			}
		}
		//Delete Image From Folder
		$form_data = array(
			'turn_over_three'=> ''
		);
		
		$this->admin->form_update(tbl_vendor,$form_data,'id',$id);
		?>
		<div class="mb-2">
			<input type="file" class="form-control-file" id="turn_over_three" name="turn_over_three" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
		</div>	
		<?php
	}
	
	public function viewvendor()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			$segmentRemove = array_filter($this->request->uri->getSegments());
			$segment = array_values($segmentRemove);
			$id = $segment[2];
			$data = $this->adminvars->variables(); //Admin Variable Load
			$data['RsVendor'] = $this->admin->getDataById(tbl_vendor, 'id', $id);
			$data['RsStatename'] = $this->admin->getDataById(tbl_state, 'id', $data['RsVendor']->state_id);
			
			echo view('ctt-admin/dashboard/head', $data);
			echo view('ctt-admin/dashboard/sidebar', $data);
			echo view('ctt-admin/adm-vendor/adm-view-vendor', $data);
			echo view('ctt-admin/dashboard/footer', $data);
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	
	public function searchvendor()
    {
		$company_name = $_REQUEST['company_name'];
		
		$QsVendor = $this->admin->retrive_all_cond_data('*',tbl_vendor,'is_delete="0" AND company_name LIKE "%'.$company_name.'%"', 'id','DESC'); 
		$skillData = array(); 
		if(!empty($QsVendor)){ 
			foreach($QsVendor as $RsVendor)
			{
				$data['id'] = $RsVendor->id; 
				$data['value'] = $RsVendor->company_name; 
				array_push($skillData, $data); 
			} 
		} 
		echo json_encode($skillData); 
    }
}