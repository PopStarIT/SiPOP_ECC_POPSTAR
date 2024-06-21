<div class="row">
	<div class="col-xl-12">     
		<div class="card card-statistics h-100"> 
			<div class="card-body" style="padding: 1.25rem !important">
				<h5 class="card-title form_title_<?php echo $methodid ?>"><?php echo $page_title ?></h5>
			
				<div class="tab tab-border">
					<ul class="nav nav-tabs form_tab_<?php echo $methodid ?>" role="tablist">
						<li class="nav-item">
							<a class="nav-link active show" id="tab_<?php echo $methodid; ?>_header" data-toggle="tab" href="#content_<?php echo $methodid; ?>_header" role="tab" aria-controls="content_<?php echo $methodid; ?>_header" aria-selected="true">
								Karyawan
							</a>	
						</li>
						<li class="nav-item">
							<a class="nav-link" id="tab_<?php echo $methodid; ?>_biodata" data-toggle="tab" href="#content_<?php echo $methodid; ?>_biodata" role="tab" aria-controls="content_<?php echo $methodid; ?>_biodata" aria-selected="true">
							Biodata
							</a>	
						</li>
						<li class="nav-item">
							<a class="nav-link" id="tab_<?php echo $methodid; ?>_keluarga" data-toggle="tab" href="#content_<?php echo $methodid; ?>_keluarga" role="tab" aria-controls="content_<?php echo $methodid; ?>_keluarga" aria-selected="true">
								Keluarga
							</a>	
						</li>
						<li class="nav-item">
							<a class="nav-link" id="tab_<?php echo $methodid; ?>_dokumen" data-toggle="tab" href="#content_<?php echo $methodid; ?>_dokumen" role="tab" aria-controls="content_<?php echo $methodid; ?>_dokumen" aria-selected="true">
								dokumen
							</a>	
						</li>
					</ul>
					
					<div class="tab-content">
					   					
						<div class="tab_custom_ecc tab-pane fade active show" id="content_<?php echo $methodid; ?>_header" role="tabpanel" aria-labelledby="tab_<?php echo $methodid; ?>_header">
							<div class="row">
								<div class="col-xl-12 mb-10 ml-10">
									<form class="ui grid ecc_form" id="form_<?php echo $methodid ?>" action="javascript:post_<?php echo $methodid ?>()" enctype="multipart/form-data" method="post">
										<?php 
											$this->ecc_library->form('hidden','',"form_".$methodid,$this->security->get_csrf_token_name(),$this->security->get_csrf_hash());
											$this->ecc_library->form('hidden','',"form_".$methodid,'karyawan_id','');
											//$this->ecc_library->form('hidden','',"form_".$methodid,'badgenumber','');
										?>
										
										<div class="row">
											<div class="col-xl-4">
											  <div class="row">
											   <div class="col-xl-12">
												<?php 
													$this->ecc_library->form('text','Nama Karyawan',"form_".$methodid,'nama_karyawan','','','');
													
												?>
												</div>
												 <div class="col-xl-8">
												   <?php 
												   	$this->ecc_library->form('text','ID Absen',"form_".$methodid,'badgenumber','','','');
												 	$this->ecc_library->form('select_pop','Status Karyawan',"form_".$methodid,'status_id','','','plh_status');
													$this->ecc_library->form('date','Tanggal Masuk',"form_".$methodid,'date_in','','','');
													$this->ecc_library->form('file_photo','Browse Photo',"form_".$methodid,'link_photo','','','');
													//$this->ecc_library->form('text','nmficture',"form_".$methodid,'nmficture','','','');
													?>
												 </div>
											  </div>
											</div>
											
											<div class="col-xl-4">
												<div class="row">
													<div class="col-xl-8">
														<?php 
														$this->ecc_library->form('select_pop','Gender',"form_".$methodid,'gender_id','','','gender');
														?>
													</div>
													
													<div class="col-xl-12">
														<div class="row">
															<div class="col-xl-6">
																<?php 
														//$this->ecc_library->form('select','Currencies',"form_".$methodid,'currencies_id','','','currencies');	
														$this->ecc_library->form('select_pop','Divisi',"form_".$methodid,'divisi_id','','','plh_divisi');
													    $this->ecc_library->form('text','Email',"form_".$methodid,'email','','','');	
														$this->ecc_library->form('date','Tanggal Keluar',"form_".$methodid,'date_out','','','');
														//echo base_url();
														
												 				?>
														<!--<img src="<?php echo base_url('assets/img/profile/default.jpeg'); ?>" alt="" height="170px" width="150px" class="rouded-circle img-thumbnail mt-2 gbrphoto"  id="gambar">-->
														<img src="<?php echo base_url('assets/img/profile/default.jpeg'); ?>" alt="" height="170px" width="150px" class="rouded-circle img-thumbnail mt-2 gbrphoto"  id="gambar">
															</div>
														</div>
													</div>
												</div>
											</div>
											
											<div class="col-xl-3">
												<?php 
		//$this->ecc_library->form('select','Order Type',"form_".$methodid,'purchase_order_type_id','','','purchase_order_type_purchase');
                                                     $this->ecc_library->form('text','NIK',"form_".$methodid,'nik','','','');
                                                    $this->ecc_library->form('select_pop','Departement',"form_".$methodid,'departement_id','','','plh_departement');
													$this->ecc_library->form('select_pop','Jabatan',"form_".$methodid,'jabatan_id','','','plh_jabatan');
													//$this->ecc_library->form('text','Group / Line',"form_".$methodid,'group','','','');	
                                                    $this->ecc_library->form('select_pop','Group / Line',"form_".$methodid,'group_id','','','plh_group');											    	 $this->ecc_library->form('select_pop','Jam Kerja',"form_".$methodid,'jam_kerja','','','plh_jam');
                                                    $this->ecc_library->form('select_pop','Keterangan Karyawan',"form_".$methodid,'ket_status','','','plh_keterangan');													
												?>
											</div>
										</div>
									</form>
									
									<div class="ui grid form">
										<div class="row field">
											<div class="twelve wide column">
												<button type="button" class="btn btn-success" onclick="save_<?php echo $methodid ?>()">
													<i class="fa fa-save"></i> Save Header
												</button>
												
												<button type="button" class="btn btn-info" onclick="cancel_<?php echo $methodid ?>()">
													<i class="fa fa-arrow-left"></i> Back
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						 <div class="tab_custom_ecc tab-pane fade" id="content_<?php echo $methodid; ?>_biodata" role="tabpanel" aria-labelledby="tab_<?php echo $methodid; ?>_biodata">
							<div class="row panel_<?php echo $methodid ?>_panel_biodata">
								<div class="col-xl-12">
								 <form class="ui grid ecc_form" id="form_<?php echo $methodid ?>_biodata" action="javascript:add_<?php echo $methodid ?>_biodata()">
										<?php 
											$this->ecc_library->form('hidden','',"form_".$methodid."_karyawan_biodata",$this->security->get_csrf_token_name(),$this->security->get_csrf_hash());
											$this->ecc_library->form('hidden','',"form_".$methodid."_biodata",'karyawan_id','');
											$this->ecc_library->form('hidden','',"form_".$methodid,'biodata_id','');
										?>							
										<div class="row">
											<div class="col-xl-4">
											  <div class="row">
											  
												 <div class="col-xl-8">
												   <?php 
												  
													$this->ecc_library->form('select_pop','Agama',"form_".$methodid,'agama_id','','','plh_agama');
													$this->ecc_library->form('select_pop','Status Nikah',"form_".$methodid,'nikah_id','','','plh_nikah');
													$this->ecc_library->form('text','Nomor NPWP',"form_".$methodid,'no_npwp','','','');
													 
													?>
												 </div>
												  <div class="col-xl-12">
												  <?php
												  $this->ecc_library->form('text','Alamat',"form_".$methodid,'alamat','','','');
												  ?>
												</div>
												 <div class="col-xl-8">
												   <?php
												 $this->ecc_library->form('text','Kecamatan',"form_".$methodid,'kecamatan','','','');
												 $this->ecc_library->form('text','Nomor Hp',"form_".$methodid,'no_hp','','','');
												 $this->ecc_library->form('text','Nomor Hp (Alternatif)',"form_".$methodid,'handphone2','','','');
												  ?>
												 </div>
											  </div>
											</div>
											
											<div class="col-xl-4">
												<div class="row">
													<div class="col-xl-8">
														<?php 
														 $this->ecc_library->form('text','Tempat Lahir',"form_".$methodid,'tempat_lahir','','','');
														 $this->ecc_library->form('text','Nomor KTP',"form_".$methodid,'no_ktp','','','');
														  $this->ecc_library->form('text','Pendidikan',"form_".$methodid,'pendidikan','','','');
														?>
													</div>										
													<div class="col-xl-12">
														<div class="row">
															<div class="col-xl-6">
																<?php 
														  $this->ecc_library->form('text','RT',"form_".$methodid,'rt','','','');
														  $this->ecc_library->form('text','Kota',"form_".$methodid,'kota','','','');
														  $this->ecc_library->form('text','Nama Ibu',"form_".$methodid,'nama_ibu','','','');
												 				?>
															</div>
															<div class="col-xl-6">
																<?php 
														  $this->ecc_library->form('text','RW',"form_".$methodid,'rw','','','');
														  $this->ecc_library->form('text','Provinsi',"form_".$methodid,'provinsi','','','');
														  $this->ecc_library->form('text','Nama Bapak',"form_".$methodid,'nama_bapak','','','');
												 				?>
															</div>
												
														</div>
													</div>
													<div class="col-xl-8">
														<?php 
														 
														?>
													</div>		
												</div>
											</div>
											
											<div class="col-xl-3">
												<?php 
		
                                                    $this->ecc_library->form('date','Tanggal Lahir',"form_".$methodid,'tanggal_lahir','','','');                                                    $this->ecc_library->form('text','Nomor Kartu Keluarga',"form_".$methodid,'no_kk','','','');
													$this->ecc_library->form('text','Jurusan',"form_".$methodid,'jurusan','','','');
													$this->ecc_library->form('text','Kelurahan',"form_".$methodid,'kelurahan','','','');
													$this->ecc_library->form('text','Kode Pos',"form_".$methodid,'kode_pos','','','');
													$this->ecc_library->form('text','Alamat Lain',"form_".$methodid,'alamat_lain','','','');
												?>
											</div>
										</div>
									</form>
									
									<div class="ui grid form">
										<div class="row field">
											<div class="twelve wide column">
												<button type="button" class="btn btn-success" onclick="save_<?php echo $methodid ?>_biodata()">
													<i class="fa fa-save"></i> Save Biodata
												</button>
												
											<!--	<button type="button" class="btn btn-info" onclick="cancel_<?php //echo $methodid ?>()">
													<i class="fa fa-arrow-left"></i> Back
												</button> -->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
					<div class="tab_custom_ecc tab-pane fade" id="content_<?php echo $methodid; ?>_keluarga" role="tabpanel" aria-labelledby="tab_<?php echo $methodid; ?>_keluarga">
							<div class="row panel_<?php echo $methodid ?>_panel_keluarga">
								<div class="col-xl-12">
									<form class="ui grid ecc_form" id="form_<?php echo $methodid ?>_keluarga" action="javascript:add_<?php echo $methodid ?>_keluarga()">
										<div class="row">
											<div class="col-xl-9">
												<div class="row">
													<div class="col-xl-5">
														<?php
										     $this->ecc_library->form('hidden','',"form_".$methodid."_karyawan_keluarga",$this->security->get_csrf_token_name(),$this->security->get_csrf_hash());
											$this->ecc_library->form('hidden','',"form_".$methodid."_keluarga",'karyawan_id','','','');
											$this->ecc_library->form('hidden','',"form_".$methodid,'keluarga_id','','','');
											$this->ecc_library->form('text','Nama Keluarga',"form_".$methodid."_keluarga",'nama_keluarga','','','');
														?>
													</div>
													
													<div class="col-xl-4">
														<?php
											$this->ecc_library->form('select_pop','Status Keluarga',"form_".$methodid."_keluarga",'status_keluarga_id','','','plh_status_keluarga');
														?>
													</div>
													
													
													<div class="col-xl-3">
														<?php
													$this->ecc_library->form('select_pop','Gender',"form_".$methodid."_keluarga",'gender_keluarga','','','gender');
													//$this->ecc_library->form('select_pop','Gender',"form_".$methodid,'pilih_id','','','gender');
														?>
													</div>
														
													<div class="col-xl-3">
														<?php
															$this->ecc_library->form('text','Pekerjaan',"form_".$methodid."_keluarga",'pekerjaan','','','');
														?>
													</div>
													
													<div class="col-xl-3">
														<?php
	                                         
											  $this->ecc_library->form('text','Pendidikan',"form_".$methodid."_keluarga",'pendidikan','','','');
												     ?>
													</div>
													<div class="col-xl-3">
														<?php
															$this->ecc_library->form('text','Tempat lahir',"form_".$methodid."_keluarga",'tempat_lahir_keluarga','','','');
														?>
													</div>
													
													<div class="col-xl-3">
														<?php
														$this->ecc_library->form('date','Tanggal Lahir',"form_".$methodid."_keluarga",'tanggal_lahir_keluarga','','','');
														?>
													</div>
											
												</div>
											</div>
											
											<div class="col-xl-3">
												<label> &nbsp </label>
												<div class="input-group">
													<div class="button_<?php echo $methodid ?>_keluarga_new" style="display:none">
														<button type="submit" class="btn btn-success">
															<i class="fa fa-plus"></i> ADD
														</button>
													</div>
													
													<div class="button_<?php echo $methodid ?>_keluarga_edit" style="display:none">
														<button type="submit" class="btn btn-success">
															<i class="fa fa-check"></i> SAVE
														</button>
														
														<a class="btn btn-danger" onclick="javascript:cancel_keluarga_<?php echo $methodid ?>()">
															<i class="fa fa-times"></i> CANCEL
														</a>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
							
							<div class="row panel_<?php echo $methodid ?>_panel_purchase_request mb-10" >
								<div class="col-xl-12">
									<?php 
									//	$extra_field = array();
									//	$extra_field[] = array('field' => 'purchase_order_id','form_id' => 'form_'. $methodid .'_detail_purchase_order_id');
									//	$extra_field[] = array('field' => 'purchase_order_detail_id','form_id' => 'form_'. $methodid .'_detail_purchase_order_detail_id');
									//	$extra_param = array('methodid'=> $methodid,'beforeclick'=> 'beforeclick_'.$methodid."_purchase_request",'extra_param' => $extra_field);
									//	$this->ecc_library->jqgrid($methodid."_purchase_request", $dashboard_table['field_purchase_request'], $dashboard_table['field_purchase_request_loaddata'],$extra_param); 
									$extra_field = array();
									$extra_field[] = array('field' => 'karyawan_id','form_id' => 'form_'. $methodid .'_detail_karyawan_id');
									$extra_field[] = array('field' => 'biodata_id','form_id' => 'form_'. $methodid .'_detail_biodata_id');
									$extra_field[] = array('field' => 'keluarga_id','form_id' => 'form_'. $methodid .'_detail_keluarga_id');
									$extra_field[] = array('field' => 'dokumen_id','form_id' => 'form_'. $methodid .'_detail_dokumen_id');
									$extra_param = array('methodid'=> $methodid,'beforeclick'=> 'beforeclick_'.$methodid."_purchase_request",'extra_param' => $extra_field);
									?>
								</div>
							</div> 
							
							<div class="row">
								<div class="col-xl-12">
									<?php 
								//	print_r($dashboard_table);
										$extra_param = array('methodid'=> $methodid,'extra_param' => array(0 => array('field' => 'karyawan_id','form_id' => 'form_'. $methodid .'_keluarga_karyawan_id')));
										$this->ecc_library->jqgrid($methodid."_keluarga", $dashboard_table['field_keluarga'], $dashboard_table['field_keluarga_loaddata'],$extra_param); 
									?>
								</div>
							</div>
						</div>
						
				<div class="tab_custom_ecc tab-pane fade" id="content_<?php echo $methodid; ?>_dokumen" role="tabpanel" aria-labelledby="tab_<?php echo $methodid; ?>_dokumen">
							<div class="row panel_<?php echo $methodid ?>_panel_dokumen">
								<div class="col-xl-12">
									<form class="ui grid ecc_form" id="form_<?php echo $methodid ?>_dokumen" action="javascript:add_<?php echo $methodid ?>_dokumen()">
										<div class="row">
											<div class="col-xl-9">
												<div class="row">
													<div class="col-xl-5">
														<?php
										$this->ecc_library->form('hidden','',"form_".$methodid."_karyawan_dokumen",$this->security->get_csrf_token_name(),$this->security->get_csrf_hash());
											$this->ecc_library->form('hidden','',"form_".$methodid."_dokumen",'karyawan_id','','','');
											$this->ecc_library->form('hidden','',"form_".$methodid,'dokumen_id','','','');
											$this->ecc_library->form('hidden','',"form_".$methodid,'alamat_dok','','','');
											$this->ecc_library->form('select_pop','Nama Dokumen',"form_".$methodid,'nama_dokumen','','','plh_dokumen');
													?>
													</div>
													
													<div class="col-xl-6">
														<?php
										  	$this->ecc_library->form('file','Cari Dokumen',"form_".$methodid,'lokasi_dokumen','','','');
														?>
													</div>
													
													
													<div class="col-xl-3">
														<?php
											$this->ecc_library->form('text','Keterangan',"form_".$methodid."_dokumen",'keterangan_dokumen','','','');
													//$this->ecc_library->form('select_pop','Gender',"form_".$methodid,'pilih_id','','','gender');
														?>
													</div>
												
												</div>
											</div>
											
											<div class="col-xl-3">
												<label> &nbsp </label>
												<div class="input-group">
													<div class="button_<?php echo $methodid ?>_dokumen_new" style="display:none">
														<button type="submit" class="btn btn-success">
															<i class="fa fa-plus"></i> ADD
														</button>
													</div>
													
													<div class="button_<?php echo $methodid ?>_dokumen_edit" style="display:none">
														<button type="submit" class="btn btn-success">
															<i class="fa fa-check"></i> SAVE
														</button>
														
														<a class="btn btn-danger" onclick="javascript:cancel_dokumen_<?php echo $methodid ?>()">
															<i class="fa fa-times"></i> CANCEL
														</a>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
							
													
							<div class="row">
								<div class="col-xl-12">
										<?php 
								//	print_r($dashboard_table);
										$extra_param = array('methodid'=> $methodid,'extra_param' => array(0 => array('field' => 'karyawan_id','form_id' => 'form_'. $methodid .'_dokumen_karyawan_id')));
										$this->ecc_library->jqgrid($methodid."_dokumen", $dashboard_table['field_dokumen'], $dashboard_table['field_dokumen_loaddata'],$extra_param); 
									?>
								</div>
							</div>
						</div>
					</div>
					
					<div class="modal fade" id="gbr_dokumen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog modal-xl" role="document" >
					   <div class="modal-content">
                         <div class="modal-header">
						     <h4 class="modal-title" id="myModalLabel">Preview Image</h4>
						 </div>
						 <div class="modal-body">
						   						
							<img src="./assets/img/profile/ekonomi Bulolo/dokumen/072917_Dokumen Lain_20220221-020355.jpg" class="img-fluid">
							
						 </div>
						</div>
					  </div>
				   </div>
				   
				   <div class="modal fade modalPalingBesar" id="gbr_dokumen2" tabindex="-1" role="dialog" aria-hidden="true">
                     <div class="modal-dialog modal-xl">
                       
                       <div class="modal-content">
                         <div class="modal-header">
                           <h5>Preview</h5>
                         </div>
                         <div class="modal-body" id="modal_gbr">
                        <!--<img src="./assets/img/profile/ekonomi Bulolo/dokumen/050957_KTP_1644884239_3b035d0c146004e27195.jpg" class="img-fluid"> -->
                         </div>
                       </div>
                     
                     </div>
                   </div>
					
					
				</div>
			</div>
		</div>   
	</div>
</div>