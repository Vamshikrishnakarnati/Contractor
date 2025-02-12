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
								<li class="breadcrumb-item active text-primary" aria-current="page"><?php if($urisegment) { echo $BTN_Edit; } else { echo $BTN_Add; } ?> <?=$MO_Organisation;?></li>
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
							<a href="<?=site_url();?>ctt-admin/organisation-listing" class="btn btn-primary btn-sm"><i class="ti ti-arrow-left"></i> <?=$BTN_Back;?></a>
						</div>
					</div>
					<div class="card-body">
						<form id="userForm" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
							<div class="row">
								<div class="form-group col-md-6">
									<label class="control-label" for="industry_id"><?=$MO_industry;?> <span class="text-danger">*</span></label>
									<div class="mb-2 selects-contant">
										<select class="js-basic-single form-control" name="industry_id" id="industry_id">
											<option value=""><?=$MO_Select_industry;?></option>
											<?php 
											$QsIndustry = $this->admin->retrive_all_cond_data('*',tbl_industry, 'is_active=1', 'industry_name','ASC');
											foreach($QsIndustry as $RsIndustry) { ?>
											<option value="<?=$RsIndustry->id;?>" <?php if($EditData->industry_id == $RsIndustry->id) {?>selected<?php } ?> ><?=$this->admin->HtmlStripSlash($RsIndustry->industry_name);?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="company_name"><?=$MO_Company_Name;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter Company Name" maxlength="80" value="<?php if($urisegment) { if(isset($_POST['company_name'])) { echo $_POST['company_name']; } else { echo $this->admin->HtmlStripSlash($EditData->company_name); } }  else { if(isset($_POST['company_name'])) { echo $_POST['company_name']; } } ?>"/>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="company_logo"><?=$MO_Company_Logo;?> <span class="text-danger">*</span></label>
									<?php if($urisegment && $EditData->company_logo != "" && file_exists($MO_ImageViewPath.$EditData->company_logo))
									{  ?>
									<div id="upload_image">
										<div class="col-md-6 mb-2 mb-xs-0">
											<img class="img-fluid" style src="<?=site_url();?><?=$MO_ImageViewPath.$EditData->company_logo;?>" alt="">
										</div>
										<div class="row m-b-20">
											<div class="form-group col-md-6">
												<div class="mt-4 text-center">
													<a href="javascript:void(0);" data-tooltip="tooltip" data-toggle="modal" title="Delete Image" data-target="#modal-delete-confirm" class="btn btn-icon btn-outline-danger"><i class="dripicons dripicons dripicons-trash"></i></i></a>
												</div>		
											</div>		
										</div>		
									</div>	
									<div class="modal fade" id="modal-delete-confirm" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<h5 class="modal-title" id="verticalCenterTitle"> &nbsp; </h5>
												<div class="modal-body text-center">
													<div class="swal2-header"><div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"><span class="swal2-icon-text">!</span></div><h4 class="swal2-title" id="swal2-title" style="display: center;"><?=$DeleteImageConfirmMsg;?></h4></div>
													<div class="" style="text-align:center;">
														<button type="button" class="btn btn-success" onclick="delete_image(<?php echo $EditData->id;?>);"
														 data-dismiss="modal"><?=$Yes;?></button>
														<button type="button" class="btn btn-danger" data-dismiss="modal"><?=$No;?></button>
													</div>
												</div>
											</div>
										</div>
									</div>
									<input name="hidden_image" type="hidden" id="hidden_image"  class="form-control" value="<?php if($urisegment) { echo $EditData->company_logo; } ?>">	
									<?php }
									else { ?>
										<div class="mb-2">
											<input type="file"  class="form-control" id="company_logo" name="company_logo" accept="image/*"/>
										</div>
									<?php } ?>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="landline"><?=$MO_Phone_Landline;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="landline" name="landline" placeholder="Enter Phone Landline" maxlength="15" minlength ="10" onkeypress="return numbersonly(event);" value="<?php if($urisegment) { if(isset($_POST['landline'])) { echo $_POST['landline']; } else { echo $this->admin->HtmlStripSlash($EditData->landline); } }  else { if(isset($_POST['landline'])) { echo $_POST['landline']; } } ?>"/>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="mobile"><?=$MO_Phone_Mobile;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Phone" onkeypress="return numbersonly(event)" maxlength="15"  minlength="10" value="<?php if($urisegment) { if(isset($_POST['mobile'])) { echo $_POST['mobile']; } else { echo $this->admin->HtmlStripSlash($EditData->mobile); } }  else { if(isset($_POST['mobile'])) { echo $_POST['mobile']; } } ?>"/>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="email"><?=$MO_Email;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" maxlength="50" value="<?php if($urisegment) { if(isset($_POST['email'])) { echo $_POST['email']; } else { echo $this->admin->HtmlStripSlash($EditData->email); } }  else { if(isset($_POST['email'])) { echo $_POST['email']; } } ?>"/>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="corporate_address"><?=$MO_Corporate_Address;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<textarea rows="4" class="form-control" id="corporate_address" name="corporate_address" placeholder="Enter Corporate Address"><?php if($urisegment) { if(isset($_POST['corporate_address'])) { echo $_POST['corporate_address']; } else { echo $this->admin->HtmlStripSlash($EditData->corporate_address); } }  else { if(isset($_POST['corporate_address'])) { echo $_POST['corporate_address']; } } ?></textarea>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="correspondence_address"><?=$MO_Correspondence_Address;?><span class="text-danger">*</span></label>
									<div class="mb-2">
										<textarea rows="4" class="form-control" id="correspondence_address" name="correspondence_address" placeholder="Enter Correspondence Address"><?php if($urisegment) { if(isset($_POST['correspondence_address'])) { echo $_POST['correspondence_address']; } else { echo $this->admin->HtmlStripSlash($EditData->correspondence_address); } }  else { if(isset($_POST['correspondence_address'])) { echo $_POST['correspondence_address']; } } ?></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h4>Single Point of Contact</h4>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="contact_name"><?=$MO_Contact_Name;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Enter Contact Name" maxlength="50" value="<?php if($urisegment) { if(isset($_POST['contact_name'])) { echo $_POST['contact_name']; } else { echo $this->admin->HtmlStripSlash($EditData->contact_name); } }  else { if(isset($_POST['contact_name'])) { echo $_POST['contact_name']; } } ?>"/>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="contact_mobile"><?=$MO_Contact_Mobile;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="contact_mobile" name="contact_mobile" placeholder="Enter Contact Mobile" onkeypress="return numbersonly(event)" maxlength="15" minlength="10" value="<?php if($urisegment) { if(isset($_POST['contact_mobile'])) { echo $_POST['contact_mobile']; } else { echo $this->admin->HtmlStripSlash($EditData->contact_mobile); } }  else { if(isset($_POST['contact_mobile'])) { echo $_POST['contact_mobile']; } } ?>"/>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="contact_email"><?=$MO_Contact_Email;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="contact_email" name="contact_email" placeholder="Enter Contact Email" maxlength="30" value="<?php if($urisegment) { if(isset($_POST['contact_email'])) { echo $_POST['contact_email']; } else { echo $this->admin->HtmlStripSlash($EditData->contact_email); } }  else { if(isset($_POST['contact_email'])) { echo $_POST['contact_email']; } } ?>"/>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="company_type"><?=$MO_Company_Type;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="company_type" name="company_type" placeholder="Enter Company Type" maxlength="80" value="<?php if($urisegment) { if(isset($_POST['company_type'])) { echo $_POST['company_type']; } else { echo $this->admin->HtmlStripSlash($EditData->company_type); } }  else { if(isset($_POST['company_type'])) { echo $_POST['company_type']; } } ?>"/>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="organisation_id"><?=$MO_Organisation_Id;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="organisation_id" name="organisation_id" placeholder="Enter Organisation Id" maxlength="10" value="<?php if($urisegment) { if(isset($_POST['organisation_id'])) { echo $_POST['organisation_id']; } else { echo $this->admin->HtmlStripSlash($EditData->organisation_id); } }  else { if(isset($_POST['organisation_id'])) { echo $_POST['organisation_id']; } } ?>"/>
									</div>
								</div>
							</div>
							<div id="product_sizes">
								<?php 
								$Divs = '';
								$i=0; 
								if($urisegment) {
								if(!empty($QsSBU)) {
									foreach($QsSBU as $RsSBU) { $i++;?>
									<div class="row" id="set_<?php echo $i; ?>">
										<div class="form-group col-md-5">
											<label class="control-label" for="sbu_name_<?php echo $i; ?>"><?=$MO_SBU_Name;?> <span class="text-danger">*</span></label>
											<div class="mb-2">
												<input type="text" class="form-control" id="sbu_name_<?php echo $i; ?>" name="sbu_name_<?php echo $i; ?>" placeholder="Enter SBU Name" maxlength="50" value="<?php if($urisegment) { if(isset($_POST['sbu_name'])) { echo $_POST['sbu_name']; } else { echo $this->admin->HtmlStripSlash($RsSBU->sbu_name); } }  else { if(isset($_POST['sbu_name'])) { echo $_POST['sbu_name']; } } ?>"/>
											</div>
										</div>
										<div class="form-group col-md-5">
											<label class="control-label" for="location_<?php echo $i; ?>"><?=$MO_Location;?> <span class="text-danger">*</span></label>
											<div class="mb-2">
												<input type="text" class="form-control" id="location_<?php echo $i; ?>" name="location_<?php echo $i; ?>" placeholder="Enter Location" maxlength="100" value="<?php if($urisegment) { if(isset($_POST['location'])) { echo $_POST['location']; } else { echo $this->admin->HtmlStripSlash($RsSBU->location); } }  else { if(isset($_POST['location'])) { echo $_POST['location']; } } ?>"/>
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
								<?php } } } else { ?>
								<div class="row" id="set_1">
									<div class="form-group col-md-5">
										<label class="control-label" for="sbu_name_1"><?=$MO_SBU_Name;?> <span class="text-danger">*</span></label>
										<div class="mb-2">
											<input type="text" class="form-control" id="sbu_name_1" name="sbu_name_1" placeholder="Enter SBU Name" maxlength="50" value="<?php if($urisegment) { if(isset($_POST['sbu_name'])) { echo $_POST['sbu_name']; } else { echo $this->admin->HtmlStripSlash($EditData->sbu_name); } }  else { if(isset($_POST['sbu_name'])) { echo $_POST['sbu_name']; } } ?>"/>
										</div>
									</div>
									<div class="form-group col-md-5">
										<label class="control-label" for="location"><?=$MO_Location;?> <span class="text-danger">*</span></label>
										<div class="mb-2">
											<input type="text" class="form-control" id="location_1" name="location_1" placeholder="Enter Location" maxlength="100" value="<?php if($urisegment) { if(isset($_POST['location'])) { echo $_POST['location']; } else { echo $this->admin->HtmlStripSlash($EditData->location); } }  else { if(isset($_POST['location'])) { echo $_POST['location']; } } ?>"/>
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
										<button type="submit" class="btn btn-primary" name="btn_update" value="updateoffers"><?=$BTN_Update;?></button>
									<?php } else { ?>
										<button type="submit" class="btn btn-primary" name="btn_submit" value="addoffers"><?=$BTN_Submit;?></button>
									<?php } ?>
									<a href="<?=site_url();?>ctt-admin/organisation-listing" class="btn btn-danger"><?=$BTN_Cancel;?></a>
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
		url: projectPath+"CttAdmin/Organisation/AddMoreOrganisation",
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
	  company_name: {
		required: true,
	  },
	  company_logo: {
		required: true,
	  },
	  landline: {
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
	  contact_mobile: {
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
	  organisation_id: {
		required: true,
	  },
	  sbu_name_1: {
		required: true,
	  },
	  location_1: {
		required: true,
	  },
	},
	messages: {
	  company_name: {
		required: "Please enter company name",
	  },
	  company_logo: {
		required: "Please enter company logo",
	  },
	  landline: {
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
	  contact_mobile: {
		required: "Please enter contact mobile no",
	  },
	  contact_email: {
		required: "Please enter contact mobile no",
		email: "Please enter a valid email address",
	  },
	  company_type: {
		required: "Please enter company type",
	  },
	  industry_id: {
		required: "Please enter industry",
	  },
	  organisation_id: {
		required: "Please enter organisation id",
	  },
	  sbu_name_1: {
		required: "Please enter SUB name",
	  },
	  location_1: {
		required: "Please enter location",
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

//function for Delete Complain Image
function delete_image(id)
{
	var projectPath = $("#projectPath").val();
	//alert(projectPath);
	$.ajax(
	{ 
		url: projectPath+"ctt-admin/delete-organisation-image",
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