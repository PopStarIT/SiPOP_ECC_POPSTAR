<div id="header" class="sticky transparent noborder clearfix">
	<!-- TOP NAV -->
	<header id="topNav">
		<div class="full-container">
			<!-- Mobile Menu Button -->
			<button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
				<i class="fa fa-bars"></i>
			</button>
			
			<!-- Logo -->
			<a class="logo pull-left" href="<?php echo base_url() ?>">
				<img src="<?php echo BASEDIR . "assets/" . $path_template ."/frontend/" ?>images/logo_light.png" alt="" /> <!-- light logo -->
				<img src="<?php echo BASEDIR . "assets/" . $path_template ."/frontend/" ?>images/logo_dark.png" alt="" /> <!-- dark logo -->
			</a>

			<!-- 
				Top Nav 
				
				AVAILABLE CLASSES:
				submenu-dark = dark sub menu
			-->
			<div class="navbar-collapse pull-right nav-main-collapse collapse submenu-dark">
				<nav class="nav-main">

					<!--
						NOTE
						
						For a regular link, remove "dropdown" class from LI tag and "dropdown-toggle" class from the href.
						Direct Link Example: 

						<li>
							<a href="#">HOME</a>
						</li>
					-->
					<ul id="topMain" class="nav nav-pills nav-main">
						<?php if($this->session->userdata('login')){ ?>
							<li>
								<a href="<?php echo base_url()?>users"><button type="button" class="btn btn-default">Wallet</button></a>
							</li>
						<?php } else { ?>
							<li>
								<a href="<?php echo base_url()?>users">Sign In</a>
							</li>
							<li>
								<a href="<?php echo base_url()?>users/register"><button type="button" class="btn btn-default">Sign Up</button></a>
							</li>
						<?php } ?>
					</ul>

				</nav>
			</div>

		</div>
	</header>
	<!-- /Top Nav -->

</div>