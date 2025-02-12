<?php namespace App\Controllers\CttAdmin;

use App\Models\Admin;
use App\Models\Adminvariable;
use CodeIgniter\Controller;

class VendorPayment extends Controller
{
	public function __construct()
	{
		$this->admin = new Admin();
		$this->adminvars = new Adminvariable();
		$this->uri = new \CodeIgniter\HTTP\URI(current_url()); 
	}
		
	public function vendorpayment()
    {
		$session = \Config\Services::session();
		$adminId = $session->get('adminId');
		$segmentRemove = array_filter($this->request->uri->getSegments());
		$segment = array_values($segmentRemove);
		
		
		$data = $this->adminvars->variables(); //Admin Variable Load
		$data['vendor_email'] = $segment[2];
		$data['payable'] = '1.00';
		$data['order_id'] = $this->admin->getNUID(2).'-Vendor';
		$data['RsVendor'] = $this->admin->getDataById(tbl_vendor, 'email', $segment[2]);
		//print_r($data['RsVendor']);exit;
		echo view('ctt-admin/adm-vendor-payment/adm-vendor-payment', $data);
		
    }	
	// callback method
    public function callback() {   
        //print_r($_POST);exit;
        if(!empty($_POST['razorpay_payment_id']) && !empty($_POST['merchant_order_id'])) {
            $razorpay_payment_id = $_POST['razorpay_payment_id'];
            $merchant_order_id = $_POST['merchant_order_id'];
            $merchant_trans_id = $_POST['merchant_trans_id'];
            
			$data = $this->adminvars->variables(); //Admin Variable Load
			$session = \Config\Services::session();
			$session->set('urazorpay_payment_id', $razorpay_payment_id);
			$session->set('umerchant_order_id', $merchant_order_id);
			$session->set('umerchant_trans_id', $merchant_trans_id);
			$session->set('merchant_total', $_POST['merchant_total']);
            $currency_code = 'INR';
            $amount = $_POST['merchant_total'];
            $success = false;
            $error = '';
            try {                
                $ch = $this->curl_handler($razorpay_payment_id, $amount);
                //execute post
                $result = curl_exec($ch);
                $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if ($result === false) {
                    $success = false;
                    $error = 'Curl error: '.curl_error($ch);
                } else {
                    $response_array = json_decode($result, true);
                        //Check success response
                        if ($http_status === 200 and isset($response_array['error']) === false) {
                            $success = true;
                        } else {
                            $success = false;
                            if (!empty($response_array['error']['code'])) {
                                $error = $response_array['error']['code'].':'.$response_array['error']['description'];
                            } else {
                                $error = 'RAZORPAY_ERROR:Invalid Response <br/>'.$result;
                            }
                        }
                }
                //close curl connection
                curl_close($ch);
            } catch (Exception $e) {
                $success = false;
                $error = 'Request to Razorpay Failed';
            }
            
            if ($success === true) {
                if(!empty($session->get('ci_subscription_keys'))) {
                    $session->remove('ci_subscription_keys');
                }
                if (!$order_info['order_status_id']) {
					return redirect()->to($_POST['merchant_surl_id']);
                } else {
					return redirect()->to($_POST['merchant_surl_id']);
                }

            } else {
				return redirect()->to($_POST['merchant_furl_id']);
            }
        } else {
            echo 'An error occured. Contact site administrator, please!';
        }
    }
	public function success()
	{
		$data = $this->adminvars->variables(); //Load User Variables
		$session = \Config\Services::session();
		$userId = $session->get('userId');
		
			/* $order_id =$session->get('Get_Order_id');
			//$order_id = 'Pk-517280';
			$userId = $session->get('userId');
			$order = $this->user->retrive_all_cond_data('*',tbl_billpayment,'is_active = 1 AND is_delete = 0 AND order_id="'.$order_id.'"', 'id','ASC');
			
			$Transaction = $this->user->retrive_all_cond_data('*',tbl_payment_transaction,'is_active = 1 AND is_delete = 0 AND order_id="'.$order_id.'"', 'id','ASC');
			
			if($order[0]->planCode)
			{
				//echo 'aaaaaaaa';exit;
				 $getdetails =$this->Getplandetails($order[0]->operator_code,$order[0]->circle_code,$order[0]->planCode,$order[0]->category_id,$order[0]->customer_no,$order[0]->order_id);
				 $getdetails['recharge_time'] = $order[0]->created_date;
				 $getdetails['transaction_id'] = $Transaction[0]->transaction_id;
				 $getdetails['category_id'] = $order[0]->category_id;
				 $data['getdetails'] =$getdetails;
			}
			else
			{
				//echo 'bbbbbbbb';exit;
				$str = array();
				if($PlanResult->talktime > 0)
				{
					$str['talktime'] =0;
				}
				else
				{
					$str['talktime'] =0;
				}
				$str['dataBenefit'] ='';
				$str['validity'] ='';
				$str['planDescription'] ='';
				$str['amount'] =$order[0]->amount;
				$str['planName'] ='';
				$Operator = $this->user->retrive_all_cond_data("*",tbl_operator,"is_active = 1 AND is_delete = 0 AND operator_code='".$order[0]->operator_code."'", "operator_name","ASC");
				$Circle = $this->user->retrive_all_cond_data('*',tbl_circle,'is_active = 1 AND is_delete = 0 AND circle_code = "'.$order[0]->circle_code.'"', 'circle_name','ASC');
				$Category = $this->user->retrive_all_cond_data('*',tbl_category,'is_active = 1 AND is_delete = 0 AND id = "'.$order[0]->category_id.'"', 'category_name','ASC');
				$str['operator'] =$Operator[0]->operator_name;
				$str['circle'] =$Circle[0]->circle_name;
				$str['category'] =$Category[0]->category_name;
				$str['customer_no'] =$order[0]->customer_no;
				$str['order_id'] =$order[0]->order_id;
				$str['recharge_time'] = $order[0]->created_date;
				$str['category_id'] = $order[0]->category_id;
				$str['transaction_id'] = $Transaction[0]->transaction_id;
				$data['getdetails'] =$str;
			}
			
			echo view('pk-user/dashboard/head', $data);
			echo view('pk-user/usr-recharge/success', $data);
			echo view('pk-user/dashboard/footer', $data); */
		
		echo view('ctt-admin/adm-vendor-payment/adm-payment-success', $data);
	}
	public function failure()
	{
		$data = $this->adminvars->variables(); //Load User Variables
		$session = \Config\Services::session();
		$userId = $session->get('userId');
		
			/* $order_id =$session->get('Get_Order_id');
			//$order_id = 'Pk-517280';
			$userId = $session->get('userId');
			$order = $this->user->retrive_all_cond_data('*',tbl_billpayment,'is_active = 1 AND is_delete = 0 AND order_id="'.$order_id.'"', 'id','ASC');
			
			$Transaction = $this->user->retrive_all_cond_data('*',tbl_payment_transaction,'is_active = 1 AND is_delete = 0 AND order_id="'.$order_id.'"', 'id','ASC');
			
			if($order[0]->planCode)
			{
				//echo 'aaaaaaaa';exit;
				 $getdetails =$this->Getplandetails($order[0]->operator_code,$order[0]->circle_code,$order[0]->planCode,$order[0]->category_id,$order[0]->customer_no,$order[0]->order_id);
				 $getdetails['recharge_time'] = $order[0]->created_date;
				 $getdetails['transaction_id'] = $Transaction[0]->transaction_id;
				 $getdetails['category_id'] = $order[0]->category_id;
				 $data['getdetails'] =$getdetails;
			}
			else
			{
				//echo 'bbbbbbbb';exit;
				$str = array();
				if($PlanResult->talktime > 0)
				{
					$str['talktime'] =0;
				}
				else
				{
					$str['talktime'] =0;
				}
				$str['dataBenefit'] ='';
				$str['validity'] ='';
				$str['planDescription'] ='';
				$str['amount'] =$order[0]->amount;
				$str['planName'] ='';
				$Operator = $this->user->retrive_all_cond_data("*",tbl_operator,"is_active = 1 AND is_delete = 0 AND operator_code='".$order[0]->operator_code."'", "operator_name","ASC");
				$Circle = $this->user->retrive_all_cond_data('*',tbl_circle,'is_active = 1 AND is_delete = 0 AND circle_code = "'.$order[0]->circle_code.'"', 'circle_name','ASC');
				$Category = $this->user->retrive_all_cond_data('*',tbl_category,'is_active = 1 AND is_delete = 0 AND id = "'.$order[0]->category_id.'"', 'category_name','ASC');
				$str['operator'] =$Operator[0]->operator_name;
				$str['circle'] =$Circle[0]->circle_name;
				$str['category'] =$Category[0]->category_name;
				$str['customer_no'] =$order[0]->customer_no;
				$str['order_id'] =$order[0]->order_id;
				$str['recharge_time'] = $order[0]->created_date;
				$str['category_id'] = $order[0]->category_id;
				$str['transaction_id'] = $Transaction[0]->transaction_id;
				$data['getdetails'] =$str;
			}
			echo view('pk-user/dashboard/head', $data);
			echo view('pk-user/usr-recharge/failure', $data);
			echo view('pk-user/dashboard/footer', $data); */
			
		echo view('ctt-admin/adm-vendor-payment/adm-payment-failure', $data);
		
	}
}