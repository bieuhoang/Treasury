<div class="container mt30">
	<div class="row-fluid">
		<div class="span12">
			<div class="span7 offset2">
				<?php echo form_open('search', 'class="form-search" id="form-search-map"'); ?>
					<input type="text" class="input-xxlarge search-query" id="search-input" value="<?php echo config_item('query_string') ?>" placeholder="Search for your registered shops...">
					<button type="submit" class="btn btn-primary">Search</button>
				<?php echo form_close() ?>
			</div>

			<div id="map-container"></div>
		</div>
	</div>
</div>