<?php
use App\Models\Admin; $this->admin = new Admin();
$this->uri = new \CodeIgniter\HTTP\URI(current_url());
?>
<div class="app-main" id="main">
	<!-- begin container-fluid -->
	<div class="container-fluid">
		<!-- begin row -->
		<div class="row">
			<div class="col-md-12 m-b-30">
				<!-- begin page title -->
				<div class="d-block d-sm-flex flex-nowrap align-items-center">
					<div class="page-title mb-2 mb-sm-0">
						<h1><?=$SubMenu;?></h1>
					</div>
					<div class="ml-auto d-flex align-items-center">
						<nav>
							<ol class="breadcrumb p-0 m-b-0">
								<li class="breadcrumb-item">
									<a href="<?=site_url();?>ctt-admin/dashboard"><i class="ti ti-home"></i></a>
								</li>
								<li class="breadcrumb-item">
									<?=$Menu;?>
								</li>
								<li class="breadcrumb-item active text-primary" aria-current="page"><?php if($urisegment) { echo $BTN_Edit; } else { echo $BTN_Add; } ?> <?=$MSBU_Sbu;?></li>
							</ol>
						</nav>
					</div>
				</div>
				<!-- end page title -->
			</div>
		</div>
		<!-- end row -->
		<!-- start Validation row -->
		<div class="row formavlidation-wrapper">
			<div class="col-xl-12">
				<div class="card card-statistics">
					<div class="card-header">
						<div class="card-heading text-right">
							<a href="<?=site_url();?>ctt-admin/sbu-listing" class="btn btn-primary btn-sm"><i class="ti ti-arrow-left"></i> <?=$BTN_Back;?></a>
						</div>
					</div>
					<div class="card-body">
						<form id="userForm" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
							<div class="row">
								<div class="form-group col-md-6">
									<label class="control-label" for=""><?=$MSBU_OrganisationName;?><span class="text-danger"> *</span></label>
									<div class="mb-2 selects-contant">
										<select class="js-basic-single form-control cat" <?php if($urisegment) { ?>disabled<?php } ?> name="company_id" onchange="get_sbu(this.value);" id="company_id">
											<option value=""><?=$MSBU_SelectOrganisationName;?></option>
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
								<div class="form-group col-md-6">
									<label class="control-label" for=""><?=$MSBU_SBUName;?><span class="text-danger"> *</span></label>
									<div class="mb-2 selects-contant">
										<select class="js-basic-single form-control cat" <?php if($urisegment) { ?>disabled<?php } ?> name="sbu_id" id="sbu_id">
											<option value=""><?=$MSBU_SelectSBUName;?></option>
											<?php 
											if($urisegment)
											{
											$QsSbu = $this->admin->retrive_all_cond_data('*',tbl_sbu, 'is_active=1 AND is_delete = 0', 'id','DESC');
											if(!empty($QsSbu))
											{
											foreach($QsSbu as $RsSbu) { ?>
											<option value="<?=$RsSbu->id;?>" <?php if($EditData->id == $RsSbu->id) {?>selected<?php } ?> ><?=$this->admin->HtmlStripSlash($RsSbu->sbu_name);?></option>
											<?php } } } ?>
										</select>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="land_line"><?=$MSBU_Landline;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="land_line" name="land_line" placeholder="Enter Landline" onkeypress="return numbersonly(event)" maxlength="15" minlength="10" value="<?php if($urisegment) { if(isset($_POST['land_line'])) { echo $_POST['land_line']; } else { echo $this->admin->HtmlStripSlash($EditData->land_line); } }  else { if(isset($_POST['land_line'])) { echo $_POST['land_line']; } } ?>"/>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="mobile"><?=$MSBU_Mobile;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile" onkeypress="return numbersonly(event)" maxlength="15"  minlength="10" value="<?php if($urisegment) { if(isset($_POST['mobile'])) { echo $_POST['mobile']; } else { echo $this->admin->HtmlStripSlash($EditData->mobile); } }  else { if(isset($_POST['mobile'])) { echo $_POST['mobile']; } } ?>"/>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="email"><?=$MSBU_Email;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" maxlength="50" value="<?php if($urisegment) { if(isset($_POST['email'])) { echo $_POST['email']; } else { echo $this->admin->HtmlStripSlash($EditData->contact_email); } }  else { if(isset($_POST['email'])) { echo $_POST['email']; } } ?>"/>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="corporate_address"><?=$MSBU_CorporateAddress;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<textarea rows="4" class="form-control" id="corporate_address" name="corporate_address" placeholder="Enter Corporate Address"><?php if($urisegment) { if(isset($_POST['corporate_address'])) { echo $_POST['corporate_address']; } else { echo $this->admin->HtmlStripSlash($EditData->corporate_address); } }  else { if(isset($_POST['corporate_address'])) { echo $_POST['corporate_address']; } } ?></textarea>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="correspondence_address"><?=$MSBU_CorrespondenceAddress;?><span class="text-danger">*</span></label>
									<div class="mb-2">
										<textarea rows="4" class="form-control" id="correspondence_address" name="correspondence_address" placeholder="Enter Correspondence Address"><?php if($urisegment) { if(isset($_POST['correspondence_address'])) { echo $_POST['correspondence_address']; } else { echo $this->admin->HtmlStripSlash($EditData->correspondence_address); } }  else { if(isset($_POST['correspondence_address'])) { echo $_POST['correspondence_address']; } } ?></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h4>Single Point of Contact</h4>
								</div>
								<div class="form-group col-md-4">
									<label class="control-label" for="contact_name"><?=$MSBU_Name;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Enter Contact Name" maxlength="50" value="<?php if($urisegment) { if(isset($_POST['contact_name'])) { echo $_POST['contact_name']; } else { echo $this->admin->HtmlStripSlash($EditData->contact_name); } }  else { if(isset($_POST['contact_name'])) { echo $_POST['contact_name']; } } ?>"/>
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="control-label" for="contact_phone"><?=$MSBU_Phone;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="contact_phone" name="contact_phone" placeholder="Enter Contact Mobile" onkeypress="return numbersonly(event)" maxlength="15" minlength="10" value="<?php if($urisegment) { if(isset($_POST['contact_phone'])) { echo $_POST['contact_phone']; } else { echo $this->admin->HtmlStripSlash($EditData->contact_phone); } }  else { if(isset($_POST['contact_phone'])) { echo $_POST['contact_phone']; } } ?>"/>
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="control-label" for="contact_email"><?=$MSBU_Email;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="contact_email" name="contact_email" placeholder="Enter Contact Email" maxlength="30" value="<?php if($urisegment) { if(isset($_POST['contact_email'])) { echo $_POST['contact_email']; } else { echo $this->admin->HtmlStripSlash($EditData->contact_email); } }  else { if(isset($_POST['contact_email'])) { echo $_POST['contact_email']; } } ?>"/>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h4>Centralised Departments</h4>
								</div>
							</div>
							<div class="row text-center">
								<div class="form-group col-md-4">
									<label class="control-label" for="contact_name">Department Name</label>
								</div>
								<div class="form-group col-md-4">
									<label class="control-label" for="contact_name">Department Code</label>
								</div>
								<div class="form-group col-md-4">
									<label class="control-label" for="contact_name">Yes/No</label>
								</div>
							</div>
							<div class="row text-center">
								<?php 
								$QsDepartment = $this->admin->retrive_all_cond_data('*',tbl_department, 'is_active=1 AND is_delete = 0','id','ASC');
								if(!empty($QsDepartment))
								{
									$i = 0;
									$departmentids = "";
									foreach($QsDepartment as $RsDepartment) {
									$i++;
									if(empty($departmentids))
									{
										$departmentids = $RsDepartment->id;
									}
									else
									{
										$departmentids .= ",".$RsDepartment->id;
									}
									$CentralisedDept = $this->admin->retrive_all_cond_data('*',tbl_centralised_department, 'is_active=1 AND is_delete = 0 AND sbu_id = "'.$urisegment.'" AND department_id = "'.$RsDepartment->id .'"','id','DESC');
									
								?>
								<div class="form-group col-md-4">
									<label class="control-label" for="department_name"><?php echo $this->admin->HtmlStripSlash($RsDepartment->department_name); ?></label>
								</div>
								<div class="form-group col-md-4">
									<label class="control-label" for="department_name"><?php echo $this->admin->HtmlStripSlash($RsDepartment->department_code); ?></label>
								</div>
								<div class="form-group col-md-4">
									<div class="radio">
									  <label><input type="radio" name="yes_no<?php echo $RsDepartment->id; ?>" value="1" id="yes<?php echo $RsDepartment->id; ?>" <?php if($urisegment) { if($CentralisedDept[0]->is_value == 1) { ?>checked<?php } } else { ?>checked<?php } ?>> Yes</label>&nbsp;&nbsp;&nbsp;
									  <label><input type="radio" id="no<?php echo $RsDepartment->id; ?>" value="0" name="yes_no<?php echo $RsDepartment->id; ?>"  <?php if($urisegment) { if($CentralisedDept[0]->is_value == 0) { ?>checked<?php } } ?>> No</label>
									</div>
								</div>
								<?php } ?><input type="hidden" name="department_count" id="department_count" value="<?php echo count($QsDepartment);?>">
								<input type="hidden" name="department_ids" id="department_ids" value="<?php echo $departmentids;?>"> <?php } 
								?>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h4>Operational Departments</h4>
								</div>
							</div>
							<div id="product_sizes">
								<?php 
								$Divs = '';
								$i=0; 
								if($urisegment && !empty($QsOtherOperationDept)) {
									foreach($QsOtherOperationDept as $RsOtherOperationDept) { $i++;?>
									<div class="row" id="set_<?php echo $i; ?>">
										<div class="form-group col-md-5">
											<label class="control-label" for="department_name_<?php echo $i; ?>"><?=$MSBU_DepartmentName;?> <span class="text-danger">*</span></label>
											<div class="mb-2">
												<input type="text" class="form-control" id="department_name_<?php echo $i; ?>" name="department_name_<?php echo $i; ?>" placeholder="Enter Department Name" maxlength="150" value="<?php if($urisegment) { if(isset($_POST['department_name'])) { echo $_POST['department_name']; } else { echo $this->admin->HtmlStripSlash($RsOtherOperationDept->department_name); } }  else { if(isset($_POST['department_name'])) { echo $_POST['department_name']; } } ?>"/>
											</div>
										</div>
										<div class="form-group col-md-5">
											<label class="control-label" for="department_code_<?php echo $i; ?>"><?=$MSBU_DepartmentCode;?> <span class="text-danger">*</span></label>
											<div class="mb-2">
												<input type="text" class="form-control" id="department_code_<?php echo $i; ?>" name="department_code_<?php echo $i; ?>" placeholder="Enter Department Code" maxlength="10" value="<?php if($urisegment) { if(isset($_POST['department_code'])) { echo $_POST['department_code']; } else { echo $this->admin->HtmlStripSlash($RsOtherOperationDept->department_code); } }  else { if(isset($_POST['department_code'])) { echo $_POST['department_code']; } } ?>"/>
											</div>
										</div>
										<?php if($i == 1) { ?>
										<div class="col-md-2">
											<label class="control-label" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
											<button type="button"  onclick="return addrow();" class="btn btn-primary add_button" name="btn_submit" >+ Add More</button>
										</div>
										<?php } else { ?>
										<div class="col-md-2">
											<label class="control-label" style="color: #fff;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
											<button type="button" onclick="return removerow('<?php echo $i; ?>');" class="btn btn-danger add_button" name="btn_submit" >- Remove</button>
										</div>
										<?php } ?>
									</div>
								<?php } }  else { ?>
								<div class="row" id="set_1">
									<div class="form-group col-md-5">
										<label class="control-label" for="department_name_1"><?=$MSBU_DepartmentName;?> <span class="text-danger">*</span></label>
										<div class="mb-2">
											<input type="text" class="form-control" id="department_name_1" name="department_name_1" placeholder="Enter Department Name" maxlength="150" value="<?php if($urisegment) { if(isset($_POST['sbu_name'])) { echo $_POST['sbu_name']; } else { echo $this->admin->HtmlStripSlash($EditData->sbu_name); } }  else { if(isset($_POST['sbu_name'])) { echo $_POST['sbu_name']; } } ?>"/>
										</div>
									</div>
									<div class="form-group col-md-5">
										<label class="control-label" for="department_code_1"><?=$MSBU_DepartmentCode;?> <span class="text-danger">*</span></label>
										<div class="mb-2">
											<input type="text" class="form-control" id="department_code_1" name="department_code_1" placeholder="Enter Department Code" maxlength="10" value="<?php if($urisegment) { if(isset($_POST['department_code'])) { echo $_POST['department_code']; } else { echo $this->admin->HtmlStripSlash($EditData->department_code); } }  else { if(isset($_POST['department_code'])) { echo $_POST['department_code']; } } ?>"/>
										</div>
									</div>
									<div class="form-group col-md-2">
										<label class="control-label" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
										<button type="button"  onclick="return addrow();" class="btn btn-primary add_button" name="btn_submit" >+ Add More</button>
									</div>
								</div>
								<?php } ?>
							</div>
							<input type="hidden" name="div_count" id="div_count" value="1">
							<input type="hidden" name="divs" id="divs" value="1">
						<?php if(!$urisegment) { ?>
							<div class="row">
								<div class="form-group col-md-6">
									<label class="control-label" for="vendor_master"><?=$MSBU_VendorMaster;?> <span class="text-danger">*</span></label>
									<?php if($urisegment && $EditData->vendor_master != "" && file_exists($MV_VendorMasterViewPath.$EditData->vendor_master))
									{  ?>
									<div id="upload_vendor_master">
										<div class="col-md-6 mb-2 mb-xs-0">
											<a href="<?=site_url();?><?=$MV_VendorMasterViewPath.$EditData->vendor_master;?>" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
										</div>
										<div class="row m-b-20">
											<div class="form-group col-md-6">
												<div class="mt-4 text-center">
													<a href="javascript:void(0);" data-tooltip="tooltip" data-toggle="modal" title="Delete Vendor Master" data-target="#modal-delete-confirm-vendor-master" class="btn btn-icon btn-outline-danger"><i class="dripicons dripicons dripicons-trash"></i></i></a>
												</div>		
											</div>		
										</div>		
									</div>	
									<input name="hidden_vendor_master" type="hidden" id="hidden_vendor_master"  class="form-control" value="<?php if($urisegment) { echo $EditData->vendor_master; } ?>">	
									<?php }
									else { ?>
										<div class="mb-2">
											<input type="file" class="form-control" id="vendor_master" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  name="vendor_master">
										</div>
									<?php } ?>
								</div>
								<div class="modal fade" id="modal-delete-confirm-vendor-master" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<h5 class="modal-title" id="verticalCenterTitle"> &nbsp; </h5>
											<div class="modal-body text-center">
												<div class="swal2-header"><div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"><span class="swal2-icon-text">!</span></div><h4 class="swal2-title" id="swal2-title" style="display: center;"><?=$DeleteImageConfirmMsg;?></h4></div>
												<div class="" style="text-align:center;">
													<button type="button" class="btn btn-success" onclick="delete_vendor_master(<?php echo $EditData->id;?>);" data-dismiss="modal"><?=$Yes;?></button>
													<button type="button" class="btn btn-danger" data-dismiss="modal"><?=$No;?></button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="employee_smaster"><?=$MSBU_EmployeeMaster;?> <span class="text-danger">*</span></label>
									<?php if($urisegment && $EditData->employee_master != "" && file_exists($MV_EmployeeMasterViewPath.$EditData->employee_master))
									{  ?>
									<div id="upload_employee_master">
										<div class="col-md-6 mb-2 mb-xs-0">
											<a href="<?=site_url();?><?=$MV_EmployeeMasterViewPath.$EditData->employee_master;?>" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
										</div>
										<div class="row m-b-20">
											<div class="form-group col-md-6">
												<div class="mt-4 text-center">
													<a href="javascript:void(0);" data-tooltip="tooltip" data-toggle="modal" title="Delete Employee Master" data-target="#modal-delete-confirm-employee-master" class="btn btn-icon btn-outline-danger"><i class="dripicons dripicons dripicons-trash"></i></i></a>
												</div>		
											</div>		
										</div>		
									</div>	
									<input name="hidden_employee_master" type="hidden" id="hidden_employee_master"  class="form-control" value="<?php if($urisegment) { echo $EditData->employee_master; } ?>">	
									<?php }
									else { ?>
										<div class="mb-2">
											<input type="file" class="form-control" id="employee_master"  accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  name="employee_master">
										</div>
									<?php } ?>
								</div>
								<div class="modal fade" id="modal-delete-confirm-employee-master" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<h5 class="modal-title" id="verticalCenterTitle"> &nbsp; </h5>
											<div class="modal-body text-center">
												<div class="swal2-header"><div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"><span class="swal2-icon-text">!</span></div><h4 class="swal2-title" id="swal2-title" style="display: center;"><?=$DeleteImageConfirmMsg;?></h4></div>
												<div class="" style="text-align:center;">
													<button type="button" class="btn btn-success" onclick="delete_employee_master(<?php echo $EditData->id;?>);" data-dismiss="modal"><?=$Yes;?></button>
													<button type="button" class="btn btn-danger" data-dismiss="modal"><?=$No;?></button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
							<div class="row">
								<div class="form-group col-md-12">
									<?php if($urisegment) { ?>
										<button type="submit" class="btn btn-primary" name="btn_update" value="updatesbu"><?=$BTN_Update;?></button>
									<?php } else { ?>
										<button type="submit" class="btn btn-primary" name="btn_submit" value="addsbu"><?=$BTN_Submit;?></button>
									<?php } ?>
									<a href="<?=site_url();?>ctt-admin/sbu-listing" class="btn btn-danger"><?=$BTN_Cancel;?></a>
									<button type="reset" class="btn btn-warning" name="signup" value="Sign up"><?=$BTN_Reset;?></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- end Validation row  -->
	</div>
	<!-- end container-fluid -->
</div>
<script type="text/javascript">

//Function for Add more
function addrow()
{
	var projectPath = $('#projectPath').val();
	var div_count = $('#div_count').val();
	var divs = $('#divs').val();
	div_count++;
	var numbersArray = divs.split(',');
	numbersArray.push(div_count);
	$.ajax(
	{
		url: projectPath+"CttAdmin/Sbu/AddMoreSbu",
		type: "POST",
		cache: false,
		data:'div_name='+div_count,
		async: false,
		success: function(data)
		{
			$("#product_sizes").append(data);
			$("#div_count").val(div_count);
			$("#divs").val(numbersArray);
		}
	});
}
//function for get Bed Price
 function removerow(div)
{
	var div_count = $('#div_count').val();
	$("#set_"+div).remove();
	var divs = $('#divs').val();
	var numbersArray = divs.split(',');
	var result = jQuery.grep(numbersArray, function(value) {
	  return value != div;
	});
	$("#divs").val(result);
}
function numbersonly(e)
{
	var unicode=e.charCode? e.charCode : e.keyCode
	if (unicode!=8){ //if the key isn't the backspace key (which we should allow)
		if ((unicode<46 || unicode>57) && unicode!=9 && unicode!=47) //if not a number  
		return false //disable key press    
	}
}

$(document).ready(function () {
  $('#userForm').validate({
  ignore: [],
	rules: {
	  company_id: {
		required: true,
	  },
	  company_logo: {
		required: true,
	  },
	  land_line: {
		required: true,
	  },
	  mobile: {
		required: true,
	  },
	  corporate_address: {
		required: true,
	  },
	  correspondence_address: {
		required: true,
	  },
	  email: {
		required: true,
		email: true,
	  },
	  contact_name: {
		required: true,
	  },
	  contact_phone: {
		required: true,
	  },
	  contact_email: {
		required: true,
		email: true,
	  },
	  company_type: {
		required: true,
	  },
	  industry_id: {
		required: true,
	  },
	  sbu_id: {
		required: true,
	  },
	  department_code_1: {
		required: true,
	  },
	  department_name_1: {
		required: true,
	  },
	},
	messages: {
	  company_id: {
		required: "Please select organisation name",
	  },
	  company_logo: {
		required: "Please enter company logo",
	  },
	  land_line: {
		required: "Please enter landline",
	  },
	  mobile: {
		required: "Please enter mobile",
	  },
	  corporate_address: {
		required: "Please enter corporate address",
	  },
	  correspondence_address: {
		required: "Please enter correspondence address",
	  },
	  email: {
		required: "Please enter email address",
		email: "Please enter a valid email address",
	  },
	  contact_name: {
		required: "Please enter contact name",
	  },
	  contact_phone: {
		required: "Please enter contact mobile no",
	  },
	  contact_email: {
		required: "Please enter contact mobile no",
		email: "Please enter a valid email address",
	  },
	  company_type: {
		required: "Please enter contact type",
	  },
	  industry_id: {
		required: "Please enter industry",
	  },
	  sbu_id: {
		required: "Please enter sbu id",
	  },
	  department_code_1: {
		required: "Please enter department code",
	  },
	  department_name_1: {
		required: "Please enter department name",
	  },
	},
	errorElement: 'span',
	errorPlacement: function (error, element) {
	  error.addClass('invalid-feedback');
	  element.closest('.form-group').append(error);
	},
	highlight: function (element, errorClass, validClass) {
	  $(element).addClass('is-invalid');
	},
	unhighlight: function (element, errorClass, validClass) {
	  $(element).removeClass('is-invalid');
	}
  });
  
  jQuery.validator.addMethod("ckrequired", function (value, element) {  
            var idname = $(element).attr('id');  
            var editor = CKEDITOR.instances[idname];  
            var ckValue = GetTextFromHtml(editor.getData()).replace(/<[^>]*>/gi, '').trim();  
            if (ckValue.length === 0) {  
                $(element).val(ckValue);  
				 $(element).next().css('border', '1px solid red');
            } else {  
                $(element).val(editor.getData());  
				$(element).next().css('border', '');
            }  
            return $(element).val().length > 0;  
        }, "This field is required");  
  
function GetTextFromHtml(html) {  
            var dv = document.createElement("DIV");  
            dv.innerHTML = html;  
            return dv.textContent || dv.innerText || "";  
        }  
});

function numberdecimal(e)
{
	 var unicode=e.charCode? e.charCode : e.keyCode 
	 if (unicode!=8)
	 { 
	  if ((unicode<48 || unicode>57) && unicode!=9 && unicode!=46)  
	  return false //disable key press    
	 }
}

function delete_vendor_master(id)
{
	var projectPath = $("#projectPath").val();
	//alert(projectPath);
	$.ajax(
	{ 
		url: projectPath+"ctt-admin/delete-vendor-master",
		type: "POST",
		cache: false,
		data:'id='+id,
		async: false,
		success: function(data) 
		{
			//alert(data);
			Command: toastr["success"]("Image Deleted Successfully !")
			toastr.options = {
			  "closeButton": true,
			  "debug": false,
			  "newestOnTop": false,
			  "progressBar": true,
			  "positionClass": "toast-top-right",
			  "preventDuplicates": false,
			  "onclick": null,
			  "showDuration": 300,
			  "hideDuration": 1000,
			  "timeOut": 5000,
			  "extendedTimeOut": 1000,
			  "showEasing": "swing",
			  "hideEasing": "linear",
			  "showMethod": "fadeIn",
			  "hideMethod": "fadeOut"
			}
			$("#upload_cin_no_file").html(data);
		} 
	});
}

function delete_employee_master(id)
{
	var projectPath = $("#projectPath").val();
	//alert(projectPath);
	$.ajax(
	{ 
		url: projectPath+"ctt-admin/delete-employee-master",
		type: "POST",
		cache: false,
		data:'id='+id,
		async: false,
		success: function(data) 
		{
			//alert(data);
			Command: toastr["success"]("Image Deleted Successfully !")
			toastr.options = {
			  "closeButton": true,
			  "debug": false,
			  "newestOnTop": false,
			  "progressBar": true,
			  "positionClass": "toast-top-right",
			  "preventDuplicates": false,
			  "onclick": null,
			  "showDuration": 300,
			  "hideDuration": 1000,
			  "timeOut": 5000,
			  "extendedTimeOut": 1000,
			  "showEasing": "swing",
			  "hideEasing": "linear",
			  "showMethod": "fadeIn",
			  "hideMethod": "fadeOut"
			}
			$("#upload_employee_master").html(data);
		} 
	});
}


function get_sbu(company_id)
{
	var projectPath = $("#projectPath").val();
	$.ajax(
	 { 
		  url: projectPath+"CttAdmin/Sbu/Get_Sbu",
		  type: "POST",
		  cache: false,
		   data:"company_id="+company_id,
		  async: false,
		  success: function(data) 
		  {
			$("#sbu_id").html(data);
		  } 
	 });
}

</script>
<div id="errormodal" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-close-area modal-close-df">
				<a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
			</div>
			<div class="modal-body">
				<span class="educate-icon educate-danger modal-check-pro information-icon-pro"></span>
				<h2>OOPS!</h2>
				<?php
					$session = \Config\Services::session($config);
				$error_msg = $session->getFlashdata('error_msg'); ?>
				<h4><?=$error_msg;?></h4>
			</div>
			<div class="modal-footer danger-md">
				<a data-dismiss="modal" href="#">Close</a>
			</div>
		</div>
	</div>
</div>