<div class="container">
	<div class="row-fluid">
		<div class="span3"></div>
		<div class="span6">
			<?php echo form_open('', 'class="form-horizontal" id="form-register"') ?>

			<fieldset>				
				<legend>Register for shop owner</legend>

				<div class="control-group">
					<label for="form-username" class="control-label">Username</label>
					<div class="controls">
						<input type="text" name="form[username]" value="" placeholder="Username">
					</div>
				</div>

				<div class="control-group">
					<label for="form-password" class="control-label">Password</label>
					<div class="controls">
						<input type="password" id="password" name="form[password]" value="" placeholder="Password">
					</div>
				</div>

				<div class="control-group">
					<label for="form-re-password" class="control-label">Retype password</label>
					<div class="controls">
						<input type="password" name="form[repassword]" value="" placeholder="Retype password">
					</div>
				</div>

				<div class="control-group">
					<label for="form-email" class="control-label">Email address</label>
					<div class="controls">
						<input type="email" name="form[email]" value="" placeholder="name@domain.com">
					</div>
				</div>

				<div class="control-group">
					<label for="form-first_name" class="control-label">First name</label>
					<div class="controls">
						<input type="text" name="form[first_name]" value="" placeholder="First name">
					</div>
				</div>

				<div class="control-group">
					<label for="form-last_name" class="control-label">Last name</label>
					<div class="controls">
						<input type="text" name="form[last_name]" value="" placeholder="Last name">
					</div>
				</div>

				<div class="control-group">
					<label for="form-address" class="control-label">Address</label>
					<div class="controls">
						<input type="text" name="form[address]" value="" placeholder="Address">
					</div>
				</div>

				<div class="control-group">
					<label for="form-zip" class="control-label">Zip</label>
					<div class="controls">
						<input type="text" name="form[zip]" value="" placeholder="Zip">
					</div>
				</div>

				<div class="control-group">
					<label for="form-city" class="control-label">City</label>
					<div class="controls">
						<input type="text" name="form[city]" value="" placeholder="City">
					</div>
				</div>

				<div class="control-group">
					<label for="form-logo" class="control-label">Category</label>
					<div class="controls">
						<select name="cat_id" id="">
							<option value="">Select a category</option>
							<?php foreach($categories as $cat): ?>
							<option value="<?php echo $cat->id ?>"><?php echo $cat->title ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>

				<div class="control-group">
					<label for="form-logo" class="control-label">Logo</label>
					<div class="controls">
						<input type="file" name="userfile" value="" placeholder="Logo">
					</div>
				</div>

				<div class="control-group">
					<label for="form" class="control-label"></label>
					<div class="controls">
						<button type="submit" class="btn btn-primary">Register</button>
					</div>
				</div>

				<div class="control-group">
					<div class="controls">
						<?php echo anchor('register', 'Register for normal user?') ?>
					</div>
				</div>
			</fieldset>

			<?php echo form_close() ?>
		</div>
		<div class="span3"></div>
	</div>
</div>