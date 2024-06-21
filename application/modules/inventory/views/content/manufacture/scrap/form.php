<div class="row">
	<div class="col-xl-12">     
		<div class="card card-statistics h-100"> 
			<div class="card-body" style="padding: 1.25rem !exportant">
				<h5 class="card-title form_title_<?php echo $methodid ?>"><?php echo $page_title ?></h5>
				<div class="tab tab-border">
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
						
						<li class="nav-item">
							<a class="nav-link" id="tab_<?php echo $methodid; ?>_supply" data-toggle="tab" href="#content_<?php echo $methodid; ?>_supply" role="tab" aria-controls="content_<?php echo $methodid; ?>_supply" aria-selected="true">
								Supply
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
											$this->ecc_library->form('hidden','',"form_".$methodid,'work_order_scrap_id','');
										?>
										
										<div class="row">
											<div class="col-xl-6">
												<?php 
													$this->ecc_library->form('text','Scrap No',"form_".$methodid,'work_order_scrap_no','','','');
													$this->ecc_library->form('date','Scrap Date',"form_".$methodid,'work_order_scrap_date','','','');
													
												?>
											</div>
											
											<div class="col-xl-5">
												<?php 
													$this->ecc_library->form('select','Work Process',"form_".$methodid,'work_process_id','','','work_process_user');
													$this->ecc_library->form('select','Production Plan',"form_".$methodid,'work_order_plan_id','','','get_work_order_plan_process',array('extra_param' => array(0 => array('field' => 'work_process_id' ))));
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
						
						<div class="tab_custom_ecc tab-pane fade" id="content_<?php echo $methodid; ?>_detail" role="tabpanel" aria-labelledby="tab_<?php echo $methodid; ?>_detail">
							<div class="row">
								<div class="col-xl-12">
									<h3>List Material</h3>
									<form class="ui grid ecc_form" id="form_<?php echo $methodid ?>_detail" action="javascript:add_<?php echo $methodid ?>()">
										<div class="row">
											<div class="col-xl-8">
												<div class="row">
													<div class="col-xl-12 grid_container_<?php echo $methodid ?>_material">
														<table id="table_<?php echo $methodid ?>_material"></table>
														<div id="ptable_<?php echo $methodid ?>_material"></div>                                                     
													</div>
												</div>
											</div>
											<div class="col-xl-3 ">
												<div class="row">
													<div class="col-xl-12">
														<?php
															$this->ecc_library->form('hidden','',"form_".$methodid."_detail",$this->security->get_csrf_token_name(),$this->security->get_csrf_hash());
															$this->ecc_library->form('hidden','',"form_".$methodid."_detail",'work_order_scrap_id','','','');
															$this->ecc_library->form('hidden','',"form_".$methodid."_detail",'work_order_plan_id','','','');
															$this->ecc_library->form('hidden','',"form_".$methodid."_detail",'work_process_id','','','');
															$this->ecc_library->form('hidden','',"form_".$methodid."_detail",'work_order_scrap_date','','','');
															$this->ecc_library->form('hidden','',"form_".$methodid."_detail",'work_order_scrap_detail_id','','','');
															$this->ecc_library->form('select','Scrap',"form_".$methodid."_detail",'item_id','','','item_scrap');
														?>
													</div>
													<div class="col-xl-12">
														<?php
															$this->ecc_library->form('text','Qty Scrap',"form_".$methodid."_detail",'quantity_scrap','','','');
														?>
													</div>
													<div class="col-xl-12">
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
											</div>
										</div>
									</form>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-xl-12">
									<h3>Scrap Detail</h3>
									<?php 
										$extra_param = array('methodid'=> $methodid,'extra_param' => array(0 => array('field' => 'work_order_scrap_id','form_id' => 'form_'. $methodid .'_detail_work_order_scrap_id')));
										$this->ecc_library->jqgrid($methodid."_detail", $dashboard_table['field_detail'], $dashboard_table['field_detail_loaddata'],$extra_param); 
									?>
								</div>
							</div>
						</div>
						
						<div class="tab_custom_ecc tab-pane fade" id="content_<?php echo $methodid; ?>_supply" role="tabpanel" aria-labelledby="tab_<?php echo $methodid; ?>_supply">
							<div class="row panel_<?php echo $methodid ?>_panel_supply">
								<div class="col-xl-12">
									<div class="row">
										<div class="col-xl-6">
											<?php 
												$this->ecc_library->form('readonly','Scrap No',"form_".$methodid."_supply",'work_order_scrap_no','','','');
												$this->ecc_library->form('readonly','Scrap Date',"form_".$methodid."_supply",'work_order_scrap_date','','','');
											?>
										</div>
										
										<div class="col-xl-6">
											<?php 
												$this->ecc_library->form('readonly','Work Process',"form_".$methodid."_supply",'work_process_name','','','');
												$this->ecc_library->form('readonly','Production Plan',"form_".$methodid."_supply",'work_order_plan','','','');
											?>
										</div>
									</div>
									
									<div class="row">
										<div class="col-xl-12 mb-30">
											<button type="button" class="btn btn-info" onclick="javascript:supply_fifo_<?php echo $methodid ?>()">
												<i class="fa fa-archive"></i> Auto Supply FIFO
											</button>
											
											<button type="button" class="btn btn-info" onclick="javascript:supply_lifo_<?php echo $methodid ?>()">
												<i class="fa fa-archive"></i> Auto Supply LIFO
											</button>
											<br>
											<br>
											<div class="row">
												<div class="col-xl-12">
													<?php 
														$extra_param = array('methodid'=> $methodid,'onclick'=> 'click_transfer_'.$methodid,'extra_param' => array(0 => array('field' => 'work_order_scrap_id','form_id' => 'form_'. $methodid .'_supply_work_order_scrap_id')));
														$this->ecc_library->jqgrid($methodid."_supply", $dashboard_table['field_detail_supply'], $dashboard_table['field_detail_supply_loaddata'],$extra_param); 
													?>
												</div>
											</div>
										</div>
									</div>	
									
									<br>
									
									<div class="row">
										<div class="col-xl-8 mb-30">
											<h3>Available Stock</h3>
											<div class="row">
												<div class="col-xl-12">
													<?php 
														$extra_field = array();
														$extra_field[] = array('field' => 'work_order_scrap_list_id','form_id' => 'form_'. $methodid .'_supply_work_order_scrap_list_id');
														$extra_field[] = array('field' => 'work_order_scrap_supply_id','form_id' => 'form_'. $methodid .'work_order_scrap_supply_id');
														$extra_param = array('methodid'=> $methodid,'onclick'=> 'click_item_'.$methodid ,'extra_param' => $extra_field);
														$this->ecc_library->jqgrid($methodid."_available", $dashboard_table['field_transfer_item'], $dashboard_table['field_transfer_item_loaddata'],$extra_param); 
													?>
												</div>
											</div>
											<br>
											<h3>List Supply</h3>
											<div class="row">
												<div class="col-xl-12">
													<?php 
														$extra_field = array();
														$extra_field[] = array('field' => 'work_order_scrap_list_id','form_id' => 'form_'. $methodid .'_supply_work_order_scrap_list_id');
														$extra_field[] = array('field' => 'work_order_scrap_supply_id','form_id' => 'form_'. $methodid .'work_order_scrap_supply_id');
														$extra_param = array('methodid'=> $methodid,'onclick'=> 'click_supply_'.$methodid ,'extra_param' => $extra_field);
														$this->ecc_library->jqgrid($methodid."_list_transfer", $dashboard_table['field_supply_item'], $dashboard_table['field_supply_item_loaddata'],$extra_param); 
													?>
												</div>
											</div>
										</div>
										<div class="col-xl-4 mb-30">
											<form class="ui grid ecc_form" id="form_<?php echo $methodid ?>_supply" action="javascript:post_<?php echo $methodid ?>_supply()">
												<?php 
													$this->ecc_library->form('hidden','',"form_".$methodid."_supply",$this->security->get_csrf_token_name(),$this->security->get_csrf_hash());
													$this->ecc_library->form('hidden','',"form_".$methodid."_supply",'work_order_scrap_id','');
													$this->ecc_library->form('hidden','',"form_".$methodid."_supply",'stock_move_id','');
													$this->ecc_library->form('hidden','',"form_".$methodid."_supply",'work_order_scrap_list_id','');
													$this->ecc_library->form('hidden','',"form_".$methodid."_supply",'work_order_scrap_supply_id','');
													$this->ecc_library->form('text','From',"form_".$methodid."_supply",'from','','','');
													$this->ecc_library->form('date','Receive Date',"form_".$methodid."_supply",'receive_date','','','');
													$this->ecc_library->form('text','Receive No',"form_".$methodid."_supply",'receive_no','','','');
													$this->ecc_library->form('text','Quantity Supply',"form_".$methodid."_supply",'quantity_supply','','','');
												?>
												
												<div class="input-group">
													<button type="submit" class="btn btn-success">
														<i class="fa fa-save"></i> ADD / UPDATE
													</button>
												</div>
											</form>
										</div>
									</div>
									<br>
									<div class="ui grid form">
										<div class="row field">
											<div class="twelve wide column">
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
	</div>
</div>