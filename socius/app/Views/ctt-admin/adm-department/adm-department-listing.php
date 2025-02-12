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
						<form role="form" name="departmentlistingForm" id="departmentlistingForm" method="post">
                            <div class="row">
								<div class="form-group col-md-4">
									<div class="mb-2">
										<input type="text" autocomplete="off" onkeyup="ss();" class="form-control" id="department_name" name="department_name" placeholder="Enter Department Name" maxlength="80" value="<?php if($urisegment) { if(isset($_POST['department_name'])) { echo $_POST['department_name']; } else { echo $this->admin->HtmlStripSlash($EditData->department_name); } }  else { if(isset($_POST['department_name'])) { echo $_POST['department_name']; } } ?>"/>
									</div>
								</div>
                                <div class="col-md-4">
                                    <button type="submit" value="submit" name="btn_submit" id="btn_submit" class="btn btn-primary"><?=$BTN_Search?></button>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3 text-right">
										<a href="<?=site_url();?>ctt-admin/add-department" class="btn btn-primary"><i class="ti ti-plus"></i> <?=$BTN_Add;?></a>
									</div>
                                </div>
                            </div>
                        </form>
						<div class="datatable-wrapper" style="display: <?php if(!empty($QsDepartment)) { echo "block"; } else { echo "none"; }?>;">
							<table id="datatable" class="table table-hover table-bordered w-100" style="margin-top: 0px !important;">
								<thead class="bg-primary text-white text-center">
									<tr>
										<th><?=$SL;?></th>
										<th><?=$MD_Department_Name;?></th>
										<th><?=$MD_Department_Code;?></th>
										<th><?=$Status;?></th>
										<th data-sortable="false" class="notexport"><?=$Action;?></th>
									</tr>
								</thead>
								<tbody >
									<?php 
									if(!empty($QsDepartment))//Check Count
									{
										$i=0;
										foreach($QsDepartment as $RsDepartment)
										{ 
										$i++;
										$Status = $RsDepartment->is_active;
										if($Status == 1) 
										{ 
											$StatusFun = "inactive-department"; 
											$StatusTitle = $BTN_Active; 
											$Class="danger";
											$TextClass="success";
											$title = $BTN_Inactive;
											$icon = "fa fa-check";
											$modalClass = "success";
										}
										if($Status == 0) 
										{ 
											$StatusFun = "active-department"; 
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
										<td><?=$this->admin->HtmlStripSlash($RsDepartment->department_name);?></td>
										<td><?=$this->admin->HtmlStripSlash($RsDepartment->department_code);?></td>
										<td class="text-<?=$TextClass;?>"><?=$StatusTitle?></td>
										<td>
											<div class="btn-group btn-group-sm">
												<!--<button type="button" title="<?=$title;?>" class="btn btn-sm btn-<?=$Class;?>" data-toggle="modal" data-userid="<?=$RsDepartment->id;?>" data-title="<?=$title;?>" data-statusfun="<?=$StatusFun;?>" data-target="#modal-active-confirm"><span class="<?=$icon;?>"></span></button>&nbsp;&nbsp;-->
												<a href="<?=site_url();?>ctt-admin/edit-department/<?=$RsDepartment->id;?>" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
												<button type="button" class="btn btn-sm btn-danger"  data-toggle="modal"  data-deluserid="<?=$RsDepartment->id;?>" data-target="#modal-delete-confirm" title="Delete" style="background-color: #f71a1a"><span class="fa fa-trash"></span></button>
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
						<?php if(empty($QsDepartment) && !empty($_POST)) { ?>
							<div class="datatable-wrapper">
							<table id="datatable" class="table table-hover table-bordered w-100">
								<thead class="bg-primary text-white text-center">
									<tr>
										<th><?=$SL;?></th>
										<th><?=$MD_Department_Name;?></th>
										<th><?=$MD_Department_Code;?></th>
										<th><?=$Status;?></th>
										<th data-sortable="false" class="notexport"><?=$Action;?></th>
									
									</tr>
								</thead>
								<tbody >
									</tbody>
										<tr><td colspan="5" style="text-align:center;color:red;"><?php echo $NoRecordsFound;?></td></tr>
									</table>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function () {
  $('#departmentlistingForm').validate({
  ignore: [],
	rules: {
	  department_name: {
		required: true,
	  },
	},
	messages: {
	  department_name: {
		required: "Please enter department name",
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
	
	/* $(document).ready(function() {
		$( "#department_name" ).load(function() {
			alert( "Handler for .change() called." );
		});
	});
  $( function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    $( "#department_name" ).autocomplete({
		source: availableTags
    });
	
  } ); */
  </script>
<script>
var site_url = $('#projectPath').val();
function ss()
{
	return $("#department_name").val();
}
// source: site_url+'ctt-admin/search-department/c',
$(function() {
    $("#department_name").autocomplete({
		source: function(request, response) {
			$.ajax({
				url: site_url+'ctt-admin/search-department',
				dataType: "json",
				data: {
					department_name : $("#department_name").val()
				},
				success: function(data) {
					response(data);
				}
			});
		},
        select: function( event, ui ) {
            event.preventDefault();
            $("#department_name").val(ui.item.value);
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
  var StatusUrl = site_url+'ctt-admin/delete-department/'+deluserid;
  var modal = $(this)
  modal.find('.DeleteFun a').attr('href', StatusUrl);
});
</script>