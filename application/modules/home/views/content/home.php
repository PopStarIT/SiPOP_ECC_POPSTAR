<div class="bg-image" style="background-image: url('<?php echo BASEDIR . "assets/" . $path_template ."/" ?>media/photos/photo.jpg');">
	<div class="hero bg-white-90 overflow-hidden">
		<div class="hero-inner">
			<div class="content content-full">
				<h1 class="h2 font-w700 mb-3 invisible" data-toggle="appear">
							MAIK'S MASTERNODE HOSTING.
						</h1>
				<div class="row">
					<div class="col-lg-5">
						
						<p class="font-size-h4 font-w300 text-muted mb-5 invisible" data-toggle="appear">
							Fully automated deployment system that has only one button to deploy a masternode.
						</p>
						<span class="d-inline-block invisible" data-toggle="appear" data-timeout="150">
							<?php if($this->session->userdata('login')){ ?>
								<a class="btn btn-hero-primary" href="<?php echo base_url()?>users">
									<i class="fa fa-fw fa-desktop mr-1"></i> Dashboard
								</a>
							<?php } else { ?>
								<a class="btn btn-hero-primary" href="<?php echo base_url()?>users/register">
									<i class="fa fa-fw fa-rocket mr-1"></i> Get Started
								</a>
							<?php } ?>
						</span>
					</div>
					<div class="d-none d-lg-block col-lg-6 offset-lg-1 invisible" data-toggle="appear" data-timeout="300">
						<h1 class="h2 font-w700 mb-3 invisible" data-toggle="appear">
							1000+ HOSTED NODES.
						</h1>
						<h1 class="h2 font-w700 mb-3 invisible" data-toggle="appear">
							30+ Coins Supported.
						</h1>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>

<div class="bg-body-light">
	<div class="content content-full">
		 <div class="row py-3 invisible" data-toggle="appear">
			<div class="col-sm-12 col-md-3 mb-5">
				<h4 class="h5 mb-2">
					Low cost hosting
				</h4>
				<p class="mb-0 text-muted">
					All the payments are in SecureCloudNet coins (SCN) and we are proud to be the cheapest hosting platform on the internet.
				</p>
			</div>
			
			<div class="col-sm-12 col-md-3 mb-5">
				<h4 class="h5 mb-2">
					One button setup
				</h4>
				<p class="mb-0 text-muted">
					We have a fully automated deployment system that has only one button to deploy a masternode.
				</p>
			</div>
			
			<div class="col-sm-12 col-md-3 mb-5">
				<h4 class="h5 mb-2">
					Pre-payed system
				</h4>
				<p class="mb-0 text-muted">
					Payments are made in advance of service each month, manual or automatically, with our automated payment system.
				</p>
			</div>
			
			<div class="col-sm-12 col-md-3 mb-5">
				<h4 class="h5 mb-2">
					RYON hosting
				</h4>
				<p class="mb-0 text-muted">
					We provide “Run Your Own Node” hosting so your coins are always safe in your own wallet.
				</p>
			</div>
			
		</div>
	</div>
</div>

<div class="bg-body-light">
	<div class="content content-full">
		<div class="push text-center">
			<h2>
				Supported Coins
			</h2>
		</div>
		
		 <div class="row invisible" data-toggle="appear">

			<div class="col-sm-12 col-md-3">
				<div class="block block-rounded block-bordered">
					<div class="block-content" style="padding:0">
						<div class="media py-2 coin-widget">
							<div class="mr-3 ml-2 overlay-container overlay-left"> 
								<img class="img-avatar img-avatar48" src="<?php echo BASEDIR . "assets/" . $path_template ."/" ?>media/coin/scn.png" alt="">
							</div> 								
							<div class="media-body"> 								
								<div class="font-w600">SCN</div> 								
								<div class="font-w600 text-muted">SecureCloudNet</div>
							</div>
						</div> 								
					</div> 								
				</div> 								
			</div>
		</div>
	</div>
</div>