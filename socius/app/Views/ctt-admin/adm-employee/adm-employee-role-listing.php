<?php use App\Models\Admin; 
$this->admin = new Admin(); ?>
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
									<a href="<?=site_url();?>ctt-admin/employee-listing"><?=$Menu;?></a>
								</li>
								<li class="breadcrumb-item active text-primary" aria-current="page"><?=$SubMenu;?></li>
							</ol>
						</nav>
					</div>
				</div>
				<!-- end page title -->
			</div>
		</div>
		<!-- end row -->
		<!-- begin row -->
		<div class="row">
			<div class="col-lg-12">
				<div class="card card-statistics">
					<div class="card-body">
						<form role="form" name="employeelistingForm" id="employeelistingForm" method="post">
							<div class="position-sticky pt-3" style="top:60px;z-index:99;background:#ffffff;">
								<div class="form-row">
									<div class="col-md-3 mb-3">
										<label><?=$MER_Organisation_Name;?></label>
										<select class="custom-select" name="organisation_id" id="organisation_id" onchange="return get_sbu();">
											<option value=""><?=$MER_Select_Organisation;?></option>
											<?php 
												$QsOrganisation = $this->admin->retrive_all_cond_data('*',tbl_organisation, 'is_active=1', 'company_name','ASC');
												foreach($QsOrganisation as $RsOrganisation) { ?>
												<option value="<?=$RsOrganisation->id;?>" <?php if($_POST['organisation_id'] == $RsOrganisation->id) {?>selected<?php } ?> ><?=$this->admin->HtmlStripSlash($RsOrganisation->company_name);?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-md-3 mb-3">
										<label><?=$MER_SBU_Name;?></label>
										<select class="custom-select" name="sbu_id" id="sbu_id">
											<option value=""><?=$MER_Select_SBU;?></option>
											<?php if(isset($_POST['sbu_id'])) {
												$QsOrgSbu = $this->admin->retrive_all_cond_data('*',tbl_sbu, 'is_active=1', 'sbu_name','ASC');
												foreach($QsOrgSbu as $RsOrgSbu) { ?>
												<option value="<?=$RsOrgSbu->id;?>" <?php if($_POST['sbu_id'] == $RsOrgSbu->id) {?>selected<?php } ?> ><?=$this->admin->HtmlStripSlash($RsOrgSbu->sbu_name);?></option>
											<?php } } ?>
										</select>
									</div>
									<div class="col-md-3 align-self-end mb-3">
										<button type="submit" value="search" name="btn_submit" id="btn_submit" class="btn btn-primary btn-sm"><?=$BTN_Search?></button>
									</div>
									
									<div class="col-md-3 align-self-end text-right mb-3">
										<button type="submit" value="all" name="btnsubmit" id="btnsubmit" class="btn btn-primary btn-sm"><?=$MER_All_Save;?></button>
										<a href="<?=site_url();?>ctt-admin/employee-listing" class="btn btn-primary btn-sm"><i class="ti ti-arrow-left"></i> <?=$BTN_Back;?></a>
									</div>
								</div>
							</div>
						
						<div class="mt-4">
							<div class="row">
								<div class="col-md-12">
									<div class="datatable-wrapper" style="display: <?php if(!empty($QsEmployee)) { echo "block"; } else { echo "none"; }?>;">
											<table id="datatable" class="table table-hover table-bordered w-100" style="margin-top: 0px !important;">
												<thead class="bg-primary text-white">
													<tr>
														<th><?=$MER_Users;?></th>
														<th><?=$MER_Access_Level;?></th>
														<th><?=$MER_Access_Level_2;?></th>
														<th><?=$MER_Department;?></th>
														<th><?=$MER_Area;?></th>
														<th><?=$MER_Role;?></th>
														<th data-sortable="false" class="notexport"><?=$Action;?></th>
													</tr>
												</thead>
												<?php 
												if(!empty($QsEmployee))//Check Count
												{
													$ids = '';
													$i=0;
													foreach($QsEmployee as $RsEmployee)
													{ 
													$i++;
													
													if(!empty($ids))
													{
														$ids .= ','.$RsEmployee->id;
													}
													else
													{
														$ids .= $RsEmployee->id;
													}
												?>
												<tbody>
													<tr>
														<td><?=$this->admin->HtmlStripSlash($RsEmployee->employee_name);?></td>
														<td>
															<select class="custom-select" name="level_<?=$RsEmployee->id;?>" id="level_<?=$RsEmployee->id;?>" onchange="get_department(<?=$RsEmployee->id;?>);">
																<option value=""><?=$MER_Select_Access_Level;?></option>
																<?php 
																$QsAccessLevel = $this->admin->retrive_all_cond_data('*',tbl_access_level, 'is_active=1', 'name','ASC');
																foreach($QsAccessLevel as $RsAccessLevel) { ?>
																<option value="<?=$RsAccessLevel->id;?>" <?php if($RsEmployee->level_id == $RsAccessLevel->id) {?>selected<?php } ?> ><?=$this->admin->HtmlStripSlash($RsAccessLevel->name);?></option>
																<?php } ?>
															</select>
														</td>
														<td>
															<select class="custom-select" name="level2_<?=$RsEmployee->id;?>" id="level2_<?=$RsEmployee->id;?>">
																<option value=""><?=$MER_Select_Access_Level_2;?></option>
																<?php 
																$QsAccessLevel2 = $this->admin->retrive_all_cond_data('*',tbl_access_level2, 'is_active=1', 'name','ASC');
																foreach($QsAccessLevel2 as $RsAccessLevel2) { ?>
																<option value="<?=$RsAccessLevel2->id;?>" <?php if($RsEmployee->level2_id == $RsAccessLevel2->id) {?>selected<?php } ?> ><?=$this->admin->HtmlStripSlash($RsAccessLevel2->name);?></option>
																<?php } ?>
															</select>
														</td>
														<td>
															<select class="custom-select" name="department_<?=$RsEmployee->id;?>" id="department_<?=$RsEmployee->id;?>">
																<option value=""><?=$MER_Select_Department;?></option>
																<?php  if(!empty($RsEmployee->department_id)) {
																$QsDepartment = $this->admin->retrive_all_cond_data('*',tbl_department, 'is_active=1', 'department_name','ASC');?>
																<?php foreach($QsDepartment as $RsDepartment) { ?>
																<option value="<?=$RsDepartment->id?>" <?php if($RsEmployee->department_id == $RsDepartment->id) {?>selected<?php } ?> ><?=$this->admin->HtmlStripSlash($RsDepartment->department_name);?></option>
																<?php } } ?>
															</select>
														</td>
														<td>
															<select class="custom-select" name="area_<?=$RsEmployee->id;?>" id="area_<?=$RsEmployee->id;?>">
																<option value=""><?=$MER_Select_Area;?></option>
																<?php 
																$QsAccessLevel2 = $this->admin->retrive_all_cond_data('*',tbl_area, 'is_active=1', 'name','ASC');
																foreach($QsAccessLevel2 as $RsAccessLevel2) { ?>
																<option value="<?=$RsAccessLevel2->id;?>" <?php if($RsEmployee->area_id == $RsAccessLevel2->id) {?>selected<?php } ?> ><?=$this->admin->HtmlStripSlash($RsAccessLevel2->name);?></option>
																<?php } ?>
															</select>
														</td>
														<td>
															<select class="custom-select" name="role_<?=$RsEmployee->id;?>" id="role_<?=$RsEmployee->id;?>">
																<option value=""><?=$MER_Select_Role;?></option>
																<?php 
																$QsAccessLevel2 = $this->admin->retrive_all_cond_data('*',tbl_role, 'is_active=1', 'name','ASC');
																foreach($QsAccessLevel2 as $RsAccessLevel2) { ?>
																<option value="<?=$RsAccessLevel2->id;?>" <?php if($RsEmployee->role_id == $RsAccessLevel2->id) {?>selected<?php } ?> ><?=$this->admin->HtmlStripSlash($RsAccessLevel2->name);?></option>
																<?php } ?>
															</select>
														</td>
														<td>
															<button type="submit" name="row_btn_submit" id="row_btn_submit" value="<?=$RsEmployee->id;?>" class="btn btn-primary btn-sm" onclick="row_update(<?=$RsEmployee->id;?>);" >Save</button>
														</td>
													</tr>
												</tbody>
												<?php } } ?>
												<input type="hidden" name="row_ids" id="row_ids" value="<?=$ids;?>">
											</table>	
										</form>	
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end row -->
	</div>
	<!-- end container-fluid -->
</div>

<script type="text/javascript">
var projectPath = $('#projectPath').val();
function row_update(row_id)
{
	var organisation_id = $('#organisation_id').val();
	var sbu_id = $('#sbu_id').val();
	
}
function get_sbu()
{
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
function get_department(id)
{
	var organisation_id = $('#organisation_id').val();
	var sbu_id = $('#sbu_id').val();
	var level = $('#level_'+id).val();
	//alert(level);
	$.ajax(
	{
		url: projectPath+"ctt-admin/employee/getdepartment",
		type: "POST",
		cache: false,
		data:'level='+level+'&organisation_id='+organisation_id+'&sbu_id='+sbu_id+'&id='+id,
		async: false,
		success: function(data)
		{
			//alert(data);
			$("#department_"+id).html(data);
			
		}
	});
}
$(document).ready(function () {
  $('#employeelistingForm').validate({
  ignore: [],
	rules: {
	  organisation_id: {
		required: true,
	  },
	  sbu_id: {
		required: true,
	  },
	},
	messages: {
	  organisation_id: {
		required: "Please select organisation name",
	  },
	  sbu_id: {
		required: "Please select SBU name",
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
<script>
var site_url = $('#projectPath').val();


$('#modal-active-confirm').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var userid = button.data('userid') // Extract info from data-* attributes
  var title = button.data('title') // Extract info from data-* attributes
  var StatusFun = button.data('statusfun') // Extract info from data-* attributes
  var site_url = $('#projectPath').val();
  var StatusUrl = site_url+'ctt-admin/'+StatusFun+'/'+userid;
  //alert(StatusUrl);
  var modal = $(this)
  modal.find('.title').text(title);
  modal.find('.StatusFun a').attr('href', StatusUrl);
});
$('#modal-delete-confirm').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var deluserid = button.data('deluserid') // Extract info from data-* attributes
  var site_url = $('#projectPath').val();
  var StatusUrl = site_url+'ctt-admin/delete-contract/'+deluserid;
  var modal = $(this)
  modal.find('.DeleteFun a').attr('href', StatusUrl);
});
</script>