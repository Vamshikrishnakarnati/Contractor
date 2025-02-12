<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$ProjectName;?> | Vendor Payment </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="Admin template that can be used to build dashboards for CRM, CMS, etc." />
    <meta name="author" content="Potenza Global Solutions" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="<?=site_url();?>public/assets/admin/img/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=site_url();?>public/assets/admin/css/vendors.css" />
    <link rel="stylesheet" type="text/css" href="<?=site_url();?>public/assets/admin/css/style.css" />
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" />
	
</head>

<body class="bg-white">
    <div class="app">
        <div class="app-wrap">
            <div class="loader">
                <div class="h-100 d-flex justify-content-center">
                    <div class="align-self-center">
                        <img src="<?=site_url();?>public/assets/admin/img/loader/loader.svg" alt="loader">
                    </div>
                </div>
            </div>
			
            <div class="app-contant">
                <div class="bg-white">
                    <div class="container py-5">
						<!-- For demo purpose -->
						<div class="row mb-4">
							<div class="col-lg-8 mx-auto text-center">
								<h1 class="display-6">Vendor Payment</h1>
							</div>
						</div> <!-- End -->
						<div class="row">
							<div class="col-lg-6 mx-auto">
								<div class="card ">
									<div class="card-header">
										<div class="text-center">
											<div id="paypal" class="tab-pane pt-3">
												<h6 class="pb-2">To login a Vender in contracktor please play now</h6>
												
												<?php
												$description        = "Vendor Registration";
												$txnid              = date("YmdHis");     
												$key_id             = RozorPayApiKey;
												$currency_code      = 'INR';            
												$total              = ($payable* 100); // 100 = 1 indian rupees
												$amount             = $payable;
												$merchant_order_id  = $order_id;
												$card_holder_name   = $RsVendor->single_contact_name;
												$email              = $vendor_email;
												$phone              = $RsVendor->phone_mobile;
												$name               = $RsVendor->single_contact_name;
												?>
												<form name="razorpay-form" id="razorpay-form" action="<?php echo $callback_url; ?>" method="POST">
													<input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
													<input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
													<input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
													<input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $description; ?>"/>
													<input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
													<input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
													<input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?php echo $card_holder_name; ?>"/>
													<input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $total; ?>"/>
													<input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amount; ?>"/>
												</form>
												<button class="btn btn-primary"  id="pay-btn" type="submit" onclick="razorpaySubmit(this);" > Make Payment</button>
												<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
												<script>
													var options = {
														key:            "<?php echo $key_id; ?>",
														amount:         "<?php echo $total; ?>",
														name:           "Phonekwik",
														description:    "Order # <?php echo $merchant_order_id; ?>",
														netbanking:     true,
														currency:       "<?php echo $currency_code; ?>", // INR
														prefill: {
															name:       "<?php echo $card_holder_name; ?>",
															email:      "<?php echo $email; ?>",
															contact:    "<?php echo $phone; ?>"
														},
														notes: {
															soolegal_order_id: "<?php echo $merchant_order_id; ?>",
														},
														handler: function (transaction) {
															document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
															document.getElementById('razorpay-form').submit();
														},
														"modal": {
															"ondismiss": function(){
																location.reload()
															}
														}
													};

													var razorpay_pay_btn, instance;
													function razorpaySubmit(el) {
														if(typeof Razorpay == 'undefined') {
															setTimeout(razorpaySubmit, 200);
															if(!razorpay_pay_btn && el) {
																razorpay_pay_btn    = el;
																el.disabled         = true;
																el.value            = 'Please wait...';  
															}
														} else {
															if(!instance) {
																instance = new Razorpay(options);
																if(razorpay_pay_btn) {
																razorpay_pay_btn.disabled   = false;
																razorpay_pay_btn.value      = "Pay Now";
																}
															}
															instance.open();
														}
													}  
												</script>
												<!--<p class="text-muted"> Note: After clicking on the button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website to view details of your order. </p>-->
											</div> 
										</div> 
									</div>
								</div>
							</div>
						</div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?=site_url();?>public/assets/admin/js/vendors.js"></script>
    <script src="<?=site_url();?>public/assets/admin/js/app.js"></script>
	<script type="text/javascript">
	$(document).ready(function () {
	  $('#loginForm').validate({
		rules: {
		  email: {
			required: true,
		  },
		  password: {
			required: true,
			minlength: 6
		  },
		},
		messages: {
		  email: {
			required: "Please enter user id or email"
		  },
		  password: {
			required: "Please provide a password",
			minlength: "Your password must be at least 6 characters long"
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
	});
	</script>
	</body>
</html>