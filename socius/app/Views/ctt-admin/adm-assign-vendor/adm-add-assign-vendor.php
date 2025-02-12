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
								<li class="breadcrumb-item active text-primary" aria-current="page"><?php if($urisegment) { echo $BTN_Edit; } else { echo $BTN_Add; } ?> <?=$MAV_AssignVendor;?></li>
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
							<a href="<?=site_url();?>ctt-admin/assign-vendor-listing" class="btn btn-primary btn-sm"><i class="ti ti-arrow-left"></i> <?=$BTN_Back;?></a>
						</div>
					</div>
					<div class="card-body">
						<form id="userForm" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
							<div id="vendor_assigns">
								<?php 
								$Divs = '';
								$i=0; 
								if($urisegment && !empty($QsOtherOperationDept)) {
									foreach($QsOtherOperationDept as $RsOtherOperationDept) { $i++;?>
									<div class="row" id="set_<?php echo $i; ?>">
									
										<div class="form-group col-md-2">
											<label class="control-label" for="">Vendor Name<span class="text-danger"> *</span></label>
											<div class="mb-2 selects-contant">
												<select class="js-basic-single form-control cat"  name="vendor_id_<?php echo $i; ?>" id="vendor_id_<?php echo $i; ?>">
													<option value="">Select Vendor</option>
													<?php 
													$QsVendor = $this->admin->retrive_all_cond_data('*',tbl_vendor, 'is_active=1 AND is_delete = 0','id','ASC');
													if(!empty($QsVendor))
													{
														foreach($QsVendor as $RsVendor) {
														
													?>
													<option value="<?=$RsVendor->id;?>" <?php if($EditData->vendor_id == $RsVendor->id) {?>selected<?php } ?> ><?=$this->admin->HtmlStripSlash($RsVendor->company_name);?></option>
													<?php } } ?>
												</select>
											</div>
										</div>
									
										<div class="form-group col-md-3">
											<label class="control-label" for="">Organisation Name<span class="text-danger"> *</span></label>
											<div class="mb-2 selects-contant">
												<select class="js-basic-single form-control cat" name="company_id_<?php echo $i; ?>" onchange="get_sbu(this.value);" id="company_id_<?php echo $i; ?>">
													<option value="">Select Oraganisation</option>
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
											<label class="control-label" for="">Sbu Name<span class="text-danger"> *</span></label>
											<div class="mb-2 selects-contant">
												<select class="js-basic-single form-control cat" name="sbu_id_<?php echo $i; ?>" onchange="get_vendor_master(this.value);" id="sbu_id_<?php echo $i; ?>">
													<option value="">Select Sbu</option>
													<?php 
													$QsSbu = $this->admin->retrive_all_cond_data('*',tbl_sbu, 'is_active=1 AND is_delete = 0','id','ASC');
													if(!empty($QsSbu))
													{
														foreach($QsSbu as $RsSbu) {
														
													?>
													<option value="<?=$RsSbu->id;?>" <?php if($EditData->sbu_id == $RsSbu->id) {?>selected<?php } ?> ><?=$this->admin->HtmlStripSlash($RsSbu->sbu_name);?></option>
													<?php } } ?>
												</select>
											</div>
										</div>
										<div class="form-group col-md-3">
											<label class="control-label" for="">Vendor Master Name<span class="text-danger"> *</span></label>
											<div class="mb-2 selects-contant">
												<select class="js-basic-single form-control cat" name="vendor_master_id_<?php echo $i; ?>" id="vendor_master_id_<?php echo $i; ?>">
													<option value="">Select Vendor Master</option>
													<?php 
													$QsVendorMaster = $this->admin->retrive_all_cond_data('*',tbl_vendor_master, 'is_active=1 AND is_delete = 0','id','ASC');
													if(!empty($QsVendorMaster))
													{
														foreach($QsVendorMaster as $RsVendorMaster) {
														
													?>
													<option value="<?=$RsVendorMaster->id;?>" <?php if($EditData->vendor_master_id == $RsVendorMaster->id) {?>selected<?php } ?> ><?=$this->admin->HtmlStripSlash($RsVendorMaster->vendor_name);?></option>
													<?php } } ?>
												</select>
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
									<div class="form-group col-md-2">
										<label class="control-label" for="">Vendor Name<span class="text-danger"> *</span></label>
										<div class="mb-2 selects-contant">
											<select class="js-basic-single form-control cat" name="vendor_id_1" id="vendor_id_1">
												<option value="">Select Vendor</option>
												<?php 
												$QsVendor = $this->admin->retrive_all_cond_data('*',tbl_vendor, 'is_active=1 AND is_delete = 0','id','ASC');
												if(!empty($QsVendor))
												{
													foreach($QsVendor as $RsVendor) {
													
												?>
												<option value="<?=$RsVendor->id;?>" <?php if($EditData->vendor_id == $RsVendor->id) {?>selected<?php } ?> ><?=$this->admin->HtmlStripSlash($RsVendor->company_name);?></option>
												<?php } } ?>
											</select>
										</div>
									</div>
								
									<div class="form-group col-md-3">
										<label class="control-label" for="">Organisation Name<span class="text-danger"> *</span></label>
										<div class="mb-2 selects-contant">
											<select class="js-basic-single form-control cat"  name="company_id_1" onchange="get_sbu(this.value);" id="company_id_1">
												<option value="">Select Organisation</option>
												<?php 
												$QsOrganisation = $this->admin->retrive_all_cond_data('*',tbl_organisation, 'is_active=1 AND is_delete = 0','id','ASC');
												if(!empty($QsOrganisation))
												{
													foreach($QsOrganisation as $RsOrganisation) {
													
												?>
												<option value="<?=$RsOrganisation->id;?>" <?php if($EditData->company_id == $RsOrganisation->id) {?>selected<?php } ?> ><?=$this->admin->HtmlStripSlash($RsOrganisation->company_name);?></option>
												<?php } }  ?>
											</select>
										</div>
									</div>
									<div class="form-group col-md-2">
										<label class="control-label" for="">Sbu Name<span class="text-danger"> *</span></label>
										<div class="mb-2 selects-contant">
											<select class="js-basic-single form-control cat"  name="sbu_id_1" onchange="get_vendor_master(this.value);" id="sbu_id_1">
												<option value="">Select Sbu</option>
												<?php 
												if($urisegment) { 
												$QsSbu = $this->admin->retrive_all_cond_data('*',tbl_sbu, 'is_active=1 AND is_delete = 0','id','ASC');
												if(!empty($QsSbu))
												{
													foreach($QsSbu as $RsSbu) {
													
												?>
												<option value="<?=$RsSbu->id;?>" <?php if($EditData->sbu_id == $RsSbu->id) {?>selected<?php } ?> ><?=$this->admin->HtmlStripSlash($RsSbu->sbu_name);?></option>
												<?php } } } ?>
											</select>
										</div>
									</div>
									<div class="form-group col-md-3">
										<label class="control-label" for="">Vendor Master Name<span class="text-danger"> *</span></label>
										<div class="mb-2 selects-contant">
											<select class="js-basic-single form-control cat"  name="vendor_master_id_1" id="vendor_master_id_1">
												<option value="">Select Vendor Master</option>
												<?php 
												if($urisegment) { 
												$QsVendorMaster = $this->admin->retrive_all_cond_data('*',tbl_vendor_master, 'is_active=1 AND is_delete = 0','id','ASC');
												if(!empty($QsVendorMaster))
												{
													foreach($QsVendorMaster as $RsVendorMaster) {
													
												?>
												<option value="<?=$RsVendorMaster->id;?>" <?php if($EditData->vendor_master_id == $RsVendorMaster->id) {?>selected<?php } ?> ><?=$this->admin->HtmlStripSlash($RsVendorMaster->vendor_name);?></option>
												<?php } } } ?>
											</select>
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
						
							<div class="row">
								<div class="form-group col-md-12">
									<?php if($urisegment) { ?>
										<button type="submit" class="btn btn-primary" name="btn_update" value="updatesbu"><?=$BTN_Update;?></button>
									<?php } else { ?>
										<button type="submit" class="btn btn-primary" name="btn_submit" value="addsbu"><?=$BTN_Submit;?></button>
									<?php } ?>
									<a href="<?=site_url();?>ctt-admin/assign-vendor-listing" class="btn btn-danger"><?=$BTN_Cancel;?></a>
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
		url: projectPath+"CttAdmin/AssignVendor/AddMoreAssignVendor",
		type: "POST",
		cache: false,
		data:'div_name='+div_count,
		async: false,
		success: function(data)
		{
			$("#vendor_assigns").append(data);
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
	  vendor_id_1: {
		required: true,
	  },
	  company_id_1: {
		required: true,
	  },
	  sbu_id_1: {
		required: true,
	  },
	  vendor_master_id_1: {
		required: true,
	  },
	},
	messages: {
	  vendor_id_1: {
		required: "Please select vendor",
	  },
	  company_id_1: {
		required: "Please select organisation",
	  },
	  sbu_id_1: {
		required: "Please select sbu",
	  },
	  vendor_master_id_1: {
		required: "Please select vendor master",
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
		  url: projectPath+"CttAdmin/AssignVendor/Get_Sbu",
		  type: "POST",
		  cache: false,
		   data:"company_id="+company_id,
		  async: false,
		  success: function(data) 
		  {
			//alert(data);
			$("#sbu_id_1").html(data);
		  } 
	 });
}

function get_vendor_master(sbu_id)
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
			$("#vendor_master_id_1").html(data);
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