<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="<?php echo isset($base_config['keywords']) ? html_entity_decode($base_config['keywords']) : "keywords"; ?>" name="keywords">
	<meta content="<?php echo isset($base_config['description']) ? html_entity_decode($base_config['description']) : "description"; ?>" name="description">

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<title>
		<?php 
			echo isset($base_config['webname']) ? html_entity_decode($base_config['webname']) : "webname"; 
			echo isset($page_title) ? " | ". $page_title : ""; 
		?>
	</title>
	
	<link rel="shortcut icon" href="<?php echo BASEDIR . "assets/" . $path_template ."/" ?>favicon/favicon.ico">
	
	<?php $this->load->view($path_template.'/include/global/css'); ?>
</head>