<div class="row">
	<div class="col-xl-12">     
		<div class="card card-statistics h-100"> 
			<div class="card-body" style="padding: 1.25rem !important">
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
							<a class="nav-link" id="tab_<?php echo $methodid; ?>_forecast" data-toggle="tab" href="#content_<?php echo $methodid; ?>_forecast" role="tab" aria-controls="content_<?php echo $methodid; ?>_forecast" aria-selected="true">
								Forecast Material
							</a>	
						</li>
						<li class="nav-item">
							<a class="nav-link" id="tab_<?php echo $methodid; ?>_material" data-toggle="tab" href="#content_<?php echo $methodid; ?>_material" role="tab" aria-controls="content_<?php echo $methodid; ?>_material" aria-selected="true">
								List Material
							</a>	
						</li>
					</ul>
					
					<div class="tab-content">
						<div class="tab_custom_ecc tab-pane fade active show" id="content_<?php echo $methodid; ?>_header" role="tabpanel" aria-labelledby="tab_<?php echo $methodid; ?>_header">
							<div class="row">
								<div class="col-xl-11 mb-10 ml-10">
									<form class="ui grid ecc_form" id="form_<?php echo $methodid ?>" action="javascript:post_<?php echo $methodid ?>()">
										<?php 
											$this->ecc_library->form('hidden','',"form_".$methodid,$this->security->get_csrf_token_name(),$this->security->get_csrf_hash());
											$this->ecc_library->form('hidden','',"form_".$methodid,'work_order_plan_id','');
										?>
										
										<div class="row">
											<div class="col-xl-3">
												<?php 
													$this->ecc_library->form('text','Production Plan No',"form_".$methodid,'work_order_plan_no','','','');
												?>
											</div>
											
											<div class="col-xl-3">
												<?php 
													$this->ecc_library->form('date','Production Plan Date',"form_".$methodid,'work_order_plan_date','','','');
												?>
											</div>
											
											<div class="col-xl-3">
												<?php 
													$this->ecc_library->form('date','Required Date',"form_".$methodid,'work_order_required_date','','','');
												?>
											</div>
											
											<div class="col-xl-3">
												<div class="row">
													<div class="col-xl-12">
														<?php 
															$this->ecc_library->form('select','Production Plan Type',"form_".$methodid,'work_order_plan_type_id','','','work_order_plan_type');							
														?>
													</div>
													
													<div class="col-xl-12">
														<div class="row production_plan_type_sales">
															<div class="col-xl-12">
																<?php 
																	$this->ecc_library->form('select','Sales / Memo Order',"form_".$methodid,'sales_order_id','','','sales_order_plan');									
																?>
															</div>
														</div>
														
														<div class="row production_plan_type_subcon" style="display:none">
															<div class="col-xl-12">
																<?php 
																	$this->ecc_library->form('select','Contract Subcon',"form_".$methodid,'contract_subcon_id','','','contract_subcon_plan');									
																?>
															</div>
														</div>
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
													<div class="col-xl-6">
														<?php
															$this->ecc_library->form('hidden','',"form_".$methodid."_detail",$this->security->get_csrf_token_name(),$this->security->get_csrf_hash());
															$this->ecc_library->form('hidden','',"form_".$methodid."_detail",'work_order_plan_id','','','');
															$this->ecc_library->form('hidden','',"form_".$methodid."_detail",'work_order_id','','','');
															$this->ecc_library->form('select','Item Code',"form_".$methodid."_detail",'item_id','','','manufacture_item_with_bom_process');
														?>
													</div>
													
													<div class="col-xl-6 ">
														<?php
													//	print_r(array('extra_param' => array(0 => array('field' => 'item_id' ))));
															$this->ecc_library->form('select','Bom Process',"form_".$methodid."_detail",'bom_process_id','','','get_bom_process',array('extra_param' => array(0 => array('field' => 'item_id' ))));
														?>
													</div>
													
													<div class="col-xl-6">
														<?php
															$this->ecc_library->form('text','Qty Plan',"form_".$methodid."_detail",'quantity_plan','','','');
														?>
													</div>
													
													<div class="col-xl-6">
														<?php
															$this->ecc_library->form('text','Mark Up Material (%)',"form_".$methodid."_detail",'mark_up_material','','','');
														?>
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
										$extra_param = array('methodid'=> $methodid,'extra_param' => array(0 => array('field' => 'work_order_plan_id','form_id' => 'form_'. $methodid .'_detail_work_order_plan_id')));
										$this->ecc_library->jqgrid($methodid."_detail", $dashboard_table['field_detail'], $dashboard_table['field_detail_loaddata'],$extra_param); 
									?>
								</div>
							</div>
						</div>
						
						<div class="tab_custom_ecc tab-pane fade" id="content_<?php echo $methodid; ?>_material" role="tabpanel" aria-labelledby="tab_<?php echo $methodid; ?>_material">
							<div class="row">
								<div class="col-xl-11 mb-10 ml-10">
									<form class="ui grid ecc_form" id="form_<?php echo $methodid ?>_material">
										<?php 
											$this->ecc_library->form('hidden','',"form_".$methodid."_material",'work_order_plan_id','');
										?>
										
										<div class="row">
											<div class="col-xl-6">
												<?php 
													$this->ecc_library->form('readonly','Production Plan No',"form_".$methodid."_material",'work_order_plan_no','','','');
												?>
											</div>
											
											<div class="col-xl-3">
												<?php 
													$this->ecc_library->form('readonly','Production Plan Date',"form_".$methodid."_material",'work_order_plan_date','','','');
												?>
											</div>
											
											<div class="col-xl-3">
												<?php 
													$this->ecc_library->form('readonly','Required Date',"form_".$methodid."_material",'work_order_required_date','','','');
												?>
											</div>
											
											<div class="col-xl-3">
												<?php 
													$this->ecc_library->form('readonly','Plan Type',"form_".$methodid."_material",'work_order_plan_type','','','');
												?>
											</div>
											
											<div class="col-xl-6">
												<?php 
													$this->ecc_library->form('readonly','Contract Subcon',"form_".$methodid."_material",'contract_subcon_no','','','');
												?>
											</div>
											
										</div>
									</form>
									
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
							
							<div class="row">
								<div class="col-xl-12">
									<?php 
										$extra_param = array('methodid'=> $methodid,'extra_param' => array(0 => array('field' => 'work_order_plan_id','form_id' => 'form_'. $methodid .'_material_work_order_plan_id')));
										$this->ecc_library->jqgrid($methodid."_material", $dashboard_table['field_material'], $dashboard_table['field_material_loaddata'],$extra_param); 
									?>
								</div>
							</div>
						</div>
						
						<div class="tab_custom_ecc tab-pane fade" id="content_<?php echo $methodid; ?>_forecast" role="tabpanel" aria-labelledby="tab_<?php echo $methodid; ?>_forecast">
							<div class="row">
								<div class="col-xl-11 mb-10 ml-10">
									<form class="ui grid ecc_form" id="form_<?php echo $methodid ?>_forecast">
										<?php 
											$this->ecc_library->form('hidden','',"form_".$methodid."_forecast",'work_order_plan_id','');
										?>
										
										<div class="row">
											<div class="col-xl-6">
												<?php 
													$this->ecc_library->form('readonly','Production Plan No',"form_".$methodid."_forecast",'work_order_plan_no','','','');
												?>
											</div>
											
											<div class="col-xl-3">
												<?php 
													$this->ecc_library->form('readonly','Production Plan Date',"form_".$methodid."_forecast",'work_order_plan_date','','','');
												?>
											</div>
											
											<div class="col-xl-3">
												<?php 
													$this->ecc_library->form('readonly','Required Date',"form_".$methodid."_forecast",'work_order_required_date','','','');
												?>
											</div>
											
											<div class="col-xl-3">
												<?php 
													$this->ecc_library->form('readonly','Plan Type',"form_".$methodid."_forecast",'work_order_plan_type','','','');
												?>
											</div>
											
											<div class="col-xl-6">
												<?php 
													$this->ecc_library->form('readonly','Contract Subcon',"form_".$methodid."_forecast",'contract_subcon_no','','','');
												?>
											</div>
											
										</div>
									</form>
									
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
							
							<div class="row">
								<div class="col-xl-12 grid_container_<?php echo $methodid ?>_forecast">
									<table id="table_<?php echo $methodid ?>_forecast"></table>
									<div id="ptable_<?php echo $methodid ?>_forecast"></div>                                                     
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-xl-12">
									<button type="button" class="btn btn-success" onclick="javascript:add_<?php echo $methodid ?>_forecast()">
										<i class="fa fa-save"></i> Create Purchase Request
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