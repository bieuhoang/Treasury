<div class="container">
	<div class="row">
		<div class="span12">
			<div class="page-header">
				<h2>Promotion</h2>
			</div>

			<?php echo form_open() ?>

			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Image</th>
						<th>From - To</th>
						<th>Shop</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>

				<tbody>
					<?php if(isset($items) and count($items)): ?>
						<?php foreach($items as $item): ?>
						<tr id="row<?php echo $item->id ?>">
							<td><?php echo $item->id ?></td>
							<td><?php echo anchor('admin/promotion/edit/'.$item->id, $item->title) ?></td>
							<td><?php if($item->image != ''): ?><img src="<?php echo $item->image() ?>"/><?php endif ?></td>
							<td><?php echo $item->date_from().' - '.$item->date_to() ?></td>
							<td><?php echo $item->owner()->fullname() ?></td>
							<td id='statusName<?php echo $item->id ?>'><?php echo $item->status() ?></td>
							<td>
								<?php if($item->id != 1): ?>
									<a class="item-action" data-action="remove" href="javascript:;" data-id="<?php echo $item->id ?>" title="Remove" data-toggle="tooltip"><span class="icon-remove"></span></a>
									<?php if($item->status == 1): ?>
									<a class="item-action item-action<?php echo $item->id ?>" thisStatus="0"  nextStatus="<?php echo $item->status?>" changeTo="InActive" data-action="block" href="javascript:;" data-id="<?php echo $item->id ?>" title="Block" data-toggle="tooltip"><span class="icon-ok-circle"></span></a>
									<a class="item-action item-action<?php echo $item->id ?>" thisStatus="2" nextStatus="<?php echo $item->status?>" changeTo="Pending" data-action="pending" href="javascript:;" data-id="<?php echo $item->id ?>" title="Pending" data-toggle="tooltip"><span class="icon-time"></span></a>
									<?php endif ?>
									<?php if($item->status == 0): ?>
									<a class="item-action item-action<?php echo $item->id ?>" thisStatus="1" nextStatus="<?php echo $item->status?>" changeTo="Active" data-action="active" href="javascript:;" data-id="<?php echo $item->id ?>" title="Active" data-toggle="tooltip"><span class="icon-ban-circle"></span></a>
									<a class="item-action item-action<?php echo $item->id ?>" thisStatus="2" nextStatus="<?php echo $item->status?>" changeTo="Pending" data-action="pending" href="javascript:;" data-id="<?php echo $item->id ?>" title="Pending" data-toggle="tooltip"><span class="icon-time"></span></a>
									<?php endif ?>
									<?php if($item->status == 2): ?>
									<a class="item-action item-action<?php echo $item->id ?>" thisStatus="0" nextStatus="<?php echo $item->status?>" changeTo="InActive" data-action="block" href="javascript:;" data-id="<?php echo $item->id ?>" title="Block" data-toggle="tooltip"><span class="icon-ok-circle"></span></a>
									<a class="item-action item-action<?php echo $item->id ?>" thisStatus="1" nextStatus="<?php echo $item->status?>" changeTo="Active" data-action="active" href="javascript:;" data-id="<?php echo $item->id ?>" title="Active" data-toggle="tooltip"><span class="icon-ban-circle"></span></a>
									<?php endif ?>
								<?php endif ?>
							</td>
						</tr>
						<?php endforeach ?>
					<?php else: ?>
						<tr>
							<td colspan="7">No user not found.</td>
						</tr>
					<?php endif ?>
				</tbody>

				<tfoot>
					<tr>
						<td colspan="7"><?php echo $pagination_links ?></td>
					</tr>
				</tfoot>

			</table>

			<?php echo form_close() ?>
		</div>
	</div>
</div>