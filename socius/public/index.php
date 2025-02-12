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
	define('Prefix','mob_');
	define('tbl_admin',Prefix.'admin');
	define('tbl_parameter',Prefix.'parameter');
    define('tbl_setting',Prefix.'setting');
	define('tbl_page',Prefix.'page');
	define('tbl_contact_us',Prefix.'contact_us');
	define('tbl_banner',Prefix.'banner');
	define('tbl_blog',Prefix.'blog');
	define('tbl_blog_comment',Prefix.'blog_comment');
	define('tbl_associates',Prefix.'associates');
	define('tbl_category',Prefix.'category');
	define('tbl_enquiry',Prefix.'enquiry');
	define('tbl_reference',Prefix.'reference');
	define('tbl_feed_back',Prefix.'feed_back');
	define('tbl_faq',Prefix.'faq');
	define('tbl_testimonial',Prefix.'testimonial');
	define('tbl_services',Prefix.'services');
	
	
	
	//Common Variables	
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
	define('InactiveErrMsg','Sorry Your Account is Deactive Please Contact to Support Team');
	define('GlobalCondition',"is_active = '1' AND is_delete = '0'");
	define('GlobalOrderByColumn',"id");
	define('GlobalOrderByType',"DESC");
	define('ImgFolder','public/assets/user/images/');
	
	//Varibles Define For ChangePassword
	if(in_array('change-password',$uri))
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
	//Varibles Define For Content
	if(in_array('edit-content',$uri))
	{
		
		define('CN_UpdateMsg','Content updated successfully');
		
	}
	//Varibles Define For Faq 
	if(in_array('faq-listing',$uri) || in_array('add-faq',$uri) || in_array('edit-faq',$uri) || in_array('delete-faq',$uri) || in_array('inactive-faq',$uri) || in_array('active-faq',$uri))
	{
		define('MF_AddMsg','Faq inserted successfully');
		define('MF_UpdateMsg','Faq updated successfully');
		define('MF_InactiveMsg','Faq deactivated successfully');
		define('MF_ActiveMsg','Faq activated successfully');
		define('MF_DeleteMsg','Faq deleted successfully');
	}
	//Varibles Define For Testimonial 
	if(in_array('testimonial-listing',$uri) || in_array('add-testimonial',$uri) || in_array('edit-testimonial',$uri) || in_array('delete-testimonial',$uri) || in_array('inactive-testimonial',$uri) || in_array('active-testimonial',$uri))
	{
		define('MT_AddMsg','Testimonial inserted successfully');
		define('MT_UpdateMsg','Testimonial updated successfully');
		define('MT_InactiveMsg','Testimonial deactivated successfully');
		define('MT_ActiveMsg','Testimonial activated successfully');
		define('MT_DeleteMsg','Testimonial deleted successfully');
		define('MT_ImagePath',MediaUpload.'testimonial/');
	}
	//Varibles Define For Services 
	if(in_array('services-listing',$uri) || in_array('add-services',$uri) || in_array('edit-services',$uri) || in_array('delete-services',$uri) || in_array('inactive-services',$uri) || in_array('active-services',$uri))
	{
		define('MS_AddMsg','Services inserted successfully');
		define('MS_UpdateMsg','Services updated successfully');
		define('MS_InactiveMsg','Services deactivated successfully');
		define('MS_ActiveMsg','Services activated successfully');
		define('MS_DeleteMsg','Services deleted successfully');
		define('MS_ImagePath',MediaUpload.'services/');
	}
	
	//Varibles Define For Banner 
	if(in_array('banner-listing',$uri) || in_array('add-banner',$uri) || in_array('edit-banner',$uri) || in_array('delete-banner',$uri) || in_array('inactive-banner',$uri) || in_array('active-banner',$uri) || in_array('delete-banner-image',$uri))
	{
		define('BN_AddMsg','Banner inserted successfully');
		define('BN_UpdateMsg','Banner updated successfully');
		define('BN_InactiveMsg','Banner deactivated successfully');
		define('BN_ActiveMsg','Banner activated successfully');
		define('BN_DeleteMsg','Banner deleted successfully');
		define('BN_ImagePath',MediaUpload.'banner/');
	}
	
	//Varibles Define For Blog 
	if(in_array('blog-listing',$uri) || in_array('add-blog',$uri) || in_array('edit-blog',$uri) || in_array('delete-blog',$uri) || in_array('inactive-blog',$uri) || in_array('active-blog',$uri) || in_array('delete-blog-image',$uri) || in_array('blog-comment-listing',$uri) || in_array('active-blog-comment',$uri) || in_array('inactive-blog-comment',$uri))
	{
		define('BL_AddMsg','Blog inserted successfully');
		define('BL_UpdateMsg','Blog updated successfully');
		define('BL_InactiveMsg','Blog deactivated successfully');
		define('BL_ActiveMsg','Blog activated successfully');
		define('BL_DeleteMsg','Blog deleted successfully');
		define('BL_ImagePath',MediaUpload.'blog/');
		
		define('BLC_InactiveMsg','Blog comment deactivated successfully');
		define('BLC_ActiveMsg','Blog comment activated successfully');
		define('BLC_DeleteMsg','Blog comment deleted successfully');
	}
	
	//Varibles Define For Footer Links 
	if(in_array('footer-links-listing',$uri) || in_array('add-footer-links',$uri) || in_array('delete-footer-links',$uri) || in_array('inactive-footer-links',$uri) || in_array('active-footer-links',$uri) || in_array('edit-footer-links',$uri))
	{
		define('MFL_AddMsg','Footer links inserted successfully');
		define('MFL_InactiveMsg','Footer links deactivated successfully');
		define('MFL_UpdateMsg','Footer links updated successfully');
		define('MFL_ActiveMsg','Footer links activated successfully');
		define('MFL_DeleteMsg','Footer links deleted successfully');
	}
	
	//Varibles Define For Footer Links 
	if(in_array('contactus-listing',$uri) || in_array('reply-contactus',$uri) || in_array('delete-contactus',$uri))
	{
		define('MCU_ReplyMsg','Reply sent successfully');
		define('MCU_DeleteMsg','Contact Us deleted successfully');
	}
	
	//Varibles Define For Category 
	if(in_array('category-listing',$uri) || in_array('add-category',$uri) || in_array('edit-category',$uri) || in_array('delete-category',$uri) || in_array('inactive-category',$uri) || in_array('active-category',$uri))
	{
		define('MC_AddMsg','Category inserted successfully');
		define('MC_UpdateMsg','Category updated successfully');
		define('MC_InactiveMsg','Category deactivated successfully');
		define('MC_ActiveMsg','Category activated successfully');
		define('MC_DeleteMsg','Category deleted successfully');
	}
	
	
	
	//Varibles Define For Associates 
	if(in_array('associates-listing',$uri) || in_array('add-associates',$uri) || in_array('edit-associates',$uri) || in_array('delete-associates',$uri) || in_array('inactive-associates',$uri) || in_array('active-associates',$uri) || in_array('delete-associates-image',$uri))
	{
		define('BA_AddMsg','Associates inserted successfully');
		define('BA_UpdateMsg','Associates updated successfully');
		define('BA_InactiveMsg','Associates deactivated successfully');
		define('BA_ActiveMsg','Associates activated successfully');
		define('BA_DeleteMsg','Associates deleted successfully');
		define('BA_ImagePath',MediaUpload.'associates/');
	}
	
	//Varibles Define For Footer Links 
	if(in_array('feedback-listing',$uri) || in_array('reply-feedback',$uri) || in_array('delete-feedback',$uri))
	{
		define('MFB_ReplyMsg','Reply sent successfully');
		define('MFB_DeleteMsg','FeedBack deleted successfully');
	}
	
	//Varibles Define For Enquiry
	if(in_array('enquiry-listing',$uri) || in_array('reply-enquiry',$uri) || in_array('delete-enquiry',$uri))
	{
		define('ME_ReplyMsg','Reply sent successfully');
		define('ME_DeleteMsg','Enquiry deleted successfully');
	}
	
	//Varibles Define For Reference 
	if(in_array('reference-listing',$uri) || in_array('add-reference',$uri) || in_array('edit-reference',$uri) || in_array('delete-reference',$uri) || in_array('inactive-reference',$uri) || in_array('active-reference',$uri) || in_array('delete-reference-image',$uri))
	{
		define('MR_AddMsg','Reference inserted successfully');
		define('MR_UpdateMsg','Reference updated successfully');
		define('MR_InactiveMsg','Reference deactivated successfully');
		define('MR_ActiveMsg','Reference activated successfully');
		define('MR_DeleteMsg','Reference deleted successfully');
		define('MR_ImagePath',MediaUpload.'reference/');
	}

// Path to the front controller (this file)
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Location of the Paths config file.
// This is the line that might need to be changed, depending on your folder structure.
$pathsPath = FCPATH . '../app/Config/Paths.php';
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
