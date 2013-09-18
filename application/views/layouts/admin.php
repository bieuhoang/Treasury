<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="<?php echo config_item('charset') ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="application-name" content="<?php echo config_item('site_name') ?>">
	<meta name="author" content="<?php echo config_item('meta_author') ?>">
	<title><?php echo $site_name ?></title>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false" type="text/javascript"></script>
	<?php echo get_styles() ?>
	<script type="text/javascript">
		window.site = <?php echo json_encode($site_config) ?>;
	</script>
</head>
<body>
	<noscript>Your browser does not support JavaScript!</noscript>

	<!-- top navigation -->
	<?php echo $this->template->block('top_navigation') ?>
	<!-- /top navigation -->
	
	<div class="container mt60">
		
		<div class="row sd">

			<div class="span12">
				<?php echo $this->template->message(); ?>
			
				<?php echo $this->template->yield(); ?>
			</div>
			
		</div>

	</div>

	<?php echo get_scripts() ?>
	<!-- Page rendered in <strong>{elapsed_time}</strong> seconds. Memory usage: <strong>{memory_usage}</strong>. -->
</body>
</html>