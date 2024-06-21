<!doctype html>
<html lang="en">
    <?php $this->load->view($path_template.'/include/global/meta'); ?>
    <body>
        <div id="page-container" class="page-header-fixed page-header-glass main-content-boxed">
            
			<?php $this->load->view($path_template.'/include/global/aside'); ?>
			<!-- Header -->
            <?php $this->load->view($path_template.'/include/global/header'); ?>
            <!-- END Header -->

            <!-- Main Container -->
            <main id="main-container">
				<div class="bg-body-light">
					<h2 class="mb-4"> &nbsp </h2>
				</div>
				
				<div class="row no-gutters flex-md-10-auto">
					<div class="col-md-4 col-lg-5 col-xl-3">
						<div class="content">
							<!-- Toggle Side Content -->
							<div class="d-md-none push text-right">
								<!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
								<button type="button" class="btn btn-hero-primary" data-toggle="class-toggle" data-target="#side-content" data-class="d-none">
									<i class="fa fa-fw fa-bars"></i>
								</button>
							</div>
							<!-- END Toggle Side Content -->

							<!-- Side Content -->
							<?php 
								$side_menu = array();
								$privacy = array();
								$privacy['method_id'] = 29;
								$privacy['icon'] = "fa-book";
								$privacy['name'] = "Privacy Policy";
								
								$terms = array();
								$terms['method_id'] = 30;
								$terms['icon'] = "fa-book";
								$terms['name'] = "Terms Of Use";
								
								$contact = array();
								$contact['method_id'] = 28;
								$contact['icon'] = "fa-envelope";
								$contact['name'] = "Contact Us";
								
								$side_menu[] = $privacy;
								$side_menu[] = $terms;
								$side_menu[] = $contact;
							?>
							<div id="side-content" class="d-none d-md-block push">
								<ul class="nav nav-pills flex-column push">
									<?php 
										foreach($side_menu as $dt_side_menu){ 
											$link = $this->authentication->generate_link($dt_side_menu['method_id']);
											$permission_check = $this->authentication->permission_check($dt_side_menu['method_id']);
											if($permission_check){
												$active = "";
												if($methodid == $dt_side_menu['method_id']){
													$active = "active";
												}
												
												echo "<li class='nav-item'>";
												echo "<a class='nav-link ". $active ."' href='". $link ."'>";
												echo "<i class='fa fa-fw ". $dt_side_menu['icon'] ." mr-1'></i> ". $dt_side_menu['name'];
												echo "</a>";
												echo "</li>";
											}
										}	
									?>					
								</ul>
							</div>
							<!-- END Side Content -->
						</div>
					</div>
					<div class="col-md-8 col-lg-7 col-xl-9 bg-body-dark">
						<?php 
							if(isset($view_load)){
								if(is_array($view_load)){
									foreach($view_load as $dt_load){
										$this->load->view('content/'.$dt_load);
									}
								} else {
									$this->load->view('content/'.$view_load);
								}
							}
						?>
					</div>
				</div>
                
				
				
                <!-- Footer -->
				<?php $this->load->view($path_template.'/include/global/footer'); ?>
                <!-- END Footer -->

            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->

        <?php $this->load->view($path_template.'/include/global/javascript'); ?>
        
    </body>
</html>