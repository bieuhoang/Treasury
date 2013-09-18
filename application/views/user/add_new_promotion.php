<div class="container">
	<div class="row-fluid">
		<div class="span3 mt30">
			<?php echo $this->template->block('user_sidebar') ?>
		</div>
		<div class="span9 box">
			<div class="box-content">
					
				<div class="page-header">
					<h2>Add new promotion</h2>
				</div>


				<?php echo form_open('', 'class="form-horizontal" id="form-add-new-promotion"') ?>

				<fieldset>
					<div class="control-group">
						<label for="" class="control-label">Title</label>
						<div class="controls">
							<input type="text" name="title" class="input-xxlarge" value="<?php echo set_value('title') ?>">
						</div>
					</div>

					<div class="control-group">
						<label for="" class="control-label">Content</label>
						<div class="controls">
							<textarea name="content" id="content" class="input-xxlarge" rows="3"><?php echo set_value('content') ?></textarea>
						</div>
					</div>

					<div class="control-group">
						<label for="" class="control-label">Image</label>
						<div class="controls">
							<input type="file" name="userfile">
						</div>
					</div>

					<div class="control-group">
						<label for="" class="control-label">Date from</label>
						<div class="controls">
							<input type="text" id="date_from_date" class="input-small" name="date_from_date" value="<?php echo set_value('date_from_date') ?>">
							<input type="text" id="date_from_time" class="input-mini" name="date_from_time" value="<?php echo set_value('date_from_time') ?>">
						</div>
					</div>

					<div class="control-group">
						<label for="" class="control-label">Date to</label>
						<div class="controls">
							<input type="text" id="date_to_date" class="input-small" name="date_to_date" value="<?php echo set_value('date_to_date') ?>">
							<input type="text" id="date_to_time" class="input-mini" name="date_to_time" value="<?php echo set_value('date_to_time') ?>">
						</div>
					</div>
				</fieldset>

				<fieldset>
					<legend>Audience</legend>
					<div class="control-group">
						<label for="" class="control-label">Gender</label>
						<div class="controls">
							<select name="gender_limit">
								<option value="" selected>All genders</option>
								<option value="male">Male</option>
								<option value="female">Female</option>
							</select>
						</div>
					</div>

					<div class="control-group">
						<label for="" class="control-label">Age</label>
						<div class="controls">
							<select name="age_limit">
								<option value="" selected>All ages</option>
								<option value="18-25">18-25</option>
								<option value="25-30">25-30</option>
								<option value="30-40">30-40</option>
								<option value="40+">40+</option>
							</select>
						</div>
					</div>					
				</fieldset>
	
				<fieldset>
					<legend></legend>
					<div class="control-group">
						<label for="" class="control-label">Status</label>
						<div class="controls">
							<select name="status">
								<?php foreach(array(
									'1' => 'Active',
									'0' => 'Block'
								) as $value => $label): ?>
								<option value="<?php echo $value ?>"><?php echo $label ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>
					<div class="control-group">
						<label for="" class="control-label"></label>
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