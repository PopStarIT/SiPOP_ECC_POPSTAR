<script type="text/javascript">
	
	var button_click = 0;
	var jvalidate = $("#form_users_login").validate({
		ignore: [],
		rules: {                                            
			username: {
				required: true,
				alphanumeric: true
			},
			password: {
				required: true
			}
		}
	});
	
	var check_submit = 0;
	function post_user_login(){
		if(check_submit == 0) {
			check_submit = 1
			page_loading("show",'Loading','Please Wait...');
			var data = $("#form_users_login").serialize();
		//	alert (data);
		//	alert (baseurl+'users/login');
			$.ajax({
				url: baseurl+'users/login',
				data: data,
				dataType: 'json',
				method: 'post',
				success: function(data){
					//alert (data.valid);
					check_submit = 0;
					if(data.valid){
						window.location.href = "<?php echo base_url() ?>";
					} else {
						page_loading("hide");
						show_error("show",'Error',data.message);
					}
				},
				error: function(xhr,error){
					//alert (xhr.status.toString());
					show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again');
					check_submit = 0;
				}
			});
		}
	}
	
	// $('#panel_users_login').show();
	
	// <?php 
		// if(isset($confirmation)){
			// if($confirmation){
	// ?>
				// show_success("show",'Email Successfully Confirmed','Thank you for confirming your email address, your registration is now complete');
	// <?php
			// }
		// }
	// ?>
	// <?php 
		// if(isset($confirmation_2)){
			// if($confirmation_2){
	// ?>
				// show_success("show",'Password Successfully Reset','Your password has been reset');
	// <?php
			// }
		// }
	// ?>
	
	// function show_confirmation(action,message,message2){
		// action = typeof action !== 'undefined' ? action : 'show';
		// message = typeof message !== 'undefined' ? message : 'Error';
		// message2= typeof message2 !== 'undefined' ? message2 : '500 Internal Server Error';
		
		// if(action == 'show'){
			// swal({
				// type: 'info',
				// title: message,
				// html: message2,
				// backdrop: true,
				// allowOutsideClick : false,
				// showCancelButton: true,
				// confirmButtonText: 'Resend Email',
				// cancelButtonText: 'Close',
				// reverseButtons: true
			// }).then((result) => {
				  // if (result.value) {
					// page_loading("show");
					// var data = {'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'};
					// $.ajax({
						// url: baseurl+'users/register_confirmation_resend',
						// data: data,
						// dataType: 'json',
						// method: 'post',
						// success: function(data){
							// page_loading("hide");
							// check_submit = 0;
							// if(data.valid){
								// show_success("show",'Confirmation Email Sent',data.message,'redirect');
							// } else {
								// show_error("show",'Error',data.message);
							// }
						// },
						// error: function(xhr,error){
							// show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again');
							// check_submit = 0;
						// }
					// });
				  // } else if (
					// // Read more about handling dismissals
					// result.dismiss === swal.DismissReason.cancel
				  // ) {
					// swal.closeModal();	
				  // }
			// });
		// } else {
			// swal.closeModal();	
		// }	
	// }
	
	
	
	// var jvalidate2 = $("#form_users_authentication").validate({
		// ignore: [],
		// rules: {                                            
			// authentication_code: {
				// required: true
			// }
		// }
	// });
	
	
	
	// function post_user_authentication(){
		// if(check_submit == 0) {
			// check_submit = 1
			// // page_loading("show",'Loading','Please Wait...');
			// var data = $("#form_users_authentication").serialize();
			// $.ajax({
				// url: baseurl+'users/login_verify',
				// data: data,
				// dataType: 'json',
				// method: 'post',
				// success: function(data){
					// page_loading("hide");
					// check_submit = 0;
					// if(data.valid){
						// swal({
							// type: 'success',
							// title: 'Login Successfull',
							// text: 'Please Wait...',
							// backdrop: true,
							// allowOutsideClick : false,
							// onOpen: () => {
								// if (mhw) {
									// if(mhw.auth){	
										// auth = JSON.parse(mhw.auth);
										// loginStatus = true;
										// data_auth = data.auth;
										// auth.loginStatus = loginStatus;
										// auth.data_auth = data_auth;
										// mhw.auth = JSON.stringify(auth);
										// mhw.device_id = data.device_id;
										// localStorage.mhw = JSON.stringify(mhw);
									// }
								// }
								
								// swal.showLoading();
								// window.location.href = "<?php echo base_url() ?>/users";
							  // }
						// });
					// } else {
						// show_error("show",'Error',data.message);
					// }
				// },
				// error: function(xhr,error){
					// show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again');
					// check_submit = 0;
				// }
			// });
		// }
	// }
	
	
</script>