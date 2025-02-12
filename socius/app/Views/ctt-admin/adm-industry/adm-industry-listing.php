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
									<?=$Menu;?>
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
						<form role="form" name="industrylistingForm" id="industrylistingForm" method="post">
                            <div class="row">
								<div class="form-group col-md-4">
									<div class="mb-2">
										<input type="text" autocomplete="off" onkeyup="ss();" class="form-control" id="industry_name" name="industry_name" placeholder="Enter Industry Name" maxlength="80" value="<?php if($urisegment) { if(isset($_POST['industry_name'])) { echo $_POST['industry_name']; } else { echo $this->admin->HtmlStripSlash($EditData->industry_name); } }  else { if(isset($_POST['industry_name'])) { echo $_POST['industry_name']; } } ?>"/>
									</div>
								</div>
                                <div class="col-md-4">
                                    <button type="submit" value="submit" name="btn_submit" id="btn_submit" class="btn btn-primary"><?=$BTN_Search?></button>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3 text-right">
										<a href="<?=site_url();?>ctt-admin/add-industry" class="btn btn-primary"><i class="ti ti-plus"></i> <?=$BTN_Add;?></a>
									</div>
                                </div>
                            </div>
                        </form>
						
						<div class="datatable-wrapper" style="display: <?php if(!empty($QsIndustry)) { echo "block"; } else { echo "none"; }?>;">
							<table id="datatable" class="table table-hover table-bordered w-100" style="margin-top: 0px !important;">
								<thead class="bg-primary text-white text-center">
									<tr>
										<th><?=$SL;?></th>
										<th><?=$MI_Industry_Name;?></th>
										<th><?=$Status;?></th>
										<th data-sortable="false" class="notexport"><?=$Action;?></th>
									</tr>
								</thead>
								<tbody >
									<?php 
									if(!empty($QsIndustry))//Check Count
									{
										$i=0;
										foreach($QsIndustry as $RsIndustry)
										{ 
										$i++;
										$Status = $RsIndustry->is_active;
										if($Status == 1) 
										{ 
											$StatusFun = "inactive-industry"; 
											$StatusTitle = $BTN_Active; 
											$Class="danger";
											$TextClass="success";
											$title = $BTN_Inactive;
											$icon = "fa fa-check";
											$modalClass = "success";
										}
										if($Status == 0) 
										{ 
											$StatusFun = "active-industry"; 
											$StatusTitle = $BTN_Inactive; 
											$Class="success";
											$TextClass="danger";
											$title = $BTN_Active;
											$icon = "fa fa-check";
											$modalClass = "danger";
										}
									?>
									<tr class="text-center">
										<td><?=$i;?></td>
										<td><?=$this->admin->HtmlStripSlash($RsIndustry->industry_name);?></td>
										<td class="text-<?=$TextClass;?>"><?=$StatusTitle?></td>
										<td>
											<div class="btn-group btn-group-sm">
												<!--<button type="button" title="<?=$title;?>" class="btn btn-sm btn-<?=$Class;?>" data-toggle="modal" data-userid="<?=$RsIndustry->id;?>" data-title="<?=$title;?>" data-statusfun="<?=$StatusFun;?>" data-target="#modal-active-confirm"><span class="<?=$icon;?>"></span></button>&nbsp;&nbsp;-->
												<a href="<?=site_url();?>ctt-admin/edit-industry/<?=$RsIndustry->id;?>" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
												<button type="button" class="btn btn-sm btn-danger"  data-toggle="modal"  data-deluserid="<?=$RsIndustry->id;?>" data-target="#modal-delete-confirm" title="Delete" style="background-color: #f71a1a"><span class="fa fa-trash"></span></button>
											</div>
										</td>
									</tr>
									<?php } } ?>
								</tbody>
							</table>
							<!-- Modal For Active Inactive-->
							<div class="modal fade" id="modal-active-confirm" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<h5 class="modal-title" id="verticalCenterTitle"> &nbsp; </h5>
										<div class="modal-body text-center">
											<div class="swal2-header"><div class="swal2-icon swal2-warning swal2-animate-warning-icon" style="display: flex;"><span class="swal2-icon-text">!</span></div><h4 class="swal2-title" id="swal2-title" style="display: center;"><?=$AreSureMsg;?> <span class="title"></span> <?=$ThisOne;?></h4></div>
											<div class="" style="text-align:center;">
												<span class="StatusFun"><a href="javascript:void(0);" class="btn btn-success"><?=$Yes;?></a></span>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><?=$No;?></button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Modal For Delete-->
							<div class="modal fade" id="modal-delete-confirm" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<h5 class="modal-title" id="verticalCenterTitle"> &nbsp; </h5>
										<div class="modal-body text-center">
											<div class="swal2-header"><div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;"><span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></span></div><h4 class="swal2-title" id="swal2-title" style="display: center;"><?=$DeleteConfirmMsg;?></h4></div>
											<div class="" style="text-align:center;">
												<span class="DeleteFun"><a href="javascript:void(0);" class="btn btn-success"><?=$Yes;?></a></span>
												<button type="button" class="btn btn-danger" data-dismiss="modal"><?=$No;?></button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php if(empty($QsIndustry) && !empty($_POST)) { ?>
							<div class="datatable-wrapper">
							<table id="datatable" class="table table-hover table-bordered w-100">
								<thead class="bg-primary text-white text-center">
									<tr>
										<th width="10px;"><?=$SL;?></th>
										<th width="150px;"><?=$MI_Industry_Name;?></th>
										<th width="50px;" data-sortable="false" class="notexport"><?=$Action;?></th>
									</tr>
								</thead>
								<tbody >
									</tbody>
										<tr><td colspan="3" style="text-align:center;color:red;"><?php echo $NoRecordsFound;?></td></tr>
									</table>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<!-- end row -->
	</div>
	<!-- end container-fluid -->
</div>

<script>
var site_url = $('#projectPath').val();
$(document).ready(function () {
  $('#industrylistingForm').validate({
  ignore: [],
	rules: {
	  industry_name: {
		required: true,
	  },
	},
	messages: {
	  industry_name: {
		required: "Please enter industry name",
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
$(function() {
    $("#industry_name").autocomplete({
		source: function(request, response) {
			$.ajax({
				url: site_url+'ctt-admin/search-industry',
				dataType: "json",
				data: {
					industry_name : $("#industry_name").val()
				},
				success: function(data) {
					response(data);
				}
			});
		},
        select: function( event, ui ) {
            event.preventDefault();
            $("#industry_name").val(ui.item.value);
			//searchdata(ui.item.value);
        }
    });
});

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
  var StatusUrl = site_url+'ctt-admin/delete-industry/'+deluserid;
  var modal = $(this)
  modal.find('.DeleteFun a').attr('href', StatusUrl);
});
</script>