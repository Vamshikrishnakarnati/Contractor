			
			</div>
			<!-- end app-wrap -->
		<!-- begin footer -->
		<footer class="footer">
			<div class="row">
				<div class="col-12 col-sm-6 text-center text-sm-left">
				   <p>&copy; <?=$Copyright;?> <script>document.write(new Date().getFullYear());</script>. <?=$AllRights;?></p>
				</div>
			   <div class="col  col-sm-6 ml-sm-auto text-center text-sm-right">
					<p><a target="_blank" href="https://www.converthink.com/"><img src="<?=site_url();?>public/assets/admin/img/ct-small-logo.png" title="<?=$CompanyName;?>"></a></p>
				</div>
			</div>
		</footer>
		<!-- end footer -->
    </div>
    <!-- custom app -->
    <script src="<?=site_url();?>public/assets/admin/js/app.js"></script>
	
	<script src="<?=site_url();?>public/assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="<?=site_url();?>public/assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	<script src="<?=site_url();?>public/assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
	<script src="<?=site_url();?>public/assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
	<script src="<?=site_url();?>public/assets/admin/plugins/jszip/jszip.min.js"></script>
	<script src="<?=site_url();?>public/assets/admin/plugins/pdfmake/pdfmake.min.js"></script>
	<script src="<?=site_url();?>public/assets/admin/plugins/pdfmake/vfs_fonts.js"></script>
	<script src="<?=site_url();?>public/assets/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
	<script src="<?=site_url();?>public/assets/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
	<script src="<?=site_url();?>public/assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
	<!-- daterangepicker -->
<script src="<?=site_url();?>public/assets/admin/plugins/moment/moment.min.js"></script>
<script src="<?=site_url();?>public/assets/admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?=site_url();?>public/assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- end app -->
    <!-- plugins -->
	<?php
$session = \Config\Services::session($config);
$lsuccess = $session->getFlashdata('success_msg');
if(isset($lsuccess) && !empty($lsuccess)){
?>
	<script type="text/javascript">
		$(window).on('load',function()
		{
			//$('#successmodal').modal('show');
			Command: toastr["success"]("<?php echo $lsuccess;?>")
			toastr.options = {
			  "closeButton": true,
			  "debug": false,
			  "newestOnTop": false,
			  "progressBar": true,
			  "positionClass": "toast-top-right",
			  "preventDuplicates": false,
			  "onclick": null,
			  "showDuration": 300,
			  "hideDuration": 1000,
			  "timeOut": 5000,
			  "extendedTimeOut": 1000,
			  "showEasing": "swing",
			  "hideEasing": "linear",
			  "showMethod": "fadeIn",
			  "hideMethod": "fadeOut"
			}
		});
	</script>
	<?php
	}
	?>
	<?php
	$error_msg = $session->getFlashdata('error_msg');
	if(isset($error_msg) && !empty($error_msg)){
	?>
		<script type="text/javascript">
			$(window).on('load',function()
			{
				Command: toastr["error"]("<?php echo $error_msg;?>")
				toastr.options = {
				  "closeButton": true,
				  "debug": false,
				  "newestOnTop": false,
				  "progressBar": true,
				  "positionClass": "toast-top-right",
				  "preventDuplicates": false,
				  "onclick": null,
				  "showDuration": 300,
				  "hideDuration": 1000,
				  "timeOut": 5000,
				  "extendedTimeOut": 1000,
				  "showEasing": "swing",
				  "hideEasing": "linear",
				  "showMethod": "fadeIn",
				  "hideMethod": "fadeOut"
				}
			});
		</script>
	<?php
	}
	?>
<script type="text/javascript">
(window, document, window.jQuery);
(function(window, document, $, undefined){

    $(function(){
        var magnific = jQuery(".magnific-wrapper");
        if (magnific.length > 0) {
                $('.view').magnificPopup({
                    type: 'image'
                    // other options
                });
                $(document).ready(function() {
                    $('.view2').magnificPopup({
                        disableOn: 700,
                        type: 'iframe',
                        mainClass: 'mfp-fade',
                        removalDelay: 160,
                        preloader: false,
                        fixedContentPos: false
                    });
                });
                $('.view1').magnificPopup({
                    type: 'image',
                    gallery: {
                        enabled: true
                    },
                });
        }
    });
})
</script>
<script type="text/javascript">
function numbersonly(e)
{
	var unicode=e.charCode? e.charCode : e.keyCode
	if (unicode!=8){ //if the key isn't the backspace key (which we should allow)
	if ((unicode<46 || unicode>57) && unicode!=9 && unicode!=47) //if not a number
	return false //disable key press
	}
}


		
function numberdecimal(e)
{
	 var unicode=e.charCode? e.charCode : e.keyCode 
	 if (unicode!=8)
	 { //if the key isn't the backspace key (which we should allow)
	  if ((unicode<48 || unicode>57) && unicode!=9 && unicode!=46)  //if not a number  
	  return false //disable key press    
	 }
}

</script>

<script>
$(function () {
	var today = new Date();
	
	//Date range picker
	$('.turn_over_year_one').datetimepicker({
		format: "YYYY",
		pickTime: false,
	});
	$('.turn_over_year_two').datetimepicker({
		format: "YYYY",
		pickTime: false,
	});
	$('.turn_over_year_three').datetimepicker({
		format: "YYYY",
		pickTime: false,
	});
	
});
// function searchdata(search_word)
// {
	// alert(search_word);
	// alert(site_url);
	// $.ajax({ 
		// url: site_url+'ctt-admin/industry-listing,
		// type: "POST",
		// cache: false,
		// data:'industry_name='+search_word,
		// async: false,
		// success: function(data) { 
			// alert(data);
		// }
	// });
//}
</script>
</body>
</html>