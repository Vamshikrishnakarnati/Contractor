<div class="app-main" id="main">
	<!-- begin container-fluid -->
	<div class="container-fluid">
		<!-- begin row -->
		<div class="row">
			<div class="col-md-12 m-b-30">
				<!-- begin page title -->
				<div class="d-block d-sm-flex flex-nowrap align-items-center">
					<div class="page-title mb-2 mb-sm-0">
					</div>
					<div class="ml-auto d-flex align-items-center">
						<nav>
							<ol class="breadcrumb p-0 m-b-0">
								<li class="breadcrumb-item">
									<a href="<?=site_url();?>ctt-admin/dashboard"><i class="ti ti-home"></i></a>
								</li>
								<li class="breadcrumb-item">
									Settings
								</li>
								<li class="breadcrumb-item active text-primary" aria-current="page"><?=$ChangePassword;?></li>
							</ol>
						</nav>
					</div>
				</div>
				<!-- end page title -->
			</div>
		</div>
		<div class="col-xl-12">
			<div class="card card-statistics">
				<div class="card-header">
					<div class="card-heading">
						<h4 class="card-title"><?=$ChangePassword;?></h4>
					</div>
				</div>
				<div class="card-body">
					 <form role="form" id="changepassForm" method="post" autocomplete="off">
						<div class="form-group">
							<label for="exampleInputEmail1"><?=$OldPassword;?><sup class="text-danger">*</sup></label>
							<input type="password" name="Old_Password" id="Old_Password" class="form-control" placeholder="Enter old password" maxlength="50">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1"><?=$NewPassword;?><sup class="text-danger">*</sup></label>
							<input type="password" name="New_Password" id="New_Password" class="form-control" placeholder="Enter new password" maxlength="50">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1"><?=$ConfirmPassword;?><sup class="text-danger">*</sup></label>
							<input type="password" name="Confirm_Password" id="Confirm_Password" class="form-control" placeholder="Enter confirm password" maxlength="50">
						</div>
						<button type="submit" name="btn_update" value="changepass" class="btn btn-primary"><?=$BTN_Submit;?></button>
						<a href="<?=site_url();?>ctt-admin/dashboard" class="btn btn-danger"><?=$BTN_Cancel;?></a>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function () {
  $('#changepassForm').validate({
    rules: {
      Old_Password: {
        required: true
      },
	  New_Password: {
        required: true,
		minlength: 6
      },
	  Confirm_Password: {
        required: true,
		equalTo: "#New_Password"
      },
    },
    messages: {
      Old_Password: {
        required: "Please enter old password"
      },
	  New_Password: {
        required: "Please enter new password",
		minlength: "Your password must be at least 6 characters long"
      },
	  Confirm_Password: {
        required: "Please enter confirm password",
		equalTo: "New password and confirm password mismatch"
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
</script>