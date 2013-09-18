<div class="container">
	<div class="row-fluid">
		<div class="span12">
			<div class="page-title mb10">
				<h3 class="box-title">About us</h3>
			</div>
			<div id="page-content-page_about_us">
				<?php echo $this->config->item('page_about_us') ?>
			</div>

			<?php if($this->auth->is_admin()): ?>
			<a href="#" title="Edit" data-title="About us" data-page="page_about_us" class="edit-page btn btn-primary pull-right">Edit</a>
			<?php endif ?>
		</div>
	</div>
</div>