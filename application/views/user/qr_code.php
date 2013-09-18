<div class="container">
	<div class="row-fluid">
		<div class="span3 mt30">
			<?php echo $this->template->block('user_sidebar') ?>
		</div>
		<div class="span9 box">
			<div class="box-content">
				<div class="page-header">
					<h2>QR Code</h2>
				</div>
				<?php echo form_open('', 'class="form-horizontal" id="user-change-password-form"') ?>
			
				<fieldset>
					
					<div class="control-group">
						<label for="retype-password" class="control-label">QR Code</label>
						<div class="controls">
							<input type="text" name="qr_code" value="<?php echo $this->current_user->qr_code ?>">
							<?php if($this->current_user->qr_code !== ''): ?>
								<div class="mt10"><?php echo qr_code($this->current_user->qr_code, 150, 150) ?></div>
							<?php endif ?>
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<button type="submit" class="btn btn-primary">Create</button>
						</div>
					</div>

				</fieldset>

				<?php echo form_close() ?>
			</div>
		</div>
	</div>
</div>