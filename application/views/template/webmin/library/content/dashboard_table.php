<?php if(isset($dashboard_table)) { ?>
	<div class="row">
		<div class="col-xl-12">
			<div class="card card-statistics"> 
				<div class="card-body">
					<?php if(isset($dashboard_table['nav_button'])) { ?>
						<div class="row">
							<div class="col-xl-12">
								<?php 
									foreach($dashboard_table['nav_button'] as $dt_nav_button) {
										$permision = $this->authentication->permission_check($dt_nav_button['method_id']);
										if($permision){
											echo "<button type=\"button\" class=\"btn btn-default mb-1\" onclick=\"javascript:nav_button_".$dt_nav_button['method_id'] ."_". $data_method[$dt_nav_button['method_id']]['method']."();\">";
											echo "<i class=\"". $dt_nav_button['icon'] ."\"></i> ".$dt_nav_button['title'];
											echo "</button> ";
										}
									}
								?>                                                             
							</div>
						</div>
					<?php } ?>
					<div class="row">
						<div class="col-xl-12">
							<div class="table-responsive">
								<table id="table_<?php echo $methodid ?>" class="table datatable table-hover table-bordered table-striped nowrap" width="100%">
									<thead>
										<tr>
										<?php 
											if(isset($dashboard_table['field'])) {
												foreach($dashboard_table['field'] as $key => $dt_field){
													echo "<th>";
													if(isset($dt_field['title'])){
														$title = $dt_field['title'];
													} else {
														$title = strtoupper(str_replace('_',' ',$dt_field['field']));
													}
													echo $title;
													echo "</th>";
												}
											}
										?>
										</tr>
									</thead>
								</table>
							</div>                                                      
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>