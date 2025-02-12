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
								<li class="breadcrumb-item active text-primary" aria-current="page"><?php if($urisegment) { echo $BTN_Edit; } else { echo $BTN_Add; } ?> <?=$ME_Employee;?></li>
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
							<a href="<?=site_url();?>ctt-admin/employee-listing" class="btn btn-primary btn-sm"><i class="ti ti-arrow-left"></i> <?=$BTN_Back;?></a>
						</div>
					</div>
					<div class="card-body">
						<form method="post" id="userEmployee" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
							<div class="row">
								<div class="form-group col-md-6">
									<label class="control-label" for="organisation_id"><?=$ME_Organisation_Name;?> <span class="text-danger">*</span></label>
									<div class="mb-2 selects-contant">
										<select class="js-basic-single form-control" name="organisation_id" id="organisation_id" onchange="return get_sbu();">
											<option value=""><?=$ME_Select_Organisation;?></option>
											<?php 
											$QsOrganisation = $this->admin->retrive_all_cond_data('*',tbl_organisation, 'is_active=1', 'company_name','ASC');
											foreach($QsOrganisation as $RsOrganisation) { ?>
											<option value="<?=$RsOrganisation->id;?>" <?php if($EditData->organisation_id == $RsOrganisation->id) {?>selected<?php } ?> ><?=$this->admin->HtmlStripSlash($RsOrganisation->company_name);?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="sbu_id"><?=$ME_SBU_Name;?> <span class="text-danger">*</span></label>
									<div class="mb-2 selects-contant">
										<select class="js-basic-single form-control" name="sbu_id" id="sbu_id">
											<option value=""><?=$ME_Select_SBU;?></option>
											<?php if($urisegment) {
											$QsOrgSbu = $this->admin->retrive_all_cond_data('*',tbl_sbu, 'is_active=1', 'sbu_name','ASC');
											foreach($QsOrgSbu as $RsOrgSbu) { ?>
											<option value="<?=$RsOrgSbu->id;?>" <?php if($EditData->organisation_sbu_id == $RsOrgSbu->id) {?>selected<?php } ?> ><?=$this->admin->HtmlStripSlash($RsOrgSbu->sbu_name);?></option>
											<?php } } ?>
										</select>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="employee_name"><?=$ME_Employee_Name;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="employee_name" name="employee_name" placeholder="Enter Employee Name" maxlength="80" value="<?php if($urisegment) { if(isset($_POST['employee_name'])) { echo $_POST['employee_name']; } else { echo $this->admin->HtmlStripSlash($EditData->employee_name); } }  else { if(isset($_POST['employee_name'])) { echo $_POST['employee_name']; } } ?>"/>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="employee_email"><?=$ME_Employee_Email;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="employee_email" name="employee_email" placeholder="Enter Employee Email" maxlength="80" value="<?php if($urisegment) { if(isset($_POST['employee_email'])) { echo $_POST['employee_email']; } else { echo $this->admin->HtmlStripSlash($EditData->employee_email); } }  else { if(isset($_POST['employee_email'])) { echo $_POST['employee_email']; } } ?>"/>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<?php if($urisegment) { ?>
										<button type="submit" class="btn btn-primary" name="btn_update" value="updateoffers"><?=$BTN_Update;?></button>
									<?php } else { ?>
										<button type="submit" class="btn btn-primary" name="btn_submit" value="addoffers"><?=$BTN_Submit;?></button>
									<?php } ?>
									<a href="<?=site_url();?>ctt-admin/employee-listing" class="btn btn-danger"><?=$BTN_Cancel;?></a>
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
function get_sbu()
{
	var projectPath = $('#projectPath').val();
	var organisation_id = $('#organisation_id').val();
	$.ajax(
	{
		url: projectPath+"ctt-admin/employee/getsbu",
		type: "POST",
		cache: false,
		data:'organisation_id='+organisation_id,
		async: false,
		success: function(data)
		{
			//alert(data);
			$("#sbu_id").html(data);
			
		}
	});
}
$(document).ready(function () {
  $('#userEmployee').validate({
  ignore: [],
	rules: {
	  organisation_id: {
		required: true,
	  },
	  sbu_id: {
		required: true,
	  },
	  employee_name: {
		required: true,
	  },
	  employee_email: {
		required: true,
		email: true,
	  },
	},
	messages: {
	  organisation_id: {
		required: "Please select organisation",
	  },
	  sbu_id: {
		required: "Please select sub",
	  },
	  employee_name: {
		required: "Please enter employee name",
	  },
	  employee_email: {
		required: "Please enter employee email",
		email: "Please enter a valid email",
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
  
    //Validation For Ckeditor Start
  jQuery.validator.addMethod("ckrequired", function (value, element) {  
            var idname = $(element).attr('id');  
            var editor = CKEDITOR.instances[idname];  
            var ckValue = GetTextFromHtml(editor.getData()).replace(/<[^>]*>/gi, '').trim();  
            if (ckValue.length === 0) {  
//if empty or trimmed value then remove extra spacing to current control  
                $(element).val(ckValue);  
				 $(element).next().css('border', '1px solid red');
            } else {  
//If not empty then leave the value as it is  
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
	 { //if the key isn't the backspace key (which we should allow)
	  if ((unicode<48 || unicode>57) && unicode!=9 && unicode!=46)  //if not a number  
	  return false //disable key press    
	 }
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