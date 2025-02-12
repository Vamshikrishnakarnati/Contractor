<?php
namespace App\Models;

use CodeIgniter\Model;

class Adminmail extends Model
{
	 public function Read_IPN_Data()
    {
		$data['project_team'] = "Conracktor Team"; 
		$data['admin_mailid'] = "info@converthink.in"; 
		$data['server_mailid'] = "info@converthink.in"; 
		return $data;
	}	
	//Send Email to the admin forgot password to reset password
	function forgetpassemail($user_email,$user_name)
	{
		$IPN_Data = $this->Read_IPN_Data();
		$email = \Config\Services::email();
		$config['mailtype'] = 'html';
		$email->initialize($config);
		$email->setFrom($IPN_Data['admin_mailid'], $IPN_Data['project_team']);
		$email->setTo($user_email);
		$email->setSubject('Reset your password - '.$IPN_Data['project_team']);
		$encode_value = base64_encode($user_email);
		$mm_email = rtrim($encode_value, '=');
		$User_Mail_Content = '<table width="700px" border="0" cellpadding="0" cellspacing="0">
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
					<a href="'.site_url().'bo-admin/reset-password/'.$mm_email.'" target="_blank_">Reset your password</a>
				</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Thanks, <br />'. $IPN_Data['project_team'] .'</td>
			</tr>
		</table>';
		$email->setMessage($User_Mail_Content);
		//print_r($email); exit;
		$email->send();
		$email->clear();
	}
	
	//Send Email to the admin Contact_Email
	function Contact_Email($contact_email_id,$contact_name,$contact_message)
	{
		$IPN_Data = $this->Read_IPN_Data();
		$email = \Config\Services::email();
		$config['mailtype'] = 'html';
		$email->initialize($config);
		$email->setFrom($IPN_Data['admin_mailid'], $IPN_Data['project_team']);
		$email->setTo($contact_email_id);
		$email->setSubject('Contact Reply Confirmation From - '.$IPN_Data['project_team']);
		$encode_value = base64_encode($contact_email_id);
		$mm_email = rtrim($encode_value, '=');
		$User_Mail_Content = '<table width="700px" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Hi '. $contact_name .',</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
					'. $contact_message .',
				</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Thanks, <br />'. $IPN_Data['project_team'] .'</td>
			</tr>
		</table>';
		$email->setMessage($User_Mail_Content);
		//print_r($email); exit;
		$email->send();
		$email->clear();
	}
	
	
	//Send Email to the admin Support Email
	function Support_Email($contact_email_id,$contact_name,$contact_message)
	{
		$IPN_Data = $this->Read_IPN_Data();
		$email = \Config\Services::email();
		$config['mailtype'] = 'html';
		$email->initialize($config);
		$email->setFrom($IPN_Data['admin_mailid'], $IPN_Data['project_team']);
		$email->setTo($contact_email_id);
		$email->setSubject('Contact Reply Confirmation From - '.$IPN_Data['project_team']);
		$encode_value = base64_encode($contact_email_id);
		$mm_email = rtrim($encode_value, '=');
		$User_Mail_Content = '<table width="700px" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Hi '. $contact_name .',</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
					'. $contact_message .',
				</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Thanks, <br />'. $IPN_Data['project_team'] .'</td>
			</tr>
		</table>';
		$email->setMessage($User_Mail_Content);
		//print_r($email); exit;
		$email->send();
		$email->clear();
	}
	function RegistrationSuccessful($admin_name,$admin_id,$admin_email,$admin_phone)
	{
		$this->user = new User();
		$IPN_Data = $this->Read_IPN_Data();
		$User_Mail_Content = '<table width="700px" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Hi '.$admin_name.',</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
					You have successfully registered as a Key Manager.
				</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
					Your Details are as follows:
				</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td width="40px"></td>
				<td width="120px" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Key Manager Id: </td>
				<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">'. $admin_id .'</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td width="40px"></td>
				<td width="120px" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Email: </td>
				<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">'. $admin_email .'</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td width="40px"></td>
				<td width="120px" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Phone No.: </td>
				<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">'. $admin_phone .'</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
					Please Register And Login To Your Admin Panel By Changing Your Password In the Given Below Link.
				</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
					<a href="'.site_url().'ctt-admin" target="_blank">'.site_url().'ctt-admin</a>
				</td>
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
	function VendorRegistrationSuccessfulPayment($vender_name,$vender_email,$vender_phone)
	{
		$this->user = new User();
		$IPN_Data = $this->Read_IPN_Data();
		$User_Mail_Content = '<table width="700px" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Hi '.$vender_name.',</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
					You have successfully registered as a Vender.
				</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
					Your Details are as follows:
				</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
					I hope you’re doing well! I’m reaching out to remind you that payment $150.00. You can pay using this secure payment link: <a target="_blank" href="'.site_url().'ctt-admin/vendorpayment/'.$vender_email.'">Pay Now</a>
				</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td width="40px"></td>
				<td width="120px" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Email: </td>
				<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">'. $vender_email .'</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td width="40px"></td>
				<td width="120px" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Phone No.: </td>
				<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">'. $vender_phone .'</td>
			</tr>
			<tr height="15px"><td colspan="3"></td></tr>
			<tr>
				<td colspan="3" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">Thanks, <br />'. $IPN_Data['project_team'] .'</td>
			</tr>
		</table>';
		$to = $vender_email;
		$subject = 'Vender Registration Successful - '.$IPN_Data['project_team'];;
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
}
?>