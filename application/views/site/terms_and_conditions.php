<div class="container">
	<div class="row-fluid">
		<div class="span12">
			<div class="page-title mb10">
				<h3 class="box-title">Terms and Conditions</h3>
			</div>
			
			<div id="page-content-page_terms_and_conditions">
				<?php echo $this->config->item('page_terms_and_conditions') ?>
			</div>

			<?php if($this->auth->is_admin()): ?>
			<a href="#" title="Edit" data-title="Terms and Conditions" data-page="page_terms_and_conditions" class="edit-page btn btn-primary pull-right">Edit</a>
			<?php endif ?>
		</div>
	</div>
</div>