<div class="container-fluid">
	<div id="panel_content_<?php echo $methodid ?>">
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
													<a class="nav-link active show" id="tab_<?php echo $methodid; ?>_stock" data-toggle="tab" href="#content_<?php echo $methodid; ?>_stock" role="tab" aria-controls="content_<?php echo $methodid; ?>_stock" aria-selected="true">
														<i class="fa fa-cog"></i> Stock
													</a>	
												</li>
												
												<li class="nav-item">
													<a class="nav-link" id="tab_<?php echo $methodid; ?>_incoming" data-toggle="tab" href="#content_<?php echo $methodid; ?>_incoming" role="tab" aria-controls="content_<?php echo $methodid; ?>_incoming" aria-selected="true">
														<i class="fa fa-cog"></i> Incoming
													</a>	
												</li>

												<li class="nav-item">
													<a class="nav-link" id="tab_<?php echo $methodid; ?>_outgoing" data-toggle="tab" href="#content_<?php echo $methodid; ?>_outgoing" role="tab" aria-controls="content_<?php echo $methodid; ?>_outgoing" aria-selected="true">
														<i class="fa fa-cog"></i> Outgoing
													</a>	
												</li>
											</ul>
										</div>
										
										<div class="tab-content">
											<div class="tab-pane fade active show" id="content_<?php echo $methodid; ?>_stock" role="tabpanel" aria-labelledby="tab_<?php echo $methodid; ?>_stock">
												<div class="row">
													<div class="col-xl-12">
														<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
															<div class="card-body">
																<form class="ui grid ecc_form" id="form_<?php echo $methodid ?>_assets">
																	<div class="form-group">
																		<div class="col-xl-12">
																			<?php 	
																				$this->ecc_library->form('select','Item Category :',"form_".$methodid,'item_category_id','','','item_category');	
																			?>
																		</div>
																	</div>  
																</form>
																<button type="button" class="btn btn-default" onclick="javascript:print_<?php echo $methodid ?>_asset('xlsx');">
																	<i class="fa fa-search"></i> Print Xlsx
																</button>
															</div>
														</div>
													</div>
												</div>
												
												<div class="row mb-10 ml-10">
													<div class="col-xl-12">
														<?php 
															$extra_field = array();
															$extra_field[] = array('field' => 'item_category_id','form_id' => 'form_'. $methodid .'_item_category_id');
															$extra_param = array('methodid'=> $methodid,'extra_param' => $extra_field);
															$this->ecc_library->jqgrid($methodid."_asset", $dashboard_table['field_asset'], $dashboard_table['field_asset_loaddata'],$extra_param); 
														?>
													</div>
												</div>
											</div>
											
											<div class="tab-pane fade" id="content_<?php echo $methodid; ?>_incoming" role="tabpanel" aria-labelledby="tab_<?php echo $methodid; ?>_incoming">
												<div class="row">
												   <div class="col-xl-12">
													  <form class="ui grid ecc_form" id="form_<?php echo $methodid ?>_incoming">
														 <div class="form-group">
															<div class="col-xl-12">
															   <?php 	
																  $this->ecc_library->form('select','Item :',"form_".$methodid,'item_id_incoming','','','get_item_detail');	
															   ?>
															</div>
														 </div>  
													  </form>
													  <button type="button" class="btn btn-default" onclick="javascript:print_<?php echo $methodid ?>_incoming('xlsx');">
														<i class="fa fa-search"></i> Print Xlsx
													  </button>
												   </div>
												</div>
												
												<div class="row mb-10 ml-10">
													<div class="col-xl-12">
														<?php 
															$extra_field = array();
															$extra_field[] = array('field' => 'item_id','form_id' => 'form_'. $methodid .'_item_id_incoming');
															$extra_param = array('methodid'=> $methodid,'footer_data'=> true,'extra_param' => $extra_field);
															$this->ecc_library->jqgrid($methodid."_incoming", $dashboard_table['field_incoming'], $dashboard_table['field_incoming_loaddata'],$extra_param); 
														?>
													</div>
												</div>
											 </div>
											 
											 <div class="tab-pane fade" id="content_<?php echo $methodid; ?>_outgoing" role="tabpanel" aria-labelledby="tab_<?php echo $methodid; ?>_outgoing">
												<div class="row">
												   <div class="col-xl-12">
													  <form class="ui grid ecc_form" id="form_<?php echo $methodid ?>_outgoing">
														 <div class="form-group">
															<div class="col-xl-12">
															   <?php 	
																  $this->ecc_library->form('select','Item :',"form_".$methodid,'item_id_outgoing','','','get_item_detail');	
															   ?>
															</div>
														 </div>  
													  </form>
													  <button type="button" class="btn btn-default" onclick="javascript:print_<?php echo $methodid ?>_outgoing('xlsx');">
														<i class="fa fa-search"></i> Print Xlsx
													  </button>
												   </div>
												</div>
												
												<div class="row mb-10 ml-10">
													<div class="col-xl-12">
														<?php 
															$extra_field = array();
															$extra_field[] = array('field' => 'item_id','form_id' => 'form_'. $methodid .'_item_id_outgoing');
															$extra_param = array('methodid'=> $methodid,'footer_data'=> true,'extra_param' => $extra_field);
															$this->ecc_library->jqgrid($methodid."_outgoing", $dashboard_table['field_outgoing'], $dashboard_table['field_outgoing_loaddata'],$extra_param); 
														?>
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
	
	<div id="panel_print_<?php echo $methodid ?>" style="display:none"></div>
	
	<form id="form_<?php echo $methodid ?>_print" action="<?php echo base_url() . $class_uri ?>/loaddata" method="POST" target="panel_print_<?php echo $methodid ?>" style="display:none">
		<input type="hidden" id="form_<?php echo $methodid ?>_print_csrf" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>" />
		<input type="hidden" id="form_<?php echo $methodid ?>_print_date_start" name="date_start" value="" />
		<input type="hidden" id="form_<?php echo $methodid ?>_print_date_end" name="date_end" value="" />
		<input type="hidden" id="form_<?php echo $methodid ?>_print_format" name="format" value="" />
		<input type="hidden" id="form_<?php echo $methodid ?>_print_print" name="print" value="1" />
	</form>
</div>