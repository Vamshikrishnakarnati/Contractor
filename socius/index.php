<?php

// Valid PHP Version?
$minPHPVersion = '7.1';
if (phpversion() < $minPHPVersion)
{
	die("Your PHP version must be {$minPHPVersion} or higher to run CodeIgniter. Current version: " . phpversion());
}
unset($minPHPVersion);

	//Admin Variable Define
	$uri = explode('/',$_SERVER['REQUEST_URI']);
	
	//Define All Table Variables
	define('Prefix','ctt_');
	define('tbl_admin',Prefix.'admin');
	define('tbl_parameter',Prefix.'parameter');
    define('tbl_setting',Prefix.'setting');
    define('tbl_industry',Prefix.'industry');
    define('tbl_organisation',Prefix.'organisation');
	define('tbl_department',Prefix.'department');
    define('tbl_contract',Prefix.'contract');
    define('tbl_vendor',Prefix.'vendor');
    define('tbl_state',Prefix.'state');
    define('tbl_sbu',Prefix.'sbu');
    define('tbl_other_operational_department',Prefix.'other_operational_department');
    define('tbl_centralised_department',Prefix.'centralised_department');
    define('tbl_employee',Prefix.'employee');
    define('tbl_vendor_master',Prefix.'vendor_master');
    define('tbl_access_level',Prefix.'access_level');
    define('tbl_access_level2',Prefix.'access_level2');
    define('tbl_area',Prefix.'area');
    define('tbl_role',Prefix.'role');
    define('tbl_sub_department',Prefix.'sub_department');
    define('tbl_evaluation_question',Prefix.'evaluation_question');
    define('tbl_evaluation_points',Prefix.'evaluation_points');
	define('tbl_assign_vendor',Prefix.'assign_vendor');
 
	define('RozorPayApiKey',"rzp_test_V90UZBjlOMtgJg");
	define('RozorPaySecretKey',"9t84B1z07diVbSfYbEKegswq");
	
	/* //Common Variables	 */
	define('DocumentExtension','err|doc|DOC|docx|DOCX|PDF|pdf');
	define('AllDocumentExtension','err|doc|DOC|docx|DOCX|PDF|pdf|jpg|JPG|png|PNG|jpeg|JPEG');
	define('DocumentSize','3000');
	define('MediaUpload','./public/uploads/');
	define('ImageExtension','err|jpg|JPG|png|PNG|jpeg|JPEG');
	define('LoginErrMsg','Incorrect user id or password please try again');
	define('LoginErrEmail','Incorrect email address please try again');
	define('ForgotMsg','A link send to your email id successfully to reset your password');
	define('NotMatchPassMsg','New password and confirm password mismatch');
	define('ResetPasswordMsg','Password reset successfully');
	define('ChangeUserPasswordMsg','Password changed successfully');
	define('InactiveErrMsg','Sorry Your Account is Deactive Please Contact to Support Team');
	define('NotMatchMpinMsg','New pin and old pin mismatch');
	define('GlobalCondition',"is_active = '1' AND is_delete = '0'");
	define('GlobalOrderByColumn',"id");
	define('GlobalOrderByType',"DESC");
	define('ImgFolder','public/assets/user/images/');
	define('NotRegisterdErrEmail','Sorry your this email is not registered in our database');
	define('CreatePasswordMsg','Password created successfully');
	
	//Varibles Define For ChangePassword
	if(in_array('change-password',$uri) || in_array('Change-Password',$uri))
	{
		define('ChangePasswordMsg','Password changed successfully');
		define('NotMatchCurrPass','Old password not matched');
	}
	
	//Varibles Define For Parameter
	if(in_array('edit-parameter',$uri))
	{
		define('MP_UpdateMsg','Parameter name updated successfully');
	}
	//Varibles Define For Setting
	if(in_array('edit-setting',$uri))
	{
		
		define('ST_UpdateMsg','Setting updated successfully');
		
	}
	
	//Varibles Define For Industry 
	if(in_array('industry-listing',$uri) || in_array('add-industry',$uri) || in_array('edit-industry',$uri) || in_array('inactive-industry',$uri) || in_array('active-industry',$uri) || in_array('delete-industry',$uri))
	{
		define('MI_AddMsg','Industry inserted successfully');
		define('MI_UpdateMsg','Industry updated successfully');
		define('MI_InactiveMsg','Industry deactivated successfully');
		define('MI_ActiveMsg','Industry activated successfully');
		define('MI_DeleteMsg','Industry deleted successfully');
	}
	
	//Varibles Define For Organisation 
	if(in_array('organisation-listing',$uri) || in_array('add-organisation',$uri) || in_array('edit-organisation',$uri) || in_array('inactive-organisation',$uri) || in_array('active-organisation',$uri) || in_array('delete-organisation',$uri) || in_array('delete-organisation-image',$uri))
	{
		define('MO_AddMsg','Organisation inserted successfully');
		define('MO_UpdateMsg','Organisation updated successfully');
		define('MO_InactiveMsg','Organisation deactivated successfully');
		define('MO_ActiveMsg','Organisation activated successfully');
		define('MO_DeleteMsg','Organisation deleted successfully');
		define('MO_ImagePath',MediaUpload.'company_logo/');
	}
	
	//Varibles Define For Department 
	if(in_array('department-listing',$uri) || in_array('add-department',$uri) || in_array('edit-department',$uri) || in_array('inactive-department',$uri) || in_array('active-department',$uri) || in_array('delete-department',$uri))
	{
		define('MD_AddMsg','Department inserted successfully');
		define('MD_UpdateMsg','Department updated successfully');
		define('MD_InactiveMsg','Department deactivated successfully');
		define('MD_ActiveMsg','Department activated successfully');
		define('MD_DeleteMsg','Department deleted successfully');
	}
	
	//Varibles Define For Contract 
	if(in_array('contract-listing',$uri) || in_array('add-contract',$uri) || in_array('edit-contract',$uri) || in_array('inactive-contract',$uri) || in_array('active-contract',$uri) || in_array('delete-contract',$uri))
	{
		define('MC_AddMsg','Contract inserted successfully');
		define('MC_UpdateMsg','Contract updated successfully');
		define('MC_InactiveMsg','Contract deactivated successfully');
		define('MC_ActiveMsg','Contract activated successfully');
		define('MC_DeleteMsg','Contract deleted successfully');
	}
	
	//Varibles Define For Vendor
	if(in_array('vendor-listing',$uri) || in_array('add-vendor',$uri) || in_array('edit-vendor',$uri) || in_array('delete-vendor',$uri) || in_array('delete-company-logo',$uri) || in_array('delete-company-cin',$uri) || in_array('delete-company-gst',$uri) || in_array('delete-company-turn-over-one',$uri) || in_array('delete-company-turn-over-two',$uri) || in_array('delete-company-turn-over-three',$uri))
	{
		define('MV_AddMsg','Vendor inserted successfully');
		define('MV_UpdateMsg','Vendor updated successfully');
		define('MV_InactiveMsg','Vendor deactivated successfully');
		define('MV_ActiveMsg','Vendor activated successfully');
		define('MV_DeleteMsg','Vendor deleted successfully');
		define('MV_CompanyLogoImagePath',MediaUpload.'vendor/company_logo/');
		define('MV_CompanyCinImagePath',MediaUpload.'vendor/company_cin/');
		define('MV_CompanyGstImagePath',MediaUpload.'vendor/company_gst/');
		define('MV_CompanyTurnOverImagePath',MediaUpload.'vendor/company_turn_over/');
	}
	
	//Varibles Define For SBU
	if(in_array('sbu-listing',$uri) || in_array('add-sbu',$uri) || in_array('edit-sbu',$uri) || in_array('delete-sbu',$uri) || in_array('delete-company-logo',$uri) || in_array('delete-company-cin',$uri) || in_array('delete-company-gst',$uri) || in_array('delete-company-turn-over-one',$uri) || in_array('delete-company-turn-over-two',$uri) || in_array('delete-company-turn-over-three',$uri))
	{
		define('MSBU_AddMsg','SBU inserted successfully');
		define('MSBU_UpdateMsg','SBU updated successfully');
		define('MSBU_InactiveMsg','SBU deactivated successfully');
		define('MSBU_ActiveMsg','SBU activated successfully');
		define('MSBU_DeleteMsg','SBU deleted successfully');
		define('MSBU_VendorMasterImagePath',MediaUpload.'vendor_master/');
		define('MSBU_EmployeeMasterImagePath',MediaUpload.'employee_master/');
	}
	
	//Varibles Define For Employee 
	if(in_array('employee-listing',$uri) || in_array('add-employee',$uri) || in_array('edit-employee',$uri) || in_array('inactive-employee',$uri) || in_array('active-employee',$uri) || in_array('delete-employee',$uri))
	{
		define('ME_AddMsg','Employee inserted successfully');
		define('ME_UpdateMsg','Employee updated successfully');
		define('ME_InactiveMsg','Employee deactivated successfully');
		define('ME_ActiveMsg','Employee activated successfully');
		define('ME_DeleteMsg','Employee deleted successfully');
	}
	
	//Varibles Define For Employee 
	if(in_array('employeerole-listing',$uri))
	{
		define('MER_AddMsg','Employee role inserted successfully');
		define('MER_UpdateMsg','Employee role updated successfully');
		define('MER_InactiveMsg','Employee role deactivated successfully');
		define('MER_ActiveMsg','Employee role activated successfully');
		define('MER_DeleteMsg','Employee role deleted successfully');
	}
	
	//Varibles Define For Evaluation Question 
	if(in_array('evaluation-questions-listing',$uri) || in_array('add-evaluation-questions',$uri) || in_array('edit-evaluation-questions',$uri) || in_array('search-evaluation-questions',$uri) || in_array('delete-evaluation-questions',$uri))
	{
		define('MEQ_AddMsg','Evaluation question inserted successfully');
		define('MEQ_UpdateMsg','Evaluation question updated successfully');
		define('MEQ_DeleteMsg','Evaluation question deleted successfully');
	}
	
	
	//Varibles Define For Key Manager 
	if(in_array('key-manager-listing',$uri) || in_array('add-key-manager',$uri) || in_array('edit-key-manager',$uri) || in_array('inactive-key-manager',$uri) || in_array('active-key-manager',$uri) || in_array('delete-key-manager',$uri))
	{
		define('MKM_AddMsg','Key manager inserted successfully');
		define('MKM_UpdateMsg','Key manager updated successfully');
		define('MKM_DeleteMsg','Key manager deleted successfully');
	}
	//*--------------------------------------------------------------------------------------------------------------	
										//USER VARIABLES DEFINE HERE
	//*--------------------------------------------------------------------------------------------------------------
	






// Path to the front controller (this file)
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Location of the Paths config file.
// This is the line that might need to be changed, depending on your folder structure.
$pathsPath = FCPATH . 'app/Config/Paths.php';
// ^^^ Change this if you move your application folder

/*
 *---------------------------------------------------------------
 * BOOTSTRAP THE APPLICATION
 *---------------------------------------------------------------
 * This process sets up the path constants, loads and registers
 * our autoloader, along with Composer's, loads our constants
 * and fires up an environment-specific bootstrapping.
 */

// Ensure the current directory is pointing to the front controller's directory
chdir(__DIR__);

// Load our paths config file
require $pathsPath;
$paths = new Config\Paths();

// Location of the framework bootstrap file.
$app = require rtrim($paths->systemDirectory, '/ ') . '/bootstrap.php';

/*
 *---------------------------------------------------------------
 * LAUNCH THE APPLICATION
 *---------------------------------------------------------------
 * Now that everything is setup, it's time to actually fire
 * up the engines and make this app do its thang.
 */
$app->run();
