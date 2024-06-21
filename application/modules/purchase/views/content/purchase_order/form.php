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
					</ul>
					
					<div class="tab-content">
						<div class="tab_custom_ecc tab-pane fade active show" id="content_<?php echo $methodid; ?>_header" role="tabpanel" aria-labelledby="tab_<?php echo $methodid; ?>_header">
							<div class="row">
								<div class="col-xl-12 mb-10 ml-10">
									<form class="ui grid ecc_form" id="form_<?php echo $methodid ?>" action="javascript:post_<?php echo $methodid ?>()">
										<?php 
											$this->ecc_library->form('hidden','',"form_".$methodid,$this->security->get_csrf_token_name(),$this->security->get_csrf_hash());
											$this->ecc_library->form('hidden','',"form_".$methodid,'purchase_order_id','');
											$this->ecc_library->form('hidden','',"form_".$methodid,'purchase_type_id','');
											$this->ecc_library->form('hidden','',"form_".$methodid,'this_memo','');
										?>
										
										<div class="row">
											<div class="col-xl-4">
												<?php 
													$this->ecc_library->form('text','Purchase Order No',"form_".$methodid,'purchase_order_no','','','');
													$this->ecc_library->form('date','Purchase Order Date',"form_".$methodid,'purchase_order_date','','','');
												?>
											</div>
											
											<div class="col-xl-4">
												<div class="row">
													<div class="col-xl-12">
														<?php 
															$this->ecc_library->form('select','Supplier',"form_".$methodid,'partner_id','','','supplier');
														?>
													</div>
													
													<div class="col-xl-12">
														<div class="row">
															<div class="col-xl-6">
																<?php 
																	$this->ecc_library->form('select','Currencies',"form_".$methodid,'currencies_id','','','currencies');						
																?>
															</div>
															<div class="col-xl-6">
																<?php 
																	$this->ecc_library->form('readonly','Rate',"form_".$methodid,'rate','','','');						
																?>
															</div>
														</div>
													</div>
												</div>
											</div>
											
											<div class="col-xl-3">
												<?php 
													$this->ecc_library->form('select','Order Type',"form_".$methodid,'purchase_order_type_id','','','purchase_order_type_purchase');						
													$this->ecc_library->form('text','Memo',"form_".$methodid,'purchase_order_memo','','','');						
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
							<div class="row panel_<?php echo $methodid ?>_panel_detail">
								<div class="col-xl-12">
									<form class="ui grid ecc_form" id="form_<?php echo $methodid ?>_detail" action="javascript:add_<?php echo $methodid ?>()">
										<div class="row">
											<div class="col-xl-9">
												<div class="row">
													<div class="col-xl-5">
														<?php
															$this->ecc_library->form('hidden','',"form_".$methodid."_detail",$this->security->get_csrf_token_name(),$this->security->get_csrf_hash());
															$this->ecc_library->form('hidden','',"form_".$methodid."_detail",'purchase_order_id','','','');
															$this->ecc_library->form('hidden','',"form_".$methodid."_detail",'purchase_order_detail_id','','','');
															$this->ecc_library->form('select','Item Code',"form_".$methodid."_detail",'item_id','','','item_detail');
														?>
													</div>
													
													<div class="col-xl-2">
														<?php
															$this->ecc_library->form('text','Qty',"form_".$methodid."_detail",'quantity_ordered','','','');
														?>
													</div>
													
													<div class="col-xl-3 ">
														<?php
															$this->ecc_library->form('select','Unit',"form_".$methodid."_detail",'uom_id','','','uom');
														?>
													</div>
													
													<div class="col-xl-2">
														<?php
															$this->ecc_library->form('text','Conversion',"form_".$methodid."_detail",'conversion','','','');
														?>
													</div>
														
													<div class="col-xl-3">
														<?php
															$this->ecc_library->form('text','Unit Price',"form_".$methodid."_detail",'unit_price','','','');
														?>
													</div>
													
													<div class="col-xl-3">
														<?php
													$this->ecc_library->form('date','Order Delivery Date',"form_".$methodid."_detail",'order_delivery_date','','','');						
												     ?>
													</div>
													<div class="col-xl-3">
														<?php
															$this->ecc_library->form('text','Style',"form_".$methodid."_detail",'purchase_order_detail_Style','','','');
														?>
													</div>
													
													<div class="col-xl-6">
														<?php
															$this->ecc_library->form('text','Composition',"form_".$methodid."_detail",'purchase_order_detail_composition','','','');
														?>
													</div>
													
													<div class="col-xl-6">
														<?php
															$this->ecc_library->form('text','Intruction',"form_".$methodid."_detail",'purchase_order_detail_intruction','','','');
														?>
													</div>
													
													<div class="col-xl-6">
														<?php
															$this->ecc_library->form('text','Memo',"form_".$methodid."_detail",'purchase_order_detail_memo','','','');
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
							
							<div class="row panel_<?php echo $methodid ?>_panel_purchase_request mb-10" >
								<div class="col-xl-12">
									<?php 
										$extra_field = array();
										$extra_field[] = array('field' => 'purchase_order_id','form_id' => 'form_'. $methodid .'_detail_purchase_order_id');
										$extra_field[] = array('field' => 'purchase_order_detail_id','form_id' => 'form_'. $methodid .'_detail_purchase_order_detail_id');
										$extra_param = array('methodid'=> $methodid,'beforeclick'=> 'beforeclick_'.$methodid."_purchase_request",'extra_param' => $extra_field);
										$this->ecc_library->jqgrid($methodid."_purchase_request", $dashboard_table['field_purchase_request'], $dashboard_table['field_purchase_request_loaddata'],$extra_param); 
									?>
								</div>
							</div> 
							
							<div class="row">
								<div class="col-xl-12">
									<?php 
								//	print_r($dashboard_table);
										$extra_param = array('methodid'=> $methodid,'extra_param' => array(0 => array('field' => 'purchase_order_id','form_id' => 'form_'. $methodid .'_detail_purchase_order_id')));
										$this->ecc_library->jqgrid($methodid."_detail", $dashboard_table['field_detail'], $dashboard_table['field_detail_loaddata'],$extra_param); 
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