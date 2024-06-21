<?php if(isset($dashboard_tab)) { ?>
	<div class="row">
		<div class="col-xl-12">
			<div class="tab tab-border">
				<ul class="nav nav-tabs" role="tablist">
					<?php 
						$first = true;
						foreach($dashboard_tab as $tab) { 
							$class = "";
							if($first){
								$class = "active show";
							}

							echo "<li class=\"nav-item\">";
							echo "<a class=\"nav-link ". $class ." \" id=\"tab_". $methodid ."_". $tab['alias'] ."\" data-toggle=\"tab\" href=\"#content_". $methodid ."_". $tab['alias'] ."\" role=\"tab\" aria-controls=\"content_". $methodid ."_". $tab['alias'] ."\" aria-selected=\"true\">";	
							echo "<i class=\"". $tab['icon'] ."\"></i> ". $tab['title'];	
							echo "</a>";	
							echo "</li>";	
								
								
							$first = false;
						}
					?>
				</ul>
				
				<div class="tab-content">
					<?php 
						$first = true;
						foreach($dashboard_tab as $tab) { 
							$class = "";
							if($first){
								$class = "active show";
							}
							
							echo "<div class=\"tab_custom_ecc tab-pane fade ".$class." \" id=\"content_". $methodid ."_". $tab['alias'] ."\" role=\"tabpanel\" aria-labelledby=\"tab_". $methodid ."_". $tab['alias'] ."\">";
							
							//var_dump($tab_content['menu_icon']);echo "<br \>";
							//var_dump($data_method['1046']);echo "<br \>";
							if(isset($tab['content'])){
								echo "<div class=\"row\">";
								foreach($tab['content'] as $tab_content){
									//var_dump($data_method[$tab_content['method_id']]);
									// javascript:add_tab(13,'Account Groups','accounting/maintenance/account_group','fa fa-align-justify');
									$permision = $this->authentication->permission_check_pop($tab_content['method_id']);
									if($permision){
										echo "<div class=\"col-xl-3 col-lg-6 col-md-6\">";	
										echo "<a href=\"javascript:add_tab(". $tab_content['method_id'] .", '". $tab_content['menu_name'] ."' , '". $data_method[$tab_content['method_id']]['link'] ."','". $tab_content['menu_icon'] ."');\" class=\"tile tile-primary tile-valign\">";	
										echo "<span class=\"". $tab_content['menu_icon'] ."\"></span>";	
										echo "<div class=\"informer informer-default\">". $tab_content['menu_name'] ."</div>";	
										echo "<div class=\"informer informer-default dir-br\">". $tab_content['menu_name'] ."</div>";	
										echo "</a>";	
										echo "</div>";	
									}
									
									
								}
								echo "</div>";
							} 

							// if(isset($tab['view_content'])){
								// $this->load->view('content/'.$tab['view_content']);
							// }
							echo "</div>";
							
							
							
							$first = false;
						}
					?>
				</div>
			</div>
		</div>
	</div>	
<?php } ?>