<div class="container">
	<div class="row-fluid">
		<div class="span12">
			<div class="page-title mb10">
				<h3 class="box-title edit-title" data-name="<?php echo $page->code ?>"><?php echo $page->title ?></h3>
			</div>
			<div id="page-content-<?php echo $page->code ?>">
				<?php echo $page->content ?>
			</div>

			<?php if($this->auth->is_admin()): ?>
			<a href="#" title="Edit" data-title="<?php echo $page->title ?>" data-page="<?php echo $page->code ?>" class="edit-page btn pull-right btn-primary">Edit</a>
			<?php endif ?>
		</div>
	</div>
</div>