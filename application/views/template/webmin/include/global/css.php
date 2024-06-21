<!-- Font -->
<link  rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

<link rel="stylesheet" type="text/css" href="<?php echo BASEDIR . "assets/" . $path_template ."/" ?>css/style.css" />

<link rel="stylesheet" type="text/css" href="<?php echo BASEDIR . "assets/" . $path_template ."/" ?>plugins/bootstrap-select/css/bootstrap-select.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo BASEDIR . "assets/" . $path_template ."/" ?>css/animate.css" />
<link rel="stylesheet" type="text/css" href="<?php echo BASEDIR . "assets/" . $path_template ."/" ?>plugins/select2/css/select2.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo BASEDIR . "assets/" . $path_template ."/" ?>plugins/select2/css/select2-bootstrap4.min.css" />

<link rel="stylesheet" type="text/css" href="<?php echo BASEDIR . "assets/" . $path_template ."/" ?>plugins/jqgrid/css/jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo BASEDIR . "assets/" . $path_template ."/" ?>plugins/jqgrid/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo BASEDIR . "assets/" . $path_template ."/" ?>plugins/jqgrid/css/ui.jqgrid.min.css" />

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