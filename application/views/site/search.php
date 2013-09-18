<div class="container">
	<div class="row-fluid">
		<div class="span12">
			<div class="row-fluid">
				<div class="span3"></div>
				<div class="span7">
					<?php echo form_open('search', 'class="form-search" id="form-search-map"'); ?>
						<input type="text" class="input-xxlarge search-query" id="search-input" value="<?php echo config_item('query_string') ?>" placeholder="Input your location and press Enter to search promotions...">
						<button type="submit" class="btn btn-primary">Search</button>
					<?php echo form_close() ?>
				</div>
				<div class="span2"></div>
			</div>

			<div class="row-fluid">
				<div class="span12">
					<div id="map-container"></div>
				</div>				
			</div>
		</div>
	</div>
</div>