<div class="container">
	<div class="row">
		<div class="span12">
			<div class="content">
				<?php echo form_open('', 'class="form-horizontal"') ?>

				<input type="hidden" name="id" value="<?php echo $id ?>">

				<div class="control-group">
					<div class="control-label"></div>
					<div class="controls">
						<div class="page-header">
							<h2><?php echo isset($promotion) ? 'Edit: '.$promotion->title : 'Add new' ?></h2>
						</div>						
					</div>
				</div>

				<div class="control-group">
					<div class="control-label">Title</div>
					<div class="controls">
						<input type="text" name="title" class="input-xxlarge" value="<?php echo set_value('title', isset($promotion) ? $promotion->title : '') ?>">
					</div>
				</div>

				<div class="control-group">
					<div class="control-label">Content</div>
					<div class="controls">
						<textarea id="content" name="content" class="input-xxlarge" id="" cols="30" rows="10">
							<?php echo set_value('content', isset($promotion) ? $promotion->content : '') ?>
						</textarea>
					</div>
				</div>

				<div class="control-group">
					<div class="control-label">Store</div>
					<div class="controls">
						<select name="created_by" id="">
							<?php foreach($stores as $store): ?>
							<option value="<?php echo $store->id ?>"<?php echo (isset($promotion) and $promotion->created_by == $store->id) ? 'selected="selected"' : '' ?>><?php echo $store->fullname() ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>

				<div class="control-group">
					<div class="control-label">Image</div>
					<div class="controls">
						<input type="file" name="userfile" class="input-xxlarge">
						<?php if(isset($promotion) and $promotion->image != ''): ?>
							<div class="mt10"><img src="<?php echo $promotion->image(300); ?>" alt=""></div>
						<?php endif ?>
					</div>
				</div>

				<div class="control-group">
					<div class="control-label">Date From</div>
					<div class="controls">
						<input type="text" id="date_from_date" name="date_from_date" value="<?php echo isset($promotion) ? $promotion->date_from('Y-m-d') : '' ?>" class="input input-small">
						<input type="text" id="date_from_time" name="date_from_time" value="<?php echo isset($promotion) ? $promotion->date_from('h:i a') : '' ?>" class="input input-mini">
					</div>
				</div>

				<div class="control-group">
					<div class="control-label">Date to</div>
					<div class="controls">
						<input type="text" id="date_to_date" name="date_to_date" value="<?php echo isset($promotion) ? $promotion->date_to('Y-m-d') : '' ?>" class="input input-small">
						<input type="text" id="date_to_time" name="date_to_time" value="<?php echo isset($promotion) ? $promotion->date_to('h:i a') : '' ?>" class="input input-mini">
					</div>
				</div>

				<div class="control-group">
					<div class="control-label">Gender</div>
					<div class="controls">
						<select name="gender_limit" id="">
							<?php foreach(array('All genders', 'Male', 'Female') as $gender): ?>
							<option value="<?php echo $gender ?>"<?php echo (isset($promotion) and $promotion->gender_limit == $gender) ? 'selected="selected"' : '' ?>><?php echo $gender ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>

				<div class="control-group">
					<div class="control-label">Age</div>
					<div class="controls">
						<select name="age_limit" id="">
							<?php foreach(array('All ages', '18-25', '25-30', '30-40', '40+') as $age): ?>
							<option value="<?php echo $age ?>" <?php echo (isset($promotion) and $promotion->age_limit == $age) ? 'selected="selected"' : '' ?>><?php echo $age ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>

				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-primary" name="submited"><?php echo isset($promotion) ? 'Save changes' : 'Add new' ?></button>
					</div>
				</div>

				<?php echo form_close() ?>
			</div>
		</div>
	</div>
</div>