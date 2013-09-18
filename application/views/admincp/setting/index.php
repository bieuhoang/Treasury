<div class="container box">
	<div class="row">
		<div class="span12">
			<div class="box-content">
				<div class="page-header">
					<h1>Settings</h1>
				</div>

				<?php echo form_open('', 'class="form-horizontal"') ?>

				<div class="control-group">
					<label for="setting-site-name" class="control-label">Site name:</label>
					<div class="controls">
						<?php echo form_input('form[site_name]', config_item('site_name'), 'class="span6"') ?>
					</div>
				</div>

				<div class="control-group">
					<label for="setting-site-description" class="control-label">Site description:</label>
					<div class="controls">
						<?php echo form_input('form[site_description]', config_item('site_description'), 'class="span6"') ?>
					</div>
				</div>

				<div class="control-group">
					<label for="setting-meta-keywords" class="control-label">Meta keywords:</label>
					<div class="controls">
						<?php echo form_input('form[meta_keywords]', config_item('meta_keywords'), 'class="span6"') ?>
					</div>
				</div>

				<div class="control-group">
					<label for="setting-meta-description" class="control-label">Meta description:</label>
					<div class="controls">
						<?php echo form_input('form[meta_description]', config_item('meta_description'), 'class="span6"') ?>
					</div>
				</div>

				<div class="control-group">
					<label for="setting-ga-code" class="control-label">GA code:</label>
					<div class="controls">
						<?php echo form_textarea('form[ga_code]', config_item('ga_code'), 'class="span6"') ?>
					</div>
				</div>

				<div class="control-group">
					<label for="setting-meta-description" class="control-label">Send mail to user register:</label>
					<div class="controls">
					
					</div>
				</div>

				<fieldset>
					<legend>Messages (For user register):</legend>

					<div class="control-group">
						<label for="setting-email-smtp-host" class="control-label">Subject:</label>
						<div class="controls">
							<?php echo form_input('form[message_register_subject]', config_item('message_register_subject'), 'class="span6"') ?>
						</div>
					</div>

					<div class="control-group">
						<label for="setting-email-smtp-host" class="control-label">Content:</label>
						<div class="controls">
							<p>Use shortcode: <strong>{username}</strong>, <strong>{email}</strong>, <strong>{password}</strong>, <strong>{site_url}</strong></p>
							<?php echo form_textarea('form[message_register_content]', config_item('message_register_content'), 'class="span6 wysiwyg"') ?>
						</div>
					</div>
				</fieldset>

				<fieldset>
					<legend>Email SMTP Config</legend>

					<div class="control-group">
						<label for="setting-email-smtp-host" class="control-label">Host:</label>
						<div class="controls">
							<?php echo form_input('form[email_smtp_host]', config_item('email_smtp_host'), 'class="span6"') ?>
						</div>
					</div>

					<div class="control-group">
						<label for="setting-email-smtp-port" class="control-label">Port:</label>
						<div class="controls">
							<?php echo form_input('form[email_smtp_port]', config_item('email_smtp_port'), 'class="span6"') ?>
						</div>
					</div>

					<div class="control-group">
						<label for="setting-email-smtp-username" class="control-label">Username:</label>
						<div class="controls">
							<?php echo form_input('form[email_smtp_username]', config_item('email_smtp_username'), 'class="span6"') ?>
						</div>
					</div>

					<div class="control-group">
						<label for="setting-email-smtp-password" class="control-label">Password:</label>
						<div class="controls">
							<?php echo form_input('form[email_smtp_password]', config_item('email_smtp_password'), 'class="span6"') ?>
						</div>
					</div>
				</fieldset>

				<div class="control-group">
					<div class="controls">
						<button type="submit" name="submit" class="btn btn-primary">Save changed</button>
					</div>
				</div>

				<?php echo form_close() ?>
			</div>
		</div>
	</div>
</div>