<?php
namespace App\Models;

use CodeIgniter\Model;

class Adminvariable extends Model
{
   // protected $CI;
    public function variables()
    {
        //$this->CI = new Adminvariable(); //read manual: create libraries
        $dataX = array(); // set here all your vars to views
		$uri = explode('/',$_SERVER['REQUEST_URI']);//Request URL
		
		/***************************|--------------|************************/
		/***************************|ADMIN VARIBLES|***********************/
		/***************************|--------------|**********************/
		
		//Sidebar Variables
		$dataX['Dashboard'] = 'Dashboard';
		$dataX['SiteSettings'] = 'Site Settings';
		$dataX['ManageParameter'] = 'Manage Parameter';
		$dataX['ManageSetting']='Manage Setting';
		$dataX['ManageSocious']='Manage Socious';
		$dataX['ManageMaster']='Manage Master';
		$dataX['ManageIndustry']='Manage Industry';
		$dataX['ManageOrganisation']='Manage Organisation';
		$dataX['ManageDepartment']='Manage Department';
		$dataX['ManageContract']='Manage Contract';
		$dataX['ManageVendor']='Manage Vendor';
		$dataX['ManageSBU']='Manage SBU';
		$dataX['ManageEmployee']='Manage Employee';
		$dataX['ManageEmployeeRole']='Manage Employee Role';
		$dataX['ManageEvaluationQuestion']='Manage Evaluation Question';
		$dataX['ManageKeyManager']='Manage Key Manager';
		$dataX['AssignVendor'] = 'Assign Vendor';

		//Common Varibales
		$dataX['BTN_Add'] = 'Add';
		$dataX['BTN_Back'] = 'Back';
		$dataX['BTN_Save'] = 'Save';
		$dataX['BTN_Search'] = 'Search';
		$dataX['BTN_Submit'] = 'Submit';
		$dataX['BTN_Update'] = 'Update';
		$dataX['BTN_Cancel'] = 'Cancel';
		$dataX['BTN_Reset'] = 'Reset';
		$dataX['BTN_Delete'] = 'Delete';
		$dataX['BTN_Close'] = 'Close';
		$dataX['BTN_Ok'] = 'Ok';
		$dataX['BTN_Done'] = 'Done';
		$dataX['BTN_New'] = 'New';
		$dataX['BTN_Edit'] = 'Edit';
		$dataX['BTN_View'] = 'View';
		$dataX['BTN_ReadMore'] = '..Read More';
		$dataX['BTN_Active'] = 'Active';
		$dataX['BTN_Inactive'] = 'Inactive';
		$dataX['Select'] = 'Select';
		$dataX['Yes'] = 'Yes';
		$dataX['Close'] = 'Close';
		$dataX['Ok'] = 'Ok';
		$dataX['No'] = 'No';
		$dataX['SL'] = 'SL #';
		$dataX['NoRecordsFound'] = 'No Records Found !';
		$dataX['Status'] = 'Status';
		$dataX['Action'] = 'Action';
		$dataX['AreSureMsg'] = 'Are your sure to';
		$dataX['ThisOne'] = 'this one ?';
		$dataX['DeleteConfirmMsg'] = 'Are your sure to delete this one ?<br>This process can not be undo.';
		$dataX['DeleteImageConfirmMsg'] = 'Do you really want to delete this image ?<br>This process can not be undo.';
		$dataX['RefundConfirmMsg'] = 'Are your sure to refund this amount ?<br>This process can not be undo.';	
			
		$dataX['ProjectName'] = 'Contracktor';//Define Project Name
		$dataX['NotAllowedMsg'] = 'No direct script access allowed';
		$dataX['LoginPageTitle'] = 'Login | '.$dataX['ProjectName'];
		$dataX['ChangePassword'] = 'Change Password';
		$dataX['SignOut'] = 'Sign Out';
		$dataX['UploadImage'] = 'Upload Image';
		$dataX['Upload'] = 'Upload';
		$dataX['Document'] = 'Document';
		$dataX['ImageDelMsg'] = 'Your document was deleted successfully';
		$dataX['MediaUpload'] = './media/uploads/';
		$dataX['MediaView'] = 'public/uploads/';
		$dataX['NoImgPath'] = $dataX['MediaView'].'no-image.jpg';
		$dataX['SignIn'] = 'Sign In';
		$dataX['SignInMsg'] = 'Sign in to start your session';
		$dataX['UserId'] = 'Enter Your User Id';
		$dataX['Password'] = 'Enter Password';
		$dataX['ForgotPassword'] = 'Forgot Password ?';
		$dataX['ResetPassword'] = 'Reset Password';
		$dataX['List'] = 'List';
		$dataX['Menu'] = 'Home';
		$dataX['Copyright'] = 'Copyright';
		$dataX['AllRights'] = 'All rights reserved.';
		$dataX['CompanyName'] = 'Converthink Solutions';
		$dataX['AdminPanel'] = 'Admin Panel';
		$dataX['UserName'] = 'User Name';
		$dataX['Password'] = 'Password';
		$dataX['EmailAddress'] = 'Enter Your Email Address';
		$dataX['NewPassword'] = 'New Password';
		$dataX['ConfirmPassword'] = 'Confirm Password';
		$dataX['OldPassword'] = 'Old Password';
		$dataX['SignUp'] = 'Sign Up';
		$dataX['CreatePassword'] = 'Create Password';
		
		//Varibles Define For Change Password
		if(in_array('change-password',$uri))
		{
			$dataX['Menu'] = 'Home';
			$dataX['SubMenu'] = 'Change Password';
			$dataX['CP_ChangePassword'] = 'Change Password';
			$dataX['CP_Old_Password'] = 'Old Password';
			$dataX['CP_New_Password'] = 'New Password';
			$dataX['CP_Confirm_Password'] = 'Confirm Password';
			$dataX['CP_Back'] = 'Back to';
			$dataX['CP_Update'] = 'Update';
			$dataX['CP_Cancel'] = 'Cancel';
			$dataX['CP_Reset'] = 'Reset';
		}

		//Varibles Define For setting
		if(in_array('setting-listing',$uri) || in_array('add-setting',$uri) || in_array('edit-setting',$uri) || in_array('delete-setting',$uri) || in_array('inactive-setting',$uri) || in_array('active-setting',$uri))
		{
			$dataX['Menu'] = 'Master';
			$dataX['SubMenu'] = 'Manage Setting';
			$dataX['ST_Setting'] ='Setting';
			$dataX['ST_Parameter_Id'] = 'Parameter Name';
			$dataX['ST_Parameter_Value'] = 'Parameter Value';
			$dataX['ST_SelectParameter']='Select Parameter';
		}


		//Varibles Define For Parameter
		if(in_array('parameter-listing',$uri) || in_array('add-parameter',$uri) || in_array('edit-parameter',$uri) || in_array('delete-parameter',$uri) || in_array('inactive-parameter',$uri) || in_array('active-parameter',$uri))
		{
			$dataX['Menu'] = 'Master';
			$dataX['SubMenu'] = 'Manage Parameter';
			$dataX['ST_Parameter'] ='Parameter';
			$dataX['ST_Parameter_Name'] = 'Parameter Name';
		}	

		//Varibles Define For Industry
		if(in_array('industry-listing',$uri) || in_array('add-industry',$uri) || in_array('edit-industry',$uri) || in_array('delete-industry',$uri) || in_array('inactive-industry',$uri) || in_array('active-industry',$uri))
		{
			$dataX['Menu'] = 'Master';
			$dataX['SubMenu'] = 'Manage Industry';
			$dataX['MI_Industry_Name'] = 'Industry Name';
		}
		
		//Varibles Define For Organisation
		if(in_array('organisation-listing',$uri) || in_array('add-organisation',$uri) || in_array('edit-organisation',$uri) || in_array('delete-organisation',$uri) || in_array('inactive-organisation',$uri) || in_array('active-organisation',$uri) || in_array('AddMoreOrganisation',$uri))
		{
			$dataX['Menu'] = 'Master';
			$dataX['SubMenu'] = 'Manage Organisation';
			$dataX['MO_Organisation'] = 'Organisation';
			$dataX['MO_Company_Name'] = 'Company Name';
			$dataX['MO_Company_Logo'] = 'Company Logo';
			$dataX['MO_Phone_Landline'] = 'Phone Landline';
			$dataX['MO_Phone_Mobile'] = 'Phone Mobile';
			$dataX['MO_Email'] = 'Email';
			$dataX['MO_Corporate_Address'] = 'Corporate Address';
			$dataX['MO_Correspondence_Address'] = 'Correspondence Address';
			$dataX['MO_Contact_Name'] = 'Contact Name';
			$dataX['MO_Contact_Mobile'] = 'Contact Mobile';
			$dataX['MO_Contact_Email'] = 'Contact Email';
			$dataX['MO_Company_Type'] = 'Company Type';
			$dataX['MO_industry'] = 'Industry';
			$dataX['MO_Select_industry'] = 'Select Industry';
			$dataX['MO_Organisation_Id'] = 'Organisation Id';
			$dataX['MO_SBU_Name'] = 'SBU Name';
			$dataX['MO_Location'] = 'Location';
			$dataX['MO_ImageViewPath'] = $dataX['MediaView'].'company_logo/';
		}
		
		//Varibles Define For Department
		if(in_array('department-listing',$uri) || in_array('add-department',$uri) || in_array('edit-department',$uri) || in_array('delete-department',$uri) || in_array('inactive-department',$uri) || in_array('active-department',$uri))
		{
			$dataX['Menu'] = 'Master';
			$dataX['SubMenu'] = 'Manage Department';
			$dataX['MD_Department_Name'] = 'Department Name';
			$dataX['MD_Department_Code'] = 'Department Code';
		}
		
		if(in_array('contract-listing',$uri) || in_array('add-contract',$uri) || in_array('edit-contract',$uri) || in_array('delete-contract',$uri) || in_array('inactive-contract',$uri) || in_array('active-contract',$uri))
		{
			$dataX['Menu'] = 'Master';
			$dataX['SubMenu'] = 'Manage Contract';
			$dataX['MC_Contract_Type'] = 'Contract Type';
		}
		
		if(in_array('vendor-listing',$uri) || in_array('add-vendor',$uri) || in_array('edit-vendor',$uri) || in_array('delete-vendor',$uri) || in_array('view-vendor',$uri) || in_array('delete-company-logo',$uri) || in_array('delete-company-cin',$uri) || in_array('delete-company-gst',$uri) || in_array('delete-company-turn-over-one',$uri) || in_array('delete-company-turn-over-two',$uri) || in_array('delete-company-turn-over-three',$uri))
		{
			$dataX['Menu'] = 'Configuration';
			$dataX['SubMenu'] = 'Manage Vendor';
			$dataX['MV_Vendor'] ='Vendor';
			$dataX['MV_CompanyName'] ='Company Name';
			$dataX['MV_CompanyLogo'] ='Company Logo';
			$dataX['MV_PhoneLandline'] ='Phone Landline';
			$dataX['MV_PhoneMobile'] ='Phone Mobile';
			$dataX['MV_Email'] ='Email';
			$dataX['MV_AddressCorporate'] ='Address (Corporate)';
			$dataX['MV_AddressCorrespondence'] ='Address (Correspondence)';
			$dataX['MV_ContactName'] ='Name';
			$dataX['MV_ContactPhone'] ='Phone';
			$dataX['MV_ContactEmail'] ='Email';
			$dataX['MV_CompanyType'] ='Type Of Company';
			$dataX['MV_CompanyCINNo'] ='CIN No';
			$dataX['MV_CompanyCINNoDocument'] ='CIN No Document';
			$dataX['MV_GSTNo'] ='GST No(s)';
			$dataX['MV_GSTNoDocument'] ='GST No(s) Document';
			$dataX['MV_IndustriesOperating'] ='Industries in which operating';
			$dataX['MV_Locations'] ='Locations in which operating';
			$dataX['MV_SelectLocations'] ='Select Locations';
			$dataX['MV_AreaofExpertise'] ='Area of Expertise';
			$dataX['MV_IMSCertifications'] ='IMS Certifications';
			$dataX['MV_AwardsRecognitions'] ='Awards and Recognitions';
			$dataX['MV_TechnicalCollaborations'] ='Technical Collaborations';
			$dataX['MV_MemberOfIndustryAssociation'] ='Member Of Industry Association';
			$dataX['MV_TurnOverYear'] ='Turnover of last 3 years';
			$dataX['MV_TurnOverYearOne'] ='Turnover Year One';
			$dataX['MV_TurnOverYearTwo'] ='Turnover Year Two';
			$dataX['MV_TurnOverYearThree'] ='Turnover Year Three';
			$dataX['MV_TurnOver'] ='Turnover';
			$dataX['MV_TurnOverOne'] ='Turnover One';
			$dataX['MV_TurnOverTwo'] ='Turnover Two';
			$dataX['MV_TurnOverThree'] ='Turnover Three';
			$dataX['MV_CompanyLogoViewPath'] = $dataX['MediaView'].'vendor/company_logo/';
			$dataX['MV_CompanyCinViewPath'] = $dataX['MediaView'].'vendor/company_cin/';
			$dataX['MV_CompanyGstViewPath'] = $dataX['MediaView'].'vendor/company_gst/';
			$dataX['MV_CompanyTurnOverViewPath'] = $dataX['MediaView'].'vendor/company_turn_over/';
		}
		
		if(in_array('sbu-listing',$uri) || in_array('add-sbu',$uri) || in_array('edit-sbu',$uri) || in_array('delete-sbu',$uri) || in_array('AddMoreSbu',$uri) || in_array('delete-vendor-master',$uri) || in_array('delete-employee-master',$uri))
		{
			$dataX['Menu'] = 'Master';
			$dataX['SubMenu'] = 'Manage SBU';
			$dataX['MSBU_Sbu'] = 'SBU';
			$dataX['MSBU_OrganisationName'] = 'Organisation Name';
			$dataX['MSBU_SelectOrganisationName'] = 'Select Organisation Name';
			$dataX['MSBU_SBUName'] = 'SBU Name';
			$dataX['MSBU_SelectSBUName'] = 'Select SBU Name';
			$dataX['MSBU_Landline'] = 'Landline';
			$dataX['MSBU_Mobile'] = 'Mobile';
			$dataX['MSBU_CorporateAddress'] = 'Corporate Address';
			$dataX['MSBU_CorrespondenceAddress'] = 'Correspondence Address';
			$dataX['MSBU_SinglePointOfContact'] = 'Single Point Of Contact';
			$dataX['MSBU_Name'] = 'Name';
			$dataX['MSBU_Phone'] = 'Phone';
			$dataX['MSBU_Email'] = 'Email';
			$dataX['MSBU_CentralisedDepartments'] = 'Centralised Departments';
			$dataX['MSBU_DepartmentName'] = 'Department Name';
			$dataX['MSBU_DepartmentCode'] = 'Department Code';
			$dataX['MSBU_YesNo'] = 'Yes/No';
			$dataX['MSBU_Yes'] = 'Yes';
			$dataX['MSBU_No'] = 'No';
			$dataX['MSBU_OperatingDepartments'] = 'Operating Departments';
			$dataX['MSBU_VendorMaster'] = 'Vendor Master';
			$dataX['MSBU_EmployeeMaster'] = 'Employee Master';
			$dataX['MSBU_VendorMasterViewPath'] = $dataX['MediaView'].'vendor_master/';
			$dataX['MSBU_EmployeeMasterViewPath'] = $dataX['MediaView'].'employee_master/';
		}
		
		//Varibles Define For Organisation
		if(in_array('employee-listing',$uri) || in_array('add-employee',$uri) || in_array('edit-employee',$uri) || in_array('delete-employee',$uri) || in_array('inactive-employee',$uri) || in_array('active-employee',$uri) || in_array('getsbu',$uri))
		{
			$dataX['Menu'] = 'Master';
			$dataX['SubMenu'] = 'Manage Employee';
			$dataX['ME_Employee'] = 'Employee';
			$dataX['ME_Organisation_Name'] = 'Organisation Name';
			$dataX['ME_Select_Organisation'] = 'Select Organisation';
			$dataX['ME_SBU_Name'] = 'SBU Name';
			$dataX['ME_Select_SBU'] = 'Select SBU';
			$dataX['ME_Employee_Name'] = 'Employee Name';
			$dataX['ME_Employee_Email'] = 'Employee Email';
		}
		
		//Varibles Define For Organisation
		if(in_array('employeerole-listing',$uri) ||in_array('add-employee-role',$uri) || in_array('getsbu',$uri) || in_array('getdepartment',$uri))
		{
			$dataX['Menu'] = 'Manage Employee';
			$dataX['SubMenu'] = 'Manage Employee Role';
			$dataX['MER_Organisation_Name'] = 'Organisation Name';
			$dataX['MER_Select_Organisation'] = 'Select Organisation';
			$dataX['MER_SBU_Name'] = 'SBU Name';
			$dataX['MER_Select_SBU'] = 'Select SBU';
			$dataX['MER_All_Save'] = 'All Save';
			
			$dataX['MER_Users'] = 'Users';
			$dataX['MER_Access_Level'] = 'Access Level';
			$dataX['MER_Select_Access_Level'] = 'Select Access Level';
			$dataX['MER_Access_Level_2'] = 'Access Level 2';
			$dataX['MER_Select_Access_Level_2'] = 'Select Access Level 2';
			$dataX['MER_Department'] = 'Department';
			$dataX['MER_Select_Department'] = 'Select Department';
			$dataX['MER_Area'] = 'Area';
			$dataX['MER_Select_Area'] = 'Select Area';
			$dataX['MER_Role'] = 'Role';
			$dataX['MER_Select_Role'] = 'Select Role';
		}
		
		//Varibles Define For Evaluation Questions
		if(in_array('evaluation-questions-listing',$uri) || in_array('add-evaluation-questions',$uri) || in_array('edit-evaluation-questions',$uri) || in_array('delete-evaluation-questions',$uri) || in_array('search-evaluation-questions',$uri))
		{
			$dataX['Menu'] = 'Master';
			$dataX['SubMenu'] = 'Manage Evaluation Question';
			$dataX['MEQ_EvaluationQuestion'] = 'Evaluation Question';
		}
	
		//Varibles Define For Key Manager
		if(in_array('key-manager-listing',$uri) || in_array('add-key-manager',$uri) || in_array('edit-key-manager',$uri) || in_array('delete-key-manager',$uri))
		{
			$dataX['Menu'] = 'Master';
			$dataX['SubMenu'] = 'Manage Key Manager';
			$dataX['MKM_UserType'] = 'User Type';
			$dataX['MKM_SelectUserType'] = 'Select User Type';
			$dataX['MKM_KeyManagerName'] = 'Key Manager Name';
			$dataX['MKM_KeyManagerId'] = 'Manager Id';
			$dataX['MKM_KeyManagerEmail'] = 'Manager Email';
			$dataX['MKM_KeyManagerPhone'] = 'Manager Phone';
			$dataX['MKM_KeyManagerPassword'] = 'User Password';
		}
		
		
		if(in_array('assign-vendor-listing',$uri) || in_array('add-assign-vendor',$uri) || in_array('edit-assign-vendor',$uri) || in_array('delete-assign-vendor',$uri) || in_array('AddMoreAssignVendor',$uri) || in_array('delete-assign-vendor',$uri))
		{
			$dataX['Menu'] = 'Master';
			$dataX['SubMenu'] = 'Assign Vendor';
			$dataX['MAV_AssignVendor'] = 'Assign Vendor';
			$dataX['MAV_VendorName'] = 'Vendor Name';
			$dataX['MAV_SelectVendorName'] = 'Select Vendor Name';
			$dataX['MAV_OrganisationName'] = 'Organisation Name';
			$dataX['MAV_SelectOrganisationName'] = 'Select Organisation Name';
			$dataX['MAV_SBUName'] = 'SBU Name';
			$dataX['MAV_SelectSBUName'] = 'Select SBU Name';
			$dataX['MAV_VendorMasterName'] = 'Vendor Master Name';
			$dataX['MAV_SelectVendorMasterName'] = 'Select Vendor Name';
		}
		/********************ADMIN VARIABLES END********************/    
		/**************************************************************/ 
        //$this->CI->load->vars($dataX);//Load all variables in CI for View Pages
		//print_r($dataX);
		return $dataX;
    }
}