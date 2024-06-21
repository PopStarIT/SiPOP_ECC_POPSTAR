<div class="row">
	<div class="col-xl-12">     
		<div class="card card-statistics h-100"> 
			<div class="card-body" style="padding: 1.25rem !important">
				<h5 class="card-title form_title_<?php echo $methodid ?>"><?php echo $page_title ?></h5>
				<ul class="nav nav-tabs form_tab_<?php echo $methodid ?>" role="tablist">
					<li class="nav-item">
						<a class="nav-link active show" id="tab_<?php echo $methodid; ?>_header" data-toggle="tab" href="#content_<?php echo $methodid; ?>_header" role="tab" aria-controls="content_<?php echo $methodid; ?>_header" aria-selected="true">
							Header
						</a>	
					</li>
					
					<li class="nav-item">
						<a class="nav-link" id="tab_<?php echo $methodid; ?>_detail" data-toggle="tab" href="#content_<?php echo $methodid; ?>_detail" role="tab" aria-controls="content_<?php echo $methodid; ?>_detail" aria-selected="true">
							Detail
						</a>	
					</li>
				</ul>
					
				<div class="tab-content">
					<div class="tab_custom_ecc tab-pane fade active show" id="content_<?php echo $methodid; ?>_header" role="tabpanel" aria-labelledby="tab_<?php echo $methodid; ?>_header">
						<div class="row">
							<div class="col-xl-12 mb-10 ml-10">
								<form class="ui grid ecc_form" id="form_<?php echo $methodid ?>" action="javascript:post_<?php echo $methodid ?>()">
									<?php 
										$this->ecc_library->form('hidden','',"form_".$methodid,$this->security->get_csrf_token_name(),$this->security->get_csrf_hash());
										$this->ecc_library->form('hidden','',"form_".$methodid,'bom_id','');										
									?>
									<div class="row">
											<div class="col-xl-4">
												<div class="row">
													<div class="col-xl-12">
														<?php 
															$this->ecc_library->form('text','Bom Code',"form_".$methodid,'bom_code','','','');
														?>
													</div>
													
													<div class="col-xl-12">
														<?php 
															$this->ecc_library->form('text','Bom Name',"form_".$methodid,'bom_name','','','');						
														?>
													</div>
												</div>
											</div>
											
											<div class="col-xl-7">
												<div class="row">
													<div class="col-xl-12">
														<?php 
															$this->ecc_library->form('select','Finish Good / Semi Finish Good',"form_".$methodid,'fg_item_id','','','manufacture_item');						
														?>
													</div>
												</div>
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
					
					<div class="tab_custom_ecc tab-pane fade" id="content_<?php echo $methodid; ?>_detail" role="tabpanel" aria-labelledby="tab_<?php echo $methodid; ?>_detail">
						<div class="row">
							<div class="col-xl-12">
								<form class="ui grid ecc_form" id="form_<?php echo $methodid ?>_detail" action="javascript:add_<?php echo $methodid ?>()">
								
									<div class="row">
										<div class="col-xl-9">
											<div class="row">
												<div class="col-xl-4">
												 <div class="row">
												  <div class="col-xl-12">
													<?php	
                                                       // print_r($methodid);												
														$this->ecc_library->form('hidden','',"form_".$methodid."_detail",$this->security->get_csrf_token_name(),$this->security->get_csrf_hash());
														$this->ecc_library->form('hidden','',"form_".$methodid."_detail",'bom_detail_id','','','');
														$this->ecc_library->form('hidden','',"form_".$methodid."_detail",'bom_id','','','');
														$this->ecc_library->form('select','Raw Material',"form_".$methodid."_detail",'mat_item_id','','','item_detail');
													?>
												   </div>
												    <div class="col-xl-12">
														<?php
													$this->ecc_library->form('readonly','Category',"form_".$methodid."_category",'mat_category_id','','','get_mat_category_id',array('extra_param' => array(0 => array('field' => 'mat_category_id' ))));
														?>
													</div>
												 </div>
												</div>
												
												<div class="col-xl-4">
												  <div class="row">
												   <div class="col-xl-12">
													<?php
														$this->ecc_library->form('text','Quantity',"form_".$methodid."_detail",'mat_quantity','','','');
													?>
												  </div>
												   <div class="col-xl-12">
												     <?php
												 	$this->ecc_library->form('readonly','Asset',"form_".$methodid."_detail",'mat_asset_id','','','get_mat_item_id',array('extra_param' => array(0 => array('field' => 'mat_item_id' ))));
													$this->ecc_library->form('readonly','stock',"form_".$methodid."_detail",'mat_keluar','','','get_mat_keluar_id',array('extra_param' => array(0 => array('field' => 'mat_item_id' ))));
														?>
												   </div>
												   
												 </div>
											  </div>
										   </div>
										</div>
										
										<div class="col-xl-3">
											<label> &nbsp </label>
											<div class="input-group">
												<div class="button_<?php echo $methodid ?>_detail_new" style="display:none">
													<button type="submit" class="btn btn-success">
														<i class="fa fa-plus"></i> ADD
													</button>
												</div>
												
												<div class="button_<?php echo $methodid ?>_detail_edit" style="display:none">
													<button type="submit" class="btn btn-success">
														<i class="fa fa-check"></i> SAVE
													</button>
													
													<a class="btn btn-danger" onclick="javascript:cancel_detail_<?php echo $methodid ?>()">
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
								
									$extra_param = array('methodid'=> $methodid,'extra_param' => array(0 => array('field' => 'bom_id','form_id' => 'form_'. $methodid .'_detail_bom_id')));
									$this->ecc_library->jqgrid($methodid."_detail", $dashboard_table['field_detail'], $dashboard_table['field_detail_loaddata'],$extra_param); 
										//print_r($extra_param);
								?>
							</div>
						</div>
						<script type="text/javascript">
                        //
						//		$('#form_<?php echo $methodid ?>_detail_mat_item_id').on('change', function(){
                        //            var item_id = $(this). children("option:selected"). val();
                         //          // alert(item_id)
                        //        });
                          
                          
                       </script>
					</div>
				</div>
				
			</div>
		</div>   
	</div>
</div>



