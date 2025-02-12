<!-- begin app-container -->
<div class="app-container">
	<!-- begin app-nabar -->
	<aside class="app-navbar">
		<?php 
		$uri = explode('/',$_SERVER['REQUEST_URI']); 
		//$Access = explode(',', $this->session->userdata('access_permission'));
		//$userType = explode(',', $this->session->userdata('userType'));
		?>
		<!-- begin sidebar-nav -->
		<div class="sidebar-nav scrollbar scroll_light">
			<ul class="metismenu " id="sidebarNav">
				<!-- Dashboard -->
				<li class="<?php if(in_array('dashboard',$uri)){ ?>active<?php } ?>">
					<a href="<?=site_url();?>ctt-admin/dashboard" aria-expanded="false"><i class="nav-icon ti ti-rocket"></i><span class="nav-title"><?=$Dashboard;?></span></a>
				</li>
				<li class="<?php if(in_array('parameter-listing',$uri) || in_array('edit-parameter',$uri) || in_array('setting-listing',$uri) || in_array('add-setting',$uri) || in_array('add-configuration',$uri) || in_array('edit-configuration',$uri) || in_array('configuration-listing',$uri) || in_array('key-manager-listing',$uri) || in_array('add-key-manager',$uri) || in_array('edit-key-manager',$uri) || in_array('delete-key-manager',$uri)){ ?>active<?php } ?>">
					<a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon fa fa-lock"></i><span class="nav-title"><?=$ManageSocious;?></span></a>
					<ul aria-expanded="false">
						<li class="<?php if(in_array('parameter-listing',$uri) || in_array('edit-parameter',$uri)){ ?>active<?php } ?>">
						<a href="<?=site_url();?>ctt-admin/parameter-listing" aria-expanded="false"><i class="nav-icon fa fa-cog"></i><span class="nav-title"><?=$ManageParameter;?></span></a>
						</li>
						<li class="<?php if(in_array('setting-listing',$uri) || in_array('add-setting',$uri) || in_array('edit-setting',$uri)){ ?>active<?php } ?>">
						<a href="<?=site_url();?>ctt-admin/setting-listing" aria-expanded="false"><i class="nav-icon fa fa-cogs"></i><span class="nav-title"><?=$ManageSetting;?></span></a>
						</li>
						<li class="<?php if(in_array('key-manager-listing',$uri) || in_array('add-key-manager',$uri) || in_array('edit-key-manager',$uri) || in_array('delete-key-manager',$uri)){ ?>active<?php } ?>">
							<a href="<?=site_url();?>ctt-admin/key-manager-listing" aria-expanded="false"><i class="nav-icon fa fa-key"></i><span class="nav-title"><?=$ManageKeyManager;?></span></a>
						</li>
					</ul>
				</li>
				<li class="<?php if(in_array('industry-listing',$uri) || in_array('add-industry',$uri) || in_array('edit-industry',$uri) || in_array('department-listing',$uri) || in_array('add-department',$uri) || in_array('evaluation-questions-listing',$uri) || in_array('add-evaluation-questions',$uri) || in_array('edit-evaluation-questions',$uri) || in_array('delete-evaluation-questions',$uri) || in_array('contract-listing',$uri) || in_array('add-contract',$uri) || in_array('edit-contract',$uri)){ ?>active<?php } ?>">
					<a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon fa fa-users"></i><span class="nav-title"><?=$ManageMaster;?></span></a>
					<ul aria-expanded="false">
						<li class="<?php if(in_array('industry-listing',$uri) || in_array('add-industry',$uri) || in_array('edit-industry',$uri)){ ?>active<?php } ?>">
							<a href="<?=site_url();?>ctt-admin/industry-listing" aria-expanded="false"><i class="nav-icon fa fa-industry"></i><span class="nav-title"><?=$ManageIndustry;?></span></a>
						</li>
						<li class="<?php if(in_array('department-listing',$uri) || in_array('add-department',$uri) || in_array('edit-department',$uri)){ ?>active<?php } ?>">
							<a href="<?=site_url();?>ctt-admin/department-listing" aria-expanded="false"><i class="nav-icon fa fa-building"></i><span class="nav-title"><?=$ManageDepartment;?></span></a>
						</li>
						<li class="<?php if(in_array('evaluation-questions-listing',$uri) || in_array('add-evaluation-questions',$uri) || in_array('edit-evaluation-questions',$uri) || in_array('delete-evaluation-questions',$uri)){ ?>active<?php } ?>">
							<a href="<?=site_url();?>ctt-admin/evaluation-questions-listing" aria-expanded="false"><i class="nav-icon fa fa-question-circle"></i><span class="nav-title"><?=$ManageEvaluationQuestion;?></span></a>
						</li>
						<li class="<?php if(in_array('contract-listing',$uri) || in_array('add-contract',$uri) || in_array('edit-contract',$uri)){ ?>active<?php } ?>">
							<a href="<?=site_url();?>ctt-admin/contract-listing" aria-expanded="false"><i class="nav-icon fa fa-file"></i><span class="nav-title"><?=$ManageContract;?></span></a>
						</li>
					</ul>
				</li>
				<li class="<?php if(in_array('organisation-listing',$uri) || in_array('add-organisation',$uri) || in_array('edit-organisation',$uri) || in_array('getsbu',$uri) || in_array('add-employee-role',$uri) || in_array('sbu-listing',$uri) || in_array('add-sbu',$uri) || in_array('edit-sbu',$uri) || in_array('employee-listing',$uri) || in_array('add-employee',$uri) || in_array('edit-employee',$uri) || in_array('employeerole-listing',$uri)){ ?>active<?php } ?>">
					<a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon fa fa-users"></i><span class="nav-title"><?=$ManageOrganisation;?></span></a>
					<ul aria-expanded="false">
						<li class="<?php if(in_array('organisation-listing',$uri) || in_array('add-organisation',$uri) || in_array('edit-organisation',$uri)){ ?>active<?php } ?>">
							<a href="<?=site_url();?>ctt-admin/organisation-listing" aria-expanded="false"><i class="nav-icon fa fa-building"></i><span class="nav-title"><?=$ManageOrganisation;?></span></a>
						</li>
						<li class="<?php if(in_array('sbu-listing',$uri) || in_array('add-sbu',$uri) || in_array('edit-sbu',$uri)){ ?>active<?php } ?>">
							<a href="<?=site_url();?>ctt-admin/sbu-listing" aria-expanded="false"><i class="nav-icon fa fa-gears"></i><span class="nav-title"><?=$ManageSBU;?></span></a>
						</li>
						<li class="<?php if(in_array('employee-listing',$uri) || in_array('add-employee',$uri) || in_array('edit-employee',$uri) || in_array('add-employee-role',$uri) || in_array('employeerole-listing',$uri)){ ?>active<?php } ?>">
							<a href="<?=site_url();?>ctt-admin/employee-listing" aria-expanded="false"><i class="nav-icon fa fa-users"></i><span class="nav-title"><?=$ManageEmployee;?></span></a>
						</li>
					</ul>
				</li>
				
				<li class="<?php if(in_array('vendor-listing',$uri) || in_array('add-vendor',$uri) || in_array('edit-vendor',$uri) || in_array('assign-vendor-listing',$uri) || in_array('add-assign-vendor',$uri) || in_array('edit-assign-vendor',$uri) || in_array('delete-assign-vendor',$uri)){ ?>active<?php } ?>">
					<a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon fa fa-users"></i><span class="nav-title"><?=$ManageVendor;?></span></a>
					<ul aria-expanded="false">
						<li class="<?php if(in_array('vendor-listing',$uri) || in_array('add-vendor',$uri) || in_array('edit-vendor',$uri)){ ?>active<?php } ?>">
							<a href="<?=site_url();?>ctt-admin/vendor-listing" aria-expanded="false"><i class="nav-icon fa fa-handshake-o"></i><span class="nav-title"><?=$ManageVendor;?></span></a>
						</li>
						<li class="<?php if(in_array('assign-vendor-listing',$uri) || in_array('add-assign-vendor',$uri) || in_array('edit-assign-vendor',$uri) || in_array('delete-assign-vendor',$uri)){ ?>active<?php } ?>">
							<a href="<?=site_url();?>ctt-admin/assign-vendor-listing" aria-expanded="false"><i class="nav-icon fa fa-user-plus"></i><span class="nav-title"><?=$AssignVendor;?></span></a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	<!-- end sidebar-nav -->
</aside>
<!-- end app-navbar -->