<div class="container">
	<div class="row-fluid">
		<div class="span3"></div>
		<div class="span6">
			<?php echo form_open('', 'class="form-horizontal" id="form-register"') ?>

			<?php echo isset($form_errors) ? $form_errors : '' ?>

			<fieldset>				
				<legend>Register for normal user</legend>

				<div class="control-group">
					<label for="form-username" class="control-label">Username</label>
					<div class="controls">
						<input type="text" class="inputTxtForm" name="form[username]" value="" placeholder="Username">
					</div>
				</div>

				<div class="control-group">
					<label for="form-password" class="control-label">Password</label>
					<div class="controls">
						<input type="password" class="inputPwForm" id="password" name="form[password]" value="" placeholder="Password">
					</div>
				</div>

				<div class="control-group">
					<label for="form-re-password"  class="control-label">Retype password</label>
					<div class="controls">
						<input type="password" class="inputPwForm" name="form[repassword]" value="" placeholder="Retype password">
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
						<input type="text" class="inputTxtForm" name="form[first_name]" value="" placeholder="First name">
					</div>
				</div>

				<div class="control-group">
					<label for="form-last_name" class="control-label">Last name</label>
					<div class="controls">
						<input type="text" class="inputTxtForm" name="form[last_name]" value="" placeholder="Last name">
					</div>
				</div>

				<div class="control-group">
					<label for="form-gender" class="control-label">Gender</label>
					<div class="controls">
						<select name="form[gender]">
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
					</div>
				</div>

				<div class="control-group">
					<label for="form-birthday" class="control-label">Birthday</label>
					<div class="controls">
						<input type="text" class="inputTxtForm" name="form[birthday]" class="datepicker" value="" placeholder="99/99/9999">
					</div>
				</div>

				<div class="control-group">
					<label for="form-company" class="control-label">Company</label>
					<div class="controls">
						<input type="text" class="inputTxtForm" name="form[company]" value="" placeholder="Company">
					</div>
				</div>

				<div class="control-group">
					<label for="form-phone" class="control-label">Phone</label>
					<div class="controls">
						<input type="text" class="inputTxtForm" name="form[phone]" value="" placeholder="Phone">
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
						<?php echo anchor('register-shop', 'Register for shop owner?') ?>
					</div>
				</div>
			</fieldset>

			<?php echo form_close() ?>
		</div>
		<div class="span3"></div>
	</div>
</div>