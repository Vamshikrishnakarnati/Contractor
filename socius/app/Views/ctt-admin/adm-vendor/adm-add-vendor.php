<?php
use App\Models\Admin; $this->admin = new Admin();
$this->uri = new \CodeIgniter\HTTP\URI(current_url());
?>
<div class="app-main" id="main">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 m-b-30">
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
								<li class="breadcrumb-item active text-primary" aria-current="page"><?php if($urisegment) { echo $BTN_Edit; } else { echo $BTN_Add; } ?> <?php  echo $MV_Vendor;?></li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<form id="userForm" method="post" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
			<div class="row formavlidation-wrapper">
				<div class="col-xl-12">
					<div class="card card-statistics">
						<div class="card-header">
							<div class="card-heading text-right">
								<a href="<?=site_url();?>ctt-admin/vendor-listing" class="btn btn-primary btn-sm"><i class="ti ti-arrow-left"></i> <?=$BTN_Back;?></a>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="form-group col-md-12">
									<label class="control-label" for="company_name"><?=$MV_CompanyName;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter Company Name" maxlength="80" value="<?php if($urisegment) { if(isset($_POST['company_name'])) { echo $_POST['company_name']; } else { echo $this->admin->HtmlStripSlash($EditData->company_name); } }  else { if(isset($_POST['company_name'])) { echo $_POST['company_name']; } } ?>"/>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="phone_landline"><?=$MV_PhoneLandline;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="phone_landline" name="phone_landline" placeholder="Enter Phone Land Line" maxlength="15" minlength = "10" onkeypress="return numbersonly(event);" value="<?php if($urisegment) { if(isset($_POST['phone_landline'])) { echo $_POST['phone_landline']; } else { echo $this->admin->HtmlStripSlash($EditData->phone_landline); } }  else { if(isset($_POST['phone_landline'])) { echo $_POST['phone_landline']; } } ?>"/>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="phone_mobile"><?=$MV_PhoneMobile;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="phone_mobile" name="phone_mobile" placeholder="Enter Phone Mobile No" maxlength="15" minlength = "10" onkeypress="return numbersonly(event);" value="<?php if($urisegment) { if(isset($_POST['phone_mobile'])) { echo $_POST['phone_mobile']; } else { echo $this->admin->HtmlStripSlash($EditData->phone_mobile); } }  else { if(isset($_POST['phone_mobile'])) { echo $_POST['phone_mobile']; } } ?>"/>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="email"><?=$MV_Email;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="email" class="form-control" id="email" name="email" placeholder="Enter Company Email" maxlength="150" value="<?php if($urisegment) { if(isset($_POST['email'])) { echo $_POST['email']; } else { echo $this->admin->HtmlStripSlash($EditData->email); } }  else { if(isset($_POST['email'])) { echo $_POST['email']; } } ?>"/>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="company_logo"><?=$MV_CompanyLogo;?> <span class="text-danger">*</span></label>
									<?php if($urisegment && $EditData->company_logo != "" && file_exists($MV_CompanyLogoViewPath.$EditData->company_logo))
									{  ?>
									<div id="upload_logo">
										<div class="col-md-6 mb-2 mb-xs-0">
											<img class="img-fluid" style src="<?=site_url();?><?=$MV_CompanyLogoViewPath.$EditData->company_logo;?>" alt="">
										</div>
										<div class="row m-b-20">
											<div class="form-group col-md-6">
												<div class="mt-4 text-center">
													<a href="javascript:void(0);" data-tooltip="tooltip" data-toggle="modal" title="Delete Company Logo" data-target="#modal-delete-confirm-company-logo" class="btn btn-icon btn-outline-danger"><i class="dripicons dripicons dripicons-trash"></i></i></a>
												</div>		
											</div>		
										</div>		
									</div>	
									<input name="hidden_company_logo" type="hidden" id="hidden_company_logo"  class="form-control" value="<?php if($urisegment) { echo $EditData->company_logo; } ?>">	
									<?php }
									else { ?>
										<div class="mb-2">
											<input type="file" class="form-control" id="company_logo" accept="image/png,image/jpg,image/jpeg" name="company_logo">
										</div>
									<?php } ?>
								</div>
								<div class="modal fade" id="modal-delete-confirm-company-logo" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<h5 class="modal-title" id="verticalCenterTitle"> &nbsp; </h5>
											<div class="modal-body text-center">
												<div class="swal2-header"><div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"><span class="swal2-icon-text">!</span></div><h4 class="swal2-title" id="swal2-title" style="display: center;"><?=$DeleteImageConfirmMsg;?></h4></div>
												<div class="" style="text-align:center;">
													<button type="button" class="btn btn-success" onclick="delete_company_logo(<?php echo $EditData->id;?>);"
													 data-dismiss="modal"><?=$Yes;?></button>
													<button type="button" class="btn btn-danger" data-dismiss="modal"><?=$No;?></button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="content_desc"><?=$MV_AddressCorporate;?><span class="text-danger"> *</span></label>
									<div class="mb-2">
										<textarea rows="4" maxlength="150" class="form-control" rows="3" placeholder="Enter Address Corporate" name="address_corporate" id="address_corporate"><?php if($urisegment) { if(isset($_POST['address_corporate'])) { echo $_POST['address_corporate']; } else { echo $this->admin->HtmlStripSlash($EditData->address_corporate); } } else { if(isset($_POST['address_corporate'])) { echo 
								         $_POST['address_corporate']; } } ?></textarea>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="content_desc"><?=$MV_AddressCorrespondence;?><span class="text-danger"> *</span></label>
									<div class="mb-2">
										<textarea rows="4" maxlength="150" class="form-control" rows="3" placeholder="Enter Address Correspondence" name="address_correspondence" id="address_correspondence"><?php if($urisegment) { if(isset($_POST['address_correspondence'])) { echo $_POST['address_correspondence']; } else { echo $this->admin->HtmlStripSlash($EditData->address_correspondence); } } else { if(isset($_POST['address_correspondence'])) { echo 
								         $_POST['address_correspondence']; } } ?></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row formavlidation-wrapper">
				<div class="col-xl-12">
					<div class="card card-statistics">
						<div class="card-body">
							<div class="row">				
								<div class="form-group col-md-12">
									<h4>Single Point Of Contact</h4>
								</div>
								<div class="form-group col-md-4">
									<label class="control-label" for="single_contact_name"><?=$MV_ContactName;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="single_contact_name" name="single_contact_name" placeholder="Enter Contact Name" maxlength="150" value="<?php if($urisegment) { if(isset($_POST['single_contact_name'])) { echo $_POST['single_contact_name']; } else { echo $this->admin->HtmlStripSlash($EditData->single_contact_name); } }  else { if(isset($_POST['single_contact_name'])) { echo $_POST['single_contact_name']; } } ?>"/>
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="control-label" for="single_contact_phone"><?=$MV_ContactPhone;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="single_contact_phone" name="single_contact_phone" placeholder="Enter Contact Phone" maxlength="15" minlength = "10" onkeypress="return numbersonly(event);" value="<?php if($urisegment) { if(isset($_POST['single_contact_phone'])) { echo $_POST['single_contact_phone']; } else { echo $this->admin->HtmlStripSlash($EditData->single_contact_phone); } }  else { if(isset($_POST['single_contact_phone'])) { echo $_POST['single_contact_phone']; } } ?>"/>
									</div>
								</div>
								<div class="form-group col-md-4">
									<label class="control-label" for="single_contact_email"><?=$MV_ContactEmail;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="email" class="form-control" id="single_contact_email" name="single_contact_email" placeholder="Enter Contact Email" maxlength="150" value="<?php if($urisegment) { if(isset($_POST['single_contact_email'])) { echo $_POST['single_contact_email']; } else { echo $this->admin->HtmlStripSlash($EditData->single_contact_email); } }  else { if(isset($_POST['single_contact_email'])) { echo $_POST['single_contact_email']; } } ?>"/>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row formavlidation-wrapper">
				<div class="col-xl-12">
					<div class="card card-statistics">
						<div class="card-body">
							<div class="row">						
								<div class="form-group col-md-12">
									<label class="control-label" for="company_type"><?=$MV_CompanyType;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="company_type" name="company_type" placeholder="Enter Company Type" maxlength="150" value="<?php if($urisegment) { if(isset($_POST['company_type'])) { echo $_POST['company_type']; } else { echo $this->admin->HtmlStripSlash($EditData->company_type); } }  else { if(isset($_POST['company_type'])) { echo $_POST['company_type']; } } ?>"/>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="cin_no"><?=$MV_CompanyCINNo;?> <span class="text-danger">*</span></label>
									<div class="mb-2">
										<input type="text" class="form-control" id="cin_no" name="cin_no" placeholder="Enter Cin No" maxlength="10" value="<?php if($urisegment) { if(isset($_POST['cin_no'])) { echo $_POST['cin_no']; } else { echo $this->admin->HtmlStripSlash($EditData->cin_no); } }  else { if(isset($_POST['cin_no'])) { echo $_POST['cin_no']; } } ?>"/>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label class="control-label" for="company_cin_no_file"><?=$MV_CompanyCINNoDocument;?> <span class="text-danger">*</span></label>
									<?php if($urisegment && $EditData->company_cin_no_file != "" && file_exists($MV_CompanyCinViewPath.$EditData->company_cin_no_file))
									{  ?>
									<div id="upload_cin_no_file">
										<div class="col-md-6 mb-2 mb-xs-0">
											<a href="<?=site_url();?><?=$MV_CompanyCinViewPath.$EditData->company_cin_no_file;?>" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
										<!--<img class="img-fluid" src="<?=site_url();?><?=$MV_CompanyCinViewPath.$EditData->company_cin_no_file;?>" alt="">-->
										</div>
										<div class="row m-b-20">
											<div class="form-group col-md-6">
												<div class="mt-4 text-center">
													<a href="javascript:void(0);" data-tooltip="tooltip" data-toggle="modal" title="Delete Company CIN" data-target="#modal-delete-confirm-company-cin" class="btn btn-icon btn-outline-danger"><i class="dripicons dripicons dripicons-trash"></i></i></a>
												</div>		
											</div>		
										</div>		
									</div>	
									<input name="hidden_company_cin" type="hidden" id="hidden_company_cin"  class="form-control" value="<?php if($urisegment) { echo $EditData->company_cin_no_file; } ?>">	
									<?php }
									else { ?>
										<div class="mb-2">
											<input type="file" class="form-control" id="company_cin_no_file"  accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"  name="company_cin_no_file">
										</div>
									<?php } ?>
								</div>
								<div class="modal fade" id="modal-delete-confirm-company-cin" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<h5 class="modal-title" id="verticalCenterTitle"> &nbsp; </h5>
										<div class="modal-body text-center">
											<div class="swal2-header"><div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"><span class="swal2-icon-text">!</span></div><h4 class="swal2-title" id="swal2-title" style="display: center;"><?=$DeleteImageConfirmMsg;?></h4></div>
											<div class="" style="text-align:center;">
												<button type="button" class="btn btn-success" onclick="delete_company_cin(<?php echo $EditData->id;?>);" data-dismiss="modal"><?=$Yes;?></button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><?=$No;?></button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group col-md-6">
								<label class="control-label" for="gst_no"><?=$MV_GSTNo;?> <span class="text-danger">*</span></label>
								<div class="mb-2">
									<input type="text" class="form-control" id="gst_no" name="gst_no" placeholder="Enter Gst No" maxlength="16" value="<?php if($urisegment) { if(isset($_POST['gst_no'])) { echo $_POST['gst_no']; } else { echo $this->admin->HtmlStripSlash($EditData->gst_no); } }  else { if(isset($_POST['gst_no'])) { echo $_POST['gst_no']; } } ?>"/>
								</div>
							</div>
							<div class="form-group col-md-6">
								<label class="control-label" for="company_gst_no_file"><?=$MV_GSTNoDocument;?> <span class="text-danger">*</span></label>
									<?php if($urisegment && $EditData->company_gst_no_file != "" && file_exists($MV_CompanyGstViewPath.$EditData->company_gst_no_file))
									{  ?>
									<div id="upload_gst">
										<div class="col-md-6 mb-2 mb-xs-0">
											<a href="<?=site_url();?><?=$MV_CompanyGstViewPath.$EditData->company_gst_no_file;?>" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
											<!--<img class="img-fluid" style src="<?=site_url();?><?=$MV_CompanyGstViewPath.$EditData->company_gst_no_file;?>" alt="">-->
										</div>
										<div class="row m-b-20">
											<div class="form-group col-md-6">
												<div class="mt-4 text-center">
													<a href="javascript:void(0);" data-tooltip="tooltip" data-toggle="modal" title="Delete Company Gst No" data-target="#modal-delete-confirm-company-gst" class="btn btn-icon btn-outline-danger"><i class="dripicons dripicons dripicons-trash"></i></i></a>
												</div>		
											</div>		
										</div>		
									</div>	
									<input name="hidden_company_gst" type="hidden" id="hidden_company_gst"  class="form-control" value="<?php if($urisegment) { echo $EditData->company_gst_no_file; } ?>">	
									<?php }
									else { ?>
										<div class="mb-2">
											<input type="file" class="form-control" id="company_gst_no_file"  accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"  name="company_gst_no_file">
										</div>
									<?php } ?>
								</div>
								<div class="modal fade" id="modal-delete-confirm-company-gst" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<h5 class="modal-title" id="verticalCenterTitle"> &nbsp; </h5>
										<div class="modal-body text-center">
											<div class="swal2-header"><div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"><span class="swal2-icon-text">!</span></div><h4 class="swal2-title" id="swal2-title" style="display: center;"><?=$DeleteImageConfirmMsg;?></h4></div>
											<div class="" style="text-align:center;">
												<button type="button" class="btn btn-success" onclick="delete_company_gst_no(<?php echo $EditData->id;?>);" data-dismiss="modal"><?=$Yes;?></button>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><?=$No;?></button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group col-md-6">
								<label class="control-label" for="industries_operating"><?=$MV_IndustriesOperating;?> <span class="text-danger">*</span></label>
								<div class="mb-2">
									<input type="text" class="form-control" id="industries_operating" name="industries_operating" placeholder="Enter Industries Operating" maxlength="150" value="<?php if($urisegment) { if(isset($_POST['industries_operating'])) { echo $_POST['industries_operating']; } else { echo $this->admin->HtmlStripSlash($EditData->industries_operating); } }  else { if(isset($_POST['industries_operating'])) { echo $_POST['industries_operating']; } } ?>"/>
								</div>
							</div>
							<div class="form-group col-md-6">
								<label class="control-label" for=""><?=$MV_Locations;?><span class="text-danger"> *</span></label>
								<div class="mb-2 selects-contant">
									<select class="js-basic-single form-control cat" multiple name="state_id[]" id="state_id">
										<option value=""><?=$MV_SelectLocations;?></option>
										<?php 
										$QsState = $this->admin->retrive_all_cond_data('*',tbl_state, 'is_active=1 AND is_delete = 0','id','ASC');
										if(!empty($QsState))
										{
											foreach($QsState as $RsState) {
											$stateids = explode(",",$EditData->state_id);
										?>
										<option value="<?=$RsState->id;?>" <?php if(in_array($RsState->id,$stateids)) { ?>selected<?php } ?> ><?=$this->admin->HtmlStripSlash($RsState->state_name); ?>
										</option>
										<?php } } ?>
									</select>
								</div>
							</div>
							<div class="form-group col-md-6">
								<label class="control-label" for="areas_of_expertise"><?=$MV_AreaofExpertise;?> <span class="text-danger">*</span></label>
								<div class="mb-2">
									<input type="text" class="form-control" id="areas_of_expertise" name="areas_of_expertise" placeholder="Enter Areas Of Expertise" maxlength="150" value="<?php if($urisegment) { if(isset($_POST['areas_of_expertise'])) { echo $_POST['areas_of_expertise']; } else { echo $this->admin->HtmlStripSlash($EditData->areas_of_expertise); } }  else { if(isset($_POST['areas_of_expertise'])) { echo $_POST['areas_of_expertise']; } } ?>"/>
								</div>
							</div>
							<div class="form-group col-md-6">
								<label class="control-label" for="ims_certifications"><?=$MV_IMSCertifications;?> <span class="text-danger">*</span></label>
								<div class="mb-2">
									<input type="text" class="form-control" id="ims_certifications" name="ims_certifications" placeholder="Enter IMS Certifications" maxlength="150" value="<?php if($urisegment) { if(isset($_POST['ims_certifications'])) { echo $_POST['ims_certifications']; } else { echo $this->admin->HtmlStripSlash($EditData->ims_certifications); } }  else { if(isset($_POST['ims_certifications'])) { echo $_POST['ims_certifications']; } } ?>"/>
								</div>
							</div>
							<div class="form-group col-md-6">
								<label class="control-label" for="awards_recognitions"><?=$MV_AwardsRecognitions;?> <span class="text-danger">*</span></label>
								<div class="mb-2">
									<input type="text" class="form-control" id="awards_recognitions" name="awards_recognitions" placeholder="Enter Awards And Recognitions" maxlength="150" value="<?php if($urisegment) { if(isset($_POST['awards_recognitions'])) { echo $_POST['awards_recognitions']; } else { echo $this->admin->HtmlStripSlash($EditData->awards_recognitions); } }  else { if(isset($_POST['awards_recognitions'])) { echo $_POST['awards_recognitions']; } } ?>"/>
								</div>
							</div>
							<div class="form-group col-md-6">
								<label class="control-label" for="technical_collaborations"><?=$MV_TechnicalCollaborations;?> <span class="text-danger">*</span>
								</label>
								<div class="mb-2">
									<input type="text" class="form-control" id="technical_collaborations" name="technical_collaborations" placeholder="Enter Technical Collaborations" maxlength="150" value="<?php if($urisegment) { if(isset($_POST['technical_collaborations'])) { echo $_POST['technical_collaborations']; } else { echo $this->admin->HtmlStripSlash($EditData->technical_collaborations); } }  else { if(isset($_POST['technical_collaborations'])) { echo $_POST['technical_collaborations']; } } ?>"/>
								</div>
							</div>
							<div class="form-group col-md-6">
								<label class="control-label" for="member_of_industry_association"><?=$MV_MemberOfIndustryAssociation;?> <span class="text-danger">*</span></label>
								<div class="mb-2">
									<input type="text" class="form-control" id="member_of_industry_association" name="member_of_industry_association" placeholder="Enter Member OF Industy Association" maxlength="6" onkeypress="return numbersonly(event);" value="<?php if($urisegment) { if(isset($_POST['member_of_industry_association'])) { echo $_POST['member_of_industry_association']; } else { echo $this->admin->HtmlStripSlash($EditData->member_of_industry_association); } }  else { if(isset($_POST['member_of_industry_association'])) { echo $_POST['member_of_industry_association']; } } ?>"/>
								</div>
							</div>
							<div class="col-md-12 text-center">
								<h4><?=$MV_TurnOverYear;?></h4> 
							</div>
							<div class="col-md-12">
								<div class = "row">
									<div class ="form-group col-md-4">
										<label class="control-label" for="turn_over_year_one"><?=$MV_TurnOverYearOne;?> <span class="text-danger">*</span></label>
										<div class="mb-2">
											<input type="text" class="form-control datetimepicker turn_over_year_one" data-toggle="datetimepicker" data-target=".turn_over_year_one" aria-invalid="false" id="turn_over_year_one" name="turn_over_year_one" placeholder="Select Turn Over Year" value="<?php if($urisegment) { if(isset($_POST['turn_over_year_one'])) { echo date("d-m-y", strtotime($_POST['turn_over_year_one'])); } else { echo date("d-m-y", strtotime($this->admin->HtmlStripSlash($EditData->turn_over_year_one))); } }  else { if($_POST['turn_over_year_one']) { echo date("d-m-y", strtotime($_POST['turn_over_year_one'])); } } ?>"/>
										</div>
									</div>
									<div class ="form-group col-md-4">
										<label class="control-label" for="turn_over_year_two"><?=$MV_TurnOverYearTwo;?> <span class="text-danger">*</span></label>
										<div class="mb-2">
											<input type="text" class="form-control datetimepicker turn_over_year_two" data-toggle="datetimepicker" data-target=".turn_over_year_two" aria-invalid="false" id="turn_over_year_two" name="turn_over_year_two" placeholder="Select Turn Over Year" value="<?php if($urisegment) { if(isset($_POST['turn_over_year_two'])) { echo date("d-m-y", strtotime($_POST['turn_over_year_two'])); } else { echo date("d-m-y", strtotime($this->admin->HtmlStripSlash($EditData->turn_over_year_two))); } }  else { if($_POST['turn_over_year_two']) { echo date("d-m-y", strtotime($_POST['turn_over_year_two'])); } } ?>"/>
										</div>
									</div>
									<div class ="form-group col-md-4">
										<label class="control-label" for="turn_over_year_three"><?=$MV_TurnOverYearThree;?> <span class="text-danger">*</span></label>
										<div class="mb-2">
											<input type="text" class="form-control datetimepicker turn_over_year_three" data-toggle="datetimepicker" data-target=".turn_over_year_three" aria-invalid="false" id="turn_over_year_three" name="turn_over_year_three" placeholder="Select Turn Over Year" value="<?php if($urisegment) { if(isset($_POST['turn_over_year_three'])) { echo date("d-m-y", strtotime($_POST['turn_over_year_three'])); } else { echo date("d-m-y", strtotime($this->admin->HtmlStripSlash($EditData->turn_over_year_three))); } }  else { if($_POST['turn_over_year_three']) { echo date("d-m-y", strtotime($_POST['turn_over_year_three'])); } } ?>"/>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group col-md-4">
								<label class="control-label" for="turn_over_one"><?=$MV_TurnOverOne;?> <span class="text-danger">*</span></label>
									<?php if($urisegment && $EditData->turn_over_one != "" && file_exists($MV_CompanyTurnOverViewPath.$EditData->turn_over_one))
									{  ?>
									<div id="upload_image_one">
										<div class="col-md-6 mb-2 mb-xs-0">
											<a href="<?=site_url();?><?=$MV_CompanyTurnOverViewPath.$EditData->turn_over_one;?>" target = "_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
											<!--<img class="img-fluid" src="<?=site_url();?><?=$MV_CompanyTurnOverViewPath.$EditData->turn_over_one;?>" alt="">-->
										</div>
										<div class="row m-b-20">
											<div class="form-group col-md-6">
												<div class="mt-4 text-center">
													<a href="javascript:void(0);" data-tooltip="tooltip" data-toggle="modal" title="Delete Company Turn Over" data-target="#modal-delete-confirm-company-turn-over-one" class="btn btn-icon btn-outline-danger"><i class="dripicons dripicons dripicons-trash"></i></i></a>
												</div>		
											</div>		
										</div>		
									</div>	
									<input name="hidden_company_turn_over_one" type="hidden" id="hidden_company_turn_over_one"  class="form-control" value="<?php if($urisegment) { echo $EditData->turn_over_one; } ?>">	
									<?php }
									else { ?>
										<div class="mb-2">
											<input type="file" class="form-control" id="turn_over_one" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" name="turn_over_one">
										</div>
									<?php } ?>
								</div>
								<div class="modal fade" id="modal-delete-confirm-company-turn-over-one" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<h5 class="modal-title" id="verticalCenterTitle"> &nbsp; </h5>
											<div class="modal-body text-center">
												<div class="swal2-header"><div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"><span class="swal2-icon-text">!</span></div><h4 class="swal2-title" id="swal2-title" style="display: center;"><?=$DeleteImageConfirmMsg;?></h4></div>
												<div class="" style="text-align:center;">
													<button type="button" class="btn btn-success" onclick="delete_turn_over_one(<?php echo $EditData->id;?>);" data-dismiss="modal"><?=$Yes;?></button>
													<button type="button" class="btn btn-danger" data-dismiss="modal"><?=$No;?></button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group col-md-4">
								<label class="control-label" for="turn_over_two"><?=$MV_TurnOverYearTwo;?> <span class="text-danger">*</span></label>
									<?php if($urisegment && $EditData->turn_over_two != "" && file_exists($MV_CompanyTurnOverViewPath.$EditData->turn_over_two))
									{  ?>
									<div id="upload_image_two">
										<div class="col-md-6 mb-2 mb-xs-0">
											<a href="<?=site_url();?><?=$MV_CompanyTurnOverViewPath.$EditData->turn_over_two;?>" target = "_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
											<!--<img class="img-fluid" src="<?=site_url();?><?=$MV_CompanyTurnOverViewPath.$EditData->turn_over_two;?>" alt="">-->
										</div>
										<div class="row m-b-20">
											<div class="form-group col-md-6">
												<div class="mt-4 text-center">
													<a href="javascript:void(0);" data-tooltip="tooltip" data-toggle="modal" title="Delete Company Turn Over" data-target="#modal-delete-confirm-company-turn-over-two" class="btn btn-icon btn-outline-danger"><i class="dripicons dripicons dripicons-trash"></i></i></a>
												</div>		
											</div>		
										</div>		
									</div>	
									<input name="hidden_company_turn_over_two" type="hidden" id="hidden_company_turn_over_two"  class="form-control" value="<?php if($urisegment) { echo $EditData->turn_over_two; } ?>">	
									<?php } else { ?>
										<div class="mb-2">
											<input type="file" class="form-control" id="turn_over_two" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" name="turn_over_two">
										</div>
									<?php } ?>
								</div>
								<div class="modal fade" id="modal-delete-confirm-company-turn-over-two" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<h5 class="modal-title" id="verticalCenterTitle"> &nbsp; </h5>
											<div class="modal-body text-center">
												<div class="swal2-header"><div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"><span class="swal2-icon-text">!</span></div><h4 class="swal2-title" id="swal2-title" style="display: center;"><?=$DeleteImageConfirmMsg;?></h4></div>
												<div class="" style="text-align:center;">
													<button type="button" class="btn btn-success" onclick="delete_turn_over_two(<?php echo $EditData->id;?>);" data-dismiss="modal"><?=$Yes;?></button>
													<button type="button" class="btn btn-danger" data-dismiss="modal"><?=$No;?></button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group col-md-4">
								<label class="control-label" for="turn_over_three"><?=$MV_TurnOverYearThree;?> <span class="text-danger">*</span></label>
									<?php if($urisegment && $EditData->turn_over_three != "" && file_exists($MV_CompanyTurnOverViewPath.$EditData->turn_over_three))
									{  ?>
									<div id="upload_image_three">
										<div class="col-md-6 mb-2 mb-xs-0">
											<a href="<?=site_url();?><?=$MV_CompanyTurnOverViewPath.$EditData->turn_over_three;?>" target = "_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
											<!--<img class="img-fluid" src="<?=site_url();?><?=$MV_CompanyTurnOverViewPath.$EditData->turn_over_three;?>" alt="">-->
										</div>
										<div class="row m-b-20">
											<div class="form-group col-md-6">
												<div class="mt-4 text-center">
													<a href="javascript:void(0);" data-tooltip="tooltip" data-toggle="modal" title="Delete Company Turn Over" data-target="#modal-delete-confirm-company-turn-over-three" class="btn btn-icon btn-outline-danger"><i class="dripicons dripicons dripicons-trash"></i></i></a>
												</div>		
											</div>		
										</div>		
									</div>	
									<input name="hidden_company_turn_over_three" type="hidden" id="hidden_company_turn_over_three"  class="form-control" value="<?php if($urisegment) { echo $EditData->turn_over_three; } ?>">	
									<?php }
									else { ?>
										<div class="mb-2">
											<input type="file" class="form-control" id="turn_over_three" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"  name="turn_over_three">
										</div>
									<?php } ?>
								</div>
								<div class="modal fade" id="modal-delete-confirm-company-turn-over-three" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<h5 class="modal-title" id="verticalCenterTitle"> &nbsp; </h5>
											<div class="modal-body text-center">
												<div class="swal2-header"><div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"><span class="swal2-icon-text">!</span></div><h4 class="swal2-title" id="swal2-title" style="display: center;"><?=$DeleteImageConfirmMsg;?></h4></div>
												<div class="" style="text-align:center;">
													<button type="button" class="btn btn-success" onclick="delete_turn_over_three(<?php echo $EditData->id;?>);" data-dismiss="modal"><?=$Yes;?></button>
													<button type="button" class="btn btn-danger" data-dismiss="modal"><?=$No;?></button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group col-md-12">
									<?php if($urisegment) { ?>
									<button type="submit" class="btn btn-primary" name="btn_update" value="updatevendor"><?=$BTN_Update;?></button>
									<?php } else { ?>
									<button type="submit" class="btn btn-primary" name="btn_submit" value="addvendor"><?=$BTN_Submit;?></button>
									<?php } ?>
									<a href="<?=site_url();?>ctt-admin/vendor-listing" class="btn btn-danger"><?=$BTN_Cancel;?></a>
									<button type="reset" class="btn btn-warning" name="signup" value="Sign up"><?=$BTN_Reset;?></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
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
	  phone_landline: {
		required: true,
	  },
	  phone_mobile: {
		required: true,
	  },
	  email: {
		required: true,
	  },
	  address_corporate: {
		required: true,
	  },
	  address_correspondence: {
		required: true,
	  },
	  single_contact_name: {
		required: true,
	  },
	  single_contact_phone: {
		required: true,
	  },
	  single_contact_email: {
		required: true,
	  },
	  company_type: {
		required: true,
	  },
	  cin_no: {
		required: true,
	  },
	  company_cin_no_file: {
		required: true,
	  },
	  gst_no: {
		required: true,
	  },
	  company_gst_no_file: {
		required: true,
	  },
	  industries_operating: {
		required: true,
	  },
	  state_id: {
		required: true,
	  },
	  areas_of_expertise: {
		required: true,
	  },
	  ims_certifications: {
		required: true,
	  },
	  awards_recognitions: {
		required: true,
	  },
	  technical_collaborations: {
		required: true,
	  },
	  member_of_industry_association: {
		required: true,
	  },
	  turn_over_year_one: {
		required: true,
	  },
	  turn_over_year_two: {
		required: true,
	  },
	  turn_over_year_three: {
		required: true,
	  },
	  turn_over_one: {
		required: true,
	  },
	  turn_over_two: {
		required: true,
	  },
	  turn_over_three: {
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
	  phone_landline: {
		required: "Please enter phone land line",
	  },
	  phone_mobile: {
		required: "Please enter phone mobile",
	  },
	  email: {
		required: "Please enter company email",
	  },
	  address_corporate: {
		required: "Please enter company corporate address",
	  },
	  address_correspondence: {
		required: "Please enter company correspondence address",
	  },
	  single_contact_name: {
		required: "Please enter name",
	  },
	  single_contact_phone: {
		required: "Please enter phone",
	  },
	  single_contact_email: {
		required: "Please enter email",
	  },
	  company_type: {
		required: "Please enter company type",
	  },
	  cin_no: {
		required: "Please enter company cin no.",
	  },
	  company_cin_no_file: {
		required: "Please select cin no document ",
	  },
	  gst_no: {
		required: "Please enter company gst no.",
	  },
	  company_gst_no_file: {
		required: "Please select gst no document",
	  },
	  industries_operating: {
		required: "Please enter industries operating",
	  },
	  state_id: {
		required: "Please select state id",
	  },
	  areas_of_expertise: {
		required: "Please enter areas of expertise",
	  },
	  ims_certifications: {
		required: "Please enter ims certifications",
	  },
	  awards_recognitions: {
		required: "Please enter awards and recognitions",
	  },
	  technical_collaborations: {
		required: "Please enter technical collabrorations",
	  },
	  member_of_industry_association: {
		required: "Please enter member of industry association",
	  },
	  turn_over_year_one: {
		required: "Please select turn over year one",
	  },
	  turn_over_year_two: {
		required: "Please select turn over year two",
	  },
	  turn_over_year_three: {
		required: "Please select turn over year three",
	  },
	  turn_over_one: {
		required: "Please select turn over one document",
	  },
	  turn_over_two: {
		required: "Please select turn over two document",
	  },
	  turn_over_three: {
		required: "Please select turn over three document",
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



//function for Delete Complain Logo
function delete_company_logo(id)
{
	var projectPath = $("#projectPath").val();
	//alert(projectPath);
	$.ajax(
	{ 
		url: projectPath+"ctt-admin/delete-company-logo",
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
			$("#upload_logo").html(data);
		} 
	});
}


//function for Delete Complain Cin
function delete_company_cin(id)
{
	var projectPath = $("#projectPath").val();
	//alert(projectPath);
	$.ajax(
	{ 
		url: projectPath+"ctt-admin/delete-company-cin",
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

//function for Delete Complain Cin
function delete_company_gst_no(id)
{
	var projectPath = $("#projectPath").val();
	//alert(projectPath);
	$.ajax(
	{ 
		url: projectPath+"ctt-admin/delete-company-gst",
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
			$("#upload_gst").html(data);
		} 
	});
}


function delete_turn_over_one(id)
{
	var projectPath = $("#projectPath").val();
	$.ajax(
	{ 
		url: projectPath+"ctt-admin/delete-company-turn-over-one",
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
			$("#upload_image_one").html(data);
		} 
	});
}


function delete_turn_over_two(id)
{
	var projectPath = $("#projectPath").val();
	$.ajax(
	{ 
		url: projectPath+"ctt-admin/delete-company-turn-over-two",
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
			$("#upload_image_two").html(data);
		} 
	});
}

function delete_turn_over_three(id)
{
	var projectPath = $("#projectPath").val();
	$.ajax(
	{ 
		url: projectPath+"ctt-admin/delete-company-turn-over-three",
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
			$("#upload_image_three").html(data);
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