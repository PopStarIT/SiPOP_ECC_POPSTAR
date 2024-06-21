<div class="row">
	<div class="col-xl-12">     
		<div class="card card-statistics h-100"> 
			<div class="card-body" style="padding: 1.25rem !important">
				<h5 class="card-title form_title_<?php echo $methodid ?>"><?php echo $page_title ?></h5>
			  <div class="card">
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
												    $this->ecc_library->form('select_pop','Status Karyawan',"form_".$methodid,'status_id','','','plh_status');
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
													  	//echo base_url();
														
												 				?>
														<!--<img src=" echo base_url('assets/img/profile/default.jpeg'); ?>" alt="" height="170px" width="150px" class="rouded-circle img-thumbnail mt-2 gbrphoto"  id="gambar">-->
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
													//$this->ecc_library->form('text','Group / Line',"form_".$methodid,'group','','','');	
                                                 													
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
			</div>
		</div>   
	</div>
</div>