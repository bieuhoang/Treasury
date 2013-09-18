<div class="container box">
	<div class="row">
		<div class="span5">
			<div class="box-content">
				<div class="page-header">
					<h2>Add new category</h2>
				</div>
				<?php if(!isset($cat)): ?>
				<?php echo form_open('admin/category/add', 'class="form-horizontal"') ?>
				<?php else: ?>
				<?php echo form_open('admin/category/update', 'class="form-horizontal"') ?>
				<input type="hidden" name="id" value="<?php echo $cat->id ?>">
				<?php endif ?>
				<div class="control-group">
					<label class="control-label">Title</label>
					<div class="controls">
						<input type="text" name="title" value="<?php echo set_value('title', isset($cat) ? $cat->title : '') ?>" class="xx-large">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Title</label>
					<div class="controls">
						<textarea name="description" id="" cols="30" rows="10"><?php echo isset($cat) ? $cat->description : '' ?></textarea>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-primary"><?php echo isset($cat) ? 'Update' : 'Save' ?></button>
					</div>
				</div>
				<?php echo form_close() ?>
			</div>
		</div>
		<div class="span7">
			<div class="page-header">
				<h2>Management</h2>
			</div>
			<?php echo form_open('admin/category/delete', 'id="form-management"') ?>

			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Titlte</th>
						<th>Description</th>
						<th>Num of stores</th>
						<th>Actions</th>
					</tr>
				</thead>

				<tbody>
					<?php if(isset($items) and count($items)): ?>
						<?php foreach($items as $item): ?>
						<tr id="row<?php echo $item->id ?>">
							<td><?php echo $item->id ?></td>
							<td><?php echo anchor('admin/category/index/'.$item->id, $item->title) ?></td>
							<td><?php echo $item->description ?></td>
							<td><?php echo count($item->stores()) ?></td>
							<td>
								<a class="action delete" data-action="remove" href="javascript:;" data-id="<?php echo $item->id ?>" title="Remove" data-toggle="tooltip"><span class="icon-remove"></span></a>
							</td>
						</tr>
						<?php endforeach ?>
					<?php else: ?>
						<tr>
							<td colspan="7">No category not found.</td>
						</tr>
					<?php endif ?>
				</tbody>

				<input type="hidden" id="item-id" name="id" value="">

			</table>

			<?php echo form_close() ?>
		</div>
	</div>
</div>