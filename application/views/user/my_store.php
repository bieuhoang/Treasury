<div class="container">
	<div class="row-fluid">
		<div class="span3 mt30">
			<?php echo $this->template->block('user_sidebar') ?>
		</div>
		<div class="span9 box">
			<div class="box-content">
				<div class="page-header">
					<h2>My Store</h2>
				</div>
				
				<?php echo form_open() ?>

				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Title</th>
							<th>From</th>
							<th>To</th>
							<th>Public Pages</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td colspan="5"><?php echo isset($pagination_links) ? $pagination_links : '' ?></td>
						</tr>
					</tfoot>
					<tbody>
						<?php if(isset($items) and count($items)): ?>
							<?php foreach($items as $item): ?>
								<tr>
									<td><?php echo $item->id ?></td>
									<td><?php echo anchor('user/edit_promotion/'.$item->id, $item->title) ?></td>
									<td><?php echo $item->date_from ?></td>
									<td><?php echo $item->date_to ?></td>
									<td><a href="<?php echo $item->url() ?>" target="_blank" title="About this promotion ">DETAILS</a></td>
									<td>
										<a href="javascript:;" class="actions" data-action="delete" data-id="<?php echo $item->id ?>" data-toggle="tooltip" title="Remove"><span class="icon-remove"></span></a>
										<a href="javascript:;" class="actions" data-action="edit" data-id="<?php echo $item->id ?>" data-toggle="tooltip" title="Edit"><span class="icon-edit"></span></a>
										<a href="javascript:;" class="actions" data-action="<?php echo $item->status ? 'block' : 'active' ?>" data-id="<?php echo $item->id ?>" data-toggle="tooltip" title="<?php echo $item->status ? 'Block' : 'Active' ?>"><span class="icon-<?php echo $item->status ? 'ban-circle' : 'random' ?>"></span></a>
									</td>
								</tr>
							<?php endforeach ?>
						<?php else: ?>
						<tr>
							<td colspan="5">No promotion found</td>
						</tr>
						<?php endif ?>
					</tbody>
				</table>

				<?php echo form_close() ?>

			</div>
		</div>
	</div>
</div>