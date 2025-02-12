<?php namespace App\Controllers\CttAdmin;

use App\Models\Admin;
use App\Models\Adminvariable;

use CodeIgniter\Controller;

class Sbu extends Controller
{
	public function __construct()
	{
		$this->admin = new Admin();
		$this->adminvars = new Adminvariable();
		$this->uri = new \CodeIgniter\HTTP\URI(current_url()); 
	}
		
	public function sbulisting()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			$data = $this->adminvars->variables(); //Admin Variable Load
			$sbu_id = $this->request->getVar('sbu_name'); 
			$data['QsSbu'] = $this->admin->retrive_all_cond_data('*',tbl_sbu,'is_delete="0" AND sbu_name = "'.$sbu_id .'"', 'id','DESC');
			
			echo view('ctt-admin/dashboard/head', $data);
			echo view('ctt-admin/dashboard/sidebar', $data);
			echo view('ctt-admin/adm-sbu/adm-sbu-listing', $data);
			echo view('ctt-admin/dashboard/footer', $data);
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	
	public function addsbu()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			helper(['form', 'url']);
			if($this->request->getVar()) 
			{
				$company_id = $this->admin->HtmlAddSlash($_POST['company_id']); 
				$sbu_id = $this->admin->HtmlAddSlash($_POST['sbu_id']); 
				$land_line = $this->admin->HtmlAddSlash($_POST['land_line']); 
				$mobile = $this->admin->HtmlAddSlash($_POST['mobile']); 
				$email = $this->admin->HtmlAddSlash($_POST['email']); 
				$corporate_address = $this->admin->HtmlAddSlash($_POST['corporate_address']); 
				$correspondence_address = $this->admin->HtmlAddSlash($_POST['correspondence_address']); 
				$contact_name = $this->admin->HtmlAddSlash($_POST['contact_name']); 
				$contact_phone = $this->admin->HtmlAddSlash($_POST['contact_phone']); 
				$contact_email = $this->admin->HtmlAddSlash($_POST['contact_email']); 
				
				$datasbu = [
				'land_line' => $land_line,
				'mobile' => $mobile,
				'corporate_address' => $corporate_address,
				'correspondence_address' => $correspondence_address,
				'contact_name' => $contact_name,
				'contact_phone' =>  $contact_phone,
				'contact_email' =>  $contact_email,
				];
				$error_code = $this->admin->form_update(tbl_sbu,$datasbu,'id',$sbu_id);
				$last_insert_id = $sbu_id;
				
				$db      = \Config\Database::connect();
				$error_code = $db->error();
				$avatar = $this->request->getFile('vendor_master');
				if(!empty($avatar) && $avatar != "")
				{
					$validated = $this->validate([
					'vendor_master' => [
						'uploaded[vendor_master]',
						'mime_in[vendor_master,application/csv,application/excel,application/vnd.msexcel,application/vnd.ms-excel,application/x-csv,application/xls,application/x-xls,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,text/csv,text/x-comma-separated-values,text/comma-separated-values,text/x-csv,application/vnd.msexcel,text/plain]',
						'max_size[vendor_master,4096]',
						],
					]);
					if($validated) 
					{
						$newName = $avatar->getRandomName();
						$avatar->move(MediaUpload. 'vendor_master', $newName);
						$file = fopen(MediaUpload. 'vendor_master/'.$newName,"r");
						$i = 0;
						$numberOfFields = 2; 
						$importData_arr = array();
						while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
						$num = count($filedata);
						if($i > 0 && $num == $numberOfFields){ 
							$importData_arr[$i]['id'] = "";
							$importData_arr[$i]['sbu_id'] = $last_insert_id;
							$importData_arr[$i]['vendor_name'] = $filedata[0];
							$importData_arr[$i]['vendor_email'] = $filedata[1];
						}
						$i++;
						}
						fclose($file);
						$count = 0;
						foreach($importData_arr as $userdata)
						{
							$this->admin->form_insert(tbl_vendor_master,$userdata);
						}
					}
				} 
				$avatar_emp = $this->request->getFile('employee_master');
				if(!empty($avatar_emp) && $avatar_emp != "")
				{
					$validated_employeemaster = $this->validate([
					'employee_master' => [
						'uploaded[employee_master]',
						'mime_in[employee_master,application/csv,application/excel,application/vnd.msexcel,application/vnd.ms-excel,application/x-csv,application/xls,application/x-xls,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,text/csv,text/x-comma-separated-values,text/comma-separated-values,text/x-csv,application/vnd.msexcel,text/plain]',
						'max_size[employee_master,4096]',
						],
					]);
				
					$newName_emp = $avatar_emp->getRandomName();
					if($validated_employeemaster) 
					{
						$avatar_emp->move(MediaUpload. 'employee_master', $newName_emp);
						$file_emp = fopen(MediaUpload. 'employee_master/'.$newName_emp,"r");
						$j = 0;
						$numberOfFields = 2; 
						$importData_arr_emp = array();
						while (($filedata_emp = fgetcsv($file_emp, 1000, ",")) !== FALSE) {
						$num = count($filedata_emp);
						if($j > 0 && $num == $numberOfFields){ 
							$importData_arr_emp[$j]['id'] = "";
							$importData_arr_emp[$j]['organisation_id'] = $company_id;
							$importData_arr_emp[$j]['organisation_sbu_id'] = $last_insert_id;
							$importData_arr_emp[$j]['employee_name'] = $filedata_emp[0];
							$importData_arr_emp[$j]['employee_email'] = $filedata_emp[1];
						}
						$j++;
						}
						fclose($file_emp);
						$count = 0;
						foreach($importData_arr_emp as $empdata)
						{
							$this->admin->form_insert(tbl_employee,$empdata);
						}
					}
				}	
				if($error_code['code'] != '0')
				{
					$error_msg = $this->admin->ErrorMessage($error_code, 'Company Name', '','');
					$session = \Config\Services::session();
					$session->setFlashdata('error_msg', $error_msg);
					$data = $this->adminvars->variables();
					echo view('ctt-admin/dashboard/head', $data);
					echo view('ctt-admin/dashboard/sidebar', $data);
					echo view('ctt-admin/adm-sbu/adm-add-sbu', $data);
					echo view('ctt-admin/dashboard/footer', $data);
				}
				else
				{
					$department_count = $_POST['department_count']; 
					$department_ids = $_POST['department_ids']; 
					$DeprtIds = explode(",",$department_ids);
				
					$i= 0;
					foreach($DeprtIds as $RSDeprtIds)
					{
						$yes_no = $_POST['yes_no'.$RSDeprtIds];
						$sbu_centralised = [
						'sbu_id' => $last_insert_id,
						'department_id' => $RSDeprtIds,
						'is_value' => $yes_no
						];
						$this->admin->form_insert(tbl_centralised_department,$sbu_centralised);
						$i++;
					}
					
					$Div_count = $_POST['divs'];
					$InsertData = explode(",",$Div_count);
					foreach($InsertData as $SizeData)
					{
						$department_name = $_POST['department_name_'.$SizeData];
						$department_code = $_POST['department_code_'.$SizeData];
						
						$sbu_data = [
						'sbu_id' => $last_insert_id,
						'department_name' => $department_name,
						'department_code' => $department_code
						];
						$this->admin->form_insert(tbl_other_operational_department,$sbu_data);
					}
					$session = \Config\Services::session();
					$session->setFlashdata('success_msg', MSBU_AddMsg);
					return redirect()->to( site_url('ctt-admin/sbu-listing') );
				}
			}
			else
			{
				$data = $this->adminvars->variables(); //Admin Variable Load
				//Load Page
				echo view('ctt-admin/dashboard/head', $data);
				echo view('ctt-admin/dashboard/sidebar', $data);
				echo view('ctt-admin/adm-sbu/adm-add-sbu', $data);
				echo view('ctt-admin/dashboard/footer', $data);
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	public function AddMoreSbu()
	{
		$data = $this->adminvars->variables();
		$DivId = $_POST['div_name'];
		?>
		<div class="row" id="set_<?php echo $DivId; ?>">
			<div class="form-group col-md-5">
				<label class="control-label" for="department_name_<?php echo $DivId; ?>"><?=$data['MSBU_DepartmentName'];?> <span class="text-danger">*</span></label>
				<div class="mb-2">
					<input type="text" class="form-control" id="department_name_<?php echo $DivId; ?>" name="department_name_<?php echo $DivId; ?>" placeholder="Enter Department Name" maxlength="150"/>
				</div>
			</div>
			<div class="form-group col-md-5">
				<label class="control-label" for="department_code_<?php echo $DivId; ?>"><?=$data['MSBU_DepartmentCode'];?> <span class="text-danger">*</span></label>
				<div class="mb-2">
					<input type="text" class="form-control" id="department_code_<?php echo $DivId; ?>" name="department_code_<?php echo $DivId; ?>" placeholder="Enter Department Code" maxlength="10"/>
				</div>
			</div>
			<div class="col-md-2">
				<label class="control-label" style="color: #fff;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
				<button type="button" onclick="return removerow('<?php echo $DivId; ?>');" class="btn btn-danger add_button" name="btn_submit" >- Remove</button>
			</div>
		</div>
		<?php
	}
	
	public function editSbu()
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
					
				$sbu_id = $this->admin->HtmlAddSlash($_POST['sbu_id']); 
				$land_line = $this->admin->HtmlAddSlash($_POST['land_line']); 
				$mobile = $this->admin->HtmlAddSlash($_POST['mobile']); 
				$email = $this->admin->HtmlAddSlash($_POST['email']); 
				$corporate_address = $this->admin->HtmlAddSlash($_POST['corporate_address']); 
				$correspondence_address = $this->admin->HtmlAddSlash($_POST['correspondence_address']); 
				$contact_name = $this->admin->HtmlAddSlash($_POST['contact_name']); 
				$contact_phone = $this->admin->HtmlAddSlash($_POST['contact_phone']); 
				$contact_email = $this->admin->HtmlAddSlash($_POST['contact_email']); 
			
				$data = [
				'land_line' => $land_line,
				'mobile' => $mobile,
				'corporate_address' => $corporate_address,
				'correspondence_address' => $correspondence_address,
				'contact_name' => $contact_name,
				'contact_phone' =>  $contact_phone,
				'contact_email' =>  $contact_email,
					];
					
				$error_code = $this->admin->form_update(tbl_sbu,$data,'id',$id);
				if($error_code != '')
				{
					//Set error message if any error in SQL
					$error_msg = $this->admin->ErrorMessage($error_code, 'sbu name', '','');
					$session = \Config\Services::session();
					$session->setFlashdata('error_msg', $error_msg);
					
					$data = $this->adminvars->variables(); //Admin Variable Load
					$data['EditData'] = $this->admin->getDataById(tbl_sbu, 'id', $id);
					//Load Page
					$data['urisegment'] = $segment[2];
					echo view('ctt-admin/dashboard/head', $data);
					echo view('ctt-admin/dashboard/sidebar', $data);
					echo view('ctt-admin/adm-sbu/adm-add-sbu', $data);
					echo view('ctt-admin/dashboard/footer', $data);
				}
				else
				{
					$DeleteDept = $this->admin->retrive_all_cond_data('*',tbl_other_operational_department,"is_delete='0' AND sbu_id ='".$id."'", 'id','DESC');
					if(!empty($DeleteDept))
					foreach($DeleteDept as $RsDeleteSBU)
					{
						$this->admin->deleteRow(tbl_other_operational_department,'id',$RsDeleteSBU->id);
					}
					
					$DeletecentralisedDept = $this->admin->retrive_all_cond_data('*',tbl_centralised_department,"is_delete='0' AND sbu_id ='".$id."'", 'id','DESC');
					if(!empty($DeletecentralisedDept))
					foreach($DeletecentralisedDept as $RsDeleteCentr)
					{
						$this->admin->deleteRow(tbl_centralised_department,'id',$RsDeleteCentr->id);
					}
					
					$department_count = $_POST['department_count']; 
					$department_ids = $_POST['department_ids']; 
					$DeprtIds = explode(",",$department_ids);
				
					$i= 0;
					foreach($DeprtIds as $RSDeprtIds)
					{
						$yes_no = $_POST['yes_no'.$RSDeprtIds];
						$sbu_centralised = [
						'sbu_id' => $id,
						'department_id' => $RSDeprtIds,
						'is_value' => $yes_no
						];
						$this->admin->form_insert(tbl_centralised_department,$sbu_centralised);
						$i++;
					}
					
					$Div_count = $_POST['divs'];
					$InsertData = explode(",",$Div_count);
					//print_r($InsertData);exit;
					foreach($InsertData as $SizeData)
					{
						$department_name = $_POST['department_name_'.$SizeData];
						$department_code = $_POST['department_code_'.$SizeData];
						
						$sbu_data = [
						'sbu_id' => $id,
						'department_name' => $department_name,
						'department_code' => $department_code
						];
						//print_r($sbu_data);exit;
						$this->admin->form_insert(tbl_other_operational_department,$sbu_data);
					}
					//exit;
					//Set Flashdata session
					$session = \Config\Services::session();
					$session->setFlashdata('success_msg', MSBU_UpdateMsg);
					return redirect()->to( site_url('ctt-admin/sbu-listing') );
				}
			}
			else
			{
				$data = $this->adminvars->variables(); //Admin Variable Load
				//Load Page
				$data['urisegment'] = $segment[2];
				$data['EditData'] = $this->admin->getDataById(tbl_sbu, 'id', $id);
				$data['QsOtherOperationDept'] = $this->admin->retrive_all_cond_data('*',tbl_other_operational_department,"is_delete='0' AND sbu_id='".$id."'", 'id','ASC');
				//print_r($data['QsOtherOperationDept']);exit;
				echo view('ctt-admin/dashboard/head', $data);
				echo view('ctt-admin/dashboard/sidebar', $data);
				echo view('ctt-admin/adm-sbu/adm-add-sbu', $data);
				echo view('ctt-admin/dashboard/footer', $data);
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Delete Sbu
	public function deletesbu()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			$segmentRemove = array_filter($this->request->uri->getSegments());
			$segment = array_values($segmentRemove);
			$id = $segment[2];
			$error_code = $this->admin->deleteRow(tbl_sbu,'id',$id);
			if($error_code != "")
			{
				//Set error message if any error in SQL
				$error_msg = $this->admin->ErrorMessage($error_code, 'sbu name', '','');
				$session = \Config\Services::session();
				$session->setFlashdata('error_msg', $error_msg);
				return redirect()->to( site_url('ctt-admin/sbu-listing') );
			}
			else
			{
				//Set Flashdata session
				$session = \Config\Services::session();
				$session->setFlashdata('success_msg', MSBU_DeleteMsg);
				return redirect()->to( site_url('ctt-admin/sbu-listing') );
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	
	
	/* 
	public function DeleteVendorMaster()
	{
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		$id = $_POST['id'];//Get Id From URL
		$data['delete_image'] = $this->admin->getDataById(tbl_sbu, 'id', $id);
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
		
		$error_code = $this->admin->form_update(tbl_sbu,$form_data,'id',$id);
		?>
		<div class="mb-2">
			<input type="file" class="form-control-file" id="company_logo" name="company_logo" accept="image/png,image/jpg,image/jpeg" >
		</div>	
		<?php
	}
	
	
	public function DeleteEmployeeMaster()
	{
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		$id = $_POST['id'];//Get Id From URL
		$data['delete_image'] = $this->admin->getDataById(tbl_sbu, 'id', $id);
		$img_name = $data['delete_image']->company_logo;
		if($img_name){
			$data = $this->adminvars->variables(); 
			$prev_file_path = MSBU_EmployeeMasterImagePath.$img_name;
			if(file_exists($prev_file_path))
			{
				unlink($prev_file_path );
			}
		}
		//Delete Image From Folder
		$form_data = array(
			'company_logo'=> ''
		);
		
		$error_code = $this->admin->form_update(tbl_sbu,$form_data,'id',$id);
		?>
		<div class="mb-2">
			<input type="file" class="form-control-file" id="company_logo" name="company_logo" accept="image/png,image/jpg,image/jpeg" >
		</div>	
		<?php
	}
	 */
	
	//Function for Get Get_SubCategory
	public function Get_Sbu()
	{
		$data = $this->adminvars->variables(); //Admin Variable Load
		$company_id = $_POST['company_id'];
		//echo $company_id
		if(isset($company_id))
		{	
			$data['QsSbu'] = $this->admin->retrive_all_cond_data('*',tbl_sbu,'is_delete="0" AND company_id = "'.$company_id.'" AND land_line is NULL AND mobile is NULL AND corporate_address is NULL','id','DESC');
		?>
			
		<option value="">Select Sbu Name</option>
			<?php foreach($data['QsSbu'] as $RsSbu)
			{
			?>
			<option value="<?php echo $RsSbu->id;?>"  <?php if($RsSbu->id == $EditData->company_id) { ?>selected="selected"  <?php } ?>><?php echo $this->admin->HtmlStripSlash($RsSbu->sbu_name );?></option>	
		<?php }
		}
	}
	
	
	//Search Industry
	public function searchsbu()
    {
		// Get search term 
		$sbu_name = $_REQUEST['sbu_name'];
		
		$QsSbu = $this->admin->retrive_all_cond_data('*',tbl_sbu,'is_delete="0" AND sbu_name LIKE "%'.$sbu_name.'%" AND land_line is NOT NULL AND mobile is NOT NULL AND corporate_address is NOT NULL ', 'id','DESC'); 
		$skillData = array(); 
		if(!empty($QsSbu)){ 
			foreach($QsSbu as $RsSbu)
			{
				$data['id'] = $RsSbu->id; 
				$data['value'] = $RsSbu->sbu_name; 
				array_push($skillData, $data); 
			} 
		} 
		 
		echo json_encode($skillData); 
    }
}