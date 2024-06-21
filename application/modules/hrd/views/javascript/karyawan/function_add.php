<script type="text/javascript">  
	function nav_button_<?php echo $function ?>(){
		//alert(' echo $page_title ?>');
		new_karyawan = 1;
		karyawan_id = 0;
		karyawan_type_id = 1;
		karyawan_this_memo = 0;
		karyawan_lock_data = 0;
		karyawan_open_form = 1;
		
		$('.form_title_<?php echo $methodid ?>').html('New <?php echo $page_title ?>');
	  //	page_loading("show",'New <?php echo $page_title ?>','Please Wait...');
		
		$("#tab_<?php echo $methodid; ?>_biodata").removeAttr("data-toggle");
		$("#tab_<?php echo $methodid; ?>_keluarga").removeAttr("data-toggle");
		$("#tab_<?php echo $methodid; ?>_dokumen").removeAttr("data-toggle");
		
		$("#tab_<?php echo $methodid; ?>_biodata").addClass( "tab_disabled");
		$("#tab_<?php echo $methodid; ?>_keluarga").addClass( "tab_disabled");
		$("#tab_<?php echo $methodid; ?>_dokumen").addClass( "tab_disabled");
		
		$('#panel_content_<?php echo $methodid ?>').hide();
		$('#panel_content_form_<?php echo $methodid ?>').show();
		$('#panel_content_form_upload_<?php echo $methodid ?>').hide();
		
		$('#form_<?php echo $methodid ?>_karyawan_id').val('');
		
		$('.button_<?php echo $methodid ?>_keluarga_edit').hide();
		$('.button_<?php echo $methodid ?>_keluarga_new').show();
		
		$('.button_<?php echo $methodid ?>_dokumen_edit').hide();
		$('.button_<?php echo $methodid ?>_dokumen_new').show();
		
		
		 change_mat_item(-1);
		
		setTimeout(function(){ 
			//purchase_order_get_purchase_data();
			$('.tab_scrollbar').getNiceScroll().resize(); 
		}, 100);
	}
	

</script>