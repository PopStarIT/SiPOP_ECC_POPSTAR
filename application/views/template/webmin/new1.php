<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <title>ID Card POPSTAR </title>
   <style>
		body {
			background: #008080;
		}

		#bg {
			width: 1000px;
			height: 450px;

			margin: 60px;
			float: left;

		}

		#id {
			width: 250px;
			height: 450px;
			position: absolute;
			opacity: 0.88;
			font-family: sans-serif;

			transition: 0.4s;
			/* background-color: #FFFFFF; */
			border-radius: 2%;
		}

		#id::before {
			content: "";
			position: absolute;
			width: 100%;
			height: 100%;
			
			 background:url(<?php echo site_url('assets/img/id_card/bg/depan.jpg'); ?>);
			/*if you want to change the background image replace logo.png*/
			background-repeat: repeat-x;
			background-size: 250px 450px;
			border-radius: 2%;
			/* opacity: 0.2; */
			z-index: -1;
			text-align: center;

		}

		.container {
			font-size: 12px;
			font-family: sans-serif;

		}
		
		.id-1 {
			transition: 0.4s;
			width: 250px;
			height: 450px;
			background: #FFFFFF;
			text-align: center;
			font-size: 16px;
			font-family: sans-serif;
			float: left;
			margin: auto;
			margin-left: 270px;
			border-radius: 2%;


		}

		.id-2 {
			transition: 0.4s;
			position: absolute;
			width: 250px;
			height: 450px;
			background-image: url(<?php echo site_url('assets/img/id_card/bg/belakang.jpg'); ?>);
			/*if you want to change the background image replace logo.png*/
		    margin-left: 270px;
			background-size: 250px 450px;
			border-radius: 2%;
			/* opacity: 0.2; */
			z-index: -1;
			text-align: center;
	
		}
		
		#id img{
			border-radius:50%;
			position: relative;
			width: 150px;
						
		}
		
		#id imgold{
			border-radius:50%;
			position: relative;
			width: 150px;
			transform: translate(-5%,-10%);
			
		}
	</style>
</head>
<body>
<script type="text/javascript">
		window.print();
	</script>
 <!--  <h2>ID Card <?php //echo $page_title; ?> </h2> -->
   <?php
  // print_r($_GET);
 //  echo 'nik= '.$_GET['nik'];
 //  echo 'link= '.$_GET['link'];
   $nama=$_GET['nama'];
   $nik=$_GET['nik'];
   $link='./'.$_GET['link'];
  
   //<img src="./assets/img/profile/ekonomi Bulolo/dokumen/072917_Dokumen Lain_20220221-020355.jpg" class="img-fluid">
   //<img src='../assets/img/id_card/bg/bkg-2.jpg'  width='70px' height='70px' alt=''>
   ?>
   <div id="bg">
	<div id="id">
	<br>
	 <table border="0" width="245px">
		<tr>
		<td><center>
		<img src=<?php echo site_url('./assets/img/id_card/img/logo-popstar.png'); ?>  alt='Avatar' width='140px' height='30px' alt='' ></center>
		</td>
		
		</tr>
	</table>
	<br>
	<center>
	 <?php 
	 if ($link ==''){
		 $photo='';
	 }else{
		  $photo=$link;
	 }
	  	 ?>
	<!-- <img src=<?php //echo site_url('./assets/img/id_card/img/photo/rosidi_072847_ROSIDI.JPG'); ?> height='170px' width='125px' alt='' style='border: 2px solid black;'> -->
	<img src=<?php echo site_url($photo); ?> height='170px' width='120px' alt='' style='border: 2px solid black;'> 
	</center>
	<div class="container" align="center">

				<p style="margin-top:2%">Name</p>
				<p style="font-weight: bold;margin-top:-4%"><?php echo strtoupper($nama);?>
				<p style="margin-top:-4%">Position</p>
				<p style="font-weight: bold;margin-top:-4%">-
				<p style="margin-top:-4%">STAFF ID:</p>
				<p style="font-weight: bold;margin-top:-4%"><?php echo $nik;?>
				<p style="margin-top:-4%">DEPARTMENT:</p>
				<p style="font-weight: bold;margin-top:-4%">Production
				<p style="margin-top:-4%">HOLDER SIGNATURE</p>

    </div>
  </div>
  <div class="id-2">
   <center>
   <img src=<?php echo site_url('./assets/img/id_card/bg/icon.png'); ?> alt="Avatar" width="200px" height="175px">
				<div class="container" align="center">
					<p style="margin:auto">The bearer whose photograph appears overleaf is a staff of</p>
					<h2 style="color:#00BFFF;margin-left:2%">THE STATE OF</h2>
					<p style="margin:auto">If lost and found please return to the nearest police station</p>
					<hr align="center" style="border: 1px solid black;width:80%;margin-top:13%">
					</hr>

					<p align="center" style="margin-top:-2%">Authorized Signature</p>
					
			</center>
  </div>
</body>
</html>

