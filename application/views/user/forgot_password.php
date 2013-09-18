<div class="row">
	<div class="span3"></div>
	<div class="span6">
		<?php echo form_open('forgot-password', 'class="form-horizontal"') ?>

		<fieldset>
			<legend>Forgot password</legend>

			<?php if(isset($message)): ?>
			<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $message ?>
			</div>
			<?php endif ?>

			<div class="control-group">
				<label class="control-label" for="form-email">Email</label>
				<div class="controls">
					<input type="text" name="email" id="form-email" class="input-xlarge">
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<?php echo anchor('login', 'Back to login?') ?>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<button type="submit" class="btn btn-primary">Send request</button>
				</div>
			</div>
		</fieldset>

		<?php echo form_close() ?>
	</div>
</div>