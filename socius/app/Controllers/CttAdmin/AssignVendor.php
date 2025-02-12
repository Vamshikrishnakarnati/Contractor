<?php namespace App\Controllers\CttAdmin;

use App\Models\Admin;
use App\Models\Adminvariable;

use CodeIgniter\Controller;

class AssignVendor extends Controller
{
	public function __construct()
	{
		$this->admin = new Admin();
		$this->adminvars = new Adminvariable();
		$this->uri = new \CodeIgniter\HTTP\URI(current_url()); 
	}
		
	public function assignvendorlisting()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			$data = $this->adminvars->variables(); //Admin Variable Load
			$vendor_name = $this->request->getVar('vendor_name'); 
			$VendorName = $this->admin->getDataById(tbl_vendor, 'company_name', $vendor_name);
			$data['QsAssignVendor'] = $this->admin->retrive_all_cond_data('*',tbl_assign_vendor,'is_delete="0" AND vendor_id = "'.$VendorName->id.'"', 'id','DESC');
			echo view('ctt-admin/dashboard/head', $data);
			echo view('ctt-admin/dashboard/sidebar', $data);
			echo view('ctt-admin/adm-assign-vendor/adm-assign-vendor-listing', $data);
			echo view('ctt-admin/dashboard/footer', $data);
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	
	public function addassignvendor()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			helper(['form', 'url']);
			if($this->request->getVar()) 
			{
				$Div_count = $_POST['divs'];
				$InsertData = explode(",",$Div_count);
				foreach($InsertData as $SizeData)
				{
					$vendor_id = $_POST['vendor_id_'.$SizeData];
					$company_id = $_POST['company_id_'.$SizeData];
					$sbu_id = $_POST['sbu_id_'.$SizeData];
					$vendor_master_id = $_POST['vendor_master_id_'.$SizeData];
					
					$QsAssignVendor = $this->admin->retrive_all_cond_data('*',tbl_assign_vendor,'is_delete="0" AND vendor_id = "'.$vendor_id .'" AND company_id = "'.$company_id.'" AND sbu_id = "'.$sbu_id.'" AND vendor_master_id = "'.$vendor_master_id.'"', 'id','DESC');
					if(!empty($QsAssignVendor) && count($QsAssignVendor) > 0)
					{
						$session->setFlashdata('error_msg', "This vendor is already been assigned");
						$data = $this->adminvars->variables();
						echo view('ctt-admin/dashboard/head', $data);
						echo view('ctt-admin/dashboard/sidebar', $data);
						echo view('ctt-admin/adm-assign-vendor/adm-add-assign-vendor', $data);
						echo view('ctt-admin/dashboard/footer', $data);
						exit;
					}
					else
					{
						$sbu_data = [
						'vendor_id' => $vendor_id,
						'company_id' => $company_id,
						'sbu_id' => $sbu_id,
						'vendor_master_id' => $vendor_master_id
						];
						//print_r($sbu_data);
						$this->admin->form_insert(tbl_assign_vendor,$sbu_data);
					}	
				}
				$db  = \Config\Database::connect();
				$error_code = $db->error();
				if($error_code['code'] != '0')
				{
					$error_msg = $this->admin->ErrorMessage($error_code, 'Vendor', '','');
					$session = \Config\Services::session();
					$session->setFlashdata('error_msg', $error_msg);
					$data = $this->adminvars->variables();
					echo view('ctt-admin/dashboard/head', $data);
					echo view('ctt-admin/dashboard/sidebar', $data);
					echo view('ctt-admin/adm-assign-vendor/adm-add-assign-vendor', $data);
					echo view('ctt-admin/dashboard/footer', $data);
				}
				else
				{
					$session = \Config\Services::session();
					$session->setFlashdata('success_msg', MAV_AddMsg);
					return redirect()->to( site_url('ctt-admin/assign-vendor-listing') );
				}
			}
			else
			{
				$data = $this->adminvars->variables(); 
				echo view('ctt-admin/dashboard/head', $data);
				echo view('ctt-admin/dashboard/sidebar', $data);
				echo view('ctt-admin/adm-assign-vendor/adm-add-assign-vendor', $data);
				echo view('ctt-admin/dashboard/footer', $data);
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	public function AddMoreAssignVendor()
	{
		$data = $this->adminvars->variables();
		$DivId = $_POST['div_name'];
		?>
		<div class="row" id="set_<?php echo $DivId; ?>">
			<div class="form-group col-md-2">
			<label class="control-label" for="">Vendor Name<span class="text-danger"> </span></label>
			<div class="mb-2 selects-contant">
				<select class="js-basic-single form-control cat" <?php if($urisegment) { ?>disabled<?php } ?> name="vendor_id_<?php echo $DivId; ?>" id="vendor_id_<?php echo $DivId; ?>">
					<option value="">Select Vendor</option>
					<?php 
					$QsVendor = $this->admin->retrive_all_cond_data('*',tbl_vendor, 'is_active=1 AND is_delete = 0','id','ASC');
					if(!empty($QsVendor))
					{
						foreach($QsVendor as $RsVendor) {
						
						$Sbuid = $this->admin->getDataById(tbl_sbu, 'id', $EditData->id);
					?>
					<option value="<?=$RsVendor->id;?>" <?php if($Sbuid->company_id == $RsVendor->id) {?>selected<?php } ?> ><?=$this->admin->HtmlStripSlash($RsVendor->company_name);?></option>
					<?php } } ?>
				</select>
			</div>
		</div>
	
		<div class="form-group col-md-3">
			<label class="control-label" for="">Organisation Name<span class="text-danger"> </span></label>
			<div class="mb-2 selects-contant">
				<select class="js-basic-single form-control cat" <?php if($urisegment) { ?>disabled<?php } ?> name="company_id_<?php echo $DivId; ?>" onchange="get_sbu_<?php echo $DivId; ?>(this.value);" id="company_id_<?php echo $DivId; ?>">
					<option value="">Select Organisation</option>
					<?php 
					$QsOrganisation = $this->admin->retrive_all_cond_data('*',tbl_organisation, 'is_active=1 AND is_delete = 0','id','ASC');
					if(!empty($QsOrganisation))
					{
						foreach($QsOrganisation as $RsOrganisation) {
						
						$Sbuid = $this->admin->getDataById(tbl_sbu, 'id', $EditData->id);
					?>
					<option value="<?=$RsOrganisation->id;?>" <?php if($Sbuid->company_id == $RsOrganisation->id) {?>selected<?php } ?> ><?=$this->admin->HtmlStripSlash($RsOrganisation->company_name);?></option>
					<?php } } ?>
				</select>
			</div>
		</div>
		<div class="form-group col-md-2">
			<label class="control-label" for="">Sbu Name<span class="text-danger"> </span></label>
			<div class="mb-2 selects-contant">
				<select class="js-basic-single form-control cat" <?php if($urisegment) { ?>disabled<?php } ?> name="sbu_id_<?php echo $DivId; ?>" onchange="get_vendor_master_<?php echo $DivId; ?>(this.value);" id="sbu_id_<?php echo $DivId; ?>">
					<option value="">Select Sbu</option>
					
				</select>
			</div>
		</div>
		<div class="form-group col-md-3">
			<label class="control-label" for="">Vendor Master Name<span class="text-danger"> </span></label>
			<div class="mb-2 selects-contant">
				<select class="js-basic-single form-control cat" <?php if($urisegment) { ?>disabled<?php } ?> name="vendor_master_id_<?php echo $DivId; ?>" id="vendor_master_id_<?php echo $DivId; ?>">
					<option value="">Select Vendor Master</option>
						
				</select>
			</div>
		</div>
			<div class="col-md-2">
				<label class="control-label" style="color: #fff;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
				<button type="button" onclick="return removerow('<?php echo $DivId; ?>');" class="btn btn-danger add_button" name="btn_submit" >- Remove</button>
			</div>
		</div>
		
			<script>												
				function get_sbu_<?php echo $DivId; ?>(company_id)
				{
					var projectPath = $("#projectPath").val();
					$.ajax(
					 { 
						  url: projectPath+"CttAdmin/AssignVendor/Get_Sbu",
						  type: "POST",
						  cache: false,
						   data:"company_id="+company_id,
						  async: false,
						  success: function(data) 
						  {
							//alert(data);
							$("#sbu_id_<?php echo $DivId; ?>").html(data);
						  } 
					 });
				}

				function get_vendor_master_<?php echo $DivId; ?>(sbu_id)
				{
					var projectPath = $("#projectPath").val();
					$.ajax(
					 { 
						  url: projectPath+"CttAdmin/AssignVendor/Get_Vendor_Master",
						  type: "POST",
						  cache: false,
						   data:"sbu_id="+sbu_id,
						  async: false,
						  success: function(data) 
						  {
							//alert(data);
							$("#vendor_master_id_<?php echo $DivId; ?>").html(data);
						  } 
					 });
				}

			
			</script>
		
		<?php
	}
	
	public function editAssignVendor()
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
				$DeleteAssignVendor = $this->admin->retrive_all_cond_data('*',tbl_assign_vendor,"is_delete='0' AND id ='".$id."'", 'id','DESC');
				if(!empty($DeleteAssignVendor))
				foreach($DeleteAssignVendor as $RsAssignVendor)
				{
					$this->admin->deleteRow(tbl_assign_vendor,'id',$RsAssignVendor->id);
				}
					
				
				$Div_count = $_POST['divs'];
				$InsertData = explode(",",$Div_count);
				foreach($InsertData as $SizeData)
				{
					$vendor_id = $_POST['vendor_id_'.$SizeData];
					$company_id = $_POST['company_id_'.$SizeData];
					$sbu_id = $_POST['sbu_id_'.$SizeData];
					$vendor_master_id = $_POST['vendor_master_id_'.$SizeData];
					
					$QsAssignVendor = $this->admin->retrive_all_cond_data('*',tbl_assign_vendor,'is_delete="0" AND vendor_id = "'.$vendor_id .'" AND company_id = "'.$company_id.'" AND sbu_id = "'.$sbu_id.'" AND vendor_master_id = "'.$vendor_master_id.'"', 'id','DESC');
				
					if(!empty($QsAssignVendor) && count($QsAssignVendor) > 0)
					{
						$session->setFlashdata('error_msg', "This vendor is already been assigned");
						$data = $this->adminvars->variables();
						echo view('ctt-admin/dashboard/head', $data);
						echo view('ctt-admin/dashboard/sidebar', $data);
						echo view('ctt-admin/adm-assign-vendor/adm-add-assign-vendor', $data);
						echo view('ctt-admin/dashboard/footer', $data);
						exit;
					}
					else
					{
						$sbu_data = [
						'vendor_id' => $vendor_id,
						'company_id' => $company_id,
						'sbu_id' => $sbu_id,
						'vendor_master_id' => $vendor_master_id
						];
						//print_r($sbu_data);
						$this->admin->form_insert(tbl_assign_vendor,$sbu_data);
					}	
				}
				$db  = \Config\Database::connect();
				$error_code = $db->error();
				if($error_code != '')
				{
					//Set error message if any error in SQL
					$error_msg = $this->admin->ErrorMessage($error_code, 'Vendor Name', '','');
					$session = \Config\Services::session();
					$session->setFlashdata('error_msg', $error_msg);
					
					$data = $this->adminvars->variables(); //Admin Variable Load
					$data['EditData'] = $this->admin->getDataById(tbl_assign_vendor, 'id', $id);
					//Load Page
					$data['urisegment'] = $segment[2];
					echo view('ctt-admin/dashboard/head', $data);
					echo view('ctt-admin/dashboard/sidebar', $data);
					echo view('ctt-admin/adm-assign-vendor/adm-add-assign-vendor', $data);
					echo view('ctt-admin/dashboard/footer', $data);
				}
				else
				{
					$session = \Config\Services::session();
					$session->setFlashdata('success_msg', MAV_UpdateMsg);
					return redirect()->to( site_url('ctt-admin/assign-vendor-listing') );
				}
			}
			else
			{
				$data = $this->adminvars->variables(); //Admin Variable Load
				//Load Page
				$data['urisegment'] = $segment[2];
				$data['EditData'] = $this->admin->getDataById(tbl_assign_vendor, 'id', $id);
				echo view('ctt-admin/dashboard/head', $data);
				echo view('ctt-admin/dashboard/sidebar', $data);
				echo view('ctt-admin/adm-assign-vendor/adm-add-assign-vendor', $data);
				echo view('ctt-admin/dashboard/footer', $data);
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	//Delete Sbu
	public function deleteassignvendor()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		if(!empty($adminId))
		{
			$segmentRemove = array_filter($this->request->uri->getSegments());
			$segment = array_values($segmentRemove);
			$id = $segment[2];
			$error_code = $this->admin->deleteRow(tbl_assign_vendor,'id',$id);
			if($error_code != "")
			{
				//Set error message if any error in SQL
				$error_msg = $this->admin->ErrorMessage($error_code, 'Vendor Name', '','');
				$session = \Config\Services::session();
				$session->setFlashdata('error_msg', $error_msg);
				return redirect()->to( site_url('ctt-admin/assign-vendor-listing') );
			}
			else
			{
				//Set Flashdata session
				$session = \Config\Services::session();
				$session->setFlashdata('success_msg', MSBU_DeleteMsg);
				return redirect()->to( site_url('ctt-admin/assign-vendor-listing') );
			}
		}
		else
		{
			return redirect()->to(site_url('ctt-admin/login'));
		}
    }
	
	
	//Function for Get Get_SubCategory
	public function Get_Sbu()
	{
		$data = $this->adminvars->variables(); //Admin Variable Load
		$company_id = $_POST['company_id'];
		if(isset($company_id))
		{	
			$data['QsSbu'] = $this->admin->retrive_all_cond_data('*',tbl_sbu,'is_delete="0" AND company_id = "'.$company_id.'" AND land_line is NOT NULL AND mobile is NOT NULL AND corporate_address is NOT NULL','id','DESC');
			//print_r($data['QsSbu']);exit;
		?>
			
		<option value="">Select Sbu</option>
			<?php foreach($data['QsSbu'] as $RsSbu)
			{
			?>
			<option value="<?php echo $RsSbu->id;?>"  <?php if($RsSbu->id == $EditData->company_id) { ?>selected="selected"  <?php } ?>><?php echo $this->admin->HtmlStripSlash($RsSbu->sbu_name);?></option>	
		<?php }
		}
	}
	
	//Function for Get Get_Vendor Master
	public function Get_Vendor_Master()
	{
		$data = $this->adminvars->variables(); //Admin Variable Load
		$sbu_id = $_POST['sbu_id'];
		if(isset($sbu_id))
		{	
			$data['QsVendorMaster'] = $this->admin->retrive_all_cond_data('*',tbl_vendor_master,'is_delete="0" AND sbu_id = "'.$sbu_id.'"','id','DESC');
			//print_r($data['QsVendorMaster']);exit;
		?>
			
		<option value="">Select Vendor Master</option>
			<?php foreach($data['QsVendorMaster'] as $RsVendorMaster)
			{
			?>
			<option value="<?php echo $RsVendorMaster->id;?>"  <?php if($RsVendorMaster->id == $EditData->sbu_id) { ?>selected="selected"  <?php } ?>><?php echo $this->admin->HtmlStripSlash($RsVendorMaster->vendor_name);?></option>	
		<?php }
		}
	}
	
	public function searchassignvendor()
    {
		$vendor_name = $_REQUEST['vendor_name'];
		$QsVendor = $this->admin->retrive_all_cond_data('*',tbl_vendor,'is_delete="0" AND company_name LIKE "%'.$vendor_name.'%"', 'id','DESC'); 
		
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