function getXMLHTTP(){var xmlhttp=false;try{xmlhttp=new XMLHttpRequest();}
catch(e){try{xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
catch(e){try{xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");}
catch(e1){xmlhttp=false;}}}
return xmlhttp;}
//Function for not allowed white space in input fields
$(function()
{
    $('form').find('input').each(function()
	{
        if($(this).prop('required'))
		{
            $(this).attr(
			{
                'pattern': '.*\\S+.*'
            });
        }
    });
});
//Functio for trim all input fields and text area before and after
$('.needs-validation').on('submit', function() {
    $('input').val(function(_, value) {
		return $.trim(value);
	});

    $('textarea').each(function(){
            $(this).val($(this).val().trim());
        }
    );
});
function numbersonly(e)
{
	var unicode=e.charCode? e.charCode : e.keyCode
	if (unicode!=8){ //if the key isn't the backspace key (which we should allow)
		if ((unicode<46 || unicode>57) && unicode!=9 && unicode!=47) //if not a number  
		return false //disable key press    
	}
}

function phoneValidationUS(e)
{
	//event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57)
	var unicode=e.charCode? e.charCode : e.keyCode
	if (unicode!=8){ //if the key isn't the backspace key (which we should allow)
		if ((unicode<46 || unicode>57) && unicode!=9 && unicode!=47 && unicode!=40 && unicode!=41 && unicode!=32 && unicode!=43 && unicode!=45) //if not a number  
		return false //disable key press    
	}
}
function lettersOnly() 
{
	var charCode = event.keyCode;

	if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 8)

		return true;
	else
		return false;
}// Function for Get Operatorfunction showoperator(operator_id,replace_id,hide_id,checkval){	if(checkval == 1)	{		$("#"+hide_id).css('display','block');		$('#amount').attr('readonly', true);	}	else	{		$("#"+hide_id).css('display','none');		$("#planCode").val('');		$('#amount').attr('readonly', false);	}	var base_url = $("#base_url").val();	$.ajax(	 { 		  url: base_url+"get-operator",		  type: "POST",		  cache: false,		  data:'operator_id='+operator_id,		  async: false,		  success: function(data) 		  {			$("#"+replace_id).html(data);		  } 	 });  }// Function for Set Amountfunction setAmount(amount,planCode){	$("#amount").val(amount);	$("#planCode").val(planCode);	$('#view-plans').modal('hide');}function validateForm() {  var operator_id = $("#operator_id").val();  var circle_id = $("#circle_id").val();  var amount = $("#amount").val();  var mobileNumber = $("#mobileNumber").val();  var login_userid = $("#login_userid").val();  var err =0;  if(mobileNumber =='')  {	err = err+1;	$('#mobileNumber').css('border-color', 'red');  }  else  {	$('#mobileNumber').css('border-color', 'green');  }  if(operator_id =='')  {	err = err+1;	$('#operator_id').css('border-color', 'red');  }  else  {	$('#operator_id').css('border-color', 'green');  }  if(circle_id =='')  {	err = err+1;	$('#circle_id').css('border-color', 'red');  }  else  {	$('#circle_id').css('border-color', 'green');  }  if(amount =='')  {	err = err+1;	$('#amount').css('border-color', 'red');  }  else  {	$('#amount').css('border-color', 'green');  }  if(err > 0)  {	return false;  }  else  {		if(login_userid == '')		{			$('#login-modal').modal('show'); 			return false;		}  }}// Function for Get Planfunction Getplan(str){	var base_url = $("#base_url").val();	if(str == 0)	{	var operator_id = $("#operator_id").val();	var circle_id = $("#circle_id").val();	$("#operator_hide").val(operator_id);	$("#circle_hide").val(circle_id);	}	else	{	var operator_id = $("#operator_hide").val();	var circle_id = $("#circle_hide").val();	$("#operator_id").val(operator_id);	$("#circle_id").val(circle_id);	}	$.ajax(	 { 		  url: base_url+"get-plan",		  type: "POST",		  cache: false,		  data:'operator_id='+operator_id+'&circle_id='+circle_id,		  async: false,		  success: function(data) 		  {			$("#plan_details").html(data);		  } 	 });  }