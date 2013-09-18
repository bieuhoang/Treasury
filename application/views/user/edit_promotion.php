<div class="container">
	<div class="row-fluid">
		<div class="span3 mt30">
			<?php echo $this->template->block('user_sidebar') ?>
		</div>
		<div class="span9 box">
			<div class="box-content">
				<div class="page-header">
					<h2>Edit promotion: #<?php echo $this->promotion->id ?></h2>
				</div>

				<?php echo form_open('', 'class="form-horizontal" id="form-edit-promotion"') ?>

				<fieldset>					
					<div class="control-group">
						<label for="" class="control-label">Title</label>
						<div class="controls">
							<input type="text" name="title" class="input-xxlarge" value="<?php echo set_value('title', $this->promotion->title) ?>">
						</div>
					</div>

					<div class="control-group">
						<label for="" class="control-label">Content</label>
						<div class="controls">
							<textarea name="content" id="content" class="input-xxlarge" rows="3"><?php echo set_value('content', $this->promotion->content) ?></textarea>
						</div>
					</div>

					<div class="control-group">
						<label for="" class="control-label">Image</label>
						<div class="controls">
							<input type="file" name="userfile">
							<?php if($this->promotion->image !== ''): ?>
							<img class="avatar" id="image-promotion" src="<?php echo base_url($this->promotion->image) ?>" width="150">
							<?php endif ?>
						</div>
					</div>

					<div class="control-group">
						<label for="" class="control-label">Date from</label>
						<div class="controls">
							<input type="text" id="date_from_date" class="input-small" name="date_from_date" value="<?php echo set_value('date_from_date', date('m/d/Y', strtotime($this->promotion->date_from))) ?>">
							<input type="text" id="date_from_time" class="input-mini" name="date_from_time" value="<?php echo set_value('date_from_time', date('h:i a', strtotime($this->promotion->date_from))) ?>">
						</div>
					</div>

					<div class="control-group">
						<label for="" class="control-label">Date to</label>
						<div class="controls">
							<input type="text" id="date_to_date" class="input-small" name="date_to_date" value="<?php echo set_value('date_to_date', date('m/d/Y', strtotime($this->promotion->date_to))) ?>">
							<input type="text" id="date_to_time" class="input-mini" name="date_to_time" value="<?php echo set_value('date_to_time', date('h:i a', strtotime($this->promotion->date_to))) ?>">
						</div>
					</div>
				</fieldset>
	
				<fieldset>
					<legend>Audience</legend>
					<div class="control-group">
						<label for="" class="control-label">Gender</label>
						<div class="controls">
							<select name="gender_limit">
								<?php foreach(array(
									'' => 'All genders',
									'Male' => 'Male',
									'Female' => 'Female'
								) as $value => $label): ?>
								<option value="<?php echo $value ?>"<?php echo $value == $this->promotion->gender_limit ? ' selected' : '' ?>><?php echo $label ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>

					<div class="control-group">
						<label for="" class="control-label">Age</label>
						<div class="controls">
							<select name="age_limit">
								<?php foreach(array(
									'' => 'All ages',
									'18-25' => '18-25',
									'25-30' => '25-30',
									'30-40' => '30-40',
									'40+' => '40+'
								) as $value => $label): ?>
								<option value="<?php echo $value ?>" <?php echo $value == $this->promotion->age_limit ? 'selected' : '' ?>><?php echo $label ?></option>
								<?php endforeach ?>
							</select>
						</div>
					</div>					
				</fieldset>
				
				<fieldset>
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