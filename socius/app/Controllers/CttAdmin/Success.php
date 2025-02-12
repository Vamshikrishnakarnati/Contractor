<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Success extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->session->sess_expiration = '86400';
		$this->load->model('admin');
		$this->load->model('adminmail');
		$this->load->helper('url');
		$this->load->library('email');
	}
	//Function For Home
	public function paymentsuccess()
	{
		$admininfo = $this->session->admindata('adminId');
		$OrderID = $this->uri->segment(2);
		if($admininfo)
		{
			$data['QsOrderDetails'] = $this->admin->retrive_all_cond_data('*',tbl_order_details, 'order_id = "'.$OrderID.'"', '','');
			$QsOrder = $this->admin->getRecordByField(tbl_order, 'order_id',$OrderID);
			
			$data['ProfileDtls'] = $this->admin->getRecordByField(tbl_shipping_address, 'id',$QsOrder->order_address);
			
			//Load Page
			$this->load->view('sk-admin/dashboard/head');
			$this->load->view('sk-admin/usr-success/usr-success',$data);
			$this->load->view('sk-admin/dashboard/footer');
		}
		else
		{
			redirect('Login', 'location');
		}
	}
	//Function For Home
	public function paymentfailure()
	{
		$OrderID = $this->uri->segment(3);
		$data['QsOrderDetails'] = $this->admin->retrive_all_cond_data('*',tbl_order_details, 'order_id = "'.$OrderID.'"', '','');
		$QsOrder = $this->admin->getRecordByField(tbl_order, 'order_id',$OrderID);
		$data['ProfileDtls'] = $this->admin->getRecordByField(tbl_shipping_address, 'id',$QsOrder->order_address);
		
		//Load Page
		$this->load->view('sk-admin/dashboard/head');
		$this->load->view('sk-admin/usr-success/usr-payment-failure',$data);
		$this->load->view('sk-admin/dashboard/footer');
	}
	//Function For Home
	public function PayPalIPN()
	{
		//paypal return transaction details array
        $paypalInfo    = $this->input->post();
		
        $order_id = $paypalInfo['order_id'];
        $txn_id    = $paypalInfo["txn_id"];
        $payment_gross = $paypalInfo["amount"];
        $currency_code = $paypalInfo["mc_currency"];
        $payer_email = $paypalInfo["payer_email"];
        $payment_status    = $paypalInfo["payment_status"];
		
		$form_transactions = array(
		'order_id' => $order_id,
		'txn_id' => $txn_id,
		'payment_gross' => $payment_gross,
		'currency_code' => $currency_code,
		'payer_email' => $payer_email,
		'payment_status' => $payment_status
		);
		
        $paypalURL = $this->paypal_lib->paypal_url;        
        $result    = $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
        //check whether the payment is verified
        if(preg_match("/VERIFIED/i",$result)){
           // $this->admin->storeTransaction($data);
			$this->admin->form_insert(tbl_transactions,$form_transactions);
        }
	}
	//Function For Home
	public function PayPalSuccess()
	{
		$admininfo = $this->session->admindata('adminId');
		$OrderID = $this->uri->segment(3);
		if($admininfo)
		{
			$QsOrder = $this->admin->getRecordByField(tbl_order, 'order_id' ,$OrderID);
			$order_id = $QsOrder->id;
			$sweet_cash_spend = $this->session->admindata('sweet_cash_spend');
			$PrevSweetCash = $_COOKIE['PrevSweetCash'];
			$total_price = $_COOKIE['total_price'];
			
			$QsOrderDetails = $this->admin->retrive_all_cond_data('*',tbl_order_details, 'order_id = "'.$OrderID.'"', '','');
			foreach($QsOrderDetails as $RsOrderDetails)
			{
				$ProductSizeID = $RsOrderDetails->product_size;
				$RsProductSize = $this->admin->getRecordByField(tbl_product_size, 'id',$ProductSizeID);
				$ProductQuantity = $RsProductSize->quantity;
				$UpdateQty = $ProductQuantity - $RsOrderDetails->prod_qty;
				$form_update_prod_qty = array(
				'quantity' => $UpdateQty
				);
				$this->admin->form_update(tbl_product_size,$form_update_prod_qty,'id',$ProductSizeID);
			}
			if($sweet_cash_spend == 1)
			{
				$QsProfileCash = $this->admin->getRecordByField(tbl_register, 'id' ,$admininfo);
				$adminSweetCash = $QsProfileCash->sweet_cash;
				$RemSweetCash = $adminSweetCash - $SweetCashUsed;
				$form_sweet_cash_used = array(
				'sweet_cash' => 0,
				);
				$this->admin->form_update(tbl_register,$form_sweet_cash_used,'id',$admininfo);
				
				$form_sweetcash_transactions = array(
				'admin_id' => $admininfo,
				'order_id' => $order_id,
				'sweetcash_spend' => $adminSweetCash,
				'transaction_date' => date('Y-m-d')
				);
				$this->admin->form_insert(tbl_sweetcash_transactions,$form_sweetcash_transactions);
				$total_price = $total_price - $adminSweetCash;
			}
			$this->session->set_admindata('sweet_cash_spend','');
			
			$QsProfile = $this->admin->getRecordByField(tbl_register, 'id' ,$admininfo);
			$PrevSweetCash = $QsProfile->sweet_cash;
			$SweetCashEarned = 1 / 100 * $total_price;
			$TotalSweetCash = $PrevSweetCash + $SweetCashEarned;
			$form_sweet_cash = array(
			'sweet_cash' => $TotalSweetCash,
			);
			$this->admin->form_update(tbl_register,$form_sweet_cash,'id',$admininfo);
			
			$form_sweetcash_transactions = array(
			'admin_id' => $admininfo,
			'order_id' => $order_id,
			'sweetcash_earned' => $SweetCashEarned,
			'transaction_date' => date('Y-m-d')
			);
			$this->admin->form_insert(tbl_sweetcash_transactions,$form_sweetcash_transactions);
			
			$this->adminmail->SuccessOrderMail($OrderID,$admininfo);
			$OrderSuccessMessage = "Thank you for shopping with us! <br> Your Order ID is : '".$OrderID."'";
			$ShippingDetails = $this->admin->getRecordByField(tbl_shipping_address, 'customer_id',$admininfo);
			$CountryID = $ShippingDetails->country;
			$Phone = $ShippingDetails->phone;
			
			$Country = $this->admin->getRecordByField(tbl_country, 'id',$CountryID);
			$PhoneCode = '+'.$Country->phonecode;
			$CountryPhone = $PhoneCode.$Phone;
			$this->admin->ClickSendMessage($OrderSuccessMessage,$CountryPhone);
			
			redirect('Success/'.$OrderID, 'location');
		}
		else
		{
			redirect('Login', 'location');
		}
	}
}