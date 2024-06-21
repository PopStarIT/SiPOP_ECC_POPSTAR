<!-- WEB FONTS : use %7C instead of | (pipe) -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700" rel="stylesheet" type="text/css" />

	<!-- CORE CSS -->
	<link href="<?php echo BASEDIR . "assets/" . $path_template ."/frontend/" ?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

	<!-- THEME CSS -->
	<link href="<?php echo BASEDIR . "assets/" . $path_template ."/frontend/" ?>css/essentials.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo BASEDIR . "assets/" . $path_template ."/frontend/" ?>css/layout.css" rel="stylesheet" type="text/css" />

	<!-- PAGE LEVEL SCRIPTS -->
	<link href="<?php echo BASEDIR . "assets/" . $path_template ."/frontend/" ?>css/header-1.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo BASEDIR . "assets/" . $path_template ."/frontend/" ?>css/color_scheme/green.css" rel="stylesheet" type="text/css" id="color_scheme" />

<?php 
if(isset($load_css)){
	if(is_array($load_css)){
		foreach($load_css as $dt_css){
			echo "<link rel='stylesheet' type='text/css' href='". BASEDIR . "assets/" . $path_template ."/". $dt_css ."' media='screen' />";
		}
	} else {
		echo "<link rel='stylesheet' type='text/css' href='". BASEDIR . "assets/" . $path_template ."/". $load_css ."' media='screen' />";
	}
} else {
	
}
?>