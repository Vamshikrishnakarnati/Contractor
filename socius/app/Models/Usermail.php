<?php
namespace App\Models;

use CodeIgniter\Model;

class Usermail extends Model
{
	//Read the IPN Data
	public function Read_IPN_Data()
	{
		$data['project_team'] = "PhoneKwik Team"; 
		$data['admin_mailid'] = "info@converthink.in"; 
		$data['server_mailid'] = "info@converthink.in"; 
		return $data;
	}
	
	function Contact_Email($contact_email,$contact_name,$contact_phone,$contact_subject,$contact_message)
	{
		$IPN_Data = $this->Read_IPN_Data();
		$To_User_Mail_Content = '<table width="700px" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Hi '. $contact_name .',</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
					Thank you for contacting us.
				</td>
			</tr>
			<tr height="10px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
					We have forwarded your details to our respective department.
				</td>
			</tr>
			<tr height="10px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
					Our team will responds you as soon as possible.
				</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Thanks, <br />'. $IPN_Data['project_team'] .'</td>
			</tr>
		</table>';
		
		$to = $contact_email;
		$subject = 'Contact Confirmation From - '.$IPN_Data['project_team'];
		$message = $To_User_Mail_Content;
		$headers = array(
		'MIME-Version' =>  '1.0'. '\r\n',
		'Content-type' =>  'text/html;charset=UTF-8',
		'From' => $IPN_Data['admin_mailid'],
		'Reply-To' => $IPN_Data['admin_mailid'],
		'X-Mailer' => 'PHP/' . phpversion()
		);
		
		mail($to, $subject, $message, $headers);
	
		//	print_r($headers);exit;
		//print_r($message);
		$User_Mail_Content = '<table width="700px" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Hi Admin,</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
					One person contact you on - '. date('Y-m-d') .'
				</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
					His/Her contact informations are as follows:
				</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td width="40px"></td>
				<td width="120px" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Name: </td>
				<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">'. $contact_name .'</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td width="40px"></td>
				<td width="120px" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Email Id: </td>
				<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">'. $contact_email .'</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td width="40px"></td>
				<td width="120px" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Mobile No.: </td>
				<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">'. $contact_phone .'</td>
			</tr>
			<tr height="10px"><td colspan="3"></td></tr>
			<tr>
				<td></td>
				<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Subject: </td>
				<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">'. $contact_subject .'</td>
			</tr>
			<tr height="10px"><td colspan="3"></td></tr>
			<tr>
				<td></td>
				<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;" valign="top">Content Details: </td>
				<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">'. $contact_message .'</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
					He/She is waiting for your valuable response.
				</td>
			</tr>
			<tr height="10px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
					Try to respond him as soon as possible.
				</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Thanks, <br />'. $IPN_Data['project_team'] .'</td>
			</tr>
		</table>';
		$to = $IPN_Data['admin_mailid'];
		$subject = 'New Contact Email From - '.$IPN_Data['project_team'];
		$message = $User_Mail_Content;
		//print_r($message);exit;
		$headers = array(
		'MIME-Version' =>  '1.0'. '\r\n',
		'Content-type' =>  'text/html;charset=UTF-8',
		'From' => $IPN_Data['admin_mailid'],
		'Reply-To' => $IPN_Data['admin_mailid'],
		'X-Mailer' => 'PHP/' . phpversion()
		);
		mail($to, $subject, $message, $headers);
	}
	
	
	//Send Email to the admin forgot password to reset password
	function ForgotPwdEmail($user_email,$user_name)
	{
		$IPN_Data = $this->Read_IPN_Data();
		$encode_value = base64_encode($user_email);
		$mm_email = rtrim($encode_value, '=');
		$To_User_Mail_Content = '<table width="700px" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Hi '.$user_name.',</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
					You recently requested to reset your password for your account.<br>
					Please click the below link to reset your password.
				</td>
			</tr>
			<tr height="10px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
					<a href="'.site_url().'Reset-Password/'.$mm_email.'" target="_blank_">Reset your password</a>
				</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Thanks, <br />'. $IPN_Data['project_team'] .'</td>
			</tr>
		</table>';
		
		$to = $user_email;
		$subject = 'Reset Password From - '.$IPN_Data['project_team'];
		$message = $To_User_Mail_Content;
		//print_r($message);exit;
		$headers = array(
		'MIME-Version' =>  '1.0'. '\r\n',
		'Content-type' =>  'text/html;charset=UTF-8',
		'From' => $IPN_Data['admin_mailid'],
		'Reply-To' => $IPN_Data['admin_mailid'],
		'X-Mailer' => 'PHP/' . phpversion()
		);
		
		mail($to, $subject, $message, $headers);
	}
	
	function RegistrationSuccessful($refer_code,$full_name,$user_name,$user_email,$user_phone,$password)
	{
		$this->user = new User();
		$IPN_Data = $this->Read_IPN_Data();
		$User_Mail_Content = '<table width="700px" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Hi '.$full_name.',</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
					You have successfully registered as a Phonekwik User.
				</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
					Your login details are as follows:
				</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td width="40px"></td>
				<td width="120px" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Refer Code: </td>
				<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">'. $refer_code .'</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td width="40px"></td>
				<td width="120px" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">User Name: </td>
				<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">'. $user_name .'</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td width="40px"></td>
				<td width="120px" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Email: </td>
				<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">'. $user_email .'</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td width="40px"></td>
				<td width="120px" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Phone No.: </td>
				<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">'. $user_phone .'</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td width="40px"></td>
				<td width="120px" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Password : </td>
				<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">'. $password .'</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Thanks, <br />'. $IPN_Data['project_team'] .'</td>
			</tr>
		</table>';
		$to = $user_email;
		$subject = 'Registration Successful - '.$IPN_Data['project_team'];;
		$message = $User_Mail_Content;
		//print_r($message);exit;
		$headers = array(
		'MIME-Version' =>  '1.0'. '\r\n',
		'Content-type' =>  'text/html;charset=UTF-8',
		'From' => $IPN_Data['admin_mailid'],
		'Reply-To' => $IPN_Data['admin_mailid'],
		'X-Mailer' => 'PHP/' . phpversion()
		);
		//mail($to, $subject, $message, $headers);
	}
	
	
	
	function Support_Email($contact_email,$contact_name,$contact_phone,$contact_subject,$contact_message)
	{
		$IPN_Data = $this->Read_IPN_Data();
		$To_User_Mail_Content = '<table width="700px" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Hi '. $contact_name .',</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
					Thank you for contacting us.
				</td>
			</tr>
			<tr height="10px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
					We have forwarded your details to our respective department.
				</td>
			</tr>
			<tr height="10px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
					Our team will responds you as soon as possible.
				</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Thanks, <br />'. $IPN_Data['project_team'] .'</td>
			</tr>
		</table>';
		
		$to = $contact_email;
		$subject = 'Support Query From - '.$IPN_Data['project_team'];
		$message = $To_User_Mail_Content;
		$headers = array(
		'MIME-Version' =>  '1.0'. '\r\n',
		'Content-type' =>  'text/html;charset=UTF-8',
		'From' => $IPN_Data['admin_mailid'],
		'Reply-To' => $IPN_Data['admin_mailid'],
		'X-Mailer' => 'PHP/' . phpversion()
		);
		
		mail($to, $subject, $message, $headers);
	
		//print_r($message);exit;
		
		$User_Mail_Content = '<table width="700px" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Hi Admin,</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
					One person contact you on - '. date('Y-m-d') .'
				</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
					His/Her contact informations are as follows:
				</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td width="40px"></td>
				<td width="120px" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Name: </td>
				<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">'. $contact_name .'</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td width="40px"></td>
				<td width="120px" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Email Id: </td>
				<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">'. $contact_email .'</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td width="40px"></td>
				<td width="120px" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Mobile No.: </td>
				<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">'. $contact_phone .'</td>
			</tr>
			<tr height="10px"><td colspan="3"></td></tr>
			<tr>
				<td></td>
				<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Subject: </td>
				<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">'. $contact_subject .'</td>
			</tr>
			<tr height="10px"><td colspan="3"></td></tr>
			<tr>
				<td></td>
				<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;" valign="top">Content Details: </td>
				<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">'. $contact_message .'</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
					He/She is waiting for your valuable response.
				</td>
			</tr>
			<tr height="10px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
					Try to respond him as soon as possible.
				</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Thanks, <br />'. $IPN_Data['project_team'] .'</td>
			</tr>
		</table>';
		$to = $IPN_Data['admin_mailid'];
		$subject = 'New Support Query From - '.$IPN_Data['project_team'];
		$message = $User_Mail_Content;
		//print_r($message);exit;
		$headers = array(
		'MIME-Version' =>  '1.0'. '\r\n',
		'Content-type' =>  'text/html;charset=UTF-8',
		'From' => $IPN_Data['admin_mailid'],
		'Reply-To' => $IPN_Data['admin_mailid'],
		'X-Mailer' => 'PHP/' . phpversion()
		);
		mail($to, $subject, $message, $headers);
	}
	
	
	//Send Email to the admin forgot password to reset password
	function AndroidForgotOTPPassEmail($user_email,$user_name,$otppassword)
	{
		$IPN_Data = $this->Read_IPN_Data();
		$session = \Config\Services::session();
		$this->user = new User();
		$User_Mail_Content = '<table width="700px" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Hi '.$user_name.',</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
							You"ve forgotten your PhoneKwik password.
				</td>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
							No problem.
				</td>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
							Here is your temporary one time password - ' . $otppassword . '.
				</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Thanks, <br />'. $IPN_Data['project_team'] .'</td>
			</tr>
		</table>';
		$to = $user_email;
		$subject = $this->user->HtmlStripSlash($ForgtPassword->subject);
		$message = $User_Mail_Content;
		//print_r($message);exit;
		$headers = array(
		'MIME-Version' =>  '1.0'. '\r\n',
		'Content-type' =>  'text/html;charset=UTF-8',
		'From' => $IPN_Data['admin_mailid'],
		'Reply-To' => $IPN_Data['admin_mailid'],
		'X-Mailer' => 'PHP/' . phpversion()
		);
		mail($to, $subject, $message, $headers);
	}
	
	
	
}
?>