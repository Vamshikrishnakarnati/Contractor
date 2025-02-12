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
								<li class="breadcrumb-item active text-primary" aria-current="page"><?php if($urisegment) { echo $BTN_Edit; } else { echo $BTN_Add; } ?></li>
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
							<a href="<?=site_url();?>ctt-admin/key-manager-listing" class="btn btn-primary btn-sm"><i class="ti ti-arrow-left"></i> <?=$BTN_Back;?></a>
						</div>
					</div>
					<div class="card-body">
						<form id="userForm" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
							<div class="row">
								<div class="form-group col-md-6">
									<label class="control-label" for="admin_name"><?=$MKM_KeyManagerName;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="admin_name" name="admin_name" placeholder="Enter Manager Name" maxlength="80" value="<?php if($urisegment) { if(isset($_POST['admin_name'])) { echo $_POST['admin_name']; } else { echo $this->admin->HtmlStripSlash($EditData->admin_name); } }  else { if(isset($_POST['admin_name'])) { echo $_POST['admin_name']; } } ?>"/>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="admin_id"><?=$MKM_KeyManagerId;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="admin_id" name="admin_id" placeholder="Enter Manager Id" maxlength="10" value="<?php if($urisegment) { if(isset($_POST['admin_id'])) { echo $_POST['admin_id']; } else { echo $this->admin->HtmlStripSlash($EditData->admin_id); } }  else { if(isset($_POST['admin_id'])) { echo $_POST['admin_id']; } } ?>"/>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="admin_email"><?=$MKM_KeyManagerEmail;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="email" class="form-control" id="admin_email" name="admin_email" placeholder="Enter Manager Email" maxlength="80" value="<?php if($urisegment) { if(isset($_POST['admin_email'])) { echo $_POST['admin_email']; } else { echo $this->admin->HtmlStripSlash($EditData->admin_email); } }  else { if(isset($_POST['admin_email'])) { echo $_POST['admin_email']; } } ?>"/>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="admin_phone"><?=$MKM_KeyManagerPhone;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="admin_phone" name="admin_phone" placeholder="Enter Manager Phone" onkeypress="return numbersonly(event);" maxlength="15" minlength="10" value="<?php if($urisegment) { if(isset($_POST['admin_phone'])) { echo $_POST['admin_phone']; } else { echo $this->admin->HtmlStripSlash($EditData->admin_phone); } }  else { if(isset($_POST['admin_phone'])) { echo $_POST['admin_phone']; } } ?>"/>
									</div>
								</div>
								<div class="form-group col-md-12">
									<?php if($urisegment) { ?>
									<button type="submit" class="btn btn-primary" name="btn_update" value="updatekeymanager"><?=$BTN_Update;?></button>
									<?php } else { ?>
									<button type="submit" class="btn btn-primary" name="btn_submit" value="addkeymanager"><?=$BTN_Submit;?></button>
									<?php } ?>
									<a href="<?=site_url();?>ctt-admin/key-manager-listing" class="btn btn-danger"><?=$BTN_Cancel;?></a>
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
  $('#userForm').validate({
  ignore: [],
	rules: {
	  admin_name: {
		required: true,
	  },
	  admin_id: {
		required: true,
	  },
	  admin_email: {
		required: true,
	  },
	  admin_phone: {
		required: true,
	  },
	},
	messages: {
	  admin_name: {
		required: "Please enter manager name",
	  },
	  admin_id: {
		required: "Please enter manager id",
	  },
	  admin_email: {
		required: "Please enter manager email",
	  },
	  admin_phone: {
		required: "Please enter manager phone",
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