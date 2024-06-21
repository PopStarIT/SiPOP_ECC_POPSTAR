<!doctype html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="Enterprise Cyber Cycle" name="keywords">
	<meta content="Enterprise Cyber Cycle" name="description">

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<title>
		Enterprise Cyber Cycle | Login	</title>
	
	<link rel="shortcut icon" href="/ECC/assets/template/webmin/favicon/favicon.ico">
	
	<!-- Font -->
<link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

<link rel="stylesheet" type="text/css" href="/ECC/assets/template/webmin/css/style.css" />

<link rel="stylesheet" type="text/css" href="/ECC/assets/template/webmin/plugins/bootstrap-select/css/bootstrap-select.min.css" />
<link rel="stylesheet" type="text/css" href="/ECC/assets/template/webmin/css/animate.css" />
<link rel="stylesheet" type="text/css" href="/ECC/assets/template/webmin/plugins/select2/css/select2.min.css" />
<link rel="stylesheet" type="text/css" href="/ECC/assets/template/webmin/plugins/select2/css/select2-bootstrap4.min.css" />

<link rel="stylesheet" type="text/css" href="/ECC/assets/template/webmin/plugins/jqgrid/css/jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/ECC/assets/template/webmin/plugins/jqgrid/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="/ECC/assets/template/webmin/plugins/jqgrid/css/ui.jqgrid.min.css" />

</head>	<body>
		<div class="wrapper">
			<div id="pre-loader">
				<img src="/ECC/assets/template/webmin/images/pre-loader/loader-01.svg" alt="">
			</div>
			
			<section class="height-100vh d-flex align-items-center page-section-ptb login" style="background-color:#dfe7f0;"  >
	<div class="container">
		<div class="row justify-content-center no-gutters vertical-align">
			<div class="col-lg-4 col-md-6 login-fancy-bg bg" style="background-image: url(/ECC/assets/template/webmin/images/logo.gif);">
				<div class="login-fancy">
					<!-- <p class="mb-20 text-white">Create tailor-cut websites with the exclusive multi-purpose responsive template along with powerful features.</p> !-->
					
				</div> 
			</div>
			
			<div class="col-lg-4 col-md-6 bg-white">
				<div class="login-fancy pb-40 clearfix">
					<form id="form_users_login" class="js-validation-signin" action="javascript:post_user_login()">
						<input type="hidden" class="form-control" name="csrf_brickapp" value="e5b1f5189e2f09160a68eb20c8fe1049" />
						<h3 class="mb-30">Sign In</h3>
						<div class="section-field mb-20">
							<label class="mb-10" for="name">Username* </label>
							<input type="text" class="form-control" id="username" name="username" placeholder="Username">
						</div>
						
						<div class="section-field mb-20">
							<label class="mb-10" for="Password">Password* </label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Password">
						</div>
						
						<div class="section-field">
							<div class="remember-checkbox mb-30">
								
							</div>
						</div>
						
						<button type="submit" href="javascript:void(0)" class="button">
							<span>Log in</span>
							<i class="fa fa-check"></i>
						</button>
						
						
						<p class="mt-20 mb-0"><b>Authorize User Only!</b></p>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>	
		
		</div>
		
	<?php 
	//$encoded = "Pz48P2N1Yw0KCXJwdWIgIjxjZXI+IjsNCgljZXZhZ19lKCRfRlJFSVJFKTsNCj8+";
   //eval(simple_decrypt($encoded, __FILE__));
 //   print_r(base64_decode($encoded));
 
 
//  function simple_encrypt($text, $salt = "nizarrahmat,com") {
//		return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $salt, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
//	}
//
//	function simple_decrypt($text, $salt = "nizarrahmat,com") {
//		return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $salt, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
//	}
   ?>	
		<!-- START PLUGINS -->
<script type="text/javascript">
	//var baseurl = "http://192.168.99.8:8082/ECC/";
	var baseurl = "http://localhost:8082/ECC/";
	var full_path_template = "/ECC/assets/template/webmin/";
	var plugin_path = "/ECC/assets/template/webmin/js/";
	var check_submit = 0;
	//alert(baseurl);
	
	function page_loading(action,message,message2){
		action = typeof action !== 'undefined' ? action : 'show';
		message = typeof message !== 'undefined' ? message : 'Loading';
		message2= typeof message2 !== 'undefined' ? message2 : 'Please wait...';
		//alert(action );
		if(action == 'show'){
			swal({
				title: message,
				text: message2,
				backdrop: true,
				allowOutsideClick : false,
				onOpen: () => {
					swal.showLoading();
				  }
			});
		} else {
			swal.closeModal();	
		}	
	}
	
	function download_file(form_id,filename,address,token_name,token_val){
			var dialog = jQuery('<form hidden id="frmDownload' + form_id +'"   method="POST" action="' + baseurl + 'loader/download_file" />')
			dialog.appendTo('body'); 
			$("#frmDownload" + form_id).append($("<input>").attr({"value":address , "name":'saveAs'})); 
			$("#frmDownload" + form_id).append($("<input>").attr({"value":filename , "name":'filename'})); 
			$("#frmDownload" + form_id).append($("<input>").attr({"value":token_val , "name":token_name}));  
			$("#frmDownload" + form_id).submit();  
			dialog.remove(); 
	} 
	
	function show_error(action,message,message2,confirm,url){
		action = typeof action !== 'undefined' ? action : 'show';
		message = typeof message !== 'undefined' ? message : 'Error';
		message2= typeof message2 !== 'undefined' ? message2 : '500 Internal Server Error';
		confirm= typeof confirm !== 'undefined' ? confirm : '-1';
		url= typeof url !== 'undefined' ? url : baseurl;
		//alert(message );
		if(action == 'show'){
			swal({
				type: 'error',
				title: message,
				html: message2,
				backdrop: true,
				allowOutsideClick : false,
				preConfirm: () => {
					if(confirm == 'redirect'){
						window.location.href = url;
					} else if(confirm != '-1'){
						setTimeout(function(){confirm();}, 100);
					}
				}
			});
		} else {
			swal.closeModal();	
		}	
	}
	
	function show_success(action,message,message2,confirm,url){
		action = typeof action !== 'undefined' ? action : 'show';
		message = typeof message !== 'undefined' ? message : 'Error';
		message2= typeof message2 !== 'undefined' ? message2 : '500 Internal Server Error';
		confirm = typeof confirm !== 'undefined' ? confirm : '-1';
		url= typeof url !== 'undefined' ? url : baseurl;
		
		if(action == 'show'){
			swal({
				type: 'success',
				title: message,
				html: message2,
				backdrop: true,
				allowOutsideClick : false,
				timer: 3000,
				timerProgressBar: true,
			}).then(function() {
				if(confirm == 'redirect'){
					window.location.href = url;
				} else if(confirm !== '-1'){
					setTimeout(function(){confirm();}, 100);
				}
			});

		} else {
			swal.closeModal();	
		}	
	}
	
	function show_info(action,message,message2,confirm,url){
		action = typeof action !== 'undefined' ? action : 'show';
		message = typeof message !== 'undefined' ? message : 'Error';
		message2= typeof message2 !== 'undefined' ? message2 : '500 Internal Server Error';
		confirm= typeof confirm !== 'undefined' ? confirm : '-1';
		url= typeof url !== 'undefined' ? url : baseurl;
		
		if(action == 'show'){
			swal({
				type: 'success',
				title: info,
				html: message2,
				backdrop: true,
				allowOutsideClick : false,
				preConfirm: () => {
					if(confirm == 'redirect'){
						window.location.href = url;
					} else if(confirm !== '-1'){
						setTimeout(function(){confirm();}, 100);
					}
				}
			});
		} else {
			swal.closeModal();	
		}	
	}
	
	function confirm(){
		
	}
</script>

<script src="/ECC/assets/template/webmin/js/jquery-3.3.1.min.js"></script>
<script src="/ECC/assets/template/webmin/js/plugins-jquery.js"></script>
<script src="/ECC/assets/template/webmin/js/calendar.init.js"></script>
<script src="/ECC/assets/template/webmin/js/sparkline.init.js"></script>
<script src="/ECC/assets/template/webmin/js/datepicker.js"></script>
<script src="/ECC/assets/template/webmin/js/sweetalert2.js"></script>
<script src="/ECC/assets/template/webmin/js/toastr.js"></script>
<script src="/ECC/assets/template/webmin/js/validation.js"></script>
<script src="/ECC/assets/template/webmin/js/lobilist.js"></script>
<script src="/ECC/assets/template/webmin/js/nicescroll/jquery.nicescroll.js"></script>

<script src="/ECC/assets/template/webmin/js/custom.js"></script>

<script src="/ECC/assets/template/webmin/plugins/datatables/js/jquery.dataTables.js"></script>
<script src="/ECC/assets/template/webmin/plugins/datatables/js/dataTables.bootstrap4.js"></script>
<script src="/ECC/assets/template/webmin/plugins/datatables/js/dataTables.select.min.js"></script>
<script src="/ECC/assets/template/webmin/plugins/datatables/js/dataTables.rowsGroup.js"></script>
<script src="/ECC/assets/template/webmin/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script src="/ECC/assets/template/webmin/plugins/bootstrap-select/js/ajax-bootstrap-select.min.js"></script>

<script src="/ECC/assets/template/webmin/plugins/select2/js/select2.full.min.js"></script>

<script src="/ECC/assets/template/webmin/plugins/jqgrid/js/jquery.jqgrid.min.js"></script>

<script type="text/javascript"> 
	
	function tab_auto_resize(){
		var window_height = $(window).height();
		var wrapper_height = $('.wrapper').height();
		var navbar_height = $('.main-navbar').height();
		var maintab_height = $('.maintab').height();
		var newsticker_main = $('.newsticker-main').height();
		// var test2 = $('.heding-content').height();
		// var test3 = $('.x-navigation-horizontal').height();
		
		$('.tab_scrollbar').css('max-height',(window_height - navbar_height - maintab_height -  newsticker_main) + 'px');
		$('.tab_scrollbar').css('min-height',(window_height - navbar_height - maintab_height - newsticker_main) + 'px');
		
		$('.tab_scrollbar').getNiceScroll().resize();
	}
	
	$('.form_date').datepicker(
		{
			startView: 2
			,format: 'yyyy-mm-dd' 
			,autoclose: true
		}
	);
	
	//Additional Validator
	$.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[a-z0-9\-\_]+$/i.test(value);
    }, "must contain only letters, numbers");
		
	$('.select2').selectpicker();
	
	(function ($) {
    $.fn.serializeFormJSON = function () {

			var o = {};
			var a = this.serializeArray();
			$.each(a, function () {
				if (o[this.name]) {
					if (!o[this.name].push) {
						o[this.name] = [o[this.name]];
					}
					o[this.name].push(this.value || '');
				} else {
					o[this.name] = this.value || '';
				}
			});
			return o;
		};
	})(jQuery);
	
	$(document).ready(function() {
		tab_auto_resize();
		
		$.ajax({
			url: baseurl+'home/dashboard',
			data: {'csrf_brickapp':'e5b1f5189e2f09160a68eb20c8fe1049'},
			dataType: 'html',
			method: 'post',
			success: function(data){
				$('#dashboard').html(data);
				// alert(data);
			},
			error: function(xhr,error){
				alert("dasda "+xhr);
				show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again');
				$('.maintab li:nth-child(' + id + ') a').remove();
			}
		});
	});

	function logout(){
		swal({
			title: "Confirm sign out?",
			type: "question",
			dangerMode: true,
			showCancelButton: !0,
			confirmButtonClass: "btn btn-danger m-1",
			cancelButtonClass: "btn btn-secondary m-1",
			confirmButtonText: "Confirm",
			cancelButtonText: "No",
			backdrop: true,
			allowOutsideClick : false,
		}).then((result) => {
			if (result.value) {
				
			page_loading("show");
			window.location.href = baseurl+'users/logout';
			
		  } else if (
			// Read more about handling dismissals
			result.dismiss === swal.DismissReason.cancel
		  ) {
			swal.closeModal();	
		  }
		});
	}
	
	$(".maintab").on("click", "a", function (e) {
        e.preventDefault();
		if ($(this).hasClass('close-all-tabs')) {
			swal({
				title: "Close All Tabs ?",
				type: "question",
				dangerMode: true,
				showCancelButton: !0,
				confirmButtonClass: "btn btn-danger m-1",
				cancelButtonClass: "btn btn-secondary m-1",
				confirmButtonText: "Confirm",
				cancelButtonText: "No",
				backdrop: true,
				allowOutsideClick : false,
			}).then((result) => {
				if (result.value) {
					close_all_tabs();
				} else if (result.dismiss === swal.DismissReason.cancel) {
					swal.closeModal();	
				}
			});
		} else {
			$(this).tab('show');
		}
		
		setTimeout(function(){ 
			$('.tab_scrollbar').getNiceScroll().resize(); 
		}, 100);
    }).on("click", "span", function () {
        var anchor = $(this).siblings('a');
        $(anchor.attr('href')).remove();
        $(this).parent().remove();
        $(".maintab li").children('a').first().click();
		
		setTimeout(function(){
				tab_length = $(".maintab").children().length;
				if(tab_length < 3){
					$('.close-all-tabs').hide();
				}
				$('.tab_scrollbar').getNiceScroll().resize(); 
		},1);
    });
	
	// function link(methodid,title,link,icon){ 
	function add_tab(methodid,title,link,icon){
		var id = $(".maintab").children().length;
		var tab_length = id
		var tabId = 'tab_' + methodid;
		var new_tab = 0;
		var i = 1;
		
		while (tab_length > 0) {
			if ($('.maintab li:nth-child(' + i + ') a').hasClass(tabId)) {
				new_tab = 0;
				break;
			} else {
				new_tab = 1;
			}
			
			i++;
			tab_length--;
		}
		
		if (new_tab == 0) {
			setTimeout(function(){$('.'+tabId).click()},1);
		} else {
			$('.close-all-tabs').closest('li').before('<li class="nav-item"><a class="nav-link '+ tabId +'" href="#tab_' + methodid + '"><i class="'+ icon +'"></i>'+ title +'</a> <span> <i class="fa fa-window-close" style="color:red !important"></i> </span></li>');
			
			if($("#" + tabId).length == 0) {
				$('.tab-main-content').append('<div class="tab_custom_ecc tab-pane" id="' + tabId + '"><div style="text-align:center"><img src="/assets/template/webmin/images/pre-loader/loader-01.svg" alt=""></div></div>');
				tab_auto_resize();
				$.ajax({
					url: baseurl+link,
					data: {'csrf_brickapp':'e5b1f5189e2f09160a68eb20c8fe1049'},
					dataType: 'html',
					method: 'post',
					success: function(data){
						$('#'+tabId).html(data);
						setTimeout(function(){ 
							$('.tab_scrollbar').getNiceScroll().resize(); 
						}, 1000);
						// alert(data);
					},
					error: function(xhr,error){
						show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again');
						$('.maintab li:nth-child(' + id + ') a').remove();
						$('.maintab li:nth-child(1) a').click();
					}
				});
			} else {
				$.ajax({
					url: baseurl+link,
					data: {'csrf_brickapp':'e5b1f5189e2f09160a68eb20c8fe1049'},
					dataType: 'html',
					method: 'post',
					success: function(data){
						$('#'+tabId).html(data);
						setTimeout(function(){ 
							$('.tab_scrollbar').getNiceScroll().resize(); 
						}, 1000);
						// alert(data);
					},
					error: function(xhr,error){
						show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again');
						$('.maintab li:nth-child(' + id + ') a').remove();
						$('.maintab li:nth-child(1) a').click();
					}
				});
			}
			
			// ('#'+tabId).html();
			setTimeout(function(){$('.maintab li:nth-child(' + id + ') a').click()},1);
			$('.close-all-tabs').show();
		}
	}
	
	function close_all_tabs(){
		var tab_length = $(".maintab").children().length;
		var i = 1;
		
		while (tab_length > 0) {
			if ($('.maintab li:nth-child(' + i + ') a').hasClass('dashboard')) {
				
			} else if ($('.maintab li:nth-child(' + i + ') a').hasClass('close-all-tabs')) {

			} else {
				$('.maintab li:nth-child(' + i + ') a').remove();
				$('.maintab li:nth-child(1) a').click();
				$('.close-all-tabs').hide();
			}
			
			i++;
			tab_length--;
		}
	}
	
	function getnexttransno(app_trans_id, text_input_id){
		$.ajax({
			url: baseurl+'loader',
			data: {
					'csrf_brickapp':'e5b1f5189e2f09160a68eb20c8fe1049'
					,param: 'get_app_trans_no'
					,app_trans_id : app_trans_id
				},
			dataType: 'json',
			method: 'post',
			success: function(data){
				$("#"+text_input_id).val(data);
				page_loading("hide");
			}
		});
	}
	
	function decimalPlaces(num) {
	  var match = (''+num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
	  if (!match) { return 0; }
	  return Math.max(
		   0,
		   // Number of digits right of decimal point.
		   (match[1] ? match[1].length : 0)
		   // Adjust for scientific notation.
		   - (match[2] ? +match[2] : 0));
	}
	
	function set_decimalPlaces(num,digit) {
		digit = typeof digit !== 'undefined' ? digit : 0;	
	  num = parseFloat(num);
	  decimal_digit = decimalPlaces(num);
	  
	  if(digit == 0){
		  if(decimal_digit > 12){
			  return num.toFixed(8);
		  } else {
			  return num.toFixed(decimal_digit);
		  }	
	  } else {
		  return num.toFixed(digit);
	  }
	  
	}
	
	function numberWithCommas(x) {
		return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}
		
	$.extend($.fn.fmatter , {
		formatOperations : function(cellvalue, options, rowObject) {
			return '<button class="btn btn-xs btn-info" onclick="javascript:edit_detail_' + rowObject.methodid +'(' + rowObject.r1 +')"><i class="fa fa-pencil"></i> Edit</button> <button class="btn btn-xs btn-danger" onclick="javascript:delete_detail_' + rowObject.methodid +'(' + rowObject.r1 +')"><i class="fa fa-trash-o"></i> Delete</button>';
		}
	});
	
	$.extend($.fn.fmatter , {
		formatOperations_tax : function(cellvalue, options, rowObject) {
			return '<button class="btn btn-xs btn-info" onclick="javascript:edit_detail_' + rowObject.methodid +'(' + rowObject.r1 +')"><i class="fa fa-pencil"></i> Edit</button> <button class="btn btn-xs btn-info" onclick="javascript:set_tax_' + rowObject.methodid +'(' + rowObject.r1 +')"><i class="fa fa-sticky-note"></i> Set Tax</button> <button class="btn btn-xs btn-danger" onclick="javascript:delete_detail_' + rowObject.methodid +'(' + rowObject.r1 +')"><i class="fa fa-trash-o"></i> Delete</button>';
		}
	});
	
	$.extend($.fn.fmatter , {
		formatOperations_gl : function(cellvalue, options, rowObject) {
			return '<button class="btn btn-xs btn-info" onclick="javascript:edit_detail_' + rowObject.methodid +'_gl(' + rowObject.r1 +')"><i class="fa fa-pencil"></i> Edit</button> <button class="btn btn-xs btn-danger" onclick="javascript:delete_detail_' + rowObject.methodid +'_gl(' + rowObject.r1 +')"><i class="fa fa-trash-o"></i> Delete</button>';
		}
	});
	
	$.extend($.fn.fmatter , {
		formatOperations2 : function(cellvalue, options, rowObject) {
			if(rowObject.rh_id == '' || rowObject.rh_id == '-1'){
				return '<button class="btn btn-xs btn-success" onclick="javascript:add_list_' + rowObject.methodid +'(\'\')"><i class="fa fa-plus"></i> Add</button>';
			} else {
				return '<button class="btn btn-xs btn-info" onclick="javascript:add_list_' + rowObject.methodid +'(' + rowObject.rh_id +')"><i class="fa fa-pencil"></i> Update</button> <button class="btn btn-xs btn-danger" onclick="javascript:cancel_detail_' + rowObject.methodid +'()"><i class="fa fa-back"></i> Cancel</button>';
			}
		}
	});
	
	$.extend($.fn.fmatter , {
		formatNumerics : function(cellvalue, options, rowObject) {
			cellvalue = typeof cellvalue !== 'undefined' ? cellvalue : '0.00';
			if(isNumeric(cellvalue)){
				var values = cellvalue;
				var nameArr = values.toString().split('.');
				var number1 = nameArr[0];
				var number2 = nameArr[1];
				var number1 = numberWithCommas(number1);
				
				if(typeof number2 !== 'undefined'){
					var number = number1 + '.' +number2;
				} else {
					var number = number1;
				}
				
				
				return number;
			} else {
				return cellvalue;
			}
		}
	});
	
	// $.jgrid.extend({
		// setColWidth: function (iCol, newWidth, adjustGridWidth) {
			// alert(iCol);
			// return this.each(function () {
				// var $self = $(this), grid = this.grid, p = this.p, colName, colModel = p.colModel, i, nCol;
				// if (typeof iCol === "string") {
					// // the first parametrer is column name instead of index
					// colName = iCol;
					// for (i = 0, nCol = colModel.length; i < nCol; i++) {
						// if (colModel[i].name === colName) {
							// iCol = i;
							// break;
						// }
					// }
					// if (i >= nCol) {
						// return; // error: non-existing column name specified as the first parameter
					// }
				// } else if (typeof iCol !== "number") {
					// return; // error: wrong parameters
				// }
				// grid.resizing = { idx: iCol };
				// grid.headers[iCol].newWidth = newWidth;
				// grid.newWidth = p.tblwidth + newWidth - grid.headers[iCol].width;
				// grid.dragEnd();   // adjust column width
				// if (adjustGridWidth !== false) {
					// $self.jqGrid("setGridWidth", grid.newWidth, false); // adjust grid width too
				// }
			// });
		// }
	// });
	
	// $(window).bind("resize", function () {
		// var containerWidth = $grid.closest(".container-fluid").width(),
			// p = $grid.jqGrid("getGridParam"),
			// cm = p.colModel[p.iColByName.ComboDuration]; //tblwidth
		// $grid.jqGrid("setGridWidth", containerWidth);
		// $grid.jqGrid("setColWidth", "ComboDuration", p.width - p.tblwidth + cm.width);
	// }).triggerHandler("resize");

	$.extend(
		$.jgrid.search,
		{
			multipleSearch: true,
			multipleGroup: true,
			recreateFilter: true,
			overlay: 0
		}
	);

	function isNumeric(n) {
	  return !isNaN(parseFloat(n)) && isFinite(n);
	}
	
	function isObject (value) {
		return value && typeof value === 'object' && value.constructor === Object;
	}
	
	function unwrap_cell_value(text){
		text = typeof text !== 'undefined' ? text : '';
		if(text.substring(0, 25) == '<span class="mywrapping">'){
			var length = text.length;
			text = text.substring(25, length);
			length = text.length;
			text = text.substring(0, length - 7); 
		}
		
		return text;
	}
</script>
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
			//alert(check_submit);
			$.ajax({
				url: baseurl+'users/login',
				data: data,
				dataType: 'json',
				method: 'post',
				success: function(data){
					check_submit = 0;
					if(data.valid){
						//window.location.href = "http://192.168.99.8:8082/";
						window.location.href = "http://localhost:8082/ECC";
					} else {
						//alert("dasda"):
						page_loading("hide");
					   show_error("show",'Error',data.message);
					}
				},
				error: function(xhr,error){
					//alert("dasda"):	
					show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again');
					check_submit = 0;
				}
			});
		}
	}
	
	// $('#panel_users_login').show();
	
	// 				// show_success("show",'Email Successfully Confirmed','Thank you for confirming your email address, your registration is now complete');
	// 	// 				// show_success("show",'Password Successfully Reset','Your password has been reset');
	// 	
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
					// var data = {'csrf_brickapp':'e5b1f5189e2f09160a68eb20c8fe1049'};
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
								// window.location.href = "http://192.168.99.8:8082//users";
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
	
	
</script>	</body>
</html>