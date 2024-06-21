<section class="height-100vh d-flex align-items-center page-section-ptb login" style="background-color:#dfe7f0;"  >
	<div class="container">
		<div class="row justify-content-center no-gutters vertical-align">
			<div class="col-lg-4 col-md-6 login-fancy-bg bg" style="background-image: url(<?php echo BASEDIR . "assets/" . $path_template ."/" ?>images/popstar1.jpg);">
				<div class="login-fancy">
					<!-- <p class="mb-20 text-white">Create tailor-cut websites with the exclusive multi-purpose responsive template along with powerful features.</p> !-->
					
				</div> 
			</div>
			
			<div class="col-lg-4 col-md-6 bg-dark text-light">
				<div class="login-fancy pb-40 clearfix">
					<form id="form_users_login" class="js-validation-signin" action="javascript:post_user_login()">
						<input type="hidden" class="form-control" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>" />
						<h3 class="mb-30 text-light">Sign In</h3>
						<div class="section-field mb-20">
							<label class="mb-10" for="name">Username* </label>
							<input type="text" class="form-control" id="username" name="username" placeholder="Username">
						</div>
						
						<div class="section-field mb-20">
							<label class="mb-10" for="Password">Password* </label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Password">
						</div>
						
						<div class="section-field">
							<div class="remember-checkbox mb-30">
								
							</div>
						</div>
						
						<button type="submit" href="javascript:void(0)" class="button">
							<span>Log in </span>
							<i class="fa fa-check"></i>
						</button>
						<p class="mt-20 mb-0">PT.POPSTAR</p>
						<p class="mt-25 mb-0">Jalan Nanjung KM.3 No.99, Lagadar, Kec. Margaasih, Kabupaten Bandung, Jawa Barat 40216</p>
						
						<p class="mt-20 mb-0"><b><i>Authorize User Only!</i></b></p>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>