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
									<a href="<?=site_url();?>pk-admin/dashboard"><i class="ti ti-home"></i></a>
								</li>
								<li class="breadcrumb-item">
									<?=$Menu;?>
								</li>
								<li class="breadcrumb-item active text-primary" aria-current="page"><?php if($urisegment) { echo $BTN_Edit; } else { echo $BTN_Add; } ?> <?=$ST_Setting;?></li>
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
							<a href="<?=site_url();?>pk-admin/setting-listing" class="btn btn-primary btn-sm"><i class="ti ti-arrow-left"></i> <?=$BTN_Back;?></a>
						</div>
					</div>
					<div class="card-body">
						<form id="settingForm" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
							<div class="row">
								<div class="form-group col-md-6">
									<label class="control-label" for=""><?=$ST_Parameter_Id;?><span class="text-danger"></span></label>
									<div class="mb-2 selects-contant">
										<select class="js-basic-single form-control" name="parameter_id" id="parameter_id" disabled>
											<option value=""><?=$ST_SelectParameter;?></option>
											<?php 
											$QsParameter = $this->admin->retrive_all_cond_data('*',tbl_parameter, 'is_active=1', 'parameter_name','ASC');
											foreach($QsParameter as $RsParameter) { ?>
											<option value="<?=$RsParameter->id;?>" <?php if($EditData->parameter_id == $RsParameter->id) {?>selected<?php } ?> ><?=$this->admin->HtmlStripSlash($RsParameter->parameter_name);?></option>
											<?php } ?>
										</select>
										</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="parameter_value"><?=$ST_Parameter_Value;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="parameter_value" name="parameter_value" placeholder="Enter Parameter Value" maxlength="200" value="<?php if($urisegment) { if(isset($_POST['parameter_value'])) { echo $_POST['parameter_value']; } else { echo $this->admin->HtmlStripSlash($EditData->parameter_value); } }  else { if(isset($_POST['parameter_value'])) { echo $_POST['parameter_value']; } } ?>"/>
									</div>
								</div>
								
								
								
								
								<div class="modal fade" id="modal-delete-confirm" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<h5 class="modal-title" id="verticalCenterTitle"> &nbsp; </h5>
										<div class="modal-body text-center">
											<div class="swal2-header"><div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"><span class="swal2-icon-text">!</span></div><h4 class="swal2-title" id="swal2-title" style="display: center;"><?=$DeleteImageConfirmMsg;?></h4></div>
											<div class="" style="text-align:center;">
												<button type="button" class="btn btn-success" onclick="delete_user_image(<?php echo $EditData->
												id;?>);" data-dismiss="modal"><?=$Yes;?></button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><?=$No;?></button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="modal fade" id="modal-delete-inactive-confirm" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<h5 class="modal-title" id="verticalCenterTitle"> &nbsp; </h5>
										<div class="modal-body text-center">
											<div class="swal2-header"><div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"><span class="swal2-icon-text">!</span></div><h4 class="swal2-title" id="swal2-title" style="display: center;"><?=$DeleteImageConfirmMsg;?></h4></div>
											<div class="" style="text-align:center;">
												<button type="button" class="btn btn-success" onclick="delete_inactive_image(<?php echo $EditData->
												id;?>);" data-dismiss="modal"><?=$Yes;?></button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><?=$No;?></button>
											</div>
										</div>
									</div>
								</div>
							</div>
								<div class="form-group col-md-12">
									<?php if($urisegment) { ?>
									<button type="submit" class="btn btn-primary" name="btn_update" value="updatesetting"><?=$BTN_Update;?></button>
									<?php } else { ?>
									<button type="submit" class="btn btn-primary" name="btn_submit" value="addsetting"><?=$BTN_Submit;?></button>
									<?php } ?>
									<a href="<?=site_url();?>pk-admin/setting-listing" class="btn btn-danger"><?=$BTN_Cancel;?></a>
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
$(document).ready(function () {
  $('#settingForm').validate({
	rules: {
	  parameter_name: {
		required: true
	  },
	   parameter_value: {
		required: true
	  },
	  
},
	messages: {
	  parameter_name: {
		required: "Please enter parameter name"
	  },
	  parameter_value: {
		required: "Please enter parameter value"
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
});


//function for Delete User Image
function delete_user_image(id)
{
	var projectPath = $("#projectPath").val();
	//alert(projectPath);
	$.ajax(
	{ 
		url: projectPath+"pk-admin/delete-user-image",
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
			$("#upload_image").html(data);
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