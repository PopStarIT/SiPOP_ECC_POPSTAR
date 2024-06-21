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
								
								     <div class="tab tab-border">
											<ul class="nav nav-tabs form_tab_<?php echo $methodid ?>" role="tablist">
											    <li class="nav-item">
													<a class="nav-link" id="tab_<?php echo $methodid; ?>_outgoing" data-toggle="tab" href="#content_<?php echo $methodid; ?>_dashboard" role="tab" aria-controls="content_<?php echo $methodid; ?>_dashboard" aria-selected="true">
														<i class="fa fa-file"></i> Dashboard
													</a>	
												</li>
											
												<li class="nav-item">
													<a class="nav-link active show" id="tab_<?php echo $methodid; ?>_attendance" data-toggle="tab" href="#content_<?php echo $methodid; ?>_attendance" role="tab" aria-controls="content_<?php echo $methodid; ?>_attendance" aria-selected="true">
														<i class="fa fa-calendar-o"></i> Attendance
													</a>	
												</li>
												
												<li class="nav-item">
													<a class="nav-link" id="tab_<?php echo $methodid; ?>_report" data-toggle="tab" href="#content_<?php echo $methodid; ?>_report" role="tab" aria-controls="content_<?php echo $methodid; ?>_report" aria-selected="true">
														<i class="fa fa-file"></i> Report
													</a>	
												</li>

												
											</ul>
										</div>
									<div class="tab-content">
									<div  class="tab-pane collapse show" data-parent="#accordion" id="content_<?php echo $methodid; ?>_dashboard" role="tabpanel"  aria-labelledby="tab_<?php echo $methodid; ?>_dashboard">
									<div class="row">
		                               <div class="col-xl-12">
			                             <div class="tab tab-border">
										   <div class="tab-content">
										    <div class="tab_custom_ecc tab-pane fade active show" id="content_M" role="tabpanel">
											
											 <div class="row">
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
											</div>
											
										     <div class="row">
									          <div class="col-xl-3 col-lg-6 col-md-6">
										        <a href="#" class="tile tile-danger tile-valign" data-toggle="modal" data-target="#view_modal">
												<div class="att att-absen">M-Absen Tanpa keterangan</div>
												<span class="fa fa-bed"></span>
												<div class="att att-absen dir-att">30</div>
												</a>
									          </div>
											  
											   <div class="col-xl-3 col-lg-6 col-md-6">
										        <a href="#" class="tile tile-success tile-valign" >
												<div class="att att-absen">S-Sakit</div>
												<span class="fa fa-hospital-o"></span>
												<div class="att att-absen dir-att">20</div>
												</a>
									          </div>
											  
											   <div class="col-xl-3 col-lg-6 col-md-6">
										        <a href="#" class="tile tile-info tile-valign">
												<div class="att att-absen">CT-Cuti</div>
												<span class="fa fa-handshake-o"></span>
												<div class="att att-absen dir-att">40</div>
												</a>
									           </div>
											  
											   <div class="col-xl-3 col-lg-6 col-md-6">
										        <a href="#" class="tile tile-warnalain tile-valign">
												<div class="att att-absen">CL-Cuti Melahirkan</div>
												<span class="fa fa-medkit"></span>
												<div class="att att-absen dir-att">40</div>
												</a>
									           </div>
											  
											  </div>
											 </div>
											 
											
										   </div>
										  </div>
									    </div>
									  </div>
									</div>
									 <!-- <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion" > -->
									<div  class="tab-pane fade active show" id="content_<?php echo $methodid; ?>_attendance" role="tabpanel" aria-labelledby="tab_<?php echo $methodid; ?>_attendance">
											<div class="card-body">
												<!-- <form class="form-inline" id="form_echo $methodid ?>"> -->
												 <form class="ui grid ecc_form" id="form_echo $methodid ?>">
																					 
												 <div class="col-xl-8">
												 <?php 
					                              
												   $this->ecc_library->form2('select_pop_line','Employee Name',"form_".$methodid,'karyawan_name','','','get_nama_karyawan','6');
			                                     ?>
												 </div>
												 
												<div class="col-xl-8">
												 <?php 
					                                $this->ecc_library->form2('select_pop_line','Departement',"form_".$methodid,'karyawan_departemen','','','get_departemen','4');
			                                     ?>
												 </div>
												 
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
														<button type="button" class="btn btn-default" onclick="javascript:print_<?php echo $methodid ?>_absen_1('xlsx');">
															<i class="fa fa-search"></i> Print Xlsx
														</button>
														
														&nbsp &nbsp
														<button type="button" class="btn btn-default" onclick="javascript:print_periode_<?php echo $methodid ?>('xlsx');">
															<i class="fa fa-search"></i> Print per Periode Xlsx
														</button>
														
														
													</div>	
                                                 </div>													
												</form>
											</div>
																								
									     <div class="row">
							                <div class="col-xl-12">
								             <table id="table_<?php echo $methodid ?>_absen_karyawan"></table>
								             <div id="ptable_<?php echo $methodid ?>"></div>                                                     
							               </div>
						                 </div>
								        <br />
								   	</div>
									
								   <div  class="tab-pane collapse show" id="content_<?php echo $methodid; ?>_report" role="tabpanel"  aria-labelledby="tab_<?php echo $methodid; ?>_report">  
								    <div class="card-body">
									   <form class="ui grid ecc_form" id="form_echo $methodid ?>_report">
								 
												<div class="col-xl-8 ">
												 <?php 
					                                $this->ecc_library->form2('select_pop_line','Departement',"form_".$methodid,'karyawan_departemen1','','','get_departemen_1','3');
			                                     ?>
												 </div>
												 <div class="col-xl-8">
												 <?php 
					                                $this->ecc_library->form2('select_pop_line','Divisi',"form_".$methodid,'karyawan_divisi','','','get_divisi_1','4');
			                                     ?>
												 </div>
												  <div class="col-xl-8">
												 <?php 
					                                $this->ecc_library->form2('select_pop_line','Sub Divisi',"form_".$methodid,'karyawan_sub_divisi','','','get_group_1','3');
			                                     ?>
												 </div>
												   <div class="col-xl-8">
												 <?php 
					                                $this->ecc_library->form2('select_pop_line','working time',"form_".$methodid,'karyawan_lama_kerja','','','get_tahun','3');
			                                     ?>
												 </div>
												 
												 <div class="col-xl-8">
												   <div class="form-group form-inline row">
												     <label for="inputPassword6"  class="col-sm-4 col-form-label">Periode  &nbsp </label>
													   <div class="col-xl-4 input-group">
															<div class="input-group-prepend">
																<span class="input-group-text"><i class="fa fa-calendar"></i></span>
															</div>
															<input class="form-control" id="form_<?php echo $methodid ?>_date_start"  name="date_start" type="text" value="<?php echo date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) ) ?>" />
														</div>
														
														
														
														<div class="col-xl-4 input-group">
														 S/D &nbsp &nbsp
															<div class="input-group-prepend">
																<span class="input-group-text"><i class="fa fa-calendar"></i></span>
															</div>
															<input class="form-control" id="form_<?php echo $methodid ?>_date_end"  name="date_end" type="text" value="<?php echo date("Y-m-d") ?>" />
														</div>
													</div>																								
												 </div>
												 <div class="col-xl-10">
													<div class="form-group form-inline row">
														<button type="button" class="btn btn-default" onclick="javascript:search_report_<?php echo $methodid ?>();">
														<i class="fa fa-search"></i> Search
														</button> 	
																												
														&nbsp &nbsp
														<button type="button" class="btn btn-default" onclick="javascript:print_report_<?php echo $methodid ?>('xlsx');">
															<i class="fa fa-search"></i> Print Xlsx
														</button>
														
														
													</div>	
                                                 </div>													
												</form>
												
												  <div class="row">
							                        <div class="col-xl-12">
								                       <table id="table_<?php echo $methodid ?>_report_absen"></table>
								                       <div id="ptable_<?php echo $methodid ?>_report_absen"></div>                                                     
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
					   <input type="text"  id="form_<?php echo $methodid ?>_in" name="in" class="form-control">
					 </div>
				   </div>
				 </div>
				 <div class="col-xl-10">
				   <div class="form-group row">
				      <div class="col-sm-4">
				        <label for="jam_keluar" class="control-label">Jam Keluar</label>
					  </div>
					 <div class="col-sm-4">
					   <input type="text"  id="form_<?php echo $methodid ?>_out" name="out" class="form-control">
					 </div>
				   </div>
				 </div>
				 <div class="col-xl-10">
				   <div class="form-group row">
				       <div class="col-sm-10">
					  <?php 
					    //$this->ecc_library->form('select_pop','Keterangan Absen',"form_".$methodid,'keterangan_absen','','','plh_keterangan_absen');
					    $this->ecc_library->form2('select_pop_line','Keterangan',"form_".$methodid,'keterangan_absen','','','get_keterangan_absen','8');
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
	  
	<div class="modal fade" id="view_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
		  <form class="ui grid ecc_form" id="form_<?php echo $methodid ?>_modal_coba" action="javascript:addx_<?php echo $methodid ?>_absen()">
            <div class="form-group row">
				     <div class="col-sm-4">
				        <label for="absen_id" class="control-label">Absen ID</label>
					   </div>
					 <div class="col-sm-6">
					   <input type="text"  id="form_<?php echo $methodid ?>_badgenumber3" name="badgenumber3" class="form-control" >
					 </div>
		    </div>
			</form>
			
			  <div class="row">
                <div class="col-xl-12">
                 <table id="table_<?php echo $methodid ?>_report_absen_keterangan"></table>
                 <div id="ptable_<?php echo $methodid ?>_report_absen_keterangan"></div>                                                     
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
   </div>
	  
	<div id="view_modalxx" class="modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
       <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
			 <h6 class="modal-title">.:: Add / Edit Data</h4>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" id="tutup2"><span aria-hidden="true">&times;</span></button>
            
            </div>
			 <form class="ui grid ecc_form" id="form_<?php echo $methodid ?>_add_edit_absenx" action="javascript:addx_<?php echo $methodid ?>_absen()">
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
					   <input type="text"  id="form_<?php echo $methodid ?>_badgenumber4" name="badgenumber4" class="form-control">
					 </div>
				   </div>
				 </div>
				 <div class="col-xl-10">
				   <div class="form-group row">
				    <div class="col-sm-4">
				      <label for="jam_masuk" class="control-label m-6">Jam Masuk</label>
					</div>
					 <div class="col-sm-4">
					   <input type="text"  id="form_<?php echo $methodid ?>_in" name="in" class="form-control">
					 </div>
				   </div>
				 </div>
				 <div class="col-xl-10">
				   <div class="form-group row">
				      <div class="col-sm-4">
				        <label for="jam_keluar" class="control-label">Jam Keluar</label>
					  </div>
					 <div class="col-sm-4">
					   <input type="text"  id="form_<?php echo $methodid ?>_out" name="out" class="form-control">
					 </div>
				   </div>
				 </div>
				 <div class="col-xl-10">
				   <div class="form-group row">
				       <div class="col-sm-10">
					  <?php 
					    //$this->ecc_library->form('select_pop','Keterangan Absen',"form_".$methodid,'keterangan_absen','','','plh_keterangan_absen');
					    $this->ecc_library->form2('select_pop_line','Keterangan',"form_".$methodid,'keterangan_absen','','','get_keterangan_absen','8');
					   ?>
					 </div>
				   </div>
				 </div>
              </div>
			 </div>
		    </div>
            <div class="modal-footer">
			   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="batal2">Close</button>
            </div>
			 </form>
          </div>
        </div>
	  </div>