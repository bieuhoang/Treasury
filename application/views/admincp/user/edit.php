<div class="container box">
	<div class="row">

		<div class="span10 offset1 mt20">
			<?php if( !isset($user) ): ?>
			<ul class="nav nav-tabs" id="myTab">
				<li class="active"><a href="#normal-user">Normal User</a></li>
				<li><a href="#store-user">Store User</a></li>
				<li><a href="#admin-user">Administrator</a></li>
			</ul>
			<?php endif ?>

			<div class="tab-content">
				<?php if(!isset($user) || (isset($user) and in_array(2, $users_groups))): ?>
				<div class="tab-pane active" id="normal-user">
					<?php echo form_open('admin/user/edit', 'class="form-horizontal" id="normal-user-form"') ?>

						<?php echo form_hidden('id', isset($user) ? $user->id : 0) ?>

						<div class="control-group">
							<label for="" class="control-label">Username</label>
							<div class="controls">
								<input type="text" name="username" value="<?php echo set_value('username', isset($user) ? $user->username : '') ?>">
							</div>
						</div>

						<div class="control-group">
							<label for="" class="control-label">Password</label>
							<div class="controls">
								<input type="password" name="password" value="" id="password-normal-user-form">
							</div>
						</div>

						<div class="control-group">
							<label for="" class="control-label">Retype password</label>
							<div class="controls">
								<input type="password" name="repassword" value="">
							</div>
						</div>

						<div class="control-group">
							<label for="" class="control-label">Email</label>
							<div class="controls">
								<input type="text" name="email" value="<?php echo set_value('email', isset($user) ? $user->email : '') ?>">
							</div>
						</div>
						 
						<div class="control-group">
							<label for="" class="control-label">First name</label>
							<div class="controls">
								<input type="text" name="first_name" value="<?php echo set_value('first_name', isset($user) ? $user->first_name : '') ?>">
							</div>
						</div>

						<div class="control-group">
							<label for="" class="control-label">Last name</label>
							<div class="controls">
								<input type="text" name="last_name" value="<?php echo set_value('last_name', isset($user) ? $user->last_name : '') ?>">
							</div>
						</div>

						<div class="control-group">
							<label for="" class="control-label">Gender</label>
							<div class="controls">						
								<select name="gender" id="">
									<?php foreach(array('Male', 'Female') as $gender): ?>
									<option value="<?php echo $gender ?>" <?php echo (isset($user) and $user->gender == $gender) ? 'selected="selected"' : '' ?>><?php echo $gender ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>

						<div class="control-group">
							<label for="" class="control-label">Company</label>
							<div class="controls">
								<input type="text" name="company" value="<?php echo set_value('company', isset($user) ? $user->company : '') ?>">
							</div>
						</div>

						<div class="control-group">
							<label for="" class="control-label">Phone</label>
							<div class="controls">
								<input type="text" name="phone" value="<?php echo set_value('phone', isset($user) ? $user->phone : '') ?>">
							</div>
						</div>

						<div class="control-group">
							<div class="controls">
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
						</div>

						<input type="hidden" name="group_id" value="2">

					<?php echo form_close() ?>
				</div>
				<?php endif ?>

				<?php if( !isset($user) || (isset($user) and in_array(3, $users_groups))): ?>
				<div class="<?php echo  (!(isset($user) and in_array(3, $users_groups))) ? 'tab-pane' : '' ?>" id="store-user">
					
					<?php echo form_open('admin/user/edit', 'class="form-horizontal" id="store-user-form"') ?>
						<?php echo form_hidden('id', isset($user) ? $user->id : 0) ?>

						<div class="row-fluid">
							<div class="span6">
								<div class="control-group">
									<label for="" class="control-label">Username</label>
									<div class="controls">
										<input type="text" name="username" value="<?php echo set_value('username', isset($user) ? $user->username : '') ?>">
									</div>
								</div>

								<div class="control-group">
									<label for="" class="control-label">Password</label>
									<div class="controls">
										<input type="password" name="password" value="" id="password-store-user-form">
									</div>
								</div>

								<div class="control-group">
									<label for="" class="control-label">Retype password</label>
									<div class="controls">
										<input type="password" name="repassword" value="">
									</div>
								</div>

								<div class="control-group">
									<label for="" class="control-label">Email</label>
									<div class="controls">
										<input type="text" name="email" value="<?php echo set_value('email', isset($user) ? $user->email : '') ?>">
									</div>
								</div>
								 
								<div class="control-group">
									<label for="" class="control-label">First name</label>
									<div class="controls">
										<input type="text" name="first_name" value="<?php echo set_value('first_name', isset($user) ? $user->first_name : '') ?>">
									</div>
								</div>

								<div class="control-group">
									<label for="" class="control-label">Last name</label>
									<div class="controls">
										<input type="text" name="last_name" value="<?php echo set_value('last_name', isset($user) ? $user->last_name : '') ?>">
									</div>
								</div>

								<div class="control-group">
									<label for="" class="control-label">Gender</label>
									<div class="controls">						
										<select name="gender" id="">
											<?php foreach(array('Male', 'Female') as $gender): ?>
											<option value="<?php echo $gender ?>" <?php echo (isset($user) and $user->gender == $gender) ? 'selected="selected"' : '' ?>><?php echo $gender ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>

								<div class="control-group">
									<label for="" class="control-label">Company</label>
									<div class="controls">
										<input type="text" name="company" value="<?php echo set_value('company', isset($user) ? $user->company : '') ?>">
									</div>
								</div>

								<div class="control-group">
									<label for="" class="control-label">Phone</label>
									<div class="controls">
										<input type="text" name="phone" value="<?php echo set_value('phone', isset($user) ? $user->phone : '') ?>">
									</div>
								</div>

								<div class="control-group">
									<label for="" class="control-label">Avatar</label>
									<div class="controls">
										<input type="file" name="userfile">
										<?php if(isset($user) and $user->avatar !== ''): ?>
										<input type="hidden" name="avatar" value="<?php echo $user->avatar ?>">
										<img class="avatar" src="<?php echo base_url($user->avatar) ?>" style="width: auto">
										<?php endif ?>
									</div>
								</div>
							</div>
							<div class="span6">

								<div class="control-group">
									<label for="" class="control-label">Address</label>
									<div class="controls">
										<input type="text" name="address" value="<?php echo isset($user) ? $user->address : '' ?>">
									</div>
								</div>
								<div class="control-group">
									<label for="" class="control-label">Zip</label>
									<div class="controls">
										<input type="text" name="zip" value="<?php echo isset($user) ? $user->zip : '' ?>">
									</div>
								</div>
								<div class="control-group">
									<label for="" class="control-label">City</label>
									<div class="controls">
										<input type="text" name="city" value="<?php echo isset($user) ? $user->city : '' ?>">
									</div>
								</div>
								<div class="control-group">
									<label for="" class="control-label">Category</label>
									<div class="controls">
										<select name="cat_id" id="">
											<?php if(isset($categories)): foreach($categories as $cat): ?>
											<option value="<?php echo $cat->id ?>" <?php echo (isset($user) and $user->cat_id == $cat->id) ? 'selected="selected"' : '' ?>><?php echo $cat->title ?></option>
											<?php endforeach; endif ?>
										</select>
									</div>
								</div>

								<div class="control-group">
									<label for="" class="control-label">Map</label>
									<div class="controls">
										<div class="input-append">
											<input id="address" type="text">
											<button class="btn" type="button" id="search-map">Search Location!</button>
										</div>
										<div id="map-canvas" style="width: 300px;"></div>
									</div>
								</div>
								
								<input type="hidden" id="longitude" name="longitude" value="<?php echo isset($user) ? $user->longitude : '' ?>">
								<input type="hidden" id="latitude" name="latitude" value="<?php echo isset($user) ? $user->latitude : '' ?>">
							</div>
						</div>
					
						<div class="control-group">
							<label for="" class="control-label">Public page</label>
							<div class="controls">
								<textarea name="public_text" id="public_text" cols="30" rows="10"><?php echo isset($user) ? $user->public_text : '' ?></textarea>
							</div>
						</div>

						<div class="control-group">
							<div class="controls">
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
						</div>

						<input type="hidden" name="group_id" value="3">

					<?php echo form_close() ?>

				</div>
				<?php endif ?>

				<?php if(!isset($user) || (isset($user) and in_array(1, $users_groups))): ?>
				<div class="<?php echo (!(isset($user) and in_array(1, $users_groups))) ? 'tab-pane' : '' ?>" id="admin-user">
					
					<?php echo form_open('admin/user/edit', 'class="form-horizontal" id="admin-user-form"') ?>

						<?php echo form_hidden('id', isset($user) ? $user->id : 0) ?>

						<div class="control-group">
							<label for="" class="control-label">Username</label>
							<div class="controls">
								<input type="text" name="username" value="<?php echo set_value('username', isset($user) ? $user->username : '') ?>">
							</div>
						</div>

						<div class="control-group">
							<label for="" class="control-label">Password</label>
							<div class="controls">
								<input type="password" name="password" value="" id="password-admin-user-form">
							</div>
						</div>

						<div class="control-group">
							<label for="" class="control-label">Retype password</label>
							<div class="controls">
								<input type="password" name="repassword" value="">
							</div>
						</div>

						<div class="control-group">
							<label for="" class="control-label">Email</label>
							<div class="controls">
								<input type="text" name="email" value="<?php echo set_value('email', isset($user) ? $user->email : '') ?>">
							</div>
						</div>
						 
						<div class="control-group">
							<label for="" class="control-label">First name</label>
							<div class="controls">
								<input type="text" name="first_name" value="<?php echo set_value('first_name', isset($user) ? $user->first_name : '') ?>">
							</div>
						</div>

						<div class="control-group">
							<label for="" class="control-label">Last name</label>
							<div class="controls">
								<input type="text" name="last_name" value="<?php echo set_value('last_name', isset($user) ? $user->last_name : '') ?>">
							</div>
						</div>

						<div class="control-group">
							<label for="" class="control-label">Gender</label>
							<div class="controls">						
								<select name="gender" id="">
									<?php foreach(array('Male', 'Female') as $gender): ?>
									<option value="<?php echo $gender ?>" <?php echo (isset($user) and $user->gender == $gender) ? 'selected="selected"' : '' ?>><?php echo $gender ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>

						<div class="control-group">
							<label for="" class="control-label">Company</label>
							<div class="controls">
								<input type="text" name="company" value="<?php echo set_value('company', isset($user) ? $user->company : '') ?>">
							</div>
						</div>

						<div class="control-group">
							<label for="" class="control-label">Phone</label>
							<div class="controls">
								<input type="text" name="phone" value="<?php echo set_value('phone', isset($user) ? $user->phone : '') ?>">
							</div>
						</div>

						<div class="control-group">
							<div class="controls">
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
						</div>

						<input type="hidden" name="group_id" value="1">

					<?php echo form_close() ?>

				</div>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	window.isStore = <?php echo (!isset($user) || (isset($user) and in_array(3, $users_groups))) ? 'true' : 'false' ?>;
</script>