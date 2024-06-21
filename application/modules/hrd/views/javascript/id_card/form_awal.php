<script type="text/javascript">
//alert("coba view");
   var new_karyawan=1;
   var karyawan_id=0;
   var karyawan_type_id=1;
   var karyawan_lock_data=0;
   var karyawan_open_form =0;
   
	var new_purchase_order = 1;
	var purchase_order_id = 0;
	var purchase_type_id = 1;
	var purchase_order_this_memo = 0;
	var purchase_order_lock_data = 0;
	var purchase_order_open_form = 0;
	
	$(".form_tab_<?php echo $methodid ?>").on("click", "a", function (e) {
	//alert("coba view");
        e.preventDefault();
		setTimeout(function(){ 
				   		
			$("#table_<?php echo $methodid ?>_biodata").trigger('reloadGrid');
			$("#table_<?php echo $methodid ?>_biodata").setGridWidth($('.grid_container_<?php echo $methodid; ?>_biodata').width() - 20,true).trigger('resize');
			
			$("#table_<?php echo $methodid ?>_keluarga").trigger('reloadGrid');
			$("#table_<?php echo $methodid ?>_keluarga").setGridWidth($('.grid_container_<?php echo $methodid; ?>_keluarga').width() - 20,true).trigger('resize');
			
			$("#table_<?php echo $methodid ?>_dokumen").trigger('reloadGrid');
			$("#table_<?php echo $methodid ?>_dokumen").setGridWidth($('.grid_container_<?php echo $methodid; ?>_dokumen').width() - 20,true).trigger('resize');
			
						
			$('.tab_scrollbar').getNiceScroll().resize(); 
		}, 1000);
    });
	
	$('#form_<?php echo $methodid ?>_detail_item_id,#form_<?php echo $methodid ?>_partner_id,#form_<?php echo $methodid ?>_currencies_id,#form_<?php echo $methodid ?>_purchase_order_date ').on('change', function (event, clickedIndex, newValue, oldValue) {
		//alert(baseurl+'loader');
		//purchase_order_get_purchase_data();
	});
		

	function cancel_<?php echo $methodid ?>(){
		//alert('cancel');
		$('#panel_content_<?php echo $methodid ?>').show();
		$('#panel_content_form_<?php echo $methodid ?>').hide();
		$('#panel_uploadexcel_form_<?php echo $methodid ?>').hide();
		$("#table_<?php echo $methodid ?>").trigger('reloadGrid');
	}
	
	function save_<?php echo $methodid ?>(){
		$('#form_<?php echo $methodid ?>').submit();
	}
	
	function save_<?php echo $methodid ?>_biodata(){
		//alert('form_<?php echo $methodid ?>_biodata');
		$('#form_<?php echo $methodid ?>_biodata').submit();
	}
	
	var jvalidate = $("#form_<?php echo $methodid ?>").validate({
		ignore: [],
		rules: {                                            
			gl_account_group: {
				required: true
			}
		} 
	});
	
	function edit_<?php echo $methodid?>(id){
		page_loading("show",'<?php echo $page_title ?>','Please Wait...');
		//alert(id +'loader');
		$.ajax({
			url: baseurl+'loader',
			data: {
				'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
				,param: 'data_karyawan_edit'
				,param_pop: 'db_pop'
				,id : id
			},
			dataType: 'json',
			method: 'post',
			success: function(data){
				page_loading("hide");
				$('.button_<?php echo $methodid ?>_keluarga_edit').hide();
				$('.button_<?php echo $methodid ?>_keluarga_new').show();	

                $('.button_<?php echo $methodid ?>_dokumen_edit').hide();
				$('.button_<?php echo $methodid ?>_dokumen_new').show();				
							
				new_karyawan_id=0;
				karyawan_id=data[0].karyawan_id;
				var img = document.getElementById("gambar");
				if (data[0].karyawan_link_photo != null){
				     img.setAttribute("src", baseurl+data[0].karyawan_link_photo);
				}else{
					 img.setAttribute("src", baseurl+'assets/img/profile/default.jpeg');
				}
				//var pic = document.getElementById("picture");
				//const elementBaru = document.createElement('p');
				$('#form_<?php echo $methodid ?>_karyawan_id').val(data[0].karyawan_id);
				$('#form_<?php echo $methodid ?>_nama_karyawan').val(data[0].name);
				$('#form_<?php echo $methodid ?>_badgenumber').val(data[0].badgenumber);
				$('#form_<?php echo $methodid ?>_nik').val(data[0].nik);
				$('#form_<?php echo $methodid ?>_date_in').val(data[0].date_in);
				
				$('#form_<?php echo $methodid ?>_biodata_karyawan_id').val(data[0].karyawan_id);
				$('#form_<?php echo $methodid ?>_tempat_lahir').val(data[0].tempat_lahir);
				$('#form_<?php echo $methodid ?>_alamat').val(data[0].alamat);
				
				$('#form_<?php echo $methodid ?>_keluarga_karyawan_id').val(data[0].karyawan_id);
				
				$('#form_<?php echo $methodid ?>_dokumen_karyawan_id').val(data[0].karyawan_id);
				//$('#form_<?php echo $methodid ?>_purchase_order_date').val(data[0].purchase_order_date);
				//$('#form_<?php echo $methodid ?>_purchase_order_memo').val(data[0].purchase_order_memo);
				//$('#form_<?php echo $methodid ?>_rate').val(data[0].rate);
				
				change_form_<?php echo $methodid ?>_gender_id(data[0].gender_id);
				change_form_<?php echo $methodid ?>_divisi_id(data[0].divisi_id);
				change_form_<?php echo $methodid ?>_departement_id(data[0].departement_id);
				change_form_<?php echo $methodid ?>_jabatan_id(data[0].jabatan_id);
				change_form_<?php echo $methodid ?>_group_id(data[0].group_id);
				change_form_<?php echo $methodid ?>_status_id(data[0].status_id);
				
				//change_form_<?php echo $methodid ?>_partner_id(data[0].partner_id);
				//change_form_<?php echo $methodid ?>_currencies_id(data[0].currencies_id);
				//change_form_<?php echo $methodid ?>_purchase_order_type_id(data[0].purchase_order_type_id);
				
				//$("#tab_<?php echo $methodid; ?>_detail").attr("data-toggle","tab");
				//$("#tab_<?php echo $methodid; ?>_detail").removeClass( "tab_disabled");
				
			//	$("#tab_<?php echo $methodid; ?>_keluarga").attr("data-toggle","tab");
			//	$("#tab_<?php echo $methodid; ?>_keluarga").removeClass( "tab_disabled");
			//	
			//	$("#tab_<?php echo $methodid; ?>_dokumen").attr("data-toggle","tab");
			//	$("#tab_<?php echo $methodid; ?>_dokumen").removeClass( "tab_disabled");
				if(data[0].karyawan_id == 1){
					$('.panel_<?php echo $methodid ?>_panel_detail').show();
					$('.panel_<?php echo $methodid ?>_panel_purchase_request').hide();
				} else {
					$('.panel_<?php echo $methodid ?>_panel_detail').hide();
					$('.panel_<?php echo $methodid ?>_panel_purchase_request').show();
					
				}
				
				setTimeout(function(){ 
					$('.tab_scrollbar').getNiceScroll().resize(); 
				}, 90);
			}
		});
	}
	
	var check_submit = 0;
	function post_<?php echo $methodid ?>(){
		if(check_submit == 0) {
			check_submit = 1;
			page_loading("show",'Save <?php echo $page_title ?>','Please Wait...');
			var data = $("#form_<?php echo $methodid ?>").serialize();
			
			let frmdata= new FormData();
			
			var data2 =  $("#form_<?php echo $methodid ?>").serializeArray();
			$.each(data2, function (key,input) {
				frmdata.append(input.name,input.value);
			});
			
			const file_data = $('#form_<?php echo $methodid ?>_link_photo').prop('files')[0];
			//console.log(frmdata);
			if(file_data){
				frmdata.append('file',file_data);
				frmdata.append('info',"Yes");
			}else{
				frmdata.append('info',"No");
			}
			//console.log(frmdata);
			//alert(data2);
			    //data: frmdata,
				//dataType: 'json',
				//Method: 'post',
			$.ajax({
				url: baseurl+'<?php echo $class_uri ?>/post_add_edit',
				type:'post',
				data: frmdata,
				processData:false,
				contentType:false,
				dataType:'json',
				success: function(data){
					page_loading("hide");
					check_submit = 0;
					if(data.valid){
						show_success("show",'<?php echo $page_title ?>',data.message);	
						
						if(new_purchase_order == 1){
							new_purchase_order = 0;
							$("#tab_<?php echo $methodid; ?>_biodata").attr("data-toggle","tab");
							$("#tab_<?php echo $methodid; ?>_biodata").removeClass( "tab_disabled");
							$("#tab_<?php echo $methodid; ?>_biodata").click();
							
							karyawan_id = data.karyawan_id;
							$('#form_<?php echo $methodid ?>_karyawan_id').val(karyawan_id);
							$('#form_<?php echo $methodid ?>_biodata_karyawan_id').val(karyawan_id);
														
							setTimeout(function(){ 
								$("#table_<?php echo $methodid ?>_biodata").trigger('reloadGrid');
								$("#table_<?php echo $methodid ?>_biodata").setGridWidth($('.grid_container_<?php echo $methodid; ?>_biodata').width() - 20,true).trigger('resize');
								$('.tab_scrollbar').getNiceScroll().resize(); 
							}, 500);
							
						
							
						} else {
							new_purchase_order = 1;
							$('#panel_content_<?php echo $methodid ?>').show();
							$('#panel_content_form_<?php echo $methodid ?>').hide();
							$("#table_<?php echo $methodid ?>").trigger('reloadGrid');
						}
					} else {
						show_error("show",'Error',data.message);
					}
				},
				error: function(xhr,error){
					show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again');
					check_submit = 0;
				}
			});
		}
	}
	
	/* Detail Function */
	
	var beforeclick_<?php echo $methodid ?>_purchase_request = function (rowid, e) {
		$("#table_<?php echo $methodid ?>_purchase_request").jqGrid('resetSelection');
		return(true);
	}
	
	var jvalidate2 = $("#form_<?php echo $methodid ?>_detail").validate({
		ignore: [],
		rules: {                                            
			item_id: {
				required: true
			},
			'quantity_ordered': {
				min: 0
			}
		} 
	});
	
	var check_submit = 0;
	function add_<?php echo $methodid ?>_biodata(){
		new_karyawan = 0;
		//alert('data');
		if(check_submit == 0) {
			check_submit = 1;
			page_loading("show",'<?php echo $page_title ?> Biodata','Please Wait...');
			var data = $("#form_<?php echo $methodid ?>_biodata").serialize();
			//alert(data);
			$.ajax({
				url: baseurl+'<?php echo $class_uri ?>/post_add_edit_biodata',
				data: data,
				dataType: 'json',
				method: 'post',
				success: function(data){
					page_loading("hide");
					check_submit = 0;
					if(data.valid){
						show_success("show",'<?php echo $page_title ?> Biodata',data.message);	
						
						    $("#tab_<?php echo $methodid; ?>_biodata").attr("data-toggle","tab");
							$("#tab_<?php echo $methodid; ?>_biodata").removeClass( "tab_disabled");
						
					   	    $("#tab_<?php echo $methodid; ?>_keluarga").attr("data-toggle","tab");
							$("#tab_<?php echo $methodid; ?>_keluarga").removeClass( "tab_disabled");
							$("#tab_<?php echo $methodid; ?>_keluarga").click();
							
							karyawan_id = data.karyawan_id;
							biodata_id = data.biodata_id;
							$('#form_<?php echo $methodid ?>_keluarga_karyawan_id').val(karyawan_id);
							$('#form_<?php echo $methodid ?>_biodata_id').val(biodata_id);
							
							//$('#form_<?php echo $methodid ?>_keluarga_id').val(karyawan_id);
								
							setTimeout(function(){ 
								$("#table_<?php echo $methodid ?>_keluarga").trigger('reloadGrid');
								$("#table_<?php echo $methodid ?>_keluarga").setGridWidth($('.grid_container_<?php echo $methodid; ?>_keluarga').width() - 20,true).trigger('resize');
								$('.tab_scrollbar').getNiceScroll().resize(); 
							}, 500);
						
						//$("#table_<?php echo $methodid ?>_detail").trigger('reloadGrid');
						//cancel_detail_<?php echo $methodid ?>();
						//$("#table_<?php echo $methodid ?>_detail").setGridWidth($('.grid_container_<?php echo $methodid; ?>_detail').width() - 20,true).trigger('resize');
									
					} else {
						show_error("show",'Error',data.message);
					}
				},
				error: function(xhr,error){
					show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again');
					check_submit = 0;
				}
			});
		}
	}
	
   var check_submit_keluarga = 0;
   function add_<?php echo $methodid ?>_keluarga(){
	  new_karyawan_keluarga = 0;
	  
	   if(check_submit_keluarga == 0) {
		  page_loading("show",'<?php echo $page_title ?> Keluarga','Please Wait...');
		   var data = $("#form_<?php echo $methodid ?>_keluarga").serialize();
		    // alert(data);
			 $.ajax({
				url: baseurl+'<?php echo $class_uri ?>/post_add_edit_keluarga',
				data: data,
				dataType: 'json',
				method: 'post',
				success: function(data){
				  page_loading("hide");
				  check_submit_keluarga = 0;
                  $("#tab_<?php echo $methodid; ?>_biodata").attr("data-toggle","tab");
				  $("#tab_<?php echo $methodid; ?>_biodata").removeClass( "tab_disabled");
						
			      $("#tab_<?php echo $methodid; ?>_keluarga").attr("data-toggle","tab");
				  $("#tab_<?php echo $methodid; ?>_keluarga").removeClass( "tab_disabled");
				
                  $("#tab_<?php echo $methodid; ?>_dokumen").attr("data-toggle","tab");
				  $("#tab_<?php echo $methodid; ?>_dokumen").removeClass( "tab_disabled");
				  
				  $("#tab_<?php echo $methodid; ?>_keluarga").click();					  
				
				  karyawan_id = data.karyawan_id;
				  //biodata_id = data.biodata_id;
							$('#form_<?php echo $methodid ?>_keluarga_karyawan_id').val(karyawan_id);
							$('#form_<?php echo $methodid ?>_dokumen_karyawan_id').val(karyawan_id);
							
							$('#form_<?php echo $methodid ?>_keluarga_nama_keluarga').val('');
				            $('#form_<?php echo $methodid ?>_keluarga_pekerjaan').val('');
				            $('#form_<?php echo $methodid ?>_keluarga_pendidikan').val('');
				            $('#form_<?php echo $methodid ?>_keluarga_tempat_lahir_keluarga').val('');
			   	            $('#form_<?php echo $methodid ?>_keluarga_id').val('');
			   
			              //  change_form_<?php echo $methodid ?>_keluarga_status_keluarga_id(data[0].kode_status);
				          //change_form_<?php echo $methodid ?>_keluarga_gender_keluarga(data[0].kode_gender);
				
				
			               $('.button_<?php echo $methodid ?>_keluarga_edit').hide();
			               $('.button_<?php echo $methodid ?>_keluarga_new').show();	
								
							setTimeout(function(){ 
								$("#table_<?php echo $methodid ?>_keluarga").trigger('reloadGrid');
								$("#table_<?php echo $methodid ?>_keluarga").setGridWidth($('.grid_container_<?php echo $methodid; ?>_keluarga').width() - 20,true).trigger('resize');
								$('.tab_scrollbar').getNiceScroll().resize(); 
							}, 500); 
				   
				  show_success("show",'Information',data.message);
                }					
			 });
	     }
	}
	
	var check_submit_dokumen = 0;
	function add_<?php echo $methodid ?>_dokumen(){
	  new_dokumen_keluarga = 0;
	   if(check_submit_dokumen == 0) {
		  // page_loading("show",'<?php echo $page_title ?> Dokumen','Please Wait...');
		   var data = $("#form_<?php echo $methodid ?>_dokumen").serialize();
			
			let frmdok= new FormData();
			
			var data2 =  $("#form_<?php echo $methodid ?>_dokumen").serializeArray();
			$.each(data2, function (key,input) {
				frmdok.append(input.name,input.value);
			});
			
			const file_data = $('#form_<?php echo $methodid ?>_lokasi_dokumen').prop('files')[0];
			//console.log(file_data);
			if(file_data){
				frmdok.append('file',file_data);
				frmdok.append('info',"Yes");
			}else{
				frmdok.append('info',"No");
			}
			
			$.ajax({
				url: baseurl+'<?php echo $class_uri ?>/post_add_edit_dokumen',
				type:'post',
				data: frmdok,
				processData:false,
				contentType:false,
				dataType:'json',
				success: function(data){
					page_loading("hide");
					check_submit_dokumen = 0;
					if(data.valid){
						 $("#tab_<?php echo $methodid; ?>_biodata").attr("data-toggle","tab");
				         $("#tab_<?php echo $methodid; ?>_biodata").removeClass( "tab_disabled");
				  	      
			             $("#tab_<?php echo $methodid; ?>_keluarga").attr("data-toggle","tab");
				         $("#tab_<?php echo $methodid; ?>_keluarga").removeClass( "tab_disabled");
				         
                         $("#tab_<?php echo $methodid; ?>_dokumen").attr("data-toggle","tab");
				         $("#tab_<?php echo $methodid; ?>_dokumen").removeClass( "tab_disabled");
				         $("#tab_<?php echo $methodid; ?>_dokumen").click();	

                           karyawan_id = data.karyawan_id;
                      	 $('#form_<?php echo $methodid ?>_dokumen_karyawan_id').val(karyawan_id);	
						 $('#form_<?php echo $methodid ?>_dokumen_keterangan_dokumen').val('');
                           setTimeout(function(){ 
								$("#table_<?php echo $methodid ?>_dokumen").trigger('reloadGrid');
								$("#table_<?php echo $methodid ?>_dokumen").setGridWidth($('.grid_container_<?php echo $methodid; ?>_dokumen').width() - 20,true).trigger('resize');
								$('.tab_scrollbar').getNiceScroll().resize(); 
							}, 500); 
				   
				       show_success("show",'Information',data.message);						 
					}
				}
			});
	    // alert('dokumen');
	   }
	}
	
	function edit_detail_<?php echo $methodid ?>(purchase_order_detail_id){
		page_loading("show",'<?php echo $page_title ?>','Please Wait...');
		//alert(baseurl+'loader');
		$.ajax({
			url: baseurl+'loader',
			data: {
				'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
				,param: 'data_purchase_order_detail'
				,id : purchase_order_detail_id
			},
			dataType: 'json',
			method: 'post',
			success: function(data){
				page_loading("hide");
				console.log(data[0]);
				$('#form_<?php echo $methodid ?>_detail_purchase_order_detail_id').val(data[0].purchase_order_detail_id);
				$('#form_<?php echo $methodid ?>_detail_quantity_ordered').val(data[0].quantity_ordered);
				$('#form_<?php echo $methodid ?>_detail_order_delivery_date').val(data[0].order_delivery_date);
				$('#form_<?php echo $methodid ?>_detail_conversion').val(data[0].conversion);
				$('#form_<?php echo $methodid ?>_detail_unit_price').val(data[0].unit_price);
				$('#form_<?php echo $methodid ?>_detail_purchase_order_detail_memo').val(data[0].purchase_order_detail_memo);
				$('#form_<?php echo $methodid ?>_detail_purchase_order_detail_Style').val(data[0].po_style);
				$('#form_<?php echo $methodid ?>_detail_purchase_order_detail_composition').val(data[0].po_composition);
				$('#form_<?php echo $methodid ?>_detail_purchase_order_detail_intruction').val(data[0].po_intruction);
				
				if(purchase_type_id == 1){
					$('.button_<?php echo $methodid ?>_detail_edit').show();
					$('.button_<?php echo $methodid ?>_detail_new').hide();	
					
					change_form_<?php echo $methodid ?>_detail_item_id(data[0].item_id);
					change_form_<?php echo $methodid ?>_detail_uom_id(data[0].uom_id);
				} else {
					$("#table_<?php echo $methodid ?>_purchase_request").trigger('reloadGrid');
				}		
			}
		});
	}
	
	function edit_keluarga_<?php echo $methodid ?>(keluarga_id){
		page_loading("show",'<?php echo $page_title ?>','Please Wait...');
		//alert('coba');
		$.ajax({
			url: baseurl+'loader',
			data: {
				'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
				,param: 'data_keluarga_detail'
				,param_pop:'db_pop'
				,id : keluarga_id
			},
			dataType: 'json',
			method: 'post',
			success: function(data){
				page_loading("hide");
				//console.log(data[0]);
				//alert(data[0].kode_status);
				$('#form_<?php echo $methodid ?>_keluarga_nama_keluarga').val(data[0].nama_keluarga);
				$('#form_<?php echo $methodid ?>_keluarga_pekerjaan').val(data[0].pekerjaan);
				$('#form_<?php echo $methodid ?>_keluarga_pendidikan').val(data[0].pendidikan);
				$('#form_<?php echo $methodid ?>_keluarga_tempat_lahir_keluarga').val(data[0].tempat_lahir);
				$('#form_<?php echo $methodid ?>_keluarga_id').val(data[0].keluarga_id);
			   
			    change_form_<?php echo $methodid ?>_keluarga_status_keluarga_id(data[0].kode_status);
				change_form_<?php echo $methodid ?>_keluarga_gender_keluarga(data[0].kode_gender);
				
				
			   $('.button_<?php echo $methodid ?>_keluarga_edit').show();
			   $('.button_<?php echo $methodid ?>_keluarga_new').hide();	
			}
		});
	}
	
	function delete_keluarga_<?php echo $methodid ?>(keluarga_id){
		if(check_submit == 0) {
			swal({
				title: "Confirm Delete <?php echo $page_title ?> Keluarga ?",
				type: "question",
				dangerMode: true,
				showCancelButton: !0,
				confirmButtonClass: "btn btn-danger m-1",
				cancelButtonClass: "btn btn-secondary m-1",
				confirmButtonText: "Confirm",
				cancelButtonText: "Cancel",
				backdrop: true,
				allowOutsideClick : false,
			}).then((result) => {
			  if (result.value) {
			    page_loading("show",'Delete <?php echo $page_title ?> Keluarga','Please Wait...');
				 $.ajax({
					 url: baseurl+'<?php echo $class_uri ?>/delete_keluarga',								
					 data: {'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>',keluarga_id:keluarga_id},
					 dataType: 'json',
					 method: 'post',
					success: function(data){
						page_loading("hide");
							check_submit = 0;
							if(data.valid){
								show_success("show",'Delete <?php echo $page_title ?> keluarga',data.message);			
								$("#table_<?php echo $methodid ?>_keluarga").trigger('reloadGrid');
								cancel_keluarga_<?php echo $methodid ?>();
								
								setTimeout(function(){ 
									$('.tab_scrollbar').getNiceScroll().resize(); 
								}, 100);
							} else {
								show_error("show",'Error',data.message);
							}
					},
					 error: function(xhr,error){
					 	show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again');
					 	check_submit = 0;
					 }
				 });
			  } else if (result.dismiss === swal.DismissReason.cancel) {
					swal.closeModal();	
					check_submit = 0;
			  }
			  });
		}
	}
	
	function edit_dokumen_<?php echo $methodid ?>(dokumen_id){
		page_loading("show",'<?php echo $page_title ?>','Please Wait...');
		//alert('coba');
		$.ajax({
			url: baseurl+'loader',
			data: {
				'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
				,param: 'data_dokumen_detail'
				,param_pop:'db_pop'
				,id : dokumen_id
			},
			dataType: 'json',
			method: 'post',
			success: function(data){
				page_loading("hide");
				//console.log(data[0]);
				//alert(data[0].kode_status);
				$('#form_<?php echo $methodid ?>_dokumen_id').val(data[0].dokumen_id);
				$('#form_<?php echo $methodid ?>_dokumen_keterangan_dokumen').val(data[0].keterangan_dokumen);
				$('#form_<?php echo $methodid ?>_alamat_dok').val(data[0].lokasi_dokumen);
				
			    change_form_<?php echo $methodid ?>_nama_dokumen(data[0].id_nama);
					
				
			   $('.button_<?php echo $methodid ?>_dokumen_edit').show();
			   $('.button_<?php echo $methodid ?>_dokumen_new').hide();	
			}
		});
	}
	
	function delete_dokumen_<?php echo $methodid ?>(dokumen_id){
		if(check_submit == 0) {
			swal({
				title: "Confirm Delete <?php echo $page_title ?> Dokumen ?",
				type: "question",
				dangerMode: true,
				showCancelButton: !0,
				confirmButtonClass: "btn btn-danger m-1",
				cancelButtonClass: "btn btn-secondary m-1",
				confirmButtonText: "Confirm",
				cancelButtonText: "Cancel",
				backdrop: true,
				allowOutsideClick : false,
			}).then((result) => {
			  if (result.value) {
			    page_loading("show",'Delete <?php echo $page_title ?> Dokumen','Please Wait...');
				 $.ajax({
					 url: baseurl+'<?php echo $class_uri ?>/delete_dokumen',								
					 data: {'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>',dokumen_id:dokumen_id},
					 dataType: 'json',
					 method: 'post',
					success: function(data){
						page_loading("hide");
							check_submit = 0;
							if(data.valid){
								show_success("show",'Delete <?php echo $page_title ?> dokumen',data.message);			
								$("#table_<?php echo $methodid ?>_dokumen").trigger('reloadGrid');
								cancel_dokumen_<?php echo $methodid ?>();
								
								setTimeout(function(){ 
									$('.tab_scrollbar').getNiceScroll().resize(); 
								}, 100);
							} else {
								show_error("show",'Error',data.message);
							}
					},
					 error: function(xhr,error){
					 	show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again');
					 	check_submit = 0;
					 }
				 });
			  } else if (result.dismiss === swal.DismissReason.cancel) {
					swal.closeModal();	
					check_submit = 0;
			  }
			  });
		}
	}
	

    function cancel_keluarga_<?php echo $methodid ?>(){
	
		$('#form_<?php echo $methodid ?>_keluarga_nama_keluarga').val('');
		$('#form_<?php echo $methodid ?>_keluarga_pekerjaan').val('');
		$('#form_<?php echo $methodid ?>_keluarga_pendidikan').val('');
		$('#form_<?php echo $methodid ?>_keluarga_tempat_lahir_keluarga').val('');
		$('#form_<?php echo $methodid ?>_keluarga_id').val('');
		
		change_form_<?php echo $methodid ?>_keluarga_status_keluarga_id('5');
		change_form_<?php echo $methodid ?>_keluarga_gender_keluarga('2');
				
		$('.button_<?php echo $methodid ?>_keluarga_edit').hide();
		$('.button_<?php echo $methodid ?>_keluarga_new').show();	
		
		$("#table_<?php echo $methodid ?>_keluarga").trigger('reloadGrid');
	}	
	
	function cancel_dokumen_<?php echo $methodid ?>(){
	    $('#form_<?php echo $methodid ?>_dokumen_keterangan_dokumen').val('');
							   
	    change_form_<?php echo $methodid ?>_nama_dokumen('10');
					
		 $('.button_<?php echo $methodid ?>_dokumen_edit').hide();
		 $('.button_<?php echo $methodid ?>_dokumen_new').show();	
		
		$("#table_<?php echo $methodid ?>_dokumen").trigger('reloadGrid');
	}

     function preview_dokumen_<?php echo $methodid ?>(dokumen_id){
		// alert(link_dokumen);
		$.ajax({
			url:baseurl+'<?php echo $class_uri ?>/preview_dokumen',
			data: {
				'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
				,param_pop:'db_pop'
				,dokumen_id : dokumen_id
			},
			dataType: 'json',
			method: 'post',
			success: function(data){
				//page_loading("hide");
				//console.log(data['lokasi']);
		    $('#gbr_dokumen2').modal('show');
		   $('#modal_gbr').html('<img src="'+ data['lokasi'] + '" class="img-fluid">');
					
			}
		});
		  
		// document.gbr.src='./assets/img/profile/ekonomi Bulolo/dokumen/050957_KTP_1644884239_3b035d0c146004e27195.jpg';
         //document.gbr.width=500;
        //document.gbr.style.display='block';
	   //$('#form_<?php echo $methodid ?>_dokumen_keterangan_dokumen').val('');
		//					   
	   //change_form_<?php echo $methodid ?>_nama_dokumen('10');
		//			
		// $('.button_<?php echo $methodid ?>_dokumen_edit').hide();
		// $('.button_<?php echo $methodid ?>_dokumen_new').show();	
		//
		//$("#table_<?php echo $methodid ?>_dokumen").trigger('reloadGrid');
	}		
	
	  function download_dokumen_<?php echo $methodid ?>(dokumen_id){
	   //	page_loading("show",'<?php echo $page_title ?>','Please Wait...');
		//alert('coba');
		$.ajax({
			url:baseurl+'<?php echo $class_uri ?>/download_dokumen',
			data: {
				'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
				,param_pop:'db_pop'
				,dokumen_id : dokumen_id
			},
			dataType: 'json',
			method: 'post',
			success: function(data){
				page_loading("hide");
				console.log(data);
					
			}
		});
	
	}		
	/* End Detail Function */
	
	var check_submit = 0;
	function add_list_<?php echo $methodid ?>(rh_id){
		page_loading("show",'<?php echo $page_title ?> Detail','Please Wait...');
		setTimeout(function(){ 
			var id = jQuery("#table_<?php echo $methodid ?>_purchase_request").jqGrid('getGridParam','selrow');
			if (id) {
				var row = jQuery("#table_<?php echo $methodid ?>_purchase_request").jqGrid('getRowData',id);   
				
				purchase_order_id = $('#form_<?php echo $methodid ?>_purchase_order_id').val();
				purchase_order_detail_id = rh_id;
				purchase_request_detail_id = parseInt(unwrap_cell_value(row.r1).replace(/,/g, ''));
				item_id = parseInt(unwrap_cell_value(row.r19).replace(/,/g, ''));
				quantity_ordered = parseFloat(unwrap_cell_value(row.r12).replace(/,/g, ''));
				uom_id = parseInt(unwrap_cell_value(row.r13).replace(/,/g, ''));
				conversion = parseFloat(unwrap_cell_value(row.r14).replace(/,/g, ''));
				unit_price = parseFloat(unwrap_cell_value(row.r15).replace(/,/g, ''));
				order_delivery_date = unwrap_cell_value(row.r16);
				purchase_order_detail_memo = unwrap_cell_value(row.r17);
				
				$.ajax({
				url: baseurl+'<?php echo $class_uri ?>/post_add_edit_detail',
				data: {
					'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
					,purchase_order_detail_id:purchase_order_detail_id
					,purchase_request_detail_id :purchase_request_detail_id
					,purchase_order_id :purchase_order_id
					,item_id :item_id
					,quantity_ordered :quantity_ordered
					,uom_id :uom_id
					,conversion :conversion
					,unit_price :unit_price
					,order_delivery_date :order_delivery_date
					,purchase_order_detail_memo :purchase_order_detail_memo
					,trans_type :2
				},
				dataType: 'json',
				method: 'post',
				success: function(data){
					
					page_loading("hide");
					check_submit = 0;
					if(data.valid){
						show_success("show",'<?php echo $page_title ?> Detail',data.message);	
						cancel_detail_<?php echo $methodid ?>();
						$("#table_<?php echo $methodid ?>_purchase_request").trigger('reloadGrid');
						$("#table_<?php echo $methodid ?>_detail").trigger('reloadGrid');
						page_loading("hide");			
					} else {
						show_error("show",'Error',data.message);
					}
				},
				error: function(xhr,error){
					show_error("show",xhr.status.toString() + ' ' + xhr.statusText,'Please try again');
					check_submit = 0;
				}
			});
				
				
			} else {
				show_error("show",'Error','Please select row');
			}
			
		}, 500);	
		
	}
	
	function pictureadd(){
		//var filegbr= $("form_<?php echo $methodid; ?>_link_photo");
		//var filegbr= $("form_1045_link_photo");
		const filegbr= document.getElementById("form_<?php echo $methodid; ?>_link_photo");
		//const namagbr= document.getElementById("form_<?php echo $methodid; ?>_nmficture");
		//const filegbr= document.getElementById("form_1045_link_photo");
		let name=filegbr.files[0].name;
		let fjenis=filegbr.files[0].type;
		let fsize=filegbr.files[0].size;
		const ext=fjenis.split("/").pop().toLowerCase();
		//alert (fsize); 
		if(ext =="jpg" || ext=="jpeg" || ext=="png"){
			//namagbr.value=name
			 //----cek ukuran gambar ---------
			 //1195585
			 if(fsize > 2000000){
			   swal({
				  icon: "warning",
				  title:"Information",
				  text:"Maaf, File terlalu Besar ! Maximum 800KB ",
				  timer:4500
			   });
			   this.value="";
			 }
			
		}else{
			swal({
				icon: "warning",
				title:"Information",
				text:"Format gambar tidak sesuai..",
				timer:4500
			});
		//	$("#nmficture").val("");
			return false;
		}
		      //alert('asssss4');	
		      const gbr=document.querySelector(".gbrphoto");
		      filegbr.textContent = name;
		      
		      const fileimg = new FileReader();
	          fileimg.readAsDataURL(filegbr.files[0]);
		      
		      fileimg.onload = function(e) {
		      	gbr.src = e.target.result;
		      };
			//$("#nmficture").val(name);  
		//	  var file_data = filegbr.prop('files')[0];
		     //var form_data = $('#link_photo').prop('files')[0];
		  //    alert('coba8 ');
		      //console.log(fjenis);
		      //alert('coba2 '+name + " size: " + ext);
	}
	

</script>