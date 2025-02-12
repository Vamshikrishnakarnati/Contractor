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
									<a href="<?=site_url();?>"><i class="ti ti-home"></i></a>
								</li>
								<li class="breadcrumb-item">
									<?=$Menu;?>
								</li>
								<li class="breadcrumb-item active text-primary" aria-current="page"><?php if($urisegment) { echo $BTN_View; } else { echo $BTN_View; } ?> <?=$MV_Vendor;?></li>
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
							<a href="<?=site_url();?>ctt-admin/vendor-listing" class="btn btn-primary btn-sm"><i class="ti ti-arrow-left"></i> <?=$BTN_Back;?></a>
						</div>
					</div>
					<div class="card-body">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td scope="col" style="width:20%;"><strong><?=$MV_CompanyName;?>  :</strong></td>
									<td scope="col"><?=$this->admin->HtmlStripSlash($RsVendor->category_name); ?></td>
								</tr>
								<tr>
									<td scope="col" style="width:30%;"><strong><?=$MV_CompanyLogo;?> :</strong></td>
									<td scope="col">
										<?php if($RsVendor->company_logo !="" && file_exists($MV_CompanyLogoViewPath.$RsVendor->company_logo)) { ?>	
											<img width="250" height="100" src="<?=site_url();?><?=$MV_CompanyLogoViewPath.$RsVendor->company_logo;?>">
										<?php } else { ?>
										<div class="bg-img magnific-wrapper gallery mx-auto">
											<img class="img-fluid rounded" src="<?=site_url();?><?=$NoImgPath?>" alt="">
										<?php } ?> 	
										</div>
									</td>
								</tr>
								<tr>
									<td scope="col" style="width:30%;"><strong><?=$MV_PhoneLandline;?> :</strong></td>
									<td scope="col"><?=$this->admin->HtmlStripSlash($RsVendor->phone_landline); ?></td>
								</tr>
								<tr>
									<td scope="col" style="width:30%;"><strong><?=$MV_PhoneMobile;?> :</strong></td>
									<td scope="col"><?=$this->admin->HtmlStripSlash($RsVendor->phone_mobile); ?></td>
								</tr>
								<tr>
									<td scope="col" style="width:30%;"><strong><?=$MV_Email;?> :</strong></td>
									<td scope="col"><?=$this->admin->HtmlStripSlash($RsVendor->email); ?></td>
								</tr>
								<tr>
									<td scope="col" style="width:30%;"><strong><?=$MV_AddressCorporate;?> :</strong></td>
									<td scope="col"><?=$this->admin->HtmlStripSlash($RsVendor->address_corporate); ?></td>
								</tr>
								<tr>
									<td scope="col" style="width:30%;"><strong><?=$MV_AddressCorrespondence;?> :</strong></td>
									<td scope="col"><?=$this->admin->HtmlStripSlash($RsVendor->address_correspondence); ?> %</td>
								</tr>
								<tr>
									<td scope="col" style="width:30%;"><strong><?=$MV_ContactName;?> :</strong></td>
									<td scope="col"><?=$this->admin->HtmlStripSlash($RsVendor->single_contact_name); ?></td>
								</tr>
								<tr>
									<td scope="col" style="width:30%;"><strong><?=$MV_ContactPhone;?> :</strong></td>
									<td scope="col"><?=$this->admin->HtmlStripSlash($RsVendor->single_contact_phone); ?></td>
								</tr>
								<tr>
									<td scope="col" style="width:30%;"><strong><?=$MV_ContactEmail;?> :</strong></td>
									<td scope="col"><?=$this->admin->HtmlStripSlash($RsVendor->single_contact_email); ?></td>
								</tr>
								<tr>
									<td scope="col" style="width:30%;"><strong><?=$MV_CompanyType;?> :</strong></td>
									<td scope="col"><?=$this->admin->HtmlStripSlash($RsVendor->company_type); ?></td>
								</tr>
								<tr>
									<td scope="col" style="width:30%;"><strong><?=$MV_CompanyType;?> :</strong></td>
									<td scope="col"><?=$this->admin->HtmlStripSlash($RsVendor->company_type); ?></td>
								</tr>
								<tr>
									<td scope="col" style="width:30%;"><strong><?=$MV_CompanyCINNo;?> :</strong></td>
									<td scope="col">
										<?php if($RsVendor->company_cin_no_file !="" && file_exists($MV_CompanyCinViewPath.$RsVendor->company_cin_no_file)) { ?>	
											<img width="250" height="100" src="<?=site_url();?><?=$MV_CompanyCinViewPath.$RsVendor->company_cin_no_file;?>">
										<?php } else { ?>
										<div class="bg-img magnific-wrapper gallery mx-auto">
											<img class="img-fluid rounded" src="<?=site_url();?><?=$NoImgPath?>" alt="">
										<?php } ?> 	
										</div>
									</td>
								</tr>
								<tr>
									<td scope="col" style="width:30%;"><strong><?=$MV_GSTNo;?> :</strong></td>
									<td scope="col">
										<?php if($RsVendor->company_gst_no_file !="" && file_exists($MV_CompanyGstViewPath.$RsVendor->company_gst_no_file)) { ?>	
											<img width="250" height="100" src="<?=site_url();?><?=$MV_CompanyGstViewPath.$RsVendor->company_gst_no_file;?>">
										<?php } else { ?>
										<div class="bg-img magnific-wrapper gallery mx-auto">
											<img class="img-fluid rounded" src="<?=site_url();?><?=$NoImgPath?>" alt="">
										<?php } ?> 	
										</div>
									</td>
								</tr>
								<tr>
									<td scope="col" style="width:30%;"><strong><?=$MV_IndustriesOperating;?> :</strong></td>
									<td scope="col"><?=$this->admin->HtmlStripSlash($RsVendor->industries_operating); ?></td>
								</tr>
								<tr>
									<td scope="col" style="width:30%;"><strong><?=$MV_Locations;?> :</strong></td>
									<td scope="col"><?=$this->admin->HtmlStripSlash($RsStatename->state_name); ?></td>
								</tr>
								<tr>
									<td scope="col" style="width:30%;"><strong><?=$MV_AreaofExpertise;?> :</strong></td>
									<td scope="col"><?=$this->admin->HtmlStripSlash($RsVendor->areas_of_expertise); ?></td>
								</tr>
								<tr>
									<td scope="col" style="width:30%;"><strong><?=$MV_IMSCertifications;?> :</strong></td>
									<td scope="col"><?=$this->admin->HtmlStripSlash($RsVendor->ims_certifications); ?></td>
								</tr>
								<tr>
									<td scope="col" style="width:30%;"><strong><?=$MV_AwardsRecognitions;?> :</strong></td>
									<td scope="col"><?=$this->admin->HtmlStripSlash($RsVendor->awards_recognitions); ?></td>
								</tr>
								<tr>
									<td scope="col" style="width:30%;"><strong><?=$MV_TechnicalCollaborations;?> :</strong></td>
									<td scope="col"><?=$this->admin->HtmlStripSlash($RsVendor->technical_collaborations); ?></td>
								</tr>
								<tr>
									<td scope="col" style="width:30%;"><strong><?=$MV_MemberOfIndustryAssociation;?> :</strong></td>
									<td scope="col"><?=$this->admin->HtmlStripSlash($RsVendor->member_of_industry_association); ?></td>
								</tr>
								<tr>
									<td scope="col" style="width:30%;"><strong><?=$MV_TurnOverYear;?> :</strong></td>
									<td scope="col"><?php echo date("Y",$RsVendor->turn_over_year); ?></td>
								</tr>
								<tr>
									<td scope="col" style="width:30%;"><strong><?=$MV_TurnOver;?> :</strong></td>
									<td scope="col">
										<?php if($RsVendor->turn_over !="" && file_exists($MV_CompanyTurnOverViewPath.$RsVendor->turn_over)) { ?>	
											<img width="250" height="100" src="<?=site_url();?><?=$MV_CompanyTurnOverViewPath.$RsVendor->turn_over;?>">
										<?php } else { ?>
										<div class="bg-img magnific-wrapper gallery mx-auto">
											<img class="img-fluid rounded" src="<?=site_url();?><?=$NoImgPath?>" alt="">
										<?php } ?> 	
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- end Validation row  -->
	</div>
	<!-- end container-fluid -->
</div>