<div class="container-fluid">
	<div class="row">
		<div class="col-xl-12">
			<div class="card card-statistics"> 
				<div class="card-body">
					<div class="row">
						<div class="col-xl-12">
							<div id="accordion">
								<div class="card">
									<div class="card-header" id="headingOne">
										<h5 class="mb-0">
											<?php echo $page_title ?>
										</h5>
									</div>
										<div class="card-body">
												<!-- <form class="form-inline" id="form_echo $methodid ?>"> -->
												 <form class="ui grid ecc_form" id="form_echo $methodid ?>">
												 <div class="col-xl-8">
												   <div class="form-group form-inline row">
												     <label for="inputPassword6"  class="col-sm-4 col-form-label">Date  &nbsp </label>
														<div class="input-group">
															<div class="input-group-prepend">
																<span class="input-group-text"><i class="fa fa-calendar"></i></span>
															</div>
															<input class="form-control" id="form_<?php echo $methodid ?>_date"  name="date" type="text" value="<?php echo date("Y-m-d") ?>" />
														</div>
																																					
												    </div>
												 </div>
												 <div class="col-xl-10">
													<div class="form-group form-inline row">
														<button type="button" class="btn btn-default" onclick="javascript:search_daily_<?php echo $methodid ?>();">
														<i class="fa fa-search"></i> Search
														</button> 	
														&nbsp &nbsp	
														<button type="button" class="btn btn-default"  onclick="javascript:copy_prev_<?php echo $methodid ?>();" >
															<i class="fa fa-clone"></i> Copy style sebelumnya
														</button>
														
														&nbsp &nbsp	
														<button type="button" class="btn btn-default"  onclick="javascript:add_style_<?php echo $methodid ?>();" >
															<i class="fa fa-plus"></i> Add
														</button>
														
														&nbsp &nbsp	
														<button type="button" class="btn btn-default"  onclick="javascript:delete_<?php echo $methodid ?>();" >
															<i class="fa fa-trash"></i> Delete
														</button>
														<!--
														&nbsp &nbsp
														<button type="button" class="btn btn-default" id="add_edit" data-bs-toggle="modal" data-bs-target="#form_add_edit">
															<i class="fa fa-search"></i> Add/Edit
														</button>
														
														&nbsp &nbsp
														<button type="button" class="btn btn-default" onclick="javascript:print_<?php //echo $methodid ?>_absen_1('pdf');">
															<i class="fa fa-search"></i> Print PDF
														</button>
														
														&nbsp &nbsp
														<button type="button" class="btn btn-default" onclick="javascript:print_<?php //echo $methodid ?>_absen_1('xlsx');">
															<i class="fa fa-search"></i> Print Xlsx
														</button>
														
														&nbsp &nbsp
														<button type="button" class="btn btn-default" onclick="javascript:print_periode_<?php //echo $methodid ?>('xlsx');">
															<i class="fa fa-search"></i> Print per Periode Xlsx
														</button>
														-->
														
														
													</div>	
                                                 </div>													
												</form>
											</div>
																								
									     <div class="row">
							                <div class="col-xl-12">
								             <table id="table_<?php echo $methodid ?>_daily_output"></table>
								             <div id="ptable_<?php echo $methodid ?>_daily_output"></div>                                                     
							               </div>
						                 </div>
								        <br />
								   					
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

 <div class="modal fade" id="m_target_daily" tabindex="-1" role="dialog" aria-labelledby="dailyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
	      <div class="modal-header">
            <h5 class="modal-title" id="dailyModalLabel">Add / Edit Data Target</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
		
		    <form class="ui grid ecc_form" id="form_<?php echo $methodid ?>_target_daily" action="javascript:add_<?php echo $methodid ?>_daily()">
		   <div class="modal-body">
		   <div class="form-group row">
				     <div class="col-sm-2">
				        <label for="absen_id" class="control-label">Date</label>
					   </div>
					 <div class="col-sm-6">
					   <input type="text"  id="form_<?php echo $methodid ?>_date_target" name="date_target" class="form-control" >
					 </div>
		    </div>
            <div class="form-group row">
				     <div class="col-sm-2">
				        <label for="absen_id" class="control-label">Style</label>
					   </div>
					 <div class="col-sm-3">
					   <input type="text"  id="form_<?php echo $methodid ?>_style_target" name="style_target" class="form-control" >
					 </div>
					 
					 <div class="col-sm-2">
				        <label for="absen_id" class="control-label">PO</label>
					 </div>
					  <div class="col-sm-3">
					   <input type="text"  id="form_<?php echo $methodid ?>_po_target" name="po_target" class="form-control" >
					 </div>
		    </div>
			<div class="form-group row">
				     <div class="col-sm-2">
				        <label for="absen_id" class="control-label">Price</label>
					   </div>
					 <div class="col-sm-3">
					 <input type="text"  id="form_<?php echo $methodid ?>_harga" name="harga" class="form-control" value="700">
					 </div>
					   <div class="col-sm-2">
				        <label for="absen_id" class="control-label">Unit Price</label>
					   </div>
					 <div class="col-sm-3">
					   <input type="text"  id="form_<?php echo $methodid ?>_harga_satuan" name="harga_satuan" class="form-control" >
					 </div>
		    </div>
			<div class="form-group row">
				     <div class="col-sm-2">
				        <label for="absen_id" class="control-label">Target Production</label>
					   </div>
					 <div class="col-sm-6">
					   <input type="text"  id="form_<?php echo $methodid ?>_production_target" name="roduction_target" class="form-control" >
					 </div>
		    </div>
		   </div>
		   
			   <div class="modal-footer">
			    <button type="submit" class="btn btn-primary" id="send">Send message</button>
			     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			  </div>
		 </form>
	   </div>
	 </div>
  </div>

<div id="modal_target" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
	      <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Add / Edit Data Target</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
		    <!--  action="javascript:add_<?php //echo $methodid ?>_absen()" -->
		    <form class="ui grid ecc_form" id="form_<?php echo $methodid ?>_modal_target" action="javascript:add_<?php echo $methodid ?>_target()">
		   <div class="modal-body">
		   <div class="form-group row">
		             <div class="col-sm-4">
				        <label for="lbl_info" class="control-label" id="lbl_info">Hasil</label>
					   </div>
				     <div class="col-sm-6">
					   <input type="hidden"  id="form_<?php echo $methodid ?>_id_target" name="id_target" class="form-control" >
					   <input type="hidden"  id="form_<?php echo $methodid ?>_line_target" name="line_target" class="form-control" >
					   <input type="hidden"  id="form_<?php echo $methodid ?>_date_target2" name="date_target2" class="form-control" >
					   <input type="hidden"  id="form_<?php echo $methodid ?>_style_target2" name="style_target2" class="form-control" >
					   <input type="hidden"  id="form_<?php echo $methodid ?>_po_target2" name="po_target2" class="form-control" >
					   <input type="hidden"  id="form_<?php echo $methodid ?>_harga" name="harga" class="form-control" >
					   <input type="hidden"  id="form_<?php echo $methodid ?>_jam" name="jam" class="form-control" >
					   <input type="hidden"  id="form_<?php echo $methodid ?>_production_target2" name="production_target2" class="form-control" >
					 </div>
		    </div>
             
			<div class="form-group row">
				     <div class="col-sm-4">
				        <label for="absen_id" class="control-label">Hasil</label>
					   </div>
					 <div class="col-sm-6">
					   <input type="text"  id="form_<?php echo $methodid ?>_hasil_target" name="hasil_target" class="form-control" >
					 </div>
		    </div>
		  </div>
		     <div class="modal-footer">
			  <button type="submit" class="btn btn-primary" >Save</button>
			  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
				 
			 </div>
		  </form>
	   </div>
	 </div>
  </div>
  
 
  <div class="modal" id="add_target_daily" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
	      <div class="modal-header">
            <h5 class="modal-title" id="dailyModalLabel">Add Data Target</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
		
		    <form class="ui grid ecc_form" id="form_<?php echo $methodid ?>_add_target_daily" action="javascript:new_daily_<?php echo $methodid ?>()">
		   <div class="modal-body">
		   <div class="col-xl-10">
		     <div class="form-group row">
				         <div class="col-sm-6">
						    <?php 
					        //$this->ecc_library->form('select_pop','Keterangan Absen',"form_".$methodid,'keterangan_absen','','','plh_keterangan_absen');
					        $this->ecc_library->form2('select_pop_line','Nama  
							Line',"form_".$methodid,'keterangan_line','','','get_keterangan_line','8');
					       ?>
					     </div>
		    </div>
		  </div>	
		  <div class="col-xl-10">
		   <div class="form-group row">
				     <div class="col-sm-2">
				        <label for="absen_id" class="control-label">Date</label>
					  </div>
					 <div class="col-sm-3">
					   <input type="text"  id="form_<?php echo $methodid ?>_date_daily" name="date_daily" class="form-control" >
					 </div>
		    </div>
		   </div>
		   <div class="col-xl-10">
            <div class="form-group row">
			          <div class="col-sm-6" >
						    <?php 
					        //$this->ecc_library->form('select_pop','Keterangan Absen',"form_".$methodid,'keterangan_absen','','','plh_keterangan_absen');
					        $this->ecc_library->form2('select_pop_line','Style',"form_".$methodid,'list_style','','','get_list_style','6');
					       ?>
					   </div>
					
		               <div class="form-group row" id="form_style">
					     <div class="col-sm-4">
				          <label for="absen_id" class="control-label">New Style</label> 
						</div>
						 <div class="col-sm-8">
						    <input type="text"  id="form_<?php echo $methodid ?>_new_style" name="new_style" class="form-control" >
					    </div>
					   </div>
                   
		      </div>
			</div>
			<div class="col-xl-10">
             <div class="form-group row">
			  		 <div class="col-sm-2">
				        <label for="absen_id" class="control-label">PO Number</label>
					 </div>
					  <div class="col-sm-6">
					   <input type="text"  id="form_<?php echo $methodid ?>_add_po" name="add_po" class="form-control" >
					 </div>
		    </div>
			</div>
			<div class="col-xl-10">
			<div class="form-group row">
				     <div class="col-sm-2">
				        <label for="absen_id" class="control-label">Price</label>
					   </div>
					 <div class="col-sm-2">
					 <input type="text"  id="form_<?php echo $methodid ?>_harga" name="harga" class="form-control" value="700">
					 </div>
					 
					<div class="col-sm-2">
				        <label for="absen_id" class="control-label">Unit Price</label>
					   </div>
					 <div class="col-sm-2">
					   <input type="text"  id="form_<?php echo $methodid ?>_harga_satuan" name="harga_satuan" class="form-control" >
					 </div>
					 
					   <div class="col-sm-1">
				        <label for="absen_id" class="control-label">Day</label>
					   </div>
					 <div class="col-sm-2">
					   <input type="text"  id="form_<?php echo $methodid ?>_lama_hari" name="lama_hari" class="form-control" value="14" readonly >
					 </div>
		    </div>
			</div>
		   <div class="col-xl-10">
			<div class="form-group row">
				     <div class="col-sm-3">
				        <label for="absen_id" class="control-label">Target Production</label>
					   </div>
					 <div class="col-sm-4">
					   <input type="text"  id="form_<?php echo $methodid ?>_nilai_target" name="nilai_target" class="form-control" >
					 </div>
		    </div>
		   </div>
		   </div>
		   
			   <div class="modal-footer">
			    <button type="submit" class="btn btn-primary" id="send">Save</button>
			     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			  </div>
		 </form>
	   </div>
	 </div>
  </div>
  
  <script type="text/javascript">
      $('#form_<?php echo $methodid ?>_list_style').on('change', function(){
		   const  style= $("#form_<?php echo $methodid ?>_list_style").val();
		//	alert('value '+ style); 
		    $("#form_style").hide();
			//$("p").html("nilai yang di pilih adalah " + style); 
			if (style == 26){
			//	alert('value '+ style); 
				  $("#form_style").show()
			}
        });
   
  </script> 