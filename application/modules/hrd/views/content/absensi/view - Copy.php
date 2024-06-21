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
								
									
									<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
											<div class="card-body">
												<!-- <form class="form-inline" id="form_echo $methodid ?>"> -->
												 <form class="ui grid ecc_form" id="form_echo $methodid ?>">
																					 
												 <div class="col-xl-8">
												 <?php 
					                              
												   $this->ecc_library->form2('select_pop_line','Nama Karyawan',"form_".$methodid,'karyawan_name','','','get_nama_karyawan','6');
			                                     ?>
												 </div>
												 
												<div class="col-xl-8">
												 <?php 
					                                $this->ecc_library->form2('select_pop_line','Departemen',"form_".$methodid,'karyawan_departemen','','','get_departemen','4');
			                                     ?>
												 </div>
												 
												 <div class="col-xl-8">
												   <div class="form-group form-inline row">
												     <label for="inputPassword6"  class="col-sm-4 col-form-label">Periode  &nbsp </label>
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
														<button type="button" class="btn btn-default" onclick="javascript:search_<?php echo $methodid ?>();">
														<i class="fa fa-search"></i> Search
														</button> 	
														
														&nbsp &nbsp
														<button type="button" class="btn btn-default" id="add_edit" data-bs-toggle="modal" data-bs-target="#form_add_edit">
															<i class="fa fa-search"></i> Add/Edit
														</button>
														
														&nbsp &nbsp
														<button type="button" class="btn btn-default" onclick="javascript:print_<?php echo $methodid ?>_absen_1('pdf');">
															<i class="fa fa-search"></i> Print PDF
														</button>
														
														&nbsp &nbsp
														<button type="button" class="btn btn-default" onclick="javascript:print_<?php echo $methodid ?>('xlsx');">
															<i class="fa fa-search"></i> Print Xlsx
														</button>
														
														
													</div>	
                                                 </div>													
												</form>
											</div>
										</div>
										
									
									
									<div class="row">
							         <div class="col-xl-12">
								        <table id="table_<?php echo $methodid ?>_absen_karyawan"></table>
								        <div id="ptable_<?php echo $methodid ?>"></div>                                                     
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

<!-- dibawah code dari data yang lama untuk proses upload excel -->
<!-- jika tidak digunakan silakan hapus -->

</div>

 <!-- <div id="form_add_edit" class="modal modal-edu-general default-popup-PrimaryModal" role="dialog" > -->
  <div id="form_add_edit" class="modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >

       <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
			 <h6 class="modal-title">.:: Add / Edit Data</h4>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" id="tutup"><span aria-hidden="true">&times;</span></button>
            
            </div>
			 <form class="ui grid ecc_form" id="form_<?php echo $methodid ?>_add_edit_absen" action="javascript:add_<?php echo $methodid ?>_absen()">
            <div class="modal-body">
			 <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
			  <div class="card-body">
               <div class="col-xl-10">
			     <div class="form-group row">
				     <div class="col-sm-4">
					   <?php 
				       $this->ecc_library->form('hidden','',"form_".$methodid,$this->security->get_csrf_token_name(),$this->security->get_csrf_hash());
					    $this->ecc_library->form('hidden','absen_id',"form_".$methodid,'absen_id','','','');
					   $this->ecc_library->form('hidden','tanggal',"form_".$methodid,'tanggal_absen','','','');
				       ?>
					 </div>
				  </div>
			     
				   <div class="form-group row">
				     <div class="col-sm-4">
				        <label for="absen_id" class="control-label">Absen ID</label>
					   </div>
					 <div class="col-sm-6">
					   <input type="text"  id="form_<?php echo $methodid ?>_badgenumber" name="badgenumber" class="form-control" readonly>
					 </div>
				   </div>
				 </div>
				 <div class="col-xl-10">
				   <div class="form-group row">
				    <div class="col-sm-4">
				      <label for="jam_masuk" class="control-label m-6">Jam Masuk</label>
					</div>
					 <div class="col-sm-4">
					   <input type="text"  id="form_<?php echo $methodid ?>_in" name="in" class="form-control" readonly >
					 </div>
				   </div>
				 </div>
				 <div class="col-xl-10">
				   <div class="form-group row">
				      <div class="col-sm-4">
				        <label for="jam_keluar" class="control-label">Jam Keluar</label>
					  </div>
					 <div class="col-sm-4">
					   <input type="text"  id="form_<?php echo $methodid ?>_out" name="out" class="form-control" readonly>
					 </div>
				   </div>
				 </div>
				 <div class="col-xl-10">
				   <div class="form-group row">
				       <div class="col-sm-10">
					  <?php 
					   $this->ecc_library->form('select_pop','Keterangan Absen',"form_".$methodid,'keterangan_absen','','','plh_keterangan_absen');
					   ?>
					 </div>
				   </div>
				 </div>
              </div>
			 </div>
		    </div>
            <div class="modal-footer">
			  <button type="submit" class="btn btn-primary" id="send">Send message</button>
			   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="batal">Close</button>
            </div>
			 </form>
          </div>
        </div>
	  </div>