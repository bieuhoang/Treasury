<div class="row-fluid">
	<div class="span3"></div>
	<div class="span6">
		<?php echo form_open('login', 'class="form-horizontal"') ?>

		
		<fieldset>
			<legend>Login</legend>

			<?php if(isset($message)): ?>
			<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $message ?>
			</div>
			<?php endif ?>

			<div class="control-group">
				<label class="control-label" for="form-email">Username</label>
				<div class="controls">
					<input type="text" name="form[email]" autocomplete="off" id="form-email">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="form-password">Password</label>
				<div class="controls">
					<input type="password" name="form[password]" autocomplete="off" id="form-password">
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<label class="checkbox">
						<input type="checkbox" name="remember"> Remember me
					</label>
					<button type="submit" class="btn btn-primary">Sign in</button>
					<a href="register"><input type="button" class="btn btn-primary" value = "No account? Register here"></a>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<?php echo anchor('forgot-password', 'Forgot your password?') ?>
				</div>
			</div>
		</fieldset>

		<?php echo form_close() ?>
	</div>
</div>