<?php
namespace App\Models;

use CodeIgniter\Model;

class Androidvariable extends Model
{
   // protected $CI;
    public function variables()
    {
         //$this->CI = new Uservariable(); //read manual: create libraries
        $dataX = array(); // set here all your vars to views
		$uri = explode('/',$_SERVER['REQUEST_URI']);//Request URL
		
		/***************************|--------------|************************/
		/***************************|User VARIBLES|***********************/
		
		//Common Varibales
		$dataX['BTN_Add'] = 'Add';
		$dataX['BTN_Back'] = 'Back';
		$dataX['BTN_Save'] = 'Save';
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
		$dataX['BTN_ReadMore'] = '..Read More';
		$dataX['BTN_Active'] = 'Active';
		$dataX['BTN_Inactive'] = 'Inactive';
		$dataX['Select'] = 'Select';
		$dataX['Yes'] = 'Yes';
		$dataX['Close'] = 'Close';
		$dataX['Ok'] = 'Ok';
		$dataX['No'] = 'No';
		$dataX['SL'] = 'SL #';
		$dataX['NoRecordsFound'] = 'Opps !! No Records Found ...';
		$dataX['NoCommentsYet'] = 'Opps !! No Comments Yet ...';
		$dataX['Status'] = 'Status';
		$dataX['Action'] = 'Action';
		$dataX['AreSureMsg'] = 'Are your sure to';
		$dataX['ThisOne'] = 'this one ?';
		$dataX['DeleteConfirmMsg'] = 'Are your sure to delete this one ?<br>This process can not be undo.';
		$dataX['DeleteImageConfirmMsg'] = 'Do you really want to delete this image ?<br>This process can not be undo.';
		
			
			
		$dataX['ProjectName'] = 'PhoneKwik';//Define Project Name
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
		
		/********************User VARIABLES END********************/    
		/**************************************************************/ 
        //$this->CI->load->vars($dataX);//Load all variables in CI for View Pages
		//print_r($dataX);
		return $dataX;
    }
}