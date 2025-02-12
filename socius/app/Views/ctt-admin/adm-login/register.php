<?php
use App\Models\Admin; $this->admin = new Admin();
$this->uri = new \CodeIgniter\HTTP\URI(current_url());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$ProjectName;?> | Sign Up</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Admin template that can be used to build dashboards for CRM, CMS, etc." />
    <meta name="author" content="Potenza Global Solutions" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- app favicon -->
    <link rel="shortcut icon" href="<?=site_url();?>public/assets/admin/img/favicon.ico">
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <!-- plugin stylesheets -->
    <link rel="stylesheet" type="text/css" href="<?=site_url();?>public/assets/admin/css/vendors.css" />
    <!-- app style -->
    <link rel="stylesheet" type="text/css" href="<?=site_url();?>public/assets/admin/css/style.css" />
</head>
<body class="bg-white">
    <!-- begin app -->
    <div class="app">
        <!-- begin app-wrap -->
        <div class="app-wrap">
            <!-- begin pre-loader -->
            <div class="loader">
                <div class="h-100 d-flex justify-content-center">
                    <div class="align-self-center">
                        <img src="<?=site_url();?>public/assets/admin/img/loader/loader.svg" alt="loader">
                    </div>
                </div>
            </div>
            <!-- end pre-loader -->

            <!--start login contant-->
            <div class="app-contant">
                <div class="bg-white">
                    <div class="container-fluid p-0">
                        <div class="row no-gutters">
                            <div class="col-sm-6 col-lg-5 col-xxl-3  align-self-center order-2 order-sm-1">
                                <div class="d-flex align-items-center h-100-vh">
                                    <div class="login p-50">
										<img class="img-fluid" src="<?=site_url();?>public/assets/admin/img/logo-light.png" alt="">
                                        <h1 class="mb-2 text-center"><?=$AdminPanel;?></h1>
                                        <p><?=$SignUp;?></p>
										<?php  
										$session = \Config\Services::session();
										$error_msg = $session->getFlashdata('error_msg');
										if(!empty($error_msg)){
											echo '<div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">
                                                    '.$error_msg.'
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <i class="ti ti-close"></i>
                                                    </button>
                                                </div>';
										}
										$success_msg = $session->getFlashdata('success_msg');
										if(!empty($success_msg)){
											echo '<div class="alert alert-success alert-dismissible fade show mt-1" role="alert">
                                                    '.$success_msg.'
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <i class="ti ti-close"></i>
                                                    </button>
                                                </div>';
										}
										?>
                                       <form action="" method="post" id="forgotForm" role="form" autocomplete="off">
                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><?=$EmailAddress;?>*</label>
                                                        <input type="text"  name="email" id="email" placeholder="Enter Your Email Address" class="form-control" maxlength="70"/>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-block d-sm-flex  align-items-center">
                                                        <!--<div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="gridCheck">
                                                            <label class="form-check-label" for="gridCheck">
                                                                Remember Me
                                                            </label>
                                                        </div>-->
                                                        <a href="<?=site_url();?>ctt-admin/login" class="ml-auto">Back to <?=$SignIn;?></a>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <button type="submit" name="submit" value="signup" class="btn btn-primary text-uppercase"><?=$BTN_Submit;?></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xxl-9 col-lg-7 bg-gradient o-hidden order-1 order-sm-2">
                                <div class="row align-items-center h-100">
                                    <div class="col-7 mx-auto ">
                                        <img class="img-fluid" src="<?=site_url();?>public/assets/admin/img/bg/login.svg" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end login contant-->
        </div>
        <!-- end app-wrap -->
    </div>
    <!-- end app -->
    <!-- plugins -->
    <script src="<?=site_url();?>public/assets/admin/js/vendors.js"></script>
    <!-- custom app -->
    <script src="<?=site_url();?>public/assets/admin/js/app.js"></script>
	<script type="text/javascript">
	$(document).ready(function () {
	  $('#forgotForm').validate({
		rules: {
		  email: {
			required: true,
			email: true,
		  },
		},
		messages: {
		  email: {
			required: "Please enter a email address",
			email: "Please enter a vaild email address"
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
</body>
</html>