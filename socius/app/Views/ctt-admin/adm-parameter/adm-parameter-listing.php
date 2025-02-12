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
									<a href="<?=site_url();?>pk-admin/dashboard"><i class="ti ti-home"></i></a>
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
						<div class="datatable-wrapper">
							<table id="datatable" class="table table-hover table-bordered w-100" style="margin-top: 0px !important;">
								<thead class="bg-primary text-white text-center">
									<tr>
										<th><?=$SL;?></th>
										<th><?=$ST_Parameter_Name;?></th>
										<th data-sortable="false" class="notexport"><?=$Action;?></th>
									</tr>
								</thead>
							<tbody >
									<?php 
									if(count($QsParameter)>0)//Check Count
									{
										$i=0;
										foreach($QsParameter as $RsParameter)
										{ 
										$i++;
										$Status = $RsParameter->is_active;
										if($Status == 1) 
										{ 
											$StatusFun = "inactive-parameter"; 
											$StatusTitle = $BTN_Active; 
											$Class="danger";
											$TextClass="success";
											$title = $BTN_Inactive;
											$icon = "fa fa-check";
											$modalClass = "success";
										}
										if($Status == 0) 
										{ 
											$StatusFun = "active-parameter"; 
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
										<td><?=$this->admin->HtmlStripSlash($RsParameter->parameter_name);?></td>
										
										<td>
											<div class="btn-group btn-group-sm">
												
												<a href="<?=site_url();?>pk-admin/edit-parameter/<?=$RsParameter->id;?>" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
												
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
					</div>
				</div>
			</div>
		</div>
		<!-- end row -->
	</div>
	<!-- end container-fluid -->
</div>
<script>
$('#modal-active-confirm').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var userid = button.data('userid') // Extract info from data-* attributes
  var title = button.data('title') // Extract info from data-* attributes
  var StatusFun = button.data('statusfun') // Extract info from data-* attributes
  var site_url = $('#projectPath').val();
  var StatusUrl = site_url+'pk-admin/'+StatusFun+'/'+userid;
  //alert(StatusUrl);
  var modal = $(this)
  modal.find('.title').text(title);
  modal.find('.StatusFun a').attr('href', StatusUrl);
});
$('#modal-delete-confirm').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var deluserid = button.data('deluserid') // Extract info from data-* attributes
  var site_url = $('#projectPath').val();
  var StatusUrl = site_url+'pk-admin/delete-parameter/'+deluserid;
  var modal = $(this)
  modal.find('.DeleteFun a').attr('href', StatusUrl);
});
</script>
<script type="text/javascript">
$(document).ready(function () {
  $('#parameterForm').validate({
	rules: {
	  from_date: {
		required: true
	  },
	  to_date: {
		required: true
	  },
	},
	messages: {
	  from_date: {
		required: "Please select from date"
	  },
	  to_date: {
		required: "Please select to date"
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