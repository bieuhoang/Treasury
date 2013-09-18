<div class="container box">
	<div class="row">
		<div class="span12">
			<div class="box-content">
				<div class="page-header">
					<h2><?php echo $heading ?></h2>
				</div>
				<?php echo form_open('admin/user/edit', 'class="form-horizontal"') ?>
				<?php echo form_hidden('id', isset($user) ? $user->id : 0) ?>
				<div class="control-group">
					<label for="" class="control-label">Email (use to login)</label>
					<div class="controls">
						<input type="text" name="email" value="<?php echo set_value('email', isset($user) ? $user->email : '') ?>">
					</div>
				</div>

				<div class="control-group">
					<label for="" class="control-label">Username</label>
					<div class="controls">
						<input type="text" name="username" value="<?php echo set_value('username', isset($user) ? $user->username : '') ?>">
					</div>
				</div>

				<div class="control-group">
					<label for="" class="control-label">Password</label>
					<div class="controls">
						<input type="password" name="password" value="" id="password">
					</div>
				</div>

				<div class="control-group">
					<label for="" class="control-label">Retype password</label>
					<div class="controls">
						<input type="password" name="repassword" value="">
					</div>
				</div>

				<div class="control-group">
					<label for="" class="control-label">First name</label>
					<div class="controls">
						<input type="text" name="first_name" value="<?php echo set_value('first_name', isset($user) ? $user->first_name : '') ?>">
					</div>
				</div>

				<div class="control-group">
					<label for="" class="control-label">Last name</label>
					<div class="controls">
						<input type="text" name="last_name" value="<?php echo set_value('last_name', isset($user) ? $user->last_name : '') ?>">
					</div>
				</div>

				<div class="control-group">
					<label for="" class="control-label">Company</label>
					<div class="controls">
						<input type="text" name="company" value="<?php echo set_value('company', isset($user) ? $user->company : '') ?>">
					</div>
				</div>

				<div class="control-group">
					<label for="" class="control-label">Phone</label>
					<div class="controls">
						<input type="text" name="phone" value="<?php echo set_value('phone', isset($user) ? $user->phone : '') ?>">
					</div>
				</div>

				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</div>

				<?php echo form_close() ?>
			</div>
		</div>
	</div>
</div>