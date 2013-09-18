<script>
	var IS_SHOP = <?php echo $this->auth->in_group(3) ? 'true' : 'false' ?>;
</script>
<div class="container">
	<div class="row-fluid">
		<div class="span3 mt30">
			<?php echo $this->template->block('user_sidebar') ?>
		</div>
		<div class="span9 box">
			<div class="box-content">
				<div class="page-header">
					<h2>My profile</h2>
				</div>

				<?php echo form_open('user/update_profile', 'class="form-horizontal" id="update-profile"') ?>

				<div class="control-group<?php echo form_error('username') ? ' error' : '' ?>">
					<label for="" class="control-label">Username</label>
					<div class="controls">
						<input type="text" disabled name="username" value="<?php echo set_value('username', $this->current_user->username) ?>"> <?php echo form_error('username') ? ('<span class="help-line">'.form_error('username').'</span>') : '' ?>
					</div>
				</div>

				<div class="control-group">
					<label for="" class="control-label">Email</label>
					<div class="controls">
						<input type="text" name="email" value="<?php echo set_value('email', $this->current_user->email) ?>">
					</div>
				</div>

				<div class="control-group">
					<label for="" class="control-label">First name</label>
					<div class="controls">
						<input type="text" name="first_name" value="<?php echo set_value('first_name', $this->current_user->first_name) ?>">
					</div>
				</div>

				<div class="control-group">
					<label for="" class="control-label">Last name</label>
					<div class="controls">
						<input type="text" name="last_name" value="<?php echo set_value('last_name', $this->current_user->last_name) ?>">
					</div>
				</div>

				<div class="control-group">
					<label for="" class="control-label">Company</label>
					<div class="controls">
						<input type="text" name="company" value="<?php echo set_value('company', $this->current_user->company) ?>">
					</div>
				</div>

				<div class="control-group">
					<label for="" class="control-label">Phone</label>
					<div class="controls">
						<input type="text" name="phone" value="<?php echo set_value('phone', $this->current_user->phone) ?>">
					</div>
				</div>

				<?php if($this->auth->in_group(3)): ?>

				<div class="control-group">
					<label for="" class="control-label">Address</label>
					<div class="controls">
						<input type="text" name="address" value="<?php echo set_value('address', $this->current_user->address) ?>">
					</div>
				</div>

				<div class="control-group">
					<label for="" class="control-label">City</label>
					<div class="controls">
						<input type="text" name="city" value="<?php echo set_value('city', $this->current_user->city) ?>">
					</div>
				</div>

				<div class="control-group">
					<label for="" class="control-label">Zip</label>
					<div class="controls">
						<input type="text" name="zip" value="<?php echo set_value('zip', $this->current_user->zip) ?>">
					</div>
				</div>

				<div class="control-group">
					<label for="" class="control-label">Avatar</label>
					<div class="controls">
						<input type="file" name="userfile">
						<?php if($this->current_user->avatar !== ''): ?>
						<input type="hidden" name="avatar" value="<?php echo $this->current_user->avatar ?>">
						<img class="avatar" src="<?php echo base_url($this->current_user->avatar) ?>" style="width: auto">
						<?php endif ?>
					</div>
				</div>
				<div class="control-group">
					<label for="" class="control-label">Map</label>
					<div class="controls">
						<div class="input-append">
							<input id="address" type="text">
							<button class="btn" type="button" id="search-map">Search Location!</button>
						</div>
						<div id="map-canvas"></div>
					</div>
				</div>

				<div class="control-group">
					<label for="" class="control-label">Public page</label>
					<div class="controls">
						<textarea name="public_text" id="public_text" cols="30" rows="10"><?php echo $this->current_user->public_text ?></textarea>
					</div>
				</div>
				<input type="hidden" id="longitude" name="longitude" value="<?php echo $this->current_user->longitude ?>">
				<input type="hidden" id="latitude" name="latitude" value="<?php echo $this->current_user->latitude ?>">
				<input type="hidden" id="username" name="username" value="<?php echo $this->current_user->username ?>">
				<?php endif ?>

				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</div>

				<?php echo form_close() ?>
			</div>
		</div>
	</div>
</div>