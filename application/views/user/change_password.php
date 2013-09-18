<div class="container">
	<div class="row-fluid">
		<div class="span3 mt30">
			<?php echo $this->template->block('user_sidebar') ?>
		</div>
		<div class="span9 box">
			<div class="box-content">
				<div class="page-header">
					<h2>Change password</h2>
				</div>
				<?php echo form_open('', 'class="form-horizontal" id="user-change-password-form"') ?>
			
				<fieldset>

					<div class="control-group">
						<label for="current-password" class="control-label">Current password</label>
						<div class="controls">
							<input type="password" name="current_password" value="">
						</div>
					</div>
					<div class="control-group">
						<label for="new-password" class="control-label">New password</label>
						<div class="controls">
							<input type="password" name="password" id="password" value="">
						</div>
					</div>
					<div class="control-group">
						<label for="retype-password" class="control-label">Retype password</label>
						<div class="controls">
							<input type="password" name="repassword" value="">
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<button type="submit" class="btn btn-primary">Save changes</button>
						</div>
					</div>

				</fieldset>

				<?php echo form_close() ?>
			</div>
		</div>
	</div>
</div>