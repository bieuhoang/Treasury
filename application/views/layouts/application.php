<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="<?php echo config_item('charset') ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="application-name" content="<?php echo config_item('site_name') ?>">
	<meta name="author" content="<?php echo config_item('meta_author') ?>">
	<meta name="description" content="<?php echo config_item('meta_description') ?>">
	<meta name="keywords" content="<?php echo config_item('meta_keywords') ?>">
	<meta name="generator" content="<?php echo config_item('meta_generator') ?>">
	<meta NAME="robots" content="index,follow">
	<title><?php echo $site_name ?></title>
	<!-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> -->
	<?php echo get_styles() ?>
	<script type="text/javascript">
		window.site = <?php echo json_encode($site_config) ?>;
		<?php echo config_item('ga_code') ?>
	</script>
</head>
<body>
	<noscript>Your browser does not support JavaScript!</noscript>

	<?php echo $this->template->block('top_navigation') ?>
	
	<div class="mt40">
		
		<div class="row-fluid">

			<div class="span12">
				<?php echo $this->template->message(); ?>
			
				<?php echo $this->template->yield(); ?>
			</div>
			
		</div>


	</div>

	<footer class="footer">		
		<div class="container">			
			<div class="row">				
				<p class="pull-right">&copy <?php echo date('Y') ?> Copyright by <?php echo $this->config->item('site_name') ?>. All rights reserved.</p>
			</div>
		</div>
	</footer>

	<!-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> -->
	<?php echo get_scripts() ?>
	<!-- Page rendered in <strong>{elapsed_time}</strong> seconds. Memory usage: <strong>{memory_usage}</strong>. -->
</body>
</html>