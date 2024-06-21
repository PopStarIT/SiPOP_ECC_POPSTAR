<!DOCTYPE html>
<html lang="en">
	<?php $this->load->view($path_template.'/include/global/meta'); ?>
	<body>
		<div class="wrapper">
			<div id="pre-loader">
				<img src="<?php echo BASEDIR . "assets/" . $path_template ."/" ?>images/pre-loader/loader-01.svg" alt="">
			</div>

			<?php $this->load->view($path_template.'/include/global/header'); ?>

			<div class="container-fluid">
				<div class="row">
					 <?php $this->load->view($path_template.'/include/global/sidebar'); ?>
					<div class="content-wrapper">													
						<div class="row">   
							<div class="col-xl-12">     
								<div class="tab tab-border">
									<!-- <ul class="nav nav-tabs maintab" role="tablist" style="background:lightgoldenrodyellow;"> -->
									<ul class="nav nav-tabs maintab" role="tablist" style="background:#dbdbd4;">
										<li class="nav-item">
											<a class="nav-link dashboard active show" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="true"> <i class="fa fa-home"></i> Home</a>
										</li>
										<li class="nav-item">
											<a class="nav-link close-all-tabs" href="javascript:void()" style="display:none"> 
												<i class="fa fa-window-close" style="color:red !important"></i> Close All Tabs
											</a>
										</li>
										
										
									</ul>
									<div class="tab-content tab-main-content scrollbar tab_scrollbar">
										<div class="tab_custom_ecc tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard">
											<div style="text-align:center"><img src="<?php echo BASEDIR . "assets/" . $path_template ."/" ?>images/pre-loader/loader-01.svg" alt=""></div>
										</div>
									</div>
								</div>   
							</div>
						</div> 
						
						
						<div class="row newsticker-main">   
							<div class="col-xl-12">     
								<div class="card card-statistics"> 
									<div class="card-body" style="color:#041f75 !important; !important;">
									<p class="mb-0"> &copy; Copyright <span id="copyright"> <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script></span>. <a href="#"> </p>
									</div>
								</div>
							</div>
						</div>
						<?php #$this->load->view($path_template.'/include/global/footer'); ?>
					</div> 
				</div>
			</div>
		</div>
		
		<?php $this->load->view($path_template.'/include/global/javascript'); ?>
	</body>
</html>