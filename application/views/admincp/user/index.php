<div class="container box">
	<div class="row">
		<div class="span12">
			<div class="box-content">
				<div class="page-header">
					<h2>Users management</h2>
				</div>
				<?php echo form_open() ?>

				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Username</th>
							<th>Email</th>
							<th>Fullname</th>
							<th>Register date</th>
							<th>Group</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>

					<tbody>
						<?php if(isset($items) and count($items)): ?>
							<?php foreach($items as $item): ?>
							<tr id="row<?php echo $item->id ?>">
								<td><?php echo $item->id ?></td>
								<td><?php echo $item->id != 1 ? anchor('admin/user/edit/'.$item->id, $item->username) : $item->username ?></td>
								<td><?php echo $item->email ?></td>
								<td><?php echo $item->fullname() ?></td>
								<td><?php echo $item->register_date() ?></td>
								<td><?php echo $item->group_name() ?></td>
								<td><?php echo $item->status() ?></td>
								<td>
									<?php if($item->id != 1): ?>
										<a class="item-action" href="<?php echo site_url('admin/user/edit/'.$item->id) ?>" title="Edit" data-toggle="tooltip"><span class="icon-edit"></span></a>
										<a class="item-action" data-action="remove" href="javascript:;" data-id="<?php echo $item->id ?>" title="Remove" data-toggle="tooltip"><span class="icon-remove"></span></a>
										<?php if($item->active == 1): ?>
										<a class="item-action" data-action="block" href="javascript:;" data-id="<?php echo $item->id ?>" title="Block" data-toggle="tooltip"><span class="icon-ban-circle"></span></a> 
										<?php else: ?>
										<a class="item-action" data-action="active" href="javascript:;" data-id="<?php echo $item->id ?>" title="Active" data-toggle="tooltip"><span class="icon-ok-circle"></span></a> 
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

				</table>

				<?php echo form_close() ?>
			</div>
		</div>
	</div>
</div>